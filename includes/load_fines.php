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

$user_check_query = "SELECT * FROM `fines`";
$res = mysqli_query($link, $user_check_query);

$rowcount = $res->num_rows;	

if($rowcount > 0)
{		
	$i = 0;

	while($result2 = mysqli_fetch_array($res, MYSQLI_ASSOC))
	{
		$fine_data[$i] = $result2;
		
		$i++;
	}
}

if($rowcount > 0)
{
	for($i = 0; $i < $rowcount; $i++)
	{
		$ID = $fine_data[$i]['id'];
		$Name = $fine_data[$i]['addressee'];
		$Amount = $fine_data[$i]['price'];
		$Reason = $fine_data[$i]['reason'];
		$Date = $fine_data[$i]['date'];
		$Finer = $fine_data[$i]['cop'];
		$Agency = $fine_data[$i]['agency'];
		
		?>
		<tr class="kari">
		<td><?php echo $ID; ?></td>
		<td><?php echo $Name; ?></td>
		<td>$<?php echo $Amount; ?></td>
		<td><?php echo $Reason; ?></td>
		<td><?php echo $Date; ?></td>
		<td>N/A</td>
		<td><?php echo $Finer; ?></td>
		<td><?php echo $Agency; ?></td>
		</tr>
		<?php		
	}
}

?>