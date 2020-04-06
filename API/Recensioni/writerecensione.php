<?php
header("Access-Control-Allow-Origin: http://cv19ing20.altervista.org/");
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
include '../config/databaseconnect.php';
require 'Recensioni.php';

// get database connection
try{
    $db = new Database();
    $db = $db->getConnection();
}catch(Exception $E){
    http_response_code("502");
    echo json_encode(array("message"=>"errore connessione al db"));
}
// instantiate user object
$recensioni = new Recensioni($db);

//Cotrollo se l'email esiste

// get posted data
$review = json_decode(file_get_contents("php://input"));


//JWT
include_once '../config/core.php';
include_once '../libs/php-jwt-master/src/BeforeValidException.php';
include_once '../libs/php-jwt-master/src/ExpiredException.php';
include_once '../libs/php-jwt-master/src/SignatureInvalidException.php';
include_once '../libs/php-jwt-master/src/JWT.php';
use \Firebase\JWT\JWT;

$jwt = getBearerToken();

// Non mi è arrivato il token
if(!isset($jwt)) {
    // set response code
    http_response_code(401);
 
    // tell the user login failed
    echo json_encode(array("error" =>  true, "data" => array(),  "message" => "Missing jwt authorization header"));
    exit();
}


// è arrivato il token, ma non è valido


try {
	$decodedToken = JWT::decode($jwt, $key, array('HS256'));
} catch(Exception $ex) {
	http_response_code(401);
 
    // tell the user login failed
    echo json_encode(array("error" =>  true, "data" => array(),  "message" => "Invalid jwt"));
    exit();
}


if(!isset($decodedToken)) {
    // set response code
    http_response_code(401);
 
    // tell the user login failed
    echo json_encode(array("error" =>  true, "data" =>  array(),  "message" => "Invalid jwt."));
    exit();
}



if (strlen($review->titolo)>2 && strlen($review->titolo)<50 && strlen($review->testo)<255 ){

    /*
        Verificare validità JWT così da recuperare fkutente
        Se jwt non valido: 401
    */
    $review->fkutente = $decodedToken->data->email;
    $review->fkstruttura = $review->struttura;
    $nomeCompleto = $decodedToken->data->nome.' '.$decodedToken->data->cognome;
	$review->nomeMostrato = $review->mostraUsername ? $decodedToken->data->username : $nomeCompleto; 
    
    http_response_code(200);
    
    // generate jwt
    try{ 
        $result=$recensioni->create($review);
        http_response_code(200);
 
		echo json_encode(array("error" =>  false, "data" => array()));
        }catch(Exception $ex){
            http_response_code(400);
            echo json_encode(array("message "=> $ex->getMessage().": errore nella creazione della recensione"));
        }
    
    
    
}

else{
        
        // set response code
        http_response_code(401);
 
        // tell the user login failed
        echo json_encode(array("message" => "Manca qualcosa, ricontrolla la recensione."));
}   


/** 
 * Get header Authorization
 * */
function getAuthorizationHeader(){
    $headers = null;
    if (isset($_SERVER['Authorization'])) {
        $headers = trim($_SERVER["Authorization"]);
    }
    else if (isset($_SERVER['HTTP_AUTHORIZATION'])) { //Nginx or fast CGI
        $headers = trim($_SERVER["HTTP_AUTHORIZATION"]);
    } elseif (function_exists('apache_request_headers')) {
        $requestHeaders = apache_request_headers();
        // Server-side fix for bug in old Android versions (a nice side-effect of this fix means we don't care about capitalization for Authorization)
        $requestHeaders = array_combine(array_map('ucwords', array_keys($requestHeaders)), array_values($requestHeaders));
        //print_r($requestHeaders);
        if (isset($requestHeaders['Authorization'])) {
            $headers = trim($requestHeaders['Authorization']);
        }
    }
    return $headers;
}
/**
* get access token from header
* */
function getBearerToken() {
$headers = getAuthorizationHeader();
// HEADER: Get the access token from the header
if (!empty($headers)) {
    if (preg_match('/Bearer\s(\S+)/', $headers, $matches)) {
        return $matches[1];
    }
}
return null;
}