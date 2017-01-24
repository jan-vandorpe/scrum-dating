<?php

/**
 * Created by PhpStorm.
 * User: cyber10
 * Date: 18/01/2017
 * Time: 9:24
 */
//services/OogkleurService.php
require_once ('data/OogkleurDAO.php');

class OogkleurService
{
    //READ
    public function toonAlleOogkleuren()
    {
        $oogkleurDAO=new OogkleurDAO();
        $alleOogkleuren=$oogkleurDAO->getAlleOogkleuren();
        return $alleOogkleuren;
    }
    public function getOogkleurById($id){
        $oogkleurDAO=new OogkleurDAO();
        $oogkleur=$oogkleurDAO->getOogkleurById($id);
        return $oogkleur;
    }


    //CREATE
    public function createOogkleur($oogkleur)
    {
        $oogkleurDAO=new OogkleurDAO();
        $alleOogkleuren=$oogkleurDAO->createOogkleur($oogkleur);
        return $alleOogkleuren;

    }

    //UPDATE
    public function updateOogkleur($oogkleur)
    {
        $oogkleurDAO=new OogkleurDAO();
        $alleOogkleuren=$oogkleurDAO->updateOogkleur($oogkleur);
        return $alleOogkleuren;
    }

    //DELETE
    public function deleteOogkleur($oogkleurId)
    {
        $oogkleurDAO=new OogkleurDAO();
        $alleOogkleuren=$oogkleurDAO->delete($oogkleurId);
        return $alleOogkleuren;
    }


}