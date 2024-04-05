<?php

use model\table\AdresseTable;
use model\object\Adresse;
use model\table\EntrepriseTable;
use model\table\LinkTable;
use model\table\OffreTable;

require_once($_SERVER['DOCUMENT_ROOT'] . '/controller/Controller.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/model/table/UtilisateurTable.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/model/table/EtudiantTable.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/api/requests.php');

checkConnection();

// Handle HTTP methods
$method = $_SERVER['REQUEST_METHOD'];

header('Content-Type: application/json');

switch($method) {
    case 'GET':
        checkIfGetColumn(new AdresseTable());

        $parameters = [];

        if(isset($_GET[fromColumn(EntrepriseTable::$ID_COLUMN)]))
        {
            $wanted_entreprise = $_GET[fromColumn(EntrepriseTable::$ID_COLUMN)];

            $table = new EntrepriseTable();
            $entreprise = $table->select([EntrepriseTable::$ID_COLUMN => $wanted_entreprise]);

            if($entreprise === null)
            {
                http_response_code(404);
                echo json_encode(['statut' => 'error', fromColumn(EntrepriseTable::$ID_COLUMN) => $wanted_entreprise, 'error' => 'Entreprise non trouvée', 'adresses' => []]);
                exit();
            }

            $table = LinkTable::getEntrepriseToAdresse();
            $links = $table->select([$table->getIdFromColumn() => $wanted_entreprise]);
            $table = new AdresseTable();
            $adresses = $links == null ? [] : Controller::fromLinks($links, AdresseTable::$ID_COLUMN, fn($a) => $table->selectOr($a), fn($a) => $table->select([AdresseTable::$ID_COLUMN => $a->getIdTo()]));

            $json = [fromColumn(EntrepriseTable::$ID_COLUMN) => $wanted_entreprise, 'adresses' => $adresses];
            echo json_encode($json);
            exit();
        }
        elseif(isset($_GET[fromColumn(EtudiantTable::$ID_COLUMN)]))
        {
            $wanted_etudiant = $_GET[fromColumn(EtudiantTable::$ID_COLUMN)];

            $table = new EtudiantTable();
            $etudiant = $table->select([EtudiantTable::$ID_COLUMN => $wanted_etudiant]);

            if($etudiant === null)
            {
                http_response_code(404);
                echo json_encode(['statut' => 'error', fromColumn(EtudiantTable::$ID_COLUMN) => $wanted_etudiant, 'error' => 'Etudiant non trouvé', 'adresses' => []]);
                exit();
            }

            $table = new AdresseTable();
            $adresse = $table->select([AdresseTable::$ID_COLUMN => $etudiant->getIdAdresse()]);

            $json = [fromColumn(EtudiantTable::$ID_COLUMN) => $wanted_etudiant, 'adresse' => $adresse];
            echo json_encode($json);
            exit();
        }
        elseif(isset($_GET['IdOffre']))
        {
            $wanted_offre = $_GET['IdOffre'];

            $table = new OffreTable();
            $offre = $table->select([OffreTable::$ID_COLUMN => $wanted_offre]);

            if($offre === null)
            {
                http_response_code(404);
                echo json_encode(['statut' => 'error', 'IdOffre' => $wanted_offre, 'error' => 'Offre non trouvée', 'adresse' => []]);
                exit();
            }

            $table = new AdresseTable();
            $adresse = $table->select([AdresseTable::$ID_COLUMN => $offre->getIdAdresse()]);

            $json = ['IdOffre' => $wanted_offre, 'adresse' => $adresse];
            echo json_encode($json);
            exit();
        }

        echo json_encode(['statut' => 'error', 'error' => 'Paramètres invalides']);
        break;

    case 'POST':
        $data = json_decode(file_get_contents('php://input'), true);
        if($data === null)

            if(!isset($data['noAddress']) || !isset($data['street']) || !isset($data['city']) || !isset($data['pc']) || !isset($data['country']))
            {
                http_response_code(400);
                echo json_encode(['statut' => 'error', 'error' => 'Paramètres manquants', 'expected' => ['noAddress', 'street', 'city', 'pc', 'country'], 'received' => array_keys($data ?? [])]);
                exit();
            }
        $address = new \model\object\Adresse(-1, $data['noAddress'], $data['street'], $data['city'], $data['pc'], $data['country']);
        $tableAddress = new \model\table\AdresseTable();

        try
        {
            $tableAddress->insert($address);
            echo json_encode(['statut' => 'success', 'success' => 'Adresse ajoutée', 'adresse' => $tableAddress->getLastInsertId()]);
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