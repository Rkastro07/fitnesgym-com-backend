<?php
session_start();
include_once('../functions/functions.php');

// Verifica se o usuário é treinador ou administrador
if (!isset($_SESSION['validated']) || $_SESSION['validated'] !== true || 
    !in_array($_SESSION['role'], ['trainer', 'admin'])) {
    header("Location: ../index.php");
    exit();
}

// Conexão com o banco de dados
$dbConnect = dbLink();

// Obtém o ID do exercício a ser deletado
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: manage_exercises.php");
    exit();
}

$exercise_id = intval($_GET['id']);

// Opcional: Verifica se o exercício existe antes de deletar
$sql = "SELECT * FROM exercises WHERE id = :id";
$query = $dbConnect->prepare($sql);
$query->bindParam(":id", $exercise_id, PDO::PARAM_INT);
$query->execute();
$exercise = $query->fetch(PDO::FETCH_ASSOC);

if (!$exercise) {
    header("Location: manage_exercises.php");
    exit();
}

// Deleta o exercício usando a função deleteExercise()
if (deleteExercise($dbConnect, $exercise_id)) {
    // Opção 1: Redirecionar imediatamente após deletar
    header("Location: manage_exercises.php?message=Exercise+deleted+successfully");
    exit();

    // Opção 2: Adicionar confirmação antes de deletar
    // Neste caso, a confirmação já é feita via JavaScript no link de exclusão,
    // então podemos proceder diretamente para deletar.
} else {
    // Se a exclusão falhar, redireciona com uma mensagem de erro
    header("Location: manage_exercises.php?error=Error+deleting+exercise");
    exit();
}
?>
