<div class="inner-content-area">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="text-center" style="color:red">
				<?php echo $this->session->flashdata('message_error');?>
			</div>
			<div class="text-center" style="color:green">
				<?php
				echo $this->session->flashdata('message_success');
				?>
			</div>
			<?php echo form_open_multipart('',array('class'=>'form-horizontal','id'=>'AddEditProductAttribute'));?>
			<input class="form-control" type="hidden"
			value="<?php echo $product_id?>" id="product_id" name="product_id">
			<input class="form-control" type="hidden"
			value="<?php echo $quantity_id?>" id="quantity_id" name="quantity_id">
			<input class="form-control" type="hidden"
			value="<?php echo $size_id?>" id="size_id" name="size_id">
			<input class="form-control" type="hidden"
			value="<?php echo $attribute_id?>" id="attribute_id" name="attribute_id">
			<input class="form-control" name="id" type="hidden"  value="<?php echo $id?>" id="id">
			<?php
			$MultipleAttribute=$MultipleAttributes[$attribute_id];
			//pr($MultipleAttribute,1);
			?>
			<div class="form-role-area">
				<div class="control-group info">
					<div class="row align-items-center">
						<div class="col-md-4">
							<label class="span2 " for="inputMame"><?php echo$MultipleAttribute['name'];?></label>
						</div>
						<div class="col-md-8">
							<div class="controls">
								<select name="attribute_item_id" class="form-control" required>
								    <option value="">Select <?php echo $MultipleAttribute['name'];?></option>
									<?php
									foreach($MultipleAttribute['items'] as $key=>$val){
									    $selected='';
                                        if($attribute_item_id==$key){
											$selected='selected="selected"';
										}
									?>
									   <option value="<?php echo $key;?>" <?php echo $selected;?>><?php echo $val;?></option>
									<?php
									}?>
								</select>

							</div>
						</div>
					</div>
				</div>
				<div class="control-group info">
					<div class="row align-items-center">
						<div class="col-md-4">
							<label class="span2 " for="inputMame">Extra Price</label>
						</div>
						<div class="col-md-8">
							<div class="controls">
								 <input type="text" value='<?php echo showValue($extra_price);?>' name="extra_price"  onkeypress="javascript:return isNumber(event)" placeholder="Extra Price" class="form-control">
							   <?php echo form_error('extra_price');?>
							</div>
						</div>
					</div>
				</div>
				<div class="text-right">
					<button type="submit" class="btn btn-success" id="submitBtn" >Submit</button>
				</div>
			</div>
			<?php echo form_close();?>
		</div>
	</div>
</div>
<script src="<?php echo $BASE_URL?>/assets/js/validation.js"></script>
<script>
 success='<?php echo $success?>';
$('#AddEditProductAttribute').validate({
	    rules: {
			attribute_item_id: {
			  required: true,
			},
		},
        messages: {
            attribute_item_id: {
              required: 'Please select attribute item',
            },
        },
        submitHandler: function(form) {
			$("#loder-img").show();
			var url  = '<?php echo $BASE_URL ?>admin/Products/AddEditProductAttribute';
			$.ajax({
			  type: "POST",
			  url: url,
			  data: $(form).serialize(), // serializes the form's elements.
			  beforeSend:function() {
				 $('button[type=submit]').attr('disabled', true);
			  },
			  success: function(data) {
				$('button[type=submit]').attr('disabled', false);
				$("#loder-img").hide();
				$("#ItemModal .modal-body").html(data);
				    if(success==1){
					  location.reload();
				    }
			  }
			});
        },
    });
</script>