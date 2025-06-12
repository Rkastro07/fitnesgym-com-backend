<?php
session_start();
include_once('../functions/functions.php');

// Verifica se o usuário é administrador
checkRole('admin');

// Conexão com o banco de dados
$dbConnect = dbLink();

$userId = $_GET['id'];

// Deletar usuário
$sql = "DELETE FROM users WHERE id = :id";
$query = $dbConnect->prepare($sql);
$query->bindParam(":id", $userId);
$query->execute();

header("Location: manage_users.php");
exit();
?>
