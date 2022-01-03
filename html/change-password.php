<?php include("header.php"); ?>

<div class="page-title-section universal-bg-white">
    <div class="container">
        <div class="page-title-section-inner universal-half-spacing">
            <div class="inner-breadcrum">
                <a href="index.php">Home</a>
                /
                <span class="current">Change Password</span>
            </div>
        </div>
    </div>
</div>

<div class="account-section universal-spacing universal-bg-white">
    <div class="container">
        <div class="account-section-inner">
            <?php include("account-points.php"); ?>
            <div class="account-area">
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
                    <div class="order-btn">
                        <button type="submit" id="account-change-pswd">Continue</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include("footer.php"); ?>