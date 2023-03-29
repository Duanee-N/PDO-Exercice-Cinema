<?php 
    session_start();
    ob_start();
?>
<form action="index.php?action=addRealisateur" method="post" class="form" enctype="multipart/form-data">
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
            <input type="submit" name="submitRealisateur" value="Ajouter un réalisateur/une réalisatrice">
        </p>
    </div>
</form>

<?php
    $titre="Ajouter un réalisateur/une réalisatrice";
    $titre_secondaire="Ajouter un réalisateur/une réalisatrice";
    $contenu=ob_get_clean();
    require "view/template.php";
?>