<?php
/*
Il costruttore genera la pagina statica per ogni pagina template le venga passata, non fa la stampa già nel costruttore perchè potrebbero essere necessarie alcune azioni specifiche (php), quindi
è delegato alla pagina chiamante la stampa
Non serve distruttore grazie al garbage collector di php
*/
use functions\functions;

class paginaWeb{
    private $strutturaHTML = "";
    public $testoFooter = "Sandra Bertocco - 2024";

    //Costruttore
    //Parametri: link alla pagina template con contenuto, titolo della pagina, keywords, descrizione
    public function __construct($pagina, $titoloPagina, $keywords, $description, bool $navBool=true){ 
        if (session_status() == PHP_SESSION_NONE)
            session_start();

        $paginaTemplate = file_get_contents($pagina);
        $this->strutturaHTML = file_get_contents("../template/generalTemplate.html"); //strutturaHTML ora contiene l'HTML di generalTemplate (il template generale)

        $this->strutturaHTML = str_replace("{titoloPagina}", $titoloPagina , $this->strutturaHTML);                 //Sostituisce segnaposto titolo
        $this->strutturaHTML = str_replace("{metaKeywords}", "Sandra Bertocco,".$keywords , $this->strutturaHTML);  //Sostituisce segnaposto keywords 
        $this->strutturaHTML = str_replace("{metaDescription}", $description , $this->strutturaHTML);               //Sostituisce segnaposto description
        if($navBool == true)
            $this->strutturaHTML = str_replace("{navBar}", $this->printNavBar($pagina) , $this->strutturaHTML);         //Sostituzione segnaposto navBar
        else
            $this->strutturaHTML = str_replace("{navBar}", "<p>Torna ad <a href=\"dashboard.php\">area riservata</a></p>" , $this->strutturaHTML);
	    $this->strutturaHTML = str_replace("{testoFooter}", $this->testoFooter, $this->strutturaHTML);              //Sostituzione segnaposto testoFooter

        if($pagina != "../template/contatti.html")
            $this->strutturaHTML = str_replace("{script}", "", $this->strutturaHTML);
        
        //Sostituzione contenuto principale con il segnaposto main
        $this->strutturaHTML = str_replace("{contenutoMain}", $paginaTemplate, $this->strutturaHTML);
    }

    public function addHTML($segnaposto, $dati){
        $this->strutturaHTML = str_replace($segnaposto, $dati, $this->strutturaHTML);
    }

    public function getHTML(){
        return $this->strutturaHTML;
    }

    public function printPage(){
        echo $this->strutturaHTML;
    }

