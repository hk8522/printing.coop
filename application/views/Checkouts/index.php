<?php
    $stap = base64_decode($stap);
    if ($stap == 1) {
        $stap1Title = $language_name == 'French' ? 'Identifiez-vous ou inscrivez-vous' : 'Login Or Signup';
        $stap2Title = $language_name == 'French' ? 'Adresse de livraison' : 'Shipping Address';
        $stap3Title = $language_name == 'French' ? 'méthodes de livraison' : 'Shipping Methods';
        $stap4Title = $language_name == 'French' ? 'Options de paiement' : 'Payment Options';
        $stap1Open = true;
        $stap2Open = false;
        $stap3Open = false;
        $stap4Open = false;
    } elseif ($stap == 2) {
        $stap1Title = $language_name == 'French' ? 'Sidentifier <i class="fa fa-check" aria-hidden="true" style="color:green;"></i>' : 'Login <i class="fa fa-check" aria-hidden="true" style="color:green;"></i>';
        $stap2Title = $language_name == 'French' ? 'Adresse de livraison' : 'Shipping Address';
        $stap3Title = $language_name == 'French' ? 'méthodes de livraison' : 'Shipping Methods';
        $stap4Title = $language_name == 'French' ? 'Options de paiement' : 'Payment Options';
        $stap1Open = false;
        $stap2Open = true;
        $stap3Open = false;
        $stap4Open = false;
    } elseif ($stap == 3) {
        $stap1Title = $language_name == 'French' ? 'Sidentifier <i class="fa fa-check" aria-hidden="true" style="color:green;"></i>' : 'Login <i class="fa fa-check" aria-hidden="true" style="color:green;"></i>';
        $stap2Title = $language_name == 'French' ? 'Adresse de livraison <i class="fa fa-check" aria-hidden="true" style="color:green;"></i>' : 'Shipping Address <i class="fa fa-check" aria-hidden="true" style="color:green;"></i>';
        $stap3Title = $language_name == 'French' ? 'méthodes de livraison' : 'Shipping Methods';
        $stap4Title = $language_name == 'French' ? 'Options de paiement' : 'Payment Options';
        $stap1Open = false;
        $stap2Open = false;
        $stap3Open = true;
        $stap4Open = false;
    } elseif ($stap == 4) {
        $stap1Open = false;
        $stap2Open = false;
        $stap3Open = false;
        $stap4Open = true;
        $stap1Title = $language_name == 'French' ? 'Sidentifier <i class="fa fa-check" aria-hidden="true" style="color:green;"></i>' : 'Login <i class="fa fa-check" aria-hidden="true" style="color:green;"></i>';
        $stap2Title = $language_name == 'French' ? 'Adresse de livraison <i class="fa fa-check" aria-hidden="true" style="color:green;"></i>' : 'Shipping Address <i class="fa fa-check" aria-hidden="true" style="color:green;"></i>';
        $stap3Title = $language_name == 'French' ? 'méthodes de livraison <i class="fa fa-check" aria-hidden="true" style="color:green;"></i>' : 'Shipping Methods <i class="fa fa-check" aria-hidden="true" style="color:green;"></i>';
        $stap4Title = $language_name == 'French' ? 'Options de paiement' : 'Payment Options';
    }
