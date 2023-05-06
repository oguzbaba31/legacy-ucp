<?php

if(basename($_SERVER['PHP_SELF']) == basename(__FILE__)) // Disable direct access
{
	die();
}

if(!isset($link))
{
	$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

	if($link === false)
	{
		die("ERROR: Could not connect.");
	}
}
														
$user_check_query = "SELECT `ID`, `title`, `time`, `read`, `friend`, `sender` FROM `notifications` WHERE `master` = '$playersqlid' ORDER BY `ID` DESC LIMIT 4";
$result = mysqli_query($link, $user_check_query);

$notif_counti = $result->num_rows;
$seen_count = 0;

if($notif_counti > 0)
{	
	$user_check_query = "SELECT `ID` FROM `notifications` WHERE `master` = '$playersqlid' AND `read` = '0' LIMIT 4";
	$result2 = mysqli_query($link, $user_check_query);
						
	$seen_count = $result2->num_rows;
}

?>
<app-sidepanel _ngcontent-tnh-c136="" _nghost-tnh-c137=""> 					
    <nav _ngcontent-tnh-c137="" id="panel">
        <header _ngcontent-tnh-c137="" routerlink="/panel/characters" style="outline: none; cursor: pointer;" tabindex="0">
            <h1 _ngcontent-tnh-c137="">Header</h1>
        </header>
        <div _ngcontent-tnh-c137="" class="category-wrapper">
            <div _ngcontent-tnh-c137="" class="category">
                <h2 _ngcontent-tnh-c137="" translate=""> Header </h2> 
            </div>
			<?php if($admin_panel == false) { ?>
            <ul _ngcontent-tnh-c137="" class="menu">
                <li _ngcontent-tnh-c137="" tabindex="0" id="characters" <?php if($current_page == "characters") { ?>class="selected"<?php } ?> onclick="changeCurrentPage('characters', '/panel/characters')"><a _ngcontent-tnh-c137="" translate="" href="javascript:void(0);"><i _ngcontent-tnh-c137="" class="fa fa-fw fa-theater-masks"></i><span _ngcontent-tnh-c137="" class="link-label">Characters</span></a></li>
                <li _ngcontent-tnh-c137="" tabindex="0" id="admin-record" <?php if($current_page == "admin-record") { ?>class="selected"<?php } ?> onclick="changeCurrentPage('admin-record', '/panel/admin-record')"><a _ngcontent-tnh-c137="" translate="" href="javascript:void(0);"><i _ngcontent-tnh-c137="" class="fa fa-fw fa-gavel"></i><span _ngcontent-tnh-c137="" class="link-label">Admin Record</span></a></li>
                <li _ngcontent-tnh-c137="" tabindex="0" id="online" <?php if($current_page == "online") { ?>class="selected"<?php } ?> onclick="changeCurrentPage('online', '/panel/online')"><a _ngcontent-tnh-c137="" translate="" href="javascript:void(0);"><i _ngcontent-tnh-c137="" class="fa fa-fw fa-globe"></i><span _ngcontent-tnh-c137="" class="link-label">Players Online</span></a></li>						                             
			</ul>								
			<?php } else { ?>								
            <ul _ngcontent-tnh-c137="" class="menu">
				<li _ngcontent-tnh-c137="" tabindex="0" id="applications" onclick="changeCurrentPage_A('applications', '/admin/applications')" <?php if($current_page == "applications") { ?> class="selected" <?php } ?>><a _ngcontent-tnh-c137="" translate="" href="javascript:void(0);"><i _ngcontent-tnh-c137="" class="fa fa-fw fa-address-card"></i><span _ngcontent-tnh-c137="" class="link-label">Applications</span></a></li> 
            </ul>								
			<?php } ?>								
            <!---->
        </div>
        <!---->
        <div _ngcontent-tnh-c137="" class="category-wrapper">
		<?php 								
		if($admin_panel == false) 
		{ 	
			if($adminlevel == -1 || $adminlevel >= 1)
			{
				?>
				<!--<div _ngcontent-tnh-c137="" class="adminpanel" onclick="document.location.href='http://localhost/admin/applications'">
					<a href="javascript:void(0);"><h2 _ngcontent-tnh-c137="" style="opacity: 0;">Administration</h2></a>
				</div>-->									
				<div _ngcontent-tnh-c137="" class="category">
					<a href="http://localhost/admin/applications"><h2 _ngcontent-tnh-c137="">Administration</h2></a>
				</div>								
				<?php
			}
		}							
		else
		{										
			?>
			<!--<div _ngcontent-tnh-c137="" class="controlpanel" onclick="document.location.href='http://localhost/panel/characters'">
				<a href="javascript:void(0);"><h2 _ngcontent-tnh-c137="" style="opacity: 0;">Control Panel</h2></a>
			</div>-->				
			<div _ngcontent-tnh-c137="" class="category">
				<a href="http://localhost/panel/characters"><h2 _ngcontent-tnh-c137="">Control Panel</h2></a>
			</div>									
			<?php								
		}								
		?>								
            <div _ngcontent-tnh-c137="" class="category">
                <h2 _ngcontent-tnh-c137="">Useful Links</h2>
            </div>
            <ul _ngcontent-tnh-c137="" class="menu">
                <li _ngcontent-tnh-c137=""><a _ngcontent-tnh-c137="" href="https://" target="_blank"><i _ngcontent-tnh-c137="" class="fa fa-fw fa-comments"></i><span _ngcontent-tnh-c137="" class="link-label">Community Forum</span></a></li>
                <!--<li _ngcontent-tnh-c137=""><a _ngcontent-tnh-c137="" href="javascript:void(0);"><i _ngcontent-tnh-c137="" class="fa fa-fw fa-user-headset"></i><span _ngcontent-tnh-c137="" class="link-label">Support</span></a></li>
                <li _ngcontent-tnh-c137=""><a _ngcontent-tnh-c137="" href="javascript:void(0);"><i _ngcontent-tnh-c137="" class="fa fa-fw fa-server"></i><span _ngcontent-tnh-c137="" class="link-label">Status Page</span></a></li>-->
            </ul>
        </div>
    </nav>
