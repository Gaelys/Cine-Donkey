<?php
require_once(__DIR__ . '/src/Booking.php');
$title = 'Mon panier';
require_once('templates/head.php');
$showDate = 'In profress';
$showTime = 'In progress';

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
    //var_dump($pendingBookings);
?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-8 col-md-8">
                <?php
                $totalPrice = 0;
                foreach ($pendingBookings as $booking) {
                ?>
                    <div class="card border-warning mb-1">
                        <h4 class="card-header"><?= $booking['title'] ?> : séance du <?= $booking['showDate'] ?> à <?= $booking['showTime'] ?></h4>
                        <div class="card-body">
                            <div><?= $booking['quantity'] ?> places</div>
                            <div class="mt-1"><?= $booking['totalPrice'] ?>€</div>
                        </div>
                    </div>
                <?php
                    $totalPrice += $booking['totalPrice'];
                    if (isset($_GET['error'])) {
                        $errorMessage = "La commande n'a pas pu être validée. Veuillez réessayer.";
                        // Display the error message as needed
                        echo "<p class='text-danger'>$errorMessage</p>";
                    }
                }
                ?>
            </div>
            <div class="card border-warning col-sm-4 col-md-4 totalcard">
                <h3 class="card-header text-center">Total :</h3>
                <?php
                foreach ($pendingBookings as $booking) {
                ?>
                    <div class="mt-5">
                        <div class="card-header"><?= $booking['title'] ?></div>
                    </div>
                <?php
                }
                ?>
                <div class="text-center text-danger mt-5 mb-4"> <?php echo $totalPrice; ?> €</div>
                <!--form action='confirm_booking.php' method='post'>
                    <input type='hidden' name='booking_id' value='<?= $booking['id'] ?>'>
                    <button class="offset-4 btn btn-warning" type='submit' name='confirm_booking'>Régler ma commande</button>
                </form-->
            </div>
        </div>
    </div>
<?php
} catch (Exception $e) {
    // Handle the exception
    echo 'Erreur : ' . $e->getMessage();
}

require_once 'templates/footer.php';
