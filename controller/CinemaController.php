<?php

namespace Controller;
use Model\Connect;

class CinemaController{

    //FILMS
    public function listFilms(){
        $pdo=Connect::seConnecter(); //Connexion
        $requete=$pdo->query("SELECT id_film, titre_film, annee_sortie_fr, TIME_FORMAT(SEC_TO_TIME(duree * 60), '%HH%i') AS duree, f.id_realisateur, prenom, nom
        FROM film f
        INNER JOIN realisateur r ON r.id_realisateur = f.id_realisateur
        INNER JOIN personne p ON p.id_personne = r.id_personne
        ORDER BY annee_sortie_fr DESC"); //Exécution de la requête choisie

        require "view/listFilms.php"; //Require permet de relier la vue qui nous intéresse (située dans le dossier "view")
    }

    public function detailFilms($id){ 
        $pdo=Connect::seConnecter(); 
        $requete1=$pdo->prepare("SELECT id_film, titre_film, annee_sortie_fr, TIME_FORMAT(SEC_TO_TIME(duree * 60), '%HH%i') AS duree, synopsis, note, affiche, r.id_realisateur, prenom, nom
        FROM film f
        INNER JOIN realisateur r ON r.id_realisateur = f.id_realisateur
        INNER JOIN personne p ON p.id_personne = r.id_personne
        -- INNER JOIN posseder_genre pg ON pg.id_film = f.id_film
        WHERE f.id_film = :id"); 
        $requete1->execute(["id"=>$id]);

        $requete2=$pdo->prepare("SELECT prenom, nom, r.id_role, nom_role, a.id_acteur
        FROM casting c
        INNER JOIN film f ON f.id_film = c.id_film
        INNER JOIN acteur a ON a.id_acteur = c.id_acteur
        INNER JOIN personne p ON p.id_personne = a.id_personne
        INNER JOIN role r ON r.id_role = c.id_role
        WHERE f.id_film = :id");
        $requete2->execute(["id"=>$id]);

        require "view/detailFilms.php"; 
    }

    public function addFilms(){ 
        $pdo=Connect::seConnecter();
        if(isset($_POST["submitFilm"])) { //vérification de l'existence de la clé "submitFilm" - = attribut name="submitFilm" - dans le tableau $_POST
            $titre = filter_input(INPUT_POST, "titre", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $anneeSortie = filter_input(INPUT_POST, "anneeSortie", FILTER_VALIDATE_INT);
            $duree = filter_input(INPUT_POST, "duree", FILTER_VALIDATE_INT);
            $synopsis = (empty($_POST["synopsis"])) ? NULL : filter_input(INPUT_POST, "synopsis", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $note = (empty($_POST["note"])) ? NULL : filter_input(INPUT_POST, "note", FILTER_VALIDATE_INT); 
            $realisateur=filter_input(INPUT_POST, "realisateur", FILTER_VALIDATE_INT); // A FILTRER
            //$id=$_POST["id"];
            // $pdo->lastinsertid();

            if(isset($_FILES["affiche"])){
                $tmpName=$_FILES["affiche"]["tmp_name"];
                $nameimg=$_FILES["affiche"]["name"];
                $size=$_FILES["affiche"]["size"];
                $error=$_FILES["affiche"]["error"];
                $type=$_FILES["affiche"]["type"];
    
                $tabExtension=explode(".", $nameimg); //ici, explode découpe une chaîne de caractères à chaque point : permet de vérifier si c'est bien une image qui est upload
                $extension=strtolower(end($tabExtension)); //end va récupérer le dernier élément du tableau
                $validExtension=["jpg", "jpeg", "gif", "png", "jfif"];
    
                if(in_array($extension, $validExtension)&&$error==0){ //si l'extension du fichier fait partie du tableau $validExtension, alors...
                        $uniqueName=uniqid("", true); //définir un nom unique pour éviter l'écrasement d'une autre image en cas de nom identique
                        $fileName=$uniqueName.".".$extension;
                        
                        move_uploaded_file($tmpName, "public/img/".$fileName); //déplacer l'image de $tmpName vers le dossier img
                }else{
                        echo "Erreur fichier ou extension... Veuillez réessayer.";
                }
            }

                $requete=$pdo->prepare("INSERT INTO 'film' ('titre_film', 'annee_sortie_fr', 'duree', 'synopsis', 'note', 'affiche', 'id_realisateur') 
                VALUES (:titre_film, :annee_sortie_fr, :duree, :synopsis, :note, :affiche, :id_realisateur)"); //$_POST['titre_film'] //$titre_film
                if($titre && $anneeSortie && $duree && $synopsis && $note && $fileName && $realisateur){ 
                    $requete->execute(array(
                        "titre_film" => $titre,
                        "annee_sortie_fr" => $anneeSortie,
                        "duree" => $duree,
                        "synopsis" => $synopsis,
                        "note" => $note,
                        "affiche" => $fileName,
                        "id_realisateur" => $realisateur
                    ));
                }
            echo "<p>Le film a bien été ajouté</p>";
            header("Location:index.php?action=addFilm");
        }

        $requeteReal=$pdo->query("SELECT r.id_realisateur as id, prenom, nom
        FROM realisateur r
        INNER JOIN personne p ON p.id_personne = r.id_personne
        GROUP BY r.id_realisateur
        ORDER BY nom");

        require "view/formFilms.php"; 
    }

    //ACTEURS
    public function listActeurs(){
        $pdo=Connect::seConnecter();
        $requete=$pdo->query("SELECT prenom, nom, sexe, date_naissance, a.id_acteur
        FROM acteur a
        INNER JOIN personne p ON a.id_personne = p.id_personne
        GROUP BY a.id_acteur
        ORDER BY nom");

        require "view/listActeurs.php";
    }

    public function detailActeurs($id){ 
        $pdo=Connect::seConnecter(); 
        $requete=$pdo->prepare("SELECT f.id_film, titre_film, annee_sortie_fr, prenom, nom, r.id_role, nom_role, date_naissance, sexe
        FROM casting c
        INNER JOIN film f ON f.id_film = c.id_film
        INNER JOIN acteur a ON a.id_acteur = c.id_acteur
        INNER JOIN personne p ON p.id_personne = a.id_personne
        INNER JOIN role r ON r.id_role = c.id_role
        WHERE a.id_acteur = :id"); 
        $requete->execute(["id"=>$id]);

        require "view/detailActeurs.php"; 
    }

    //ROLES
    public function listRoles(){ 
        $pdo=Connect::seConnecter();
        $requete=$pdo->query("SELECT f.id_film, titre_film, a.id_acteur, prenom, nom, r.id_role, nom_role
        FROM casting c
        INNER JOIN film f ON f.id_film = c.id_film
        INNER JOIN acteur a ON a.id_acteur = c.id_acteur
        INNER JOIN personne p ON p.id_personne = a.id_personne
        INNER JOIN role r ON r.id_role = c.id_role
        ORDER BY titre_film");
    
        require "view/listRoles.php";
    }

    public function detailRoles($id){ 
        $pdo=Connect::seConnecter(); 
        $requete=$pdo->prepare("SELECT f.id_film, f.titre_film, f.annee_sortie_fr, a.id_acteur, prenom, nom, nom_role
        FROM casting c
        INNER JOIN film f ON f.id_film = c.id_film
        INNER JOIN acteur a ON a.id_acteur = c.id_acteur
        INNER JOIN personne p ON p.id_personne = a.id_personne
        INNER JOIN role r ON r.id_role = c.id_role
        WHERE r.id_role = :id"); 
        $requete->execute(["id"=>$id]);

        require "view/detailRoles.php"; 
    }

    //REALISATEURS
    public function listRealisateurs(){ 
        $pdo=Connect::seConnecter();
        $requete=$pdo->query("SELECT r.id_realisateur, prenom, nom, sexe, DATE_FORMAT(date_naissance, '%d-%m-%Y') AS date_naissance
        FROM realisateur r
        INNER JOIN personne p ON p.id_personne = r.id_personne
        GROUP BY r.id_realisateur
        ORDER BY nom");

        require "view/listRealisateurs.php";
    }

    public function detailRealisateurs($id){ 
        $pdo=Connect::seConnecter(); 
        $requete=$pdo->prepare("SELECT prenom, nom, date_naissance, sexe, id_film, titre_film, annee_sortie_fr
        FROM film f
        INNER JOIN realisateur r ON r.id_realisateur = f.id_realisateur
        INNER JOIN personne p ON p.id_personne = r.id_personne
        WHERE r.id_realisateur = :id"); 
        $requete->execute(["id"=>$id]);

        require "view/detailRealisateurs.php"; 
    }
}

?>