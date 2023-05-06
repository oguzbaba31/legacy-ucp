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

						$user_check_query = "SELECT `char_name`, `Online`, `CarLic`, `WepLic`, `CCWLicense`, `ID`, `PlayingHours`, `PlayingSeconds`, `PhoneNumbr`, `BankAccount`, `Cash`, `Model`, `PayCheck`, `Savings` FROM characters WHERE `char_name` = '$sqljaa' AND `master` = '$playersqlid' LIMIT 1";
						$result = mysqli_query($link, $user_check_query);

						$rowcount = $result->num_rows;	

						if($rowcount == 0)
						{
							mysqli_free_result($result);
							
							//echo '<script>window.location.href = "http://localhost/panel/characters";</script>';
							
							?>
					
                        <router-outlet _ngcontent-tnh-c136="" class="router-outlet"></router-outlet>
                        <app-vehicle _nghost-tnh-c164="">
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
                        </app-vehicle>
                        <!---->
					
							<?php 	
						}
						else
						{

						$result2 = mysqli_fetch_array($result, MYSQLI_ASSOC);

						$playerid = $result2['ID'];	
						$Online = $result2['Online'];	
						$emni = $result2['char_name'];
						$number = $result2['PhoneNumbr'];		
						$bank = $result2['BankAccount'];
						$cash = $result2['Cash'];		
						$hours = $result2['PlayingHours'];
						$seconds = $result2['PlayingSeconds'];
						$totaltime = ($hours * 3600) + $seconds;
						
						$PayCheck = $result2['PayCheck'];
						$Savings = $result2['Savings'];
						$Model = $result2['Model'];
							
						$CarLic = $result2['CarLic'];
						$WepLic = $result2['WepLic'];
						$CCWLicense = $result2['CCWLicense'];
							
						$count = 0;
						$str_1 = "";
						$str_2 = "";
							
						if($CarLic > 0)
						{
							$str_1 = "Driver";
							$count++;
						}
						if($WepLic > 0)
						{
							if($CCWLicense)
							{
								if($count) $str_2 = ", Weapon (CCW)";
								else $str_2 = "Weapon (CCW)";			
							}
							else
							{
								if($count) $str_2 = ", Weapon";
								else $str_2 = "Weapon";
							}
								
							$count++;
						}	
							
						if($count == 0) $str_e = "None"; 
						else $str_e = $str_1.$str_2;

						mysqli_free_result($result);
						
						?>
						
                        <router-outlet _ngcontent-tnh-c136="" class="router-outlet"></router-outlet>
                        <app-character _nghost-tnh-c145="">
                            <!---->
                            <div _ngcontent-tnh-c145="" class="content-header">							
                                <h3 _ngcontent-tnh-c145=""> <?php echo returnName($emni); ?> <?php if($Online == 1) { ?><i _ngcontent-tnh-c145="" class="fa fa-fw color-green fa-gamepad ng-star-inserted"></i><?php } ?>
                                    <!---->
                                </h3>
                            </div>				
                            <!---->													
							
							<div id="charname2" style="display: none;"><?php echo $emni; ?></div>
                            <div _ngcontent-tnh-c145="" class="content">
                                <section _ngcontent-tnh-c145="" class="csthird card cursor-pointer" tabindex="0" onclick="changeCurrentPage('change_skin', '<?php echo $emni; ?>', 2)"><span _ngcontent-tnh-c145="" class="card-title"><i _ngcontent-tnh-c145="" class="fa fa-fw fa-child color-blue"></i><strong _ngcontent-tnh-c145=""> Change Skin</strong></span>
								<?php
								
								for($x = 0; $x < sizeof($serverSkins); ++$x)
								{
									if($serverSkins[$x]["id"] == $Model)
									{
										$Model = $serverSkins[$x]["name"];
										break;
									}
								}								

								?>
									<div _ngcontent-tnh-c145="" class="text-center"><img _ngcontent-tnh-c145="" src="http://localhost/assets/skins_small/<?php echo $Model; ?>-240-400.png"></div>
								</section>
                                <section _ngcontent-tnh-c145="" class="cstwothirds nopadding transparent grid grid-gap-10">
                                    <section _ngcontent-tnh-c145="" class="cs-1 card"><span _ngcontent-tnh-c145="" class="card-title"><i _ngcontent-tnh-c145="" class="fa fa-fw fa-user-ninja color-blue"></i><strong _ngcontent-tnh-c145=""> Out of character</strong></span>
                                        <table _ngcontent-tnh-c145="" cellspacing="0" class="onedimension">
                                            <tr _ngcontent-tnh-c145="">
                                                <td _ngcontent-tnh-c145="">Player #</td>
                                                <td _ngcontent-tnh-c145=""><?php echo $playerid; ?></td>
                                            </tr>
                                            <tr _ngcontent-tnh-c145="">
                                                <td _ngcontent-tnh-c145="">Donation</td>
                                                <td _ngcontent-tnh-c145="">None</td>
                                            </tr>
                                            <tr _ngcontent-tnh-c145="">
                                                <td _ngcontent-tnh-c145="">Time played</td>
                                                <td _ngcontent-tnh-c145=""><?php echo convertSeconds($totaltime); ?> </td>
                                                <!---->
                                            </tr>
                                        </table>
                                    </section>
                                    <section _ngcontent-tnh-c145="" class="cs-1 card"><span _ngcontent-tnh-c145="" class="card-title"><i _ngcontent-tnh-c145="" class="fa fa-fw fa-gamepad color-blue"></i><strong _ngcontent-tnh-c145=""> In character</strong></span>
                                        <table _ngcontent-tnh-c145="" cellspacing="0" class="onedimension">
                                            <tr _ngcontent-tnh-c145="">
                                                <td _ngcontent-tnh-c145="">Name</td>
                                                <td _ngcontent-tnh-c145=""> <?php echo $emni; ?> <!--<i _ngcontent-tnh-c145="" title="Change Name" class="fa fa-fw fa-pencil color-blue cursor-pointer" onclick="PLAYER_NAMECHANGE('<?php echo $emni; ?>')"></i>--></td>
                                            </tr>
                                            <tr _ngcontent-tnh-c145="">
                                                <td _ngcontent-tnh-c145="">Phone Number</td>
                                                <td _ngcontent-tnh-c145=""> <?php echo $number; ?></td>
                                            </tr>
                                            <tr _ngcontent-tnh-c145="">
                                                <td _ngcontent-tnh-c145="">Money</td>
                                                <td _ngcontent-tnh-c145=""><i _ngcontent-tnh-c145="" class="fa fa-dollar-sign <?php if($cash > 0) { ?>color-green<?php } ?>"></i> <?php echo number_format($cash); ?> </td>
                                            </tr>
                                            <tr _ngcontent-tnh-c145="">
                                                <td _ngcontent-tnh-c145="">Bank Balance</td>
                                                <td _ngcontent-tnh-c145=""><i _ngcontent-tnh-c145="" class="fa fa-dollar-sign <?php if($bank > 0) { ?>color-green<?php } ?>"></i> <?php echo number_format($bank); ?> </td>
                                            </tr>
                                            <tr _ngcontent-tnh-c145="">
                                                <td _ngcontent-tnh-c145="">Savings</td>
                                                <td _ngcontent-tnh-c145=""><i _ngcontent-tnh-c145="" class="fa fa-dollar-sign <?php if($Savings > 0) { ?>color-green<?php } ?>"></i> <?php echo number_format($Savings); ?> </td>
                                            </tr>
                                            <tr _ngcontent-tnh-c145="">
                                                <td _ngcontent-tnh-c145="">Paycheck</td>
                                                <td _ngcontent-tnh-c145=""><i _ngcontent-tnh-c145="" class="fa fa-dollar-sign <?php if($PayCheck > 0) { ?>color-green<?php } ?>"></i> <?php echo number_format($PayCheck); ?> </td>
                                            </tr>
                                            <tr _ngcontent-tnh-c145="">
                                                <td _ngcontent-tnh-c145="">Licenses</td>
                                                <td _ngcontent-tnh-c145="" class="commaList"><span _ngcontent-tnh-c145="" translate=""><?php echo $str_e; ?></span>
                                                    <!---->
                                                </td>
                                            </tr>
                                            <tr _ngcontent-tnh-c145="">
                                                <td _ngcontent-tnh-c145="">Fighting Style</td>
                                                <td _ngcontent-tnh-c145=""> Normal <!--<i _ngcontent-tnh-c145="" title="Change Fighting Style" class="fa fa-fw fa-pencil color-blue cursor-pointer" onclick="function_FStyleChange('<?php echo $emni; ?>')"></i>--></td>
                                            </tr>
                                        </table>
                                    </section>
                                </section>
										
								<?php		
								$user_check_query = "SELECT `carID`, `carModel`, `carMileage`, `carPlate`, `carHealth`, `carColor1`, `carColor2`, `carBatteryL` FROM `cars` WHERE `carOwner` = '$playerid' LIMIT 12";
								$res = mysqli_query($link, $user_check_query);	

								$rowcount = $res->num_rows;
								
								if($rowcount > 0)
								{
									?>
                                <div _ngcontent-tnh-c145="" class="section-category">
                                    <h4 _ngcontent-tnh-c145="">Vehicles</h4>
                                </div>
                                <!---->									
									<?php									

									while($result2 = mysqli_fetch_array($res, MYSQLI_ASSOC))
									{
										$carID = $result2['carID'];	
										$carModel = $result2['carModel'];			
										$carMileage = $result2['carMileage'];		
										$carPlate = $result2['carPlate'];
										$carHealth = $result2['carHealth'];		
										$carColor1 = $result2['carColor1'];	
										$carColor2 = $result2['carColor2'];	
										$carBatteryL = $result2['carBatteryL'];													
										
										$meci = "";
										
										if($carBatteryL < 0.5)
										{
											$str = "slash";
											$meci = "color-red ";
										}
										else if($carBatteryL >= 0.5 && $carBatteryL < 25.0)
										{
											$str = "quarter";
											$meci = "color-orange ";
										}									
										else if($carBatteryL >= 25.0 && $carBatteryL < 52.0)
										{
											$str = "half";
										}
										else if($carBatteryL >= 52.0 && $carBatteryL < 75.0)
										{
											$str = "three-quarters";
										}									
										else if($carBatteryL > 75.0 && $carBatteryL <= 100.0)
										{
											$str = "full";
											$meci = "color-green ";
										}
										
										?>									
								
                                <section _ngcontent-tnh-c145="" class="transparent csquarterthird vehicle cursor-pointer" tabindex="0" onClick="changeCurrentPage('vehicle', '<?php echo $carID; ?>', 6)">
                                    <app-model-preview _ngcontent-tnh-c145="" scene="vehicle" padding="20" class="color-blue" _nghost-tnh-c166="">
                                        <div _ngcontent-tnh-c166="" class="previewContainer">
                                            <div _ngcontent-tnh-c166="" class="preview" style="background-image: url(&quot;http://localhost/vehicles/<?php echo $carModel; ?>.png&quot;); top: 20px; bottom: 20px; left: 20px; right: 20px;"></div>
                                            <!---->
											<!--<div _ngcontent-tnh-c166="" class="loader" id="loader"><i _ngcontent-tnh-c166="" class="fa fa-spinner-third fa-spin fa-fw"></i> Preview is being generated </div>-->
                                            <!----><span _ngcontent-tnh-c145="" class="title"><strong _ngcontent-tnh-c145=""><?php echo $cars[ $carModel - 400 ]; ?></strong> <?php echo $carPlate; ?></span>
                                            <div _ngcontent-tnh-c145="" class="fl-ri text-right"> <?php echo intval($carMileage); ?> miles <i _ngcontent-tnh-c145="" class="fa fa-fw fa-tachometer"></i><br _ngcontent-tnh-c145="">  <?php echo intval($carHealth); ?>% <i _ngcontent-tnh-c145="" class="fa fa-fw fa-heartbeat"></i><br _ngcontent-tnh-c145=""> <?php echo intval($carBatteryL); ?>% <i _ngcontent-tnh-c145="" class="<?php echo $meci; ?>fa fa-battery-<?php echo $str; ?> fa-fw"></i><br _ngcontent-tnh-c145=""></div>
                                            <div _ngcontent-tnh-c145="" title="Vehicle can be viewed in Virtual Garage" class="virtual-garage" onClick="window.location.href = 'http://localhost/panel/garage/<?php echo $carID; ?>';"><i _ngcontent-tnh-c145="" class="fa fa-fw fa-car-garage"></i></div>
                                            <!---->
                                        </div>
									</app-model-preview>
                                </section>
									
									<?php 
									}
								}
									
								$user_check_query = "SELECT id, posx, posy, info, complex FROM houses WHERE ownerSQLID = '$playerid'";
								$res = mysqli_query($link, $user_check_query);	

								$rowcount = $res->num_rows;
								
								if($rowcount > 0)
								{
									?>
								<div _ngcontent-tnh-c166="" class="section-category" *ngIf="character.properties.length">
									<h4>Properties</h4> 
								</div>
                                <!---->									
									<?php									

									while($result2 = mysqli_fetch_array($res, MYSQLI_ASSOC))
									{								
								
								?>
	
								<section _ngcontent-tnh-c166="" class="nopadding transparent csquarterthird property" *ngFor="let property of character.properties">
									<div _ngcontent-tnh-c219="" style="height: 175px">
									
									<!--
									                            "background-image": "url('https://m.nkar/w/tiles/render/" + o + ".jpg')",
                            "background-position": "calc(50% - " + Math.floor(t - n) + "px) calc(50% - " + Math.floor(e - r) + "px)"
							
					
									-->
									
									<?php
									$posi_x = $result2['posx'];
									$posi_y = $result2['posy'];
									
									$info = $result2['info'];
									$complex = $result2['complex'];
									
									if($complex == -1)
									{
										$icon = "fa-home";
										$type_text = "House";
									}
									else
									{
										$icon = "fa-building";
										$type_text = "Complex";										
									}
									
									$hehehehe_1 = 0;
									$hehehehe_2 = 0;
									
									$houseid = $result2['id'];
									$street = returnStreet($posi_x, $posi_y, $streets); 
									
									/*if($complex != -1)
									{
										$user_check_query = "SELECT `ePosX`, `ePosY` FROM `apartments` WHERE `ID` = '$complex'";
										$searchQuery2 = mysqli_query($link, $user_check_query);	
										
										$results2 = mysqli_fetch_array($searchQuery2, MYSQLI_ASSOC);
																						
										$posi_x = $results2['ePosX'];
										$posi_y = $results2['ePosY'];										

										mysql_free_result($searchQuery2);
									}*/
								
									$area = qomaLokacionin($posi_x, $posi_y, $zonat);
									$area_code = ReturnAreaCodeByName($area);
									$city = GetCity($posi_x, $posi_y, $cities);
									
									?>
									
										<app-map-section _ngcontent-tnh-c166="" [center_x]="property.entrance_x" [center_y]="property.entrance_y - 10" [isVector]="mapType"  routerLink="/panel/property/{{ property.id }}" class="cursor-pointer">
										<!--<div id="kari" style="background-image: url(&quot;https://m.ls-rp.com/w/tiles/render/500x500+<?php echo $posi_x; ?>+<?php echo $posi_y; ?>.jpg&quot;); background-position: calc(50% - <?php echo $hehehehe_1; ?>px) calc(50% - <?php echo $hehehehe_2; ?>px);">-->
										<div _ngcontent-tnh-c219="" class="map-section" style="background-image: url(&quot;http://localhost/map/?x=<?php echo $posi_x; ?>&y=<?php echo $posi_y; ?>&quot;); background-position: calc(-70px) calc(-5px);" onClick="changeCurrentPage('property', '<?php echo $houseid; ?>', 10)">
											<div _ngcontent-tnh-c166="" class="marker house" style="background: url('http://localhost/mapicons/house.gif'); background-size: 100%; background-repeat: no-repeat;"></div>						
											<div _ngcontent-tnh-c164="" class="marker"><i _ngcontent-tnh-c164="" class="fa fa-fw fa-home"></i></div> 
											<div _ngcontent-tnh-c166="" class="padding-5">
												<div _ngcontent-tnh-c166="" class="address fl-le"  [ngClass]="{\'color-white\': !mapType, \'text-shadow-thick\': !mapType, \'text-shadow-white\': mapType, \'color-blue\': mapType}"> <i class="fa fa-fw text-shadow-white <?php echo $icon; ?> color-blue"></i> <?php echo $houseid; ?> <?php echo $street; ?>, <?php echo $area; ?> <!--<?php echo $area_code; ?>, <?php echo $city; ?>--><!--{{ property.complex ? property.complex.id : property.id }} {{ property.address.street }}{{ property.complex ? \', APT. \' + property.id: \'\'}}--> </div>												
												<app-button _ngcontent-tnh-c145="" caption="Spawn Here" icon="fa-file-contract" class="fl-ri color-white thin blue shadow" _nghost-tnh-c216="" onClick="document.location.href='http://localhost/panel/property/<?php echo $houseid; ?>/changespawn';">
													<div _ngcontent-tnh-c216="" class="btn-wrapper">
														<div _ngcontent-tnh-c216="" class="button">
															<div _ngcontent-tnh-c216="" class="icon"><i _ngcontent-tnh-c216="" class="fa fa-compass"></i></div>
															<!----> 
															<div _ngcontent-tnh-c216="" class="caption">Spawn Here</div>
															<!---->
														</div>
														<!---->
													</div>
												</app-button>												
											</div>
											<div _ngcontent-tnh-c166="" class="section-description"> <?php echo $type_text; ?> in <?php echo qomaLokacionin($posi_x, $posi_y, $zonat); ?> </div> 
										</br></br></br></br></br></br></br></br>
										</div>
										</app-map-section _ngcontent-tnh-c166=""> 
									</div> 
								</section>
								
								<?php
								
									}
								}
									?>
								<!--<div _ngcontent-tnh-c166="" class="section-category" *ngIf="character.businesses.length">
									<h4>Businesses</h4> </div>
								<section _ngcontent-tnh-c166="" class="nopadding transparent csquarterthird cursor-pointer" *ngFor="let business of character.businesses"  routerLink="/panel/business/{{ business.id }}">
									<div _ngcontent-tnh-c166="" style="height: 175px">
										<app-map-section _ngcontent-tnh-c166="" [center_x]="business.entx" [center_y]="business.enty-10" [isVector]="mapType">
											<div _ngcontent-tnh-c166="" class="marker housered"></div>
											<div _ngcontent-tnh-c166="" class="padding-5">
												<div _ngcontent-tnh-c166="" class="address color-white"> <i class="fa fa-fw {{ UtilityService.getBusinessIcon(business.type) }}"></i> {{ business.nameClean }} <br> </div> </div>
											<div _ngcontent-tnh-c166="" class="section-description"> {{UtilityService.getBusinessTypeName(business.type)}} in {{business.address.district}}<br> </div> 
										</app-map-section _ngcontent-tnh-c166=""> 
									</div> 
								</section>	-->							
								<?php
								
								mysqli_free_result($res);
								?>
                                <!---->
                                <!---->
                                <!---->
                                <!---->
                                <!---->
                            </div>
                            <!---->
                        </app-character>								
                        <!---->
						
						<?php } ?>
						
						<?php if(isset($link)) { mysqli_close($link); } ?>