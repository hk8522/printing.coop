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

										<div class="row">
										    <div class="control-group info col-sm-12">
											        <div class="controls file-data">
													    <div class="image-info col-xs-12" style="margin-bottom: 10px;">
															<span>
															 Allowed image type  : <b> (csv)</b>
															</span><br>
															<span>
															Allowed image size maximum  : <b> (100Mb)</b>
															</span>
															<br>
														</div>
													  <div class="entry input-group col-xs-12" style="margin-bottom:15px;">
														<input class="btn btn-primary" name="csv_file" type="file" accept=".csv" id="fileUpload-1"/>
														&nbsp;&nbsp;
														<!---<span class="input-group-btn">
														 <button class="btn btn-success btn-add" type="button">
														<span class="fa fa-plus"></span>
														</button>
														</span>-->

													  </div>
													  <div style="color:red">
									                  <?php echo $this->session->flashdata('csv_file');?>
													  </div>
												  </div>
										     </div>
										</div>



										<div class="product-actions-btn text-right">

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





