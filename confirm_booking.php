<!-- Logique de confirmation du "panier" par l'utilisateur, et le changement du statut booking en "Confirmé" -->
<?php
require_once(__DIR__ . '/src/Booking.php');
$title = 'Confirmation de la commande';
require_once('templates/head.php');

if (isset($_POST['confirm_booking'])) {
    $bookingId = $_POST['booking_id'];

    $booking = new Booking();
    $success = $booking->confirmBooking($bookingId);

    if ($success) {
        header("Location: showCart.php");
        exit;
    } else {
        header("Location: showCart.php?error=1");
        exit;
    }
}
