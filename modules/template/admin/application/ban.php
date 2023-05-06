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

$user_check_query = "SELECT `master`, `char_name`, `ip_address` FROM application WHERE `id` = '$app_id' AND `status` != '2' AND `accepted` != '2' AND `reviewed_by` != '-1'";
$result = mysqli_query($link, $user_check_query);

$rowcount = $result->num_rows;	

if($rowcount == 0)
{
	header("location: /admin/applications");
	exit();
}

$result2 = mysqli_fetch_array($result, MYSQLI_ASSOC);

$master = $result2['master'];
$char_name = $result2['char_name'];
$ip_address = $result2['ip_address'];

mysqli_free_result($result);

$data = date("d-m-Y h:i:s");
$user_check_query = "UPDATE application SET `status` = '2', `accepted` = '2', `reason` = '$verdict', `date_of_verdict` = '$data' WHERE `id` = '$app_id' LIMIT 1";
$result = mysqli_query($link, $user_check_query);

mysqli_free_result($result);

$master_name = returnMaster($link, $master);
issueBan($link, $master_name, $username, $verdict, $ip_address, 1);
insertBanLog($link, $ip_address, $char_name, $username, $verdict, $master);

mysqli_close($link);

Discord_AlertStaff("$username has denied application **#$app_id** and banned the applicant for '$clean_verdict'.");

header("location: /admin/application/$app_id");

?>