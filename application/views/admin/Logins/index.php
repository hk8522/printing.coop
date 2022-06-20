<div class="login-section" style="background-image: url('<?php echo $BASE_URL;?>assets/admin/images/69e89dcc83ef49118e39006936c7e0dc.jpg');">
    <div class="login-box">
        <div class="login-box-spacing">
            <div class="logo">
                <img src="<?php echo $BASE_URL;?>assets/admin/images/printing.coopLogo.png">
            </div>
            <div class="login-field-section">
                <div class="text-center" style="color:red">
                <?php echo $this->session->flashdata('message_error');?></div>
                <div class="text-center" style="color:green">
                <?php echo $this->session->flashdata('message_success');?>
                </div>

                <?php echo form_open('',array());?>
                    <div class="login-fields">
                        <input type="text" placeholder="Username" name="username">
                        <?php echo form_error('username');?>
                        <input type="password" placeholder="Password" name="password">
                        <?php echo form_error('password');?>
                        <div class="login-btn">
                            <button type="submit" name="login">Login</button>
                        </div>
                    </div>
                <?php echo form_close();?>
            </div>
            <div class="forgot-password">
                <span><a href="<?php echo $BASE_URL;?>pcoopadmin/forgot-password">Forgot Password?</a></span>
            </div>
        </div>
    </div>
</div>
