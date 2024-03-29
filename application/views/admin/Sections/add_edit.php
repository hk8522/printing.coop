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
                  <input class="form-control" name="id" type="hidden"  value="<?= isset($postData['id']) ? $postData['id'] : '' ?>">
                  <div class="form-role-area">
                    <div class="control-group info">
                      <div class="row">
                        <div class="col-md-4">
                          <label class="span2"for="name">Section Name</label>
                        </div>
                        <div class="col-md-8">
                          <div class="controls">
                            <input class="form-control" name="name" id="name" type="text" placeholder="Name" value="<?= isset($postData['name']) ? $postData['name'] : '' ?>" maxlength="50">
                            <label class="mt-2 text-danger"><?= $errors['name'] ?? '' ?></label>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="control-group info">
                      <div class="row">
                        <div class="col-md-4">
                          <label class="span2" for="name_french">French Section Name</label>
                        </div>
                        <div class="col-md-8">
                          <div class="controls">
                            <input class="form-control" name="name_french" id="name_french" type="text" placeholder="name france" value="<?= isset($postData['name_french']) ? $postData['name_french'] : '' ?>" maxlength="50">
                            <label class="mt-2 text-danger"><?= $errors['name_french'] ?? '' ?></label>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="control-group info">
                      <div class="row">
                        <div class="col-md-4">
                          <label class="span2" for="description">Section Description</label>
                        </div>
                        <div class="col-md-8">
                          <div class="controls">
                            <textarea class="form-control" rows="4" name="description" placeholder="Description"><?= isset($postData['description'])? $postData['description'] : '' ?></textarea>
                            <label class="mt-2 text-danger"><?= $errors['description'] ?? '' ?></label>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="control-group info">
                      <div class="row">
                        <div class="col-md-4">
                          <label class="span2" for="description_french">French Section Description</label>
                        </div>
                        <div class="col-md-8">
                          <div class="controls">
                            <textarea class="form-control" rows="4" name="description_french" placeholder="description_french"><?= isset($postData['description_french'])? $postData['description_french'] : '' ?></textarea>
                            <label class="mt-2 text-danger"><?= $errors['description_french'] ?? '' ?></label>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="control-group info mt-2">
                      <div class="row">
                        <div class="col-md-12">
                          <label class="span2" for="content">Section Content</label>
                        </div>
                        <div class="col-md-12">
                          <div class="controls">
                            <textarea name="content" id="content" rows="100">
                              <?= isset($postData['content']) ? $postData['content'] : '' ?>
                            </textarea>
                            <?= form_error('content') ?>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="control-group info mt-2">
                      <div class="row">
                        <div class="col-md-12">
                          <label class="span2" for="content1">French Section Content</label>
                        </div>
                        <div class="col-md-12">
                          <div class="controls">
                            <textarea name="content_french" id="content1" rows="100">
                              <?= isset($postData['content_french']) ? $postData['content_french'] : '' ?>
                            </textarea>
                            <?= form_error('content_french') ?>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="control-group info">
                      <div class="row">
                        <div class="col-md-4">
                        <label class="span2" for="old_background_image">Section Background image</label>
                        </div>
                        <div class="col-md-8">
                        <div class="controls">
                          <div class="col-xs-3" style="margin-bottom:15px;">
                            <?php $old_background_image =isset($postData['background_image']) ? $postData['background_image'] : '';
                              ?>
                            <?php
                              if ($old_background_image !='') {
                                 $imageurl=getSectionImage($old_background_image);
                                 ?>
                              <img src="<?= $imageurl ?>" width="100" height="80">
                              <?php } ?>
                            <input name="old_background_image" value="<?= $old_background_image ?>" type="hidden">
                          </div>
                        </div>
                        <div class="controls file-data">
                          <div class="image-info col-xs-12" style="margin-bottom: 10px;">
                            <span>
                            Allowed image type  : <b> (jpg, png, gif)</b>
                            </span>
                          </div>
                           <div class="entry input-group col-xs-3" style="margin-bottom:15px;">
                           <input class="btn btn-primary" name="background_image" type="file" accept="image/x-png,image/gif,image/jpeg"/>
                          </div>
                          <div style="color:red">

                            <?php
                               echo form_error('background_image');
                            ?>
                          </div>
                        </div>
                        </div>
                      </div>
                    </div>

                    <div class="control-group info">
                      <div class="row">
                        <div class="col-md-4">
                        <label class="span2" for="old_french_background_image">French Section Background Image</label>
                        </div>
                        <div class="col-md-8">
                        <div class="controls">
                          <div class="col-xs-3" style="margin-bottom:15px;">
                            <?php $old_french_background_image =isset($postData['french_background_image']) ? $postData['french_background_image'] : '';
                              ?>
                            <?php
                              if ($old_french_background_image !='') {
                                 $imageurl=getSectionImage($old_french_background_image);
                                 ?>
                              <img src="<?= $imageurl ?>" width="100" height="80">
                              <?php }?>
                            <input name="old_french_background_image" value="<?= $old_french_background_image ?>" type="hidden">
                          </div>
                        </div>
                        <div class="controls file-data">
                          <div class="image-info col-xs-12" style="margin-bottom: 10px;">
                            <span>
                            Allowed image type  : <b> (jpg, png, gif)</b>
                            </span>
                          </div>
                           <div class="entry input-group col-xs-3" style="margin-bottom:15px;">
                           <input class="btn btn-primary" name="french_background_image" type="file" accept="image/x-png,image/gif,image/jpeg"/>
                          </div>
                          <div style="color:red">

                            <?php
                               echo form_error('french_background_image');
                            ?>
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
      </div>
    </div>
  </section>
</div>
<script>
 CKEDITOR.replace('content', {
  height: 300,
  filebrowserUploadUrl: "<?= $BASE_URL ?>upload.php",
  allowedContent:true,
  extraAllowedContent: 'p(*)[*]{*};div(*)[*]{*};li(*)[*]{*};ul(*)[*]{*}',
 });
CKEDITOR.dtd.$removeEmpty.i = 0;
CKEDITOR.replace('content1', {
  height: 300,
  filebrowserUploadUrl: "<?= $BASE_URL ?>upload.php",
  allowedContent:true,
  extraAllowedContent: 'p(*)[*]{*};div(*)[*]{*};li(*)[*]{*};ul(*)[*]{*}',
 });
 CKEDITOR.dtd.$removeEmpty.i = 0;
</script>
