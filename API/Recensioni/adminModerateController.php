<?php
session_start();
include_once '../config/databaseconnect.php'; 
include_once 'Recensioni.php';
include_once '../config/DAOFactory.php';
include_once '../Recensioni/RecensioniMySqlDao.php';
    
    if($_SESSION['username']==null){
        http_response_code(404);
    }
    try{
        $FactoryDao = DAOFactory::getDao();
        $recensione = $FactoryDao->getRecensioniDao();
        $result = $recensione->readReviewToModerate();
        
        http_response_code(200);

        header("Location: http://cv19ing20.altervista.org/Cv19/BackOffice/ModerationPannel.php");

    }catch(Exception $E){
        http_response_code(404); 
        echo json_encode( array("message" => "Nessuna recensione trovata.") ); 
    }
?>