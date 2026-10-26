<?php
// Credenciais carregadas de conexao/config.php (não versionado; veja conexao/config.example.php)
require_once "./conexao/config.php";


// Cria uma conexão com o MySQL
$conn = new mysqli($hostname, $username, $password, $database, (int) $port);

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