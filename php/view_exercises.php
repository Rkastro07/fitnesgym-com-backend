<?php
session_start();
include_once('../functions/functions.php');

// Verifica se o usuário é um cliente
checkRole('client');

// Conexão com o banco de dados
$dbConnect = dbLink();

// Obter exercícios atribuídos ao cliente usando a função getClientExercises
$client_id = $_SESSION['user_id'];
$exercises = getClientExercises($dbConnect, $client_id);

?>
<!DOCTYPE html>
<html>
<head>
    <title>Your Exercises</title>
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
        <h1>Your Assigned Exercises</h1>
        <div class="info-cards">
            <?php foreach ($exercises as $exercise): ?>
            <div class="info-card">
                <div class="info-header"><?php echo htmlspecialchars($exercise['exercise_name']); ?></div>
                <p><strong>Description:</strong> <?php echo htmlspecialchars($exercise['description']); ?></p>
                <p><strong>Equipment:</strong> <?php echo htmlspecialchars($exercise['equipment']); ?></p>
                <p><strong>Sets:</strong> <?php echo $exercise['sets']; ?></p>
                <p><strong>Reps:</strong> <?php echo $exercise['reps']; ?></p>
                <p><strong>Assigned Date:</strong> <?php echo date('Y-m-d', strtotime($exercise['assigned_date'])); ?></p>
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
