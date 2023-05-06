<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/modules/core/header.php"); 

$searched = false;
$vehicle_plate = "";

if(isset($_GET['plate']))
{
	$vehicle_plate = $_GET['plate'];

	$searched = true;
	
	if(!isset($link))
	{
		$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

		if($link === false) 
		{
			die("ERROR: Could not connect. " . mysqli_connect_error());
		}	
	}

	$friend_id = mysqli_escape_string($link, $friend_id);

	$user_check_query = "SELECT `carOwner`, `carModel`, `carColor1`, `carPosX`, `carPosY`, `carInsurance`, `carDate` FROM `cars` WHERE `carPlate` = '$vehicle_plate' LIMIT 1";
	$res = mysqli_query($link, $user_check_query);
								
	$rowcount = $res->num_rows;
	
	if($rowcount > 0)
	{
		$found = true;
		
		$result2 = mysqli_fetch_array($res, MYSQLI_ASSOC);

		$carOwner = $result2['carOwner'];
		$carModel = $result2['carModel'];
		$carColor1 = $result2['carColor1'];
		$carInsurance = $result2['carInsurance'];
		$x = $result2['carPosX'];
		$y = $result2['carPosY'];
		$carDate = $result2['carDate'];				
		$ownerName = returnCharacter($link, $carOwner);

	}
	else $found = false;
	
	mysqli_free_result($res);
	mysqli_close($link);
}

?>

 <!--<div class="inputs">
    <mat-form-field class="example-full-width"> <input matInput #nameInput placeholder="Vehicle Reg. no." [(ngModel)]="plate" pattern="^[a-zA-Z_0-9 ]{1,20}$"> </mat-form-field>
    <app-button caption="Look up" class="blue margin-left-20" [disabled]="!nameInput.checkValidity() || !plate.length || loading" (pressed)="lookup()"></app-button></div>
