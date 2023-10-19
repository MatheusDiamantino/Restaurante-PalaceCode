<?php

// Start session
if (!session_id()) {
    session_start();
}
require_once "./conexao/config.php";
require_once "logar.php";
require_once "UsuarioName.php";

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
    <link rel="icon" type="image/x-icon" href="./img/palacelogo1.png" sizes="100x100">


    <title>Gerenciador Palacecode</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="css/dash1.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

    <style>
        @keyframes rubberBand {
            0% {
                transform: scale(1);
            }

            30% {
                transform: scale(1.25);
            }

            40% {
                transform: scale(0.95);
            }

            60% {
                transform: scale(1.15);
            }

            100% {
                transform: scale(1);
            }
        }

        .rubberBand {
            animation-name: rubberBand;
            animation-duration: 1s;
            animation-timing-function: ease-in-out;
        }

        .card1 {
            transition: transform 0.3s ease-in-out;
        }

        .card1:hover {
            transform: scale(1.1);
        }

        .custom-button {
            background-color: transparent;
            /* Fundo transparente */
            color: #333;
            /* Cor do texto (cinza escuro) */
            border: none;
            /* Remova a borda */
            border-radius: 5px;
            /* Borda arredondada */
            padding: 10px 20px;
            /* Espaçamento interno */
            font-size: 16px;
            /* Tamanho da fonte */
            text-decoration: none !important;
            /* Remova a decoração de texto */
        }

        .custom-button i {
            font-size: 20px;
            /* Tamanho do ícone */
            margin-right: 5px;
            /* Espaçamento à direita do ícone */
        }
    </style>

</head>

