<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/modules/core/header.php"); 

if(!isset($link))
{
	$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

	if($link === false) 
	{
		die("ERROR: Could not connect. " . mysqli_connect_error());
	}	
}

$user_check_query = "SELECT Username FROM accounts WHERE Tester = 1";
$res = mysqli_query($link, $user_check_query);
								
$rowcount = $res->num_rows;
?>

<p>There are <?php echo $rowcount; ?> Tester(s) online right now</p>