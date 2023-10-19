<?php
$hostname = 'REMOVIDO';  // Endereço do servidor do banco de dados
$port = '3306';
$username = 'REMOVIDO';  // Nome de usuário do banco de dados
$password = 'REMOVIDO';  // Senha do banco de dados
$database = 'REMOVIDO';  // Nome do banco de dados

//
// Cria a conexão com o banco de dados
$conn = mysqli_connect($hostname, $username, $password, $database,$port);

// Verifica se a conexão foi estabelecida corretamente
if (!$conn) {
    die('Erro na conexão com o banco de dados: ' . mysqli_connect_error());
}
?>