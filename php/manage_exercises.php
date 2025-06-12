<?php
session_start();
include_once('../functions/functions.php');

// Verifica se o usuário é treinador ou administrador
if ($_SESSION['role'] !== 'trainer' && $_SESSION['role'] !== 'admin') {
    header("Location: ../index.php");
    exit();
}

// Conexão com o banco de dados
$dbConnect = dbLink();

// Obter lista de exercícios usando a função getExercises
$exercises = getExercises($dbConnect);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Manage Exercises</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
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

    <div class="dashboard-content">
        <h1>Manage Exercises</h1>
        <a href="add_exercise.php" class="btn">Add New Exercise</a>
        <table>
            <tr>
                <th>Exercise Name</th>
                <th>Description</th>
                <th>Equipment</th>
                <th>Sets</th>
                <th>Reps</th>
                <th>Actions</th>
            </tr>
            <?php foreach ($exercises as $exercise): ?>
            <tr>
                <td><?php echo htmlspecialchars($exercise['exercise_name']); ?></td>
                <td><?php echo htmlspecialchars($exercise['description']); ?></td>
                <td><?php echo htmlspecialchars($exercise['equipment']); ?></td>
                <td><?php echo $exercise['sets']; ?></td>
                <td><?php echo $exercise['reps']; ?></td>
                <td>
                    <a href="edit_exercise.php?id=<?php echo $exercise['id']; ?>">Edit</a>
                    <a href="delete_exercise.php?id=<?php echo $exercise['id']; ?>" onclick="return confirm('Are you sure?');">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>

    <!-- Rodapé -->
    <footer>
        <p>Fitness Club © 2024</p>
    </footer>
</body>
</html>
