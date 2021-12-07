<?php echo form_open_multipart('',array('class'=>'form-horizontal')); ?>
<?php //pr($PostData);?>
<div class="custom-order-info-section">
		<div class="custom-order-info-title">
			<span>Order Information</span>
		</div>
		<div class="step-fields">
			<div class="row">
				<div class="col-md-4">
					<div class="step-fields-inner universal-bg-white">
						<div class="universal-small-dark-title">
							<span>Customer Information</span>
						</div>
						<div class="quote-bottom-row summary-deatil">
							<div class="summary-deatil-inner control-group">
								<div class="row">
									<div class="col-md-12">
										<div class="table-filter-fields">
											<label>Name</label>
											<div class="controls">
												<input type="text" class="form-control" placeholder="Name" value="<?php echo isset($PostData['name']) ? $PostData['name']:'';?>" name="name">
												<?php echo form_error('name');?>
											</div>
										</div>
									</div>
									<div class="col-md-12">
										<div class="table-filter-fields">
											<label>Mobile</label>
											<div class="controls">
												<input type="text" class="form-control" placeholder="Mobile"  value="<?php echo isset($PostData['mobile']) ? $PostData['mobile']:'';?>" name="mobile">
												<?php echo form_error('mobile');?>
											</div>
										</div>
									</div>
									<div class="col-md-12">
										<div class="table-filter-fields">
											<label>Email</label>
											<div class="controls">
												<input type="email" class="form-control" placeholder="Email" value="<?php echo isset($PostData['email']) ? $PostData['email']:'';?>" name="email" id="email">
												<?php echo form_error('email');?>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-8">            			
					<div class="step-fields-inner universal-bg-white">
						<div class="universal-small-dark-title">
							<span>Shipping/Billing Address</span>
						</div>
						<div class="quote-bottom-row summary-deatil">
							<div class="summary-deatil-inner control-group">
								<div class="row">
									<div class="col-md-4">
										<div class="table-filter-fields">
											<label>Name</label>
											<div class="controls">
												<input class="form-control" type="text" placeholder="Name*" value="<?php echo isset($PostData['billing_name']) ? $PostData['billing_name']:'';?>" name="billing_name">
												 <?php echo form_error('billing_name');?>
											</div>
										</div>
									</div>
									<div class="col-md-4">
										<div class="table-filter-fields">
											<label>Phone Number</label>
											<div class="controls">
												<input class="form-control" type="text" placeholder="Phone Number*" value="<?php echo isset($PostData['billing_mobile']) ? $PostData['billing_mobile']:'';?>" name="billing_mobile">
												 <?php echo form_error('billing_mobile');?>
											</div>
										</div>
									</div>
									<div class="col-md-4">
										<div class="table-filter-fields">
											<label>Company</label>
											<div class="controls">
												<input class="form-control" type="text" placeholder="Company" value="<?php echo isset($PostData['billing_company']) ? $PostData['billing_company']:'';?>" name="billing_company">
												 <?php echo form_error('billing_company');?>
											</div>
										</div>
									</div>
									<div class="col-md-12">
										<div class="table-filter-fields">
											<label>Address</label>
											<div class="controls">
												<textarea class="form-control" style="height: 60px !important;" type="text" placeholder="Address (area &amp; street)*" name="billing_address"><?php echo isset($PostData['billing_address']) ? $PostData['billing_address']:'';?></textarea>
												 <?php 
												 echo form_error('billing_address');
												 ?>
											</div>
										</div>
									</div>
									<div class="col-md-3">
										<div class="table-filter-fields">
											<label>Country</label>
											<div class="controls">
												 <select name="billing_country" onchange="getState($(this).val())" class="form-control">
												  <option value="">Select Country</option>
												  
												  <?php foreach ($countries as $country) {
													  $selected = '';
													  $post_country = isset($PostData['billing_country']) ? $PostData['billing_country']:'';
													  
													  if ($country['id'] == $post_country){
														  $selected='selected="selected"';
													  }
													  ?>
												  <option value="<?php echo $country['id']?>" <?php echo $selected;?>><?php echo $country['name'];?></option>
												  <?php }?>
												</select>
												 <?php 
												 echo form_error('billing_country');
												 ?>
											</div>
										</div>
									</div>
									<div class="col-md-3">
										<div class="table-filter-fields">
											<label>State</label>
											<div class="controls">
												
												<select name="billing_state" id="stateiD" class="form-control" onchange="getCity($(this).val())">
												  <option value="">-- Select State --</option>
												  <?php foreach ($states as $state) {
													  
													  $selected ='';
													  $post_state = isset($PostData['billing_state']) ? $PostData['billing_state']:'';
													  if ($state['id'] == $post_state){
														  
														  $selected='selected="selected"';
													  }
													  ?>
												  <option value="<?php echo $state['id']?>" <?php echo $selected;?>><?php echo $state['name'];?></option>
												  <?php }?>
												</select>
												<?php 
												 echo form_error('billing_state');
												 ?>
											</div>
										</div>
									</div>
									
									<div class="col-md-3">
										<div class="table-filter-fields">
											<label>City</label>
											<div class="controls">
											 <select name="billing_city" id="cityId" class="form-control">
											  <option value="">-- Select City --</option>
											  <?php foreach ($citys as $city) {
												  
												  $selected ='';
		                                          $post_city = isset($PostData['billing_city']) ? $PostData['billing_city']:'';
												  
													if ($city['id'] == $post_city){
													  
													   $selected='selected="selected"';
														
													}
												  ?>
											  <option value="<?php echo $city['id']?>" <?php echo $selected;?>><?php echo $city['name'];?></option>
											  <?php }?>
											   </select>
												
												<?php 
												 echo form_error('billing_city');
												 ?>
											</div>
										</div>
									</div>
									<div class="col-md-3">
										<div class="table-filter-fields">
											<label>Zip/Postal Code</label>
											<div class="controls">
												<input class="form-control" type="text" placeholder="Zip/Postal Code*" name="billing_pin_code" value="<?php echo isset($PostData['billing_pin_code']) ? $PostData['billing_pin_code']:'';?>" >
												<?php 
												 echo form_error('billing_pin_code');
												 ?>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php 
				    
				?>
				<div class="col-md-6">  
                    <?php 
					    include('shipping_method.php'); 
					?>				
				</div>
				
				<div class="col-md-6">
					<div class="step-fields-inner universal-bg-white">
						<div class="universal-small-dark-title">
							<span>Payment Information</span>
						</div>
						<div class="quote-bottom-row summary-deatil">
							<div class="summary-deatil-inner control-group">
								<div class="row">
									<div class="col-md-12">
										<div class="table-filter-fields">
											<label>Payment Type</label>
											<div class="controls">
												<select class="form-control" name="payment_type">
													<option value="">Select Type</option>
													<option value="paypal">Paypal</option>
													<!--<?php 
													    foreach ($PaymentMethod as $key=>$val) {
														  $selected = '';
														  $payment_type = isset($PostData['payment_type']) ? $PostData['payment_type']:'';
														  
														  if ($val == $payment_type){
															  
															  $selected='selected="selected"';
														  }
														  ?>
														 <option value="<?php echo $val?>" <?php echo $selected;?>><?php echo $val;?></option>
												  <?php
												  }?>-->
												</select>
												<?php 
												  echo form_error('payment_status');
												 ?>
											</div>
										</div>
									</div>
									<div class="col-md-12">
										<div class="table-filter-fields">
											<label>Payment Status</label>
											<div class="controls">
												<select class="form-control" name="payment_status">
												
													<option value="">Select Status</option>
														<?php foreach ($PaymentStatus as $key=>$val) {
														  $selected = '';
														  $payment_status = isset($PostData['payment_status']) ? $PostData['payment_status']:'';
														  
														  if ($key == $payment_status){
															  
															  $selected='selected="selected"';
														  }
														  ?>
														 <option value="<?php echo $key?>" <?php echo $selected;?>><?php echo $val;?></option>
												  <?php
												  }?>
													
												</select>
												<?php 
												  echo form_error('payment_status');
												 ?>
											</div>
										</div>
									</div>
									<div class="col-md-12">
										<div class="table-filter-fields">
											<label>Payment Transaction ID</label>
											<div class="controls">
												<input type="text" class="form-control" placeholder="Transaction ID" name="transition_id" value="<?php echo isset($PostData['transition_id']) ? $PostData['transition_id']:'';?>">
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				
				<div class="col-md-6">
					<div class="step-fields-inner universal-bg-white">
						<div class="universal-small-dark-title">
							<span>Discount</span>
						</div>
						<div class="quote-bottom-row summary-deatil">
							<div class="summary-deatil-inner control-group">
								<div class="row">
									<div class="col-md-12">
										<div class="table-filter-fields">
											<label></label>
											<div class="controls">
												<input type="text" class="form-control" placeholder="Entr Coupon code" name="coupon_code" id="coupon_code">
												<label id="coupon_code_error" class="product_error"></label>
											</div>
										</div>
									</div>
									
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="step-fields-inner universal-bg-white">
						<div class="universal-small-dark-title">
							<span>Order Information </span>
						</div>
						<div class="quote-bottom-row summary-deatil">
							<div class="summary-deatil-inner control-group">
								<div class="row" id="Order-Information">
									<?php include('order-information.php');?>
								</div>
								
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="next-step-btn" id="confirmbtn">
			   <?php 
			      include('confirm_btn.php');
			   ?>
			</div>
		</div>
	</div>
	</form>
	
	<script>
	
	function getState(country_id){
		
		$("#stateiD").val('');
		$("#stateiD").html('<option value="">Loding..</option>');
		if(country_id !=''){
			
			var url ='<?php echo $BASE_URL ?>MyAccounts/getStateDropDownListByAjax/'+country_id;
			$.ajax({
				   type: "GET",
				   url: url,
				   contentType:"html",
				   //data:{'country_id':country_id}, // serializes the form's elements.
				   success: function(data)
				   {
					   
					   $("#stateiD").html(data);	
				   }
			});
	    }
		
	}
	
	function getCity(state_id){
		
		$("#cityId").val('');
		$("#cityId").html('<option value="">Loding..</option>');
		if(state_id !=''){
			
			var url ='<?php echo $BASE_URL ?>/admin/Orders/getCityDropDownListByAjax/'+state_id;
			$.ajax({
				   type: "GET",
				   url: url,
				   contentType:"html",
				   //data:{'country_id':country_id}, // serializes the form's elements.
				   success: function(data)
				   {
					   
				    var json=JSON.parse(data);
					var orderinformation = json.orderinformation;
					var confirmbtn=json.confirmbtn;
					$("#Order-Information").html(orderinformation);
					$("#confirmbtn").html(confirmbtn);
					$("#cityId").html(json.options);
					
				   }
			});
	    }
		
	}
	</script>
	
	
	
	
	