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

$gabim = "";

$user_check_query = "SELECT `answer1`, `answer2`, `answered_questions` FROM `accounts` WHERE `ID` = '$playersqlid' LIMIT 1";
$result = mysqli_query($link, $user_check_query);
						
$result2 = mysqli_fetch_array($result, MYSQLI_ASSOC);

$answered_questions = $result2['answered_questions'];	
$answer1 = $result2['answer1'];	
$answer2 = $result2['answer2'];	

$answer1clean = $answer1;
$answer2clean = $answer2;
							
mysqli_free_result($result);	

$ApplicationErrors = array();

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST")
{
	$character = $_POST["character"];
	$origin = $_POST["origin"];
	$gender = $_POST["gender"];
	$age = $_POST["age"];
	$story = $_POST["story"];
	$skin = $_POST["skin"];
	$clean_story = $story;
	
	if(empty($character) || empty($origin) || empty($gender) || empty($age)) 
	{
		array_push($ApplicationErrors, "Fill in all the fields.");
	}
							
	if(characterCount($character, "_") < 1)
	{
		array_push($ApplicationErrors, "Your character name format is not valid.");
	}
	
	$symbols = array("!", "@", "#", "$", "%", "^", "*", "(", ")", "=", "+", "-", "~", "[", "]", ">", "<", "?", "|", ":", "{", "}", "'");
	
	for($f = 0; $f < sizeof($symbols); $f++)
	{
		if(characterCount($character, $symbols[$f]))
		{
			array_push($ApplicationErrors, "Your character name contains invalid symbols.");
			break;
		}
	}	
							
	$character = mysqli_escape_string($link, $character);
	$origin = mysqli_escape_string($link, $origin);
	$gender = mysqli_escape_string($link, $gender);
	$story = mysqli_escape_string($link, $story);
	$skin = mysqli_escape_string($link, $skin);
							
	if($adminlevel < 1)
	{
		$answer1 = $_POST["answer1"];
		$answer2 = $_POST["answer2"];
		
		$answer1clean = $answer1;
		$answer2clean = $answer2;		
								
		$answer1 = mysqli_escape_string($link, $answer1);
		$answer2 = mysqli_escape_string($link, $answer2);
								
		if(empty($story))
		{
			array_push($ApplicationErrors, "Your background story is empty.");
		}
								
		if($answered_questions == 0 && (empty($answer1) || empty($answer2)))
		{
			array_push($ApplicationErrors, "OOC fields are empty.");
		}
	}					
							
	if(!is_numeric($age))
	{
		array_push($ApplicationErrors, "Birthyear must be a number, e.g. 1996.");
	}
							
	if(!count($ApplicationErrors))
	{	
		if($adminlevel >= 1 || strlen($story) > 200)
		{
			$user_check_query = "SELECT `ID` FROM `characters` WHERE `char_name` = '$character' LIMIT 1";
			$result = mysqli_query($link, $user_check_query);
									
			$rowcount = $result->num_rows;
									
			if($rowcount == 0)
			{	
				if($adminlevel > 0)
				{
					$phone_num = rand(100000, 999999);

					$user_check_query = "INSERT INTO `characters` (master, char_name, PhoneNumbr, Activated, Model) VALUES ('$playersqlid', '$character', '$phone_num', '1', '$skin')";
					$result = mysqli_query($link, $user_check_query);

					mysqli_close($link); 	
											
					echo "<script>document.location.href='http://localhost/panel/characters'</script>";
					exit;
				}
				else
				{
					$ip_address = returnIpAddress();										

					// Gather location data such as country name, code

					$json_url = "http://ip-api.com/json/$ip_address";
					$json = file_get_contents($json_url);
					$data = json_decode($json, TRUE);												
												
					$country_name = $data["country"];
					$country_code = $data["countryCode"];				
											
					$user_check_query = "SELECT `answered_questions` FROM `accounts` WHERE `ID` = '$playersqlid' LIMIT 1";
					$result = mysqli_query($link, $user_check_query);				
					$result2 = mysqli_fetch_array($result, MYSQLI_ASSOC);
											
					$answered_questions = $result2['answered_questions'];
											
					mysqli_free_result($result);
											
					if($answered_questions == 0)
					{												
						$user_check_query = "UPDATE `accounts` SET `answer1` = '$answer1', `answer2` = '$answer2', `answered_questions` = '1' WHERE `ID` = '$playersqlid' LIMIT 1";
						$result = mysqli_query($link, $user_check_query);	
					}
											
					$user_check_query = "INSERT INTO application (master, char_name, story, ip_address, country_name, country_code, origin, gender, age, skin) VALUES ('$playersqlid', '$character', '$story', '$ip_address', '$country_name', '$country_code', '$origin', '$gender', '$age', '$skin')";
					$result = mysqli_query($link, $user_check_query);
											
					$app_id = mysqli_insert_id($link);
											
					mysqli_close($link); 
											
					Discord_AlertStaff("@here A new character application has just been submitted by **$username**! http://localhost/admin/application/$app_id"); 
											
					echo "<script>document.location.href='http://localhost/panel/characters'</script>";
					exit;
				}
			}
			else
			{
				array_push($ApplicationErrors, "Character name is already taken.");
			}
		}
		else
		{
			array_push($ApplicationErrors, "Background story is too short.");
		}
	}
	else
	{
		$gabim = "Failed to submit your application";
	}
}
						
