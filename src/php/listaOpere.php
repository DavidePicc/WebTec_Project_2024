<?php
require_once "functions.php"; 
require_once("paginaWeb.php");
use functions\functions;

ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);
setlocale(LC_ALL, 'it_IT');

$paginaObj = new paginaWeb("../template/listaOpereTemplate.html", "Opere", 
                            "Lista opere di Sandra Bertocco, pittrice di Padova, acrilico su tela, tempera, acquerello, guazzo",
                            "Lista opere di Sandra Bertocco");

$paginaObj->addHTML("{tecnica}", ucfirst(getTecnica())); //ucfirst = prima lettera maiuscola
$paginaObj->addHTML("{opere}", printListaOpere());

$paginaObj->printPage();

function getTecnica(){
    $connection = new functions(); 
    $connectionOk = $connection->openDBConnection(); 

    if($connectionOk){
        if (isset($_GET['tipoOpera'])){
            $tipoOpera = $_GET['tipoOpera'];
            if($tipoOpera == "quadro")
                $tipoOpera = "Quadri";
            else if($tipoOpera == "tela")
                $tipoOpera = "Opere su tela";
        }
    }else{
        $tipoOpera ="<p>I sistemi sono momentaneamente fuori servizio, ci scusiamo per il disagio.</p>";
    }

    $connection->closeConnection(); 
    return $tipoOpera;
}
function printListaOpere(){
    $stringaOpere = "";
    $listaOpere = "";   

    $connection = new functions(); 
    $connectionOk = $connection->openDBConnection(); 

    if($connectionOk){
        if (isset($_GET['tipoOpera'])){
            //Da aggiungere sanificazione dei parametri per prevenire attacchi di injection
            $tipoOpera = $_GET['tipoOpera'];

            if($tipoOpera == 'quadro'){
                $listaOpere = $connection->getQuadri(); 

                if($listaOpere != null){

                    foreach( $listaOpere as $row){
                        //SEtto le dimensioni del quadro a seconda della sua tipologia di dimensione
                        $width = sqrt($row['larghezza']);
                        if ($row['altezza'] > $row['larghezza']) {
                            $width = sqrt($row['altezza']) / $row['altezza'] * $row['larghezza'];
                        }

                        $width= $width*40;
                        
                        $paginaHTML = file_get_contents("../template/templateListaOpere.html");
                       
                        $data= $row['data'];
                        $path= $row['path'];
                        $tecnica= $row['tecnica'];
                        $altezza= $row['altezza'];
                        $larghezza= $row['larghezza'];
                        $titolo= $row['titolo'];
                        
                        $paginaHTML = str_replace("{titolo}", $titolo, $paginaHTML);
                        $paginaHTML = str_replace("{tecnica}", $tecnica, $paginaHTML);
                        $paginaHTML = str_replace("{data}", $data, $paginaHTML);
                        $paginaHTML = str_replace("{path}", $path, $paginaHTML);
                        $paginaHTML = str_replace("{larghezza}", $larghezza, $paginaHTML);
                        $paginaHTML = str_replace("{altezza}", $altezza, $paginaHTML);
                        $paginaHTML = str_replace("{width}", $width, $paginaHTML);

                        $encodeTitolo = urlencode($titolo);
                        $paginaHTML = str_replace("{encodeTitolo}", $encodeTitolo, $paginaHTML);

                        $stringaOpere .= $paginaHTML;
                    }                            
                }else{
                    $stringaOpere .= "<li>Non ci sono opere al momento</li>";
                }
            }else if($tipoOpera == "carta"){
                $listaOpere = $connection->getCarta(); 

                if($listaOpere != null){

                 
                    foreach( $listaOpere as $row){
                        $paginaHTML = file_get_contents("../template/templateListaCarta.html");
                       
                        $data= $row['data'];
                        $path= $row['path'];
                        $tecnica= $row['tecnica'];

                        if ($row['titolo'] !== null) {
                            
                            $titolo= $row['titolo'];
                        } else {
                            
                            $titolo= "opera senza titolo";
                        }
                        $paginaHTML = str_replace("{titolo}", $titolo, $paginaHTML);
                        $paginaHTML = str_replace("{tecnica}", $tecnica, $paginaHTML);
                        $paginaHTML = str_replace("{data}", $data, $paginaHTML);
                        $paginaHTML = str_replace("{path}", $path, $paginaHTML);

                        $encodePath = urlencode($path);
                        $paginaHTML = str_replace("{encodePath}", $encodePath, $paginaHTML);

                        $stringaOpere .= $paginaHTML;
                    }
                }else{
                    $stringaOpere .= "<li>Non ci sono opere al momento</li>";
                }
            }
        }
    }else{
        $stringaOpere ="<p>I sistemi sono momentaneamente fuori servizio, ci scusiamo per il disagio.</p>";
    }

    $connection->closeConnection(); 
    return $stringaOpere;
}

    