						<?php 		

						require_once($_SERVER['DOCUMENT_ROOT'] . "/modules/core/header.php"); 
						
						if(empty($_GET['test'])) die();				
						
						if(!isset($link))
						{
							$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

							if($link === false) 
							{
								die("ERROR: Could not connect.");
							}	
						}	

						$carsqlid = $_GET['test'];
						
						$carsqlid = mysqli_escape_string($link, $carsqlid);
						
						$user_check_query = "SELECT info, posx, posy, info, ownerSQLID, owner, price, cash, levelbuy, scriptid FROM houses WHERE id = '$carsqlid' LIMIT 1";
						$res = mysqli_query($link, $user_check_query);
						
						$rowcount = $res->num_rows;											
						
						if($rowcount < 1)
						{
							mysqli_free_result($res);
							
							//echo '<script>window.location.href = "http://localhost/panel/characters";</script>';
							
							?>
							
                        <router-outlet _ngcontent-tnh-c136="" class="router-outlet"></router-outlet>
                        <app-vehicle _nghost-tnh-c164="">
                            <div _ngcontent-tnh-c169="" class="content">
                                <app-info-bar _ngcontent-tnh-c169="" type="error" class="cs-1" _nghost-tnh-c215="">
                                    <div _ngcontent-tnh-c215="" class="error infobar">
                                        <div _ngcontent-tnh-c215="" class="icon"><i _ngcontent-tnh-c215="" class="fa fa-exclamation-triangle fa-fw"></i></div>
                                        <div _ngcontent-tnh-c215="" class="message">Invalid house ID specified.</div>
                                    </div>
                                </app-info-bar>
                            </div>
                            <!---->
                            <!---->
                            <!---->
                        </app-vehicle>
                        <!---->
						
							<?php
						}
						else
						{
							
						$result2 = mysqli_fetch_array($res, MYSQLI_ASSOC); 	
					
						$house_owner = $result2['owner'];
						$house_ownersql = $result2['ownerSQLID'];
						$scriptid = $result2['scriptid'];
					
						$user_check_query = "SELECT `master` FROM `characters` WHERE `ID` = '$house_ownersql'";
						$res2 = mysqli_query($link, $user_check_query);						

						$result3 = mysqli_fetch_array($res2, MYSQLI_ASSOC); 

						mysqli_free_result($res2);
						
						if($result3['master'] != $playersqlid)
						{
							?>Nice try<?php
						}
						else
						{
							
						if(!empty($_GET['update_skin']))
						{
							if($_GET['update_skin'] == "changespawn")
							{
								$user_check_query = "UPDATE characters SET SpawnPoint = '2', playerHouseKey = '$scriptid' WHERE char_name = '$house_owner'";
								$res2 = mysqli_query($link, $user_check_query);
								
								$gabim = "Spawn changed.";

								mysqli_free_result($res2);								
							}
						}
							?>							
                        <router-outlet _ngcontent-tnh-c136="" class="router-outlet"></router-outlet>
                        <app-character _nghost-tnh-c145="">
                            <!---->							
					<div _ngcontent-tnh-c145="" class="content-header" *ngIf="property">
						<h3><?php echo $carsqlid; ?> <?php echo $result2['info']; ?>, San Andreas</h3>
						
						<!--<app-button _ngcontent-tnh-c145="" caption="Spawn Here" icon="fa fa-ellipsis-h" class="fl-ri margin-left-10" _nghost-tnh-c216="" onClick="">
							<div _ngcontent-tnh-c216="" class="btn-wrapper">
								<div _ngcontent-tnh-c216="" class="button">
									<div _ngcontent-tnh-c216="" class="icon"><i _ngcontent-tnh-c216="" class="fa fa-file-contract"></i></div>
									<div _ngcontent-tnh-c216="" class="caption">Request Interior Change</div>
								</div>
							</div>
						</app-button>-->		
						<app-button _ngcontent-tnh-c145="" caption="Spawn Here" icon="fa-compass" class="fl-ri blue" _nghost-tnh-c216="" onClick="document.location.href='http://localhost/panel/property/<?php echo $carsqlid; ?>/changespawn';">
							<div _ngcontent-tnh-c216="" class="btn-wrapper">
								<div _ngcontent-tnh-c216="" class="button">
									<div _ngcontent-tnh-c216="" class="icon"><i _ngcontent-tnh-c216="" class="fa fa-compass"></i></div>
									<div _ngcontent-tnh-c216="" class="caption">Spawn Here</div>
								</div>
							</div>
						</app-button>
						<!--<app-button _ngcontent-tnh-c145="" caption="Spawn Here" class="fl-ri green margin-right-10" _nghost-tnh-c216="" onClick="">
							<div _ngcontent-tnh-c216="" class="btn-wrapper">
								<div _ngcontent-tnh-c216="" class="button">
									<div _ngcontent-tnh-c216="" class="icon"><i _ngcontent-tnh-c216="" class="fa fa-ellipsis-h"></i></div>
									<div _ngcontent-tnh-c216="" class="caption">Virtual Preview</div>
								</div>
							</div>
						</app-button>-->	
					</div>
				<!--<app-property-interior *ngIf="slug === \'interior\'" [property]="property"></app-property-interior>-->
				<div _ngcontent-tnh-c145="" class="content" *ngIf="property && !slug">
					<!--<app-map-section [center_x]="property.entrance_x" [center_y]="property.entrance_y" width="200"  class="cs-1 map-section">
					<div _ngcontent-tnh-c219="" class="cs-1 map-section" width="200" style="background-image: url(&quot;http://localhost/map/?x=<?php echo $result2['posx']; ?>&y=<?php echo $result2['posy']; ?>&quot;); background-position: calc(-70px) calc(-5px);">
						<div _ngcontent-tnh-c145="" class="marker"> <i class="fa fa-fw fa-home"></i> </div> 
						</br></br></br></br></br></br></br></br></br></br></br></br>
					</div>
					</app-map-section>-->
					<section _ngcontent-tnh-c145="" class="card csthird">
						<div _ngcontent-tnh-c145="" class="card-title"> <i class="fa fa-fw fa-info color-blue"></i> Overview </div>
						<ul _ngcontent-tnh-c145="" class="no-list-style">
							<li> <i class="fa fa-fw fa-id-card color-blue"></i> Property owned by <?php echo $result2['owner']; ?> </li>
							<li> <i class="fa fa-fw fa-chart-bar color-blue"></i> Property level <?php echo $result2['levelbuy']; ?></li>
							<li> <i class="fa fa-fw fa-money-bill color-blue"></i> Property market price <?php echo $result2['price']; ?> </li>
							<li *ngIf="property.apartments.length" translate> <i class="fa fa-fw fa-lamp color-{{ property.allow_apt_furnishing ? \'green\' : \'tomato\' }}"></i> Property furnishing enabled </li>
							<!--<li *ngIf="property.apartments.length" translate> <i class="fa fa-fw fa-money-check-alt color-{{ property.allow_apt_sale ? \'green\' : \'tomato\' }}"></i> {{ property.allow_apt_sale ? \'PROPERTY_APT_SALES_ENABLED\' : \'PROPERTY_APT_SALES_DISABLED\' }} </li>-->
							<li> <i class="fa fa-fw fa-piggy-bank color-green"></i> $<?php echo $result2['cash']; ?> stashed in the cash box </li> </ul> 
					</section>
	
					<section class="csthird" *ngIf="property.apartments.length" style="background-image: url(&quot;http://localhost/map/?x=<?php echo $result2['posx']; ?>&y=<?php echo $result2['posy']; ?>&quot;); background-position: calc(0px) calc(65px);">
						<div _ngcontent-tnh-c145="" class="marker"> <i class="fa fa-fw fa-home color-white"></i> </div> 
						</br></br></br></br></br></br></br></br></br></br></br></br></br></br></br>
					</section>	
		
			<!--<section class="csthird card" *ngIf="property.apartments.length">
				<div class="card-title"> <i class="fa fa-fw fa-door-open color-blue"></i> Apartments <span class="color-grey fl-ri"> {{ property.apartments.length }}</span> 
				</div>
				<ul class="no-list-style">
					<li *ngFor="let apartment of property.apartments"> <span class="apartment-id">{{ apartment.id }}</span> <span *ngIf="apartment.owner">                        <app-activity-indicator class="fl-ri" [activity]="apartment.owner.activity"                                                *ngIf="apartment.owner.activity !== undefined"></app-activity-indicator>                        {{ apartment.owner.username }}                        <span *ngIf="online && online[apartment.owner.id] === 1">                            <i class="fa fa-fw fa-gamepad fa-xs color-green"></i>                        </span> </span> <span class="color-grey" *ngIf="!apartment.owner" translate>                        PROPERTY_APARTMENT_VACANT                    </span> </li> </ul> 
				</section>-->
		
			<section class="csthird card" *ngIf="property.tenants.length">
			<?php
			mysqli_free_result($res);
			
			$user_check_query = "SELECT `char_name`, `Online` FROM characters WHERE `playerHouseKey` = '$scriptid' AND `ID` != '$house_ownersql'";
			$res = mysqli_query($link, $user_check_query);	

			$rowcount = $res->num_rows;	
			?>
				<div class="card-title"> <i class="fa fa-fw fa-users color-blue"></i> Tenants <span class="color-grey fl-ri"> <?php echo $rowcount; ?></span> </div>
				<ul class="no-list-style">
				<?php
				
					while($result2 = mysqli_fetch_array($res, MYSQLI_ASSOC))
					{
						$char_name = $result2['char_name'];	
						$Online = $result2['Online'];	
						
				?>
					<li *ngFor="let tenant of property.tenants"> <a (click)="evictTenant(tenant)"><i class="fal fa-fw fa-user-times color-tomato fl-ri cursor-pointer"></i></a> <?php echo $char_name; ?> <?php if($Online == 1) { ?><span *ngIf="online && online[tenant.id] === 1">                    <i class="fa fa-fw fa-gamepad fa-xs color-green"></i>                </span><?php } ?> </li> 
				<?php
					
					}
					
				?>
								</ul> 
							</section>
						</div>
                        <!---->
                    </app-character>								
                    <!---->		
			<?php
						}
						}
						
						?>