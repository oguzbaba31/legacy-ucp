<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/modules/core/header.php"); 
require_once($_SERVER['DOCUMENT_ROOT'] . "/modules/core/staff.php"); 

$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if($link === false)
{
	die("ERROR: Could not connect. " . mysqli_connect_error());
}	

$app_id = $_SESSION['viewingapp'];

if(empty($_POST['verdict'])) $verdict = "None";
else $verdict = $_POST['verdict'];

$verdict = mysqli_escape_string($link, $verdict);

$user_check_query = "SELECT `master`, `char_name`, `skin` FROM `application` WHERE `id` = '$app_id' AND `status` != '2' AND `accepted` != '1' AND `reviewed_by` != '-1'";
$result = mysqli_query($link, $user_check_query);

$rowcount = $result->num_rows;	

$result2 = mysqli_fetch_array($result, MYSQLI_ASSOC);

$master = $result2['master'];
$char_name = $result2['char_name'];
$skin = $result2['skin'];

mysqli_free_result($result);

if($rowcount == 0)
{
	header("location: /admin/applications");
	exit();
}

$data = date("d-m-Y h:i:s");

$user_check_query = "UPDATE application SET `status` = '2', `accepted` = '1', `reason` = '$verdict', `date_of_verdict` = '$data' WHERE `id` = '$app_id' LIMIT 1";
$result = mysqli_query($link, $user_check_query);

mysqli_free_result($result);

$phone_num = rand(100000, 999999); 

$user_check_query = "INSERT INTO `characters` (master, char_name, PhoneNumbr, Activated, Model) VALUES ('$master', '$char_name', '$phone_num', '1', '$skin')";
$result = mysqli_query($link, $user_check_query);

mysqli_free_result($result);

$masterrr = returnMaster($link, $master);
$body = "Dear $masterrr,<br><br>Your character application for <strong>$char_name</strong> has been accepted. You can now start to play on our server with your new character using the password which you have chosen in your application:<br><br><strong>IP: <a href='unsafe:samp://$server_ip'>$server_ip</a></strong><br><strong>Hostname:</strong> [0.3-DL] [LS] Header<br><strong>Player slots:</strong> 100<br><strong>Server password:</strong> N/A<br><br>";

insertNotification($link, $master, "Character Application", $body, $username);

Discord_AlertStaff("$username has accepted character application **#$app_id**.");

header("location: /admin/application/$app_id");

?>