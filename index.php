<?php

require_once 'services/GebruikerService.php';
$gebService = new GebruikerService();
$lijst = $gebService -> toonAlleUsers();
print_r($lijst);