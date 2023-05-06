<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/modules/core/header.php"); 
require_once($_SERVER['DOCUMENT_ROOT'] . "/modules/core/staff.php"); 

if(empty($_GET['app_id']))
{
	header("location: /admin/applications");
	exit;
}

$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if($link === false)
{
	die("ERROR: Could not connect. " . mysqli_connect_error());
}	

$app_id = $_GET['app_id'];

$user_check_query = "SELECT `id` FROM application WHERE `id` = '$app_id' AND `status` != '1' AND `accepted` != '1' AND `reviewed_by` = '-1'";
$result = mysqli_query($link, $user_check_query);

$rowcount = $result->num_rows;	

if($rowcount == 0)
{
	header("location: /admin/applications");
	exit();
}

mysqli_free_result($result);

$data = date("d-m-Y h:i:s");
$user_check_query = "UPDATE application SET `status` = '1', `reviewed_by` = '$playersqlid', `date_of_review` = '$data' WHERE `id` = '$app_id' LIMIT 1";
$result = mysqli_query($link, $user_check_query);

mysqli_free_result($result);

Discord_AlertStaff("$username is now reviewing character application **#$app_id**.");

header("location: /admin/application/$app_id");

?>