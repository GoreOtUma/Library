<?php
session_start();

// Проверяем, авторизован ли пользователь
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php"); // Если пользователь не авторизован, перенаправляем на страницу входа
    exit();
}

// Получаем роль пользователя
$role = $_SESSION['role'];

// Функция для проверки, является ли пользователь библиотекарем
function isLibrarian() {
    return $_SESSION['role'] === 'librarian';
}
?>
