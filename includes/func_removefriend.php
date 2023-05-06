<?php 

require_once($_SERVER['DOCUMENT_ROOT'] . "/modules/core/header.php"); 

if(!isset($_GET['friend']))
{
	exit;
}	

$friend_id = $_GET['friend'];

$show_stuff = true;
$friend_removed = false;

if(!isset($link))
{
	$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

	if($link === false) 
	{
		die("ERROR: Could not connect. " . mysqli_connect_error());
	}	
}

$friend_id = mysqli_escape_string($link, $friend_id);

$user_check_query = "SELECT friendName, playerName, friendPending FROM ucp_friends WHERE ID = '$friend_id' LIMIT 1";
$res = mysqli_query($link, $user_check_query);
							
$rowcount = $res->num_rows;

if($rowcount > 0)
{
	$result2 = mysqli_fetch_array($res, MYSQLI_ASSOC);

	$friendName = $result2['friendName'];
	$friendPending = $result2['friendPending'];
	
	if($friendName == $username)
	{
		$friendName = $result2['playerName'];
	}	
	
	$show_stuff = true;
	
	if(isset($_GET['remove']))
	{
		$user_check_query = "DELETE FROM ucp_friends WHERE ID = '$friend_id' LIMIT 1";
		$res = mysqli_query($link, $user_check_query);
			
		$friend_removed = true;
		$show_stuff = false;
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
							<?php if($show_stuff == false && $friend_removed == false) { ?>
							<app-popup-friends-approve _nghost-tnh-c206="" class="ng-star-inserted">
                                <div _ngcontent-tnh-c206="" class="ng-star-inserted">
                                    <app-info-bar _ngcontent-tnh-c206="" type="error" _nghost-tnh-c215="">
                                        <div _ngcontent-tnh-c215="" class="error infobar">
                                            <div _ngcontent-tnh-c215="" class="icon"><i _ngcontent-tnh-c215="" class="fa fa-exclamation-triangle fa-fw"></i></div>
                                            <div _ngcontent-tnh-c215="" class="message"> Friendship already removed </div>
                                        </div>
                                    </app-info-bar>
                                    <div _ngcontent-tnh-c206="" class="clearfix"></div>
                                </div>
                                <!---->
                                <!---->
                            </app-popup-friends-approve>							
							<?php } ?>						
							<?php if($show_stuff == true) { ?>
                            <p _ngcontent-tnh-c158="" translate="">Do you really want to remove <?php echo $friendName; ?> from your friends?</p>
                            <!---->
							<?php } ?>
                            <div _ngcontent-tnh-c158=""></div>
                            <!---->								
							<?php if($friend_removed == true) { ?>
							<app-popup-friends-approve _nghost-tnh-c206="" class="ng-star-inserted">
                                <div _ngcontent-tnh-c206="" class="ng-star-inserted">
                                    <app-info-bar _ngcontent-tnh-c206="" type="success" _nghost-tnh-c215="">
                                        <div _ngcontent-tnh-c215="" class="success infobar">
                                            <div _ngcontent-tnh-c215="" class="icon"><i _ngcontent-tnh-c215="" class="fa fa-exclamation-triangle fa-fw"></i></div>
                                            <div _ngcontent-tnh-c215="" class="message"> Friend removed </div>
                                        </div>
                                    </app-info-bar>
                                    <div _ngcontent-tnh-c206="" class="clearfix"></div>
                                </div>
                                <!---->
                                <!---->
                            </app-popup-friends-approve>
							<?php } ?>
							<?php if($show_stuff == true) { ?>
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
                                <app-button _ngcontent-tnh-c158="" _nghost-tnh-c216="" class="blue" onclick="removeFriend(<?php echo $friend_id; ?>)">
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