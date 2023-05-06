<?php
header('Content-Type: image/png');

if(isset($_GET["x"]) && isset($_GET["y"])) 
{
	$x = $_GET["x"];
	$y = $_GET["y"];
	
	$icox = -($x - 3000) - 5910;
	$icoy = $y + 3000 - 5950;
	
	$src = imagecreatefromjpeg("map.outer.jpg");
	$dst = imagecreatetruecolor(6000, 6000);
	imagecopyresampled($dst, $src, 0, 0, 0 + $x, 0 - $y, 6000, 6000, 6000, 6000);	
	
	imagepng($dst);
	imagedestroy($src);
	imagedestroy($dst);
}
?>