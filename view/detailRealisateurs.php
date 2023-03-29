<?php 
    ob_start();
    $realisateur=$requete->fetchAll();
?>
<div id="detailRealisateurs">
        <p>Date de naissance : <?= $realisateur[0]["date_naissance"] ?></p>
        <p>Sexe : <?= $realisateur[0]["sexe"] ?></p>
        <p>Films réalisés : <br><ul>
<?php
foreach($realisateur as $filmographie){
?>
    <li>- <a href="index.php?action=detailFilms&id=<?= $filmographie["id_film"] ?>"><p class="red"><?= $filmographie["titre_film"] ?> (<?= $filmographie["annee_sortie_fr"] ?>)</p></a></li>
<?php } ?>
    </ul></p>
    </div>

<?php 
    $titre="Détails du réalisateur/de la réalisatrice";
    $titre_secondaire="<h2 class=titre-details>Réalisateur/Réalisatrice : ".$realisateur[0]["prenom"]." ".$realisateur[0]["nom"]."</h2>";
    $contenu=ob_get_clean();
    require "view/template.php";
?>