<?php 

$host = $_SERVER['SERVER_NAME'];

if($host == "62.4.16.133")
{
	die();
}

require_once("modules/core/config.php");

session_start();

if(isset($_SESSION["playersqlid"])) 
{
    header("location: /panel/characters");
    exit;
}

$username = "";
$password = "";

$errors = 0;
$gabim = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST")
{
	$username = $_POST["username"];
	$email = $_POST['email'];	
	$password = $_POST['password'];	
	$confirm_password = $_POST['confirm_password'];	
	
	if(empty($username) || empty($email) || empty($password) || empty($confirm_password)) 
	{
		$errors++;
		
		$gabim = "Please fill in all the fields.";
	}
	else
	{
		if(strlen($username) < 3)
		{
			$errors++;
			
			$gabim = "Your username is too short.";
		}
		
		if(preg_match("/[^A-Za-z0-9]/", $username))
		{
			$errors++;
			
			$gabim = "Your username contains invalid characters.";
		}
		
		if(!valid_email($email))
		{
			$errors++;
			
			$gabim = "Invalid email address.";			
		}
		
		$names = array("nigger", "nigga", "fuck", "bitch", "shit", "whore", "dick", "penis");
			
		for($j = 0; $j < sizeof($names); ++$j)
		{
			if(strpos($username, $names[$j]) !== false)
			{
				$errors++;
					
				$gabim = "Your username contains invalid characters.";				
				break;
			}
		}		
	}	
	
	if(!$errors)
	{	
		if($password == $confirm_password)
		{
			$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

			if($link === false)
			{
				die("ERROR: Something went wrong, contact a developer.");
			}			
			
			$username = mysqli_real_escape_string($link, $username);
			$email = mysqli_real_escape_string($link, $email); 
			$password = mysqli_real_escape_string($link, $password); 
			$confirm_password = mysqli_real_escape_string($link, $confirm_password); 	
			
			$user_check_query = "SELECT `ID` FROM accounts WHERE `Username` = '$username' LIMIT 1";
			$result = mysqli_query($link, $user_check_query);
			
			$rowcount = $result->num_rows;	
			
			if($rowcount == 0)
			{	
				$password = hash('whirlpool', $password); 
				$password = strtoupper($password);	
				
				$ip_address = returnIpAddress();
		
				$user_check_query = "INSERT INTO accounts (Username, Password, Email, IP) VALUES ('$username', '$password', '$email', '$ip_address')";
				$result = mysqli_query($link, $user_check_query);

				$playersqlid = mysqli_insert_id($link);
				
				$body = "Welcome to Header, <strong>$username</strong>!<br><br>This is your main account which is generally used to manage your characters. You can't use your main account to play, therefore you will have to <a href='http://localhost/panel/create-character'>create a character</a>. Once this character gets approved by the Tester team you can start to (role)play on our gameserver and manage it on the UCP.<br><br>The UCP (User Control Panel) allows you to change your spawn location, your skin and much more. We wish you good luck!<br><br>If you have any questions, use the forums or our support site.";
				insertNotification($link, $playersqlid, "Welcome!", $body, "Administration");
				
				$chars = array( 
					array("N/A", -1, 0),
					array("N/A", -1, 0),
					array("N/A", -1, 0),
					array("N/A", -1, 0),
					array("N/A", -1, 0)
				);					
				
				$_SESSION['username'] = $username;		
				$_SESSION['adminlevel'] = 0;	
				$_SESSION['playersqlid'] = $playersqlid;
				$_SESSION['characters'] = $chars;	
				$_SESSION['playeremail'] = $email;	
				$_SESSION['namechanges'] = 0;	
				$_SESSION['phonechanges'] = 0;					
				$_SESSION['discord_auth'] = "";	
				$_SESSION['forum_auth'] = "";	
					
				header('location: /characters');	
			}
			else $gabim = "Username already taken.";
		}
		else $gabim = "Password does not match.";
	}
	//else $gabim = "There are a few errors with the form, correct them.";
}

