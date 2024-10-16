<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php"); 
    exit();
}

$role = $_SESSION['role'];

function isLibrarian() {
    return $_SESSION['role'] === 'librarian';
}
?>
