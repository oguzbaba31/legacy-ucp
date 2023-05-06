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
						
						if(isset($_GET['app_id']))
						{
							?>
                        <app-index _nghost-tnh-c225="">
                            <div _ngcontent-tnh-c225="" class="content-header">
                                <h3 _ngcontent-tnh-c225=""> Master - <?php echo $_GET['app_id']; ?> </h3>
                            </div>							
							<div _ngcontent-tnh-c225="" class="content">
								<section _ngcontent-tnh-c144="" class="transparent grid-newline cs-1 form nopadding">									
									<div id="look_up_results">

									</div>									
								</section>							
							</div>																				
						</app-index>
						
						<script>
						var ToggleGeo = 0;
						
						function ToggleGeolocation()
						{
							if(ToggleGeo)
							{
								ToggleGeo = 0;
								
								document.getElementById("geobutton").innerHTML = '<a href="javascript:void(0)" onclick="ToggleGeolocation()">Click to show</a>';
								document.getElementById("geolocation2").style.display = 'none';
							}
							else
							{
								ToggleGeo = 1;
								
								document.getElementById("geobutton").innerHTML = '<a href="javascript:void(0)" onclick="ToggleGeolocation()">Click to hide</a>';
								document.getElementById("geolocation2").style.display = 'block';
							}
						}							
						
						var loadbar = document.getElementById('loadingbar');		
						loadbar.classList.add("active");							
						
						$("#look_up_results").load("http://localhost/admin/search_results.php?search_type=2&search_input=" + "<?php echo $_GET['app_id']; ?>", function() 
						{														
							loadbar.classList.remove("active");
						});						
						</script>
							<?php
						}
						else
						{
						
						?>
                        <router-outlet _ngcontent-tnh-c136="" class="router-outlet"></router-outlet>
                        <app-settings _nghost-tnh-c144="">
                            <div _ngcontent-tnh-c144="" class="content-header">
                                <h3 _ngcontent-tnh-c144="" style="display: inline;">Registered Accounts</h3>
                            </div>
                            <div _ngcontent-tnh-c144="" class="content">
								
								<section _ngcontent-tnh-c144="" class="transparent grid-newline cs-1 form nopadding">
									
								<app-table _ngcontent-tnh-c170="" class="cs-1" _nghost-tnh-c167="">
                                    <div _ngcontent-tnh-c167="">
                                        <header _ngcontent-tnh-c167="">
                                            <div _ngcontent-tnh-c167="" class="pagination"><a _ngcontent-tnh-c167="" class="page" onclick="changePage_Backward()"><i _ngcontent-tnh-c167="" class="fa fa-fw fa-caret-square-left"></i></a>
                                                <!---->
                                                <!---->
                                                <!----><a _ngcontent-tnh-c167="" class="page current" id="current_page_1">1</a>
                                                <!---->
                                                <!---->
                                                <!----><a _ngcontent-tnh-c167="" class="page" onclick="changePage_Forward()"><i _ngcontent-tnh-c167="" class="fa fa-fw fa-caret-square-right"></i></a></div>
                                        </header>
                                        <!---->
                                        <table _ngcontent-tnh-c167="" cellspacing="0">
                                            <thead _ngcontent-tnh-c167="">
                                                <tr _ngcontent-tnh-c167="">
                                                    <!---->
                                                    <th _ngcontent-tnh-c167="">
                                                        <!---->
                                                    </th>
                                                    <th _ngcontent-tnh-c167=""> User
                                                        <!---->
                                                    </th>
                                                    <th _ngcontent-tnh-c167=""> Email
                                                        <!---->
                                                    </th>
                                                    <th _ngcontent-tnh-c167=""> IP
                                                        <!---->
                                                    </th>
                                                    <th _ngcontent-tnh-c167=""> Register Date
                                                        <!---->
                                                    </th>													
                                                    <!---->
                                                </tr>
                                            </thead>
                                            <!---->
                                            <tbody _ngcontent-tnh-c167="">
																					
												
											<?php
													
													$user_check_query = "SELECT ID, Username, Email, IP, RegisterDate, LastIP FROM accounts ORDER BY ID DESC";
													$result = mysqli_query($link, $user_check_query);

													$rowcount = $result->num_rows;	
														
													if($rowcount > 0)
													{
														while($result2 = mysqli_fetch_array($result, MYSQLI_ASSOC))
														{
															$ID = $result2['ID'];
															$Username = $result2['Username'];		
															$Email = $result2['Email'];
															$IP = $result2['IP'];		
															$RegisterDate = $result2['RegisterDate'];
															$LastIP = $result2['LastIP'];

															$user_check_query = "SELECT `id` FROM `bans` WHERE `name` = '$Username' ORDER BY id DESC LIMIT 1"; 
															$result_2 = mysqli_query($link, $user_check_query);

															$rowcount = $result_2->num_rows;

															mysqli_free_result($result_2);

															if($rowcount > 0)
															{					
																$banned = true;			
															}			
															else $banned = false;															
															
															?>
														
													<tr _ngcontent-tnh-c167="" id="kari" <?php if($banned == true) { ?>class="color-red"<?php } ?>>
														<td _ngcontent-tnh-c167=""><span _ngcontent-tnh-c167=""><?php echo $ID; ?></span></td>
														<td _ngcontent-tnh-c167=""><span _ngcontent-tnh-c167=""><a href="http://localhost/admin/accounts/<?php echo $Username; ?>" target="_blank"><?php echo $Username; ?></a></span></td>
														<td _ngcontent-tnh-c167=""><span _ngcontent-tnh-c167=""><?php echo $Email; ?></span></td>
														<td _ngcontent-tnh-c167=""><span _ngcontent-tnh-c167=""><?php echo $IP; ?></span></td>
														<td _ngcontent-tnh-c167=""><span _ngcontent-tnh-c167=""><?php echo $RegisterDate; ?></span></td>
													</tr>
													
															<?php
														}
														
														mysqli_free_result($result);
													}
													
													?>
												
																								
                                                <!---->
                                            </tbody>
                                            <!---->
                                        </table>
                                        <footer _ngcontent-tnh-c167="">
                                            <div _ngcontent-tnh-c167="" class="pagination"><a _ngcontent-tnh-c167="" class="page" onclick="changePage_Backward()"><i _ngcontent-tnh-c167="" class="fa fa-fw fa-caret-square-left"></i></a>
                                                <!---->
                                                <!---->
                                                <!----><a _ngcontent-tnh-c167="" class="page current" id="current_page_2">1</a>
                                                <!---->
                                                <!---->
                                                <!----><a _ngcontent-tnh-c167="" class="page" onclick="changePage_Forward()"><i _ngcontent-tnh-c167="" class="fa fa-fw fa-caret-square-right"></i></a></div><span _ngcontent-tnh-c167="" class="info" id="paginatorilol"><i _ngcontent-tnh-c167="" class="fa fa-fw fa-info-circle"></i> Showing 1 entries of 1</span></footer>
                                        <!---->
                                    </div>
                                    <!---->
                                    <!---->
                                </app-table>									
									
								</section>
							</div>	
						</app-settings>
                        <!---->
						
						<script>
						
						var count = 0;	
						var perPage = 14;
						var index = -1;
						var current_page = 0;
						var last_count = 0;
						var tables = document.querySelectorAll("#kari");
						var currpage1 = document.getElementById("current_page_1");
						var currpage2 = document.getElementById("current_page_2");
							
						for(var i = 0; i < tables.length; i++) 
						{
							if(count >= perPage)
							{
								tables[i].style.display = 'none';
							}
							else 
							{
								index = i;
									
								last_count++;
							}
								
							count++;
						}
							
						if(count > 0)
						{
							current_page = 1;
								
							var pagess = maxPages();
								
							document.getElementById('paginatorilol').innerHTML = '<i _ngcontent-tnh-c167="" class="fa fa-fw fa-info-circle"></i> Showing ' + current_page + " entries of " + pagess;
						}
						else document.getElementById('paginatorilol').innerHTML = '<i _ngcontent-tnh-c167="" class="fa fa-fw fa-info-circle"></i> Showing entries 0 of 0';	

						currpage1.innerHTML = "1";
						currpage2.innerHTML = "1";
						
						function changePage_Backward()
						{
							if(current_page == 1) return false;
							
							var tables = document.querySelectorAll("#kari");
							
							for(var i = 0; i < tables.length; i++) 
							{							
								tables[i].style.display = 'none';
							}	
							
							count = 0;
							
							var idx = last_count;
							
							last_count = 0;

							for(var i = index - (idx - 1) - perPage; i < tables.length; i++) 
							{												
								if(count >= perPage)
								{
									tables[i].style.display = 'none';
								}
								else 
								{
									index = i;		
						
									tables[i].style.display = '';
									
									last_count++;
								}
								
								count++;
							}
							
							current_page--;
							
							currpage1.innerHTML = current_page;
							currpage2.innerHTML = current_page;
							
							var pagess = maxPages();
							
							document.getElementById('paginatorilol').innerHTML = '<i _ngcontent-tnh-c167="" class="fa fa-fw fa-info-circle"></i> Showing ' + current_page + " entries of " + pagess;
						}						
						
						function changePage_Forward()
						{
							if(current_page + 1 > maxPages()) return false;
							
							var tables = document.querySelectorAll("#kari");
							
							for(var i = 0; i < tables.length; i++) 
							{							
								tables[i].style.display = 'none';
							}	
							
							count = 0;
							
							var idx = last_count;
							
							last_count = 0;							

							for(var i = index + 1; i < tables.length; i++) 
							{												
								if(count >= perPage)
								{
									tables[i].style.display = 'none';
								}
								else 
								{
									index = i;	
						
									tables[i].style.display = '';
									
									last_count++;
								}
								
								count++;
							}													
							
							current_page++;
							
							currpage1.innerHTML = current_page;
							currpage2.innerHTML = current_page;							
							
							var pagess = maxPages();
							
							document.getElementById('paginatorilol').innerHTML = '<i _ngcontent-tnh-c167="" class="fa fa-fw fa-info-circle"></i> Showing ' + current_page + " entries of " + pagess;
						}
						
						function maxPages()
						{
							var tables = document.querySelectorAll("#kari");
							
							var pages = 0;
							var rows = 0;
							
							for(var i = 0; i < tables.length; i++) 
							{	
								if(rows == perPage)
								{
									rows = 0;
									
									pages++;
								}
						
								rows++;								
							}
							
							if(pages == 0 && rows > 0) pages = 1;
							
							if(rows < perPage && pages > 1) pages++;

							return pages;
						}						
											
						</script>
					
						<?php } ?>