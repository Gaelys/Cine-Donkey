<?php
 //var_dump(__DIR__);
 require_once __DIR__ . '/../config/config.php';

require_once  'Database.php';

class MovieRepository {
    

    public function getMovieTitle() {
        $query = "SELECT title ,id,imagePath FROM movie";
        $statement = $this->pdo->query($query);
        $movies = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $movies;
    }

    public function getAllMovie() {
        $query = "SELECT * FROM movie";
        $statement = $this->pdo->query($query);
        $movies = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $movies;
    }
 
    private $pdo;

    public function __construct() {
    $this->pdo = Database::getPdo();
}

 
}
 
// $movieRepository = new MovieRepository ();
// $movies = $movieRepository->getMovieTitle ();
// //$allmovie = $movieRepository->getAllMovie ();


// var_dump($movies);



?>
