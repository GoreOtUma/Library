<?php

try {

    $pdo = new PDO('sqlite:library.db');
    

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Успешное подключение к базе данных!";
} catch (PDOException $e) {

    echo "Ошибка подключения к базе данных: " . $e->getMessage();
}

?>
