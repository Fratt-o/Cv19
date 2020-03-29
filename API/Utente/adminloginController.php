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
	try {
		$user['email']=filter_input($_POST['email'],FILTER_VALIDATE_EMAIL);
		$user['psw']=filter_input($_POST['psw'],FILTER_DEFAULT);
		if(empty($user['email'])&& empty($user['psw'])){
			http_response_code(400);
			echo "Errore valori non inizializzati";
		}
	} catch (Exception $E){
		http_response_code(403);
		echo "Errore Forbidden Data";
	}

	try{
		$utente = new Utente($db);
		$user['psw']=password_hash($user['psw'],PASSWORD_DEFAULT);
		$result = $utente->isAdmin($user);
		if($result->rowCount() > 0){
			
			$row= $result->fetch_assoc();
			if(!session_id()) session_start();
			
			$_SESSION['username']= $row['username'];
			header("Location: http://cv19ing20.altervista.org/BackOffice/adminPannel.php");

		} else {
			http_response_code(403);
			echo "invalid Param";
		}
	}catch(Exception $E){
		http_response_code(500);
		echo "Errore Query";
	}
	

?>