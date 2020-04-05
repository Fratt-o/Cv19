<?php 
    include_once '../config/DAOFactory.php';
    
    $daoFactory = DAOFactory::getDao();
    try {
        $CaratDao = $daoFactory->getCaratteristicaDao();
        $result = $CaratDao->readAllCaratteristiche();
    }catch(Exception $E){
        $result['data']=null;
        $result['error']=false;
        echo json_encode($result);
    }
    http_response_code(200); 
    
    echo json_encode($result);


?>