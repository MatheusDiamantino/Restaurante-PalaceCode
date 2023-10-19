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

// Verifica a ocupação do usuário
if ($_SESSION['OCUPACAO'] !== 'Admin') {
    // Se a ocupação não for 'Admin', redireciona para outra página ou mostra uma mensagem de erro
    header("Location: dash.php.php");
    exit();
}


?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <link href="css/table.css" rel="stylesheet">
    <meta name="author" content="">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

    <title>Gerenciador Palacecode</title>

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">


    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="./js/jquery.mask.js"></script>

    <script>
        $("#data").mask("00/00/0000");
    </script>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dash.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <img src="./img/logotcc.png">
                </div>
                <div class="sidebar-brand-text mx-3">Rock Speto</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="dash.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span> Painel de gerenciamento</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <!--Apagado-->


            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link" href="utilities-mesas.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Mesas</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <li class="nav-item">
                <a class="nav-link" href="utilities-cardapio.php">
                    <i class="fas bi-card-checklist"></i>
                    <span>Cardápio</span></a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider">



            <li class="nav-item">
                <a class="nav-link" href="utilities-pedidos.php">
                    <i class="fas fa-fw bi-phone"></i>
                    <span>Pedidos</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">


            <li class="nav-item">
                <a class="nav-link" href="utilities-caixa.php">
                    <i class="fas bi-cash-coin"></i>
                    <span>Caixa</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="tables.php">
                    <i class="fas bi-person-circle"></i>
                    <span>Funcionários</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class=" d-flex flex-column" style="background-image:url(./img/fundo2.png)">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <form class="form-inline">
                        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                            <i class="fa fa-bars"></i>
                        </button>
                    </form>

                    <!-- Topbar Search -->

                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small" placeholder="Pesquisar..." aria-label="Pesquisar" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-dark" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <!-- Nav Item - Alerts -->
                        <!--Apagado-->

                        <div class="topbar-divider d-none d-sm-block"></div>
                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $nomeUsuario ?></span>
                                <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="conta.php">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Perfil
                                </a>

                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Sair da conta
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->



                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-dark">Funcionários</h1>
                    <p class="mb-4">
                        <a target="_blank" href="https://datatables.net"></a>
                    </p>

                    <button id="cadastrar-funcionario" type="button" class="btn btn-link" style="text-decoration: none; margin-bottom: 30px;" value="cadastrar">
                        <i class="fas bi-box-arrow-up-right text-dark" style="float: left; margin-right: 10px; margin-top: 2px;"></i>
                        <h6 class="m-0 font-weight-bold text-dark float-right ">Cadastrar Funcionario</h6>
                    </button>

                    <script>
                        document.getElementById("cadastrar-funcionario").addEventListener("click", function() {
                            window.location.href = "cadastro_funcionario.php";
                        });
                    </script>
                    <?php

                    include './conexao/config.php';

                    try {
                        // Cria uma nova conexão PDO
                        $conn = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
                        // Define o modo de erro PDO para exceções
                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

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
                                                FROM funcionario WHERE situacao = 'ATIVO'";
                        $stmt = $conn->query($query);
                        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    } catch (PDOException $e) {
                        echo "Erro na conexão: " . $e->getMessage();
                    }


                    ?>

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-dark">Gerenciamento de Funcionários</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" method="GET">
                                    <thead>
                                        <tr>
                                            <th>Nome</th>
                                            <th>Ocupação</th>
                                            <th>Idade</th>
                                            <th>Data de início</th>
                                            <th>Salário</th>
                                            <th>Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($results as $row) {
                                        ?>
                                            <tr>
                                                <td><?php echo $row['nome']; ?></td>
                                                <td><?php echo $row['ocupacao']; ?></td>
                                                <td><?php echo $row['idade']; ?></td>
                                                <td><?php echo $row['data_inicio']; ?></td>
                                                <td><?php echo $row['salario']; ?></td>
                                                <td class="text-center">
                                                    <span class="d-none d-md-block">

                                                        <a class="btn btn-outline-primary" href="visualizar.php?id=<?php echo $row['id']; ?>" data-toggle="modal" data-target="#myModal1<?php echo $row['id']; ?>">Visualizar</a>
                                                        <div class="modal fade" id="myModal1<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1<?php echo $row['id']; ?>">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="myModalLabel1<?php echo $row['id']; ?>">Visualizar Dados</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form class="user" action="#" method="GET">
                                                                            <div class="form-group row">
                                                                                <label class="col-sm-4 col-form-label visually-hidden">ID:</label>
                                                                                <div class="col-sm-8">
                                                                                    <input type="hidden" class="form-control form-control-user" value="<?php echo $row['id']; ?>" readonly>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group row">
                                                                                <label class="col-sm-4 col-form-label">CPF:</label>
                                                                                <div class="col-sm-8">
                                                                                    <input type="text" class="form-control form-control-user" value="<?php echo $row['cpf']; ?>" readonly>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group row">
                                                                                <label class="col-sm-4 col-form-label">Nome:</label>
                                                                                <div class="col-sm-8">
                                                                                    <input type="text" class="form-control form-control-user" value="<?php echo $row['nome']; ?>" readonly>
                                                                                </div>
                                                                            </div>
                                                                            <!-- Outros campos para visualização -->
                                                                            <div class="form-group row">
                                                                                <label class="col-sm-4 col-form-label">Email:</label>
                                                                                <div class="col-sm-8">
                                                                                    <input type="text" class="form-control form-control-user" value="<?php echo $row['email']; ?>" readonly>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group row">
                                                                                <label class="col-sm-4 col-form-label">Ocupação:</label>
                                                                                <div class="col-sm-8">
                                                                                    <input type="text" class="form-control form-control-user" value="<?php echo $row['ocupacao']; ?>" readonly>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group row">
                                                                                <label class="col-sm-4 col-form-label">Usuário:</label>
                                                                                <div class="col-sm-8">
                                                                                    <input type="text" class="form-control form-control-user" value="<?php echo $row['usuario']; ?>" readonly>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group row">
                                                                                <label class="col-sm-4 col-form-label">Idade:</label>
                                                                                <div class="col-sm-8">
                                                                                    <input type="text" class="form-control form-control-user" value="<?php echo $row['idade']; ?>" readonly>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group row">
                                                                                <label class="col-sm-4 col-form-label">Senha:</label>
                                                                                <div class="col-sm-8">
                                                                                    <input type="password" class="form-control form-control-user" value="<?php echo $row['senha']; ?>" readonly>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group row">
                                                                                <label class="col-sm-4 col-form-label">RG:</label>
                                                                                <div class="col-sm-8">
                                                                                    <input type="text" class="form-control form-control-user" value="<?php echo $row['rg']; ?>" readonly>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group row">
                                                                                <label class="col-sm-4 col-form-label ">Salário:</label>
                                                                                <div class="col-sm-8">
                                                                                    <input type="text" class="form-control form-control-user" value="<?php echo $row['salario']; ?>" readonly>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group row">
                                                                                <label class="col-sm-4 col-form-label">Telefone:</label>
                                                                                <div class="col-sm-8">
                                                                                    <input type="text" class="form-control form-control-user" value="<?php echo $row['telefone']; ?>" readonly>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group row">
                                                                                <label class="col-sm-4 col-form-label">Data de Início:</label>
                                                                                <div class="col-sm-8">
                                                                                    <input type="text" class="form-control form-control-user" value="<?php echo $row['data_inicio']; ?>" readonly>
                                                                                </div>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <a class="btn btn-outline-warning" href="editar_registro.php?id=<?php echo $row['id']; ?>" data-toggle="modal" data-target="#myModal<?php echo $row['id']; ?>">Editar</a>
                                                        <div class="modal fade" id="myModal<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel<?php echo $row['id']; ?>">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="myModalLabel<?php echo $row['id']; ?>">Formulário de Edição</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form class="user" action="update_registro.php" method="POST" onsubmit="return validarForm()">
                                                                            <div class="form-group row">
                                                                                <input type="hidden" class="form-control form-control-user" name="id" value="<?php echo $row['id']; ?>">
                                                                            </div>
                                                                            <div class="form-group row">
                                                                                <div class="col-sm-12 mb-3 mb-sm-0">
                                                                                    <input type="text" id="cpf" name="cpf" class="form-control form-control-user" placeholder="CPF" value="<?php echo $row['cpf']; ?>" maxlength="14" required>

                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group row">
                                                                                <div class="col-sm-12 mb-3 mb-sm-0">
                                                                                    <input type="text" class="form-control form-control-user" name="nome" value="<?php echo $row['nome']; ?>" placeholder="Nome">
                                                                                </div>
                                                                            </div>
                                                                            <!-- Outros campos para edição -->
                                                                            <div class="form-group row">
                                                                                <div class="col-sm-12">
                                                                                    <input type="email" class="form-control form-control-user" name="email" value="<?php echo $row['email']; ?>" placeholder="E-mail">
                                                                                </div>
                                                                            </div>

                                                                            <div class="form-group row">
                                                                                <div class="col-sm-12">
                                                                                    <input type="text" class="form-control form-control-user" name="ocupacao" value="<?php echo $row['ocupacao']; ?>">
                                                                                </div>
                                                                            </div>

                                                                            <div class="form-group row">
                                                                                <div class="col-sm-12">
                                                                                    <input type="text" class="form-control form-control-user" name="usuario" value="<?php echo $row['usuario']; ?>" placeholder="Usuário">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group row">
                                                                                <div class="col-sm-12">
                                                                                    <input type="text" class="form-control form-control-user" id="idade" name="idade" value="<?php echo $row['idade']; ?>" placeholder="Idade">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group row">
                                                                                <div class="col-sm-12">
                                                                                    <input type="password" class="form-control form-control-user" name="senha" value="<?php echo $row['senha']; ?>" placeholder="Senha">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group row">
                                                                                <div class="col-sm-12">
                                                                                    <input type="text" class="form-control form-control-user" id="rg" name="rg" value="<?php echo $row['rg']; ?>" placeholder="RG">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group row">
                                                                                <div class="col-sm-12">
                                                                                    <input type="text" class="form-control form-control-user" id="salario" name="salario" value="<?php echo $row['salario']; ?>" placeholder="Salário">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group row">
                                                                                <div class="col-sm-12">
                                                                                    <input type="text" class="form-control form-control-user" id="telefone" name="telefone" value="<?php echo $row['telefone']; ?>" placeholder="Telefone">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group row">
                                                                                <div class="col-sm-12">
                                                                                    <input type="text" class="form-control form-control-user" id="data" name="data_inicio" value="<?php echo $row['data_inicio']; ?>" placeholder="Data de Início">
                                                                                </div>
                                                                            </div>
                                                                            <!-- Botão de envio -->
                                                                            <input class="btn btn-light text-dark w-100" type="submit" value="Salvar">
                                                                        </form>

                                                                        <script>
                                                                            // Máscara para o campo CPF
                                                                            document.getElementById('cpf').addEventListener('input', function(e) {
                                                                                let value = e.target.value;
                                                                                value = value.replace(/\D/g, ''); // Remove todos os caracteres não numéricos
                                                                                if (value.length > 11) {
                                                                                    value = value.slice(0, 11); // Limita a 11 caracteres
                                                                                }
                                                                                if (value.length === 11) {
                                                                                    value = value.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, '$1.$2.$3-$4'); // Formato: XXX.XXX.XXX-XX
                                                                                } else if (value.length > 3 && value.length <= 6) {
                                                                                    value = value.replace(/(\d{3})(\d{0,3})/, '$1.$2'); // Formato: XXX.XXX
                                                                                } else if (value.length > 6 && value.length <= 9) {
                                                                                    value = value.replace(/(\d{3})(\d{3})(\d{0,3})/, '$1.$2.$3'); // Formato: XXX.XXX.XXX
                                                                                }
                                                                                e.target.value = value;
                                                                            });

                                                                            // Máscara para o campo RG
                                                                            document.getElementById('rg').addEventListener('input', function(e) {
                                                                                let value = e.target.value;

                                                                                // Remove todos os caracteres não numéricos
                                                                                value = value.replace(/\D/g, '');

                                                                                // Aplica a máscara, no caso, assumindo um formato de 99.999.999-9
                                                                                if (value.length > 0) {
                                                                                    value = value.replace(/^(\d{2})(\d{3})(\d{3})(\d{1})$/, '$1.$2.$3-$4');
                                                                                }

                                                                                e.target.value = value;
                                                                            });
                                                                            document.getElementById('telefone').addEventListener('input', function(e) {
                                                                                let value = e.target.value;

                                                                                // Remove todos os caracteres não numéricos
                                                                                value = value.replace(/\D/g, '');

                                                                                // Aplica a máscara para o formato (99) 9999-9999
                                                                                if (value.length > 2) {
                                                                                    value = `(${value.substring(0, 2)}) ${value.substring(2)}`;
                                                                                    if (value.length > 10) {
                                                                                        value = `${value.substring(0, 10)}-${value.substring(10)}`;
                                                                                    }
                                                                                }

                                                                                e.target.value = value;
                                                                            });


                                                                            function validarCPF() {
                                                                                var cpfInput = document.getElementById('cpf');
                                                                                var cpfValue = cpfInput.value.replace(/[^\d]/g, ''); // Remove caracteres não numéricos
                                                                                if (cpfValue.length !== 11) {
                                                                                    document.getElementById('cpf-error').innerText = 'CPF deve ter 11 dígitos.';
                                                                                    cpfInput.focus();
                                                                                    return false;
                                                                                } else {
                                                                                    document.getElementById('cpf-error').innerText = ''; // Limpa mensagem de erro se o CPF tiver 11 dígitos
                                                                                }
                                                                                return true;
                                                                            }

                                                                            function validarEmail() {
                                                                                var emailInput = document.getElementById('email');
                                                                                var emailValue = emailInput.value.trim(); // Remove espaços em branco do início e do fim

                                                                                // Verifica se o campo de e-mail está vazio
                                                                                if (emailValue === '') {
                                                                                    document.getElementById('email-error').innerText = 'E-mail é obrigatório.';
                                                                                    emailInput.focus();
                                                                                    return false;
                                                                                }

                                                                                // Verifica se o e-mail possui um formato válido
                                                                                var emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
                                                                                if (!emailPattern.test(emailValue)) {
                                                                                    document.getElementById('email-error').innerText = 'E-mail inválido.';
                                                                                    emailInput.focus();
                                                                                    return false;
                                                                                }

                                                                                // Aqui você pode adicionar sua lógica personalizada para permitir ou rejeitar domínios específicos
                                                                                // Por exemplo, você pode permitir apenas e-mails do domínio "example.com"
                                                                                var allowedDomains = ["gmail.com", "example.com"]; // Adicione os domínios permitidos aqui
                                                                                var emailDomain = emailValue.split('@')[1];

                                                                                if (!allowedDomains.includes(emailDomain)) {
                                                                                    document.getElementById('email-error').innerText = 'Este domínio de e-mail não é permitido.';
                                                                                    emailInput.focus();
                                                                                    return false;
                                                                                }

                                                                                // Máscara para o campo CPF
                                                                                document.getElementById('cpf').addEventListener('input', function(e) {
                                                                                    let value = e.target.value;
                                                                                    value = value.replace(/\D/g, ''); // Remove todos os caracteres não numéricos
                                                                                    if (value.length > 11) {
                                                                                        value = value.slice(0, 11); // Limita a 11 caracteres
                                                                                    }
                                                                                    if (value.length >= 4 && value.length <= 6) {
                                                                                        value = value.replace(/(\d{3})(\d{0,3})/, '$1.$2'); // Formato: XXX.XXX
                                                                                    } else if (value.length >= 7 && value.length <= 9) {
                                                                                        value = value.replace(/(\d{3})(\d{3})(\d{0,3})/, '$1.$2.$3'); // Formato: XXX.XXX.XXX
                                                                                    } else if (value.length === 10) {
                                                                                        value = value.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, '$1.$2.$3-$4'); // Formato: XXX.XXX.XXX-XX
                                                                                    }
                                                                                    e.target.value = value;
                                                                                });

                                                                                function validarCPF() {
                                                                                    var cpfInput = document.getElementById('cpf');
                                                                                    var cpfValue = cpfInput.value.replace(/[^\d]/g, ''); // Remove caracteres não numéricos
                                                                                    if (cpfValue.length !== 11) {
                                                                                        document.getElementById('cpf-error').innerText = 'CPF deve ter 11 dígitos.';
                                                                                        cpfInput.focus();
                                                                                        return false;
                                                                                    } else {
                                                                                        document.getElementById('cpf-error').innerText = ''; // Limpa mensagem de erro se o CPF tiver 11 dígitos
                                                                                    }
                                                                                    return true;
                                                                                }


                                                                                // Limpa a mensagem de erro se o e-mail for válido
                                                                                document.getElementById('email-error').innerText = '';
                                                                                return true;
                                                                            }
                                                                        </script>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <a href="deletar_registro.php?id=<?php echo $row['id']; ?>" class="btn btn-outline-danger">Excluir</a>
                                                    </span>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- /.container-fluid -->

                </div>
                <!-- End of Main Content -->

                <!-- Footer -->
                <footer class="sticky-footer">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span>Copyright &copy; PalaceCode 2023</span>
                        </div>
                    </div>
                </footer>
                <!-- End of Footer -->

            </div>
            <!-- End of Content Wrapper -->

        </div>
        <!-- End of Page Wrapper -->

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <!-- Logout Modal-->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Pronto para sair?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Selecione "Sair" abaixo se você está pronto para encerrar sua sessão</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                        <a class="btn btn-dark" href="index.php">Sair</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap core JavaScript-->
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="js/sb-admin-2.min.js"></script>

        <!-- Page level plugins -->
        <script src="vendor/datatables/jquery.dataTables.min.js"></script>
        <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

        <!-- Page level custom scripts -->
        <script src="js/demo/datatables-demo.js"></script>

        <!-- Bootstrap core JavaScript-->
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="js/sb-admin-2.min.js"></script>

        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="js/sb-admin-2.min.js"></script>


        <!-- Page level plugins -->
        <script src="vendor/datatables/jquery.dataTables.min.js"></script>
        <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

        <!-- Page level custom scripts -->
        <script src="js/demo/datatables-demo.js"></script>

</body>

</html>