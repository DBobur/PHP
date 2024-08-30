<?php
include 'config.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        header("Location: todo.php");
    } else {
        echo "Xato: Foydalanuvchi nomi yoki parol noto'g'ri.";
    }
}
?>

<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <title>Kirish</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Kirish</h2>
    <form method="post">
        <label>Foydalanuvchi nomi:</label>
        <input type="text" name="username" required><br><br>
        <label>Parol:</label>
        <input type="password" name="password" required><br><br>
        <button type="submit">Kirish</button>
    </form>
</body>
</html>
