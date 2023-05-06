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
						
						?>
                        <router-outlet _ngcontent-tnh-c136="" class="router-outlet"></router-outlet>
                        <app-admin-record _nghost-tnh-c146="">
                            <div _ngcontent-tnh-c146="" class="content-header">
                                <h3 _ngcontent-tnh-c146="">Admin Record - <?php echo $username; ?></h3>
                            </div>
                            <div _ngcontent-tnh-c146="" class="content">
                                <div _ngcontent-tnh-c146="" class="section-category">
                                    <h4 _ngcontent-tnh-c146="">Bans</h4>
                                </div>
                                <section _ngcontent-tnh-c146="" class="nopadding transparent grid-newline cs-1">
                                    <table _ngcontent-tnh-c146="" cellspacing="0" class="spacey">
                                        <thead _ngcontent-tnh-c146="">
                                            <tr _ngcontent-tnh-c146="">
                                                <th _ngcontent-tnh-c146="">Character</th>
                                                <th _ngcontent-tnh-c146="">Administrator</th>
                                                <th _ngcontent-tnh-c146="">Reason</th>
                                                <th _ngcontent-tnh-c146="">Date</th>
                                            </tr>
                                        </thead>
                                        <tbody _ngcontent-tnh-c146="">
										<?php	
										$user_check_query = "SELECT * FROM logs_ban WHERE `user_id` = '$playersqlid' ORDER BY id DESC";
										$res = mysqli_query($link, $user_check_query);								

										while($result2 = mysqli_fetch_array($res, MYSQLI_ASSOC))
										{
											$Character = $result2['Character'];
											$BannedBy = $result2['BannedBy'];				
											$Reason = $result2['Reason'];
											$Date = $result2['Date'];											
											
											?>									
										
                                           <tr _ngcontent-tnh-c146="">
                                                <td _ngcontent-tnh-c146=""><?php echo $Character; ?></td>
                                                <td _ngcontent-tnh-c146=""><?php echo $BannedBy; ?></td>
                                                <td _ngcontent-tnh-c146=""><?php echo $Reason; ?> </td>
												<td _ngcontent-tnh-c146=""><?php echo $Date; ?></td>
                                            </tr>
										
										<?php 
										} 
										
										mysqli_free_result($res);
										?>										
                                            <!---->
                                        </tbody>
                                    </table>
                                </section>
                                <!---->
                                <div _ngcontent-tnh-c146="" class="section-category">
                                    <h4 _ngcontent-tnh-c146="">Admin Jails</h4>
                                </div>												
                                <section _ngcontent-tnh-c146="" class="nopadding transparent grid-newline cs-1">
                                    <table _ngcontent-tnh-c146="" cellspacing="0" class="spacey">
                                        <thead _ngcontent-tnh-c146="">
                                            <tr _ngcontent-tnh-c146="">
                                                <th _ngcontent-tnh-c146="">Character</th>
                                                <th _ngcontent-tnh-c146="">Administrator</th>
                                                <th _ngcontent-tnh-c146="">Reason</th>
                                                <th _ngcontent-tnh-c146="">Duration (min)</th>
                                                <th _ngcontent-tnh-c146="">Date</th>
                                            </tr>
                                        </thead>
                                        <tbody _ngcontent-tnh-c146="">
										
										<?php	
										$user_check_query = "SELECT * FROM logs_jail WHERE `user_id` = '$playersqlid' ORDER BY id DESC";
										$res = mysqli_query($link, $user_check_query);								

										while($result2 = mysqli_fetch_array($res, MYSQLI_ASSOC))
										{
											$Character = $result2['Character'];	
											$JailedBy = $result2['JailedBy'];			
											$Minutes = $result2['Minutes'];		
											$Reason = $result2['Reason'];
											$Date = $result2['Date'];											
											
											?>									
										
                                           <tr _ngcontent-tnh-c146="">
                                                <td _ngcontent-tnh-c146=""><?php echo $Character; ?></td>
                                                <td _ngcontent-tnh-c146=""><?php echo $JailedBy; ?></td>
                                                <td _ngcontent-tnh-c146=""><?php echo $Reason; ?> </td>
                                                <td _ngcontent-tnh-c146=""><?php echo $Minutes; ?></td>
												<td _ngcontent-tnh-c146=""><?php echo $Date; ?></td>
                                            </tr>
										
										<?php 
										} 
										
										mysqli_free_result($res);
										?>										
										
                                            <!---->
                                        </tbody>
                                    </table>
                                </section>
                                <!---->
                                <div _ngcontent-tnh-c146="" class="section-category">
                                    <h4 _ngcontent-tnh-c146="">Kicks</h4>
                                </div>
                                <section _ngcontent-tnh-c146="" class="nopadding transparent grid-newline cs-1">
                                    <table _ngcontent-tnh-c146="" cellspacing="0" class="spacey">
                                        <thead _ngcontent-tnh-c146="">
                                            <tr _ngcontent-tnh-c146="">
                                                <th _ngcontent-tnh-c146="">Character</th>
                                                <th _ngcontent-tnh-c146="">Administrator</th>
                                                <th _ngcontent-tnh-c146="">Reason</th>
                                                <th _ngcontent-tnh-c146="">Date</th>
                                            </tr>
                                        </thead>
                                        <tbody _ngcontent-tnh-c146="">
										<?php	
										$user_check_query = "SELECT * FROM logs_kick WHERE `user_id` = '$playersqlid' ORDER BY id DESC";
										$res = mysqli_query($link, $user_check_query);								

										while($result2 = mysqli_fetch_array($res, MYSQLI_ASSOC))
										{
											$Character = $result2['Character'];
											$KickedBy = $result2['KickedBy'];				
											$Reason = $result2['Reason'];
											$Date = $result2['Date'];											
											
											?>									
										
                                           <tr _ngcontent-tnh-c146="">
                                                <td _ngcontent-tnh-c146=""><?php echo $Character; ?></td>
                                                <td _ngcontent-tnh-c146=""><?php echo $KickedBy; ?></td>
                                                <td _ngcontent-tnh-c146=""><?php echo $Reason; ?> </td>
												<td _ngcontent-tnh-c146=""><?php echo $Date; ?></td>
                                            </tr>
										
										<?php 
										} 
										
										mysqli_free_result($res);
										?>
                                            <!---->
                                        </tbody>
                                    </table>
                                </section>
                                <!---->
                            </div>
                        </app-admin-record>
                        <!---->
						
						<?php if(isset($link)) { mysqli_close($link); } ?>