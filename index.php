<?php

include_once($_SERVER['DOCUMENT_ROOT'] . '/controller/Controller.php');

$controller = new Controller();

if(empty($_SERVER['QUERY_STRING']))
{
    $controller->homeController();
}
elseif(isset($_GET['view']))
{
    switch($_GET['view'])
    {
        case 'about':
            $controller->aboutController();
            break;
        case 'accueil':
            $controller->homeController();
            break;
        case 'admin-page':
            $controller->adminPageController();
            break;
        case 'connexion':
            $controller->connexionController();
            break;
        case 'contact':
            $controller->contactController();
            break;
        case 'description-entreprise':
            $controller->descriptionEntrepriseController();
            break;
        case 'description-offre':
            $controller->descriptionOffreController();
            break;
        case 'entreprise':
            $controller->entrepriseController();
            break;
        case 'forbidden':
            $controller->forbiddenController();
            break;
        case 'inscription':
            $controller->inscriptionController();
            break;
        case 'mentions':
            $controller->mentionsController();
            break;
        case 'offres': 
            $controller->offresController();
            break;
        case 'poster-offre':
            $controller->posterOffreController();
            break;
        case 'profil':
            $controller->profileController();
            break;
        case 'entreprises':
            $controller->entreprisesController();
            break;
        case 'utilisateurs':
            $controller->utilisateursController();
            break;
        case 'candidature':
            $controller->candidatureController();
            break;
        default:
            $controller->notFoundController();
            break;
    }
}
else
{
    $controller->homeController();
}