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

    <div class="container col-sm-4">
        <form method="post">
            <div  class="form-group">
                <label class="form-label" for="lastname">Nom : </label>
                <input class="form-control" type="text" id="lastname" name="lastname" placeholder="Nom"/>
            </div>
            <div  class="form-group mt-3">
                <label class="form-label" for="firstname">Prénom : </label>
                <input class="form-control" type="text" id="firstname" name="firstname" placeholder="Prénom"/>
            </div>
            
            <div  class="form-group  mt-3">
                <label class="form-label" for="phoneNumber">Téléphone : </label>
                <input class="form-control" type="tel" id="phoneNumber" name="phoneNumber" placeholder="n° de téléphone"/>
            </div>
            <div  class="form-group  mt-3">
                <label class="form-label" for="email">Adresse email : </label>
                <input class="form-control" type="email" id="email" name="email" placeholder="Adresse email" />
            </div>
            <div  class="form-group  mt-3">
                <label class="form-label" for="password">Mot de passe : </label>
                <input class="form-control" type="password" id="password" name="password" placeholder="Mot de passe"/>
            </div>
            <div  class="form-group  mt-3">
                <label class="form-label" for="verifyPassword">Confirmer mon mot de passe : </label>
                <input class="form-control" type="password" id="verifyPassword" name="verifyPassword" placeholder="Mot de passe"/>
            </div>
            <div class="mt-2 offset-4">
                <button class="mt-4 btn btn-secondary offset-1"type="submit">Inscription</button>
            </div>
        </form>
        <div class="container offset-4 mt-4">
            <a class="ml-2 text-secondary" href="login.php">J'ai déjà un compte</a>
        </div>
    </div>

<?php 
}
require_once 'templates/footer.php';