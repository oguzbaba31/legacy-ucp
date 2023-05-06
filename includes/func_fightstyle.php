 <?php 
require_once($_SERVER['DOCUMENT_ROOT'] . "/modules/core/header.php"); 

if(!isset($_GET['char']))
{
	exit;
}	

$char_name = $_GET['char'];

if(isset($_GET['changename']))
{
	$namechanges -= 1;
	$changename = $_GET['changename'];
	
	$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

	if($link === false) 
	{
		die("ERROR: Could not connect. " . mysqli_connect_error());
	}
	
	$char_name = mysqli_real_escape_string($link, $char_name);
	$changename = mysqli_real_escape_string($link, $changename);	
	
	$_SESSION['namechanges'] = $namechanges;
	
	$charID = returnCharacterID($link, $char_name);

	$user_check_query = "UPDATE `characters` SET `FightStyle` = '$changename' WHERE `char_name` = '$char_name' LIMIT 1";
	$result = mysqli_query($link, $user_check_query);	
		
	
	//header('location: http://localhost/panel/characters/$changename');
	
	?>
	<form method="POST" action="http://localhost/panel/characters/<?php echo $changename; ?>" id="changename_form">
	<input type="hidden" name="message" value="Fight style updated successfully.">
	</form>
	<script>document.getElementById('changename_form').submit();</script>
	<?php
	exit;
}

?>

           <app-popup _nghost-tnh-c158="">
                <div _ngcontent-tnh-c158="" class="popper">
                    <div _ngcontent-tnh-c158="" class="popup">
                        <header _ngcontent-tnh-c158=""><span _ngcontent-tnh-c158="">Change Fight Style</span><span _ngcontent-tnh-c158="" class="close" onclick="cancelDialog()"><i _ngcontent-tnh-c158="" class="far fa-fw fa-times"></i></span></header>
                        <div _ngcontent-tnh-c158="" class="popup-content">
                            <!---->
                            <div _ngcontent-tnh-c158=""></div>
                            <!---->
                            <!---->
                            <app-popup-name-change _nghost-tnh-c194="">
								<div id="currentCharacter" style="display: none;"><?php echo $char_name; ?></div>
                                <div _ngcontent-tnh-c194=""> Please select a new fight style for <span _ngcontent-tnh-c194="" class="strongish"><?php echo returnName($char_name); ?></span>.<br _ngcontent-tnh-c194=""><br _ngcontent-tnh-c194="">
 
									                                       <div _ngcontent-tnh-c194="" class="ck">
                                            <mat-slide-toggle _ngcontent-tnh-c194="" color="primary" class="mat-slide-toggle mat-primary ng-untouched ng-pristine ng-valid" id="mat-slide-toggle-1" tabindex="-1"><label class="mat-slide-toggle-label" for="mat-slide-toggle-1-input"><div class="mat-slide-toggle-bar mat-slide-toggle-bar-no-side-margin"><input type="checkbox" role="switch" class="mat-slide-toggle-input cdk-visually-hidden" id="mat-slide-toggle-1-input" tabindex="0" aria-checked="false"><div class="mat-slide-toggle-thumb-container"><div class="mat-slide-toggle-thumb"></div><div mat-ripple="" class="mat-ripple mat-slide-toggle-ripple mat-focus-indicator"><div class="mat-ripple-element mat-slide-toggle-persistent-ripple"></div></div></div></div><span class="mat-slide-toggle-content"><span style="display: none;">&nbsp;</span></span></label></mat-slide-toggle><span _ngcontent-tnh-c194="" class="margin-left-10">Character Kill <?php echo $char_name; ?></span><i _ngcontent-tnh-c194="" mattooltip="Once you kill a character, you will not be able to use the name again in the future." class="fa fa-fw fa-question-circle color-grey margin-left-10" aria-describedby="cdk-describedby-message-0" cdk-describedby-host=""></i>
                                            <!---->
                                        </div>
 
									<?php if(!$donaterank) { ?>
								     <app-info-bar _ngcontent-tnh-c194="" type="warning" class="margin-top-20 clearfix" _nghost-tnh-c215="">
                                        <div _ngcontent-tnh-c215="" class="infobar warning">
                                            <div _ngcontent-tnh-c215="" class="icon"><i _ngcontent-tnh-c215="" class="fa fa-exclamation-circle fa-fw"></i></div>
                                            <div _ngcontent-tnh-c215="" class="message"> This feature requires donator status.</div>
                                        </div>
                                    </app-info-bar>	
									<?php } ?>
				

                                    <div _ngcontent-tnh-c194="" class="buttons">
                                        <?php if($namechanges > 0) { ?>
										<app-button _ngcontent-tnh-c194="" caption="Change Style" class="fl-ri blue margin-left-10" _nghost-tnh-c216="" id="ChangeButton">
                                            <div _ngcontent-tnh-c216="" id="submit_lol" class="btn-wrapper disabled">
                                                <div _ngcontent-tnh-c216="" class="button">
                                                    <!---->
                                                    <div _ngcontent-tnh-c216="" class="caption">Change Style</div>
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
			