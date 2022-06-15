<?php
$provider = 'sina';
?>
<link rel="stylesheet" type="text/css" href="/assets/css/provider.css"/>
<div class="content-wrapper dd">
    <div id="product-grid"></div>
</div>

<script>
    var record = 0;
    $(document).ready(function () {
        $('#product-grid').kendoGrid({
            dataSource: {
                transport: {
                    read: {
                        url: '/admin/Products/Provider/<?=$provider?>',
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
                pageSize: 10,
                serverPaging: true,
                serverFiltering: true,
                serverSorting: true
            },
            pageable: {
                refresh: true,
                pageSizes: [10, 15, 20, 50, 100]
            },
            scrollable: false,
                columns: [{
                title: '#',
                template: '#= ++record #',
            }, {
                field: 'provider_product_id',
                title: 'ID',
            }, {
                field: 'sku',
                title: 'SKU',
            }, {
                field: 'name',
                title: 'Name',
            }, {
                field: 'category',
                title: 'Category',
            }, {
                field: 'product_id',
                title: 'Product Binding',
                template: `
                    <a href="/admin/Products/ProviderProductBind/#=id#"
                        class="k-link bind-product product-thumbs #if (product_id) {# active #}#"
                        onclick="bindProduct(#=id#, #=product_id#)"
                        >
                        <img class="thumbs" src="#=product_image#" alt="#=product_name#">
                        <div class="action">
                            <svg class="bi b-icon" width="2em" height="2em" fill="currentColor">
                                <use xlink:href="/assets/images/bootstrap-icons.svg\\#pencil-square"/>
                            </svg>
                        </div>
                    </a>`,
            }],
            dataBinding: function() {
                record = this.dataSource.pageSize() * (this.dataSource.page() - 1);
            },
            dataBound: function() {
                $('.bind-product').magnificPopup({
                    type: 'ajax',
                    settings: { cache: false, async: false },
                    midClick: true,
                    callbacks: {
                        parseAjax: function (mfpResponse) {
                            console.log('test');
                            mfpResponse.data = $('<div></div>').html(mfpResponse.data);
                        },
                        ajaxContentAdded: function () {
                            console.log('test 2');
                            $('.mfp-wrap').removeAttr('tabindex');
                        }
                    }
                });
            },
        });
    });

    function bindProduct(id, product_id)
    {
        // console.log(id, product_id);
        // $('#product-grid').data('kendoGrid').refresh();
        return false;
    }
</script>
