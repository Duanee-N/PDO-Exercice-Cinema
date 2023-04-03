<?php 
    session_start();
    ob_start();
?>
<form action="index.php?action=addRealisateur" method="post" class="form" enctype="multipart/form-data">
    <div class="formulaire">
        <h3>Formulaire</h3>
        <div class="box">
            <p>
                <label>
                    Nom :
                    <input type="text" name="nom" class="input">
                </label>
            </p>
        </div>
        <div class="box">
            <p>
                <label>
                    Prénom :
                    <input type="text" name="prenom" class="input">
                </label>
            </p>
        </div>
        <div class="box">
            <p>
                <label>
                    Sexe :
                    <select name="sexe" class="input">
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
                    <input type="date" name="dateNaissance" class="input">
                </label>
            </p>
        </div>
        <div class="box">
            <p>
                <label class="input img">
                    Image (non obligatoire) :
                    <span class="newInput"><input type="file" name="affiche" class="input file">Choisir un fichier</span>
                </label>
            </p>
        </div>
    </div>
    <div>
        <p>
            <input type="submit" name="submitRealisateur" value="Envoyer le formulaire" class="submitBtn">
        </p>
    </div>
</form>

<?php
    $titre="Ajouter un réalisateur/une réalisatrice";
    $titre_secondaire="Ajouter un réalisateur/une réalisatrice";
    $chiffre=4;
    $space=1;
    $contenu=ob_get_clean();
    require "view/template.php";
?>