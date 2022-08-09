<script src="https://cdn.ckeditor.com/4.6.2/standard-all/ckeditor.js"></script>
<div class="content-wrapper" style="min-height: 687px;">
    <section class="content">
        <div class="row" style="display: flex;justify-content: center;align-items: center;">
            <div class="col-md-12 col-xs-12">
                <div class="box box-success box-solid">
                    <div class="box-body">
                        <div class="inner-head-section">
                            <div class="inner-title">
                                <span><?= $page_title ?></span>
                            </div>
                        </div>
                        <div class="inner-content-area">
                            <div class="row justify-content-center">
                                <div class="col-md-12">
                                    <div class="text-center" style="color:red">
                                        <?= $this->session->flashdata('message_error') ?>
                                    </div>
                                    <?= form_open_multipart('',array('class' => 'form-horizontal')) ?>
                                    <input class="form-control" name="id" type="hidden"  value="<?= isset($postData['id']) ? $postData['id']:'' ?>">
                                    <div class="form-role-area">

                                        <div class="control-group info">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label class="span2" for="inputMame">Name</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="controls">
                                                        <input class="form-control" name="name" id="name" type="text" placeholder="Name" value="<?= isset($postData['name']) ? $postData['name']:$old_values['name'] ?? '' ?>" maxlength="50">
                                                                                                                <label class="mt-2 text-danger"><?= $errors['name'] ?? '' ?></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="control-group info">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label class="span2" for="inputMame">French Name</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="controls">
                                                        <input class="form-control" name="name_french" id="name_french" type="text" placeholder="name french" value="<?= isset($postData['name_french']) ? $postData['name_french']:$old_values['name_french'] ?? '' ?>" maxlength="50">
                                                                                                                <label class="mt-2 text-danger"><?= $errors['name_french'] ?? '' ?></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="control-group info">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label class="span2" for="inputMame">Tag Order</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="controls">
                                                        <input class="form-control" name="tag_order" id="sub_category_order" type="number" placeholder="Tag Order" value="<?= isset($postData['tag_order']) ? $postData['tag_order']:'' ?>">
                                                        <label class="mt-2 text-danger"><?= $errors['tag_order'] ?? '' ?></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="control-group info">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label class="span2" for="inputMame">Tag Font Awesome Class</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="controls">
                                                        <input class="form-control" name="font_class" id="font_class" type="text" placeholder="Font Awesome Class" value="<?= isset($postData['font_class']) ? $postData['font_class']:'' ?>">
                                                        <label class="mt-2 text-danger"><?= $errors['font_class'] ?? '' ?></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="control-group info">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label class="span2" for="inputMame">Show Tag</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="controls">
                                                        <input type="checkbox" name="proudly_display_your_brand" value="1" <?= !empty($postData['proudly_display_your_brand']) ? 'checked':'' ?>> Proudly Display Your Brand
                                                        <?php echo form_error('category_dispersion');
                                                        ?>
                                                        <input type="checkbox" name="montreal_book_printing" value="1" <?= !empty(    $postData['montreal_book_printing']) ? 'checked':'' ?>> Montreal Book Printing
                                                        <?php echo form_error('montreal_book_printing');
                                                        ?>
                                                        <input type="checkbox" name="footer" value="1" <?= !empty($postData['footer']) ? 'checked':'' ?>> Show  Footer
                                                        <?php echo form_error('footer');
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="control-group info">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label class="span2" for="inputMame">Tag Image</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="controls">
                                                        <div tyle="margin-bottom:15px;">
                                                            <?php $old_image =isset($postData['image']) ? $postData['image']:'';?>
                                                            <?php
                                                                if ($old_image !='') {
                                                                   $imageurl=geCategoryImage($old_image,'large');?>
                                                                   <img src="<?= $imageurl ?>" width="100" height="80">
                                                            <?php
                                                                }
                                                                ?>
                                                            <input name="old_image" value="<?= $old_image ?>" type="hidden">
                                                        </div>
                                                        <div class="image-info">
                                                            <span>
                                                            Allowed image type  : <b> (jpg, png, gif)</b>
                                                            </span>
                                                            <!--<br>
                                                            <span>
                                                            Allowed image size maximum  : <b> (1Mb)</b>
                                                            </span>
                                                            <br>
                                                            <!--<span>
                                                            Allowed image in only  dimensions(WXH) 1920pxX428px
                                                            </span>-->

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
                                        </div>
                                        <div class="control-group info">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label class="span2" for="inputMame">Tag Image French</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="controls">
                                                        <div tyle="margin-bottom:15px;">
                                                            <?php $old_image_french =isset($postData['image_french']) ? $postData['image_french']:'';?>
                                                            <?php
                                                                if ($old_image_french !='') {
                                                                   $imageurl=geCategoryImage($old_image_french,'large');?>
                                                                   <img src="<?= $imageurl ?>" width="100" height="80">
                                                            <?php
                                                                }
                                                                ?>
                                                            <input name="old_image_french" value="<?= $old_image_french ?>" type="hidden">
                                                        </div>
                                                        <div class="image-info">
                                                            <span>
                                                            Allowed image type  : <b> (jpg, png, gif)</b>
                                                            </span>
                                                            <!--<br>
                                                            <span>
                                                            Allowed image size maximum  : <b> (1Mb)</b>
                                                            </span>
                                                            <br>
                                                            <!--<span>
                                                            Allowed image in only  dimensions(WXH) 1920pxX428px
                                                            </span>-->

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
                                        </div>
                                        <div class="text-right">
                                            <button type="submit" class="btn btn-success">Submit</button>
                                            <a href="<?= $BASE_URL.$class_name.$main_page_url ?>" class="btn btn-success">Back</a>
                                        </div>
                                        <?= form_close() ?>
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
                var FILE_MAX_SIZE_JS='<?= FILE_MAX_SIZE_JS ?>';

                //alert(imagesize);
                if (FILE_MAX_SIZE_JS < imagesize) {
                    $('#MsgModal .modal-body').html('<span style="color:red">Allowed image size maximum  :1Mb</b></span>');
                    $('#MsgModal').modal('show');
                          return false;
                }
                 /*else if (height  =< 400 || width !=1920) {
                    document.getElementById(imageId).value='';
                    $('#MsgModal .modal-body').html('<span style="color:red">Allowed image in only  dimensions(WXH) 1920pxX428px</b></span>');
                    $('#MsgModal').modal('show');
                          return false;
                  }*/
                  };
              }
          }
      }
  }
  CKEDITOR.replace('content', {
    height: 300,
    filebrowserUploadUrl: "upload.php",
    allowedContent:true,
    extraAllowedContent: 'p(*)[*]{*};div(*)[*]{*};li(*)[*]{*};ul(*)[*]{*}',
 });

 CKEDITOR.dtd.$removeEmpty.i = 0;

</script>
