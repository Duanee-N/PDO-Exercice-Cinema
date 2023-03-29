<?php 
    session_start();
    ob_start();
?>
<form action="index.php?action=addRole" method="post" class="form" enctype="multipart/form-data">
    <div class="formulaire">
        <div class="box">
            <p>
                <label>
                    Nom du rôle :
                    <input type="text" name="role">
                </label>
            </p>
        </div>
    </div>
    <div id="submitBtn">
        <p>
            <input type="submit" name="submitRole" value="Ajouter un role">
        </p>
    </div>
</form>

<?php
    $titre="Ajouter un rôle";
    $titre_secondaire="Ajouter un rôle";
    $contenu=ob_get_clean();
    require "view/template.php";
?>