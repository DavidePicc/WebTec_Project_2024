<?php
    require_once("paginaWeb.php");
    $images = "";
    $file = $_GET['file'];
    
    $directory = "../assets/galleria/";
    $path = $directory . $file;
    
    if ($handle = opendir($path)) {
        // Legge ogni elemento nella directory
        while (($image = readdir($handle)) !== false) {
            // Ignora i punti e le directory nascoste
            if ($image != "." && $image != "..") {
                // Puoi fare qualcosa con il file, ad esempio visualizzarlo o elaborarlo
                 $images .= "<div class=\"slideImmagini\"><img src=\"" . $path . "/" . $image . "\"></div>\n";
            }
        }
        // Chiude la directory
        closedir($handle);
    }
    
    if($file == "pensieri_liquidi"){
        $paginaObj = new paginaWeb("../template/gallerie/pensieri_liquidi.html", "Pensieri Liquidi", 
                                    "Galleria Pensieri Liquidi Sandra Bertocco, pittrice di Padova, acrilico su tela, tempera, acquerello, guazzo",
                                    "Galleria Pensieri Liquidi");
    }
    if($file == "resilienza"){
        $paginaObj = new paginaWeb("../template/gallerie/resilienza.html", "Resilienza", 
                                    "Galleria Resilienza Sandra Bertocco, pittrice di Padova, acrilico su tela, tempera, acquerello, guazzo",
                                    "Galleria Resilienza");
    }
    if($file == "un_astrazione_possibile"){
        $paginaObj = new paginaWeb("../template/gallerie/un_astrazione_possibile.html", "Un'Astrazione Possibile", 
                                    "Galleria Un'Astrazione Possibile Sandra Bertocco, pittrice di Padova, acrilico su tela, tempera, acquerello, guazzo",
                                    "Galleria Un'Astrazione Possibile");
    }
    if($file == "artefiera_cremona"){
        $paginaObj = new paginaWeb("../template/gallerie/artefiera_cremona.html", "ArteFiera Cremona", 
                                    "Galleria ArteFiera Cremona Sandra Bertocco, pittrice di Padova, acrilico su tela, tempera, acquerello, guazzo",
                                    "Galleria ArteFiera Cremona");
    }
    if($file == "attraverso_il_colore"){
        $paginaObj = new paginaWeb("../template/gallerie/attraverso_il_colore.html", "Attraverso il Colore", 
                                    "Galleria Attraverso il Colore Sandra Bertocco, pittrice di Padova, acrilico su tela, tempera, acquerello, guazzo",
                                    "Galleria Attraverso il Colore");
    }
    $paginaObj->addHTML("{fotoGalleria}", $images);
    $paginaObj->printPage();
