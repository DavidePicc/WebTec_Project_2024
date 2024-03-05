<?php
require_once("../php/paginaWeb.php");

//Metto i segnaposti così poi verranno sostituiti in base al quadro
$paginaObj = new paginaWeb("errore500.html", 
                            "Errore 500 - Pagina non trovata", 
                            "", "Pagina di errore 500");

$paginaObj->printPage();