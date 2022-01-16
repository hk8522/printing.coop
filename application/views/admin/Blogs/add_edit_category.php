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
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="text-center" style="color:red">
                                        <?php echo $this->session->flashdata('message_error');?>
                                    </div>
                                    <?php echo form_open_multipart('',array('class'=>'form-horizontal'));?>
                                    <input class="form-control" name="id" type="hidden"  value="<?php echo isset($postData['id']) ? $postData['id']:'';?>" id="id">
                                    <div class="form-role-area">
									     <div class="control-group info">
                                            <div class="row align-items-center">
                                                <div class="col-md-4">
                                                    <label class="span2 " for="inputMame">WebSite</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="controls">
													    <?php
														$store_ids=$postData['store_id'];
														if(!empty($store_ids)){
															$store_ids=explode(',',$store_ids);
														}else{
															$store_ids=array();
														}

														foreach($StoreList as $key=>$val){
															$checked='';
														    if(in_array($key,$store_ids)){
																$checked='checked';
															}
														?>

                                                            <input  name="store_id[]" type="checkbox" value="<?php echo $key?>" <?php echo $checked;?>><label style="margin-left:5px;"><?php echo $val['name']?></label>
														<?php
														}?>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="control-group info">
                                            <div class="row align-items-center">
                                                <div class="col-md-4">
                                                    <label class="span2 " for="inputMame">Category Name</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="controls">
                                                        <input class="form-control" name="category_name" id="category_name" type="text" placeholder="category name" value="<?php echo isset($postData['category_name']) ? $postData['category_name']:'';?>" >
                                                        <?php echo form_error('category_name');?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="control-group info">
                                            <div class="row align-items-center">
                                                <div class="col-md-4">
                                                    <label class="span2 " for="inputMame">French Category Name</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="controls">
                                                        <input class="form-control" name="category_name_french" id="category_name_french" type="text" placeholder="category name french" value="<?php echo isset($postData['category_name_french']) ? $postData['category_name_french']:'';?>" >
                                                        <?php echo form_error('category_name_french');?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="control-group info">
                                          <div class="text-right">
                                              <button type="submit" class="btn btn-success" id="submitBtn" >Submit</button>
                                              <a href="<?php echo $BASE_URL.$class_name.$main_page_url ?>" class="btn btn-success">Back</a>
                                          </div>
                                          <?php echo form_close();?>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col-->
        </div>
        <!-- ./row -->
    </section>
    <!-- /.content -->
</div>

