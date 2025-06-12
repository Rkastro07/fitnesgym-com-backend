<?php
session_start();
include_once('../functions/functions.php');

// Verifica se o usuário é administrador
checkRole('admin');

// Conexão com o banco de dados
$dbConnect = dbLink();

// Obter lista de horários
$sql = "SELECT * FROM timetables";
$query = $dbConnect->prepare($sql);
$query->execute();
$timetables = $query->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Manage Timetables</title>
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
        <h1>Manage Timetables</h1>
        <a href="add_timetable.php" class="btn">Add New Timetable</a>
        <table>
            <tr>
                <th>Day</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Actions</th>
            </tr>
            <?php foreach ($timetables as $timetable): ?>
            <tr>
                <td><?php echo htmlspecialchars($timetable['day']); ?></td>
                <td><?php echo date('H:i', strtotime($timetable['start_time'])); ?></td>
                <td><?php echo date('H:i', strtotime($timetable['end_time'])); ?></td>
                <td>
                    <a href="edit_timetable.php?id=<?php echo $timetable['id']; ?>">Edit</a>
                    <a href="delete_timetable.php?id=<?php echo $timetable['id']; ?>" onclick="return confirm('Are you sure?');">Delete</a>
                </td>
            <?php endforeach; ?>
            </tr>
        </table>
    </div>

    <!-- Rodapé -->
    <footer>
        <p>Fitness Club © 2024</p>
    </footer>
</body>
</html>
