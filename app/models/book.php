<?php 

namespace app\models;

class Book
{
    private $id;
    private $title;
    private $author;
    private $genre;
    private $description;
    private $publicationYear;
    private $totalCopies;
    private $availableCopies;

    // Constructor
    public function __construct($title, $author, $genre, $description, $publicationYear, $totalCopies, $availableCopies)
    {
        $this->title = $title;
        $this->author = $author;
        $this->genre = $genre;
        $this->description = $description;
        $this->publicationYear = $publicationYear;
        $this->totalCopies = $totalCopies;
        $this->availableCopies = $availableCopies;
    }

    // Getters and Setters for properties

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getAuthor()
    {
        return $this->author;
    }

    public function setAuthor($author)
    {
        $this->author = $author;
    }

    public function getGenre()
    {
        return $this->genre;
    }

    public function setGenre($genre)
    {
        $this->genre = $genre;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getPublicationYear()
    {
        return $this->publicationYear;
    }

    public function setPublicationYear($publicationYear)
    {
        $this->publicationYear = $publicationYear;
    }

    public function getTotalCopies()
    {
        return $this->totalCopies;
    }

    public function setTotalCopies($totalCopies)
    {
        $this->totalCopies = $totalCopies;
    }

    public function getAvailableCopies()
    {
        return $this->availableCopies;
    }

    public function setAvailableCopies($availableCopies)
    {
        $this->availableCopies = $availableCopies;
    }
}