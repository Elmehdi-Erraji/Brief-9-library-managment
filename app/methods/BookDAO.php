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
}