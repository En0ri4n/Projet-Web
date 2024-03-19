<?php

namespace Object;

include_once 'Utilisateur.php';

class Pilote extends Utilisateur
{
    public function __construct($id, $nom, $prenom, $email, $password, $telephone)
    {
        parent::__construct($id, $nom, $prenom, $email, $password, $telephone);
    }
}