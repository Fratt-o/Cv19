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

try{
    $database = new Database(); 
    $db = $database->getConnection();
}
catch (Exception  $E){
    http_response_code(400);
    echo json_encode(array("message"=>"errore connessione al db"));
}  
$recensione = new Recensioni($db);
try{
	$idStruttura = $_GET["idStruttura"];	
    $stmt = $recensione->read($idStruttura);
}catch(Exception $E){
    http_response_code(400);
    echo json_encode(array("message"=>"errore ricerca recensioni db"));
}
$num = $stmt->rowCount(); 
if($num>0){ 
	$stutt_arr= array();
    $strutt_arr['lista'] = array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){ 
    	array_push($strutt_arr['lista'],$row);       
    }
    http_response_code(200); 
    echo json_encode($strutt_arr); 
    }
   else { 
       http_response_code(404); 
       echo json_encode( array("message" => "Nessuna recensione trovata.") ); 
       
   }
    
