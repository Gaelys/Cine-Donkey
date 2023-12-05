<?php
$title = 'Se Connecter';
require_once 'templates/head.php';
require_once 'src\User.php';
if (!empty($_SESSION['idUser'])) {
    ?>
    <div class="mt-5 offset-5"><h3>Vous êtes déjà connectés.</h3></div>
    <?php
} else {
    if (!empty($_POST)) {
        $post = $_POST;
        $user = new User();
        try {
        $initSession = $user->getUser($post['email'], $post['password']);
        if (empty($initSession)) {
            throw new Exception('Compte inexistant');
        }
        $_SESSION['user'] = $initSession['firstname'];
        $_SESSION['idUser'] = $initSession['id'];
        header('Location: index.php');
        die;
        } catch (Exception $e) {
            ?>
            <div class="alert alert-dismissible alert-danger">
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                <strong>Oh zut!</strong>
                <?php
                echo " : " . $e->getMessage();
                ?>
            </div>
            <?php
        }
    }
?>

    <div class="container mt-5 col-sm-4">
        <form method="post">
            <div class="form-group">
                <label class="form-label" for="email">Adresse email : </label>
                <input class="form-control" type="email" id="email" name="email" placeholder="Adresse email"/>
            </div>
            <div class="form-group mt-5">
                <label class="form-label" for="password">Mot de passe : </label>
                <input class="form-control" type="password" id="password" name="password" placeholder="Mot de passe"/>
            </div>
            <div class="offset-3 mt-5">
                <button class="btn btn-warning offset-2" type="submit">Se Connecter</button>
            </div>
        </form>
        <div class="offset-3 mt-4">
            <a class="ml-2 text-warning offset-1" href="signup.php">Je n'ai pas encore de compte</a>
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
