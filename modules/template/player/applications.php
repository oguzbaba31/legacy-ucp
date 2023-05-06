						<?php 

						require_once($_SERVER['DOCUMENT_ROOT'] . "/modules/core/header.php");

						if(!isset($link))
						{
							$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

							if($link === false) 
							{
								die("ERROR: Could not connect.");
							}	
						}
						
						if(isset($_GET['test']))
						{							
							$application_id = $_GET['test'];
							
							$application_id = mysqli_escape_string($link, $application_id);	
							
							$user_check_query = "SELECT `master`, `char_name`, `reviewed_by`, `story`, `status`, `origin`, `gender`, `age`, `accepted`, `date_of_submit`, `reason`, `date_of_verdict`, `skin` FROM `application` WHERE `id` = '$application_id' LIMIT 1";
							$result = mysqli_query($link, $user_check_query);

							$rowcount = $result->num_rows;	

							if($rowcount == 0) die();												

							$ApplicationData = mysqli_fetch_array($result, MYSQLI_ASSOC);													

							if($ApplicationData['master'] != $playersqlid) die();
							
							if(isset($_GET['update_skin']))
							{
								if($_GET['update_skin'] == "withdraw")
								{
									$date = date("d-m-Y h:i:s");
									$user_check_query = "UPDATE `application` SET `status` = '3', `reviewed_by` = '-1', `date_of_verdict` = '$date' WHERE `id` = '$application_id' LIMIT 1";
									$result = mysqli_query($link, $user_check_query);	

									$ApplicationData['status'] = 3;
									$ApplicationData['date_of_verdict'] = $date;
								}
							}							

							$user_check_query = "SELECT `answer1`, `answer2`, `answered_questions` FROM `accounts` WHERE `ID` = '$playersqlid' LIMIT 1";
							$result = mysqli_query($link, $user_check_query);
							$QuestionData = mysqli_fetch_array($result, MYSQLI_ASSOC);

							mysqli_free_result($result);

							$user_check_query = "SELECT `id` FROM `application` WHERE `status` != '2' AND `id` != '$application_id'";
							$result = mysqli_query($link, $user_check_query);
							$applic_count = $result->num_rows;
							
							if(!$applic_count) $applic_count = 1;

							mysqli_free_result($result);

							for($x = 0; $x < sizeof($serverSkins); ++$x)
							{
								if($serverSkins[$x]["id"] == $ApplicationData['skin'])
								{
									$ApplicationData['skin'] = $serverSkins[$x]["name"];
									break;
								}
							}								
							
							?>

                       <router-outlet _ngcontent-tnh-c136="" class="router-outlet"></router-outlet>
                       <app-settings _nghost-tnh-c144="">
					   
						<section class="content-header" *ngIf="application">
							<h3><?php echo $ApplicationData['char_name']; ?>  - Character Application</h3>
							<?php if($ApplicationData['status'] < 2) { ?>
                            <!--<app-button _ngcontent-tnh-c145="" caption="Withdraw Application" icon="fa-trash" class="fl-ri blue margin-left-10" _nghost-tnh-c216="" onClick="window.location.href='http://localhost/panel/applications/<?php echo $application_id; ?>/withdraw'" onclick="">
                                <div _ngcontent-tnh-c216="" class="btn-wrapper">
                                    <div _ngcontent-tnh-c216="" class="button">
                                        <div _ngcontent-tnh-c216="" class="icon"><i _ngcontent-tnh-c216="" class="fa fa-trash"></i></div>
                                        <div _ngcontent-tnh-c216="" class="caption">Withdraw Application</div>
                                    </div>
                                </div>
                            </app-button>-->	
							<?php } ?>
							<span *ngIf="application.handled" class="fl-ri color-grey padding-5">        Submitted on <?php echo $ApplicationData['date_of_submit']; ?>    </span></section>
						<div class="content" *ngIf="application">
							<section class="cs-1 transparent nopadding margin-bottom-20">
							<?php
							switch($ApplicationData['status'])
							{
								case 0:
								{
									?>
									
                                <app-info-bar _ngcontent-tnh-c169="" type="info" class="cs-1" _nghost-tnh-c215="">
                                    <div _ngcontent-tnh-c215="" class="info infobar">
                                        <div _ngcontent-tnh-c215="" class="icon"><i _ngcontent-tnh-c215="" class="fa fa-exclamation-triangle fa-fw"></i></div>
                                        <div _ngcontent-tnh-c215="" class="message">This application was not handled yet. Your position in the queue is <?php echo $applic_count; ?>.</div>
                                    </div>
                                </app-info-bar>									
									
									<?php									
									break;
								}
								case 2:
								{
									?>
									
                                <app-info-bar _ngcontent-tnh-c169="" type="<?php if($ApplicationData['accepted'] == 1) { ?>success<?php } else { ?>info<?php } ?>" class="cs-1" _nghost-tnh-c215="">
                                    <div _ngcontent-tnh-c215="" class="<?php if($ApplicationData['accepted'] == 1) { ?>success<?php } else { ?>info<?php } ?> infobar">
                                        <div _ngcontent-tnh-c215="" class="icon"><i _ngcontent-tnh-c215="" class="fa fa-exclamation-triangle fa-fw"></i></div>
                                        <div _ngcontent-tnh-c215="" class="message">This application was <strong><?php if($ApplicationData['accepted'] == 1) { ?>accepted<?php } else if($ApplicationData['accepted'] == 0) { ?>denied<?php } else { ?>denied and user banned<?php } ?></strong> by <span [innerHTML]="application.handler.username"><?php echo returnMaster($link, $ApplicationData['reviewed_by']); ?></span> for the following reason:<br><br> <span style="white-space: pre-wrap"><?php echo $ApplicationData['reason']; ?></span></div>
                                    </div>
                                </app-info-bar>										
									
									<?php
									
									break;
								}
								case 3:
								{
									?>
									
                                <app-info-bar _ngcontent-tnh-c169="" type="info" class="cs-1" _nghost-tnh-c215="">
                                    <div _ngcontent-tnh-c215="" class="info infobar">
                                        <div _ngcontent-tnh-c215="" class="icon"><i _ngcontent-tnh-c215="" class="fa fa-exclamation-triangle fa-fw"></i></div>
                                        <div _ngcontent-tnh-c215="" class="message">This application was withdrawn on <?php echo $ApplicationData['date_of_verdict']; ?></div>
                                    </div>
                                </app-info-bar>	
								
									<?php
									break;
								}
							}
							?>
							</section>
							
							<section class="cstwothirds transparent nopadding">
								<section class="card">
									<div class="card-title"> Background Story </div>
									<div class="text-block"> <?php echo $ApplicationData['story']; ?> </div> 
								</section>
								<section class="card margin-top-10">
									<div class="card-title"> About - OOC </div>
									<div class="text-block" style="word-wrap: break-word;"> <strong>Have you got any past RP experience on SA-MP or another game? If past RP experience on SA-MP, what server(s) was it and what was your IG name(s)?</strong><br><?php echo $QuestionData['answer1']; ?><br><br><strong>Explain some roleplaying terms, like metagaming and powergaming, and give examples to each.</strong><br><?php echo $QuestionData['answer2']; ?> </div> </section> </section>
							<section class="csthird transparent nopadding text-center"> <img src="http://localhost/assets/skins_small/<?php echo $ApplicationData['skin']; ?>-240-400.png"> 							</section>
						</div>					   					   					  
                        </app-settings>
                        <!---->
							
							<?php
						}
						else
						{
							$user_check_query = "SELECT `ID`, `char_name`, `date_of_submit`, `reason`, `status`, `accepted` FROM `application` WHERE `master` = '$playersqlid' ORDER BY ID DESC";
							$result = mysqli_query($link, $user_check_query);

							$rowcount = $result->num_rows;	

							if($rowcount > 0)
							{
								$i = 0;
								
								while($result2 = mysqli_fetch_array($result, MYSQLI_ASSOC))
								{
									$ApplicationData[$i] = $result2;
									
									$i++;
								}
							}

						?>
		
                        <router-outlet _ngcontent-tnh-c136="" class="router-outlet"></router-outlet>
                        <app-applications _nghost-tnh-c144="">		
							<div _ngcontent-tnh-c142="" class="content-header">
								<h3>Application History</h3>
							</div>
							<div _ngcontent-tnh-c142="" class="content">
								<div class=" cs-1">
									<table class="">
										<thead>
											<tr>
												<th>Application ID</th>
												<th>Character Name</th>
												<th>Submitted</th>
												<th>Status</th>
												<th>Reason</th> </tr> </thead>
										<tbody>
										<?php 
										
										if($rowcount > 0) 
										{										
											for($i = 0; $i < $rowcount; ++$i)
											{ 
												
											if(strlen($ApplicationData[$i]['reason']) > 10)
											{
												$verdict = implode(' ', array_slice(explode(' ', $ApplicationData[$i]['reason']), 0, 10)) . " ...";
											}
											else $verdict = $ApplicationData[$i]['reason'];
											
											if(!strlen($verdict)) $verdict = "N/A";
												
											?>
											
											<tr *ngFor="let application of applications">
												<td onClick="changeCurrentPage('applications', '<?php echo $ApplicationData[$i]['ID']; ?>', 4)"><a href="javascript:void(0);" style="text-decoration: underline"><?php echo $ApplicationData[$i]['ID']; ?></a></td>
												<td onClick="changeCurrentPage('applications', '<?php echo $ApplicationData[$i]['ID']; ?>', 4)"><a href="javascript:void(0);"><?php echo $ApplicationData[$i]['char_name']; ?></a></td>
												<td><?php echo $ApplicationData[$i]['date_of_submit']; ?></td>
												<td><?php echo applicationStatus($ApplicationData[$i]['status'], $ApplicationData[$i]['accepted']); ?></td>
												<td><?php echo $verdict; ?></td> 
											</tr> 
											
											<?php
											
											}
										}
										
										?>
										</tbody> 
									</table> 
								</div>
							</div>															
						</app-applications>	
						
						<?php
						
						}
						
						?>