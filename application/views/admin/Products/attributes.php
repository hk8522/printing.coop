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
                    $tabs = ['Attributes', 'Attribute Items'];
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
                            <div class="x_panel light form-fit popup-window">
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
                <div id="dlg-attribute-items" style="display:none;">
                    <div id="dlg-attribute-items-grid"></div>
                    <div class="window-footer">
                        <div class="form-group text-right pull-right">
                            <span class="k-button"
                                onclick="$('#dlg-attribute-items').data('kendoWindow').close();">Close</span>
                        </div>
                    </div>
                </div>
            </div>
            <div tab-index="1">
            <form id="attribute-item-search-form" method="post" action="/admin/Products/AttributeItemsMap">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="x_panel light form-fit popup-window">
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
                    }, ],
                    width: 100,
                }],
                dataBinding: function() {
                    record = this.dataSource.pageSize() * (this.dataSource.page() - 1);
                },
            });

            //search button
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
                    }, ],
                    width: 100,
                }],
                dataBinding: function() {
                    record = this.dataSource.pageSize() * (this.dataSource.page() - 1);
                },
            });

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
                    }, ],
                    width: 100,
                }],
                dataBinding: function() {
                    record = this.dataSource.pageSize() * (this.dataSource.page() - 1);
                },
            });
        });

        function additionalDataAttribute() {
            return {
                q: $('#attribute-search-form #q').val(),
            };
        }
        function additionalDataAttributeItem() {
            return {
                q: $('#attribute-item-search-form #q').val(),
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
        </script>
    </section>
</div>