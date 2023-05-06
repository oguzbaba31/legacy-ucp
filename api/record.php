<?php

error_reporting(0);

$link = mysqli_connect('localhost', 'root', '', 'lux-rp');

if($link === false) die('[]');

$count = 0;

$user_check_query = "SELECT `Character`, `BannedBy` as 'Issuer', `Reason`, `Date` FROM logs_ban WHERE `user_id` = '3'";
$result = mysqli_query($link, $user_check_query);

$rowcount = $result->num_rows;
$total_rowcount = $rowcount;

if($rowcount)
{
	while($result2 = mysqli_fetch_array($result, MYSQLI_ASSOC))
	{
		$record[$count] = $result2;
		$record[$count]['Type'] = 1;
		$record[$count]['Minutes'] = 0;
									
		$count++;
	}
}

mysqli_free_result($result);

$user_check_query = "SELECT `Character`, `JailedBy` as 'Issuer', `Minutes`, `Reason`, `Date` FROM logs_jail WHERE `user_id` = '3'";
$result = mysqli_query($link, $user_check_query);

$rowcount = $result->num_rows;
$total_rowcount += $rowcount;

if($rowcount)
{
	while($result2 = mysqli_fetch_array($result, MYSQLI_ASSOC))
	{
		$record[$count] = $result2;
		$record[$count]['Type'] = 2;
									
		$count++;
	}
}

mysqli_free_result($result);

$user_check_query = "SELECT `Character`, `KickedBy` as 'Issuer', `Reason`, `Date` FROM logs_kick WHERE `user_id` = '3'";
$result = mysqli_query($link, $user_check_query);

$rowcount = $result->num_rows;
$total_rowcount += $rowcount;

if($rowcount)
{
	while($result2 = mysqli_fetch_array($result, MYSQLI_ASSOC))
	{
		$record[$count] = $result2;
		$record[$count]['Type'] = 3;
		$record[$count]['Minutes'] = 0;
									
		$count++;
	}
}

mysqli_free_result($result);
mysqli_close($link);

if(!$total_rowcount) die('[]');

$jsondata = '[';

for($i = 0; $i < $total_rowcount; $i++)
{	
	if($i == 0) $jsondata = $jsondata.'{"Character":"'.$record[$i]['Character'].'","Issuer":"'.$record[$i]['Issuer'].'","Reason":"'.$record[$i]['Reason'].'","Date":"'.$record[$i]['Date'].'","Minutes":'.$record[$i]['Minutes'].',"Type":'.$record[$i]['Type'].'}';
	else $jsondata = $jsondata.',{"Character":"'.$record[$i]['Character'].'","Issuer":"'.$record[$i]['Issuer'].'","Reason":"'.$record[$i]['Reason'].'","Date":"'.$record[$i]['Date'].'","Minutes":'.$record[$i]['Minutes'].',"Type":'.$record[$i]['Type'].'}';
}

$jsondata = $jsondata.']';

echo $jsondata; 

?>