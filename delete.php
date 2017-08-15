<?php
session_start();
include 'src/Tweet.php';
include 'src/config.php';
include 'connection.php';


if(!isset($_SESSION['loggedUserId'])) {
	header("Location: login.php");
}

$tweetId = $_GET['id'];

if (isset ($_GET['id'])) {
    $del_tw= new Tweet();
    $res= $del_tw->loadTweetById($conn, $tweetId);
//    var_dump($res);
    $res->delete($conn);
    
}
header("Location: my_profile.php");