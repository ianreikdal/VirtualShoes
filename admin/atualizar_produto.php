<?php
include '../conexao.php';
include 'protect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id_produto']);
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $preco = floatval($_POST['preco']);
    $estoque = intval($_POST['estoque']);

    // Verifica se uma nova imagem foi enviada
    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] == UPLOAD_ERR_OK) {
        $imagem = $_FILES['imagem'];
        $nomeImagem = time() . "_" . basename($imagem['name']);
        $caminhoDestino = "../img/" . $nomeImagem;

        // Cria a pasta img se não existir
        if (!file_exists("../img")) {
            mkdir("../img", 0777, true);
        }

        // Move o arquivo para a pasta img
        if (move_uploaded_file($imagem['tmp_name'], $caminhoDestino)) {
            $imagemUrl = "img/" . $nomeImagem;
            // Atualiza todos os campos, incluindo imagem
            $sql = "UPDATE produtos SET nome=?, descricao=?, preco=?, estoque=?, imagem=? WHERE id_produto=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssdssi", $nome, $descricao, $preco, $estoque, $imagemUrl, $id);
        } else {
            echo "Erro ao salvar a imagem.";
            exit;
        }
    } else {
        // Atualiza sem alterar a imagem
        $sql = "UPDATE produtos SET nome=?, descricao=?, preco=?, estoque=? WHERE id_produto=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssdsi", $nome, $descricao, $preco, $estoque, $id);
    }

    if ($stmt->execute()) {
        header("Location: index.php");
        exit;
    } else {
        echo "Erro: " . $stmt->error;
    }
    $stmt->close();
} else {
    echo "Método inválido.";
}
?>