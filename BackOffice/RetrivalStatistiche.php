<?php
    header('Content-Type: application/json');
    include_once "../API/Struttura/ControllerAdminStrutture.php";
    $controller= new ControllerAdminStrutture;
    $result = $controller->getStats();
    $data = json_encode($result);
    echo $data;

?>