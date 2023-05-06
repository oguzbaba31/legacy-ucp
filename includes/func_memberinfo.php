<?php 

require_once($_SERVER['DOCUMENT_ROOT'] . "/modules/core/header.php"); 

if(!isset($_GET['faction']) || !isset($_GET['member']))
{
	exit;
}	

$factionid = $_GET['faction'];
$char_name = $_GET['member'];

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

$factionid = mysqli_escape_string($link, $factionid);
$char_name = mysqli_escape_string($link, $char_name);

$user_check_query = "SELECT `master`, `Online`, `FactionRank`, `LastLogin` FROM `characters` WHERE `char_name` = '$char_name' AND `Faction` = '$factionid' LIMIT 1";
$res = mysqli_query($link, $user_check_query);
							
$rowcount = $res->num_rows;

if($rowcount > 0)
{
	$result2 = mysqli_fetch_array($res, MYSQLI_ASSOC);
	
	$master = $result2["master"];
	$Online = $result2["Online"];
	$FactionRanki = $result2["FactionRank"];
	$LastLogin = $result2["LastLogin"];	
	
	mysqli_free_result($res);
	
	$master_name = returnMaster($link, $master);
	
	$user_check_query = "SELECT factionRank1, factionRank2, factionRank3, factionRank4, factionRank5, factionRank6, factionRank7, factionRank8, factionRank9, factionRank10, factionRank11, factionRank12, factionRank13, factionRank14, factionRank15, factionRank16 FROM `factions` WHERE `factionID` = '$factionid'";
	$res = mysqli_query($link, $user_check_query);
							
	$rowcount = $res->num_rows;
							
	if($rowcount == 0) die();
							
	$result2 = mysqli_fetch_array($res, MYSQLI_ASSOC);
							
	$i = 0;
							
	$factionRanks = array("", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "");
							
	for($i = 1; $i < 17; $i++)
	{
		$factionRanks[$i - 1] = $result2["factionRank$i"];
	}
							
	mysqli_free_result($res);	
}
else
{
	mysqli_free_result($res);
	mysqli_close($link);
	
	exit();
}

mysqli_close($link);
?>

			<app-popup _nghost-tnh-c158="">
				<div _ngcontent-tnh-c158="" class="popper">
					<div _ngcontent-tnh-c158="" class="popup">
						<header _ngcontent-tnh-c158=""><span _ngcontent-tnh-c158="">Member Information</span><span _ngcontent-tnh-c158="" class="close" onclick="cancelDialog()"><i _ngcontent-tnh-c158="" class="far fa-fw fa-times"></i></span></header>
						<div _ngcontent-tnh-c158="" class="popup-content">
							<!---->
							<div _ngcontent-tnh-c158=""></div>
							<!---->
							<!---->
							<app-popup-faction-member _nghost-tnh-c195="">
								<div _ngcontent-tnh-c195="" class="table"><span _ngcontent-tnh-c195="">Account</span><span _ngcontent-tnh-c195=""><?php echo $master_name; ?></span><span _ngcontent-tnh-c195="">Character</span><span _ngcontent-tnh-c195=""><?php echo $char_name; ?></span><span _ngcontent-tnh-c195="">Rank</span><span _ngcontent-tnh-c195=""><?php echo $factionRanks[$FactionRanki - 1]; ?></span><span _ngcontent-tnh-c195="">Last Online</span><?php if($Online == 1) { ?><span _ngcontent-tnh-c195="" class='color-green strongish'>Online</span><?php } else { ?><span _ngcontent-tnh-c195=""><?php echo date('Y/m/d H:i:s', $LastLogin); ?></span><?php } ?>
									<!---->
									<!---->
									<!---->
									<!---->
								</div>
								<!---->
								<div _ngcontent-tnh-c195="">
									<!---->
									<!---->
								</div>
							</app-popup-faction-member>
							<!---->
						</div>
					</div>
				</div>
			</app-popup>
			<!---->