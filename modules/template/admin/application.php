<?php 						

require_once($_SERVER['DOCUMENT_ROOT'] . "/modules/core/header.php"); 
require_once($_SERVER['DOCUMENT_ROOT'] . "/modules/core/staff.php"); 

if(empty($_GET['app_id'])) die();

if(!isset($link))
{
	$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

	if($link === false) 
	{
		die("ERROR: Could not connect. " . mysqli_connect_error());
	}	
}		

$applicid = $_GET['app_id'];
$user_check_query = "SELECT `reviewed_by` FROM application WHERE `reviewed_by` = '$playersqlid' AND `status` = '1' AND `id` != '$applicid'";
$result = mysqli_query($link, $user_check_query);

$rowcount = $result->num_rows;	

$noperm = false;

if($rowcount > 0) $noperm = true;

$user_check_query = "SELECT * FROM `application` WHERE `id` = '$applicid' LIMIT 1";
$result = mysqli_query($link, $user_check_query);

$rowcount = $result->num_rows;	

if($rowcount == 0) die();

$result2 = mysqli_fetch_array($result, MYSQLI_ASSOC);

$app_id = $result2['id'];
$master = $result2['master'];
$char_name = $result2['char_name'];
$reviewed_by = $result2['reviewed_by'];
$story = $result2['story'];
$status = $result2['status'];		
$ip_address = $result2['ip_address'];

$country = $result2['country_name'];
$country_code = $result2['country_code'];

$accepted = $result2['accepted'];
$origin = $result2['origin'];
$gender = $result2['gender'];
$age = $result2['age'];
$date_of_review = $result2['date_of_review'];
$date_of_verdict = $result2['date_of_verdict'];
$verdict = $result2['reason'];
$_POST['verdict'] = "";

$year = date("Y");
$age = $year - $age;

$flag_1 = "";
$flag_2 = "";
$flag_3 = "";
$flag_4 = "";
$flag_5 = "";

$mastername = returnMaster($link, $master);

mysqli_free_result($result);

$user_check_query = "SELECT `answer1`, `answer2`, `answered_questions` FROM `accounts` WHERE `ID` = '$master' LIMIT 1";
$result = mysqli_query($link, $user_check_query);
$result2 = mysqli_fetch_array($result, MYSQLI_ASSOC);

$answer1 = $result2['answer1'];
$answer2 = $result2['answer2'];
$answered_questions = $result2['answered_questions'];

mysqli_free_result($result);

$user_check_query = "SELECT `name` FROM `bans` WHERE `playerIP` = '$ip_address' LIMIT 1"; 
$result = mysqli_query($link, $user_check_query);

$rowcount = $result->num_rows;	

if($rowcount > 0)
{
	$flag_1 = "$rowcount bans on the same IP address";
}

if(strlen($ip_address) > 5 && characterCount($ip_address, ".") > 5)
{
	$meci = explode(".", $ip_address);
	$partial_ip = $meci[0].".".$meci[1].".".$meci[2];

	$user_check_query = "SELECT `playerIP` FROM bans WHERE `playerIP` LIKE '$partial_ip%'"; 
	$result = mysqli_query($link, $user_check_query);
	$result2 = mysqli_fetch_array($result, MYSQLI_ASSOC);

	$rowcount = $result->num_rows;
								
	$playerIP = $result2['playerIP'];

	mysqli_free_result($result);

	if($rowcount > 0)
	{
		$flag_2 = "IP $ip_address matches ban $playerIP on the same subnet";
	}
}

$url = "https://en.wikipedia.org/w/api.php?action=opensearch&search=$char_name&limit=1&namespace=0&format=json";

$body = file_get_contents($url);
							
