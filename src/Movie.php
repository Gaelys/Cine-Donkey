<?php
 require_once __DIR__ . '/../config/config.php';

 require_once  'Database.php';
 
Class Movie {
    private string $title;
    private string $summary;
    private string $agerating;
    private string $date;
    private float $startShowDate;
    private string $imagePath;
    private $pdo;



    

//     public function __construct() {
//     $this->pdo = Database::getPdo();
// }




    public function __construct()
    {
       
     $this->pdo = Database::getPdo();
      

    }


    /**
     * Get the value of title
     *
     * @return string
     */
    public function getTitle(): string {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @param string $title
     *
     * @return self
     */
    public function setTitle(string $title): self {
        $this->title = $title;
        return $this;
    }

    /**
     * Get the value of summary
     *
     * @return string
     */
    public function getSummary(): string {
        return $this->summary;
    }

    /**
     * Set the value of summary
     *
     * @param string $summary
     *
     * @return self
     */
    public function setSummary(string $summary): self {
        $this->summary = $summary;
        return $this;
    }

    /**
     * Get the value of agerating
     *
     * @return string
     */
    public function getAgerating(): string {
        return $this->agerating;
    }

    /**
     * Set the value of agerating
     *
     * @param string $agerating
     *
     * @return self
     */
    public function setAgerating(string $agerating): self {
        $this->agerating = $agerating;
        return $this;
    }

    /**
     * Get the value of date
     *
     * @return string
     */
    public function getDate(): string {
        return $this->date;
    }

    /**
     * Set the value of date
     *
     * @param string $date
     *
     * @return self
     */
    public function setDate(string $date): self {
        $this->date = $date;
        return $this;
    }

    /**
     * Get the value of startShowDate
     *
     * @return float
     */
    public function getStartShowDate(): float {
        return $this->startShowDate;
    }

    /**
     * Set the value of startShowDate
     *
     * @param float $startShowDate
     *
     * @return self
     */
    public function setStartShowDate(float $startShowDate): self {
        $this->startShowDate = $startShowDate;
        return $this;
    }

    /**
     * Get the value of imagePath
     *
     * @return string
     */
    public function getImagePath(): string {
        return $this->imagePath;
    }

    /**
     * Set the value of imagePath
     *
     * @param string $imagePath
     *
     * @return self
     */
    public function setImagePath(string $imagePath): self {
        $this->imagePath = $imagePath;
        return $this;
    }


    public function getMovieTimeDate($id) {
      
        //$query = "SELECT id,title, summary, age_rating, startShowDate, price, imagePath FROM movie WHERE movie.id=:IdMovie";
        //$query = "SELECT  m.title AS movie_title,   sd.showDate AS show_date, st.showTime AS show_time FROM movie m JOIN movie_has_showDate_and_showTime mhst ON m.id = mhst.movie_id JOIN showDate sd ON mhst.showDate_id = sd.id JOIN showTime st ON mhst.showTime_id = st.id WHERE m.id =:IdMovie";
        //$query = "SELECT showDate_id, showTime_id ,title ,showDate, showTime FROM movie JOIN movie_has_showDate_and_showTime on movie.id = movie_has_showDate_and_showTime.movie_id JOIN showDate on showDate.id = movie_has_showDate_and_showTime.showdate_id JOIN showTime on showTime.id = movie_has_showDate_and_showTime.showTime_id WHERE movie.id = :IdMovie";
        $query = "SELECT movie_has_showDate_and_showTime.id AS movie_has_showDate_and_showTime, showDate_id, showTime_id, title, showDate, showTime 
          FROM movie 
          JOIN movie_has_showDate_and_showTime ON movie.id = movie_has_showDate_and_showTime.movie_id 
          JOIN showDate ON showDate.id = movie_has_showDate_and_showTime.showdate_id 
          JOIN showTime ON showTime.id = movie_has_showDate_and_showTime.showTime_id 
          WHERE movie.id = :IdMovie";

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
     
    public function getmovie_has_showDate_and_showTime($movie_id,$showDate_id,$showTime_id) {
        $query = "SELECT movie_has_showDate_and_showTime.id FROM movie_has_showDate_and_showTime WHERE movie_id = :movieid and showDate_id = :showDateid and showTime_id = :showTimeid";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(":movieid", $movie_id, \PDO::PARAM_INT);
        $statement->bindValue(":showDateid", $showDate_id, \PDO::PARAM_INT); 
        $statement->bindValue(":showTimeid", $showTime_id, \PDO::PARAM_INT);  
        $statement->execute();
        $movies = $statement->fetch(PDO::FETCH_ASSOC);
        return $movies;
    }

    public function getmovie_has_showDate($movie_id,$showDate_id) {
        $query = "SELECT movie_has_showDate_and_showTime.showTime_id FROM movie_has_showDate_and_showTime WHERE movie_id = :movieid and showDate_id = :showDateid";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(":movieid", $movie_id, \PDO::PARAM_INT);
        $statement->bindValue(":showDateid", $showDate_id, \PDO::PARAM_INT); 
        //$statement->bindValue(":showTimeid", $showTime_id, \PDO::PARAM_INT);  
        $statement->execute();
        $movies = $statement->fetch(PDO::FETCH_ASSOC);
        return $movies;
    }

    public function getmovieTimeByDateAndID($movie_id,$showDate_id) {
        $query = "SELECT showTime_id,showTime  FROM showTime JOIN movie_has_showDate_and_showTime ON showTime.id = movie_has_showDate_and_showTime.showTime_id WHERE  movie_id = :movieid AND showDate_id = :showDateid";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(":movieid", $movie_id, \PDO::PARAM_INT);
        $statement->bindValue(":showDateid", $showDate_id, \PDO::PARAM_INT); 
        //$statement->bindValue(":showTimeid", $showTime_id, \PDO::PARAM_INT);  
        $statement->execute();
        $movies = $statement->fetch(PDO::FETCH_ASSOC);
        return $movies;
    }
    
    public function getIdByDateAndTime($movie_id,$showDate_id,$showTime_id) {
        $query = "SELECT movie_has_showDate_and_showTime.id FROM movie_has_showDate_and_showTime JOIN showTime ON showTime.id = movie_has_showDate_and_showTime.showTime_id WHERE  movie_id = :movieid AND showDate_id = :showDateid AND showTime_id = :showTimeid";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(":movieid", $movie_id, \PDO::PARAM_INT);
        $statement->bindValue(":showDateid", $showDate_id, \PDO::PARAM_INT);
        $statement->bindValue(":showTimeid", $showTime_id, \PDO::PARAM_INT); 
        //$statement->bindValue(":showTimeid", $showTime_id, \PDO::PARAM_INT);  
        $statement->execute();
        $movies = $statement->fetch(PDO::FETCH_ASSOC);
        return $movies;
    }
    
 
   


 }
