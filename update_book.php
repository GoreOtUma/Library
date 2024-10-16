<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $bookId = $_POST['book_id'];
    $title = $_POST['title'];
    $author = $_POST['author'];

    if (!empty($bookId) && !empty($title) && !empty($author)) {
        // Обновляем книгу в базе данных
        $stmt = $pdo->prepare("UPDATE books SET title = ?, author = ? WHERE book_id = ?");
        $stmt->execute([$title, $author, $bookId]);

        if ($stmt->rowCount() > 0) {
            echo 'success';
        } else {
            echo 'error';
        }
    } else {
        echo 'invalid';
    }
}
?>
