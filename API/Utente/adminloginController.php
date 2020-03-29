<?php
	include_once '../config/databaseconnect.php';
	include_once '../Utente/Utente.php';

	try{
		$database = new Database(); 
	    $db = $database->getConnection();
	}catch(Exception $E){
		http_response_code(503);
		echo "Errore di Connessione al BD";
	}

	try{
		$user['email']=$_POST['email'];
		$user['psw']=$_POST['psw'];
	
		$utente = new Utente($db);
		
		$result = $utente->isAdmin($user['email']);
		if($result == true  && password_verify($user['psw'],$utente->password)){
			
			
			if(!session_id()) session_start();
			
			$_SESSION['username']= $utente->username;
			header("Location: http://cv19ing20.altervista.org/Cv19/BackOffice/adminPannel.php");

		} else {
			http_response_code(403);
			echo "Non c'è un account";
		}
	}catch(Exception $E){
		http_response_code(500);
		echo "Errore Query";
	}
	

?>