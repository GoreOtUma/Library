<?php
session_start();
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $signupName = $_POST['signupName'];
    $signupEmail = $_POST['signupEmail'];
    $signupBDate = $_POST['signupBDate'];
    $signupPassword = $_POST['signupPassword'];

    if (empty($signupName) || empty($signupEmail) || empty($signupBDate) || empty($signupPassword)) {
        echo "Пожалуйста, заполните все поля.";
        exit;
    }

    $hashedPassword = password_hash($signupPassword, PASSWORD_DEFAULT);

    try {
        $sql = "INSERT INTO users (role, first_name, last_name, birth_date, login, password) 
                VALUES ('user', :first_name, :last_name, :birth_date, :login, :password)";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':first_name' => $signupName,
            ':birth_date' => $signupBDate,
            ':login' => $signupEmail,
            ':password' => $hashedPassword
        ]);
        header("Location: main_window.php");
        echo "Аккаунт успешно создан!";
    } catch (PDOException $e) {
        if ($e->getCode() == 23000) {
            echo "Пользователь с таким e-mail уже существует.";
        } else {
            echo "Ошибка при создании аккаунта: " . $e->getMessage();
        }
    }
}
?>