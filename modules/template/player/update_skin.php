<?php

if(!isset($_GET['idx']))
{
	exit;
}	

$idx = $_GET['idx'];

require_once($_SERVER['DOCUMENT_ROOT'] . "/modules/core/config.php");

$count = 0;

for($i = 0; $i < sizeof($skinlist); ++$i)
{	
	if($skinlist[$i][1] == "disabled") continue; 
	
	if($count == $idx) break;
	
	$count++; 
	
	if($skinlist[$i][0] >= 25000)
	{
		?>
		<div _ngcontent-tnh-c163="" class="skin" style="background-image: url(&quot;https://m2.ls-rp.com/skin/<?php echo $skinlist[$i][1]; ?>-240-400.png&quot;);" onclick="selectSkin2(<?php echo $skinlist[$i][0]; ?>, '<?php echo $skinlist[$i][1]; ?>')"></div>
		<?php
	}
	else
	{
		?>
		<div _ngcontent-tnh-c163="" class="skin" style="background-image: url(&quot;http://localhost/skins/<?php echo $skinlist[$i][1]; ?>-240-400.png&quot;);" onclick="selectSkin2(<?php echo $skinlist[$i][0]; ?>, '<?php echo $skinlist[$i][1]; ?>')"></div>
		<?php
	}
}

?>

                                   <?php if($idx < sizeof($skinlist)) { ?><app-button _ngcontent-tnh-c163="" class="cs-1 blue text-center" _nghost-tnh-c216="" onclick="refreshSkins2(50)">
                                        <div _ngcontent-tnh-c216="" class="btn-wrapper">
                                            <div _ngcontent-tnh-c216="" class="button">
                                                <!---->
                                                <div _ngcontent-tnh-c216="" class="caption">Show more skins</div>
                                                <!---->
                                            </div>
                                            <!---->
                                        </div>
                                    </app-button>
								   <?php } ?>