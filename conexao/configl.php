<?php
$hostname = 'localhost';  // Endereço do servidor do banco de dados
$username = 'root';  // Nome de usuário do banco de dados
$password = '';  // Senha do banco de dados
$database = 'banco_tcc';  // Nome do banco de dados



// Cria a conexão com o banco de dados
$conn = mysqli_connect($hostname, $username, $password, $database);

// Verifica se a conexão foi estabelecida corretamente
if (!$conn) {
    die('Erro na conexão com o banco de dados: ' . mysqli_connect_error());
}
?>