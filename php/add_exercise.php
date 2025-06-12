<?php
session_start();
include_once('../functions/functions.php');

// Verifica se o usuário é treinador ou administrador
if (!isset($_SESSION['validated']) || $_SESSION['validated'] !== true || 
    !in_array($_SESSION['role'], ['trainer', 'admin'])) {
    header("Location: ../index.php");
    exit();
}

// Conexão com o banco de dados
$dbConnect = dbLink();

// Inicializa variáveis de mensagem
$success_message = '';
$error_message = '';

// Processamento do formulário
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Coleta e sanitiza os dados do formulário
    $exercise_name = trim($_POST['exercise_name']);
    $description = trim($_POST['description']);
    $equipment = trim($_POST['equipment']);
    $sets = intval($_POST['sets']);
    $reps = intval($_POST['reps']);

    // Validação básica dos dados
    if (empty($exercise_name) || empty($description) || empty($equipment) || $sets <= 0 || $reps <= 0) {
        $error_message = "Por favor, preencha todos os campos corretamente.";
    } else {
        // Prepara os dados para inserção
        $exerciseData = [
            'name' => $exercise_name,
            'description' => $description,
            'equipment' => $equipment,
            'sets' => $sets,
            'reps' => $reps
        ];

        // Chama a função para adicionar o exercício
        if (addExercise($dbConnect, $exerciseData)) {
            $success_message = "Exercício adicionado com sucesso.";
            // Limpa os campos do formulário após o sucesso
            $exercise_name = $description = $equipment = '';
            $sets = $reps = 0;
        } else {
            $error_message = "Erro ao adicionar o exercício. Tente novamente.";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add New Exercise</title>
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
        <h1>Add New Exercise</h1>

        <?php if (!empty($success_message)): ?>
            <p class="success"><?php echo htmlspecialchars($success_message); ?></p>
        <?php endif; ?>

        <?php if (!empty($error_message)): ?>
            <p class="error"><?php echo htmlspecialchars($error_message); ?></p>
        <?php endif; ?>

        <div class="info-card">
            <form action="" method="post">
                <label for="exercise_name">Nome do Exercises:</label>
                <input type="text" name="exercise_name" id="exercise_name" 
                       value="<?php echo isset($exercise_name) ? htmlspecialchars($exercise_name) : ''; ?>" required>

                <label for="description">Description:</label>
                <textarea name="description" id="description" rows="4" required><?php echo isset($description) ? htmlspecialchars($description) : ''; ?></textarea>

                <label for="equipment">Equipaments:</label>
                <input type="text" name="equipment" id="equipment" 
                       value="<?php echo isset($equipment) ? htmlspecialchars($equipment) : ''; ?>" required>

                <label for="sets">Sets:</label>
                <input type="number" name="sets" id="sets" min="1" 
                       value="<?php echo isset($sets) ? intval($sets) : ''; ?>" required>

                <label for="reps">Reps:</label>
                <input type="number" name="reps" id="reps" min="1" 
                       value="<?php echo isset($reps) ? intval($reps) : ''; ?>" required>

                <input type="submit" value="Adicionar Exercício" class="btn-submit">
            </form>
        </div>
    </main>

    <!-- Footer -->
    <footer>
        <p>Fitness Club © 2024</p>
    </footer>
</body>
</html>
