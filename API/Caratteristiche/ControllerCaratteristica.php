<?php 
    include_once '../config/DAOFactory.php';
    
    $daoFactory = DAOFactory::getDao();

    $CaratDao = $daoFactory->getCaratteristicaDao();

    $result = $CaratDao->readAllCaratteristiche();
    
    http_response_code(200); 

    echo json_encode($risposta);


?>