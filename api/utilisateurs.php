<?php

use model\table\UtilisateurTable;
use model\object\Utilisateur;
use model\object\Etudiant;

require_once($_SERVER['DOCUMENT_ROOT'] . '/controller/Controller.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/model/table/UtilisateurTable.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/model/table/EtudiantTable.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/api/requests.php');

checkConnection();

ob_start('ob_gzhandler');

// Handle HTTP methods
$method = $_SERVER['REQUEST_METHOD'];

header('Content-Type: application/json');

switch($method)
{
    case 'GET':
        $parameters = [];

        checkIfGetColumn(new UtilisateurTable());

        if(isset($_GET['self']))
        {
            $self = json_decode(base64_decode($_COOKIE[Controller::$USER_COOKIE_NAME]), true);
            $id = $self['IdUtilisateur'];

            $table = new UtilisateurTable();
            $utilisateur = $table->select([UtilisateurTable::$ID_COLUMN => $id]);

            echo json_encode($utilisateur);
            exit();
        }

        addIfSetSpecial($parameters, $_GET, 'IdUtilisateur', eq(UtilisateurTable::$ID_COLUMN));

        addIfSetSpecial($parameters, $_GET, 'Nom', like(UtilisateurTable::$PRENOM_COLUMN));
        addIfSetSpecial($parameters, $_GET, 'Nom', like(UtilisateurTable::$NOM_COLUMN));

        $table = new UtilisateurTable();

        $total_users = $table->selectOrSpecialConditionsAndParameters($parameters, "", fn($a) => Utilisateur::fromArray($a));

        $utilisateurs = $table->selectOrSpecialConditionsAndParameters($parameters, "LIMIT " . getPerPage() . " OFFSET " . (getPerPage() * (getPage() - 1)), fn($a) => Utilisateur::fromArray($a));

        $json = setupPages(count(is_array($total_users) ? $total_users : ($total_users === null ? [] : [$total_users])));

        /*TODO : Fix*/
        if (isset($_GET['promotion'])) {
            $a = [];
            foreach ($utilisateurs as $u) {
                if ($u->jsonSerialize()["user_type"] == "etudiant") {
                    if ($u->jsonSerialize()['promotion'] == $_GET['promotion']) {
                        $a[] = $u;
                    }
                }
            }
        }

        if(!isset($a))
        {
            $a = $utilisateurs;
        }

        $json['users'] = $a === null ? [] : (is_array($a) ? $a : [$a]);

        echo json_encode($json);
        exit();
    default:
        http_response_code(405);
        echo json_encode(['statut' => 'error', 'error' => 'Méthode non autorisée']);
        exit();

    case 'POST':
        $data = json_decode(file_get_contents('php://input'), true);

        if(!isset($data['IdUtilisateur']) || !isset($data['Prenom']) || !isset($data['Nom']) || !isset($data['MailUtilisateur']) || !isset($data['MotDePasse']) || !isset($data['TelephoneUtilisateur']))
        {
            http_response_code(400);
            echo json_encode(['statut' => 'error', 'error' => 'Paramètres manquants', 'expected' => ['IdUtilisateur', 'Prenom', 'Nom', 'MailUtilisateur', 'MotDePasse', 'TelephoneUtilisateur'], 'received' => array_keys($data ?? [])]);
            exit();
        }

        $utilisateur = new Utilisateur($data['IdUtilisateur'], $data['Nom'], $data['Prenom'], $data['MailUtilisateur'], $data['MotDePasse'], $data['TelephoneUtilisateur']);
        $table = new UtilisateurTable();
        try
        {
            $table->insert($utilisateur);
            http_response_code(201);
            echo json_encode(['statut' => 'success', 'success' => 'Utilisateur ajouté', 'utilisateur' => $utilisateur]);
        }
        catch(Exception $e)
        {
            http_response_code(500);
            echo json_encode(['statut' => 'error', 'error' => 'Erreur interne', 'message' => $e->getMessage()]);
        }

        if(isset($data['type']))
        {
            if($data['type']==='etudiant'){
                if(!isset($data['Numero']) || !isset($data['Rue']) || !isset($data['Ville']) || !isset($data['CodePostal']) || !isset($data['Pays']) || !isset($data['idPromo'])){
                    http_response_code(400);
                    echo json_encode(['statut' => 'error', 'error' => 'Paramètres manquants', 'expected' => ['Numero', 'Rue', 'Ville', 'CodePostal', 'Pays', 'idPromo'], 'received' => array_keys($data ?? [])]);
                    exit();
                }
                $address = new \model\object\Adresse(-1, $data['Numero'], $data['Rue'], $data['Ville'], $data['CodePostal'], $data['Pays']);
                $tableAddress = new \model\table\AdresseTable();
                $tableStudent = new EtudiantTable();
                try
                {
                    $tableAddress->insert($address);
                    echo json_encode(['success' => 'Adresse ajoutée', 'adresse' => $tableAddress->getLastInsertId()]);
                    $etudiant = new Etudiant($data['IdUtilisateur'], $data['Nom'], $data['Prenom'], $data['MailUtilisateur'], $data['MotDePasse'], $data['TelephoneUtilisateur'], intval($data['idPromo'])  , $tableAddress->getLastInsertId());
                    $tableStudent->insert($etudiant);
                    echo json_encode(['statut' => 'success', 'success' => 'Etudiant ajouté', 'etudiant' => $etudiant]);
                }
                catch(Exception $e)
                {
                    http_response_code(500);
                    echo json_encode(['statut' => 'error', 'error' => 'Erreur interne', 'message' => $e->getMessage()]);
                }
            }
            /*TODO : créer plusieurs promo par pilote*/
            if($data['type']==='pilote'){
                if(!isset($data['namePromo']) || !isset($data['typePromo']) || !isset($data['datePromo']) || !isset($data['lvlPromo']) || !isset($data['durationPromo']) || !isset($data['center'])){
                    http_response_code(400);
                    echo json_encode(['statut' => 'error', 'error' => 'Paramètres manquants', 'expected' => ['namePromo', 'typePromo', 'datePromo', 'lvlPromo', 'durationPromo', 'center'], 'received' => array_keys($data ?? [])]);
                    exit();
                }
                $pilote = new \model\object\Pilote($data['IdUtilisateur'], $data['Nom'], $data['Prenom'], $data['MailUtilisateur'], $data['MotDePasse'], $data['TelephoneUtilisateur']);
                $promotion = new \model\object\Promotion(-1,$data['namePromo'], $data['typePromo'], $data['datePromo'], $data['lvlPromo'], $data['durationPromo'], $data['center'], $pilote->getId());
                $tablePilote = new PiloteTable();
                $tablePromotion = new \model\table\PromotionTable();
                try
                {
                    $tablePilote->insert($pilote);
                    echo json_encode(['statut' => 'success', 'success' => 'Pilote ajouté', 'pilote' => $pilote]);
                    $tablePromotion->insert($promotion);
                    echo json_encode(['success' => 'Promotion ajoutée', 'promotion' => $promotion]);
                }
                catch(Exception $e)
                {
                    http_response_code(500);
                    echo json_encode(['statut' => 'error', 'error' => 'Erreur interne', 'message' => $e->getMessage()]);
                }
            }
            if($data['type']==='administrateur'){
                $administrateur = new \model\object\Administrateur($data['IdUtilisateur'], $data['Nom'], $data['Prenom'], $data['MailUtilisateur'], $data['MotDePasse'], $data['TelephoneUtilisateur']);
                $tableAdmin = new AdministrateurTable();
                try{
                    $tableAdmin->insert($administrateur);
                    echo json_encode(['statut' => 'success','success' => 'Administrateur ajouté', 'administrateur' => $administrateur]);
                }
                catch(Exception $e)
                {
                    http_response_code(500);
                    echo json_encode(['statut' => 'error', 'error' => 'Erreur interne', 'message' => $e->getMessage()]);
                }
            }
        }
        exit();

    case 'PUT':
        $data = json_decode(file_get_contents('php://input'), true);

        if (!isset($data['IdUtilisateur']))
        {
            http_response_code(400);
            echo json_encode(['statut' => 'error', 'error' => 'Paramètre manquant', 'expected' => ['IdUtilisateur'], 'received' => array_keys($data ?? [])]);
            exit();
        }

        $etudiantTable = new EtudiantTable();
        $piloteTable = new PiloteTable();
        $adminTable = new AdministrateurTable();
        $adresseTable = new \model\table\AdresseTable();
        $utilisateurTable = new UtilisateurTable();

        $etudiant = $etudiantTable->select([EtudiantTable::$ID_COLUMN => $data['IdUtilisateur']]);

        $id = array_shift($data);

        $s = array();
        $cols = $etudiantTable->selectJoinedColumnNames($utilisateurTable->getTableName(), $adresseTable->getTableName());

        foreach ($data as $key => $value) {
            if (in_array($key, $cols)) {
                $s[$key] = $value;
            }
        }

        if (isset($s['Numero']) && isset($s['Rue']) && isset($s['Ville']) && isset($s['CodePostal']) && isset($s['Pays'])) {

            $adresse = new \model\object\Adresse(-1, $s['Numero'], $s['Rue'], $s['Ville'], $s['CodePostal'], $s['Pays']);
            unset($s['Numero']);
            unset($s['Rue']);
            unset($s['Ville']);
            unset($s['CodePostal']);
            unset($s['Pays']);
            $adresseTable->insertWith(array_keys($adresse->toInsertArray()), $adresse->toInsertArray());

            $s['IdAdresse'] = $adresseTable->getLastInsertId();
        }

        $data = $s;

        if ($etudiantTable->isEtudiant($id)){

            try {
                $etudiantTable->defaultJoinUpdate($id, \model\table\AbstractTable::inner_join(UtilisateurTable::$TABLE_NAME, UtilisateurTable::$ID_COLUMN, EtudiantTable::$ID_COLUMN), $data);
                $adresseTable->delete($etudiant->getIdAdresse());
                echo json_encode(['statut' => 'success', 'success' => 'Etudiant mis à jour', 'etudiant' => $id]);
            }
            catch(Exception $e)
            {
                http_response_code(500);
                echo json_encode(['statut' => 'error', 'error' => 'Erreur interne', 'message' => $e->getMessage()]);
            }
        }

        if ($piloteTable->isPilote($id)){
            try {
                $piloteTable->defaultJoinUpdate($id, \model\table\AbstractTable::inner_join(UtilisateurTable::$TABLE_NAME, UtilisateurTable::$ID_COLUMN, PiloteTable::$ID_COLUMN), $data);
                echo json_encode(['statut' => 'success','success' => 'Pilote mis à jour', 'pilote' => $id]);
            }
            catch(Exception $e)
            {
                http_response_code(500);
                echo json_encode(['statut' => 'error', 'error' => 'Erreur interne', 'message' => $e->getMessage()]);
            }
        }

        if ($adminTable->isAdministrateur($id)){
            try {
                $adminTable->defaultJoinUpdate($id, \model\table\AbstractTable::inner_join(UtilisateurTable::$TABLE_NAME, UtilisateurTable::$ID_COLUMN, AdministrateurTable::$ID_COLUMN), $data);
                echo json_encode(['statut' => 'success', 'success' => 'Administrateur mis à jour', 'administrateur' => $id]);
            }
            catch(Exception $e)
            {
                http_response_code(500);
                echo json_encode(['statut' => 'error', 'error' => 'Erreur interne', 'message' => $e->getMessage()]);
            }
        }
        exit();

    case 'DELETE':
        $data = json_decode(file_get_contents('php://input'), true);

        if (!isset($data['IdUtilisateur']))
        {
            http_response_code(400);
            echo json_encode(['statut' => 'error', 'error' => 'Paramètre manquant', 'expected' => ['IdUtilisateur'], 'received' => array_keys($data ?? [])]);
            exit();
        }

        $adresseTable = new \model\table\AdresseTable();
        $etudiantTable = new EtudiantTable();
        $piloteTable = new PiloteTable();
        $adminTable = new AdministrateurTable();
        $testEtu = $etudiantTable->isEtudiant($data['IdUtilisateur']);
        $testPil = $piloteTable->isPilote($data['IdUtilisateur']);
        $testAdmin = $adminTable->isAdministrateur($data['IdUtilisateur']);

            try {
                if ($testEtu){
                    $etudiant = $etudiantTable->select([EtudiantTable::$ID_COLUMN => $data['IdUtilisateur']]);
                    $etudiantTable->delete($data['IdUtilisateur']);
                    $adresseTable->delete($etudiant->getIdAdresse());
                }

                if ($testPil){
                    $piloteTable->delete($data['IdUtilisateur']);
                }

                if ($testAdmin){
                    $adminTable->delete($data['IdUtilisateur']);
                }

                echo json_encode(['statut' => 'success', 'success' => 'Utilisateur supprimé', 'utilisateur' => $data['IdUtilisateur']]);
            }
            catch(Exception $e)
            {
                http_response_code(500);
                echo json_encode(['statut' => 'error', 'error' => 'Erreur interne', 'message' => $e->getMessage()]);
            }
    exit();
}