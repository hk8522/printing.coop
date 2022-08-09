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
                             <input class="form-control" name="id" type="hidden"  value="<?= isset($postData['id']) ? $postData['id']:'' ?>" id="product_id">
                            <div class="row">
                                <div class="control-group info col-sm-6">
                                    <label class="span2" for="inputMame">First Name</label>
                                    <div class="controls">
                                        <input class="form-control" name="fname" id="fname" type="text" placeholder="First Name" value="<?= isset($postData['fname']) ? $postData['fname']:'' ?>" maxlength="50">
                                        <?= form_error('fname') ?>
                                    </div>
                                </div>

                                <div class="control-group info col-sm-6">
                                    <label class="span2" for="inputMame">Last Name</label>
                                    <div class="controls">
                                        <input class="form-control" name="lname" id="lname" type="text" placeholder="Last Name" value="<?= isset($postData['lname']) ? $postData['lname']:'' ?>" maxlength="50">
                                        <?= form_error('lname') ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="control-group info col-sm-6">
                                    <label class="span2" for="inputMame">Mobile Number</label>
                                    <div class="controls">
                                        <input class="form-control" name="mobile" id="mobile" type="text" placeholder="Mobile Number" value="<?= isset($postData['mobile']) ? $postData['mobile']:'' ?>" maxlength="50">
                                        <?= form_error('mobile') ?>
                                    </div>
                                </div>
                                <div class="control-group info col-sm-6">
                                    <label class="span2" for="inputMame">Email Id</label>
                                    <div class="controls">
                                        <input class="form-control" name="email" id="email" type="text" placeholder="Email Id" value="<?= isset($postData['email']) ? $postData['email']:'' ?>" maxlength="50">
                                        <?= form_error('email') ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="control-group info col-sm-12">
                                    <label class="span2" for="inputMame">Password</label>
                                    <div class="controls">
                                        <input class="form-control" name="password" id="password"
                                        type="password" placeholder="Password" value="" maxlength="50">
                                        <?= form_error('password') ?>
                                    </div>
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

