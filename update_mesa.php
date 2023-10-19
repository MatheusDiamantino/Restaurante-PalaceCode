<?php
// Start session
if (!session_id()) {
    session_start();
}

require_once "./conexao/config.php";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém os valores dos campos do formulário
    $mesa = $_POST['mesa'];

    // Conexão com o banco de dados e tratamento de exceções

    try {
        // Cria a conexão PDO
        $conn = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
        // Define o modo de erro PDO para exceções
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prepara a declaração SQL para atualizar o registro
        $stmt = $conn->prepare("UPDATE mesas SET numero_mesa = :mesa WHERE numero_mesa = :mesa");

        // Vincula os parâmetros aos marcadores de posição
        $stmt->bindParam(':mesa', $mesa);


        // Executa a declaração preparada
        if ($stmt->execute()) {
            // Verifica se o registro foi atualizado com sucesso
            if ($stmt->rowCount() > 0) {
                header("Location: utilities-mesas.php");
                // Outras ações após a atualização
            } else {
                echo "Nenhum registro foi atualizado.";
            }
        } else {
            echo "Erro na execução da declaração: " . $stmt->errorInfo()[2];
        }
    } catch (PDOException $e) {
        // Trata erros de conexão PDO
        echo "Erro na conexão: " . $e->getMessage();
    }
}

?>
