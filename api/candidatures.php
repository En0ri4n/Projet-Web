<?php

use model\object\Candidature;
use model\table\CandidatureTable;

require_once($_SERVER['DOCUMENT_ROOT'] . '/model/table/UtilisateurTable.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/model/table/CandidatureTable.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/model/table/EtudiantTable.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/model/object/Candidature.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/api/requests.php');

checkUserConnection();

// Handle HTTP methods
$method = $_SERVER['REQUEST_METHOD'];

header('Content-Type: application/json');

switch($method) {
    case 'GET':
        checkIfGetColumn(new CandidatureTable());

        $parameters = [];

        addIfSetSpecial($parameters, $_GET, 'IdCandidature', eq(CandidatureTable::$ID_COLUMN));
        addIfSetSpecial($parameters, $_GET, 'IdOffre', eq(CandidatureTable::$ID_OFFRE_COLUMN));
        addIfSetSpecial($parameters, $_GET, 'IdEtudiant', eq(CandidatureTable::$ID_ETUDIANT_COLUMN));

        try
        {
            $candidature_table = new CandidatureTable();

            $total_candidatures = $candidature_table->selectSpecialConditionsAndParameters($parameters, "", fn($a) => Candidature::fromArray($a));

            $candidatures = $candidature_table->selectSpecialConditionsAndParameters($parameters, "LIMIT " . getPerPage() . " OFFSET " . (getPerPage() * (getPage() - 1)), fn($a) => Candidature::fromArray($a));

            $json = setupPages(count(is_array($total_candidatures) ? $total_candidatures : ($total_candidatures === null ? [] : [$total_candidatures])));
            $json['candidatures'] = $candidatures === null ? [] : (is_array($candidatures) ? $candidatures : [$candidatures]);

            if($candidatures === null)
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
        break;

    case 'POST':

        if(!EtudiantTable::isEtudiant(Controller::getCurrentUser()->getId()))
        {
            http_response_code(403);
            echo json_encode(['statut' => 'error', 'error' => 'Non autorisé']);
            exit;
        }

        $cv_target = '/storage/' . basename($_FILES['cv']['name']);
        $motivation_target =  '/storage/' . basename($_FILES['motivation']['name']);

        move_uploaded_file($_FILES['cv']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . $cv_target);
        move_uploaded_file($_FILES['motivation']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . $motivation_target);

        $candidature_table = new CandidatureTable();

        $candidature = [
            CandidatureTable::$ID_OFFRE_COLUMN => $_POST['IdOffre'],
            CandidatureTable::$ID_ETUDIANT_COLUMN => Controller::getCurrentUser()->getId(),
            CandidatureTable::$CV_PATH_COLUMN=> $cv_target,
            CandidatureTable::$COVER_LETTER_PATH_COLUMN => $motivation_target
        ];

        try
        {
            $candidature_table->insertWithArray($candidature);

            echo json_encode(['statut' => 'success', 'success' => 'Candidature enregistrée']);
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