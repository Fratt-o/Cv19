<?php

include_once './Utente.php';

$manuel = new Utente();

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    if (!filter_input(INPUT_POST, "nome") === false) {
        
       // $errors[] = 'Il nome può contenere solo lettere o spazi.';
      //  http_response_code("406");       
        echo("Nome valido"); 
        
        if(( preg_match("/manuel/", filter_input(INPUT_POST, "nome") ) )){
            $manuel->nome=filter_input(INPUT_POST, "nome");

            http_response_code("200");
        }
       

    } else { 
        echo("Nome non valido"); 
            http_response_code("500");

} 
}
else{
    echo"Errore";
    http_response_code("501");
}

  
    echo json_encode ($manuel);


