<?php
require_once(__DIR__ . '/src/Cart.php');

$title = 'Panier';
require_once 'templates/head.php';
$cart = new Cart;
$cart->addMovie(2, 3);
/*************All $_POST contents are waiting for the movie detail page to be  done . Sene! Remember to rename ++++++++******/
//Waiting for the + button on quantity to be held in movie detail page
if (isset($_POST['addToCart'])) {
    $movieId = $_POST['movieId'];
    $quantity = $_POST['quantity'];
    $cart->addMovie($movieId, $quantity);
}
//Waiting for the - button on quantity to be held in movie detail page
if (isset($_POST['removeFromCart'])) {
    $movieId = $_POST['movieId'];
    $cart->removeMovie($movieId);
}

$cartContent = $cart->displayCart();
var_dump($cartContent);
?>

<h2>Votre Panier</h2>

<table>
    <?php foreach ($cartContent as $movieId => $quantity) : ?>
        <tr>
            <td><?= $movieId ?></td>
            <td><a href="">+<a><?= $quantity ?><a href="">-<a></td>
            <td>
                <form method="post" action="">
                    <input type="hidden" name="movieId" value="<?= $movieId ?>">
                    <button type="submit" name="remove">Supprimer</button>
                </form>
            </td>
        </tr>
    <?php endforeach;
    if (!empty($cartContent)) : ?>
        <tr>
            <td>
                <form method="post" action="">
                    <button type="submit" name="create_booking">Confirmer ma commande</button>
                </form>
            </td>
        </tr>
    <?php endif; ?>
</table>
<?php
require_once 'templates/footer.php';