<body id="page-top ">


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
            <li class="nav-item active">
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
        <div id="content-wrapper" class="fundo-2 d-flex flex-column " style="background-image:url(./img/fundo2.png)">


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
                                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-dark" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>


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

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-dark">Painel de controle</h1>
                        <a href="backup.php" class="custom-button">
                            <i class="bi bi-download"></i> Backup do banco
                        </a>
                    </div>

                    <!-- Ganhos (mensal) Card Example -->
                    <div class="row">
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card1 border-left-success shadow h-100 py-2 ">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Funcionários
                                            </div>
                                            <?php
                                            try {
                                                $conn = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
                                                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                                                $query = "SELECT COUNT(*) as funcionario_cadastro FROM funcionario WHERE situacao = 'ATIVO'";
                                                $stmt = $conn->query($query);
                                                $result = $stmt->fetch(PDO::FETCH_ASSOC);

                                                $funcionario_cadastro = $result['funcionario_cadastro'];

                                                echo '<div class="h5 mb-0 font-weight-bold text-gray-800">' . number_format($funcionario_cadastro) . '</div>';
                                            } catch (PDOException $e) {
                                                echo "Erro na conexão: " . $e->getMessage();
                                            }
                                            ?>
                                        </div>
                                        <div class="col-auto">
                                            <i class="bi bi-file-person-fill fa-2x text-success"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card1 border-left-success shadow h-100 py-2 ">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                Pedidos em andamento</div>
                                            <?php
                                            try {
                                                $conn = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
                                                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                                                $query = "SELECT COUNT(*) as pedidos_ativos FROM Pedidos WHERE situacao = 'ATIVO'";
                                                $stmt = $conn->query($query);
                                                $result = $stmt->fetch(PDO::FETCH_ASSOC);

                                                $pedidos_ativos = $result['pedidos_ativos'];

                                                echo '<div class="h5 mb-0 font-weight-bold text-gray-800">' . number_format($pedidos_ativos) . '</div>';
                                            } catch (PDOException $e) {
                                                echo "Erro na conexão: " . $e->getMessage();
                                            }
                                            ?>
                                        </div>
                                        <div class="col-auto">
                                            <i class="bi bi-list-check fa-2x text-info"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card1 border-left-success shadow h-100 py-2 ">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Ganhos do dia
                                            </div>
                                            <?php
                                            try {
                                                $conn = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
                                                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                                                $query = "SELECT SUM(valorTotal) as Total FROM Pedidos WHERE DATE(timestamp) = CURDATE()";
                                                $stmt = $conn->query($query);
                                                $result = $stmt->fetch(PDO::FETCH_ASSOC);

                                                $Total = $result['Total'];

                                                // Check if $Total is not null before formatting and displaying it
                                                if ($Total !== null) {
                                                    echo '<div class="h5 mb-0 font-weight-bold text-gray-800">R$ ' . number_format($Total, 2) . '</div>';
                                                } else {
                                                    echo '<div class="h5 mb-0 font-weight-bold text-gray-800">Sem ganhos hoje
            </div>';
                                                }
                                            } catch (PDOException $e) {
                                                echo "Erro na conexão: " . $e->getMessage();
                                            }
                                            ?>
                                        </div>

                                        <div class="col-auto">
                                            <i class="bi bi-cash-coin fa-2x text-success"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card1 border-left-success shadow h-100 py-2 ">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                Mesas Disponíveis</div>
                                            <?php
                                            try {
                                                $conn = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
                                                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                                                $query = "SELECT COUNT(*) as pedidos_ativos FROM mesas WHERE situacao = 'ATIVO'";
                                                $stmt = $conn->query($query);
                                                $result = $stmt->fetch(PDO::FETCH_ASSOC);

                                                $pedidos_ativos = $result['pedidos_ativos'];

                                                echo '<div class="h5 mb-0 font-weight-bold text-gray-800">' . number_format($pedidos_ativos) . '</div>';
                                            } catch (PDOException $e) {
                                                echo "Erro na conexão: " . $e->getMessage();
                                            }
                                            ?>
                                        </div>
                                        <div class="col-auto">
                                            <i class="bi bi-list-check fa-2x text-info"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                    <?php
                    include './conexao/config.php';

                    try {
                        // Cria uma nova conexão PDO
                        $conn = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
                        // Define o modo de erro PDO para exceções
                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                        $conn->query("SET lc_time_names = 'pt_BR'");

                        // Obtém o mês atual
                        $mes_atual = date('m');

                        // Antes de inserir novos pedidos para o mês atual, exclua os pedidos do mês anterior
                        $mes_anterior = date('m', strtotime('-1 month'));
                        $update_query = "UPDATE Pedidos SET situacao = 'INATIVO' WHERE MONTH(timestamp) = $mes_anterior";
                        $conn->exec($update_query);

                        // Insira novos pedidos para o mês atual
                        // (coloque aqui a lógica para inserir os novos pedidos)

                        // Consulta para recuperar os funcionários do mês atual e somar todos os pedidos do mês
                        $query = "SELECT 
        f.ID_FUNC AS id_funcionario,
        f.USUARIO AS funcionario,
        COUNT(p.ID_Pedido) AS total_pedidos,
        SUM(p.valorTotal) AS valor_total_pedidos
    FROM funcionario f
    LEFT JOIN Pedidos p ON f.ID_FUNC = p.ID_FUNC
    WHERE MONTH(p.timestamp) = MONTH(CURRENT_DATE())
    AND YEAR(p.timestamp) = YEAR(CURRENT_DATE())
    GROUP BY f.ID_FUNC, f.USUARIO
    ORDER BY valor_total_pedidos DESC
    LIMIT 4";

                        $stmt = $conn->query($query);
                        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        // Verifica se há resultados antes de exibi-los
                        if (!empty($results)) {
                    ?>
                            <div class="card-body card">
                                <h2>Funcionário do Mês</h2>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover text-dark" id="employeeOfTheMonthTable">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>Funcionário</th>
                                                <th>Mês</th>
                                                <th>Total de Pedidos</th>
                                                <th>Valor Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($results as $row) { ?>
                                                <tr>
                                                    <td><?php echo $row['funcionario']; ?></td>
                                                    <td><?php echo $mes_atual; ?></td>
                                                    <td><?php echo $row['total_pedidos']; ?></td>
                                                    <td>R$ <?php echo number_format($row['valor_total_pedidos'], 2, ',', '.'); ?></td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                    <?php
                        } else {
                            echo " ";
                        }
                    } catch (PDOException $e) {
                        echo "Erro na conexão: " . $e->getMessage();
                    }
                    ?>





                    <!-- Content Row -->
                    <div class="row">

                        <div class=" container  mb-4">

                            <!-- Illustrations -->
                            <div class="cardimg card1 shadow mb-4 p-2 m-5 ">
                                <div class="card-body">
                                    <div class="text-center">
                                        <img class="container" id="rockgif" src="./img/gif1.gif">

                                        <img class="container" id="palacegif" src="./img/gif2.gif">

                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->



            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="foot sticky-footer">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Palacecode &copy; site desenvolvido 2023</span>
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
                    <h5 class="modal-title" id="exampleModalLabel">Tem certaza que deseja sair?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Selecione "Sair" abaixo se estiver pronto para encerrar sua sessão atual.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                    <a class="btn btn-dark" href="logout.php">Sair</a>
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


</body>

</html>