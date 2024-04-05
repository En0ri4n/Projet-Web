<?php

use model\object\Entreprise;
use model\object\Offre;
use model\table\EntrepriseTable;
use model\table\OffreTable;
use model\table\SecteurTable;

require_once($_SERVER['DOCUMENT_ROOT'] . '/controller/Controller.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/api/requests.php');

checkConnection();

ob_start('ob_gzhandler');

// Handle HTTP methods
$method = $_SERVER['REQUEST_METHOD'];

header('Content-Type: application/json');

switch($method)
{
    /*TODO : get statut et secteur*/
    case 'GET':
        if(isset($_GET['column']) && (str_contains($_GET['column'], 'IdSecteur') || str_contains($_GET['column'], 'NomSecteur')))
            checkIfGetColumn(new SecteurTable());
        checkIfGetColumn(new EntrepriseTable());

        $parameters = [];
        addIfSetSpecial($parameters, $_GET, 'IdEntreprise', eq(EntrepriseTable::$ID_COLUMN));
        addIfSetSpecial($parameters, $_GET, 'name', like(EntrepriseTable::$NOM_COLUMN));
        addIfSetSpecial($parameters, $_GET, 'IdSecteur', eq(\model\table\LinkTable::getEntrepriseToSecteur()->getIdToColumn()));

        try
        {
            $entreprise_table = new EntrepriseTable();

            $total_entreprises = $entreprise_table->selectJoinSpecialConditionsAndParameters(EntrepriseTable::inner_join('Composer', 'Entreprise.IdEntreprise', 'Composer.IdEntreprise'), $parameters, "GROUP BY " . 'Composer.IdEntreprise', fn($a) => Entreprise::fromArray($a));



            $entreprises = $entreprise_table->selectJoinSpecialConditionsAndParameters(EntrepriseTable::inner_join('Composer', 'Entreprise.IdEntreprise', 'Composer.IdEntreprise'), $parameters,  "GROUP BY Composer.IdEntreprise " . "LIMIT " . getPerPage() . " OFFSET " . (getPerPage() * (getPage() - 1)), fn($a) => Entreprise::fromArray($a));

            $json = setupPages(count(is_array($total_entreprises) ? $total_entreprises : ($total_entreprises === null ? [] : [$total_entreprises])));
            $json['entreprises'] = $entreprises === null ? [] : (is_array($entreprises) ? $entreprises : [$entreprises]);

            if($entreprises === null)
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
        exit;

        /*TODO : secteur et adresse*/
    case 'POST':
        $data = json_decode(file_get_contents('php://input'), true);
        if($data === null)
        {
            http_response_code(400);
            echo json_encode(['statut' => 'error', 'error' => 'Données invalides']);
            exit;
        }

        if(!isset($data['name']) || !isset($data['site']) || !isset($data['description']) || !isset($data['email']) || !isset($data['phone']) || !isset($data['status'])){
            http_response_code(400);
            echo json_encode(['statut' => 'error', 'error' => 'Paramètres manquants', 'expected' => ['name', 'site', 'description', 'email', 'phone', 'status'], 'received' => array_keys($data ?? [])]);
            exit();
        }

        try
        {
            $entreprise = new Entreprise(-1, $data['name'], $data['site'], $data['description'], $data['email'], $data['phone'], $data['status']);
            $entreprise_table = new EntrepriseTable();
            $entreprise_table->insert($entreprise);
            http_response_code(201);
            echo json_encode(['id' => $entreprise_table->getLastInsertId()]);
        }
        catch(Exception $e)
        {
            http_response_code(500);
            echo json_encode(['statut' => 'error', 'error' => 'Erreur interne', 'message' => $e->getMessage()]);
        }
        exit;

    case 'PUT':
        $data = json_decode(file_get_contents('php://input'), true);

        if (!isset($data['id']))
        {
            http_response_code(400);
            echo json_encode(['statut' => 'error', 'error' => 'Paramètre manquant', 'expected' => ['id'], 'received' => array_keys($data ?? [])]);
            exit();
        }

        $entrepriseTable = new EntrepriseTable();
        $id = array_shift($data);
        try {
            $entrepriseTable->defaultJoinUpdate($id, '', $data);
            echo json_encode(['statut' => 'success', 'success' => 'Entreprise mise à jour', 'entreprise' => $id]);
        }
        catch(Exception $e)
        {
            http_response_code(500);
            echo json_encode(['statut' => 'error', 'error' => 'Erreur interne', 'message' => $e->getMessage()]);
        }
        exit();

    case 'DELETE':
        $data = json_decode(file_get_contents('php://input'), true);

        if (!isset($data['IdEntreprise']))
        {
            http_response_code(400);
            echo json_encode(['statut' => 'error', 'error' => 'Paramètre manquant', 'expected' => ['IdEntreprise'], 'received' => array_keys($data ?? [])]);
            exit();
        }

        $entrepriseTable = new EntrepriseTable();

        try {
            $entrepriseTable->defaultJoinUpdate($data['IdEntreprise'], '', ['Statut'=>'Indisponible']);
            echo json_encode(['statut' => 'success', 'success' => 'Entreprise archivée', 'entreprise' => $data['IdEntreprise']]);
        }
        catch(Exception $e)
        {
            http_response_code(500);
            echo json_encode(['statut' => 'error', 'error' => 'Erreur interne', 'message' => $e->getMessage()]);
        }
        exit();

    default:
        http_response_code(500);
        echo json_encode(['statut' => 'error', 'error' => 'Méthode non supportée']);
        exit;
}