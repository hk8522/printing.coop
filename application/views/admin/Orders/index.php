<link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<div class="content-wrapper dd">
<?php
$pageSize = 10;
$pageSizes = [10, 15, 20, 50, 100];
?>
<section class="content">
<div class="row">
    <div class="col-md-12">
        <div class="x_panel light form-fit popup-window">
            <?php if ($this->session->has_userdata('message_error')) {?>
                <div class="alert alert-danger">
                    <?=$this->session->flashdata('message_error')?>
                </div>
            <?php } ?>
            <?php if ($this->session->has_userdata('message_success')) {?>
                <div class="alert alert-success">
                    <?=$this->session->flashdata('message_success')?>
                </div>
            <?php } ?>
            <div class="x_title">
                <div class="caption">
                    <i class="fa fa-shopping-cart"></i>
                    <?=ucfirst($page_title)?>
                </div>
                <div class="actions btn-group btn-group-devided util-btn-margin-bottom-5">
                    <button class="btn btn-primary" id="export-csv">
                        <i class="fa fa-download"></i> Export CSV
                    </button>
                </div>
            </div>
            <form id="search-order-form" method="post" action="/admin/Orders/List">
                <div class="x_content form">
                    <div class="form-horizontal">
                        <div class="form-body">
                            <div class="col-12 px-0">
                                <div class="row align-items-end">
                                    <div class="col-md-4 col-ms-6 col-6">
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label" for="from">From #</label>
                                            <div class="col-md-9 col-sm-9">
                                                <input class="form-control" type="text" value="<?=$this->input->get('from_no')?>" id="from_no" name="from_no">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-ms-6 col-6">
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label" for="to">To #</label>
                                            <div class="col-md-9 col-sm-9">
                                                <input class="form-control" type="text" value="<?=$this->input->get('to_no')?>" id="to_no" name="to_no">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-4">
                                        <div class="form-actions">
                                            <div class="form-group">
                                                <button class="btn btn-success filter-submit" id="search-orders">
                                                    <i class="fa fa-search"></i> Search
                                                </button>
                                                <button class="btn btn-info" type="button" data-toggle="collapse" data-target="#filterCollapse" aria-expanded="false" aria-controls="filterCollapse">
                                                    <i class="fa fa-filter"></i>&nbsp; Filters
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="collapse" id="filterCollapse">
                            <div class="drop-filters-container w-100">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="from">From Date</label>
                                    <div class="col-md-9 col-sm-9">
                                        <?php $this->load->view('admin/shared/date_nullable', ['name' => 'from', 'value' => $this->input->get('from')]); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="to">To Date</label>
                                    <div class="col-md-9 col-sm-9">
                                        <?php $this->load->view('admin/shared/date_nullable', ['name' => 'to', 'value' => $this->input->get('to')]); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="status">Order Status</label>
                                    <div class="col-md-9 col-sm-9">
                                        <?php $this->load->view('admin/shared/multi_select', ['name' => 'status', 'items' => App\Common\OrderStatus::names, 'value' => $status != null ? [$status] : $this->input->get('status'), 'index' => true]); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="x_content">
                            <div id="orders-grid" class="tight"></div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div id="sina_ship_methods" style="display:none;">
    <form method="post" action="/admin/Orders/sendToSina">
        <input type="hidden" name="id">
        <!-- <input type="hidden" name="ship_method"> -->
        <div class="card">
            <div class="card-body">
                <div id="ship-methods-grid"></div>
            </div>
            <div class="card-footer">
                <div class="form-actions pull-right">
                    <input type="submit" class="k-button" value="Ok" />
                    <span class="k-button" onclick="$('#sina_ship_methods').data('kendoWindow').close();">Cancel</span>
                </div>
            </div>
        </div>
    </form>
