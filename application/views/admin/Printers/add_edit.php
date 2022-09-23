<div class="content-wrapper" style="min-height: 687px;">
    <section class="content">
        <div class="row" style="display: flex;justify-content: center;align-items: center;">
            <div class="col-md-12 col-xs-12">
                <div class="box box-success box-solid">
                    <div class="box-body">
                        <div class="inner-head-section">
                            <div class="inner-title">
                                <span><?= $page_title ?></span>
                            </div>
                        </div>
                        <div class="inner-content-area">
                            <div class="row justify-content-center">
                                <div class="col-md-7">
                                    <div class="text-center" style="color:red ;margin-bottom:10px;">
                                        <?= $this->session->flashdata('message_error') ?>
                                    </div>
                                    <?= form_open('',array('class' => 'form-horizontal')) ?>
                                     <input class="form-control" name="id" type="hidden"  value="<?= isset($postData['id']) ? $postData['id'] : '' ?>">

                                    <input class="form-control" name="type" type="hidden"  value="<?= $type ?>">

                                    <div class="form-role-area">
                                    <?php if ($type =='printer_series' || $type =='printermodels') { ?>
                                        <div class="control-group info">
                                            <div class="row align-items-center">
                                                <div class="col-md-4">
                                                    <label class="span2" for="inputMame">Printer Brands</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="controls">
                                                        <select name="printer_brand_id" class="form-control" id="printer_brand_id">
                                                            <option value="">Select Printer Brands</option>
                                                           <?php
                                                            foreach ($PrinterBrandLists as $list) {
                                                            $selected='';
                                                            if ($list['id']==$postData['printer_brand_id']) {
                                                                $selected='selected="selected"';
                                                            }
                                                            ?>
                                                             <option value="<?= $list['id']?>" <?= $selected?>><?= $list['name'] ?></option>
                                                        <?php } ?>
                                                        </select>
                                                        <?= form_error('printer_brand_id') ?>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                   } ?>
                                    <?php
                                    #pr($postData);
                                    if ($type =='printermodels') { ?>
                                        <div class="control-group info">
                                            <div class="row align-items-center">
                                                <div class="col-md-4">
                                                    <label class="span2" for="inputMame">Printer Series</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="controls">
                                                        <select name="printer_series_id" class="form-control" id="printer_series_id">
                                                            <option value="">Select Printer Series</option>
                                                           <?php

                                                            foreach ($PrinterSeriesLists as $list) {
                                                            $selected='';
                                                            if ($list['id']==$postData['printer_series_id']) {
                                                                $selected='selected="selected"';
                                                            }
                                                            ?>
                                                             <option value="<?= $list['id']?>" <?= $selected?>><?= $list['name'] ?></option>
                                                        <?php } ?>
                                                        </select>
                                                        <?= form_error('printer_series_id') ?>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                   } ?>
                                        <div class="control-group info">
                                            <div class="row align-items-center">
                                                <div class="col-md-4">
                                                    <label class="span2" for="inputMame">Name</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="controls">
                                                        <input class="form-control" type="text" name="name" value="<?= isset($postData['name']) ? $postData['name'] : '' ?>" maxlength="50">
                                                        <?= form_error('name') ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="control-group info">
                                            <div class="row align-items-center">
                                                <div class="col-md-4">
                                                    <label class="span2" for="inputMame">French Name</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="controls">
                                                        <input class="form-control" type="text" name="name_french" value="<?= isset($postData['name_french']) ? $postData['name_french'] : '' ?>" maxlength="50">
                                                        <?= form_error('name_french') ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                        <div class="text-right">
                                            <button type="submit" class="btn btn-success">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- /.box -->
            </div><!-- /.col-->
        </div><!-- ./row -->
    </section><!-- /.content -->
 </div>
 <script>
  $('#printer_brand_id').on('change', function (e) {
        var printer_brand_id=$(this).val();
        $('#printer_series_id').html('<option value="">Select Printer Series</option>');
        $.ajax({
        type: 'GET',
        dataType: 'html',
        url: '<?= $BASE_URL ?>admin/Ajax/getPrinterSeriesListByAjax/'+printer_brand_id,
        cache: false,
        contentType: false,
        processData: false,
        success: function (data) {
            $('#printer_series_id').html(data);
        }
        });
    });
 </script>
