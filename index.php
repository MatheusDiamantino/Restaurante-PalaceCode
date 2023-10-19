<?php
// Start session
if (!session_id()) {
    session_start();
}
require_once "./conexao/config.php";
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/animate.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/animate.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" defer></script>
    <link rel="stylesheet" type="text/css" href="./css/index.css">
    <title>Login</title>
</head>

<body class="corpo">
    <div class="container d-flex justify-content-center align-items-center">
        <img class="logo position-fixed" src="./img/palacelogo1.png">
        <form action="dash.php" method="POST">
            <div class="card bg-transparent">
                <a class="login">Login</a>
                <div class="inputBox">
                    <input type="text" name="usuario" required="required">
                    <span class="user">Username</span>
                </div>
                <div class="inputBox">
                    <input type="password" name="senha" required="required">
                    <span>Password</span>
                </div>
                <input type="submit" value="entrar" class="enter"></input>
            </div>
        </form>
    </div>
</body>

</html>