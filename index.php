<?php
$title = "Accueil";
require_once 'templates/head.php';
require_once __DIR__.'/src/Movie.php';

$movieRepository = new Movie ();
$allTitles = $movieRepository->getMovieTitle();

//var_dump($allTitles);
?>
<div class="container-fluid">
    <h1 class="text-center mb-5 text-success">Vos Films :</h1>
        <div class="row">
            <?php foreach ($allTitles as $allTitle):?>
                <div class="col-md-4 mb-4">
                    <div class="image-container text-center"><img src="<?php echo $allTitle["imagePath"];?>" width="240em" height="280e"/></div>
                    <div class="text-center">
                        <h4 class="text-success"><?php echo $allTitle ["title"]; ?></h4>
                        <p><a href="MovieDetail.php?id=<?php echo $allTitle ["id"];?>">Details</a></p>
                    </div>
                </div>
                <?php endforeach; ?>
        </div>
</div> 

<?php
require_once 'templates/footer.php';