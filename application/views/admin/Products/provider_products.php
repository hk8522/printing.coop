<?php
$pageSize = 10;
$pageSizes = [10, 15, 20, 50, 100];
?>
<div id="product-grid"></div>
<script>
    var record = 0;
    $(document).ready(function () {
        $('#product-grid').kendoGrid({
            dataSource: {
                transport: {
                    read: {
                        url: '/admin/Products/ProviderProducts/<?=$provider?>',
                        type: 'POST',
                        dataType: 'json',
                        data: []
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
                pageSizes: <?=json_encode($pageSizes)?>
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
                        class="k-link bind-product product-thumbs #if (product_id) {# active #}#"
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
                title: 'Attributes',
                template: `
                    #if (product_id) {#
                        <a href="/admin/Products/ProviderProductAttributes/<?=$provider?>/#=provider_product_id#" class="k-link bind-product-attributes">
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
    });
</script>
