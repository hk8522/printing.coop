<?php
  #unset($_SESSION['product_list']);
  #unset($_SESSION['product_id']);
  #pr($_SESSION);
  $sn=1;
 if(isset($_SESSION['product_list'])){
	$product_list=$_SESSION['product_list'];
	$QtyOptions=array();
	foreach($product_list as $product_id_key=>$product_val){
    #pr($product_val);
	$data=explode('-',$product_id_key);
	$product_id=$data[1];
	$Product = $this->Product_Model->getProductDataById($product_id);

	 $ProductAttributes=$this->Product_Model->getProductAttributesByItemIdFrontEnd($product_id);

	 $ProductSizes=$this->Product_Model->ProductSizeListDropDwon($product_id);

	#pr($Product);

?>

		<form method="post" id="cardFrom-<?php echo $product_id_key?>">
			<input type="hidden" id="product_id-<?php echo $product_id_key?>" value="<?php echo $Product['id']?>" name="product_id">
			<input type="hidden" id="product_price<?php echo $product_id_key?>" value="<?php echo $Product['price']?>" name="price">
			<div class="custom-order-section">
				<div class="row">
					<div class="col-md-12">
						<div class="custom-order-card active" id="<?php echo $product_id_key?>">
							<div class="custom-order-header">
								<div class="custom-order-header-inner">
									<span class="product-number"><?php echo $sn;?></span>
									<span><?php echo $Product['name'];?></span>
									<div class="create-tab-action">

										<a onClick="closeCard('<?php echo $product_id_key;?>')" href="javascript:void(0)" id="close-<?php echo $product_id_key;?>" >
										<span class="custom-close"><i class="fas fa-minus"></i>

										</span>

										</a>

										<a onClick="openCard('<?php echo $product_id_key;?>')" href="javascript:void(0)" id="open-<?php echo $product_id_key;?>" style="display:none"><span class="custom-open">
										<i class="fas fa-plus"></i>

										</span>

										</a>

										<a onClick="removeProduct('<?php echo $product_id_key;?>')" href="javascript:void(0)">
									    <span><i class="fas fa-trash"></i></span>
										</a>

									</div>
								</div>
							</div>
							<div class="custom-order-info">
								<div class="product-fields control-group">
									<div class="row">
									     <div class="col-md-12" id="addtocart-message<?php echo $product_id_key;?>">
										  </div>

									<?php

									$i=1;
									if(!empty($ProductSizes)){
										$i=2;

									?>

								<div class="col-md-3">
										   <div class="table-filter-fields">
												<label>Quantity<span class="required">*</span></label>
	<select name="product_quantity_id" required id="product_quantity_id<?php echo $product_id_key?>" onchange="showQuantity('<?php echo $product_id_key?>')" class="form-control">
										        <option value="">Choose an option...</option>

			        <?php

				    foreach($ProductSizes as $key=>$val){
						$qty_name='';
						$qty_extra_price='';
						foreach($val as $qty){
	                         $qty_name=$qty[0]['qty_name'];
							if(!empty($qty[0]['price']) && $qty[0]['price'] !='0.00'){
							    //$qty_extra_price=" (+ ".$product_price_currency_symbol.$qty[0]['price'].")";
							}
		                    break;
	                    }

				    ?>
														      <option value='<?php echo $key;?>'>
	<?php echo $qty_name.$qty_extra_price?>
															  </option>
													    <?php
					}

					?>
												</select>

											</div>
										</div>
										<div id="SiZeOPrions<?php echo $product_id_key?>">
										</div>
		<script>
		getSizeOptions('<?php echo $product_id_key?>','<?php echo $product_id?>','0');
	    </script>
					<?php

                    //$QtyOptions[$product_id_key]=$product_id;
					}?>

<?php
												#pr($Product);
												#pr($ProductAttributes);

												$attribute_ids=isset($product_val['options']['attribute_ids']) ? $product_val['options']['attribute_ids']:array();

												foreach($ProductAttributes as $key=>$val){
												//pr($val);
												?>
													<div class="col-md-3">
														<div class="table-filter-fields">
															<label><?php echo $val['data']['attribute_name']?>
															<span class="required">*</span></label>
															<?php $items=$val['items'];?>
															<?php
															 if(!empty($items)){
															    $select_item_id='';
																$disabled='disabled';
													            if(array_key_exists($key,$attribute_ids)){
														            $select_item_id=$attribute_ids[$key];
																	$disabled='';
													            }

															   ?>
																   <div class="controls">

																		<select name="attribute_id_<?php echo $key;?>" required <?php if($i > 1){ echo $disabled;}?> onchange="showAttribute('<?php echo $i?>_<?php echo $product_id_key?>','<?php echo $i+1;?>_<?php echo $product_id_key?>','<?php echo $product_id_key?>')" id="attribute_id_<?php echo $i;?>_<?php echo $product_id_key?>"  class="form-control">
																			<option value="">Choose an option...</option>
																			<?php foreach($items as $subkey=>$subval){
																			      $selected='';
                   $extra_price='';
             if(!empty($subval['extra_price']) && $subval['extra_price'] !='0.00'){
		      $extra_price=" (+ ".CURREBCY_SYMBOL.$subval['extra_price'].")";
	        }                                                    if($select_item_id==$subval['attribute_item_id']){
																					  $selected='selected="selected"';
																            }
																			?>
																				  <option value="<?php echo $subval['attribute_item_id']?>" <?php echo  $selected;?>>
																				  <?php echo $subval['item_name'].$extra_price;?>
																				  </option>
																			<?php
																			}?>
																		</select>
																		<?php if($key==RECTO_ATTRIBUTE_ID){?>

            <span>Recto/verso will add 35% more to the price</span>

		<?php
		}?>
																	</div>
															<?php
															 $i++;
															}?>
														</div>
													</div>
												 <?php
												 }?>

								    <input type="hidden" name="add_length_width" value="<?php echo $Product['add_length_width'];?>">

									<?php
									$product_width_length=isset($product_val['options']['product_width_length']) ? $product_val['options']['product_width_length']:array();
									?>
									<?php
                                    //pr($Product);
									if($Product['add_length_width']==1){
									?>

						             <div class="col-md-3">
									   <div class="table-filter-fields">
										<label>Length (Inch)  <span class="required">*</span></label>
										<input type="text" name="product_length" id="product_length_<?php echo $product_id_key?>" required value="<?php echo isset($product_width_length['product_length']) ? $product_width_length['product_length']:0?>" onkeypress="javascript:return isNumber(event)"  class="form-control" onchange="getLengthWidthPrice('<?php echo $product_id_key?>')">
										<span style="color:red" id="product_length_error_<?php echo $product_id_key?>"><span>
									</div>
									</div>
									 <div class="col-md-3">
									   <div class="table-filter-fields">
										<label>Width (Inch)  <span class="required">*</span></label>
									    <input type="text" name="product_width" id="product_width_<?php echo $product_id_key?>" required value="<?php echo isset($product_width_length['product_width']) ? $product_width_length['product_width']:0?>" onkeypress="javascript:return isNumber(event)"  class="form-control" onchange="getLengthWidthPrice('<?php echo $product_id_key?>')"><span style="color:red" id="product_width_error_<?php echo $product_id_key?>"><span>
									</div>
									</div>

				                    <label> <?php echo $Product['min_length']?> X <?php echo $Product['min_width']?> Inch Price :<span class="required"><?php echo CURREBCY_SYMBOL.number_format($Product['min_length_min_width_price'],2)?></span>
									</label>
									<?php
									}?>
									</div>
								</div>
								<div class="set-price-area">
									<div class="row align-items-center">
										<div class="col-md-6">
											<div class="shop-product-price">
											    <?php $price=isset($product_val['subtotal']) ? $product_val['subtotal']: $Product['price'];?>
												<span><font class="new-price" ><?php echo CURREBCY_SYMBOL.'<span id="total-price-'.$product_id_key.'">'.number_format($price,2).'</span>'?> </font></span>
											</div>
										</div>
										<div class="col-md-6">
											<div class="quant-cart">
												<label>Sets</label>
												<input type="text" value="<?php echo isset($product_val['qty']) ? $product_val['qty']:1 ?>" id="quantity<?php echo $product_id_key?>" name="quantity"  onkeypress="javascript:return isNumber(event)" onchange="setQuantity('<?php echo $product_id_key?>')">
											</div>
										</div>
									</div>
								</div>
								<div class="file-upload-section">

									<div class="file-upload-area">
										<input type="file" name="file" id="file<?php echo $product_id_key?>" style="display:none">
										 <span class="info-span">Submit and Upload File (Allow size per file: 30 Mb. Allow file type:jpeg,png,jpg)</span>
										 <div class="upload-file upload-area" id="uploadfile<?php echo $product_id_key?>">

											<span class="file-btn" id="file-btn<?php echo $product_id_key?>">Submit Upload</span>

											<span id="file-drop<?php echo $product_id_key?>">Drag & Drop Files</span>
										</div>
									</div>

									<div class="uploaded-file-detail" id="upload-file-data<?php echo $product_id_key?>">
									   <?php

									        $cart_images=isset($product_val['options']['cart_images']) ? $product_val['options']['cart_images']:array();

									   foreach($cart_images as $return_arr){
										     #pr($return_arr);
									   ?>
										   <div class="uploaded-file-single" id="teb-<?php echo $return_arr['skey']?>">
												<div class="uploaded-file-single-inner">
													<div class="uploaded-file-img" style="background-image: url(<?php echo $return_arr['src']?>)">
													</div>
													<div class="uploaded-file-info">
														<div class="row align-items-center">
															<div class="col-md-7">
																<div class="uploaded-file-name"><span><?php echo $return_arr['name']?></span></div>
															</div>
															<div class="col-md-5">
																<div class="upload-action-btn">
																	<button type="button" onclick="update_cumment('<?php echo $return_arr['skey']?>','<?php echo $return_arr['product_id']?>','<?php echo $return_arr['product_id_key']?>')" id="smc-<?php echo $return_arr['skey']?>">Update Note</button>
																	<button type="button" title="Delete" onclick="delete_image('<?php echo $return_arr['skey']?>','<?php echo $return_arr['product_id']?>','<?php echo $return_arr['product_id_key']?>')"  id="smd-<?php echo $return_arr['skey']?>"><i class="fas fa-trash"></i>
																	</button>
																	<input type="hidden" value="<?php echo $return_arr['location'];?>" id="location-<?php echo $return_arr['skey']?>">
																</div>
															</div>
														</div>
														<div class="upload-field">
															<textarea id="cumment-<?php echo $return_arr['skey']?>"><?php echo $return_arr['cumment']?></textarea>
														</div>
													</div>
												</div>
											</div>
										<?php
										}?>
									</div>
								</div>
								<div class="custom-save-btn">
									<button>Save</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<input type="hidden" name="product_id_key" value="<?php echo $product_id_key;?>">
		</form>
		<script>
		$('form#cardFrom-'+'<?php echo $product_id_key;?>').on('submit', function (e) {
		        $("#loder-img").show();
			    $('input[type="submit"]').prop('disabled',true);
	            $('input[type="button"]').prop('disabled',true);
				var formData = new FormData(this);
				e.preventDefault();

				var url ='<?php echo $BASE_URL ?>admin/Orders/addToCard';

				$.ajax({
				  type: "POST",
				  url: url,
				  data: formData,
				  cache: false,
				  contentType: false,
				  processData: false,
				  success: function(data) {
					   $("#loder-img").hide();
					   $('input[type="submit"]').prop('disabled',true);
	                   $('input[type="button"]').prop('disabled',true);
					   var json = JSON.parse(data);
					   var status = json.status;
					   var msg = json.msg;
					   var orderinformation = json.orderinformation;

					   if (status == 1 ) {
							 $('#addtocart-message<?php echo $product_id_key;?>').html('<div class="alert alert-success alert-dismissible fade show" role="alert">'+msg+'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
							 $("#Order-Information").html(orderinformation);
							 $("#confirmbtn").html(json.confirmbtn);
					   } else {
							 $('#addtocart-message<?php echo $product_id_key;?>').html('<div class="alert alert-danger alert-dismissible fade show" role="alert">'+msg+'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
					   }
				  },
				  error: function (error) {
				  }
			 });
  });

  $(function() {
    // preventing page from redirecting
    $("html").on("dragover", function(e) {
        e.preventDefault();
        e.stopPropagation();
        $("#file-drop<?php echo $product_id_key?>").text("Drag here");
    });

    $("html").on("drop", function(e) { e.preventDefault(); e.stopPropagation(); });

    // Drag enter
    $('#uploadfile<?php echo $product_id_key?>').on('dragenter', function (e) {
        e.stopPropagation();
        e.preventDefault();
        $("#file-drop<?php echo $product_id_key?>").text("Drop");
    });

    // Drag over
    $('#uploadfile<?php echo $product_id_key?>').on('dragover', function (e) {
        e.stopPropagation();
        e.preventDefault();
        $("#file-drop<?php echo $product_id_key?>").text("Drop");
    });

    // Drop
    $('#uploadfile<?php echo $product_id_key?>').on('drop', function (e) {
        e.stopPropagation();
        e.preventDefault();
		var product_id=$("#product_id-<?php echo $product_id_key?>").val();
		var product_id_key='<?php echo $product_id_key?>';
		$('#file<?php echo $product_id_key?>').prop('disabled', true);
		$("#file-btn<?php echo $product_id_key?>").hide();
        $("#file-drop<?php echo $product_id_key?>").text("file uploading please wait...");
        var file = e.originalEvent.dataTransfer.files;
        var fd = new FormData();
        fd.append('file', file[0]);
		fd.append('product_id',product_id);
		fd.append('product_id_key',product_id_key);
        uploadData(fd,'<?php echo $product_id_key?>');
    });

    // Open file selector on div click
    $("#uploadfile<?php echo $product_id_key?>").click(function(){
        $("#file<?php echo $product_id_key?>").click();
    });

    // file selected
    $("#file<?php echo $product_id_key?>").change(function(){
		var product_id=$("#product_id-<?php echo $product_id_key?>").val();
		var product_id_key='<?php echo $product_id_key?>';
		$('#file<?php echo $product_id_key?>').prop('disabled', true);
		$("#file-btn<?php echo $product_id_key?>").hide();
        $("#file-drop<?php echo $product_id_key?>").text("file uploading please wait...");
        var fd = new FormData();
        var files = $('#file<?php echo $product_id_key?>')[0].files[0];
        fd.append('file',files);
		fd.append('product_id',product_id);
		fd.append('product_id_key',product_id_key);
        uploadData(fd,'<?php echo $product_id_key?>');
    });
 });
  </script>
<?php
     $sn++;
    }
 }?>