<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $author = isset($_POST['author']) ? trim($_POST['author']) : '';
    $title = isset($_POST['title']) ? trim($_POST['title']) : '';

    if (!empty($author) && !empty($title)) {
        try {
            $stmt = $pdo->prepare('INSERT INTO books (author, title) VALUES (:author, :title)');
            $stmt->bindParam(':author', $author);
            $stmt->bindParam(':title', $title);

            if ($stmt->execute()) {
                echo "Книга успешно добавлена!";
            } else {
                echo "Ошибка при добавлении книги.";
            }
        } catch (PDOException $e) {
            echo "Ошибка: " . $e->getMessage();
        }
    } else {
        echo "Заполните все поля.";
    }
} else {
    echo "Неверный метод запроса.";
}
?>
