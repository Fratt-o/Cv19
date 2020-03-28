<?php

include_once '../config/databaseconnect.php';
include_once '../Utente/Utente.php';

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$database = new Database();
$db = $database->getConnection();

$utente = new Utente($db);

// query products
$stmt = $utente->read();
$num = $stmt->rowCount(); //funzione di sistema
 
// check if more than 0 record found
if($num>0){
 
    // utente array
    $utente_arr=array();
    $utente_arr["records"]=array();
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
        $utente_item=array(
            "username" => $username,
            "nome" => $nome,
            "cognome" => $cognome
        );
 
        array_push($utente_arr["records"], $utente_item);
    }
 
    // set response code - 200 OK
    http_response_code(200);
 
    echo json_encode($utente_arr);
}

else
{
    echo http_response_code(404); 
    echo json_encode( array("message" => "Nessun utente trovato.") );
}

