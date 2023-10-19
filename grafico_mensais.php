<?php
$hostname = '149.100.155.114';  // Endereço do servidor do banco de dados
$port = '3306';
$username = 'u266684669_matheus';  // Nome de usuário do banco de dados
$password = 'Dteles100!';  // Senha do banco de dados
$database = 'u266684669_palacecode';  // Nome do banco de dados


// Cria uma conexão com o MySQL
$conn = new mysqli($hostname, $username, $password, $database);

// Verifica a conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Consulta para buscar os dados (substitua com sua própria consulta SQL)
$sql = "SELECT DATE_FORMAT(timestamp, '%Y-%m') as mes, SUM(valorTotal) as vendas FROM Pedidos GROUP BY mes";
$result = $conn->query($sql);

$data = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $data[] = array(
            "mes" => $row["mes"],
            "vendas" => $row["vendas"]
        );
    }
}

// Fecha a conexão com o MySQL
$conn->close();

// Retorna os dados como JSON
echo json_encode($data);
?>