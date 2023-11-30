<?php 
$title = 'Inscription';
require_once 'templates/head.php';
require_once 'src\User.php';

if (!empty($_SESSION['idUser'])) {
    ?>
    <div> Vous êtes déjà connectés</div>
    <?php
} else {
    if (!empty($_POST)) {
        $post = $_POST;
        try {
            $user = new User();
            $user->initialiseUser($post['firstname'], $post['lastname'], $post['email'], $post['password'],$post['verifyPassword'], $post['phoneNumber']);
            $user->insertUser();
            $info = $user->getUser($post['email'], $post['password']);
            $_SESSION['user'] = $info['firstname'];
            $_SESSION['idUser'] = $info['id'];
            header ('Location: index.php');
            die;
        } catch (Exception $e) {
            echo "Erreur : " . $e->getMessage();
        }
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

<?php 
}
require_once 'templates/footer.php';