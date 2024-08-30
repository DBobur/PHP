<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);

    if ($stmt->execute()) {
        echo "Ro'yxatdan muvaffaqiyatli o'tdingiz!";
    } else {
        echo "Xato: Ro'yxatdan o'tishda muammo yuz berdi.";
    }
}
?>

<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <title>Ro'yxatdan o'tish</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Ro'yxatdan o'tish</h2>
    <form method="post">
        <label>Foydalanuvchi nomi:</label>
        <input type="text" name="username" required><br><br>
        <label>Parol:</label>
        <input type="password" name="password" required><br><br>
        <button type="submit">Ro'yxatdan o'tish</button>
    </form>
</body>
</html>
