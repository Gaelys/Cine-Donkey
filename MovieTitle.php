<?php

require_once __DIR__.'/src/MovieRepository.php';

$movieRepository = new MovieRepository ();
$allTitles = $movieRepository->getMovieTitle();

//var_dump($allTitles);
?>
 <div>
    <table>
        <thead>
            <tr>
                <th> Movies Title</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($allTitles as $allTitle):?>
                
               
                <tr class="d-flex">
                    
                    <td><img src="<?php echo $allTitle["imagePath"];?>" width="160em" height="250e"/></td>
                    <td> <?php echo $allTitle ["title"]; ?></td>
                    <td><a href="MovieDetail.php?id=<?php echo $allTitle ["id"];?>">Details</a></td>
                </tr>
                <?php endforeach; ?>

        </tbody>
    </table>
</div> 