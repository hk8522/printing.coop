<div class="content-wrapper" style="min-height: 687px;">
  <section class="content">
    <div class="row" style="display: flex;justify-content: center;align-items: center;">
      <div class="col-md-12 col-xs-12">
        <div class="box box-success box-solid">
          <div class="box-body">
            <h3 class="text-center mb-5" style="color:#555 !important;"><?=$page_title?></h3>
            <div class="text-center" style="color:red">
              <?=$this->session->flashdata('message_error')?></div>

            <div class="row">
              <div class="control-group info col-sm-4">
                <label class="span2" for="website">Website</label>
              </div>
              <div class="control-group info col-sm-8">
                <div class="controls">
                  <?php
                  $store_ids = $blog['store_id'];
                  if (!empty($store_ids)) {
                    $store_ids = explode(',', $store_ids);
                  } else {
                    $store_ids = array();
                  }

                  foreach ($StoreList as $key => $val) {
                    if (in_array($key, $store_ids)) {
                    ?>
                      <label style="margin-left:5px;"><?=$val['name']?></label>
                    <?php }
                  }?>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="control-group info col-sm-4">
                <label class="span2" for="title">Title</label>
              </div>
              <div class="control-group info col-sm-8">
                <div class="controls">
                  <p>
                    <?=ucfirst($blog['title'])?>
                  </p>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="control-group info col-sm-4">
                <label class="span2" for="content">Content</label>
              </div>
              <div class="control-group info col-sm-8">
                <div class="controls">
                  <p>
                    <?=ucfirst($blog['content'])?>
                  </p>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="control-group info col-sm-4">
                <label class="span2" for="image">Image</label>
              </div>
              <div class="control-group info col-sm-8">
                <div class="controls">
                  <?php $imageurl = getBlogImage($blog['image'], 'large'); ?>
                  <img src="<?=$imageurl?>" width="700" height="400">
                </div>
              </div>
            </div>

            <div class="text-right">
              <a href="<?=$BASE_URL . $class_name . $main_page_url?>" class="btn btn-success">Back
              </a>
            </div>
          </div>
        </div>
      </div><!-- /.box -->
    </div><!-- /.col-->
</div><!-- ./row -->
</section><!-- /.content -->
</div>