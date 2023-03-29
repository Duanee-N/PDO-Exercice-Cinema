<?php 
    ob_start();
    $list=$requete->fetchAll();
?>

<p>Il y a <?= $requete->rowCount() ?> réalisateurs</p>

    <table border=1 style='border-collapse:collapse;'>
        <thead>
            <tr>
                <th>NOM</th>
                <th>SEXE</th>
                <th>DATE DE NAISSANCE</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($list as $realisateur){ ?>
                <tr>
                    <td><a href='index.php?action=detailRealisateurs&id=<?= $realisateur["id_realisateur"] ?>'><?= $realisateur["prenom"] ?> <?= $realisateur["nom"] ?></a></td>
                    <td><?= $realisateur["sexe"] ?></td>
                    <td><?= $realisateur["date_naissance"] ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

<?php 
    $titre="Liste des réalisateurs";
    $titre_secondaire="Liste des réalisateurs";
    $contenu=ob_get_clean();
    require "view/template.php";
?>