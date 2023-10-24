<?php
if (!session_id()) {
    session_start();
}
require_once "./conexao/config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['mesa']) && !empty($_POST['mesa'])) {
        $mesa = $_POST['mesa'];

        require_once "./conexao/config.php";

        try {
            $conn = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $statusMesa = 'DISPONIVEL';  // Defina o status como "Disponível"

            $checkStmt = $conn->prepare("SELECT * FROM mesas WHERE numero_mesa = :mesa");
            $checkStmt->bindParam(':mesa', $mesa);
            $checkStmt->execute();
            $existingMesa = $checkStmt->fetch(PDO::FETCH_ASSOC);

            if ($existingMesa) {
                if ($existingMesa['situacao'] == 'INATIVO') {
                    $updateStmt = $conn->prepare("UPDATE mesas SET situacao = 'ATIVO', statusMesa = :statusMesa, data_reserva = NULL, hora_reserva = NULL WHERE numero_mesa = :mesa");
                    $updateStmt->bindParam(':mesa', $mesa);
                    $updateStmt->bindParam(':statusMesa', $statusMesa);
                    if ($updateStmt->execute()) {
                        echo "A mesa já existe, mas a situação foi atualizada para ATIVO e status definido como Disponível.";
                    } else {
                        echo "Erro ao atualizar a situação da mesa.";
                    }
                } else {
                    echo "A mesa já existe e está ATIVA.";
                }
            } else {
                $insertStmt = $conn->prepare("INSERT INTO mesas (numero_mesa, situacao, statusMesa, data_reserva, hora_reserva) VALUES (:mesa, 'ATIVO', :statusMesa, NULL, NULL)");
                $insertStmt->bindParam(':mesa', $mesa);
                $insertStmt->bindParam(':statusMesa', $statusMesa);
                if ($insertStmt->execute()) {
                    echo "Mesa criada com sucesso com status Disponível.";
                } else {
                    echo "Erro ao inserir a mesa.";
                }
            }

            header("Location: utilities-mesas.php");
            exit();
        } catch (PDOException $e) {
            echo "Erro na conexão: " . $e->getMessage();
        }
    } else {
        echo "Número da mesa não foi especificado.";
    }
}
?>