<?php
include '../conexao.php';
include 'protect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id_produto'];
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];
    $estoque = $_POST['estoque'];
    
    $imagem = $_FILES['imagem'];

    $sql = "UPDATE produtos SET nome=?, descricao=?, preco=?, estoque=? WHERE id_produto=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssdss", $nome, $descricao, $preco, $estoque, $id);

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