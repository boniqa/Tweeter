<?php

include 'src/config.php';
include 'src/User.php';
include 'src/Tweet.php';
include 'connection.php';

if(isset($_SESSION['loggedUserId'])) {
	header("Location: main.php");
}

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(!isset($_POST['usr']) || !isset($_POST['email']) || !isset($_POST['pwd']) || !isset($_POST['pwd2'])){
        
        echo "error! error!";
    }
    else{
      $username = ($_POST['usr']);
      $email = trim($_POST['email']);
      $password1= trim($_POST['pwd']);
      $password2= trim($_POST['pwd2']);
      
      if($password1 != $password2){
          
          echo 'Error, two different passwords!';
      }
      else{
          
          $new_usr= new User;
          $new_usr->setUsername($username);
          $new_usr->setEmail($email);
          $new_usr->setHashedPassword($password1);
          $new_usr->saveToDb($conn);
          $new_usr_id= $new_usr->getId();
          var_dump($new_usr_id);
          
          $_SESSION['loggedUserId'] = $new_usr_id;
          header("Location: main.php");
          
      }

	//echo $username. "  ".$email. "  ".$password1." ". $password2 ;
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
   <div class="page-header">
        <h2 style="margin-left: 100px">Rejestracja nowego użytkownika:</h2>
   </div>
   
   <div class="form-group">
       <form action="#" method="POST">
        <label for="usr">Name:</label>
        <input type="text" class="form-control" name="usr">
        <label for="usr">Email:</label>
        <input type="text" class="form-control" name="email">
        <label for="pwd">Password:</label>
        <input type="password" class="form-control" name="pwd">
        <label for="pwd">Repeat password:</label>
        <input type="password" class="form-control" name="pwd2">
        <input type="submit" name="submit" value="Register now!"/>
    </form>

        
    </div>
    
    
    
</body>
</html>