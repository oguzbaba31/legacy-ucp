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

						if(!empty($_GET['test']))
						{																		
							$notifid = $_GET['test'];
							
							$notifid = mysqli_escape_string($link, $notifid);	
							
							$user_check_query = "SELECT * FROM notifications WHERE `ID` = '$notifid' LIMIT 1";
							$result = mysqli_query($link, $user_check_query);

							$rowcount = $result->num_rows;	

							if($rowcount == 0) die();

							if(!empty($_GET['delete']) && is_numeric($_GET['delete']))
							{
								if($_GET['delete'] == 1)
								{
									$user_check_query = "DELETE FROM notifications WHERE `ID` = '$notifid' LIMIT 1";
									$result = mysqli_query($link, $user_check_query);		
									
									//require_once("inbox.php");
									
									//header("Location: http://localhost/panel/inbox/");
									echo '<script>window.location.href = "http://localhost/panel/inbox/";</script>';
									exit;		
								}
							}

							$result2 = mysqli_fetch_array($result, MYSQLI_ASSOC);						

							$master = $result2['master'];	

							if($master != $playersqlid) die();

							$sender = $result2['sender'];	
							$title = $result2['title'];				
							$body = $result2['body'];
							$read = $result2['read'];
							$time = $result2['time'];											

							mysqli_free_result($result);

							if($read == 0)
							{
								$user_check_query = "UPDATE `notifications` SET `read` = '1' WHERE `ID` = '$notifid'";
								$result = mysqli_query($link, $user_check_query);
							}

						?>
						
                        <router-outlet _ngcontent-tnh-c136="" class="router-outlet"></router-outlet>
                        <app-message _nghost-tnh-c172="">
                            <div _ngcontent-tnh-c172="" class="content-header">
                                <h3 _ngcontent-tnh-c172=""> « <?php echo $title; ?> » </h3>
                                <app-button _ngcontent-tnh-c172="" icon="fa fa-trash-alt" caption="Delete" class="fl-ri tomato" _nghost-tnh-c216="" onclick="document.location.href='http://localhost/panel/inbox/<?php echo $notifid; ?>&delete=1'">
                                    <div _ngcontent-tnh-c216="" class="btn-wrapper">
                                        <div _ngcontent-tnh-c216="" class="button">
                                            <div _ngcontent-tnh-c216="" class="icon"><i _ngcontent-tnh-c216="" class="fa fa-trash-alt"></i></div>
                                            <!---->
                                            <div _ngcontent-tnh-c216="" class="caption">Delete</div>
                                            <!---->
                                        </div>
                                        <!---->
                                    </div>
                                </app-button>
                            </div>
                            <!---->
                            <div _ngcontent-tnh-c172="" class="content">
                                <section _ngcontent-tnh-c172="" class="csquarter card"><i _ngcontent-tnh-c172="" class="color-blue fa fa-fw fa-hashtag"></i> <?php echo $notifid; ?><br _ngcontent-tnh-c172=""><i _ngcontent-tnh-c172="" class="color-blue fa fa-fw fa-user-tie"></i> <?php echo $sender; ?><br _ngcontent-tnh-c172=""><i _ngcontent-tnh-c172="" class="color-blue fa fa-fw fa-calendar"></i> <?php echo $time; ?><br _ngcontent-tnh-c172=""></section>
                                <section _ngcontent-tnh-c172="" class="csthreequarters card message"><?php echo $body; ?></section>
                            </div>
                            <!---->
                        </app-message>						
                        <!---->
						
						<?php } else { ?>

                       <router-outlet _ngcontent-tnh-c136="" class="router-outlet"></router-outlet>
                       <app-inbox _nghost-tnh-c170="">
                            <section _ngcontent-tnh-c170="" class="content-header">
                                <h3 _ngcontent-tnh-c170="">Inbox</h3>
                            </section>
                            <div _ngcontent-tnh-c170="" class="content">
                                <app-table _ngcontent-tnh-c170="" class="cs-1" _nghost-tnh-c167="">
                                    <div _ngcontent-tnh-c167="">
                                        <header _ngcontent-tnh-c167="">
                                            <div _ngcontent-tnh-c167="" class="pagination"><a _ngcontent-tnh-c167="" class="page"><i _ngcontent-tnh-c167="" class="fa fa-fw fa-caret-square-left"></i></a>
                                                <!---->
                                                <!---->
                                                <!----><a _ngcontent-tnh-c167="" class="page current">1</a>
                                                <!---->
                                                <!---->
                                                <!----><a _ngcontent-tnh-c167="" class="page"><i _ngcontent-tnh-c167="" class="fa fa-fw fa-caret-square-right"></i></a></div>
                                        </header>
                                        <!---->
                                        <table _ngcontent-tnh-c167="" cellspacing="0">
                                            <thead _ngcontent-tnh-c167="">
                                                <tr _ngcontent-tnh-c167="">
                                                    <!---->
                                                    <th _ngcontent-tnh-c167="">
                                                        <!---->
                                                    </th>
                                                    <th _ngcontent-tnh-c167=""> from
                                                        <!---->
                                                    </th>
                                                    <th _ngcontent-tnh-c167=""> subject
                                                        <!---->
                                                    </th>
                                                    <th _ngcontent-tnh-c167=""> date
                                                        <!---->
                                                    </th>
                                                    <!---->
                                                </tr>
                                            </thead>
                                            <!---->
                                            <tbody _ngcontent-tnh-c167="">
												<?php	
												$user_check_query = "SELECT `ID`, `sender`, `title`, `time`, `read` FROM notifications WHERE `master` = '$playersqlid' AND `friend` = '0'";
												$res = mysqli_query($link, $user_check_query);								

												while($result2 = mysqli_fetch_array($res, MYSQLI_ASSOC))
												{
													$notifidd = $result2['ID'];
													$sender = $result2['sender'];				
													$title = $result2['title'];
													$time = $result2['time'];		
													$read = $result2['read'];	
													
													?>									
												
													<tr _ngcontent-tnh-c167="" class="cursor-pointer" tabindex="0" onClick="changeCurrentPage('inbox', '<?php echo $notifidd; ?>', 3)" <?php if($read == 0) { ?>style="background:#f4f4f4;"<?php } ?>>
														<td _ngcontent-tnh-c167=""><span _ngcontent-tnh-c167=""><i class="fal fa-fw color-blue fa-envelope<?php if($read == 1) { ?>-open<?php } ?>"></i></span></td>
														<td _ngcontent-tnh-c167=""><span _ngcontent-tnh-c167=""><?php echo $sender; ?></span></td>
														<td _ngcontent-tnh-c167=""><span _ngcontent-tnh-c167=""><?php echo $title; ?></span></td>
														<td _ngcontent-tnh-c167=""><span _ngcontent-tnh-c167=""><?php echo $time; ?></span></td>
													</tr>
												
												<?php 
												} 
												
												mysqli_free_result($res);
												?>												
                                                <!---->
                                            </tbody>
                                            <!---->
                                        </table>
                                        <footer _ngcontent-tnh-c167="">
                                            <div _ngcontent-tnh-c167="" class="pagination"><a _ngcontent-tnh-c167="" class="page"><i _ngcontent-tnh-c167="" class="fa fa-fw fa-caret-square-left"></i></a>
                                                <!---->
                                                <!---->
                                                <!----><a _ngcontent-tnh-c167="" class="page current">1</a>
                                                <!---->
                                                <!---->
                                                <!----><a _ngcontent-tnh-c167="" class="page"><i _ngcontent-tnh-c167="" class="fa fa-fw fa-caret-square-right"></i></a></div><span _ngcontent-tnh-c167="" class="info"><i _ngcontent-tnh-c167="" class="fa fa-fw fa-info-circle"></i> Showing 1 entries of 1</span></footer>
                                        <!---->
                                    </div>
                                    <!---->
                                    <!---->
                                </app-table>
                            </div>
                        </app-inbox>						
                        <!---->
						
						<?php if(isset($link)) { mysqli_close($link); } ?>
						<?php } ?>