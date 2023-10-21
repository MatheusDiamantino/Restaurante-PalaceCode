<?php
if (!session_id()) {
    session_start();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mesa = $_POST['numero_mesa'];
    $data_reserva = $_POST['data_reserva'];
    $hora_reserva = $_POST['hora_reserva'];

    require_once "./conexao/config.php";

    try {
        $conn = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Verificar se a mesa já existe
        $checkStmt = $conn->prepare("SELECT * FROM mesas WHERE numero_mesa = :mesa");
        $checkStmt->bindParam(':mesa', $mesa);
        $checkStmt->execute();
        $existingMesa = $checkStmt->fetch(PDO::FETCH_ASSOC);

        if ($existingMesa) {
            // A mesa existe, então atualize os campos data_reserva e hora_reserva
            $updateStmt = $conn->prepare("UPDATE mesas SET data_reserva = :data_reserva, hora_reserva = :hora_reserva, statusMesa = 'Reservada' WHERE numero_mesa = :mesa");
            $updateStmt->bindParam(':data_reserva', $data_reserva);
            $updateStmt->bindParam(':hora_reserva', $hora_reserva);
            $updateStmt->bindParam(':mesa', $mesa);

            if ($updateStmt->execute()) {
                echo "Os campos data_reserva e hora_reserva foram atualizados com sucesso, e o status da mesa foi definido como 'Reservada'.";

                // Verificar se a mesa está inativa e atualizá-la para ativa
                if ($existingMesa['situacao'] == 'INATIVO') {
                    $updateStatusStmt = $conn->prepare("UPDATE mesas SET situacao = 'ATIVO' WHERE numero_mesa = :mesa");
                    $updateStatusStmt->bindParam(':mesa', $mesa);
                    $updateStatusStmt->execute();
                    echo "A mesa estava INATIVA e foi atualizada para ATIVA.";
                }
            } else {
                echo "Erro ao atualizar os campos data_reserva e hora_reserva da mesa.";
            }
        } else {
            // Se a mesa não existir, insira uma nova mesa com os dados fornecidos e status 'Reservada'
            $insertStmt = $conn->prepare("INSERT INTO mesas (numero_mesa, data_reserva, hora_reserva, situacao, statusMesa) VALUES (:mesa, :data_reserva, :hora_reserva, 'ATIVO', 'Reservada')");
            $insertStmt->bindParam(':mesa', $mesa);
            $insertStmt->bindParam(':data_reserva', $data_reserva);
            $insertStmt->bindParam(':hora_reserva', $hora_reserva);

            if ($insertStmt->execute()) {
                echo "Mesa criada com sucesso e definida como 'Reservada'.";
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
