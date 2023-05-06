<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/modules/core/config.php"); 

session_start();

if(isset($_SESSION["playersqlid"])) exit("false");

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST")
{
	$username = $_POST["username"];
	$password = $_POST['password'];
		
	
	if(empty($username) || empty($password)) $errors++;
	
	if(!$errors)
	{	
		$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

		if($link === false){
			die("ERROR: Could not connect. " . mysqli_connect_error());
		}

		$username = mysqli_real_escape_string($link, $username);
		$password = mysqli_real_escape_string($link, $password); 		

		$user_check_query = "SELECT ID, Password, Quiz, Admin, Email, Namechanges, Phonechanges, Discord, Forum, DonateRank FROM accounts WHERE Username = '$username' LIMIT 1";
		$result = mysqli_query($link, $user_check_query);
		$result2 = mysqli_fetch_array($result, MYSQLI_ASSOC);
		
		$rowcount = $result->num_rows;	
		
		if($rowcount > 0)
		{	
			$passi_numer_dy = hash('whirlpool', $password); 
			$passi_numer_dy = strtoupper($passi_numer_dy);
			
			$passi = $result2['Password'];
			$adminlevel = $result2['Admin'];
			$useridja = $result2['ID'];
			$emaili = $result2['Email'];
			$namech = $result2['Namechanges'];
			$phonech = $result2['Phonechanges'];
			$discordauth = $result2['Discord'];
			$forumauth = $result2['Forum'];
			$donaterank = $result2['DonateRank'];
			$quiz = $result2['Quiz'];

			mysqli_free_result($result);

			$user_check_query = "SELECT reason, date FROM bans WHERE name = '$username' LIMIT 1";
			$result = mysqli_query($link, $user_check_query);

			$rowcount = $result->num_rows;
		
			if($rowcount == 0)
			{						
				if($passi_numer_dy == $passi)
				{				
					$chars = array( 
						array("N/A", -1, 0),
						array("N/A", -1, 0),
						array("N/A", -1, 0),
						array("N/A", -1, 0),
						array("N/A", -1, 0),
						array("N/A", -1, 0)
					);		
			
					$user_check_query = "SELECT ID, char_name, Model FROM characters WHERE master = '$useridja' LIMIT 6";
					$result = mysqli_query($link, $user_check_query);
					
					$count = 0;
					
					while($result2 = mysqli_fetch_array($result, MYSQLI_ASSOC))
					{
						$emri = $result2['char_name'];
						$playid = $result2['ID'];
						$Model = $result2['Model'];
						
						$chars[$count][0] = returnName($emri);
						$chars[$count][1] = $playid;
						$chars[$count][2] = $Model;
						
						$count++;
					}
					
					mysqli_free_result($result);
					
					if($count > 0)
					{
						$averagehours = averageHours($link, $username);
					}
					else $averagehours = 0.0;
					
					$client_ip = returnIpAddress();
					$client_browser = getBrowser();
					$client_os = getOS();
					
					$user_check_query = "INSERT INTO ucp_logins(User, IP, Browser, OS) VALUES ('$username', '$client_ip', '$client_browser', '$client_os')";
					$result = mysqli_query($link, $user_check_query);	

					mysqli_free_result($result);						
					mysqli_close($link);
			
					$_SESSION['username'] = $username;	
					$_SESSION['quiz'] = $quiz;	
					$_SESSION['donaterank'] = $donaterank;			
					$_SESSION['adminlevel'] = $adminlevel;					
					$_SESSION['playersqlid'] = $useridja;
					$_SESSION['playeremail'] = $emaili;	
					$_SESSION['namechanges'] = $namech;	
					$_SESSION['phonechanges'] = $phonech;					
					$_SESSION['characters'] = $chars;
					$_SESSION['discord_auth'] = $discordauth;		
					$_SESSION['forum_auth'] = $forumauth;
					$_SESSION['averagehours'] = $averagehours;
										
					exit("true");
				}
				else 
				{
					mysqli_close($link);
					
					$gabim = "Invalid credentials given";
				}
			}
			else
			{
				$BanData = mysqli_fetch_array($result, MYSQLI_ASSOC);
				
				mysqli_free_result($result);
				
				?>
				
				<app-popup _nghost-kmh-c158="">
					<div _ngcontent-kmh-c158="" class="popper">
						<div _ngcontent-kmh-c158="" class="popup">
							<header _ngcontent-kmh-c158=""><span _ngcontent-kmh-c158="">You've been banned!</span><span _ngcontent-kmh-c158="" class="close" onclick="document.getElementById('app-alerts').innerHTML = '';"><i _ngcontent-kmh-c158="" class="far fa-fw fa-times"></i></span></header>
							<div _ngcontent-kmh-c158="" class="popup-content">	
							<p>It appears there is an active ban on your account.<br><br>Ban for "<?php echo $BanData['reason']; ?>", issued <?php echo $BanData['date']; ?><br><br>If you feel that you've been banned wrongly, please appeal in the <strong>Ban Appeal section</strong> of our forum.</p>
							</div>
						</div>
					</div>
				</app-popup>

				<?php
				
				mysqli_close($link);
				exit();
			}
		}
		else $gabim = "Account was not found";		
	}
	else $gabim = "There are a few errors with the form, correct them";
}
?>

					<ul _ngcontent-kmh-c147="" class="message_pop_n">
						<li _ngcontent-kmh-c147="" class="info"><span _ngcontent-kmh-c147="" class="icon"><i _ngcontent-kmh-c147="" class="fa fa-fw fa-info-circle"></i></span><span _ngcontent-kmh-c147="" translate="" class="message"> <?php echo $gabim; ?> </span></li>
						<!---->
					</ul>