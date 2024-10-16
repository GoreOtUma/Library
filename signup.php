<?php
session_start();
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $signupName = $_POST['signupName'];
    $signupLastName = $_POST['signupLastName'];
    $signupEmail = $_POST['signupEmail'];
    $signupBDate = $_POST['signupBDate'];
    $signupPassword = $_POST['signupPassword'];

    if (empty($signupName) || empty($signupEmail) || empty($signupBDate) || empty($signupPassword)) {
        echo "Пожалуйста, заполните все поля.";
        exit;
    }

    try {
        $sql = "INSERT INTO users (role, first_name, last_name, birth_date, login, password) 
                VALUES ('user', :first_name, :last_name, :birth_date, :login, :password)";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':first_name' => $signupName,
            ':last_name' => $signupLastName,
            ':birth_date' => $signupBDate,
            ':login' => $signupEmail,
            ':password' => $signupPassword
        ]);
        $user_id = $pdo->lastInsertId();
        $sql = "SELECT * FROM users WHERE user_id = :user_id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':user_id' => $user_id]);

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['login'] = $user['login'];
            $_SESSION['role'] = $user['role']; 
        }

        header("Location: main_window.php");
        exit;
    } catch (PDOException $e) {
        if ($e->getCode() == 23000) {
            echo "Пользователь с таким e-mail уже существует.";
        } else {
            echo "Ошибка при создании аккаунта: " . $e->getMessage();
        }
    }
}
?>