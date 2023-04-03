<?php 
    session_start();
    ob_start();
?>

<form action="index.php?action=formFilms" method="post" class="form" enctype="multipart/form-data">
    <div class="formulaire">
        <h3>Formulaire</h3>
        <div class="box">
            <p>
                <label>
                    Titre du film :
                    <input type="text" name="titre" class="input">
                </label>
            </p>
        </div>
        <div class="box">
            <p>
                <label>
                    Réalisateur :
                    <select name="realisateur" class="input">
                    <?php
                            $reals = $requeteReal->fetchAll();
                            foreach($reals as $real){        
                    ?>
                        <option value="<?= $real["id"] ?>"><?=  $real["prenom"] ?> <?= $real["nom"] ?></option>
                    <?php
                        }
                    ?>
                    </select>
                </label>
            </p>
        </div> 
        <div class="box">
            <p>
                <label>
                    Année de sortie :
                    <input type="number" name="anneeSortie" class="input">
                </label>
            </p>
        </div>
        <div class="box">
            <p>
                <label>
                    Durée (en minutes) :
                    <input type="number" min="1" step="1" name="duree" class="input">
                </label>
            </p>
        </div>
        <div class="box">
            <p>
                <label>
                    Genre :
                    <select name="genre" class="input">
                    <?php
                            $genres = $requeteGenre->fetchAll();
                            foreach($genres as $genre){        
                    ?>
                        <option value="<?= $genre["id_genre"] ?>"><?=  $genre["libelle_genre"] ?></option>
                    <?php
                        }
                    ?>
                    </select>
                </label>
            </p>
        </div>
        <div class="box">
            <p>
                <label>
                    Synopsis (non obligatoire) :
                    <textarea name="synopsis" class="input"></textarea>
                </label>
            </p>
        </div>
        <div class="box">
            <p>
                <label>
                    Note (non obligatoire) :
                    <input type="number" min="0" max="5" name="note" class="input">
                </label>
            </p>
        </div>
        <div class="box">
            <p>
                <label class="input img">
                    Affiche (non obligatoire) :
                    <span class="newInput"><input type="file" name="affiche" class="input file">Choisir un fichier</span>
                </label>
            </p>
        </div>
    </div>
    <div>
        <p>
            <input type="submit" name="submitFilm" value="Envoyer le formulaire" class="submitBtn">
        </p>
    </div>
</form>

<?php
    $titre="Ajouter un film";
    $titre_secondaire="Ajouter un film";
    $chiffre=0;
    $space=1;
    $center=0;
    $footer=0;
    $footerSize=1;
    $contenu=ob_get_clean();
    require "view/template.php";
?>