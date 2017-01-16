<?php

/**
 * Created by PhpStorm.
 * User: cyber10
 * Date: 16/01/2017
 * Time: 11:55
 */
//services/HobbyService.php
require_once ('data/HobbyDAO.php');

class HobbyService
{
    //READ
    public function toonAlleHobbies()
    {
        $hobbyDAO=new HobbyDAO();
        $alleHobbies=$hobbyDAO->getAlleHobbies();
        return $alleHobbies;
    }

    //CREATE
    public function createHobby($hobbies)
    {
        $hobbyDAO=new HobbyDAO();
        $alleHobbies=$hobbyDAO->createHobby($hobbies);
        return $alleHobbies;
    }

    //UPDATE
    public function updateHobby($hobbies)
    {
        $hobbyDAO=new HobbyDAO();
        $alleHobbies=$hobbyDAO->updateHobbies($hobbies);
        return $alleHobbies;

    }

    //DELETE
    public function deleteHobby($hobbiesId)
    {
        $hobbyDAO=new HobbyDAO();
        $alleHobbies=$hobbyDAO->delete($hobbiesId);
        return $alleHobbies;

    }

}