						<?php 		

						require_once($_SERVER['DOCUMENT_ROOT'] . "/modules/core/header.php");
						
						if(empty($_GET['test'])) die();				
						
						if(!isset($link))
						{
							$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

							if($link === false) 
							{
								die("ERROR: Could not connect.");
							}	
						}

						$sqljaa = $_GET['test'];		

						$sqljaa = mysqli_escape_string($link, $sqljaa);	

						$user_check_query = "SELECT `char_name`, `Model`, `Faction` FROM characters WHERE `char_name` = '$sqljaa' AND `master` = '$playersqlid' LIMIT 1";
						$result = mysqli_query($link, $user_check_query);

						$rowcount = $result->num_rows;	

						if($rowcount == 0)
						{
							mysqli_free_result($result);
							
							//echo '<script>window.location.href = "http://localhost/panel/characters";</script>';
							
							?>
					
                        <router-outlet _ngcontent-tnh-c136="" class="router-outlet"></router-outlet>
                        <app-character _nghost-tnh-c145="">	
                            <div _ngcontent-tnh-c169="" class="content">
                                <app-info-bar _ngcontent-tnh-c169="" type="error" class="cs-1" _nghost-tnh-c215="">
                                    <div _ngcontent-tnh-c215="" class="error infobar">
                                        <div _ngcontent-tnh-c215="" class="icon"><i _ngcontent-tnh-c215="" class="fa fa-exclamation-triangle fa-fw"></i></div>
                                        <div _ngcontent-tnh-c215="" class="message">You don't have a character named <?php echo $sqljaa; ?></div>
                                    </div>
                                </app-info-bar>
                            </div>
                            <!---->
                            <!---->
                            <!---->
                        </app-character>
                        <!---->
					
							<?php 	
						}
						else
						{

						$result2 = mysqli_fetch_array($result, MYSQLI_ASSOC);

						$char_name = $result2['char_name'];	
						$Model = $result2['Model'];
						$Faction = $result2['Faction'];

						mysqli_free_result($result);

						if(!empty($_GET['update_skin']))
						{
							$Modeli = $_GET['update_skin'];
							
							for($x = 0; $x < sizeof($serverSkins); ++$x)
							{
								if($serverSkins[$x]["name"] == $Modeli)
								{
									$Model = $serverSkins[$x]["id"];
									break;
								}
							}								
							
							$user_check_query = "UPDATE characters SET Model = '$Model' WHERE char_name = '$sqljaa'";
							$result = mysqli_query($link, $user_check_query);
							
							updateCharacters($link, $playersqlid);
						}
						
						for($i = 0; $i < sizeof($serverSkins); ++$i)
						{
							if($serverSkins[$i]["id"] == $Model)
							{
								$skinipau = $serverSkins[$i]["name"];
								break;
							}
						}							
						
						?>
                        <router-outlet _ngcontent-tnh-c136="" class="router-outlet"></router-outlet>										
                        <app-character _nghost-tnh-c145="">	
                            <section _ngcontent-kjw-c163="" class="content-header">
                                <h3 _ngcontent-kjw-c163="">Skin Selection - <?php echo returnName($char_name); ?></h3>
                            </section>						
                            <div _ngcontent-tnh-c145="" class="content">
	                                <div _ngcontent-tnh-c163="" class="cshalf preview">
                                    <div _ngcontent-tnh-c163="" class="header"><span _ngcontent-tnh-c163="" id="skin_title" class="title">Skin #<?php echo $Model; ?> - <?php echo $skinipau; ?></span><span _ngcontent-tnh-c163="" class="credit">made by R*</span>
										<div id="save_skin_id" style="display: none;">	
                                        <app-button _ngcontent-tnh-c163="" caption="Use this skin" class="blue thin margin-top-10" _nghost-tnh-c216="" onclick="saveThisSkin2('<?php echo $char_name; ?>')">
                                            <div _ngcontent-tnh-c216="" class="btn-wrapper">
                                                <div _ngcontent-tnh-c216="" class="button">
                                                    <!---->
                                                    <div _ngcontent-tnh-c216="" class="caption">Use this skin</div>
                                                    <!---->
                                                </div>
                                                <!---->
                                            </div>
                                        </app-button>
										</div>
                                        <!---->
                                    </div>

                                    <iframe _ngcontent-tnh-c163="" name="<?php echo $skins[ $Model ]; ?>" class="scene" id="skin_src" src="http://localhost/assets/skins_small/<?php echo $skinipau; ?>-240-400.png" scrolling="no"></iframe>

                                    <!--<div _ngcontent-tnh-c163="" class="properties"><span _ngcontent-tnh-c163="">Male <i class="fa-fw fa fa-mars"></i><br></span><span _ngcontent-tnh-c163="">Hispanic <i class="fa-fw fa fa-globe-americas"></i><br></span><span _ngcontent-tnh-c163="">Athletic <i class="fa-fw fa fa-child"></i><br></span><span _ngcontent-tnh-c163="">Gang member <i class="fa-fw fa fa-angry"></i><br></span>
                                    
                                    </div>-->
                                    <!---->
                                </div>
                               <section _ngcontent-tnh-c163="" class="card cshalf grid grid-gap-10">
                                    <div _ngcontent-tnh-c163="" class="cs-1 card-title"><strong _ngcontent-tnh-c163=""><i _ngcontent-tnh-c163="" class="fa color-grey fa-filter"></i> Filter</strong><span _ngcontent-tnh-c163="" class="fl-ri color-grey cursor-pointer" onclick="resetFilter()">Reset Filter</span></div>
                                    <div _ngcontent-tnh-c163="" class="cshalf">
                                        <div _ngcontent-tnh-c163="">
                                            <ul _ngcontent-tnh-c163="" class="no-list-style margin-bottom-10">
                                                <li _ngcontent-tnh-c163="" class="skinFilterChoice" onClick="ChangeSkinGender(1)"><span _ngcontent-tnh-c163=""><i _ngcontent-tnh-c163="" id="gender1" class="color-grey far fa-fw fa-square"></i></span>
                                                    <!---->
                                                    <!---->Male </li>
                                                <li _ngcontent-tnh-c163="" class="skinFilterChoice" onClick="ChangeSkinGender(2)"><span _ngcontent-tnh-c163=""><i _ngcontent-tnh-c163="" id="gender2" class="color-grey far fa-fw fa-square"></i></span>
                                                    <!---->
                                                    <!---->Female </li>
                                                <!---->
                                            </ul>
                                            <!---->
                                        </div>
                                        <div _ngcontent-tnh-c163="">
                                            <ul _ngcontent-tnh-c163="" class="no-list-style margin-bottom-10">
                                                <li _ngcontent-tnh-c163="" class="skinFilterChoice" onClick="ChangeSkinRace(1)"><span _ngcontent-tnh-c163=""><i _ngcontent-tnh-c163="" id="race1" class="color-grey far fa-fw fa-square"></i></span>
                                                    <!---->
                                                    <!---->Caucasian </li>
                                                <li _ngcontent-tnh-c163="" class="skinFilterChoice" onClick="ChangeSkinRace(2)"><span _ngcontent-tnh-c163=""><i _ngcontent-tnh-c163="" id="race2" class="color-grey far fa-fw fa-square"></i></span>
                                                    <!---->
                                                    <!---->African American </li>
                                                <li _ngcontent-tnh-c163="" class="skinFilterChoice" onClick="ChangeSkinRace(3)"><span _ngcontent-tnh-c163=""><i _ngcontent-tnh-c163="" id="race3" class="color-grey far fa-fw fa-square"></i></span>
                                                    <!---->
                                                    <!---->Hispanic </li>
                                                <li _ngcontent-tnh-c163="" class="skinFilterChoice" onClick="ChangeSkinRace(4)"><span _ngcontent-tnh-c163=""><i _ngcontent-tnh-c163="" id="race4" class="color-grey far fa-fw fa-square"></i></span>
                                                    <!---->
                                                    <!---->Asian </li>
                                                <!---->
                                            </ul>
                                            <!---->
                                        </div>
                                        <div _ngcontent-tnh-c163="">
                                            <ul _ngcontent-tnh-c163="" class="no-list-style margin-bottom-10">
                                                <li _ngcontent-tnh-c163="" class="skinFilterChoice" onClick="ChangeSkinWeight(1)"><span _ngcontent-tnh-c163=""><i _ngcontent-tnh-c163="" id="weight1" class="color-grey far fa-fw fa-square"></i></span>
                                                    <!---->
                                                    <!---->Athletic </li>
                                                <li _ngcontent-tnh-c163="" class="skinFilterChoice" onClick="ChangeSkinWeight(2)"><span _ngcontent-tnh-c163=""><i _ngcontent-tnh-c163="" id="weight2" class="color-grey far fa-fw fa-square"></i></span>
                                                    <!---->
                                                    <!---->Overweight </li>
                                                <li _ngcontent-tnh-c163="" class="skinFilterChoice" onClick="ChangeSkinWeight(3)"><span _ngcontent-tnh-c163=""><i _ngcontent-tnh-c163="" id="weight3" class="color-grey far fa-fw fa-square"></i></span>
                                                    <!---->
                                                    <!---->Muscular </li>
                                                <!---->
                                            </ul>
                                            <!---->
                                        </div>
                                        <div _ngcontent-tnh-c163="">
                                            <!---->
                                        </div>
                                        <!---->
                                    </div>
                                    <div _ngcontent-tnh-c163="" class="cshalf">
                                        <div _ngcontent-tnh-c163="">
                                            <!---->
                                        </div>
                                        <div _ngcontent-tnh-c163="">
                                            <!---->
                                        </div>
                                        <div _ngcontent-tnh-c163="">
                                            <!---->
                                        </div>
                                        <div _ngcontent-tnh-c163="">
                                            <ul _ngcontent-tnh-c163="" class="no-list-style margin-bottom-10">
                                                <li _ngcontent-tnh-c163="" class="skinFilterChoice" onClick="ChangeSkinCategory(1)"><span _ngcontent-tnh-c163=""><i _ngcontent-tnh-c163="" id="category1" class="color-grey far fa-fw fa-square"></i></span>
                                                    <!---->
                                                    <!---->Civilian </li>
                                                <li _ngcontent-tnh-c163="" class="skinFilterChoice" onClick="ChangeSkinCategory(2)"><span _ngcontent-tnh-c163=""><i _ngcontent-tnh-c163="" id="category2" class="color-grey far fa-fw fa-square"></i></span>
                                                    <!---->
                                                    <!---->Gang member </li>
                                                <li _ngcontent-tnh-c163="" class="skinFilterChoice" onClick="ChangeSkinCategory(3)"><span _ngcontent-tnh-c163=""><i _ngcontent-tnh-c163="" id="category3" class="color-grey far fa-fw fa-square"></i></span>
                                                    <!---->
                                                    <!---->Country &amp; Old people </li>
                                                <li _ngcontent-tnh-c163="" class="skinFilterChoice" onClick="ChangeSkinCategory(4)"><span _ngcontent-tnh-c163=""><i _ngcontent-tnh-c163="" id="category4" class="color-grey far fa-fw fa-square"></i></span>
                                                    <!---->
                                                    <!---->Prostitutes </li>
                                                <li _ngcontent-tnh-c163="" class="skinFilterChoice" onClick="ChangeSkinCategory(5)"><span _ngcontent-tnh-c163=""><i _ngcontent-tnh-c163="" id="category5" class="color-grey far fa-fw fa-square"></i></span>
                                                    <!---->
                                                    <!---->Sportsmen </li>
                                                <li _ngcontent-tnh-c163="" class="skinFilterChoice" onClick="ChangeSkinCategory(6)"><span _ngcontent-tnh-c163=""><i _ngcontent-tnh-c163="" id="category6" class="color-grey far fa-fw fa-square"></i></span>
                                                    <!---->
                                                    <!---->Specific Professions </li>
                                                <li _ngcontent-tnh-c163="" class="skinFilterChoice" onClick="ChangeSkinCategory(7)"><span _ngcontent-tnh-c163=""><i _ngcontent-tnh-c163="" id="category7" class="color-grey far fa-fw fa-square"></i></span>
                                                    <!---->
                                                    <!---->Beach Visitors </li>
                                                <li _ngcontent-tnh-c163="" class="skinFilterChoice" onClick="ChangeSkinCategory(8)"><span _ngcontent-tnh-c163=""><i _ngcontent-tnh-c163="" id="category8" class="color-grey far fa-fw fa-square"></i></span>
                                                    <!---->
                                                    <!---->Homeless </li>
                                                <!---->
                                            </ul>
                                            <!---->
                                        </div>
                                        <!---->
                                    </div>
                                </section>								
                                <div _ngcontent-tnh-c163="" class="section-category">
                                    <h4 _ngcontent-tnh-c163="" id="skinHeader">Found 0 skins matching your criteria</h4>
                                </div>
                                <section _ngcontent-tnh-c163="" class="skins cs-1 card" id="skins_content">


                                    <!--
                                    <app-button _ngcontent-tnh-c163="" class="cs-1 blue text-center" _nghost-tnh-c216="" onclick="showMoreSkins(50)">
                                        <div _ngcontent-tnh-c216="" class="btn-wrapper">
                                            <div _ngcontent-tnh-c216="" class="button">
                                                <div _ngcontent-tnh-c216="" class="caption">Show 50 more skins</div>
                                            </div>
                                        </div>
                                    </app-button>
                                    -->
                                </section>	
                                <!---->
                            </div>
                            <!---->
                        </app-character>
                        <!---->
	
						<script>
						//refreshSkins();
						
						var data = "";
						
						var showPage = 1;
						
						var f_skin_race = -1;
						
						var f_skin_gender = -1;
						
						var f_skin_weight = -1;
						
						var f_skin_category = -1;
						
						var faction = <?php echo $Faction; ?>;
						
						var skins_found = 0;
						
						function ChangeSkinRace(id)
						{							
							if(f_skin_race != -1) document.getElementById('race' + f_skin_race).className = "color-grey far fa-fw fa-square";					
							
							if(f_skin_race == id)
							{
								f_skin_race = -1;
							}
							else 
							{
								f_skin_race = id;
								
								document.getElementById('race' + id).className = "color-blue fa fa-fw fa-check-square";	
							}

							refreshSkins2(50);	
						}						
		
						function ChangeSkinGender(id)
						{							
							if(f_skin_gender != -1) document.getElementById('gender' + f_skin_gender).className = "color-grey far fa-fw fa-square";					
							
							if(f_skin_gender == id)
							{
								f_skin_gender = -1;
							}
							else 
							{
								f_skin_gender = id;
								
								document.getElementById('gender' + id).className = "color-blue fa fa-fw fa-check-square";	
							}

							refreshSkins2(50);	
						}
		
						function ChangeSkinWeight(id)
						{							
							if(f_skin_weight != -1) document.getElementById('weight' + f_skin_weight).className = "color-grey far fa-fw fa-square";					
							
							if(f_skin_weight == id)
							{
								f_skin_weight = -1;
							}
							else 
							{
								f_skin_weight = id;
								
								document.getElementById('weight' + id).className = "color-blue fa fa-fw fa-check-square";	
							}

							refreshSkins2(50);	
						}						
						
						function ChangeSkinCategory(id)
						{							
							if(f_skin_category != -1) document.getElementById('category' + f_skin_category).className = "color-grey far fa-fw fa-square";					
							
							if(f_skin_category == id)
							{
								f_skin_category = -1;
							}
							else 
							{
								f_skin_category = id;
								
								document.getElementById('category' + id).className = "color-blue fa fa-fw fa-check-square";	
							}

							refreshSkins2(50);	
						}
						
						function resetFilter()
						{
							if(f_skin_race != -1) document.getElementById('race' + f_skin_race).className = "color-grey far fa-fw fa-square";	
							if(f_skin_gender != -1) document.getElementById('gender' + f_skin_gender).className = "color-grey far fa-fw fa-square";	
							if(f_skin_weight != -1) document.getElementById('weight' + f_skin_weight).className = "color-grey far fa-fw fa-square";	
							if(f_skin_category != -1) document.getElementById('category' + f_skin_category).className = "color-grey far fa-fw fa-square";
							
							f_skin_race = -1;
						
							f_skin_gender = -1;
						
							f_skin_weight = -1;
						
							f_skin_category = -1;		
							
							refreshSkins2(50);	
						}
						
						var idx = 0;

						function refreshSkins2()
						{
							$.post('http://localhost/api/skinload.php', {race: f_skin_race, gender: f_skin_gender, weight: f_skin_weight, category: f_skin_category, faction_id: faction}).done(function(response) 
							{
								data = JSON.parse(response);
								
								var length = data.length;
								
								//console.log(data.length);
								
								var html = ""; var count = 0;
								
								document.getElementById('skinHeader').innerHTML = 'Found ' + length + ' skins matching your criteria';
								
								idx = 6;
								
								for (i = 0; i < length; i++) 
								{
									if(count == 6) break;
																	
									var link = "";
										
									var skinid = data[i]['id'];
										
									link = "http://localhost/assets/skins_small/" + data[i]['name'] + '-240-400.png'; 
										
									html += '<div _ngcontent-tnh-c163="" class="skin" style="background-image: url(&quot;' + link + '&quot;);" onclick="selectSkin2(' + data[i]['id'] + ', ' + "'" + data[i]['name'] + "'" + ')"></div>';
									
									count ++;
								}
								
								if(idx < length) 
								{									
									var skins_left = length - idx;
									
									if(skins_left >= 50) skins_left = 50;
									
									html += '<app-button _ngcontent-tnh-c163="" class="cs-1 blue text-center" _nghost-tnh-c216="" onclick="showMoreSkins(' + skins_left + ')"> <div _ngcontent-tnh-c216="" class="btn-wrapper"> <div _ngcontent-tnh-c216="" class="button"> <div _ngcontent-tnh-c216="" class="caption">Show ' + skins_left + ' more skins</div> </div> </div> </app-button>';
								}
								
								document.getElementById('skins_content').innerHTML = html;
							});														
						}
						
						function showMoreSkins(moreskins)
						{					
							var length = data.length;
						
							if(idx != length)
							{							
								idx += moreskins;
								
								var html = ""; var count = 0;
									
								for (i = 0; i < length; i++) 
								{
									if(count == idx) break;
									
									var link = "";
										
									var skinid = data[i]['id'];
										
									link = "http://localhost/assets/skins_small/" + data[i]['name'] + '-240-400.png'; 									
										
									html += '<div _ngcontent-tnh-c163="" class="skin" style="background-image: url(&quot;' + link + '&quot;);" onclick="selectSkin2(' + data[i]['id'] + ', ' + "'" + data[i]['name'] + "'" + ')"></div>';
									
									count ++;
								}
								
								if(idx < length) 
								{
									var skins_left = length - idx;
									
									if(skins_left >= 50) skins_left = 50;
									
									html += '<app-button _ngcontent-tnh-c163="" class="cs-1 blue text-center" _nghost-tnh-c216="" onclick="showMoreSkins(' + skins_left + ')"> <div _ngcontent-tnh-c216="" class="btn-wrapper"> <div _ngcontent-tnh-c216="" class="button"> <div _ngcontent-tnh-c216="" class="caption">Show ' + skins_left + ' more skins</div> </div> </div> </app-button>';
								}
								
								document.getElementById('skins_content').innerHTML = html;	
							}
						}
						
						refreshSkins2(6);

						function selectSkin2(skinid, skinname) 
						{
							var test = "http://localhost/assets/skins_small/" + skinname + "-240-400.png", src_idx = document.getElementById("skin_src");
							
							src_idx.src = test;
							src_idx.name = skinname;
							
							document.getElementById("skin_title").innerHTML = "Skin #" + skinid + " - " + skinname;
							
							document.getElementById("save_skin_id").style.display = "block";
							
							$('html,body').scrollTop(0);
						}

						function saveThisSkin2(playerid) 
						{
							var skinid = document.getElementById("skin_src").name;
							
							document.location.href = 'http://localhost/panel/change_skin/' + playerid + '/' + skinid;
						}			

						/*
						color-grey far fa-fw fa-square
						*/
					
						</script>
						
						<?php 
						
						} 
						
						?>
						
						<?php if(isset($link)) { mysqli_close($link); } ?>