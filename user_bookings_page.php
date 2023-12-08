<?php
$title = "Mes Réservations";
require_once 'templates/head.php';
require_once(__DIR__ . '/src/Booking.php');
$title = 'Mes réservations';

require_once 'templates/head.php';


$userId = $_SESSION['idUser'];
//var_dump($userId);

$user_bookings = new Booking();
$currentBookings = $user_bookings->getCurrentBookings($userId); //Récupération de l'id du user connecté une fois ceci est géré en session
$pastBookings = $user_bookings->getPastBookings($userId); //Récupération de l'id du user connecté une fois ceci est géré en session
$showDate = 'Placeholder'; //Récupération du showDate et showTime une fois ceux-ci est géré! 
$showTime = 'Placeholder'; //Récupération du showDate et showTime une fois ceux-ci est géré! 
var_dump($user_bookings);
var_dump($pastBookings);
?>

<div class="container mt-3">
    <div>
        <h3>Réservations en cours</h3>
        <?php foreach ($currentBookings as $booking) : ?>
            <div class="card border-secondary mb-3">
                <div class="card-body">
                    <h4 class="card-header">Réservation n°<?php echo $booking['id']; ?> faite le <?php echo $booking['bookingDate']; ?> :</h4>
                    <p class="card-text mt-2"><?php echo $booking['title']; ?>: séance du <?php echo $booking['showDate']; ?> à <?php echo $booking['showTime']; ?></p>
                    <p class="card-text"><?php echo $booking['quantity']; ?> places</p>
                    <p class="card-text"><?php echo $booking['totalPrice']; ?></p>
                    <form class="offset-2" action="delete_booking.php" method="post">
                        <input type="hidden" name="booking_id" value="<?php echo $booking['id']; ?>">
                        <button class="offset-4 btn btn-secondary mb-2" type="submit">Annuler ma réservation</button>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="mt-5">
        <h3>Réservations passées</h3>
        <?php foreach ($pastBookings as $booking) : ?>
            <div class="card border-secondary mb-3">
                <div class="card-body">
                    <h4 class="card-header">Réservation n°<?php echo $booking['id']; ?> faite le <?php echo $booking['bookingDate']; ?> :</h4>
                    <p class="card-text mt-2"><?php echo $booking['title']; ?>: séance du <?php echo $booking['showDate']; ?> à <?php echo $booking['showTime']; ?></p>
                    <p class="card-text"><?php echo $booking['quantity']; ?> places</p>
                    <p class="card-text"><?php echo $booking['totalPrice']; ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<?php
require_once 'templates/footer.php';
