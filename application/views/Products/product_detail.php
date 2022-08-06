<div class="col-md-12 col-md-12 col-md-8">
    <input type="hidden" name="add_length_width" value="<?= $Product['add_length_width']?>">
    <input type="hidden" name="length_width_quantity_show" value="<?= $Product['length_width_quantity_show']?>">
    <input type="hidden" name="page_add_length_width" value="<?= $Product['page_add_length_width']?>">
    <input type="hidden" name="page_length_width_pages_show" value="<?= $Product['page_length_width_pages_show']?>">
    <input type="hidden" name="page_length_width_sheets_show" value="<?= $Product['page_length_width_sheets_show']?>">
    <input type="hidden" name="page_length_width_quantity_show"
        value="<?= $Product['page_length_width_quantity_show']?>">

    <input type="hidden" name="depth_add_length_width" value="<?= $Product['depth_add_length_width']?>">
    <input type="hidden" name="depth_width_length_quantity_show"
        value="<?= $Product['depth_width_length_quantity_show']?>">

    <?php if ($Product['add_length_width'] == 1) {?>
        <div class="single-review">
            <label><?= $language_name == 'French' ? 'Longueur (pouces)' : 'Length (Inch)'?><span
                    class="required">*</span></label>
            <input type="text" name="product_length" id="product_length" required value="0"
                onkeypress="javascript:return isNumber(event)">
            <span style="color:red" id="product_length_error"></span>
        </div>

        <div class="single-review">
            <label><?= $language_name == 'French' ? 'Largeur (pouces)' : 'Width (Inch)'?><span
                    class="required">*</span></label>
            <input type="text" name="product_width" id="product_width" required value="0"
                onkeypress="javascript:return isNumber(event)"><span style="color:red" id="product_width_error"></span>
        </div>
        <?php if ($Product['length_width_color_show'] == 1) {?>
            <div class="single-review">
                <label><?= $language_name == 'French' ? 'Couleurs' : 'Colors'?><span class="required">*</span></label>
                <select name="length_width_color" id="length_width_color" required>
                    <option value=""><?= $language_name == 'French' ? 'Sélectionnez la couleur' : 'Select Color'?></option>
                    <option value="black"><?= $language_name == 'French'?'Noire':'Black'?></option>
                    <option value="color"><?= $language_name == 'French'?'Couleur':'Color'?></option>
                </select>
                <!-- <span> -->
            </div>
        <?php }?>

        <?php if ($Product['length_width_quantity_show'] == 1) {?>
            <div class="single-review">
                <label><?= $language_name == 'French' ? 'Quantité' : 'Quantity'?><span class="required">*</span></label>
                <?php if ($Product['length_width_pages_type'] == 'input') {?>
                    <input type="number" name="product_total_page" id="product_total_page" required
                        onkeypress="javascript:return isNumber(event)" value="<?= $Product['length_width_min_quantity']?>"
                        onkeypress="javascript:return isNumber(event)">
                <?php } else {?>
                    <select name="product_total_page" required id="product_total_page">
                        <option value="">
                            <?= $language_name == 'French' ? 'Sélectionnez la quantité' : 'Select Quantity'?>
                        </option>
                        <?php foreach($pageQuantity as $Quantity) {?>
                        <option value="<?= $Quantity['name']?>">
                            <?= $language_name == 'French' ? $Quantity['name_french'] : $Quantity['name']?>
                        </option>
                        <?php }?>
                    </select>
                <?php }?>
                <span style="color:red" id="product_total_page_error"></span>
            </div>
        <?php }?>
    <?php }?>

    <?php if ($Product['page_add_length_width'] == 1) {?>
        <div class="single-review">
            <label><?= $language_name == 'French' ? 'Longueur (pouces)' : 'Length (Inch)'?><span
                    class="required">*</span></label>
            <input type="text" name="page_product_length" id="page_product_length" required value="0"
                onkeypress="javascript:return isNumber(event)">
            <span style="color:red" id="page_product_length_error"></span>
        </div>

        <div class="single-review">
            <label><?= $language_name == 'French' ? 'Largeur (pouces)' : 'Width (Inch)'?><span
                    class="required">*</span></label>
            <input type="text" name="page_product_width" id="page_product_width" required value="0"
                onkeypress="javascript:return isNumber(event)"><span style="color:red" id="page_product_width_error"></span>
        </div>
        <?php if ($Product['page_length_width_color_show'] == 1) {?>
            <div class="single-review">
                <label><?= $language_name == 'French' ? 'Couleurs' : 'Colors'?><span class="required">*</span></label>
                <select name="page_length_width_color" required id="page_length_width_color">
                    <option value=""><?= $language_name == 'French'?'Sélectionnez la couleur':'Select Color'?></option>
                    <option value="black"><?= $language_name == 'French'?'Noire':'Black'?></option>
                    <option value="color"><?= $language_name == 'French'?'Couleur':'Color'?></option>
                </select>
                <span>
            </div>
        <?php }?>

        <?php if ($Product['page_length_width_pages_show'] == 1) {?>
            <div class="single-review">
                <label><?= $language_name == 'French' ? 'Des pages' : 'Pages'?><span class="required">*</span></label>
                <?php if ($Product['length_width_pages_type']=='input') {?>
                    <input type="text" name="page_product_total_page" id="page_product_total_page" required value="1"
                        onkeypress="javascript:return isNumber(event)">
                <?php } else {?>
                    <select name="page_product_total_page" required id="page_product_total_page">
                        <option value=""><?= $language_name == 'French' ? 'Sélectionner des pages' : 'Select Pages'?></option>
                        <?php foreach($ProductPages as $Pages) {?>
                        <option value="<?= $Pages['total_page'].'-'.$Pages['name']?>-<?= $Pages['name_french']?>">
                            <?= $language_name == 'French' ? $Pages['name_french'] : $Pages['name']?>
                        </option>
                        <?php }?>
                    </select>
                <?php }?>
                <span style="color:red" id="page_product_total_page_error"></span>
            </div>
        <?php }?>

        <?php if ($Product['page_length_width_sheets_show'] == 1) {?>
            <div class="single-review">
                <label><?= $language_name == 'French' ? 'Feuille par bloc' : 'Sheet Per Pad'?><span
                        class="required">*</span></label>
                <?php if ($Product['page_length_width_sheets_type'] == 'input') {?>
                    <input type="text" name="page_product_total_sheets" id="page_product_total_sheets" required value="1"
                        onkeypress="javascript:return isNumber(event)">
                <?php } else {?>
                    <select name="page_product_total_sheets" required id="page_product_total_sheets">
                        <option value="">
                            <?= $language_name == 'French' ? 'Sélectionner une feuille par bloc' : 'Select Sheet per pad'?></option>
                        <?php foreach($ProductSheets as $Sheets) {?>
                        <option value="<?= $Sheets['name']?>">
                            <?= $language_name == 'French' ? $Sheets['name_french'] : $Sheets['name']?></option>
                        <?php }?>
                    </select>
                <?php }?>
                <span style="color:red" id="page_product_total_sheets_error"></span>
            </div>
        <?php }?>
        <?php if ($Product['page_length_width_quantity_show'] == 1) {?>
            <div class="single-review">
                <label><?= $language_name == 'French' ? 'Quantité' : 'Quantity'?><span class="required">*</span></label>
                <?php if ($Product['page_length_width_quantity_type'] == 'input') {?>
                    <input type="text" name="page_product_total_quantity" id="page_product_total_quantity" required
                        onkeypress="javascript:return isNumber(event)" value="0">
                <?php } else { ?>
                    <select name="page_product_total_quantity" required id="page_product_total_quantity">
                        <option value=""><?= $language_name == 'French' ? 'Sélectionnez la quantité' : 'Select Quantity'?></option>
                        <?php foreach($pageQuantity as $Quantity) {?>
                        <option value="<?= $Quantity['name']?>">
                            <?= $language_name == 'French' ? $Quantity['name_french'] : $Quantity['name']?></option>
                        <?php }?>
                    </select>
                <?php }?>
                <span style="color:red" id="page_product_total_quantity_error"></span>
            </div>
        <?php }?>
    <?php }?>

    <?php if ($Product['depth_add_length_width'] == 1) {?>
        <div class="single-review">
            <label><?= $language_name == 'French' ? 'Longueur (pouces)' : 'Length (Inch)'?> <span
                    class="required">*</span></label>
            <input type="text" name="product_depth_length" id="product_depth_length" required value="0"
                onkeypress="javascript:return isNumber(event)">
            <span style="color:red" id="product_depth_length_error"></span>
        </div>

        <div class="single-review">
            <label><?= $language_name == 'French' ? 'Largeur (pouces)' : 'Width (Inch)'?> <span
                    class="required">*</span></label>
            <input type="text" name="product_depth_width" id="product_depth_width" required value="0"
                onkeypress="javascript:return isNumber(event)"><span style="color:red"
                id="product_depth_width_error"></span>
        </div>
        <div class="single-review">
            <label><?= $language_name == 'French' ? 'Profondeur (pouces)' : 'Depth (Inch)'?> <span
                    class="required">*</span></label>
            <input type="text" name="product_depth" id="product_depth" required value="0"
                onkeypress="javascript:return isNumber(event)"><span style="color:red" id="product_depth_error"></span>
        </div>
        <?php if ($Product['depth_color_show'] == 1) {?>
            <div class="single-review">
                <label><?= $language_name == 'French' ? 'Couleurs' : 'Colors'?><span class="required">*</span></label>

                <select name="depth_color" id="depth_color" required>
                    <option value=""> <?= $language_name == 'French'?'Sélectionnez la couleur':'Select Color'?></option>

                    <option value="black">
                        <?= $language_name == 'French'?'Noire':'Black'?></option>
                    <option value="color">
                        <?= $language_name == 'French'?'Couleur':'Color'?></option>
                </select>
                <span>
            </div>
        <?php }?>
        <?php if ($Product['depth_width_length_quantity_show'] == 1) {?>
            <div class="single-review">
                <label><?= $language_name == 'French' ? 'Quantité' : 'Quantity'?><span class="required">*</span></label>
                <?php if ($Product['depth_width_length_type'] == 'input') { ?>
                <input type="text" name="product_depth_total_page" id="product_depth_total_page" required
                    value="<?= $Product['depth_min_quantity']?>" onkeypress="javascript:return isNumber(event)">
                <?php } else { ?>
                <select name="product_depth_total_page" required id="page_product_total_quantity">
                    <option value=""><?= $language_name == 'French' ? 'Sélectionnez la quantité' : 'Select Quantity'?></option>
                    <?php foreach($pageQuantity as $Quantity) {?>
                    <option value="<?= $Quantity['name']?>">
                        <?= $language_name == 'French' ? $Quantity['name_french'] : $Quantity['name']?></option>
                    <?php }?>
                </select>
                <?php }?>
                <span style="color:red" id="product_depth_total_page_error"></span>
            </div>
        <?php }?>
    <?php }?>
    <?php
        $i = 1;
        if (!empty($ProductSizes)) {
            $i = 2;
    ?>

        <div class="single-review">
            <label><?= $language_name == 'French' ? 'Quantité' : 'Quantity'?><span class="required">*</span></label>
            <select name="product_quantity_id" required id="product_quantity_id" onchange="showQuantity()">
                <option value=""><?= $language_name == 'French'?'Choisis une option...':'Choose an option...'?></option>

                <?php foreach($ProductSizes as $key => $val) {
                        $qty_name = '';
                        $qty_extra_price = '';
                        $qty_name = $language_name == 'French' ? $val['qty_name_french'] : $val['qty_name'];
                    ?>
                    <option value='<?= $key?>'><?= $qty_name.$qty_extra_price?></option>
                <?php }?>
            </select>
        </div>

        <div id="SizeOptions"></div>
    <?php }?>

    <?php foreach($ProductAttributes as $key => $val) {
        $items = $val['items'];
    ?>
        <div class="single-review">
            <label><?= $language_name == 'French' ? $val['data']['attribute_name_french'] : $val['data']['attribute_name']?><span
                    class="required">*</span></label>
            <?php $items = $val['items'];?>
            <?php if (!empty($items)) {?>
                <select name="attribute_id_<?= $key?>" required <?php if ($i > 1) {echo 'disabled';}?>
                    onchange="showAttribute(<?= $i?>,'<?= $i + 1?>')" id="attribute_id_<?= $i?>">
                    <option value=""><?= $language_name == 'French' ? 'Choisis une option...':'Choose an option...'?> </option>
                    <?php foreach($items as $subkey => $subval) {
                                $extra_price = '';
                                if (!empty($subval['extra_price']) && $subval['extra_price'] !='0.00') {
                                    //$extra_price=" (+ ".$product_price_currency_symbol.$subval['extra_price'].")";
                                }
                            ?>
                    <option value="<?= $subval['attribute_item_id']?>">
                        <?= $language_name == 'French' ? $subval['item_name_french'].$extra_price : $subval['item_name'].$extra_price?>
                    </option>
                    <?php }?>
                </select>
            <?php $i++; }?>
        </div>
    <?php }?>

    <?php if ($Product['recto_verso'] == 1) {?>
        <div class="single-review">
            <label><?= $language_name == 'French' ? 'Recto verso' : 'Recto/Verso'?><span class="required">*</span></label>
            <select name="recto_verso" required id="attribute_id_<?= $i?>" <?php if ($i > 1) {echo 'disabled';}?>
                onchange="showAttribute(<?= $i?>,'<?= $i + 1?>')">
                <option value=""><?= $language_name == 'French' ? 'Choisis une option...':'Choose an option...'?></option>
                <option value="Yes"><?= $language_name == 'French' ? 'Oui':'Yes'?></option>
                <option value="No"><?= $language_name == 'French' ? 'Non':'No'?></option>
            </select>
            <!--<span>Recto/verso will add <?= $Product['recto_verso_price']?>% more to the price</span>-->
        </div>
        <input type="hidden" name="recto_verso_price" value="<?= $Product['recto_verso_price']?>">
    <?php }?>
    <?php if ($Product['votre_text'] == 1) {?>
        <div class="single-review">
            <label><?= $language_name == 'French' ? 'Votre TEXTE - Votre TEXTE' : 'Your TEXT - Votre TEXT'?><span
                    class="required">*</span></label>
            <input type="text" name="votre_text" id="votre_text" required value="">
        </div>
    <?php }?>

    <?php if ($Product['call'] == 1) {?>
        <div class="single-review">
            <label><?= $language_name == 'French' ? 'Appel' : 'Call'?><span class="required"></span></label>
            <label>
                <?= $Product['phone_number']?>
                <span class="required"></span>
            </label>
        </div>
    <?php }?>
