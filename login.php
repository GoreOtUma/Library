<?php
session_start();
include 'config.php';
session_start();
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $loginEmail = $_POST['loginEmail'];
    $loginPassword = $_POST['loginPassword'];

    if (empty($loginEmail) || empty($loginPassword)) {
        echo "Пожалуйста, заполните все поля.";
        exit;
    }

    try {
        // Проверяем данные пользователя в базе
        $sql = "SELECT * FROM users WHERE login = :login";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':login' => $loginEmail]);

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Проверяем пароль и авторизуем пользователя
        if ($user && $loginPassword === $user['password']) { 
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['login'] = $user['login'];
            $_SESSION['role'] = $user['role']; // Сохраняем роль (например, 'librarian' или 'user')
            
            // Перенаправляем пользователя на основную страницу
            header("Location: main_window.php");
            exit;
        } else {
            echo "Неправильный логин или пароль.";
        }
    } catch (PDOException $e) {
        echo "Ошибка при входе: " . $e->getMessage();
    }
}
?>

