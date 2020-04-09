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
    include_once '../Utility/validation.php';

    //$data = json_decode(file_get_contents("php://input"));
    $data = (Object)$_POST;
    $daoFactory = DAOFactory::getDao();

    try{
        $UtenteDao = $daoFactory->getUtenteDao();
        $nome = validation::isValidString($data->nome,'nome');
        $user['nome'] = $nome;
        $user['cognome'] = validation::isValidString($data->cognome,'cognome');
        $user['email'] = validation::isEmail($data->email);
        $user['username'] = validation::isValidString( $data->username,'username');
        $psw= validation::isValidPassword( $data->password);
        $user['password'] =password_hash($psw, PASSWORD_BCRYPT);
        

        if($UtenteDao->emailExist($user['email'])==false){
            $user['avatar']= uploadFile($_FILES["file"], $user['email']);
            $UtenteDao->createUser($user);    
            $response["error"] = FALSE;
            echo json_encode($response);
        }else{
            $response["error"] = TRUE;
            $response["error_msg"] = "L'utente è già registrato con la seguente email " . $user['email'];
            http_response_code("200");
            echo json_encode($response);
        }
         
    }catch(Exception $E){
        $response = array();
        $response['error'] = true;
        $response['message'] = $E->getMessage();
        echo json_encode($response);
	}


    function uploadFile($file, $name){
        $avatar = 'http://cv19ing20.altervista.org/Cv19/API/Immagini/user_default.jpeg';
        if(!isset($file)) {
            return $avatar;
        }
        $fileName = $_FILES['file']['name'];
        $fileTmpName  = $_FILES['file']['tmp_name'];
        $exploded = explode('.',$fileName);
        $fileExtension = strtolower(end($exploded));
        $currentDir = getcwd();
        $uploadDir = "$currentDir/../Immagini/Utente";
        $uploadPath = "$uploadDir/$name.$fileExtension";
        
        if (is_dir($uploadDir) && is_writable($uploadDir)) {
             $didUpload = move_uploaded_file($fileTmpName, $uploadPath);
            if ($didUpload) {
                //http://cv19ing20.altervista.org/Cv19/API/Immagini/user_default.jpeg
                $avatar = "http://cv19ing20.altervista.org/Cv19/API/Immagini/Utente/$name.$fileExtension";
            } 
        } 
        return $avatar;
    }



?>