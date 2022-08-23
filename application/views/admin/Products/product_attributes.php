<?php
$tabname = 'attributes-view';
?>
<link rel="stylesheet" type="text/css" href="/assets/css/provider.css" />
<div class="content-wrapper dd">
    <?php
    $pageSize = 10;
    $pageSizes = [10, 15, 20, 50, 100];
    ?>
    <section class="content">
        <h3><?= $product['name'] ?></h3>
        <?php $this->load->view('admin/shared/tabscript', ['tabname' => $tabname, 'position' => 'top']); ?>
        <div id="<?= $tabname?>" style="display:none">
            <ul>
                <?php
                    $tabs = ['Attributes', 'Items'];
                ?>
                <?php
                foreach ($tabs as $i => $tab) { ?>
                    <li <?= ($_SESSION["$tabname-tab"] ?? 0) == $i ? 'class="k-active"' : ''?>><?= $tab?></li>
                <?php } ?>
            </ul>

            <div tab-index="0">
                <form id="attribute-search-form" method="post" action="/admin/Products/ProductAttributes/<?= $product_id ?>">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="x_panel light form-fit">
                                <div class="x_content form">
                                    <div class="form-horizontal">
                                        <div class="form-body">
                                            <div class="col-12 px-0">
                                                <div class="row align-items-end">
                                                    <div class="col-md-8 col-ms-12 col-12">
                                                        <div class="form-group mb-0">
                                                            <label class="control-label" for="q">Attribute Name</label>
                                                            <input class="form-control k-input text-box single-line"
                                                                id="q" name="q" type="text" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 col-sm-12 col-12">
                                                        <div class="form-actions">
                                                            <div class="btn-group">
                                                                <button class="btn btn-success filter-submit" id="search-attributes">
                                                                    <i class="fa fa-search"></i> Search
                                                                </button>
                                                                <a id="attribute-create" href="/admin/Products/ProductAttributeCreate/<?= $product_id ?>" class="btn green"><i class="fa fa-plus"></i><span class="d-none d-sm-inline"> Add New</span></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="x_content">
                                            <div id="attributes-grid"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <form id="dlg-attribute-create" class="k-card" style="display:none;" method="post" action="/admin/Products/ProductAttributeCreate/<?= $product_id ?>">
                    <div class="k-card-body">
                        <div class="form-horizontal">
                            <div class="form-body">
                                <div class="form-group">
                                    <label for="name" class="control-label col-md-3 col-sm-3">Attribute</label>
                                    <?php $this->load->view('admin/shared/dropdown', ['data' => [
                                        'id' => 'attribute-create-attribute_id',
                                        'name' => 'attribute_id',
                                        'url' => '/admin/Products/AttributesMap',
                                        'label' => 'Select Attributes...',
                                        'class' => 'form-control col-md-9 col-sm-9',
                                        'fieldText' => 'label',
                                        'template' => '#=label# (#=label_fr#) : #=name#',
                                        ]]); ?>
                                </div>
                                <div class="form-group">
                                    <label for="type" class="control-label col-md-3 col-sm-3">Use Items</label>
                                    <?php $this->load->view('admin/shared/select', ['name' => 'use_items', 'value' => 1, 'items' => [1=> 'Yes', 0 => 'No'], 'index' => true, 'class' => 'form-control col-md-9 col-sm-9']); ?>
                                </div>
                                <div class="form-group">
                                    <label for="type" class="control-label col-md-3 col-sm-3">Min Value</label>
                                    <?php $this->load->view('admin/shared/double', ['name' => 'value_min', 'value' => 0]); ?>
                                </div>
                                <div class="form-group">
                                    <label for="type" class="control-label col-md-3 col-sm-3">Max Value</label>
                                    <?php $this->load->view('admin/shared/double', ['name' => 'value_max', 'value' => 0]); ?>
                                </div>
                                <div class="form-group">
                                    <label for="type" class="control-label col-md-3 col-sm-3">Additional Fee</label>
                                    <?php $this->load->view('admin/shared/double', ['name' => 'additional_fee', 'value' => 0]); ?>
                                </div>
                                <div class="border fee-apply">
                                    <label for="type" class="control-label col-md-3 col-sm-3">Fee Apply To ...</label>
                                    <div class="form-group">
                                        <label for="type" class="control-label col-md-3 col-sm-3">Size</label>
                                        <?php $this->load->view('admin/shared/select', ['name' => 'fee_apply_size', 'value' => 0, 'items' => [1=> 'Yes', 0 => 'No'], 'index' => true, 'class' => 'form-control col-md-9 col-sm-9']); ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="type" class="control-label col-md-3 col-sm-3">Width</label>
                                        <?php $this->load->view('admin/shared/select', ['name' => 'fee_apply_width', 'value' => 0, 'items' => [1=> 'Yes', 0 => 'No'], 'index' => true, 'class' => 'form-control col-md-9 col-sm-9']); ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="type" class="control-label col-md-3 col-sm-3">Length</label>
                                        <?php $this->load->view('admin/shared/select', ['name' => 'fee_apply_length', 'value' => 0, 'items' => [1=> 'Yes', 0 => 'No'], 'index' => true, 'class' => 'form-control col-md-9 col-sm-9']); ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="type" class="control-label col-md-3 col-sm-3">Diameter</label>
                                        <?php $this->load->view('admin/shared/select', ['name' => 'fee_apply_diameter', 'value' => 0, 'items' => [1=> 'Yes', 0 => 'No'], 'index' => true, 'class' => 'form-control col-md-9 col-sm-9']); ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="type" class="control-label col-md-3 col-sm-3">Depth</label>
                                        <?php $this->load->view('admin/shared/select', ['name' => 'fee_apply_depth', 'value' => 0, 'items' => [1=> 'Yes', 0 => 'No'], 'index' => true, 'class' => 'form-control col-md-9 col-sm-9']); ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="type" class="control-label col-md-3 col-sm-3">Pages</label>
                                        <?php $this->load->view('admin/shared/select', ['name' => 'fee_apply_pages', 'value' => 0, 'items' => [1=> 'Yes', 0 => 'No'], 'index' => true, 'class' => 'form-control col-md-9 col-sm-9']); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="k-card-actions">
                        <div class="stats"></div>
                        <span class="k-card-action">
                            <button type="submit" class="k-button k-button-flat-primary k-button-flat k-button-md k-rounded-md filter-submit">
                                <i class="fa fa-check"></i> Save
                            </button>
                        </span>
                    </div>
                </form>
                <div id="dlg-attribute-items" class="k-card" style="display:none;">
                    <div class="k-card-body">
                        <div class="k-card-actions ">
                            <span class="k-card-action"><span id="attribute-item-create" class="k-button k-button-flat-base k-button-flat k-button-md k-rounded-md"><i class="fa fa-plus"> <span class="d-none d-sm-inline"> Add New</span></i></span></span>
                        </div>
                        <div id="dlg-attribute-items-grid"></div>
                    </div>
                    <div class="k-card-actions ">
                        <span class="k-card-action"><span class="k-button k-button-flat-primary k-button-flat k-button-md k-rounded-md" onclick="$('#dlg-attribute-items').data('kendoWindow').close();">Close</span></span>
                    </div>
                </div>
            </div>
            <div tab-index="1">
                <form id="attribute-item-search-form" method="post" action="/admin/Products/ProductAttributeItems">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="x_panel light form-fit">
                                <div class="x_content form">
                                    <div class="form-horizontal">
                                        <div class="form-body">
                                            <div class="col-12 px-0">
                                                <div class="row align-items-end">
                                                    <div class="col-md-8 col-ms-12 col-12">
                                                        <div class="form-group mb-0">
                                                            <label class="control-label" for="q">Item Name</label>
                                                            <input class="form-control k-input text-box single-line"
                                                                id="q" name="q" type="text" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 col-sm-12 col-12">
                                                        <div class="form-actions">
                                                            <div class="btn-group">
                                                                <button class="btn btn-success filter-submit" id="search-attribute-items">
                                                                    <i class="fa fa-search"></i> Search
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="x_content">
                                            <div id="attribute-items-grid"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <form id="dlg-attribute-item-create" class="k-card" style="display:none;" method="post" action="/admin/Products/ProductAttributeItemCreate/<?= $product_id ?>">
            <div class="k-card-body">
                <div class="form-horizontal">
                    <div class="form-body">
                        <input type="hidden" name="attribute_id">
                        <div class="form-group">
                            <label for="name" class="control-label col-md-3 col-sm-3">Item</label>
                            <?php $this->load->view('admin/shared/dropdown', ['data' => [
                                'id' => 'attribute-item-create-attribute_item_id',
                                'name' => 'attribute_item_id',
                                'urlFunction' => 'attributeItemUrl',
                                'label' => 'Select Attributes...',
                                'class' => 'form-control col-md-9 col-sm-9',
                                'fieldText' => 'name',
                                ]]); ?>
                        </div>
                        <div class="form-group">
                            <label for="type" class="control-label col-md-3 col-sm-3">Additional Fee</label>
                            <?php $this->load->view('admin/shared/double', ['name' => 'additional_fee', 'value' => 0]); ?>
                        </div>
                        <div class="form-group">
                            <label for="type" class="control-label col-md-3 col-sm-3">Show Order</label>
                            <?php $this->load->view('admin/shared/int32', ['name' => 'show_order', 'value' => 0]); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="k-card-actions">
                <div class="stats"></div>
                <span class="k-card-action">
                    <button type="submit" class="k-button k-button-flat-primary k-button-flat k-button-md k-rounded-md filter-submit">
                        <i class="fa fa-check"></i> Save
                    </button>
                </span>
            </div>
        </form>
        <script>
        var typeNames = <?= json_encode(App\Common\AttributeType::names)?>;
        var typeNamesList = [];
        for (const [key, value] of Object.entries(typeNames)) {
            typeNamesList.push({
                key: key,
                value: value
            });
        }
        var record = 0;
        $(document).ready(function() {
            $('#attributes-grid').kendoGrid({
                dataSource: {
                    transport: {
                        read: {
                            url: '/admin/Products/ProductAttributes/<?= $product_id ?>',
                            type: 'POST',
                            dataType: 'json',
                            data: additionalDataAttribute
                        },
                        update: {
                            url: '/admin/Products/ProductAttributeUpdate',
                            type: 'POST',
                            dataType: 'json',
                            data: []
                        },
                        destroy: {
                            url: '/admin/Products/ProductAttributeDelete',
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
                                id: { editable: false, type: 'int' },
                                name: { editable: false, type: 'string' },
                                type: { editable: false, type: 'int' },
                                label: { editable: false, type: 'string' },
                                label_fr: { editable: false, type: 'string' },
                                attribute_id: { editable: false, type: 'number' },
                                item_count: { editable: false, type: 'number' },
                            }
                        }
                    },
                    error: function(e) {
                        display_kendoui_grid_error(e);
                        // Cancel the changes
                        this.cancelChanges();
                    },
                    pageSize: <?= $pageSize?>,
                    serverPaging: true,
                    serverFiltering: true,
                    serverSorting: true
                },
                pageable: {
                    refresh: true,
                    pageSizes: <?= json_encode($pageSizes)?>
                },
                editable: {
                    confirmation: true,
                    mode: 'inline',
                },
                scrollable: false,
                columnMenu: true,
                columns: [{
                    field: 'id',
                    title: '#',
                    template: '#= ++record #',
                }, {
                    title: 'Attribute',
                    columns: [{
                        field: 'name',
                        title: 'Name',
                        template: '<a title="#=label#(#=label_fr#)">#=name#</a>',
                        width: '200px'
                    }, {
                        field: 'type',
                        title: 'Type',
                        template: '#=typeNames[type]#',
                    }, {
                        field: 'item_count',
                        title: 'Items',
                    }]
                }, {
                    field: 'use_items',
                    title: 'Use Items',
                    template: '#= use_items == 1 == 1 ? "Yes" : ""#',
                    editor: booleanEditor,
                }, {
                    title: 'Value Range',
                    columns: [{
                        field: 'value_min',
                        title: 'Min',
                    }, {
                        field: 'value_max',
                        title: 'Max',
                    }]
                }, {
                    field: 'additional_fee',
                    title: 'Additional Fee',
                }, {
                    title: 'Fee Apply to ...',
                    columns: [{
                        field: 'fee_apply_size',
                        title: 'Size',
                        template: '#= fee_apply_size == 1 ? "Yes" : ""#',
                        editor: booleanEditor,
                    }, {
                        field: 'fee_apply_width',
                        title: 'Width',
                        template: '#= fee_apply_width == 1 ? "Yes" : ""#',
                        editor: booleanEditor,
                    }, {
                        field: 'fee_apply_length',
                        title: 'Length',
                        template: '#= fee_apply_length == 1 ? "Yes" : ""#',
                        editor: booleanEditor,
                    }, {
                        field: 'fee_apply_diameter',
                        title: 'Diameter',
                        template: '#= fee_apply_diameter == 1 ? "Yes" : ""#',
                        editor: booleanEditor,
                    }, {
                        field: 'fee_apply_depth',
                        title: 'Depth',
                        template: '#= fee_apply_depth == 1 ? "Yes" : ""#',
                        editor: booleanEditor,
                    }, {
                        field: 'fee_apply_pages',
                        title: 'Pages',
                        template: '#= fee_apply_pages == 1 ? "Yes" : ""#',
                        editor: booleanEditor,
                    }]
                }, {
                    field: 'show_order',
                    title: 'Show Order',
                }, {
                    command: [{
                        name: 'edit',
                        text: {
                            edit: 'Edit',
                            update: 'Update',
                            cancel: 'Cancel'
                        }
                    }, {
                        text: "Items",
                        click: showItems,
                        visible: function(dataItem) {
                            return dataItem.use_items == 1;
                        }
                    }, {
                        name: 'destroy',
                    }],
                    width: 100,
                }],
                dataBinding: function() {
                    record = this.dataSource.pageSize() * (this.dataSource.page() - 1);
                },
            });
            // if ($('#attributes-grid').width() < 1400)
            //     $('#attributes-grid').width(1400);

            $('#search-attributes').click(function() {
                //search
                var grid = $('#attributes-grid').data('kendoGrid');
                grid.dataSource.page(1);
                return false;
            });

            $('#dlg-attribute-items-grid').kendoGrid({
                dataSource: {
                    transport: {
                        read: {
                            url: productAttributeItemUrl,
                            type: 'POST',
                            dataType: 'json',
                            // data: additionalDataAttribute
                        },
                        update: {
                            url: '/admin/Products/ProductAttributeItemUpdate',
                            type: 'POST',
                            dataType: 'json',
                            data: []
                        },
                        destroy: {
                            url: '/admin/Products/ProductAttributeItemDelete',
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
                                id: { editable: false, type: 'int' },
                                attribute_item_id: { editable: false, type: 'string' },
                            }
                        }
                    },
                    error: function(e) {
                        display_kendoui_grid_error(e);
                        // Cancel the changes
                        this.cancelChanges();
                    },
                    pageSize: <?= $pageSize?>,
                    serverPaging: true,
                    serverFiltering: true,
                    serverSorting: true
                },
                pageable: {
                    refresh: true,
                    pageSizes: <?= json_encode($pageSizes)?>
                },
                editable: {
                    confirmation: true,
                    mode: 'inline',
                },
                scrollable: false,
                columns: [{
                    field: 'id',
                    title: '#',
                    template: '#= ++record #',
                }, {
                    field: 'attribute_item_id',
                    title: 'Item',
                    template: '#=attribute_item_name#',
                }, {
                    field: 'additional_fee',
                    title: 'Additional Fee',
                }, {
                    field: 'show_order',
                    title: 'Show Order',
                }, {
                    command: [{
                        name: 'edit',
                        text: {
                            edit: 'Edit',
                            update: 'Update',
                            cancel: 'Cancel'
                        }
                    }, {
                        name: 'destroy',
                    }],
                    width: 100,
                }],
                dataBinding: function() {
                    record = this.dataSource.pageSize() * (this.dataSource.page() - 1);
                },
            });

            $('#attribute-create').click(attributeCreate);

            $('#dlg-attribute-create').on('submit', function(e) {
                e.preventDefault();
                $('#loader-img').show();
                $.post('/admin/Products/ProductAttributeCreate/<?= $product_id ?>', $(this).serialize())
                .done(function (response) {
                    $('#loader-img').hide();
                    if (!response) {
                        kendo.alert('Error occurred.');
                        return;
                    } else if (!response.success) {
                        kendo.alert(response.message);
                        return;
                    }
                    refreshGrid('attributes-grid');
                    $('#dlg-attribute-create').data('kendoWindow').close();
                }).fail(function (error) {
                    kendo.alert(error);
                    $('#loader-img').hide();
                });
            });
        });

        function additionalDataAttribute() {
            return {
                q: $('#attribute-search-form #q').val(),
            };
        }

        function booleanEditor(container, options) {
            $('<input required name="' + options.field + '"/>')
                .appendTo(container)
                .kendoDropDownList({
                    value: options.model.type,
                    dataSource: [{key: 1, value: 'Yes'}, {key: 0, value: 'No'}],
                    dataTextField: "value",
                    dataValueField: "key",
                });
        }

        var curAttribute = null;

        function showItems(e) {
            e.preventDefault();
            var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
            curAttribute = dataItem;
            var wnd = $('#dlg-attribute-items');
            if (!wnd.data('kendoWindow')) {
                wnd.kendoWindow({
                    modal: true,
                    title: 'Attribute Items',
                    actions: ['Close'],
                    width: '70%',
                    height: '80%',
                });
            }
            wnd.data('kendoWindow').center().open();
            wnd.data('kendoWindow').title('Items of ' + curAttribute.name);
            $('.k-overlay').click(function() {
                $('#dlg-attribute-items').data('kendoWindow').close();
            });
            refreshGrid('dlg-attribute-items-grid');
        }

        function productAttributeItemUrl() {
            return '/admin/Products/ProductAttributeItems/<?= $product_id ?>/' + (curAttribute ? curAttribute.attribute_id : 0);
        }

        function attributeCreate(e) {
            e.preventDefault();
            var wnd = $('#dlg-attribute-create');
            if (!wnd.data('kendoWindow')) {
                wnd.kendoWindow({
                    modal: true,
                    title: 'Create a new attribute',
                    actions: ['Close'],
                    width: '70%',
                    height: '80%',
                });
            }
            wnd.data('kendoWindow').center().open();
            $('.k-overlay').click(function() {
                $('#dlg-attribute-create').data('kendoWindow').close();
            });
        }

        function attributeItemUrl() {
            return '/admin/Products/AttributeItemsMap/' + (curAttribute == null ? 0 : curAttribute.attribute_id);
        }

        $(document).ready(function() {
            $('#attribute-items-grid').kendoGrid({
                dataSource: {
                    transport: {
                        read: {
                            url: '/admin/Products/ProductAttributeItems/<?= $product_id ?>',
                            type: 'POST',
                            dataType: 'json',
                            data: additionalDataAttributeItem
                        },
                        update: {
                            url: '/admin/Products/ProductAttributeItemUpdate',
                            type: 'POST',
                            dataType: 'json',
                            data: []
                        },
                        destroy: {
                            url: '/admin/Products/ProductAttributeItemDelete',
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
                                id: { editable: false, type: 'int' },
                                name: { editable: false, type: 'string' },
                                attribute_name: { editable: false, type: 'string' },
                                attribute_label: { editable: false, type: 'string' },
                                attribute_item_name: { editable: false, type: 'string' },
                                attribute_item_name_fr: { editable: false, type: 'string' },
                            }
                        }
                    },
                    error: function(e) {
                        display_kendoui_grid_error(e);
                        // Cancel the changes
                        this.cancelChanges();
                    },
                    pageSize: <?= $pageSize?>,
                    serverPaging: true,
                    serverFiltering: true,
                    serverSorting: true
                },
                pageable: {
                    refresh: true,
                    pageSizes: <?= json_encode($pageSizes)?>
                },
                editable: {
                    confirmation: true,
                    mode: 'inline',
                },
                scrollable: false,
                columns: [{
                    field: 'id',
                    title: '#',
                    template: '#= ++record #',
                }, {
                    field: 'attribute_name',
                    title: 'Attribute',
                }, {
                    field: 'attribute_item_name',
                    title: 'Item',
                }, {
                    field: 'attribute_item_name_fr',
                    title: 'Nom',
                    template: '#=unescape(attribute_item_name_fr)#',
                }, {
                    field: 'additional_fee',
                    title: 'Additional Fee',
                }, {
                    field: 'show_order',
                    title: 'Show Order',
                }, {
                    command: [{
                        name: 'edit',
                        text: {
                            edit: 'Edit',
                            update: 'Update',
                            cancel: 'Cancel'
                        }
                    }, {
                        name: 'destroy',
                    }],
                    width: 100,
                }],
                dataBinding: function() {
                    record = this.dataSource.pageSize() * (this.dataSource.page() - 1);
                },
            });

            $('#search-attribute-items').click(function() {
                //search
                var grid = $('#attribute-items-grid').data('kendoGrid');
                grid.dataSource.page(1);
                return false;
            });

            $('#attribute-item-create').click(attributeItemCreate);

            $('#dlg-attribute-item-create').on('submit', function(e) {
                e.preventDefault();
                $('#loader-img').show();
                $.post('/admin/Products/ProductAttributeItemCreate/<?= $product_id ?>', $(this).serialize())
                .done(function (response) {
                    $('#loader-img').hide();
                    if (!response) {
                        kendo.alert('Error occurred.');
                        return;
                    } else if (!response.success) {
                        kendo.alert(response.message);
                        return;
                    }
                    refreshGrid('attribute-items-grid');
                    refreshGrid('dlg-attribute-items-grid');
                    $('#dlg-attribute-item-create').data('kendoWindow').close();
                }).fail(function (error) {
                    kendo.alert(error);
                    $('#loader-img').hide();
                });
            });
        });

        function additionalDataAttributeItem() {
            return {
                q: $('#attribute-item-search-form #q').val(),
            };
        }

        function attributeItemCreate(e) {
            e.preventDefault();
            $('#dlg-attribute-item-create [name="attribute_id"]').val(curAttribute.id);
            var wnd = $('#dlg-attribute-item-create');
            if (!wnd.data('kendoWindow')) {
                wnd.kendoWindow({
                    modal: true,
                    title: 'Create a new item',
                    actions: ['Close'],
                    width: '70%',
                    height: '80%',
                });
            }
            wnd.data('kendoWindow').center().open();
            $('.k-overlay').click(function() {
                $('#dlg-attribute-item-create').data('kendoWindow').close();
            });

            $('#attribute-item-create-attribute_item_id').data('kendoDropDownList').dataSource.read();
        }
        </script>
    </section>
</div>