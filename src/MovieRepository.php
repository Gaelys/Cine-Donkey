<?php
 //var_dump(__DIR__);
 require_once __DIR__ . '/../config/config.php';

require_once  'Database.php';

class MovieRepository {
    


    // public function createBooking($user_id, $movie_id, $totalPrice, $quantity)
    // {
    //     $bookingDate = date('Y-m-d H:i:s');

    //     $bookingStatus = 'Confirmé';

    //     $query = "INSERT INTO booking ( totalPrice, bookingDate, bookingStatus, quantity, user_id, movie_id) VALUES (:totalprice, :bookingdate, :bookingstatus, :quantity, :userid, :movieid )";

    //     $statement = $this->pdo->prepare($query);

    //     $statement->bindParam(':userid', $user_id, PDO::PARAM_INT);
    //     $statement->bindParam(':totalprice', $totalPrice, PDO::PARAM_STR);
    //     $statement->bindParam(':bookingdate', $bookingDate, PDO::PARAM_STR);
    //     $statement->bindParam(':bookingstatus', $bookingStatus, PDO::PARAM_STR);
    //     $statement->bindParam(':quantity', $quantity, PDO::PARAM_INT);
    //     $statement->bindParam(':movieid', $movie_id, PDO::PARAM_INT);

    //     $result = $statement->execute();
    //     return $result;
    // }


    public function getMovieTimeDate($id) {
      
        //$query = "SELECT id,title, summary, age_rating, startShowDate, price, imagePath FROM movie WHERE movie.id=:IdMovie";
        //$query = "SELECT  m.title AS movie_title,   sd.showDate AS show_date, st.showTime AS show_time FROM movie m JOIN movie_has_showDate_and_showTime mhst ON m.id = mhst.movie_id JOIN showDate sd ON mhst.showDate_id = sd.id JOIN showTime st ON mhst.showTime_id = st.id WHERE m.id =:IdMovie";
        $query = "SELECT showDate_id, showTime_id ,title ,showDate, showTime FROM movie JOIN movie_has_showDate_and_showTime on movie.id = movie_has_showDate_and_showTime.movie_id JOIN showDate on showDate.id = movie_has_showDate_and_showTime.showdate_id JOIN showTime on showTime.id = movie_has_showDate_and_showTime.showTime_id WHERE movie.id = :IdMovie";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(":IdMovie", $id, \PDO::PARAM_INT); 
        $statement->execute();
        $movies = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $movies;
    }

    public function getMovieByID($id) {
      
        $query = "SELECT id,title, summary, age_rating, startShowDate, price, imagePath FROM movie WHERE movie.id=:IdMovie";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(":IdMovie", $id, \PDO::PARAM_INT); 
        $statement->execute();
        $movies = $statement->fetch(PDO::FETCH_ASSOC);
        return $movies;
    }

    public function getMovieTitle() {
        $query = "SELECT title ,id,imagePath FROM movie";
        $statement = $this->pdo->query($query);
        $movies = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $movies;
    }

    public function getAllMovieInformation() {
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
