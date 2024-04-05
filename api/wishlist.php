<?php

use model\object\Candidature;
use model\object\Wishlist;
use model\table\CandidatureTable;
use model\table\WishlistTable;

require_once($_SERVER['DOCUMENT_ROOT'] . '/model/table/UtilisateurTable.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/model/table/EtudiantTable.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/model/table/WishlistTable.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/api/requests.php');

checkUserConnection();

// Handle HTTP methods
$method = $_SERVER['REQUEST_METHOD'];

header('Content-Type: application/json');

switch($method) {
    case 'GET':
        checkIfGetColumn(new WishlistTable());

        $parameters = [];

        addIfSetSpecial($parameters, $_GET, 'IdOffre', eq(WishlistTable::$ID_OFFRE_COLUMN));
        addIfSetSpecial($parameters, $_GET, 'IdEtudiant', eq(WishlistTable::$ID_UTILISATEUR_COLUMN));

        try
        {
            $wishlist_table = new WishlistTable();

            $total_wishlist = $wishlist_table->selectSpecialConditionsAndParameters($parameters, "", fn($a) => Wishlist::fromArray($a));

            $wishlist = $wishlist_table->selectSpecialConditionsAndParameters($parameters, "LIMIT " . getPerPage() . " OFFSET " . (getPerPage() * (getPage() - 1)), fn($a) => Wishlist::fromArray($a));

            $json = setupPages(count(is_array($total_wishlist) ? $total_wishlist : ($total_wishlist === null ? [] : [$total_wishlist])));
            $json['wishlist'] = $wishlist === null ? [] : (is_array($wishlist) ? $wishlist : [$wishlist]);

            if($wishlist === null)
            {
                echo json_encode($json);
                exit;
            }
            echo json_encode($json);
        }
        catch(Exception $e)
        {
            http_response_code(500);
            echo json_encode(['statut' => 'error', 'error' => 'Erreur interne', 'message' => $e->getMessage()]);
        }
        exit();
    case 'POST':
        if(!EtudiantTable::isEtudiant(Controller::getCurrentUser()->getId()))
        {
            http_response_code(403);
            echo json_encode(['statut' => 'error', 'error' => 'Non autorisé']);
            exit;
        }

        if(!isset($_POST['IdOffre']))
        {
            http_response_code(400);
            echo json_encode(['statut' => 'error', 'error' => 'Paramètres manquants']);
            exit;
        }

        $wishlist_table = new WishlistTable();

        $wishlist = [
            WishlistTable::$ID_OFFRE_COLUMN => $_POST['IdOffre'],
            WishlistTable::$ID_UTILISATEUR_COLUMN => Controller::getCurrentUser()->getId(),
        ];

        try
        {
            $wishlist_table->insertWithArray($wishlist);

            echo json_encode(['statut' => 'success', 'success' => 'Wishlist enregistrée']);
            http_response_code(201);
        }
        catch(Exception $e)
        {
            http_response_code(500);
            echo json_encode(['statut' => 'error', 'error' => 'Erreur interne', 'message' => $e->getMessage()]);
        }
        exit;

    default:
        http_response_code(405);
        echo json_encode(['statut' => 'error', 'error' => 'Méthode non supportée']);
        exit;
}