    public function printNavBar($currentPage=null){
        $pagina = file_get_contents("../template/navBarTemplate.html"); 

        $breadcrump = "Ti trovi in: ";

        $homeCliccato = "";
        $opereCliccato = "";
        $galleriaCliccato = "";
        $biografiaCliccato = "";
        $contattiCliccato = "";
        $registratiCliccato = "";
        $accediCliccato = "";
        $dashboardCliccato ="";

        $homeLogo = "<a href=\"index.php\"><img src=\"../assets/icon.png\" alt=\"Logo Sandra Bertocco\"></a>";

        $homePath = "<a href=\"index.php\"><span lang=\"en\">Home</span></a>";
        $operePath = "<a href=\"opere.php\">Opere</a>";
        $galleriaPath = "<a href=\"galleria.php\">Galleria</a>";
        $biografiaPath = "<a href=\"biografia.php\">Biografia</a>";
        $contattiPath = "<a href=\"contatti.php\">Contatti</a>";
        $dashboardPath = "<a href=\"dashboard.php\">Area personale</a>";
        
        $logoutPath = "<a href=\"logout.php\">Logout</a></li>";
        $registratiPath= "<a href=\"signup.php\">Registrati</a>";
        $accediPath= "<a href=\"login.php\">Accedi</a>";

        if($currentPage == "../template/index.html"){//Se sono in home
            $breadcrump .= "<span lang=\"en\">Home</span>";
            $homeCliccato = "cliccato";
            $homePath = "Home";
            $homeLogo = "<img src=\"../assets/icon.png\" alt=\"Logo Sandra Bertocco\"></img>";

        }else if($currentPage == "../template/opere.html"){//Se sono in opere
            $breadcrump .= "Opere";
            $opereCliccato = "cliccato";
            $operePath = "Opere";

        }else if($currentPage == "../template/listaOpereTemplate.html" || $currentPage == "../template/operaTemplate.html"){
            $breadcrump .= "<a href=\"opere.php\">Opere</a> >> ";

            if (isset($_GET['tipoOpera'])){
                if($currentPage == "../template/operaTemplate.html"){
                    if($_GET['tipoOpera'] == "quadro")
                        $breadcrump .= "<a href=\"listaOpere.php?tipoOpera=quadro\">opere su tela</a>";
                    else if($_GET['tipoOpera'] == "carta")
                        $breadcrump .= "<a href=\"listaOpere.php?tipoOpera=carta\">opere su carta</a>";

                    $breadcrump .= " >> ".$_GET['idOpera'];
                }else{
                    if($_GET['tipoOpera'] == "quadro")
                        $breadcrump .= "opere su tela";
                    else if($_GET['tipoOpera'] == "carta")
                        $breadcrump .= "opere su carta";
                }
            }
                
            $opereCliccato = "cliccato";
            $operePath = "Opere";
            
        }else if($currentPage == "../template/galleria.html"){//Se sono in galleria
            $breadcrump .= "Galleria";
            $galleriaCliccato = "cliccato";
            $galleriaPath = "Galleria";

        }else if($currentPage == "../template/biografia.html"){//Se sono in biografia
            $breadcrump .= "Biografia";
            $biografiaCliccato = "cliccato";
            $biografiaPath = "Biografia";

        }else if($currentPage == "../template/contatti.html"){//Se sono in contatti
            $breadcrump .= "Contatti";
            $contattiCliccato = "cliccato";
            $contattiPath = "Contatti";

        }else if($currentPage == "../template/signup.html"){
            $breadcrump .= "Registrati";
            $registratiCliccato = "cliccato";
            $registratiPath = "Registrati";

        }else if($currentPage == "../template/login.html"){
            $breadcrump .= "Accedi";
            $accediCliccato = "cliccato";
            $accediPath = "Accedi";

        }else if($currentPage == "../template/dashboard.html"){
            $breadcrump .= "Area personale";
            $dashboardCliccato = "cliccato";
            $dashboardPath = "Area personale";
            
        }else if($currentPage == "../template/gallerie/resilienza.html"){
            $breadcrump .= "<a href=\"galleria.php\">Galleria</a> >> Resilienza";
            $galleriaCliccato = "cliccato";
            $galleriaPath = "Galleria";

        }else if($currentPage == "../template/gallerie/pensieri_liquidi.html"){
            $breadcrump .= "<a href=\"galleria.php\">Galleria</a> >> Pensieri Liquidi";
            $galleriaCliccato = "cliccato";
            $galleriaPath = "Galleria";
            
        }else if($currentPage == "../template/gallerie/artefiera_cremona.html"){
            $breadcrump .= "<a href=\"galleria.php\">Galleria</a> >> ArteFiera Cremona";
            $galleriaCliccato = "cliccato";
            $galleriaPath = "Galleria";
            
        }else if($currentPage == "../template/gallerie/attraverso_il_colore.html"){
            $breadcrump .= "<a href=\"galleria.php\">Galleria</a> >> Attraverso il Colore";
            $galleriaCliccato = "cliccato";
            $galleriaPath = "Galleria";
            
        }else if($currentPage == "../template/gallerie/un_astrazione_possibile.html"){
            $breadcrump .= "<a href=\"galleria.php\">Galleria</a> >> Un'Astrazione Possibile";
            $galleriaCliccato = "cliccato";
            $galleriaPath = "Galleria";
            
        }else{
            $breadcrump = "";
        }

        if(isset($_SESSION['user_name']) && $_SESSION['user_name'] == "admin")
            $contattiPath = "";

            
        $registratiPath = "<li class=\"".$registratiCliccato."\">$registratiPath</li>";
        $accediPath = "<li class=\"".$accediCliccato."\">$accediPath</li>";
        $dashboardPath = "<li class=\"".$dashboardCliccato."\">".$dashboardPath."</li>";

        if(isset($_SESSION['user_name']) && !empty($_SESSION['user_name'])){//Se la sessione è già attiva
            $registratiPath = $accediPath  = "";
        }else{
            $dashboardPath = $logoutPath = "";
        }

        $pagina = str_replace("{registrati}", $registratiPath, $pagina);
        $pagina = str_replace("{accedi}", $accediPath, $pagina);
        $pagina = str_replace("{dashboard}", $dashboardPath, $pagina);
        $pagina = str_replace("{logout}", $logoutPath, $pagina);

        $pagina = str_replace("{breadcrump}", $breadcrump, $pagina);
        
        $pagina = str_replace("{homeCliccato}", $homeCliccato, $pagina); 
        $pagina = str_replace("{opereCliccato}", $opereCliccato, $pagina);
        $pagina = str_replace("{galleriaCliccato}", $galleriaCliccato, $pagina);
        $pagina = str_replace("{biografiaCliccato}", $biografiaCliccato, $pagina);
        $pagina = str_replace("{contattiCliccato}", $contattiCliccato, $pagina);
        $pagina = str_replace("{accediCliccato}", $accediCliccato, $pagina);
        $pagina = str_replace("{registratiCliccato}", $registratiCliccato, $pagina);
        $pagina = str_replace("{dashboardCliccato}", $dashboardCliccato, $pagina);
        
        $pagina = str_replace("{homeLogo}", $homeLogo, $pagina);
        $pagina = str_replace("{homePath}", $homePath, $pagina);
        $pagina = str_replace("{operePath}", $operePath, $pagina);
        $pagina = str_replace("{galleriaPath}", $galleriaPath, $pagina);
        $pagina = str_replace("{biografiaPath}", $biografiaPath, $pagina);
        $pagina = str_replace("{contattiPath}", $contattiPath, $pagina);

        return $pagina;
    }


