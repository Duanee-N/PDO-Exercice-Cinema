<?php 
    ob_start();
    $list=$requete->fetchAll()
?>

<div class="recap">
    <p>Il y a <?= $requete->rowCount() ?> genres</p>
    <button><a href="index.php?action=formGenres">Ajouter un genre</a></button>
</div>

<table border=1 style='border-collapse:collapse;'>
    <thead>
        <tr>
            <th>GENRE</th>
            <th>NOMBRE DE FILMS</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($list as $genre){ ?>
            <tr>
                <td><a href='index.php?action=detailGenres&id=<?= $genre["id_genre"] ?>'><?= $genre["libelle_genre"] ?><a></td>
                <td><?= $genre["nbFilmGenre"] ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<?php 
    $titre="Liste des genres";
    $titre_secondaire="Liste des genres";
    $contenu=ob_get_clean();
    require "view/template.php";
?>