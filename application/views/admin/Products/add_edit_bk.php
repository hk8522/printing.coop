<style type="text/css">
	.controls.small-control {
    position: relative;
}
</style>
<div class="content-wrapper" style="min-height: 687px;">
		<section class="content">
		<div class="row" style="display: flex;justify-content: center;align-items: center;">
			<div class="col-md-12 col-xs-12">
				<div class="box box-success box-solid">
					<div class="box-body">
						<div class="inner-head-section">
                            <div class="inner-title">
                                <span><?php echo $page_title?></span>
                            </div>
                        </div>
                        <div class="inner-content-area">
                            <div class="row justify-content-center">
                                <div class="col-md-12">
					    			<div class="text-center" style="color:red">
										<?php echo $this->session->flashdata('message_error');?>
									</div>
				        			<?php echo form_open_multipart('',array('class'=>'form-horizontal'));?>
						     		<input class="form-control" name="id" type="hidden"  value="<?php echo isset($postData['id']) ? $postData['id']:'';?>" id="product_id">
					     			<div class="form-role-area">
										<div class="control-group info">
											<div class="row">
                                                <div class="col-md-4">
													<label class="span2 " for="inputMame">Select Fields</label>
												</div>
												<div class="col-md-8">
                                                    <div class="controls">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <select class="form-control" name="menu_id" id="menu_id">
																	<option value="">Select Menu</option>
																	<?php
																	$menu_id=isset($postData['menu_id']) ? $postData['menu_id']:'';										
																	foreach($menuList as $key=>$val){
																		$selected='';
																		
																		if($key==$menu_id){
																			$selected='selected="selected"';
																		}
																	?>
																	<option value="<?php echo $key?>" <?php echo $selected ?>><?php echo $val;?></option>
																	<?php    
																	}
																	?>
																</select>																	
                                                                <label class="form-inner-label">Menu </label>
                                                                <?php echo form_error('menu_id');?>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <select class="form-control" name="category_id" id="category_id">
																	<option value="">Select Category</option>
																	<?php
																	$category_id=isset($postData['category_id']) ? $postData['category_id']:'';										
																	foreach($categoryList as $key=>$val){
																		
																		$selected='';
																		if($key==$category_id){	
																			$selected='selected="selected"';
																		}
																	?>
																	 <option value="<?php echo $key?>" <?php echo $selected ?>><?php echo $val;?></option>
																	<?php    
																	}
																	?>
																</select>
                                                                <label class="form-inner-label">Category</label>
                                                                <?php echo form_error('category_id');?>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <select class="form-control" name="sub_category_id" id="sub_category_id">
																	<option value="">Select Sub Category</option>
																	<?php
																	$sub_category_id=isset($postData['sub_category_id']) ? $postData['sub_category_id']:'';
																	
																	foreach($subCategoryList as $key=>$val){
																		
																		$selected='';
																		if($key==$sub_category_id){
																			
																			$selected='selected="selected"';
																		}
																	?>
																	 
																	   <option value="<?php echo $key?>" <?php echo $selected ?>><?php echo $val;?></option>
																	<?php    
																	}
																	?>
																</select>
                                                                <label class="form-inner-label">Sub Category</label>
                                                                <?php echo form_error('sub_category_id');?>
                                                            </div>
															<div class="col-md-6">
                                                                <select class="form-control" name="brand" id="brand">
																	<option value="">Select Product Brand</option>
																	<?php
																	$brand=isset($postData['brand']) ? $postData['brand']:'';
																	
																	foreach($brandList as $key=>$val){
																		
																		$selected='';
																		if($key==$brand){
																			
																			$selected='selected="selected"';
																		}
																	?>
																	<option value="<?php echo $key?>" <?php echo $selected ?>><?php echo $val;?></option>
																	<?php    
																	}
																	?>
																</select>
                                                                <label class="form-inner-label">Brand</label>
                                                                <?php echo form_error('brand');?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
											</div>
										</div>				
										<div class="control-group info">
											<div class="row align-items-center">
                                                <div class="col-md-4">	
													<label class="span2 " for="inputMame"> Product Name</label>
												</div>
                                                <div class="col-md-8">	
													<div class="controls">
														<input class="form-control" name="name" id="name" type="text" placeholder="Product Name" value="<?php echo isset($postData['name']) ? $postData['name']:'';?>" maxlength="50">
														<?php echo form_error('name');?>
													</div>
												</div>
											</div>
										</div>	
										<div class="control-group info">
											<div class="row align-items-center">
												<div class="col-md-4">
											 		<label class="span2" for="inputMame">Product Short Description</label>
											 	</div>
											 	<div class="col-md-8">
													<div class="controls">
														<input class="form-control" name="short_description" id="short_description" type="text" placeholder="short description" value="<?php echo isset($postData['short_description']) ? $postData['short_description']:'';?>" maxlength="100">
														<?php echo form_error('short_description');?>
													</div>
												</div>
											</div>
										</div>
										<div class="control-group info">
											<div class="row">
												<div class="col-md-4">
											 		<label class="span2 " for="inputMame">Product Full Description</label>
												</div>
												<div class="col-md-8">
													<div class="controls">
													    <textarea class="form-control" name="full_description"><?php echo isset($postData['full_description'])? $postData['full_description']:'';?></textarea>
							                             <?php echo form_error('full_description');?>
													</div>
												</div>
											</div>
										</div>							
										<div class="control-group info">
											<div class="row">
                                                <div class="col-md-4">	
													<label class="span2 " for="inputMame">Product Price</label>
												</div>
												<div class="col-md-8">
                                                    <div class="controls">
                                                        <div class="row align-items-center">
                                                            <div class="col-md-6">
                                                                <input class="form-control" name="price" id="price" type="text" placeholder="Product Price" value="<?php echo isset($postData['price']) ? $postData['price']:'';?>">
                                                                <label class="form-inner-label">List Price</label>
                                                                <?php echo form_error('price');?>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <input class="form-control" type="number" name="your_price" value="<?php echo isset($postData['your_price']) ? $postData['your_price']:'';?>">
                                                                <label class="form-inner-label">Your Price</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
											</div>
										</div>
										<div class="control-group info">
											<div class="row">
                                                <div class="col-md-4">	
													<label class="span2 " for="inputMame">Product Attributes</label>
												</div>
												<div class="col-md-8">
                                                    <div class="controls">
                                                        <div class="row">
                                                        	<div class="col-md-4">
                                                                <input class="form-control" name="total_stock" id="total_stock " type="text" placeholder="Product Stock" value="<?php echo isset($postData['total_stock']) ? $postData['total_stock']:'';?>">
                                                                <label class="form-inner-label">Stock</label>
                                                                <?php echo form_error('total_stock');?>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <input class="form-control" type="number" name="min_order_quantity" value="<?php echo isset($postData['min_order_quantity']) ? $postData['min_order_quantity']:1;?>" >
                                                                <label class="form-inner-label">Min. Order Quantity</label>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <input class="form-control" name="code" id="code" type="text" placeholder="Product Code" value="<?php echo isset($postData['code']) ? $postData['code']:'';?>">
                                                                <label class="form-inner-label">Code</label>
                                                                <?php echo form_error('code');?>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <input class="form-control" name=" discount" id="discount" type="text" placeholder="Product Discount" value="<?php echo isset($postData['discount']) ? $postData['discount']:'';?>">
                                                                <label class="form-inner-label">Discount in %</label>
                                                                <?php echo form_error('discount');?>
                                                            </div>
                                                            
                                                            <div class="col-md-4">
                                                                <select class="form-control" name="size">
                                                                	<option selected="">Select Size</option>
                                                                	<option value="Small" <?php if(isset($postData['size']) && $postData['size']=='Small'){ echo 'selected' ;}?>>Small</option>
                                                                	<option value="Medium" <?php if(isset($postData['size']) && $postData['size']=='Medium'){ echo 'selected' ;}?>>Medium</option>
                                                                	<option value="Large" <?php if(isset($postData['size']) && $postData['size']=='Large'){ echo 'selected' ;}?>>Large</option>
                                                                </select>
                                                                <label class="form-inner-label">Size</label>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <input class="form-control" type="text" name="color" value="<?php echo isset($postData['color']) ? $postData['color']:'';?>">
                                                                <label class="form-inner-label">Color</label>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <input class="form-control" type="text" name="weight" value="<?php echo isset($postData['weight']) ? $postData['weight']:'';?>">
                                                                <label class="form-inner-label">Weight</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
											</div>
										</div>		
										<div class="control-group info">
											<div class="row">
                                                <div class="col-md-4">	
													<label class="span2 " for="inputMame">Product Tags</label>
												</div>
												<div class="col-md-8">
                                                    <div class="controls small-controls">
                                                        <div class="row">
                                                        	<div class="col-md-6">
                                                        		<?php 
																$is_featured=isset($postData['is_featured']) ? $postData['is_featured']:'';
																$cehecked='';
																if($is_featured==1){
																	$cehecked='checked';
																}
																?>
																<label class="span2"><input name="is_featured" id="is_featured" type="checkbox" value="1" <?php echo $cehecked;?>> Featured Product</label>
															    <?php echo form_error('is_featured');?>
                                                            </div>
                                                            <div class="col-md-6">
                                                        		<?php 
																$is_special=isset($postData['is_special']) ? $postData['is_special']:'';
																$cehecked='';
																if($is_special==1){
																	
																	$cehecked='checked';
																}
																?>
																<label class="span2"><input name="is_special" id="is_special" type="checkbox" value="1" <?php echo $cehecked;?>> Special</label>
															    <?php echo form_error('is_special');?>
                                                            </div>
                                                            <div class="col-md-6">
                                                        		<?php 
																$is_bestseller=isset($postData['is_bestseller']) ? $postData['is_bestseller']:'';
																$cehecked='';
																if($is_bestseller==1){
																	
																	$cehecked='checked';
																}
																?>
																<label class="span2"><input name="is_bestseller" id="is_bestseller" type="checkbox" value="1" <?php echo $cehecked;?>> Bestseller</label>
															    <?php echo form_error('is_bestseller');?>
                                                            </div>
                                                            <div class="col-md-6">
                                                        		<?php 
																$is_bestdeal=isset($postData['is_bestdeal']) ? $postData['is_bestdeal']:'';
																$cehecked='';
																if($is_bestdeal==1){
																	
																	$cehecked='checked';
																}
																?>
																<label class="span2"><input name="is_bestdeal" id="is_bestdeal" type="checkbox" value="1" <?php echo $cehecked;?>> Best Deals</label>
															    <?php echo form_error('is_bestdeal ');?>
                                                            </div>
                                                            <div class="col-md-6">
                                                        		<?php 
																$is_stock=isset($postData['is_stock']) ? $postData['is_stock']:'';
																$cehecked='';
																if($is_stock==1){
																	
																	$cehecked='checked';
																}
																?>
																<label class="span2"><input name="is_stock" id="is_stock" type="checkbox" value="1" <?php echo $cehecked;?>> Out of Stock</label>
															    <?php echo form_error('is_stock ');?>
                                                            </div>
                                                            <div class="col-md-6">
                                                        		<?php 
																$is_today_deal=isset($postData['is_today_deal']) ? $postData['is_today_deal']:'';
																$cehecked='';
																if($is_today_deal==1){
																	
																	$cehecked='checked';
																}
																?>
																<label class="span2"><input name="is_today_deal" id="is_today_deal" type="checkbox" value="1" <?php echo $cehecked;?>> Featured Deal</label>
															    <?php echo form_error('is_today_deal');?>
                                                            </div>
                                                            <div class="col-md-12">
																<label class="span2"><input type="checkbox"<?php echo $cehecked;?>> Reviews Allowed</label>
                                                            </div>
                                                            <div class="col-md-12">
                                                        		<input class="form-control" name="is_today_deal_date" id="is_today_deal_date " type="date" value="<?php echo isset($postData['is_today_deal_date']) ? $postData['is_today_deal_date']:'';?>">
                                                                <label class="form-inner-label">Featured Deal Date</label>
                                                                <?php echo form_error('is_today_deal_date');?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
											</div>
										</div>			
										<div class="control-group info">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label class="span2">Free Shipping<font color="red">*</font></label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="controls">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label class="span2" id="hide-shipping-amount">
										<input type="radio" name="free_shipping" value="1"
										
										<?php echo isset($postData['free_shipping']) && $postData['free_shipping'] ==1 ? 'checked':'';?>> Yes
										</label>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="span2" id="show-shipping-amount">
			<input type="radio" name="free_shipping" value="2" <?php echo isset($postData['free_shipping']) && $postData['free_shipping']==2 ? 'checked':'';?>> No</label>
                                                            </div>
                                                  <div class="shipping-amount-area" style="display: <?php echo isset($postData['free_shipping']) && $postData['free_shipping']==2 ? '':'none';?>">
             <input class="form-control" type="number" name="delivery_charge" value="<?php echo isset($postData['delivery_charge']) ? $postData['delivery_charge']:'';?>">
                   <label class="form-inner-label" <?php ?>>Handling Fee</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
										<div class="control-group info">
											<div class="row">
											<div class="col-md-4">
											    <label class="span2 " for="inputMame">Product Type</label>
											</div>
											<div class="col-md-8">
												<div class="controls">
													<select class="form-control" name="product_type" id="product_type">
														<option value="">Select Product Type</option>
														<?php
														$product_type=isset($postData['product_type']) ? $postData['product_type']:'';
														
														 $ptoducttypeList=array(2=>'Personalised',1=>'Non Personalised');
														 
														
														foreach($ptoducttypeList as $key=>$val){
															
															$selected='';
															if($key==$product_type){
																$selected='selected="selected"';
															}
														?>
														 
														   <option value="<?php echo $key?>" <?php echo $selected ?>><?php echo $val;?></option>
														<?php    
														}
														?>
													</select>
													<?php echo form_error('product_type');?>
												</div>
											</div>
											</div>
										</div>	
										<div class="control-group info" style="display:<?php echo $product_type==2 ? '':'none'?>" id="total_upload_image_div">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label class="span2">Add Total Upload Image<font color="red">*</font></label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="controls">
                                                            <div class="single-filed-section">
                                                                <select class="form-control" type="text" name="total_upload_image">
                                                                    <option selected="">--Select--</option>
                                                                    <option value="1" <?php if(isset($personalise['image_upload']) && $personalise['image_upload']==1){ echo 'selected' ;}?>>1</option>
                                                                    <option value="2" <?php if(isset($personalise['image_upload']) && $personalise['image_upload']==2){ echo 'selected' ;}?>>2</option>
                                                                    <option value="3" <?php if(isset($personalise['image_upload']) && $personalise['image_upload']==3){ echo 'selected' ;}?>>3</option>
                                                                    <option value="4" <?php if(isset($personalise['image_upload']) && $personalise['image_upload']==4){ echo 'selected' ;}?>>4</option>
                                                                    <option value="5" <?php if(isset($personalise['image_upload']) && $personalise['image_upload']==5){ echo 'selected' ;}?>>5</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
																
										<div class="row">
										    <div class="control-group info col-sm-12">
											        
													<div class="controls">
													  <?php foreach($ProductImages as $key=>$list){ ?>
													  <div class="col-xs-3" style="margin-bottom:15px;" id="img_<?php echo $list['id']?>">
												      <?php $imageurl=getProductImage($list['image']);?>
														  <img src="<?php echo $imageurl?>" width="100" height="80">
														  <input name="old_image[]" value="<?php echo $list['image'];?>" type="hidden">
														&nbsp;&nbsp;
														<span class="input-group-btn">
														 <button class="btn btn-danger" type="button" title="remove image" onclick="remove_image('<?php echo $list['id']?>','<?php echo $list['image']?>')" id="img_remove_btn">
														<span class="fa fa-minus"></span>
														</button>
														</span>
													  </div>
													  <?php 
													  }?> 
												    </div>
											        <div class="controls file-data">
													    <div class="image-info col-xs-12" style="margin-bottom: 10px;"> 
															<span>
															 Allowed image type  : <b> (jpg, png, gif)</b>
															</span><br>
															<span>
															Allowed image size maximum  : <b> (1Mb)</b>
															</span>
															<br>
															<span>
															  Allowed image in only square : <b> (minimum image dimensions 800pxX800px and maximum mindimensions 1500pxX1500px)</b>
															</span>
														</div>
													  <div class="entry input-group col-xs-12" style="margin-bottom:15px;">
														<input class="btn btn-primary" name="files[]" type="file" accept="image/x-png,image/gif,image/jpeg" id="fileUpload-1" onchange="return Upload('fileUpload-1')"/>
														&nbsp;&nbsp;
														<span class="input-group-btn">
														 <button class="btn btn-success btn-add" type="button">
														<span class="fa fa-plus"></span>
														</button>
														</span>
													  </div>
													  <div style="color:red">
									                  <?php echo $this->session->flashdata('file_message_error');?>
													  </div>
												  </div>
										     </div>
										</div>
										
										<div class="personalised-box" style="display: none;">
										    <div class="control-group info">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label class="span2">Add Color<font color="red">*</font></label>
                                                        <br>
                                                        <div class="add-icon add-color">
                                                             <span class="fa fa-plus "></span> 
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="controls ">
                                                            <div class="row field_wrapper">

                                                            	<?php 
    $color=isset($personalise['color']) && !empty($personalise['color']) ? explode(',',$personalise['color']):array();
																
	if(count($color) > 0){
	    $cnt=1;
	foreach ($color as  $value) {
																		
																	
																	?>
																
	<div class="col-md-4">
		        <div class="single-filed-section">
		                                                                <input class="form-control" type="text" name="personial_color[]" value="<?php echo $value ;?>">
		                                                                <label class="form-inner-label">Color</label>
		                                                                
		                                                            </div>
		                                                             <?php if($cnt>1) {?>
		                                                            <div class="remove-icon remove-color">
				                                                             <span class="fa fa-minus"></span> 
				                                                        </div>
				                                                    <?php }?>
		                                                        </div>
                                                               
                                                               
                                                            <?php $cnt++ ;} 
															}else{?>
                                                                <!-- Start -->
		                                                         <div class="col-md-4">
                                                                    <div class="single-filed-section">
                                                        <input class="form-control" type="text" name="personial_color[]" value="">
                                                                        <label class="form-inner-label">Color</label>
                                                                    </div>
                                                                </div>
                                                            <?php 
															}?>
		                                                        <!-- End -->
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
										    <div class="control-group info">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label class="span2">Add Text Field<font color="red">*</font></label>
                                                        <br>
                                                        <div class="add-icon">
                                                             <span class="fa fa-plus add-text-field"></span> 
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="controls text_field_wrapper">


