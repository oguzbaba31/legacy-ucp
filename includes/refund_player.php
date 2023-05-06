			<app-popup _nghost-tnh-c158="">
				<div _ngcontent-tnh-c158="" class="popper">
					<div _ngcontent-tnh-c158="" class="popup">
						<header _ngcontent-tnh-c158=""><span _ngcontent-tnh-c158="">Refund Player</span><span _ngcontent-tnh-c158="" class="close" onclick="cancelDialog()"><i _ngcontent-tnh-c158="" class="far fa-fw fa-times"></i></span></header>
                        <div _ngcontent-tnh-c158="" class="popup-content">
                            <!---->
                            <div _ngcontent-tnh-c158=""></div>
                            <!---->
                            <!---->
							<app-popup-admin-record-share _nghost-tnh-c200="">
								<div _ngcontent-tnh-c194="">
									<div _ngcontent-tnh-c200="" class="ng-star-inserted"><span _ngcontent-tnh-c200="" class="strongish">Select a refund type</span>
										<br _ngcontent-tnh-c200="">
										<br _ngcontent-tnh-c200="">
										<select id="menyja" onchange = "menyjaChanged()">  
										<option> -- Refund Type --</option>  
										<option value="1"> Weapon </option>  
										<option value="2"> Drugs </option>  
										<option value="3"> Money </option>  
										<option value="4"> Vehicle Stats </option>  
										</select>  
										<br _ngcontent-tnh-c200="">
										<!--<app-button _ngcontent-tnh-c200="" caption="Grant" class="blue margin-left-10" _nghost-tnh-c216="">
											<div _ngcontent-tnh-c216="" class="btn-wrapper">
												<div _ngcontent-tnh-c216="" class="button">
													<div _ngcontent-tnh-c216="" class="caption ng-star-inserted">Grant</div>
												</div>
											</div>
										</app-button>-->
										<br _ngcontent-tnh-c200="">
									</div>
                                    <div _ngcontent-tnh-c194="" class="buttons">
                                        <app-button _ngcontent-tnh-c194="" caption="Cancel" class="fl-ri tomato margin-left-10" _nghost-tnh-c216="" onclick="cancelDialog()">
                                            <div _ngcontent-tnh-c216="" class="btn-wrapper">
                                                <div _ngcontent-tnh-c216="" class="button">
                                                    <!---->
                                                    <div _ngcontent-tnh-c216="" class="caption">Cancel</div>
                                                    <!---->
                                                </div>
                                                <!---->
                                            </div>
                                        </app-button>									
									
										<app-button _ngcontent-tnh-c194="" caption="Change Name" class="fl-ri blue" _nghost-tnh-c216="" id="ChangeButton" onclick="refundPlayer()">
                                            <div _ngcontent-tnh-c216="" id="submit_lol" class="btn-wrapper disabled">
                                                <div _ngcontent-tnh-c216="" class="button">
                                                    <!---->
                                                    <div _ngcontent-tnh-c216="" class="caption">Refund</div>
                                                    <!---->
                                                </div>
                                                <!---->
                                            </div>
                                        </app-button>
										</br>
                                    </div>
								</div>
							</app-popup-admin-record-share>
						</div>
					</div>
				</div>
			</app-popup>