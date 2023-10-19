<?php

// Start session
if (!session_id()) {
    session_start();
}
require_once "./conexao/config.php";
require_once "UsuarioName.php";
require_once "visualizar.php";

// Verifica se o usuário está autenticado
if (!isset($_SESSION['usuario'])) {
    // Redireciona para a página de login
    header("Location: index.php");
    exit();
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Gerenciador PalaceCode</title>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="css/perfil.css" rel="stylesheet">

</head>

<body class="page-top" style="background-image:url(./img/fundo2.png)">

    <div class="container" >
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0 small-card-body">
                <div class="row">
                    <div class="col1 col-lg-5 d-none d-lg-block" style="background-color: gray">
                        <img id="palace" src="./img/palacelogo1.png">
                        <img id="rock" src="./img/logotcc.png">
                    </div>
                    <div class="col-lg-7">
                        <div class="p-5" >
                            <div class="text-center" >
                                <h1 class="h2 text-dark mb-4">Funcionário</h1>
                                <hr>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                                    onclick="window.location.href='dash.php'">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <?php

                            include './conexao/config.php';

                            try {
                                // Cria uma nova conexão PDO
                                $conn = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
                                // Define o modo de erro PDO para exceções
                                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                                // Obtém o ID do usuário logado
                                $idUsuario = isset($_SESSION['usuario']) ? $_SESSION['usuario'] : '';

                                $query = "SELECT ID_FUNC as id,
                                                CPF_FUNC as cpf,
                                                NOME_FUNC as nome,
                                                EMAIL_FUNC as email,
                                                OCUPACAO as ocupacao,
                                                USUARIO as usuario,
                                                IDADE_TRA as idade,
                                                SENHA as senha,
                                                RG_FUNC as rg,
                                                SALARIO_FUNC as salario,
                                                TELEFONE_FUNC as telefone,
                                                DATE_FORMAT(DATA_INICIO, '%d/%m/%Y') as data_inicio,
                                                FORMAT(SALARIO_FUNC, 2, 'pt_BR') as salario
                                        FROM funcionario
                                        WHERE USUARIO = :idUsuario";
                                $stmt = $conn->prepare($query);
                                $stmt->bindParam(':idUsuario', $idUsuario);
                                $stmt->execute();
                                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                            } catch (PDOException $e) {
                                echo "Erro na conexão: " . $e->getMessage();
                            }

                            ?>
                            <form class="user" method="GET" action="visualizar.php">
                            <input type="hidden" class="form-control" value="<?php echo htmlspecialchars($idUsuario); ?>" readonly>

                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label class="font-weight-bold">Nome</label>
                                        <input type="text" class="form-control" value="<?php echo $row['nome']; ?>"
                                            readonly>
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="font-weight-bold">Email</label>
                                        <input type="email" class="form-control" value="<?php echo $row['email']; ?>"
                                            readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label class="font-weight-bold">Senha</label>
                                        <input type="password" class="form-control"
                                            value="<?php echo $row['senha']; ?>" readonly>
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="font-weight-bold">CPF</label>
                                        <input type="text" class="form-control" value="<?php echo $row['cpf']; ?>"
                                            id="CPF" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label class="font-weight-bold">Telefone</label>
                                        <input type="text" class="form-control"
                                            value="<?php echo $row['telefone']; ?>" id="Telefone" readonly>
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="font-weight-bold">Usuário</label>
                                        <input type="text" class="form-control"
                                            value="<?php echo $row['usuario']; ?>" id="Usuário" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label class="font-weight-bold">Ocupação</label>
                                        <input type="text" class="form-control"
                                            value="<?php echo $row['ocupacao']; ?>" id="Ocupação" readonly>
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="font-weight-bold">Salário</label>
                                        <input type="text" class="form-control"
                                            value="<?php echo $row['salario']; ?>" id="Salário" readonly>
                                    </div>
                                </div>
                            </form>
                            <hr>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>
</body>

</html>
