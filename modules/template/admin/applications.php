<?php 					

require_once($_SERVER['DOCUMENT_ROOT'] . "/modules/core/header.php"); 
require_once($_SERVER['DOCUMENT_ROOT'] . "/modules/core/staff.php"); 

if(!isset($link))
{
	$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

	if($link === false) 
	{
		die("ERROR: Could not connect. " . mysqli_connect_error());
	}	
}									
								
$user_check_query = "SELECT `id`, `master`, `char_name`, `reviewed_by`, `status`, `ip_address`, `country_name`, `country_code` FROM `application` ORDER BY `id` DESC";
$result = mysqli_query($link, $user_check_query);
								
$rowcount = $result->num_rows;	
					
$active_applications = 0;
$handled_applications = 0;
$unanswered_count = 0;

if($rowcount > 0)
{						
	while($result2 = mysqli_fetch_array($result, MYSQLI_ASSOC))
	{
		if($result2['status'] < 2)
		{
			$ActiveApplication[$active_applications] = $result2;
								
			$active_applications++;
								
			if($result2['reviewed_by'] == -1) $unanswered_count++;
		}
		else
		{
			$HandledApplication[$handled_applications] = $result2;
								
			$handled_applications++;
		}
	}
}

?>
					<router-outlet _ngcontent-tnh-c136="" class="router-outlet"></router-outlet>					
					<app-application-list _nghost-tnh-c142="">

					<div _ngcontent-tnh-c154="" class="content-header">
						<h3>Character Applications</h3>
					</div>
					<?php if(!$active_applications) { ?>
					<div _ngcontent-tnh-c154="" class="content" *ngIf="applications && !applications.length" id="no_active_applications">								
						<app-info-bar _ngcontent-tnh-c169="" type="info" class="cs-1" _nghost-tnh-c215="">
							<div _ngcontent-tnh-c215="" class="info infobar">
								<div _ngcontent-tnh-c215="" class="icon"><i _ngcontent-tnh-c215="" class="fa fa-exclamation-triangle fa-fw"></i></div>
								<div _ngcontent-tnh-c215="" class="message">There are no pending applications right now</div>
							</div>
						 </app-info-bar>
					</div>
					<?php } ?>
					<?php if(!$handled_applications) { ?>
					<div _ngcontent-tnh-c154="" class="content" *ngIf="applications && !applications.length" id="no_active_history" hidden>								
						<app-info-bar _ngcontent-tnh-c169="" type="info" class="cs-1" _nghost-tnh-c215="">
							<div _ngcontent-tnh-c215="" class="info infobar">
								<div _ngcontent-tnh-c215="" class="icon"><i _ngcontent-tnh-c215="" class="fa fa-exclamation-triangle fa-fw"></i></div>
								<div _ngcontent-tnh-c215="" class="message">There's no application history available</div>
							</div>
						 </app-info-bar>
					</div>
					<?php } ?>					
					<div _ngcontent-tnh-c154="" class="content" *ngIf="applications && applications.length">
						<section _ngcontent-tnh-c154="" class="cstwothirds transparent nopadding">
						<div id="active_applications">
						<?php
						
						if($active_applications > 0)
						{
							for($i = 0; $i < $active_applications; ++$i)
							{
							
							?>
							<div _ngcontent-tnh-c154="" class="application" style="background-image: url(&quot;http://localhost/assets/images/flags/<?php echo strtolower($ActiveApplication[$i]["country_code"]); ?>.svg&quot;);" *ngFor="let application of applications" [ngStyle]="application.customStyle" onClick="changeCurrentPage_A('application', '<?php echo $ActiveApplication[$i]['id']; ?>', 1)"> 
								<span class="color-grey">#<?php echo $ActiveApplication[$i]['id']; ?></span> 
								
								<span class="bold">                
								<?php echo $ActiveApplication[$i]['char_name']; ?>                
								<?php if($ActiveApplication[$i]['reviewed_by'] != -1) { ?>
								<span class="fl-ri color-tomato margin-right-10" *ngIf="application.reservation">This application is currently under review by  <?php echo returnMaster($link, $ActiveApplication[$i]["reviewed_by"]); ?></span>
								<?php } ?> 
								</span> 
								
								<span><?php echo $ActiveApplication[$i]['ip_address']; ?></span>
								<div _ngcontent-tnh-c154="" class="flag"> </div> 
							</div> 						
							<?php
							
							}						
						}												
						  
						?>
						</div>
						<div id="application_history" hidden>
						<?php
						
						if($handled_applications > 0)
						{ 
							for($i = 0; $i < $handled_applications; ++$i)
							{				
							
							?>
							<div _ngcontent-tnh-c154="" class="application" style="background-image: url(&quot;http://localhost/assets/images/flags/<?php echo strtolower($HandledApplication[$i]["country_code"]); ?>.svg&quot;);" *ngFor="let application of applications" [ngStyle]="application.customStyle" onClick="changeCurrentPage_A('application', '<?php echo $HandledApplication[$i]['id']; ?>', 1)"> <span class="color-grey">#<?php echo $HandledApplication[$i]['id']; ?></span> <span class="bold">                <?php echo $HandledApplication[$i]['char_name']; ?>                <?php if($HandledApplication[$i]['reviewed_by'] != -1) { ?><span class="fl-ri color-tomato margin-right-10" *ngIf="application.reservation">This application was reviewed by <?php echo returnMaster($link, $HandledApplication[$i]['reviewed_by']); ?><!--{{ application.reservation.user.username }} until {{ application.reservation.expires | date: \'HH:mm\'}}--></span><?php } ?> </span> <span><?php echo $HandledApplication[$i]['ip_address']; ?></span>

							</div>				
							<?php
							
							}						
						}												
						  
						?>							
						</div>
						</section>
						<section _ngcontent-tnh-c154="" class="csthird nopadding transparent">
							<?php if($unanswered_count > 0) { ?>
							<section _ngcontent-tnh-c154="" class="state" [ngClass]="priorities[priority].class"> <!--<span class="main">{{ priorities[priority].caption }} priority</span>--> <span class="description"><?php echo $active_applications; ?> unanswered application(s)</span> </section>
							<?php } ?>
							<section _ngcontent-tnh-c154="" class="card">
								<ul class="options">
									<li onclick="changeMenu()"><i class="fa fa-fw fa-file-contract icon"></i> <a href="javascript:void(0);">Application history</a></li>
									<li><i class="fa fa-fw fa-list-ul icon"></i> Quiz configuration</li> 
								</ul> 
							</section> 
						</section>
					</div>
					</app-application-list>
					
					<script>
					var application_menu = 0;
					
					if($('#no_active_history').length > 0) 
					{
						$("#no_active_history").hide();
					}	
					
					function changeMenu()
					{
						if(!application_menu)
						{
							application_menu = 1;
							
							$("#application_history").show();
							$("#active_applications").hide();
							
							if($('#no_active_applications').length > 0) 
							{
								$("#no_active_applications").hide();
							}

							if($('#no_active_history').length > 0) 
							{
								$("#no_active_history").show();
							}										
						}
						else
						{
							application_menu = 0;
							
							$("#active_applications").show();
							$("#application_history").hide();		

							if($('#no_active_history').length > 0) 
							{
								$("#no_active_history").hide();
							}								
							
							if($('#no_active_applications').length > 0) 
							{
								$("#no_active_applications").show();
							}							
						}
					}
					</script>