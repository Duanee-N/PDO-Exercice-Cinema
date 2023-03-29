<?php 
    ob_start();
?>

<div class="recap">
    <p>Il y a <?= $requete->rowCount() ?> films</p>
    <button><a href="index.php?action=addFilm">Ajouter un film</a></button>
</div>

<table border=1 style='border-collapse:collapse;'>
    <thead>
        <tr>
            <th>TITRE</th>
            <th>ANNEE SORTIE</th>
            <th>REALISATEUR</th>
            <th>DUREE</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($requete->fetchAll() as $film){ ?>
            <tr>
                <td><a href="index.php?action=detailFilms&id=<?= $film["id_film"] ?>"><?= $film["titre_film"] ?></a></td>
                <td><?= $film["annee_sortie_fr"] ?></td>
                <td><a href='index.php?action=detailRealisateurs&id=<?= $film["id_realisateur"] ?>'><?= $film["prenom"] ?> <?= $film["nom"] ?><a></td>
                <td><?= $film["duree"] ?></td></tr>
            </tr>
        <?php } ?>
    </tbody>
</table>

<?php 
    $titre="Liste des films";
    $titre_secondaire="Liste des films";
    $contenu=ob_get_clean();
    require "view/template.php";
?>