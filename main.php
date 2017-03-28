<?php

include 'config.php';

$conn= new mysqli($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_DBNAME);

    if ($conn->connect_error){
        die("POłączenie nieudane, błąd".$conn->connect_error);
    }
    else{
        echo 'połaczenie działa';
    }
    // alt+ insert -> getery + setery ;
    /*
     Create table Users (
     id int NOT NULL AUTO_INCREMENT,
     email varchar(255) NOT NULL UNIQUE,
     user_name varchar(255) NOT NULL,
     hashed_password varchar(60) NOT NULL,
     PRIMARY KEY(id)  
     );

     */
     /*
      * 3 pliki: klasa user, main, config.php + klasa tweet, 
      *  ignore net beans do gita; oddzielny plik;
      */
    
    
    /*
     * Create table tweets (
        id int NOT NULL AUTO_INCREMENT,
        user_id int NOT NULL,
        text varchar(160) NOT NULL,
        creation_date DATETIME NOT NULL,
        PRIMARY KEY(id)  ,
     * foreign key (user_id)
     * REFERENCES Users(id) ON DELETE CASCADE
     );
     */
    