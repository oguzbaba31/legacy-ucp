<?php

if(!isset($adminlevel))
{
	die("no access");
}

if($adminlevel == 0 || $adminlevel < -1)
{
	die("no access");
}

?>