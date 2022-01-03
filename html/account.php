<?php include("header.php"); ?>

<div class="page-title-section universal-bg-white">
    <div class="container">
        <div class="page-title-section-inner universal-half-spacing">
            <div class="inner-breadcrum">
                <a href="index.php">Home</a>
                /
                <span class="current">Account</span>
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
                    <span>Your Personal Details</span>
                </div>
                <div class="shipping-form">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="single-review">
                                <label>Your Name *</label>
                                <input type="text" name="shipping-form-name">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="single-review">
                                <label>Your Last Name *</label>
                                <input type="text" name="shipping-form-last-name">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="single-review">
                                <label>Your Email Address *</label>
                                <input type="text" name="shipping-form-email">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="single-review">
                                <label>Your Phone *</label>
                                <input type="text" name="shipping-form-phone">
                            </div>
                        </div>
                    </div>
                    <div class="order-btn">
                        <button type="submit">Continue</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include("footer.php"); ?>