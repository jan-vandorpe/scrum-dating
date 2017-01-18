<?php

/**
 * Created by PhpStorm.
 * User: cyber10
 * Date: 18/01/2017
 * Time: 10:02
 */
//services/OpleidingsniveauService.php
require_once ('data/OpleidingsniveauDAO.php');

class OpleidingsniveauService
{
    //READ
    public function toonAlleOpleidingsniveaus()
    {
        $opleidingsniveauDAO=new OpleidingsniveauDAO();
        $alleOpleidingsniveaus=$opleidingsniveauDAO->getAlleOpleidingsniveaus();
        return $alleOpleidingsniveaus;
    }

    //CREATE
    public function createOpleidingsniveau($opleidingsniveau)
    {
        $opleidingsniveauDAO=new OpleidingsniveauDAO();
        $alleOpleidingsniveaus=$opleidingsniveauDAO->createOpleidingsniveau($opleidingsniveau);
        return $alleOpleidingsniveaus;
    }

    //UPDATE
    public function updateOpleidingsniveau($opleidingsniveau)
    {
        $opleidingsniveauDAO=new OpleidingsniveauDAO();
        $alleOpleidingsniveaus=$opleidingsniveauDAO->updateOpleidingsniveau($opleidingsniveau);
        return $alleOpleidingsniveaus;
    }

    //DELETE
    public function deleteOpleidingsniveau($oplNiveauId)
    {
        $opleidingsniveauDAO=new OpleidingsniveauDAO();
        $alleOpleidingsniveaus=$opleidingsniveauDAO->delete($oplNiveauId);
        return $alleOpleidingsniveaus;
    }

}