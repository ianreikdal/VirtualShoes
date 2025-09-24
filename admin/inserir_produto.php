<?php
include '../conexao.php';

// Dados
$nome = $_POST['nome'];
$descricao = $_POST['descricao'];
$preco = floatval($_POST['preco']);
$estoque = intval($_POST['estoque']);

// Upload da imagem
$imagem = $_FILES['imagem'];
$nomeImagem = time() . "_" . basename($imagem['name']); // nome único
$caminhoDestino = "../img/" . $nomeImagem;

// Cria a pasta img se não existir
if (!file_exists("../img")) {
    mkdir("../img", 0777, true);
}

// Move o arquivo para a pasta img
if (move_uploaded_file($imagem['tmp_name'], $caminhoDestino)) {
    $imagemUrl = "img/" . $nomeImagem; // salva o caminho relativo no banco
} else {
    $imagemUrl = ""; // fallback se der erro
}

// Inserir no banco
$sql = "INSERT INTO produtos (nome, descricao, preco, estoque, imagem, ativo)
        VALUES ('$nome', '$descricao', $preco, $estoque, '$imagemUrl', 1)";
        
if ($conn->query($sql) === TRUE) {
    header("Location: index.php");
    exit;
} else {
    echo "Erro: " . $conn->error;
}