</app-sidepanel>
<app-topbar _ngcontent-tnh-c136="" _nghost-tnh-c140="">
    <div _ngcontent-tnh-c140="" id="wrapper">
        <ul _ngcontent-tnh-c140="" class="links"> 
            <li _ngcontent-tnh-c140=""><a _ngcontent-tnh-c140="" href="javascript:void(0);"><i _ngcontent-tnh-c140="" class="fab fa-fw fa-twitter twitter"></i></a></li>
            <li _ngcontent-tnh-c140=""><a _ngcontent-tnh-c140="" href="javascript:void(0);" target="_blank"><i _ngcontent-tnh-c140="" class="fab fa-fw fa-youtube youtube"></i></a></li>
            <li _ngcontent-tnh-c140=""><a _ngcontent-tnh-c140="" href="https://discord.com/invite/WcBmayfXgv" target="_blank"><i _ngcontent-tnh-c140="" class="fab fa-fw fa-discord discord"></i></a></li>
            <li _ngcontent-tnh-c140=""><a _ngcontent-tnh-c140="" href="javascript:void(0);"><i _ngcontent-tnh-c140="" class="fab fa-fw fa-teamspeak teamspeak"></i></a></li>
        </ul>
    <div _ngcontent-tnh-c140="" class="icons">
		<div _ngcontent-tnh-c140="" class="user">
			<div _ngcontent-tnh-c140="" class="name" > <div id="player_name"><?php echo $username; ?></div>
                <div _ngcontent-tnh-c140="" class="rank"> <?php echo playerRank($username, $adminlevel); ?> </div>
            </div>
 								
			<?php if(!strlen($forum_auth)) { ?>
            <!----><i _ngcontent-tnh-c140="" class="fa fa-fw fa-user icon" onclick="toggleMenu()" id="toggleMenuBtn"></i>
            <!----> 
			<?php } else { ?>

			<?php if(isset($_GET['haha'])) { $has_avatar = true; ?>
			<div _ngcontent-tnh-c140="" class="avatar" *ngIf="me.forum_account && me.forum_account.forum_avatar" [ngStyle]="avatarStyle" style="background-image: url('http://forum.localhost/get_avatar.php?username=<?php echo $username; ?>');" onclick="toggleMenu()"> <i _ngcontent-tnh-c140="" class="fa fa-fw fa-caret-down dropdown"></i> 
			</div> 
									
			<?php } else { $has_avatar = false; ?>
            <!----><i _ngcontent-tnh-c140="" class="fa fa-fw fa-user icon" onclick="toggleMenu()" id="toggleMenuBtn"></i>
            <!----> 							
			<?php } }?> 
									
            <app-account-dropdown _ngcontent-tnh-c140="" _nghost-tnh-c207="">
			<div _ngcontent-tnh-c207="" class="container" id="profile_dropdown" style="display: none;"><?php if($has_avatar) { ?><img _ngcontent-tnh-c207="" class="avatar" src="http://forum.localhost/get_avatar.php?username=<?php echo $username; ?>"><?php } ?>
				<!---->
				<div _ngcontent-tnh-c207="" class="userinfo cs-1">
					<div _ngcontent-tnh-c207="" class="strongish"> <?php echo $username; ?>
						<div _ngcontent-tnh-c207="" class="menu"><a _ngcontent-tnh-c207="" routerlink="/panel/friends" href="javascript:void(0);" onClick="changeCurrentPage('friends', '/panel/friends')"><i _ngcontent-tnh-c207="" class="fa fa-fw fa-user-friends menu-icon"></i></a><a _ngcontent-tnh-c207="" href="javascript:void(0);" onclick="changeCurrentPage('settings', '/panel/settings')"><i _ngcontent-tnh-c207="" class="fa fa-fw fa-cogs menu-icon"></i></a><a _ngcontent-tnh-c207="" routerlink="/logout" href="http://localhost/logout"><i _ngcontent-tnh-c207="" class="fa fa-fw fa-power-off menu-icon"></i></a></div>
					</div>
					<span _ngcontent-tnh-c207="" class="color-darkGrey"><?php echo playerRank($username, $adminlevel); ?></span>
				</div>
                <div _ngcontent-tnh-c207="" class="characters">
				<?php
				for($i = 0; $i < 6; ++$i)
				{
					if($charss[$i][1] != -1)
					{												
						$testname = str_replace(" ", "_", $charss[$i][0], $count);	

						for($x = 0; $x < sizeof($serverSkins); ++$x)
						{
							if($serverSkins[$x]["id"] == $charss[$i][2])
							{
								$skinipau = $serverSkins[$x]["name"];
								break;
							}
						}							
														
						?>
						<div _ngcontent-tnh-c207="" class="character" tabindex="0" title="<?php echo $charss[$i][0]; ?>" onClick="changeCurrentPage('characters', '<?php echo $testname; ?>', 1)" style="background-image: url(&quot;http://localhost/assets/skins_small/<?php echo $skinipau; ?>-240-400.png&quot;);"></div>
						<?php

					}
				}
				?>
                <!---->
                </div>												
			</div>
            </app-account-dropdown>
        </div>
		<div _ngcontent-tnh-c140="" class="icon-group" onclick="toggleNotif()" id="toggleNotifBtn"><i _ngcontent-tnh-c140="" class="icon fa fa-fw fa-bell"></i>
            <?php if($seen_count > 0) { ?><div _ngcontent-tnh-c140="" id="notif_number" class="notice"> <?php echo $seen_count; ?> </div><?php } ?>
            <!---->
        </div>
    </div>
    </div>
    <app-loadingbar _ngcontent-tnh-c140="" _nghost-tnh-c159="">
		<div _ngcontent-tnh-c159="" id="loadingbar" class="loadingbar"></div>
    </app-loadingbar>
    <app-notifications _ngcontent-tnh-c140="" _nghost-tnh-c150="">
		<div _ngcontent-tnh-c150="" class="notifications active" id="notif_dropdown" style="display: none;">
			<div id="notif_update">
				<header _ngcontent-tnh-c150="">
				<h2 _ngcontent-tnh-c150="">Notifications</h2><i _ngcontent-tnh-c150="" class="fal fa-fw fa-times fl-ri close cursor-pointer" onclick="toggleNotif()"></i></header>
				<ul _ngcontent-tnh-c150="">
				<?php
				while($result2 = mysqli_fetch_array($result, MYSQLI_ASSOC))
				{
					$notifidd = $result2['ID'];
					$title_nav = $result2['title'];
					$time_nav = $result2['time'];
					$read_nav = $result2['read'];
					$friend_nav = $result2['friend'];
										
					if($friend_nav == 0)
					{
										
					?>
					<li _ngcontent-tnh-c150="" id="notfid_<?php echo $notifidd; ?>" class="<?php if($read_nav == 1) { ?>read<?php } else { ?>cursor-pointer<?php } ?>" onClick="document.location.href='http://localhost/panel/inbox/<?php echo $notifidd; ?>'"><i _ngcontent-tnh-c150="" class="fa fa-fw fa-bell icon"></i><span _ngcontent-tnh-c150="" class="label"> <?php echo $title_nav; ?> <span _ngcontent-tnh-c150="" class="time" title="<?php echo $time_nav; ?>"> <?php echo $time_nav; ?> </span></span>
					</li>
					<?php
										
					}
					else if($friend_nav == -1)
					{									
						$sender_nav = $result2['sender'];	
											
						?>
						<li _ngcontent-tnh-c150="" id="notfid_<?php echo $notifidd; ?>" class="<?php if($read_nav == 1) { ?>read<?php } ?> cursor-pointer"><i _ngcontent-tnh-c150="" class="fa fa-fw fa-user-friends icon"></i><span _ngcontent-tnh-c150="" class="label"> <?php echo $sender_nav; ?> approved your friend request <span _ngcontent-tnh-c150="" class="time" title="<?php echo $time_nav; ?>"> <?php echo $time_nav; ?> </span></span>
						   </li>
						<?php
										
					}									
					else
					{								
						$sender_nav = $result2['sender'];	
											
						?>
						<li _ngcontent-tnh-c150="" id="notfid_<?php echo $notifidd; ?>" class="<?php if($read_nav == 1) { ?>read<?php } ?> cursor-pointer" onclick="function_AcceptFriend(<?php echo $friend_nav; ?>)"><i _ngcontent-tnh-c150="" class="fa fa-fw fa-user-friends icon"></i><span _ngcontent-tnh-c150="" class="label"> <?php echo $sender_nav; ?> sent you a friend request <span _ngcontent-tnh-c150="" class="time" title="<?php echo $time_nav; ?>"> <?php echo $time_nav; ?> </span></span>
						   </li>
						<?php
										
					}
										
					$notif_count++;
				}

				mysqli_free_result($result);
				?>
										 
				<!---->
				</ul>
				<footer _ngcontent-tnh-c150=""><a _ngcontent-tnh-c150="" href="javascript:void(0);" <?php if($notif_count > 0) { ?>onClick="document.location.href='http://localhost/mark_all_read.php?lasturl=http://localhost/panel/inbox<?php } ?>">Mark all read</a> | <a _ngcontent-tnh-c150="" href="javascript:void(0);" onclick="changeCurrentPage('inbox', '/panel/inbox')">Inbox</a> </footer>
			</div>
		</div>
    </app-notifications>
</app-topbar>