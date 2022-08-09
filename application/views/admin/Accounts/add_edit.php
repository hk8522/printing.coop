<script src="https://cdn.ckeditor.com/4.6.2/standard-all/ckeditor.js"></script>
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

.attribute-inner label,
.attribute-info-inner label {
    margin: 0px !important;
    padding-right: 5px;
}

.attribute-inner input,
.attribute-info-inner input {
    height: 30px;
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

.attribute-row {
    padding: 0px;
    background: #f9f9f9;
    height: 0px;
    overflow: hidden;
    margin-bottom: 0px;
}

.attribute.active .attribute-row {
    padding: 10px 10px 10px 25px;
    background: #f9f9f9;
    height: auto;
    margin-bottom: 10px;
}

.attribute-info {
    background: #fff;
    padding: 10px 10px;
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
<div class="content-wrapper" style="min-height: 687px;">
    <section class="content">
        <div class="row" style="display: flex;justify-content: center;align-items: center;">
            <div class="col-md-12 col-xs-12">
                <div class="box box-success box-solid">
                    <div class="box-body">
                        <div class="inner-head-section">
                            <div class="inner-title">
                                <span><?=$page_title?></span>
                            </div>
                        </div>
                        <div class="inner-content-area">
                            <div class="row justify-content-center">
                                <div class="col-md-12">
                                    <div class="text-center" style="color:red">
                                        <?=$this->session->flashdata('message_error')?>
                                    </div>
                                    <?=form_open_multipart('', array('class' => 'form-horizontal'))?>
                                    <input class="form-control" name="id" type="hidden"
                                        value="<?=isset($postData['id']) ? $postData['id'] : ''?>" id="product_id">
                                    <div class="form-role-area">
                                        <div class="control-group info">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label class="span2" for="inputMame">Store</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <div class="controls">
                                                        <div class="row">
                                                            <div class="col-md-12">

                                                                <?php
                                                                $store_ids = isset($postData['store_ids']) ? explode(',', $postData['store_ids']) : '';
                                                                foreach ($StoreList as $key => $val) {
                                                                    $selected = '';
                                                                    if (in_array($val['id'], $store_ids)) {
                                                                        $selected = 'checked';
                                                                    }
                                                                    ?>
                                                                    <input type="checkbox" value="<?=$val['id']?>"
                                                                        <?=$selected?> name="store_ids[]">&nbsp;
                                                                    <?= $val['name'] ?>
                                                                <?php } ?>
                                                                <?=form_error('store_ids[]')?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="control-group info">
                                            <div class="row align-items-center">
                                                <div class="col-md-3">
                                                    <label class="span2" for="inputMame">Name</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <div class="controls">
                                                        <input class="form-control" name="name" id="name" type="text"
                                                            placeholder="Name"
                                                            value="<?=isset($postData['name']) ? $postData['name'] : ''?>"
                                                            maxlength="50">
                                                        <?=form_error('name')?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="control-group info">
                                            <div class="row align-items-center">
                                                <div class="col-md-3">
                                                    <label class="span2" for="inputMame">Email</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <div class="controls">
                                                        <input class="form-control" name="email" id="email" type="text"
                                                            placeholder="email"
                                                            value="<?=isset($postData['email']) ? $postData['email'] : ''?>">
                                                        <?=form_error('email')?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="control-group info">
                                            <div class="row align-items-center">
                                                <div class="col-md-3">
                                                    <label class="span2" for="inputMame">Mobile</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <div class="controls">
                                                        <input class="form-control" name="mobile" id="mobile"
                                                            type="text" placeholder="mobile"
                                                            value="<?=isset($postData['mobile']) ? $postData['mobile'] : ''?>">
                                                        <?=form_error('mobile')?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="control-group info">
                                            <div class="row align-items-center">
                                                <div class="col-md-3">
                                                    <label class="span2" for="inputMame">User Name</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <div class="controls">
                                                        <input class="form-control" name="username" id="username"
                                                            type="text" placeholder="User Name"
                                                            value="<?=isset($postData['username']) ? $postData['username'] : ''?>">
                                                        <?=form_error('username')?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="control-group info">
                                            <div class="row align-items-center">
                                                <div class="col-md-3">
                                                    <label class="span2" for="inputMame">Password</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <div class="controls">
                                                        <input class="form-control" name="password" id="password"
                                                            type="password" placeholder="password" value="">
                                                        <?=form_error('password')?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="control-group info">
                                            <div class="row align-items-center">
                                                <div class="col-md-3">
                                                    <label class="span2" for="inputMame">Address</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <div class="controls">
                                                        <input class="form-control" name="address" id="address"
                                                            type="text" placeholder="Address"
                                                            value="<?=isset($postData['address']) ? $postData['address'] : ''?>"
                                                            maxlength="100">
                                                        <?=form_error('address')?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="control-group info">
                                            <div class="row">
                                                <div class="col-md-3" style="">
                                                    <label class="span2" for="inputMame">Module Access
                                                        Permission</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <div class="controls small-controls">
                                                        <?php foreach ($AttributesList as $key => $val) { //pr($AttributesList); die('OK');?>
                                                            <div class="attribute <?php if (array_key_exists($key, $ProductAttributes)) { echo "active"; } ?>" id="attribute_id_div_<?=$key?>">
                                                                <!-- Toggle "active" class when clicked on input(checkbox) below -->
                                                                <div class="attribute-title">
                                                                    <div class="row align-items-center">
                                                                        <div class="col-md-12">
                                                                            <label class="span2">
                                                                                <input type="checkbox" value="<?=$key?>"
                                                                                    name="attribute_id_<?=$key?>"
                                                                                    id="attribute_id_<?=$key?>" <?php if (array_key_exists($key, $ProductAttributes)) { echo "checked"; } ?> onchange="addActiveClass('<?=$key?>')"><?=$val['name']?>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="attribute-row">
                                                                    <div class="row">
                                                                        <?php foreach ($val['items'] as $subkey => $subval) {?>
                                                                            <div class="col-md-6">
                                                                                <div class="attribute-info">
                                                                                    <div class="row">
                                                                                        <div class="col-md-12">
                                                                                            <label class="span2">
                                                                                                <input type="checkbox"
                                                                                                    value="<?=$subkey?>"
                                                                                                    name="attribute_item_id_<?=$key?>[]" <?php if (isset($ProductAttributes[$key]['items']) && array_key_exists($subkey, $ProductAttributes[$key]['items'])) { echo "checked"; } ?>>
                                                                                                <?=$subval?>
                                                                                            </label>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        <?php }?>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        <?php }?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="product-actions-btn text-right">
                                            <button type="submit" class="btn btn-success" id="submitBtn">Submit</button>
                                            <a href="<?=$BASE_URL . $class_name . $main_page_url?>"
                                                class="btn btn-success">Back</a>
                                        </div>
                                        <?=form_close()?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col-->
        </div>
        <!-- ./row -->
    </section>
    <!-- /.content -->
</div>
<script>
function isNumber(evt) {
    var iKeyCode = (evt.which) ? evt.which : evt.keyCode
    if (iKeyCode != 46 && iKeyCode > 31 && (iKeyCode < 48 || iKeyCode > 57))
        return false;

    return true;
}

function addActiveClass(id) {
    if ($('#attribute_id_' + id).prop('checked') == true) {
        $('#attribute_id_div_' + id).addClass('active');
    } else {
        $('#attribute_id_div_' + id).removeClass('active');
    }
}
</script>