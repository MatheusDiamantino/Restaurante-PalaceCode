<?php
// Inicie a sessão
// Start session
if(!session_id()){
    session_start();
}
require_once "./conexao/config.php";


// Verifique se o usuário está autenticado
if (isset($_SESSION['usuario'])) {
    // Obtém o nome do usuário e a ocupação da sessão
    $nomeUsuario = $_SESSION['usuario'];
    $ocupacaoUsuario = $_SESSION['OCUPACAO'];

    // Agora você tem o nome do usuário e a ocupação disponíveis para uso
} else {
    // Usuário não autenticado, redirecione para a página de login
    header("Location: index.php");
    exit();
}

?>