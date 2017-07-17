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

 $user_id= $_SESSION['loggedUserId'];
        $usr= new User();
        $res= $usr->loadUserById($conn, $user_id);
        
if($_SERVER['REQUEST_METHOD'] == 'GET') {
    if(!isset($_GET['id'])) {
       echo "Error!";
       
    }
    else{
        
        $user_id= $_GET['id'];
        $usr= new User();
        $res= $usr->loadUserById($conn, $user_id);                          
                 
    }
	
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
                <h2 style="margin-left: 100px">Profile user: <?php echo $res->getUsername()?></h2>

    </div>
        
    
    
    
    <div class="page-header">
        <h2 style="margin-left: 100px">Users Tweets:</h2>
    </div>
    
    
    <table class="table table-striped">
            <thead>
              <tr>
                <th>#</th>
                <th>What?</th>
                <th>When?</th>
                <th>Comments</th>

              </tr>
            </thead>
            <tbody>
                <?php
                 $tweets= new Tweet();
                $result= $tweets->loadTweetByUserId($conn, $user_id);
             
                foreach ($result as $row){
                    
                $comments= new Comment();
                $res= $comments->loadAllCommentsByPostId($conn, $row->getId());
                
                    echo "<tr>
                <td>".$row->getId()."</td>
                <td>".$row->getText(). "</td>
                <td>".$row->getCreationDate()."</td>
                <td>". count($res)."</td>
                <td><a href= 'showPost.php?id=".$row->getId()."'>show post</td>
                <br>

                </tr>"
                ;}  
                
               
               ?>
            </tbody>
          </table>
    
</body>
</html>