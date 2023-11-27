<?php
require_once __DIR__ . '/../Repository/MovieRepository.php';

class  MovieController {
    public function getMovies() {
        $movieRepository = new MovieRepository();
        $movies = $movieRepository->getMovies();
        require_once __DIR__ . '/../View/MovieView.php';
    }
}