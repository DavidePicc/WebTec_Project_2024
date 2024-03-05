<?php
require_once "functions.php"; 
require_once("paginaWeb.php");

use functions\functions;

ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);

setlocale(LC_ALL, 'it_IT');

$paginaObj = new paginaWeb("../template/formPrenotazioneTemplate.html", 
                        "Nuova opera", 
                        "", "Nuova opera", false);
$modifiche = "";

$connection = new functions(); 
$connectionOk = $connection->openDBConnection(); 

if (session_status() == PHP_SESSION_NONE)
        session_start();

if($connectionOk){
    if(isset($_SESSION['user_name']) && ($_SESSION['user_name'] != "admin") ){ //se è un utente normale loggato	
        $idOpera;	
        if($connectionOk){
            $idUtente = $_SESSION['user_name'];
            $idOpera = $_GET['idOpera'];
            if(isset($_POST['submit'])){
                if (isset($_GET['idOpera']) && isset($_POST['messaggio'])) {                    
                    $messaggio = $connection->pulisciInput($_POST['messaggio']);
                    if ($connection->prenotaOpera($idUtente, $idOpera, $messaggio)) {
                        $paginaObj = new paginaWeb("../template/modificaAvvenuta.html", 
                                                    "Prenota opera", 
                                                    "", "Prenotazione opera", false);
                        $paginaObj->addHTML("{messaggioTitolo}", "Prenotazione avvenuta");
                        $paginaObj->addHTML("{messaggioModifica}", "Richiesta di prenotazione inviata correttamente");
                        $paginaObj->printPage();
                        die;
                    } else {
                        $modifiche = "Errore nell'inserimento dei dati, riprovare";
                    }
                }else{
                    $modifiche .= "<p>Si è verificato un errore di connessione, riprovare</p>"; // da aggiustare
                }
            }
        }else{
            $modifiche .="<p>I sistemi sono momentaneamente fuori servizio, ci scusiamo per il disagio.</p>";// da aggiustare
        }
       
        $connection->closeConnection(); 
        $paginaObj->addHTML("{messaggio}", $modifiche);
        $paginaObj->addHTML("{opera}", $idOpera);
        $paginaObj->printPage();
    }else{
        header("Location: login.php");
        exit;
    }
}