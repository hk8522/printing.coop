<div class="content-wrapper" style="min-height: 687px;">
    <section class="content">
        <div class="row" style="display: flex;justify-content: center;align-items: center;">
            <div class="col-md-9 col-xs-12">
                <div class="box box-success box-solid">
                    <div class="box-body">
                        <h3 class="text-center" style="color:#555 !important;"><?= $page_title ?></h3>
                        <div class="text-center" style="color:red">
                        <?= $this->session->flashdata('message_error') ?></div>
                        <?= form_open_multipart('',array('class' => 'form-horizontal')) ?>

                                <div class="control-group info">
                                    <label class="span2 " for="inputMame">Enter New Password</label>
                                    <div class="controls">
                                        <input class="form-control" name="id"  type="hidden" value="<?= $id ?>" >

                                        <input class="form-control" name="password" id="password" type="password" placeholder="Enter New Password" value="" maxlength="50">
                                        <?= form_error('password') ?>
                                    </div>
                                </div>
                                <div class="text-right">
                                <button type="submit" class="btn btn-success" id="submitBtn">Submit</button>
                                <a href="<?= $BASE_URL.$class_name.$main_page_url ?>"
                                class="btn btn-success">Back</a>
                                </div>
                         <?= form_close() ?>
                    </div>
                </div><!-- /.box -->
            </div><!-- /.col-->
        </div><!-- ./row -->
    </section><!-- /.content -->
 </div>

