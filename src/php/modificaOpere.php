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

if(isset($_POST['submit'])) {   //Modifica
    $percorso = $_POST['percorso'];
    $altezza = $larghezza = $proprietario = null;
    if(isset($_POST['tipoOpera'])){
        if($_POST['tipoOpera'] == "quadro"){
            $titolo =  $dbFunctions->pulisciInput($_POST['titolo']);
            $tecnica =  $dbFunctions->pulisciInput($_POST['tecnica']);
            $descrizione =  $dbFunctions->pulisciInput($_POST['descrizione']);
            $proprietario =  $dbFunctions->pulisciInput($_POST['proprietario']);
            $data = $_POST['data'];
            $altezza = $_POST['altezza'];
            $larghezza = $_POST['larghezza'];
            $idOpera = $titolo;
        }else{
            $titolo =  $dbFunctions->pulisciInput($_POST['titolo']);
            $tecnica =  $dbFunctions->pulisciInput($_POST['tecnica']);
            $descrizione =  $dbFunctions->pulisciInput($_POST['descrizione']);            
            $data = $_POST['data'];
            $idOpera = $percorso;
        }
    }
//    public function modificaOpera($tipoOpera, $idOpera, $titolo, $percorso, $tecnica, $data, $descrizione, $proprietario=null, $altezza=null, $larghezza=null){
    $dbFunctions->modificaOpera($_POST['tipoOpera'], $idOpera, $titolo, $percorso, $tecnica, $data, $descrizione, $proprietario, $altezza, $larghezza);
    $messaggio = "Opera " . $idOpera . " modificata correttamente: "
                    ."<a href=\"operaSingola.php?tipoOpera=".$_POST['tipoOpera']."&idOpera=".$idOpera."\">link all'opera modificata</a>";
    $messaggioTitolo = "Modifica avvenuta";


} else {    //Elimina
    if(isset($_POST['tipoOpera'])){
        if($_POST['tipoOpera'] == "quadro"){
            $idOpera = $_POST['titolo'];

        }else{
            $idOpera = $percorso;
        }
        $dbFunctions->eliminaOpera($_POST['tipoOpera'], $idOpera);
        $messaggio = "Opera " . $idOpera . " eliminata correttamente";
        $messaggioTitolo = "Eliminazione avvenuta";
    }
}

$paginaObj = new paginaWeb("../template/modificaAvvenuta.html", 
                            "{title}", 
                            "", "{title}", false);

$paginaObj->addHTML("{title}", "Modifica opera");
$paginaObj->addHTML("{messaggioTitolo}", $messaggioTitolo);
$paginaObj->addHTML("{messaggioModifica}", $messaggio);

$paginaObj->printPage();