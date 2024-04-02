<?php

use model\object\Offre;
use model\table\OffreTable;

require_once($_SERVER['DOCUMENT_ROOT'] . '/controller/Controller.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/model/table/OffreTable.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/api/requests.php');

// Handle HTTP methods
$method = $_SERVER['REQUEST_METHOD'];

header('Content-Type: application/json');

switch ($method) {
    case 'GET':
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

        try {
            $offre_table = new OffreTable();
            $offres = $offre_table->selectSpecialConditionsAndParameters($parameters, "LIMIT " . getPerPage() . " OFFSET " . (getPerPage() * (getPage() - 1)) , fn($a) => Offre::fromArray($a));

            $json = setupPages(count($offres));
            $json['offres'] = $offres === null ? [] : $offres;

            if ($offres === null) {
                echo json_encode($json);
                exit();
            }
            echo json_encode($json);
        }
        catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => 'Erreur interne', 'message' => $e->getMessage()]);
        }
}