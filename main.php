<?php

include 'src/config.php';
include 'src/User.php';
include 'src/Tweet.php';


$conn= new mysqli($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_DBNAME);

    if ($conn->connect_error){
        die("POłączenie nieudane, błąd".$conn->connect_error);
    }
    else{
        $conn->set_charset("utf8");
    }
    
    
    
 


    $twee= new Tweet();
   
    var_dump($twee->loadAllTweets($conn));
    
    
    
    // alt+ insert -> getery + setery ;
    /*
     *  $twee->setUserId(1);
    $twee->setText("brzydka pogoda");
    $twee->setCreationDate(date("m.d.y"));
    var_dump($twee);
    var_dump($twee->saveToDb($conn));
     * 
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
      */
    
    
    /*
      Create table Tweets (
        id int NOT NULL AUTO_INCREMENT,
        user_id int NOT NULL,
        text varchar(160) NOT NULL,
        creation_date DATETIME NOT NULL,
        PRIMARY KEY(id)  ,
        foreign key (user_id)
        REFERENCES Users(id) ON DELETE CASCADE
     );
     * 
     * 
     INSERT INTO Tweets(user_Id, text, creationDate)
          VALUES('{$this->user_id}', '{$this->text}', '{$this->creation_date}');
     */
    