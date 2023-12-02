<?php
require_once(__DIR__ . '/src/Booking.php');
$title = 'Mon panier';
require_once('templates/head.php');

try {
    if (!isset($_SESSION['idUser'])) {
        throw new Exception('User not logged in.');
    }
    if (isset($_GET['error'])) {
        $errorMessage = "La commande n'a pas pu être validée. Veuillez réessayer.";
        // Display the error message as needed
        echo "<p style='color: red;'>$errorMessage</p>";
    }

    $userId = $_SESSION['idUser'];

    $booking = new Booking();
    $pendingBookings = $booking->getPendingBookings($userId);


    foreach ($pendingBookings as $booking) {
?>
        <div>
            <h4>Réservation n°<?= $booking['id'] ?> faite le <?= $booking['bookingDate'] ?> :</h4>
            <p><?= $booking['title'] ?>: séance du <?= $showDate ?> à <?= $showTime ?></p>
            <p><?= $booking['quantity'] ?> places</p>
            <p><?= $booking['totalPrice'] ?></p>
            <form action='confirm_booking.php' method='post'>
                <input type='hidden' name='booking_id' value='<?= $booking['id'] ?>'>
                <button type='submit' name='confirm_booking'>Valider mon panier</button>
            </form>
        </div>
<?php
        if (isset($_GET['error'])) {
            $errorMessage = "La commande n'a pas pu être validée. Veuillez réessayer.";
            // Display the error message as needed
            echo "<p class='text-danger'>$errorMessage</p>";
        }
    }
} catch (Exception $e) {
    // Handle the exception
    echo 'Erreur : ' . $e->getMessage();
}
?>