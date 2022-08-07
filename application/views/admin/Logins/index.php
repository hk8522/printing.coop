<div class="login-section" style="background-image: url('<?= $BASE_URL ?>assets/admin/images/69e89dcc83ef49118e39006936c7e0dc.jpg');">
    <div class="login-box">
        <div class="login-box-spacing">
            <div class="logo">
                <img src="<?= $BASE_URL ?>assets/admin/images/printing.coopLogo.png">
            </div>
            <div class="login-field-section">
                <div class="text-center" style="color:red">
                <?= $this->session->flashdata('message_error') ?></div>
                <div class="text-center" style="color:green">
                <?= $this->session->flashdata('message_success') ?>
                </div>

                <?= form_open('',array()) ?>
                    <div class="login-fields">
                        <input type="text" placeholder="Username" name="username">
                        <?= form_error('username') ?>
                        <input type="password" placeholder="Password" name="password">
                        <?= form_error('password') ?>
                        <div class="login-btn">
                            <button type="submit" name="login">Login</button>
                        </div>
                    </div>
                <?= form_close() ?>
            </div>
            <div class="forgot-password">
                <span><a href="<?= $BASE_URL ?>pcoopadmin/forgot-password">Forgot Password?</a></span>
            </div>
        </div>
    </div>
</div>
