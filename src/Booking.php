<?php
require_once('Database.php');

class Booking
{
    private $pdo;

    //Instantiate PDO whehn class Booking is instanciated
    public function __construct()
    {
        $this->pdo = Database::getPdo();
    }
    //Gets all the booking  by user ID, for the user to show them later, in his all bookings page
    public function getBookingsByUserId()
    {
        $query = "SELECT * FROM booking WHERE user_id = :userid";
        $statement = $this->pdo->prepare($query);
        $statement->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $statement->execute();
    }
    //Creates the booking  after validating cart
    public function createBooking($user_id, $movie_id, $totalPrice, $quantity)
    {
        $bookingDate = date('Y-m-d H:i:s');

        $bookingStatus = 'Confirmé';

        $query = "INSERT INTO booking ( totalPrice, bookingDate, bookingStatus, quantity, user_id, movie_id) VALUES (:totalprice, :bookingdate, :bookingstatus, :quantity, :userid, :movieid )";

        $statement = $this->pdo->prepare($query);

        $statement->bindParam(':userid', $user_id, PDO::PARAM_INT);
        $statement->bindParam(':totalprice', $totalPrice, PDO::PARAM_STR);
        $statement->bindParam(':bookingdate', $bookingDate, PDO::PARAM_STR);
        $statement->bindParam(':bookingstatus', $bookingStatus, PDO::PARAM_STR);
        $statement->bindParam(':quantity', $quantity, PDO::PARAM_INT);
        $statement->bindParam(':movieid', $movie_id, PDO::PARAM_INT);

        $result = $statement->execute();

        //Gets last inserted entry of booking
        if ($result) {
            return $this->pdo->lastInsertId(); // a native PDO function : https://www.php.net/manual/fr/pdo.lastinsertid.php
        } else {
            throw new Exception("Error while creating booking"); //Back-end message, not for users, doesn't need to be in french
        }
    }
    //To get a single booking  if needed
    public function getBookingById($booking_id)
    {
        $query = "SELECT * FROM booking WHERE id = :bookingid";
        $statement = $this->pdo->prepare($query);
        $statement->bindParam(':bookingid', $booking_id, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetch(PDO::FETCH_ASSOC);
    }
    //Sort function to allow user to sort his bookings by date
    public function sortBookingsByDate($user_id)
    {

        $query = "SELECT b.*, m.title
              FROM booking b
              JOIN movie m ON b.movie_id = m.id
              WHERE b.user_id = :userid 
              ORDER BY bookingDate";

        $statement = $this->pdo->prepare($query);
        $statement->bindParam(':userid', $user_id, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    //Allowing  user to search his bookings by movie title
    public function getBookingsByMovieTitle($user_id, $movieTitle)
    {
        $query = "SELECT b.*
              FROM booking b
              JOIN movie m ON b.movie_id = m.id
              WHERE b.user_id = :userid AND m.title LIKE :movietitle";

        $statement = $this->pdo->prepare($query);
        $statement->bindParam(':userid', $user_id, PDO::PARAM_INT);
        $statement->bindValue(':movietitle', "%$movieTitle%", PDO::PARAM_STR); //% for contains in mysql
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }


    //Requête pour l'admin plus tard 
    /*public function getAllBookings()
    {
        $query = "SELECT * FROM booking";
        $statement = $this->pdo->query($query);

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }*/
}
