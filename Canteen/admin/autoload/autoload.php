<?php

    session_start();
    require_once __dir__. "/../../library/Database.php";
    require_once __dir__. "/../../library/Function.php";
    $db = new Database;
    define('ROOT', $_SERVER['DOCUMENT_ROOT']."/Canteen/public/uploads/");
    
?>
