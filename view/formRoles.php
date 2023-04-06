<?php 
    session_start();
    ob_start();
?>
<form action="index.php?action=addRole" method="post" class="form" enctype="multipart/form-data">
    <div class="formulaire">
        <h3>Formulaire</h3>
        <div class="box">
            <p>
                <label>
                    Film :
                    <select name="film" class="input">
                        <?php
                        $films = $requeteFilm->fetchAll();
                        foreach($films as $film){
                            ?>
                            <option value="<?= $film["id_film"] ?>"><?= $film["titre_film"] ?></option>
                            <?php } ?>
                        </select>
                    </label>
                </p>
        </div>
        <div class="box">
            <p>
                <label>
                    Nom du rôle :
                    <input type="text" name="role" class="input">
                </label>
            </p>
        </div>
        <div class="box">
            <p>
                <label>
                    Acteur :
                    <select name="acteur" class="input">
                        <?php
                        $acteurs = $requeteActeur->fetchAll();
                        foreach($acteurs as $acteur){
                            ?>
                            <option value="<?= $acteur["id_acteur"] ?>"><?= $acteur["prenom"] ?> <?= $acteur["nom"] ?></option>
                            <?php } ?>
                    </select>
                </label>
            </p>
        </div>
    </div>
    <div>
        <p>
            <input type="submit" name="submitRole" value="Envoyer le formulaire" class="submitBtn">
        </p>
    </div>
</form>

<?php
    $titre="Ajouter un rôle";
    $titre_secondaire="Ajouter un rôle";
    $chiffre=3;
    $space=1;
    $center=0;
    $footer=0;
    $contenu=ob_get_clean();
    require "view/template.php";
?>