<?php



require_once  __DIR__ .'/src/MovieRepository.php';
require_once  __DIR__ .'/src/Booking.php';
$movieRepository = new MovieRepository ();
$movie= $movieRepository -> getIdByDateAndTime  ($_POST['id_film_'],$_POST['film_date_id_'],$_POST['time']);



$bookingRepository = new Booking ();
$newbook =$bookingRepository -> createBooking ($_SESSION['idUser'],$movie['id'],$_POST['totalPrice_'],$_POST['quantity_']);

header ('Location: MovieTitle.php');

die;