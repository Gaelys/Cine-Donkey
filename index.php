<?php
require_once __DIR__ . '/src/Repository/MovieRepository.php';

// routeur

$movies = new MovieRepository();
$movies->getMovies();
var_dump($movies);