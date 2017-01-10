<?php

require_once 'services/GebruikerService.php';


$gebService = new GebruikerService();

$toonAlleUsers = $gebService -> toonAlleUsers();
print_r($toonAlleUsers); 


$gebService->createUser(
    'test@vdab.be',
    'M',
    'paswoord',
    '2017-02-19',
    'naam',
    'voornaam',
    '8210',
    'zedelgem',
    '180',
    '3',
    '3',
    'pedoloog',
    '2',
    '0',
    '5',
    '4',
    '2',
    'foto',
    '4',
    '2017-04-05',
    '180',
    '4',
    '2',
    '0',
    '0',
    '4',
    'V'
    );


