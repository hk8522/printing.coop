<?php
$pageSize = 10;
$pageSizes = [10, 15, 20, 50, 100];
?>
<form id="product-search-form" method="post" action="/admin/Products/ProviderProducts/<?=$provider?>">
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
                                            <label class="control-label" for="q">Product Name</label>
                                            <input class="form-control k-input text-box single-line" id="q" name="q" type="text" value="<?=$this->input->get('q', '')?>" />
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12 col-12">
                                        <div class="form-actions">
                                            <div class="btn-group">
                                                <button class="btn btn-success filter-submit" id="search-products">
                                                    <i class="fa fa-search"></i> Search
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="x_content">
                            <div id="products-grid"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<script>
    var record = 0;
    $(document).ready(function () {
        $('#products-grid').kendoGrid({
            dataSource: {
                transport: {
                    read: {
                        url: '/admin/Products/ProviderProducts/<?=$provider?>',
                        type: 'POST',
                        dataType: 'json',
                        data: additionalData
                    }
                },
                schema: {
                    data: 'data',
                    total: 'total',
                    errors: 'errors'
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
                pageSizes: <?=json_encode($pageSizes)?>,
                change: function(e) {
                    var stateurl = new URL(location.href);
                    stateurl.searchParams.set('page', e.index);
                    window.history.replaceState({ path: stateurl.href }, '', stateurl.href);
                }
            },
            scrollable: false,
            columns: [{
                title: '#',
                template: '#= ++record #',
            }, {
                field: 'provider_product_id',
                title: 'ID',
            }, {
                field: 'name',
                title: 'Name',
            }, {
                field: 'category',
                title: 'Category',
            }, {
                field: 'sku',
                title: 'SKU',
            }, {
                field: 'product_id',
                title: 'Product Binding',
                template: `
                    <a href="/admin/Products/ProviderProductBind/#=id#"
                        class="k-link bind-product product-thumbs #if (product_id) {# active #}# d-flex justify-content-center"
                        >
                        <img class="thumbs" src="#=product_image#" alt="#=product_name#">
                        <div class="action">
                            <svg class="bi b-icon" width="2em" height="2em" fill="currentColor">
                                <use xlink:href="/assets/images/bootstrap-icons.svg\\#pencil-square"/>
                            </svg>
                        </div>
                    </a>
                    #if (product_id) {#<p>#=product_name#</p>#}#`,
            }, {
                field: 'provider_product_id',
                title: 'Options',
                template: `
                    #if (product_id) {#
                        <a href="/admin/Products/ProviderProductOptions/<?=$provider?>/#=provider_product_id#" class="k-link bind-product-attributes">
                            <div class="action">
                                <svg class="bi b-icon" width="2em" height="2em" fill="currentColor">
                                    <use xlink:href="/assets/images/bootstrap-icons.svg\\#pencil-square"/>
                                </svg>
                            </div>
                        </a>
                    #}#`,
            }],
            dataBinding: function() {
                record = this.dataSource.pageSize() * (this.dataSource.page() - 1);
            },
            dataBound: function() {
                $('.bind-product, .bind-product-attributes').magnificPopup({
                    type: 'ajax',
                    settings: { cache: false, async: false },
                    midClick: true,
                    callbacks: {
                        parseAjax: function (mfpResponse) {
                            mfpResponse.data = $('<div></div>').html(mfpResponse.data);
                        },
                        ajaxContentAdded: function () {
                            $('.mfp-wrap').removeAttr('tabindex');
                        }
                    }
                });
            },
        });

        //search button
        $('#search-products').click(function () {
            //search
            var grid = $('#products-grid').data('kendoGrid');
            grid.dataSource.page(1);

            var params = additionalData();
            var stateurl = new URL(location.href);
            stateurl.searchParams.set('page', 1);
            for (const item of Object.entries(params)) {
                if (item[0] != '_token') {
                    if (item[1] != undefined && item[1] != '')
                        stateurl.searchParams.set(item[0], item[1]);
                    else {
                        stateurl.searchParams.delete(item[0]);
                    }
                }
            }
            stateurl.searchParams.delete('timestamp');
            window.history.replaceState({ path: stateurl.href }, '', stateurl.href);
            return false;
        });
    });

    function additionalData() {
        return {
            q: $('#product-search-form #q').val(),
        };
    }
</script>
