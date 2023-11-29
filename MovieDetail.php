<?php

require_once  __DIR__ .'/src/MovieRepository.php';

$movieRepository = new MovieRepository ();
$alldetail = $movieRepository->getAllMovie();

var_dump($alldetail);