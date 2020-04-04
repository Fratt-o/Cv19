<?php
    try{
        $database = new Database(); 
        $db = $database->getConnection();

    }catch(Exception $E){
        http_response_code(400);
        echo json_encode(array("message"=>"errore connessione al db")); 
    }
    $recensione = new Recensioni($db);
    try{
        $stmt = $recensione->readReviewToModerate();
        $stutt_arr= array();
        $strutt_arr['data'] = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        http_response_code(200); 
        echo json_encode($strutt_arr); 

    }catch(Exception $E){
        http_response_code(404); 
        echo json_encode( array("message" => "Nessuna recensione trovata.") ); 
    }
?>