    public function getOperaSingola(){
        $connection = new functions(); 
        $connectionOk = $connection->openDBConnection(); 
        $modifiche = "";

        if($connectionOk){
            if (isset($_GET['tipoOpera']) && isset($_GET['idOpera'])) {// Verifica se i parametri idOpera e secondoParametro sono presenti nell'URL
                //Da aggiungere sanificazione dei parametri per prevenire attacchi di injection
                $tipoOpera = $_GET['tipoOpera'];
                $idOpera = urldecode($_GET['idOpera']);

                $modifiche = $connection->getOpera($tipoOpera, $idOpera);

                if($modifiche != null){
                    $modificheFoto = $modifiche['path'] . ".jpg";
                    $modificheTitolo = ($modifiche['titolo'] == NULL ? "Senza titolo" : $modifiche['titolo']);
                    $modificheTecnica = $modifiche['tecnica'];
                    $modificheData = $modifiche['data'];
                    
                    $modificheDescrizione = $modifiche['descrizione'];    
                    
                    if(isset($_SESSION['user_name']) && $_SESSION['user_name'] === "admin"){ //Se sono admin
                        $bottone = "<a href=\"formModifica.php?tipoOpera={$tipoOpera}&idOpera={$idOpera}\" id=\"bottonePrenotazione\" role=\"button\">Modifica opera</a>";
                        $tipoOpera=="quadro" && $modifiche['proprietario'] != NULL ? $modificheProprietario="Proprietario: ".($modifiche['proprietario']) : $modificheProprietario = ("Opera senza proprietario");
                    }else{  //Se non sono admin
                        if(isset($modifiche['proprietario']) && $modifiche['proprietario'] != NULL){ //Se ha proprietario
                            $modificheProprietario = "Proprietario: ".($modifiche['proprietario']);
                            $bottone = "";
    
                        }else{ //Se non ha proprietario
                            $modificheProprietario = ("Opera senza proprietario");
                            $tipoOpera=="carta" ?  $bottone="Non in vendita" : $bottone = "<a href=\"formPrenotazione.php?tipoOpera={$tipoOpera}&idOpera={$idOpera}\" id=\"bottonePrenotazione\" role=\"button\">Prenota opera</a>";
                        }
                    }

                    if($tipoOpera == "quadro"){
                        $modificheDescrizione .= "<p>Dimensioni: " .$modifiche['altezza']."x".$modifiche['larghezza']."</p>";
                    }
                    $this->strutturaHTML = str_replace("{fotoOpera}", $modificheFoto, $this->strutturaHTML); 
                    $this->strutturaHTML = str_replace("{titoloOpera}", $modificheTitolo, $this->strutturaHTML); 
                    $this->strutturaHTML = str_replace("{tecnicaOpera}", $modificheTecnica, $this->strutturaHTML); 
                    $this->strutturaHTML = str_replace("{dataOpera}", $modificheData, $this->strutturaHTML); 
                    $this->strutturaHTML = str_replace("{descrizioneOpera}", $modificheDescrizione, $this->strutturaHTML);
                    $this->strutturaHTML = str_replace("{proprietario}", $modificheProprietario, $this->strutturaHTML);
                    $this->strutturaHTML = str_replace("{bottonePrenotazione}", $bottone, $this->strutturaHTML);
                    return;
                }else{
                    $modifiche = "<p>Si è verificato un errore, ripetere l'operazione sull'opera desiderata</p>";
                }
            }else{
                $modifiche = "<p>Si è verificato un errore di connessione, riprovare</p>"; // da aggiustare
            }

            $connection->closeConnection(); 
        }else{
            $modifiche ="<p>I sistemi sono momentaneamente fuori servizio, ci scusiamo per il disagio.</p>";// da aggiustare
        }
    
        $this->strutturaHTML = str_replace("{titoloOpera}", $modifiche, $this->strutturaHTML);
        $this->strutturaHTML = str_replace("{fotoOpera}", "", $this->strutturaHTML);
        $this->strutturaHTML = str_replace("{tecnicaOpera}", "", $this->strutturaHTML);
        $this->strutturaHTML = str_replace("{dataOpera}", "", $this->strutturaHTML);
        $this->strutturaHTML = str_replace("{descrizioneOpera}", "", $this->strutturaHTML);
        $this->strutturaHTML = str_replace("{bottonePrenotazione}", "", $this->strutturaHTML);
        $this->strutturaHTML = str_replace("{proprietario}", "", $this->strutturaHTML);

    }
}