?>
<div class="checkout-section universal-spacing universal-bg-white">
    <div class="container">
        <div class="checkout-section-inner">
            <div class="row">
                <div class="col-md-7">
                    <div class="text-center" style="color:red">
                        <?= $this->session->flashdata('message_error')?>
                    </div>
                    <div class="text-center" style="color:green">
                        <?= $this->session->flashdata('message_success')?>
                    </div><br>
                    <div id="accordion">
                        <div class="card">
                            <div class="card-header <?= $stap == 1 ? '' : 'collapsed'?>" id="heading1" data-toggle="collapse" data-target="#collapse1" aria-expanded="true" aria-controls="collapse1">
                                <div class="universal-dark-title">
                                    <span><?= $stap1Title?></span>
                                    <span style="float:right;"><?= $loginName?></span>
                                </div>
                            </div>
                            <?php if ($stap1Open) { ?>
                                <div id="collapse1" class="collapse show" aria-labelledby="heading1" data-parent="#accordion">
                                    <div class="card-body">
                                        <div class="checkout-select">
                                            <div class="checkout-select-single">

                                            </div>
                                            <div class="checkout-select-single" id="checkoutFormPenal">
                                                <form id="checkoutForm" method="post">
                                                    <div class="shipping-form" id="login-signup-show" style="">
                                                        <div class="single-review">
                                                            <label>
                                                            <?= ($language_name == 'French') ? 'Adresse électronique:' : 'Email Address:'?>
                                                            </label>
                                                            <input type="email" id="ck_moblie_number" maxlength="100" name="ck_moblie_number">
                                                            <label id="ck_moblie_number_error"  class="mt-3"style="color:red"></label>
                                                        </div>
                                                        <div class="login-btn">
                                                            <button type="submit" id="checkoutContinue">
                                                            <?= ($language_name == 'French') ? 'Continuer' : 'Continue'?></button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="checkout-select">
                                            <div class="checkout-select-single" id="signupFormPanel" style="display:none">
                                                <form method="post" id="CksignupForm">
                                                    <label id="login-signup">
                                                        <div class="shipping-form" >
                                                            <div id="ck_signup_msg"></div>
                                                            <div class="single-review">
                                                                <label>
                                                                    <?= ($language_name == 'French') ? 'Adresse électronique:' : 'Email Address:'?>
                                                                </label>
                                                                <input type="email" name="email" id="ck_signup_mobile" maxlength="100">
                                                                <label id="ck_signup_email_error" class="mt-3" style="color:red"></label>
                                                                <input type="hidden" name="signupOtp" id="ck_signupOtp" value="">
                                                                <input type="hidden" name="signupOtpMobile" id="ck_signupOtpMobile" value="">
                                                                <button id="ck-signup-continue" class="register btn btn-warning float-right" type="Button" onclick="cksendOptSignupMobile()"><?= ($language_name == 'French') ? 'Renvoyer' : 'Resend'?></button>
                                                            </div>
                                                            <div class="next-register-fields" style="display:" id="signup-next">
                                                                <div class="single-review">
                                                                    <label><?= ($language_name == 'French') ? 'Entrez le code:' : 'Resend'?></label>
                                                                    <input type="text" placeholder="Enter Code" name="singup_inputOtp" id="ck_singup_inputOtp" maxlength="6">
                                                                    <label id="ck_singup_inputOtp_error" style="color:red"></label><br>
                                                                </div>
                                                                <div class="single-review">
                                                                    <label><?= ($language_name == 'French') ? 'Prénom:' : 'First Name:'?></label>
                                                                    <input type="text" placeholder="First Name" name="fname" id="ck_fname" maxlength="30">
                                                                    <label id="ck_signup_fname_error" style="color:red"></label><br>
                                                                </div>
                                                                <div class="single-review">
                                                                    <label><?= ($language_name == 'French') ? 'Nom de famille:' : 'Last Name:'?></label>
                                                                    <input type="text" placeholder="Last Name" name="lname" maxlength="30" id="ck_lname">
                                                                    <label id="ck_signup_lname_error" style="color:red"></label><br>
                                                                    <input type="hidden" name="email_verification" id="email_verification" value="1">
                                                                </div>
                                                                <div class="single-review">
                                                                    <label><?= ($language_name == 'French') ? 'Définir le mot de passe:' : 'Set Password:'?></label>
                                                                    <input type="password" placeholder="Set Password" name="password" id="ck_signup_password" maxlength="20" minlength="8">
                                                                    <label id="ck_signup_password_error" style="color:red"></label>
                                                                </div>
                                                                <div class="single-review">
                                                                    <label><?= ($language_name == 'French') ? 'Confirmez le mot de passe:' : 'Confirm Password:'?></label>
                                                                    <input type="password" placeholder="Set Password" name="confirm_password" id="ck_signup_confirm_password" maxlength="20" minlength="8">
                                                                    <label id="ck_signup_confirm_password_error" style="color:red"></label>
                                                                </div>
                                                            </div>
                                                            <div class="login-btn">
                                                                <button type="submit" id="signupSubmit"><?= ($language_name == 'French') ? 'S\'inscrire' : 'Signup'?></button>
                                                            </div>
                                                        </div>
                                                    </label>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="checkout-select">
                                            <div class="checkout-select-single" id="LoginFormPenal" style="display:none">
                                                <form method="post" id="CkLoginForm">
                                                    <label id="login-signup">
                                                        <div class="shipping-form" >
                                                            <div id="ck_login_msg"></div>
                                                            <div class="single-review">
                                                                <label><?= ($language_name == 'French') ? 'Adresse électronique:' : 'Email Address:'?></label>
                                                                <input type="email" name="loginemail" id="ck_login_mobile" maxlength="100">
                                                                <label id="ck_login_mobile_error" style="color:red"></label><br>
                                                            </div>
                                                            <div class="single-review">
                                                                <label><?= ($language_name == 'French') ? 'Mot de passe:' : 'Password:'?></label>
                                                                <input type="password" placeholder="Password" name="loginpassword" id="ck_login_password">
                                                                <label id="ck_login_password_error" style="color:red"></label>
                                                            </div>
                                                            <div class="login-btn">
                                                                <button type="submit"  id="ckloginSubmit"><?= ($language_name == 'French') ? 'S\'identifier' : 'Login'?></button>
                                                            </div>
                                                        </div>
                                                    </label>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="card">
                            <div class="card-header <?= $stap == 2 ? '' : 'collapsed'?>" id="heading2" data-toggle="collapse" data-target="#collapse2" aria-expanded="false" aria-controls="collapse2">
                                <div class="universal-dark-title">
                                    <span><?= $stap2Title?></span>
                                    <?php if ($stap > 2) { ?>
                                        <a class="mobile-position" href="<?= $BASE_URL?>Checkouts/index/<?= base64_encode($stap-1)?>/<?= $order_id?>/<?= $product_id?>/<?= $coupon_code?>">
                                            <button class="btn btn-warning button"  style="float:right;" type="button">
                                                <?= ($language_name == 'French') ? 'Changement' : 'Change'?>
                                            </button>
                                        </a>
                                    <?php } ?>
                                </div>
                            </div>
                            <?php if ($stap2Open) { ?>
                                <div id="collapse2" class="collapse show" aria-labelledby="heading2" data-parent="#accordion">
                                    <div class="card-body">
                                        <div class="account-address-area">
                                            <div class="checkout-addresss">
                                                <form action="<?= $BASE_URL?>Checkouts/index/<?= base64_encode($stap)?>/<?= $order_id?>/<?= $product_id?>/<?= $coupon_code?>" method="post">
                                                    <div id="exsiting-address">
                                                        <div id="address-list">
                                                            <?php
                                                            $dispaly = 'none';
                                                            if (!empty($address)) {
                                                                $dispaly = '';
                                                                foreach ($address as $list) {
                                                                    $checked = '';
                                                                    if ($list['default_delivery_address'] == 1) {
                                                                        $checked = 'checked';
                                                                    }
                                                            ?>
                                                                    <div class="email-field-t for-cus-label">
                                                                        <label>
                                                                            <input type="radio" name="delivery_address_id" value="<?= $list['id']?>" <?= $checked?>>
                                                                            <div class="email-text-t">
                                                                                <span class="address-type-name">
                                                                                    <?= ucfirst($list['address_type'])?>
                                                                                    <?= $list['default_delivery_address'] == 1 ? '(Default Delivery Address)' : ''?>
                                                                            </span>
                                                                                <span>
                                                                                    <?= ucfirst($list['name'])?> <?= $list['mobile']?> <?= !empty($list['alternate_phone']) ? ',' . $list['alternate_phone'] : ''?>
                                                                                    <?= !empty($list['company_name']) ? '(' . $list['company_name'] . ')' : ''?>
                                                                            </span>
                                                                                <br>
                                                                                <span class="tt-t"><?= $list['address'] ?>, <?= $list['cityName']?>, <?= $list['StateName']?>, <?= $list['CountryName']?> - <strong><?= $list['pin_code']?></strong></span>
                                                                            </div>
                                                                        </label>
                                                                    </div>
                                                                <?php } ?>
                                                            <?php } ?>
                                                        </div>

                                                        <div class="save-btn" style="display:<?= $dispaly?>" id="Save-and-Deliver-here">
                                                            <button class="save" type="submit"><?= ($language_name == 'French') ? 'Enregistrer et livrer ici' : 'Save and Deliver here'?></button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="checkout-addresss for-cus-new-add">
                                                <label id="new-address">
                                                    <span class="new-c-addr"><i class="las la-plus"></i> <?= ($language_name == 'French') ? 'Nouvelle adresse' : 'New Address'?></span>
                                                </label>
                                                <form method="post" id="checkout-address">
                                                    <div class="delivery-fileds" id="checkout-new-address" style="display: none;">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="single-review">
                                                                    <input type="text" placeholder="First Name*" name="first_name">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="single-review">
                                                                    <input type="text" placeholder="Last Name*" name="last_name">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="single-review">
                                                                    <input type="text" placeholder="Phone Number*" name="mobile">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="single-review">
                                                                    <input type="text" placeholder="Company Name" name="company_name">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="single-review">
                                                                    <textarea style="height:150px;" type="text" placeholder="Address (area &amp; street)*"name="address"></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="single-review">
                                                                    <select name="country" onchange="getState($(this).val())">
                                                                        <?php
                                                                        if ($language_name == 'French') { ?>
                                                                            <option value="">-- Choisissez le pays --</option>
                                                                        <?php } else { ?>
                                                                            <option value="">-- Select Country --</option>
                                                                        <?php } ?>

                                                                        <?php foreach ($countries as $country) {
                                                                            $selected = '';
                                                                            $post_country = isset($postData['country']) ? $postData['country']:'';
                                                                            if ($country['id'] == $post_country) {
                                                                                $selected = 'selected="selected"';
                                                                            }
                                                                            ?>
                                                                            <option value="<?= $country['id']?>" <?= $selected?>><?= $country['name']?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="single-review">
                                                                    <select name="state" id="stateiD" onchange="getCity($(this).val())">
                                                                        <?php
                                                                        if ($language_name == 'French') { ?>
                                                                            <option value="">-- Sélectionnez l'état --</option>
                                                                        <?php } else { ?>
                                                                            <option value="">-- Select State --</option>
                                                                        <?php } ?>

                                                                        <?php foreach ($states as $state) {
                                                                            $selected ='';
                                                                            $post_state = isset($postData['state']) ? $postData['state']:'';
                                                                            if ($state['id'] == $post_state) {
                                                                                $selected = 'selected="selected"';
                                                                            }
                                                                            ?>
                                                                            <option value="<?= $state['id']?>" <?= $selected?>><?= $state['name']?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="single-review">
                                                                    <select name="city" id="cityId">
                                                                        <option value="">-- Select City --</option>
                                                                        <?php foreach ($citys as $city) {
                                                                            $selected = '';
                                                                            $post_city = isset($postData['city']) ? $postData['city'] : '';

                                                                                if ($city['id'] == $post_city) {
                                                                                $selected = 'selected="selected"';
                                                                                }
                                                                            ?>
                                                                        <option value="<?= $city['id']?>" <?= $selected?>><?= $city['name']?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="single-review">
                                                                    <input type="text" placeholder="Zip/Postal Code*" name="pin_code">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="address-type">
                                                                    <div class="single-review">
                                                                        <label><?= ($language_name == 'French') ? 'Type d\'adresse' : 'Address Type'?></label>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <label id="home">
                                                                                <input name="address_type" value="home" for="home" type="radio" checked="">
                                                                                <?= ($language_name == 'French') ? 'Accueil (livraison toute la journée)' : 'Home (All day delivery)'?>
                                                                            </label>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <label id="work">
                                                                                <input name="address_type" value="work" for="work" type="radio">
                                                                                <?= ($language_name == 'French') ? 'Travail (livraison entre 10h et 17h)' : 'Work (Delivery between 10AM - 5PM)'?>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="save-btn login-btn">
                                                                    <button class="save" type="submit" id="save-address">Save</button>
                                                                    <a id="cancel-address">Cancel</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>

                        <div class="card">
                            <div class="card-header <?= $stap == 3 ? '' : 'collapsed'?>" id="heading3" data-toggle="collapse" data-target="#collapse3" aria-expanded="false" aria-controls="collapse3">
                                <div class="universal-dark-title">
                                    <span><?= $stap3Title?></span>
                                    <?php if ($stap > 3) {
                                        $stap_old = $stap - 1;
                                        ?>
                                        <a class="mobile-position" href="<?= $BASE_URL?>Checkouts/index/<?= base64_encode($stap_old)?>/<?= $order_id?>/<?= $product_id?>/<?= $coupon_code ?>">
                                            <button class="btn btn-warning button" style="float:right;" type="button">Change</button>
                                        </a>
                                    <?php } ?>
                                </div>
                            </div>

                            <?php if ($stap3Open) { ?>
                                <div id="collapse3" class="collapse show" aria-labelledby="heading3" data-parent="#accordion">
                                    <div class="card-body">
                                        <div class="shipping_method-fields">
                                            <form action="<?= $BASE_URL?>Checkouts/index/<?= base64_encode($stap)?>/<?= $order_id?>/<?= $product_id?>/<?= $coupon_code?>" method="post">
                                                <?php
                                                    $shipping_method_formate = $ProductOrder['shipping_method_formate'];
                                                ?>

                                                <?php
                                                $upsServiceCode = upsServiceCode();
                                                foreach ($total_charges_ups as $key => $val) {
                                                    $value = 'ups-'.$val->TotalCharges->MonetaryValue . '-' . $val->Service->Code;
                                                ?>
                                                    <div class="shipping-metthod-single">
                                                        <label>
                                                            <input type="radio" name="shipping_method_formate" value="<?= $value?>" <?= $shipping_method_formate == $value ? 'checked' : ''?>>
                                                            <div class="row">
                                                                <div class="col-md-12 col-lg-3 col-xl-2">
                                                                    <strong><?= $product_price_currency_symbol.$val->TotalCharges->MonetaryValue?></strong>
                                                                </div>
                                                                <div class="col-md-9 col-lg-6 col-xl-7 p-0">
                                                                    <span><?= $upsServiceCode[$val->Service->Code]?></span>
                                                                </div>
                                                                <div class="col-md-3 col-lg-3 col-xl-3">
                                                                    <span>UPS</span>
                                                                </div>
                                                            </div>
                                                        </label>
                                                    </div>
                                                <?php } ?>
                                                <?php
                                                foreach ($CanedaPostShiping['list'] as $key => $val) {
                                                    $value = 'canadapost-' . $val['price'] . '-' . $val['service_name'];
                                                ?>
                                                    <div class="shipping-metthod-single">
                                                        <label>
                                                            <input type="radio" name="shipping_method_formate" value="<?= $value?>" <?= $shipping_method_formate == $value ? 'checked' : ''?>>
                                                            <div class="row">
                                                                <div class="col-md-12 col-lg-3 col-xl-2">
                                                                    <strong><?= $product_price_currency_symbol.$val['price']?></strong>
                                                                </div>
                                                                <div class="col-md-9 col-lg-6 col-xl-7 p-0">
                                                                    <span><?= $val['service_name']?></span>
                                                                    <!--<span>Expedited Parcel - Est. Delivery Jan 19, 2020</span>-->
                                                                </div>
                                                                <div class="col-md-3 col-lg-3 col-xl-3">
                                                                    <span><?= ($language_name == 'French') ? 'Postes Canada' : 'Canada Post'?></span>
                                                                </div>
                                                            </div>
                                                        </label>
                                                    </div>
                                                <?php } ?>
                                                <?php
                                                foreach ($FlagShiping as $data) {
                                                    $flag_shiping_cost = $data->rate->price->total;
                                                    $cutumer_shiping_cost = $flag_shiping_cost;
                                                    if ($our_company_shiping_cost == 0 && $our_company_shiping_cost == 0.00) {
                                                        $cutumer_shiping_cost = '0.00';
                                                    } else if ($flag_shiping_cost < $our_company_shiping_cost) {
                                                        $cutumer_shiping_cost = $our_company_shiping_cost;
                                                    }
                                                    $value = 'flagship-' . $cutumer_shiping_cost . '-' . $data->rate->service->courier_code . '-' . $flag_shiping_cost;
                                                ?>
                                                    <div class="shipping-metthod-single">
                                                        <label>
                                                            <input type="radio" name="shipping_method_formate" value="<?= $value?>" <?= $shipping_method_formate==$value ? 'checked' : ''?>>
                                                            <div class="row">
                                                                <div class="col-md-12 col-lg-3 col-xl-2">
                                                                    <strong><?php
                                                                        if ($cutumer_shiping_cost == 0 && $cutumer_shiping_cost == '0.00') {
                                                                            echo $language_name == 'French' ? 'Livraison gratuite' : 'Free Delivery';
                                                                        } else {
                                                                            echo $product_price_currency_symbol . number_format($cutumer_shiping_cost, 2);
                                                                        }
                                                                    ?></strong>
                                                                </div>
                                                                <div class="col-md-9 col-lg-6 col-xl-7 p-0">
                                                                    <span><?= $data->rate->service->courier_name.'<br>'.$data->rate->service->courier_desc?></span>
                                                                </div>
                                                                <div class="col-md-3 col-lg-3 col-xl-3">
                                                                    <span><?= ($language_name == 'French') ? 'Vaisseau amiral' : 'FlagShip'?></span>
                                                                </div>
                                                            </div>
                                                        </label>
                                                    </div>
                                                <?php } ?>
                                                <?php
                                                if ($ProductOrder['provider_product_count'] == 0) {
                                                    foreach ($PickupStoresList as $key => $val) {
                                                        $value='pickupinstore-0.00-' . $val['id'];
                                                    ?>
                                                        <div class="shipping-metthod-single">
                                                            <label>
                                                                <input type="radio" name="shipping_method_formate" value="<?= $value?>" <?= $shipping_method_formate==$value ? 'checked' : ''?>>
                                                                <div class="row">
                                                                    <div class="col-md-12 col-lg-12 col-xl-2">
                                                                        <strong><?= ($language_name == 'French') ? 'Livraison gratuite' : 'Free Delivery'?></strong>
                                                                    </div>
                                                                    <div class="col-md-8 col-lg-7 col-xl-7 p-0">
                                                                        <span><?= $val['name']?></span><br>
                                                                        <span><?= $val['address']?></span><br>
                                                                        <span><?= $val['phone']?></span>
                                                                    </div>
                                                                    <div class="col-md-4 col-lg-5 col-xl-3">
                                                                        <span><?= ($language_name == 'French') ? 'Ramassage en magasin' : 'Pickup In Store'?></span>
                                                                    </div>
                                                                </div>
                                                            </label>
                                                        </div>
                                                    <?php }
                                               } ?>

                                                <div class="save-btn">
                                                    <button class="save" type="submit">
                                                    <?= ($language_name == 'French') ? 'Enregistrer la méthode d\'expédition' : 'Save Shipping Method'?></button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                        <form action="<?= $BASE_URL?>Checkouts/SubmitOrder" id="place-order-form" method="post">
                            <input type="hidden" name="order_id" value="<?= base64_decode($order_id)?>">
                            <div class="card">
                                <div class="card-header <?= $stap == 4 ? '' : 'collapsed'?>" id="heading4" data-toggle="collapse" data-target="#collapse4" aria-expanded="false" aria-controls="collapse4">
                                    <div class="universal-dark-title">
                                        <span><?= $stap4Title?></span>
                                    </div>
                                </div>
                                <?php
                                if ($stap4Open) { ?>
                                    <div id="collapse4" class="collapse show" aria-labelledby="heading4" data-parent="#accordion">
                                        <div class="card-body">
                                            <div class="payment-sections">
                                                <div id="accordion1">
                                                    <div class="card">
                                                        <div class="card-header" id="headingPay3" data-toggle="collapse" data-target="#collapsePay3" aria-expanded="false" aria-controls="collapsePay3">
                                                            <label class="main-input" for="3payment">
                                                                <input name="payment_type" value="paypal" type="radio" id="3payment" checked>
                                                                <?= ($language_name == 'French') ? 'Pay Pal' : 'Paypal'?>
                                                            </label>
                                                        </div>
                                                        <div id="collapsePay3" class="collapse show" aria-labelledby="headingPay3" data-parent="#accordion1" style="">
                                                            <div class="payment-option">
                                                                <div class="order-confirm-text">
                                                                    <span><?= ($language_name == 'French') ? 'Vous serez redirigé vers la page Paypal' : 'You\'ll be redirected to Paypal page'?></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- POS CHECKOUT -->
                                                    <div class="card pos">
                                                        <div class="card-header" id="headingPay4" data-toggle="collapse" data-target="#collapsePay4" aria-expanded="false" aria-controls="collapsePay4">
                                                            <label class="main-input" for="4payment">
                                                                <input name="payment_type" value="pos" type="radio" id="4payment">
                                                                <?= ($language_name == 'French') ? 'POS' : 'POS'?>
                                                            </label>
                                                        </div>
                                                        <div id="collapsePay4" class="collapse" aria-labelledby="headingPay4" data-parent="#accordion1" style="">
                                                            <div class="payment-option">
                                                                <div class="order-confirm-text">
                                                                    <input type="hidden" id="ExpMonth" name="ExpMonth">
                                                                    <input type="hidden" id="ExpYear" name="ExpYear">
                                                                    <!-- card form -->
                                                                    <p class="heading">PAYMENT DETAILS</p>
                                                                    <div class="card-details">
                                                                        <div class="row">
                                                                            <div class="col-md-6 form-group">
                                                                                <p class="text-warning">Card Number</p> <input type="text" name="card-num" placeholder="1234 5678 9012 3457" id="CardNumber" size="20" minlength="19" maxlength="19">
                                                                            </div>
                                                                            <div class="col-md-3 form-group">
                                                                                <p class="text-warning">Expiration</p> <input type="text" id="ExpDate" placeholder="MM/YY" size="5" minlength="5" maxlength="5">
                                                                            </div>
                                                                            <div class="col-md-3">
                                                                                <p class="text-warning">Cvv</p> <input type="password" name="cvv" id="cvv" placeholder="&#9679;&#9679;&#9679;" size="1" minlength="3" maxlength="3">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- card form end -->
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- POS CHECKOUT END -->
                                                </div>
                                            </div>
                                            <div class="order-btn text-right">
                                                <button type="submit"><?= ($language_name == 'French') ? 'Passer la commande' : 'Place Order'?></button>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-5">
                    <?php if (!empty($ProductOrderItem)) { ?>
                        <div>
                            <div class="order-area">
                                <div class="universal-dark-title">
                                    <span><?= ($language_name == 'French') ? 'Vos commandes' : 'Your Orders'?></span>
                                </div>
                                <table class="shop-cart-table">
                                    <tbody>
                                        <?php foreach ($ProductOrderItem as $item) {
                                            $product_id = $item['product_id'];

                                            $Product = $this->Product_Model->getProductList($product_id);

                                            $cart_images = json_decode($item['cart_images'], true);

                                            if ($item['provider_product_id']) {
                                                $attribute_ids = sina_options_map($item['attribute_ids']);
                                            } else {
                                                $attribute_ids = json_decode($item['attribute_ids'], true);
                                            }

                                            $product_size = json_decode($item['product_size'], true);

                                            $product_width_length = json_decode($item['product_width_length'], true);

                                            $page_product_width_length = json_decode($item['page_product_width_length'], true);
                                            $product_depth_length_width = json_decode($item['product_depth_length_width'], true);

                                            $votre_text = $item['votre_text'];

                                            $recto_verso = $recto_verso_french = $item['recto_verso'];

                                            //$recto_verso=$item['options']['recto_verso'];
                                            //$recto_verso_french=$item['options']['recto_verso_french'];

                                            //$AttributesData=$this->Product_Model->getProductAttributesByItemIdFrontEnd($product_id);
                                        ?>
                                            <tr>
                                                <td class="product-thumbnail">
                                                    <a href="<?= $BASE_URL ?>Products/view/<?= base64_encode($item['id'])?>" target="_blank">
                                                        <?php $imageurl = getProductImage($item['product_image']);?>
                                                        <img src="<?= $imageurl?>">
                                                    </a>
                                                </td>
                                                <td class="product-name">
                                                    <a href="<?= $BASE_URL?>Products/view/<?= base64_encode($item['id'])?>" target="_blank">
                                                        <?php if ($language_name == 'French') {
                                                            echo ucfirst($Product['name_french']);
                                                        } else {
                                                            echo ucfirst($Product['name']);
                                                       } ?>
                                                    </a>
                                                    <div class="row align-items-center">
                                                        <div class="col-md-6 text-left">
                                                            <div class="product-subtotal text-left">
                                                                <span><?= ($language_name == 'French') ? 'Combien d\'ensembles:' : 'How many sets:'?><?= $item['quantity']?></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 text-right">
                                                            <div class="product-subtotal text-right">
                                                                <span><?= $product_price_currency_symbol.number_format($item['price'], 2)?></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 text-right">
                                                            <div class="product-subtotal text-right">
                                                                <span><?= $product_price_currency_symbol.number_format($item['price']*$item['quantity'], 2)?></span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="product-name-detail">
                                                        <div class="row">
                                                            <?php if (!empty($product_width_length)) { ?>
                                                                <div class="col-md-12 col-lg-12 col-xl-6">
                                                                    <span><strong><?= ($language_name == 'French') ? 'Longueur(pouces)' : 'Length(Inch)'?>: <?= $product_width_length['product_length']?></strong></span>
                                                                </div>
                                                                <div class="col-md-12 col-lg-12 col-xl-6">
                                                                    <span><strong> <?= ($language_name == 'French') ? 'Largeur (pouces)' : 'Width(Inch)'?>: <?= $product_width_length['product_width']?></strong></span>
                                                                </div>
                                                                <?php if (!empty($product_width_length['length_width_color_show'])) { ?>
                                                                    <div class="col-md-6">
                                                                        <span><strong><?php
                                                                            if ($language_name == 'French') {
                                                                                echo 'Couleursv:'.$product_width_length['length_width_color_french'];
                                                                            } else {
                                                                                echo 'Colors:'.$product_width_length['length_width_color'];
                                                                            }
                                                                        ?></strong></span>
                                                                    </div>
                                                                <?php } ?>
                                                                <?php if (!empty($product_width_length['product_total_page'])) { ?>
                                                                    <div class="col-md-12 col-lg-12 col-xl-6">
                                                                        <span><strong> <?= ($language_name == 'French') ? 'Quantité' : 'Quantity'?>: <?= $product_width_length['product_total_page']?></strong></span>
                                                                    </div>
                                                                <?php } ?>
                                                            <?php } ?>

                                                            <?php if (!empty($product_depth_length_width)) { ?>
                                                                <div class="col-md-12 col-lg-12 col-xl-6">
                                                                    <span><strong><?= ($language_name == 'French') ? 'Longueur (pouces)' : 'Length(Inch)'?>: <?= $product_depth_length_width['product_depth_length']?></strong></span>
                                                                </div>
                                                                <div class="col-md-12 col-lg-12 col-xl-6">
                                                                    <span><strong> <?= ($language_name == 'French') ? 'Largeur (pouces)' : 'Width(Inch)'?>: <?= $product_depth_length_width['product_depth_width']?></strong></span>
                                                                </div>
                                                                <div class="col-md-12 col-lg-12 col-xl-6">
                                                                    <span><strong> <?= ($language_name == 'French') ? 'Profondeur (pouces)' : 'Depth(Inch)'?>: <?= $product_depth_length_width['product_depth']?></strong></span>
                                                                </div>
                                                                <?php if (!empty($product_depth_length_width['depth_color_show'])) { ?>
                                                                    <div class="col-md-12 col-lg-12 col-xl-6">
                                                                        <span><strong><?php
                                                                            if ($language_name == 'French') {
                                                                                    echo 'Couleursv:'.$product_depth_length_width['depth_color_french'];
                                                                            } else {
                                                                                echo 'Colors:'.$product_depth_length_width['depth_color'];
                                                                            }
                                                                        ?></strong></span>
                                                                    </div>
                                                                <?php } ?>
                                                                <?php if (!empty($product_depth_length_width['product_depth_total_page'])) { ?>
                                                                    <div class="col-md-12 col-lg-12 col-xl-6">
                                                                        <span><strong> <?= ($language_name == 'French') ? 'Quantité' : 'Quantity'?>: <?= $product_depth_length_width['product_depth_total_page']?></strong></span>
                                                                    </div>
                                                                <?php } ?>
                                                            <?php } ?>
                                                            <?php if (!empty($page_product_width_length)) { ?>
                                                                <div class="col-md-12 col-lg-12 col-xl-6">
                                                                    <span><strong><?= ($language_name == 'French') ? 'Longueur (pouces)' : 'Length(Inch)'?>: <?= $page_product_width_length['page_product_length']?></strong></span>
                                                                </div>
                                                                <div class="col-md-12 col-lg-12 col-xl-6">
                                                                    <span><strong><?= ($language_name == 'French') ? 'Largeur(pouces)' : 'Width(Inch)'?>: <?= $page_product_width_length['page_product_width']?></strong></span>
                                                                </div>

                                                                <?php if (!empty($page_product_width_length['page_length_width_color_show'])) { ?>
                                                                    <div class="col-md-12 col-lg-12 col-xl-6">
                                                                        <span><strong><?php
                                                                            if ($language_name == 'French') {
                                                                                echo 'Couleursv:'.$page_product_width_length['page_length_width_color_french'];
                                                                            } else {
                                                                                echo 'Colors:'.$page_product_width_length['page_length_width_color'];
                                                                            }
                                                                        ?></strong></span>
                                                                    </div>
                                                                <?php } ?>
                                                                <?php if (!empty($page_product_width_length['page_product_total_page'])) { ?>
                                                                    <div class="col-md-12 col-lg-12 col-xl-6">
                                                                        <span><strong><?php
                                                                            if ($language_name == 'French') {
                                                                                echo 'Des pages:'.$page_product_width_length['page_product_total_page_french'];
                                                                            } else {
                                                                                echo 'Pages:'.$page_product_width_length['page_product_total_page'];
                                                                            }
                                                                        ?></strong></span>
                                                                    </div>
                                                                <?php } ?>
                                                                <?php if (!empty($page_product_width_length['page_product_total_sheets'])) { ?>
                                                                    <div class="col-md-12 col-lg-6 col-xl-6">
                                                                        <span><strong><?php
                                                                            if ($language_name == 'French') {
                                                                                echo ' Feuille par bloc:'.$page_product_width_length['page_product_total_sheets_french'];
                                                                            } else {
                                                                                echo 'Sheet Per Pad:'.$page_product_width_length['page_product_total_sheets'];
                                                                            }
                                                                        ?></strong></span>
                                                                    </div>
                                                                <?php } ?>
                                                                <?php if (!empty($page_product_width_length['page_product_total_quantity'])) { ?>
                                                                    <div class="col-md-12 col-lg-6 col-xl-6">
                                                                        <span><strong><?php
                                                                            if ($language_name == 'French') {
                                                                                echo 'Quantité:'.$page_product_width_length['page_product_total_quantity'];
                                                                            } else {
                                                                                echo 'Quantity:'.$page_product_width_length['page_product_total_quantity'];
                                                                            }
                                                                        ?></strong></span>
                                                                    </div>
                                                                <?php } ?>
                                                            <?php } ?>
                                                            <?php
                                                            if (!empty($product_size)) {
                                                                if ($language_name == 'French') {
                                                                    $size_name = $product_size['product_size_french'] ?? '';
                                                                    $label_qty = $product_size['product_quantity_french'] ?? '';
                                                                } else {
                                                                    $size_name = $product_size['product_size'] ?? '';
                                                                    $label_qty = $product_size['product_quantity'] ?? '';
                                                                }

                                                                $attribute = isset($product_size['attribute']) ? $product_size['attribute'] : '';
                                                                if ($label_qty) { ?>
                                                                    <div class="col-md-12 col-lg-6 col-xl-6">
                                                                        <span><strong><?= ($language_name == 'French') ? 'Quantité' : 'Quantity'?> : <?= $label_qty?></strong></span>
                                                                    </div>
                                                                <?php
                                                                }
                                                                if ($size_name) { ?>
                                                                    <div class="col-md-12 col-lg-6 col-xl-6">
                                                                        <span><strong><?= ($language_name == 'French') ? 'Taille' : 'Size'?>: <?= $size_name?></strong></span>
                                                                    </div>
                                                                <?php
                                                                }
                                                                if ($attribute) {
                                                                    foreach ($attribute as $akey => $aval) {
                                                                        $multiple_attribute_name = $aval['attributes_name'];
                                                                        $multiple_attribute_item_name = $aval['attributes_item_name'];

                                                                        if ($language_name == 'French') {
                                                                            $multiple_attribute_name = $aval['attributes_name_french'];
                                                                            $multiple_attribute_item_name = $aval['attributes_item_name_french'];
                                                                        }
                                                                ?>
                                                                        <div class="col-md-12 col-lg-6 col-xl-6">
                                                                            <span><strong><?= $multiple_attribute_name . ':' . $multiple_attribute_item_name?></strong></span>
                                                                        </div>
                                                                    <?php }
                                                                }
                                                            }

                                                            foreach ($attribute_ids as $key => $val) {
                                                                if ($language_name == 'French') {
                                                                    $attribute_name = $val['attribute_name_french'];
                                                                    $item_name = $val['item_name_french'];
                                                                } else {
                                                                    $attribute_name = $val['attribute_name'];
                                                                    $item_name = $val['item_name'];
                                                                }
                                                                ?>
                                                                <div class="col-md-12 col-lg-6 col-xl-6">
                                                                    <span><strong><?= $attribute_name?>: <?= $item_name?></strong></span>
                                                                </div>
                                                            <?php } ?>

                                                            <?php if (!empty($recto_verso)) { ?>
                                                                <div class="col-md-12 col-lg-12 col-xl-6">
                                                                    <span><strong><?= ($language_name == 'French') ? 'Recto verso: ' . $recto_verso_french : 'Recto/Verso: ' . $recto_verso?></strong></span>
                                                                </div>
                                                            <?php } ?>
                                                            <?php if (!empty($votre_text)) { ?>
                                                                <div class="col-md-12 col-lg-12 col-xl-6">
                                                                    <span><strong><?= ($language_name == 'French') ? 'Votre TEXTE - Votre TEXTE' : 'Your TEXT - Votre TEXT'?>: <?= $votre_text?></strong></span>
                                                                </div>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                    <div class="uploaded-file-detail" id="upload-file-data">
                                                        <?php if (!empty($cart_images)) {
                                                            foreach ($cart_images as $key => $return_arr) { ?>
                                                                <div class="uploaded-file-single" id="teb-<?= $return_arr['skey']?>">
                                                                    <div class="uploaded-file-single-inner">
                                                                        <a href="<?= $return_arr['file_base_url']?>" target="_blank"><div class="uploaded-file-img" style="background-image: url(<?= $return_arr['src']?>)"></div></a>
                                                                        <div class="uploaded-file-info">
                                                                            <div class="uploaded-file-name">
                                                                                <span><a href="<?= $return_arr['file_base_url']?>" target="_blank"><?= $return_arr['name']?></a></span>
                                                                            </div>
                                                                            <div class="upload-field">
                                                                                <textarea readonly><?= $return_arr['cumment']?></textarea>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            <?php }
                                                       } ?>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="cart-total-area">
                                <div class="universal-dark-title">
                                    <span><?= ($language_name == 'French') ? 'Totaux du panier' : 'Cart Totals'?></span>
                                </div>
                                <div class="single-cart-total">
                                    <div class="row">
                                        <div class="col-5 col-md-6">
                                            <strong><?= ($language_name == 'French') ? 'Sous-total du panier' : 'Cart Subtotal'?></strong>
                                        </div>
                                        <div class="col-7 col-md-6">
                                            <strong><?= $product_price_currency_symbol.number_format($ProductOrder['sub_total_amount'], 2)?></strong>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                if (!empty($ProductOrder['preffered_customer_discount']) &&  $ProductOrder['preffered_customer_discount'] != '0.00') { ?>
                                    <div class="single-cart-total">
                                        <div class="row">
                                            <div class="col-5 col-md-6">
                                                <strong><?= ($language_name == 'French') ? 'Remise client privilégiée' : 'Preffered Customer Discount'?></strong>
                                            </div>
                                            <div class="col-7 col-md-6">
                                                <strong><?= $product_price_currency_symbol.number_format($ProductOrder['preffered_customer_discount'], 2)?></strong>
                                            </div>
                                        </div>
                                    </div>
                                <?php }
                                if (!empty($ProductOrder['coupon_discount_amount']) &&  $ProductOrder['coupon_discount_amount'] != '0.00') { ?>
                                    <div class="single-cart-total">
                                        <div class="row">
                                            <div class="col-5 col-md-6">
                                                <strong><?= ($language_name == 'French') ? 'Remise de coupon' : 'Coupon Discount'?></strong>
                                            </div>
                                            <div class="col-7 col-md-6">
                                                <span><?= '- ' . $product_price_currency_symbol . number_format($ProductOrder['coupon_discount_amount'], 2)?></span>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                                <div class="single-cart-total">
                                    <div class="row">
                                        <div class="col-5 col-md-6">
                                            <strong><?= ($language_name == 'French') ? 'Appliquer' : 'Apply'?>Shipping Method</strong>
                                        </div>
                                        <div class="col-7 col-md-6">
                                            <?php
                                            if ($ProductOrder['shipping_method_formate']) {
                                                $shipping_method_formate = explode('-', $ProductOrder['shipping_method_formate']);
                                            ?>
                                                <span>
                                                <?php
                                                $upsServiceCode = upsServiceCode();
                                                if ($shipping_method_formate[0] === 'ups') {
                                                    echo $upsServiceCode[$shipping_method_formate[2]] . ' (UPS)';
                                                } elseif ($shipping_method_formate[0] == 'canadapost') {
                                                    echo $shipping_method_formate[2] . '(Canada Post)';
                                                }
                                                elseif ($shipping_method_formate[0] == 'flagship') {
                                                    $codeData = FlagShipServiceCode($shipping_method_formate[2]);
                                                    echo $codeData['courier_name'] . '<br>' . $codeData['courier_desc'] . '</br>(FlagShip)';
                                                }
                                                elseif ($shipping_method_formate[0] == 'pickupinstore') {
                                                    $pickupStore = $this->Store_Model->getPickupStoreDataById($shipping_method_formate[2]);
                                                    echo 'Pickup In Store<br>' . $pickupStore['name'] . '<br>' . $pickupStore['address'] . '<br>' . $pickupStore['phone'];
                                                }
                                                ?>
                                                <br><strong><?= $product_price_currency_symbol.ucfirst($shipping_method_formate[1])?></strong></span>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <form action="<?= $BASE_URL?>Checkouts/index/<?= base64_encode($stap)?>/<?= $order_id?>/<?= $product_id?>/<?= $coupon_code?>" onsubmit="$('#loader-img').show()">
                                    <div class="single-cart-total">
                                        <div class="row align-items-center">
                                            <div class="col-5 col-md-12 col-lg-12 col-xl-6">
                                                <strong><?= ($language_name == 'French') ? 'Appliquer Coupon' : 'Apply Coupon'?></strong>
                                            </div>
                                            <div class="col-7 col-md-12 col-lg-12 col-xl-6">
                                                <div class="for-coupon">
                                                    <span style="color:red"><?= $this->session->flashdata('code_error')?></span>
                                                    <span style="color:green"><?= $this->session->flashdata('code_success')?></span>
                                                    <input type="text" name="coupon_code" placeholder="Enter Coupon Code" required>
                                                    <button type="submit" name="apply_code" value="apply"><?= ($language_name == 'French') ? 'Appliquer' : 'Apply'?></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                                <?php if (!empty($ProductOrder['total_sales_tax']) &&  $ProductOrder['total_sales_tax'] !='0.00') { ?>
                                    <div class="single-cart-total">
                                        <div class="row">
                                            <div class="col-5 col-md-6">
                                                <strong>Total <?= $salesTaxRatesProvinces_Data['type']?> <?= number_format($salesTaxRatesProvinces_Data['total_tax_rate'], 2)?>%</strong>
                                            </div>
                                            <div class="col-7 col-md-6">
                                                <span><?= $product_price_currency_symbol . number_format($ProductOrder['total_sales_tax'], 2)?></span>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                                <div class="single-cart-total">
                                    <div class="row">
                                        <div class="col-5 col-md-6">
                                            <strong>Total</strong>
                                        </div>
                                        <div class="col-7 col-md-6">
                                            <span class="total"><?= $product_price_currency_symbol.number_format($ProductOrder['total_amount'], 2)?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } else { ?>
                        <div class="text-center">
                            <div class="order-area">
                                <div class="universal-dark-title">
                                    <span>
                                    <?= ($language_name == 'French') ? 'Vos commandes' : 'Your Orders'?></span>
                                </div>
                            </div>
                            <div class="text-center">
                                <h4>
                                <?= ($language_name == 'French') ? 'Le panier d\'achat est vide' : 'Shopping Cart Is Empty'?></h4>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
