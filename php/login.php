<?php
session_start();
include_once('../functions/functions.php');

// Conexão com o banco de dados
$dbConnect = dbLink();

// Processamento do formulário de login
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    if (validateUser($dbConnect, $username, $password, $role)) {
        header("Location: dashboard.php");
        exit();
    } else {
        $_SESSION['login_error'] = "Invalid credentials. Please try again.";
        header("Location: ../index.php");
        exit();
    }
}
?>
