<?php
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
header("Access-Control-Allow-Methods: HEAD, GET, POST, PUT, PATCH, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method,Access-Control-Request-Headers, Authorization");
header('Content-Type: application/json');

$method = $_SERVER['REQUEST_METHOD'];
if ($method == "OPTIONS") {
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method,Access-Control-Request-Headers, Authorization");
    header("HTTP/1.1 200 OK");
    die();
}
include_once '../config/databaseconnect.php'; 
include_once 'Recensioni.php';
include_once '../config/DAOFactory.php';
include_once '../Recensioni/RecensioniMySqlDao.php';

    try{
        $FactoryDao = DAOFactory::getDao();
        $recensione = $FactoryDao->getRecensioniDao();
        $result = $recensione->readReviewToModerate();
    
        http_response_code(200); 
        echo json_encode($result); 
        header("Location: http://cv19ing20.altervista.org/Cv19/BackOffice/ModerationPannel.php");

    }catch(Exception $E){
        http_response_code(404); 
        echo json_encode( array("message" => "Nessuna recensione trovata.") ); 
    }
?>