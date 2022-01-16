<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<div class="account-section  universal-spacing universal-bg-white">
    <div class="container">
        <div class="account-section-inner">
		   <?php  if($loginId) $this->load->view('elements/my-account-menu');?>
            <div class="row">
                <div class="col-md-6">
                    <div class="account-area">
                        <div class="shipping-area-title universal-dark-title">
                            <?php if ($loginId) { ?>
                                <span>
                                <?php
                                if($language_name=='French'){ ?>
                                  Changez votre mot de passe
                                <?php }else{ ?>
                                  Change Your Password
                                <?php
                                }?></span>
                              <?php
                            } else { ?>
                                <span>
                                    <?php
                                    if($language_name=='French'){ ?>
                                      Mot de passe oublié
                                    <?php }else{ ?>
                                      Forget Password
                                    <?php
                                    }?>
                              <?php
                            }
                            ?>
                        </div>
                        <form id="password-form" method="post">
                          <div class="customer-fields pad-for-span" style="min-height: initial;">
              				<div id="forgot_msg" class="col-md-12 text-center"></div>
                          </div>
                            <div class="shipping-form">
                                <div class="single-review">
                                    <label>
                                    <?php
                                    if($language_name=='French'){ ?>
                                      Adresse électronique:
                                    <?php }else{ ?>
                                      Email Address:
                                    <?php
                                    }?></label>
                                    <input type="email" name="account_email" id="account-email" value="<?php echo $loginEmail ?? '' ?>" <?php echo $loginEmail  ? 'readonly' : '' ?>>
                                    <label id="account-email-error" style="color:red"></label>
                                    <input type="hidden" name="send_otp" id="send-otp" value="">
                                </div>
								 <div class="single-review">
								     <div class="g-recaptcha" data-sitekey="6LcXjt4UAAAAAMf-gtro8dDUsHGFBOtpfePKAifa"></div>
									 <label id="g-recaptcha-error" style="color:red"></label>

								 </div>
                                <div class="order-btn login-btn">
                                    <button type="button" class="login" id="account-change-pswd" onclick="sendOptToEmail()">
                                    <?php
                                    if($language_name=='French'){ ?>
                                      Continuer
                                    <?php }else{ ?>
                                      Continue
                                    <?php
                                    }?></button>
                                </div>

                                <div class="change-pswd-field-show"  style="display:none;" id="otp-container">
                                    <div class="single-review">
                                        <label>
                                            <?php
                                            if($language_name=='French'){ ?>
                                              Entrez OTP
                                            <?php }else{ ?>
                                              Enter OTP
                                            <?php
                                            }?> <span class="text-danger">  *</span></label>
                                        <input type="text" name="input_otp" id="input-otp" placeholder="Enter Otp" maxlength="6">
                                        <label id="input-otp-error" style="color:red"></label>
                                    </div>
                                    <div class="single-review">
                                        <label>
                                            <?php
                                            if($language_name=='French'){ ?>
                                              Definir un nouveau mot de passe
                                            <?php }else{ ?>
                                              Set New Password
                                            <?php
                                            }?> <span class="text-danger">  *</span> </label>
                                        <input type="password" placeholder="Set Password" name="new_password" id="new-password" maxlength="20"  minlength="8">
                                        <label id="new-password-error" style="color:red"></label>
                                    </div>
                                    <div class="order-btn">
                                        <button type="submit" id="Fsubmit">
                                        <?php
                                        if($language_name=='French'){ ?>
                                          Soumettre
                                        <?php }else{ ?>
                                          Submit
                                        <?php
                                        }?></button>
                                    </div>
                                </div>
                            </div>
                      </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

