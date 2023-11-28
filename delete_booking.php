<?php
require_once(__DIR__ . '/src/Booking.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['booking_id'])) {
    $booking_to_delete = $_POST['booking_id'];

    $user_bookings = new Booking();
    $bookDeletion = $user_bookings->deleteBooking($booking_to_delete);

    if ($bookDeletion) {
        echo "Votre réservation a bien été supprimée";
    } else {
        echo "Erreur lors de la suppression de la réservation.";
    }
} else {
    echo "Requête non valide.";
}
