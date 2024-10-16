<?php
$books = [];
try {
    $stmt = $pdo->query("SELECT author, title FROM books"); // Измените на имя вашей таблицы
    $books = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo 'Ошибка запроса: ' . $e->getMessage();
}
?>