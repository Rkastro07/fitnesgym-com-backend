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
$username = $_SESSION['username'];
?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo ucfirst($role); ?> Dashboard</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body class="dashboard">
    <!-- Header e navegação -->
    <header>
    <div class="container">
        <div class="logo">
            <a href="<?php echo $basePath; ?>index.php">
                <img src="<?php echo $basePath; ?>images/logo.webp" alt="panabianco" style="max-height: 50px;">
            </a>
        </div>
        <div class="nav">
            <?php navigation(); ?>
        </div>
    </div>
</header>


    <!-- Conteúdo do Dashboard -->
    <main>
        <h1>Welcome, <?php echo ucfirst($username); ?>!</h1>

        <div class="info-cards">
            <?php
            if ($role === 'admin') {
                // Funcionalidades do administrador
                echo '
                <div class="info-card">
                    <div class="info-header">Admin Panel</div>
                    <p><a href="manage_users.php">Manage Users</a></p>
                    <p><a href="manage_classes.php">Manage Classes</a></p>
                    <p><a href="manage_exercises.php">Manage Exercises</a></p>
                    <p><a href="manage_timetables.php">Manage Timetables</a></p>
                </div>
                ';
            } elseif ($role === 'trainer') {
                // Funcionalidades do treinador
                echo '
                <div class="info-card">
                    <div class="info-header">Trainer Panel</div>
                    <p><a href="view_classes.php">View Classes</a></p>
                    <p><a href="manage_exercises.php">Manage Exercises</a></p>
                    <p><a href="assign_exercises.php">Assign Exercises to Clients</a></p>
                </div>
                ';
            } else {
                // Funcionalidades do cliente
                echo '
                <div class="info-card">
                    <div class="info-header">Client Panel</div>
                    <p><a href="view_classes.php">View Classes</a></p>
                    <p><a href="view_exercises.php">View Your Exercises</a></p>
                </div>
                ';
            }
            ?>
        </div>
    </main>

    <!-- Footer -->
    <footer>
        <p>Fitness Club © 2024</p>
    </footer>
</body>
</html>
