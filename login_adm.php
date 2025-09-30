<?php
session_start();
include '../conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $conn->real_escape_string($_POST['usuario']);
    $senha = $_POST['senha'];
    
    $sql = "SELECT * FROM admins WHERE usuario='$usuario'";
    $res = $conn->query($sql);
    if ($res->num_rows > 0) {
        $admin = $res->fetch_assoc();
        if (password_verify($senha, $admin['senha'])) {
            $_SESSION['admin'] = $admin['usuario'];
            header("Location: index.php");
            exit;
        } else {
            $erro = "Senha incorreta!";
        }
    } else {
        $erro = "Admin não encontrado!";
    }
}