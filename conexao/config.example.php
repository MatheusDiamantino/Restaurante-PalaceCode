<?php
// Copie este arquivo para conexao/config.php e preencha com os dados do seu MySQL.
// O arquivo conexao/config.php não é versionado (.gitignore).
$hostname = 'localhost';
$port     = '3306';
$username = 'root';
$password = '';
$database = 'restaurante';

try {
    $conn = new PDO("mysql:host=$hostname;port=$port;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erro na conexão com o banco de dados: " . $e->getMessage();
}
