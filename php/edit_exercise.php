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

// Obtém o ID do exercício a ser editado
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: manage_exercises.php");
    exit();
}

$exercise_id = intval($_GET['id']);

// Obtém os dados do exercício existente
$sql = "SELECT * FROM exercises WHERE id = :id";
$query = $dbConnect->prepare($sql);
$query->bindParam(":id", $exercise_id, PDO::PARAM_INT);
$query->execute();
$exercise = $query->fetch(PDO::FETCH_ASSOC);

if (!$exercise) {
    header("Location: manage_exercises.php");
    exit();
}

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
        // Prepara os dados para atualização
        $exerciseData = [
            'id' => $exercise_id,
            'name' => $exercise_name,
            'description' => $description,
            'equipment' => $equipment,
            'sets' => $sets,
            'reps' => $reps
        ];

        // Chama a função para atualizar o exercício
        if (updateExercise($dbConnect, $exerciseData)) {
            $success_message = "Exercício atualizado com sucesso.";
            // Atualiza os dados exibidos no formulário
            $exercise['exercise_name'] = $exercise_name;
            $exercise['description'] = $description;
            $exercise['equipment'] = $equipment;
            $exercise['sets'] = $sets;
            $exercise['reps'] = $reps;
        } else {
            $error_message = "Erro ao atualizar o exercício. Tente novamente.";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Exercise</title>
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
        <h1>Edit Exercise</h1>

        <?php if (!empty($success_message)): ?>
            <p class="success"><?php echo htmlspecialchars($success_message); ?></p>
        <?php endif; ?>

        <?php if (!empty($error_message)): ?>
            <p class="error"><?php echo htmlspecialchars($error_message); ?></p>
        <?php endif; ?>

        <div class="info-card">
            <form action="" method="post">
                <label for="exercise_name">EXERCISE:</label>
                <input type="text" name="exercise_name" id="exercise_name" 
                       value="<?php echo htmlspecialchars($exercise['exercise_name']); ?>" required>

                <label for="description">Description:</label>
                <textarea name="description" id="description" rows="4" required><?php echo htmlspecialchars($exercise['description']); ?></textarea>

                <label for="equipment">Equipament:</label>
                <input type="text" name="equipment" id="equipment" 
                       value="<?php echo htmlspecialchars($exercise['equipment']); ?>" required>

                <label for="sets">Ssets:</label>
                <input type="number" name="sets" id="sets" min="1" 
                       value="<?php echo intval($exercise['sets']); ?>" required>

                <label for="reps">Reps:</label>
                <input type="number" name="reps" id="reps" min="1" 
                       value="<?php echo intval($exercise['reps']); ?>" required>

                <input type="submit" value="Atualizar Exercício" class="btn-submit">
            </form>
        </div>
    </main>

    <!-- Footer -->
    <footer>
        <p>Fitness Club © 2024</p>
    </footer>
</body>
</html>
