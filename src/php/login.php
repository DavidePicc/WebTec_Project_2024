<?php 
	require_once("connection.php");
	require_once("paginaWeb.php");
	require_once "functions.php"; 
	use functions\functions;

	$dbFunctions = new functions();
	$error = "";
	
	$paginaObj = new paginaWeb("../template/login.html", 
								"Login", 
								"Login - accesso", 
								"Pagina di login");

	if($_SERVER['REQUEST_METHOD'] == "POST"){
		//something was posted
		$user_name = $dbFunctions->pulisciInput($_POST['user_name']);
		$password = $dbFunctions->pulisciInput($_POST['password']);

		if(!empty($user_name) && !empty($password) && !is_numeric($user_name)){

			$query = "SELECT * FROM utenti WHERE user_name = '$user_name'"; //Reminder: username sarà unico
			$result = mysqli_query($con, $query);

			if($result){
				if(mysqli_num_rows($result) > 0){

					$user_data = mysqli_fetch_assoc($result);
					
					if($user_data['password'] === $password){ //Se login funziona inizio la sessione
						$_SESSION['user_id'] = $user_data['id'];
						$_SESSION['user_name'] = $user_data['user_name'];

						header("Location: dashboard.php");
						exit;
					}
				}else{
					$error = "Si è verificato un'errore, riprovare la procedura di login";
				}
			}
			$error = "Nome utente o password errati!";
		}else{
			$error = "Nome utente o password mancanti!";
		}
	}

$paginaObj->addHTML("{Error}", $error);
$paginaObj->printPage();
