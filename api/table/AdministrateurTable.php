<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/api/includes.php');

class AdministrateurTable extends UtilisateurTable
{
    public function getAdministrateurTable($db): AdministrateurTable
    {
        $instance = new AdministrateurTable();
        $this->setDatabase($db);
        $this->setTable("Administrateur");
        return $instance;
    }
}