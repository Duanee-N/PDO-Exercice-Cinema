<?php 
    session_start();
    ob_start();
?>
<form action="index.php?action=addActeur" method="post" class="form" enctype="multipart/form-data">
    <div class="formulaire">
        <div class="box">
            <p>
                <label>
                    Nom :
                    <input type="text" name="nom">
                </label>
            </p>
        </div>
        <div class="box">
            <p>
                <label>
                    Prénom :
                    <input type="text" name="prenom">
                </label>
            </p>
        </div>
        <div class="box">
            <p>
                <label>
                    Sexe :
                    <select name="sexe">
                        <option value="Homme">Homme</option>
                        <option value="Femme">Femme</option>
                    </select>
                </label>
            </p>
        </div>
        <div class="box">
            <p>
                <label>
                    Date de naissance :
                    <input type="date" name="dateNaissance">
                </label>
            </p>
        </div>
    </div>
    <div id="submitBtn">
        <p>
            <input type="submit" name="submitActeur" value="Ajouter un acteur/une actrice">
        </p>
    </div>
</form>

<?php
    $titre="Ajouter un acteur/une actrice";
    $titre_secondaire="Ajouter un acteur/une actrice";
    $contenu=ob_get_clean();
    require "view/template.php";
?>