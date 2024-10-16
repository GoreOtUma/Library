<?php
$myBooks = [];

try {
    // Предполагаем, что $pdo корректно подключен к базе данных
    $stmt = $pdo->prepare("
        SELECT books.author, books.title 
        FROM history 
        JOIN books ON history.book_id = books.book_id
        WHERE history.user_id = :user_id
        AND history.action = 'на руках'
        AND history.action_date = (
            SELECT MAX(action_date) 
            FROM history h2 
            WHERE h2.book_id = history.book_id 
            AND h2.user_id = history.user_id
        )
    ");
    $stmt->execute(['user_id' => $userId]);
    $myBooks = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo 'Ошибка запроса: ' . $e->getMessage();
}
?>