<app-info-bar type="error" *ngIf="vehicle === false" class="clearfix width-100"> No matches found.</app-info-bar>
<div class="section-category" *ngIf="vehicle"> {{ UtilityService.getVehicleColorString(vehicle.vehicle_info_primary_color, vehicle.vehicle_info_secondary_color) }} {{ vehicle.name }} - <span class="strongish">{{ vehicle.vehicle_info_license_plate }}</span>, registered by <span class="strongish">{{ vehicle.owner.username }}</span></div>
<div class="wrapper" *ngIf="vehicle">
    <app-scene class="scene"  width="500"  height="400"  [alpha]="true"  [options]="{spin: true}"  [settings]="{type: \'vehicle\', models: [{name: vehicle.modelName, color: {primary: vehicle.vehicle_info_primary_color, secondary: vehicle.vehicle_info_secondary_color}}], modifications: vehicle.modifications || []}"  [potaflip]="true"  [cameraPos]="{x: 0, y: 0.2, z: 6}" > </app-scene></div>	    -->       
			
			<app-popup _nghost-tnh-c158="" class="ng-star-inserted">
                <div _ngcontent-tnh-c158="" class="popper" width="500px">
                    <div _ngcontent-tnh-c158="" class="popup" width="500px">
                        <header _ngcontent-tnh-c158=""><span _ngcontent-tnh-c158="">Vehicle lookup</span><span _ngcontent-tnh-c158="" class="close" onclick="cancelDialog()"><i _ngcontent-tnh-c158="" class="far fa-fw fa-times"></i></span></header>
                        <div _ngcontent-tnh-c158="" class="popup-content" width="500px">
                            <!---->
                            <div _ngcontent-tnh-c158=""></div>
                            <!---->
                            <!---->
                            <app-popup-gov-dmv _nghost-tnh-c199="" class="ng-star-inserted">
                                <div _ngcontent-tnh-c199="" class="inputs">
                                    <mat-form-field _ngcontent-tnh-c199="" class="mat-form-field example-full-width ng-tns-c77-2 mat-primary mat-form-field-type-mat-input mat-form-field-appearance-legacy mat-form-field-can-float mat-form-field-has-label mat-form-field-hide-placeholder ng-untouched ng-pristine ng-valid">
                                        <div class="mat-form-field-wrapper ng-tns-c77-2">
                                            <div class="mat-form-field-flex ng-tns-c77-2">
                                                <!---->
                                                <!---->
                                                <div class="mat-form-field-infix ng-tns-c77-2" id="add_friend"><input _ngcontent-tnh-c199="" matinput="" placeholder="Vehicle Reg. no." value="<?php echo $vehicle_plate; ?>" pattern="^[a-zA-Z_0-9 ]{1,20}$" class="mat-input-element mat-form-field-autofill-control ng-tns-c77-2 cdk-text-field-autofill-monitored ng-untouched ng-pristine ng-valid" id="mat-input-2" type="text" aria-invalid="false" aria-required="false"><span class="mat-form-field-label-wrapper ng-tns-c77-2"><label class="mat-form-field-label ng-tns-c77-2 mat-empty mat-form-field-empty ng-star-inserted" id="mat-form-field-label-5" for="mat-input-2" aria-owns="mat-input-2"><span class="ng-tns-c77-2 ng-star-inserted"><div id="kari"><?php if($searched == false) { ?>Vehicle Reg. no.<?php } ?></div></span>
                                                    <!---->
                                                    <!---->
                                                    <!---->
                                                    <!---->
                                                    </label>
                                                    <!---->
                                                    </span>
                                                </div>
                                                <!---->
                                            </div>
                                            <div class="mat-form-field-underline ng-tns-c77-2 ng-star-inserted"><span class="mat-form-field-ripple ng-tns-c77-2"></span></div>
                                            <!---->
                                            <div class="mat-form-field-subscript-wrapper ng-tns-c77-2">
                                                <!---->
                                                <div class="mat-form-field-hint-wrapper ng-tns-c77-2 ng-trigger ng-trigger-transitionMessages ng-star-inserted" style="opacity: 1; transform: translateY(0%);">
                                                    <!---->
                                                    <div class="mat-form-field-hint-spacer ng-tns-c77-2"></div>
                                                </div>
                                                <!---->
                                            </div>
                                        </div>
                                    </mat-form-field>
                                    <app-button _ngcontent-tnh-c199="" caption="Look up" class="blue margin-left-20" _nghost-tnh-c216="" id="ChangeButton">
                                        <div _ngcontent-tnh-c216="" id="submit_lol" class="btn-wrapper disabled">
                                            <div _ngcontent-tnh-c216="" class="button">
                                                <!---->
                                                <div _ngcontent-tnh-c216="" class="caption ng-star-inserted">Look up</div>
                                                <!---->
                                            </div>
                                            <!---->
                                        </div>
                                    </app-button>
                                </div>
								<?php if($searched == true) { ?>
								<?php if($found == false) { ?>
								<app-info-bar _ngcontent-tnh-c216="" type="error" *ngIf="vehicle === false" class="clearfix width-100"> No matches found.</app-info-bar>
								<?php } else { ?>
								<!--<div class="section-category" *ngIf="vehicle"> <?php echo $vehicleColors[$carColor1]; ?> <?php echo $cars[ $carModel - 400 ]; ?> - <span class="strongish"><?php echo $vehicle_plate; ?></span>, registered by <span class="strongish"><?php echo $ownerName; ?></span></div>-->
                                
                           <div _ngcontent-tnh-c164="" class="content"> 
                                <app-model-preview _ngcontent-tnh-c164="" scene="vehicle" class="cstwothirds preview" _nghost-tnh-c166="">
                                    <div _ngcontent-tnh-c166="" class="previewContainer">
                                        <div _ngcontent-tnh-c166="" id="vehpreview" class="preview" style="background-image: url(&quot;https://m2.ls-rp.com/vehicle/<?php echo strtolower($cars[ $carModel - 400 ]); ?>-1280-720-<?php echo $carColor1; ?>-<?php echo $carColor2; ?>.png&quot;); top: 0px; bottom: 0px; left: 0px; right: 0px;"></div>
                                        <!---->
										
                                        <!---->
                                    </div><!--<img _ngcontent-tnh-c166="" hidden="" src="./Los Santos Roleplay_files/oceanic-1280-720-0-0.png">-->
								</app-model-preview>
									</br></br>
                                <section _ngcontent-tnh-c164="" class="card cs-1">
                                    <div _ngcontent-tnh-c164="" class="card-title"> Information</div>
                                    <ul _ngcontent-tnh-c164="" class="no-list-style margin-top-10">
										<li _ngcontent-tnh-c164=""><i _ngcontent-tnh-c164="" class="fa fa-fw fa-car color-blue"></i> Model <span _ngcontent-tnh-c164="" class="fl-ri color-grey"><?php echo $cars[ $carModel - 400 ]; ?></span></li>
                                
                                        <li _ngcontent-tnh-c164=""><i _ngcontent-tnh-c164="" class="fa fa-fw fa-id-card color-blue"></i> Registered by <span _ngcontent-tnh-c164="" class="fl-ri color-grey"><?php echo $ownerName; ?> at <?php echo $carDate; ?> under <?php echo $vehicle_plate; ?></span></li>
                                        <li _ngcontent-tnh-c164=""><i _ngcontent-tnh-c164="" class="fa fa-fw fa-palette color-blue"></i> Color <span _ngcontent-tnh-c164="" class="fl-ri color-grey"><?php echo $vehicleColors[$carColor1]; ?></span></li>
										<?php if(!$carInsurance) { ?>
										<li _ngcontent-tnh-c164=""><i _ngcontent-tnh-c164="" class="fa fa-fw fa-user-shield color-blue"></i> Insurance<span _ngcontent-tnh-c164="" class="fl-ri color-grey">Not insured </span></li>
										<?php } else { ?>
                                        <li _ngcontent-tnh-c164=""><i _ngcontent-tnh-c164="" class="fa fa-fw fa-user-shield color-blue"></i> Insurance<span _ngcontent-tnh-c164="" class="fl-ri color-grey">Plan <?php echo $carInsurance; ?></span></li>
										<?php } ?>
										
										<li _ngcontent-tnh-c164=""><i _ngcontent-tnh-c164="" class="fa fa-fw fa-map-marker color-blue"></i> Last seen <span _ngcontent-tnh-c164="" class="fl-ri color-grey"><?php echo qomaLokacionin($x, $y, $zonat); ?></span></li>
                                        <!---->
                                        <!---->
                                    </ul>
                                </section>
                                <!---->
                            </div>
                            <!---->								
								
								
								<!---->
								<?php } ?>
								<?php } ?>
                                <!---->
                                <!---->
                            </app-popup-gov-dmv>
                            <!---->
                        </div>
                    </div>
                </div>
            </app-popup>
            <!---->
			
			<script>			
			(function() {
				$('#add_friend').on('keyup', 'input[type="text"]', function() 
				{								
					var empty = false; 
					
					$('input[type="text"]').each(function() 
					{											
						if (($(this).val() == '')) {
							empty = true;
						}
					});

					if (empty) 
					{
						$('#submit_lol').addClass('disabled');
						
						document.getElementById("ChangeButton").setAttribute("onClick", "");
					} 
					else 
					{
						document.getElementById("kari").innerHTML = "";
						
						$('#submit_lol').removeClass('disabled');
							
						document.getElementById("ChangeButton").setAttribute("onClick", "govLookup()");
					}
				});
			})()
			</script>			