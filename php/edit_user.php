<?php
session_start();
include_once('../functions/functions.php');

// Verifica se o usuário é administrador
checkRole('admin');

// Conexão com o banco de dados
$dbConnect = dbLink();

$userId = $_GET['id'];

// Obter dados do usuário
$sql = "SELECT * FROM users WHERE id = :id";
$query = $dbConnect->prepare($sql);
$query->bindParam(":id", $userId);
$query->execute();
$user = $query->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    header("Location: manage_users.php");
    exit();
}

// Processamento do formulário
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Atualizar usuário no banco de dados
    $sql = "UPDATE users SET username = :username, password = :password, role = :role WHERE id = :id";
    $query = $dbConnect->prepare($sql);
    $query->bindParam(":username", $username);
    $query->bindParam(":password", $password);
    $query->bindParam(":role", $role);
    $query->bindParam(":id", $userId);
    $query->execute();

    header("Location: manage_users.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
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

    <div class="dashboard-content">
        <h1>Edit User</h1>
        <form action="" method="post">
            <label for="username">Username:</label><br>
            <input type="text" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required><br>
            <label for="password">Password:</label><br>
            <input type="password" name="password" value="<?php echo htmlspecialchars($user['password']); ?>" required><br>
            <label for="role">Role:</label><br>
            <select name="role">
                <option value="client" <?php if ($user['role'] == 'client') echo 'selected'; ?>>Client</option>
                <option value="trainer" <?php if ($user['role'] == 'trainer') echo 'selected'; ?>>Trainer</option>
                <option value="admin" <?php if ($user['role'] == 'admin') echo 'selected'; ?>>Admin</option>
            </select><br><br>
            <input type="submit" value="Update User">
        </form>
    </div>

    <!-- Footer -->
    <footer>
        <p>Fitness Club © 2024</p>
    </footer>
</body>
</html>
