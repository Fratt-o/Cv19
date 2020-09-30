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
include_once '../Caratteristiche/Caratteristica.php'; 
use DatabaseCon\Database;
use Model\Caratteristica;
$database = new Database(); 
$db = $database->getConnection(); 
$caratteristica = new caratteristica($db);

//$queryModel = json_decode(file_get_contents("php://input"));


$stmt = $caratteristica->read($queryModel);
$rowCount = $stmt->rowCount();

if($rowCount > 0) {
	$risposta = array();
	
	$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
	$risposta['data'] = $row;
	$risposta['error'] = false;
	http_response_code(200); 
	echo json_encode($risposta); 
} else {
	$risposta['data'] = array();
	$risposta['error'] = false;
	http_response_code(200); 
	echo json_encode($risposta); 
}

    

?>

