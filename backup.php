<?php
if (!session_id()) {
    session_start();
}

require_once("./conexao/config.php");

try {
    // Dados de conexão com o banco de dados
    $conn = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Nome do arquivo de backup
    $backupFileName = 'backup_' . date('Y-m-d_H-i-s') . '.sql';

    // Obter todas as tabelas do banco de dados
    $tables = $conn->query('SHOW TABLES')->fetchAll(PDO::FETCH_COLUMN);

    // Iniciar a saída do backup
    $output = "-- MySQL Backup\n";
    $output .= "-- Data: " . date('Y-m-d H:i:s') . "\n\n";

    foreach ($tables as $table) {
        $output .= "-- Tabela: $table\n";
        $output .= "CREATE TABLE IF NOT EXISTS `$table` (\n";

        // Obter a estrutura da tabela
        $tableInfo = $conn->query("SHOW CREATE TABLE `$table`")->fetch(PDO::FETCH_ASSOC);
        $output .= $tableInfo['Create Table'] . ";\n\n";

        // Obter os dados da tabela
        $rows = $conn->query("SELECT * FROM `$table`")->fetchAll(PDO::FETCH_ASSOC);
        foreach ($rows as $row) {
            $output .= "INSERT INTO `$table` VALUES (";
            $values = [];
            foreach ($row as $value) {
                if ($value === null) {
                    $values[] = "NULL";
                } else {
                    $values[] = $conn->quote($value);
                }
            }
            $output .= implode(', ', $values) . ");\n";
        }

        $output .= "\n";
    }

    // Gravar o backup em um arquivo
    file_put_contents($backupFileName, $output);

    // Fazer o download do arquivo de backup
    header("Content-disposition: attachment; filename=$backupFileName");
    header("Content-type: application/sql");
    readfile($backupFileName);

    // Remover o arquivo de backup após o download
    unlink($backupFileName);
} catch(PDOException $e) {
    echo "Erro: " . $e->getMessage();
}

// Fechar a conexão PDO
$conn = null;
?>
