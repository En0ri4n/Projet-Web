<?php

use model\object\Link;
use model\object\Utilisateur;
use model\table\AdresseTable;
use model\table\CompetenceTable;
use model\table\EntrepriseTable;
use model\table\LinkTable;
use model\table\OffreTable;
use model\table\SecteurTable;

require_once($_SERVER['DOCUMENT_ROOT'] . '/libs/Smarty.class.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/model/object/Utilisateur.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/model/table/EtudiantTable.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/model/table/PiloteTable.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/model/table/AdministrateurTable.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/model/table/OffreTable.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/model/table/EntrepriseTable.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/model/table/AdresseTable.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/model/table/LinkTable.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/model/table/CompetenceTable.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/model/table/SecteurTable.php');

class Controller
{
    public static string $INDEX_PAGE = '/index.php';
    public static string $DEFAULT_PAGE = '/accueil';
    public static string $CONNECTION_PAGE = '/connexion';
    public static string $FORBIDDEN_PAGE = '/forbidden';

    public static string $USER_COOKIE_NAME = 'user';

    private Smarty $smarty;

    /*TODO Vérifier que les autorisations soient correctes à chaque changement de page*/
    public function homeController(): void
    {
        $this->setup(false);

        $this->display('view/accueil.tpl');
    }

    public function connexionController(): void
    {
        $this->setup(true);
        $this->display('view/connexion.tpl');
    }

    public function forbiddenController(): void
    {
        $this->setup(false);
        $this->display('view/forbidden403.tpl');
    }

    public function notFoundController(): void
    {
        $this->setup(false);
        $this->display('view/notfound404.tpl');
    }

    public function aboutController(): void
    {
        $this->setup(false);
        $this->display('view/about.tpl');
    }

    public function contactController(): void
    {
        $this->setup(false);
        $this->display('view/contact.tpl');
    }

    public function offresController(): void
    {
        $this->setup(false);
        $this->display('view/offres.tpl');
    }

    public function mentionsController(): void
    {
        $this->setup(false);
        $this->display('view/mentions.tpl');
    }

    public function adminPageController(): void
    {
        $this->setup(false);
        $this->display('view/admin_page.tpl');
    }

    public function entrepriseController(): void
    {
        $this->setup(false);
        $this->display('view/entreprise.tpl');
    }

    public function descriptionEntrepriseController(): void
    {
        $this->setup(false);
		
		if(!isset($_GET['entrepriseId']))
        {
            $this->smarty->assign('entreprise_exists', false);
            $this->display('view/description_entreprise.tpl');
            return;
        }
		
		$this->smarty->assign('entreprise_exists', true);
		$table = new EntrepriseTable();
        $entreprise = $table->select([EntrepriseTable::$ID_COLUMN => $_GET['entrepriseId']]);
		
		if($entreprise == null)
        {
            $this->smarty->assign('entreprise_exists', false);
            $this->display('view/description_entreprise.tpl');
            return;
        }
        $this->smarty->assign('entreprise', $entreprise);

        // TODO: Copier les changements des compétences d'une entreprise ici
        $table = LinkTable::getEntrepriseToSecteur();
        $links_secteurs = $table->select([LinkTable::getEntrepriseToSecteur()->getIdFromColumn() => $entreprise->getId()]);
        $table = new SecteurTable();
        $q = array();

        if(is_array($links_secteurs))
        {
            foreach($links_secteurs as $link)
                array_merge($q, [SecteurTable::$ID_COLUMN => $link->getIdTo()]);
            $secteurs[] = $table->selectOr($q); 
        }
        else
        {
            $secteurs[] = $table->select([SecteurTable::$ID_COLUMN => $links_secteurs->getIdTo()]);
        }

        $table = LinkTable::getEntrepriseToAdresse();
        $links_adresses = $table->select([LinkTable::getEntrepriseToAdresse()->getIdFromColumn() => $entreprise->getId()]);
        $table = new AdresseTable();
        $q = array();

        if(is_array($links_adresses))
        {
            foreach($links_adresses as $link)
                array_merge($q, [AdresseTable::$ID_COLUMN => $link->getIdTo()]);
            $adresses[] = $table->selectOr($q); 
        }
        else
        {
            $adresses[] = $table->select([AdresseTable::$ID_COLUMN => $links_adresses->getIdTo()]);
        }

        // TODO: Listes des offres d'une entreprise
		
        $this->display('view/description_entreprise.tpl');
    }

