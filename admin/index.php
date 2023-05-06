<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/modules/core/header.php"); 
require_once($_SERVER['DOCUMENT_ROOT'] . "/modules/core/staff.php"); 

$admin_panel = true; 

if(isset($_GET['page'])) 
{
    $current_page = $_GET['page'];
} 
else 
{
    $current_page = 'dashboard';
}

if(!is_file("../modules/template/admin/$current_page.php"))
{
	exit(); //require_once("error.php")
}

$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if($link === false) 
{
	die("ERROR: Could not connect. " . mysqli_connect_error());
}

ignore_user_abort();

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Administration | Header</title>
    <base href="/">

    <!--<meta name="viewport" content="width=device-width, initial-scale=1">-->
	<meta name="viewport" content="width=device-width, initial-scale=0.1">
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700+Ubuntu:400,700" rel="stylesheet">

	<!-- Assets -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-Bx4pytHkyTDy3aJKjGkGoHPt3tvv6zlwwjc3iqN7ktaiEMLDPqLSZYts2OjKcBx1" crossorigin="anonymous">
	<link rel="stylesheet" href="http://localhost/style.css"> 
	<link rel="stylesheet" href="http://localhost/modules/template/admin/style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="http://localhost/js/page.js" defer></script>	
	<script src="http://localhost/js/admin.js" defer></script>	
</head>
<body <?php if($current_page == "lookup") { ?>onload="switchMenu(1)"<?php } ?>>
    <router-outlet _ngcontent-tnh-c135=""></router-outlet>
    <app-panel _nghost-tnh-c136="">
        <div _ngcontent-tnh-c136="" id="wrapper">
            <div _ngcontent-tnh-c136="" id="page">
                    
				<?php require_once("../navbar.php"); ?>
					
				<main _ngcontent-tnh-c136="" id="body_cont">

				<?php 

				require_once("../modules/template/admin/$current_page.php");
					
				?>

                </main>

				<?php require_once("../footer.php"); ?>	

            </div>
        </div>
        <!---->
        <div _ngcontent-tnh-c136="" class="bg-gradient"></div>
        <app-alerts _ngcontent-tnh-c136="" _nghost-tnh-c147="">
            <ul _ngcontent-tnh-c147="" class="message_pop_n_admin" id="message_pop_n_admin">
                <?php if(isset($gabim)) { if(strlen($gabim) > 0) { ?><li _ngcontent-tnh-c147="" class="info"><span _ngcontent-tnh-c147="" class="icon"><i _ngcontent-tnh-c147="" class="fa fa-fw fa-info-circle"></i></span><span _ngcontent-tnh-c147="" translate="" class="message"> <?php echo $gabim; ?> </span></li><?php } } ?>
					
				<li _ngcontent-tnh-c147="" class="info" id="infomsg" style="display: none;"><span _ngcontent-tnh-c147="" class="icon"><i _ngcontent-tnh-c147="" class="fa fa-fw fa-info-circle"></i></span><span _ngcontent-tnh-c147="" translate="" class="message" id="message"> <?php echo $gabim; ?> </span></li>
                <!---->
            </ul>
        </app-alerts>
        <!---->
        <!---->
    </app-panel>
    <!---->
    <app-popup-container _ngcontent-tnh-c135="" _nghost-tnh-c186="" id="popup_container">

    </app-popup-container>
    <app-version-check _ngcontent-tnh-c135="" _nghost-tnh-c210="">
        <!---->
    </app-version-check> 
</body>

</html>