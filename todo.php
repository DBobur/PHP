<?php
include 'config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $todo_text = $_POST['todo_text'];

    $stmt = $conn->prepare("INSERT INTO todos (user_id, todo_text) VALUES (:user_id, :todo_text)");
    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':todo_text', $todo_text);

    if ($stmt->execute()) {
        echo "Todo muvaffaqiyatli qo'shildi!";
    } else {
        echo "Xato: Todo qo'shishda muammo yuz berdi.";
    }
}

$todos_stmt = $conn->prepare("SELECT * FROM todos WHERE user_id = :user_id");
$todos_stmt->bindParam(':user_id', $user_id);
$todos_stmt->execute();
$todos = $todos_stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <title>Todo ro'yxati</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Todo ro'yxati</h2>
    <form method="post">
        <label>Todo:</label>
        <input type="text" name="todo_text" required><br><br>
        <button type="submit">Qo'shish</button>
    </form>
    <h3>Todo'lar:</h3>
    <ul>
        <?php foreach ($todos as $todo): ?>
            <li><?= htmlspecialchars($todo['todo_text']) ?></li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
