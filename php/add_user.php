<?php
session_start();
include_once('../functions/functions.php');

// Verifica se o usuário é administrador
checkRole('admin');

// Conexão com o banco de dados
$dbConnect = dbLink();

// Processamento do formulário
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Inserir usuário no banco de dados
    $sql = "INSERT INTO users (username, password, role) VALUES (:username, :password, :role)";
    $query = $dbConnect->prepare($sql);
    $query->bindParam(":username", $username);
    $query->bindParam(":password", $password);
    $query->bindParam(":role", $role);
    $query->execute();

    header("Location: manage_users.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add New User</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body class="dashboard">
    <!-- Header e navegação -->
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
        <h1>Add New User</h1>
        <div class="info-card">
            <form action="" method="post">
                <label for="username">Username:</label>
                <input type="text" name="username" required>

                <label for="password">Password:</label>
                <input type="password" name="password" required>

                <label for="role">Role:</label>
                <select name="role">
                    <option value="client">Client</option>
                    <option value="trainer">Trainer</option>
                    <option value="admin">Admin</option>
                </select>

                <input type="submit" value="Add User">
            </form>
        </div>
    </main>

    <!-- Footer -->
    <footer>
        <p>Fitness Club © 2024</p>
    </footer>
</body>
</html>
