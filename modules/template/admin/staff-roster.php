						<?php 						

						require_once($_SERVER['DOCUMENT_ROOT'] . "/modules/core/header.php"); 
						require_once($_SERVER['DOCUMENT_ROOT'] . "/modules/core/staff.php"); 

						if($adminlevel != 1337) 
						{
							die("no access");
						}
						
						if(!isset($link))
						{
							$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

							if($link === false) 
							{
								die("ERROR: Could not connect. " . mysqli_connect_error());
							}	
						}							
						
						?>

						<router-outlet _ngcontent-tnh-c136="" class="router-outlet"></router-outlet>
						<app-settings _nghost-tnh-c144="">
							<div class="content-header">
								<h3>Staff Roster</h3></div>
							<div class="content">
								<table class="cs-1">
									<thead>
										<tr>
											<th>Roles</th>
											<th>Name</th>
											<th>Discord</th>
											<th>Forum</th>
											<!--<th>Characters</th>-->
										</tr> 
									</thead>
									<tbody>
									
										<?php
													
										$user_check_query = "SELECT Username, Email, Forum, Admin, Discord FROM accounts WHERE Admin > 0 OR Admin = -1 ORDER BY Admin DESC";
										$result = mysqli_query($link, $user_check_query);

										$rowcount = $result->num_rows;	
														
										if($rowcount > 0)
										{
											while($result2 = mysqli_fetch_array($result, MYSQLI_ASSOC))
											{			
												$Discord = $result2['Discord'];

												if(strlen($Discord) > 0)
												{
													$apiURLBase = 'https://discordapp.com/api/users/@me';
													
													$user = apiRequest_custom($apiURLBase, $Discord);
												}

											?>
											
										<tr *ngFor="let member of members">
											<td><?php echo playerRank($result2['Username'], $result2['Admin']); ?></td>
											<td> <a href="http://localhost/admin/accounts/<?php echo $result2['Username']; ?>" target="_blank" class="strongish">                    <?php echo $result2['Username']; ?>                </a> </td>
											<!--<td *ngIf="member.discord_token"> <img src="https://cdn.discordapp.com/avatars/427916747501469698/e65339059c494f2bbc1bd9775b1cc3ef.png?size=16" *ngIf="member.discord_token.discord_avatar"> ᴄʜᴏᴘᴀ#<span class="color-grey">2512</span> </td>-->
											<?php if(strlen($Discord) > 0) { ?>
											<td><img *ngIf="player.account.discord_token.discord_avatar" src="https://cdn.discordapp.com/avatars/<?php echo $user->id; ?>/<?php echo $user->avatar; ?>.png?size=16" height="16"> <?php echo $user->username; ?><span class="color-grey">#<?php echo $user->discriminator; ?></span></td>
											<?php } else { ?>
											<td>Not connected</td>
											<?php } ?>
											<td><?php echo (strlen($result2['Forum']) > 0 ? $result2['Forum'] : 'Not connected'); ?></td>
											<!--<td class="color-grey" style="font-size: 0.8em">{{ member.characterNames }}</td>--> 
										</tr> 
										
											<?php
										
											}
										}										
										?>
									</tbody> 
								</table>
							</div>
						</app-settings>