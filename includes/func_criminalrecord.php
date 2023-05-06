<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/modules/core/header.php"); 

if(!isset($_GET['name']))
{
	die();
}

$user_name = $_GET['name'];

if(!isset($link))
{
	$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

	if($link === false) 
	{
		die("ERROR: Could not connect. " . mysqli_connect_error());
	}	
}

str_replace(" ", "_", $user_name);

$user_name = mysqli_escape_string($link, $user_name);

$user_check_query = "SELECT `ID`, `char_name`, `Model` FROM `characters` WHERE `char_name` = '$user_name' LIMIT 1";
$res = mysqli_query($link, $user_check_query);
								
$rowcount = $res->num_rows;
	
if($rowcount > 0)
{	
	$found = true;

	$result2 = mysqli_fetch_array($res, MYSQLI_ASSOC);

	$ID = $result2['ID'];
	$char_name = $result2['char_name'];
	$Model = $result2['Model'];
	
	mysqli_free_result($res);
	
	$user_check_query = "SELECT `userid`, `charge`, `date`, `officer` FROM `criminalrecords` WHERE `userid` = '$ID'";
	$res = mysqli_query($link, $user_check_query);

	$records = 0;

	while($result2 = mysqli_fetch_array($res, MYSQLI_ASSOC))
	{
		$criminal_record[$records] = $result2;
		
		$records++;
	}
}
else $found = false;

mysqli_free_result($res);

?>

									<?php if($found == true) { ?>
									<div _ngcontent-tnh-c226="" class="cs-1" style="display: flex;" *ngIf="result">
										<div _ngcontent-tnh-c226="" class="mugshot-background" *ngIf="result.mugshot_skin">
											<div _ngcontent-tnh-c226="" class="mugshot" [ngStyle]="mugshotStyle" style="background-image: url('http://localhost/skins/<?php echo $skins[ $Model ]; ?>-240-400.png')"> </div> </div>
										<div>
											<div class="card-title"> <?php echo returnName($char_name); ?> <!--<strong class="color-tomato" *ngIf="result.isWanted">WANTED</strong>--> </div>
											<!--<div *ngIf="lastPrison"> Last imprisoned on {{lastPrison.date}} </div>-->
										</div> 
									</div>
									<br>
									<table class="cs-1" *ngIf="result">
										<thead>
											<tr>
												<th>Filed by</th>
												<th>Date</th>
												<th>Entry</th> </tr> </thead>
										<tbody>
											<?php 
											
											for($i = 0; $i < $records; $i++)
											{
												
											?>
											<tr *ngFor="let crime of result.crimes">
												<td><?php echo returnCharacter($link, $criminal_record[$i]["officer"]); ?></td>
												<td><?php echo $criminal_record[$i]["date"]; ?></td>
												<!--<td *ngIf="crime.status === 2"> <span class="strongish color-green">{{ crime.reason }}</span> <br><br> Officer Statement: {{ crime.officer_statement }} </td>-->
												<td *ngIf="crime.status !== 2" [ngClass]="{outstanding: crime.outstanding && result.isWanted}"> <?php echo $criminal_record[$i]["charge"]; ?> </td> 
											</tr> 
											
											<?php
											
											}
											
											?>
										</tbody> 
									</table>
									<?php } else { ?>
                                    <app-info-bar _ngcontent-tnh-c205="" type="error" class="clearfix width-100" _nghost-tnh-c215="">
                                        <div _ngcontent-tnh-c215="" class="error infobar">
                                            <div _ngcontent-tnh-c215="" class="icon"><i _ngcontent-tnh-c215="" class="fa fa-exclamation-triangle fa-fw"></i></div>
                                            <div _ngcontent-tnh-c215="" class="message"> No matches found for <?php echo returnName($user_name); ?> </div>
                                        </div>
                                    </app-info-bar>
									<?php } ?>
									
									<?php mysqli_close($link); ?>