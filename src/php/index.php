<?php
    require_once("paginaWeb.php");
    $paginaObj = new paginaWeb("../template/index.html", "Sandra Bertocco - Home", 
                                "Sandra Bertocco, pittrice di Padova, acrilico su tela, tempera, acquerello, guazzo",
                                "Portfolio di Sandra Bertocco, Sito di Sandra Bertocco");
    $paginaObj->printPage();