<?php
    require_once("paginaWeb.php");
    $paginaObj = new paginaWeb("../template/opere.html", "Opere Sandra Bertocco", 
                                "Lista opere, Sandra Bertocco, pittrice di Padova, acrilico su tela, tempera, acquerello, guazzo",
                                "Lista opere di Sandra Bertocco");
    $paginaObj->printPage();