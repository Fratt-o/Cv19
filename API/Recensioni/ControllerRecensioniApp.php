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

    include_once('../config/DAOFactory.php');
    include_once('../Recensioni/RecensioniMySqlDao.php');
    include_once('../Utility/validation.php');
    include_once('../Utility/jwtUtility.php');

    $requestType = $_SERVER['REQUEST_METHOD'];
 
    switch ($requestType) {
        case 'POST':
          doPost();  
          break;
        case 'GET':
          doGet();  
          break;
        default:
            break;
    }
    function doGet(){
        try{
            $factoryDao = DAOFactory::getDao();
            $recensioniDao= $factoryDao->getRecensioniDao();
            $idStruttura = $_GET["idStruttura"];
            $result = $recensioniDao->readAllReview($idStruttura);
           
            
            http_response_code(200); 
            echo json_encode($result); 
            
        }catch(Exception $E){

        }

    }

    function doPost(){

        echo "richiesta post";
    }







?>