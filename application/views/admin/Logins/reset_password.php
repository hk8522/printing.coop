<div class="login-section" style="background-image: url('<?= $BASE_URL ?>assets/admin/images/summer_bg.jpg');">
    <div class="login-box">
        <div class="login-box-spacing">
            <div class="logo">
                <img src="<?= $BASE_URL ?>assets/admin/images/printing.coopLogo.png">
            </div>
            <div class="login-field-section">
                <!--<div class="login-logo">
                    <span><?= WEBSITE_NAME ?></span>
                </div>-->
                <div class="text-center" style="color:red">
                <?= $this->session->flashdata('message_error') ?></div>
                <div class="text-center" style="color:green">
                <?= $this->session->flashdata('message_success') ?>
                </div>
                <?= form_open_multipart('',array('class' => 'form-horizontal')) ?>
                    <div class="login-fields">
                        <input type="password" placeholder="New Password" name="password">

                        <?= form_error('password') ?>
                    </div>
                    <div class="login-fields">
                        <input type="password" placeholder="Re Enter Password" name="passconf">
                        <?= form_error('passconf') ?>

                        <button type="submit" name="login">Submit</button>
                    </div>

                <?= form_close() ?>
            </div>
            <div class="forgot-password">
                <span><a href="<?= $BASE_URL ?>pcoopadmin">Back  To Login</a></span>
            </div>
        </div>
    </div>
</div>
