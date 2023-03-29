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
            
        case "addFilm" :
            $ctrlCinema->addFilms();
            break;


        //ACTEURS    
        case "listActeurs" :
            $ctrlCinema->listActeurs();
            break;

        case "detailActeurs" :
            $ctrlCinema->detailActeurs($id);
            break;    


        //ROLES  
        case "listRoles" :
            $ctrlCinema->listRoles();
            break;
            
        case "detailRoles" :
            $ctrlCinema->detailRoles($id);
            break;       


        //REALISATEURS           
        case "listRealisateurs" :
            $ctrlCinema->listRealisateurs();
            break;

        case "detailRealisateurs" :
            $ctrlCinema->detailRealisateurs($id);
            break;   

        }
    } else{
        $ctrlCinema->listFilms();
    }
        
?>