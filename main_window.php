<?php
session_start();
require 'check_role.php'; 

include 'config.php';

$userRole = $_SESSION['role']; 
$userId = $_SESSION['user_id']; 
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
    <?php if ($userRole === 'user'):?>
        <script async src="scriptMainR.js"></script>
    <?php endif; ?>
    <?php if ($userRole === 'librarian'):?>
        <script async src="scriptMainL.js"></script>
    <?php endif; ?>
</head>
<body>
<main>
<div class="wrapper backgroundColor">
    <aside id="menu">
        <div id="mainNav">
            <h1>Library</h1>
            <nav>
                <ul>
                        <li id="booksTab">Книги</li>
                        <?php if ($userRole === 'user'):?>
                            <li id="readersTab" style='display:block'>Мои книги</li>
                        <?php endif; ?>
                        <?php if ($userRole === 'librarian'):?>
                            <li id="readersTab">Читатели</li>
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

    <section id="readersPage" style="display:none">
        <?php if ($userRole === 'librarian'): ?>
        <h2>Читатели</h2>
        <?php endif; ?>
        <?php if ($userRole === 'user'): ?>
        <h2>Мои книги</h2>
        <?php endif; ?>
    
        <div class="container">
            <div class="list-container">
                <?php if ($userRole === 'librarian'): ?>
                <div class="list-box">
                    <ul id="readerList">
                        <li>Элемент примера 1</li>
                        <li>Элемент примера 2</li>
                        <li>Элемент примера 3</li>
                        <li>Элемент примера 4</li>
                        <li>Элемент примера 5</li>
                    </ul>
                </div>
                <?php endif; ?>
                <div class="list-box">
                    <ul id="bookList">
                        <li>Элемент примера 1</li>
                        <li>Элемент примера 2</li>
                        <li>Элемент примера 3</li>
                        <li>Элемент примера 4</li>
                        <li>Элемент примера 5</li>
                    </ul>
                </div>
            </div>
             
            <?php if ($userRole === 'librarian'): ?>
            <div class="form-container">
                <form action="add_reader.php" method="POST">
                    <input type="text" name="first_name" placeholder="Имя" required>
                    <input type="text" name="last_name" placeholder="Фамилия" required>
                    <input type="date" name="birth_date" placeholder="Дата рождения" required>
                    <input type="text" name="login" placeholder="Логин" required> 
                    <input type="password" name="password" placeholder="Пароль" required> <br><br>
                    <button id="addReaderBtn" type="submit">Добавить читателя</button>
                </form>
            </div>
            <br><br>
            <div class="form-container">
                <button id="removeReaderBtn">Удалить читателя</button>
            </div>
            <?php endif; ?>
        </div>
    </section>

    <?php if ($userRole === 'librarian'): ?>
    <section id="libraryPage" style="display:none">
        <h2>Библиотека</h2>
        <div class="library-container">
            <div class="library-lists">
                <div class="book-list-section">
                    <h3><?php echo ($userRole === 'librarian') ? 'Список книг' : 'Мои книги'; ?></h3>
                    <ul id="libraryBookList">
                        <li>Книга 1</li>
                        <li>Книга 2</li>
                        <li>Книга 3</li>
                        <li>Книга 4</li>
                        <li>Книга 5</li>
                    </ul>
                </div>

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
            </div>
        </div>
    </section>
    <?php endif; ?>
</div>
</main>
</body>
</html>