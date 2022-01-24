<style type="text/css">
.attribute-items:nth-child(even) {
    background: #f1f1f1;
    padding: 3px 10px;
}
.attribute-items:nth-child(odd) {
    background: #e8e8e8;
    padding: 3px 10px;
}
</style>
<div class="content-wrapper" style="min-height: 687px;">
<section class="content">
    <div class="row">
        <div class="col-md-10 offset-md-1 mt-4">
            <div class="card">
                <div class="card-header">
                    <h5><?= $curNeighbor != null ? ('Edit Neighbor ' . $curNeighbor['name']) : 'Add a new neighbor' ?></h5>
                </div>
                <div class="card-body row">
                    <div class="col-md-12">
                        <? if ($curNeighbor) { ?>
                            <h3 class="mb-4 text-center bg-success text-white"><?= $curNeighbor['name'] ?></h3>
                        <? } ?>
                        <form action="<?= $BASE_URL . $class_name . "edit/$neighbor_id" ?>" method="post">
                            <? if (count($errors) > 0) { ?>
                                <div class="alert alert-danger alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    <? foreach($errors as $error)
                                        echo $error . "<br>"; ?>
                                </div>
                            <? } ?>
                            <? if ($message = $success) { ?>
                                <div class="alert alert-success alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert">×</button>   
                                        <strong><?= $message ?></strong>
                                </div>
                            <? } ?>
                            <div class="control-group info">
                                <div class="row align-items-center">
                                    <div class="col-md-3">
                                        <label class="span2" for="name">Neighbor Name</label>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="controls">
                                            <input class="form-control" name="name" type="text" placeholder="Neighbor Name" value="<?= $curNeighbor ? $curNeighbor['name'] : '' ?>" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="control-group info">
                                <div class="row align-items-center">
                                    <div class="col-md-3">
                                        <label class="span2" for="name">URL</label>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="controls">
                                            <input class="form-control" name="url" type="text" placeholder="URL" value="<?= $curNeighbor ? $curNeighbor['url'] : '' ?>" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12" style="text-align: right;">
                                    <button class="btn btn-primary" type="submit">Save</button>
                                    <? if ($curNeighbor) { ?>
                                        <a class="btn btn-success" href="<?= $BASE_URL . $class_name . "edit" ?>">Add a new Neighbor</a>
                                    <? } ?>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <? if ($curNeighbor) { ?>
                <div class="card-body row">
                    <div class="col-md-12">
                        <? if ($curAttribute) { ?>
                            <h4 class="mb-4 text-center bg-success text-white"><?= $curAttribute['name'] ?></h3>
                        <? } else { ?>
                            <h4 class="mb-4 text-center bg-success text-white">Add a new Attribute</h3>
                        <? } ?>
                        <form action="<?= $BASE_URL . $class_name . "attribute_put/$neighbor_id/" . $curAttribute['id'] ?>" method="post">
                            <!-- @if (count($errors->attribute->all()) > 0)
                                <div class="alert alert-danger alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    @foreach($errors->attribute->all() as $error)
                                            {{ $error }}<br>
                                    @endforeach
                                </div>
                            @endif -->
                            <? if ($message = $attribute_success) { ?>
                                <div class="alert alert-success alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert">×</button>   
                                        <strong><?= $message ?></strong>
                                </div>
                            <? } ?>
                            <input type="hidden" name="index" value="<? $curAttribute ? $curAttribute['index'] : count($attributes) ?>">
                            <? if (count($attributes) > 0) {
                                foreach ($attributes as $attribute) { ?>
                                    <div class="control-group info">
                                        <div class="row align-items-center">
                                            <div class="col-md-6 offset-md-3"><?= $attribute['name'] ?></div>
                                            <div class="col-md-3" style="text-align: right;">
                                                <a href="<?= $BASE_URL . $class_name . "edit/$neighbor_id/" . $attribute['id'] ?>"><i class="fa fa-pencil"></i></a>
                                                <a href="<?= $BASE_URL . $class_name . "attribute_up/$neighbor_id/" . $attribute['id'] ?>"><i class="fa fa-arrow-up"></i></a>
                                                <a href="<?= $BASE_URL . $class_name . "attribute_down/$neighbor_id/" . $attribute['id'] ?>"><i class="fa fa-arrow-down"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                <? } ?>
                                <hr>
                            <? } ?>
                            <div class="control-group info">
                                <div class="row align-items-center">
                                    <div class="col-md-3">
                                        <label class="span2" for="name">Attribute Name</label>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="controls">
                                            <input class="form-control" name="name" type="text" placeholder="Attribute Name" value="<?= $curAttribute ? $curAttribute['name'] : '' ?>" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12" style="text-align: right;">
                                    <button class="btn btn-primary" type="submit">Save</button>
                                    <? if ($curAttribute) { ?>
                                        <a class="btn btn-success" href="<?= $BASE_URL . $class_name . "edit/$neighbor_id" ?>">Add a new Attribute</a>
                                    <? } ?>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <? } ?>

                <? if ($curAttribute) { ?>
                <div class="card-body row">
                    <div class="col-md-12">
                        <? if ($curAttributeItem) { ?>
                            <h5 class="mb-4 text-center bg-success text-white"><?= $curAttributeItem['name'] ?></h3>
                        <? } else { ?>
                            <h5 class="mb-4 text-center bg-success text-white">Add a new Attribute Item</h3>
                        <? } ?>
                        <form action="<?= $BASE_URL . $class_name . "attribute_item_put/$neighbor_id/" . $curAttribute['id'] . "/" . $curAttributeItem['id'] ?>" method="post">
                            <input type="hidden" name="index" value="{{ $curItem ? $curItem->index : count($curAttribute->items) }}">
                            <!-- @if (count($errors->item->all()) > 0)
                                <div class="alert alert-danger alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    @foreach($errors->item->all() as $error)
                                            {{ $error }}<br>
                                    @endforeach
                                </div>
                            @endif -->
                            <? if ($message = $item_success) { ?>
                                <div class="alert alert-success alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert">×</button>   
                                        <strong><?= $message ?></strong>
                                </div>
                            <? } ?>
                            <? if (count($curAttributeItems) > 0) {
                                foreach ($curAttributeItems as $item) { ?>
                                    <div class="control-group info">
                                        <div class="row align-items-center">
                                            <div class="col-md-6 offset-md-3"><?= $item['name'] ?></div>
                                            <div class="col-md-3" style="text-align: right;">
                                                <a href="<?= $BASE_URL . $class_name . "edit/$neighbor_id/" . $attribute['id'] . "/" . $item['id'] ?>"><i class="fa fa-pencil"></i></a>
                                                <a href="<?= $BASE_URL . $class_name . "attribute_up/$neighbor_id/" . $attribute['id'] . "/" . $item['id'] ?>"><i class="fa fa-arrow-up"></i></a>
                                                <a href="<?= $BASE_URL . $class_name . "attribute_down/$neighbor_id/" . $attribute['id'] . "/" . $item['id'] ?>"><i class="fa fa-arrow-down"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                <? } ?>
                                <hr>
                            <? } ?>
                            <div class="control-group info">
                                <div class="row align-items-center">
                                    <div class="col-md-3">
                                        <label class="span2" for="name">Item Name</label>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="controls">
                                            <input class="form-control" name="name" type="text" placeholder="Item Name" value="<?= $curItem ? $curItem['name'] : '' ?>" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12" style="text-align: right;">
                                    <button class="btn btn-primary" type="submit">Save</button>
                                    <? if ($curAttributeItem) { ?>
                                        <a class="btn btn-success" href="<?= $BASE_URL . $class_name . "edit/$neighbor_id" . "/" . $curAttribute['id'] ?>">Add a new Attribute Item</a>
                                    <? } ?>
                                </div>
                            </div>
                        </form>
                        <? } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</div>

