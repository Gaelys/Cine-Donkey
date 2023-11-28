<?php
require_once('Database.php');

class Booking
{
    private int $id;
    private float $totalPrice;
    private string $bookingDate;
    private string $bookingStatus;
    private int $quantity;

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
        return $result;

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
    //Function to get current bookings

    public function getCurrentBookings($user_id)
    {
        $currentDate = date('Y-m-d H:i:s');

        $query = "SELECT b.*, m.title
                  FROM booking b
                  JOIN movie m ON b.movie_id = m.id
                  WHERE b.user_id = :userid AND b.bookingDate > :currentdate
                  ORDER BY b.bookingDate";

        $statement = $this->pdo->prepare($query);
        $statement->bindParam(':userid', $user_id, PDO::PARAM_INT);
        $statement->bindParam(':currentdate', $currentDate, PDO::PARAM_STR);
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    //Function to get past bookings
    public function getPastBookings($user_id)
    {
        $currentDate = date('Y-m-d H:i:s');
        //echo $currentDate; 
        $query = "SELECT b.*, m.title
                  FROM booking b
                  JOIN movie m ON b.movie_id = m.id
                  WHERE b.user_id = :userid AND b.bookingDate <= :currentdate
                  ORDER BY b.bookingDate";

        $statement = $this->pdo->prepare($query);
        $statement->bindParam(':userid', $user_id, PDO::PARAM_INT);
        $statement->bindParam(':currentdate', $currentDate, PDO::PARAM_STR);
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    //Deletion function from booking
    public function deleteBooking($booking_id)
    {
        $query = "DELETE FROM booking WHERE id = :bookingid";
        $statement = $this->pdo->prepare($query);
        $statement->bindParam(':bookingid', $booking_id, PDO::PARAM_INT);

        return $statement->execute();
    }
    //Requête pour l'admin plus tard 
    /*public function getAllBookings()
    {
        $query = "SELECT * FROM booking";
        $statement = $this->pdo->query($query);

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }*/

    /**
     * Get the value of id
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @param int $id
     *
     * @return self
     */
    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Get the value of totalPrice
     *
     * @return float
     */
    public function getTotalPrice(): float
    {
        return $this->totalPrice;
    }

    /**
     * Set the value of totalPrice
     *
     * @param float $totalPrice
     *
     * @return self
     */
    public function setTotalPrice(float $totalPrice): self
    {
        $this->totalPrice = $totalPrice;
        return $this;
    }

    /**
     * Get the value of bookingDate
     *
     * @return string
     */
    public function getBookingDate(): string
    {
        return $this->bookingDate;
    }

    /**
     * Set the value of bookingDate
     *
     * @param string $bookingDate
     *
     * @return self
     */
    public function setBookingDate(string $bookingDate): self
    {
        $this->bookingDate = $bookingDate;
        return $this;
    }

    /**
     * Get the value of bookingStatus
     *
     * @return string
     */
    public function getBookingStatus(): string
    {
        return $this->bookingStatus;
    }

    /**
     * Set the value of bookingStatus
     *
     * @param string $bookingStatus
     *
     * @return self
     */
    public function setBookingStatus(string $bookingStatus): self
    {
        $this->bookingStatus = $bookingStatus;
        return $this;
    }

    /**
     * Get the value of quantity
     *
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * Set the value of quantity
     *
     * @param int $quantity
     *
     * @return self
     */
    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;
        return $this;
    }
}
