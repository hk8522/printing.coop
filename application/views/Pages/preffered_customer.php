<div class="contact-section-detail universal-bg-white">
    <div class="container ">
<?php
if($language_name=='French'){

echo $pageData['description_france'];
}else{

echo $pageData['description'];
}
//pr($countries);
?>
        <div class="customer-detail-blog universal-spacing universal-bg-white">
            <div class="universal-dark-title">
                <span>
				<?php
				if($language_name=='French'){ ?>
				    Devenez un membre Privilège:
				<?php }else{ ?>
                    Become a Preferred Customer:
                <?php
				}?>
				</span>
            </div>
			<div class="universal-dark-info" id="signup-msg">
            </div>
            <div class="contact-form">
			   <?php
				if($language_name=='French'){ ?>
                <form action="" method="post" id="Preferred-Customer">
                    <div class="row">
					    <div class="col-md-4">
                            <div class="single-review">
                                <label>Etunimesi*</label>
                                <input type="text" name="fname" required="">
                            </div>
                        </div>
						<div class="col-md-4">
                            <div class="single-review">
                                <label>Votre nom de famille*</label>
                                <input type="text" name="lname" required="">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="single-review">
                                <label>Nom de la compagnie*</label>
                                <input type="text" name="company_name" required="">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="single-review">
                                <label>Email*</label>
                                <input type="email" name="email" required="">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="single-review">
                                <label>Passwards*</label>
                                <input type="password" name="password" required="" id="signup-password">
                            </div>
                        </div>
						 <!--<div class="col-md-4">
                            <div class="single-review">
                                <label>Confirm Password*</label>
                                <input type="password" name="confirm_password" id="confirm-password" required="">
                            </div>
                        </div>-->

                       <div class="col-md-4">
                            <div class="single-review">
                                <label>Nom du responsable*</label>
                                <input type="text" name="responsible_name" required="">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="single-review">
                                <label>Cp*</label>
                                <input type="text" name="cp" required="">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="single-review">
                                <label>Zone active*</label>
                                <input type="text" name="active_area" required="">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="single-review">
                                <label>Adresse*</label>
                                <input type="text" name="address" required="">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="single-review">
                                <label>Numéro de téléphone*</label>
                                <input type="text" name="mobile" required="">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="single-review">
                                <label>Choisissez le pays*</label>
								<select name="country" onchange="getState($(this).val())"  class="crs-country" required="">
									  <option value="">-- Choisissez le pays --</option>
									  <?php foreach ($countries as $country) {
										  $selected = '';
										  $post_country = isset($postData['country']) ? $postData['country']:'';
										  if ($country['id'] == $post_country){

											  $selected='selected="selected"';
										  }
										  ?>
									  <option value="<?php echo $country['id']?>" <?php echo $selected;?>>
									  <?php echo $country['name'];?></option>
									  <?php }?>
									</select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="single-review">
                                <label>Etat*</label>
								<select name="region" id="stateiD" required="">
                                      <option value="">-- Sélectionnez l'état --</option>
                                      <?php foreach($states as $state){

								      $selected='';
									  $post_state= isset($postData['state']) ? $postData['state']:'';

									  if($state['StateID'] == $post_state){

										    $selected='selected="selected"';
									  }
								    ?>
								       <option value="<?php echo $state['StateID']?>" <?php echo $selected;?>><?php echo $state['StateName'];?>
									  </option>
								<?php }?>
								     </select>

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="single-review">
                                <label>Ville*</label>
                                <input type="text" name="city" required="">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="single-review">
                                <label>Code postal*</label>
                                <input type="text" name="zip_code" required="">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="single-review">
                                <label>Demande*</label>
                                <textarea type="text" name="request" required=""></textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="order-btn">
                                <button type="submit">DEVENIR MEMBRE</button>
                            </div>
                        </div>
                    </div>
                </form>
				<?php }else{ ?>
                    <form action="" method="post" id="Preferred-Customer">
                    <div class="row">
					    <div class="col-md-4">
                            <div class="single-review">
                                <label>Your First Name*</label>
                                <input type="text" name="fname" required="">
                            </div>
                        </div>
						<div class="col-md-4">
                            <div class="single-review">
                                <label>Your Last Name*</label>
                                <input type="text" name="lname" required="">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="single-review">
                                <label>Company Name*</label>
                                <input type="text" name="company_name" required="">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="single-review">
                                <label>Email*</label>
                                <input type="email" name="email" required="">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="single-review">
                                <label>Passward*</label>
                                <input type="password" name="password" required="" id="signup-password">
                            </div>
                        </div>
						 <!--<div class="col-md-4">
                            <div class="single-review">
                                <label>Confirm Password*</label>
                                <input type="password" name="confirm_password" id="confirm-password" required="">
                            </div>
                        </div>-->

                       <div class="col-md-4">
                            <div class="single-review">
                                <label>Name of the Responsible*</label>
                                <input type="text" name="responsible_name" required="">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="single-review">
                                <label>Cp*</label>
                                <input type="text" name="cp" required="">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="single-review">
                                <label>Active area *</label>
                                <input type="text" name="active_area" required="">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="single-review">
                                <label>Address*</label>
                                <input type="text" name="address" required="">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="single-review">
                                <label>Phone no*</label>
                                <input type="text" name="mobile" required="">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="single-review">
                                <label>Select country*</label>
								<select name="country" onchange="getState($(this).val())"  class="crs-country" required="">
									  <option value="">-- Select Country --</option>
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
                        <div class="col-md-4">
                            <div class="single-review">
                                <label>State*</label>
								<select name="region" id="stateiD" required="">
                                      <option value="">-- Select State --</option>
                                      <?php foreach($states as $state){

								      $selected='';
									  $post_state= isset($postData['state']) ? $postData['state']:'';

									  if($state['StateID'] == $post_state){

										    $selected='selected="selected"';
									  }
								    ?>
								       <option value="<?php echo $state['StateID']?>" <?php echo $selected;?>><?php echo $state['StateName'];?>
									  </option>
								<?php }?>
								     </select>

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="single-review">
                                <label>City*</label>
                                <input type="text" name="city" required="">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="single-review">
                                <label>Zip code*</label>
                                <input type="text" name="zip_code" required="">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="single-review">
                                <label>Request*</label>
                                <textarea type="text" name="request" required=""></textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="order-btn">
                                <button type="submit">BECOME A MEMBER</button>
                            </div>
                        </div>
                    </div>
                </form>
                <?php
				}?>

            </div>
        </div>
    </div>
</div>
