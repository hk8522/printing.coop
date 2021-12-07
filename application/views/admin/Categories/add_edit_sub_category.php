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
                                                    <label class="span2 " for="inputMame">Parent Category</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="controls">
                                                        <select class="form-control" name="category_id" id="category_id">
                                                            <option value="">Select Parent Category</option>
                                                            <?php
                                                                $category_id = isset($postData['category_id']) ? $postData['category_id']:$old_values['category_id'] ?? '';
                                                                foreach ($categoryList as $key => $category) {
                                                                $selected = '';
                                                                if ($key == $category_id) {
                                                                    $selected = 'selected="selected"';
                                                                }
                                                                ?>
                                                                  <option value="<?php echo  $key?>" <?php echo $selected ?>><?php echo $category;?></option>
		                                                            <?php
		                                                            }
		                                                            ?>
                                                        </select>
																												<label class="mt-2 text-danger"><?php echo $errors['category_id'] ?? '';?></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="control-group info">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label class="span2 " for="inputMame">Name</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="controls">
                                                        <input class="form-control" name="name" id="name" type="text" placeholder="Name" value="<?php echo isset($postData['name']) ? $postData['name']:$old_values['name'] ?? '';?>" maxlength="50">
																												<label class="mt-2 text-danger"><?php echo $errors['name'] ?? '';?></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
										
										<div class="control-group info">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label class="span2 " for="inputMame">French Name</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="controls">
                                                        <input class="form-control" name="name_french" id="name_french" type="text" placeholder="Name" value="<?php echo isset($postData['name_french']) ? $postData['name_french']:$old_values['name_french'] ?? '';?>" maxlength="50">
																												<label class="mt-2 text-danger"><?php echo $errors['name_french'] ?? '';?></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
										
                                        <div class="control-group info">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label class="span2 " for="inputMame">Sub Category Order</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="controls">
                                                        <input class="form-control" name="sub_category_order" id="sub_category_order" type="number" placeholder="Sub Category Order" value="<?php echo isset($postData['sub_category_order']) ? $postData['sub_category_order']:'';?>">
                                                        <label class="mt-2 text-danger"><?php echo $errors['sub_category_order'] ?? '';?></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="control-group info">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label class="span2 " for="inputMame">Sub Category Dispersion</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="controls">
													    <textarea class="form-control" name="sub_category_dispersion" id="content"><?php echo isset($postData['sub_category_dispersion']) ? $postData['sub_category_dispersion']:'';?></textarea>
                                                        <?php echo form_error('sub_category_dispersion');?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
										<div class="control-group info">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label class="span2 " for="inputMame">French Sub Category Dispersion</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="controls">
													    <textarea class="form-control" name="sub_category_dispersion_french" id="content1"><?php echo isset($postData['sub_category_dispersion_french']) ? $postData['sub_category_dispersion_french']:'';?></textarea>
                                                        <?php echo form_error('sub_category_dispersion_french');?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
										
										<div class="control-group info">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label class="span2 " for="inputMame">Show Sub Category</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="controls">
														<input type="checkbox" name="show_main_menu" value="1" <?php echo !empty(    $postData['show_main_menu']) ? 'checked':''?>> Show Main Menu	
                                                        <?php echo form_error('show_main_menu');
														?>
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
                <!-- /.box -->
            </div>
            <!-- /.col-->
        </div>
        <!-- ./row -->
    </section>
    <!-- /.content -->
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
</script>
