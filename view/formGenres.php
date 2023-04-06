<?php 
    session_start();
    ob_start();
?>
<form action="index.php?action=formGenres" method="post" class="form" enctype="multipart/form-data">
    <div class="formulaire">
        <h3>Formulaire</h3>
        <div class="box">
            <p>
                <label>
                    Nom du genre :
                    <input type="text" name="genre" class="input">
                </label>
            </p>
        </div>
    </div>
    <div>
        <p>
            <input type="submit" name="submitGenre" value="Envoyer le formulaire" class="submitBtn">
        </p>
    </div>
</form>

<?php
    $titre="Ajouter un genre";
    $titre_secondaire="Ajouter un genre";
    $chiffre=1;
    $center=1;
    $space=1;
    $footer=0;
    $contenu=ob_get_clean();
    require "view/template.php";
?>