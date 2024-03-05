<?php
require_once "functions.php"; 
require_once("paginaWeb.php");

use functions\functions;

ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);
setlocale(LC_ALL, 'it_IT');

$paginaObj = new paginaWeb("../template/newCarta.html", 
                            "Nuova opera", 
                            "", "Nuova opera", false);

$dbFunctions = new functions();

$conn = $dbFunctions->openDBConnection();

$messaggiPerForm = ''; //messaggio errore

//Variabili per il form
$titolo = '';
$tecnica = '';
$anno = '';
$descrizione = '';
$path = '';

if($conn){
    if(isset($_POST['submit'])){  

        $titolo = $dbFunctions->pulisciInput($_POST['titolo']); 
        if (strlen($titolo) == 0){
            $messaggiPerForm .= '<li>titolo non inserito</li>'; //invece di una serie di if uso una variabile
            $titoloNULL = NULL;//se non c'è il titolo
        }else{
            $titoloNULL=$titolo;//se invece c'e
        }
    
        $tecnica = $dbFunctions->pulisciInput($_POST['tecnica']); 
        if (strlen($tecnica) == 0){
            $messaggiPerForm .= '<li>tecnica non inserito</li>';
        }
    
    
        $anno = $dbFunctions->pulisciInput($_POST['anno']);
        if (strlen($anno) == 0){
            $messaggiPerForm .= '<li>anno non inserito</li>';
        }else{
            if(!preg_match("/^\d{4}$/", $anno)) {
                $messaggiPerForm .= '<li>anno deve essere un numero di 4 cifre</li>';
            }
        }
    
        $descrizione = $dbFunctions->pulisciInput($_POST['descrizione']);
        if (strlen($descrizione) == 0){
            $messaggiPerForm .= '<li>descrizione non inserita</li>';
        }
    
        $path = $dbFunctions->pulisciInput($_POST['path']);
        if (strlen($path) == 0){
            $messaggiPerForm .= '<li>path non inserito</li>';
        }
    
        //CONTROLLO ESISTENZA DELL?OPERA
        if($dbFunctions->checkCarta($path)){
            $messaggiPerForm .= "<li>L'opera esiste già o stai usando un path già esistente</li>";
        }
    
        //IMMAGINE
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // DESTINAZIONE
            $uploadDir = "../assets/opere/";
        
            // Verifica se la cartella di destinazione esiste, altrimenti crea la cartella
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
        
            // INFORMAZIONI SULL'IMMAGINE(recuperata online)
            $fileName = basename($_FILES["file"]["name"]);
            $targetFilePath = $uploadDir . $fileName;
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
        
            // Verifica se il file è un'immagine
            $allowTypes = array("jpg", "jpeg", "png", "gif");
            if (in_array($fileType, $allowTypes)) {
                // Sposta il file nella cartella di destinazione
                if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) {
                } else {
                    $messaggiPerForm = "Si è verificato un errore durante il caricamento dell'immagine.";
                }
            } else {
                $messaggiPerForm = "Sono consentiti solo file di tipo JPG, JPEG, PNG e GIF.";
            }
        }
        //IMMAGINE
    
        if(strlen($messaggiPerForm) == 0){//se non ci sono messaggi di errore fino ad qua
            if($conn){
        
                if ($dbFunctions->addCarta($titoloNULL, $tecnica, $anno, $descrizione, $path)) {
                    $paginaObj = new paginaWeb("../template/modificaAvvenuta.html", 
                                                    "Nuova opera", 
                                                    "", "Nuova opera", false);
                        $paginaObj->addHTML("{messaggioTitolo}", "Nuova opera");
                        $paginaObj->addHTML("{messaggioModifica}", "Nuova opera inserita correttamente");
                        $paginaObj->printPage();
                        die;            
                } else {
                    //echo "Errore nell'inserimento dei dati: ";
                    $messaggiPerForm = "il quadro NON è stato aggiunto con successo errore nell'inserimento dati";
                }
            }else{
                die("Errore nella connessione al database");
            }
        }   
    }
}


$dbFunctions->closeConnection();
//per non perdere quello scritto in caso di errore
$paginaObj->addHTML("{messaggio}", $messaggiPerForm);
$paginaObj->addHTML("{titolo}", $titolo);
$paginaObj->addHTML("{anno}", $anno);
$paginaObj->addHTML("{tecnica}", $tecnica);
$paginaObj->addHTML("{descrizione}", $descrizione);
$paginaObj->addHTML("{path}", $path);

$paginaObj->printPage();