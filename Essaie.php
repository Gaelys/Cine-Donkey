<?php

 var_dump($_POST);
//die;

require_once  __DIR__ .'/src/MovieRepository.php';
//$movieID = $_GET ["id"];

// var_dump($movieID);
// die;
$movieRepository = new MovieRepository ();
$dateTimes = $_POST['date'] ." ". $_POST['time'];
echo $dateTimes;
die;
$allinserts = $movieRepository->createBooking($_POST['id_film_'],$_POST['date'],$_POST['time'],1);

header('Location: MovieTitle.php');

