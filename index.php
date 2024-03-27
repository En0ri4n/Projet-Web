<?php

include_once($_SERVER['DOCUMENT_ROOT'] . '/controller/Controller.php');

$controller = new Controller();

if(empty($_SERVER['QUERY_STRING']))
{
    $controller->homeController();
}
else if(isset($_GET['view']))
{
    switch($_GET['view'])
    {
        case 'connexion':
            $controller->connexionController();
            break;
        case 'forbidden':
            $controller->forbiddenController();
            break;
        case 'about':
            $controller->aboutController();
            break;
        case 'contact':
            $controller->contactController();
            break;
        case 'offres':
            $controller->offresController();
            break;
        case 'mentions':
            $controller->mentionsController();
            break;
        case 'profile':
            $controller->profileController();
            break;
        case 'accueil':
            $controller->homeController();
            break;
        case 'admin_page':
            $controller->admin_pageController();
            break;
        default:
            $controller->notFoundController();
            break;
    }
}
else
{
    $controller->notFoundController();
}