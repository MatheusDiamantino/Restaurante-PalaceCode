<?php
$hostname = '149.100.155.114';  // Endereço do servidor do banco de dados
$port = '3306';
$username = 'u266684669_matheus';  // Nome de usuário do banco de dados
$password = 'Dteles100!';  // Senha do banco de dados
$database = 'u266684669_palacecode';  // Nome do banco de dados

//
// Cria a conexão com o banco de dados
$conn = mysqli_connect($hostname, $username, $password, $database,$port);

// Verifica se a conexão foi estabelecida corretamente
if (!$conn) {
    die('Erro na conexão com o banco de dados: ' . mysqli_connect_error());
}
?>