    public function descriptionOffreController(): void
    {
        $this->setup(false);

        if (!isset($_GET['offreId'])) {
            $this->smarty->assign('offre_exists', false);
            $this->display('view/description_offre.tpl');
            return;
        }

        $this->smarty->assign('offre_exists', true);

        $table = new OffreTable();
        $offre = $table->select([OffreTable::$ID_COLUMN => $_GET['offreId']]);

        if ($offre == null) {
            $this->smarty->assign('offre_exists', false);
            $this->display('view/description_offre.tpl');
            return;
        }

        $this->smarty->assign('offre', $offre);

        $secteur_table = new SecteurTable();
        $entreprise_table = new EntrepriseTable();
        $entreprise_to_adresse_table = LinkTable::getEntrepriseToAdresse();
        $entreprise_to_secteur_table = LinkTable::getEntrepriseToSecteur();
        $adresse_table = new AdresseTable();
        $offre_to_competence_table = LinkTable::getOffreToCompetence();
        $competence_table = new CompetenceTable();


        $secteur = $secteur_table->select([SecteurTable::$ID_COLUMN => $offre->getIdSecteur()]);
        $this->smarty->assign('secteur', $secteur);

        $entreprise = $entreprise_table->select([EntrepriseTable::$ID_COLUMN => $offre->getIdCompany()]);
        $this->smarty->assign('entreprise', $entreprise);

        $links_entreprise_adresses = $entreprise_to_adresse_table->select([LinkTable::getEntrepriseToAdresse()->getIdFromColumn() => $offre->getIdCompany()]);
        $entreprise_adresses = $this->fromLinks($links_entreprise_adresses, AdresseTable::$ID_COLUMN, fn($q) => $adresse_table->selectOr($q), fn($a) => $adresse_table->select([AdresseTable::$ID_COLUMN => $a->getIdTo()]));
        $this->smarty->assign('entreprise_adresses', $entreprise_adresses);

        $links_entreprise_secteurs = $entreprise_to_secteur_table->select([LinkTable::getEntrepriseToSecteur()->getIdFromColumn() => $offre->getIdCompany()]);
        $entreprise_secteurs = $this->fromLinks($links_entreprise_secteurs, SecteurTable::$ID_COLUMN, fn($q) => $secteur_table->selectOr($q), fn($a) => $secteur_table->select([SecteurTable::$ID_COLUMN => $a->getIdTo()]));
        $this->smarty->assign('entreprise_secteurs', $entreprise_secteurs);

        $adresse = $adresse_table->select([AdresseTable::$ID_COLUMN => $offre->getIdAdresse()]);
        $this->smarty->assign('adresse', $adresse);

        $links_competences = $offre_to_competence_table->select([LinkTable::getOffreToCompetence()->getIdFromColumn() => $offre->getId()]);
        $competences = $this->fromLinks($links_competences, CompetenceTable::$ID_COLUMN, fn($q) => $competence_table->selectOr($q), fn($a) => $competence_table->select([CompetenceTable::$ID_COLUMN => $a->getIdTo()]));

        $this->smarty->assign('competences', $competences);


        $this->display('view/description_offre.tpl');
    }

    public function fromLinks(array|Link $a, string $col, callable $array, callable $single): array
    {
        $q = array();
        if (is_array($a)) {
            foreach ($a as $link) {
                $q = array_merge($q, [$col => $link->getIdTo()]);
            }

            if(count($q) == 0)
                return [];
            elseif(count($q) == 1)
                return [$array($q)];

            return $array($q);
        }
        else {
            return [$single($a)];
        }
    }

    public function inscriptionController(): void
    {
        $this->setup(false);
        $this->display('view/inscription.tpl');
    }

    public function posterOffreController(): void
    {
        $this->setup(false);
        $this->display('view/poster_offre.tpl');
    }

    public function entreprisesController(): void
    {
        $this->setup(false);
        $this->display('view/entreprises.tpl');
    }

    public function utilisateursController(): void
    {
        $this->setup(false);
        $this->display('view/utilisateurs.tpl');
    }

