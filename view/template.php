<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial scale=1.0">
        <script src="https://kit.fontawesome.com/2ce970fdf5.js" crossorigin="anonymous"></script>
        <script src="public/js/script.js"></script>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400&display=swap" rel="stylesheet">
        <link href="public/css/style.css" rel="stylesheet"/>
        <link href="public/css/styleMobile.css" rel="stylesheet"/>
        <title><?= $titre ?></title>
    </head>
    <body>
        <header>
            <div id="navbar">
                <div id="nav-content">
                    <img src="public/img/nav-icon.png" id="popcorn">
                    <span id="cineclick"><b>CinéClick</b></span>
                </div>
                <ul id="socials">
                        <li><a href="#"><i class="fa-brands fa-facebook-f"></i></a></li>
                        <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
                        <li><a href="#"><i class="fa-brands fa-twitter"></i></a></li>
                </ul>
            </div>
        </header>
        <main class="<?= ($center == 1) ? 'center'  : ''?>">
            <nav>
                <ul id="menu">
                    <li><a href="index.php?action=listFilms" class="lien <?= ($chiffre == 0) ? 'clicked'  : 'menu'?>" id="films">Films</a></li>
                    <li><a href="index.php?action=listGenres" class="lien <?= ($chiffre == 1) ? 'clicked'  : 'menu'?>" id="genres">Genres</a></li>
                    <li><a href="index.php?action=listActeurs" class="lien <?= ($chiffre == 2) ? 'clicked'  : 'menu'?>" id="acteurs">Acteurs</a></li>
                    <li><a href="index.php?action=listRoles" class="lien <?= ($chiffre == 3) ? 'clicked'  : 'menu'?>" id="roles">Rôles</a></li>
                    <li><a href="index.php?action=listRealisateurs" class="lien <?= ($chiffre == 4) ? 'clicked'  : 'menu'?>" id="realisateur">Réalisateurs</a></li>
                </ul>
            </nav>
            <div id="titre">
                <h1>CINÉMA</h1>
                <h2><?= $titre_secondaire ?></h2>
            </div>
            <div class="contenu <?= ($chiffre == 3) ? 'role'  : ''?> <?= ($chiffre == 1) ? 'genre'  : ''?> <?= ($space == 1) ? 'space'  : ''?>">
                <?= $contenu ?>
            </div>
        </main>
        <footer class="<?= ($footer == 1) ? 'footer'  : ''?> <?= ($footerSize == 1) ? 'footerSize'  : ''?>">
            <div class="footer-column">
                <ul>
                    <h3>Aide</h3>
                    <li><a href="#">Contactez-nous</a></li>
                    <li><a href="#">contact@cineclick.fr</a></li>
                </ul>
            </div>
            <div class="footer-column">
                <ul>
                    <h3>Informations</h3>
                    <li><a href="#">Qui sommes-nous ?</a></li>
                    <li><a href="#">En savoir plus</a></li>
                </ul>
            </div>
        </footer>
        <a href="#navbar"><i class="fa-solid fa-arrow-up"></i></a>
    </body>
</html>