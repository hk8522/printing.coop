<style type="text/css">
.controls.small-control {
    position: relative;
}

.entrynew.input-group .form-control {
    width: 100px;
}

.attribute-inner,
.attribute-info-inner {
    text-align: center;
    display: flex;
    align-items: center;
    justify-content: flex-end;
}

.attribute-info .row .col-md-6:nth-child(2) .attribute-info-inner {
    justify-content: flex-start;
}

#WidthAndLengthSection .attribute-info .row .col-md-6:nth-child(2) .attribute-info-inner {
    justify-content: flex-end;
}

.for-att-multi .attribute-info .row .col-md-6:nth-child(2) .attribute-info-inner {
    justify-content: flex-end;
}

.for-att-multi .attribute-info .row .col-md-12 .attribute-info-inner {
    padding-left: 0px;
    margin-top: 5px;
}

.attribute-inner label,
.attribute-info-inner label {
    margin: 0px !important;
    padding-right: 5px;
}

.control-group .attribute-inner input,
.control-group .attribute-info-inner input {
    height: 30px !important;
    padding: 5px 5px !important;
    color: #000;
    background-color: rgb(255, 255, 255);
    background-image: none;
    border: 1px solid #ccc !important;
    border-radius: 4px !important;
    font-size: 13px;
    width: 80px;
    text-align: center;
}

.control-group .attribute-info-inner select {
    height: 30px !important;
    padding: 5px 5px !important;
    color: #000;
    background-color: rgb(255, 255, 255);
    background-image: none;
    border: 1px solid #ccc !important;
    border-radius: 4px !important;
    font-size: 13px;
    width: 100%;
    text-align: left;
}

.attribute-row {
    padding: 0px;
    background: #f9f9f9;
    height: 0px;
    overflow: hidden;
    margin-bottom: 0px;
}

.attribute-row.field-area {
    padding: 10px 10px 10px 10px;
    background: #f9f9f9;
    height: auto;
}

.attribute.active .attribute-row {
    padding: 10px 10px 10px 25px;
    background: #f9f9f9;
    height: auto;
    margin-bottom: 10px;
}

.attribute-info {
    background: #fff;
    padding: 5px 5px;
    margin-bottom: 10px;
}

.attribute-info-inner {
    padding: 0px 0px 0px 20px;
}

.attribute-title {
    background: #f1f1f1;
    padding: 5px 10px;
}

.attribute {
    padding-bottom: 10px;
}

.controls.small-controls .attribute:last-child {
    margin: 0px;
    padding: 0px;
}

