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
                <div class="col-md-7">
                  <div class="text-center" style="color:red">
                    <?= $this->session->flashdata('message_error') ?>
                  </div>
                  <?= form_open_multipart('', array('class' => 'form-horizontal')) ?>
                  <input class="form-control" name="id" type="hidden"
                    value="<?= isset($postData['id']) ? $postData['id'] : '' ?>" id="id">
                  <div class="form-role-area">
                    <div class="control-group info">
                      <div class="row align-items-center">
                        <div class="col-md-4">
                          <label class="span2" for="menu_id">Select Product To Link</label>
                        </div>
                        <div class="col-md-8">
                          <div class="controls">
                            <div class="row">
                              <div class="col-md-6">
                                <select class="form-control" name="menu_id"
                                  id="menu_id">
                                  <option value="">Select Menu</option>
                                  <?php
                                  $menu_id = isset($postData['menu_id']) ? $postData['menu_id'] : '';
                                  foreach ($menuList as $key => $val) {
                                    $selected = '';

                                    if ($key == $menu_id) {
                                      $selected = 'selected="selected"';
                                    }
                                    ?>
                                    <option value="<?= $key ?>"
                                      <?= $selected ?>><?= $val ?>
                                    </option>
                                  <?php } ?>
                                </select>
                                <label class="form-inner-label">Menu</label>
                                <?= form_error('menu_id') ?>
                              </div>
                              <div class="col-md-6">
                                <select class="form-control" name="product_id"
                                  id="product_id">
                                  <option value="">Select Product Name</option>
                                  <?php
                                  $product_id = isset($postData['product_id']) ? $postData['product_id'] : '';

                                  foreach ($ProductList as $key => $val) {
                                    $selected = '';
                                    if ($key == $product_id) {
                                      $selected = 'selected="selected"';
                                    }
                                    ?>
                                    <option value="<?= $key ?>"
                                      <?= $selected ?>><?= $val ?>
                                    </option>
                                  <?php } ?>
                                </select>
                                <label class="form-inner-label">Product Name</label>
                                <?= form_error('product_id') ?>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="control-group info">
                      <div class="row align-items-center">
                        <div class="col-md-4">
                          <label class="span2" for="name">Banner Name</label>
                        </div>
                        <div class="col-md-8">
                          <div class="controls">
                            <input class="form-control" name="name" id="name" type="text"
                              placeholder="Banner Name"
                              value="<?= isset($postData['name']) ? $postData['name'] : '' ?>"
                              maxlength="50">
                            <?= form_error('name') ?>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="control-group info">
                      <div class="row align-items-center">
                        <div class="col-md-4">
                          <label class="span2" for="short_description">Banner Description</label>
                        </div>
                        <div class="col-md-8">
                          <div class="controls">
                            <input class="form-control" name="short_description"
                              id="short_description" type="text"
                              placeholder="short description"
                              value="<?= isset($postData['short_description']) ? $postData['short_description'] : '' ?>"
                              maxlength="150">
                            <?= form_error('short_description') ?>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="control-group info">
                      <div class="controls">
                        <div class="col-xs-3" style="margin-bottom:15px;">
                          <?php
                          $old_image = isset($postData['banner_image']) ? $postData['banner_image'] : '';
                          if ($old_image != '') {
                            $imageurl = getBannerImage($old_image, 'large');?>
                            <img src="<?= $imageurl ?>" width="100" height="80">
                          <?php } ?>
                          <input name="old_image" value="<?= $old_image ?>"
                            type="hidden">
                        </div>
                      </div>
                      <div class="controls file-data">
                        <div class="image-info col-xs-12" style="margin-bottom: 10px;">
                          <span>
                            Allowed image type : <b> (jpg, png, gif)</b>
                          </span>
                          <br>
                          <span>
                            Allowed image size maximum : <b> (1Mb)</b>
                          </span>
                          <br>
                          <span>
                            Allowed image in only dimensions(WXH) 1500pxX570px
                          </span>
                        </div>
                        <div class="entry input-group col-xs-3" style="margin-bottom:15px;">
                          <input class="btn btn-primary" name="files" type="file"
                            accept="image/x-png,image/gif,image/jpeg" id="upload"
                            onchange="Upload('upload')" />
                        </div>
                        <div style="color:red">
                          <?= $this->session->flashdata('file_message_error') ?>
                          <?= form_error('files') ?>
                        </div>
                      </div>
                    </div>
                    <div class="text-right">
                      <button type="submit" class="btn btn-success" id="submitBtn">Submit</button>
                      <a href="<?= $BASE_URL . $class_name . $main_page_url ?>"
                        class="btn btn-success">Back</a>
                    </div>
                    <?= form_close() ?>
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
$('#menu_id').on('change', function(e) {
  var menu_id = $(this).val();
  $('#product_id').html('<option value="">Select Product Name</option>');
  $.ajax({
    type: 'GET',
    dataType: 'html',
    url: '<?= $BASE_URL ?>admin/Ajax/getProductDropDownListByAjax/' + menu_id,
    //data:{'menu_id':menu_id},
    cache: false,
    contentType: false,
    processData: false,
    success: function(data) {
      $('#product_id').html(data);
    }
  });
});
</script>
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
if (FILE_MAX_SIZE_JS < imagesize) { $('#MsgModal .modal-body').html('<span style="color:red">Allowed image size maximum
  :1Mb</b></span>');
  $('#MsgModal').modal('show');
  return false;
  } else if (height != 570 || width !=1500) {
  document.getElementById(imageId).value='';
  $('#MsgModal .modal-body').html('<span style="color:red">Allowed image in only dimensions(WXH)
    1500pxX570px</b></span>');
  $('#MsgModal').modal('show');
  return false;
  }
  };
  }
  }
  }
  }
  </script>