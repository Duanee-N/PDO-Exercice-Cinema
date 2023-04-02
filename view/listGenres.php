<?php 
    ob_start();
    $list=$requete->fetchAll()
?>

<div class="recap">
    <p><?= $requete->rowCount() ?> genres</p>
    <button class="addBtn"><a href="index.php?action=addGenre">Ajouter un genre</a></button>
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
                <td name="Genre"><a href='index.php?action=detailGenres&id=<?= $genre["id_genre"] ?>'><?= $genre["libelle_genre"] ?><a></td>
                <td name="Nombre de films"><?= $genre["nbFilmGenre"] ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<?php 
    $titre="Liste des genres";
    $titre_secondaire="Liste des genres";
    $chiffre=1;
    $contenu=ob_get_clean();
    require "view/template.php";
?>