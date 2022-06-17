<?php
$pageSize = 10;
$pageSizes = [10, 15, 20, 50, 100];
?>
<script id="attribute-popup-editor" type="text/x-kendo-template">
    <div class="form-horizontal" id="attribute-form">
        <div class="form-header center">
            <h3><span data-bind="html:name"</h3>
        </div>
        <div class="form-body">
            <div class="form-group">
                <label for="type" class="control-label col-md-3 col-sm-3">Type</label>
                <div class="col-md-9 col-sm-9">
                    <select class="form-control k-input text-box single-line" name="type" data-bind="value:type" >
                        <?php
                        foreach (App\Common\ProductAttributeType::names as $key => $name) {?>
                            <option value="<?=$key?>"><?=$name?></option>
                        <?php }?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="attribute_id" class="control-label col-md-3 col-sm-3">Attribute</label>
                <div class="col-md-9 col-sm-9">
                    <input type="hidden" name="attribute_id" data-bind="value:attribute_id" />
                    <div class="search-box-area">
                        <div class="search-sugg">
                            <input class="form-control" type="text" placeholder="Search Attribute" onkeyup="searchAttribute($(this).val())" data:bind="value:attribute_name" name="attribute_name">
                        </div>
                        <div class="search-result" style="display:none">
                            <a href="javascript:void(0)" onclick="hideSearchResult()"><i class="fas fa-times" ></i></a>
                            <ul></ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</script>
<div id="attribute-grid"></div>
<script>
    var attributeTypeNames = <?=json_encode(App\Common\ProductAttributeType::names)?>;
    var record = 0;
    $(document).ready(function () {
        $('#attribute-grid').kendoGrid({
            dataSource: {
                transport: {
                    read: {
                        url: '/admin/Products/ProviderAttributes/<?=$provider?>',
                        type: 'POST',
                        dataType: 'json',
                        data: []
                    },
                    update: {
                        url:'/admin/Products/ProviderAttributeUpdate',
                        type: 'POST',
                        dataType: 'json',
                        data: []
                    },
                    destroy: {
                        url: '',
                        type: 'POST',
                        dataType: 'json',
                        data: []
                    }
                },
                schema: {
                    data: 'data',
                    total: 'total',
                    errors: 'errors',
                    model: {
                        id: 'id',
                        fields: {
                            name: { editable: false, type: 'string'},
                            type: { editable: true, type: 'number' },
                            attribute_id: { editable: true, type: 'number' },
                            attribute_name: { editable: true, type: 'string' },
                        }
                    }
                },
                error: function(e) {
                    display_kendoui_grid_error(e);
                    // Cancel the changes
                    this.cancelChanges();
                },
                pageSize: <?=$pageSize?>,
                serverPaging: true,
                serverFiltering: true,
                serverSorting: true
            },
            pageable: {
                refresh: true,
                pageSizes: <?=json_encode($pageSizes)?>
            },
            editable: {
                confirmation: false,
                // mode: 'inline',
                mode: 'popup',
                template: kendo.template($('#attribute-popup-editor').html())
            },
            scrollable: false,
            columns: [{
                title: '#',
                template: '#= ++record #',
            }, {
                field: 'name',
                title: 'Name',
            }, {
                field: 'type',
                title: 'Type',
                template: '#=attributeTypeNames[type]#',
            }, {
                field: 'attribute_name',
                title: 'Attribute',
            }, {
                command: [{
                    name: 'edit',
                    text: {
                        edit: 'Edit',
                        update: 'Update',
                        cancel: 'Cancel'
                    }
                }],
                width: 100,
            }],
            dataBinding: function() {
                record = this.dataSource.pageSize() * (this.dataSource.page() - 1);
            },
        });
    });

    function searchAttribute(q)
    {
        if (q !='') {
            $('#loader-img').show();
            $('.search-result').show();
            $('.search-result ul').html('');
            $.ajax({
                type: 'POST',
                url: '/admin/Products/Attributes',
                headers: { Accept: 'application/json; charset=utf-8' },
                data: { q: q },
                success: function(data)
                {
                    data = data.data;
                    $('#loader-img').hide();
                    var html = '<div>';
                    for (var i = 0; i < data.length; i++) {
                        html += `<li><a class="k-link product-thumbs" onclick="setAttributeId('${data[i].id}', '${data[i].name}')"><span></i>${data[i].name}</span></li></a>`;
                    }
                    html += '</div>';
                    $('.search-result ul').html(html);
                },
                error: function (error) {
                }
            });
        } else {
            $('.search-result').hide();
            $('.search-result ul').html('');
            $('.search-sugg input').val('');
        }
    }
    function hideSearchResult()
    {
        $('.search-result').hide();
        $('.search-result ul').html('');
    }
    function setAttributeId(id, name)
    {
        $('#attribute-form input[name="attribute_id"]').val(id);
        $('#attribute-form input[name="attribute_name"]').val(name);

        // var grid = $('#attribute-grid').data('kendoGrid');
        var model = $('.k-popup-edit-form').data('kendoEditable').options.model;
        model.attribute_id = id;
        model.attribute_name = name;
        // model.dirty = true;
        hideSearchResult();
    }
</script>
