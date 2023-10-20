<?php
if (!session_id()) {
    session_start();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mesa = $_POST['mesa'];

    require_once "./conexao/config.php";

    try {
        $conn = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $checkStmt = $conn->prepare("SELECT * FROM mesas WHERE numero_mesa = :mesa");
        $checkStmt->bindParam(':mesa', $mesa);
        $checkStmt->execute();
        $existingMesa = $checkStmt->fetch(PDO::FETCH_ASSOC);

        if ($existingMesa) {
            if ($existingMesa['situacao'] == 'INATIVO') {
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
            $insertStmt = $conn->prepare("INSERT INTO mesas (numero_mesa, situacao) VALUES (:mesa, 'DISPONIVEL')");
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
        echo "Erro na conexão: " . $e->getMessage();
    }
}

?>
