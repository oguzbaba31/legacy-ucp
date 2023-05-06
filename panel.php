<?php

require_once("modules/core/header.php");

if(isset($_GET['page'])) 
{
    $current_page = $_GET['page'];
} 
else 
{
    $current_page = 'characters';
}

if(!is_file("modules/template/player/$current_page.php"))
{
	exit(); //require_once("error.php")
}

$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if($link === false) 
{
	die("ERROR: Could not connect.");
}

if(isset($_POST['message']))
{
	$gabim = $_POST['message'];
}

ignore_user_abort();

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Header</title>
    <base href="/">

    <!--<meta name="viewport" content="width=device-width, initial-scale=1">-->
	<meta name="viewport" content="width=device-width, initial-scale=0.1">
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700+Ubuntu:400,700" rel="stylesheet">

	<!-- Assets -->
	<script type="text/javascript">eval(unescape('%64%6f%63%75%6d%65%6e%74%2e%77%72%69%74%65%28%27%3c%6c%69%6e%6b%20%72%65%6c%3d%22%73%74%79%6c%65%73%68%65%65%74%22%20%68%72%65%66%3d%22%68%74%74%70%73%3a%2f%2f%70%72%6f%2e%66%6f%6e%74%61%77%65%73%6f%6d%65%2e%63%6f%6d%2f%72%65%6c%65%61%73%65%73%2f%76%35%2e%38%2e%31%2f%63%73%73%2f%61%6c%6c%2e%63%73%73%22%20%69%6e%74%65%67%72%69%74%79%3d%22%73%68%61%33%38%34%2d%42%78%34%70%79%74%48%6b%79%54%44%79%33%61%4a%4b%6a%47%6b%47%6f%48%50%74%33%74%76%76%36%7a%6c%77%77%6a%63%33%69%71%4e%37%6b%74%61%69%45%4d%4c%44%50%71%4c%53%5a%59%74%73%32%4f%6a%4b%63%42%78%31%22%20%63%72%6f%73%73%6f%72%69%67%69%6e%3d%22%61%6e%6f%6e%79%6d%6f%75%73%22%3e%5c%6e%09%3c%6c%69%6e%6b%20%72%65%6c%3d%22%73%74%79%6c%65%73%68%65%65%74%22%20%68%72%65%66%3d%22%68%74%74%70%73%3a%2f%2f%77%77%77%2e%6c%65%67%61%63%79%2d%72%70%2e%6e%65%74%2f%73%74%79%6c%65%2e%63%73%73%22%3e%20%5c%6e%09%3c%6c%69%6e%6b%20%72%65%6c%3d%22%73%74%79%6c%65%73%68%65%65%74%22%20%68%72%65%66%3d%22%68%74%74%70%73%3a%2f%2f%77%77%77%2e%6c%65%67%61%63%79%2d%72%70%2e%6e%65%74%2f%6d%6f%64%75%6c%65%73%2f%74%65%6d%70%6c%61%74%65%2f%70%6c%61%79%65%72%2f%73%74%79%6c%65%2e%63%73%73%22%3e%5c%6e%09%3c%73%63%72%69%70%74%20%73%72%63%3d%22%68%74%74%70%73%3a%2f%2f%61%6a%61%78%2e%67%6f%6f%67%6c%65%61%70%69%73%2e%63%6f%6d%2f%61%6a%61%78%2f%6c%69%62%73%2f%6a%71%75%65%72%79%2f%33%2e%35%2e%31%2f%6a%71%75%65%72%79%2e%6d%69%6e%2e%6a%73%22%3e%3c%2f%73%63%72%69%70%74%3e%27%29%3b'));</script>
</head>
<body>
    <router-outlet _ngcontent-tnh-c135=""></router-outlet>
    <app-panel _nghost-tnh-c136="">
        <div _ngcontent-tnh-c136="" id="wrapper">
            <div _ngcontent-tnh-c136="" id="page">
                    
				<?php require_once("navbar.php"); ?>
					
                <main _ngcontent-tnh-c136="" id="body_cont">

				<?php 
					
				if($current_page == "characters")
				{
					if(!empty($_GET['test']))
					{
						require_once("modules/template/player/profile.php");
					}
					else require_once("modules/template/player/$current_page.php");
				}
				else require_once("modules/template/player/$current_page.php");
					
				?>

                </main>

				<?php require_once("footer.php"); ?>	

            </div>
        </div>
        <!---->
        <div _ngcontent-tnh-c136="" class="bg-gradient"></div>
        <app-alerts _ngcontent-tnh-c136="" _nghost-tnh-c147="">
            <ul _ngcontent-tnh-c147="" class="message_pop_n">
                <?php if(isset($gabim)) { if(strlen($gabim) > 0) { ?><li _ngcontent-tnh-c147="" class="info"><span _ngcontent-tnh-c147="" class="icon"><i _ngcontent-tnh-c147="" class="fa fa-fw fa-info-circle"></i></span><span _ngcontent-tnh-c147="" translate="" class="message"> <?php echo $gabim; ?> </span></li><?php } } ?>
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