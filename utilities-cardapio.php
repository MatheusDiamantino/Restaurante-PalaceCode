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
    <meta name="author" content="">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

    <title>Gerenciador Palacecode</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="css/cardapio.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">

    <style>
        .restaurant-card {
            border: 1px solid #ccc;
            border-radius: 10px;
            padding: 10px;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            max-width: 300px;
            /* Defina a largura máxima desejada */
            margin: 0 auto;
            /* Centralize o card horizontalmente */
        }

        .restaurant-card img {
            max-width: 100%;
            height: auto;
        }

        .restaurant-card .card-actions {
            text-align: right;
        }

        .hover-grow {
            transition: transform 0.9s ease;
            /* Define a transição de 0.3 segundos com efeito suave */
        }

        .hover-grow:hover {
            transform: scale(0.9);
            /* Aumenta o tamanho em 10% (1.1 vezes) ao passar o mouse */
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
                    <img id="img" src="./img/logotcc.png" class="logo-tcc">
                </div>
                <div class="sidebar-brand-text mx-3">Rock Speto</div>
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
                                        <button class="btn btn-primary" type="button">
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

            <!--Inicio Coluna-->

            <!-- Begin Page Content -->
            <div class="container-fluid">
                <!-- Tabela Mesa -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex justify-content-around">
                        <h6 class="m-0 font-weight-bold text-dark fa-2x">Cardápio</h6>
                        <div id="cdm">
                            <button type="button" class="btn btn-link text-dark fw-bold" style="text-decoration: none;" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">Adicionar Combos</button>
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class=" fw-bold fs-5" id="exampleModalLabel">Adicione um combo no cardápio</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>

                                        <!--Tabela-->
                                        <div class="modal-body">
                                            <form method="POST" action="insert_cardapio.php" enctype="multipart/form-data">
                                                <div class="row mb-3">
                                                    <label for="nome" class="col-sm-3 col-form-label">Nome:</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" id="nome" name="nome" required>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label for="descricao" class="col-md-3 col-form-label">Descrição:</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" id="descricao" name="descricao" required>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label for="preco" class="col-sm-3 col-form-label">Preço:</label>
                                                    <div class="col-sm-9">
                                                        <input type="number" class="form-control" id="preco" name="preco" step="0.01" required>
                                                    </div>
                                                </div>
                                                <div class="form-row mb-3">
                                                    <label for="imagem" class="col-sm-3 col-form-label">Imagem:</label>
                                                    <div class="col-sm-9">
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input" name="imagem" accept="image/*" id="imagem" aria-label="Upload de imagem" aria-describedby="imagem-label">
                                                            <label class="custom-file-label" for="imagem" id="imagem-label">Escolha um arquivo</label>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Fechar</button>
                                                    <button type="submit" class="btn btn-dark">Adicionar Combo</button>
                                                </div>
                                            </form>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- HTML -->
                    <div class="card-body" style="max-width: 1200px; margin: 0 auto;">
                        <div class="table-responsive">
                            <?php
                            // Continue com o restante do código
                            include './conexao/config.php';

                            try {
                                // Cria uma nova conexão PDO
                                $query = "SELECT ID_CARDAPIO as id,
      PRECO_CARDAPIO as preco,
      NOME as nome,
      DESCRICAO as descricao,
      imagem,
      situacao
  FROM cardapio WHERE situacao = 'ATIVO'";
                                $stmt = $conn->prepare($query);
                                $stmt->execute();
                                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                            } catch (PDOException $e) {
                                echo "Erro na conexão: " . $e->getMessage();
                            }
                            ?>

                            <div class="container">
                                <div class="row justify-content-center">
                                    <?php foreach ($results as $row) { ?>
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="restaurant-card hover-grow"> <!-- Adicione a classe hover-grow aqui -->
                                                <img src="data:image/jpeg;base64,<?php echo base64_encode($row['imagem']); ?>" alt="<?php echo $row['nome']; ?>">
                                                <h4 class="text-center mt-3"><?php echo $row['nome']; ?></h4>
                                                <div class="form-group text-center">
                                                    <p><?php echo $row['descricao']; ?></p>
                                                </div>
                                                <p class="text-center">Preço: R$ <?php echo number_format($row['preco'], 2, ',', '.'); ?></p>
                                                <div class="card-actions text-center">
                                                    <a href="deletar_cardapio.php?id=<?php echo $row['id']; ?>" class="btn btn-danger"><i class="bi bi-trash3-fill"></i> Deletar</a>
                                                    <a class="btn btn-warning" href="editar_registro.php?nome=<?php echo urlencode($row['nome']); ?>" data-toggle="modal" data-target="#myModal<?php echo $row['id']; ?>"><i class="bi bi-pen-fill"></i> Editar</a>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Modal de Edição -->
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
                                                        <form class="user" action="update_cardapio.php" method="POST" enctype="multipart/form-data">
                                                            <input type="hidden" class="form-control form-control-user" name="id" value="<?php echo $row['id']; ?>">
                                                            <div class="form-group">
                                                                <label for="preco">Preço:</label>
                                                                <input type="text" class="form-control" name="preco" value="<?php echo $row['preco']; ?>">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="nome">Nome:</label>
                                                                <input type="text" class="form-control" name="nome" value="<?php echo $row['nome']; ?>">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="descricao">Descrição:</label>
                                                                <input type="text" class="form-control" name="descricao" value="<?php echo $row['descricao']; ?>">
                                                            </div>

                                                            <input type="file" class="btn btn-link text-dark fw-bold" style="text-decoration: none;" name="nova_imagem" id="nova_imagem" accept="image/*">

                                                            <input class="btn btn-light text-dark w-100" type="submit" value="Salvar">
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Footer -->
                    <footer class="sticky-footer ">
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

            <script type="text/javascript" src="js/cardapio.js"></script>
            <!-- Bootstrap core JavaScript-->
            <script src="vendor/jquery/jquery.min.js"></script>
            <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

            <!-- Core plugin JavaScript-->
            <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

            <!-- Custom scripts for all pages-->
            <script src="js/sb-admin-2.min.js"></script>

            <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>


            <!-- Page level plugins -->
            <script src="vendor/datatables/jquery.dataTables.min.js"></script>
            <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

            <!-- Page level custom scripts -->
            <script src="js/demo/datatables-demo.js"></script>

</body>

</html>