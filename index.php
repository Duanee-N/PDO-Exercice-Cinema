<?php
//L'index.php va servir à accueillir l'action transmise par l'URL en GET
//On aura toujours une URL de la forme : "index.php?action=listFilms" ou "index.php?action=listActeurs", etc

use Controller\CinemaController; //On peut utiliser use la classe sans connaître son emplacement physique. On a juste besoin de savoir dans quel namespace elle se trouve - ici, Controller !

spl_autoload_register(function($class_name){ //Autochargement des classes du projet
    include $class_name.".php";
});

$ctrlCinema=new CinemaController();

$id=(isset($_GET["id"])) ? $_GET["id"] : null;

if(isset($_GET["action"])){ //En fonction de l'action détectée dans l'URL via la propriété "action", on interagit avec la bonne méthode du controller 
    switch($_GET["action"]){

        //FILMS
        case "listFilms" :
            $ctrlCinema->listFilms();
            break;
        
        case "detailFilms" :
            $ctrlCinema->detailFilms($id);
            break;

        case "detailLike" :
            $ctrlCinema->detailLike($id);
            break;

        case "detailDislike" :
            $ctrlCinema->detailDislike($id);
            break;
            
        case "formFilms" :
            $ctrlCinema->addFilm();
            break;

        case "addFilm" :
            $ctrlCinema->addFilm();
            break;


        //GENRE
        case "listGenres" :
            $ctrlCinema->listGenres();
            break;
        
        case "detailGenres" :
            $ctrlCinema->detailGenres($id);
            break;

        case "formGenres" :
            $ctrlCinema->addGenre();
            break;
            
        case "addGenre" :
            $ctrlCinema->addGenre();
            break;


        //ACTEURS    
        case "listActeurs" :
            $ctrlCinema->listActeurs();
            break;

        case "detailActeurs" :
            $ctrlCinema->detailActeurs($id);
            break;    

        case "formActeurs" :
            $ctrlCinema->addActeur();
            break;

        case "addActeur" :
            $ctrlCinema->addActeur();
            break;


        //ROLES  
        case "listRoles" :
            $ctrlCinema->listRoles();
            break;
            
        case "detailRoles" :
            $ctrlCinema->detailRoles($id);
            break;       

        case "formRoles" :
            $ctrlCinema->addRole();
            break;
        
        case "addRole" :
            $ctrlCinema->addRole();
            break;


        //REALISATEURS           
        case "listRealisateurs" :
            $ctrlCinema->listRealisateurs();
            break;

        case "detailRealisateurs" :
            $ctrlCinema->detailRealisateurs($id);
            break;   

        case "formRealisateurs" :
            $ctrlCinema->addRealisateur();
            break;

        case "addRealisateur" :
            $ctrlCinema->addRealisateur();
            break;

        }
    } else{
        $ctrlCinema->listFilms();
    }
        
?>