if(strpos($body, 'wikipedia.org') !== false)
{				
	$fpos = strpos($body, ',["') + 3;
	$spos = strpos($body, '"', $fpos);
							
	$flag_4 = substr($body, $fpos, $spos - $fpos);							
	$flag_4 = "Wikipedia Article on $flag_4";
							
	$firstpos = strpos($body, "https:");
	$secondpos = strpos($body, '"]', $firstpos);
							
	$wiki_link = substr($body, $firstpos);							
	$wiki_link = str_replace('"]]', "", $wiki_link); 
}

$_SESSION['viewingapp'] = $app_id;

if(strlen($story) > 10 && characterCount($story, ".") > 2)
{	
	$sim = similarApplication($link, $story, $app_id);

	if($sim != -1)
	{
		$flag_5 = "Similar to Application #$sim";
	}
}

$user_check_query = "SELECT `id`, `char_name`, `status`, `accepted` FROM `application` WHERE `master` = '$master' AND `id` != '$applicid'";
$result = mysqli_query($link, $user_check_query);

$count = 0;

$PastApplications = array();

while($result2 = mysqli_fetch_array($result, MYSQLI_ASSOC))
{
	array_push($PastApplications, $result2);
}

mysqli_free_result($result);

?>
                        <router-outlet _ngcontent-tnh-c136="" class="router-outlet"></router-outlet>
                        <app-character-list _nghost-tnh-c142="">
						<div class="content-header" *ngIf="app">				
						
							<h3>Application #<?php echo $app_id; ?> - <?php echo $mastername; ?> | <?php echo $char_name; ?> 
							
							<?php 
							switch($status)
							{
								case 0:
								{
									?>
									- <strong><span style="color:orange">Pending</span></strong>
									<?php
									break;		
								}
								case 1:
								{
									?>
									- <strong><span style="color:#34649f">Reviewing</span></strong>
									<?php
									break;		
								}
								case 2:
								{
									if($accepted == 1)
									{
									?>
									- <strong><span style="color:green">Accepted</span></strong>
									<?php
									} 
									else if($accepted == 2)
									{
									?>
									- <strong><span style="color:tomato">Denied and Banned</span></strong>
									<?php
									} 									
									else									
									{
									?>
									- <strong><span style="color:tomato">Denied</span></strong>
									<?php											
									}
									break;									
								}								
							}
							?>
										
							</h3>
						</div>
						<div id="mask" style="display: none;"><?php echo $char_name; ?></div>
						<div class="content" *ngIf="app">
							<section class="cstwothirds transparent nopadding">
								<section class="card">
									<div class="card-title"> In Character Information </div> 									
									<div style="font-size: 15px; background: white; word-wrap: break-word; box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;">									
										<div style="display: flex; padding: 10px;">
											<span style="width: 30%; border: none;">
												<b>Character Name:</b><br>
												<?php echo $char_name; ?>
											</span>
											<span style="width: 30%; border: none;">
												<b>Origin:</b></br>
												<?php echo $origin; ?>
											</span>
											<span style="width: 20%; border: none;">
												<b>Gender:</b></br>
												<?php echo $gender; ?>
											</span>
											<span style="width: 20%; border: none;">
												<b>Age:</b></br>
												<?php echo $age; ?>
											</span>	
										</div>
										
										<div style="padding: 10px; position: relative;">
											<span style="width: 100%;">
												<b>Background story:</b><br>
												<?php echo $story; ?>
												
												<div style="position: absolute; right: 10px; bottom: 10px; font-size: 12px; opacity: 0.8;">Application Length: <?php echo strlen($story); ?></div><br><br>
											</span>
										</div>	
									</div>
								</section>
								</br>
								
								<section class="card">
									<div class="card-title"> Out Of Character Information </div>									
									<div style="font-size: 15px; background: white; word-wrap: break-word; box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;">									
										<div style="padding: 10px;">
											<span style="width: 100%;">
												<b>Have you got any past RP experience on SA-MP or another game? If past RP experience on SA-MP, what server(s) was it and what was your IG name(s)?</b></br>
												<?php echo $answer1; ?>
											</span>
										</div>
										
										<div style="padding: 10px;">
											<span style="width: 100%;">
												<b>Explain some roleplaying terms, like metagaming and powergaming, and give examples to each.</b></br>
												<?php echo $answer2; ?>
											</span>
										</div>	
									</div>									
								</section>
								
								<?php if(($status == 1 && $reviewed_by == $playersqlid) || $status == 2) { ?>
								<div class="section-category">
									<h4>Verdict</h4> 
								</div>		
								<?php } ?>
								<section class="transparent nopadding" *ngIf="!app.handled && (!app.reservation || app.reservation.user.id === me.id)"> 
								<form id="hiddenField" action="" method="post" accept-charset="utf-8">								
								<?php if(($status == 1 && $reviewed_by == $playersqlid) || $status == 2) { ?><textarea style="overflow:hidden" name="verdict" id="verdict" placeholder="<?php echo htmlspecialchars($verdict); ?>" [(ngModel)]="reason" <?php if($status == 2 || $reviewed_by != $playersqlid) { ?>disabled<?php } ?>></textarea><?php } ?>							
								<?php if($status != 2 && $reviewed_by == $playersqlid) { ?>
									<div class="buttons">
										<app-button _ngcontent-tnh-c145="" caption="Freeze" icon="fa-check" class="green" _nghost-tnh-c216="" onclick="APPLICATION_HANDLE(1)">
											<div _ngcontent-tnh-c216="" class="btn-wrapper">
												<div _ngcontent-tnh-c216="" class="button">
													<div _ngcontent-tnh-c216="" class="icon"><i _ngcontent-tnh-c216="" class="fa fa-check"></i></div>
													<!---->
													<div _ngcontent-tnh-c216="" class="caption">Accept</a></div>
													<!---->
												</div>
												<!---->
											</div>
										</app-button>
										<app-button _ngcontent-tnh-c145="" caption="Freeze" icon="fa-times" class="tomato" _nghost-tnh-c216="" onclick="APPLICATION_HANDLE(0)">
											<div _ngcontent-tnh-c216="" class="btn-wrapper">
												<div _ngcontent-tnh-c216="" class="button">
													<div _ngcontent-tnh-c216="" class="icon"><i _ngcontent-tnh-c216="" class="fa fa-times"></i></div>
													<!---->
													<div _ngcontent-tnh-c216="" class="caption">Deny</div>
													<!---->
												</div>
												<!---->
											</div>
										</app-button>
										<app-button _ngcontent-tnh-c145="" caption="Freeze" icon="fa-snowflake" class="red fl-ri" _nghost-tnh-c216="" onclick="APPLICATION_HANDLE(2)">
											<div _ngcontent-tnh-c216="" class="btn-wrapper">
												<div _ngcontent-tnh-c216="" class="button">
													<div _ngcontent-tnh-c216="" class="icon"><i _ngcontent-tnh-c216="" class="fa fa-gavel"></i></div>
													<!---->
													<div _ngcontent-tnh-c216="" class="caption">Ban <?php echo $mastername; ?></div>
													<!---->
												</div>
												<!---->
											</div>
										</app-button>
									</div> 
								</form>
								<?php } ?>
								<?php if($status == 0 && $noperm == false) { ?>
									<div class="buttons">
									</br>
										<app-button _ngcontent-tnh-c145="" caption="Freeze" icon="fa-eye" class="blue" _nghost-tnh-c216="" onClick="document.location.href='http://localhost/modules/template/admin/application/review.php?app_id=<?php echo $app_id; ?>'">
											<div _ngcontent-tnh-c216="" class="btn-wrapper">
												<div _ngcontent-tnh-c216="" class="button">	
													<div _ngcontent-tnh-c216="" class="icon"><i _ngcontent-tnh-c216="" class="fa fa-eye"></i></div>		
													<!---->
													<div _ngcontent-tnh-c216="" class="caption">Review</div>
													<!---->
												</div>
												<!---->
											</div>
										</app-button>
									</div>
								<?php } else if($status == 1) { ?>
								</br>								
                                <app-info-bar _ngcontent-tnh-c169="" type="warning" class="cs-1" _nghost-tnh-c215="">
                                    <div _ngcontent-tnh-c215="" class="warning infobar">
                                        <div _ngcontent-tnh-c215="" class="icon"><i _ngcontent-tnh-c215="" class="fa fa-exclamation-triangle fa-fw"></i></div>
                                        <div _ngcontent-tnh-c215="" class="message">This application is being reviewed by <strong><?php echo returnMaster($link, $reviewed_by); ?></strong> since <?php echo $date_of_review; ?></div>
                                    </div>
                                </app-info-bar>															
								<?php } else if($status == 2) { 
								if($accepted == 0) $str = "denied";
								else if($accepted == 1) $str = "accepted";
								else if($accepted == 2) $str = "denied and banned";?>
								</br>
                                <app-info-bar _ngcontent-tnh-c169="" type="info" class="cs-1" _nghost-tnh-c215="">
                                    <div _ngcontent-tnh-c215="" class="info infobar">
                                        <div _ngcontent-tnh-c215="" class="icon"><i _ngcontent-tnh-c215="" class="fa fa-exclamation-triangle fa-fw"></i></div>
                                        <div _ngcontent-tnh-c215="" class="message">This application was <?php echo $str; ?> by <strong [innerHTML]="app.handler.username"><?php echo returnMaster($link, $reviewed_by); ?></strong> on <?php echo $date_of_verdict; ?></div>
                                    </div>
                                </app-info-bar>										
								<?php } ?>
								</section>
								</br>
							</section>								
							<section class="nopadding transparent csthird">
								<section class="card">
									<div class="card-title"> Info </div>
									<table class="onedimension" cellspacing="0">
										<tr>
											<td>Account</td>
											<td id="master_name"><a><?php echo $mastername; ?></a></td> </tr>
										<tr>
											<td>IP Address</td>
											<td><a [routerLink]="[\'http://localhost/admin/ip\', app.ip]" target="_blank"><?php echo $ip_address; ?></a></td> </tr>
										<tr>
											<td>Country</td>
											<td><img src="http://localhost/assets/images/flags/<?php echo strtolower($country_code); ?>.svg" width="24" height="24" align="center"> <?php echo $country; ?> </td> </tr> </table> </section>
								<section class="card margin-top-10">
									<div class="card-title"> Flags </div>
									<ul class="flags">
									<?php if(strlen($flag_5) > 0) { ?>
									<li class="warning cursor-pointer">           <i class="icon fa fa-fw fa-file color-blue"></i>             <a href="http://localhost/admin/application/<?php echo $sim; ?>" target="_blank"><?php echo $flag_5; ?></a>                    </li>
									<?php } ?>									
									<?php if(strlen($flag_1) > 0) { ?>
									<li class="serious cursor">                        <i class="icon fa fa-fw fa-gavel color-blue"></i>                        <?php echo $flag_1; ?>                    </a> </li>
									<?php } ?>
									<?php if(strlen($flag_2) > 0) { ?>
									<li class="warning">                        <i class="icon fa fa-fw fa-gavel color-blue"></i>                        <?php echo $flag_2; ?>                    </a> </li>
									<?php } ?>
									<?php if(strlen($flag_3) > 0) { ?>
									<li class="warning cursor-pointer">          <a href="https://whatismyipaddress.com/ip/<?php echo $ip_address; ?>" target="_blank"><?php echo $flag_3; ?></a>                     </li>
									<?php } ?>									
									<?php if(strlen($flag_4) > 0) { ?>
									<li class="warning cursor-pointer">           <i class="icon fa fa-fw fa-user-secret color-blue"></i>             <a href="<?php echo $wiki_link; ?>" target="_blank"><?php echo $flag_4; ?></a>                     </li>
									<?php } ?>
									<?php if(!strlen($flag_1) && !strlen($flag_2) && !strlen($flag_3) && !strlen($flag_4) && !strlen($flag_5)) { ?>
									<div class="description"> <strong>None</strong> </div> 
									<?php } ?>
									
										<!--<li class="warning cursor-pointer" *ngFor="let flag of app.lsrp_application_flags"  (click)="flagClick(flag)"> <i class="icon fa fa-fw"  [ngClass]="{\'fa-tv-retro\': flag.flag_type_id === 1, \'fa-copy\': flag.flag_type_id === 5, \'fa-user-secret\': flag.flag_type_id === 4}"></i> <span *ngIf="flag.flag_type_id === 1">                        <a target="_blank" href="https://en.wikipedia.org/?curid={{ flag.value }}">                            Wikipedia Article on {{ app.name | icname }}                        </a>                    </span> <span *ngIf="flag.flag_type_id === 5">                        Similar to App #{{ flag.value.application_id }}, score: {{ flag.value.score | number: \'0.0-2\' }}                    </span> <span *ngIf="flag.flag_type_id === 4">                        <a href="https://whatismyipaddress.com/ip/{{ app.ip }}" target="_blank">IP Might be a proxy</a>                    </span> </li>--> 
									</ul> 
								</section>
								<section class="card margin-top-10" *ngIf="app.main_account && app.main_account.users">
									<div class="card-title"> Other Characters </div>
									<div class="other-character nopadding" *ngFor="let character of app.main_account.users"  [ngStyle]="character.customStyles">
								<?php			
								$user_check_query = "SELECT `char_name`, `Level`, `LastLogin` FROM characters WHERE `master` = '$master' AND `char_name` != '$char_name' LIMIT 4";
								$result = mysqli_query($link, $user_check_query);
								
								$counti = 0;

								while($result2 = mysqli_fetch_array($result, MYSQLI_ASSOC))
								{
									$userii = $result2['char_name'];
									$Level = $result2['Level'];		
									$LastLogin = $result2['LastLogin'];
									
									?>	

								<div class="description"> <strong><?php echo $userii; ?></strong> - level <?php echo $Level; ?><br> Last online <?php echo date('m/d/Y', $LastLogin); ?><br> </div> 

									<!---->
									<?php 
									
									$counti++;
								}
								
								if($counti == 0)
								{
									?>
									<div class="description"> <strong>None</strong> </div> 
									<?php
								}

								mysqli_free_result($result);	
									?>
									</div>
								</section> 
								<section class="card margin-top-10" *ngIf="app.main_account && app.main_account.users">
									<div class="card-title"> Application History </div>
									<div class="other-character nopadding" *ngFor="let character of app.main_account.users"  [ngStyle]="character.customStyles">
									<?php			
																		
									if(!count($PastApplications))
									{
										echo '<div class="description"> <strong>None</strong> </div>';
									}						
	
									for($i = 0; $i < count($PastApplications); ++$i)
									{
										switch($PastApplications[$i]["status"])
										{
											case 2:
												$PastApplications[$i]["the_status"] = $PastApplications[$i]["accepted"] == 1 ? "Accepted" : "Denied";
												break;
											default:
												$PastApplications[$i]["the_status"] = "Under Review";
												break;								
										}
										
										?>
										<div class="description"> <a href="http://localhost/admin/application/<?php echo $PastApplications[$i]["id"]; ?>" target="_blank">#<?php echo $PastApplications[$i]["id"]; ?> <?php echo $PastApplications[$i]["char_name"]; ?></a><span style="float: right; padding-right: 10px;"><strong><?php echo $PastApplications[$i]["the_status"]; ?></strong></span> </div> 
										<?php
									}
	
									?>
									</div>
								</section> 								
							</section>
						</div>				
                        </app-character-list>
                        <!---->