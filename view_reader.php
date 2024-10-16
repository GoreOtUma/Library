<?php
$users = [];
try {
    $stmt = $pdo->query("SELECT first_name, last_name, birth_date FROM users"); // Измените на имя вашей таблицы
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo 'Ошибка запроса: ' . $e->getMessage();
}
?>