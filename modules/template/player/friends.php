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
						
						$user_check_query = "SELECT ID, friendID, playerID, friendName, playerName, friendPending FROM ucp_friends WHERE playerID = '$playersqlid' OR friendID = '$playersqlid'";
						$res = mysqli_query($link, $user_check_query);
							
						$friend_count = $res->num_rows;
						$pending_count = 0;

						if($friend_count > 0)
						{
							$i = 0;
							
							while($result2 = mysqli_fetch_array($res, MYSQLI_ASSOC))
							{
								$friend_data[$i] = $result2;
								
								if($friend_data[$i]['friendPending'] == 1 && $friend_data[$i]['playerName'] != $username) $pending_count ++;
								
								if($friend_data[$i]['friendPending'] == 0) $friend_count_other++;
								
								$i++;
							}	
						}

						mysqli_free_result($link, $res);						

						if(isset($_GET['test']) && $_GET['test'] == "pending")
						{
							?>
							
                      <router-outlet _ngcontent-tnh-c136="" class="router-outlet"></router-outlet>
						<app-friends _nghost-tnh-c225="">
                            <div _ngcontent-tnh-c225="" class="content-header">
                                <h3 _ngcontent-tnh-c225="">Friends</h3>
                                <app-button _ngcontent-tnh-c225="" icon="fa fa-plus-circle" caption="Add a Friend" class="fl-ri blue" _nghost-tnh-c216="" onclick="function_addFriend()">
                                    <div _ngcontent-tnh-c216="" class="btn-wrapper">
                                        <div _ngcontent-tnh-c216="" class="button">
                                            <div _ngcontent-tnh-c216="" class="icon"><i _ngcontent-tnh-c216="" class="fa fa-plus-circle"></i></div>
                                            <!---->
                                            <div _ngcontent-tnh-c216="" class="caption">Add a Friend</div> 
                                            <!---->
                                        </div>
                                        <!---->
                                    </div>
                                </app-button>
                            </div>
                            <div _ngcontent-tnh-c225="" class="content" style="margin-bottom: 0; padding-bottom: 0;">
                                <div _ngcontent-tnh-c225="" class="section-category tabs">
                                    <h4 _ngcontent-tnh-c225="" tabindex="0" class="" onClick="changeCurrentPage('friends', '/panel/friends')">My Friends</h4>
                                    <h4 _ngcontent-tnh-c225="" tabindex="0" class="selected"> Pending <?php if($pending_count > 0) { ?><span _ngcontent-tnh-c225="" class="pending-count"> <?php echo $pending_count; ?> </span><?php } ?>
                                        <!---->
                                    </h4>
                                </div>
                            </div>
                            <router-outlet _ngcontent-tnh-c225=""></router-outlet>
                            <app-friends-list _nghost-tnh-c226="">
                                <div _ngcontent-tnh-c226="" class="content">
									<?php if($pending_count == 0) { ?>
                                    <app-info-bar _ngcontent-tnh-c226="" type="info" class="cs-1" _nghost-tnh-c215="">
                                        <div _ngcontent-tnh-c215="" class="info infobar">
                                            <div _ngcontent-tnh-c215="" class="icon"><i _ngcontent-tnh-c215="" class="fa fa-fw fa-info-circle"></i></div>
                                            <div _ngcontent-tnh-c215="" class="message"> You don't have any pending friend requests. </div>
                                        </div>
                                    </app-info-bar>
                                    <!---->
                                    <!---->									
									<?php								
									} 
									else
									{

										for($i = 0; $i < $friend_count; ++$i)
										{									 
											if($friend_data[$i]['friendPending'] == 0) continue;
											
											if($friend_data[$i]['playerName'] == $username) continue;
											
											$friend_id = $friend_data[$i]['ID'];
											$friend_name = $friend_data[$i]['playerName'];
											
											
											?>

                                    <!---->
                                    <div _ngcontent-tnh-c227="" class="card border-color-transparent csquarterthird">
                                        <div _ngcontent-tnh-c227="" class="card-title"> <?php echo $friend_name; ?>
                                            <app-button _ngcontent-tnh-c227="" icon="fa fa-fw fa-check" class="fl-ri blue thin" _nghost-tnh-c216="" onclick="function_AcceptFriend(<?php echo $friend_id; ?>)">
                                                <div _ngcontent-tnh-c216="" class="btn-wrapper">
                                                    <div _ngcontent-tnh-c216="" class="button">
                                                        <div _ngcontent-tnh-c216="" class="icon"><i _ngcontent-tnh-c216="" class="fa fa-check fa-fw"></i></div>
                                                        <!---->
                                                        <!---->
                                                    </div>
                                                    <!---->
                                                </div>
                                            </app-button>
                                            <app-button _ngcontent-tnh-c227="" icon="fa fa-fw fa-times" class="fl-ri tomato thin margin-right-10" _nghost-tnh-c216="" onclick="function_RemoveFriend(<?php echo $friend_id; ?>)">
                                                <div _ngcontent-tnh-c216="" class="btn-wrapper">
                                                    <div _ngcontent-tnh-c216="" class="button">
                                                        <div _ngcontent-tnh-c216="" class="icon"><i _ngcontent-tnh-c216="" class="fa fa-fw fa-times"></i></div>
                                                        <!---->
                                                        <!---->
                                                    </div>
                                                    <!---->
                                                </div>
                                            </app-button>
                                        </div>
                                        <!---->
                                        <!---->
                                        <!--<div _ngcontent-tnh-c227=""><span _ngcontent-tnh-c227="" class="strongish">Characters: </span> </div>-->
                                    </div>
                                    <!---->											
										
											<?php
										}
	
									}
									?>								
                                </div>
                            </app-friends-list>
                            <!---->   
                        </app-friends>
                        <!---->		
							
							<?php
						}
						else
						{								

						?>
						
                      <router-outlet _ngcontent-tnh-c136="" class="router-outlet"></router-outlet>
						<app-friends _nghost-tnh-c225="">
                            <div _ngcontent-tnh-c225="" class="content-header">
                                <h3 _ngcontent-tnh-c225="">Friends</h3>
                                <app-button _ngcontent-tnh-c225="" icon="fa fa-plus-circle" caption="Add a Friend" class="fl-ri blue" _nghost-tnh-c216="" onclick="function_addFriend()">
                                    <div _ngcontent-tnh-c216="" class="btn-wrapper">
                                        <div _ngcontent-tnh-c216="" class="button">
                                            <div _ngcontent-tnh-c216="" class="icon"><i _ngcontent-tnh-c216="" class="fa fa-plus-circle"></i></div>
                                            <!---->
                                            <div _ngcontent-tnh-c216="" class="caption">Add a Friend</div>
                                            <!---->
                                        </div>
                                        <!---->
                                    </div>
                                </app-button>
                            </div>
                            <div _ngcontent-tnh-c225="" class="content" style="margin-bottom: 0; padding-bottom: 0;">
                                <div _ngcontent-tnh-c225="" class="section-category tabs">
                                    <h4 _ngcontent-tnh-c225="" tabindex="0" class="selected">My Friends</h4>
                                    <h4 _ngcontent-tnh-c225="" tabindex="0" class="" onClick="changeCurrentPage('friends', 'pending', 8)"> Pending <?php if($pending_count > 0) { ?><span _ngcontent-tnh-c225="" class="pending-count"> <?php echo $pending_count; ?> </span><?php } ?>
                                        <!---->
                                    </h4>
                                </div>
                            </div>
                            <router-outlet _ngcontent-tnh-c225=""></router-outlet>
                            <app-friends-list _nghost-tnh-c226="">
                                <div _ngcontent-tnh-c226="" class="content">
									<?php if($friend_count_other == 0) { ?>
                                    <app-info-bar _ngcontent-tnh-c226="" type="info" class="cs-1" _nghost-tnh-c215="">
                                        <div _ngcontent-tnh-c215="" class="info infobar">
                                            <div _ngcontent-tnh-c215="" class="icon"><i _ngcontent-tnh-c215="" class="fa fa-fw fa-info-circle"></i></div>
                                            <div _ngcontent-tnh-c215="" class="message"> The game's no fun without friends. Add yours here to see what they're up to. </div>
                                        </div>
                                    </app-info-bar>
									<?php								
									} 
									else
									{

										for($i = 0; $i < $friend_count; ++$i)
										{									 
											if($friend_data[$i]['friendPending'] == 1) continue;
											
											$friend_id = $friend_data[$i]['ID'];
											$friend_name = $friend_data[$i]['friendName'];
											$idja = $friend_data[$i]['friendID'];
											
											if($friend_name == $username)
											{
												$friend_name = $friend_data[$i]['playerName'];
												$idja = $friend_data[$i]['playerID'];
											}
											
											$user_check_query = "SELECT `char_name`, `Level`, `Model` FROM `characters` WHERE `master` = '$idja' LIMIT 1";
											$res = mysqli_query($link, $user_check_query);																						
											
											?>
									<div _ngcontent-kjk-c226="" class="csquarterthird card border-color-transparent friend">
									<!---->											
                                        <div _ngcontent-kjk-c226="" class="card-title"><span _ngcontent-kjk-c226=""> <?php echo $friend_name; ?> <!----></span><i _ngcontent-kjk-c226="" title="Remove friend" class="far fa-fw fa-times color-tomato fl-ri cursor-pointer" onclick="function_RemoveFriend(<?php echo $friend_id; ?>)"></i></div>
                                        <?php
										while($result2 = mysqli_fetch_array($res, MYSQLI_ASSOC))
										{
											?>
										<div _ngcontent-kjk-c226="" class="character">
											<?php 

											for($x = 0; $x < sizeof($serverSkins); ++$x)
											{
												if($serverSkins[$x]["id"] == $result2['Model'])
												{
													$result2['Model'] = $serverSkins[$x]["name"];
													break;
												}
											}													

											?>
											<div _ngcontent-kjk-c226="" class="headshot" style="background-image: url(&quot;http://localhost/assets/skins_small/<?php echo $skinipau; ?>-240-400.png&quot;);"></div>
                                            <div _ngcontent-kjk-c226=""><span _ngcontent-kjk-c226="" class="strongish"> <?php echo $result2['char_name']; ?> </span><br _ngcontent-kjk-c226=""> Level <?php echo $result2['Level']; ?> </div>
                                        </div>
											<?php
										}
										?>
										<!---->
                                    </div>
                                    <!---->											
										
											<?php
											
											mysqli_free_result($res);
										}
	
									}
									?>
                                    <!---->
                                    <!---->
                                </div>
                            </app-friends-list>
                            <!---->   
                        </app-friends>
                        <!---->						
						
						<?php 
						} 
						
						?>
						
						<?php if(isset($link)) { mysqli_close($link); } ?>