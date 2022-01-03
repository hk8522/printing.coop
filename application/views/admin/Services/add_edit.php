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
                                    <input class="form-control" name="id" type="hidden"  value="<?php echo isset($postData['id']) ? $postData['id']: $old_values['id'] ?? '';?>">
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
                                                    <label class="span2 "for="inputMame">Service Name</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="controls">
                                                        <input class="form-control" name="name" id="name" type="text" placeholder="Name" value="<?php echo isset($postData['name']) ? $postData['name']: $old_values['name'] ?? '';?>" maxlength="50">
                                                        <label class="mt-2 text-danger"><?php echo $errors['name'] ?? '';?></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
										 <div class="control-group info">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label class="span2 "for="inputMame">French Service Name</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="controls">
                                                        <input class="form-control" name="name_french" id="name_french" type="text" placeholder="Name" value="<?php echo isset($postData['name_french']) ? $postData['name_french']: $old_values['name_french'] ?? '';?>" maxlength="50">
                                                        <label class="mt-2 text-danger"><?php echo $errors['name_french'] ?? '';?></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="control-group info">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label class="span2 " for="inputMame">Service Description</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="controls">
                                                        <textarea class="form-control" rows="4" name="description" placeholder="Description"><?php echo isset($postData['description'])? $postData['description']: $old_values['description'] ?? '';?></textarea>
                                                        <label class="mt-2 text-danger"><?php echo $errors['description'] ?? '';?></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
										 <div class="control-group info">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label class="span2 " for="inputMame">French Service Description</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="controls">
                                                        <textarea class="form-control" rows="4" name="description_french" placeholder="Description"><?php echo isset($postData['description_french'])? $postData['description_french']: $old_values['description_french'] ?? '';?></textarea>
                                                        <label class="mt-2 text-danger"><?php echo $errors['description_french'] ?? '';?></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

										<div class="control-group info">

											<div class="row">
												<div class="col-md-4">
														<label class="span2 " for="inputMame">Service Image</label>
												</div>
												<div class="col-md-8">
													<div class="controls">
														<div class="col-xs-3" style="margin-bottom:15px;">
															<?php $old_image =isset($postData['service_image']) ? $postData['service_image']:'';
																?>
															<?php
																if($old_image !=''){
																   $imageurl=getBannerImage($old_image,'large');?>
															<img src="<?php echo $imageurl?>" width="100" height="80">
															<?php
																}
																?>
															<input name="old_image" value="<?php echo $old_image;?>" type="hidden">
														</div>
													</div>
													<div class="controls file-data">
														<div class="image-info col-xs-12" style="margin-bottom: 10px;">
															<span>
															Allowed image type  : <b> (jpg, png, gif)</b>
															</span>


														</div>
														<div class="entry input-group col-xs-3" style="margin-bottom:15px;">
															<input class="btn btn-primary" name="files" type="file" accept="image/x-png,image/gif,image/jpeg" id="upload" onchange="Upload('upload')"/>
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
										<div class="control-group info">

											<div class="row">
												<div class="col-md-4">
														<label class="span2 " for="inputMame">Service Image French</label>
												</div>
												<div class="col-md-8">
													<div class="controls">
														<div class="col-xs-3" style="margin-bottom:15px;">
															<?php $old_image_french =isset($postData['service_image_french']) ? $postData['service_image_french']:'';
																?>
															<?php
																if($old_image_french !=''){
																   $imageurl=getBannerImage($old_image_french,'large');?>
															<img src="<?php echo $imageurl?>" width="100" height="80">
															<?php
																}
																?>
															<input name="old_image_french" value="<?php echo $old_image_french;?>" type="hidden">
														</div>
													</div>
													<div class="controls file-data">
														<div class="image-info col-xs-12" style="margin-bottom: 10px;">
															<span>
															Allowed image type  : <b> (jpg, png, gif)</b>
															</span>


														</div>
														<div class="entry input-group col-xs-3" style="margin-bottom:15px;">
															<input class="btn btn-primary" name="files_french" type="file" accept="image/x-png,image/gif,image/jpeg" id="upload" onchange="Upload('upload')"/>
														</div>
														<div style="color:red">
															<?php echo $this->session->flashdata('file_message_error_french');
																?>
															<?php
																echo form_error('files_french');?>
														</div>
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
                </div>
            </div>
        </div>
    </section>
</div>
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
    			/*if(FILE_MAX_SIZE_JS < imagesize){

    				$("#MsgModal .modal-body").html('<span style="color:red">Allowed image size maximum  :1Mb</b></span>');
    			    $("#MsgModal").modal('show');
                          return false;


    			}
               else if (height != 428 || width !=1920) {

    				document.getElementById(imageId).value='';
    				$("#MsgModal .modal-body").html('<span style="color:red"> Allowed image in only  dimensions(WXH) 1920pxX428px</b></span>');
    			    $("#MsgModal").modal('show');
                          return false;
                }*/

                  }

              }
          }
      }
    }
</script>