<?php

namespace App\Controllers;
require_once __DIR__ . '/../../vendor/autoload.php';

use App\Models\Book;
use App\Methods\BookDAO;

class BookController {
    public function addBook($postData) { 
        $title = $postData['title'] ?? '';
        $author = $postData['author'] ?? '';
        $genre = $postData['genre'] ?? '';
        $description = $postData['description'] ?? '';
        $publicationYear = $postData['publicationYear'] ?? '';
        $totalCopies = $postData['totalCopies'] ?? 0;
        $availableCopies = $postData['availableCopies'] ?? 0;

        $book = new Book($title, $author, $genre, $description, $publicationYear, $totalCopies, $availableCopies);

        $bookDAO = new BookDAO();       

               // Call the createBook method in BookDAO to handle SQL logic
         $result = $bookDAO->createBook($book);
       
        return $result;
            
    }

    public function getBooks() {
        $books = BookDAO::getAllBooks();
        return $books;
    }
}












//User add logic

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['addBook'])) {
    // Instantiate the UserController
    $bookController = new BookController();

    // Call the addUser method in UserController
    $result = $bookController->addBook($_POST);

    if ($result) {
        // User added successfully
        // Redirect to user list or wherever appropriate
        header("Location: /Brief-9-library-managment/views/admin/book-list.php");
        exit();
    } else {
        // Failed to add user
        // Handle error
        echo "Failed to add user.";
    }
}

//deleting a book php logic

if (isset($_GET['action']) && $_GET['action'] === 'delete') {
    if (isset($_GET['book_id'])) {
        $bookId = $_GET['book_id'];
        
        // Load required UserDAO file

        // Instantiate UserDAO to perform the deletion
        $bookDAO = new BookDAO();
        
        // Call the deleteUserById method in UserDAO
        $deleted = $bookDAO->deleteBookById($bookId);

        // Redirect back to user list
        if ($deleted) {
            header('Location: /Brief-9-library-managment/views/admin/book-list.php');
            exit();
        } else {
            // Handle deletion failure
            echo "Failed to delete the book.";
        }
    } else {
        echo "Book ID is missing.";
    }
} 




//updating a book logic 
//Users update handling 
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ubdateBook'])) {
    // Retrieve form data
    $bookId = $_POST['book_id'];
    $title = $_POST['title'];
    $author = $_POST['author'];
    $genre = $_POST['genre'];
    $description = $_POST['description'];
    $publicationYear = $_POST['publicationYear'];
    $totalCopies = $_POST['totalCopies'];
    $availableCopies = $_POST['availableCopies'];

    // Perform validation and sanitization as needed

    // Create an instance of BookDAO
    $bookDAO = new BookDAO();

    // Get the book object by ID to check if it exists
    $existingBook = $bookDAO->getBookById($bookId);

    if ($existingBook) {
        // Update the book object with the new data
        $existingBook->setTitle($title);
        $existingBook->setAuthor($author);
        $existingBook->setGenre($genre);
        $existingBook->setDescription($description);
        $existingBook->setPublicationYear($publicationYear);
        $existingBook->setTotalCopies($totalCopies);
        $existingBook->setAvailableCopies($availableCopies);

        // Update the book in the database
        $result = $bookDAO->updateBook($existingBook);

        if ($result) {
            // Book updated successfully
            header('Location: /Brief-9-library-managment/views/admin/book-list.php');
            exit();
        } else {
            echo "Failed to update book.";
        }
    } else {
        echo "Book not found.";
    }

}

