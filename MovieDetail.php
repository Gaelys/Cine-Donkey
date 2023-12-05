<?php
$title = "Informations du film";
require_once 'templates/head.php';
require_once  __DIR__ .'/src/Movie.php';

$movieID = $_GET ["id"];


$movieRepository = new Movie ();
$alldetails = $movieRepository->getMovieByID($movieID);
$allshowtimes = $movieRepository->getMovieTimeDate($movieID);

?>

<div class="container mt-5">
    <div>
        <div class="d-flex">                   
            <div class="offset-2"><img src="<?php echo $alldetails["imagePath"];?>" width="350em" height="450em"/></div>
            <div class="offset-1"> 
                <h1 class="text-success"><?php echo $alldetails ["title"]; ?></h1>
                <h3>Synopsis : </h3><?php echo $alldetails ["summary"]; ?>
                <p><?php echo $alldetails ["age_rating"]; ?></p>
                <h3>Date de Sortie :</h3><?php echo $alldetails ["startShowDate"]; ?>
                <h3>Prix :</h3><?php echo $alldetails ["price"]; ?> euros
                <form action="ChooseHour.php" method="POST">
                    <input name="id film" type="hidden" value="<?php echo $movieID;?>">
                    <div class="form-group">
                        <label class="form-label" for="date">Date de visionnage : </label>
                        <select class="form-select" name="date" id="date">
                            <?php foreach ($allshowtimes as $allshowtime): ?>
                            <option value="<?php echo $allshowtime['showDate_id'];?>"><?php echo $allshowtime['showDate'] ?></option>
                            <?php endforeach ?>
                        </select>
                        <div>
                            <label class="form-label" for="quantity" name="quantity"> Nombre de places : </label>
                            <input class="form-control" type="number" id="quantity" name="quantity" min="1"/>
                        </div>
                        <div class="offset-4 mt-1">
                            <input class="offset-1 btn btn-primary" type="submit" value="Envoyer">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<?php 
require_once 'templates/footer.php';