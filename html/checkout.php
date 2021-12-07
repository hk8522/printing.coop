<?php include("header.php"); ?>

<div class="page-title-section universal-bg-white">
    <div class="container">
        <div class="page-title-section-inner universal-half-spacing">
            <div class="inner-breadcrum">
                <a href="index.php">Home</a> 
                / 
                <span class="current">Checkout</span>
            </div>
        </div>
    </div>
</div>

<div class="checkout-section universal-spacing universal-bg-white">
    <div class="container">
        <div class="checkout-section-inner">
            <div class="row">
                <div class="col-md-7">
                    <div id="accordion">
                        <div class="card">
                            <div class="card-header" id="heading1" data-toggle="collapse" data-target="#collapse1" aria-expanded="true" aria-controls="collapse1">
                                <div class="universal-dark-title">
                                    <span>Login Or Signup</span>
                                </div>
                            </div>
                            <div id="collapse1" class="collapse show" aria-labelledby="heading1" data-parent="#accordion">
                                <div class="card-body">
                                    <div class="checkout-select">
                                        <div class="checkout-select-single">
                                            <label id="guest-signup">
                                                <input type="radio" name="checkout-select" value="guest-signup" checked="">
                                                Checkout as Guest
                                            </label>
                                        </div>
                                        <div class="checkout-select-single">
                                            <label id="login-signup">
                                                <input type="radio" name="checkout-select" value="login-signup">
                                                Already a Member?
                                                <div class="shipping-form" id="login-signup-show" style="display: none;">
                                                    <div class="single-review">
                                                        <label>Email Address:</label>
                                                        <input type="text" name="login-username">
                                                    </div>
                                                    <div class="login-btn">
                                                        <button type="submit">Continue</button>
                                                    </div>
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header collapsed" id="heading2" data-toggle="collapse" data-target="#collapse2" aria-expanded="false" aria-controls="collapse2">
                                <div class="universal-dark-title">
                                    <span>Shipping Address</span>
                                </div>
                            </div>
                            <div id="collapse2" class="collapse" aria-labelledby="heading2" data-parent="#accordion">
                                <div class="card-body">
                                    <div class="account-address-area">
                                        <div class="checkout-addresss">
                                            <label id="exsiting-address">
                                                <input name="delivery" value="exsiting-address" for="exsiting-address" type="radio" checked=""> 
                                                <div class="email-field-t">
                                                    <div class="email-text-t">
                                                        <span class="address-type-name">Work</span>
                                                        <span>Guri 9478600000</span>
                                                        <br>
                                                        <span class="tt-t">555, Sector 17, Chandigarh, punjab - <strong>160101</strong></span>
                                                    </div>
                                                </div>
                                            </label>
                                        </div>
                                        <div class="checkout-addresss">
                                            <label id="new-address">
                                                <input name="delivery" value="new-address" for="new-address" type="radio"> 
                                                <span class="new-c-addr"><i class="las la-plus"></i> New Address</span>
                                            </label>
                                            <div class="delivery-fileds" id="checkout-new-address" style="display: none;">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="single-review">
                                                            <input type="text" placeholder="First Name*">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="single-review">
                                                            <input type="text" placeholder="Last Name*">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="single-review">
                                                            <input type="text" placeholder="Phone Number*">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="single-review">
                                                            <input type="text" placeholder="Company">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="single-review">
                                                            <textarea style="height:150px;" type="text" placeholder="Address (area &amp; street)*"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="single-review">
                                                            <input type="text" placeholder="City*">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="single-review">
                                                            <select>
                                                                <option selected="">Please select a region, state or province.*</option>
                                                                <option>Alberta</option>
                                                                <option>British Columbia</option>
                                                                <option>Manitoba</option>
                                                                <option>New Brunswick</option>
                                                                <option>Newfoundland and Labrador</option>
                                                                <option>Northwest Territories</option>
                                                                <option>Nova Scotia</option>
                                                                <option>Nunavut</option>
                                                                <option>Ontario</option>
                                                                <option>Prince Edward Island</option>
                                                                <option>Quebec</option>
                                                                <option>Saskatchewan</option>
                                                                <option>Yukon Territory</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="single-review">
                                                            <input type="text" placeholder="Zip/Postal Code*">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="single-review">
                                                            <select>
                                                                <option selected="">Canada</option>
                                                                <option>xyz</option>
                                                                <option>xyz</option>
                                                                <option>xyz</option>
                                                                <option>xyz</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header collapsed" id="heading3" data-toggle="collapse" data-target="#collapse3" aria-expanded="false" aria-controls="collapse3">
                                <div class="universal-dark-title">
                                    <span>Shipping Methods</span>
                                </div>
                            </div>
                            <div id="collapse3" class="collapse" aria-labelledby="heading3" data-parent="#accordion">
                                <div class="card-body">
                                    <div class="shipping-method-fields">
                                        <div class="shipping-metthod-single">
                                            <label>
                                                <input type="radio" name="shipping-method" value="method1" checked="">
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <strong>$11.59</strong>
                                                    </div>
                                                    <div class="col-md-7 p-0">
                                                        <span>Expedited Parcel - Est. Delivery Jan 19, 2020</span>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <span>Canada Post</span>
                                                    </div>
                                                </div>
                                            </label>
                                        </div>
                                        <div class="shipping-metthod-single">
                                            <label>
                                                <input type="radio" name="shipping-method" value="method2">
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <strong>$11.59</strong>
                                                    </div>
                                                    <div class="col-md-7 p-0">
                                                        <span>Expedited Parcel - Est. Delivery Jan 19, 2020</span>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <span>Canada Post</span>
                                                    </div>
                                                </div>
                                            </label>
                                        </div>
                                        <div class="shipping-metthod-single">
                                            <label>
                                                <input type="radio" name="shipping-method" value="method3">
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <strong>$11.59</strong>
                                                    </div>
                                                    <div class="col-md-7 p-0">
                                                        <span>Expedited Parcel - Est. Delivery Jan 19, 2020</span>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <span>Canada Post</span>
                                                    </div>
                                                </div>
                                            </label>
                                        </div>
                                        <div class="shipping-metthod-single">
                                            <label>
                                                <input type="radio" name="shipping-method" value="method4">
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <strong>$11.59</strong>
                                                    </div>
                                                    <div class="col-md-7 p-0">
                                                        <span>Expedited Parcel - Est. Delivery Jan 19, 2020</span>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <span>Canada Post</span>
                                                    </div>
                                                </div>
                                            </label>
                                        </div>
                                        <div class="shipping-metthod-single">
                                            <label>
                                                <input type="radio" name="shipping-method" value="method5">
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <strong>$11.59</strong>
                                                    </div>
                                                    <div class="col-md-7 p-0">
                                                        <span>Expedited Parcel - Est. Delivery Jan 19, 2020</span>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <span>Canada Post</span>
                                                    </div>
                                                </div>
                                            </label>
                                        </div>
                                        <div class="shipping-metthod-single">
                                            <label>
                                                <input type="radio" name="shipping-method" value="method6">
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <strong>$11.59</strong>
                                                    </div>
                                                    <div class="col-md-7 p-0">
                                                        <span>Expedited Parcel - Est. Delivery Jan 19, 2020</span>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <span>Canada Post</span>
                                                    </div>
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header collapsed" id="heading4" data-toggle="collapse" data-target="#collapse4" aria-expanded="false" aria-controls="collapse4">
                                <div class="universal-dark-title">
                                    <span>Payment Option</span>
                                </div>
                            </div>
                            <div id="collapse4" class="collapse" aria-labelledby="heading4" data-parent="#accordion">
                                <div class="card-body">
                                    <div class="payment-sections">
                                        <div id="accordion1">
                                        <div class="card">
                                            <div class="card-header" id="headingPayOne" data-toggle="collapse" data-target="#collapsePayOne" aria-expanded="true" aria-controls="collapsePayOne">
                                                <label class="main-input" for="onepayment"><input name="payment" value="atm" type="radio" id="onepayment" checked="">Credit / Debit / ATM Card</label>
                                            </div>
                                            <div id="collapsePayOne" class="collapse show" aria-labelledby="headingPayOne" data-parent="#accordion1" style="">
                                                <div class="payment-option">
                                                    <div class="delivery-fileds single-review">
                                                        <input type="text" placeholder="Enter Card Mumber">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="expiry-box">
                                                                    <span>Expiry</span>
                                                                    <span class="select-month">
                                                                        <select><option selected="" value="MM">MM</option><option value="01">01</option><option value="02">02</option><option value="03">03</option><option value="04">04</option><option value="05">05</option><option value="06">06</option><option value="07">07</option><option value="08">08</option><option value="09">09</option><option value="10">10</option><option value="11">11</option><option value="12">12</option></select>
                                                                    </span>
                                                                    <span class="select-year">
                                                                        <select><option selected="" value="YY">YY</option><option value="19">19</option><option value="20">20</option><option value="21">21</option><option value="22">22</option><option value="23">23</option><option value="24">24</option><option value="25">25</option><option value="26">26</option><option value="27">27</option><option value="28">28</option><option value="29">29</option><option value="30">30</option><option value="31">31</option><option value="32">32</option><option value="33">33</option><option value="34">34</option><option value="35">35</option><option value="36">36</option><option value="37">37</option><option value="38">38</option><option value="39">39</option><option value="40">40</option><option value="41">41</option><option value="42">42</option><option value="43">43</option><option value="44">44</option><option value="45">45</option><option value="46">46</option><option value="47">47</option><option value="48">48</option><option value="49">49</option><option value="50">50</option><option value="51">51</option><option value="52">52</option><option value="53">53</option><option value="54">54</option><option value="55">55</option><option value="56">56</option><option value="57">57</option><option value="58">58</option></select>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <input type="text" placeholder="CVV">
                                                            </div>
                                                            <div class="col-md-3">
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="order-confirm-text">
                                                        <span>Your card details would be securely saved for faster payments. Your CVV will not be stored. </span>
                                                    </div>
                                                </div>
                                            </div>    
                                        </div>
                                        <div class="card">
                                            <div class="card-header collapsed" id="headingPayTwo" data-toggle="collapse" data-target="#collapsePayTwo" aria-expanded="false" aria-controls="collapsePayTwo">
                                                <label class="main-input" for="Twopayment"><input name="payment" value="phonepe" type="radio" id="Twopayment">Paypal</label>
                                            </div>
                                            <div id="collapsePayTwo" class="collapse" aria-labelledby="headingPayTwo" data-parent="#accordion1" style="">
                                                <div class="payment-option">
                                                    <div class="order-confirm-text">
                                                        <span>You'll be redirected to Paypal page</span>
                                                    </div>
                                                    <div class="phonepe-btn">
                                                        <button class="register">Continue</button>
                                                    </div>
                                                </div>
                                            </div>    
                                        </div>
                                        <div class="card">
                                            <div class="card-header collapsed" id="headingPay3" data-toggle="collapse" data-target="#collapsePay3" aria-expanded="false" aria-controls="collapsePay3">
                                                <label class="main-input" for="3payment"><input name="payment" value="phonepe" type="radio" id="3payment">Stripe</label>
                                            </div>
                                            <div id="collapsePay3" class="collapse" aria-labelledby="headingPay3" data-parent="#accordion1" style="">
                                                <div class="payment-option">
                                                    <div class="order-confirm-text">
                                                        <span>You'll be redirected to Stripe page</span>
                                                    </div>
                                                    <div class="phonepe-btn">
                                                        <button class="register">Continue</button>
                                                    </div>
                                                </div>
                                            </div>    
                                        </div>
                                        <div class="card">
                                            <div class="card-header collapsed" id="headingPayFour" data-toggle="collapse" data-target="#collapsePayFour" aria-expanded="false" aria-controls="collapsePayFour">
                                                <label class="main-input" for="Fourpayment"><input name="payment" value="cash" type="radio" id="Fourpayment">Cash On Delivery</label>
                                            </div>
                                            <div id="collapsePayFour" class="collapse" aria-labelledby="headingPayFour" data-parent="#accordion1" style=""></div>   
                                        </div>
                                        </div>
                                    </div>
                                    <div class="order-btn text-right">
                                        <button type="submit">Place Order</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="order-area">
                        <div class="universal-dark-title">
                            <span>Your Orders</span>
                        </div>
                        <table class="shop-cart-table">
                            <tbody>
                                <tr>
                                    <td class="product-thumbnail">
                                        <a href="product-single.php">
                                            <img src="images/product2.jpg">
                                        </a>                     
                                    </td>
                                    <td class="product-name">
                                        <a href="product-single.php">Printing Card Gray</a>
                                        <div class="row align-items-center">
                                            <div class="col-md-6">
                                                <div class="quant-cart text-left">
                                                    1x1
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="product-subtotal text-right">
                                                    <span></span>£738.00</span>
                                                </div>
                                            </div>
                                        </div>                                              
                                        <div class="product-name-detail">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <span><strong>Copy:</strong> 50</span>
                                                </div>
                                                <div class="col-md-6">
                                                    <span><strong>Colors:</strong> Full</span>
                                                </div>
                                                <div class="col-md-6">
                                                    <span><strong>Paper quality:</strong> Clear vinyl</span>
                                                </div>
                                                <div class="col-md-6">
                                                    <span><strong>Size:</strong> 3" x 4"</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="uploaded-file-detail">
                                            <div class="uploaded-file-single">
                                                <div class="uploaded-file-single-inner">
                                                    <div class="uploaded-file-img" style="background-image: url(images/joinus_img.jpg)"></div>
                                                    <div class="uploaded-file-info">
                                                        <div class="uploaded-file-name">
                                                            <span>File name goes here</span>
                                                        </div>                                           
                                                        <div class="upload-field">
                                                            <textarea type="text"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="cart-total-area">
                        <div class="universal-dark-title">
                            <span>Cart Totals</span>
                        </div>
                        <div class="single-cart-total">
                            <div class="row">
                                <div class="col-md-6">
                                    <strong>Cart Subtotal</strong>
                                </div>
                                <div class="col-md-6">
                                    <strong>£798.00</strong>
                                </div>
                            </div>
                        </div>
                        <div class="single-cart-total">
                            <div class="row">
                                <div class="col-md-6">
                                    <strong>Shipping Method</strong>
                                </div>
                                <div class="col-md-6">
                                    <span>Expedited Parcel - Est. Delivery Jan 19, 2020 <br> <strong>£11.59</strong></span>
                                </div>
                            </div>
                        </div>
                        <div class="single-cart-total">
                            <div class="row">
                                <div class="col-md-6">
                                    <strong>Total</strong>
                                </div>
                                <div class="col-md-6">
                                    <span class="total">£809.59</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include("footer.php"); ?>