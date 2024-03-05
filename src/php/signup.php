<?php 
require_once("connection.php");
require_once("paginaWeb.php");
require_once "functions.php"; 
use functions\functions;

$dbFunctions = new functions();
$error = "";

$paginaObj = new paginaWeb("../template/signup.html", 
                            "Signup", 
                            "signup registrazione", 
                            "Pagina di registrazione");


if($_SERVER['REQUEST_METHOD'] == "POST"){
	//something was posted
	$user_name = $dbFunctions->pulisciInput($_POST['user_name']);
	$password = $dbFunctions->pulisciInput($_POST['password']);

	if(!empty($user_name) && !empty($password) && !is_numeric($user_name))
	{
		$check_query = "SELECT * FROM utenti WHERE user_name='$user_name'";
		$result = mysqli_query($con, $check_query);
		if($result){
			if(mysqli_num_rows($result) == 0){
				// Username doesn't exist, proceed with insertion
				$insert_query = "INSERT INTO utenti (user_name, password) VALUES ('$user_name', '$password')";
				mysqli_query($con, $insert_query);

				header("Location: login.php");
				exit;
			
			}else{
				$error = "Username già esistente, sceglierne un altro";
			}
		}
        
	}else{
		$error = "Inserire dati validi";
	}
}

$paginaObj->addHTML("{Error}", $error);
$paginaObj->printPage();