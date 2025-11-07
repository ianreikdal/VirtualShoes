<?php
include 'conexao.php';

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Verifica se os campos existem antes de acessá-los
    if (isset($_POST['nome']) && isset($_POST['endereco'])) {
        $nome = mysqli_real_escape_string($conn, (string) $_POST['nome']);
        $endereco = mysqli_real_escape_string($conn, (string) $_POST['endereco']);

        // Use o nome correto da coluna de data (provavelmente 'criado_em' baseado na sua imagem)
        $sql = "INSERT INTO pedidos (nome, endereco, criado_em) 
                VALUES ('$nome', '$endereco', NOW())";

        if ($conn->query($sql) === TRUE) {
            echo "<div class='alert alert-success'>Pedido inserido com sucesso!</div>";
        } else {
            echo "<div class='alert alert-danger'>Erro ao inserir pedido: " . $conn->error . "</div>";
        }
    } else {
        echo "<div class='alert alert-warning'>Por favor, preencha todos os campos do formulário.</div>";
    }

    $conn->close();
}