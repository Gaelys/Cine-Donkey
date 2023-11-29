<?php
require_once 'src\User.php';
session_start();
if (isset($_session)) {
?>
    <div> Vous êtes déja connecté</div>
<?php
}
if (!empty($_POST)) {
    $post = $_POST;
    $user = new User();
    $initSession = $user->getUser($post['email'], $post['password']);
    if ($initSession !== true) {
        throw new Exception('Compte inexistant');
    }
    $_SESSION['user'] = $post['email'];
    $_SESSION['idUser'] = $user->getIdUser($_SESSION['user']);
    header('Location: index.php');
    die;
}
?>


<form method="post">
    <div>
        <label for="email">Mon Adresse email : </label>
        <input type="email" id="email" name="email" />
    </div>
    <div>
        <label for="password">Mon Mot de passe : </label>
        <input type="password" id="password" name="password" />
    </div>
    <div>
        <button type="submit">Se Connecter</button>
    </div>
</form>