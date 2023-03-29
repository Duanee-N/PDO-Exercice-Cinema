<?php 
    ob_start();
    $list=$requete->fetchAll();
?>

<div class="recap">
    <p>Il y a <?= $requete->rowCount() ?> acteurs</p>
    <button><a href="index.php?action=formActeurs">Ajouter un acteur/une actrice</a></button>
</div>

    <table border=1 style='border-collapse:collapse;'>
        <thead>
            <tr>
                <th>NOM</th>
                <th>SEXE</th>
                <th>DATE DE NAISSANCE</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($list as $acteur){ ?>
                <tr>
                    <td><a href='index.php?action=detailActeurs&id=<?= $acteur["id_acteur"] ?>'><?= $acteur["prenom"] ?> <?= $acteur["nom"] ?></a></td>
                    <td><?= $acteur["sexe"] ?></td>
                    <td><?= $acteur["date_naissance"] ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

<?php 
    $titre="Liste des acteurs/actrices";
    $titre_secondaire="Liste des acteurs/actrices";
    $contenu=ob_get_clean();
    require "view/template.php";
?>