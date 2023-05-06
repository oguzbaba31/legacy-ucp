<?php 
require_once($_SERVER['DOCUMENT_ROOT'] . "/modules/core/header.php"); 

if(!isset($_GET['friend']))
{
	exit;
}	

$friend_id = $_GET['friend'];

$show_stuff = true;
$friend_accepted = false;
$friend_already_accepted = false;

if(!isset($link))
{
	$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

	if($link === false) 
	{
		die("ERROR: Could not connect. " . mysqli_connect_error());
	}	
}

$friend_id = mysqli_escape_string($link, $friend_id);

$user_check_query = "SELECT friendName, playerName, playerID, friendPending FROM ucp_friends WHERE ID = '$friend_id' LIMIT 1";
$res = mysqli_query($link, $user_check_query);
							
$rowcount = $res->num_rows;

if($rowcount > 0)
{	
	$result2 = mysqli_fetch_array($res, MYSQLI_ASSOC);

	$playerID = $result2['playerID'];
	$friendName = $result2['friendName'];
	$friendPending = $result2['friendPending'];
	
	$user_check_query = "UPDATE `notifications` SET `read` = '1' WHERE `read` = '0' AND `friend` = '$friend_id' LIMIT 1";
	$res = mysqli_query($link, $user_check_query);

	mysqli_free_result($res);		
	
	if($friendName == $username)
	{ 
		$friendName = $result2['playerName'];
	}
	
	$show_stuff = true;
		
	if($friendPending == 0) 
	{
		$friend_already_accepted = true;
	}
	else
	{
		if(isset($_GET['accept']))
		{
			$user_check_query = "UPDATE ucp_friends SET friendPending = '0' WHERE ID = '$friend_id' LIMIT 1";
			$res = mysqli_query($link, $user_check_query);
			
			mysqli_free_result($res);

			$user_check_query = "INSERT INTO `notifications` (`master`, `sender`, `friend`, `read`) VALUES ('$playerID', '$username', '-1', '1')";
			$res = mysqli_query($link, $user_check_query);	

			mysqli_free_result($res);
			
			$friend_accepted = true;
			$show_stuff = false;
		}		
	}
}
else $show_stuff = false;

mysqli_free_result($res);
?>

            <app-popup _nghost-tnh-c158="">
                <div _ngcontent-tnh-c158="" class="popper">
                    <div _ngcontent-tnh-c158="" class="popup">
                        <header _ngcontent-tnh-c158=""><span _ngcontent-tnh-c158="">Confirmation</span><span _ngcontent-tnh-c158="" class="close" onclick="cancelDialog()"><i _ngcontent-tnh-c158="" class="far fa-fw fa-times"></i></span></header>
                        <div _ngcontent-tnh-c158="" class="popup-content">	
							<?php if($show_stuff == false && $friend_accepted == false) { ?>
							<app-popup-friends-approve _nghost-tnh-c206="" class="ng-star-inserted">
                                <div _ngcontent-tnh-c206="" class="ng-star-inserted">
                                    <app-info-bar _ngcontent-tnh-c206="" type="error" _nghost-tnh-c215="">
                                        <div _ngcontent-tnh-c215="" class="error infobar">
                                            <div _ngcontent-tnh-c215="" class="icon"><i _ngcontent-tnh-c215="" class="fa fa-exclamation-triangle fa-fw"></i></div>
                                            <div _ngcontent-tnh-c215="" class="message"> Invalid friend request </div>
                                        </div>
                                    </app-info-bar>
                                    <div _ngcontent-tnh-c206="" class="clearfix"></div>
                                </div>
                                <!---->
                                <!---->
                            </app-popup-friends-approve>							
							<?php } ?>						
							<?php if($show_stuff == true && $friend_already_accepted == false) { ?>
                            <p _ngcontent-tnh-c158="" translate="">Do you really want to accept <?php echo $friendName; ?> as a friend?</p>
                            <!---->
							<?php } ?>
                            <div _ngcontent-tnh-c158=""></div>
                            <!---->	
							<?php if($friend_already_accepted == true) { ?>
							<app-popup-friends-approve _nghost-tnh-c206="" class="ng-star-inserted">
                                <div _ngcontent-tnh-c206="" class="ng-star-inserted">
                                    <app-info-bar _ngcontent-tnh-c206="" type="error" _nghost-tnh-c215="">
                                        <div _ngcontent-tnh-c215="" class="error infobar">
                                            <div _ngcontent-tnh-c215="" class="icon"><i _ngcontent-tnh-c215="" class="fa fa-exclamation-triangle fa-fw"></i></div>
                                            <div _ngcontent-tnh-c215="" class="message"> Friendship already accepted </div>
                                        </div>
                                    </app-info-bar>
                                    <div _ngcontent-tnh-c206="" class="clearfix"></div>
                                </div>
                                <!---->
                                <!---->
                            </app-popup-friends-approve>
							<?php } ?>								
							<?php if($friend_accepted == true) { ?>
							<app-popup-friends-approve _nghost-tnh-c206="" class="ng-star-inserted">
                                <div _ngcontent-tnh-c206="" class="ng-star-inserted">
                                    <app-info-bar _ngcontent-tnh-c206="" type="success" _nghost-tnh-c215="">
                                        <div _ngcontent-tnh-c215="" class="success infobar">
                                            <div _ngcontent-tnh-c215="" class="icon"><i _ngcontent-tnh-c215="" class="fa fa-exclamation-triangle fa-fw"></i></div>
                                            <div _ngcontent-tnh-c215="" class="message"> Friend accepted </div>
                                        </div>
                                    </app-info-bar>
                                    <div _ngcontent-tnh-c206="" class="clearfix"></div>
                                </div>
                                <!---->
                                <!---->
                            </app-popup-friends-approve>
							<?php } ?>
							<?php if($show_stuff == true && $friend_already_accepted == false) { ?>
                            <div _ngcontent-tnh-c158="" class="buttons">								
                                <app-button _ngcontent-tnh-c158="" _nghost-tnh-c216="" class="tomato" onclick="cancelDialog()">
                                    <div _ngcontent-tnh-c216="" class="btn-wrapper">
                                        <div _ngcontent-tnh-c216="" class="button">
                                            <!---->
                                            <div _ngcontent-tnh-c216="" class="caption">Cancel</div>
                                            <!---->
                                        </div>
                                        <!---->
                                    </div>
                                </app-button>
                                <app-button _ngcontent-tnh-c158="" _nghost-tnh-c216="" class="blue" onclick="acceptFriend(<?php echo $friend_id; ?>)">
                                    <div _ngcontent-tnh-c216="" class="btn-wrapper">
                                        <div _ngcontent-tnh-c216="" class="button">
                                            <!---->
                                            <div _ngcontent-tnh-c216="" class="caption">Yes</div>
                                            <!---->
                                        </div>
                                        <!---->
                                    </div>
                                </app-button>
                                <!---->
                            </div>
							<?php } ?>
                            <!---->
                            <!---->
                        </div>
                    </div>
                </div>
            </app-popup>
            <!----> 