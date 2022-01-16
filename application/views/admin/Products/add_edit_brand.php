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
                                <div class="col-md-7">
								    <div class="text-center" style="color:red">
										<?php echo $this->session->flashdata('message_error');?>
									</div>
				        			<?php echo form_open_multipart('',array('class'=>'form-horizontal'));?>
						     		<input class="form-control" name="id" type="hidden"  value="<?php echo isset($postData['id']) ? $postData['id']:'';?>" id="id">
						     		<div class="form-role-area">
										<div class="control-group info">
											<div class="row align-items-center">
												<div class="col-md-4">
													<label class="span2 " for="inputMame">Brand Name</label>
												</div>
												<div class="col-md-8">
													<div class="controls">
														<input class="form-control" name="name" id="name" type="text" placeholder="Brand Name" value="<?php echo isset($postData['name']) ? $postData['name']:'';?>" maxlength="50">
														<?php echo form_error('name');?>
													</div>
												</div>
											</div>
										</div>
										<div class="control-group info">
											<div class="row align-items-center">
												<div class="col-md-4">
											 		<label class="span2 " for="inputMame">Brand Short Description</label>
												</div>
												<div class="col-md-8">
													<div class="controls">
														<input class="form-control" name="short_description" id="short_description" type="text" placeholder="short description" value="<?php echo isset($postData['short_description']) ? $postData['short_description']:'';?>" maxlength="150">
														<?php echo form_error('short_description');?>
													</div>
												</div>
											</div>
										</div>
										<div class="control-group info">
											<div class="row align-items-center">
												<div class="col-md-4">
											 		<label class="span2 " for="inputMame">Brand Full Description</label>
												</div>
												<div class="col-md-8">
													<div class="controls">
													    <textarea class="form-control" name="full_description"><?php echo isset($postData['full_description']) ? $postData['full_description']:'';?></textarea>
							                            <?php echo form_error('full_description');?>
													</div>
												</div>
											</div>
										</div>
									    <div class="control-group info">
									    	<div class="row">
									    		<div class="col-md-4">
									    			<label class="span2" for="inputMame">Upload Image</label>
									    		</div>
									    		<div class="col-md-8">
													<div class="controls">
													  	<div class="col-xs-3" style="margin-bottom:15px;">
													     	<?php $old_image =isset($postData['brand_image']) ? $postData['brand_image']:'';
														 	?>

														 	<?php
														 	if($old_image !=''){
														 	$imageurl=getBrandImage($old_image,'large');?>
														  	<img src="<?php echo $imageurl?>" width="auto" height="80">
														 	<?php
															   }
														 	?>
														  	<input name="old_image" value="<?php echo $old_image;?>" type="hidden">
													  	</div>
												    </div>
											        <div class="controls file-data">
													  	<div class="entry input-group col-xs-3" style="margin-bottom:15px;">
															<input class="btn btn-primary" name="files" type="file" accept="image/x-png,image/gif,image/jpeg"/>
													  	</div>
													  	<div style="color:red">
									                  		<?php echo $this->session->flashdata('file_message_error');
													  		?>
													   		<?php
													    	echo form_error('files');?>
													  	</div>
												  	</div>
										 	 	</div>
											</div>
								     	</div>
										<div class="text-right">
											<button type="submit" class="btn btn-success" id="submitBtn" >Submit</button>
											<a href="<?php echo $BASE_URL.$class_name.$main_page_url ?>" class="btn btn-success">Back</a>
										</div>
									</div>
						 			<?php echo form_close();?>
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

    //$("#submitBtn").attr("disabled", false);

    $('#menu_id').on('change', function (e) {
		var menu_id=$(this).val();
		$("#category_id").html('<option value="">Select Category</option>');
		$("#sub_category_id").html('<option value="">Select Sub Category</option>');
		$("#product_id").html('<option value="">Select Product Name </option>');

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

		$("#product_id").html('<option value="">Select Product Name </option>');

		var menu_id=$("#menu_id").val();
		var category_id=$(this).val();
		$("#sub_category_id").html('<option value="">Select Sub Category</option>');
		$.ajax({
				type: 'GET',
				dataType: 'html',
				url: '<?php echo $BASE_URL ?>admin/Ajax/getSubCategoryDropDownListByAjax/'+category_id,
				//data:{'menu_id':menu_id},
				cache: false,
				contentType: false,
				processData: false,
				success: function (data) {
					$("#sub_category_id").html(data);
				}
		});
	});

	$('#sub_category_id').on('change', function (e) {
	    $("#product_id").html('<option value="">Select Product Name </option>');

		var menu_id=$("#menu_id").val();
		var category_id=$("#category_id").val();
		var sub_category_id=$(this).val();
		$.ajax({
				type: 'GET',
				dataType: 'html',
				url: '<?php echo $BASE_URL ?>admin/Ajax/getProductDropDownListByAjax/'+menu_id+'/'+category_id+'/'+sub_category_id,
				//data:{'menu_id':menu_id},
				cache: false,
				contentType: false,
				processData: false,
				success: function (data) {
					$("#product_id").html(data);
				}
		});
	});

 </script>
