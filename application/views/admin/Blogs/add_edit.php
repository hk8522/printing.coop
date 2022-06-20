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
                                                    <label class="span2 " for="inputMame">Blog Title</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="controls">
                                                        <input class="form-control" name="title" id="title" type="text" placeholder="Blog Title" value="<?php echo isset($postData['title']) ? $postData['title']:'';?>" >
                                                        <?php echo form_error('title');?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="control-group info">
                                            <div class="row align-items-center">
                                                <div class="col-md-4">
                                                    <label class="span2 " for="inputMame">Blog Title</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="controls">
                                                        <input class="form-control" name="title_french" id="title_french" type="text" placeholder="Blog Title" value="<?php echo isset($postData['title_french']) ? $postData['title_french']:'';?>" >
                                                        <?php echo form_error('title_french');?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="control-group info">
                                            <div class="row align-items-center">
                                                <div class="col-md-4">
                                                    <label class="span2 " for="inputMame">Blog Category</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="controls">

                                                        <select class="form-control" name="category_id">
                                                        <option value="">
                                                        Select Category
                                                        </option>
                                                        <?php
                                                           $category_id=$postData['category_id'] ? isset($postData['category_id']):0;

                                                           foreach($categoryData as $key=>$val){
                                                               $selected='';
                                                               if($val['id']==$category_id){
                                                                   $selected='selected="selected"';
                                                               }
                                                        ?>
                                                           <option value="<?php echo $val['id'];?>" <?php echo $selected;?>>
                                                          <?php echo $val['category_name']?>
                                                        </option>
                                                          <?php
                                                          }?>
                                                        </select>
                                                        <?php echo form_error('category_id');?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="control-group info">
                                            <div class="row align-items-center">
                                                <div class="col-md-4">
                                                    <label class="span2 " for="inputMame">Populer</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="controls">
                                                  <input name="populer" id="populer" type="checkbox" placeholder="Blog Title" value="1" <?php echo isset($postData['populer']) && $postData['populer'] ==1 ? 'checked':'';?>>
                                                        <?php echo form_error('populer');?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="control-group info">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label class="span2 " for="inputMame">Blog Content</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="controls">
                                                      <textarea name="content" id="content"><?php echo isset($postData['content']) ? $postData['content']:'';?>
                                                      </textarea>
                                                        <?php
                                                          echo form_error('content');
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="control-group info">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label class="span2 " for="inputMame">French Blog Content</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="controls">
                                                      <textarea name="content_french" id="content1"><?php echo isset($postData['content_french']) ? $postData['content_french']:'';?>
                                                      </textarea>
                                                        <?php
                                                          echo form_error('content_french');
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="control-group info">
                                            <div class="row">
                                              <div class="col-md-4">
                                                <label class="span2 " for="inputMame"> Blog Image</label>

                                              </div>
                                              <div class="col-md-8">
                                                <div class="controls">
                                                    <div class="col-xs-3" style="margin-bottom:15px;">
                                                        <?php $old_image =isset($postData['image']) ? $postData['image']:'';
                                                            ?>
                                                        <?php
                                                            if($old_image !=''){
                                                               $imageurl=getBlogImage($old_image,'large');

                                                               ?>
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
                                                        <br>
                                                        <!--<span>
                                                        Allowed image size maximum  : <b> (1Mb)</b>
                                                        </span>
                                                        <br>-->

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
                }*/
                  };
              }
          }
      }
    }
</script>
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
