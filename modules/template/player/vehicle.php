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

						$carsqlid = $_GET['test'];
						
						$carsqlid = mysqli_escape_string($link, $carsqlid);
						
						$user_check_query = "SELECT carOwner, carPosX, carPosY, carInsurance, carLock, carAlarm, carModel, carMileage, carPlate, carHealth, carColor1, carColor2, carBatteryL, carEngineL, carWeapon0, carWeapon1, carWeapon2, carWeapon3, carAmmo0, carAmmo1, carAmmo2, carAmmo3, carMod1, carMod2, carMod3, carMod4, carMod5, carMod6, carMod7, carMod8, carMod9, carMod10, carMod11, carMod12, carMod13, carMod14 FROM `cars` WHERE `carID` = '$carsqlid' LIMIT 1";
						$res = mysqli_query($link, $user_check_query);
						
						$rowcount = $res->num_rows;	
						
						if($rowcount < 1)
						{
							mysqli_free_result($res);
							
							//echo '<script>window.location.href = "http://localhost/panel/characters";</script>';
							
							?>
							
                        <router-outlet _ngcontent-tnh-c136="" class="router-outlet"></router-outlet>
                        <app-vehicle _nghost-tnh-c164="">
                            <div _ngcontent-tnh-c169="" class="content">
                                <app-info-bar _ngcontent-tnh-c169="" type="error" class="cs-1" _nghost-tnh-c215="">
                                    <div _ngcontent-tnh-c215="" class="error infobar">
                                        <div _ngcontent-tnh-c215="" class="icon"><i _ngcontent-tnh-c215="" class="fa fa-exclamation-triangle fa-fw"></i></div>
                                        <div _ngcontent-tnh-c215="" class="message">Invalid vehicle ID specified.</div>
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

						$result2 = mysqli_fetch_array($res, MYSQLI_ASSOC); 
						
						$carOwner = $result2['carOwner'];
						
						if(!playerHasCharacter($carOwner))
						{
							mysqli_free_result($res);
							
							?>
							
                        <router-outlet _ngcontent-tnh-c136="" class="router-outlet"></router-outlet>
                        <app-vehicle _nghost-tnh-c164="">
                            <div _ngcontent-tnh-c169="" class="content">
                                <app-info-bar _ngcontent-tnh-c169="" type="error" class="cs-1" _nghost-tnh-c215="">
                                    <div _ngcontent-tnh-c215="" class="error infobar">
                                        <div _ngcontent-tnh-c215="" class="icon"><i _ngcontent-tnh-c215="" class="fa fa-exclamation-triangle fa-fw"></i></div>
                                        <div _ngcontent-tnh-c215="" class="message">You're not the owner of this vehicle.</div>
                                    </div>
                                </app-info-bar>
                            </div>
                            <!---->
                            <!---->
                            <!---->
                        </app-vehicle>
                        <!---->	
						
							<?php
							return;
						}
						
						$carWeapons = array(0, 0, 0, 0);
						$weapon_count = 0;
						$carAmmo = array(0, 0, 0, 0);
						
						for($i = 0; $i < 4; ++$i)
						{							
							if($result2["carWeapon" . $i] != 0)
							{
								$weapon_count ++;
								
								$carWeapons[$i] = $result2["carWeapon" . $i];
								$carAmmuntion[$i] = $result2["carAmmo" . $i];
							}
						}
						
						$carMods = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
						$mods_count = 0;
						
						for($m = 0; $m < 15; $m++)
						{
							$idx = $m + 1;
					
							if($result2["carMod" . $idx] != 0)
							{
								$mods_count ++;
								
								$carMods[$m] = $result2["carMod" . $idx];
							}
						}			

						$carModel = $result2['carModel'];			
						$carMileage = $result2['carMileage'];		
						$carPlate = $result2['carPlate'];
						$carHealth = $result2['carHealth'];		
						$carColor1 = $result2['carColor1'];	
						$carColor2 = $result2['carColor2'];	
						$carBatteryL = $result2['carBatteryL'];
						$carEngineL = $result2['carEngineL'];
						$carLock = $result2['carLock'];
						$carAlarm = $result2['carAlarm'];
						$carInsurance = $result2['carInsurance'];

						$x = $result2['carPosX'];
						$y = $result2['carPosY'];

						mysqli_free_result($res);
						
						//calculating battery status
						if($carBatteryL == 0)
						{
							$batteryString = "fa-battery-empty";
							$batteryStatus = "Low";
							$batteryColor = "tomato";
						}
						else if($carBatteryL > 0 && $carBatteryL < 25.0)
						{
							$batteryString = "fa-battery-quarter";
							$batteryStatus = "Acceptable";
							$batteryColor = "blue";
						}									
						else if($carBatteryL >= 25.0 && $carBatteryL < 50.0)
						{
							$batteryString = "fa-battery-half";
							$batteryStatus = "Good";
							$batteryColor = "blue";
						}
						else if($carBatteryL >= 50.0 && $carBatteryL < 75.0)
						{
							$batteryString = "fa-battery-three-quarters";
							$batteryStatus = "Excellent";
							$batteryColor = "blue";
						}									
						else if($carBatteryL >= 75.0 && $carBatteryL <= 100.0)
						{
							$batteryString = "fa-battery-full";
							$batteryStatus = "Brand new";
							$batteryColor = "green";
						}
						
						//calculating engine status
						if($carEngineL == 0)
						{
							$engineStatus = "Low";
							$engineColor = "tomato";
						}
						else if($carEngineL > 0 && $carEngineL < 25.0)
						{
							$engineStatus = "Acceptable";
							$engineColor = "blue";
						}									
						else if($carEngineL >= 25.0 && $carEngineL < 50.0)
						{
							$engineStatus = "Good";
							$engineColor = "blue";
						}
						else if($carEngineL >= 50.0 && $carEngineL < 75.0)
						{
							$engineStatus = "Excellent";
							$engineColor = "blue";
						}									
						else if($carEngineL >= 75.0 && $carEngineL <= 100.0)
						{
							$engineStatus = "Brand new";
							$engineColor = "green";
						}	

						//echo returnComponentName(1148);
						?>
						
                        <router-outlet _ngcontent-tnh-c136="" class="router-outlet"></router-outlet>
                        <app-vehicle _nghost-tnh-c164="">
                            <!---->
                            <div _ngcontent-tnh-c164="" class="content-header">
                                <h3 _ngcontent-tnh-c164=""><?php echo $vehicleColors[$carColor1]; ?> <?php echo $cars[ $carModel - 400 ]; ?> parked in <?php echo qomaLokacionin($x, $y, $zonat); ?></h3>
                            </div>
                            <!---->
                            <div _ngcontent-tnh-c164="" class="content">
                                <app-model-preview _ngcontent-tnh-c164="" scene="vehicle" class="cstwothirds preview" _nghost-tnh-c166="">
                                    <div _ngcontent-tnh-c166="" class="previewContainer">
                                        <div _ngcontent-tnh-c166="" id="vehpreview" class="preview" style="background-image: url(&quot;http://localhost/vehicles/<?php echo $carModel; ?>.png&quot;); top: 0px; bottom: 0px; left: 0px; right: 0px;"></div>
                                        <!---->
										<!--<div _ngcontent-tnh-c166="" class="loader"><i _ngcontent-tnh-c166="" class="fa fa-spinner-third fa-spin fa-fw"></i> Preview is being generated </div>-->
                                        <!---->
                                    </div>
								</app-model-preview>
                                <app-map-section _ngcontent-tnh-c164="" class="csthird map-section" _nghost-tnh-c219="">
										<div _ngcontent-tnh-c219="" class="map-section" style="background-image: url(&quot;http://localhost/map/?x=<?php echo $x; ?>&y=<?php echo $y; ?>&quot;);">
                                        <div _ngcontent-tnh-c219="" class="map-section-content">
                                            <div _ngcontent-tnh-c164="" class="marker"><i _ngcontent-tnh-c164="" class="fa fa-fw fa-car"></i></div>
                                        </div>
                                    </div>
                                </app-map-section>
                                <section _ngcontent-tnh-c164="" class="card csthird">
                                    <div _ngcontent-tnh-c164="" class="card-title"> Information </div>
                                    <ul _ngcontent-tnh-c164="" class="no-list-style margin-top-10">
                                        <li _ngcontent-tnh-c164=""><i _ngcontent-tnh-c164="" class="fa fa-fw fa-hashtag color-blue"></i> Unique vehicle ID <?php echo $carsqlid; ?></li>
                                        <li _ngcontent-tnh-c164=""><i _ngcontent-tnh-c164="" class="fa fa-fw fa-id-card color-blue"></i> Registered by <?php echo returnName(returnCharacter($link, $carOwner)); ?> under <?php echo $carPlate; ?> </li>
                                        <li _ngcontent-tnh-c164=""><i _ngcontent-tnh-c164="" class="fa fa-fw fa-palette color-blue"></i> <?php echo $vehicleColors[$carColor1]; ?> color</li>
                                        <li _ngcontent-tnh-c164=""><i _ngcontent-tnh-c164="" class="fa fa-fw fa-tachometer color-blue"></i> <?php echo intval($carMileage); ?> miles driven </li>
										
										<?php if(!$carLock) { ?>
										<li _ngcontent-tnh-c164=""><i _ngcontent-tnh-c164="" class="fa fa-fw fa-lock-open color-grey margin-top-20"></i> No lock </li>
										<?php } else { ?>
                                        <li _ngcontent-tnh-c164=""><i _ngcontent-tnh-c164="" class="fa fa-fw fa-lock color-blue margin-top-20"></i> Lock <span _ngcontent-tnh-c164="" class="fl-ri color-grey margin-top-20">Level <?php echo $carLock; ?></span></li>
										<?php } ?>
                                        <!---->
                                        <!---->
										<?php if(!$carAlarm) { ?>
										<li _ngcontent-tnh-c164=""><i _ngcontent-tnh-c164="" class="fa fa-fw fa-shield-alt color-grey"></i> No alarm </li>
										<?php } else { ?>
                                        <li _ngcontent-tnh-c164=""><i _ngcontent-tnh-c164="" class="fa fa-fw fa-shield-alt color-blue"></i> Alarm <span _ngcontent-tnh-c164="" class="fl-ri color-grey">Level <?php echo $carAlarm; ?></span></li>
										<?php } ?>
                                        <!---->
                                        <!---->
                                        <li _ngcontent-tnh-c164=""><i _ngcontent-tnh-c164="" class="color-<?php echo $batteryColor; ?> fa <?php echo $batteryString; ?> fa-fw"></i> <?php echo $batteryStatus; ?> Battery life <span _ngcontent-tnh-c164="" class="fl-ri color-grey"><?php echo intval($carBatteryL); ?> %</span></li>
                                        <li _ngcontent-tnh-c164=""><i _ngcontent-tnh-c164="" class="color-<?php echo $engineColor; ?> fa fa-fw fa-heartbeat"></i> <?php echo $engineStatus; ?> Engine health<span _ngcontent-tnh-c164="" class="fl-ri color-grey"><?php echo intval($carEngineL); ?> %</span></li>
										<?php if(!$carInsurance) { ?>
										<li _ngcontent-tnh-c164=""><i _ngcontent-tnh-c164="" class="fa fa-fw fa-user-shield color-grey"></i> Not insured </li>
										<?php } else { ?>
                                        <li _ngcontent-tnh-c164=""><i _ngcontent-tnh-c164="" class="fa fa-fw fa-user-shield color-blue"></i> Insurance<span _ngcontent-tnh-c164="" class="fl-ri color-grey">Plan <?php echo $carInsurance; ?></span></li>
										<?php } ?>
                                        <!---->
                                        <!---->
                                    </ul>
                                </section>
                                <!---->
								<?php if($weapon_count > 0) { ?>
								<section class="transparent section-border-gradient csthird"> <strong>Inventory</strong>
									<ul class="no-list-style margin-top-10">
									<?php
									
									for($i = 0; $i < 4; ++$i)
									{
										if($carWeapons[$i] != 0)
										{
										
										?>
										<li><i class="far fa-fw fa-bullseye color-grey"></i> <?php echo $weapon_names[ $carWeapons[$i] ]; ?> <span class="fl-ri color-grey"><?php echo $carAmmuntion[$i]; ?> bullets</span></li>
										<?php
										
										}
									}
									
									?>
										<!--<li><i class="far fa-fw fa-bullseye color-grey"></i> AK-47 <span class="fl-ri color-grey">200 bullets</span></li>
										<li><i class="far fa-fw fa-box-full color-grey"></i> Packaged AK-47 <span class="fl-ri color-grey">100 bullets</span></li>
										<li><i class="far fa-fw fa-box-full color-grey"></i> Packaged AK-47 <span class="fl-ri color-grey">100 bullets</span></li>
										<li><i class="far fa-fw fa-box-full color-grey"></i> Packaged AK-47 <span class="fl-ri color-grey">100 bullets</span></li>
										<li><i class="far fa-fw fa-box-full color-grey"></i> Packaged AK-47 <span class="fl-ri color-grey">100 bullets</span></li>
										<li><i class="far fa-fw fa-box-full color-grey"></i> Packaged Desert Eagle <span class="fl-ri color-grey">50 bullets</span></li>--> 
									</ul>
									<!--<ul class="no-list-style margin-top-20">
										<li><i class="fa fa-fw fa-snowflake color-grey"></i> Cocaine <span class="fl-ri color-grey">20 grams</span></li>
										<li><i class="fa fa-fw fa-syringe color-grey"></i> Heroin <span class="fl-ri color-grey">1 gram</span></li>
										<li><i class="fa fa-fw fa-leaf color-grey"></i> Marijuana <span class="fl-ri color-grey">420 grams</span></li>
										<li><i class="fa fa-fw fa-pills color-grey"></i> Ecstasy <span class="fl-ri color-grey">12 pills</span></li> 
									</ul>-->
								</section>	
								<?php } ?>
								
								<?php if($mods_count > 0) { ?>
								<section class="card csthird"  *ngIf="vehicle.modifications && vehicle.modifications.length">
									<div class="card-title"> <i class="fa fa-fw fa-car-mechanic color-blue"></i> Modifications</div>
									<ul class="no-list-style margin-top-10">
									<?php
									
									for($i = 0; $i < 15; ++$i)
									{
										if($carMods[$i] != 0)
										{
										
										?>									
									
										<li *ngFor="let modification of vehicle.modifications"><i class="color-blue"></i> <?php echo returnComponentName($carMods[$i]); ?> </li> 
										
										<?php
										
										}
									}
									
									?>
									</ul> 
								</section>								
								<?php } ?>
                            </div>				
						
						<?php } ?>
						
						<?php if(isset($link)) { mysqli_close($link); } ?>
                        <!---->