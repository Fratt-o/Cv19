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
    include 'UtenteMySqlDao.php';
    include '../config/DAOFactory.php';
    include_once '../Utility/jwtUtility.php';
    use Dao\DAOFactory;
    $data = json_decode(file_get_contents("php://input"));

    $daoFactory = DAOFactory::getDao();
    try {
        $UtenteDao = $daoFactory->getUtenteDao();
        $result = $UtenteDao->isRegistred($data->email,$data->password);
        if($result != null){
            $jwt =  new jwtUtility();

            $token = $jwt->getToken($result);
            $jwtTokenEncoded= $jwt->getEncodeToken($token);
            echo json_encode(
                array(
                    "message" => "Login effettuato.",
                    "jwt" => $jwtTokenEncoded
                )
            );
        }else{
            // set response code
            http_response_code(401);
 
            // tell the user login failed
            echo json_encode(array("message" => "Login fallito."));
        }

    }catch(Exception $E){

            // set response code
            http_response_code(401);
 
            // tell the user login failed
            echo json_encode(array("message" => "Login fallito."));
    }






?>