</div>
<div id="sina_provider_orders" style="display:none;"><ul></ul></div>
<template id="order">
    <li>
        <ul id="order-info">
            <li><label>BillAddr:</label> <span id="BillAddr"></span>
            <li><label>BillAddr2:</label> <span id="BillAddr2"></span>
            <li><label>BillCity:</label> <span id="BillCity"></span>
            <li><label>BillCompany:</label> <span id="BillCompany"></span>
            <li><label>BillCountry:</label> <span id="BillCountry"></span>
            <li><label>BillEmail:</label> <span id="BillEmail"></span>
            <li><label>BillFName:</label> <span id="BillFName"></span>
            <li><label>BillLName:</label> <span id="BillLName"></span>
            <li><label>BillPhone:</label> <span id="BillPhone"></span>
            <li><label>BillState:</label> <span id="BillState"></span>
            <li><label>BillZip:</label> <span id="BillZip"></span>
            <li><label>FreightCost:</label> <span id="FreightCost"></span>
            <li><label>Notes:</label> <span id="Notes"></span>
            <li><label>ShipAddr:</label> <span id="ShipAddr"></span>
            <li><label>ShipAddr2:</label> <span id="ShipAddr2"></span>
            <li><label>ShipCity:</label> <span id="ShipCity"></span>
            <li><label>ShipCompany:</label> <span id="ShipCompany"></span>
            <li><label>ShipCountry:</label> <span id="ShipCountry"></span>
            <li><label>ShipEmail:</label> <span id="ShipEmail"></span>
            <li><label>ShipFName:</label> <span id="ShipFName"></span>
            <li><label>ShipLName:</label> <span id="ShipLName"></span>
            <li><label>ShipMethod:</label> <span id="ShipMethod"></span>
            <li><label>ShipPhone:</label> <span id="ShipPhone"></span>
            <li><label>ShipState:</label> <span id="ShipState"></span>
            <li><label>ShipZip:</label> <span id="ShipZip"></span>
            <li><label>created_time:</label> <span id="created_time"></span>
            <li><label>discount:</label> <span id="discount"></span>
            <li><label>id:</label> <span id="id"></span>
            <li><label>payment_charged:</label> <span id="payment_charged"></span>
            <li><label>status:</label> <span id="status"></span>
            <li><label>tax:</label> <span id="tax"></span>
            <li><label>total:</label> <span id="total"></span>
            <li><label>updated_time:</label> <span id="updated_time"></span>
        </ul>
        <ul id="order-items"></ul>
    </li>
</template>
<template id="order-item">
    <li>
        <ul>
            <li><label>id:</label> <span id="id"></span>
            <li><label>order_id:</label> <span id="order_id"></span>
            <li><label>product_id:</label> <span id="product_id"></span>
            <li><label>options:</label> <span id="options"></span>
            <li><label>optionsRaw:</label> <span id="optionsRaw"></span>
            <li><label>packageInfo:</label> <span id="packageInfo"></span>
            <li><label>price:</label> <span id="price"></span>
            <li><label>status:</label> <span id="status"></span>
            <li><label>tax:</label> <span id="tax"></span>
            <li><label>total:</label> <span id="total"></span>
            <li><label>extra:</label> <span id="extra"></span>
            <li><label>file_status:</label> <span id="file_status"></span>
            <li><label>files:</label> <span id="files"></span>
            <li><label>created_time:</label> <span id="created_time"></span>
        </ul>
    </li>
