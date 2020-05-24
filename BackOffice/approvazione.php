<?php 
        use ControllerAdmin\ControllerAdmin;
        session_start();
        include_once("../API/Recensioni/ControllerAdmin.php");

        $controller = new ControllerAdmin();
        $id = $_GET['id'];
        $result = $controller->approvaRecensione($id);
        header("Location: http://cv19ing20.altervista.org/Cv19/BackOffice/ModerationPannel.php");

?>