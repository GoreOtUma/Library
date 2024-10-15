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

jQuery(document).ready(function($) {
	const $form_modal = $('.cdUserModal'),
		$form_login = $form_modal.find('#cdLogin'),
		$form_signup = $form_modal.find('#cdSignup'),
		$form_modal_tab = $('.cdSwitcher'),
		$tab_login = $form_modal_tab.find('#loginTab'),
		$tab_signup = $form_modal_tab.find('#signupTab'),
		$main_nav = $('.mainNav');

	$main_nav.on('click', function(event){
		if( $(event.target).is($mainNav) ) {
			$(this).children('ul').toggleClass('isVisible');
		} else {
			$mainNav.children('ul').removeClass('isVisible');
			$form_modal.addClass('isVisible');	
			( $(event.target).is('.cdSignup') ) ? signupSelected() : loginSelected();
		}
	});

	$('.cdUserModal').on('click', function(event){
		if( $(event.target).is($form_modal) ) {
			$form_modal.removeClass('isVisible');
		}	
	});

	$form_modal_tab.on('click', function(event) {
		event.preventDefault();
		( $(event.target).is( $tab_login ) ) ? loginSelected() : signupSelected();
	});

	$('.hidePassword').on('click', function(){
		let $this= $(this),
			$password_field = $this.prev('input');
	
		( 'password' == $password_field.attr('type') ) ? $password_field.attr('type', 'text') : $password_field.attr('type', 'password');
		( 'Скрыть' == $this.text() ) ? $this.text('Показать') : $this.text('Скрыть');
	});

	function loginSelected(){
		$form_login.addClass('isSelected');
		$form_signup.removeClass('isSelected');
		$tab_login.addClass('selected');
		$tab_signup.removeClass('selected');
	}

	function signupSelected(){
		$form_login.removeClass('isSelected');
		$form_signup.addClass('isSelected');
		$tab_login.removeClass('selected');
		$tab_signup.addClass('selected');
	};
});


//addBook
$(document).ready(function() {
    $("#addBookBtn").click(function() {
        var author = $("#author").val();
        var title = $("#title").val();

        $.ajax({
            url: 'add_book.php',
            type: 'POST',
            data: {
                author: author,
                title: title
            },
            success: function(response) {
                alert(response);

                loadBooks();
            }
        });
    });
});

function loadBooks() {
    $.ajax({
        url: 'get_books.php',  
        method: 'GET',
        success: function(data) {
            $("#bookList").html(data);
        }
    });
}


