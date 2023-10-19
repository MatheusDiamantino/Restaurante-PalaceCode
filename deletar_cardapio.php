<?php
if (!session_id()) {
    session_start();
}

require_once("./conexao/config.php");

if (!isset($_GET['id']) || empty($_GET['id'])) {
    $_SESSION['error_message'] = "ID inválido.";
    header("Location: utilities-cardapio.php");
    exit();
}

$id_mesa = $_GET['id'];

try {
    $conn = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Verifica se o registro existe
    $stmtSelect = $conn->prepare("SELECT * FROM cardapio WHERE ID_CARDAPIO = :id");
    $stmtSelect->bindParam(':id', $id_mesa, PDO::PARAM_INT);
    $stmtSelect->execute();

    if ($stmtSelect->rowCount() > 0) {
        // Deleta o registro
        $stmtDelete = $conn->prepare("UPDATE cardapio SET situacao = 'INATIVO' WHERE ID_Cardapio = :id");
        $stmtDelete->bindParam(':id', $id_mesa, PDO::PARAM_INT);
        $resultDelete = $stmtDelete->execute();

        if ($resultDelete) {
            $_SESSION['success_message'] = "Registro deletado com sucesso.";
        } else {
            $_SESSION['error_message'] = "Erro ao deletar registro.";
        }
    } else {
        $_SESSION['error_message'] = "Registro não encontrado.";
    }

    header('Location: utilities-cardapio.php');
    exit();
} catch (PDOException $e) {
    $_SESSION['error_message'] = "Erro na conexão: " . $e->getMessage();
    header("Location: utilities-cardapio.php");
    exit();
}
?>

