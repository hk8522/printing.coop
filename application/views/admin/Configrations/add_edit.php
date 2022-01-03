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
                                    <div class="text-center" style="color:green">
                        						    <?php echo $this->session->flashdata('message_success');?>
                                    </div>
                                    <?php echo form_open_multipart($BASE_URL.$class_name.'saveConfigrations' ,array('class'=>'form-horizontal'));?>
                                    <input class="form-control" name="id" type="hidden"  value="<?php echo isset($configrations['id']) ? $configrations['id']:'';?>">
                                    <div class="form-role-area">
                                        <div class="control-group info">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label class="span2" for="contact-no">Contact No</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="controls">
                                                        <input class="form-control" name="contact_no" id="contact-no" type="text" placeholder="Contact Number" value="<?php echo isset($configrations['contact_no']) ? $configrations['contact_no']:'';?>" maxlength="50">
                                                        <?php echo form_error('contact_no');?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
										<div class="control-group info">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label class="span2" for="contact-no">French Contact No</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="controls">
                                                        <input class="form-control" name="contact_no_french" id="contact_no_french" type="text" placeholder="Contact Number" value="<?php echo isset($configrations['contact_no_french']) ? $configrations['contact_no_french']:'';?>" maxlength="50">
                                                        <?php echo form_error('contact_no_french');?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="control-group info">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label class="span2 " for="office-timing">Office Timing</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="controls">
                                                        <input class="form-control" name="office_timing" id="office-timing" type="text" placeholder="Office Timing" value="<?php echo isset($configrations['office_timing']) ? $configrations['office_timing']:'';?>" maxlength="50">
                                                        <?php echo form_error('office_timing');?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
										<div class="control-group info">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label class="span2 " for="office-timing">French Office Timing</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="controls">
                                                        <input class="form-control" name="office_timing_french" id="office_timing_french" type="text" placeholder="Office Timing" value="<?php echo isset($configrations['office_timing_french']) ? $configrations['office_timing_french']:'';?>" maxlength="50">
                                                        <?php echo form_error('office_timing_french');?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="control-group info">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label class="span2 " for="announcement">Announcement</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="controls">
                                                      <textarea class="form-control" rows="4" name="announcement" placeholder="Announcement"><?php echo isset($configrations['announcement']) ? $configrations['announcement']:'';?></textarea>
                                                      <?php echo form_error('announcement');?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
										<div class="control-group info">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label class="span2 " for="announcement">French Announcement </label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="controls">
                                                      <textarea class="form-control" rows="4" name="announcement_french" placeholder="Announcement"><?php echo isset($configrations['announcement_french']) ? $configrations['announcement_french']:'';?></textarea>
                                                      <?php echo form_error('announcement_french');?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
										<div class="control-group info">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label class="span2 " for="announcement">Copy Right</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="controls">
                                                      <textarea class="form-control" rows="4" name="copy_right" placeholder="Copy Right"><?php echo isset($configrations['copy_right']) ? $configrations['copy_right']:'';?></textarea>
                                                      <?php echo form_error('copy_right');?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
										<div class="control-group info">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label class="span2 " for="announcement">French Copy Right</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="controls">
                                                      <textarea class="form-control" rows="4" name="copy_right_french" placeholder="Copy Right"><?php echo isset($configrations['copy_right_french']) ? $configrations['copy_right_french']:'';?></textarea>
                                                      <?php echo form_error('copy_right_french');?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
										<div class="control-group info">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label class="span2 " for="announcement">Address</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="controls">
                                                      <textarea class="form-control" rows="4" name="address_one" placeholder="address" id="content"><?php echo isset($configrations['address_one']) ? $configrations['address_one']:'';?></textarea>
                                                      <?php echo form_error('address_one');?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
										<div class="control-group info">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label class="span2 " for="announcement">French Address</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="controls">
                                                      <textarea class="form-control" rows="4" name="address_one_french" placeholder="address" id="content1"><?php echo isset($configrations['address_one_french']) ? $configrations['address_one_french']:'';?></textarea>
                                                      <?php echo form_error('address_one_french');?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!--<div class="control-group info">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label class="span2">Languages</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="controls small-controls">
                                                      <div class="row">
                                                          <?php
                                                            $languages = allLanguages();
                                                            $configLanguage = $configrations['languages']  ? explode(',', $configrations['languages']) : [];
                                                            foreach ($languages as $key => $language) {
                                                                  $checked = '';
                                                                  if (in_array($language['name'], $configLanguage)) {
                                                                     $checked = 'checked';
                                                                  }
                                                              ?>
                                                              <div class="col-md-6">
                                                                  <label class="span2">
                                                                    <input name="languages[]"  type="checkbox" value="<?php echo $language['name'];?>" <?php echo $checked;?>> <?php echo $language['name'];?>
                                                                 </label>
                                                              </div>
                                                              <?php
                                                            }
                                                          ?>
                                                      </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="control-group info">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label class="span2">Currencies</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="controls small-controls">
                                                      <div class="row">
                                                          <?php
                                                            $currencies = allCurrencies();
                                                            $configCurrencies = $configrations['currencies']  ? explode(',', $configrations['currencies']) : [];
                                                            foreach ($currencies as $key => $currency) {
                                                              $checked = '';
                                                              if (in_array($currency['code'], $configCurrencies)) {
                                                                 $checked = 'checked';
                                                              }
                                                              ?>
                                                              <div class="col-md-6">
                                                                  <label class="span2">
                                                                    <input name="currencies[]" type="checkbox" value="<?php echo $currency['code'];?>" <?php echo $checked;?>> <?php echo $currency['name'];?>
                                                                  </label>
                                                              </div>
                                                              <?php
                                                            }
                                                          ?>
                                                      </div>
                                                    </div>-->
                                                </div>
                                            </div>
                                        </div>
                                        <div class="control-group info">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label class="span2 ">Logo</label>
                                                </div>
                                                <div class="col-md-8">
                                                  <div class="controls">
                            											  	<div class="col-xs-3" style="margin-bottom:15px;">
                            												     <?php $old_image =isset($configrations['logo_image']) ? $configrations['logo_image'] : '';
                            													 ?>

                            													 <?php
                            													 if($old_image !='') {
                            													     $imageurl = getLogoImages($old_image);?>
                                                           <?php
                                                           if($imageurl) {
                                                             ?>
                                                             <img src="<?php echo $imageurl?>" width="100" height="80">
                                                             <?php
                                                           }?>
                            													 <?php
                            													   }
                            													 ?>
                            												  	<input name="old_image" value="<?php echo $old_image;?>" type="hidden">
                            											  	</div>
                            										    </div>
                                                  <div class="entry input-group col-xs-12" style="margin-bottom:15px;">
                                                      <input class="btn btn-primary" name="logo_image" type="file" accept="image/x-png,image/gif,image/jpeg" id="fileUpload-1">
                                                      &nbsp;&nbsp;
                                                  </div>
                                                </div>
                                            </div>
                                        </div>
										<div class="control-group info">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label class="span2 " for="office-timing">Logo Alt Teg</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="controls">
                                                        <input class="form-control" name="log_alt_teg" id="log_alt_teg" type="text" placeholder="Logo Alt Teg" value="<?php echo isset($configrations['log_alt_teg']) ? $configrations['log_alt_teg']:'';?>" maxlength="50">
                                                        <?php echo form_error('log_alt_teg');?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

										<div class="control-group info">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label class="span2 ">French Logo</label>
                                                </div>
                                                <div class="col-md-8">
                                                  <div class="controls">
                            											  	<div class="col-xs-3" style="margin-bottom:15px;">
                            												     <?php $old_image =isset($configrations['logo_image_french']) ? $configrations['logo_image_french'] : '';
                            													 ?>

                            													 <?php
                            													 if($old_image !='') {
                            													     $imageurl = getLogoImages($old_image);?>
                                                           <?php
                                                           if($imageurl) {
                                                             ?>
                                                             <img src="<?php echo $imageurl?>" width="100" height="80">
                                                             <?php
                                                           }?>
                            													 <?php
                            													   }
                            													 ?>
                            												  	<input name="logo_image_french" value="<?php echo $old_image;?>" type="hidden">
                            											  	</div>
                            										    </div>
                                                  <div class="entry input-group col-xs-12" style="margin-bottom:15px;">
                                                      <input class="btn btn-primary" name="logo_image_french" type="file" accept="image/x-png,image/gif,image/jpeg" id="fileUpload-1">
                                                      &nbsp;&nbsp;
                                                  </div>
                                                </div>
                                            </div>
                                        </div>
										<div class="control-group info">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label class="span2 " for="office-timing">French Logo Alt Teg</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="controls">
                                                        <input class="form-control" name="log_alt_teg_french" id="log_alt_teg_french" type="text" placeholder="French Logo Alt Teg" value="<?php echo isset($configrations['log_alt_teg_french']) ? $configrations['log_alt_teg_french']:'';?>" maxlength="50">
                                                        <?php echo form_error('log_alt_teg_french');?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
										<div class="control-group info">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label class="span2">Favicon</label>
                                                </div>
                                                <div class="col-md-8">
                                                  <div class="controls">
                            											  	<div class="col-xs-3" style="margin-bottom:15px;">

						<?php
						$old_favicon =isset($configrations['favicon']) ? $configrations['favicon'] : '';
                         ?>

                            								<?php
                            								if($old_favicon !='') {
                            						        $imageurl = getLogoImages($old_favicon);
															?>
                                                           <?php
                                                           if($imageurl) {
                                                             ?>
                                                             <img src="<?php echo $imageurl?>" width="50" height="50">
                                                             <?php
                                                           }?>
                            													 <?php
                            													   }
                            													 ?>
                            												  	<input name="old_favicon" value="<?php echo $old_favicon;?>" type="hidden">
                            											  	</div>
                            										    </div>
                                                  <div class="entry input-group col-xs-12" style="margin-bottom:15px;">
                                                      <input class="btn btn-primary" name="favicon" type="file" accept="image/x-png,image/gif,image/jpeg">
                                                      &nbsp;&nbsp;
                                                  </div>
                                                </div>
                                            </div>
                                        </div>

										<div class="control-group info">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label class="span2 ">French Favicon</label>
                                                </div>
                                                <div class="col-md-8">
                                                  <div class="controls">
                <div class="col-xs-3" style="margin-bottom:15px;">
                            			<?php
				$old_french_favicon =isset($configrations['french_favicon']) ? $configrations['french_favicon'] : '';
                            													 ?>

                            													 <?php
                            													 if($old_french_favicon !='') {
                            													     $imageurl = getLogoImages($old_french_favicon);?>
                                                           <?php
                                                           if($imageurl) {
                                                             ?>
                                                             <img src="<?php echo $imageurl?>" width="100" height="80">
                                                             <?php
                                                           }?>
                            													 <?php
                            													   }
                            													 ?>
                            												  	<input name="old_french_favicon" value="<?php echo $old_french_favicon;?>" type="hidden">
                            											  	</div>
                            										    </div>
                                                  <div class="entry input-group col-xs-12" style="margin-bottom:15px;">
                                                      <input class="btn btn-primary" name="french_favicon" type="file" accept="image/x-png,image/gif,image/jpeg">
                                                      &nbsp;&nbsp;
                                                  </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="text-right">
                                            <button type="submit" class="btn btn-success">Save</button>
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
 CKEDITOR.replace('content', {
    height: 300,
    filebrowserUploadUrl: "upload.php",
    allowedContent:true,
    extraAllowedContent: 'p(*)[*]{*};div(*)[*]{*};li(*)[*]{*};ul(*)[*]{*}',
 });
 CKEDITOR.dtd.$removeEmpty.i = 0;

 CKEDITOR.replace('content1', {
    height: 300,
    filebrowserUploadUrl: "upload.php",
    allowedContent:true,
    extraAllowedContent: 'p(*)[*]{*};div(*)[*]{*};li(*)[*]{*};ul(*)[*]{*}',
 });
 CKEDITOR.dtd.$removeEmpty.i = 0;

</script>
