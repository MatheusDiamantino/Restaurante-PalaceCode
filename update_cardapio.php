<?php
// Start session
if (!session_id()) {
    session_start();
}



require_once "./conexao/config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Define os campos esperados
    $id_card = $_POST['id'];
    $preco = $_POST['preco'];
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];

    // Verifica se a imagem foi enviada corretamente
    if(isset($_FILES['nova_imagem']) && $_FILES['nova_imagem']['error'] === UPLOAD_ERR_OK) {
        $imagem_temp = $_FILES['nova_imagem']['tmp_name'];
        $novaImagem = file_get_contents($imagem_temp);

        // Visualizar se a imagem foi enviada corretamente
        var_dump($_FILES['nova_imagem']);
    } else {
        // Se nenhuma nova imagem foi enviada, mantenha a imagem existente no banco de dados
        try {
            $conn = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sqlSelect = "SELECT imagem FROM cardapio WHERE ID_CARDAPIO=:id_card";
            $stmt = $conn->prepare($sqlSelect);
            $stmt->bindParam(':id_card', $id_card);
            $stmt->execute();
            $row3 = $stmt->fetch();

            if ($row3 && $row3['imagem']) {
                $novaImagem = $row3['imagem'];
            } else {
                $novaImagem = null;
            }
        } catch (PDOException $e) {
            echo "Erro na conexão: " . $e->getMessage();
            exit();
        }
    }

    // Visualizar outras variáveis
    var_dump($id_card);
    var_dump($preco);
    var_dump($nome);
    var_dump($descricao);

    try {
        // Cria uma nova conexão PDO
        require_once "./conexao/config.php";
        $conn = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
        // Define o modo de erro PDO para exceções
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Verifica se a imagem deve ser atualizada
        if ($_FILES['nova_imagem']['error'] === UPLOAD_ERR_OK) {
            $novaImagem = file_get_contents($_FILES['nova_imagem']['tmp_name']);

            // Visualizar informações da nova imagem
            echo "Informações da nova imagem:<br>";
            var_dump($_FILES['nova_imagem']);

            $sqlUpdate = "UPDATE cardapio SET PRECO_CARDAPIO = :preco,
                                            NOME = :nome,
                                            DESCRICAO = :descricao,
                                            imagem = :imagem
                            WHERE ID_CARDAPIO=:id_card";

            $stmt = $conn->prepare($sqlUpdate);
            $stmt->bindParam(':id_card', $id_card);
            $stmt->bindParam(':preco', $preco);
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':descricao', $descricao);
            $stmt->bindParam(':imagem', $novaImagem, PDO::PARAM_LOB);
        } else {
            // Se nenhuma nova imagem foi enviada, atualize apenas os outros campos
            $sqlUpdate = "UPDATE cardapio SET PRECO_CARDAPIO = :preco,
                                            NOME = :nome,
                                            DESCRICAO = :descricao
                            WHERE ID_CARDAPIO=:id_card";

            $stmt = $conn->prepare($sqlUpdate);
            $stmt->bindParam(':id_card', $id_card);
            $stmt->bindParam(':preco', $preco);
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':descricao', $descricao);
        }

        // Executa a atualização
        $stmt->execute();
        header("Location: utilities-cardapio.php");
    } catch (PDOException $e) {
        echo "Erro ao atualizar o cardápio: " . $e->getMessage();
    }

    // Fecha a conexão com o banco de dados
    $conn = null;
}
?>
