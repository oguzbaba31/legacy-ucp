<?php 

$host = $_SERVER['SERVER_NAME'];

if($host == "0.0.0.1")
{
	die();
}

@ob_start();
session_start();

require_once("config.php"); 

if(!isset($_SESSION["playersqlid"])) 
{
    header("location: /login");
    exit;
}

$username = $_SESSION['username']; 
$playersqlid = $_SESSION['playersqlid'];
$quiz = $_SESSION['quiz']; 

/*if(!$quiz)
{
	if($_SERVER['REQUEST_URI'] != "/panel/quiz")
	{	
		echo '<script>window.location.href = "http://localhost/panel/quiz";</script>';
		exit;
	}
}*/

$adminlevel = $_SESSION['adminlevel'];
$charss = $_SESSION['characters'];
$playeremail = $_SESSION['playeremail'];
$namechanges = $_SESSION['namechanges'];
$phonechanges = $_SESSION['phonechanges'];
$discord_auth = $_SESSION['discord_auth'];
$forum_auth = $_SESSION['forum_auth'];
$donaterank = $_SESSION['donaterank'];
$averagehours = $_SESSION['averagehours'];

$notif_count = 0;

?>


