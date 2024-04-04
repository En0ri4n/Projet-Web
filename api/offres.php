<?php

use model\object\Offre;
use model\table\OffreTable;

require_once($_SERVER['DOCUMENT_ROOT'] . '/controller/Controller.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/model/table/OffreTable.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/api/requests.php');

// Handle HTTP methods
$method = $_SERVER['REQUEST_METHOD'];

checkConnection();

ob_start('ob_gzhandler');

header('Content-Type: application/json');

switch($method)
{
    case 'GET':
        checkIfGetColumn(new OffreTable());

        $parameters = [];
        addIfSetSpecial($parameters, $_GET, 'name', like(OffreTable::$NAME_COLUMN));
        addIfSetSpecial($parameters, $_GET, 'date', dateSup(OffreTable::$DATE_COLUMN));
        addIfSetSpecial($parameters, $_GET, 'duration', sup(OffreTable::$DURATION_COLUMN));
        addIfSetSpecial($parameters, $_GET, 'compensation', sup(OffreTable::$COMPENSATION_COLUMN));
        addIfSetSpecial($parameters, $_GET, 'nbPlaces', sup(OffreTable::$NBPLACE_COLUMN));
        addIfSetSpecial($parameters, $_GET, 'level', inf(OffreTable::$LEVEL_COLUMN));
        addIfSetSpecial($parameters, $_GET, 'description', like(OffreTable::$DESCRIPTION_COLUMN));
        addIfSetSpecial($parameters, $_GET, 'sector', eq(OffreTable::$SECTOR_COLUMN));
        addIfSetSpecial($parameters, $_GET, 'address', eq(OffreTable::$ADDRESS_COLUMN));
        addIfSetSpecial($parameters, $_GET, 'company', eq(OffreTable::$COMPANY_COLUMN));

        try
        {
            $offre_table = new OffreTable();

            $total_offres = $offre_table->selectSpecialConditionsAndParameters($parameters, "", fn($a) => Offre::fromArray($a));

            $offres = $offre_table->selectSpecialConditionsAndParameters($parameters, "LIMIT " . getPerPage() . " OFFSET " . (getPerPage() * (getPage() - 1)), fn($a) => Offre::fromArray($a));

            $json = setupPages(count(is_array($total_offres) ? $total_offres : ($total_offres === null ? [] : [$total_offres])));
            $json['offres'] = $offres === null ? [] : (is_array($offres) ? $offres : [$offres]);

            if($offres === null)
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

    case 'POST':
        $data = json_decode(file_get_contents('php://input'), true);
        if($data === null)

        if(!isset($data['NomOffre']) || !isset($data['DateOffre']) || !isset($data['DureeOffre']) || !isset($data['Remuneration']) || !isset($data['NbPlace']) || !isset($data['NiveauOffre']) || !isset($data['DescriptionOffre']) || !isset($data['IdSecteur']) || !isset($data['IdEntreprise']) || !isset($data['noAddress']) || !isset($data['street']) || !isset($data['city']) || !isset($data['pc']) || !isset($data['country']))
        {
            http_response_code(400);
            echo json_encode(['statut' => 'error', 'error' => 'Paramètres manquants', 'expected' => ['IdUtilisateur', 'Prenom', 'Nom', 'MailUtilisateur', 'MotDePasse', 'TelephoneUtilisateur', 'IdSecteur', 'IdEntreprise', 'noAddress', 'street', 'city', 'pc', 'country'], 'received' => array_keys($data ?? [])]);
            exit();
        }
        $address = new \model\object\Adresse(-1, $data['noAddress'], $data['street'], $data['city'], $data['pc'], $data['country']);
        $tableAddress = new \model\table\AdresseTable();
        $table = new OffreTable();

        try
        {
            $tableAddress->insert($address);
            echo json_encode(['success' => 'Adresse ajoutée', 'adresse' => $tableAddress->getLastInsertId()]);
            $offre = new Offre(-1, $data['NomOffre'], $data['DateOffre'], $data['DureeOffre'], $data['Remuneration'], $data['NbPlace'], $data['NiveauOffre'], $data['DescriptionOffre'], $data['IdSecteur'], $tableAddress->getLastInsertId(), $data['IdEntreprise']);
            $table->insert($offre);
            http_response_code(201);
            echo json_encode(['statut' => 'success', 'success' => 'Adresse ajoutée', 'id' => $offre->getId()]);
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

        $offreTable = new OffreTable();
        $id = array_shift($data);
            try {
                $offreTable->defaultJoinUpdate($id, '', $data);
                echo json_encode(['statut' => 'success', 'success' => 'Offre mise à jour', 'offre' => $id]);
            }
            catch(Exception $e)
            {
                http_response_code(500);
                echo json_encode(['statut' => 'error', 'error' => 'Erreur interne', 'message' => $e->getMessage()]);
            }


        exit();

    case 'DELETE':
        $data = json_decode(file_get_contents('php://input'), true);

        if (!isset($data['id']))
        {
            http_response_code(400);
            echo json_encode(['statut' => 'error', 'error' => 'Paramètre manquant', 'expected' => ['id'], 'received' => array_keys($data ?? [])]);
            exit();
        }

        $offreTable = new OffreTable();

        try {
            $offreTable->delete($data['id']);
            echo json_encode(['statut' => 'success', 'success' => 'Offre supprimée', 'offre' => $data['id']]);
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