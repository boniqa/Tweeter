<?php

include 'src/config.php';


$conn= new mysqli($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_DBNAME);

    if ($conn->connect_error){
        die("POłączenie nieudane, błąd".$conn->connect_error);
    }
    else{
        $conn->set_charset("utf8");
    }
    
    
 