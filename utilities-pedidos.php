<?php

// Start session
if (!session_id()) {
    session_start();
}
require_once "./conexao/config.php";
require_once "UsuarioName.php";

// Verifica se o usuário está autenticado
if (!isset($_SESSION['usuario'])) {
    // Redireciona para a página de login
    header("Location: index.php");
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
    <meta name="author" content="">

    <title>Gerenciador Palacecode</title>

    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="css/pedidos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">

    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <script type="text/javascript" src="js/pedido.js"></script>

    <style>
@keyframes fadeInDown {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}

@keyframes scaleUp {
    from {
        transform: scale(1);
    }
    to {
        transform: scale(1.05);
    }
}

.fadeInDownTable {
    animation: fadeInDown 1s ease-in-out;
}

.scaleUpTable:hover {
    animation: scaleUp 0.3s ease-in-out;
}



    </style>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dash.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <img src="./img/logotcc.png" id="imagem" class="logo-tcc" onmouseover="aumentarImagem()" onmouseout="diminuirImagem()">
                </div>
                <div class="sidebar-brand-text mx-2">Rock Speto</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="dash.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Painel de gerenciamento</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>

            <!-- Nav Item - Pages Collapse Menu -->

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
            <hr class="sidebar-divider">


            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column" style="background-image:url(./img/fundo2.png)">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-dark  topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

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
                                        <input type="text" class="form-control bg-dark border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <!-- Nav Item - Alerts -->


                        <!-- Nav Item - Messages -->

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $nomeUsuario; ?></span>
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
                <div class="container">
    <h1 class="h1 mb-4 text-dark">Pedidos</h1>

                    <?php
                    include './conexao/config.php';

                    try {
                        // Cria uma nova conexão PDO
                        $query = "SELECT 
                        p.ID_Pedido AS id_pedido,
                        m.numero_mesa,
                        c.nome AS nome_cardapio,
                        p.valorTotal AS total,
                        p.descricao AS descricao,
                        p.quantidade AS qtd,
                        p.situacao,
                        p.ID_FUNC
                    FROM Pedidos p
                    INNER JOIN mesas m ON p.id_mesa = m.id_mesa
                    INNER JOIN cardapio c ON p.ID_CARDAPIO = c.ID_CARDAPIO
                    WHERE p.situacao = 'ATIVO';
";
                        $stmt = $conn->query($query);
                        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    } catch (PDOException $e) {
                        echo "Erro na conexão: " . $e->getMessage();
                    }

                    $pedidos_por_mesa = array(); // Array para armazenar pedidos por número de mesa

                    foreach ($results as $row3) {
                        $numero_mesa = $row3['numero_mesa'];

                        // Adicione o pedido ao array correspondente à mesa
                        if (!isset($pedidos_por_mesa[$numero_mesa])) {
                            $pedidos_por_mesa[$numero_mesa] = array();
                        }
                        $pedidos_por_mesa[$numero_mesa][] = $row3;
                    }
                    ?>

<div class="row">
        <?php foreach ($pedidos_por_mesa as $numero_mesa => $pedidos) { ?>
            <div class="col-lg-6 col-md-12 mb-4">
                <div class="card shadow animate__animated animate__fadeIn">
                    <div class="card-header bg-primary text-white">
                        <h6 class="m-0 font-weight-bold">Mesa <?php echo $numero_mesa; ?></h6>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered mb-0 fadeInDownTable"> <!-- Adicione a classe fadeInDownTable apenas à tabela -->
                            <tr>
                                <th>Combo</th>
                                <th>Descrição</th>
                                <th>Quantidade</th>
                                <th>Status</th>
                            </tr>
                            <?php foreach ($pedidos as $pedido) { ?>
                                <tr>
                                    <td><?php echo $pedido['nome_cardapio']; ?></td>
                                    <td><?php echo $pedido['descricao']; ?></td>
                                    <td><?php echo $pedido['qtd']; ?></td>
                                    <td><?php echo $pedido['situacao']; ?></td>
                                </tr>
                            <?php } ?>
                        </table>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
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
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                    <a class="btn btn-dark" href="index.php">Sair</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Bootstrap core JavaScript-->
                    <script type="text/javascript" src="js/pedido.js"></script>
                    <script src="vendor/jquery/jquery.min.js"></script>
                    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

                    <!-- Core plugin JavaScript-->
                    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

                    <!-- Custom scripts for all pages-->
                    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>