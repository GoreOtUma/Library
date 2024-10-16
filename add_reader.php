<?php
session_start();
try {
    $pdo = new PDO('sqlite:library.db');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Ошибка подключения к базе данных: " . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $birth_date = $_POST['birth_date'];
    $login = $_POST['login'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (role, first_name, last_name, birth_date, login, password) 
            VALUES ('user', :first_name, :last_name, :birth_date, :login, :password)";
    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(':first_name', $first_name);
    $stmt->bindParam(':last_name', $last_name);
    $stmt->bindParam(':birth_date', $birth_date);
    $stmt->bindParam(':login', $login);
    $stmt->bindParam(':password', $password);

    if ($stmt->execute()) {
        echo "Читатель успешно добавлен!";
    } else {
        echo "Ошибка при добавлении читателя!";
    }
}
?>
