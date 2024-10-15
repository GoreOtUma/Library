<?php
session_start();
require 'check_role.php'; // Проверка на авторизацию и получение роли пользователя

include 'config.php'; // Подключение к базе данных

$userRole = $_SESSION['role']; // Получаем роль пользователя
$userId = $_SESSION['user_id']; // Получаем ID пользователя

// Получение списка книг, которые взял пользователь (для роли 'user')
$myBooks = [];
if ($userRole === 'user') {
    $sql = "SELECT books.title FROM books 
            JOIN borrowed_books ON books.book_id = borrowed_books.book_id 
            WHERE borrowed_books.user_id = :user_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':user_id' => $userId]);
    $myBooks = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" type="text/css" href="https://necolas.github.io/normalize.css/8.0.1/normalize.css">
    <script async src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script async src="scriptMain.js"></script>
</head>
<body>
<div id="userRole" style="display:none;"><?php echo $_SESSION['role']; ?></div>
<main>
<div class="wrapper backgroundColor">
    <aside id="menu">
        <div id="mainNav">
            <h1>Library</h1>
            <nav>
                <ul>
                    <?php if ($userRole === 'librarian'): ?>
                        <li id="booksTab">Книги</li>
                        <li id="readersTab">Читатели</li>
                        <li id="libraryTab">Библиотека</li>
                    <?php else: ?>
                        <li id="booksTab">Книги</li>
                        <li id="libraryTab">Библиотека</li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
        <div id="settingsNav">
            <nav>
                <ul>
                    <li id="exitLibrary"><a class="cdExit" id="cdExit" href="exit.php">Выход</a></li>
                </ul>
            </nav>
        </div>
    </aside>

    <section id="overlay"></section>

    <!-- Секция книг -->
    <section id="booksPage">
        <h2>Книги</h2>
        <div class="book-container">
            <?php if ($userRole === 'librarian'): ?>
                <div class="book-form">
                    <label for="author">Автор</label>
                    <input type="text" id="author" name="author">
    
                    <label for="title">Название</label>
                    <input type="text" id="title" name="title">
    
                    <button id="addBookBtn">Добавить книгу</button>
                    <button id="removeBookBtn">Удалить книгу</button>
                </div>
            <?php endif; ?>
            <div class="book-list-wrapper">
                <h3>Список всех книг</h3>
                <div class="book-list-container">
                    <ul id="bookList">
                        <li>Книга 1</li>
                        <li>Книга 2</li>
                        <li>Книга 3</li>
                        <li>Книга 4</li>
                        <li>Книга 5</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Секция библиотеки -->
    <section id="libraryPage" style="display:none">
        <h2>Библиотека</h2>
        <div class="library-container">
            <div class="library-lists">
                <div class="book-list-section">
                    <h3><?php echo ($userRole === 'librarian') ? 'Список книг' : 'Мои книги'; ?></h3>
                    <ul id="libraryBookList">
                        <?php if ($userRole === 'librarian'): ?>
                            <li>Книга 1</li>
                            <li>Книга 2</li>
                            <li>Книга 3</li>
                            <li>Книга 4</li>
                            <li>Книга 5</li>
                        <?php else: ?>
                            <!-- Отображаем только книги пользователя -->
                            <?php foreach ($myBooks as $book): ?>
                                <li><?php echo htmlspecialchars($book['title']); ?></li>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </ul>
                </div>

                <?php if ($userRole === 'librarian'): ?>
                    <div class="reader-list-section">
                        <h3>Список читателей</h3>
                        <div class="reader-list-and-actions">
                            <ul id="readerList">
                                <li>Читатель 1</li>
                                <li>Читатель 2</li>
                                <li>Читатель 3</li>
                                <li>Читатель 4</li>
                                <li>Читатель 5</li>
                            </ul>
                            <div class="library-actions">
                                <button id="issueBookBtn">Выдать книгу</button>
                                <button id="returnBookBtn">Принять книгу</button>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
</div>
</main>
</body>
</html>
