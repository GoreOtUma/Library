const booksPage = document.getElementById('booksPage');
const readersPage = document.getElementById('readersPage');
const libraryPage = document.getElementById('libraryPage');
const booksTab = document.getElementById('booksTab');
const readersTab = document.getElementById('readersTab');
const libraryTab = document.getElementById('libraryTab');

function showBooks() {
    booksPage.style.display = 'block';
    readersPage.style.display = 'none';
    libraryPage.style.display = 'none';
}

function showReaders() {
    booksPage.style.display = 'none';
    readersPage.style.display = 'block';
    libraryPage.style.display = 'none';
}

function showLibrary() {
    booksPage.style.display = 'none';
    readersPage.style.display = 'none';
    libraryPage.style.display = 'block';
}

booksTab.addEventListener('click', showBooks);
readersTab.addEventListener('click', showReaders);
libraryTab.addEventListener('click', showLibrary);