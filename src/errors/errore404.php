<?php
require_once("../php/paginaWeb.php");

//Metto i segnaposti così poi verranno sostituiti in base al quadro
$paginaObj = new paginaWeb("errore404.html", 
                            "Errore 404 - Pagina non trovata", 
                            "", "Pagina di errore 404");

$paginaObj->printPage();