</template>
<script>
    function ucwords(str) {
        if (str)
            return str.toLowerCase().replace(/\b[a-z]/g, function(letter) {
                return letter.toUpperCase();
            });
        else
            return '';
    }
    function ucfirst(str) {
        if (str)
            return str.charAt(0).toUpperCase() + str.slice(1);;
        return '';
    }
    function refreshGrid(id) {
        var grid = $(`#${id}`).data('kendoGrid');
        grid.dataSource.page(grid.dataSource.page());
    }
    var currencies = <?=json_encode($CurrencyList)?>;
    var stores = <?=json_encode($StoreList)?>;
    var paymentStatus = {
        <?=App\Common\PaymentStatus::Pending?>: '<button type="button" class="btn btn-sm btn-warning">Pending</button>',
        <?=App\Common\PaymentStatus::Success?>: '<button type="button" class="btn btn-sm btn-info">Success</button>',
        <?=App\Common\PaymentStatus::Failed?>: '<button type="button" class="btn btn-sm btn-danger ">Failed</button>',
    };
    var orderStatus = {
        1 : '<button type="button" class="btn btn-sm">Incomplete</button>',
        2 : '<button type="button" class="btn btn-sm btn-primary">New Order</button>',
        3 : '<button type="button" class="btn btn-warning btn-sm">Processing</button>',
        4 : '<button type="button" class="btn btn-sm" style="background-color: #17a2b8; border-color: #17a2b8;">Shipped</button>',
        5 : '<button type="button" class="btn btn-info btn-sm">Delivered</button>',
        6 : '<button type="button" class="btn btn-dark btn-sm">Cancelled</button>',
        7 : '<button type="button" class="btn btn-danger btn-sm">Failed</button>',
        8 : '<button type="button" class="btn btn-info btn-sm">Complete</button>',
        9 : '<button type="button" class="btn btn-sm" style="background-color: #17a2b8; border-color: #17a2b8;">Ready for pickup</button>',
    };
    var salesTaxRatesProvinces = <?=json_encode($this->Address_Model->salesTaxRatesProvinces())?>;
    $(document).ready(function () {
        $('#export-csv').click(function () {
            var url = '/admin/Orders/exportCSV/<?=$statusStr?>/<?=$user_id?>';
            var from = $('#from').data('kendoDatePicker').value();
            var to = $('#to').data('kendoDatePicker').value();
            if (from == null)
                url += '/&nbsp;';
            else
                url += '/' + from.getFullYear() + '-' + (from.getMonth() + 1) + '-' + from.getDate();
            if (to == null)
                to += '/&nbsp;';
            else
                url += '/' + to.getFullYear() + '-' + (to.getMonth() + 1) + '-' + to.getDate();
            window.open(window.location.origin + url, '_blank').focus();
            return false;
        });
        $('#orders-grid').kendoGrid({
            dataSource: {
                transport: {
                    read: {
                        url: '/admin/Orders/list',
                        type: 'POST',
                        dataType: 'json',
                        data: additionalData
                    }
                },
                schema: {
                    data: 'data',
                    total: 'total',
                    errors: 'errors',
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
                template: '#=ucfirst(order_id)#',
            }, {
                title: 'Provider Order #',
                template: `
                    #if (provider_order_id) {#
                        <a href="/admin/Orders/provider/#=id#" class="provider-order" onClick="showProviderInfo(#=id#);return false;">#=provider_order_id##if (provider_order_count > 1) {#...#}#</a>
                    #} else if (provider_product_count > 0) {#
                        <select class="form-control" onchange="if (this.value == 'sina') sendToSina(#=id#, '#=shipping_method_formate#');">
                            <option></option>
                            <option value="sina">Send to Sina</option>
                        </select>
                    #}#
                `,
                // template: '<button type="button" class="btn btn-sm btn-info" onClick="sendToSina(#=id#, '#=shipping_method_formate#')">Send to Sina</button>',
            }, {
                title: 'Store Name',
                template: '#=stores[store_id].name#',
            }, {
                title: 'Customer Name',
                template: '#=ucwords(name)#',
            }, {
                title: 'Subtotal Amount',
                template: '#=currencies[currency_id].symbols + Number(sub_total_amount).toFixed(2)#',
            }, {
                title: 'Preffered Customer Discount',
                template: '#=preffered_customer_discount == 0 ? "-" : (currencies[currency_id].symbols + Number(preffered_customer_discount).toFixed(2))#',
            }, {
                title: 'Coupon Discount',
                template: '#=coupon_discount_amount == 0 ? "-" : (currencies[currency_id].symbols + Number(coupon_discount_amount).toFixed(2))#',
            }, {
                title: 'Shipping Fee',
                template: '#=delivery_charge == 0 ? "-" : ("<?=$product_price_currency_symbol?>" + Number(delivery_charge).toFixed(2))#',
            }, {
                field: 'total_sales_tax',
                title: 'Total Sales Tax',
                template: `#if (total_sales_tax == 0) {#-#} else {#
                    <span>#=salesTaxRatesProvinces[billing_state].Province# #=Number(salesTaxRatesProvinces[billing_state].total_tax_rate).toFixed(2)#%<br><strong><?=$product_price_currency_symbol?>#=Number(total_sales_tax).toFixed(2)#</strong></span>
                    #}#`,
            }, {
                title: 'Order Amount',
                template: '#=currencies[currency_id].symbols + Number(total_amount).toFixed(2)#',
            }, {
                title: 'Total Items',
                template: '#=ucfirst(total_items)#',
            }, {
                title: 'Payment Method',
                template: '#=ucfirst(payment_type)#',
            }, {
                title: 'Payment Status',
                template: '#=paymentStatusChangeOptions(id, payment_status)#',
            }, {
                field: 'transition_id',
                title: 'Transition Id',
            }, {
                field: 'created',
                title: 'Created On',
            }, {
                field: 'updated',
                title: 'Updated On',
            }, {
                title: 'Order Status',
                template: '#=orderStatusChangeOptions(id, order_id, payment_status, status)#',
            }, {
                title: 'View Orders',
                template: `<a class="view-btn" href="/<?=$class_name.$sub_page_view_url?>/#=id#">
                    <i class="far fa-eye fa-lg"></i></a>`,
            }, {
                title: 'Action',
                template: '#=itemActions(id, status, shipment_id, tracking_number, labels_regular, labels_thermal)#',
            }],
        });

        $('#search-order-form').submit(function(e) {
            e.preventDefault();
            $('#search-orders').click();
            return false;
        });
        //search button
        $('#search-orders').click(function () {
            //search
            var grid = $('#orders-grid').data('kendoGrid');
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

        $('#sina_ship_methods form').submit(function(e) {
            e.preventDefault();
            $("#loader-img").show();

            $.post('/admin/Orders/sendToSina', $(this).serialize())
            .done(function (response) {
                if (!response)
                    kendo.alert('Error occurred.');
                else if (!response.success)
                    kendo.alert(response.message);
               $('#sina_ship_methods').data('kendoWindow').close();
                refreshGrid('orders-grid');
                $("#loader-img").hide();
            }).fail(function (error) {
                kendo.alert(error);
                refreshGrid('orders-grid');
                $("#loader-img").hide();
            });
            return false;
        });
    });

    function sendToSina(id, shipping_method_formate) {
        var tokens = shipping_method_formate.split('-');
        var shipping_method = tokens.length == 3 ? tokens[2] : shipping_method_formate;
        var window = $('#sina_ship_methods');
        if (!window.data('kendoWindow')) {
            window.kendoWindow({
                modal: true,
                title: 'Select a Shipment Method',
                actions: ['Close'],
                width: '70%',
                height: '80%',
            });
        }
        window.data('kendoWindow').center().open();

        $("#loader-img").show();

        $('#sina_ship_methods [name="id"]').val(id);

        $('#ship-methods-grid').kendoGrid({
            dataSource: {
                transport: {
                    read: {
                        url: '/admin/Orders/sinaShipMethods',
                        type: 'POST',
                        dataType: 'json',
                        data: {id: id}
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
                    $("#loader-img").hide();
                },
                serverPaging: true,
                serverFiltering: true,
                serverSorting: true
            },
            scrollable: false,
            dataBound: function() {
                $("#loader-img").hide();
            },
            columns: [{
                field: 'name',
                title: 'Select',
                template: `<input type='radio' class='k-radio k-radio-md' name="ship_method" value="#=name#" #=(name == '${shipping_method}') ? 'checked' : ''#/>`,
            }, {
                field: 'type',
                title: 'Type',
            }, {
                field: 'name',
                title: 'Ship Method',
            }, {
                field: 'price',
                title: 'Price',
            }, {
                field: 'quantity',
                title: 'Quantity',
            }],
        });
    }

    function showProviderInfo(order_id) {
        $("#loader-img").show();

        $.ajax({
            type: "GET",
            url: `/admin/Orders/provider/${order_id}`,
            success: function(resp)
            {
                $("#loader-img").hide();
                console.log(resp);

                $('#sina_provider_orders ul').empty();
                var template = document.querySelector('#order');
                for (i = 0; i < resp.length; i++) {
                    var clone = template.content.cloneNode(true);
                    clone.querySelectorAll('#BillAddr')[0].innerHTML = resp[i].order.BillAddr;
                    clone.querySelectorAll('#BillAddr2')[0].innerHTML = resp[i].order.BillAddr2;
                    clone.querySelectorAll('#BillCity')[0].innerHTML = resp[i].order.BillCity;
                    clone.querySelectorAll('#BillCompany')[0].innerHTML = resp[i].order.BillCompany;
                    clone.querySelectorAll('#BillCountry')[0].innerHTML = resp[i].order.BillCountry;
                    clone.querySelectorAll('#BillEmail')[0].innerHTML = resp[i].order.BillEmail;
                    clone.querySelectorAll('#BillFName')[0].innerHTML = resp[i].order.BillFName;
                    clone.querySelectorAll('#BillLName')[0].innerHTML = resp[i].order.BillLName;
                    clone.querySelectorAll('#BillPhone')[0].innerHTML = resp[i].order.BillPhone;
                    clone.querySelectorAll('#BillState')[0].innerHTML = resp[i].order.BillState;
                    clone.querySelectorAll('#BillZip')[0].innerHTML = resp[i].order.BillZip;
                    clone.querySelectorAll('#FreightCost')[0].innerHTML = resp[i].order.FreightCost;
                    clone.querySelectorAll('#Notes')[0].innerHTML = resp[i].order.Notes;
                    clone.querySelectorAll('#ShipAddr')[0].innerHTML = resp[i].order.ShipAddr;
                    clone.querySelectorAll('#ShipAddr2')[0].innerHTML = resp[i].order.ShipAddr2;
                    clone.querySelectorAll('#ShipCity')[0].innerHTML = resp[i].order.ShipCity;
                    clone.querySelectorAll('#ShipCompany')[0].innerHTML = resp[i].order.ShipCompany;
                    clone.querySelectorAll('#ShipCountry')[0].innerHTML = resp[i].order.ShipCountry;
                    clone.querySelectorAll('#ShipEmail')[0].innerHTML = resp[i].order.ShipEmail;
                    clone.querySelectorAll('#ShipFName')[0].innerHTML = resp[i].order.ShipFName;
                    clone.querySelectorAll('#ShipLName')[0].innerHTML = resp[i].order.ShipLName;
                    clone.querySelectorAll('#ShipMethod')[0].innerHTML = resp[i].order.ShipMethod;
                    clone.querySelectorAll('#ShipPhone')[0].innerHTML = resp[i].order.ShipPhone;
                    clone.querySelectorAll('#ShipState')[0].innerHTML = resp[i].order.ShipState;
                    clone.querySelectorAll('#ShipZip')[0].innerHTML = resp[i].order.ShipZip;
                    clone.querySelectorAll('#created_time')[0].innerHTML = resp[i].order.created_time;
                    clone.querySelectorAll('#discount')[0].innerHTML = resp[i].order.discount;
                    clone.querySelectorAll('#id')[0].innerHTML = resp[i].order.id;
                    clone.querySelectorAll('#payment_charged')[0].innerHTML = resp[i].order.payment_charged;
                    clone.querySelectorAll('#status')[0].innerHTML = resp[i].order.status;
                    clone.querySelectorAll('#tax')[0].innerHTML = resp[i].order.tax;
                    clone.querySelectorAll('#total')[0].innerHTML = resp[i].order.total;
                    clone.querySelectorAll('#updated_time')[0].innerHTML = resp[i].order.updated_time;
                    var template2 = document.querySelector('#order-item');
                    for (var j = 0; j < resp[i].items.length; j++) {
                        var clone2 = template2.content.cloneNode(true);
                        clone2.querySelectorAll('#id')[0].innerHTML = resp[i].items[j].id;
                        clone2.querySelectorAll('#order_id')[0].innerHTML = resp[i].items[j].order_id;
                        clone2.querySelectorAll('#product_id')[0].innerHTML = resp[i].items[j].product_id;
                        clone2.querySelectorAll('#options')[0].innerHTML = resp[i].items[j].options;
                        clone2.querySelectorAll('#optionsRaw')[0].innerHTML = resp[i].items[j].optionsRaw;
                        clone2.querySelectorAll('#packageInfo')[0].innerHTML = resp[i].items[j].packageInfo;
                        clone2.querySelectorAll('#price')[0].innerHTML = resp[i].items[j].price;
                        clone2.querySelectorAll('#status')[0].innerHTML = resp[i].items[j].status;
                        clone2.querySelectorAll('#tax')[0].innerHTML = resp[i].items[j].tax;
                        clone2.querySelectorAll('#total')[0].innerHTML = resp[i].items[j].total;
                        clone2.querySelectorAll('#extra')[0].innerHTML = resp[i].items[j].extra;
                        clone2.querySelectorAll('#file_status')[0].innerHTML = resp[i].items[j].file_status;
                        clone2.querySelectorAll('#files')[0].innerHTML = resp[i].items[j].files;
                        clone2.querySelectorAll('#created_time')[0].innerHTML = resp[i].items[j].created_time;
                        $(clone.querySelectorAll('#order-items')[0]).append(clone2);
                    }
                    console.log(clone);
                    $('#sina_provider_orders ul').append(clone);
                }

                var window = $('#sina_provider_orders');
                if (!window.data('kendoWindow')) {
                    window.kendoWindow({
                        modal: true,
                        title: 'Provider Order Info',
                        actions: ['Close'],
                        width: '70%',
                        height: '80%',
                    });
                }
                window.data('kendoWindow').center().open();
            }
        });
    }

    function additionalData() {
        return {
            from_no: $('#search-order-form #from_no').val(),
            to_no: $('#search-order-form #to_no').val(),
            from: $('#search-order-form #from').val(),
            to: $('#search-order-form #to').val(),
            status: $('#search-order-form #status').data('kendoMultiSelect').value(),
        };
    }

    function paymentStatusChangeOptions(id, payment_status) {
        if (payment_status != <?=App\Common\PaymentStatus::Success?>) {
            var result = `<select class="form-control" onChange="changeOrderPaymentStatus(${id}, $(this).val())" style="width: 150px">
                <option value="">Change Payment Status</option>`;
            if (payment_status != <?=App\Common\PaymentStatus::Failed?>) {
                result += '<option value="<?=App\Common\PaymentStatus::Pending?>" ' + (payment_status == <?=App\Common\PaymentStatus::Pending?> ? 'selected="selected"' : '') + '>Pending</option>';
            }
            result += '<option value="<?=App\Common\PaymentStatus::Success?>" ' + (payment_status == <?=App\Common\PaymentStatus::Success?> ? 'selected="selected"' : '') + '>Success</option>';
            result += '</select>';
            return result;
        } else {
            return paymentStatus[payment_status];
        }
    }
    function orderStatusChangeOptions(id, order_id, payment_status, status) {
        var availables = <?=json_encode(App\Common\OrderStatus::names)?>;
        delete availables[<?=App\Common\OrderStatus::Incomplete?>];
        delete availables[<?=App\Common\OrderStatus::Failed?>];
        delete availables[<?=App\Common\OrderStatus::Complete?>];

        if (status == <?=App\Common\OrderStatus::Processing?>)
            delete availables[<?=App\Common\OrderStatus::New?>];
        if (status == <?=App\Common\OrderStatus::Shipped?>) {
            delete availables[<?=App\Common\OrderStatus::New?>];
            delete availables[<?=App\Common\OrderStatus::Processing?>];
            delete availables[<?=App\Common\OrderStatus::ReadyForPickup?>];
        }
        if (status == <?=App\Common\OrderStatus::ReadyForPickup?>) {
            delete availables[<?=App\Common\OrderStatus::New?>];
            delete availables[<?=App\Common\OrderStatus::Processing?>];
            delete availables[<?=App\Common\OrderStatus::Shipped?>];
        }
        if (status == <?=App\Common\OrderStatus::Delivered?>) {
            delete availables[<?=App\Common\OrderStatus::New?>];
            delete availables[<?=App\Common\OrderStatus::Processing?>];
            delete availables[<?=App\Common\OrderStatus::Shipped?>];
            delete availables[<?=App\Common\OrderStatus::Delivered?>];
            delete availables[<?=App\Common\OrderStatus::Cancelled?>];
            delete availables[<?=App\Common\OrderStatus::ReadyForPickup?>];
        }
        if (status == <?=App\Common\OrderStatus::Cancelled?>) {
            delete availables[<?=App\Common\OrderStatus::New?>];
            delete availables[<?=App\Common\OrderStatus::Processing?>];
            delete availables[<?=App\Common\OrderStatus::Shipped?>];
            delete availables[<?=App\Common\OrderStatus::Delivered?>];
            delete availables[<?=App\Common\OrderStatus::Cancelled?>];
            delete availables[<?=App\Common\OrderStatus::ReadyForPickup?>];
        }
        var result = '';
        if ([<?=App\Common\OrderStatus::New?>,
            <?=App\Common\OrderStatus::Processing?>,
            <?=App\Common\OrderStatus::Shipped?>,
            <?=App\Common\OrderStatus::ReadyForPickup?>
        ].indexOf(Number(status)) >= 0) {
            result += `<select class="form-control" onChange="changeOrderStatus(${id}, $(this).val(), '<?=$page_status?>', '${order_id}','${payment_status}')" id="select-${id}" style="width: 150px">
                <!--<option value="">Change Order Status</option>-->`;
            for (const [key, value] of Object.entries(availables)) {
                var selected = '';
                if (status == key)
                    selected = 'selected="selected"';
                result += `<option value="${key}" ${selected}>${value}</option>`;
            }
            result += '</select>';
        } else
            result = orderStatus[status];
        return result;
    }
    function itemActions(id, status, shipment_id, tracking_number, labels_regular, labels_thermal)
    {
        var result = '';
        if (status == <?=App\Common\OrderStatus::Delivered?> || status == <?=App\Common\OrderStatus::Cancelled?> || status == <?=App\Common\OrderStatus::Failed?>) {
            result += `<a class="view-btn" href="/<?=$class_name.$sub_page_delete_url?>/${id}/<?=$page_status?>" style="color:#d71b23" title="delete" onclick="return confirm('Are you sure you want to delete this order?');">
                <i class="fa fa-trash fa-lg"></i>
            </a>`;
        }
        if ((status == <?=App\Common\OrderStatus::Shipped?> || status == <?=App\Common\OrderStatus::Delivered?>) &&
            shipment_id != null && tracking_number != null && labels_regular != null && labels_thermal != null)
        {
            result += `<!--<label>Order shipment Id: ${shipment_id}</label><label>Order Tracking Number: ${shipment_id}</label>-->
                <a  href="${labels_regular}" target="_blank" title="Shipping Label (Regular)" style="margin-right:4px;">
                    <i class="fa fa-image fa-lg"></i>
                </a>
                <a  href="${labels_thermal}" target="_blank" title="Shipping Label (Thermal)" style="margin-right:4px;">
                    <i class="fa fa-image fa-lg"></i>
                </a>
                <a  href="javascript:void(0)" title="Tracking Order" style="margin-right:4px;" onclick="OrderTracking('${id}')">
                    <i class="fa fa-shipping-fast fa-lg"></i>
                </a>`;
        }
        return result;
    }
</script>
</section><!-- /.content -->

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
         <h4 class="modal-title">Comment for Customer </h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <form class="form-horizontal" name="commentform" method="post" action="" id="commentform">

      <input type="hidden" name="order_id" id="order_id">
      <input type="hidden" name="status" id="status">
      <input type="hidden" name="page_status" id="page_status">
      <input type="hidden" name="order_id_new" id="order_id_new">

      <div class="modal-body" id="myModalBody">
            <label>Loading...</label>
            <!--<div id="MsgError"></div>
            <div class="col-xs-12">
                <div class="form-group">
                    <label for="InputMessage" class="col-lg-12 control-label">Email Message</label>
                    <div class="col-lg-12">
                        <input type="hidden" name="mobileMsg" id="mobileMsg" >
                        <textarea name="emailMsg" id="webMsg" class="form-control" rows="5" required></textarea>
                    </div>
                </div>
            </div>-->
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success" id="btnSubmit">Submit</button>
      </div>
      </form>
    </div>
  </div>
</div>

<div id="myPaymentModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
         <h4 class="modal-title">Change Payment Status</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <form class="form-horizontal" name="commentform" method="post" action="" id="PaymentFrom">
      <input type="hidden" name="order_id" id="payment_order_id">
       <input type="hidden" name="payment_status" id="payment_status">
      <div class="modal-body">
            <div id="PMsgError"></div>
            <div class="col-xs-12">
                <div class="form-group">
                    <label for="InputMessage" class="col-lg-12 control-label">Payment Method</label>
                    <div class="col-lg-12">
                        <select name="payment_type"  class="form-control" id="payment_type"><option value="paypal">PayPal</option></select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="InputMessage" class="col-lg-12 control-label">Transition Id</label>
                    <div class="col-lg-12">
                        <input type="text" name="transition_id" id="transition_id" required  class="form-control">
                    </div>
                </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success" id="PbtnSubmit">Submit</button>
      </div>
      </form>
    </div>
  </div>
</div>

<div id="OrderTracking" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
         <h4 class="modal-title">Details</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body" id="OrderTrackingModalBody">
            <label>Loading...</label>
      </div>
    </div>
  </div>
</div>

</div>

 <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js">
 </script>
<script>
    $(document).ready(function() {
        $('#example1').DataTable({
            "order": [[ 0, "desc" ]]
        });
    });

    function changeOrderStatus(order_id, status, page_status, order_id_new, payment_status) {
        $("#btnSubmit").attr("disabled",true);
        var orderStatus = $("#orderStatus-" + order_id).val();
        if (status == '') {
            return false;
        } else if (orderStatus == status ) {
            return false;
        } else if ((status == 3 || status == 4 || status == 5 || status == 8) && (payment_status ==1 || payment_status ==3)) {
           alert("This order payment has been not done so you can't change status");
           return false;
        } else {
            $("#myModal").modal('show');
            var url ='<?=$BASE_URL?>admin/Orders/getOrderData/' + order_id + '/' + status;
            $.ajax({
                type: "GET",
                url: url,
                success: function(data)
                {
                    $("#loader-img").hide();
                    $("#myModal #order_id").val(order_id);
                    $("#myModal #status").val(status);
                    $("#myModal #page_status").val(page_status);
                    $("#myModal #order_id_new").val(order_id_new);
                    $("#myModal #btnSubmit").attr("disabled",false);
                    $("#myModal #myModalBody").html(data);
                }
            });
        }
    }

    $("#commentform").submit(function(e) {
        e.preventDefault(); // avoid to execute the actual submit of the form.
        var form = $(this);
        var formsubmit=true;
        $("#btnSubmit").attr("disabled",true);
        var order_id = $("#myModal #order_id").val();
        var status = $("#myModal #status").val();
        var page_status = $("#myModal #page_status").val();
        var order_id_new = $("#myModal #order_id_new").val();

        if (formsubmit == true) {
            $("#loader-img").show();
            var url ='<?=$BASE_URL?>admin/Orders/changeOrderStatus';
            $.ajax({
                type: "POST",
                url: url,
                data: form.serialize(), // serializes the form's elements.
                success: function(data)
                {
                    $("#loader-img").hide();
                    var json = JSON.parse(data);
                    var res = json.status;
                    var msg = json.msg;

                    if (res == 1) {
                        refreshGrid('orders-grid');
                        if (page_status == 'all') {
                            if (status == '3') {
                            $("#td-" + order_id).html('<?=getOrderSatusClass(3)?>');
                            } else if (status == '4') {
                                $("#td-" + order_id).html('<?=getOrderSatusClass(4)?>');
                            } else if (status == '5') {
                            $("#td-" + order_id).html('<?=getOrderSatusClass(5)?>');
                            } else if (status == '6') {
                                $("#td-" + order_id).html('<?=getOrderSatusClass(6)?>');
                            }
                        } else {
                            $("#row-" + order_id).remove();
                        }

                        $("#MsgError").html('<label style="color:green">'+msg+'</label>');

                        setTimeout(function() {
                            $("#btnSubmit").attr("disabled",false);

                            $("#MsgError").html('');
                            $("#myModal").modal('hide');
                            refreshGrid('orders-grid');
                        }, 2000);
                    } else {
                        $("#btnSubmit").attr("disabled",false);
                        $("#MsgError").html('<label style="color:red">'+msg+'</label>');
                    }
                },
                error: function (error) {
                    $("#btnSubmit").attr("disabled",false);
                }
            });
        } else {
            $("#btnSubmit").attr("disabled",false);
        }
    });

    function changeOrderPaymentStatus(order_id, payment_status) {
        $("#PMsgError").html('');
        $("#payment_order_id").val(order_id);
        $("#payment_status").val(payment_status);
        $("#myPaymentModal").modal('show');
    }

    $("#PaymentFrom").submit(function(e) {
        e.preventDefault(); // avoid to execute the actual submit of the form.
        var form = $(this);
        var formsubmit=true;
        $("#btnSubmit").attr("disabled",true);
        var order_id = $("#payment_order_id").val();
        var payment_status = $("#payment_status").val();
        var payment_type = $("#payment_type").val();
        var transition_id = $("#transition_id").val();

        if (formsubmit == true) {
            $("#loader-img").show();
            var url ='<?=$BASE_URL?>admin/Orders/changeOrderPaymentStatus';
            $.ajax({
                type: "POST",
                url: url,
                data: form.serialize(), // serializes the form's elements.

                success: function(data)
                {
                    $("#loader-img").hide();
                    var json = JSON.parse(data);
                    var res=json.status;
                    var msg=json.msg;
                    if (res == 1) {
                        refreshGrid('orders-grid');
                    } else {
                        $("#PbtnSubmit").attr("disabled",false);
                        $("#PMsgError").html('<label style="color:red">' + msg + '</label>');
                    }
                },
                error: function (error) {
                    $("#PbtnSubmit").attr("disabled",false);
                }
            });
        } else {
            $("#PbtnSubmit").attr("disabled",false);
        }
    });

    function OrderTracking(order_id) {
        if (order_id == '') {
            return false;
        } else {
            $("#OrderTracking").modal('show');
            var url ='<?=$BASE_URL?>admin/Orders/OrderTracking/'+order_id;;
            $.ajax({
                type: "GET",
                url: url,
                success: function(data)
                {
                    $("#OrderTrackingModalBody").html(data);
                }
            });
        }
    }

</script>
