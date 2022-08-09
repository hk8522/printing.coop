<link rel="stylesheet" type="text/css" href="<?= $BASE_URL ?>assets/admin/css/treeview.css"/>
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
<section class="content"><div class="row"><div class="col-md-10 offset-md-1 mt-4"><div class="card">
    <div class="card-header">
        <h5><?= $curNeighbor != null ? ('Edit Neighbor ' . $curNeighbor['name']) : 'Add a new neighbor' ?></h5>
    </div>
    <div class="card-body row">
        <div class="col-md-12">
            <? if ($curNeighbor) { ?>
                <h3 class="mb-4 text-center bg-success text-white"><?= $curNeighbor['name'] ?></h3>
            <? } ?>
            <form method="post" action="<?= $BASE_URL . $class_name . "edit/$neighbor_id" ?>">
                <? if (count($errors) > 0) { ?>
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <? foreach ($errors as $error)
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
                    <div class="col-md-12 right">
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
            <!-- @if (count($errors->attribute->all()) > 0)
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    @foreach ($errors->attribute->all() as $error)
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
            <ul id="tree1" class="glyphicon-plus-sign">
                <? foreach ($attributes as $attribute) { ?>
                    <li id="attribute-<?= $attribute['id'] ?>">
                        <div class="row align-items-center">
                            <div class="col-md-10 branch-title">
                                <i class="fa fa-plus"></i> <?= $attribute['name'] ?>
                            </div>
                            <div class="col-md-2 right folding">
                                <a href="<?= $BASE_URL . $class_name . "edit/$neighbor_id/" . $attribute['id'] . "#attribute-" . $attribute['id'] ?>"><i class="fa fa-edit"></i></a>
                                <a href="<?= $BASE_URL . $class_name . "attribute_up/$neighbor_id/" . $attribute['id'] . "#attribute-" . $attribute['id'] ?>"><i class="fa fa-arrow-up"></i></a>
                                <a href="<?= $BASE_URL . $class_name . "attribute_down/$neighbor_id/" . $attribute['id'] . "#attribute-" . $attribute['id'] ?>"><i class="fa fa-arrow-down"></i></a>
                                <form method="post" onsubmit="return confirmDelete();" action="<?= $BASE_URL . $class_name . "attribute_delete/$neighbor_id/" . $attribute['id'] ?>">
                                    <input type="hidden" name="id" value="<?= $attribute['id'] ?>">
                                    <button type="submit" class="btn bg-transparent btn-tight"><i class="fa fa-trash"></i></button>
                                </form>
                            </div>
                        </div>
                        <? if ($attribute['id'] == $attribute_id && empty($curAttributeItem)) { ?>
                            <form method="post" action="<?= $BASE_URL . $class_name . "attribute_put/$neighbor_id/" . $attribute['id'] ?>">
                                <input type="hidden" name="index" value="<?= $curAttribute['index'] ?>">
                                <div class="row">
                                    <div class="col-md-10">
                                        <div class="controls">
                                            <input class="form-control" name="name" type="text" placeholder="Attribute Name" value="<?= $attribute ? $attribute['name'] : '' ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-2 right">
                                        <button class="btn btn-primary" type="submit">Save</button>
                                    </div>
                                </div>
                            </form>
                        <? } ?>
                        <? if (count($attributeItemsForNeighbor[$attribute['id']])) { ?>
                            <? if ($attribute['id'] == $attribute_id) { ?>
                                <ul class="active">
                            <? } else { ?>
                                <ul>
                            <? } ?>
                            <? foreach ($attributeItemsForNeighbor[$attribute['id']] as $item) { ?>
                                <li id="attribute-item-<?= $item['id'] ?>">
                                    <div class="row align-items-center branch">
                                        <div class="col-md-10 branch-title">
                                            <i class="fa fa-plus"></i> <?= $item['name'] ?>
                                        </div>
                                        <div class="col-md-2 right folding">
                                            <a href="<?= $BASE_URL . $class_name . "edit/$neighbor_id/" . $attribute['id'] . "/" . $item['id'] . "#attribute-item-" . $item['id'] ?>"><i class="fa fa-edit"></i></a>
                                            <a href="<?= $BASE_URL . $class_name . "attribute_item_up/$neighbor_id/" . $attribute['id'] . "/" . $item['id'] . "#attribute-item-" . $item['id'] ?>"><i class="fa fa-arrow-up"></i></a>
                                            <a href="<?= $BASE_URL . $class_name . "attribute_item_down/$neighbor_id/" . $attribute['id'] . "/" . $item['id'] . "#attribute-item-" . $item['id'] ?>"><i class="fa fa-arrow-down"></i></a>
                                            <form method="post" onsubmit="return confirmDelete();" action="<?= $BASE_URL . $class_name . "attribute_item_delete/$neighbor_id/" . $attribute['id'] . "/" . $item['id'] ?>">
                                                <input type="hidden" name="id" value="<?= $item['id'] ?>">
                                                <button type="submit" class="btn bg-transparent btn-tight"><i class="fa fa-trash"></i></button>
                                            </form>
                                        </div>
                                    </div>
                                    <? if ($item['id'] == $attribute_item_id) { ?>
                                        <form method="post" action="<?= $BASE_URL . $class_name . "attribute_item_put/$neighbor_id/" . $attribute['id'] . "/" . $item['id'] ?>">
                                            <div class="row">
                                                <div class="col-md-10">
                                                    <div class="controls">
                                                        <input class="form-control" name="name" type="text" placeholder="Attribute Item Name" value="<?= $item ? $item['name'] : '' ?>" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-2 right">
                                                    <button class="btn btn-primary" type="submit">Save</button>
                                                </div>
                                            </div>
                                        </form>
                                    <? } ?>
                                </li>
                            <? } ?>
                            </ul>
                            <? if ($attribute['id'] == $attribute_id && empty($curAttributeItem)) { ?>
                                <div class="row">
                                    <div class="col-md-10 offset-md-2">
                                        <hr>
                                        <form method="post" action="<?= $BASE_URL . $class_name . "attribute_item_put/$neighbor_id/" . $curAttribute['id'] ?>">
                                            <input type="hidden" name="index" value="<?= count($attributeItems) * 2 + 2 ?>">
                                            <div class="control-group info">
                                                <div class="row align-items-center">
                                                    <div class="col-md-2">
                                                        <label class="span2" for="name">New Item</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="controls">
                                                            <input class="form-control" name="name" type="text" placeholder="Item Name" value="<?= $curAttributeItem ? $curAttributeItem['name'] : '' ?>" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2 right">
                                                        <button class="btn btn-primary" type="submit">Add</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            <? } ?>
                        <? } ?>
                    </li>
                <? } ?>
            </ul>
            <hr>
            <form id="test" method="post" action="<?= $BASE_URL . $class_name . "attribute_put/$neighbor_id" ?>">
                <input type="hidden" name="index" value="<?= count($attributes) * 2 + 2 ?>">
                <div class="control-group info">
                    <div class="row align-items-center">
                        <div class="col-md-2">
                            <label class="span2" for="name">New Attribute</label>
                        </div>
                        <div class="col-md-8">
                            <div class="controls">
                                <input class="form-control" name="name" type="text" placeholder="Attribute Name" value="" required>
                            </div>
                        </div>
                        <div class="col-md-2 right">
                            <button class="btn btn-primary" type="submit">Add</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <? } ?>
</div></div></div></section>
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
    if (searchtext !='') {
        $('#loader-img').show();
        var url ='<?= $BASE_URL?>admin/Neighbor/searchAttribute/<?= $neighbor_id?>';
        $('#searchDiv').show();
        $('#AttributeListUl').html('');
        $.ajax({
            type: "POST",
            url: url,
            data:{'searchtext':searchtext}, // serializes the form's elements.
                success: function(data)
                {   $('#loader-img').hide();
                    $('#AttributeListUl').html(data);
                },
                error: function (error) {
                }
        });
    } else {
        $('#searchDiv').hide();
        $('#AttributeListUl').html('');
        $('#searchSgedAttributeTextBox').val('');
    }
}

function hidesearchDiv() {
    $('#searchDiv').hide();
    $('#AttributeListUl').html('');
}

$('#select-all').click(function () {
    if ($(this).prop('checked') == true) {
        $('.attribute_ids').prop('checked', true);
    } else {
        $('.attribute_ids').prop('checked', false);
    }
});
//$('form').last().find('input:visible:first').focus();

function confirmDelete() {
    return confirm('Do you really want to delete this?');
}
</script>
<script src="<?= $BASE_URL ?>assets/admin/js/treeview.js" type="text/javascript"></script>
