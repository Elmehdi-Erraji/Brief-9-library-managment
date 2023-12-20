<?php

namespace App\Methods;
require_once __DIR__ . '/../../vendor/autoload.php';

use App\Models\Book;
use App\database\db_conn;


class BookDAO {
    private $db;

    public function __construct() {
        $this->db = db_conn::getConnection(); // Get the database connection
    }

    public function createBook(Book $book) {
        $title = $book->getTitle();
        $author = $book->getAuthor();
        $genre = $book->getGenre();
        $description = $book->getDescription();
        $publicationYear = $book->getPublicationYear();
        $totalCopies = $book->getTotalCopies();
        $availableCopies = $book->getAvailableCopies();

        $query = "INSERT INTO book (title, author, genre, description, publication_year, totalCopies, availableCopies) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($this->db, $query);

        mysqli_stmt_bind_param($stmt, "sssssii", $title, $author, $genre, $description, $publicationYear, $totalCopies, $availableCopies);
        $success = mysqli_stmt_execute($stmt);

        return $success;
    }

    public static function getAllBooks() {
        $connection = db_conn::getConnection();
        $books = [];
    
        $query = "SELECT * from book";
    
        $result = mysqli_query($connection, $query);
    
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $book = new Book(
                    $row['title'],
                    $row['author'],
                    $row['genre'],
                    $row['description'],
                    $row['publication_year'],
                    $row['totalCopies'],
                    $row['availableCopies']
                );
                $book->setId($row['id']) ; // Set the user ID
                
    
                $books[] = $book;
            }
            mysqli_free_result($result);
        }
    
        return $books;
    }


    public function deleteBookById($userId) {
        $connection = db_conn::getConnection();

        // Delete the user from the users table
        $deleteBookQuery = "DELETE FROM book WHERE id = $userId";
        $stmtBook = $connection->query($deleteBookQuery);

        // Check if both delete operations were successful
        if ($stmtBook) {
            return true; // Deletion successful
        } else {
            return false; // User not found or deletion failed
        }
    }



}