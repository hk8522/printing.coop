<div class="content-wrapper" style="min-height: 687px;">
    <section class="content">
        <div class="row" style="display: flex;justify-content: center;align-items: center;">
            <div class="col-md-12 col-xs-12">
                <div class="box box-success box-solid">
                    <div class="box-body">
                        <h3 class="text-center" style="color:#555 !important;"><?= $page_title ?></h3>
                        <div class="text-center" style="color:red">
                            <?= $this->session->flashdata('message_error') ?></div>

                        <div class="row">
                            <div class="control-group info col-sm-4">
                                <div class="product-details-data">
                                    <label class="span2 " for="inputMame">Menu</label>
                                    <div class="controls">
                                        <p><?= ucfirst($Product['menu_name']) ?></p>
                                    </div>
                                </div>
                            </div>

                            <div class="control-group info col-sm-4">
                                <div class="product-details-data">
                                    <label class="span2 " for="inputMame">Category</label>
                                    <div class="controls">
                                        <p><?= ucfirst($Product['category_name']) ?></p>
                                    </div>
                                </div>
                            </div>

                            <div class="control-group info col-sm-4">
                                <div class="product-details-data">
                                    <label class="span2 " for="inputMame">Sub Category</label>
                                    <div class="controls">
                                        <p><?= ucfirst($Product['sub_category_name']) ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="control-group info col-sm-6">
                                <div class="product-details-data">
                                    <label class="span2 " for="inputMame"> Product Name</label>
                                    <div class="controls">
                                        <p><?= ucfirst($Product['product_name']) ?></p>
                                    </div>
                                </div>
                            </div>

                            <div class="control-group info col-sm-6">
                                <div class="product-details-data">
                                    <label class="span2 " for="inputMame"> Banner Name</label>
                                    <div class="controls">
                                        <p><?= ucfirst($Product['name']) ?></p>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="control-group info col-sm-12">
                                <label class="span2 " for="inputMame"> Banner Description </label>
                                <div class="controls">
                                    <p><?= ucfirst($Product['short_description']) ?></p>
                                </div>
                            </div>

                        </div>
                        <div class="row">

                            <div class="control-group info col-sm-12">
                                <div class="controls">
                                    <?php $imageurl = getBannerImage($Product['banner_image'], 'large');?>
                                    <img src="<?= $imageurl ?>" width="1050" height="570">
                                </div>
                            </div>

                        </div>

                        <div class="text-right">
                            <a href="<?= $BASE_URL . $class_name . $main_page_url ?>"
                                class="btn btn-success">Back</a>
                        </div>
                    </div>
                </div><!-- /.box -->
            </div><!-- /.col-->
        </div><!-- ./row -->
    </section><!-- /.content -->
</div>