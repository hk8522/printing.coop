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
                                    <?= form_open('',array('class' => 'form-horizontal')) ?>
                                     <input class="form-control" name="id" type="hidden"  value="<?= isset($postData['id']) ? $postData['id']:'' ?>">
                                     <div class="form-role-area">

                                        <div class="control-group info">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label class="span2 " for="inputMame">Category Name</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="controls">
                                                        <input class="form-control" name="name" id="name" type="text" placeholder="Category Name" value="<?= isset($postData['name']) ? $postData['name']:'' ?>" maxlength="50">
                                                        <?= form_error('name') ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="control-group info">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label class="span2 " for="inputMame">Category Order</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="controls">
                                                        <input class="form-control" name="category_order" id="category_order" type="number" placeholder="Category Order" value="<?= isset($postData['category_order']) ? $postData['category_order']:'' ?>" maxlength="50">
                                                        <?= form_error('category_order') ?>
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
                </div><!-- /.box -->
            </div><!-- /.col-->
        </div><!-- ./row -->
    </section><!-- /.content -->
</div>
