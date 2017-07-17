<?php
session_start();
include 'src/config.php';
include 'src/User.php';
include 'src/Comment.php';
include 'src/Tweet.php';
include 'connection.php';

if(!isset($_SESSION['loggedUserId'])) {
	header("Location: login.php");
}

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(isset($_POST['comment'])){
        
      $comment_text = ($_POST['comment']);
      //var_dump($comment_text);
      $user_id= $_SESSION['loggedUserId'] ;
      $tweet_id= $_GET['id'];
      $new_comm= new Comment();
               
        $new_comm->setText($comment_text);
        $new_comm->setPost_id($tweet_id);
        $new_comm->setUserId($user_id);
        $new_comm->setCreationDate(date("Y-m-d H:i:s"));
        //var_dump($new_comm);
        $new_comm->saveToDb($conn);
                    
       // header("Location: main.php");     
      //var_dump($user_id);
      //var_dump($tweet_text);
    }
}   
if($_SERVER['REQUEST_METHOD'] == 'GET') {
    if(!isset($_GET['id'])) {
       echo "Error!";
       
    }
    else{
        
        $tweet_id= $_GET['id'];
        $tww= new Tweet();
        $res= $tww->loadTweetById($conn, $tweet_id); 
      //  var_dump($res);
                
    }
    
    $user= $res->getUserId();
    //var_dump($user); 
 $usr= new User();
 $tweet_user= $usr->loadUserById($conn, $user);
 //var_dump($tweet_user);
	
}
        
 
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
              <li class="active"><a href="main.php">Home</a></li>                
          </ul>
          <ul class="nav navbar-nav navbar-right">
              <li><a href="my_profile.php">My profile</a></li>
            <li><a href="login.php">Sign in</a></li>
            <li><a href="logout.php">Sign out</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
    <div class="jumbotron">
        <h2 style="margin-left: 100px"> <?php 
        
        //echo $tweet_id= $_GET['id'];
        //var_dump($tweet_id);
        $tww= new Tweet();
        $res= $tww->loadTweetById($conn, $tweet_id);
        //var_dump($res);
        echo "Post from user:".$res->getUserId();
        ?></h2>

    </div>
    
    
    
    
    
    <div>
        <h2 style="margin-left: 100px">" <?php echo $res->getText()?> "</h2>
    </div>
    
      <div>
          <h6 style="margin-left: 100px"><?php echo $res->getCreationDate()?></h2>
    </div>
    
    <div class="page-header">
        <h2 style="margin-left: 100px">Comments:</h2>
    </div>
    <table class="table table-striped">
            <thead>
              <tr>
                <th>#</th>
                <th>What?</th>
                <th>Who?</th>
                <th>When?</th>               
              </tr>
            </thead>
            <tbody>
                <?php

                $comments= new Comment();
                $result= $comments->loadAllCommentsByPostId($conn, $tweet_id);                
//                var_dump($result);
//                echo count($result);
                foreach ($result as $row){
                    echo "<tr>
                <td>".$row->getId()."</td>
                <td>".$row->getText(). "</td>
                <td><a href= 'showUser.php?id=".$row->getUserId()."'>".$row->getUserId()."</a></td>
                <td>".$row->getCreationDate()."</td>               

                </tr>"
                ;}
                
               
               ?>
            </tbody>
          </table>
    <div class="input-group">
        <form method="POST" action="#">
        <input type="text" maxlength="120"  name ="comment" class="form-control" placeholder="Send comment" aria-describedby="sizing-addon2">
        <input type="submit" name="comment_text" value="Add!"/>
        </form>
    </div>
</body>
</html>