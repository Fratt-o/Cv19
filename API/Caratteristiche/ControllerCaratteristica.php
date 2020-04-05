<?php 
    include_once '../config/DAOFactory.php';
    
    $daoFactory = DAOFactory::getDao();

    $CaratDao = $daoFactory->getCaratteristicaDao();

    $result = $CaratDao->readAllCaratteristiche();
    
    echo json_encode($risposta);


?>