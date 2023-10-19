<?php
// Start session
if (!session_id()) {
    session_start();
}

require_once "./conexao/config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém os valores enviados no formulário de login
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];

    try {
        // Cria uma nova conexão PDO
        $conn = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
        // Define o modo de erro PDO para exceções
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prepara a consulta SQL para verificar as credenciais do usuário
        $stmt = $conn->prepare("SELECT * FROM funcionario WHERE USUARIO = :usuario AND SENHA = :senha LIMIT 1");
        $stmt->bindParam(':usuario', $usuario);
        $stmt->bindParam(':senha', $senha);
        $stmt->execute();

        // Verifica se a consulta retornou algum resultado
        if ($stmt->rowCount() > 0) {
            // Obtém os dados do usuário
            $dadosUsuario = $stmt->fetch(PDO::FETCH_ASSOC);

            // Verifica se a situação do usuário é ATIVO
            if ($dadosUsuario['situacao'] !== 'ATIVO') {
                // Se a situação não for ATIVO, redirecione para o index
                header("Location: index.php");
                exit();
            }

            // A conta está ativa, então continua com o login

            // Obtém a ocupação do usuário a partir dos dados do usuário
            $ocupacaoDoUsuario = $dadosUsuario['OCUPACAO'];

            // Armazena a ocupação do usuário na sessão
            $_SESSION['OCUPACAO'] = $ocupacaoDoUsuario;

            // Armazena os dados do usuário na sessão
            $_SESSION['usuario'] = $dadosUsuario['USUARIO'];

            header("Location: dash.php");
            exit();
        } else {
            // Credenciais inválidas, exibe uma mensagem de erro
            header("Location: index.php");
            exit();
        }
    } catch (PDOException $e) {
        // Trata erros de conexão PDO
        echo "Erro na conexão: " . $e->getMessage();
    }
}

// Verifica se o usuário está autenticado
if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit();
}
?>
