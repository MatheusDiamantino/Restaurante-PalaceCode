<?php
$hostname = 'localhost';  // Endereço do servidor do banco de dados
$username = 'root';  // Nome de usuário do banco de dados
$password = '';  // Senha do banco de dados
$database = 'banco_tcc';  // Nome do banco de dados


try {
    // Cria a conexão com o banco de dados usando PDO
    $conn = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);

    // Configura o modo de erro do PDO para exceções
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOException $e) {
    // Em caso de erro na conexão, exibe a mensagem de erro
    echo "Erro na conexão com o banco de dados: " . $e->getMessage();
}
?>
