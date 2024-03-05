<?php 
	require_once("paginaWeb.php");
	require_once("connection.php");
	require_once "functions.php"; 
	use functions\functions;
	$connection = new functions(); 
	$connectionOk = $connection->openDBConnection(); 

	session_start(); //Perchè devo fare if prima di costruttore

	if(isset($_SESSION['user_name'])){
		if($_SESSION['user_name'] == "admin"){ //Admin
			//Aggiungi opere
			$paginaObj = new paginaWeb("../template/dashboard.html", "Dashboard", "dashboard, area personale", "Area privata admin");
			$paginaObj->addHTML("{userName}", $_SESSION['user_name']);
			$paginaObj->addHTML("{verbo}", "ricevute");
			$paginaObj->addHTML("{contattiTitolo}", "<h2>Contatti ricevuti</h2>");
			$paginaObj->addHTML("{bottoneCarta}", "<a href=\"newCarta.php\" class=\"bottonedash\">Aggiungi nuova opera Carta</a>"); //Modificare qui classe bottone
			$paginaObj->addHTML("{bottoneQuadri}", "<a href=\"newOpera.php\" class=\"bottonedash\">Aggiungi nuova opera Tela</a>");

			$messaggi = $connection->getPrenotazioni(null); 
			if($messaggi != null){
				$listaMessaggi="";
				foreach($messaggi as $row){
					$listaMessaggi .= file_get_contents("../template/messaggioDashboard.html");

					$listaMessaggi = str_replace("{user}", $row['user_id'], $listaMessaggi);
					$listaMessaggi = str_replace("{idEncoded}", urlencode($row['opera_id']), $listaMessaggi);
					$listaMessaggi = str_replace("{idUnencoded}", $row['opera_id'], $listaMessaggi);
					$listaMessaggi = str_replace("{data}", $row['data_inserimento'], $listaMessaggi);
					$listaMessaggi = str_replace("{messaggio}", $row['messaggio'], $listaMessaggi);
					$listaMessaggi = str_replace("{cell}", "", $listaMessaggi);
				}
				$paginaObj->addHTML("{messaggi}", $listaMessaggi);
			}else
				$paginaObj->addHTML("{messaggi}", "Non hai ancora ricevuto nessun messaggio");


			$contatti = $connection->getMessaggi();
			if($contatti != null) {
				$listaMessaggi="";
				foreach($contatti as $row){
					$listaMessaggi .= file_get_contents("../template/contattoDashboard.html");

					$listaMessaggi = str_replace("{idEncoded}", "", $listaMessaggi);
					$listaMessaggi = str_replace("{idUnencoded}", "", $listaMessaggi);
					$listaMessaggi = str_replace("{user}", $row['cognome']." ".$row['nome'], $listaMessaggi);
					$listaMessaggi = str_replace("{cell}", $row['telefono'], $listaMessaggi);
					$listaMessaggi = str_replace("{data}", $row['data_inserimento'], $listaMessaggi);
					$listaMessaggi = str_replace("{messaggio}", $row['testo_libero'], $listaMessaggi);
				}
				$paginaObj->addHTML("{contatti}", $listaMessaggi);
			}else
				$paginaObj->addHTML("{contatti}", "Non sei ancora stato contattato");
		}else{	//User
			$paginaObj = new paginaWeb("../template/dashboard.html", "Dashboard", "dashboard, area personale", "Area privata user");
			$paginaObj->addHTML("{userName}", $_SESSION['user_name']);
			$paginaObj->addHTML("{verbo}", "inviate");
			$paginaObj->addHTML("{contattiTitolo}", "");
			$paginaObj->addHTML("{contatti}", "");
			$paginaObj->addHTML("{bottoneCarta}", "");
			$paginaObj->addHTML("{bottoneQuadri}", "");
			
			$messaggi = $connection->getPrenotazioni($_SESSION['user_name']); 

			if($messaggi != null){
				$listaMessaggi="";
				foreach($messaggi as $row){
					$listaMessaggi .= file_get_contents("../template/messaggioDashboard.html");

					$listaMessaggi = str_replace("{user}", "", $listaMessaggi);
					$listaMessaggi = str_replace("{cell}", "", $listaMessaggi);

					
					$listaMessaggi = str_replace("{idEncoded}", urlencode($row['opera_id']), $listaMessaggi);
					$listaMessaggi = str_replace("{idUnencoded}", $row['opera_id'], $listaMessaggi);
					$listaMessaggi = str_replace("{data}", $row['data_inserimento'], $listaMessaggi);
					$listaMessaggi = str_replace("{messaggio}", $row['messaggio'], $listaMessaggi);
				}
				$paginaObj->addHTML("{messaggi}", $listaMessaggi);
				$paginaObj->addHTML("{contatti}", "");
			}else
				$paginaObj->addHTML("{messaggi}", "Non hai ancora inviato nessun messaggio");
		}
	}
	else
		$paginaObj = new paginaWeb("../errors/errore403.html", "Errore 403 - Pagina non trovata", "", "Pagina di errore 403");

    $paginaObj->printPage();