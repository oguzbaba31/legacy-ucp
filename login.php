<?php 

$host = $_SERVER['SERVER_NAME'];

if($host == "0.0.0.1") { die(); }

session_start();

if(isset($_SESSION["playersqlid"])) 
{
    header("location: /panel/characters");
    exit;
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Header | Login</title>
    <base href="/">

    <!--<meta name="viewport" content="width=device-width, initial-scale=1">-->
	<meta name="viewport" content="width=device-width, initial-scale=0.1">
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700+Ubuntu:400,700" rel="stylesheet">

	<!-- Assets -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-Bx4pytHkyTDy3aJKjGkGoHPt3tvv6zlwwjc3iqN7ktaiEMLDPqLSZYts2OjKcBx1" crossorigin="anonymous">
	<link rel="stylesheet" href="http://localhost/style.css"> 
	<link rel="stylesheet" href="http://localhost/login.css">

	<script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js'></script>
</head>
<body>
    <router-outlet _ngcontent-kmh-c135=""></router-outlet>
    <app-login _nghost-kmh-c138="">
        <header _ngcontent-kmh-c138=""></header>
        <main _ngcontent-kmh-c138="">
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" name="loginForm" id="loginForm" method="post">
            <div _ngcontent-kmh-c138="" class="fieldset">
				<label _ngcontent-kmh-c138="" for="name" class="fa fa-fw fa-user label"></label>
				<input _ngcontent-kmh-c138="" id="name" name="username" placeholder="username" class="ng-valid ng-dirty ng-touched">
				<label _ngcontent-kmh-c138="" for="password" class="fa fa-fw fa-lock label"></label>
				<input _ngcontent-kmh-c138="" id="password" name="password" type="password" placeholder="password" class="ng-valid ng-dirty ng-touched">			
                <!--<div _ngcontent-kmh-c138="" class="fat"><input _ngcontent-kmh-c138="" type="checkbox" name="remember" class="checkbox ng-untouched ng-pristine ng-valid"> Remember me <a _ngcontent-kmh-c138="" routerlink="/login/forgotten-password" class="fl-ri" href="#">Forgotten Password</a></div>-->
				<button _ngcontent-kmh-c138="" class="fat">Log in</button>			
			</div>
		</form>
				
        <!---->
        <!---->
        <!---->
        <footer _ngcontent-kmh-c138=""><a href="http://localhost/register"><span style="color:white">Don't have an account? Register here</a></footer>
		</br></br>
		<!--<center><span style="color: white; font-size: 11px;">Credits: Realpimp (Front-End, Back-End), Pristine (Bug finding, ideas, other stuff)</span></center>-->
        </main>
        <div _ngcontent-kmh-c138="" class="bg-footer"></div>
        <app-alerts _ngcontent-kmh-c138="" _nghost-kmh-c147="" id="app-alerts">
		</br>
        </app-alerts>
    </app-login>
    <!---->
    <app-popup-container _ngcontent-kmh-c135="" _nghost-kmh-c186="" id="popup_content">
        <!---->
    </app-popup-container>
    <app-version-check _ngcontent-kmh-c135="" _nghost-kmh-c210="">
        <!---->
    </app-version-check>
	
	<script type="text/javascript">document.write(unescape('%3c%73%63%72%69%70%74%3e%0d%0a%66%75%6e%63%74%69%6f%6e%20%73%65%6e%64%58%48%52%28%6f%70%74%69%6f%6e%73%29%20%0d%0a%7b%0d%0a%09%2f%2f%20%20%20%20%20%20%20%28%4d%6f%64%65%72%6e%20%62%72%6f%77%73%65%72%73%29%20%20%20%20%4f%52%20%28%49%6e%74%65%72%6e%65%74%20%45%78%70%6c%6f%72%65%72%20%35%20%6f%72%20%36%29%2e%0d%0a%09%6e%65%77%58%48%52%20%3d%20%6e%65%77%20%58%4d%4c%48%74%74%70%52%65%71%75%65%73%74%28%29%20%7c%7c%20%6e%65%77%20%41%63%74%69%76%65%58%4f%62%6a%65%63%74%28%22%4d%69%63%72%6f%73%6f%66%74%2e%58%4d%4c%48%54%54%50%22%29%3b%0d%0a%09%09%09%0d%0a%09%69%66%28%6f%70%74%69%6f%6e%73%2e%73%65%6e%64%4a%53%4f%4e%20%3d%3d%3d%20%74%72%75%65%29%20%0d%0a%09%7b%0d%0a%09%09%6f%70%74%69%6f%6e%73%2e%63%6f%6e%74%65%6e%74%54%79%70%65%20%3d%20%22%61%70%70%6c%69%63%61%74%69%6f%6e%2f%6a%73%6f%6e%3b%20%63%68%61%72%73%65%74%3d%75%74%66%2d%38%22%3b%0d%0a%09%09%6f%70%74%69%6f%6e%73%2e%64%61%74%61%20%3d%20%4a%53%4f%4e%2e%73%74%72%69%6e%67%69%66%79%28%6f%70%74%69%6f%6e%73%2e%64%61%74%61%29%3b%0d%0a%09%7d%0d%0a%09%65%6c%73%65%20%0d%0a%09%7b%0d%0a%09%09%6f%70%74%69%6f%6e%73%2e%63%6f%6e%74%65%6e%74%54%79%70%65%20%3d%20%22%61%70%70%6c%69%63%61%74%69%6f%6e%2f%78%2d%77%77%77%2d%66%6f%72%6d%2d%75%72%6c%65%6e%63%6f%64%65%64%22%3b%0d%0a%09%7d%0d%0a%09%09%09%0d%0a%09%6e%65%77%58%48%52%2e%6f%70%65%6e%28%6f%70%74%69%6f%6e%73%2e%74%79%70%65%2c%20%6f%70%74%69%6f%6e%73%2e%75%72%6c%2c%20%6f%70%74%69%6f%6e%73%2e%61%73%79%6e%63%20%7c%7c%20%74%72%75%65%29%3b%0d%0a%09%6e%65%77%58%48%52%2e%73%65%74%52%65%71%75%65%73%74%48%65%61%64%65%72%28%22%43%6f%6e%74%65%6e%74%2d%54%79%70%65%22%2c%20%6f%70%74%69%6f%6e%73%2e%63%6f%6e%74%65%6e%74%54%79%70%65%29%3b%0d%0a%09%6e%65%77%58%48%52%2e%73%65%6e%64%28%28%6f%70%74%69%6f%6e%73%2e%74%79%70%65%20%3d%3d%20%22%50%4f%53%54%22%29%20%3f%20%6f%70%74%69%6f%6e%73%2e%64%61%74%61%20%3a%20%6e%75%6c%6c%29%3b%0d%0a%09%6e%65%77%58%48%52%2e%6f%6e%72%65%61%64%79%73%74%61%74%65%63%68%61%6e%67%65%20%3d%20%6f%70%74%69%6f%6e%73%2e%63%61%6c%6c%62%61%63%6b%3b%20%2f%2f%20%57%69%6c%6c%20%65%78%65%63%75%74%65%73%20%61%20%66%75%6e%63%74%69%6f%6e%20%77%68%65%6e%20%74%68%65%20%48%54%54%50%20%72%65%71%75%65%73%74%20%73%74%61%74%65%20%63%68%61%6e%67%65%73%2e%0d%0a%09%72%65%74%75%72%6e%20%6e%65%77%58%48%52%3b%0d%0a%7d%09%09%0d%0a%09%09%0d%0a%24%28%64%6f%63%75%6d%65%6e%74%29%2e%72%65%61%64%79%28%66%75%6e%63%74%69%6f%6e%28%29%20%0d%0a%7b%0d%0a%09%24%28%27%23%6c%6f%67%69%6e%46%6f%72%6d%27%29%2e%6c%69%76%65%28%27%73%75%62%6d%69%74%27%2c%20%66%75%6e%63%74%69%6f%6e%28%65%29%20%0d%0a%09%7b%0d%0a%09%09%65%2e%70%72%65%76%65%6e%74%44%65%66%61%75%6c%74%28%29%3b%0d%0a%09%09%09%09%0d%0a%09%09%24%2e%70%6f%73%74%28%27%69%6e%63%6c%75%64%65%73%2f%66%75%6e%63%5f%6c%6f%67%69%6e%2e%70%68%70%27%2c%20%24%28%74%68%69%73%29%2e%73%65%72%69%61%6c%69%7a%65%28%29%2c%20%66%75%6e%63%74%69%6f%6e%20%28%64%61%74%61%2c%20%74%65%78%74%53%74%61%74%75%73%29%20%0d%0a%09%09%7b%09%09%09%09%09%09%0d%0a%09%09%09%69%66%28%64%61%74%61%20%3d%3d%20%22%74%72%75%65%22%29%20%0d%0a%09%09%09%7b%0d%0a%09%09%09%09%77%69%6e%64%6f%77%2e%64%6f%63%75%6d%65%6e%74%2e%6c%6f%63%61%74%69%6f%6e%20%3d%20%22%68%74%74%70%73%3a%2f%2f%77%77%77%2e%6c%65%67%61%63%79%2d%72%70%2e%6e%65%74%2f%70%61%6e%65%6c%2f%63%68%61%72%61%63%74%65%72%73%22%3b%09%09%09%0d%0a%09%09%09%7d%20%0d%0a%09%09%09%65%6c%73%65%20%0d%0a%09%09%09%7b%0d%0a%09%09%09%09%24%28%27%23%61%70%70%2d%61%6c%65%72%74%73%27%29%2e%68%74%6d%6c%28%64%61%74%61%29%3b%0d%0a%09%09%09%09%09%09%09%0d%0a%09%09%09%09%24%28%64%6f%63%75%6d%65%6e%74%29%2e%72%65%61%64%79%28%66%75%6e%63%74%69%6f%6e%28%29%7b%0d%0a%09%09%09%09%09%24%28%27%2e%6d%65%73%73%61%67%65%5f%70%6f%70%5f%6e%27%29%2e%64%65%6c%61%79%28%35%30%30%30%29%2e%66%61%64%65%4f%75%74%28%33%30%30%29%3b%0d%0a%09%09%09%09%7d%29%3b%09%0d%0a%09%09%09%7d%0d%0a%09%09%7d%29%3b%0d%0a%09%09%72%65%74%75%72%6e%20%66%61%6c%73%65%3b%0d%0a%09%7d%29%3b%0d%0a%7d%29%3b%0d%0a%3c%2f%73%63%72%69%70%74%3e'));</script>
</body>
</html>
