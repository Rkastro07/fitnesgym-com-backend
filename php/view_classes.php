<?php
session_start();
include_once('../functions/functions.php');

// Conexão com o banco de dados
$dbConnect = dbLink();

// Verifica se o usuário está logado
if (!isset($_SESSION['validated']) || $_SESSION['validated'] !== true) {
    header("Location: ../index.php");
    exit();
}

$role = $_SESSION['role'];

// Obter lista de aulas usando a função getClasses
$classes = getClasses($dbConnect);
?>
<!DOCTYPE html>
<html>
<head>
    <title>View Classes</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body class="dashboard">
    <!-- Header e Navegação -->
    <header>
        <div class="container">
            <div class="logo">
                <a href="../index.php">Fitness <span>Club</span></a>
            </div>
            <div class="nav">
            <?php navigation(); ?>
            </div>
        </div>
    </header>

    <main>
        <h1>Available Classes</h1>
        <div class="info-cards">
            <?php foreach ($classes as $class): ?>
            <div class="info-card">
                <div class="info-header"><?php echo htmlspecialchars($class['class_name']); ?></div>
                <p><strong>Schedule:</strong> <?php echo date('Y-m-d H:i', strtotime($class['schedule'])); ?></p>
            </div>
            <?php endforeach; ?>
        </div>
    </main>

    <!-- Rodapé -->
    <footer>
        <p>Fitness Club © 2024</p>
    </footer>
</body>
</html>
