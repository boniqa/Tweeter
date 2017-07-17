<?php
session_start();
include 'src/Tweet.php';
include 'connection.php';


$userId = $_SESSION['loggedUserId'];
$tweetId = $_GET['tweet_id'];
if (isset ($_GET['tweet_id'])) {
    $del_tw= new Tweet();
    $del_tw->delete($conn);
}
header("Location: main.php");