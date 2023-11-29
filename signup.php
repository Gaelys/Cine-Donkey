<?php 
require_once 'src\User.php';

if (!empty($_POST)) {
    $post = $_POST;
    $user = new User();
    $user->initialiseUser($post['firstname'], $post['lastname'], $post['email'], $post['password'],$post['verifyPassword'], $post['phoneNumber']);
    $user->insertUser();
    session_start();
    $_SESSION['user'] = $user->getEmail();
    $_SESSION['idUser'] = $user->getIdUser($_SESSION['user']);
    header ('Location: index.php');
    die;
}

?>


<form method="post">
    <div>
        <label for="firstname">Mon Prénom : </label>
        <input type="text" id="firstname" name="firstname"/>
    </div>
    <div>
        <label for="lastname">Mon Nom de famille</label>
        <input type="text" id="lastname" name="lastname"/>
    </div>
    <div>
        <label for="phoneNumber">Mon Téléphone : </label>
        <input type="tel" id="phoneNumber" name="phoneNumber"/>
    </div>
    <div>
        <label for="email">Mon Adresse email : </label>
        <input type="email" id="email" name="email" />
    </div>
    <div>
        <label for="password">Mon Mot de passe : </label>
        <input type="password" id="password" name="password"/>
    </div>
    <div>
        <label for="verifyPassword">Confirmer votre mot de passe : </label>
        <input type="password" id="verifyPassword" name="verifyPassword"/>
    </div>
    <div>
        <button type="submit">Inscription</button>
    </div>
</form>