<?php
// Start session
if (!session_id()) {
    session_start();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Define o email e senha esperados
    $mesa = $_POST['mesa'];

    require_once "./conexao/config.php";

    try {
        // Cria uma nova conexão PDO
        $conn = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
        // Define o modo de erro PDO para exceções
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Verifica se a mesa já existe no banco de dados
        $checkStmt = $conn->prepare("SELECT * FROM mesas WHERE numero_mesa = :mesa");
        $checkStmt->bindParam(':mesa', $mesa);
        $checkStmt->execute();
        $existingMesa = $checkStmt->fetch(PDO::FETCH_ASSOC);

        if ($existingMesa) {
            // A mesa já existe no banco de dados, então vamos verificar a situação
            if ($existingMesa['situacao'] == 'INATIVO') {
                // Se a mesa estiver INATIVA, atualize a situação para ATIVO
                $updateStmt = $conn->prepare("UPDATE mesas SET situacao = 'ATIVO' WHERE numero_mesa = :mesa");
                $updateStmt->bindParam(':mesa', $mesa);
                if ($updateStmt->execute()) {
                    echo "A mesa já existe, mas a situação foi atualizada para ATIVO.";
                } else {
                    echo "Erro ao atualizar a situação da mesa.";
                }
            } else {
                echo "A mesa já existe e está ATIVA.";
            }
        } else {
            // A mesa não existe, então crie uma nova
            $insertStmt = $conn->prepare("INSERT INTO mesas (numero_mesa) VALUES (:mesa)");
            $insertStmt->bindParam(':mesa', $mesa);
            if ($insertStmt->execute()) {
                echo "Mesa criada com sucesso!";
            } else {
                echo "Erro ao inserir a mesa.";
            }
        }

        header("Location: utilities-mesas.php");
        exit();

    } catch (PDOException $e) {
        // Trata erros de conexão PDO
        echo "Erro na conexão: " . $e->getMessage();
    }
}
?>
