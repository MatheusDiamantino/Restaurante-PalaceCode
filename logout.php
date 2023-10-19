<?php 

// Start session
if(!session_id()){
    session_start();
}
require_once "./conexao/config.php";

unset($_SESSION['usuario']);

header("Location: index.php");

?>