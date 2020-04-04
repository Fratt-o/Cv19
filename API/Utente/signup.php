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
require 'Utente.php';

 /**
 User Registeration
 */
 // get database connection
$database = new Database();
$db = $database->getConnection();

$register=new Utente($db);
 
// json response array
$response = array("error" => FALSE);

// $data = json_decode(file_get_contents("php://input"));


$data = $_POST;

if (isset($data)){
/*if (isset(filter_input(INPUT_POST, $email, FILTER_VALIDATE_EMAIL)) && isset(filter_input(INPUT_POST, $nome, FILTER_SANITIZE_STRING)) && 
        isset(filter_input(INPUT_POST, $cognome, FILTER_SANITIZE_STRING)) && isset(filter_input(INPUT_POST, $password)) &&
        isset(filter_input(INPUT_POST, $username))) {*/
 
    // receiving the post params
	
	/*$nome = $data->nome;
	$cognome = $data->cognome;
	$email = $data->email;
	$username = $data->username;
	$password = $data->password;*/
	
	$nome = $data["nome"];
	$cognome = $data["cognome"];
	$email = $data["email"];
	$username = $data["username"];
	$password = $data["password"];
	



	//VALIDARE I DATI IN INGRESSO CORRETTAMENTE 
	
   /* if (ctype_alpha(str_replace(' ', '', "nome")) === false) {
        if((preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', "nome"))){
            $errors[] = 'Il nome può contenere solo lettere o spazi.';
             http_response_code("406");       
        }
       }
    else{
        $nome = filter_input(INPUT_POST, $nome, FILTER_SANITIZE_STRING);       
    }
	$cognome= filter_input(INPUT_POST, 'cognome', FILTER_SANITIZE_STRING);
    if (ctype_alpha(str_replace(' ', '', $cognome)) === false) {
        if((preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', "cognome"))){
         $errors[] = 'Il nome può contenere solo lettere o spazi.';
         http_response_code("406");
       }
    }
    else{
        $cognome= filter_input(INPUT_POST, 'cognome', FILTER_SANITIZE_STRING);
    }
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $password = filter_input(INPUT_POST, 'password');  
	$username = filter_input(INPUT_POST, 'username');*/
    if (!$register->isValidUsername($username)){
		$response["error"] = TRUE;
        $response["error_msg"] = "L'username non è valido";
		echo json_encode($response);
        http_response_code("406");
		exit();
    } 
    // check if user is already existed with the same email
    if ( $register->emailExists($email) ) {
        // user already existed
        $response["error"] = TRUE;
        $response["error_msg"] = "L'utente è già registrato con la seguente email " . $email;
		http_response_code("200");
        echo json_encode($response);
    } else {
		$avatar = uploadFile($_FILES["file"], $email); 
		
        // create a new user
        $register->nome = $nome;
        $register->cognome = $cognome;
        $register->username= $username;
        $register->password = $password;
        $register->email = $email;
        $register->avatar = $avatar;
        $register = $register->create();
        if ($register) {
            // user stored successfully
            $response["error"] = FALSE;
            echo json_encode($response);
        } else {
            // user failed to store
            $response["error"] = TRUE;
            $response["error_msg"] = "Errore sconosciuto durante la registrazione!";
            echo json_encode($response);
        }
		http_response_code("200");
    } 
}

else{
    echo"Errore ";
    http_response_code("406");
}




function uploadFile($file, $name){
	$avatar = 'http://cv19ing20.altervista.org/Cv19/API/Immagini/user_default.jpeg';
	if(!isset($file)) {
		return $avatar;
	}
	$fileName = $_FILES['file']['name'];
	$fileTmpName  = $_FILES['file']['tmp_name'];
	$fileExtension = strtolower(end(explode('.',$fileName)));
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