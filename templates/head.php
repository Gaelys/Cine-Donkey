<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href=/../public/css/bootstrap.min.css />
    <link rel="stylesheet" href="/../public/css/style.css" />
    <title><?php echo $title; ?></title>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark">
            <?php session_start();
            ?>
            <div class="container-fluid">
                <div class="collapse navbar-collapse" id="navbarColor01">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <div class="nav-link">Bienvenue</div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo $title === 'Accueil' ? 'active' : '' ?>" href="index.php">Accueil</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav me-auto offset-8">
                        <?php

                        if (empty($_SESSION)) {
                        ?>
                            <li class="nav-item">
                                <a class="nav-link <?php echo $title === 'Se Connecter' ? 'active' : '' ?>" href="login.php">Se connecter</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?php echo $title === 'Inscription' ? 'active' : '' ?>" href="signup.php">S'inscrire</a>
                            </li>
                        <?php
                        } else if (!empty($_SESSION)) {
                        ?>
                            <li class="nav-item">
                                <a class="nav-link <?php echo $title === 'Mon Panier' ? 'active' : '' ?>" href="showCart.php">Mon panier</a>
                            </li>
                            <li class="nav-item dropdown">
                                <button class="nav-link dropdown-toggle" data-bs-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true"><?php echo $_SESSION['user']; ?></button>
                                <div class="dropdown-menu" data-bs-popper="static">
                                    <a class="dropdown-item <?php echo $title === 'Mes Réservations' ? 'active' : '' ?>" href="user_bookings_page.php">Mes Réservations</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item " href="logout.php">Se déconnecter</a>
                                </div>
                            </li>
                        <?php
                        };
                        ?>
                    </ul>
                </div>
            </div>
        </nav>
    </header>