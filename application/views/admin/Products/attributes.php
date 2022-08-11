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
        <?php $this->load->view('admin/shared/tabscript', ['tabname' => $tabname, 'position' => 'top']); ?>
        <div id="<?= $tabname?>" style="display:none">
            <ul>
                <?php
                    $tabs = ['Attributes', 'Items'];
                ?>
                <?php
                foreach ($tabs as $i => $tab) { ?>
                    <li <?= $_SESSION["$tabname-tab"] == $i ? 'class="k-state-active"' : ''?>><?= $tab?></li>
                <?php } ?>
            </ul>

            <div tab-index="0">
                <form id="attribute-search-form" method="post" action="/admin/Products/AttributesMap">
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
                                                                <a id="attribute-create" href="/admin/Products/AttributeCreate" class="btn green"><i class="fa fa-plus"></i><span class="d-none d-sm-inline"> Add New</span></a>
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
                <form id="dlg-attribute-create" class="k-card" style="display:none;" method="post" action="/admin/Products/AttributeCreateMap">
                    <div class="k-card-body">
                        <div class="form-horizontal">
                            <div class="form-body">
                                <div class="form-group">
                                    <label for="name" class="control-label col-md-3 col-sm-3">Name</label>
                                    <input class="form-control col-md-9 col-sm-9" type="text" placeholder="Name" id="name" name="name" required>
                                </div>
                                <div class="form-group">
                                    <label for="label" class="control-label col-md-3 col-sm-3">Label</label>
                                    <input class="form-control col-md-9 col-sm-9" type="text" placeholder="Label" id="label" name="label">
                                </div>
                                <div class="form-group">
                                    <label for="label_fr" class="control-label col-md-3 col-sm-3">Étiquette</label>
                                    <input class="form-control col-md-9 col-sm-9" type="text" placeholder="Étiquette" id="label_fr" name="label_fr">
                                </div>
                                <div class="form-group">
                                    <label for="type" class="control-label col-md-3 col-sm-3">Type</label>
                                    <?php $this->load->view('admin/shared/select', ['name' => 'type', 'items' => App\Common\ProviderOptionType::names, 'index' => true, 'class' => 'form-control col-md-9 col-sm-9']); ?>
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
                <form id="attribute-item-search-form" method="post" action="/admin/Products/AttributeItemsMap">
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
        <form id="dlg-attribute-item-create" class="k-card" style="display:none;" method="post" action="/admin/Products/AttributeItemCreateMap">
            <div class="k-card-body">
                <div class="form-horizontal">
                    <div class="form-body">
                        <input type="hidden" name="attribute_id">
                        <div class="form-group">
                            <label for="name" class="control-label col-md-3 col-sm-3">Name</label>
                            <input class="form-control col-md-9 col-sm-9" type="text" placeholder="Name" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="name_fr" class="control-label col-md-3 col-sm-3">Nom</label>
                            <input class="form-control col-md-9 col-sm-9" type="text" placeholder="Nom" id="name_fr" name="name_fr">
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
        var typeNames = <?= json_encode(App\Common\ProviderOptionType::names)?>;
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
                            url: '/admin/Products/AttributesMap',
                            type: 'POST',
                            dataType: 'json',
                            data: additionalDataAttribute
                        },
                        update: {
                            url: '/admin/Products/AttributeUpdateMap',
                            type: 'POST',
                            dataType: 'json',
                            data: []
                        },
                        destroy: {
                            url: '/admin/Products/AttributeDeleteMap',
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
                                label: { editable: true, type: 'string' },
                                label_fr: { editable: true, type: 'string' },
                                type: { editable: true, type: 'number' },
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
                columns: [{
                    field: 'id',
                    title: '#',
                    template: '#= ++record #',
                }, {
                    field: 'name',
                    title: 'Name',
                }, {
                    field: 'label',
                    title: 'Label',
                }, {
                    field: 'label_fr',
                    title: 'Étiquette',
                }, {
                    field: 'type',
                    title: 'Type',
                    template: '#=typeNames[type]#',
                    editor: typeDropDownEditor,
                }, {
                    field: 'item_count',
                    title: 'Items',
                    editor: typeDropDownEditor,
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
                        click: showItems
                    }, {
                        name: 'destroy',
                    }],
                    width: 100,
                }],
                dataBinding: function() {
                    record = this.dataSource.pageSize() * (this.dataSource.page() - 1);
                },
            });

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
                            url: attributeItemUrl,
                            type: 'POST',
                            dataType: 'json',
                            // data: additionalDataAttribute
                        },
                        update: {
                            url: '/admin/Products/AttributeItemUpdateMap',
                            type: 'POST',
                            dataType: 'json',
                            data: []
                        },
                        destroy: {
                            url: '/admin/Products/AttributeItemDeleteMap',
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
                                name: { editable: true, type: 'string' },
                                name_fr: { editable: true, type: 'string' },
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
                    field: 'name',
                    title: 'Name',
                }, {
                    field: 'name_fr',
                    title: 'Nom',
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
                $.post('/admin/Products/AttributeCreateMap', $(this).serialize())
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

        function typeDropDownEditor(container, options) {
            $('<input required name="' + options.field + '"/>')
                .appendTo(container)
                .kendoDropDownList({
                    value: options.model.type,
                    dataSource: typeNamesList,
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

        function attributeItemUrl() {
            return '/admin/Products/AttributeItemsMap/' + (curAttribute ? curAttribute.id : 0);
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

        $(document).ready(function() {
            $('#attribute-items-grid').kendoGrid({
                dataSource: {
                    transport: {
                        read: {
                            url: '/admin/Products/AttributeItemsMap',
                            type: 'POST',
                            dataType: 'json',
                            data: additionalDataAttributeItem
                        },
                        update: {
                            url: '/admin/Products/AttributeItemUpdateMap',
                            type: 'POST',
                            dataType: 'json',
                            data: []
                        },
                        destroy: {
                            url: '/admin/Products/AttributeItemDeleteMap',
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
                                name: { editable: true, type: 'string' },
                                name_fr: { editable: true, type: 'string' },
                                attribute_name: { editable: false, type: 'string' },
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
                    field: 'name',
                    title: 'Name',
                }, {
                    field: 'name_fr',
                    title: 'Nom',
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
                $.post('/admin/Products/AttributeItemCreateMap', $(this).serialize())
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
        }
        </script>
    </section>
</div>