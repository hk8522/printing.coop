<div class="login-section universal-spacing universal-bg-white">
    <div class="container">
        <div class="login-section-inner">
            <div class="row justify-content-center">
                <div class="col-md-5">
                    <?php
                    if ($language_name == 'French'){ ?>
                    <div class="login-area">
                        <div class="universal-dark-title">
                            <span>Récupérez votre mot de passe</span>
                        </div>
                        <div class="universal-dark-info">
                            <span>Saisissez votre email ci-dessous. Nous vous enverrons un lien pour réinitialiser votre mot de passe.</span>
                        </div>
                        <div class="shipping-form">
                            <div class="single-review">
                                <label>Adresse électronique: </label>
                                <input type="text" name="forgot-pass-username" >
                            </div>
                            <div class="change-pswd-field-show" style="display: none;">
                                <div class="resend-otp">
                                    <span style="padding-top: 0px;">OTP envoyé au mobile</span>
                                    <span style="padding-top: 0px;" class="for-resend-otp">Renvoyer?</span>
                                </div>
                                <div class="single-review">
                                    <label>Entrez OTP</label>
                                    <input type="text" name="forgot-pass-otp">
                                </div>
                                <div class="single-review">
                                    <label>Définir le mot de passe</label>
                                    <input type="text" name="forgot-pass-password">
                                </div>
                            </div>
                            <div class="login-btn">
                                <button type="submit" id="account-change-pswd">Continuer</button>
                            </div>
                        </div>
                    </div>
                    <?php }else{ ?>
                    <div class="login-area">
                        <div class="universal-dark-title">
                            <span>Retrieve your password here</span>
                        </div>
                        <div class="universal-dark-info">
                            <span>Please enter your email address below. You will receive a link to reset your password.</span>
                        </div>
                        <div class="shipping-form">
                            <div class="single-review">
                                <label>Email Address:</label>
                                <input type="text" name="forgot-pass-username" >
                            </div>
                            <div class="change-pswd-field-show" style="display: none;">
                                <div class="resend-otp">
                                    <span style="padding-top: 0px;">OTP sent to Mobile</span>
                                    <span style="padding-top: 0px;" class="for-resend-otp">Resend?</span>
                                </div>
                                <div class="single-review">
                                    <label>Enter OTP</label>
                                    <input type="text" name="forgot-pass-otp">
                                </div>
                                <div class="single-review">
                                    <label>Set Password</label>
                                    <input type="text" name="forgot-pass-password">
                                </div>
                            </div>
                            <div class="login-btn">
                                <button type="submit" id="account-change-pswd">Continue</button>
                            </div>
                        </div>
                    </div>
                    <?php
                    }?>
                </div>
            </div>
        </div>
    </div>
</div>