if(isset($link)) 
{ 
	mysqli_close($link); 
}

?>
<router-outlet _ngcontent-tnh-c136="" class="router-outlet"></router-outlet>
<app-settings _nghost-tnh-c144="">				
	<section class="content-header">
		<h3>New Character Application</h3>
	</section>								
	<form action="http://localhost/panel/create-character" method="post" name="forma_char" id="appi_test"></form>	
	<div class="content">
		<?php if(count($ApplicationErrors) > 0) { ?>
        <app-info-bar _ngcontent-tnh-c169="" type="warning" class="cs-1" _nghost-tnh-c215="">
			<div _ngcontent-tnh-c215="" class="warning infobar">
                <div _ngcontent-tnh-c215="" class="icon"><i _ngcontent-tnh-c215="" class="fa fa-exclamation-triangle fa-fw"></i></div>
                <div _ngcontent-tnh-c215="" class="message">There were a few errors while processing your application:
					<?php for($i = 0; $i < sizeof($ApplicationErrors); $i++)
					{
						?>
						<br><span style="padding-left: 40px;">- <?php echo $ApplicationErrors[$i]; ?></span>
						<?php
					}
					?>
				</div>
            </div>
        </app-info-bar>
		<?php } ?>
		<section class="card cshalf"> 
			<span class="card-title"> In Character Information</span>
			<app-input-text _ngcontent-tnh-c189="" placeholder="E-mail account" _nghost-tnh-c217="">													
				<div _ngcontent-tnh-c217="" class="wrapper" id="characterName">
					<!---->
					<label _ngcontent-tnh-c217="" for="input">Character name: (Firstname_Lastname - CAUTION: Make sure to put an underscore.)</label><input _ngcontent-tnh-c217="" form="appi_test" value="" id="input" name="character" type="text" class="ng-untouched ng-pristine ng-valid" oninput="onValueChange(this, 'characterName')">
				</div>
			</app-input-text>
			<div _ngcontent-tnh-c189="" class="margin-top-10">
				<app-input-text _ngcontent-tnh-c189="" placeholder="Origin: (IC)" _nghost-tnh-c217="">											
					<div _ngcontent-tnh-c217="" class="wrapper" id="origin">
					<!---->
					<label _ngcontent-tnh-c217="" for="input">Origin: (IC)</label><input _ngcontent-tnh-c217="" form="appi_test" value="" id="input" name="origin" type="text" class="ng-untouched ng-pristine ng-valid" oninput="onValueChange(this, 'origin')">
					</div>
				</app-input-text>
			</div>
			<div _ngcontent-tnh-c189="" class="margin-top-10">
				<app-input-text _ngcontent-tnh-c189="" placeholder="Gender: (IC - Male | Female)" _nghost-tnh-c217="">											
					<div _ngcontent-tnh-c217="" class="wrapper" id="gender">
						<!---->
						<label _ngcontent-tnh-c217="" for="input">Gender: (IC - Male | Female)</label><input _ngcontent-tnh-c217="" form="appi_test" value="" id="input" name="gender" type="text" class="ng-untouched ng-pristine ng-valid" oninput="onValueChange(this, 'gender')">
					</div>
				</app-input-text>
			</div>													
			<div _ngcontent-tnh-c189="" class="margin-top-10">
				<app-input-text _ngcontent-tnh-c189="" placeholder="Born: (IC - e.g. 1958 [Must be numeric.])" _nghost-tnh-c217="">												
					<div _ngcontent-tnh-c217="" class="wrapper" id="birthday">
						<!---->
						<label _ngcontent-tnh-c217="" for="input">Birthyear: (IC - example: 1995 [Must be numeric.])</label><input _ngcontent-tnh-c217="" form="appi_test" value="" id="birthdayinputelement" name="age" type="text" class="ng-untouched ng-pristine ng-valid" oninput="onValueChange(this, 'birthday')">
					</div>
				</app-input-text>
			</div>
			<div _ngcontent-tnh-c189="" class="margin-top-10" style="display: none;">
				<app-input-text _ngcontent-tnh-c189="" placeholder="Skin" _nghost-tnh-c217="">												
					<div _ngcontent-tnh-c217="" class="wrapper">
						<!---->
						<label _ngcontent-tnh-c217="" for="input">Skin</label><input _ngcontent-tnh-c217="" form="appi_test" value="" id="inputSkin" name="skin" type="text" class="ng-untouched ng-pristine ng-valid">
					</div>
				</app-input-text>
			</div>			
		</section>
		<section class="card cshalf"> 
			<span class="card-title"> Select skin</span>
			<div class="skin-container">
				<?php
				
				for($i = 0; $i < sizeof($serverSkins); ++$i)
				{
					?>
					<div class="skin-box" id="skin<?php echo $serverSkins[$i]["id"]; ?>" onclick="selectSkinModel(this, <?php echo $serverSkins[$i]["id"]; ?>)" style="background-image: url('http://localhost/assets/skins_small/<?php echo $serverSkins[$i]["name"]; ?>-240-400.png');"></div>					
					<?php
				}
				
				?>				
			</div>
		</section>			
		<?php if($adminlevel < 1) { ?>		
		<section class="card cs-1"> <span class="card-title">            <i class="fa fa-fw fa-book color-blue"></i> Your character's Background Story            <!--<span class="fl-ri" *ngIf="!story || (story && (story.length < requirements.ic.lower || story.length > requirements.ic.upper))">                <i class="fa fa-fw fa-times color-tomato"></i>            </span> <span class="fl-ri" *ngIf="story && (story.length >= requirements.ic.lower && story.length <= requirements.ic.upper)">                <i class="fa fa-fw fa-check color-green"></i>            </span> <span class="fl-ri color-grey">                requirement of {{ requirements.ic.lower }} characters            --></span> </span>
			<p> Information within this section relates to the background of your character, prior to your use on the server. This can consist of their origins, backstory in relation to future character development & anything you believe is of note to the character you are portraying on the server. This box is your first opportunity to highlight the type of character you wish to bring to our roleplaying community! <textarea ondrop="return false;" onpaste="return false;" form="appi_test" name="story" id="bgstoryelement" placeholder="Write your story here" [(ngModel)]="story"><?php if(isset($story)) { echo $clean_story; } ?></textarea> </p>
		</section>
		<?php } if($adminlevel < 1) { ?>
		<section class="card cs-1"> <span class="card-title">            <i class="fa fa-fw fa-book color-blue"></i> Something about you            <!--<span class="fl-ri" *ngIf="!about || (about && (about.length < requirements.ooc.lower || about.length > requirements.ooc.upper))">                <i class="fa fa-fw fa-times color-tomato"></i>            </span> <span class="fl-ri" *ngIf="about && (about.length >= requirements.ooc.lower && about.length <= requirements.ooc.upper)">                <i class="fa fa-fw fa-check color-green"></i>            </span> <span class="fl-ri color-grey">                requirement of {{ requirements.ooc.lower }} characters            --></span> </span>
			<p> Tell us about yourself. Do you have any experience? <textarea <?php if($answered_questions) { ?>disabled<?php } ?> ondrop="return false;" onpaste="return false;" form="appi_test" name="answer1" class="height-100" placeholder="About you" [(ngModel)]="about"><?php echo $answer1clean; ?></textarea> </p>
		</section>	
		<section class="card cs-1"> <span class="card-title">            <i class="fa fa-fw fa-book color-blue"></i> Other           <!-- <span class="fl-ri" *ngIf="!about || (about && (about.length < requirements.ooc.lower || about.length > requirements.ooc.upper))">                <i class="fa fa-fw fa-times color-tomato"></i>            </span> <span class="fl-ri" *ngIf="about && (about.length >= requirements.ooc.lower && about.length <= requirements.ooc.upper)">                <i class="fa fa-fw fa-check color-green"></i>            </span> <span class="fl-ri color-grey">                requirement of {{ requirements.ooc.lower }} characters            --></span> </span>
			<p> Explain some roleplaying terms, like metagaming and powergaming, and give two examples to each. <textarea <?php if($answered_questions) { ?>disabled<?php } ?> ondrop="return false;" onpaste="return false;" form="appi_test" name="answer2" class="height-100" placeholder="Write here" [(ngModel)]="about"><?php echo $answer2clean; ?></textarea> </p>
		</section>		
		<?php } ?>																			
	</div>
	<center>
		<!--<div class="notice">Once the application is submitted you MUST log into game in order for your application to be reviewed. If you are resubmitting your application after being denied you must. Failure to do so will result in an application that will not be reviewed and eventually denied for not logging in.</div>-->
		</br>
		<app-button _ngcontent-tnh-c145="" caption="Freeze" icon="fa-snowflake" class="blue" _nghost-tnh-c216="" onclick="submitApplication()">
			<div _ngcontent-tnh-c216="" class="btn-wrapper">
				<div _ngcontent-tnh-c216="" class="button">		
					<div _ngcontent-tnh-c216="" class="icon"><i _ngcontent-tnh-c216="" class="fa fa-save"></i></div>	
					<!---->
					<div _ngcontent-tnh-c216="" class="caption"><?php echo $adminlevel > 0 ? "Create my character!" : "Post my application!"; ?></div>
					<!---->
				</div>
				<!---->
			</div>
		</app-button>									
	</center>						
</app-settings>
<!---->

<script>

var check = <?php if($adminlevel > 0) { ?>true;<?php } else { ?>false;<?php } ?>

aplicationFormElementID = document.getElementById('appi_test');

var selectedSkinModel = -1;

function selectSkinModel(element, id)
{
	if(selectedSkinModel != -1)
	{
		document.getElementById(`skin${selectedSkinModel}`).classList.remove("skin-active");
	}
	
	document.getElementById("inputSkin").value = id;
	
	element.classList.add("skin-active");
	
	selectedSkinModel = id;
}

function submitApplication()
{
	if(selectedSkinModel == -1)
	{
		alert("Select a skin first.");
		return;
	}
	
	if(check == false)
	{
		const bgstoryelement = document.getElementById("bgstoryelement").value;
		
		if(bgstoryelement.length < 200)
		{
			alert("Your background story is too short.");
			return;		
		}
	}
	
	/*const birthdayelement = document.getElementById("birthdayinputelement").value;
	
	if(birthdayelement.isInteger == false)
	{
		alert("Birthday must be a number. (Example: 1996)");
		return;
	}*/ 
	
	aplicationFormElementID.submit();
}

</script> 