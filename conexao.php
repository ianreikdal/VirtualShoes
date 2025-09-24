<?php
$host = "localhost";
$user = "root";
$pass = "root";
$db   = "ian";

// Criar conexão
$conn = new mysqli($host, $user, $pass, $db);

// Checar erro
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}
?>