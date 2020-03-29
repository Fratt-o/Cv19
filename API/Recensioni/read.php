<?php

include_once '../config/databaseconnect.php'; 
include_once '../Struttura/Struttura.php'; 
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
    $stmt = $recensione->read();
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
    
