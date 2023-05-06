<?php
header('Content-Type: image/jpeg');

ini_set('memory_limit', '190M');

if(isset($_GET["x"]) && isset($_GET["y"])) 
{
	$x = $_GET["x"];
	$y = $_GET["y"];
	
	//$icox = -($x - 3000) - 5910;
	//$icoy = $y + 3000 - 5950;
	
	$src = imagecreatefromjpeg("map.outer.jpg");
	$dst = imagecreatetruecolor(500, 500);
	imagecopyresampled($dst, $src, 0, 0, 2745 + $x, 2900 - $y, 500, 500, 500, 500);	
	
	imagepng($dst);
	imagedestroy($src);
	imagedestroy($dst);
}
?>