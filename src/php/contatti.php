<?php
    require_once "functions.php"; 
    use functions\functions;

    ini_set('display_errors',1);
    ini_set('display_startup_errors',1);
    error_reporting(E_ALL);
    setlocale(LC_ALL, 'it_IT');

    require_once("paginaWeb.php");
    $paginaObj = new paginaWeb("../template/contatti.html", "Contatti", 
                                "Contatti di Sandra Bertocco, pittrice di Padova, acrilico su tela, tempera, acquerello, guazzo",
                                "Vari contatti di Sandra Bertocco");

    //funzioni di controllo
    function isValidName($name) {
        return preg_match("/^[a-zA-Z ]+$/", $name);
    }

    function isValidPhoneNumber($phone) {
        return preg_match("/^\d{10}$/", $phone);
    }

    $messaggio = "";


    $dbFunctions = new functions();

    $conn = $dbFunctions->openDBConnection();

    if ($conn) {
    if ($_SERVER["REQUEST_METHOD"] == "POST"){

            $nome = $dbFunctions->pulisciInput($_POST["firstName"]);
            $cognome = $dbFunctions->pulisciInput($_POST["lastName"]);
            $telefono = $dbFunctions->pulisciInput($_POST["phone"]);
            $testoLibero = $dbFunctions->pulisciInput($_POST["message"]);

            // Perform server-side validation
            if (!isValidName($nome)) {
                $messaggio = "Nome non valido, niente numeri";
                exit;
            }

            if (!isValidName($cognome)) {
                $messaggio = "Cognome non valido, niente numeri";
                exit;
            }

            if (!isValidPhoneNumber($telefono)) {
                $messaggio = "Telfono non valido.";
                exit;
            }

            if ($dbFunctions->addMessage($nome, $cognome, $telefono, $testoLibero)) {
                $paginaObj = new paginaWeb("../template/modificaAvvenuta.html", 
                                                    "Nuova opera", 
                                                    "", "Nuova opera", false);
                $paginaObj->addHTML("{messaggioTitolo}", "Messaggio inviato");
                $paginaObj->addHTML("{messaggioModifica}", "Messaggio inviato correttamente");
                $paginaObj->printPage();
                die;
            } else {
                $messaggio = "Il messaggio NON è stato inviato con successo";
            }

        }
    }else{
        die("Errore nella connessione al database");
        }

    // Chiudi la connessione al database
    $dbFunctions->closeConnection();
    
    $script= "<script src='../js/functions.js'></script><!--SCRIPT per form-->";

    $paginaObj->addHTML("{script}", $script);

    $paginaObj->addHTML("{messaggio}", $messaggio);

    $paginaObj->printPage();