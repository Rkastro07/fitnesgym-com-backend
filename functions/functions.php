<?php

$basePath = (strpos($_SERVER['SCRIPT_NAME'], '/php/') !== false) ? '../' : '';


function dbLink() {
    $db_user = 'mri';
    $db_pass = '12345';
    $db_host = 'localhost';
    $db_name = 'fitness_gym';
    try {
        $db = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (Exception $e) {
        echo "Unable to access database: " . $e->getMessage();
        exit();
    }
    return $db;
}

// Função para validar usuário
function validateUser($dbConnect, $username, $password, $role) {
    $sql = "SELECT * FROM users WHERE username = :username AND role = :role";
    $query = $dbConnect->prepare($sql);
    $query->bindParam(":username", $username);
    $query->bindParam(":role", $role);
    $query->execute();
    $user = $query->fetch(PDO::FETCH_ASSOC);

    // Verifica se o usuário existe e valida a senha usando password_verify
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $username;
        $_SESSION['role'] = $role;
        $_SESSION['validated'] = true;
        return true;
    }

    return false; // Login falhou
}




// Função de navegação
function navigation() {
    global $basePath;
    if (isset($_SESSION['validated']) && $_SESSION['validated'] === true) {
        echo '
            <nav class="header nav login-form">
                <a href="' . $basePath . 'index.php?logout=true" class="nav-link">Logout</a>
                <a href="' . $basePath . 'php/dashboard.php" class="nav-link">Dashboard</a>
                <a href="' . $basePath . 'index.php" class="nav-link">Home</a>
            </nav>
        ';
    } else {
        echo '
            <form action="' . $basePath . 'php/login.php" method="post" class="login-form">
                <input type="text" name="username" placeholder="Enter Username" required class="input-field">
                <input type="password" name="password" placeholder="Enter Password" required class="input-field">
                <select name="role" class="select-role">
                    <option value="client">Client</option>
                    <option value="trainer">Trainer</option>
                    <option value="admin">Admin</option>
                </select>
                <input type="submit" value="Login" class="btn-login">
            </form>
        ';
    }
}





// Função para verificar se o usuário está logado e tem o papel correto
function checkRole($requiredRole) {
    if (!isset($_SESSION['validated']) || $_SESSION['validated'] !== true || $_SESSION['role'] !== $requiredRole) {
        header("Location: ../index.php");
        exit();
    }
}

// Funções para Clientes

