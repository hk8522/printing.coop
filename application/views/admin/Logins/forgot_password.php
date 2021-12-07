<div class="login-section" style="background-image: url('<?php echo $BASE_URL;?>assets/admin/images/summer_bg.jpg');">
    <div class="login-box">
        <div class="login-box-spacing">
            <div class="logo">
                <img src="<?php echo $BASE_URL;?>assets/admin/images/printing.coopLogo.png">
            </div>
            <div class="login-field-section">
                <!--<div class="login-logo">
                    <!--<span><?php echo WEBSITE_NAME;?></span>-
                </div>-->
				
				<div class="text-center" style="color:red">
				<?php echo $this->session->flashdata('message_error');?></div>
				<div class="text-center" style="color:green">
				<?php echo $this->session->flashdata('message_success');?>
				</div>
				<?php echo form_open_multipart('',array('class'=>'form-horizontal'));?>
                    <div class="login-fields">
                        <input type="email" placeholder="Enter Email Id" name="email" >
						<?php echo form_error('email');?>
                        <button type="submit" name="login">Submit</button>
                    </div>
					
				<?php echo form_close();?>
            </div>
            <div class="forgot-password">
                <span><a href="<?php echo $BASE_URL;?>pcoopadmin">Back  To Login</a></span>
            </div>
        </div>
    </div>
</div>