<?php 	
						
require_once($_SERVER['DOCUMENT_ROOT'] . "/modules/core/header.php"); 
						
if(!isset($link))
{
	$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

	if($link === false) 
	{
		die("ERROR: Could not connect.");
	}	
}					
						
$user_check_query = "SELECT `ID`, `Model`, `char_name` FROM `characters` WHERE `master` = '$playersqlid' LIMIT 6";
$result = mysqli_query($link, $user_check_query);
						
$char_count = $result->num_rows;
						
if($char_count > 0)
{	
	$i = 0;
							
	while($result2 = mysqli_fetch_array($result, MYSQLI_ASSOC))
	{
		$chardata[$i] = $result2;
								
		$i++;
	}
							
	mysqli_free_result($result);
}
						
if($char_count != playerVariableCharacters())
{
	$chars = array
	( 
		array("N/A", -1, 0),
		array("N/A", -1, 0),
		array("N/A", -1, 0),
		array("N/A", -1, 0),
		array("N/A", -1, 0),
		array("N/A", -1, 0)
	);							
							
	for($i = 0; $i < $char_count; ++$i)
	{								
		$chars[$i][0] = $chardata[$i]['char_name'];
		$chars[$i][1] = $chardata[$i]['ID'];
		$chars[$i][2] = $chardata[$i]['Model'];
								
		$_SESSION['characters'] = $chars; 
	}
}
						
$user_check_query = "SELECT `ID`, `char_name`, `skin` FROM `application` WHERE `master` = '$playersqlid' AND `status` < 2 LIMIT 1";
$result = mysqli_query($link, $user_check_query);
					
$app_count = $result->num_rows;
						
if($app_count > 0)
{	
	$i = 0; 
							
	while($result2 = mysqli_fetch_array($result, MYSQLI_ASSOC))
	{
		$appdata[$i] = $result2;
								
		$i++;
	}
							
	mysqli_free_result($result);
}						
						
