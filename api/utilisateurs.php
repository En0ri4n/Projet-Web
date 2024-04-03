<?php

use model\table\UtilisateurTable;
use model\object\Utilisateur;
use model\object\Etudiant;

require_once($_SERVER['DOCUMENT_ROOT'] . '/controller/Controller.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/model/table/UtilisateurTable.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/model/table/EtudiantTable.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/api/requests.php');

checkConnection();

// Handle HTTP methods
$method = $_SERVER['REQUEST_METHOD'];

header('Content-Type: application/json');

switch($method)
{
    case 'GET':
        $parameters = [];

        if(isset($_GET['self']))
        {
            $self = json_decode(base64_decode($_COOKIE[Controller::$USER_COOKIE_NAME]), true);
            $id = $self['IdUtilisateur'];

            $table = new UtilisateurTable();
            $utilisateur = $table->select([UtilisateurTable::$ID_COLUMN => $id]);

            echo json_encode($utilisateur);
            exit();
        }

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
        echo json_encode(['error' => 'Méthode non autorisée']);
        exit();
    case 'POST':
        $data = json_decode(file_get_contents('php://input'), true);

        if(!isset($data['id']) || !isset($data['firstname']) || !isset($data['lastname']) || !isset($data['email']) || !isset($data['password']) || !isset($data['phone']))
        {
            http_response_code(400);
            echo json_encode(['error' => 'Paramètres manquants', 'expected' => ['id', 'firstname', 'lastname', 'email', 'password', 'phone'], 'received' => array_keys($data ?? [])]);
            exit();
        }

        $utilisateur = new Utilisateur($data['id'], $data['lastname'], $data['firstname'], $data['email'], $data['password'], $data['phone']);
        $table = new UtilisateurTable();
        try
        {
            $table->insert($utilisateur);
            echo json_encode(['success' => 'Utilisateur ajouté', 'utilisateur' => $utilisateur]);
        }
        catch(Exception $e)
        {
            http_response_code(500);
            echo json_encode(['error' => 'Erreur interne', 'message' => $e->getMessage()]);
        }

        if(isset($data['type']))
        {
            if($data['type']==='etudiant'){
                if(!isset($data['noAddress']) || !isset($data['street']) || !isset($data['city']) || !isset($data['pc']) || !isset($data['country']) || !isset($data['idPromo'])){
                    http_response_code(400);
                    echo json_encode(['error' => 'Paramètres manquants', 'expected' => ['noAddress', 'street', 'city', 'pc', 'country', 'idPromo'], 'received' => array_keys($data ?? [])]);
                    exit();
                }

                $address = new \model\object\Adresse(-1, $data['noAddress'], $data['street'], $data['city'], $data['pc'], $data['country']);
                $etudiant = new Etudiant($data['id'], $data['lastname'], $data['firstname'], $data['email'], $data['password'], $data['phone'], $data['idPromo'], $address->getId()); /*TODO : eventuellement changer le constructeur pour prendre en param un objet Utilisateur*/
                $tableAddress = new \model\table\AdresseTable();
                $tableStudent = new EtudiantTable();
                try
                {
                    $tableAddress->insert($address);
                    echo json_encode(['success' => 'Addresse ajoutée', 'adresse' => $address]);
                    $tableStudent->insert($etudiant);
                    echo json_encode(['success' => 'Etudiant ajouté', 'etudiant' => $etudiant]);
                }
                catch(Exception $e)
                {
                    http_response_code(500);
                    echo json_encode(['error' => 'Erreur interne', 'message' => $e->getMessage()]);
                }
            }
            /*TODO : créer plusieurs promo par pilote*/
            if($data['type']==='pilote'){
                if(!isset($data['namePromo']) || !isset($data['typePromo']) || !isset($data['datePromo']) || !isset($data['lvlPromo']) || !isset($data['durationPromo']) || !isset($data['center'])){
                    http_response_code(400);
                    echo json_encode(['error' => 'Paramètres manquants', 'expected' => ['namePromo', 'typePromo', 'datePromo', 'lvlPromo', 'durationPromo', 'center'], 'received' => array_keys($data ?? [])]);
                    exit();
                }
                $pilote = new \model\object\Pilote($data['id'], $data['lastname'], $data['firstname'], $data['email'], $data['password'], $data['phone']);
                $promotion = new \model\object\Promotion(-1,$data['namePromo'], $data['typePromo'], $data['datePromo'], $data['lvlPromo'], $data['durationPromo'], $data['center'], $pilote->getId());
                $tablePilote = new PiloteTable();
                $tablePromotion = new \model\table\PromotionTable();
                try
                {
                    $tablePilote->insert($pilote);
                    echo json_encode(['success' => 'Pilote ajouté', 'pilote' => $pilote]);
                    $tablePromotion->insert($promotion);
                    echo json_encode(['success' => 'Promotion ajoutée', 'promotion' => $promotion]);
                }
                catch(Exception $e)
                {
                    http_response_code(500);
                    echo json_encode(['error' => 'Erreur interne', 'message' => $e->getMessage()]);
                }
            }
            if($data['type']==='administrateur'){
                $administrateur = new \model\object\Administrateur($data['id'], $data['lastname'], $data['firstname'], $data['email'], $data['password'], $data['phone']);
                $tableAdmin = new AdministrateurTable();
                try{
                    $tableAdmin->insert($administrateur);
                    echo json_encode(['success' => 'Administrateur ajouté', 'administrateur' => $administrateur]);
                }
                catch(Exception $e)
                {
                    http_response_code(500);
                    echo json_encode(['error' => 'Erreur interne', 'message' => $e->getMessage()]);
                }
            }
        }

        exit();
}