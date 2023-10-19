<?php
// Start session
if (!session_id()) {
    session_start();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Define os campos esperados
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];

    // Image upload processing
    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
        $imagem_tmp_name = $_FILES['imagem']['tmp_name'];

        // Ler o conteúdo da imagem
        $imagem_content = file_get_contents($imagem_tmp_name);

        // Informações da imagem
        $imagem_info = [
            'nome' => $_FILES['imagem']['name'],
            'tipo' => $_FILES['imagem']['type'],
            'conteudo' => $imagem_content,
        ];

        // Processamento dos dados do formulário
        require_once "./conexao/config.php"; // Supondo que suas configurações de conexão com o banco de dados estão nesse arquivo

        try {
            // Prepare a declaração SQL para inserir o registro
            $stmt = $conn->prepare("INSERT INTO cardapio (preco_cardapio, nome, descricao,imagem)
            VALUES (:preco, :nome, :descricao,:imagem)");

            // Vincular parâmetros aos valores
            $stmt->bindParam(':preco', $preco);
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':descricao', $descricao);
            $stmt->bindParam(':imagem', $imagem_info['conteudo'], PDO::PARAM_LOB);

            // Executar a declaração preparada
            if ($stmt->execute()) {
                // Verificar se o registro foi inserido com sucesso
                if ($stmt->rowCount() > 0) {
                    echo "Registro inserido com sucesso!";
                    header("Location: utilities-cardapio.php");
                    exit();
                } else {
                    echo "Erro ao inserir o registro.";
                }
            } else {
                echo "Erro na execução da declaração: " . $stmt->errorInfo()[2];
            }

            $stmt->closeCursor(); // Fechar o cursor do banco de dados
        } catch (PDOException $e) {
            echo "Erro na conexão: " . $e->getMessage();
        } finally {
            $conn = null; // Fechar a conexão com o banco de dados
        }
    } else {
        echo "Erro ao enviar a imagem.";
        exit();
    }
}
?>