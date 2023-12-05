<?php


require_once  __DIR__ .'/src/Movie.php';
require_once  __DIR__ .'/src/Booking.php';
$movieRepository = new Movie ();
$movie= $movieRepository -> getIdByDateAndTime  ($_POST['id_film_'],$_POST['film_date_id_'],$_POST['time']);


$bookingRepository = new Booking ();
$newbook =$bookingRepository -> createBooking ($_SESSION['idUser'],$movie['id'],$_POST['totalPrice_'],$_POST['quantity_']);

header ('Location: MovieTitle.php');

die;