<div class="container-fluid my-account-main-section">
    <div class="container p-0">
        <div class="my-account-section">
            <div class="row">
                <div class="col-md-12">
                    <!--<div class="product-title-section">-->
                    <!--    <div class="today-deal-title">-->
                    <!--        <span>Manage Address</span>-->
                    <!--    </div>-->

                    <!--</div>-->
                </div>
<div class="col-md-9">
    <div class="product-pagination">
        <span><a href="index.php">Home</a> &gt; <a href="manage-address.php">Manage Address</a></span>
    </div>
    <div class="my-account-section-box my-acc-height account-manage-address">
        <div class="new-customer-title">
            <span>Address Entries</span>
        </div>
        <div class="customer-fields" style="min-height: initial;">
            <button class="add-address-field" id="show-adress-field"><i class="fas fa-plus"></i> Add a new address</button>
            <div class="edit-address" style="display:none">
                <div class="edit-heading">
                    <label id="edit">ADD A NEW ADDRESS</label>
                </div>
                <div class="location-btn">
                    <button>Use my current location</button>
                </div>
                <div class="delivery-fileds">
                    <div class="row">
                        <div class="col-md-6">
                            <input type="text" placeholder="Name">
                        </div>
                        <div class="col-md-6">
                            <input type="text" placeholder="Mobile Number">
                        </div>
                        <div class="col-md-6">
                            <input type="text" placeholder="Pincode">
                        </div>
                        <div class="col-md-6">
                            <input type="text" placeholder="Locality">
                        </div>
                        <div class="col-md-12">
                            <textarea style="height:150px;" type="text" placeholder="Address (area & street)"></textarea>
                        </div>
                        <div class="col-md-6">
                            <input type="text" placeholder="City/District/Town">
                        </div>
                        <div class="col-md-6">
                            <select>
                                <option>-- Select State --</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <input type="text" placeholder="Landmark (optional)">
                        </div>
                        <div class="col-md-6">
                            <input type="text" placeholder="Alternate Phone (optional)">
                        </div>
                    </div>
                </div>
                <div class="address-type">
                    <span>Address Type</span>
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
            <div class="saved-address-box">
                <div class="adrs-section">
                    <div class="email-field-t">
                        <div class="email-text-t">
                            <span class="address-type-name">Work</span>
                            <br>
                            <span>Guri 9478600000</span>
                            <br>
                            <span class="tt-t">555, Sector 17, Chandigarh, punjab - <strong>160101</strong></span>
                        </div>
                        <div class="dot-menu">
                            <button type="submit"><i class="fas fa-ellipsis-v"></i></button>
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
<div class="col-md-3 desktop-account">
   <?php $this->load->view('elements/my-account-menu');?>
</div>
            </div>
        </div>
    </div>
</div><div class="container-fluid my-account-main-section">
    <div class="container p-0">
        <div class="my-account-section">
            <div class="row">
                <div class="col-md-12">
                    <div class="product-title-section">
                        <div class="today-deal-title">
                            <span>Manage Address</span>
                        </div>
                        <div class="product-pagination">
                            <span><a href="index.php">Home</a> &gt; <a href="manage-address.php">Manage Address</a></span>
                        </div>
                    </div>
                </div>
<div class="col-md-9">
    <div class="my-account-section-box my-acc-height account-manage-address">
        <div class="new-customer-title">
            <span>Address Entries</span>
        </div>
        <div class="customer-fields" style="min-height: initial;">
            <button class="add-address-field" id="show-adress-field"><i class="fas fa-plus"></i> Add a new address</button>
            <div class="edit-address" style="display:none">
                <div class="edit-heading">
                    <label id="edit">ADD A NEW ADDRESS</label>
                </div>
                <div class="location-btn">
                    <button>Use my current location</button>
                </div>
                <div class="delivery-fileds">
                    <div class="row">
                        <div class="col-md-6">
                            <input type="text" placeholder="Name">
                        </div>
                        <div class="col-md-6">
                            <input type="text" placeholder="Mobile Number">
                        </div>
                        <div class="col-md-6">
                            <input type="text" placeholder="Pincode">
                        </div>
                        <div class="col-md-6">
                            <input type="text" placeholder="Locality">
                        </div>
                        <div class="col-md-12">
                            <textarea style="height:150px;" type="text" placeholder="Address (area & street)"></textarea>
                        </div>
                        <div class="col-md-6">
                            <input type="text" placeholder="City/District/Town">
                        </div>
                        <div class="col-md-6">
                            <select>
                                <option>-- Select State --</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <input type="text" placeholder="Landmark (optional)">
                        </div>
                        <div class="col-md-6">
                            <input type="text" placeholder="Alternate Phone (optional)">
                        </div>
                    </div>
                </div>
                <div class="address-type">
                    <span>Address Type</span>
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
            <div class="saved-address-box">
                <div class="adrs-section">
                    <div class="email-field-t">
                        <div class="email-text-t">
                            <span class="address-type-name">Work</span>
                            <br>
                            <span>Guri 9478600000</span>
                            <br>
                            <span class="tt-t">555, Sector 17, Chandigarh, punjab - <strong>160101</strong></span>
                        </div>
                        <div class="dot-menu">
                            <button type="submit"><i class="fas fa-ellipsis-v"></i></button>
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
<div class="col-md-3 desktop-account">
   <?php $this->load->view('elements/my-account-menu');?>
</div>
            </div>
        </div>
    </div>
</div>