<?php

 var_dump($_POST);

require_once  __DIR__ .'/src/MovieRepository.php';

$movieRepository = new MovieRepository ();
$movie= $movieRepository -> getMovieByID ($_POST['id_film_']);
$movie_has_showDate= $movieRepository -> getmovie_has_showDate($_POST['id_film_'],$_POST['date']);
$totalprice = $movie ['price']*$_POST['quantity'];
$movieByDateAndId = $movieRepository -> getmovieTimeByDateAndID ($_POST['id_film_'],$_POST['date']);

//var_dump($_POST['quantity']);
//var_dump($movie_has_showDate);
//var_dump($totalprice);
//var_dump($movieByDateAndId);

?>

<H1>Merci d'avoir choisi ce film veuillez choisir une horaire : </H1>

<form action="FinalEssaie.php" method="POST">
<input name="id film " type="hidden" value="<?php echo $_POST['id_film_'] ;?>">
<input name="film date id " type="hidden" value="<?php echo $_POST['date'] ;?>">
<input name="totalPrice " type="hidden" value="<?php echo $totalprice ;?>">
<input name="quantity " type="hidden" value="<?php echo $_POST['quantity'] ;?>">

<div>
<label for="time"> </label>
<select name="time" id="time">
   
<option value="<?php echo $movieByDateAndId['showTime'];?>"><?php echo $movieByDateAndId['showTime'] ?></option>
    
</select>





<H3>Pour un Total de :</H3>

<?php echo "$totalprice ";?> €

<input type="submit" value="Envoyer">

</form>









