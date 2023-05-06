<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/modules/core/header.php"); 

$searched = false;
$mask_id = "";

if(isset($_GET['mask']))
{
	$mask_id = $_GET['mask'];

	$searched = true;
	
	if(!isset($link))
	{
		$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

		if($link === false) 
		{
			die("ERROR: Could not connect. " . mysqli_connect_error());
		}	
	}

	$mask_id = mysqli_escape_string($link, $mask_id);

	$user_check_query = "SELECT `admin`, `stamp` FROM `logs_mask` WHERE `action_log` = '$mask_id' ORDER BY id DESC LIMIT 1";
	$res = mysqli_query($link, $user_check_query);

	$rowcount = $res->num_rows;	
	
	if($rowcount > 0)
	{
		$found = true;
		
		$result2 = mysqli_fetch_array($res, MYSQLI_ASSOC);

		$charID = $result2['admin'];			
		$maskTime = $result2['stamp'];	
		
		mysqli_free_result($res);
		
		$user_check_query = "SELECT `master`, `char_name` FROM `characters` WHERE `ID` = '$charID'";
		$res = mysqli_query($link, $user_check_query);

		$rowcount = $res->num_rows;		

		if($rowcount != 0)
		{
			$result2 = mysqli_fetch_array($res, MYSQLI_ASSOC);
			
			$charMaster = $result2['master'];
			$charName = $result2['char_name'];

			$masterName = returnMaster($link, $charMaster);	
		}
		else $masterName = "Invalid";
	}
	else $found = false;
	
	mysqli_free_result($res);
	mysqli_close($link);
}

?>     
			
			<app-popup _nghost-tnh-c158="" class="ng-star-inserted">
                <div _ngcontent-tnh-c158="" class="popper">
                    <div _ngcontent-tnh-c158="" class="popup">
                        <header _ngcontent-tnh-c158=""><span _ngcontent-tnh-c158="">Mask Decryption</span><span _ngcontent-tnh-c158="" class="close" onclick="cancelDialog()"><i _ngcontent-tnh-c158="" class="far fa-fw fa-times"></i></span></header>
                        <div _ngcontent-tnh-c158="" class="popup-content">
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
                                                <div class="mat-form-field-infix ng-tns-c77-2" id="add_friend"><input _ngcontent-tnh-c199="" matinput="" placeholder="Vehicle Reg. no." value="<?php echo $mask_id; ?>" pattern="^[a-zA-Z_0-9 ]{1,20}$" class="mat-input-element mat-form-field-autofill-control ng-tns-c77-2 cdk-text-field-autofill-monitored ng-untouched ng-pristine ng-valid" id="mat-input-2" type="text" aria-invalid="false" aria-required="false"><span class="mat-form-field-label-wrapper ng-tns-c77-2"><label class="mat-form-field-label ng-tns-c77-2 mat-empty mat-form-field-empty ng-star-inserted" id="mat-form-field-label-5" for="mat-input-2" aria-owns="mat-input-2"><span class="ng-tns-c77-2 ng-star-inserted"><div id="kari"><?php if($searched == false) { ?>Mask ID<?php } ?></div></span>
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
                                                <div _ngcontent-tnh-c216="" class="caption ng-star-inserted">Decrypt</div>
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
								<div class="section-category" *ngIf="vehicle"> <?php echo $mask_id; ?> was last used by <span class="strongish"><?php echo $charName; ?>(<?php echo $masterName; ?>)</span>, at <span class="strongish"><?php echo $maskTime; ?></span></div>
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
							
						document.getElementById("ChangeButton").setAttribute("onClick", "decryptMask()");
					}
				});
			})()
			</script>			