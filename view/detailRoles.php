<?php 
    ob_start();
    $film=$requete->fetchAll();
?>

<div class="details roles">
    <p>Film : <a href="index.php?action=detailFilms&id=<?= $film[0]["id_film"] ?>"> <?= $film[0]["titre_film"] ?> (<?= $film[0]["annee_sortie_fr"] ?>)</a></p>
    <p>Interprété par : </p>
    <ul>
    <?php
        foreach($film as $role){
    ?>
        <li>- <a href='index.php?action=detailActeurs&id=<?= $role["id_acteur"] ?>'><p class="red"><?= $role["prenom"] ?> <?=$role["nom"]?></p></a></li>
    <?php } ?>
        </ul></p>
</div>
    
<?php
    $titre="Détails du rôle";
    $titre_secondaire="<h2 class=titre-details>Rôle : ".$role["nom_role"]."</h2>";
    $chiffre=3;
    $center=1;
    $footer=1;
    $contenu=ob_get_clean();
    require "view/template.php";
?>