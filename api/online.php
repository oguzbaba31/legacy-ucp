<?php

error_reporting(0);

$link = mysqli_connect('localhost', 'root', '', 'lux-rp');

if($link === false) die('[]');

$user_check_query = "SELECT `master`, `char_name`, `Faction`, `Username`, `Admin`, `Tester` FROM `characters` JOIN `accounts` ON `master` = accounts.ID WHERE characters.Online = 1";
											
$result = mysqli_query($link, $user_check_query);
								
$rowcount = $result->num_rows;

if(!$rowcount) die('[]');

$rows = array();

while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) $rows[] = $row;

$jsondata = '[';

for($i = 0; $i < $rowcount; $i++)
{	
	if($i == 0) $jsondata = $jsondata.'{"master":'.$rows[$i]['master'].',"char_name":"'.$rows[$i]['char_name'].'","Faction":'.$rows[$i]['Faction'].',"Username":"'.$rows[$i]['Username'].'","Admin":'.$rows[$i]['Admin'].',"Tester":'.$rows[$i]['Tester'].'}';
	else $jsondata = $jsondata.',{"master":'.$rows[$i]['master'].',"char_name":"'.$rows[$i]['char_name'].'","Faction":'.$rows[$i]['Faction'].',"Username":"'.$rows[$i]['Username'].'","Admin":'.$rows[$i]['Admin'].',"Tester":'.$rows[$i]['Tester'].'}';
}

$jsondata = $jsondata.']';

echo $jsondata; 

?>