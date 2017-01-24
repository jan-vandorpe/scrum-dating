<?php
/**
 * Created by PhpStorm.
 * User: cyber10
 * Date: 17/01/2017
 * Time: 8:47
 */
//Services/HaarkleurService.php
require_once ('data/HaarkleurDAO.php');

class HaarkleurService {
//READ
    public function toonAlleHaarkleuren()
    {
        $haarkleurDAO=new HaarkleurDAO();
        $alleHaarkleuren=$haarkleurDAO->getAlleHaarkleuren();
        return $alleHaarkleuren;
    }
    public function getHaarkleurById($id){
        $haarkleurDAO=new HaarkleurDAO();
        $haarkleur=$haarkleurDAO->getHaarkleurById($id);
        return $haarkleur;
    }

    //CREATE
    public function createHaarkleur($haarkleur)
    {
        $haarkleurDAO=new HaarkleurDAO();
        $alleHaarkleuren=$haarkleurDAO->createHaarkleur($haarkleur);
        return $alleHaarkleuren;
    }

    //UPDATE
    public function updateHaarkleur($haarkleur)
    {
        $haarkleurDAO=new HaarkleurDAO();
        $alleHaarkleuren=$haarkleurDAO->updateHaarkleur($haarkleur);
        return $alleHaarkleuren;
    }

    //DELETE
    public function deleteHaarkleur($haarkleurId)
    {
        $haarkleurDAO=new HaarkleurDAO();
        $alleHaarkleuren=$haarkleurDAO->delete($haarkleurId);
        return $alleHaarkleuren;
    }

}