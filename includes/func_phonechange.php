<?php 

require_once($_SERVER['DOCUMENT_ROOT'] . "/modules/core/header.php"); 

if(!isset($_GET['char']))
{
	exit;
}	

$char_name = $_GET['char'];

$error = "";

if(isset($_GET['changename']))
{
	$phonechanges -= 1;
	$changenum = $_GET['changenum'];
	
	$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

	if($link === false) 
	{
		die("ERROR: Could not connect. " . mysqli_connect_error());
	}
	
	$char_name = mysqli_real_escape_string($link, $char_name);
	$changenum = mysqli_real_escape_string($link, $changenum);	
	
	$_SESSION['phonechanges'] = $phonechanges;
	
	$user_check_query = "SELECT Null FROM `characters` WHERE `PhoneNumbr` = '$changenum' LIMIT 1";
	$result = mysqli_query($link, $user_check_query);		
	
	$rowcount = mysqli_num_rows($result);
	
	mysqli_free_result($result);
	
	if($rowcount)
	{
		$phonechanges += 1;
		$_SESSION['phonechanges'] = $phonechanges;
		
		$error = "This phone number is already taken.";
	}
	else
	{			
		$charID = returnCharacterID($link, $char_name);

		$user_check_query = "UPDATE `accounts` SET `Phonechanges` = '$phonechanges' WHERE `ID` = '$playersqlid'";
		$result = mysqli_query($link, $user_check_query);	

		$user_check_query = "UPDATE `characters` SET `PhoneNumbr` = '$changenum' WHERE `char_name` = '$char_name' LIMIT 1";
		$result = mysqli_query($link, $user_check_query);	
		
		//header('location: http://localhost/panel/characters/$changename');

		?>
		<form method="POST" action="http://localhost/panel/characters/<?php echo $changenum; ?>" id="changename_form">
		<input type="hidden" name="message" value="Phone number updated successfully.">
		</form>
		<script>document.getElementById('changename_form').submit();</script>
		<?php
		exit;
	}
}	

?>

            <app-popup _nghost-tnh-c158="">
                <div _ngcontent-tnh-c158="" class="popper">
                    <div _ngcontent-tnh-c158="" class="popup">
                        <header _ngcontent-tnh-c158=""><span _ngcontent-tnh-c158="">Change Phone Number</span><span _ngcontent-tnh-c158="" class="close" onclick="cancelDialog()"><i _ngcontent-tnh-c158="" class="far fa-fw fa-times"></i></span></header>
                        <div _ngcontent-tnh-c158="" class="popup-content">
                            <!---->
                            <div _ngcontent-tnh-c158=""></div>
                            <!---->
                            <!---->
                            <app-popup-name-change _nghost-tnh-c194="">
								<div id="currentCharacter" style="display: none;"><?php echo $char_name; ?></div>
                                <div _ngcontent-tnh-c194=""> You currently have <span _ngcontent-tnh-c194="" class="strongish"><?php echo $phonechanges; ?></span> phone number changes available. Enter a new phone number for <span _ngcontent-tnh-c194="" class="strongish"><?php echo returnName($char_name); ?></span>.<br _ngcontent-tnh-c194=""><br _ngcontent-tnh-c194="">
                                    <div _ngcontent-tnh-c194="" class="text-center" id="new_name"><input _ngcontent-tnh-c194="" id="changeNameInput" type="text" maxlength="24" minlength="5" placeholder="Phone Number" class="ng-untouched ng-pristine ng-valid">
										<div id="error_message"><?php echo $error; ?></div>
                                        <!--<div _ngcontent-tnh-c194="" class="ck">
                                            <mat-slide-toggle _ngcontent-tnh-c194="" color="primary" class="mat-slide-toggle mat-primary ng-untouched ng-pristine ng-valid" id="mat-slide-toggle-1" tabindex="-1"><label class="mat-slide-toggle-label" for="mat-slide-toggle-1-input"><div class="mat-slide-toggle-bar mat-slide-toggle-bar-no-side-margin"><input type="checkbox" role="switch" class="mat-slide-toggle-input cdk-visually-hidden" id="mat-slide-toggle-1-input" tabindex="0" aria-checked="false"><div class="mat-slide-toggle-thumb-container"><div class="mat-slide-toggle-thumb"></div><div mat-ripple="" class="mat-ripple mat-slide-toggle-ripple mat-focus-indicator"><div class="mat-ripple-element mat-slide-toggle-persistent-ripple"></div></div></div></div><span class="mat-slide-toggle-content"><span style="display: none;">&nbsp;</span></span></label></mat-slide-toggle><span _ngcontent-tnh-c194="" class="margin-left-10">Character Kill <?php echo $char_name; ?></span><i _ngcontent-tnh-c194="" mattooltip="Once you kill a character, you will not be able to use the name again in the future." class="fa fa-fw fa-question-circle color-grey margin-left-10" aria-describedby="cdk-describedby-message-0" cdk-describedby-host=""></i>
                                        </div>-->
                                    </div>
                                    <!---->
                                    <div _ngcontent-tnh-c194="" class="buttons">
                                        <?php if($phonechanges > 0) { ?>
										<app-button _ngcontent-tnh-c194="" caption="Change Name" class="fl-ri blue margin-left-10" _nghost-tnh-c216="" id="ChangeButton">
                                            <div _ngcontent-tnh-c216="" id="submit_lol" class="btn-wrapper disabled">
                                                <div _ngcontent-tnh-c216="" class="button">
                                                    <!---->
                                                    <div _ngcontent-tnh-c216="" class="caption">Change Number</div>
                                                    <!---->
                                                </div>
                                                <!---->
                                            </div>
                                        </app-button>
										<?php } ?>
                                        <app-button _ngcontent-tnh-c194="" caption="Cancel" class="fl-ri tomato" _nghost-tnh-c216="" onclick="cancelDialog()">
                                            <div _ngcontent-tnh-c216="" class="btn-wrapper">
                                                <div _ngcontent-tnh-c216="" class="button">
                                                    <!---->
                                                    <div _ngcontent-tnh-c216="" class="caption">Cancel</div>
                                                    <!---->
                                                </div>
                                                <!---->
                                            </div>
                                        </app-button>
                                    </div>
                                </div>
                                <!---->
                                <!---->
                            </app-popup-name-change>
                            <!---->
                        </div>
                    </div>
                </div>
            </app-popup>
            <!---->
			
			<script>		
			function isNumeric(num){
			  return !isNaN(num)
			}
			
			(function() {
				$('#new_name').on('keyup', 'input[type="text"]', function() 
				{								
					var empty = false; 
					var val = $(this).val();
					
					$('input[type="text"]').each(function() 
					{											
						if (($(this).val() == '')) {
							empty = true;
						}
						
						if(!isNumeric(val))
						{
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
						$('#submit_lol').removeClass('disabled');
							
						document.getElementById("ChangeButton").setAttribute("onClick", "phoneChange()");
					}
				});
			})()
			</script>

<?php

?>