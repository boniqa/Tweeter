<?php

define('DB_HOST' , "localhost");
define('DB_USER' , "root");
define ('DB_PASSWORD' , "coderslab");
define('DB_DBNAME' , "tweet_db");

$conn= new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DBNAME);

    if ($conn->connect_error){
        die("POłączenie nieudane, błąd".$conn->connect_error);
    }
    else{
        echo 'połaczenie działa';
    }