<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $loginEmail = $_POST['loginEmail'];
    $loginPassword = $_POST['loginPassword'];

    if (empty($loginEmail) || empty($loginPassword)) {
        echo "Пожалуйста, заполните все поля.";
        exit;
    }

    try {
        $sql = "SELECT * FROM users WHERE login = :login";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':login' => $loginEmail]);

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($loginPassword, $user['password'])) {
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['login'] = $user['login'];
            header("Location: main_window.php");
            echo "Вы успешно вошли в систему!";
        } else {
            echo "Неправильный логин или пароль.";
        }
    } catch (PDOException $e) {
        echo "Ошибка при входе: " . $e->getMessage();
    }
}
?>