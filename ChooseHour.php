<?php



require_once  __DIR__ .'/src/Movie.php';

$movieRepository = new Movie ();
$movie= $movieRepository -> getMovieByID ($_POST['id_film_']);
$movie_has_showDate= $movieRepository -> getmovie_has_showDate($_POST['id_film_'],$_POST['date']);
$totalprice = $movie ['price']*$_POST['quantity'];
$movieByDateAndId = $movieRepository -> getmovieTimeByDateAndID ($_POST['id_film_'],$_POST['date']);



?>

<H1>Merci d'avoir choisi ce film veuillez choisir une horaire : </H1>


<form action="InsertIntoCart.php" method="POST">
<input name="id film " type="hidden" value="<?php echo $_POST['id_film_'] ;?>">
<input name="film date id " type="hidden" value="<?php echo $_POST['date'] ;?>">
<input name="totalPrice " type="hidden" value="<?php echo $totalprice ;?>">
<input name="quantity " type="hidden" value="<?php echo $_POST['quantity'] ;?>">

<div>
<label for="time"> </label>
<select name="time" id="time">
   
<option value="<?php echo $movieByDateAndId['showTime_id'];?>"><?php echo $movieByDateAndId['showTime'] ?></option>
    
</select>





<H3>Pour un Total de :</H3>

<?php echo "$totalprice ";?> €

<input type="submit" value="Envoyer">

</form>









