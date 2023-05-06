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

$clean_verdict = $verdict;
$verdict = mysqli_escape_string($link, $verdict);

$user_check_query = "SELECT `master`, `char_name` FROM application WHERE `id` = '$app_id' AND `status` != '2' AND `accepted` != '1' AND `reviewed_by` != '-1'";
$result = mysqli_query($link, $user_check_query);

$rowcount = $result->num_rows;	

if($rowcount == 0)
{
	header("location: /admin/applications");
	exit();
}

echo "asd";

$result2 = mysqli_fetch_array($result, MYSQLI_ASSOC);

$master = $result2['master'];
$char_name = $result2['char_name'];

mysqli_free_result($result);

$data = date("d-m-Y h:i:s");
$user_check_query = "UPDATE application SET `status` = '2', `accepted` = '0', `reason` = '$verdict', `date_of_verdict` = '$data' WHERE `id` = '$app_id' LIMIT 1";
$result = mysqli_query($link, $user_check_query);

mysqli_free_result($result);

$user_check_query = "UPDATE accounts SET `answered_questions` = '0' WHERE `ID` = '$master' LIMIT 1";
$result = mysqli_query($link, $user_check_query);

mysqli_free_result($result);

$masterrr = returnMaster($link, $master);
$body = "Dear $masterrr,<br><br>Your character application for <strong><a href='http://localhost/panel/applications/$app_id'>$char_name</a></strong> has been denied for the following reason: <em>$clean_verdict</em>. <br><br>Please switch to your character for more details.";

insertNotification($link, $master, "Character Application", $body, $username);

Discord_AlertStaff("$username has denied character application **#$app_id** for '$clean_verdict'.");

header("location: /admin/application/$app_id");

?>