<?php
$i = 2;
$j = 1;
$k = 2;
$last = 1;
if (!empty($AtirbuteProductSizes)) {
    $last = $last + count($AtirbuteProductSizes);
}
//echo $last;
if (!empty($options_size)) {
    if ($j == $last) {
        $onchange = "getPaperPrice('$i')";
    } else {
        $onchange = "showSizeQuantity()";
    }
    ?>
<div class="single-review">
    <label><?= $language_name == 'French' ? 'Taille' : 'Size'?><span class="required">*</span></label>
    <select name="product_size_id" required onchange="<?= $onchange?>" <?= $size_disabled ? 'disabled' : ''?>
        class="multipal_size">
        <?= $options_size?>
    </select>
</div>
<?php
    $j++;
    $k++;
}?>
<?php
#pr($AtirbuteProductSizes,1);
$l = 1;
foreach ($AtirbuteProductSizes as $mkey => $mval) {
    if (!empty($product_quantity_id) && !empty($product_size_id)) {
        $attribute_items = isset($mval['attribute_items']) ? $mval['attribute_items'] : array();
    } else if (!empty($product_quantity_id) && empty($product_size_id)) {
        $attribute_items = array();
    } else {
        $attribute_items = array();
    }

    if ($j == $last) {
        $onchange = "getPaperPrice('$i')";
    } else {
        $onchange = "getQuantityPrice('product_size_option_$k')";
    }

    $disabled = 'disabled';
    if (!empty($product_size_id) && $l == 1) {
        $disabled = '';
    }
?>
<div class="single-review">
    <label>
        <?= $language_name == 'French' ? $mval['attributes_name_french'] : $mval['attribute_name']?>
        <span class="required">*</span>
    </label>
    <select name="multiple_attribute_<?= $mkey?>" required id="product_size_option_<?= $j?>" required <?= $disabled?>
        onchange="<?= $onchange?>" class="multipal_size multipal_size_item">
        <?= $options?>
        <?php foreach ($attribute_items as $akey => $aval) { ?>
            <option value="<?= $akey?>">
                <?= $language_name == 'French' ? $aval['attributes_item_name_french'] : $aval['attributes_item_name']?>
            </option>
        <?php } ?>
    </select>
</div>
<?php
    $j++;
    $k++;
    $l++;
}
?>
<script>
function getQuantityPrice(nid) {
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
                $("#" + nid).attr("disabled", false);

                // $('[name="price"]').val(json.price);
                $("#total-price").html((json.price * $("#quantity").val()).toFixed(2));
            }
        },
        error: function(resp) {
            console.log(resp);
            $("#loader-img").hide();
            $(".new-price-img").show();
        }
    });
}

function getPaperPrice(nid) {
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
                $("#attribute_id_" + nid).attr("disabled", false);

                // $('[name="price"]').val(json.price);
                $("#total-price").html((json.price * $("#quantity").val()).toFixed(2));
            }
        }
    });
}
</script>