<?php 
	                                                        		;
																	
																	
	
	$text_field=isset($personalise['text_field']) && !empty($personalise['text_field']) ? json_decode($personalise['text_field']):array();																
if(count($text_field)>0){
	$cnt1=1;
    foreach ($text_field->personial_title as  $value) {
																		//print_r($value);
																	
																	?>
															<div class="single-filed-section">
	                                                            <div class="row">
	                                                                <div class="col-md-12">
	                                                                    <input class="form-control" type="text" name="personial_title[]" value="<?php echo $text_field->personial_title[$cnt1-1];?>">
	                                                                    <label class="form-inner-label">Title</label>
	                                                                </div>
	                                                                <div class="col-md-6">
	                                                                    <input class="form-control" type="text" name="personial_example[]" value="<?php echo $text_field->personial_example[$cnt1-1];?>">
	                                                                    <label class="form-inner-label">Example</label>
	                                                                </div>
	                                                                <div class="col-md-6">
	                                                                    <input class="form-control" type="number" name="personial_character[]" value="<?php echo $text_field->personial_character[$cnt1-1];?>">
	                                                                    <label class="form-inner-label">Character</label>
	                                                                </div>
	                                                            </div>
	                                                           <?php if($cnt1>1) {?>

	                                                            <div class="remove-icon remove-field">
		                                                            <span class="fa fa-minus "></span> 
		                                                        </div>
		                                                        <?php }?>
	                                                        </div>


                                                            <?php $cnt1++ ;} 
															}else{?>
                                                            <!-- Start -->
                                                            
                                                            <div class="single-filed-section">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <input class="form-control" type="text" name="personial_title[]" value="<?php echo isset($postData['personial_title']) ? $postData['personial_title']:'';?>">
                                                                        <label class="form-inner-label">Title</label>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <input class="form-control" type="text" name="personial_example[]" value="<?php echo isset($postData['personial_example']) ? $postData['personial_example']:'';?>">
                                                                        <label class="form-inner-label">Example</label>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <input class="form-control" type="number" name="personial_character[]" value="<?php echo isset($postData['personial_character']) ? $postData['personial_character']:'';?>">
                                                                        <label class="form-inner-label">Character</label>
                                                                    </div>
                                                                </div>
                                                            </div>
	                                                        <?php 
															}?>
                                                            <!-- End -->

                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="control-group info">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label class="span2">Add Paragraph<font color="red">*</font></label>
                                                        <br>
                                                        <div class="add-icon">
                                                             <span class="fa fa-plus add-paragraph"></span> 
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8 wapper3">
                                                       
                                                    	<div class="write-own-area">
                                                                <label class="span2" id="open-write-character">
                        <input class="writeown" name="writeown" value="1" type="checkbox" <?php if(isset($personalise['writeown']) && $personalise['writeown'] ==1){ echo 'checked' ;}?>> Write Your Own
                                                                </label>
                    <div class="write-character" style=" <?php if( isset($personalise['writeown']) && $personalise['writeown']==0 ){ echo 'display: none;' ;}?>">
                   <input class="form-control" type="number" name="paragraph_char" value="<?php echo isset($personalise['writeown_paragraph_char']) ? $personalise['writeown_paragraph_char']:'';?>">
                                                                    <label class="form-inner-label">Character</label>
                                                                </div>
                                                            </div>
                                                        <!-- Start -->
                                                                   <?php 

																	
																															
