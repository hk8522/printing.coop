<div class="account-section universal-spacing universal-bg-white">
    <div class="container">
        <div class="account-section-inner">
            <?php $this->load->view('elements/my-account-menu') ?>
            <div class="account-area">
                <div class="universal-dark-title">
                    <span>
                    <?php 
	                if($language_name=='French'){ ?>
	                  Vos entrées d'adresse
	                <?php }else{ ?>
	                  Your Address Entries
	                <?php 
	                }?></span>
                </div>
                <div class="account-address-area">
                     <button class="add-address-field" id="new-address"><i class="las la-plus"></i> 
                     <?php 
	                if($language_name=='French'){ ?>
	                  Ajouter une nouvelle adresse de livraison
	                <?php }else{ ?>
	                  Add a new shipping address
	                <?php 
	                }?></button>											  
				    <form method="post" id="add-new-address">
					<div class="delivery-fileds" id="checkout-new-address" style="display: none;">
						<div class="row">
							<div class="col-md-6">
								<div class="single-review">
									<input type="text" placeholder="First Name*" name="first_name">
								</div>
							</div>
							<div class="col-md-6">
								<div class="single-review">
									<input type="text" placeholder="Last Name*" name="last_name">
								</div>
							</div>
							<div class="col-md-6">
								<div class="single-review">
									<input type="text" placeholder="Phone Number*" name="mobile">
								</div>
							</div>
							<div class="col-md-6">
								<div class="single-review">
									<input type="text" placeholder="Company Name" name="company_name">
								</div>
							</div>
							<div class="col-md-12">
								<div class="single-review">
									<textarea style="height:150px;" type="text" placeholder="Address (area &amp; street)*"name="address"></textarea>
								</div>
							</div>
							
							<div class="col-md-6">
								<div class="single-review">
									<select name="country" onchange="getState($(this).val())">
										<?php 
						                if($language_name=='French'){ ?>
						                  <option value="">-- Choisissez le pays --</option>
						                <?php }else{ ?>
						                  <option value="">-- Select Country --</option>
						                <?php 
						                }?>
									  
									  <?php foreach ($countries as $country) {
										  $selected = '';
										  $post_country = isset($postData['country']) ? $postData['country']:'';
										  if ($country['id'] == $post_country){
											  $selected='selected="selected"';
										  }
										  ?>
									  <option value="<?php echo $country['id']?>" <?php echo $selected;?>><?php echo $country['name'];?></option>
									  <?php }?>
									</select>
								</div>
							</div>
							
							<div class="col-md-6">
								<div class="single-review">
									<select name="state" id="stateiD" onchange="getCity($(this).val())">
										<?php 
						                if($language_name=='French'){ ?>
						                  <option value="">-- Sélectionnez l'état --</option>
						                <?php }else{ ?>
						                  <option value="">-- Select State --</option>
						                <?php 
						                }?>
									  
									  <?php foreach ($states as $state) {
										  
										  $selected ='';
										  $post_state = isset($postData['state']) ? $postData['state']:'';
										  if ($state['id'] == $post_state){
											  $selected='selected="selected"';
										  }
										  ?>
									  <option value="<?php echo $state['id']?>" <?php echo $selected;?>><?php echo $state['name'];?></option>
									  <?php }?>
									</select>
								</div>
							</div>
							
							<div class="col-md-6">
								<div class="single-review">
								   <select name="city" id="cityId">
								   	<?php 
						                if($language_name=='French'){ ?>
						                  <option value="">-- Sélectionnez une ville --</option>
						                <?php }else{ ?>
						                  <option value="">-- Select City --</option>
						                <?php 
						                }?>
									  
									  <?php foreach ($citys as $city) {
										  
										  $selected ='';
										  $post_city = isset($postData['city']) ?     $postData['state']:'';
										  
										    if ($city['id'] == $post_city){
											  
											  $selected='selected="selected"';
										    }
										  ?>
									  <option value="<?php echo $city['id']?>" <?php echo $selected;?>><?php echo $city['name'];?></option>
									  <?php }?>
									</select>
									<!--<input type="text" placeholder="City*" name="city">-->
									
								</div>
							</div>
							<div class="col-md-6">
								<div class="single-review">
									<input type="text" placeholder="Zip/Postal Code*" name="pin_code">
								</div>
							</div>
							<div class="col-md-12">
							  <div class="address-type">
								  <div class="single-review">
									  <label>
									  <?php 
						                if($language_name=='French'){ ?>
						                  Type d'adresse
						                <?php }else{ ?>
						                  Address Type
						                <?php 
						                }?></label>
								  </div>
								  <div class="row">
									  <div class="col-md-6">
										  <label id="home"><input name="address_type" value="home" for="home" type="radio" checked=""> 
										  <?php 
						                if($language_name=='French'){ ?>
						                  Accueil (livraison toute la journée)
						                <?php }else{ ?>
						                  Home (All day delivery)
						                <?php 
						                }?></label>
									  </div>
									  <div class="col-md-6">
										  <label id="work"><input name="address_type" value="work" for="work" type="radio"> 
										  <?php 
						                if($language_name=='French'){ ?>
						                  Travail (livraison entre 10h et 17h)
						                <?php }else{ ?>
						                  Work (Delivery between 10AM - 5PM)
						                <?php 
						                }?></label>
									  </div>
									  <div class="col-md-6">
									
									<label id="default_delivery_address">
									<input name="default_delivery_address" value="1" for="default_delivery_address" type="checkbox"  
									 style="width: auto;height: 0px;">
									 <?php 
						                if($language_name=='French'){ ?>
						                  Créer une adresse de livraison par défaut
						                <?php }else{ ?>
						                  Make a Default Delivery Address
						                <?php 
						                }?>
									</label>
								    </div>
								  </div>
							  </div>
							</div>
							<div class="col-md-12">
							  <div class="save-btn login-btn">
								  <button class="save" type="submit" id="save-address">
								  <?php 
						                if($language_name=='French'){ ?>
						                  sauver
						                <?php }else{ ?>
						                  Save
						                <?php 
						                }?></button>
								  <a id="cancel-address" href="javascript:void(0)">
								  <?php 
						                if($language_name=='French'){ ?>
						                  Annuler
						                <?php }else{ ?>
						                  Cancel
						                <?php 
						                }?></a>
							  </div>
							</div>
						</div>
					</div>
				</form>
				 <div id="address-list"> 
			   <?php 
				foreach($address as $list){    
				?>
				<div class="saved-address-box">
					<div class="adrs-section">
						<div class="email-field-t">
							<div class="email-text-t">
								<span class="address-type-name <?php echo $list['address_type'];?>"><?php echo ucfirst($list['address_type']);?>
								<?php if($list['default_delivery_address']==1){
								   echo ' (Default Delivery Address)';
								}
								?>
								</span>
								<br>
								<span><?php echo ucfirst($list['name'])?> <?php echo $list['mobile'];?> <?php echo !empty($list['alternate_phone']) ? ','.$list['alternate_phone']:'';?>
								 <?php echo !empty($list['company_name']) ? '('.$list['company_name'].")":'';?>
								</span>
								
								<br>
								<span class="tt-t"><?php echo $list['address'];?>,
								<?php echo $list['cityName'];?>,<?php echo $list['StateName'];?>,<?php echo $list['CountryName'];?> - <strong><?php echo $list['pin_code'];?></strong></span>
								
							</div>
							<div class="dot-menu">
								<button type="submit"><i class="fas fa-ellipsis-v"></i></button>
								<div class="dot-menu-section">
									<a href="<?php echo $BASE_URL;?>MyAccounts/addEditAddress/<?php echo base64_encode($list['id']);?>">
									<button type="submit">
									<?php 
						                if($language_name=='French'){ ?>
						                  Éditer
						                <?php }else{ ?>
						                  edit
						                <?php 
						                }?></button>
									</a>
									<a href="<?php echo $BASE_URL;?>MyAccounts/deleteAddress/<?php echo base64_encode($list['id']);?>" onclick="return confirm('are you sure you wish to delete this address.');">
									<button type="submit">
									<?php 
						                if($language_name=='French'){ ?>
						                  supprimer
						                <?php }else{ ?>
						                  delete
						                <?php 
						                }?></button>
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php 
				}?>
                </div>
				
                </div>
            </div>
        </div>
    </div>
</div>
