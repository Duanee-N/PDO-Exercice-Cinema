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

    public function affiche(){
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
                    $affiche=$uniqueName.".".$extension;
                    
                    move_uploaded_file($tmpName, "public/img/".$affiche); //déplacer l'image de $tmpName vers le dossier img
            }else{
                    echo "Erreur fichier ou extension... Veuillez réessayer.";
            }
        }else{

        }
    }

    public function addFilm(){ 
        $pdo=Connect::seConnecter();
        if(isset($_POST["submitFilm"])) { //vérification de l'existence de la clé "submitFilm" - = attribut name="submitFilm" - dans le tableau $_POST
            $titre = filter_input(INPUT_POST, "titre", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $anneeSortie = filter_input(INPUT_POST, "anneeSortie", FILTER_VALIDATE_INT);
            $duree = filter_input(INPUT_POST, "duree", FILTER_VALIDATE_INT);
            $synopsis = (empty($_POST["synopsis"])) ? NULL : filter_input(INPUT_POST, "synopsis", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $note = (empty($_POST["note"])) ? NULL : filter_input(INPUT_POST, "note", FILTER_VALIDATE_INT); 
            $affiche = (empty($_POST["affiche"])) ? NULL : $this->affiche(); 
            $realisateur=filter_input(INPUT_POST, "realisateur", FILTER_VALIDATE_INT); 

            $requete=$pdo->prepare("INSERT INTO film (titre_film, annee_sortie_fr, duree, synopsis, note, affiche, id_realisateur) 
            VALUES (:titre_film, :annee_sortie_fr, :duree, :synopsis, :note, :affiche, :id_realisateur)"); //$_POST['titre_film'] //$titre_film
            if($titre && $anneeSortie && $duree && $realisateur){ 
                $requete->execute(array(
                    "titre_film" => $titre,
                    "annee_sortie_fr" => $anneeSortie,
                    "duree" => $duree,
                    "synopsis" => $synopsis,
                    "note" => $note,
                    "affiche" => $affiche,
                    "id_realisateur" => $realisateur
                ));
                echo "<p>Le film a bien été ajouté</p>";
            } else{
                echo "<p>Erreur... Veuillez réessayer.</p>";
            }
            // header("Location:index.php?action=addFilm");
            // die;
        }

        $requeteReal=$pdo->query("SELECT r.id_realisateur as id, prenom, nom
        FROM realisateur r
        INNER JOIN personne p ON p.id_personne = r.id_personne
        GROUP BY r.id_realisateur
        ORDER BY nom");

        require "view/formFilms.php"; 
    }


    //GENRES
    public function listGenres(){
        $pdo=Connect::seConnecter();
        $requete=$pdo->query("SELECT g.id_genre, g.libelle_genre , COUNT(p.id_genre) AS nbFilmGenre
        FROM posseder_genre p
        INNER JOIN genre g ON g.id_genre = p.id_genre
        GROUP BY g.id_genre
        ORDER BY nbFilmGenre DESC"); //Exécution de la requête choisie

        require "view/listGenres.php";
    }

    public function detailGenres($id){ 
        $pdo=Connect::seConnecter(); 
        $requete=$pdo->prepare("SELECT f.id_film, titre_film, annee_sortie_fr, g.id_genre, libelle_genre
        FROM posseder_genre p
        INNER JOIN genre g ON g.id_genre = p.id_genre
        INNER JOIN film f ON f.id_film = p.id_film
        WHERE g.id_genre = :id"); 
        $requete->execute(["id"=>$id]);
        require "view/detailGenres.php";
    }

    public function addGenre(){ 
        $pdo=Connect::seConnecter();
        if(isset($_POST["submitGenre"])){ 
            $genre = filter_input(INPUT_POST, "genre", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            
            $requete=$pdo->prepare("INSERT INTO genre (libelle_genre) 
            VALUE (:libelle_genre)");
    
            if($genre){
                $requete->execute([
                    "libelle_genre" => $genre
                ]);
            } else{
                echo "<p>Erreur... Veuillez réessayer.</p>";
            }
            echo "<p>Le genre a bien été ajouté</p>";
        }
        require "view/formGenres.php"; 
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

    public function addActeur(){ 
        $pdo=Connect::seConnecter();
        if(isset($_POST["submitActeur"])){ 
            $nom = filter_input(INPUT_POST, "nom", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $nom_maj=mb_strtoupper($nom);
            $prenom = filter_input(INPUT_POST, "prenom", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $sexe = filter_input(INPUT_POST, "sexe", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $dateNaissance = filter_input(INPUT_POST, "dateNaissance", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $requete=$pdo->prepare("INSERT INTO personne (nom, prenom, sexe, date_naissance) 
            VALUES (:nom, :prenom, :sexe, :date_naissance)");
    
            if($nom && $prenom && $sexe && $dateNaissance){
                $requete->execute([
                    "nom" => $nom_maj,
                    "prenom" => $prenom,
                    "sexe" => $sexe,
                    "date_naissance" => $dateNaissance
                ]);
                
                $id=$pdo->lastInsertId(); //permet de récupérer l'id de la dernière ligne insérée

                $requete2=$pdo->prepare("INSERT INTO acteur (id_personne)
                VALUE (:id_personne)");
                $requete2->execute([
                    "id_personne" => $id
                ]);
                echo "<p>L'acteur/actrice a bien été ajouté(e)</p>";
            } else{
                echo "<p>Erreur... Veuillez réessayer.</p>";
            }
        }
        require "view/formActeurs.php"; 
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

    public function addRole(){ 
        $pdo=Connect::seConnecter();
        if(isset($_POST["submitRole"])){ 
            $film = filter_input(INPUT_POST, "film", FILTER_VALIDATE_INT);
            $role = filter_input(INPUT_POST, "role", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $acteur = filter_input(INPUT_POST, "acteur", FILTER_VALIDATE_INT);

            $requete=$pdo->prepare("INSERT INTO role (nom_role) 
            VALUE (:nom_role)");
    
            if($role){
                $requete->execute([
                    "nom_role" => $role
                ]);

                $id=$pdo->lastInsertId(); //permet de récupérer l'id de la dernière ligne insérée

                $requete2=$pdo->prepare("INSERT INTO casting (id_film, id_acteur, id_role)
                VALUES (:id_film, :id_acteur, :id_role)");
                $requete2->execute([
                    "id_film" => $film, 
                    "id_acteur" => $acteur,
                    "id_role" => $id
                ]);

                echo "<p>Le rôle a bien été ajouté</p>";
            } else{
                echo "<p>Erreur... Veuillez réessayer.</p>";
            }
        }
        $requeteFilm=$pdo->query("SELECT f.id_film, titre_film
        FROM film f
        GROUP BY f.id_film
        ORDER BY titre_film");

        $requeteActeur=$pdo->query("SELECT a.id_acteur, prenom, nom
        FROM acteur a
        INNER JOIN personne p ON p.id_personne = a.id_personne
        GROUP BY a.id_acteur
        ORDER BY nom");

        require "view/formRoles.php"; 
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

    public function addRealisateur(){ 
        $pdo=Connect::seConnecter();
        if(isset($_POST["submitRealisateur"])){ 
            $nom = filter_input(INPUT_POST, "nom", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $nom_maj=mb_strtoupper($nom);
            $prenom = filter_input(INPUT_POST, "prenom", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $sexe = filter_input(INPUT_POST, "sexe", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $dateNaissance = filter_input(INPUT_POST, "dateNaissance", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $requete=$pdo->prepare("INSERT INTO personne (nom, prenom, sexe, date_naissance) 
            VALUES (:nom, :prenom, :sexe, :date_naissance)");
    
            if($nom && $prenom && $sexe && $dateNaissance){
                $requete->execute([
                    "nom" => $nom_maj,
                    "prenom" => $prenom,
                    "sexe" => $sexe,
                    "date_naissance" => $dateNaissance
                ]);
                
                $id=$pdo->lastInsertId(); //permet de récupérer l'id de la dernière ligne insérée

                $requete2=$pdo->prepare("INSERT INTO realisateur (id_personne)
                VALUE (:id_personne)");
                $requete2->execute([
                    "id_personne" => $id
                ]);
                echo "<p>Le réalisateur/la réalisatrice a bien été ajouté(e)</p>";
            } else{
                echo "<p>Erreur... Veuillez réessayer.</p>";
            }
        }
        require "view/formRealisateurs.php"; 
    }
}

?>