<?php
require_once __DIR__ . '/../Model/Database.php';

class MovieRepository {

    private $pdo;

    public function __construct() {
        $this->pdo = Database::getPdo();
    }

    public function getMovies() {
        $query = "SELECT * FROM movie";
        $statement = $this->pdo->query($query);
        $movies = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $movies;
    }

}