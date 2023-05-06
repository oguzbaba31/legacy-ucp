<?php 
@ob_start();
session_start();

if(!isset($_SESSION["playersqlid"])) 
{
    header("location: /login");
    exit;
}

$username = $_SESSION['username']; 
$playersqlid = $_SESSION['playersqlid'];
$adminlevel = $_SESSION['adminlevel'];
$charss = $_SESSION['characters'];
$playeremail = $_SESSION['playeremail'];
$namechanges = $_SESSION['namechanges'];
$phonechanges = $_SESSION['phonechanges'];
$discord_auth = $_SESSION['discord_auth'];
$forum_auth = $_SESSION['forum_auth'];
$donaterank = $_SESSION['donaterank'];
?>


