<?php

error_reporting(0);

$link = mysqli_connect('localhost', 'root', '', 'lux-rp');

if($link === false) die('[]');

$user_check_query = "SELECT `ID`, `char_name`, `Model`, `Level` FROM `characters` WHERE `master` = '1'";
$result = mysqli_query($link, $user_check_query);
								
$rowcount = $result->num_rows;

if(!$rowcount) die('[]');

$rows = array();

while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) $rows[] = $row;

mysqli_free_result($result);
mysqli_close($link);
 
$jsondata = '[';

for($i = 0; $i < $rowcount; $i++)
{	
	if($i == 0) $jsondata = $jsondata.'{"id":'.$rows[$i]['ID'].',"username":"'.$rows[$i]['char_name'].'","model":'.$rows[$i]['Model'].',"level":'.$rows[$i]['Level'].',"address":{"name":"test", "code":"123"}}';
	else $jsondata = $jsondata.',{"id":'.$rows[$i]['ID'].',"username":"'.$rows[$i]['char_name'].'","model":'.$rows[$i]['Model'].',"level":'.$rows[$i]['Level'].',"address":{"name":"test", "code":"123"}}';
}

$jsondata = $jsondata.']';

echo $jsondata;

?>