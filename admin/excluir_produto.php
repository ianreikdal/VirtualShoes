<?php
include '../conexao.php';
include 'protect.php';

$id = intval($_GET['id']);
$sql = "DELETE FROM produtos WHERE id_produto=$id";

if ($conn->query($sql) === TRUE) {
    header("Location: index.php");
    exit;
} else {
    echo "Erro: " . $conn->error;
}
