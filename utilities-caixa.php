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
    echo "Você não tem permissão para acessar esta página.";
    header("Location: dash.php");
    echo '<meta http-equiv="refresh" content="3;URL=dash.php">'; // Redireciona após 3 segundos

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
    <link href="css/index.css" rel="stylesheet">
    <link href="css/caixa.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">

    <title>Gerenciador Palacecode</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dash.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <img class="logo-tcc" src="./img/logotcc.png">
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
        <div id="content-wrapper" class=" d-flex flex-column" style="background-image:url(./img/fundo2.png)">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light  topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>


                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">


                        <!-- Dropdown - Messages -->
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
                    <h1 class="h1 mb-2 text-dark">Caixa</h1>
                </div>


                <?php
                $id_mesa = isset($_GET['id_mesa']) ? $_GET['id_mesa'] : '1';

                try {
                    $query = "SELECT p.ID_Pedido as id_pedido,
    p.id_mesa,
    m.numero_mesa,
    c.nome as nome_cardapio,
    p.valorTotal as total,
    p.descricao as descricao,
    p.quantidade as qtd,
    p.situacao
    FROM Pedidos p
    INNER JOIN cardapio c ON p.ID_CARDAPIO = c.ID_CARDAPIO
    LEFT JOIN mesas m ON m.id_mesa = p.id_mesa  
    WHERE p.id_mesa = :id_mesa";

                    $stmt = $conn->prepare($query);
                    $stmt->bindParam(':id_mesa', $id_mesa, PDO::PARAM_INT);
                    $stmt->execute();
                    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($results as $row) {
                        $id_pedido = $row['id_pedido'];
                        $numero_mesa = $row['numero_mesa'];
                        $nome_cardapio = $row['nome_cardapio'];
                        $total = $row['total'];
                        $descricao = $row['descricao'];
                        $qtd = $row['qtd'];
                        $situacao = $row['situacao'];
                    }
                } catch (PDOException $e) {
                    echo "Erro na conexão: " . $e->getMessage();
                }
                ?>




                <div class=" shadow mb-4 bg-light">
                    <div class="card-header py-3 ">
                        <h4 class="m-0 font-weight-bold text-dark">Pedidos</h4>
                    </div>
                    <div class="card-body ">
                        <div class="table-responsive">
                            <table class="table table-bordered text-dark " id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>
                                            <form>
                                                <select class="form-select form-control form-control-user" name="id_mesa" onchange="this.form.submit()">
                                                    <?php
                                                    try {
                                                        $queryMesas = "SELECT DISTINCT m.id_mesa, m.numero_mesa
                                        FROM mesas m
                                        LEFT JOIN Pedidos p ON m.id_mesa = p.id_mesa WHERE m.situacao = 'ATIVO'";
                                                        $stmtMesas = $conn->query($queryMesas);
                                                        $mesasDisponiveis = $stmtMesas->fetchAll(PDO::FETCH_ASSOC);

                                                        echo "<option selected>Selecione a mesa desejada</option>";

                                                        foreach ($mesasDisponiveis as $mesa) {
                                                            $selected = isset($_GET['id_mesa']) && $_GET['id_mesa'] == $mesa['id_mesa'] ? 'selected' : '';
                                                            echo "<option value='{$mesa['id_mesa']}' $selected>Mesa {$mesa['numero_mesa']}</option>";
                                                        }
                                                    } catch (PDOException $e) {
                                                        echo "Erro na conexão: " . $e->getMessage();
                                                    }
                                                    ?>
                                                </select>
                                            </form>
                                        </th>
                                        <th>Nº Mesa</th>
                                        <th>Combo</th>
                                        <th>Total Item</th>
                                        <th>Descrição</th>
                                        <th>Quantidade</th>
                                        <th>Situação</th>
                                        <th>Opções</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $id_mesa = isset($_GET['id_mesa']) ? $_GET['id_mesa'] : '1';
                                    $totalSoma = 0; // Inicialize a variável para a soma dos valores totais

                                    $query = "SELECT p.ID_Pedido as id_pedido,
        p.id_mesa,
        m.numero_mesa,
        c.nome as nome_cardapio,
        p.valorTotal as total,
        p.descricao as descricao,
        p.quantidade as qtd,
        p.situacao
        FROM Pedidos p
        INNER JOIN cardapio c ON p.ID_CARDAPIO = c.ID_CARDAPIO
        LEFT JOIN mesas m ON m.id_mesa = p.id_mesa  
        WHERE p.id_mesa = :id_mesa AND p.situacao = 'ATIVO'";

                                    $stmt = $conn->prepare($query);
                                    $stmt->bindParam(':id_mesa', $id_mesa, PDO::PARAM_INT);
                                    $stmt->execute();
                                    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                    foreach ($results as $row) {
                                        $totalSoma += $row['total']; // Adicione o valor total do pedido à soma
                                    ?>
                                        <tr>
                                            <td></td>
                                            <td><?php echo $row['numero_mesa']; ?></td>
                                            <td><?php echo $row['nome_cardapio']; ?></td>
                                            <td>R$ <?php echo number_format($row['total'], 2, ',', '.'); ?></td>
                                            <td><?php echo $row['descricao']; ?></td>
                                            <td><?php echo $row['qtd']; ?></td>
                                            <td><?php echo $row['situacao']; ?> </td>
                                            <td>
                                                <form method="POST" action="fecharpedido.php">
                                                    <input type="hidden" name="id_mesa" value="<?php echo $id_mesa; ?>">
                                                    <button type="submit" class="btn btn-info" onclick="return confirm('Tem certeza que deseja fechar todos os pedidos desta mesa?')"><i class="bi bi-lock-fill"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    <tr>
                                        <td colspan="8" class="text-center bg-body">
                                            <strong>Valor Total:</strong><br>R$ <?php echo number_format($totalSoma, 2, ',', '.'); ?>
                                        </td>
                                    </tr>
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>

            </div>


            <!-- End of Main Content -->
            <div>
                <!-- Footer -->
                <footer class="sticky-footer ">
                    <div class="copyright text-center my-auto">
                        <span>Palacecode &copy;desenvolvido 2023</span>
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


        <script type="text/javascript" src="js/caixa.js"></script>
        <!-- Bootstrap core JavaScript-->
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="js/sb-admin-2.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
</body>

</html>