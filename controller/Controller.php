<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/libs/Smarty.class.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/model/object/Utilisateur.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/model/table/EtudiantTable.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/model/table/PiloteTable.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/model/table/AdministrateurTable.php');

class Controller
{
    public static string $INDEX_PAGE = '/index.php';
    public static string $DEFAULT_PAGE = '/accueil';
    public static string $CONNECTION_PAGE = '/connexion';
    public static string $FORBIDDEN_PAGE = '/forbidden';

    public static string $USER_COOKIE_NAME = 'user';

    private Smarty $smarty;

    /*TODO Faire en sorte que les autorisations soient correctes à chaque changement de page*/
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

    public function profilePiloteController(): void
    {
        $this->setup(false);
        $this->display('view/profil.tpl');
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
        $this->display('view/description_entreprise.tpl');
    }

    public function descriptionOffreController(): void
    {
        $this->setup(false);
        $this->display('view/description_offre.tpl');
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

    public function profileController(): void
    {
        $this->setup(false);

        if(!isset($_GET['userId']))
        {
            $this->smarty->assign('user_exists', false);
            $this->display('view/profil.tpl');
            return;
        }

        if(EtudiantTable::isEtudiant($_GET['userId']))
        {
            $table = new EtudiantTable();

            $this->smarty->assign('user_type', 'etudiant');
        }
        else if(PiloteTable::isPilote($_GET['userId']))
        {
            $table = new PiloteTable();
            $this->smarty->assign('user_type', 'pilote');
        }
        else if(AdministrateurTable::isAdministrateur($_GET['userId']))
        {
            $table = new AdministrateurTable();
            $this->smarty->assign('user_type', 'administrateur');
        }
        else
        {
            $this->smarty->assign('user_exists', false);
            $this->display('view/profil.tpl');
            return;
        }

        $user = $table->select([$table->getIdColumn() => $_GET['userId']]);

        $this->smarty->assign('user', $user);

        $this->smarty->assign('user_exists', true);

        $this->display('view/profil.tpl');
    }

    /**
     * Display the page with the given name
     *
     * @param string $page
     * @return void
     */
    private function display(string $page): void
    {
        try
        {
            $this->smarty->display($page);
        }
        catch(SmartyException|Exception $e)
        {
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
        if(!isset($this->smarty))
        {
            $this->smarty = new Smarty();

            $this->smarty->setTemplateDir($_SERVER['DOCUMENT_ROOT'] . '/controller/templates');
            $this->smarty->setCompileDir($_SERVER['DOCUMENT_ROOT'] . '/controller/templates_c');
            $this->smarty->setConfigDir($_SERVER['DOCUMENT_ROOT'] . '/controller/configs');
            $this->smarty->setCacheDir($_SERVER['DOCUMENT_ROOT'] . '/controller/cache');
        }

        $this->addComponentController();
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

        if(!isset($_COOKIE[self::$USER_COOKIE_NAME]) && !$is_connection_page)
        {
            header('Location: ' . self::$CONNECTION_PAGE);
            exit();
        }
    }

    /**
     * Add different default values to the Smarty object to be used in the templates (e.g. the current user, the default page, the connection page, etc.)
     *
     * @return void
     */
    private function addComponentController(): void
    {
        $current_user = isset($_COOKIE[self::$USER_COOKIE_NAME]) ? Utilisateur::fromArray(json_decode(base64_decode($_COOKIE[self::$USER_COOKIE_NAME]), true)) : null;

        $this->smarty->assign('index_page', self::$INDEX_PAGE);

        $this->smarty->assign('default_page', self::$DEFAULT_PAGE);
        $this->smarty->assign('connection_page', self::$CONNECTION_PAGE);
        $this->smarty->assign('forbidden_page', self::$FORBIDDEN_PAGE);

        $this->smarty->assign('user_cookie_name', self::$USER_COOKIE_NAME);

        $this->smarty->assign('current_user', $current_user);
    }
}