.control-group .controls.small-controls .attribute-title .span2 {
    margin-bottom: 0px !important;
}
</style>
<div class="inner-content-area">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="text-center" style="color:red">
                <?= $this->session->flashdata('message_error') ?>
            </div>
            <div class="text-center" style="color:green">
                <?= $this->session->flashdata('message_success') ?>
            </div>
            <?= form_open_multipart('', array('class' => 'form-horizontal', 'id' => 'AddEditProductAttribute')) ?>
            <input class="form-control" type="hidden" value="<?= $product_id ?>" id="product_id" name="product_id">
            <input class="form-control" type="hidden" value="<?= $quantity_id ?>" id="quantity_id" name="quantity_id">
            <input class="form-control" name="size_id" type="hidden" value="<?= $size_id ?>" id="size_id">

            <div class="form-role-area">
                <div class="control-group info">
                    <div class="row align-items-center">
                        <div class="col-md-12">

                            <div class="attribute active">

                                <div class="for-att-multi attribute-row SizeQuantity">
                                    <?php
                                    //pr($NCRNumberPartsList,1);
                                    if (!empty($attribute)) {
                                        $last = count($attribute) - 1;
                                        foreach ($attribute as $subkey => $subval) { #pr($subval);
                                            ?>
                                    <div class="row sqddata">
                                        <div class="col-md-12">
                                            <?php
                                                    $displayplusnbtn = 'none';
                                                    $displayminusbtn = '';
                                                    if ($last == 0) {
                                                        $displayplusnbtn = '';
                                                        $displayminusbtn = '';
                                                    } else if ($last == $subkey) {
                                                        $displayplusnbtn = '';
                                                        $displayminusbtn = '';
                                                    }
                                                    ?>

                                            <div class="add-new-btn">
                                                <button class="btn-danger sqbtn-remove" type="button"
                                                    style="display:<?= $displayminusbtn ?>"
                                                    onclick="RemoveRow($(this))">
                                                    <span class="fa fa-minus"></span>
                                                </button>
                                                <button class="btn-success sqbtn-add" type="button"
                                                    style="display:<?= $displayplusnbtn ?>" onclick="AddRow($(this))">
                                                    <span class="fa fa-plus"></span>
                                                </button>
                                            </div>

                                        </div>
                                        <div class="col-md-6">
                                            <div class="attribute-info">
                                                <div class="row align-items-center">
                                                    <div class="col-8 col-md-6">
                                                        <label class="form-inner-label">Paper Quality</label>
                                                    </div>
                                                    <div class="col-4 col-md-6">
                                                        <div class="attribute-info-inner">
                                                            <input type="text" name="paper_quality_extra_price[]"
                                                                onkeypress="javascript:return isNumber(event)"
                                                                placeholder="Extra Price" class="form-control"
                                                                value='<?= showValue($subval['paper_quality_extra_price']) ?>'>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="attribute-info-inner">
                                                            <select name="paper_quality[]" class="form-control">
                                                                <option value="">--Select--</option>
                                                                <?php
                                                                        foreach ($PaperQualityList as $list) {
                                                                            $selected = '';
                                                                            if ($list['name'] == $subval['paper_quality']) {
                                                                                $selected = 'selected="selected"';
                                                                            }
                                                                            ?>
                                                                <option
                                                                    value='<?= $list['name'] . '@' . $list['name_french'] ?>'
                                                                    <?= $selected ?>><?= $list['name'] ?>
                                                                </option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="attribute-info">
                                                <div class="row align-items-center">
                                                    <div class="col-8 col-md-6">
                                                        <label class="form-inner-label">NCR Number of Parts</label>
                                                    </div>
                                                    <div class="col-4 col-md-6">
                                                        <div class="attribute-info-inner">
                                                            <input type="text" name="ncr_number_part_price[]"
                                                                onkeypress="javascript:return isNumber(event)"
                                                                placeholder="Extra Price"
                                                                value='<?= showValue($subval['ncr_number_part_price']) ?>'
                                                                class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="attribute-info-inner">
                                                            <select name="ncr_number_parts[]" class="form-control">
                                                                <option value="">
                                                                    --Select--
                                                                </option>
                                                                <?php
                                                                        foreach ($NCRNumberPartsList as $list) {
                                                                            $selected = '';
                                                                            if ($subval['ncr_number_parts'] == $list['name']) {
                                                                                $selected = 'selected="selected"';
                                                                            }
                                                                            ?>
                                                                <option
                                                                    value='<?= $list['name'] . '@' . $list['name_french'] ?>'
                                                                    <?= $selected ?>><?= $list['name'] ?>
                                                                </option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="attribute-info">
                                                <div class="row align-items-center">
                                                    <div class="col-8 col-md-6">
                                                        <label class="form-inner-label">Background</label>
                                                    </div>
                                                    <div class="col-4 col-md-6">
                                                        <div class="attribute-info-inner">
                                                            <input type="text"
                                                                value='<?= showValue($subval['stock_extra_price']) ?>'
                                                                name="stock_extra_price[]"
                                                                onkeypress="javascript:return isNumber(event)"
                                                                placeholder="Extra Price" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="attribute-info-inner">
                                                            <select name="stock[]" class="form-control">
                                                                <option value="">
                                                                    --Select--
                                                                </option>
                                                                <?php
                                                                        foreach ($StockList as $list) {
                                                                            $selected = '';
                                                                            if ($list['name'] == $subval['stock']) {
                                                                                $selected = 'selected="selected"';
                                                                            }
                                                                            ?>
                                                                <option
                                                                    value='<?= $list['name'] . '@' . $list['name_french'] ?>'
                                                                    <?= $selected ?>><?= $list['name'] ?>
                                                                </option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="attribute-info">
                                                <div class="row align-items-center">
                                                    <div class="col-8 col-md-6">
                                                        <label class="form-inner-label">Printed Color</label>
                                                    </div>
                                                    <div class="col-4 col-md-6">
                                                        <div class="attribute-info-inner">
                                                            <input type="text"
                                                                value='<?= showValue($subval['color_extra_price']) ?>'
                                                                name="color_extra_price[]"
                                                                onkeypress="javascript:return isNumber(event)"
                                                                placeholder="Extra Price" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="attribute-info-inner">
                                                            <select name="color[]" class="form-control">
                                                                <option value="">
                                                                    --Select--
                                                                </option>
                                                                <?php
                                                                        foreach ($ColorList as $list) {
                                                                            $selected = '';
                                                                            if ($list['name'] == $subval['color']) {
                                                                                $selected = 'selected="selected"';
                                                                            }
                                                                            ?>
                                                                <option
                                                                    value='<?= $list['name'] . '@' . $list['name_french'] ?>'
                                                                    <?= $selected ?>><?= $list['name'] ?>
                                                                </option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="attribute-info">
                                                <div class="row align-items-center">
                                                    <div class="col-8 col-md-6">
                                                        <label class="form-inner-label">Diameter</label>
                                                    </div>
                                                    <div class="col-4 col-md-6">
                                                        <div class="attribute-info-inner">
                                                            <input type="text"
                                                                value='<?= showValue($subval['diameter_extra_price']) ?>'
                                                                name="diameter_extra_price[]"
                                                                onkeypress="javascript:return isNumber(event)"
                                                                placeholder="Extra Price" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="attribute-info-inner">
                                                            <select name="diameter[]" class="form-control">
                                                                <option value="">
                                                                    --Select--
                                                                </option>
                                                                <?php
                                                                        foreach ($DiameterList as $list) {
                                                                            $selected = '';
                                                                            if ($list['name'] == $subval['diameter']) {
                                                                                $selected = 'selected="selected"';
                                                                            }
                                                                            ?>
                                                                <option
                                                                    value='<?= $list['name'] . '@' . $list['name_french'] ?>'
                                                                    <?= $selected ?>><?= $list['name'] ?>
                                                                </option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="attribute-info">
                                                <div class="row align-items-center">
                                                    <div class="col-8 col-md-6">
                                                        <label class="form-inner-label">Coating</label>
                                                    </div>
                                                    <div class="col-4 col-md-6">
                                                        <div class="attribute-info-inner">
                                                            <input type="text"
                                                                value='<?= showValue($subval['shape_paper_extra_price']) ?>'
                                                                name="shape_paper_extra_price[]"
                                                                onkeypress="javascript:return isNumber(event)"
                                                                placeholder="Extra Price" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="attribute-info-inner">
                                                            <select name="shape_paper[]" class="form-control">
                                                                <option value="">
                                                                    --Select--
                                                                </option>
                                                                <?php
                                                                        foreach ($ShapePaperList as $list) {
                                                                            $selected = '';
                                                                            if ($list['name'] == $subval['shape_paper']) {
                                                                                $selected = 'selected="selected"';
                                                                            }
                                                                            ?>
                                                                <option
                                                                    value='<?= $list['name'] . '@' . $list['name_french'] ?>'
                                                                    <?= $selected ?>><?= $list['name'] ?>
                                                                </option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="attribute-info">
                                                <div class="row align-items-center">
                                                    <div class="col-8 col-md-6">
                                                        <label class="form-inner-label">Grommets</label>
                                                    </div>
                                                    <div class="col-4 col-md-6">
                                                        <div class="attribute-info-inner">
                                                            <input type="text"
                                                                value='<?= showValue($subval['grommets_extra_price']) ?>'
                                                                name="grommets_extra_price[]"
                                                                onkeypress="javascript:return isNumber(event)"
                                                                placeholder="Extra Price" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="attribute-info-inner">
                                                            <select name="grommets[]" class="form-control">
                                                                <option value="">
                                                                    --Select--
                                                                </option>
                                                                <?php
                                                                        foreach ($Grommets as $list) {
                                                                            $selected = '';
                                                                            if ($list['name'] == $subval['grommets']) {
                                                                                $selected = 'selected="selected"';
                                                                            }
                                                                            ?>
                                                                <option
                                                                    value='<?= $list['name'] . '@' . $list['name_french'] ?>'
                                                                    <?= $selected ?>><?= $list['name'] ?>
                                                                </option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php }
                                    } else{ ?>
                                    <div class="row sqddata">
                                        <div class="col-md-12">
                                            <div class="attribute-info-inner">
                                                <span class="input-group-btn">
                                                    <button class="btn btn-danger sqbtn-remove" type="button"
                                                        style="display:none" onclick="RemoveRow($(this))">
                                                        <span class="fa fa-minus"></span>
                                                    </button>
                                                    <button class="btn btn-success sqbtn-add" type="button"
                                                        onclick="AddRow($(this))">
                                                        <span class="fa fa-plus"></span>
                                                    </button>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="attribute-info">
                                                <div class="row align-items-center">
                                                    <div class="col-8 col-md-6">
                                                        <label class="form-inner-label">Paper Quality</label>
                                                    </div>
                                                    <div class="col-4 col-md-6">
                                                        <div class="attribute-info-inner">
                                                            <input type="text" value=""
                                                                name="paper_quality_extra_price[]"
                                                                onkeypress="javascript:return isNumber(event)"
                                                                placeholder="Extra Price" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="attribute-info-inner">
                                                            <select name="paper_quality[]" class="form-control">
                                                                <option value="">
                                                                    --Select--
                                                                </option>
                                                                <?php foreach ($PaperQualityList as $list) { ?>
                                                                <option
                                                                    value='<?= $list['name'] . '@' . $list['name_french'] ?>'>
                                                                    <?= $list['name'] ?>
                                                                </option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="attribute-info">
                                                <div class="row align-items-center">
                                                    <div class="col-8 col-md-6">
                                                        <label class="form-inner-label">NCR Number of Parts</label>
                                                    </div>
                                                    <div class="col-4 col-md-6">
                                                        <div class="attribute-info-inner">
                                                            <input type="text" value="" name="ncr_number_part_price[]"
                                                                onkeypress="javascript:return isNumber(event)"
                                                                placeholder="Extra Price" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="attribute-info-inner">
                                                            <select name="ncr_number_parts[]" class="form-control">
                                                                <option value="">
                                                                    --Select--
                                                                </option>
                                                                <?php foreach ($NCRNumberPartsList as $list) { ?>
                                                                <option
                                                                    value='<?= $list['name'] . '@' . $list['name_french'] ?>'>
                                                                    <?= $list['name'] ?>
                                                                </option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="attribute-info">
                                                <div class="row align-items-center">
                                                    <div class="col-8 col-md-6">
                                                        <label class="form-inner-label">Background</label>
                                                    </div>
                                                    <div class="col-4 col-md-6">
                                                        <div class="attribute-info-inner">
                                                            <input type="text" value="" name="stock_extra_price[]"
                                                                onkeypress="javascript:return isNumber(event)"
                                                                placeholder="Extra Price" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="attribute-info-inner">
                                                            <select name="stock[]" class="form-control">
                                                                <option value="">
                                                                    --Select--
                                                                </option>
                                                                <?php foreach ($StockList as $list) { ?>
                                                                <option
                                                                    value='<?= $list['name'] . '@' . $list['name_french'] ?>'>
                                                                    <?= $list['name'] ?>
                                                                </option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="attribute-info">
                                                <div class="row align-items-center">
                                                    <div class="col-8 col-md-6">
                                                        <label class="form-inner-label">Printed Color</label>
                                                    </div>
                                                    <div class="col-4 col-md-6">
                                                        <div class="attribute-info-inner">
                                                            <input type="text" value="" name="color_extra_price[]"
                                                                onkeypress="javascript:return isNumber(event)"
                                                                placeholder="Extra Price" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="attribute-info-inner">
                                                            <select name="color[]" class="form-control">
                                                                <option value="">
                                                                    --Select--
                                                                </option>
                                                                <?php foreach ($ColorList as $list) { ?>
                                                                <option
                                                                    value='<?= $list['name'] . '@' . $list['name_french'] ?>'>
                                                                    <?= $list['name'] ?>
                                                                </option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="attribute-info">
                                                <div class="row align-items-center">
                                                    <div class="col-8 col-md-6">
                                                        <label class="form-inner-label">Diameter</label>
                                                    </div>
                                                    <div class="col-4 col-md-6">
                                                        <div class="attribute-info-inner">
                                                            <input type="text" value="" name="diameter_extra_price[]"
                                                                onkeypress="javascript:return isNumber(event)"
                                                                placeholder="Extra Price" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="attribute-info-inner">
                                                            <select name="diameter[]" class="form-control">
                                                                <option value="">
                                                                    --Select--
                                                                </option>
                                                                <?php foreach ($DiameterList as $list) { ?>
                                                                <option
                                                                    value='<?= $list['name'] . '@' . $list['name_french'] ?>'>
                                                                    <?= $list['name'] ?>
                                                                </option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="attribute-info">
                                                <div class="row align-items-center">
                                                    <div class="col-8 col-md-6">
                                                        <label class="form-inner-label">Coating</label>
                                                    </div>
                                                    <div class="col-4 col-md-6">
                                                        <div class="attribute-info-inner">
                                                            <input type="text" value="" name="shape_paper_extra_price[]"
                                                                onkeypress="javascript:return isNumber(event)"
                                                                placeholder="Extra Price" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="attribute-info-inner">
                                                            <select name="shape_paper[]" class="form-control">
                                                                <option value="">
                                                                    --Select--
                                                                </option>
                                                                <?php foreach ($ShapePaperList as $list) { ?>
                                                                <option
                                                                    value='<?= $list['name'] . '@' . $list['name_french'] ?>'>
                                                                    <?= $list['name'] ?>
                                                                </option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="attribute-info">
                                                <div class="row align-items-center">
                                                    <div class="col-8 col-md-6">
                                                        <label class="form-inner-label">Grommets</label>
                                                    </div>
                                                    <div class="col-4 col-md-6">
                                                        <div class="attribute-info-inner">
                                                            <input type="text" value="" name="grommets_extra_price[]"
                                                                onkeypress="javascript:return isNumber(event)"
                                                                placeholder="Extra Price" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="attribute-info-inner">
                                                            <select name="grommets[]" class="form-control">
                                                                <option value="">
                                                                    --Select--
                                                                </option>
                                                                <?php foreach ($Grommets as $list) { ?>
                                                                <option
                                                                    value='<?= $list['name'] . '@' . $list['name_french'] ?>'>
                                                                    <?= $list['name'] ?>
                                                                </option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-right">
                    <button type="submit" class="btn btn-success" id="submitBtn">Submit</button>
                </div>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>
<script src="<?= $BASE_URL ?>/assets/js/validation.js"></script>
<script>
function AddRow(cr) {
    var controlForm = $('.SizeQuantity:first'),
        currentEntry = cr.parents('.sqddata:first'),
        newEntry = $(currentEntry.clone()).appendTo(controlForm);

    newEntry.find('input').val('');
    newEntry.find('textarea').val('');
    newEntry.find('select').val('');

    var timestamp = new Date().getUTCMilliseconds();
    newEntry.find('input').attr('id', timestamp);

    newEntry.find('.sqbtn-remove').show();
    controlForm.find('.sqbtn-remove').show();
    controlForm.find('.sqbtn-add').hide();
    newEntry.find('.sqbtn-add').show();
}

function RemoveRow(cr, id) {
    cr.parents('.sqddata:first').remove();
    var numItems = $('.SizeQuantity .' + id + 'sqddata').length;
    var controlForm = $('.SizeQuantity .' + id + 'sqddata').last();
    if (numItems == 1) {
        controlForm.find('.sqbtn-remove').hide();
        controlForm.find('.sqbtn-add').show();
    } else {
        controlForm.find('.sqbtn-remove').show();
        controlForm.find('.sqbtn-add').show();
    }
    return false;
}

success = '<?= $success ?>';
$('#AddEditProductAttribute').validate({
    rules: {},
    messages: {},
    submitHandler: function(form) {
        $('#loader-img').show();
        var url = '<?= $BASE_URL ?>admin/Products/AddEditProductAttribute';
        $.ajax({
            type: "POST",
            url: url,
            data: $(form).serialize(), // serializes the form's elements.
            beforeSend: function() {
                $('button[type=submit]').attr('disabled', true);
            },
            success: function(data) {
                $('button[type=submit]').attr('disabled', false);
                $('#loader-img').hide();
                $('#QualityModal .modal-body').html(data);
                if (success == 1) {
                    location.reload();
                }
            }
        });
    },
});
</script>