?>							
<router-outlet _ngcontent-tnh-c136="" class="router-outlet"></router-outlet>
<app-character-list _nghost-tnh-c142="">
    <div _ngcontent-tnh-c142="" class="content-header">
        <h3 _ngcontent-tnh-c142="" translate="">My Characters</h3>		

        <app-button _ngcontent-tnh-c145="" caption="Freeze" icon="fa-file-contract" class="fl-ri blue margin-left-10" _nghost-tnh-c216="" onClick="changeCurrentPage('applications', '/panel/applications')">
            <div _ngcontent-tnh-c216="" class="btn-wrapper">
                <div _ngcontent-tnh-c216="" class="button">
                    <div _ngcontent-tnh-c216="" class="icon"><i _ngcontent-tnh-c216="" class="fa fa-file-contract"></i></div>
                    <!----> 
                    <div _ngcontent-tnh-c216="" class="caption">Application History</div>
                   <!---->
                </div>
                <!---->
            </div>
        </app-button>								
		<?php													
		if(!$app_count && $char_count != 6) 
		{
			
		?>
        <app-button _ngcontent-tnh-c145="" caption="Freeze" icon="fa-user-plus" class="fl-ri green" _nghost-tnh-c216="" onClick="changeCurrentPage('create-character', '/panel/create-character')">
            <div _ngcontent-tnh-c216="" class="btn-wrapper">
                <div _ngcontent-tnh-c216="" class="button">
                    <div _ngcontent-tnh-c216="" class="icon"><i _ngcontent-tnh-c216="" class="fa fa-user-plus"></i></div>
                    <!----> 
                    <div _ngcontent-tnh-c216="" class="caption">New</div>
                    <!---->
                </div>
                <!---->
            </div>
        </app-button>	
		<?php
		
		}						
		?>
    </div>
    <div _ngcontent-tnh-c142="" class="content">														
    <!---->
    <!---->							
	<?php							
	if($app_count > 0)
	{
		for($i = 0; $i < $app_count; ++$i)
		{
			
			for($x = 0; $x < sizeof($serverSkins); ++$x)
			{
				if($serverSkins[$x]["id"] == $appdata[$i]['skin'])
				{
					$appdata[$i]['skin'] = $serverSkins[$x]["name"];
					break;
				}
			}			
				
			?>	
			<section _ngcontent-tnh-c142="" class="character_preview nopadding transparent csquarterthird frozen" onClick="changeCurrentPage('applications', '<?php echo $appdata[$i]['ID']; ?>', 4)" style="background-image: url(&quot;http://localhost/assets/skins/<?php echo $appdata[$i]['skin']; ?>-380-600.png&quot;);">
				<h3 _ngcontent-tnh-c142="" class="section-header"> <?php echo $appdata[$i]['char_name']; ?> <i _ngcontent-tnh-c142="" class="fl-ri fa fa-fw fa-spinner fa-spin" style="margin-top: 5px;"></i> </h3>
				<div _ngcontent-tnh-c142="" class="character_ic_info"> 
					<span _ngcontent-tnh-c142="" class="app-info">                Your application for this character is being processed. <!--Your current position in the queue is {{ pending.queue }}.-->            </span> 
				</div>
			</section>
			<!---->
			<?php 
			
		}									
	}								
	if($char_count > 0)
	{
		for($i = 0; $i < $char_count; ++$i)
		{
			$playerid = $chardata[$i]['ID'];
			$Model = $chardata[$i]['Model'];
			$userii = $chardata[$i]['char_name'];
										
			$charname = explode("_", $userii);								
			
			for($x = 0; $x < sizeof($serverSkins); ++$x)
			{
				if($serverSkins[$x]["id"] == $Model)
				{
					$Model = $serverSkins[$x]["name"];
					break;
				}
			}
			
				?>
				
				<section _ngcontent-tnh-c142="" class="character_preview csquarterthird" tabindex="0" onClick="changeCurrentPage('characters', '<?php echo $userii; ?>', 1)" style="background-image: url(&quot;http://localhost/assets/skins/<?php echo $Model; ?>-380-600.png&quot;);">										
					<div _ngcontent-tnh-c142="" class="card-title flexy"><span _ngcontent-tnh-c142="" class="color-grey margin-right-10"><?php echo $playerid; ?></span><span _ngcontent-tnh-c142="" style="flex-grow: 1;"><?php echo $charname[0]; ?></span>
						<!--<app-activity-indicator _ngcontent-tnh-c142="" class="fl-ri" _nghost-tnh-c218=""><i _ngcontent-tnh-c218="" class="<?php echo returnActivityIcon($averagehours); ?>" title="<?php echo $averagehours; ?> h/d"></i></app-activity-indicator>-->
						<!----> 
						<!---->
					</div>
					<div _ngcontent-tnh-c142="" class="character_ic_info">										
					<?php											
					$user_check_query = "SELECT `id`, `posx`, `posy` FROM `houses` WHERE `owner` = '$userii' ORDER BY ID ASC LIMIT 1";
					$result2 = mysqli_query($link, $user_check_query);
											
					$house_count = $result2->num_rows;
											
					if($house_count > 0)
					{												
						$house_data = mysqli_fetch_array($result2, MYSQLI_ASSOC);
												
						$houseid = $house_data['id'];
						$str = returnStreet($house_data['posx'], $house_data['posy'], $streets); 
						$area = qomaLokacionin($house_data['posx'], $house_data['posy'], $zonat);
						$area_code = ReturnAreaCodeByName($area);
						$city = GetCity($house_data['posx'], $house_data['posy'], $cities);
												
						?>
						<span _ngcontent-tnh-c142=""  class="fl-ri" *ngIf="character.address">                <span _ngcontent-tnh-c142=""  class="key" translate>ADDRESS</span> <span _ngcontent-tnh-c142="" class="value"><?php echo $houseid; ?> <?php echo $str; ?><br><?php echo $area; ?> <?php echo $area_code; ?><br><?php echo $city; ?><br>                    <ng-container *ngIf="character.address.apartment">                         <br>                    </ng-container>                <br>                </span> </span>
						<?php
					}
											
					mysqli_free_result($result);										
					?>
											
					<!--<span _ngcontent-tnh-c142=""  class="fl-ri" *ngIf="character.address">                <span _ngcontent-tnh-c142=""  class="key" translate>1</span> <span _ngcontent-tnh-c142="" class="value">1<br>                    <ng-container *ngIf="character.address.apartment">                        APT. 1 <br>                    </ng-container>                2<br>                3</span> </span>-->
					<!----><span _ngcontent-tnh-c142="" class="fl-le"><span _ngcontent-tnh-c142="" translate="" class="key">id n.o.</span><span _ngcontent-tnh-c142="" class="value"><?php echo $playerid; ?></span><span _ngcontent-tnh-c142="" translate="" class="key">Last Name</span><span _ngcontent-tnh-c142="" class="value"><?php echo $charname[1]; ?></span><span _ngcontent-tnh-c142="" translate="" class="key">First Name</span><span _ngcontent-tnh-c142="" class="value"><?php echo $charname[0]; ?></span></span>
					</div>
				</section>
				<!---->
				<?php 
		}
	}							
	if($char_count + $app_count == 0)
	{
		?>									
        <section _ngcontent-tnh-c142="" class="cs-1 section-border-gradient transparent"> It looks like you don't have a character yet! Character is a factional person in the Los Santos universe, with its own story, memory and possessions. You can create one by submitting an application and writing out a short background story about how your character came to be and what's their role in Los Santos. <br _ngcontent-tnh-c142="">
            <app-button _ngcontent-tnh-c142="" icon="fa-plus-circle" caption="Create my first character" routerlink="/panel/characters/new" onClick="changeCurrentPage('create-character', '/panel/create-character')" class="green margin-top-20" _nghost-tnh-c216="" tabindex="0">
				<div _ngcontent-tnh-c216="" class="btn-wrapper">
					<div _ngcontent-tnh-c216="" class="button">
                        <div _ngcontent-tnh-c216="" class="icon"><i _ngcontent-tnh-c216="" class="fa fa-plus-circle"></i></div>
                        <!---->
                        <div _ngcontent-tnh-c216="" class="caption">Create my first character</div>
                        <!---->
                    </div>
                    <!---->
                </div>
            </app-button>
        </section>								
		<?php
	}								
	?>									
    </div>
</app-character-list>
						
<?php mysqli_close($link); ?>