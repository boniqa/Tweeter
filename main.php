<?php
session_start();
include 'src/config.php';
include 'src/User.php';
include 'src/Tweet.php';
include 'connection.php';


if(!isset($_SESSION['loggedUserId'])) {
	header("Location: login.php");
}
   
//var_dump($_SESSION);
//var_dump($twee->loadAllTweets($conn));
   
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(isset($_POST['tweet'])){
        
      $tweet_text = ($_POST['tweet']);
      $user_id= $_SESSION['loggedUserId'] ;
      
      $new_tweet= new Tweet();
                
        $new_tweet->setText($tweet_text);
        $new_tweet->setUserId($user_id);
        $new_tweet->setCreationDate(date("Y-m-d H:i:s"));
        $new_tweet->saveToDb($conn);
        
        echo"new tweet is set!";              
             
      //var_dump($user_id);
      //var_dump($tweet_text);
    }
    
}
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
      
    
      <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#">Home</a></li>                
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="../navbar/">My profile</a></li>
            <li><a href="login.php">Sign in</a></li>
            <li><a href="logout.php">Sign out</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
    <div class="jumbotron">
    
        <h1 style="margin-left: 100px">Tweeter</h1>
        <p><a style="margin-left: 100px" class="btn btn-lg btn-success" href="NewUser.php" role="button">Sign up today</a></p>

    </div>
     <div class="page-header">
        <h2 style="margin-left: 100px">Add Tweet:</h2>
    </div>
    
    <div class="input-group">
        <form method="POST" action="#">
        <input type="text" maxlength="120"  name ="tweet" class="form-control" placeholder="Your Tweet" aria-describedby="sizing-addon2">
        <input type="submit" name="tweet_text" value="Add!"/>
        </form>
    </div>
    
    <div class="page-header">
        <h2 style="margin-left: 100px">Latest Tweets:</h2>
    </div>
    
    
    <table class="table table-striped">
            <thead>
              <tr>
                <th>#</th>
                <th>What?</th>
                <th>Who?</th>
                <th>When?</th>
                <th>Comments</th>

              </tr>
            </thead>
            <tbody>
                <?php
                $twee= new Tweet();
                
                $result= $twee->loadAllTweets($conn);
                
                foreach ($result as $row){
                    echo "<tr>
                <td>".$row->getId()."</td>
                <td>".$row->getText(). "</td>
                <td><a href= 'showUser.php?id=".$row->getUserId()."'>".$row->getUserId()."</a></td>
                <td>".$row->getCreationDate()."</td>
                <td>No komments now</td>

                </tr>"
                ;}
                
               
               ?>
            </tbody>
          </table>
    
    
</body>
</html>