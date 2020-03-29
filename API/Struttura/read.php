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
include_once '../Struttura/Struttura.php'; 

$database = new Database(); 
$db = $database->getConnection(); 
$struttura = new Struttura($db);





/* queryModel -> Oggetto di richiesta del FE
{
	filter: {
		categoria: 'Ristorante',
		caratteristiche: [7, 20, 11] //7 Fumatori, 20 WiFi
	},
	pagination: {
		pageSize: 20,
		page: 3
	}
}



Risposta
 error: boolean;
    data: any;
    status: {
        page: number;
        pageSize: number;
        currentItems: number;
        totalRecords: number;
    };
*/


$queryModel = json_decode(file_get_contents("php://input"));



$filter = $queryModel->filter;
$pagination = $queryModel->pagination;

if(!isset($pagination)) {
	$response = array();
	$response["error"] = false;
	$response["data"] = array();
	echo json_encode($response);
	return;
} else {
	
	$stmt = $struttura->read($queryModel);
	$totalRecords = $struttura->totalItemsPerFilters($queryModel)->rowCount();
	$rowCount = $stmt->rowCount();
	
	if($rowCount > 0) {
		$risposta = array();
		
		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$risposta['data'] = $row;
		$risposta['error'] = false;
		$risposta['status'] = array("hasMoreItems" => ($totalRecords - ($pagination->page*$pagination->pageSize + $pagination->pageSize)) > 0);
		http_response_code(200); 
		echo json_encode($risposta); 
	} else {
		$risposta['data'] = array();
		$risposta['error'] = false;
		$risposta['status'] = array("hasMoreItems" => false);
		http_response_code(200); 
		echo json_encode($risposta); 
	}
}

exit();

$stmt = $struttura->read();
$stmt_caratteristiche = $struttura->stampacaratteristiche();
$car = $stmt_caratteristiche->rowCount();
$num = $stmt->rowCount(); 

if($num=1){ 
    $strutt_arr = array(); 
    $list_caratt = array();
    $strutt_arr["lista"] = array();
    $list_caratt["caratteristiche"] = array();
    $row = $stmt->fetch(PDO::FETCH_ASSOC); 
    extract($row); 
    $strutt_item = array( "nomestruttura" => $nomestruttura,
                               "categoria" => $categoria,
                               "citta" => $citta, 
                               "indirizzo" => $indirizzo, 
                               "cap"=>$cap, 
                               "mediavoto"=>$mediavoto,
                               "latitudine"=>$latitudine,
                               "longitudine"=>$longitudine,
                               "telefono"=>$telefono,
                               "email"=>$email,
                               "immagine"=>$immagine,
                               "categoria"=>$categoria,
                               "descrizione"=>$descrizione,
                         );
    array_push($strutt_arr["lista"], $strutt_item); 
    
    http_response_code(200); 
    echo json_encode($strutt_arr); 
    }
   else { 
       http_response_code(404); 
       echo json_encode( array("message" => "Nessuna struttura trovata.") ); 
       
   }
    

?>

