<?php
require_once("../php/paginaWeb.php");

//Metto i segnaposti così poi verranno sostituiti in base al quadro
$paginaObj = new paginaWeb("errore403.html", 
                            "Errore 403 - Pagina non trovata", 
                            "", "Pagina di errore 403");

$paginaObj->printPage();