<?php include("header.php"); ?>

<div class="page-title-section universal-bg-white">
    <div class="container">
        <div class="page-title-section-inner universal-half-spacing">
            <div class="inner-breadcrum">
                <a href="index.php">Home</a>
                /
                <span class="current">Forgot Password</span>
            </div>
        </div>
    </div>
</div>

<div class="login-section universal-spacing universal-bg-white">
    <div class="container">
        <div class="login-section-inner">
            <div class="row justify-content-center">
                <div class="col-md-5">
                    <div class="login-area">
                        <div class="universal-dark-title">
                            <span>Change Your Password</span>
                        </div>
                        <div class="shipping-form">
                            <div class="single-review">
                                <label>Mobile/Email Address:</label>
                                <input type="text" name="forgot-pass-username">
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
                </div>
            </div>
        </div>
    </div>
</div>

<?php include("footer.php"); ?>