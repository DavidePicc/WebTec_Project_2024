<?php
require_once ("functions.php"); 
require_once ("connection.php");
require_once("paginaWeb.php");


ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);
setlocale(LC_ALL, 'it_IT');

//Metto i segnaposti così poi verranno sostituiti in base al quadro
$paginaObj = new paginaWeb("../template/operaTemplate.html", 
                            "{titoloOpera}", 
                            "{titoloOpera}, pittrice di Padova, {tecnicaOpera}", 
                            "Opera '{titoloOpera}' di Sandra Bertocco");

$paginaObj->getOperaSingola();
$paginaObj->printPage();
