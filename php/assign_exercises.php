<?php
session_start();
include_once('../functions/functions.php');

// Verifica se o usuário é um treinador
checkRole('trainer');

// Conexão com o banco de dados
$dbConnect = dbLink();

// Processamento do formulário de atribuição
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $client_id = $_POST['client_id'];
    $exercise_id = $_POST['exercise_id'];

    // Atribuir exercício ao cliente usando a função assignExerciseToClient
    if (assignExerciseToClient($dbConnect, $client_id, $exercise_id)) {
        $success_message = "Exercise assigned to client successfully.";
    } else {
        $error_message = "Error assigning exercise.";
    }
}

// Obter lista de clientes usando a função getClients
$clients = getClients($dbConnect);

// Obter lista de exercícios usando a função getExercises
$exercises = getExercises($dbConnect);

?>
<!DOCTYPE html>
<html>
<head>
    <title>Assign Exercises to Clients</title>
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
        <h1>Assign Exercises to Clients</h1>

        <?php if (isset($success_message)): ?>
            <p class="success"><?php echo $success_message; ?></p>
        <?php elseif (isset($error_message)): ?>
            <p class="error"><?php echo $error_message; ?></p>
        <?php endif; ?>

        <div class="info-card">
            <form action="" method="post">
                <label for="client_id">Select Client:</label>
                <select name="client_id" required>
                    <?php foreach ($clients as $client): ?>
                        <option value="<?php echo $client['id']; ?>"><?php echo htmlspecialchars($client['username']); ?></option>
                    <?php endforeach; ?>
                </select>

                <label for="exercise_id">Select Exercise:</label>
                <select name="exercise_id" required>
                    <?php foreach ($exercises as $exercise): ?>
                        <option value="<?php echo $exercise['id']; ?>"><?php echo htmlspecialchars($exercise['exercise_name']); ?></option>
                    <?php endforeach; ?>
                </select>

                <input type="submit" value="Assign Exercise">
            </form>
        </div>
    </main>

    <!-- Rodapé -->
    <footer>
        <p>Fitness Club © 2024</p>
    </footer>
</body>
</html>
