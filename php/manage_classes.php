<?php
session_start();
include_once('../functions/functions.php');

// Verifica se o usuário é administrador
checkRole('admin');

// Conexão com o banco de dados
$dbConnect = dbLink();

// Obter lista de classes usando a função getClasses
$classes = getClasses($dbConnect);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Manage Classes</title>
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
        <h1>Manage Classes</h1>
        <a href="add_class.php" class="btn">Add New Class</a>
        <table>
            <tr>
                <th>Class Name</th>
                <th>Schedule</th>
                <th>Actions</th>
            </tr>
            <?php foreach ($classes as $class): ?>
            <tr>
                <td><?php echo htmlspecialchars($class['class_name']); ?></td>
                <td><?php echo date('Y-m-d H:i', strtotime($class['schedule'])); ?></td>
                <td>
                    <a href="edit_class.php?id=<?php echo $class['id']; ?>">Edit</a>
                    <a href="delete_class.php?id=<?php echo $class['id']; ?>" onclick="return confirm('Are you sure?');">Delete</a>
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
