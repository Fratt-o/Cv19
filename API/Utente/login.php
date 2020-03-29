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
require 'Utente.php';

 
// get database connection
$db = new Database();
$db = $db->getConnection();

if (is_null($db))
{
    http_response_code("502");
}
// instantiate user object
$user = new Utente($db);

//Cotrollo se l'email esiste

// get posted data
$data = json_decode(file_get_contents("php://input"));
 
// set user property values
$user->email = $data->email;
$email_exists = $user->emailExists($user->email);

include_once '../config/core.php';
include_once '../libs/php-jwt-master/src/BeforeValidException.php';
include_once '../libs/php-jwt-master/src/ExpiredException.php';
include_once '../libs/php-jwt-master/src/SignatureInvalidException.php';
include_once '../libs/php-jwt-master/src/JWT.php';
use \Firebase\JWT\JWT;

// check if email exists and if password is correct
if($email_exists && password_verify($data->password, $user->password)){
 
    $token = array(
       "iss" => $iss,
       "exp" => 600000,
       "aud" => $aud,
       "iat" => $iat,
       "nbf" => $nbf,
       "data" => array(
           "username" => $user->username,
           "email" => $user->email,
           "avatar" =>$user->avatar
       )
    );
 
    // set response code
    http_response_code(200);
 
    // generate jwt
    $jwt = JWT::encode($token, $key);
    echo json_encode(
            array(
                "message" => "Login effettuato.",
                "jwt" => $jwt
            )
        );
    
    }
    else{
        
        // set response code
        http_response_code(401);
 
        // tell the user login failed
        echo json_encode(array("message" => "Login fallito."));
}   


?>