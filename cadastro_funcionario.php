<?php

// Start session
if (!session_id()) {
    session_start();
}
require_once "./conexao/config.php";
require_once "cad_func_insert.php";

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

    <title>Gerenciador PalaceCode</title>

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Inclua o jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="./js/jquery.mask.js"></script>


    <!-- Inclua a biblioteca InputMask -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/inputmask/5.0.6/jquery.inputmask.min.js"></script>
    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="css/registro.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.6/jquery.inputmask.min.js"></script>

    <style>
        .custom-close {
            background: none;
            border: none;
            padding: 0;
            color: #000;
            /* Cor do ícone */
            font-size: 24px;
            /* Tamanho do ícone */
            margin-right: 100px;
            /* Espaço entre o ícone e o canto direito do botão */
            float: right;
            /* Alinhar à direita */
        }

        /* Estilos de formatação personalizada podem ser adicionados aqui */
        .form-group {
            margin-bottom: 15px;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .btn {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>

</head>

<body class="corpitio" style="background-image:url(./img/fundo2.png)">

    <div class="container form ">
        <div class="row">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="window.location.href='dash.php'">
                <span aria-hidden="true">&times;</span>
            </button>
            <div class=" col-lg-12">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="form-group"></div>
                    <div class="card-body p-0">

                        <div class="row">
                            <div class="col-lg-12 text-center">
                                <img id="palace" src="./img/palacelogo1.png" alt="Logo Palace">
                                <img id="rock" src="./img/logotcc.png" alt="Logo Rock">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h2 text-dark mb-4">Cadastrar Funcionário</h1>
                                    </div>
                                    <form class="user" action="cad_func_insert.php" method="POST" onsubmit="return validarCampos();">
                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <input type="text" class="form-control form-control-user" name="nome" placeholder="Primeiro nome" required>
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="email" class="form-control form-control-user" name="email" placeholder="Endereço de Email" multiple required>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <input type="text" id="cpf" name="cpf" class="form-control form-control-user" placeholder="CPF" maxlength="14" required>
                                                <span id="cpf-error" style="color: red;"></span> <!-- Exibe mensagens de erro aqui -->
                                            </div>

                                            <div class="col-sm-6">
                                                <input type="number" class="form-control date-time-mask form-control-user" name="idade" placeholder="Idade" required>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <input type="password" class="form-control form-control-user" name="senha" placeholder="Senha" required>
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control form-control-user" name="rg" id="rg" placeholder="RG" required maxlength="12">
                                            </div>

                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <input type="date" id="data" class="form-control form-control-user form-control" name="admissao" placeholder="Data" required>
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="tel" class="form-control form-control-user" name="telefone" id="telefone" placeholder="Telefone" required maxlength="15">
                                            </div>


                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <input type="text" class="form-control form-control-user" name="usuario" placeholder="Usuário" required>
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="number" class="form-control form-control-user" name="salario" placeholder="Salário" required>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <select class="form-control rounded-pill" name="ocupacao" placeholder="Selecione" required>
                                                    <option value="Admin" selected>Admin</option>
                                                    <option value="Garçom">Garçom</option>
                                                    <option value="Cozinha">Cozinha</option>
                                                    <option value="Caixa">Caixa</option>
                                                    <option value="Atendente">Atendente</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <button class="btn btn-link bg-secondary text-light w-100" style="text-decoration: none;" type="submit">Cadastrar</button>
                                        </div>
                                        <hr>
                                    </form>
                                </div>
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

                                        // Limpa a mensagem de erro se o e-mail for válido
                                        document.getElementById('email-error').innerText = '';
                                        return true;
                                    }
                                </script>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>

        <footer class="sticky-footer">
            <div class="container">
                <div class="copyright text-center">
                    <span>Palacecode &copy; site desenvolvido 2023</span>
                </div>
            </div>
        </footer>

    </div>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript -->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages -->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>