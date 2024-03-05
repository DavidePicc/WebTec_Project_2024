<?php
require_once ("functions.php"); 
require_once ("connection.php");
require_once("paginaWeb.php");
use functions\functions;
$dbFunctions = new functions();
$connectionOk = $dbFunctions->openDBConnection();

ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);
setlocale(LC_ALL, 'it_IT');

$paginaObj = new paginaWeb("../template/formModificaOpere.html", 
                            "Modifica {titolo}", 
                            "", "Modifica opera '{titolo}'", false);
    
$messaggio = ""; //messaggio errore

if($connectionOk){
    if (isset($_GET['tipoOpera']) && isset($_GET['idOpera'])) {// Verifica se i parametri idOpera e secondoParametro sono presenti nell'URL
        //Da aggiungere sanificazione dei parametri per prevenire attacchi di injection
        $tipoOpera = $_GET['tipoOpera'];
        $idOpera = $_GET['idOpera'];

        $modifiche = $dbFunctions->getOpera($tipoOpera, $idOpera);

        if($modifiche != null){
            $path = $modifiche['path'];
            $titolo = ($modifiche['titolo'] == NULL ? "Senza titolo" : $modifiche['titolo']);
            $tecnica = $modifiche['tecnica'];
            $data = $modifiche['data'];
            
            $descrizione = $modifiche['descrizione'];    
            
            $tipoOpera=="quadro" && $modifiche['proprietario'] != NULL ? $proprietario = ($modifiche['proprietario']) : $proprietario = "Opera senza proprietario";
            
            $altezza = $larghezza = "";
            if($tipoOpera == "quadro"){
                $altezza = $modifiche['altezza'];
                $larghezza = $modifiche['larghezza'];
            }
            
            //Blocco o attivo modifiche per vari casi in cui potrebbero non essere accettate
            if($altezza == null && $larghezza==null)
                $paginaObj->addHTML("{requiredDim}", "readonly");
            else{
                $paginaObj->addHTML("{requiredDim}", "required");
                $paginaObj->addHTML("{altezza}", $altezza);
                $paginaObj->addHTML("{larghezza}", $larghezza);
            }

            $paginaObj->addHTML("{titolo}", $titolo);
            $paginaObj->addHTML("{anno}", $data);
            $paginaObj->addHTML("{tecnica}", $tecnica);
            $paginaObj->addHTML("{proprietario}", $proprietario);
            $paginaObj->addHTML("{descrizione}", $descrizione);
            $paginaObj->addHTML("{path}", $path);
            $paginaObj->addHTML("{tipoHidden}", $tipoOpera);

            if($tipoOpera== "carta"){
                $paginaObj->addHTML("{requiredProprietario}", "readonly");
                $paginaObj->addHTML("{pathPrimary}", "readonly");
                $paginaObj->addHTML("{titoloPrimary}", "required");
            }else{
                $paginaObj->addHTML("{requiredProprietario}", "");
                $paginaObj->addHTML("{titoloPrimary}", "readonly");
                $paginaObj->addHTML("{proprietario}", $proprietario);
            }

        }else{
            $messaggio = "<p>Si è verificato un errore, ripetere l'operazione sull'opera desiderata</p>";
        }
    }else{
        $messaggio = "<p>Si è verificato un errore di connessione, riprovare</p>"; // da aggiustare
    }
}else{
    $messaggio ="<p>I sistemi sono momentaneamente fuori servizio, ci scusiamo per il disagio.</p>";// da aggiustare
}

$paginaObj->addHTML("{messaggio}", $messaggio);


$paginaObj->printPage();