    public function profileController(): void
    {
        $this->setup(false);

        if (!isset($_GET['userId'])) {
            $this->smarty->assign('user_exists', false);
            $this->display('view/profil_utilisateur.tpl');
            return;
        }

        if (EtudiantTable::isEtudiant($_GET['userId'])) {
            $table = new EtudiantTable();

            $this->smarty->assign('user_type', 'etudiant');
        }
        elseif (PiloteTable::isPilote($_GET['userId'])) {
            $table = new PiloteTable();
            $this->smarty->assign('user_type', 'pilote');
        }
        elseif (AdministrateurTable::isAdministrateur($_GET['userId'])) {
            $table = new AdministrateurTable();
            $this->smarty->assign('user_type', 'administrateur');
        }
        else {
            $this->smarty->assign('user_exists', false);
            $this->display('view/profil_utilisateur.tpl');
            return;
        }

        $user = $table->select([$table->getIdColumn() => $_GET['userId']]);

        $this->smarty->assign('user', $user);

        $this->smarty->assign('user_exists', true);

        $this->display('view/profil_utilisateur.tpl');
    }

    /**
     * Display the page with the given name
     *
     * @param string $page
     * @return void
     */
    private function display(string $page): void
    {
        try {
            $this->smarty->display($page);
        }
        catch (SmartyException|Exception $e) {
            echo $e->getMessage();
        }
    }

    /**
     * Call this method at the beginning of each controller method to set up the Smarty object and check if the user is connected
     *
     * @param bool $is_connection_page True if the current page is the connection page, false otherwise
     * @return void
     */
    private function setup(bool $is_connection_page): void
    {
        if (!isset($this->smarty)) {
            $this->smarty = new Smarty();

            $this->smarty->setTemplateDir($_SERVER['DOCUMENT_ROOT'] . '/controller/templates');
            $this->smarty->setCompileDir($_SERVER['DOCUMENT_ROOT'] . '/controller/templates_c');
            $this->smarty->setConfigDir($_SERVER['DOCUMENT_ROOT'] . '/controller/configs');
            $this->smarty->setCacheDir($_SERVER['DOCUMENT_ROOT'] . '/controller/cache');
        }

        $this->assignBasicComponents();
        $this->checkConnection($is_connection_page);
    }

    /**
     * Check if the user is connected and redirect to the connection page if not
     *
     * @param bool $is_connection_page
     * @return void
     */
    private function checkConnection(bool $is_connection_page): void
    {
        $this->smarty->assign('is_connected', isset($_COOKIE[self::$USER_COOKIE_NAME]));

        if (!isset($_COOKIE[self::$USER_COOKIE_NAME]) && !$is_connection_page) {
            header('Location: ' . self::$CONNECTION_PAGE);
            exit();
        }
    }

    /**
     * Add different default values to the Smarty object to be used in the templates (e.g. the current user, the default page, the connection page, etc.)
     *
     * @return void
     */
    private function assignBasicComponents(): void
    {
        $current_user = isset($_COOKIE[self::$USER_COOKIE_NAME]) ? Utilisateur::fromArray(json_decode(base64_decode($_COOKIE[self::$USER_COOKIE_NAME]), true)) : null;

        $this->smarty->assign('user_cookie_name', self::$USER_COOKIE_NAME);
        $this->smarty->assign('current_user', $current_user);

        if ($current_user !== null) {
            if (EtudiantTable::isEtudiant($current_user->getId())) {
                $this->smarty->assign('current_user_type', 'etudiant');
            }
            elseif (PiloteTable::isPilote($current_user->getId())) {
                $this->smarty->assign('current_user_type', 'pilote');
            }
            elseif (AdministrateurTable::isAdministrateur($current_user->getId())) {
                $this->smarty->assign('current_user_type', 'administrateur');
            }
        }

        $links = [
            'Accueil' => self::$DEFAULT_PAGE,
            'Entreprises' => '/entreprises',
            'Offres' => '/offres',
            'Utilisateurs' => '/utilisateurs',
            'Contact' => '/contact',
            'À propos' => '/about',
            'Mentions légales' => '/mentions'
        ];

        $this->smarty->assign('links', $links);

        $this->smarty->assign('index_page', self::$INDEX_PAGE);

        $this->smarty->assign('default_page', self::$DEFAULT_PAGE);
        $this->smarty->assign('connection_page', self::$CONNECTION_PAGE);
        $this->smarty->assign('forbidden_page', self::$FORBIDDEN_PAGE);
    }

    public static function getCurrentUser(): null|Utilisateur
    {
        return isset($_COOKIE[self::$USER_COOKIE_NAME]) ? Utilisateur::fromArray(json_decode(base64_decode($_COOKIE[self::$USER_COOKIE_NAME]), true)) : null;
    }
}