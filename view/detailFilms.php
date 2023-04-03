<?php 
    ob_start();
    $film=$requete1->fetch();

    if(!empty($film["affiche"])){
        $img=1;
    } else{
        $img=0;
        $center=1;
    }
?>

<div class="details <?= ($img == 1) ? 'img'  : 'emptyImg' ?>">
    <img src='<?= $film["affiche"] ?>'width=470>
    <div id="detailFilms">
        <p>Réalisateur : <a href='index.php?action=detailRealisateurs&id=<?= $film["id_realisateur"] ?>'><?= $film["prenom"] ?> <?= $film["nom"] ?></a></p>
        <p>Durée : <?= $film["duree"] ?></p>
        <p>Année de sortie : <?= $film["annee_sortie_fr"] ?></p>
        <p>Note :

        <?php 
            if($film["note"]!=0){
                for($i=0;$i<$film["note"];$i++){
                    echo "<i class='fa-solid fa-star fullStars'></i>";
                }
                for($i=0;$i<5-$film["note"];$i++){
                    echo "<i class='fa-regular fa-star emptyStars'></i>";
                }
            }else{
                echo "Indisponible";
            }
        ?>
        </p>

        <p>Synopsis : <?= $film["synopsis"] ?></p>
        <p>Casting : <br><ul>
            
        <?php
        foreach($requete2->fetchAll() as $casting){
        ?>
            <li>- <a href='index.php?action=detailActeurs&id=<?= $casting["id_acteur"] ?>'><p class="red"><?= $casting["prenom"] ?> <?=$casting["nom"]?></p></a> : <a href='index.php?action=detailRoles&id=<?= $casting["id_role"] ?>' class='lien'><i><?= $casting["nom_role"] ?></i></a></li>
        <?php } ?>
            </ul></p>
    </div>
</div>
    
<?php
    $titre="Détails du film";
    $titre_secondaire="<h2 class=titre-details>Film : ".$film["titre_film"]."</h2>";
    $chiffre=0;
    $space=1;
    $contenu=ob_get_clean();
    require "view/template.php";
?>