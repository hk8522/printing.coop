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
                  <div class="text-center" style="color:red">
                    <?=$this->session->flashdata('message_error')?>
                  </div>
                  <?=form_open('', array('class' => 'form-horizontal'))?>
                  <input class="form-control" name="id" type="hidden"
                    value="<?=isset($postData['id']) ? $postData['id'] : ''?>">
                  <div class="form-role-area">

                    <div class="control-group info">
                      <div class="row">
                        <div class="col-md-4">
                          <label class="span2" for="main_store_id">WebSite</label>
                        </div>
                        <div class="col-md-8">
                          <div class="controls">
                            <select name="main_store_id" class="form-control">
                              <option value="">Select WebSite</option>
                              <?php
                              foreach ($MainStoreList as $key => $val) {
                                $selected = '';
                                if ($postData['main_store_id'] == $key) {
                                  $selected = 'selected="selected"';
                                }
                                ?>
                                <option value="<?=$key?>" <?=$selected?>><?=$val?></option>
                              <?php }?>
                            </select>
                            <?=form_error('main_store_id')?>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="control-group info">
                      <div class="row">
                        <div class="col-md-4">
                          <label class="span2" for="name">Page Name</label>
                        </div>
                        <div class="col-md-8">
                          <div class="controls">
                            <input class="form-control" name="title" id="name" type="text" placeholder="Page Name"
                              value="<?=isset($postData['title']) ? $postData['title'] : ''?>" maxlength="50">
                            <?=form_error('title')?>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="control-group info">
                      <div class="row">
                        <div class="col-md-4">
                          <label class="span2" for="title_french">French Page Name</label>
                        </div>
                        <div class="col-md-8">
                          <div class="controls">
                            <input class="form-control" name="title_french" id="title_french" type="text"
                              placeholder="Page Name"
                              value="<?=isset($postData['title_french']) ? $postData['title_french'] : ''?>"
                              maxlength="50">
                            <?=form_error('title_french')?>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="control-group info">
                      <div class="row">
                        <div class="col-md-4">
                          <label class="span2" for="shortOrder">Page Order</label>
                        </div>
                        <div class="col-md-8">
                          <div class="controls">
                            <input class="form-control" name="shortOrder" id="shortOrder" type="number"
                              placeholder="Page Order"
                              value="<?=isset($postData['shortOrder']) ? $postData['shortOrder'] : ''?>" maxlength="50">
                            <?=form_error('shortOrder')?>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="control-group info">
                      <div class="row">
                        <div class="col-md-4">
                          <label class="span2" for="display_on_top_menu">Show On Menu</label>
                        </div>
                        <div class="col-md-6">

                          <?php
                          $display_on_top_menu = isset($postData['display_on_top_menu']) ? $postData['display_on_top_menu'] : '';
                          $cehecked = '';
                          if ($display_on_top_menu == 1) {
                            $cehecked = 'checked';
                          }
                          ?>
                          <label class="span2"><input name="display_on_top_menu" id="display_on_top_menu"
                              type="checkbox" value="1" <?=$cehecked?>>Top Main Menu</label>
                          <?=form_error('display_on_top_menu')?>

                          <?php
                          $displayOnFooter = isset($postData['display_on_footer']) ? $postData['display_on_footer'] : '';
                          $cehecked = '';
                          if ($displayOnFooter == 1) {
                            $cehecked = 'checked';
                          }
                          ?>
                          <label class="span2"><input name="display_on_footer" id="display_on_footer" type="checkbox"
                              value="1" <?=$cehecked?>>Footer Menu One</label>
                          <?=form_error('display_on_footer')?>

                          <?php
                          $display_on_footer_last_menu = isset($postData['display_on_footer_last_menu']) ? $postData['display_on_footer_last_menu'] : '';
                          $cehecked = '';
                          if ($display_on_footer_last_menu == 1) {
                              $cehecked = 'checked';
                          }
                          ?>
                          <label class="span2"><input name="display_on_footer_last_menu"
                              id="display_on_footer_last_menu" type="checkbox" value="1" <?=$cehecked?>> Footer Menu
                            Two</label>
                          <?=form_error('display_on_footer_last_menu')?>
                        </div>
                      </div>
                    </div>

                    <div class="control-group info">
                      <div class="row">
                        <div class="col-md-4">
                          <label class="span2" for="page_title">Page Title</label>
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
                          <label class="span2" for="page_title_french">French Page Title</label>
                        </div>
                        <div class="col-md-8">
                          <div class="controls">
                            <input class="form-control" name="page_title_french" id="page_title_french" type="text"
                              placeholder="French Page Title"
                              value="<?=isset($postData['page_title_french']) ? $postData['page_title_french'] : ''?>"
                              maxlength="50">
                            <?=form_error('page_title_french')?>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="control-group info">
                      <div class="row">
                        <div class="col-md-4">
                          <label class="span2" for="meta_description_content">Page Meta Description Content</label>
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
                          <label class="span2" for="meta_description_content_french">France Page Meta Description Content</label>
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
                          <label class="span2" for="meta_keywords_content">Page Meta Keywords Content</label>
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
                          <label class="span2" for="meta_keywords_content_french">France Page Meta Keywords Content</label>
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
                        <div class="col-md-12">
                          <label class="span2" for="content">Page Description</label>
                        </div>
                        <div class="col-md-12">
                          <div class="controls">
                            <textarea name="description" id="content"
                              rows="100"><?=isset($postData['description']) ? $postData['description'] : ''?></textarea>
                            <?=form_error('description')?>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="control-group info">
                      <div class="row">
                        <div class="col-md-12">
                          <label class="span2" for="content1">French Page Description</label>
                        </div>
                        <div class="col-md-12">
                          <div class="controls">
                            <textarea name="description_french" id="content1"
                              rows="100"><?=isset($postData['description_french']) ? $postData['description_french'] : ''?></textarea>
                            <?=form_error('description_french')?>
                          </div>
                        </div>
                      </div>
                    </div>
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
        </div><!-- /.box -->
      </div><!-- /.col-->
    </div><!-- ./row -->
  </section><!-- /.content -->
</div>
<script>
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