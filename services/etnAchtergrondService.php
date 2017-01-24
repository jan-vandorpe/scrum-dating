<?php
/**
 * Created by PhpStorm.
 * User: cyber10
 * Date: 16/01/2017
 * Time: 9:53
 */
//services/etnAchtergrondService.php
require_once ('data/etnAchtergrondDAO.php');

class etnAchtergrondService{

    //READ
    public function toonAlleAchtergronden()
    {
        $etnAchtergrondDAO=new etnAchtergrondDAO();
        $alleAchtergronden=$etnAchtergrondDAO->getAlleAchtergronden();
        return $alleAchtergronden;
    }
    public function getEtniciteitById($id){
        $etniciteitDAO=new etnAchtergrondDAO();
        $etniciteit=$etniciteitDAO->getEtniciteitById($id);
        return $etniciteit;
    }

    //CREATE
    public function createEtnAchtergrond($etnAchtergrond)
    {
        $etnAchtergrondDAO=new etnAchtergrondDAO();
        $etnAchtergrond=$etnAchtergrondDAO->createEtnAchtergrond($etnAchtergrond);
        return $etnAchtergrond;
    }

    //UPDATE
    public function updateAchtergrond($etnAchtergrond)
    {
        $etnAchtergrondDAO = new etnAchtergrondDAO();
       $Achtergrond=$etnAchtergrondDAO->updateEtnAchtergrond($etnAchtergrond);
        return $Achtergrond;
    }

    //DELETE
    public function deleteAchtergrond($etnAchtergrondId)
    {

        $etnAchtergrondDAO = new etnAchtergrondDAO();
        $Achtergrond=$etnAchtergrondDAO->delete($etnAchtergrondId);
        return $Achtergrond;
    }


}