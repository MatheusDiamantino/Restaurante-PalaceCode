<?php
// Start session
if (!session_id()) {
    session_start();
}

include_once('./conexao/config.php');

if (!empty($_GET['id'])) {
    $id = $_GET['id'];

    try {
        // Cria uma nova conexão PDO
        $conn = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
        // Define o modo de erro PDO para exceções
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Verifica se o registro existe
        $stmtSelect = $conn->prepare("SELECT * FROM funcionario WHERE ID_FUNC = :id");
        $stmtSelect->bindParam(':id', $id);
        $stmtSelect->execute();

        if ($stmtSelect->rowCount() > 0) {
            // Deleta o registro
            $stmtDelete = $conn->prepare("UPDATE funcionario SET situacao = 'INATIVO' WHERE ID_FUNC = :id");
            $stmtDelete->bindParam(':id', $id);
            $resultDelete = $stmtDelete->execute();

            if ($resultDelete) {
                echo "Registro deletado com sucesso.";
            } else {
                echo "Erro ao deletar registro.";
            }
        }
    } catch (PDOException $e) {
        // Trata erros de conexão PDO
        echo "Erro na conexão: " . $e->getMessage();
    }

    header('Location: tables.php');
    exit();
} else {
    // ID vazio, redireciona de volta para a página anterior
    header('Location: tables.php');
    exit();
}
?>
