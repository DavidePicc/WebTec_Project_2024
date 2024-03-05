<?php
    require_once("paginaWeb.php");
    $paginaObj = new paginaWeb("../template/galleria.html", "Galleria", 
                                "Galleria, Sandra Bertocco, pittrice di Padova, acrilico su tela, tempera, acquerello, guazzo",
                                "Lista di gallerie di Sandra Bertocco");
    $paginaObj->printPage();