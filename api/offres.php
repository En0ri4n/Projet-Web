<?php

use model\table\OffreTable;

require_once($_SERVER['DOCUMENT_ROOT'] . '/controller/Controller.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/model/table/OffreTable.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/api/requests.php');

// Handle HTTP methods
$method = $_SERVER['REQUEST_METHOD'];

header('Content-Type: application/json');

switch($method) {
    case 'GET': //TODO: date supérieure ou égale//
        $parameters = [];
        if(isset($_GET['name']))
            $parameters += [OffreTable::$NAME_COLUMN => url_decode_and_percent($_GET['name'])];
        if(isset($_GET['date']))
            $parameters += [OffreTable::$DATE_COLUMN => url_decode_and_percent($_GET['date'])];
        if(isset($_GET['duration']))
            $parameters += [OffreTable::$DURATION_COLUMN => url_decode_and_percent($_GET['duration'])];
        if(isset($_GET['compensation']))
            $parameters += [OffreTable::$COMPENSATION_COLUMN => url_decode_and_percent($_GET['compensation'])];
        if(isset($_GET['nbPlaces']))
            $parameters += [OffreTable::$NBPLACE_COLUMN => url_decode_and_percent($_GET['nbPlaces'])];
        if(isset($_GET['level']))
            $parameters += [OffreTable::$LEVEL_COLUMN => url_decode_and_percent($_GET['level'])];
        if(isset($_GET['description']))
            $parameters += [OffreTable::$DESCRIPTION_COLUMN => url_decode_and_percent($_GET['description'])];
        if(isset($_GET['sector']))
            $parameters += [OffreTable::$SECTOR_COLUMN => url_decode_and_percent($_GET['sector'])];
        if(isset($_GET['address']))
            $parameters += [OffreTable::$ADDRESS_COLUMN => url_decode_and_percent($_GET['address'])];
        if(isset($_GET['company']))
            $parameters += [OffreTable::$COMPANY_COLUMN => url_decode_and_percent($_GET['company'])];

            $offre_table = new OffreTable();
            $offres = $offre_table->selectLike($parameters);

            if($offres===null){
                echo json_encode([]);
                exit();
            }
            echo json_encode($offres);
        }