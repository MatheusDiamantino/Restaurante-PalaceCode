<?php
$hostname = '149.100.155.114';  // Endereço do servidor do banco de dados
$port = '3306';
$username = 'u266684669_matheus';  // Nome de usuário do banco de dados
$password = 'Dteles100!';  // Senha do banco de dados
$database = 'u266684669_palacecode';  // Nome do banco de dados

try {
    // Cria a conexão com o banco de dados usando PDO
    $conn = new PDO("mysql:host=$hostname;port=$port;dbname=$database", $username, $password);

    // Configura o modo de erro do PDO para exceções
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    // Em caso de erro na conexão, exibe a mensagem de erro
    echo "Erro na conexão com o banco de dados: " . $e->getMessage();
}
?>
