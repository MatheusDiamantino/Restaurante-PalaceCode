<?php
include_once('./conexao/config.php');

$id_mesa = $_GET['id'];

try {
    // Verifica se o registro da mesa existe
    $stmtSelect = $conn->prepare("SELECT * FROM mesas WHERE id_mesa = :id");
    $stmtSelect->bindParam(':id', $id_mesa);
    $stmtSelect->execute();

    if ($stmtSelect->rowCount() > 0) {
        // Verifica se existem pedidos associados a essa mesa
        $stmtCheckPedido = $conn->prepare("SELECT * FROM Pedidos WHERE id_mesa = :id_mesa AND situacao = 'ATIVO'");
        $stmtCheckPedido->bindParam(':id_mesa', $id_mesa);
        $stmtCheckPedido->execute();

        if ($stmtCheckPedido->rowCount() > 0) {
            // Se houver pedidos ativos, você pode definir a situação da mesa para 'INATIVO' e atualizar os pedidos
            $stmtUpdateMesa = $conn->prepare("UPDATE mesas SET situacao = 'INATIVO' WHERE id_mesa = :id");
            $stmtUpdateMesa->bindParam(':id', $id_mesa);
            $resultUpdateMesa = $stmtUpdateMesa->execute();

            if ($resultUpdateMesa) {
                // Atualiza os pedidos relacionados a esta mesa para 'INATIVO'
                $stmtUpdatePedidos = $conn->prepare("UPDATE Pedidos SET situacao = 'INATIVO' WHERE id_mesa = :id_mesa");
                $stmtUpdatePedidos->bindParam(':id_mesa', $id_mesa);
                $resultUpdatePedidos = $stmtUpdatePedidos->execute();

                if ($resultUpdatePedidos) {
                    echo "Mesa e pedidos relacionados marcados como INATIVOS com sucesso.";
                } else {
                    echo "Erro ao atualizar pedidos.";
                }
            } else {
                echo "Erro ao atualizar mesa.";
            }
        } else {
            // Se não houver pedidos ativos, apenas atualizamos a situação da mesa para 'INATIVO'
            $stmtUpdateMesa = $conn->prepare("UPDATE mesas SET situacao = 'INATIVO' WHERE id_mesa = :id");
            $stmtUpdateMesa->bindParam(':id', $id_mesa);
            $resultUpdateMesa = $stmtUpdateMesa->execute();

            if ($resultUpdateMesa) {
                echo "Mesa marcada como INATIVA com sucesso.";
            } else {
                echo "Erro ao atualizar mesa.";
            }
        }
    } else {
        echo "Registro da mesa não encontrado.";
    }

    header('Location: utilities-mesas.php');
    exit();
} catch (PDOException $e) {
    // Trata erros de conexão PDO
    echo "Erro na conexão: " . $e->getMessage();
}
?>
