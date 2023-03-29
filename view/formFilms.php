<?php 
    session_start();
    ob_start();
    ?>
<form action="index.php?action=formFilms" method="post" id="form" enctype="multipart/form-data">
    <div class="formulaire">
        <div class="box">
            <p>
                <label>
                    Titre du film :
                    <input type="text" name="titre">
                </label>
            </p>
        </div>
        <div class="box">
            <p>
                <label>
                    Réalisateur :
                    <select name="realisateur">
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
                    <input type="number" name="anneeSortie">
                </label>
            </p>
        </div>
        <div class="box">
            <p>
                <label>
                    Durée (en minutes) :
                    <input type="number" min="1" step="1" name="duree">
                </label>
            </p>
        </div>
        <!-- <div class="box">
            <p>
                <label>
                    Genre :
                    <input type="#" name="genre">
                </label>
            </p>
        </div> -->
        <div class="box">
            <p>
                <label>
                    Synopsis (non obligatoire) :
                    <textarea name="synopsis"></textarea>
                </label>
            </p>
        </div>
        <div class="box">
            <p>
                <label>
                    Note (non obligatoire) :
                    <input type="number" min="0" max="5" name="note">
                </label>
            </p>
        </div>
        <div class="box">
            <p>
                <label>
                    Affiche (non obligatoire) :
                    <input type="file" name="affiche">
                </label>
            </p>
        </div>
    </div>
    <div id="submitBtn">
        <p>
            <input type="submit" name="submitFilm" value="Ajouter un film">
        </p>
    </div>
</form>

<?php
    $titre="Ajouter un film";
    $titre_secondaire="Ajouter un film";
    $contenu=ob_get_clean();
    require "view/template.php";
?>