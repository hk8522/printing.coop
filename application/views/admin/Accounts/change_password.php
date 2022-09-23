<div class="content-wrapper" style="min-height: 687px;">
    <section class="content">
        <div class="row" style="display: flex;justify-content: center;align-items: center;">
            <div class="col-md-9 col-xs-12">
                <div class="box box-success box-solid">
                    <div class="box-body">
                        <h3 class="text-center" style="color:#555 !important;"><?= $page_title ?></h3>
                        <div class="text-center" style="color:red">
                        <?= $this->session->flashdata('message_error') ?></div>
                        <div class="text-center" style="color:green">
                        <?= $this->session->flashdata('message_success') ?>

                        <?php if ($success) { ?>
                            <script>
                            setTimeout(function() {
                                window.location='<?= $BASE_URL_ADMIN ?>Accounts/logout';
                            }, 2000
                            );

                            </script>
                        <?php } ?>
                        </div>

                        <?= form_open_multipart('',array('class' => 'form-horizontal')) ?>
                             <input class="form-control" name="id" type="hidden"  value="<?= isset($postData['id']) ? $postData['id'] : '' ?>" id="product_id">
                                <div class="control-group info">
                                    <label class="span2" for="inputMame">Email Id</label>
                                    <div class="controls">
                                        <input class="form-control" name="email" id="email" type="text" placeholder="Email Id" value="<?= isset($postData['email']) ? $postData['email'] : '' ?>" maxlength="50" readonly>
                                        <?= form_error('email') ?>
                                    </div>
                                </div>
                                <div class="text-right">
                                <button type="submit" class="btn btn-success" id="submitBtn">Submit</button>
                                </div>
                         <?= form_close() ?>
                    </div>
                </div><!-- /.box -->
            </div><!-- /.col-->
        </div><!-- ./row -->
    </section><!-- /.content -->
 </div>

