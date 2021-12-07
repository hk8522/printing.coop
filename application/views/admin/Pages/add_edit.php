 <script src="https://cdn.ckeditor.com/4.6.2/standard-all/ckeditor.js"></script>
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
				        			<?php echo form_open('',array('class'=>'form-horizontal'));?>
					     			<input class="form-control" name="id" type="hidden"  value="<?php echo isset($postData['id']) ? $postData['id']:'';?>">
					     			<div class="form-role-area">
									
									    <div class="control-group info">
											<div class="row">
												<div class="col-md-4">
													<label class="span2 " for="inputMame">WebSite</label>
												</div>
												<div class="col-md-8">
													<div class="controls">
													   <select name="main_store_id" class="form-control">
													   <option value="">Select WebSite</option>
													   <?php foreach($MainStoreList as $key=>$val){
														$selected='';
                                                        if($postData['main_store_id'] == $key){		
														     $selected='selected="selected"';
														}												
														?>
													    <option value="<?php echo $key?>" <?php echo $selected?>><?php echo $val;?></option>
													   <?php 
													   }?>
													   </select>
													   <?php echo form_error('main_store_id');?>
													</div>
												</div>
											</div>
										</div>
										<div class="control-group info">
											<div class="row">
												<div class="col-md-4">
													<label class="span2 " for="inputMame">Page Name</label>
												</div>
												<div class="col-md-8">
													<div class="controls">
													    <input class="form-control" name="title" id="name" type="text" placeholder="Page Name" value="<?php echo isset($postData['title']) ? $postData['title']:'';?>" maxlength="50">
														<?php echo form_error('title');?>
													</div>
												</div>
											</div>
										</div>
										
										<div class="control-group info">
											<div class="row">
												<div class="col-md-4">
													<label class="span2 " for="inputMame">French Page Name</label>
												</div>
												<div class="col-md-8">
													<div class="controls">
													    <input class="form-control" name="title_france" id="title_france" type="text" placeholder="Page Name" value="<?php echo isset($postData['title_france']) ? $postData['title_france']:'';?>" maxlength="50">
<?php echo form_error('title_france');?>
													</div>
												</div>
											</div>
										</div>

										<div class="control-group info">
											<div class="row">
												<div class="col-md-4">
													<label class="span2 " for="inputMame">Page Order</label>
												</div>
												<div class="col-md-8">
													<div class="controls">
													    <input class="form-control" name="shortOrder" id="shortOrder" type="number" placeholder="Page Order" value="<?php echo isset($postData['shortOrder']) ? $postData['shortOrder']:'';?>" maxlength="50">
														<?php echo form_error('shortOrder');?>
													</div>
												</div>
											</div>
										</div>

                    <div class="control-group info">
											<div class="row">
												<div class="col-md-4">
													<label class="span2 " for="inputMame">Show On Menu</label>
												</div>
                        <div class="col-md-6">
                            
							<?php
                                $display_on_top_menu = isset($postData['display_on_top_menu']) ? $postData['display_on_top_menu']:'';
                                $cehecked='';
                                if ($display_on_top_menu == 1) {
                                    $cehecked='checked';
                                }
                                ?>
                            <label class="span2"><input name="display_on_top_menu" id="display_on_top_menu" type="checkbox" value="1" <?php echo $cehecked;?>>Top Main Menu</label>
                            <?php echo form_error('display_on_top_menu');?>
							
							<?php
                                $displayOnFooter = isset($postData['display_on_footer']) ? $postData['display_on_footer']:'';
                                $cehecked='';
                                if ($displayOnFooter == 1) {
                                    $cehecked='checked';
                                }
                                ?>
                            <label class="span2"><input name="display_on_footer" id="display_on_footer" type="checkbox" value="1" <?php echo $cehecked;?>>Footer Menu One</label>
                            <?php echo form_error('display_on_footer');?>
							
							<?php
                                $display_on_footer_last_menu = isset($postData['display_on_footer_last_menu']) ? $postData['display_on_footer_last_menu']:'';
                                $cehecked='';
                                if ($display_on_footer_last_menu == 1) {
                                    $cehecked='checked';
                                }
                                ?>
                            <label class="span2"><input name="display_on_footer_last_menu" id="display_on_footer_last_menu" type="checkbox" value="1" <?php echo $cehecked;?>> Footer Menu Two</label>
                            <?php echo form_error('display_on_footer_last_menu');?>
							
                        </div>
											</div>
										</div>
										
						                <div class="control-group info">
											<div class="row">
												<div class="col-md-4">
													<label class="span2 " for="inputMame">Page Title</label>
												</div>
												<div class="col-md-8">
													<div class="controls">
													    <input class="form-control" name="page_title" id="page_title" type="text" placeholder="Page Title" value="<?php echo isset($postData['page_title']) ? $postData['page_title']:'';?>" maxlength="250">
														<?php echo form_error('page_title');?>
													</div>
												</div>
											</div>
										</div>
										
										<div class="control-group info">
											<div class="row">
												<div class="col-md-4">
													<label class="span2 " for="inputMame">French Page Title</label>
												</div>
												<div class="col-md-8">
													<div class="controls">
													    <input class="form-control" name="page_title_france" id="page_title_france" type="text" placeholder="French Page Title" value="<?php echo isset($postData['page_title_france']) ? $postData['page_title_france']:'';?>" maxlength="50">
