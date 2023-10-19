<?php 

// Start session
if (!session_id()) {
    session_start();
}

require_once "./conexao/config.php";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Verifica se o parâmetro 'id' foi enviado via GET
    if(isset($_GET['id'])) {
        $id = $_GET['id'];

        try {
            // Cria uma nova conexão PDO
            $conn = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
            // Define o modo de erro PDO para exceções
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Consulta para selecionar os dados com base no ID
            $sqlSelect = "SELECT * FROM funcionario WHERE ID_FUNC = :id";
            $stmt = $conn->prepare($sqlSelect);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            // Verifica se há resultados
            if($stmt->rowCount() > 0) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                // Exiba os dados
                echo "ID: " . $row['ID_FUNC'] . "<br>";
                echo "CPF: " . $row['CPF_FUNC'] . "<br>";
                echo "Nome: " . $row['NOME_FUNC'] . "<br>";
                // Exiba os outros campos aqui
            } else {
                echo "Nenhum resultado encontrado.";
            }
        } catch(PDOException $e) {
            echo "Erro na conexão: " . $e->getMessage();
        }
    }
}
?>


