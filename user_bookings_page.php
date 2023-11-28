<?php
require_once(__DIR__ . '/src/Booking.php');
session_start();

$user_bookings = new Booking();
$currentBookings = $user_bookings->getCurrentBookings(1); //Récupération de l'id du user connecté une fois ceci est géré en session
$pastBookings = $user_bookings->getPastBookings(1); //Récupération de l'id du user connecté une fois ceci est géré en session
$showDate = 'Placeholder'; //Récupération du showDate et showTime une fois ceux-ci est géré! 
$showTime = 'Placeholder'; //Récupération du showDate et showTime une fois ceux-ci est géré! 
$showTime = 'Placeholder';
//var_dump($pastBookings);
?>

<div>
    <div>
        <h3>Réservations en cours</h3>
        <?php foreach ($currentBookings as $booking) : ?>
            <div>
                <h4>Réservation n°<?php echo $booking['id']; ?> faite le <?php echo $booking['bookingDate']; ?> :</h4>
                <p><?php echo $booking['title']; ?>: séance du <?php echo $showDate; ?> à <?php echo $showTime; ?></p>
                <p><?php echo $booking['quantity']; ?> places</p>
                <p><?php echo $booking['totalPrice']; ?></p>
                <form action="delete_booking.php" method="post">
                    <input type="hidden" name="booking_id" value="<?php echo $booking['id']; ?>">
                    <button type="submit">Annuler ma réservation</button>
                </form>
            </div>
        <?php endforeach; ?>
    </div>

    <div>
        <h3>Réservations passées</h3>
        <?php foreach ($pastBookings as $booking) : ?>
            <div>
                <h4>Réservation n°<?php echo $booking['id']; ?> faite le <?php echo $booking['bookingDate']; ?> :</h4>
                <p><?php echo $booking['title']; ?>: séance du <?php echo $showDate; ?> à <?php echo $showTime; ?></p>
                <p><?php echo $booking['quantity']; ?> places</p>
                <p><?php echo $booking['totalPrice']; ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</div>