<?php

use model\table\EvaluationTable;
use model\object\Evaluation;
use model\table\EntrepriseTable;
use model\table\LinkTable;

require_once($_SERVER['DOCUMENT_ROOT'] . '/controller/Controller.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/model/table/EvaluationTable.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/model/table/EntrepriseTable.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/api/requests.php');

checkUserConnection();

// Handle HTTP methods
$method = $_SERVER['REQUEST_METHOD'];

header('Content-Type: application/json');

switch($method)
{
    case 'GET':

        $parameters = [];

        addIfSetSpecial($parameters, $_GET, 'IdEntreprise', eq(EvaluationTable::$ID_ENTREPRISE_COLUMN));

        /*
        if (isset($_GET['IdEntreprise'])) {
            $wanted_entreprise = $_GET['IdEntreprise'];
*/

        $table = new EvaluationTable();

        $total_evaluations = $table->selectSpecialConditionsAndParameters($parameters, "", fn($a) => Evaluation::fromArray($a));

        $evaluations = $table->selectSpecialConditionsAndParameters($parameters, "LIMIT " . getPerPage() . " OFFSET " . (getPerPage() * (getPage() - 1)), fn($a) => Evaluation::fromArray($a));
        //$evaluations = $table->select([EvaluationTable::$ID_ENTREPRISE_COLUMN => $wanted_entreprise]);
        $json = setupPages(count(is_array($total_evaluations) ? $total_evaluations : ($total_evaluations === null ? [] : [$total_evaluations])));
        $json['evaluations'] = $evaluations === null ? [] : (is_array($evaluations) ? $evaluations : [$evaluations]);

        echo json_encode($json);

        if($evaluations === null)
        {
            http_response_code(404);
            echo json_encode(['statut' => 'error', 'error' => 'Evaluations non trouvées', 'evaluations' => []]);
            exit();
        }
        exit();
    case 'POST':
        $data = $_POST;

        if(!isset($data['IdEntreprise']) || !isset($data['Note']) || !isset($data['Commentaire']))
        {
            http_response_code(400);
            echo json_encode(['statut' => 'error', 'error' => 'Paramètres manquants']);
            exit();
        }

        $entreprise_table = new EntrepriseTable();
        $entreprise = $entreprise_table->select([$entreprise_table::$ID_COLUMN => $data['IdEntreprise']]);

        if($entreprise === null)
        {
            http_response_code(404);
            echo json_encode(['statut' => 'error', 'error' => 'Entreprise non trouvée']);
            exit();
        }

        $evaluation = new Evaluation(-1, $data['Note'], $data['Commentaire'], Controller::getCurrentUser()->getId(), $data['IdEntreprise']);

        $table = new EvaluationTable();
        $table->insert($evaluation);

        echo json_encode(['statut' => 'success', 'evaluation' => $table->getLastInsertId()]);
        exit();
    default:
        http_response_code(405);
        echo json_encode(['statut' => 'error', 'error' => 'Méthode HTTP non autorisée']);
        exit();
    //}
}