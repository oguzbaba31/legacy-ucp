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
																
							$user_check_query = "SELECT `ID`, `title`, `time`, `read`, `friend`, `sender` FROM `notifications` WHERE `master` = '$playersqlid' ORDER BY `ID` DESC LIMIT 4";
							$result = mysqli_query($link, $user_check_query);

							$notif_counti = $result->num_rows;
							$seen_count = 0;

							if($notif_counti > 0)
							{	
								$user_check_query = "SELECT `ID` FROM `notifications` WHERE `master` = '$playersqlid' AND `read` = '0' LIMIT 4";
								$result2 = mysqli_query($link, $user_check_query);
								
								$seen_count = $result2->num_rows;
							}

							?>

							<div id="test321"><?php echo $seen_count; ?></div>
							<div id="notif_update">
                                <header _ngcontent-tnh-c150="">
                                    <h2 _ngcontent-tnh-c150="">Notifications</h2><i _ngcontent-tnh-c150="" class="fal fa-fw fa-times fl-ri close cursor-pointer" onclick="toggleNotif()"></i></header>
                                <ul _ngcontent-tnh-c150="">
								<?php
								while($result2 = mysqli_fetch_array($result, MYSQLI_ASSOC))
								{
									$notifidd = $result2['ID'];
									$title_nav = $result2['title'];
									$time_nav = $result2['time'];
									$read_nav = $result2['read'];
									$friend_nav = $result2['friend'];
									
									if($friend_nav == 0)
									{
									
									?>
									<li _ngcontent-tnh-c150="" id="notfid_<?php echo $notifidd; ?>" class="<?php if($read_nav == 1) { ?>read<?php } else { ?>cursor-pointer<?php } ?>" onClick="document.location.href='http://localhost/panel/inbox/<?php echo $notifidd; ?>'"><i _ngcontent-tnh-c150="" class="fa fa-fw fa-bell icon"></i><span _ngcontent-tnh-c150="" class="label"> <?php echo $title_nav; ?> <span _ngcontent-tnh-c150="" class="time" title="<?php echo $time_nav; ?>"> <?php echo $time_nav; ?> </span></span>
									</li>
									<?php
									
									}
									else if($friend_nav == -1)
									{
										
									$sender_nav = $result2['sender'];	
										
									?>
									<li _ngcontent-tnh-c150="" id="notfid_<?php echo $notifidd; ?>" class="<?php if($read_nav == 1) { ?>read<?php } ?> cursor-pointer"><i _ngcontent-tnh-c150="" class="fa fa-fw fa-user-friends icon"></i><span _ngcontent-tnh-c150="" class="label"> <?php echo $sender_nav; ?> approved your friend request <span _ngcontent-tnh-c150="" class="time" title="<?php echo $time_nav; ?>"> <?php echo $time_nav; ?> </span></span>
                                    </li>
									<?php
									
									}									
									else
									{
										
									$sender_nav = $result2['sender'];	
										
									?>
									<li _ngcontent-tnh-c150="" id="notfid_<?php echo $notifidd; ?>" class="<?php if($read_nav == 1) { ?>read<?php } ?> cursor-pointer" onclick="function_AcceptFriend(<?php echo $friend_nav; ?>)"><i _ngcontent-tnh-c150="" class="fa fa-fw fa-user-friends icon"></i><span _ngcontent-tnh-c150="" class="label"> <?php echo $sender_nav; ?> sent you a friend request <span _ngcontent-tnh-c150="" class="time" title="<?php echo $time_nav; ?>"> <?php echo $time_nav; ?> </span></span>
                                    </li>
									<?php
									
									}
									
									$notif_count++;
								}

								mysqli_free_result($result);
								mysqli_close($link);
								?>
									 
                                    <!---->
                                </ul>
                                <footer _ngcontent-tnh-c150=""><a _ngcontent-tnh-c150="" href="javascript:void(0);" <?php if($notif_count > 0) { ?>onClick="document.location.href='http://localhost/mark_all_read.php?lasturl=http://localhost/panel/inbox<?php } ?>">Mark all read</a> | <a _ngcontent-tnh-c150="" href="javascript:void(0);" onclick="changeCurrentPage('inbox', '/panel/inbox')">Inbox</a> </footer>