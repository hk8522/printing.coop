<?php include("header.php"); ?>

<div class="page-title-section universal-bg-white">
    <div class="container">
        <div class="page-title-section-inner universal-half-spacing">
            <div class="inner-breadcrum">
                <a href="index.php">Home</a> 
                / 
                <span class="current">Manage Address</span>
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
                    <span>Your Address Entries</span>
                </div>
                <div class="account-address-area">
                    <button class="add-address-field" id="show-adress-field"><i class="las la-plus"></i> Add a new shipping address</button>
                    <div class="edit-address" style="display:none">
                        <div class="edit-heading">
                            <label id="edit">NEW SHIPPING ADDRESS</label>
                        </div>
                        <div class="delivery-fileds">
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
                                <div class="col-md-6">
                                    <div class="single-review">
                                        <input type="text" placeholder="City*">
                                    </div>
                                </div>
                                <div class="col-md-6">
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
                                <div class="col-md-6">
                                    <div class="single-review">
                                        <input type="text" placeholder="Zip/Postal Code*">
                                    </div>
                                </div>
                                <div class="col-md-6">
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
                        <div class="address-type">
                            <div class="single-review">
                                <label>Address Type</label>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label id="home"><input name="delivery" value="home" for="home" type="radio" checked=""> Home (All day delivery)</label>
                                </div>
                                <div class="col-md-6">
                                    <label id="work"><input name="delivery" value="work" for="work" type="radio"> Work (Delivery between 10AM - 5PM)</label>
                                </div>
                            </div>
                        </div>
                        <div class="save-btn">
                            <button class="save">Save</button>
                            <a id="cancel-address">Cancel</a>
                        </div>
                    </div>
                    <div class="email-field-t">
                        <div class="email-text-t">
                            <span class="address-type-name">Work</span>
                            <span>Guri 9478600000</span>
                            <br>
                            <span class="tt-t">555, Sector 17, Chandigarh, punjab - <strong>160101</strong></span>
                        </div>
                        <div class="dot-menu">
                            <button type="submit"><i class="las la-ellipsis-v"></i></button>
                            <div class="dot-menu-section">
                                <button type="submit">edit</button>
                                <button type="submit">delete</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>                    
        </div>
    </div>
</div>

<?php include("footer.php"); ?>