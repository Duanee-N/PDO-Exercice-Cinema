<?php 
    session_start();
    ob_start();
?>
<form action="index.php?action=formGenres" method="post" class="form" enctype="multipart/form-data">
    <div class="formulaire">
        <div class="box">
            <p>
                <label>
                    Nom du genre :
                    <input type="text" name="genre">
                </label>
            </p>
        </div>
    </div>
    <div id="submitBtn">
        <p>
            <input type="submit" name="submitGenre" value="Ajouter un genre">
        </p>
    </div>
</form>

<?php
    $titre="Ajouter un genre";
    $titre_secondaire="Ajouter un genre";
    $contenu=ob_get_clean();
    require "view/template.php";
?>