<script type="text/javascript">
$('.show-attributes-toggle').click(function() {
    var isChecked = this.checked;
    $('.attribute-items').each(function(index, element) {
        if (isChecked) {
            if ($(element).find('[type="text"]').val() == "") {
                $(element).addClass('hide');
            }
        }
        else
        $(element).removeClass('hide');
    });
});

$('button.right').click(function() {
    var index = $('button.right').index($(this));
    $($('.copy-dest')[index]).val($('.copy-source')[index].innerText);
    $($('.copy-dest')[index]).trigger('propertychange');
    // $($('[name="neighbor_attribute[]"]')[index]).val($('[name="attribute_name"]')[index].innerText);
    // $($('[name="neighbor_attribute[]"]')[index]).trigger('propertychange');
}).trigger('propertychange');

function searchAttribute(searchtext) {
    if(searchtext !=''){
        $("#loder-img").show();
        var url ='<?= $BASE_URL?>admin/Neighbor/searchAttribute/<?= $neighbor_id?>';
        $("#searchDiv").show();
        $("#AttributeListUl").html('');
        $.ajax({
            type: "POST",
            url: url,
            data:{'searchtext':searchtext}, // serializes the form's elements.
                success: function(data)
                {   $("#loder-img").hide();
                    $("#AttributeListUl").html(data);
                },
                error: function (error) {
                }
        });
    } else {
        $("#searchDiv").hide();
        $("#AttributeListUl").html('');
        $("#searchSgedAttributeTextBox").val('');
    }
}

function hidesearchDiv(){
    $("#searchDiv").hide();
    $("#AttributeListUl").html('');
}

$("#select-all").click(function () {
    if ($(this).prop("checked") == true) {
        $(".attribute_ids").prop('checked', true);
    } else {
        $(".attribute_ids").prop('checked', false);
    }
});
$('form').last().find('input:visible:first').focus();
</script>
