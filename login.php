<?php
$title = 'Se Connecter';
require_once 'templates/head.php';
require_once 'src\User.php';
if (!empty($_SESSION['idUser'])) {
?>
    <div> Vous êtes déjà connecté</div>
<?php
} else {
    if (!empty($_POST)) {
        $post = $_POST;
        $user = new User();
        $initSession = $user->getUser($post['email'], $post['password']);
        if (empty($initSession)) {
            throw new Exception('Compte inexistant');
        }
        $_SESSION['user'] = $initSession['firstname'];
        $_SESSION['idUser'] = $initSession['id'];
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

<?php
}
require_once 'templates/footer.php';
