<?php
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
        $sql = "SELECT * FROM users WHERE login = :login";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':login' => $loginEmail]);

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && $loginPassword === $user['password']) { /
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['login'] = $user['login'];
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
