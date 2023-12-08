<?php
$title = "Séance";
require_once 'templates/head.php';

require_once  __DIR__ . '/src/Movie.php';

if (empty($_POST)) {
    header('Location: index.php');
    die;
}
$movieRepository = new Movie();
$movie = $movieRepository->getMovieByID($_POST['id_film']);
$movie_has_showDate = $movieRepository->getmovie_has_showDate($_POST['id_film'], $_POST['date']);
$totalprice = $movie['price'] * $_POST['quantity'];
$movieByDateAndId = $movieRepository->getmovieTimeByDateAndID($_POST['id_film'], $_POST['date']);

?>

<h1 class="text-center mb-4">Merci d'avoir choisi ce film, veuillez choisir un horaire : </h1>


<form action="InsertIntoCart.php" method="POST">
    <input name="id film" type="hidden" value="<?php echo $_POST['id_film']; ?>">
    <input name="film date id " type="hidden" value="<?php echo $_POST['date']; ?>">
    <input name="totalPrice " type="hidden" value="<?php echo $totalprice; ?>">
    <input name="quantity " type="hidden" value="<?php echo $_POST['quantity']; ?>">
    <div class="container">
        <div class="container text-center col-sm-4">
            <label class="form-label" for="time">Horaires disponibles :</label>
            <select class="form-select" name="time" id="time">
                <option value="<?php echo $movieByDateAndId['showTime_id']; ?>"><?php echo $movieByDateAndId['showTime'] ?></option>
            </select>
        </div>
        <div class="text-center">
            <h3>Pour un Total de :</h3>
            <h4 class="text-danger"><?php echo "$totalprice "; ?> €</h4>
        </div>
    </div>
    <div class="container text-center">
        <input class="btn btn-primary mt-3" type="submit" value="Envoyer">
    </div>
</form>

<?php
require_once 'templates/footer.php';
