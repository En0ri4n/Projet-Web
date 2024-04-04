<?php

use model\table\EvaluationTable;
use model\object\Evaluation;
use model\table\EntrepriseTable;
use model\table\LinkTable;

require_once($_SERVER['DOCUMENT_ROOT'] . '/controller/Controller.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/model/table/EvaluationTable.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/model/table/EntrepriseTable.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/api/requests.php');

checkConnection();

// Handle HTTP methods
$method = $_SERVER['REQUEST_METHOD'];

header('Content-Type: application/json');

switch($method) {
    case 'GET':

        $parameters = [];

        addIfSetSpecial($parameters, $_GET, 'IdEntreprise', eq(EvaluationTable::$ID_ENTREPRISE_COLUMN));

        /*
        if (isset($_GET['IdEntreprise'])) {
            $wanted_entreprise = $_GET['IdEntreprise'];
*/

            $table = new EvaluationTable();
            $evaluations = $table->selectSpecialConditionsAndParameters($parameters, "LIMIT " . getPerPage() . " OFFSET " . (getPerPage() * (getPage() - 1)), fn($a) => Evaluation::fromArray($a));
        //$evaluations = $table->select([EvaluationTable::$ID_ENTREPRISE_COLUMN => $wanted_entreprise]);
            echo json_encode($evaluations);
            exit();

            if ($evaluations === null) {
                http_response_code(404);
                echo json_encode(['statut' => 'error', 'error' => 'Evaluations non trouvées', 'evaluations' => []]);
                exit();
            }
        //}
}