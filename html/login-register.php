<?php include("header.php"); ?>

<div class="page-title-section universal-bg-white">
    <div class="container">
        <div class="page-title-section-inner universal-half-spacing">
            <div class="inner-breadcrum">
                <a href="index.php">Home</a>
                /
                <span class="current">Login/Register</span>
            </div>
        </div>
    </div>
</div>

<div class="login-section universal-spacing universal-bg-white">
    <div class="container">
        <div class="login-section-inner">
            <div class="row">
                <div class="col-md-5">
                    <div class="login-area">
                        <div class="universal-dark-title">
                            <span>Login to your Account</span>
                        </div>
                        <div class="universal-dark-info">
                            <span>If you have an account, sign in with your email address.</span>
                        </div>
                        <div class="shipping-form">
                            <div class="single-review">
                                <label>Email Address:</label>
                                <input type="text" name="login-username">
                            </div>
                            <div class="single-review">
                                <label>Password:</label>
                                <input type="password" name="login-password">
                            </div>
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <div class="login-btn">
                                        <button type="submit">Login</button>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="forgot-password">
                                        <a href="forgot-password.php">Forgot password?</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="register-area">
                        <div class="universal-dark-title">
                            <span>New Customers</span>
                        </div>
                        <div class="universal-dark-info">
                            <span>Creating an account has many benefits: check out faster, keep more than one address, track orders and more.</span>
                        </div>
                        <div class="shipping-form">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="single-review">
                                        <label>Your First Name *</label>
                                        <input type="text" name="register-form-name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="single-review">
                                        <label>Your Last Name *</label>
                                        <input type="text" name="register-form-last-name">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="single-review">
                                        <label>Your Email Address *</label>
                                        <input type="text" name="register-form-email">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="single-review">
                                        <label>Choose Password *</label>
                                        <input type="text" name="register-form-password">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="single-review">
                                        <label>Re-enter Password *</label>
                                        <input type="text" name="register-form-re-password">
                                    </div>
                                </div>
                            </div>
                            <div class="login-btn">
                                <button type="submit">Register Now</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include("footer.php"); ?>