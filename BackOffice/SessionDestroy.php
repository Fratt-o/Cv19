<?php

    session_start();
    $_SESSION['username']=null;
    session_destroy();
    header("Location: http://cv19ing20.altervista.org/Cv19/BackOffice/index.php");
?>