$paragraph=isset($personalise['paragraph']) && !empty($personalise['paragraph']) ? json_decode($personalise['paragraph']):array();

	if(count($paragraph)>0){
		$cnt2=1;
		foreach ($paragraph->paragraph_description as  $value) {
																		
																	
																	?>
            <div class="controls small-control">
                                                            
                    <div class="single-filed-section">
                        <div class="row">
                                    <div class="col-md-6">
                                                                        <input class="form-control" type="text" name="paragraph_title[]" value="<?php echo $paragraph->paragraph_title[$cnt2-1];?>">
                                                                        <label class="form-inner-label">Title</label>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <input class="form-control" type="number" name="paragraph_character[]" value="<?php echo $paragraph->paragraph_character[$cnt2-1];?>">
                                                                        <label class="form-inner-label">Character</label>
                                                                    </div>
                                                                    <div class="col-md-12">
                                                                        <textarea class="form-control" type="text" name="paragraph_description[]" value=""><?php echo $paragraph->paragraph_description[$cnt2-1];?></textarea>
                                                                        <label class="form-inner-label">Description</label>
                                                                    </div>
                                                                </div>
                                                                
                                                            </div>
                                                             <?php  if($cnt2 >1) {?>
  																	
                                                            <div class="remove-icon remove-paragraph">
		                                                             <span class="fa fa-minus "></span> 
		                                                       </div>
		                                                        <?php }?>
                                                        </div>

                                                        <?php $cnt2++ ;} }else{?>

                                                        <div class="controls small-control">
                                                            
                                                            <div class="single-filed-section">
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <input class="form-control" type="text" name="paragraph_title[]" value="">
                                                                        <label class="form-inner-label">Title</label>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <input class="form-control" type="number" name="paragraph_character[]" value="">
                                                                        <label class="form-inner-label">Character</label>
                                                                    </div>
                                                                    <div class="col-md-12">
                                                                        <textarea class="form-control" type="text" name="paragraph_description[]" value=""></textarea>
                                                                        <label class="form-inner-label">Description</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                       <?php }?>

                                                    </div>
                                                </div>
                                            </div>
                                            
										</div>
										
										<div class="product-actions-btn text-right">
										    <a class="orange-btn" id="open-personalised-box" style="display:<?php echo $product_type==2 ? '':'none'?>">Personalised</a>
											<button type="submit" class="btn btn-success" id="submitBtn">Submit</button>
											<a href="<?php echo $BASE_URL.$class_name.$main_page_url ?>" class="btn btn-success">Back</a>
										</div>
					 					<?php echo form_close();?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div><!-- /.box -->         
			</div><!-- /.col-->
		</div><!-- ./row -->
	</section><!-- /.content -->
 </div>
 <script>
 $(document).ready(function() {
         // on form submit
        $("form").on('submit', function() {

            // to each unchecked checkbox
            $('.writeown:not(:checked)').each(function () {
                //alert("FWEFEwf");
                $(this).attr('checked', true).val(0);
            });
        })
    })
   
    $(document).ready(function(){


    var maxField = 10; //Input fields increment limitation
    //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    

    var wrapper2 = $('.text_field_wrapper');
    var wrapper3 = $('.wapper3');
    var fieldHTML = '<div class="col-md-4"><div class="single-filed-section"><input class="form-control" type="text" name="personial_color[]" value="">'
                                                                        +'<label class="form-inner-label">Color1</label>'
                                                                    +'</div> <div class="remove-icon remove-color"><span class="fa fa-minus"></span></div>';
                                                                
                                                            
                                                            
                                                            
                                                            
     var fieldHTML2 = '<div class="single-filed-section"><div class="row"><div class="col-md-12"> <input class="form-control" type="text" name="personial_title[]" value=""><label class="form-inner-label">Title</label>'
                                                                    +' </div>'
                                                                     +'<div class="col-md-6">'
                                                                        +' <input class="form-control" type="text" name="personial_example[]" value="">'
                                                                        +' <label class="form-inner-label">Example</label>'
                                                                    +' </div>'
                                                                   +'  <div class="col-md-6">'
                                                                         +'<input class="form-control" type="text" name="personial_character[]" value="">'
                                                                        +' <label class="form-inner-label">Character</label>'
                                                                    +' </div>'
                                                                +' </div> <div class="remove-icon remove-field"><span class="fa fa-minus"></span></div>'
                                                             +'</div> '; 
                                                             
                                                             
     var fieldHTML3 ='<div class="controls small-control">'
                                        
                                        +'<div class="single-filed-section">'
                                        +'<div class="row">'
                                        +'<div class="col-md-6">'
                                        +'<input class="form-control" type="text" name="paragraph_title[]" value="">'
                                        +'<label class="form-inner-label">Title</label>'
                                        +'</div>'
                                        +'<div class="col-md-6">'
                                        +'<input class="form-control" type="text" name="paragraph_character[]" value="">'
                                        +'<label class="form-inner-label">Character</label>'
                                        +'</div>'
                                        +'<div class="col-md-12">'
                                        +'<textarea class="form-control" type="text" name="paragraph_description[]" value=""></textarea>'
                                        +'<label class="form-inner-label">Description</label>'
                                        +'</div>'
                                        +'</div>'
                                        +'</div><div class="remove-icon remove-paragraph"><span class="fa fa-minus"></span></div>'
                                        +'</div>';                                                        
    var x = 1; //Initial field counter is 1
    
    $('body').on('click', '.add-paragraph', function() {
        //Check maximum number of input fields
        if(x < maxField){ 
            x++; //Increment field counter
            $(wrapper3).append(fieldHTML3); //Add field html
        }
    });
    
    //Once remove button is clicked
    $(wrapper3).on('click', '.remove-paragraph', function(e){
      //  alert('fwfewf');
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });
    
    
    
     $('body').on('click', '.add-text-field', function() {
        //Check maximum number of input fields
        if(x < maxField){ 
            x++; //Increment field counter
            $(wrapper2).append(fieldHTML2); //Add field html
        }
    });
    
    //Once remove button is clicked
    $(wrapper2).on('click', '.remove-field', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });
    
    
    
    //Once add button is clicked
    $('body').on('click', '.add-color', function() {
        //Check maximum number of input fields
        if(x < maxField){ 
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
        }
    });
    
    //Once remove button is clicked
    $(wrapper).on('click', '.remove-color', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });
    
    
    
    
});
    
    

        
  $('body').on('click', '.add-color', function() {
      
    });
    
    $('#menu_id').on('change', function (e) {
		
		var menu_id=$(this).val();
		$("#category_id").html('<option value="">Select Category</option>');
		$("#sub_category_id").html('<option value="">Select Sub Category</option>');
		$.ajax({
				type: 'GET',
				dataType: 'html',
				url: '<?php echo $BASE_URL ?>admin/Ajax/getCategoryDropDownListByAjax/'+menu_id,
				//data:{'menu_id':menu_id},
				cache: false,
				contentType: false,
				processData: false,
				success: function (data) {
					$("#category_id").html(data);
				}	
		});
	});
	
	$('#category_id').on('change', function (e) {
		
		$("#sub_category_id").html('<option value="">Select Sub Category</option>');
		
		var menu_id=$("#menu_id").val();
		var category_id=$(this).val();
		$("#sub_category_id").html('<option value="">Select Sub Category</option>');
		$.ajax({
				type: 'GET',
				dataType: 'html',
				url: '<?php echo $BASE_URL ?>admin/Ajax/getSubCategoryDropDownListByAjax/'+menu_id+'/'+category_id,
				//data:{'menu_id':menu_id},
				cache: false,
				contentType: false,
				processData: false,
				success: function (data) {
					$("#sub_category_id").html(data);
				}	
		});
	});
	
    $(function(){	
        $(document).on('click', '.btn-add', function(e){
			e.preventDefault();
			var controlForm = $('.file-data:first'),
			currentEntry = $(this).parents('.entry:first'),
			newEntry = $(currentEntry.clone()).appendTo(controlForm);
			newEntry.find('input').val('');
			var timestamp = new Date().getUTCMilliseconds();
            newEntry.find('input').attr('id',timestamp);
			var str='return Upload('+timestamp+')';
			newEntry.find('input').attr('onchange',str);
			
			controlForm.find('.entry:not(:last) .btn-add')
				.removeClass('btn-add').addClass('btn-remove')
				.removeClass('btn-success').addClass('btn-danger')
				.html('<span class="fa fa-minus"></span>');
		}).on('click', '.btn-remove', function(e)
		{
		  $(this).parents('.entry:first').remove();
			e.preventDefault();
			return false;
		});
    });
	
	function remove_image(id,image_name){
		
		$("#submitBtn").attr("disabled", true);
		$("#img_remove_btn").attr("disabled",true);
		var product_id=$("#product_id").val();
		$.ajax({
				type: 'GET',
				dataType: 'html',
				url: '<?php echo $BASE_URL ?>admin/Ajax/removeProductImage/'+product_id+'/'+id+'/'+image_name,
				//data:{'menu_id':menu_id},
				cache: false,
				contentType: false,
				processData: false,
				success: function (data) {
					if(data==1){
					    $("#img_"+id).remove();	
					}else{
						$("#img_remove_btn").attr("disabled",false);
					}
					$("#submitBtn").attr("disabled", false);
				},
				error: function (error) {
                  $("img_remove_btn").attr("disabled", false);
				  $("#submitBtn").attr("disabled", false);
				  
				}
		});
		
	}
	
	function bntInActive(id){
		
		$("#"+id).attr("disabled", true);
		
	}
 </script>
 
 
 <script>
 
 function Upload(imageId) {
	 
    var fileUpload = document.getElementById(imageId);
    //Check whether the file is valid Image.
    var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(.jpg|jpge|.png|.gif)$");
    if (regex.test(fileUpload.value.toLowerCase())) {
        if (typeof (fileUpload.files) != "undefined") {
			
            //Initiate the FileReader object.
            var reader = new FileReader();
            //Read the contents of Image File.
            reader.readAsDataURL(fileUpload.files[0]);
            reader.onload = function (e) {
            //Initiate the JavaScript Image object.
            var image = new Image();
			
            //Set the Base64 string return from FileReader as source.
            image.src = e.target.result;  
            //Validate the File Height and Width.
            image.onload = function () {
				
                    var height = this.height;
                    var width = this.width;
					var imagesize=fileUpload.files[0].size;
					var FILE_MAX_SIZE_JS='<?php echo FILE_MAX_SIZE_JS ?>';
					
					//alert(imagesize);
					if(FILE_MAX_SIZE_JS < imagesize){
						
						$("#MsgModal .modal-body").html('<span style="color:red">Allowed image size maximum  :1Mb</b></span>');
					    $("#MsgModal").modal('show');
                        return false;
						
						
					}else if (height != width || height < 800 || width <800  || height > 1500 || width > 1500) {
						
						document.getElementById(imageId).value='';
						$("#MsgModal .modal-body").html('<span style="color:red"> Allowed image in only square :minimum image dimensions 800pxX800px and maximum mindimensions 1500pxX1500px</b></span>');
					    $("#MsgModal").modal('show');
                        return false;
                    }
       
                };
 
            }
        }
    }
}
</script>
 
<script>
$(document).ready(function(){
    $("#show-shipping-amount").click(function(){
        $(".shipping-amount-area").show();
    });
    $("#hide-shipping-amount").click(function(){
        $(".shipping-amount-area").hide();
    });
	
    $("#open-personalised-box").click(function(){
        $(".personalised-box").toggle();
    });
	$("#product_type").change(function(){
		
        var product_type=$(this).val();
		
		if(product_type==2){
			
		   $("#open-personalised-box").show();
		   $(".personalised-box").show();
		   $("#total_upload_image_div").show();
		}else{
			
			$("#open-personalised-box").hide();
		    $(".personalised-box").hide();
			$("#total_upload_image_div").hide();
		}
		
    });
	
    pen-personalised-box
    $('body').on('click', '#open-write-character', function() {
  
        $(".write-character").toggle();
    });
	


});
</script>