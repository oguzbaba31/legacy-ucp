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
											 
						$user_check_query = "SELECT `master`, `char_name`, `Faction`, `Username`, `Admin`
											FROM `characters`
											JOIN `accounts`
											ON `master` = accounts.ID
											WHERE characters.Online = 1";				
						
						$result = mysqli_query($link, $user_check_query);

						$players_online = $result->num_rows;	
						
						$players = array();	
						
						$count = 0;
						
						if($players_online > 0)
						{
							while($result2 = mysqli_fetch_array($result, MYSQLI_ASSOC))
							{
								$players[$count] = $result2;
								
								if($players[$count]['Admin'] >= 1) $admins++;
								else if($players[$count]['Admin'] == -1) $testers++;
								
								if($players[$count]['Faction'] == 1) $law++;
								else if($players[$count]['Admin'] == 0) $regular_players++; 
								
								$count++;
							}	
						
							mysqli_free_result($result);
						}
						
						mysqli_close($link);
						
						?>
                        <router-outlet _ngcontent-tnh-c136="" class="router-outlet"></router-outlet>
						<?php if($players_online > 0) { ?>
                        <app-online _nghost-tnh-c154="">
                            <div _ngcontent-tnh-c154="" class="content-header">
                                <h3 _ngcontent-tnh-c154="">Players Online - <?php echo $players_online; ?></h3>
                            </div>
                            <div _ngcontent-tnh-c154="" class="content">
                                <div _ngcontent-tnh-c154="" class="cstwothirds grid grid-gap-10">
															
									<?php	
									
									$count = 0;
									
									if($admins > 0) 
									{
										?>
										<?php if($testers > 0) { ?><section _ngcontent-tnh-c154="" class="cshalf card border-color-green"><?php } else { ?><section _ngcontent-tnh-c154="" class="cs-1 card border-color-green"><?php } ?>
										<div _ngcontent-tnh-c154="" class="card-title"><i _ngcontent-tnh-c154="" class="fa fa-fw fa-gavel color-green"></i>Administrators<span _ngcontent-tnh-c154="" class="fl-ri color-grey"><?php echo $admins; ?></span><br _ngcontent-tnh-c154=""></div>
										<div _ngcontent-tnh-c154="" class="players bold">	
										<?php
										
										for($i = 0; $i < $players_online; ++$i)
										{
											if($players[$i]['Admin'] > 0)
											{
											?>																				
										
											<?php if($count > 0) {?>,<?php } ?> <?php echo returnName($players[$i]['Username']); ?> <span style="color: #888; font-weight: 500;">(<?php echo $players[$i]['char_name']; ?>)</span>
											
											<?php
											
											$count++;
											}
										}
										
										?>
										</div>
											<!---->
											<!---->
										</section>												
										<?php
									}
									
									$count = 0;
									
									if($testers > 0) 
									{
										?>
										<?php if($admins > 0) { ?><section _ngcontent-tnh-c154="" class="cshalf card border-color-darkred"><?php } else { ?><section _ngcontent-tnh-c154="" class="cs-1 card border-color-darkred"><?php } ?>
                                        <div _ngcontent-tnh-c154="" class="card-title"><i _ngcontent-tnh-c154="" class="fa fa-fw fa-info color-darkred"></i>Testers<span _ngcontent-tnh-c154="" class="fl-ri color-grey"><?php echo $testers; ?></span></div>
										<div _ngcontent-tnh-c154="" class="players bold">	
										<?php
										
										for($i = 0; $i < $players_online; ++$i)
										{
											if($players[$i]['Admin'] == -1)
											{
											?>																				
										
											<?php if($count > 0) {?>,<?php } ?> <?php echo returnName($players[$i]['Username']); ?> <span style="color: #888; font-weight: 500;">(<?php echo $players[$i]['char_name']; ?>)</span>
											
											<?php
											
											$count++;											
											}
										}
										
										?>
										</div>
											<!---->
											<!---->
										</section>												
										<?php
									}	
									
									$count = 0;
									
									if($regular_players > 0) 
									{
										?>
										<section _ngcontent-tnh-c154="" class="cs-1 card border-color-grey">
                                        <div _ngcontent-tnh-c154="" class="card-title"><i _ngcontent-tnh-c154="" class="fa fa-fw fa-gamepad color-grey"></i> Regular Players <span _ngcontent-tnh-c154="" class="fl-ri color-grey"><?php echo $regular_players; ?></span></div>
										<div _ngcontent-tnh-c154="" class="players bold">	
										<?php
										
										for($i = 0; $i < $players_online; ++$i) 
										{
											if($players[$i]['Admin'] == 0 && $players[$i]['Faction'] < 1)
											{
											?>																				
										
											<?php if($count > 0) {?>,<?php } ?> <?php echo returnName($players[$i]['Username']); ?> <span style="color: #888; font-weight: 500;">(<?php echo $players[$i]['char_name']; ?>)</span>
											
											<?php
											
											$count++;
											}
										}
										
										?>
										</div>
											<!---->
											<!---->
										</section>												
										<?php
									}										
									
									?>
									</div>
									
									<div _ngcontent-tnh-c154="" class="csthird">
									<?php

									$count = 0;
									
									if($law > 0) 
									{
										?>
										<section _ngcontent-tnh-c154="" class="card margin-bottom-10">
                                        <div _ngcontent-tnh-c154="" class="card-title"><i _ngcontent-tnh-c154="" class="fa fa-fw fa-child color-blue"></i> Law Enforcement<span _ngcontent-tnh-c154="" class="fl-ri color-grey"><?php echo $law; ?></span></div>
                                        <ul _ngcontent-tnh-c154="" class="no-list-style players alternate">
										<?php
										
										for($i = 0; $i < $players_online; ++$i)
										{
											if($players[$i]['Admin'] == 0 && $players[$i]['Faction'] == 1)
											{
											?>																				
										
											<?php if($count > 0) {?>,<?php } ?> <span style="color: darkblue; font-weight: 500;"><?php echo returnName($players[$i]['char_name']); ?></span>
											
											<?php
											
											$count++;
											
											}
										}
										
										?>
										</div>
											<!---->
											<!---->
										</section>												
										<?php
									}

									?>

                                </div>
                        </app-online>
						<?php } else { ?>
                        <app-character _nghost-tnh-c145="">
                            <div _ngcontent-tnh-c145="" class="content">
                                <app-info-bar _ngcontent-tnh-c145="" type="error" class="cs-1" _nghost-tnh-c215="">
                                    <div _ngcontent-tnh-c215="" class="error infobar">
                                        <div _ngcontent-tnh-c215="" class="icon"><i _ngcontent-tnh-c215="" class="fa fa-exclamation-triangle fa-fw"></i></div>
                                        <div _ngcontent-tnh-c215="" class="message"> There is no player online at the moment </div>
                                    </div>
                                </app-info-bar>
                            </div>
                            <!---->
                            <!---->
                            <!---->
                            <!---->
                        </app-character>						
						<?php } ?>
                        <!---->