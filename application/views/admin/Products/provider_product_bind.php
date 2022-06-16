<section class="content">
    <div class="row">
        <div class="col-xs-12 col-md-12">
            <div class="box">
                <div class="box-body">
                    <div class="inner-head-section">
                        <div class="row align-items-end">
                            <div class="col-md-12">
<div class="search-box-area">
    <div class="search-sugg">
        <label class="span2">Search</label>
        <input class="form-control" type="text" placeholder="Search Product"  onkeyup="searchProduct($(this).val())" id="searchSgedProductTextBox" name="searchSgedProductTextBox">
        <!--<button type="button"><i class="fas fa-search"></i></button>-->
    </div>
    <div class="search-result" id="searchDiv" style="display:none"> <!-- Add "active" class to show -->
        <a href="javascript:void(0)" onclick="hidesearchDiv()"><i class="fas fa-times" ></i></a>
        <ul id="ProductListUl">
        </ul>
    </div>
</div>
</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    function searchProduct(searchtext)
    {
        if (searchtext !='') {
            $('#loader-img').show();
            $('#searchDiv').show();
            $('#ProductListUl').html('');
            $.ajax({
                type: 'POST',
                url: '/admin/Products/searchProduct',
                headers: { Accept: 'application/json; charset=utf-8' },
                data: { 'searchtext':searchtext }, // serializes the form's elements.
                success: function(data)
                {
                    $('#loader-img').hide();
                    var html = '<div>';
                    for (var i = 0; i < data.length; i++) {
                        html += `<li><a class="k-link product-thumbs" onclick="bindProduct(<?=$id?>, ${data[i].id})"><img src="${data[i].product_image}" width=50><span></i>${data[i].name}</span></li></a>`;
                    }
                    html += '</div>';
                    $('#ProductListUl').html(html);
                },
                error: function (error) {
                }
            });
        } else {
            $('#searchDiv').hide();
            $('#ProductListUl').html('');
            $('#searchSgedProductTextBox').val('');
        }
    }
    function hidesearchDiv()
    {
        $('#searchDiv').hide();
        $('#ProductListUl').html('');
    }
    function bindProduct(id, product_id)
    {
        $.ajax({
            type: 'POST',
            url: '/admin/Products/ProviderProductBind/<?=$id?>',
            headers: { Accept: 'application/json; charset=utf-8' },
            data: { product_id: product_id },
            success: function(data)
            {
                $('#loader-img').hide();
                hidesearchDiv();
                if (data.success) {
                    var grid = $('#product-grid').data('kendoGrid');
                    grid.dataSource.read();
                    grid.refresh();
                }
            },
            error: function (error) {
            }
        });
    }
</script>
