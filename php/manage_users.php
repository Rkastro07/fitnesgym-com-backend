<?php
session_start();
include_once('../functions/functions.php');

// Verifica se o usuário é administrador
checkRole('admin');

// Conexão com o banco de dados
$dbConnect = dbLink();

// Exibir lista de usuários
$sql = "SELECT * FROM users";
$users = $dbConnect->query($sql)->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Manage Users</title>
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
        <h1>Manage Users</h1>
        <a href="add_user.php" class="btn">Add New User</a>
        <div class="info-cards">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Role</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?php echo $user['id']; ?></td>
                        <td><?php echo htmlspecialchars($user['username']); ?></td>
                        <td><?php echo ucfirst($user['role']); ?></td>
                        <td>
                            <a href="edit_user.php?id=<?php echo $user['id']; ?>">Edit</a>
                            <a href="delete_user.php?id=<?php echo $user['id']; ?>" onclick="return confirm('Are you sure?');">Delete</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>

    <!-- Footer -->
    <footer>
        <p>Fitness Club © 2024</p>
    </footer>
</body>
</html>
