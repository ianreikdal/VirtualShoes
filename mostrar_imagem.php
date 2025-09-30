<?php
include 'conexao.php';
$id = intval($_GET['id']);
$sql = "SELECT imagem FROM produtos WHERE id_produto=$id";
$res = $conn->query($sql);
if ($res->num_rows > 0) {
    $img = $res->fetch_assoc()['imagem'];
    header("Content-type: image/jpeg");
    echo $img;
}
?>