<?php echo form_error('page_title_france');?>
													</div>
												</div>
											</div>
										</div>
                                        <div class="control-group info">
											<div class="row">
												<div class="col-md-4">
													<label class="span2 " for="inputMame">Page Meta Description Content</label>
												</div>
												<div class="col-md-8">
													<div class="controls">
		<textarea name="meta_description_content" id="meta_description_content" rows="100"><?php echo isset($postData['meta_description_content']) ? $postData['meta_description_content']:'';?></textarea>

														<?php echo form_error('meta_description_content');?>
													</div>
												</div>
											</div>
										</div>
										<div class="control-group info">
											<div class="row">
												<div class="col-md-4">
													<label class="span2 " for="inputMame">France Page Meta Description Content</label>
												</div>
												<div class="col-md-8">
													<div class="controls">
		<textarea name="meta_description_content_france" id="meta_description_content_france" rows="100"><?php echo isset($postData['meta_description_content_france']) ? $postData['meta_description_content_france']:'';?></textarea>

														<?php echo form_error('meta_description_content_france');?>
													</div>
												</div>
											</div>
										</div>
										<div class="control-group info">
											<div class="row">
												<div class="col-md-4">
													<label class="span2 " for="inputMame">Page Meta Keywords Content</label>
												</div>
												<div class="col-md-8">
													<div class="controls">
		<textarea name="meta_keywords_content" id="meta_keywords_content" rows="100"><?php echo isset($postData['meta_keywords_content']) ? $postData['meta_keywords_content']:'';?></textarea>

														<?php echo form_error('meta_keywords_content');?>
													</div>
												</div>
											</div>
										</div>
										<div class="control-group info">
											<div class="row">
												<div class="col-md-4">
													<label class="span2 " for="inputMame">France Page Meta Keywords Content</label>
												</div>
												<div class="col-md-8">
													<div class="controls">
		<textarea name="meta_keywords_content_france" id="meta_keywords_content_france" rows="100"><?php echo isset($postData['meta_keywords_content_france']) ? $postData['meta_keywords_content_france']:'';?></textarea>

														<?php echo form_error('meta_keywords_content_france');?>
													</div>
												</div>
											</div>
										</div>
										<div class="control-group info">
											<div class="row">
												<div class="col-md-12">
													<label class="span2 " for="inputMame">Page Description</label>
												</div>
												<div class="col-md-12">
													<div class="controls">
		<textarea name="description" id="content" rows="100"><?php echo isset($postData['description']) ? $postData['description']:'';?></textarea>

														<?php echo form_error('description');?>
													</div>
												</div>
											</div>
										</div>
										
										
										<div class="control-group info">
											<div class="row">
												<div class="col-md-12">
													<label class="span2 " for="inputMame">French Page Description</label>
												</div>
												<div class="col-md-12">
													<div class="controls">
		<textarea name="description_france" id="content1" rows="100"><?php echo isset($postData['description_france']) ? $postData['description_france']:'';?></textarea>
       <?php echo form_error('description_france');?>
													</div>
												</div>
											</div>
										</div>
										<div class="text-right">
											<button type="submit" class="btn btn-success">Submit</button>
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
 CKEDITOR.replace('content', {
    height: 300,
    filebrowserUploadUrl: "<?php echo $BASE_URL;?>upload.php",
    allowedContent:true,
    extraAllowedContent: 'p(*)[*]{*};div(*)[*]{*};li(*)[*]{*};ul(*)[*]{*}',
 });
 
CKEDITOR.dtd.$removeEmpty.i = 0;
CKEDITOR.replace('content1', {
    height: 300,
    filebrowserUploadUrl: "<?php echo $BASE_URL;?>upload.php",
    allowedContent:true,
    extraAllowedContent: 'p(*)[*]{*};div(*)[*]{*};li(*)[*]{*};ul(*)[*]{*}',
 });
 CKEDITOR.dtd.$removeEmpty.i = 0;
</script>
