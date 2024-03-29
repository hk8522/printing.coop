<script src="https://cdn.ckeditor.com/4.6.2/standard-all/ckeditor.js"></script>
<div class="content-wrapper" style="min-height: 687px;">
  <section class="content">
    <div class="row" style="display: flex;justify-content: center;align-items: center;">
      <div class="col-md-12 col-xs-12">
        <div class="box box-success box-solid">
          <div class="box-body">
            <div class="inner-head-section">
              <div class="inner-title">
                <span><?=$page_title?></span>
              </div>
            </div>
            <div class="inner-content-area">
              <div class="row justify-content-center">
                <div class="col-md-12">
                  <div class="text-center text-danger">
                    <?=$this->session->flashdata('message_error')?>
                  </div>
                  <?=form_open_multipart('', array('class' => 'form-horizontal'))?>
                  <input class="form-control" name="id" type="hidden"
                    value="<?=isset($postData['id']) ? $postData['id'] : ''?>">
                  <div class="form-role-area">
                    <div class="control-group info">
                      <div class="row">
                        <div class="col-md-4">
                          <label class="span2" for="name">Name</label>
                        </div>
                        <div class="col-md-8">
                          <div class="controls">
                            <input class="form-control" name="name" id="name" type="text" placeholder="Category Name"
                              value="<?=isset($postData['name']) ? $postData['name'] : $old_values['name'] ?? ''?>"
                              maxlength="50">
                            <label class="mt-2 text-danger"><?=$errors['name'] ?? ''?></label>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="control-group info">
                      <div class="row">
                        <div class="col-md-4">
                          <label class="span2" for="name_french">French Name</label>
                        </div>
                        <div class="col-md-8">
                          <div class="controls">
                            <input class="form-control" name="name_french" id="name_french" type="text"
                              placeholder="Category Name"
                              value="<?=isset($postData['name_french']) ? $postData['name_french'] : $old_values['name_french'] ?? ''?>"
                              maxlength="50">
                            <label class="mt-2 text-danger"><?=$errors['name_french'] ?? ''?></label>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="control-group info">
                      <div class="row">
                        <div class="col-md-4">
                          <label class="span2" for="category_order">Category Order</label>
                        </div>
                        <div class="col-md-8">
                          <div class="controls">
                            <input class="form-control" name="category_order" id="category_order" type="number"
                              placeholder="Category Order"
                              value="<?=isset($postData['category_order']) ? $postData['category_order'] : ''?>">
                            <?=form_error('category_order')?>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="control-group info">
                      <div class="row">
                        <div class="col-md-4">
                          <label class="span2" for="page_title">Category Page Title</label>
                        </div>
                        <div class="col-md-8">
                          <div class="controls">
                            <input class="form-control" name="page_title" id="page_title" type="text"
                              placeholder="Page Title"
                              value="<?=isset($postData['page_title']) ? $postData['page_title'] : ''?>"
                              maxlength="250">
                            <?=form_error('page_title')?>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="control-group info">
                      <div class="row">
                        <div class="col-md-4">
                          <label class="span2" for="page_title_french">French Category Page Title</label>
                        </div>
                        <div class="col-md-8">
                          <div class="controls">
                            <input class="form-control" name="page_title_french" id="page_title_french" type="text"
                              placeholder="French Page Title"
                              value="<?=isset($postData['page_title_french']) ? $postData['page_title_french'] : ''?>"
                              maxlength="250">
                            <?=form_error('page_title_french')?>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="control-group info">
                      <div class="row">
                        <div class="col-md-4">
                          <label class="span2" for="meta_description_content">Category Page Meta Description Content</label>
                        </div>
                        <div class="col-md-8">
                          <div class="controls">
                            <textarea name="meta_description_content" id="meta_description_content"
                              rows="100"><?=isset($postData['meta_description_content']) ? $postData['meta_description_content'] : ''?></textarea>

                            <?=form_error('meta_description_content')?>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="control-group info">
                      <div class="row">
                        <div class="col-md-4">
                          <label class="span2" for="meta_description_content_french">France Category Page Meta Description Content</label>
                        </div>
                        <div class="col-md-8">
                          <div class="controls">
                            <textarea name="meta_description_content_french" id="meta_description_content_french"
                              rows="100"><?=isset($postData['meta_description_content_french']) ? $postData['meta_description_content_french'] : ''?></textarea>

                            <?=form_error('meta_description_content_french')?>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="control-group info">
                      <div class="row">
                        <div class="col-md-4">
                          <label class="span2" for="meta_keywords_content">Category Page Meta Keywords Content</label>
                        </div>
                        <div class="col-md-8">
                          <div class="controls">
                            <textarea name="meta_keywords_content" id="meta_keywords_content"
                              rows="100"><?=isset($postData['meta_keywords_content']) ? $postData['meta_keywords_content'] : ''?></textarea>

                            <?=form_error('meta_keywords_content')?>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="control-group info">
                      <div class="row">
                        <div class="col-md-4">
                          <label class="span2" for="meta_keywords_content_french">France Category Page Meta Keywords Content</label>
                        </div>
                        <div class="col-md-8">
                          <div class="controls">
                            <textarea name="meta_keywords_content_french" id="meta_keywords_content_french"
                              rows="100"><?=isset($postData['meta_keywords_content_french']) ? $postData['meta_keywords_content_french'] : ''?></textarea>

                            <?=form_error('meta_keywords_content_french')?>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="control-group info">
                      <div class="row">
                        <div class="col-md-4">
                          <label class="span2" for="content">Category Dispersion</label>
                        </div>
                        <div class="col-md-8">
                          <div class="controls">
                            <textarea class="form-control" name="category_dispersion"
                              id="content"><?=isset($postData['category_dispersion']) ? $postData['category_dispersion'] : ''?></textarea>
                            <?=form_error('category_dispersion')?>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="control-group info">
                      <div class="row">
                        <div class="col-md-4">
                          <label class="span2" for="content1">French Category Dispersion</label>
                        </div>
                        <div class="col-md-8">
                          <div class="controls">
                            <textarea class="form-control" name="category_dispersion_french"
                              id="content1"><?=isset($postData['category_dispersion_french']) ? $postData['category_dispersion_french'] : ''?></textarea>
                            <?=form_error('category_dispersion_french')?>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="control-group info">
                      <div class="row">
                        <div class="col-md-4">
                          <label class="span2" for="show_our_printed_product">Show Category</label>
                        </div>
                        <div class="col-md-8">
                          <div class="controls">
                            <input type="checkbox" name="show_our_printed_product" value="1"
                              <?=!empty($postData['show_our_printed_product']) ? 'checked' : ''?>> Our Printed Product <?=form_error('category_dispersion')?>
                            <input type="checkbox" name="show_main_menu" value="1"
                              <?=!empty($postData['show_main_menu']) ? 'checked' : ''?>> Show Main Menu <?=form_error('show_main_menu')?>
                            <input type="checkbox" name="show_footer_menu" value="1"
                              <?=!empty($postData['show_footer_menu']) ? 'checked' : ''?>> Show Footer Menu <?=form_error('show_footer_menu')?>
                          </div>
                        </div>
                      </div>
                    </div>
                    <?php
                    foreach ($MainStoreList as $key => $val) {
                      $categoryImageData = $CategoriesImageData[$key];
                      ?>
                      <input type="hidden" name="<?=$key?>category_image_id" value="<?=$categoryImageData['id']?>">
                      <div class="control-group info">
                        <div class="row">
                          <div class="col-md-4">
                            <label class="span2" for="old_image"><?=$val?> Image</label>
                          </div>
                          <div class="col-md-8">
                            <div class="controls">
                              <div tyle="margin-bottom:15px;">
                                <?php $old_image = isset($categoryImageData['image']) ? $categoryImageData['image'] : '';?>
                                <?php
                                if ($old_image != '') {
                                  $imageurl = geCategoryImage($old_image, 'large');?>
                                  <img src="<?=$imageurl?>" width="100" height="80">
                                <?php } ?>
                                <input name="<?=$key?>old_image" value="<?=$old_image?>" type="hidden">
                              </div>
                              <div class="image-info">
                                <span>
                                  Allowed image type : <b> (jpg, png, gif)</b>
                                </span>

                                <div class="entry input-group col-xs-3" style="margin-bottom:15px;">
                                  <input class="btn btn-primary" name="<?=$key?>files" type="file"
                                    accept="image/x-png,image/gif,image/jpeg" id="<?=$key?>upload"
                                    onchange="Upload('<?=$key?>upload')" />
                                </div>
                                <div style="color:red">
                                  <?=$this->session->flashdata("$keyfile_message_error")?>
                                  <?=form_error('files')?>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <?php if ($key != 5) {?>
                        <div class="control-group info">
                          <div class="row">
                            <div class="col-md-4">
                              <label class="span2" for="old_image_french"><?=$val?> Image French</label>
                            </div>
                            <div class="col-md-8">
                              <div class="controls">
                                <div tyle="margin-bottom:15px;">
                                  <?php $old_image_french = isset($categoryImageData['image_french']) ? $categoryImageData['image_french'] : '';?>
                                  <?php
                                  if ($old_image_french != '') {
                                    $imageurl = geCategoryImage($old_image_french, 'large');?>
                                    <img src="<?=$imageurl?>" width="100" height="80">
                                  <?php } ?>
                                  <input name="<?=$key?>old_image_french" value="<?=$old_image_french?>" type="hidden">
                                </div>
                                <div class="image-info">
                                  <span>
                                    Allowed image type : <b> (jpg, png, gif)</b>
                                  </span>

                                  <div class="entry input-group col-xs-3" style="margin-bottom:15px;">
                                    <input class="btn btn-primary" name="<?=$key?>files_french" type="file"
                                      accept="image/x-png,image/gif,image/jpeg" id="upload" onchange="Upload('upload')" />
                                  </div>
                                  <div style="color:red">
                                    <?=$this->session->flashdata("$keyfile_message_error_french")?>
                                    <?=form_error('files_french')?>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      <?php }
                    }?>
                    <div class="text-right">
                      <button type="submit" class="btn btn-success">Submit</button>
                      <a href="<?=$BASE_URL . $class_name . $main_page_url?>" class="btn btn-success">Back</a>
                    </div>
                    <?=form_close()?>
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
    if (typeof(fileUpload.files) != "undefined") {
      //Initiate the FileReader object.
      var reader = new FileReader();
      //Read the contents of Image File.
      reader.readAsDataURL(fileUpload.files[0]);
      reader.onload = function(e) {
        //Initiate the JavaScript Image object.
        var image = new Image();
        //Set the Base64 string return from FileReader as source.
        image.src = e.target.result;
        //Validate the File Height and Width.
        image.onload = function() {
          var height = this.height;
          var width = this.width;
          var imagesize = fileUpload.files[0].size;
          var FILE_MAX_SIZE_JS = '<?=FILE_MAX_SIZE_JS?>';
        };
      }
    }
  }
}
CKEDITOR.replace('content', {
  height: 300,
  filebrowserUploadUrl: "<?=$BASE_URL?>upload.php",
  allowedContent: true,
  extraAllowedContent: 'p(*)[*]{*};div(*)[*]{*};li(*)[*]{*};ul(*)[*]{*}',
});

CKEDITOR.dtd.$removeEmpty.i = 0;

CKEDITOR.replace('content1', {
  height: 300,
  filebrowserUploadUrl: "<?=$BASE_URL?>upload.php",
  allowedContent: true,
  extraAllowedContent: 'p(*)[*]{*};div(*)[*]{*};li(*)[*]{*};ul(*)[*]{*}',
});
CKEDITOR.dtd.$removeEmpty.i = 0;
</script>