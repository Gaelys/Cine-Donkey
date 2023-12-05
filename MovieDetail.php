<?php

require_once  __DIR__ .'/src/Movie.php';
$movieID = $_GET ["id"];


$movieRepository = new Movie ();
$alldetails = $movieRepository->getMovieByID($movieID);
$allshowtimes = $movieRepository->getMovieTimeDate($movieID);

?>

<div>
    <table>
        <thead>
            <tr>
                <th> Movies Title</th>
            </tr>
        </thead>
        <tbody>
           
                
               
                <tr class="d-flex">                   
                    <td><img src="<?php echo $alldetails["imagePath"];?>" width="160em" height="250e"/></td>
                    <td> <h3>Titre :</h3> <?php echo $alldetails ["title"]; ?></td>
                    <td> <h3>Synopsis : </h3><?php echo $alldetails ["summary"]; ?></td>
                    <td> <?php echo $alldetails ["age_rating"]; ?></td>
                    <td> <h3>Date de Sortie :</h3><?php echo $alldetails ["startShowDate"]; ?></td>
                    <td> <h3>Prix :</h3><?php echo $alldetails ["price"]; ?> euros</td>
                </tr>
            

        </tbody>
        
    </table>
</div> 
<form action="ChooseHour.php" method="POST">
<input name="id film " type="hidden" value="<?php echo $movieID;?>">

<div>
<label for="date">Date de visionnage : </label>
<select name="date" id="date">
    <?php foreach ($allshowtimes as $allshowtime): ?>
    <option value="<?php echo $allshowtime['showDate_id'];?>"><?php echo $allshowtime['showDate'] ?></option>
     <?php endforeach ?>
</select>


<select name="quantity" id="quantity">
            <option>1</option>
            <option>2</option>
            <option>3</option>
            <option>4</option>
            
          </select>
<input type="submit" value="Envoyer">

</div>

</form>