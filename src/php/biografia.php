<?php
    require_once("paginaWeb.php");
    $paginaObj = new paginaWeb("../template/biografia.html", "Biografia Sandra Bertocco", 
                                "Biografia Sandra Bertocco, pittrice di Padova, acrilico su tela, tempera, acquerello, guazzo",
                                "Biografia di Sandra Bertocco");
    $paginaObj->printPage();