// Obter lista de aulas
function getClasses($dbConnect) {
    $sql = "SELECT * FROM classes";
    $query = $dbConnect->prepare($sql);
    $query->execute();
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

// Obter exercícios atribuídos a um cliente
function getClientExercises($dbConnect, $client_id) {
    $sql = "SELECT e.exercise_name, e.description, e.equipment, e.sets, e.reps, ce.assigned_date
            FROM exercises e
            INNER JOIN client_exercises ce ON e.id = ce.exercise_id
            WHERE ce.client_id = :client_id";
    $query = $dbConnect->prepare($sql);
    $query->bindParam(":client_id", $client_id);
    $query->execute();
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

// Funções para Treinadores

// Obter lista de exercícios
function getExercises($dbConnect) {
    $sql = "SELECT * FROM exercises";
    $query = $dbConnect->prepare($sql);
    $query->execute();
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

// Adicionar exercício
function addExercise($dbConnect, $exerciseData) {
    $sql = "INSERT INTO exercises (exercise_name, description, equipment, sets, reps) VALUES (:name, :description, :equipment, :sets, :reps)";
    $query = $dbConnect->prepare($sql);
    $query->bindParam(":name", $exerciseData['name']);
    $query->bindParam(":description", $exerciseData['description']);
    $query->bindParam(":equipment", $exerciseData['equipment']);
    $query->bindParam(":sets", $exerciseData['sets']);
    $query->bindParam(":reps", $exerciseData['reps']);
    return $query->execute();
}

// Atualizar exercício
function updateExercise($dbConnect, $exerciseData) {
    $sql = "UPDATE exercises SET exercise_name = :name, description = :description, equipment = :equipment, sets = :sets, reps = :reps WHERE id = :id";
    $query = $dbConnect->prepare($sql);
    $query->bindParam(":id", $exerciseData['id']);
    $query->bindParam(":name", $exerciseData['name']);
    $query->bindParam(":description", $exerciseData['description']);
    $query->bindParam(":equipment", $exerciseData['equipment']);
    $query->bindParam(":sets", $exerciseData['sets']);
    $query->bindParam(":reps", $exerciseData['reps']);
    return $query->execute();
}

// Excluir exercício
function deleteExercise($dbConnect, $exercise_id) {
    $sql = "DELETE FROM exercises WHERE id = :id";
    $query = $dbConnect->prepare($sql);
    $query->bindParam(":id", $exercise_id);
    return $query->execute();
}

// Atribuir exercício a um cliente
function assignExerciseToClient($dbConnect, $client_id, $exercise_id) {
    $assigned_date = date('Y-m-d');
    $sql = "INSERT INTO client_exercises (client_id, exercise_id, assigned_date) VALUES (:client_id, :exercise_id, :assigned_date)";
    $query = $dbConnect->prepare($sql);
    $query->bindParam(":client_id", $client_id);
    $query->bindParam(":exercise_id", $exercise_id);
    $query->bindParam(":assigned_date", $assigned_date);
    return $query->execute();
}

// Obter lista de clientes
function getClients($dbConnect) {
    $sql = "SELECT * FROM users WHERE role = 'client'";
    $query = $dbConnect->prepare($sql);
    $query->execute();
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

// Funções para Administradores

// Gerenciar usuários
function createUser($dbConnect, $userData) {
    $hashedPassword = password_hash($userData['password'], PASSWORD_DEFAULT); // Criptografar senha
    $sql = "INSERT INTO users (username, password, role) VALUES (:username, :password, :role)";
    $query = $dbConnect->prepare($sql);
    $query->bindParam(":username", $userData['username']);
    $query->bindParam(":password", $hashedPassword);
    $query->bindParam(":role", $userData['role']);
    return $query->execute();
}


function updateUser($dbConnect, $userData) {
    $hashedPassword = password_hash($userData['password'], PASSWORD_DEFAULT); // Criptografar senha
    $sql = "UPDATE users SET username = :username, password = :password, role = :role WHERE id = :id";
    $query = $dbConnect->prepare($sql);
    $query->bindParam(":id", $userData['id']);
    $query->bindParam(":username", $userData['username']);
    $query->bindParam(":password", $hashedPassword);
    $query->bindParam(":role", $userData['role']);
    return $query->execute();
}


function deleteUser($dbConnect, $user_id) {
    $sql = "DELETE FROM users WHERE id = :id";
    $query = $dbConnect->prepare($sql);
    $query->bindParam(":id", $user_id);
    return $query->execute();
}

// Gerenciar classes
function createClass($dbConnect, $classData) {
    $sql = "INSERT INTO classes (class_name, schedule) VALUES (:class_name, :schedule)";
    $query = $dbConnect->prepare($sql);
    $query->bindParam(":class_name", $classData['class_name']);
    $query->bindParam(":schedule", $classData['schedule']);
    return $query->execute();
}

function updateClass($dbConnect, $classData) {
    $sql = "UPDATE classes SET class_name = :class_name, schedule = :schedule WHERE id = :id";
    $query = $dbConnect->prepare($sql);
    $query->bindParam(":id", $classData['id']);
    $query->bindParam(":class_name", $classData['class_name']);
    $query->bindParam(":schedule", $classData['schedule']);
    return $query->execute();
}

function deleteClass($dbConnect, $class_id) {
    $sql = "DELETE FROM classes WHERE id = :id";
    $query = $dbConnect->prepare($sql);
    $query->bindParam(":id", $class_id);
    return $query->execute();
}

// Gerenciar horários (timetables)
function createTimetable($dbConnect, $timetableData) {
    $sql = "INSERT INTO timetables (day, start_time, end_time) VALUES (:day, :start_time, :end_time)";
    $query = $dbConnect->prepare($sql);
    $query->bindParam(":day", $timetableData['day']);
    $query->bindParam(":start_time", $timetableData['start_time']);
    $query->bindParam(":end_time", $timetableData['end_time']);
    return $query->execute();
}

function updateTimetable($dbConnect, $timetableData) {
    $sql = "UPDATE timetables SET day = :day, start_time = :start_time, end_time = :end_time WHERE id = :id";
    $query = $dbConnect->prepare($sql);
    $query->bindParam(":id", $timetableData['id']);
    $query->bindParam(":day", $timetableData['day']);
    $query->bindParam(":start_time", $timetableData['start_time']);
    $query->bindParam(":end_time", $timetableData['end_time']);
    return $query->execute();
}

function deleteTimetable($dbConnect, $timetable_id) {
    $sql = "DELETE FROM timetables WHERE id = :id";
    $query = $dbConnect->prepare($sql);
    $query->bindParam(":id", $timetable_id);
    return $query->execute();
}
?>