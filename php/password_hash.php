<?php
// Conexão ao banco de dados
$dsn = "mysql:host=localhost;dbname=fitness_gym";
$username = "mri";
$password = "12345";

try {
    $db = new PDO($dsn, $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    die("Erro ao conectar ao banco de dados: " . $e->getMessage());
}

// Busca os usuários existentes
$sql = "SELECT id, password FROM users";
$query = $db->prepare($sql);
$query->execute();
$users = $query->fetchAll(PDO::FETCH_ASSOC);

foreach ($users as $user) {
    $id = $user['id'];
    $plainPassword = $user['password'];

    // Ignora senhas já criptografadas (com base no tamanho)
    if (strlen($plainPassword) > 60) {
        continue;
    }

    // Criptografa a senha
    $hashedPassword = password_hash($plainPassword, PASSWORD_DEFAULT);

    // Atualiza o banco de dados
    $updateSql = "UPDATE users SET password = :hashedPassword WHERE id = :id";
    $updateQuery = $db->prepare($updateSql);
    $updateQuery->bindParam(':hashedPassword', $hashedPassword);
    $updateQuery->bindParam(':id', $id);
    $updateQuery->execute();

    echo "Senha do usuário ID $id atualizada com sucesso.\n";
}

echo "Todas as senhas foram processadas.\n";
?>
