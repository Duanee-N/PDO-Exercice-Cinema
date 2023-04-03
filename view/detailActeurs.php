<?php 
    ob_start();
    // $acteur=$requete->fetchAll();
    // $casting=$requete2->fetchAll();
    // var_dump($casting);die;
    $acteur=$requete->fetchAll();

    if(!empty($acteur[0]["portrait"])){
        $img=1;
    } else{
        $img=0;
    }
?>
<div class="details <?= ($img == 1) ? 'img'  : 'emptyImg' ?> acteurs">
    <img src='<?= $acteur[0]["portrait"] ?>'width=470>
    <div id="detailActeurs">
        <p>Date de naissance : <?= $acteur[0]["date_naissance"] ?></p>
        <p>Sexe : <?= $acteur[0]["sexe"] ?></p>
        <p>Rôles : <ul>
        <?php
            foreach($acteur as $filmographie){
        ?>
            <li>- <a href="index.php?action=detailFilms&id=<?= $filmographie["id_film"] ?>"><p class="red"><?= $filmographie["titre_film"] ?> (<?= $filmographie["annee_sortie_fr"] ?>)</p></a> : <a href='index.php?action=detailRoles&id=<?= $filmographie["id_role"] ?>'><i><?= $filmographie["nom_role"] ?></i></a></li>
            <?php } ?>
            </ul></p>
    </div>
</div>

<?php 
    $titre="Détails de l'acteur/l'actrice";
    $titre_secondaire="<h2 class=titre-details>Acteur/trice : ".$acteur[0]["prenom"]." ".$acteur[0]["nom"]."</h2>";
    $chiffre=2;
    $center=1;
    $space=1;
    $footer=1;
    $contenu=ob_get_clean();
    require "view/template.php";
?>