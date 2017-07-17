<?php
session_start();
include 'src/User.php';
require_once 'connection.php';
if($_SERVER['REQUEST_METHOD'] == 'POST') {
	$email = strlen(trim($_POST['email'])) ? trim($_POST['email']) : null;
	$password = strlen(trim($_POST['password'])) ? trim($_POST['password']) : null;
	
	if($email && $password) {
		if($loggedUserId = User::login($conn, $email, $password)) {
			$_SESSION['loggedUserId'] = $loggedUserId;
			header("Location: main.php");
		} else {
			echo 'Incorrect email or password<br />';
		}
	}
}
?>

<html>
	<head>
		<meta charset="utf-8" />
                <meta charset="UTF-8">
    <title>Twttr</title>
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
        <p><a style="margin-left: 100px" class="btn btn-lg btn-success" href="NewUser.php" role="button">Sign up today</a></p>

    </div>
		<form method="POST">
			<fieldset>
				<label>
					Email:
					<input type="text" name="email" />
				</label>
				<br />
				<label>
					Password:
					<input type="password" name="password" />
				</label>
				<br />
				<input type="submit" value="Login" />
			</fieldset>
		</form>
            <a href="NewUser.php">Registration</a>
	</body>
</html>