</div>
<script>
    function showAttribute(cid, nid) {
        $("#loader-img").show();
        $(".new-price-img").hide();
        var item_val = $("#attribute_id_" + cid).val();
        var myForm = document.getElementById('cartForm');
        var formData = new FormData(myForm);
        $.ajax({
            type: 'POST',
            dataType: 'html',
            url: '<?= $BASE_URL?>Products/calculatePrice',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(data) {
                var json = JSON.parse(data);
                $("#loader-img").hide();
                $(".new-price-img").show();
                if (json.success == 1) {
                    $("#attribute_id_" + nid).attr("disabled", false);
                    $("#total-price").html(json.price);
                }
            },
            error: function(resp) {
                $("#loader-img").hide();
                $(".new-price-img").show();
            }
        });
    }

    function showQuantity() {
        $("#loader-img").show();
        $(".new-price-img").hide();
        $(".multipal_size").html('<option value="">Choose an option...</option>');
        var myForm = document.getElementById('cartForm');
        var formData = new FormData(myForm);
        $.ajax({
            type: 'POST',
            dataType: 'html',
            url: '<?= $BASE_URL?>Products/GetQuantity',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(data) {
                var json = JSON.parse(data);
                $("#loader-img").hide();
                $(".new-price-img").show();
                if (json.success == 1) {
                    if (json.sizeoptions == '0') {
                        $("#attribute_id_2").attr("disabled", false);
                        $("#SizeOptions").html('');
                    } else {
                        $("#SizeOptions").html(json.sizeoptions);
                    }
                    $("#total-price").html(json.price);
                }
            }
        });
    }

    function showSizeQuantity() {
        $("#loader-img").show();
        $(".new-price-img").hide();
        $(".multipal_size_item").html('<option value="">Choose an option...</option>');
        var myForm = document.getElementById('cartForm');
        var formData = new FormData(myForm);
        $.ajax({
            type: 'POST',
            dataType: 'html',
            url: '<?= $BASE_URL?>Products/GetQuantity',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(data) {
                var json = JSON.parse(data);
                $("#loader-img").hide();
                $(".new-price-img").show();
                if (json.success == 1) {
                    $("#SizeOptions").html(json.sizeoptions);
                    $("#total-price").html(json.price);
                }
            }
        });
    }

    function getSizeOptions(product_id, make_a_default_qty_id) {
        $("#loader-img").show();
        $.ajax({
            type: 'GET',
            dataType: 'html',
            url: '<?= $BASE_URL?>Products/getSizeOptions/' + product_id + '/' + make_a_default_qty_id,
            cache: false,
            contentType: false,
            processData: false,
            success: function(data) {
                $("#loader-img").hide();
                $("#SizeOptions").html(data);
            }
        });
    }

    function getLengthWidthPrice() {
        $("#loader-img").show();
        $(".new-price-img").hide();
        var myForm = document.getElementById('cartForm');
        var formData = new FormData(myForm);
        $.ajax({
            type: 'POST',
            dataType: 'html',
            url: '<?= $BASE_URL?>Products/calculatePrice',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(data) {
                var json = JSON.parse(data);
                $("#loader-img").hide();
                $(".new-price-img").show();
                if (json.success == 1) {
                    $("#total-price").html(json.price);
                    $("#product_width").val(json.product_width);
                    $("#product_length").val(json.product_length);

                    $("#product_total_page").val(json.product_total_page);

                    $("#product_width_error").html(json.product_width_error);
                    $("#product_length_error").html(json.product_length_error);

                    $("#product_total_page_error").html(json.product_total_page_error);
                }
            }
        });
    }

    function getDepthLengthWidthPrice() {
        $("#loader-img").show();
        $(".new-price-img").hide();
        var myForm = document.getElementById('cartForm');
        var formData = new FormData(myForm);
        $.ajax({
            type: 'POST',
            dataType: 'html',
            url: '<?= $BASE_URL?>Products/calculatePrice',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(data) {
                var json = JSON.parse(data);
                $("#loader-img").hide();
                $(".new-price-img").show();
                if (json.success == 1) {
                    $("#total-price").html(json.price);

                    $("#product_depth_width").val(json.product_depth_width);
                    $("#product_depth_length").val(json.product_depth_length);

                    $("#product_depth_total_page").val(json.product_depth_total_page);

                    $("#product_depth").val(json.product_depth);

                    $("#product_depth_width_error").html(json.product_depth_width_error);
                    $("#product_depth_length_error").html(json.product_depth_length_error);

                    $("#product_depth_total_page_error").html(json.product_depth_total_page_error);

                    $("#product_depth_error").html(json.product_depth_error);
                }
            }
        });
    }

    function getPageLengthWidthPrice() {
        $("#loader-img").show();
        $(".new-price-img").hide();
        var myForm = document.getElementById('cartForm');
        var formData = new FormData(myForm);
        $.ajax({
            type: 'POST',
            dataType: 'html',
            url: '<?= $BASE_URL?>Products/calculatePrice',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(data) {
                var json = JSON.parse(data);
                $("#loader-img").hide();
                $(".new-price-img").show();

                if (json.success == 1) {
                    $("#total-price").html(json.price);
                    $("#page_product_width").val(json.page_product_width);
                    $("#page_product_length").val(json.page_product_length);

                    $("#page_product_total_page").val(json.page_product_total_page);
                    $("#page_product_total_sheets").val(json.page_product_total_sheets);

                    $("#page_product_total_quantity").val(json.page_product_total_quantity);

                    $("#page_product_width_error").html(json.page_product_width_error);
                    $("#page_product_length_error").html(json.page_product_length_error);
                    $("#page_product_total_page_error").html(json.page_product_total_page_error);
                    $("#page_product_total_quantity_error").html(json.page_product_total_quantity_error);
                    $("#page_product_total_sheets_error").html(json.page_product_total_sheets_error);
                }
            }
        });
    }

    $("#product_width, #product_total_page").change(function() {
        product_width = $(this).val();
        getLengthWidthPrice();
    });

    $("#product_length, #length_width_color").change(function() {
        product_length = $(this).val();
        getLengthWidthPrice();
    });

    $("#page_product_width, #page_product_length, #page_product_total_page, #page_product_total_sheets, #page_length_width_color, #page_product_total_quantity")
        .change(function() {
            getPageLengthWidthPrice();
        });

    $("#product_depth_width, #product_depth_total_page, #product_depth_length, #product_depth, #depth_color").change(
        function() {
            getDepthLengthWidthPrice();
        });
</script>
