<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial scale=1.0">
        <script src="https://kit.fontawesome.com/2ce970fdf5.js" crossorigin="anonymous"></script>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
        <link href="public/css/style.css" rel="stylesheet"/>
        <title><?= $titre ?></title>
    </head>
    <body>
        <header>
            <div id="navbar">
                <div id="nav-content">
                    <img src="public/img/nav-icon.png" id="popcorn">
                    <span id="cineclick"><b>CinéClick</b></span>
                </div>
                <nav>
                    <ul id="menu">
                        <li><a href="index.php?action=listFilms">Films</a></li>
                        <li><a href="index.php?action=listActeurs">Acteurs</a></li>
                        <li><a href="index.php?action=listRealisateurs">Réalisateurs</a></li>
                        <li><a href="index.php?action=listRoles">Rôles</a></li>
                        <!-- <li><a href="index.php?action=listGenres">Genres</a></li> -->
                    </ul>
                </nav>
            </div>
        </header>
        <div id="container">
            <main>
                <div id="contenu">
                    <div id="titre">
                        <h1>CINÉMA</h1>
                        <h2><?= $titre_secondaire ?></h2>
                    </div>
                    <?= $contenu ?>
                </div>
            </main>
        </div>
    </body>