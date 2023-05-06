<?php 

require_once($_SERVER['DOCUMENT_ROOT'] . "/modules/core/header.php"); 

if(!isset($_POST['master']) || !isset($_POST['text']))
{
	exit;
}	

$master_name = $_POST['master'];
$login_message = $_POST['text'];

if(!isset($link))
{
	$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

	if($link === false) 
	{
		die("ERROR: Could not connect. " . mysqli_connect_error());
	}	
}

$master_name = mysqli_escape_string($link, $master_name);
$login_message = mysqli_escape_string($link, $login_message);

$user_check_query = "UPDATE accounts SET AdminNote = '$login_message' WHERE Username = '$master_name'";
$res = mysqli_query($link, $user_check_query);

//$error = "Login message set successfully.";

mysqli_free_result($res);
mysqli_close($link);

?>