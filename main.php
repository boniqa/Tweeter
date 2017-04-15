<?php

include 'src/config.php';
include 'src/User.php';
include 'src/Tweet.php';
include 'connection.php';


    $twee= new Tweet();
   
    //var_dump($twee->loadAllTweets($conn));
    
       

    
    
    
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
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CodersLab - Warsztaty I </title>
    <link href="style/style.css" rel="stylesheet">
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" 
      integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" 
      crossorigin="anonymous">
<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" 
      integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" 
      crossorigin="anonymous">
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" 
integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" 
crossorigin="anonymous"></script>
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css"/>
</head>
<body>
    <div class="jumbotron">
    
        <h1 style="margin-left: 100px">Tweeter</h1>
    </div>
    <div class="page-header">

    <h2 style="margin-left: 100px">Menu</h2>
    </div>
    
      <div class="row">
    
    <div class="col-xs-3">
        <a href="movies.php"><button class="btn btn-block btn-default"><i class="fa fa-film" aria-hidden="true"></i>
                #1</button></a>
    </div>
    <div class="col-xs-3">
      <a href="cinemas.php"><button class="btn btn-block btn-default"><i class="fa fa-home" aria-hidden="true"></i>
              #2</button></a>
    </div>
    <div class="col-xs-3">
        <a href="delete_add.php"><button class="btn btn-block btn-danger"><i class="fa fa-trash"></i> #3</button></a>
    </div>
    <div class="col-xs-3">
      <a href="payment.php"><button class="btn btn-block btn-default"><i class="fa fa-credit-card" aria-hidden="true"></i>
              #4 </button></a>
    </div>
    
  </div>
    

    
</body>
</html>