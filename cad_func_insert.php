<?php
// Start session
if (!session_id()) {
    session_start();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Define o email e senha esperados
    $cpf = $_POST['cpf'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $ocupacao = $_POST['ocupacao'];
    $usuario = $_POST['usuario'];
    $idade = $_POST['idade'];
    $senha = $_POST['senha'];
    $rg = $_POST['rg'];
    $salario = $_POST['salario'];
    $telefone = $_POST['telefone'];
    $admissao = $_POST['admissao'];
    $data = date('Y-m-d', strtotime(str_replace('/', '-', $admissao)));

    // Função para validar CPF
    function validarCPF($cpf) {
        // Remove caracteres não numéricos
        $cpf = preg_replace('/[^0-9]/', '', $cpf);

        // Verifica se o CPF possui 11 dígitos
        if (strlen($cpf) != 11) {
            return false;
        }

        // Verifica se todos os dígitos são iguais, o que torna o CPF inválido
        if (preg_match('/^(\d)\1*$/', $cpf)) {
            return false;
        }

        // Calcula os dígitos verificadores
        $soma = 0;
        for ($i = 0; $i < 9; $i++) {
            $soma += $cpf[$i] * (10 - $i);
        }
        $resto = $soma % 11;
        $digito1 = ($resto < 2) ? 0 : 11 - $resto;

        $soma = 0;
        for ($i = 0; $i < 10; $i++) {
            $soma += $cpf[$i] * (11 - $i);
        }
        $resto = $soma % 11;
        $digito2 = ($resto < 2) ? 0 : 11 - $resto;

        // Verifica se os dígitos verificadores calculados são iguais aos dígitos originais do CPF
        if ($cpf[9] == $digito1 && $cpf[10] == $digito2) {
            return true;
        } else {
            return false;
        }
    }

    // Verificar se o CPF é válido
    if (!validarCPF($cpf)) {
        echo "CPF inválido!";
        header("Location: cadastro_funcionario.php");
        exit();
    }

    require_once "./conexao/config.php";

    try {
        // Cria uma nova conexão PDO
        $conn = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
        // Define o modo de erro PDO para exceções
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prepara a declaração SQL para inserir o registro
        $stmt = $conn->prepare("INSERT INTO funcionario (cpf_func, nome_func, email_func, ocupacao, usuario, idade_tra, senha, rg_func, salario_func, telefone_func, data_inicio)
        VALUES (:cpf, :nome, :email, :ocupacao, :usuario, :idade, :senha, :rg, :salario, :telefone, :data_data)");

        // Vincula os parâmetros aos valores
        $stmt->bindParam(':cpf', $cpf);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':ocupacao', $ocupacao);
        $stmt->bindParam(':usuario', $usuario);
        $stmt->bindParam(':idade', $idade);
        $stmt->bindParam(':senha', $senha);
        $stmt->bindParam(':rg', $rg);
        $stmt->bindParam(':salario', $salario);
        $stmt->bindParam(':telefone', $telefone);
        $stmt->bindParam(':data_data', $data);

        // Executa a declaração preparada
        if ($stmt->execute()) {
            // Verifica se o registro foi inserido com sucesso
            if ($stmt->rowCount() > 0) {
                echo "Registro inserido com sucesso!";
                header("Location: tables.php");
                exit();
            } else {
                echo "Erro ao inserir o registro.";
                header("Location: cadastro_funcionario.php");
                exit();
            }
        } else {
            echo "Erro na execução da declaração: " . $stmt->errorInfo()[2];
        }
    } catch (PDOException $e) {
        // Trata erros de conexão PDO
        echo "Erro na conexão: " . $e->getMessage();
    }
}
?>
