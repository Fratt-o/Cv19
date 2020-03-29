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


if (strlen($review->titolo)>2 && strlen($review->titolo)<50 && strlen($review->testo)<255 ){
    
    $token = array(
       "iss" => $iss,
       "exp" => 600000,
       "aud" => $aud,
       "iat" => $iat,
       "nbf" => $nbf,
       "review" => array(
           
           "titolo" => $review->titolo,
           "testo" =>$review->testo,
           "fkutente" => $review->fkutente,
           "voto" => $review->voto
       )
    );
    
    http_response_code(200);
    
    // generate jwt
    try{ 
        $result=$recensioni->create($review);
        $jwt = JWT::encode($token, $key);
        echo json_encode(
                array(
                 "message" => "Recensione inviata, in attesa di conferma.",
                 "jwt" => $jwt,
                 "risultato" => $result
             )
            );
        }catch(Exception $E){
            http_response_code(400);
            echo json_encode(array("message "=> "errore nella creazione della recensione"));
        }
    
    
    
}

else{
        
        // set response code
        http_response_code(401);
 
        // tell the user login failed
        echo json_encode(array("message" => "Manca qualcosa, ricontrolla la recensione."));
}   