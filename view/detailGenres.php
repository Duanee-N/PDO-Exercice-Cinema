<?php 
    ob_start();
    $genres=$requete->fetchAll();
?>
<div class="details genres">
    <p>Liste des films : <br><ul>
            
    <?php
    foreach($genres as $genre){
    ?>
        <li>- <a href='index.php?action=detailFilms&id=<?= $genre["id_film"] ?>'><p class="red"><?= $genre["titre_film"] ?> (<?= $genre["annee_sortie_fr"] ?>)</p></li>
    <?php } ?>
        </ul></p>
</div>
    
<?php
    $titre="Détails du genre";
    $titre_secondaire="<h2 class=titre-details>Genre : ".$genre["libelle_genre"]."</h2>";
    $chiffre=1;
    $center=1;
    $contenu=ob_get_clean();
    require "view/template.php";
?>