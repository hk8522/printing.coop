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
                                    <div class="form-role-area">
                                        <div class="control-group info">
                                            <div class="row align-items-center">
                                                <div class="col-md-4">
                                                    <label class="span2 " for="inputMame">Brand Name</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="controls">
                                                        <div class="product-view-display">
                                                            <span><?= ucfirst($Product['name']) ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="control-group info">
                                            <div class="row align-items-center">
                                                <div class="col-md-4">
                                                    <label class="span2 " for="inputMame">Brand Short Description</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="controls">
                                                        <div class="product-view-display">
                                                            <span><?= ucfirst($Product['short_description']) ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="control-group info">
                                            <div class="row align-items-center">
                                                <div class="col-md-4">
                                                    <label class="span2 " for="inputMame">Brand Full Description</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="controls">
                                                        <div class="product-view-display">
                                                            <span><?= ucfirst($Product['full_description']) ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                           <div class="control-group info">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label class="span2 " for="inputMame">Brand Image</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="controls">
                                                        <?php $imageurl = getBrandImage($Product['brand_image'], 'large');?>
                                                          <img src="<?= $imageurl ?>" width="100" height="100">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <a href="<?= $BASE_URL . $class_name . $main_page_url ?>" class="btn btn-success">Back</a>
                                        </div>
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
