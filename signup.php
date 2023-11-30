<?php 
$title = 'Inscription';
require_once 'templates/head.php';
require_once 'src\User.php';

if (!empty($_SESSION['idUser'])) {
    ?>
    <div class="mt-5 offset-4">
            <h3 class="offset-1">Vous possedez déjà un compte.</h3>
    </div>
    <?php
} else {
    if (!empty($_POST)) {
        $post = $_POST;
        try {
            $user = new User();
            $user->initialiseUser($post['firstname'], $post['lastname'], $post['email'], $post['password'],$post['verifyPassword'], $post['phoneNumber']);
        } catch (Exception $e) {
        $errors[] = $e->getMessage();
        }
        $errors = $user->getErrors();
        if (!empty($errors)) {
            foreach ($errors as $error) {
                ?>
                <div class="alert alert-dismissible alert-danger">
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    <strong>Oh zut!</strong>
                    <?php
                    echo ": " . $error;
                    ?>
                </div>
                <?php
            }
        } else {
            $user->insertUser();
            $info = $user->getUser($post['email'], $post['password']);
            $_SESSION['user'] = $info['firstname'];
            $_SESSION['idUser'] = $info['id'];
            header ('Location: index.php');
            die;
        }
    }

    ?>

    <div class="container mt-5 col-sm-4">
        <form method="post">
            <div  class="form-group">
                <label class="form-label" for="firstname">Mon Prénom : </label>
                <input class="form-control" type="text" id="firstname" name="firstname"/>
            </div>
            <div  class="form-group  mt-4">
                <label class="form-label" for="lastname">Mon Nom de famille</label>
                <input class="form-control" type="text" id="lastname" name="lastname"/>
            </div>
            <div  class="form-group  mt-4">
                <label class="form-label" for="phoneNumber">Mon Téléphone : </label>
                <input class="form-control" type="tel" id="phoneNumber" name="phoneNumber"/>
            </div>
            <div  class="form-group  mt-4">
                <label class="form-label" for="email">Mon Adresse email : </label>
                <input class="form-control" type="email" id="email" name="email" />
            </div>
            <div  class="form-group  mt-4">
                <label class="form-label" for="password">Mon Mot de passe : </label>
                <input class="form-control" type="password" id="password" name="password"/>
            </div>
            <div  class="form-group  mt-4">
                <label class="form-label" for="verifyPassword">Confirmer votre mot de passe : </label>
                <input class="form-control" type="password" id="verifyPassword" name="verifyPassword"/>
            </div>
            <div class="mt-4 offset-4">
                <button class="mt-4 btn btn-secondary offset-1"type="submit">Inscription</button>
            </div>
        </form>
    </div>
<?php 
}
require_once 'templates/footer.php';