// Close connection
mysqli_close($link);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Register | Header</title>
    <base href="/">

    <!--<meta name="viewport" content="width=device-width, initial-scale=1">-->
	<meta name="viewport" content="width=device-width, initial-scale=0.1">
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700+Ubuntu:400,700" rel="stylesheet">

    <!--<script src="assets/font-awesome/js/all.js"></script>-->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-Bx4pytHkyTDy3aJKjGkGoHPt3tvv6zlwwjc3iqN7ktaiEMLDPqLSZYts2OjKcBx1" crossorigin="anonymous">
	
	<link rel="stylesheet" href="http://localhost/style.css"> 
	
	<script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js'></script>
	
    <style>
        h1[_ngcontent-kmh-c135] {
            color: #369;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 250%;
        }
    </style>
    <style></style>
    <style>
        .vc-wrapper[_ngcontent-kmh-c210] {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            z-index: 2000;
            background: linear-gradient(to bottom, rgba(50, 100, 160, 0.1), rgba(50, 100, 160, 0.1)), url("http://localhost/assets/images/gunbg.png");
            background-repeat: repeat;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        
        .vc-wrapper[_ngcontent-kmh-c210]:after {
            background: #181c22;
            content: "";
            position: absolute;
            top: 50vh;
            left: 0;
            width: 100vw;
            height: 50vh;
        }
        
        .vc-msg[_ngcontent-kmh-c210] {
            width: 500px;
            height: -webkit-min-content;
            height: -moz-min-content;
            height: min-content;
            max-width: 100vw;
            background: white;
            z-index: 1;
            padding: 20px;
            box-shadow: 2px 2px 8px 0 rgba(0, 0, 0, 0.2);
        }
        
        .title[_ngcontent-kmh-c210] {
            font-size: 1.5em;
            margin-bottom: 10px;
        }
    </style>
    <style>
        #wrapper[_ngcontent-kmh-c136] {
            padding: 30px 30px 30px 30px;
            background: linear-gradient(to bottom, rgba(50, 100, 160, 0.1), rgba(50, 100, 160, 0.1)), url("http://localhost/assets/images/gunbg.png");
        }
        
        #page[_ngcontent-kmh-c136] {
            box-shadow: 0 0 20px 3px rgba(0, 0, 0, 0.5);
        }
        
        main[_ngcontent-kmh-c136] {
            background: #fff;
        }
        
        *[_ngcontent-kmh-c136] {
            margin: 0;
            padding: 0;
            font-family: "Roboto", sans-serif;
            font-stretch: 100%;
        }
        
        li[_ngcontent-kmh-c136] {
            list-style: none;
        }
        
        .content[_ngcontent-kmh-c136] {
            display: grid;
            grid-template-columns: repeat(24, 1fr);
            grid-template-rows: -webkit-min-content;
            grid-template-rows: min-content;
            grid-gap: 20px;
            padding: 20px;
        }
        
        .email-verify[_ngcontent-kmh-c136] {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            background: tomato;
            color: white;
            z-index: 1003;
            text-align: center;
            padding: 5px;
        }
        
        .email-verify[_ngcontent-kmh-c136] a[_ngcontent-kmh-c136] {
            text-decoration: underline;
        }
        
        [_nghost-kmh-c136] {
            display: grid;
            grid-template-rows: 250px auto;
            grid-template-columns: 1fr;
        }
        
        #wrapper[_ngcontent-kmh-c136] {
            grid-row: 1/span 1;
            grid-column: 1;
        }
        
        .bg-gradient[_ngcontent-kmh-c136] {
            grid-row: 2/span 1;
            grid-column: 1;
        }
        
        #page[_ngcontent-kmh-c136] {
            display: grid;
            grid-template-columns: -webkit-min-content auto;
            grid-template-columns: min-content auto;
            grid-template-rows: 55px auto 60px;
            min-height: calc(100vh - 30px);
        }
        
        .router-outlet[_ngcontent-kmh-c136] {
            display: none;
        }
        
        main[_ngcontent-kmh-c136] {
            display: grid;
            grid-row-start: 2;
            grid-row-end: 3;
            background: #eee;
        }
        
        footer[_ngcontent-kmh-c136] {
            grid-column-start: 2;
        }
        
        @media only screen and (max-width: 800px) {}
        
        .fl-ri[_ngcontent-kmh-c136] {
            float: right;
        }
        
        .fl-le[_ngcontent-kmh-c136] {
            float: left;
        }
        
        .ta-ri[_ngcontent-kmh-c136] {
            text-align: right;
        }
        
        .text-center[_ngcontent-kmh-c136] {
            text-align: center;
        }
        
        .margin-auto[_ngcontent-kmh-c136] {
            margin: auto;
        }
        
        .nopadding[_ngcontent-kmh-c136] {
            padding: 0px !important;
        }
        
        .nopadding-sides[_ngcontent-kmh-c136] {
            padding-left: 0;
            padding-right: 0;
        }
        
        .grid-newline[_ngcontent-kmh-c136] {
            grid-column-start: 1;
        }
        
        .chubby[_ngcontent-kmh-c136] {
            grid-column-end: span 2;
        }
        
        .top-margin-20[_ngcontent-kmh-c136] {
            margin-top: 20px !important;
        }
        
        .color-green[_ngcontent-kmh-c136] {
            color: green;
        }
        
        .color-red[_ngcontent-kmh-c136] {
            color: #b20000;
        }
        
        .color-tomato[_ngcontent-kmh-c136] {
            color: #FF6347 !important;
        }
        
        .size-10[_ngcontent-kmh-c136] {
            font-size: 10px;
        }
        
        .size-32[_ngcontent-kmh-c136] {
            font-size: 32px;
        }
        
        .test[_ngcontent-kmh-c136] {
            color: red;
        }
    </style>
    <style>
        [_nghost-kmh-c147] {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1002;
        }
        
        ul[_ngcontent-kmh-c147] li[_ngcontent-kmh-c147] {
            list-style: none;
            display: block;
            position: relative;
            min-width: 300px;
            margin-bottom: 10px;
            padding: 10px;
            box-sizing: border-box;
            color: rgba(255, 255, 255, 0.9);
            border-radius: 5px;
            box-shadow: 2px 2px 12px 0 rgba(0, 0, 0, 0.3);
        }
        
        ul[_ngcontent-kmh-c147] li[_ngcontent-kmh-c147] .icon[_ngcontent-kmh-c147] {
            color: white;
            border-right: 1px solid rgba(255, 255, 255, 0.3);
            padding-right: 10px;
            margin-right: 5px;
        }
        
        ul[_ngcontent-kmh-c147] li.error[_ngcontent-kmh-c147] {
            background: Tomato;
        }
        
        ul[_ngcontent-kmh-c147] li.warning[_ngcontent-kmh-c147] {
            background: #FF7900;
        }
        
        ul[_ngcontent-kmh-c147] li.success[_ngcontent-kmh-c147] {
            background: #4BB543;
        }
        
        ul[_ngcontent-kmh-c147] li.info[_ngcontent-kmh-c147] {
            background: #3264a0;
        }
        
        ul[_ngcontent-kmh-c147] li[_ngcontent-kmh-c147]:after {
            background: linear-gradient(to left, transparent, rgba(255, 255, 255, 0.2));
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            content: "";
        }
        
        ul[_ngcontent-kmh-c147] li.fading[_ngcontent-kmh-c147] {
            opacity: 0;
            transition: 0.5s all;
        }
    </style>
    <style>
        [_nghost-kmh-c137] {
            grid-row-start: 1;
            grid-row-end: 4;
            position: relative;
            background: #24282e;
        }
        
        [_nghost-kmh-c137] #panel[_ngcontent-kmh-c137] {
            background: #24282e;
            width: 230px;
            transition: all 0.3s;
            z-index: 3;
        }
        
        [_nghost-kmh-c137] #panel[_ngcontent-kmh-c137] *[_ngcontent-kmh-c137] {
            white-space: nowrap;
        }
        
        .phone-header[_ngcontent-kmh-c137] {
            display: none;
        }
        
        #panel.compact[_ngcontent-kmh-c137] {
            width: 50px;
        }
        
        #panel.compact[_ngcontent-kmh-c137] .category[_ngcontent-kmh-c137] {
            display: none;
        }
        
        #panel.compact[_ngcontent-kmh-c137] .user[_ngcontent-kmh-c137] {
            padding: 0;
        }
        
        #panel.compact[_ngcontent-kmh-c137] .user[_ngcontent-kmh-c137] .name[_ngcontent-kmh-c137],
        #panel.compact[_ngcontent-kmh-c137] .user[_ngcontent-kmh-c137] .description[_ngcontent-kmh-c137] {
            display: none;
        }
        
        #panel.compact[_ngcontent-kmh-c137] .user[_ngcontent-kmh-c137] .avatar[_ngcontent-kmh-c137] {
            width: 50px;
            height: 50px;
            border-radius: 0;
        }
        
        #panel.compact[_ngcontent-kmh-c137] .user[_ngcontent-kmh-c137] .icons[_ngcontent-kmh-c137] {
            display: none;
        }
        
        #panel.compact[_ngcontent-kmh-c137] .menu[_ngcontent-kmh-c137] li[_ngcontent-kmh-c137] {
            font-size: 1.25em;
        }
        
        #panel.compact[_ngcontent-kmh-c137] .menu[_ngcontent-kmh-c137] li[_ngcontent-kmh-c137] .link-label[_ngcontent-kmh-c137] {
            display: none;
        }
        
        #panel.compact[_ngcontent-kmh-c137] .phone-header[_ngcontent-kmh-c137] {
            margin: 3px;
            font-size: 1.25em;
        }
        
        @media only screen and (max-width: 800px) {
            #panel[_ngcontent-kmh-c137] {
                position: fixed;
                top: 0;
                left: 0;
                width: 230px;
                height: 100%;
                overflow-y: scroll;
            }
            header[_ngcontent-kmh-c137] {
                display: none;
            }
            .phone-header[_ngcontent-kmh-c137] {
                color: white;
                border-bottom: 1px solid rgba(255, 255, 255, 0.2);
                padding: 10px;
                margin: 10px;
                display: block;
            }
        }
        
        header[_ngcontent-kmh-c137] {
            color: #fff;
            z-index: 5;
            background-image: url('http://localhost/assets/images/serverlogo_big.png');
            background-repeat: no-repeat;
            background-size: 90%;
            background-position: center;
            padding: 15px;
            height: 50px;
        }
        
        header[_ngcontent-kmh-c137] h1[_ngcontent-kmh-c137] {
            font-size: 20px;
            display: none;
        }
        
        .user[_ngcontent-kmh-c137] {
            width: 100%;
            padding: 10px 10px 10px 10px;
            background: #24282e;
            position: relative;
            box-sizing: border-box;
            font-size: 1em;
        }
        
        .user[_ngcontent-kmh-c137] .avatar[_ngcontent-kmh-c137] {
            width: 45px;
            height: 45px;
            display: inline-block;
        }
        
        .user[_ngcontent-kmh-c137] .avatar[_ngcontent-kmh-c137] img[_ngcontent-kmh-c137] {
            width: 100%;
            height: 100%;
            border-radius: 50px;
        }
        
        .user[_ngcontent-kmh-c137] .description[_ngcontent-kmh-c137] {
            display: inline-block;
            vertical-align: top;
            padding-left: 10px;
            color: white;
            line-height: 1;
        }
        
        .user[_ngcontent-kmh-c137] .description[_ngcontent-kmh-c137] .rank[_ngcontent-kmh-c137] {
            color: rgba(255, 255, 255, 0.75);
            display: block;
            line-height: 1;
            font-size: 1em;
        }
        
        .user[_ngcontent-kmh-c137] .icons[_ngcontent-kmh-c137] {
            color: rgba(255, 255, 255, 0.75);
            display: inline;
            position: absolute;
            bottom: 10px;
            right: 10px;
            text-align: right;
        }
        
        .user[_ngcontent-kmh-c137] .icons[_ngcontent-kmh-c137] a[_ngcontent-kmh-c137] {
            margin-left: 5px;
            cursor: pointer;
        }
        
        .user[_ngcontent-kmh-c137] .icons[_ngcontent-kmh-c137] .icon[_ngcontent-kmh-c137]:hover {
            color: white;
        }
        
        .user[_ngcontent-kmh-c137] .icons[_ngcontent-kmh-c137] .selected[_ngcontent-kmh-c137] {
            color: #ffffff !important;
            border-bottom: 3px solid #55a9fe;
        }
        
        .category[_ngcontent-kmh-c137] {
            background: #24282e;
            padding: 10px;
            margin-top: 5px;
            cursor: pointer;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }
        
        .category[_ngcontent-kmh-c137] h2[_ngcontent-kmh-c137] {
            font-size: 1em;
            font-weight: bold;
            color: white;
            text-align: left;
        }
        
        .category[_ngcontent-kmh-c137] .change[_ngcontent-kmh-c137] {
            text-align: center;
            text-decoration: none;
            font-size: 10px;
        }
        
        .category[_ngcontent-kmh-c137] .collapse[_ngcontent-kmh-c137] {
            float: right;
            color: rgba(255, 255, 255, 0.8);
        }
        
        .category[_ngcontent-kmh-c137] .collapse[_ngcontent-kmh-c137]:hover {
            color: white;
        }
        
        ul.menu[_ngcontent-kmh-c137] li[_ngcontent-kmh-c137] {
            color: rgba(255, 255, 255, 0.9);
            padding: 5px 5px 5px 10px;
            margin-top: 5px;
            cursor: pointer;
            font-size: 1em;
            list-style-type: none;
            outline: none;
        }
        
        ul.menu[_ngcontent-kmh-c137] li[_ngcontent-kmh-c137] a[_ngcontent-kmh-c137] {
            text-decoration: none;
            color: inherit;
        }
        
        ul.menu[_ngcontent-kmh-c137] li[_ngcontent-kmh-c137] .link-label[_ngcontent-kmh-c137] {
            margin-left: 10px;
        }
        
        ul.menu[_ngcontent-kmh-c137] li[_ngcontent-kmh-c137] svg[_ngcontent-kmh-c137] {
            color: rgba(255, 255, 255, 0.5);
        }
        
        ul.menu[_ngcontent-kmh-c137] li[_ngcontent-kmh-c137]:hover {
            color: white;
        }
        
        ul.menu[_ngcontent-kmh-c137] li.selected[_ngcontent-kmh-c137] {
            border-left: 3px solid #55a9fe;
            padding-left: 7px;
            color: white;
        }
        
        ul.menu[_ngcontent-kmh-c137] li.selected[_ngcontent-kmh-c137] svg[_ngcontent-kmh-c137] {
            color: white;
        }
        
        ul.menu[_ngcontent-kmh-c137] li[_ngcontent-kmh-c137]:last-child {
            margin-bottom: 20px !important;
        }
        
        .gov[_ngcontent-kmh-c137] {
            position: relative;
            z-index: 1;
            text-shadow: 0 0 5px black;
        }
        
        .gov[_ngcontent-kmh-c137]:before {
            content: "";
            width: 100%;
            height: 100%;
            position: absolute;
            top: 0;
            left: 0;
            background-image: url("/assets/images/gov-menu.png");
            z-index: -1;
            opacity: 0.5;
        }
    </style>
    <style>
        @media only screen and (max-width: 800px) {
            [_nghost-kmh-c140] {
                grid-row: 1/span 1 !important;
                grid-column: 1/span 1 !important;
            }
            #wrapper[_ngcontent-kmh-c140] {
                grid-template-columns: auto 175px auto 100px !important;
            }
        }
        
        [_nghost-kmh-c140] {
            padding: 4px;
            background: #323439;
            z-index: 1;
            position: relative;
            font-size: 14px;
        }
        
        [_nghost-kmh-c140] #wrapper[_ngcontent-kmh-c140] {
            display: grid;
            padding: 5px;
            overflow: auto;
            grid-template-columns: auto -webkit-min-content;
            grid-template-columns: auto min-content;
            width: 100%;
        }
        
        [_nghost-kmh-c140] #wrapper[_ngcontent-kmh-c140] .icons[_ngcontent-kmh-c140] {
            font-weight: bold;
            text-align: right;
            margin: 0px 10px 0 0px;
            cursor: pointer;
            font-size: 1em;
            display: flex;
            align-items: center;
            white-space: nowrap;
        }
        
        [_nghost-kmh-c140] #wrapper[_ngcontent-kmh-c140] .icons[_ngcontent-kmh-c140] .user[_ngcontent-kmh-c140] {
            display: flex;
            align-content: center;
            font-weight: 500;
            cursor: pointer;
        }
        
        [_nghost-kmh-c140] #wrapper[_ngcontent-kmh-c140] .icons[_ngcontent-kmh-c140] .user[_ngcontent-kmh-c140] .avatar[_ngcontent-kmh-c140] {
            border-radius: 50%;
            background-size: 100%;
            height: 30px;
            width: 30px;
            position: relative;
            margin-left: 10px;
        }
        
        [_nghost-kmh-c140] #wrapper[_ngcontent-kmh-c140] .icons[_ngcontent-kmh-c140] .user[_ngcontent-kmh-c140] .avatar[_ngcontent-kmh-c140] .dropdown[_ngcontent-kmh-c140] {
            color: white;
            position: absolute;
            bottom: -5px;
            right: -5px;
        }
        
        [_nghost-kmh-c140] #wrapper[_ngcontent-kmh-c140] .icons[_ngcontent-kmh-c140] .user[_ngcontent-kmh-c140] .name[_ngcontent-kmh-c140] {
            color: white;
            line-height: 1.2;
        }
        
        [_nghost-kmh-c140] #wrapper[_ngcontent-kmh-c140] .icons[_ngcontent-kmh-c140] .user[_ngcontent-kmh-c140] .name[_ngcontent-kmh-c140] .rank[_ngcontent-kmh-c140] {
            color: #ddd;
            font-weight: 400;
        }
        
        [_nghost-kmh-c140] #wrapper[_ngcontent-kmh-c140] .icons[_ngcontent-kmh-c140] .icon-group[_ngcontent-kmh-c140] {
            display: inline-block;
            position: relative;
        }
        
        [_nghost-kmh-c140] #wrapper[_ngcontent-kmh-c140] .icons[_ngcontent-kmh-c140] .icon[_ngcontent-kmh-c140] {
            margin: 0 0 0 10px;
            color: #eee;
            background: rgba(255, 255, 255, 0.1);
            padding: 10px;
            border-radius: 50px;
            position: relative;
        }
        
        [_nghost-kmh-c140] #wrapper[_ngcontent-kmh-c140] .icons[_ngcontent-kmh-c140] .icon[_ngcontent-kmh-c140]:hover {
            cursor: pointer;
            background: rgba(255, 255, 255, 0.2);
        }
        
        [_nghost-kmh-c140] #wrapper[_ngcontent-kmh-c140] .icons[_ngcontent-kmh-c140] .notice[_ngcontent-kmh-c140] {
            font-size: 0.9em;
            line-height: 1.5em;
            background: red;
            width: 18px;
            height: 18px;
            text-align: center;
            border-radius: 20px;
            position: absolute;
            right: 0;
            color: rgba(255, 255, 255, 0.6);
            top: 0;
        }
        
        [_nghost-kmh-c140] #wrapper[_ngcontent-kmh-c140] .icons[_ngcontent-kmh-c140] .seen[_ngcontent-kmh-c140] {
            background: white;
            color: #444;
        }
        
        [_nghost-kmh-c140] #wrapper[_ngcontent-kmh-c140] .links[_ngcontent-kmh-c140] {
            margin: 3px 0 0 0;
            list-style: none;
        }
        
        [_nghost-kmh-c140] #wrapper[_ngcontent-kmh-c140] .links[_ngcontent-kmh-c140] li[_ngcontent-kmh-c140] {
            display: inline-block;
            margin-right: 10px;
            color: rgba(255, 255, 255, 0.5);
            background: rgba(255, 255, 255, 0.1);
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 1em;
        }
        
        [_nghost-kmh-c140] #wrapper[_ngcontent-kmh-c140] .links[_ngcontent-kmh-c140] li[_ngcontent-kmh-c140]:hover {
            cursor: pointer;
            background: rgba(255, 255, 255, 0.2);
            color: rgba(255, 255, 255, 0.8);
        }
        
        .social[_ngcontent-kmh-c140] {
            margin: 3px 0 0 20px;
        }
        
        .social[_ngcontent-kmh-c140] .discord[_ngcontent-kmh-c140]:hover {
            color: #7289da;
        }
        
        .social[_ngcontent-kmh-c140] .teamspeak[_ngcontent-kmh-c140]:hover {
            color: #87acba;
        }
        
        .social[_ngcontent-kmh-c140] .youtube[_ngcontent-kmh-c140]:hover {
            color: red;
        }
        
        .social[_ngcontent-kmh-c140] .twitter[_ngcontent-kmh-c140]:hover {
            color: #00aced;
        }
        
        .social[_ngcontent-kmh-c140]>*[_ngcontent-kmh-c140] {
            background: rgba(255, 255, 255, 0.1);
            padding: 5px;
            border-radius: 5px;
            margin: 0 5px 0 5px;
            color: rgba(255, 255, 255, 0.5);
        }
        
        .social[_ngcontent-kmh-c140]>*[_ngcontent-kmh-c140]:hover {
            cursor: pointer;
            background: rgba(255, 255, 255, 0.2);
        }
    </style>
    <style>
        [_nghost-kmh-c139] {
            padding: 10px;
            font-size: 0.8em;
            color: rgba(0, 0, 0, 0.5);
            height: 1fr;
            background: linear-gradient(to bottom, #eee, #f5f5f5);
            text-align: center;
        }
        
        [_nghost-kmh-c139] .links[_ngcontent-kmh-c139] a[_ngcontent-kmh-c139] {
            text-decoration: none;
            padding: 0 10px;
        }
    </style>
    <style>
        .container[_ngcontent-kmh-c207] {
            position: absolute;
            background: white;
            right: 60px;
            min-width: 300px;
            top: 60px;
            box-shadow: 2px 2px 8px 0 rgba(0, 0, 0, 0.2);
            text-align: left;
            cursor: default;
            font-size: 16px;
            padding: 10px;
            box-sizing: border-box;
            font-weight: 400;
            display: grid;
            grid-template-columns: 80px auto;
            grid-gap: 10px;
            z-index: 5;
        }
        
        .avatar[_ngcontent-kmh-c207] {
            width: 80px;
            height: 80px;
        }
        
        .menu[_ngcontent-kmh-c207] {
            float: right;
            display: inline-block;
        }
        
        .menu[_ngcontent-kmh-c207] .menu-icon[_ngcontent-kmh-c207] {
            color: #666;
            padding-left: 10px;
            cursor: pointer;
        }
        
        .menu[_ngcontent-kmh-c207] .menu-icon[_ngcontent-kmh-c207]:hover {
            color: black;
        }
        
        .characters[_ngcontent-kmh-c207] {
            border-top: 1px solid #ddd;
            grid-column: 1/-1;
            padding-top: 10px;
        }
        
        .characters[_ngcontent-kmh-c207] .character[_ngcontent-kmh-c207] {
            display: inline-block;
            width: 25px;
            height: 25px;
            background-size: 300%;
            background-position: center top 3px;
            background-repeaT: no-repeat;
            border-radius: 50%;
            background-color: #ddd;
            margin-right: 5px;
            cursor: pointer;
        }
    </style>
    <style>
        [_nghost-kmh-c159] {
            position: absolute;
            top: 55px;
            left: 0;
            width: 100%;
            height: 5px;
            background: #f6f6f6;
        }
        
        [_nghost-kmh-c159] .loadingbar[_ngcontent-kmh-c159] {
            width: 100%;
            height: 100%;
        }
        
        [_nghost-kmh-c159] .active[_ngcontent-kmh-c159] {
            background: linear-gradient(182deg, #3264a0, #eaf4ff);
            background-size: 400% 400%;
            -webkit-animation: LoadingSlider 2s ease infinite;
            animation: LoadingSlider 2s ease infinite;
        }
        
        @-webkit-keyframes LoadingSlider {
            0% {
                background-position: 68% 0%;
            }
            50% {
                background-position: 33% 100%;
            }
            100% {
                background-position: 68% 0%;
            }
        }
        
        @keyframes LoadingSlider {
            0% {
                background-position: 68% 0%;
            }
            50% {
                background-position: 33% 100%;
            }
            100% {
                background-position: 68% 0%;
            }
        }
    </style>
    <style>
        .active[_ngcontent-kmh-c150] {
            visibility: visible !important;
        }
        
        .notifications[_ngcontent-kmh-c150]:after {
            background: white;
            width: 20px;
            height: 20px;
            pointer-events: none;
            border-radius: 3px;
            position: absolute;
            right: 10px;
            top: 0;
            transform: rotate(45deg);
            content: "";
        }
        
        .notifications[_ngcontent-kmh-c150] {
            visibility: hidden;
            position: absolute;
            right: 10px;
            top: 50px;
            background: white;
            border-radius: 5px;
            box-shadow: 0px 5px 10px 2px rgba(0, 0, 0, 0.1);
        }
        
        .notifications[_ngcontent-kmh-c150] header[_ngcontent-kmh-c150] {
            padding: 15px 10px 10px 17px;
            border-bottom: 1px solid #eee;
        }
        
        .notifications[_ngcontent-kmh-c150] header[_ngcontent-kmh-c150] h2[_ngcontent-kmh-c150] {
            display: inline;
            font-size: 1em;
            font-weight: 500;
            color: #888;
        }
        
        .notifications[_ngcontent-kmh-c150] header[_ngcontent-kmh-c150] .close[_ngcontent-kmh-c150] {
            margin-top: 4px;
            margin-left: 10px;
        }
        
        .notifications[_ngcontent-kmh-c150] footer[_ngcontent-kmh-c150] {
            color: #333;
            background: #eee;
            padding: 10px;
            border-radius: 0 0 8px 8px;
        }
        
        .notifications[_ngcontent-kmh-c150] ul[_ngcontent-kmh-c150] {
            padding: 10px;
        }
        
        .notifications[_ngcontent-kmh-c150] ul[_ngcontent-kmh-c150] li[_ngcontent-kmh-c150] {
            list-style: none;
            margin-bottom: 5px;
            padding: 5px;
            display: flex;
        }
        
        .notifications[_ngcontent-kmh-c150] ul[_ngcontent-kmh-c150] li[_ngcontent-kmh-c150] .label[_ngcontent-kmh-c150] {
            font-weight: 500;
        }
        
        .notifications[_ngcontent-kmh-c150] ul[_ngcontent-kmh-c150] li[_ngcontent-kmh-c150] .label[_ngcontent-kmh-c150] .time[_ngcontent-kmh-c150] {
            display: block;
            color: #888;
        }
        
        .notifications[_ngcontent-kmh-c150] ul[_ngcontent-kmh-c150] li[_ngcontent-kmh-c150] .icon[_ngcontent-kmh-c150] {
            background: #55a9fe;
            color: white;
            border-radius: 50px;
            height: -webkit-min-content;
            height: -moz-min-content;
            height: min-content;
            padding: 10px 8px;
            margin-right: 15px;
        }
        
        .notifications[_ngcontent-kmh-c150] ul[_ngcontent-kmh-c150] li.read[_ngcontent-kmh-c150] {
            background: transparent;
        }
        
        .notifications[_ngcontent-kmh-c150] ul[_ngcontent-kmh-c150] li.read[_ngcontent-kmh-c150] .label[_ngcontent-kmh-c150] {
            font-weight: 400;
        }
        
        .notifications[_ngcontent-kmh-c150] ul[_ngcontent-kmh-c150] li.read[_ngcontent-kmh-c150] .icon[_ngcontent-kmh-c150] {
            background: #eee;
            color: black;
        }
    </style>
    <style>
        .frozen[_ngcontent-kmh-c142] {
            -webkit-filter: grayscale(90%);
            filter: grayscale(90%);
        }
        
        .character_preview[_ngcontent-kmh-c142] {
            background-color: #fff;
            background-repeat: no-repeat;
            background-position: -110px 30px;
            min-height: 200px;
            cursor: pointer;
            line-height: normal;
            box-shadow: 2px 2px 8px 0px rgba(0, 0, 0, 0.15);
            padding: 15px;
            box-sizing: border-box;
        }
        
        .character_preview[_ngcontent-kmh-c142] .character_ic_info[_ngcontent-kmh-c142] {
            float: right;
            padding-top: 10px;
            padding-right: 10px;
            line-height: normal;
            text-shadow: 0 0 9px #fff;
            min-width: 50%;
        }
        
        .character_preview[_ngcontent-kmh-c142] .character_ic_info[_ngcontent-kmh-c142] .key[_ngcontent-kmh-c142] {
            display: block;
            font-size: 12px;
            text-transform: uppercase;
            line-height: normal;
            margin-right: 20px;
        }
        
        .character_preview[_ngcontent-kmh-c142] .character_ic_info[_ngcontent-kmh-c142] .value[_ngcontent-kmh-c142] {
            display: block;
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 5px;
            line-height: normal;
        }
        
        .app-info[_ngcontent-kmh-c142] {
            margin-left: 150px;
            display: block;
        }
    </style>
    <style>
        @charset "UTF-8";
        [_nghost-kmh-c138] {
            display: grid;
            grid-template-rows: auto 150px 100px 100px 200px auto;
            grid-template-columns: auto 500px auto;
            height: 100vh;
            background: linear-gradient(to bottom, rgba(50, 100, 160, 0.1), rgba(50, 100, 160, 0.1)), url("http://localhost/assets/images/gunbg.png");
        }
        
        [_nghost-kmh-c138] .bg-footer[_ngcontent-kmh-c138] {
            grid-row-start: 4;
            grid-row-end: -1;
            grid-column-start: 1;
            grid-column-end: -1;
            background: #24282e;
        }
        
        [_nghost-kmh-c138] header[_ngcontent-kmh-c138] {
            background: url("http://localhost/assets/images/serverlogo_big.png") no-repeat center;
            background-position-y: 0;
            grid-column: 2/span 1;
            grid-row: 2/span 1;
        }
        
        [_nghost-kmh-c138] main.small[_ngcontent-kmh-c138] {
            grid-row: 3/span 1;
        }
        
        [_nghost-kmh-c138] main.small[_ngcontent-kmh-c138] button[_ngcontent-kmh-c138] {
            margin-top: -10px;
        }
        
        [_nghost-kmh-c138] main[_ngcontent-kmh-c138] {
            grid-row: 3/span 2;
            grid-column: 2/span 1;
            z-index: 1;
        }
        
        [_nghost-kmh-c138] main[_ngcontent-kmh-c138] a[_ngcontent-kmh-c138] {
            color: #fff;
            text-decoration: none;
        }
        
        [_nghost-kmh-c138] main[_ngcontent-kmh-c138] a[_ngcontent-kmh-c138]:hover {
            margin-top: -1px;
        }
        
        [_nghost-kmh-c138] main[_ngcontent-kmh-c138] .fieldset[_ngcontent-kmh-c138] {
            background: #34373d;
            color: #eee;
            box-shadow: 0px 0px 20px 3px rgba(5, 5, 0, 0.2);
            border-radius: 5px;
            width: 400px;
            height: 100%;
            margin: auto;
            display: grid;
            grid-template-columns: -webkit-min-content auto;
            grid-template-columns: min-content auto;
            padding: 20px;
        }
        
        [_nghost-kmh-c138] main[_ngcontent-kmh-c138] .fieldset[_ngcontent-kmh-c138] .label[_ngcontent-kmh-c138] {
            background: #3264a0;
            color: #e5e5e5;
            grid-column-start: 1;
            height: 16px;
            padding: 10px;
            border-radius: 5px 0 0 5px;
        }
        
        [_nghost-kmh-c138] main[_ngcontent-kmh-c138] .fieldset[_ngcontent-kmh-c138] input[_ngcontent-kmh-c138] {
            margin-bottom: 20px;
            font-size: 15px;
            padding: 8px;
            background: #43474c;
            color: #eee;
            border: none;
            height: 20px;
            border-radius: 0 5px 5px 0;
        }
        
        [_nghost-kmh-c138] main[_ngcontent-kmh-c138] .fieldset[_ngcontent-kmh-c138] input[_ngcontent-kmh-c138]::-webkit-input-placeholder {
            color: #ddd;
        }
        
        [_nghost-kmh-c138] main[_ngcontent-kmh-c138] .fieldset[_ngcontent-kmh-c138] input[_ngcontent-kmh-c138]::-moz-placeholder {
            color: #ddd;
        }
        
        [_nghost-kmh-c138] main[_ngcontent-kmh-c138] .fieldset[_ngcontent-kmh-c138] input[_ngcontent-kmh-c138]:-ms-input-placeholder {
            color: #ddd;
        }
        
        [_nghost-kmh-c138] main[_ngcontent-kmh-c138] .fieldset[_ngcontent-kmh-c138] input[_ngcontent-kmh-c138]::-ms-input-placeholder {
            color: #ddd;
        }
        
        [_nghost-kmh-c138] main[_ngcontent-kmh-c138] .fieldset[_ngcontent-kmh-c138] input[_ngcontent-kmh-c138]::placeholder {
            color: #ddd;
        }
        
        [_nghost-kmh-c138] main[_ngcontent-kmh-c138] .fieldset[_ngcontent-kmh-c138] input[_ngcontent-kmh-c138]:focus {
            outline: 0;
        }
        
        [_nghost-kmh-c138] main[_ngcontent-kmh-c138] .fieldset[_ngcontent-kmh-c138] .checkbox[_ngcontent-kmh-c138] {
            -webkit-appearance: none;
            background-color: #fafafa;
            border: 1px solid #cacece;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05), inset 0px -15px 10px -12px rgba(0, 0, 0, 0.05);
            padding: 9px;
            border-radius: 3px;
            display: inline-block;
            position: relative;
            margin: 0;
            cursor: pointer;
        }
        
        [_nghost-kmh-c138] main[_ngcontent-kmh-c138] .fieldset[_ngcontent-kmh-c138] .checkbox[_ngcontent-kmh-c138]:checked {
            background-color: #e9ecee;
            border: 1px solid #adb8c0;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05), inset 0px -15px 10px -12px rgba(0, 0, 0, 0.05), inset 15px 10px -12px rgba(255, 255, 255, 0.1);
            color: #99a1a7;
        }
        
        [_nghost-kmh-c138] main[_ngcontent-kmh-c138] .fieldset[_ngcontent-kmh-c138] .checkbox[_ngcontent-kmh-c138]:checked:after {
            content: "✔";
            font-size: 14px;
            position: absolute;
            top: 0;
            left: 3px;
            color: #99a1a7;
        }
        
        [_nghost-kmh-c138] main[_ngcontent-kmh-c138] button[_ngcontent-kmh-c138] {
            padding: 8px;
            border: 0;
            font-size: 14px;
            cursor: pointer;
            background: #3264a0;
            color: white;
            width: 100%;
            border-radius: 5px;
            height: 40px;
            margin-top: 15px;
        }
        
        [_nghost-kmh-c138] main[_ngcontent-kmh-c138] button[_ngcontent-kmh-c138]:disabled,
        [_nghost-kmh-c138] main[_ngcontent-kmh-c138] button[disabled][_ngcontent-kmh-c138] {
            background: #888 !important;
        }
        
        [_nghost-kmh-c138] main[_ngcontent-kmh-c138] .fat[_ngcontent-kmh-c138] {
            grid-column: 1/span 2;
        }
        
        [_nghost-kmh-c138] main[_ngcontent-kmh-c138] footer[_ngcontent-kmh-c138] {
            text-align: center;
            margin-top: 10px;
            font-size: 14px;
        }
        
        [_nghost-kmh-c138] main[_ngcontent-kmh-c138] footer[_ngcontent-kmh-c138] a[_ngcontent-kmh-c138] {
            text-decoration: none;
            color: #aaa;
            margin: 0 20px 0 20px;
        }
    </style>
	<style>
        .popper[_ngcontent-kmh-c158] {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            color: #333;
            z-index: 1000;
            display: flex;
            overflow-y: auto;
        }
        
        .popper[_ngcontent-kmh-c158]::after {
            content: "";
            background: linear-gradient(to bottom, rgba(50, 100, 160, 0.15), rgba(50, 100, 160, 0.15)), url("/assets/images/gunbg.png");
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            opacity: 0.7;
            z-index: 1000;
        }
        
        .popup[_ngcontent-kmh-c158] {
            background: white;
            z-index: 1001;
            box-shadow: 2px 2px 10px 2px rgba(0, 0, 0, 0.2);
            border-radius: 3px;
            position: relative;
            margin: auto;
            width: 600px;
            overflow: auto;
        }
        
        .popup-content[_ngcontent-kmh-c158] {
            padding: 20px;
        }
        
        header[_ngcontent-kmh-c158] {
            text-align: left;
            padding: 20px;
            border-bottom: 1px solid #eee;
            font-weight: 500;
            color: #333;
            background: #f5f5f5;
            border-radius: 3px 3px 0 0;
            display: flex;
            justify-content: space-between;
        }
        
        .close[_ngcontent-kmh-c158] {
            cursor: pointer;
            color: #888;
        }
        
        .close[_ngcontent-kmh-c158]:hover {
            color: #111;
        }
        
        .popup-form[_ngcontent-kmh-c158] {
            padding: 20px 0 10px 0;
        }
        
        .popup-form[_ngcontent-kmh-c158] input[_ngcontent-kmh-c158] {
            border: 0;
            border-radius: 5px;
            width: 100%;
            display: block;
            height: 30px;
        }
        
        .buttons[_ngcontent-kmh-c158] {
            width: 100%;
            text-align: right;
            margin-top: 20px;
        }
        
        .buttons[_ngcontent-kmh-c158]>*[_ngcontent-kmh-c158] {
            padding-left: 10px;
        }
    </style>	
</head>

<body>

        <router-outlet _ngcontent-kmh-c135=""></router-outlet>
        <app-register _nghost-kmh-c138="">
            <header _ngcontent-kmh-c138=""></header>
            <main _ngcontent-kmh-c138="">					
			
			<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div _ngcontent-kmh-c138="" class="fieldset">
				<label _ngcontent-kmh-c138="" for="name" class="fa fa-fw fa-user label"></label>
				<input _ngcontent-kmh-c138="" id="name" name="username" placeholder="username" class="ng-valid ng-dirty ng-touched">
				<label _ngcontent-kmh-c138="" for="name" class="fa fa-fw fa-envelope label"></label>
				<input _ngcontent-kmh-c138="" id="name" name="email" placeholder="email address" class="ng-valid ng-dirty ng-touched">				
				<label _ngcontent-kmh-c138="" for="password" class="fa fa-fw fa-lock label"></label>
				<input _ngcontent-kmh-c138="" id="password" name="password" type="password" placeholder="password" class="ng-valid ng-dirty ng-touched">	
				<label _ngcontent-kmh-c138="" for="password" class="fa fa-fw fa-lock label"></label>
				<input _ngcontent-kmh-c138="" id="password" name="confirm_password" type="password" placeholder="confirm password" class="ng-valid ng-dirty ng-touched">				
				<button _ngcontent-kmh-c138="" class="fat">Register</button>			
				</div>
				</form>
				
                <!---->
                <!---->
                <!---->
                <footer _ngcontent-kmh-c138=""><a href="http://localhost/login"><span style="color:white">Already have an account? Log In</a></footer>
				</br></br>
				<!--<center><span style="color: white; font-size: 11px;">Credits: Realpimp (Front-End, Back-End), Pristine (Bug finding, ideas, other stuff)</span></center>-->				
            </main>
            <div _ngcontent-kmh-c138="" class="bg-footer"></div>
			<?php if(strlen($gabim) > 0) { ?>
            <app-alerts _ngcontent-kmh-c138="" _nghost-kmh-c147="">
                <ul _ngcontent-kmh-c147="">
                    <li _ngcontent-kmh-c147="" class="info"><span _ngcontent-kmh-c147="" class="icon"><i _ngcontent-kmh-c147="" class="fa fa-fw fa-info-circle"></i></span><span _ngcontent-kmh-c147="" translate="" class="message"> <?php echo $gabim; ?> </span></li>
                    <!---->
                </ul>
            </app-alerts>
			<?php } ?>
        </app-login>
        <!---->
        <app-popup-container _ngcontent-kmh-c135="" _nghost-kmh-c186="">
            <!---->
        </app-popup-container>
        <app-version-check _ngcontent-kmh-c135="" _nghost-kmh-c210="">
            <!---->
        </app-version-check>


</body>

</html>