<?php
require 'config.php';

try {
    $books = $pdo->query('SELECT * FROM books')->fetchAll();
    foreach ($books as $book) {
        echo "<li>" . htmlspecialchars($book['title']) . " — " . htmlspecialchars($book['author']) . "</li>";
    }
} catch (PDOException $e) {
    echo "Ошибка запроса: " . $e->getMessage();
}
?>
