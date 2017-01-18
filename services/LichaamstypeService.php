<?php

/**
 * Created by PhpStorm.
 * User: cyber10
 * Date: 18/01/2017
 * Time: 9:45
 */
//services/LichaamstypeService.php
require_once ('data/LichaamstypeDAO.php');
class LichaamstypeService
{
    //READ
    public function toonAlleLichaamstypes()
    {
        $lichaamstypeDAO=new LichaamstypeDAO();
        $alleLichaamstypes=$lichaamstypeDAO->getAlleLichaamstypes();
        return $alleLichaamstypes;
    }

    //CREATE
    public function createLichaamstype($lichaamstype)
    {
        $lichaamstypeDAO=new LichaamstypeDAO();
        $alleLichaamstypes=$lichaamstypeDAO->createLichaamstype($lichaamstype);
        return $alleLichaamstypes;
    }

    //UPDATE
    public function updateLichaamstype($lichaamstype)
    {
        $lichaamstypeDAO=new LichaamstypeDAO();
        $alleLichaamstypes=$lichaamstypeDAO->updateLichaamstype($lichaamstype);
        return $alleLichaamstypes;
    }

    //DELETE
    public function deleteLichaamstype($lichaamstypeId)
    {
        $lichaamstypeDAO=new LichaamstypeDAO();
        $alleLichaamstypes=$lichaamstypeDAO->delete($lichaamstypeId);
        return $alleLichaamstypes;
    }

}