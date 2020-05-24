<?php
	include_once '../config/databaseconnect.php';
	include_once '../Utente/Utente.php';
	include_once '../Utility/validation.php';
	include_once '../config/DAOFactory.php';
	include_once '../Utente/UtenteMySqlDao.php';
	use Dao\DAOFactory;
	$daoFactory = DAOFactory::getDao();

	try{
		$user['email']=validation::isEmail($_POST['email']);
		$user['psw']=$_POST['psw'];
	
		$UtenteDao = $daoFactory->getUtenteDao();
        $result = $UtenteDao->isAdmin($user['email'],$user['psw']);
		if($result != null){
			
			if(!session_id()) session_start();
			
			$_SESSION['username']= $result->username;
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