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
if ($_SESSION['OCUPACAO'] !== 'Admin' && $_SESSION['OCUPACAO'] !== 'Atendente' && $_SESSION['OCUPACAO'] !== 'Garçom') {
    // Se a ocupação não for 'Admin', 'Atendente' ou 'Garçom', redireciona para outra página ou mostra uma mensagem de erro
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
    <link href="css/mesa.css" rel="stylesheet">


    <title>Gerenciador PalaceCode</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <style>
        .mesas {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .hidden {
            display: none;
        }


        .mesa-reservada {
            margin-top: 10px;
            font-size: 14px;
        }

        .reservada-label {
            font-weight: bold;
            margin-right: 5px;
        }

        .reservada-data {
            color: #007bff;
            margin-right: 5px;
        }

        .reservada-hora {
            color: #007bff;
        }

        .mesa {
            border: 1px solid #ccc;
            padding: 10px;
            width: 150px;
            text-align: center;
            background-color: #f9f9f9;
            position: relative;
            transition: transform 0.2s;
            overflow: hidden;
            border-radius: 10px;
            /* Adicione esta propriedade para tornar os cards redondos */
        }

        .mesa img {
            width: 80px;
            height: 80px;
            margin-bottom: 10px;
        }

        .mesa-info {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .mesa-acao {
            margin-top: 10px;
        }

        .tooltip {
            visibility: hidden;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: rgba(0, 0, 0, 0.7);
            color: #fff;
            padding: 5px;
            border-radius: 5px;
        }

        .mesa:hover {
            transform: scale(1.1);
            backdrop-filter: blur(5px);
        }

        .mesa:hover .tooltip {
            visibility: visible;
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
                <div class="sidebar-brand-icon rotate-n-15 ">
                    <img class="logopalacio" src="./img/palacelogo1.png">
                </div>
                <div class="sidebar-brand-text mx-3 ">Palace Code</div>
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
                    <i class="fas fa-table"></i>
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

            <hr class="sidebar-divider">
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

                        <!-- Nav Item - Alerts -->

                        <!-- Dropdown - Alerts -->

                        <!-- Nav Item - Messages -->


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
                    <h1 class="h3 mb-2 text-dark text">Mesas</h1>

                    <!-- Tabela Mesa -->
                    <div class="row">
                        <div class="col-md-4">
                            <div class="nav-2 card-header py-3 d-flex justify-content-between">
                                <div>
                                    <!-- Button trigger modal para cadastrar mesas -->
                                    <a type="button" class="btn btn-dark" style="position: relative; left:40%" data-bs-toggle="modal" data-bs-target="#cadastrarMesaModal">
                                        <i class="bi bi-clipboard2-plus-fill"></i> Cadastrar mesas
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="nav-2 card-header py-3 d-flex justify-content-between">
                                <div>
                                    <!-- Button trigger modal para reservar mesas -->
                                    <a type="button" class="btn btn-dark" style="position: relative; left:50%" data-bs-toggle="modal" data-bs-target="#reservarMesaModal">
                                        <i class="bi bi-clipboard-plus"></i> Reservar Mesas
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="nav-2 card-header py-3 d-flex justify-content-between">
                                <div>
                                    <!-- Button trigger modal para visualizar o histórico de reservas -->
                                    <a type="button" class="btn btn-dark" style="position: relative; left:30%" data-bs-toggle="modal" data-bs-target="#historicoReservasModal">
                                        <i class="bi bi-journal-text"></i> Histórico de Reservas
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal para cadastrar mesas -->
                <div class="modal fade" id="cadastrarMesaModal" tabindex="-1" aria-labelledby="cadastrarMesaModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h2 class="modal-title fs-3 fw-bolder" id="cadastrarMesaModalLabel">Cadastrar mesas</h2>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="insert_mesa.php">
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="mesa" class="form-label">Número da Mesa:</label>
                                            <input type="number" name="mesa" class="form-control" placeholder="Digite o número da mesa" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                        <button type="submit" class="btn btn-dark">Salvar alterações</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal para reservar mesas -->
                <div class="modal fade" id="reservarMesaModal" tabindex="-1" aria-labelledby="reservarMesaModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h2 class="modal-title fs-3 fw-bolder" id="reservarMesaModalLabel">Reservar Mesas</h2>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="reservar_mesas.php">
                                    <div class="mb-3">
                                        <label for="numero_mesa" class="form-label">Número da Mesa:</label>
                                        <input type="number" name="numero_mesa" class="form-control" placeholder="Digite o número da mesa">
                                    </div>
                                    <div class="mb-3">
                                        <label for="data_reserva" class="form-label">Data da Reserva:</label>
                                        <input type="date" name="data_reserva" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label for="hora_reserva" class="form-label">Hora da Reserva:</label>
                                        <input type="time" name="hora_reserva" class="form-control">
                                    </div>

                                    <!-- O botão de envio deve estar dentro do formulário -->
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                        <button type="submit" class="btn btn-dark">Reservar Mesa</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal para apresentar histórico de reservas de mesas -->
                <div class="modal fade" id="historicoReservasModal" tabindex="-1" aria-labelledby="historicoReservasModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h2 class="modal-title fs-3 fw-bolder" id="historicoReservasModalLabel">Histórico de Reservas</h2>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <!-- Conteúdo do histórico de reservas aqui -->
                                <!-- Você pode adicionar tabelas, listas ou qualquer conteúdo relevante sobre o histórico de reservas. -->
                                <!-- Por exemplo: -->
                                <!-- Conteúdo do histórico de reservas aqui -->
                                <!-- Você pode adicionar tabelas, listas ou qualquer conteúdo relevante sobre o histórico de reservas. -->
                                <!-- Por exemplo: -->
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Data da Reserva</th>
                                            <th>Hora da Reserva</th>
                                            <th>Número da Mesa</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        include './conexao/config.php';

                                        $query = "SELECT id_mesa as id, numero_mesa as mesa, situacao, statusMesa, data_reserva as dia, hora_reserva as hora FROM mesas WHERE id_mesa > 0 AND data_reserva IS NOT NULL AND hora_reserva IS NOT NULL";
                                        $stmt = $conn->prepare($query);
                                        $stmt->execute();
                                        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                        if (isset($results)) {
                                            foreach ($results as $row) {
                                                echo '<tr>';
                                                echo '<td>' . date('Y-m-d', strtotime($row['dia'])) . '</td>';
                                                echo '<td>' . date('H:i', strtotime($row['hora'])) . '</td>';
                                                echo '<td>' . $row['mesa'] . '</td>';
                                                echo '</tr>';
                                            }
                                        } else {
                                            echo '<tr><td colspan="3">Nenhum histórico de reservas com data e hora encontrado.</td></tr>';
                                        }
                                        ?>

                                    </tbody>
                                </table>


                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div class="mesas">
                            <?php
                            include './conexao/config.php';

                            try {
                                // Obtém a data e a hora atuais
                                $currentTime = date('Y-m-d H:i:s');
                                $currentDate = date('Y-m-d');

                                $query = "SELECT id_mesa as id, numero_mesa as mesa, situacao, statusMesa, data_reserva as dia, hora_reserva as hora FROM mesas WHERE situacao = 'ATIVO' AND id_mesa > 0"; // Adicionamos a condição id_mesa > 0 para evitar mesas com ID 0
                                $stmt = $conn->prepare($query);
                                $stmt->execute();
                                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                foreach ($results as $row4) {
                                    echo '<div class="mesa">';
                                    echo '<div>';
                                    echo '<a href="#" class="btn-excluir text-dark" style="position:absolute; left: 10%" data-toggle="modal" data-target="#confirmDeleteModal' . $row4['id'] . '"><i class="fa fa-trash"></i></a>';
                                    echo '</div>';
                                    echo '<img src="./img/mesa.png" alt="Mesa">';
                                    echo '<div class="mesa-info">';
                                    echo 'ID: ' . $row4['id'];
                                    echo '</div>';
                                    echo '<div class="mesa-info">';
                                    echo 'Nº Mesa: ' . $row4['mesa'];
                                    echo '</div>';

                                    if (!empty($row4['dia']) && !empty($row4['hora'])) {
                                        // Calcula a data e hora de reserva como um único timestamp
                                        $reservationTime = strtotime($row4['dia'] . ' ' . $row4['hora']);
                                        $reservationDate = date('Y-m-d', $reservationTime);

                                        // Verifica se o horário atual é maior do que o horário de reserva
                                        if (strtotime($currentTime) > $reservationTime) {
                                            // Se o horário atual for maior, marque a mesa como "Disponível"
                                            $statusMesa = 'Disponível';

                                            // Atualize o status da mesa para "Disponível" na base de dados
                                            $updateStatusMesa = $conn->prepare("UPDATE mesas SET statusMesa = :statusMesa WHERE id_mesa = :id_mesa");
                                            $updateStatusMesa->bindParam(':statusMesa', $statusMesa);
                                            $updateStatusMesa->bindParam(':id_mesa', $row4['id']);
                                            $updateStatusMesa->execute();
                                        } else {
                                            // O horário de reserva ainda não passou, então exiba a mensagem de reserva
                                            $statusMesa = 'Reservada';
                                            echo '<div class="mesa-reservada">';
                                            echo '<span class="reservada-label">Reservada:</span><br>';
                                            echo '<span class="reservada-data">' . date('d/m/Y', strtotime($row4['dia'])) . '</span>';
                                            echo '<span class="reservada-hora">' . date('H:i', strtotime($row4['hora'])) . '</span>';
                                            echo '</div>';
                                        }
                                    } else {
                                        // A mesa não tem data ou hora de reserva, marque-a como "Disponível"
                                        $statusMesa = 'Disponível';
                                    }

                                    echo '<div class="mesa-acao">';
                                    $idMesa = $row4['id'];
                                    $queryPedidos = "SELECT COUNT(*) as total_pedidos FROM Pedidos WHERE id_mesa = :id_mesa AND situacao = 'ATIVO'";
                                    $stmtPedidos = $conn->prepare($queryPedidos);
                                    $stmtPedidos->bindParam(':id_mesa', $idMesa);
                                    $stmtPedidos->execute();
                                    $totalPedidos = $stmtPedidos->fetchColumn();

                                    if (!empty($row4['dia']) && !empty($row4['hora'])) {
                                        // Mesa com reserva, atualize o status para "Reservada"
                                        $updateStatusMesa = $conn->prepare("UPDATE mesas SET statusMesa = :statusMesa WHERE id_mesa = :id_mesa");
                                        $updateStatusMesa->bindParam(':statusMesa', $statusMesa);
                                        $updateStatusMesa->bindParam(':id_mesa', $idMesa);
                                        $updateStatusMesa->execute();
                                        echo '<div class="status-mesa reservada">' . $statusMesa . '</div>';
                                    } elseif ($totalPedidos > 0) {
                                        // Há pedidos ativos relacionados a esta mesa, atualize o status para "Ocupada"
                                        $statusMesa = 'Ocupada';
                                        $updateStatusMesa = $conn->prepare("UPDATE mesas SET statusMesa = :statusMesa WHERE id_mesa = :id_mesa");
                                        $updateStatusMesa->bindParam(':statusMesa', $statusMesa);
                                        $updateStatusMesa->bindParam(':id_mesa', $idMesa);
                                        $updateStatusMesa->execute();
                                        echo '<div class="status-mesa ocupada">' . $statusMesa . '</div>';
                                    } else {
                                        // Não há pedidos ativos nem reservas relacionadas a esta mesa, atualize o status para "Disponível"
                                        $statusMesa = 'Disponível';
                                        $updateStatusMesa = $conn->prepare("UPDATE mesas SET statusMesa = :statusMesa WHERE id_mesa = :id_mesa");
                                        $updateStatusMesa->bindParam(':statusMesa', $statusMesa);
                                        $updateStatusMesa->bindParam(':id_mesa', $idMesa);
                                        $updateStatusMesa->execute();
                                        echo '<div class="status-mesa disponivel">' . $statusMesa . '</div>';
                                    }
                                    echo '</div>';
                                    echo '</div>';

                                    echo '<div class="modal fade" id="confirmDeleteModal' . $row4['id'] . '" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">';
                                    echo '<div class="modal-dialog" role="document">';
                                    echo '<div class="modal-content">';
                                    echo '<div class="modal-header">';
                                    echo '<h5 class="modal-title" id="confirmDeleteModalLabel">Confirmação</h5>';
                                    echo '<button type="button" class="close" data-dismiss="modal" aria-label="Fechar">';
                                    echo '<span aria-hidden=true">&times;</span>';
                                    echo '</button>';
                                    echo '</div>';
                                    echo '<div class="modal-body">';
                                    echo 'Tem certeza de que deseja excluir esta mesa?';
                                    echo '</div>';
                                    echo '<div class="modal-footer">';
                                    echo '<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>';
                                    echo '<a href="deletar_mesa.php?id=' . $row4['id'] . '" class="btn btn-danger">Excluir</a>';
                                    echo '</div>';
                                    echo '</div>';
                                    echo '</div>';
                                    echo '</div>';
                                }
                            } catch (PDOException $e) {
                                echo "Erro na conexão: " . $e->getMessage();
                            }


                            ?>
                        </div>
                    </div>
                </div>

                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer ">

                <div class="copyright text-center my-auto">
                    <span>Palacecode &copy; site desenvolvido 2023</span>
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


    <script type="text/javascript" src="js/mesas.js"></script>
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>


</body>

</html>