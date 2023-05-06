						<?php 		

						require_once($_SERVER['DOCUMENT_ROOT'] . "/modules/core/header.php");  										

						$gabim = "";
						$change_pass = false;
						$change_email = false;
						
						$authorizeURL = 'https://discordapp.com/api/oauth2/authorize';
						$tokenURL = 'https://discordapp.com/api/oauth2/token';
						$apiURLBase = 'https://discordapp.com/api/users/@me';
						$revokeURL = 'https://discordapp.com/api/oauth2/token/revoke';						

						define('OAUTH2_CLIENT_ID', '');
						define('OAUTH2_CLIENT_SECRET', '');
						
						if(isset($_GET['forum']) && isset($_GET['user']))
						{					
							if(!isset($link))
							{
								$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

								if($link === false) 
								{
									die("ERROR: Could not connect.");
								}	
							}		
					
							$forum_name = $_GET['forum'];
							$ucp_name = $_GET['user'];
							
							if($username == $ucp_name)
							{																
								$user_check_query = "UPDATE `accounts` SET `Forum` = '$forum_name' WHERE `ID` = '$playersqlid' LIMIT 1";
								$result = mysqli_query($link, $user_check_query);
								
								$_SESSION['forum_auth'] = $forum_name;								
								$forum_auth = $forum_name;

								mysqli_free_result($result);									
							}								
						}
						
						if(isset($_GET['test']))
						{
							if($_GET['test'] == "revoke_discord")
							{
								if(!isset($link))
								{
									$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

									if($link === false) 
									{
										die("ERROR: Could not connect.");
									}	
								}							
								
								apiRequest($revokeURL, array(
									'token' => $discord_auth,
									'client_id' => OAUTH2_CLIENT_ID,
									'client_secret' => OAUTH2_CLIENT_SECRET,
								));
								
								$_SESSION['discord_auth'] = "";
								$discord_auth = "";
								
								$user_check_query = "UPDATE `accounts` SET `Discord` = '' WHERE `ID` = '$playersqlid' LIMIT 1";
								$result = mysqli_query($link, $user_check_query);

								mysqli_free_result($result);	
							}
							
							if($_GET['test'] == "revoke_forum")
							{
								if(!isset($link))
								{
									$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

									if($link === false) 
									{
										die("ERROR: Could not connect.");
									}	
								}							
								
								$_SESSION['forum_auth'] = "";
								$forum_auth = "";
								
								$user_check_query = "UPDATE `accounts` SET `Forum` = '' WHERE `ID` = '$playersqlid' LIMIT 1";
								$result = mysqli_query($link, $user_check_query);

								mysqli_free_result($result);	
							}							
						}

						if(isset($_GET['code']))
						{							
							$code = $_GET['code'];
							
							if(!isset($link))
							{
								$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

								if($link === false) 
								{
									die("ERROR: Could not connect.");
								}	
							}
							
							$token = apiRequest($tokenURL, array(
								"grant_type" => "authorization_code",
								'client_id' => OAUTH2_CLIENT_ID,
								'client_secret' => OAUTH2_CLIENT_SECRET,
								'redirect_uri' => 'http://localhost/panel/settings',
								'code' => $code
							));
							
							$_SESSION['discord_auth'] = $token->access_token;
							$discord_auth = $_SESSION['discord_auth'];
							
							$user_check_query = "UPDATE `accounts` SET `Discord` = '$discord_auth' WHERE `ID` = '$playersqlid' LIMIT 1";
							$result = mysqli_query($link, $user_check_query);

							mysqli_free_result($result);							
						}

						// Processing form data when form is submitted
						if($_SERVER["REQUEST_METHOD"] == "POST")
						{										
							$email = $_POST["email"];
							$password = $_POST['password'];	
							$password_confirm = $_POST['password_confirm'];
							
							if(!isset($link))
							{
								$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

								if($link === false) 
								{
									die("ERROR: Could not connect.");
								}	
							}								
							
							if((!empty($password) && empty($password_confirm)) || (empty($password) && !empty($password_confirm)))
							{
								$gabim = "Re-confirm the password by entering it.";
							}
							else if(!empty($password) && !empty($password_confirm))
							{
								if($password == $password_confirm)
								{
									$password = mysqli_real_escape_string($link, $password); 
									
									$hashed_pas = hash('whirlpool', $password); 
									$hashed_pas = strtoupper($hashed_pas);
									
									$user_check_query = "UPDATE `accounts` SET `Password` = '$hashed_pas' WHERE `ID` = '$playersqlid' LIMIT 1";
									$result = mysqli_query($link, $user_check_query);

									$change_pass = true;
								}
								else $gabim = "Password does not match.";
							}
							
							if(!empty($email) && $playeremail != $email)
							{
								if(valid_email($email) && $email != $playeremail) //if(containsWord($email, '@'))
								{			
									$email = mysqli_real_escape_string($link, $email); 
							
									$user_check_query = "SELECT `Email` FROM `accounts` WHERE `Email` = '$email' LIMIT 1";
									$result = mysqli_query($link, $user_check_query);	

									$rowcount = $result->num_rows;	
									
									if($rowcount == 0)
									{		
										$_SESSION['playeremail'] = $email;
										
										$playeremail = $email;								
								
										$user_check_query = "UPDATE `accounts` SET email = '$email' WHERE `ID` = '$playersqlid' LIMIT 1";
										$result = mysqli_query($link, $user_check_query);	

										$change_email = true;
									}
									else $gabim = "This email is already in use.";
								}
								else $gabim = "Invalid email specified.";
							}
							
							if($change_pass == true && $change_email == true) $gabim = "Password & Email updated.";
							else if($change_pass == true && $change_email == false) $gabim = "Password updated.";
							else if($change_pass == false && $change_email == true) $gabim = "Email updated.";							
						}
						
						if(isset($link)) 
						{ 
							mysqli_close($link); 
						}

						?>
                        <router-outlet _ngcontent-tnh-c136="" class="router-outlet"></router-outlet>
                        <app-settings _nghost-tnh-c144="">
                            <div _ngcontent-tnh-c144="" class="content-header">
                                <h3 _ngcontent-tnh-c144="" style="display: inline;">Settings</h3>
                                <app-panel-tabs _ngcontent-tnh-c144="" _nghost-tnh-c149="">
                                    <ul _ngcontent-tnh-c149="" class="tabs">
                                        <li _ngcontent-tnh-c149="" routerlinkactive="selected" tabindex="0" class="selected">Accounts</li>
                                    </ul>
                                </app-panel-tabs>
                            </div>
                            <div _ngcontent-tnh-c144="" class="content">
                                <section _ngcontent-tnh-c144="" class="transparent grid-newline cs-1 form nopadding">
                                    <router-outlet _ngcontent-tnh-c144=""></router-outlet>
                                    <app-accounts _nghost-tnh-c174="">
                                        <section _ngcontent-tnh-c174="" class="grid grid-gap-20 transparent nopadding">
                                            <app-settings-personal _ngcontent-tnh-c174="" class="cshalf" _nghost-tnh-c189="">
                                                <div _ngcontent-tnh-c189="" class="card">
                                                    <div _ngcontent-tnh-c189="" class="card-title"> Personal Information </div>
													
													<form action="http://localhost/panel/settings" method="post" id="formulari">
                                                    <app-input-text _ngcontent-tnh-c189="" placeholder="E-mail account" _nghost-tnh-c217="">
													
                                                        <div _ngcontent-tnh-c217="" class="wrapper hasValue" id="email">
                                                            <!----><label _ngcontent-tnh-c217="" for="input">E-mail account</label>
															<input _ngcontent-tnh-c217="" value="<?php echo $playeremail; ?>" id="input" name="email" type="text" class="ng-untouched ng-pristine ng-valid" oninput="onValueChange(this, 'email')">
														</div>
                                                    </app-input-text>
                                                    <div _ngcontent-tnh-c189="" class="margin-top-10">
                                                        <app-input-text _ngcontent-tnh-c189="" type="password" placeholder="Password - leave blank to keep unchanged" _nghost-tnh-c217="">
                                                            <div _ngcontent-tnh-c217="" class="wrapper" id="password">
                                                                <!----><label _ngcontent-tnh-c217="" for="input">Password - leave blank to keep unchanged</label>
																<input _ngcontent-tnh-c217="" value="" name="password" id="input" type="password" class="ng-untouched ng-pristine ng-valid" oninput="onValueChange(this, 'password')">
															</div>
                                                        </app-input-text>
                                                    </div>
                                                    <div _ngcontent-tnh-c189="" class="margin-top-10">
                                                        <app-input-text _ngcontent-tnh-c189="" type="password" placeholder="Repeat password" _nghost-tnh-c217="">
                                                            <div _ngcontent-tnh-c217="" class="wrapper" id="repeat-password">
                                                                <!----><label _ngcontent-tnh-c217="" for="input">Repeat password</label>
																<input _ngcontent-tnh-c217="" value="" id="input" name="password_confirm" type="password" class="ng-untouched ng-pristine ng-valid" oninput="onValueChange(this, 'repeat-password')">
															</div>
                                                        </app-input-text>
                                                    </div>
													</form>
                                                    <app-button _ngcontent-tnh-c189="" icon="fa fa-save" caption="Save" class="blue margin-top-20" _nghost-tnh-c216="" onclick="document.getElementById('formulari').submit();">
                                                        <div _ngcontent-tnh-c216="" class="btn-wrapper">
                                                            <div _ngcontent-tnh-c216="" class="button">
                                                                <div _ngcontent-tnh-c216="" class="icon"><i _ngcontent-tnh-c216="" class="fa fa-save"></i></div>
                                                                <!---->
                                                                <div _ngcontent-tnh-c216="" class="caption">Save</div>
                                                                <!---->
                                                            </div>
                                                            <!---->
                                                        </div>
                                                    </app-button>
                                                </div>
                                                <!---->
                                            </app-settings-personal>
                                        </section>
                                        <!---->
                                    </app-accounts>
                                    <!---->
                                </section>
                            </div>
                        </app-settings>
                        <!---->