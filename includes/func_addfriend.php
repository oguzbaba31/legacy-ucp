<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/modules/core/header.php"); 

$error_message = "";
$friend_id = "";

if(isset($_GET['friend']))
{
	$friend_id = $_GET['friend'];
	
	if(!isset($link))
	{
		$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

		if($link === false) 
		{
			die("ERROR: Could not connect. " . mysqli_connect_error());
		}	
	}
	
	if($friend_id == $username) $error_message = "That's sad";
	else
	{	
		$friend_id = mysqli_escape_string($link, $friend_id);
		
		$user_check_query = "SELECT ID FROM accounts WHERE Username = BINARY '$friend_id' LIMIT 1";
		$res = mysqli_query($link, $user_check_query);		
		
		$rowcount = $res->num_rows;
		
		if($rowcount > 0)
		{
			$result2 = mysqli_fetch_array($res, MYSQLI_ASSOC);
			
			$friendSQL = $result2['ID'];
			
			mysqli_free_result($res);
			
			$user_check_query = "SELECT ID FROM ucp_friends WHERE playerName = '$username' AND friendName = '$friend_id' OR playerName = '$friend_id' AND friendName = '$username' LIMIT 1";
			$res = mysqli_query($link, $user_check_query);	
			
			$rowcount = $res->num_rows;
			
			if($rowcount > 0)
			{	
				$result2 = mysqli_fetch_array($res, MYSQLI_ASSOC);

				$friendPending = $result2['friendPending'];		
				
				if($friendPending == 1) $error_message = "There's already a pending request between you two."; 
				else $error_message = "You're already friends with this user.";
			}
			else 
			{
				mysqli_free_result($res);
				
				$user_check_query = "INSERT INTO ucp_friends (`friendID`, `playerID`, `friendName`, `playerName`) VALUES ($friendSQL, $playersqlid, '$friend_id', '$username')";
				$res = mysqli_query($link, $user_check_query);
				
				$insert = mysqli_insert_id($link);
				
				mysqli_free_result($res);

				$user_check_query = "INSERT INTO `notifications` (`master`, `sender`, `friend`) VALUES ('$friendSQL', '$username', '$insert')";
				$res = mysqli_query($link, $user_check_query);				
				
				mysqli_free_result($res);

				$success_message = "Friend request successfully sent.";
			}
		}
		else $error_message = "This user doesn't exist.";
	}
}
	
?>
          <app-popup _nghost-tnh-c158="" class="ng-star-inserted">
                <div _ngcontent-tnh-c158="" class="popper">
                    <div _ngcontent-tnh-c158="" class="popup">
                        <header _ngcontent-tnh-c158=""><span _ngcontent-tnh-c158="">Friend Request</span><span _ngcontent-tnh-c158="" class="close" onclick="cancelDialog()"><i _ngcontent-tnh-c158="" class="far fa-fw fa-times"></i></span></header>
                        <div _ngcontent-tnh-c158="" class="popup-content">
                            <!---->
                            <div _ngcontent-tnh-c158=""></div>
                            <!---->
                            <!---->
                            <app-popup-friends-new _nghost-tnh-c205="" class="ng-star-inserted">Please enter a player's name to send them a friend request. You need to specify their account name, not a character name. <br _ngcontent-tnh-c205="">
                                <mat-form-field _ngcontent-tnh-c205="" class="mat-form-field ng-tns-c77-12 mat-primary mat-form-field-type-mat-input mat-form-field-appearance-legacy mat-form-field-can-float mat-form-field-has-label mat-form-field-hide-placeholder ng-pristine ng-valid ng-touched">
                                    <div class="mat-form-field-wrapper ng-tns-c77-12">
                                        <div class="mat-form-field-flex ng-tns-c77-12">
                                            <!---->
                                            <!---->
                                            <div class="mat-form-field-infix ng-tns-c77-12" id="add_friend"><input _ngcontent-tnh-c205="" value="<?php echo $friend_id; ?>" matinput="" class="mat-input-element mat-form-field-autofill-control ng-tns-c77-12 cdk-text-field-autofill-monitored ng-pristine ng-valid ng-touched" id="friend_name" aria-invalid="false" aria-required="false" type="text" maxlength="24" minlength="3"><span class="mat-form-field-label-wrapper ng-tns-c77-12"><label class="mat-form-field-label ng-tns-c77-12 mat-empty mat-form-field-empty ng-star-inserted" id="mat-form-field-label-25" for="mat-input-12" aria-owns="mat-input-12"><span class="ng-tns-c77-12 ng-star-inserted"></span>
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
                                        <div class="mat-form-field-underline ng-tns-c77-12 ng-star-inserted"><span class="mat-form-field-ripple ng-tns-c77-12"></span></div>
                                        <!---->
                                        <div class="mat-form-field-subscript-wrapper ng-tns-c77-12">
                                            <!---->
                                            <div class="mat-form-field-hint-wrapper ng-tns-c77-12 ng-trigger ng-trigger-transitionMessages ng-star-inserted" style="opacity: 1; transform: translateY(0%);">
                                                <!---->
                                                <div class="mat-form-field-hint-spacer ng-tns-c77-12"></div>
                                            </div>
                                            <!---->
                                        </div>
                                    </div>
                                </mat-form-field></br>
                                <app-button _ngcontent-tnh-c205="" caption="Send Request" class="blue" _nghost-tnh-c216="" id="ChangeButton">
                                    <div _ngcontent-tnh-c216="" id="submit_lol" class="btn-wrapper disabled">
                                        <div _ngcontent-tnh-c216="" class="button">
                                            <!---->
                                            <div _ngcontent-tnh-c216="" class="caption ng-star-inserted">Send Request</div>
                                            <!---->
                                        </div>
                                        <!---->
                                    </div>
                                </app-button>
								<?php if(strlen($success_message) > 0) { ?>
                                <div _ngcontent-tnh-c205="" class="margin-top-20 ng-star-inserted">
                                    <app-info-bar _ngcontent-tnh-c205="" type="success" class="clearfix width-100" _nghost-tnh-c215="">
                                        <div _ngcontent-tnh-c215="" class="success infobar">
                                            <div _ngcontent-tnh-c215="" class="icon"><i _ngcontent-tnh-c215="" class="fa fa-exclamation-triangle fa-fw"></i></div>
                                            <div _ngcontent-tnh-c215="" class="message"> <?php echo $success_message; ?> </div>
                                        </div>
                                    </app-info-bar>
                                </div>								
								<?php } else if(strlen($error_message) > 0) { ?>
                                <div _ngcontent-tnh-c205="" class="margin-top-20 ng-star-inserted">
                                    <app-info-bar _ngcontent-tnh-c205="" type="error" class="clearfix width-100" _nghost-tnh-c215="">
                                        <div _ngcontent-tnh-c215="" class="error infobar">
                                            <div _ngcontent-tnh-c215="" class="icon"><i _ngcontent-tnh-c215="" class="fa fa-exclamation-triangle fa-fw"></i></div>
                                            <div _ngcontent-tnh-c215="" class="message"> <?php echo $error_message; ?> </div>
                                        </div>
                                    </app-info-bar>
                                </div>								
								<?php } ?>									
                                <!---->							
                            </app-popup-friends-new>
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
						$('#submit_lol').removeClass('disabled');
							
						document.getElementById("ChangeButton").setAttribute("onClick", "addFriend()");
					}
				});
			})()
			</script>			

<?php