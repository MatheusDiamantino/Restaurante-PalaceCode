<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(isset($_POST['id_mesa'])) {
        try {
            require_once "./conexao/config.php"; // Inclua o código de conexão com o banco de dados aqui

            $id_mesa = $_POST['id_mesa'];

            $queryUpdate = "UPDATE Pedidos SET situacao = 'INATIVO' WHERE id_mesa = :id_mesa";
            $stmtUpdate = $conn->prepare($queryUpdate);
            $stmtUpdate->bindParam(':id_mesa', $id_mesa, PDO::PARAM_INT);
            $stmtUpdate->execute();

            // Redirecione de volta para a tabela de pedidos da mesa
            header("Location: utilities-caixa.php?id_mesa=" . $id_mesa); // Substitua pelo URL apropriado
            exit();

        } catch (PDOException $e) {
            // Trate erros do banco de dados
            echo "Erro na conexão: " . $e->getMessage();
        }
    }
}
?>
