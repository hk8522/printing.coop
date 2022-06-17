<section class="content">
    <div class="row">
        <div class="col-xs-12 col-md-12">
            <div class="box">
                <div class="box-header">
                    <h2><?=$product->name?></h2>
                </div>
                <div class="box-body">
                    <div class="inner-head-section">
                        <div class="row align-items-end">
                            <div class="col-md-12">
<div class="search-box-area">
    <div class="search-sugg">
        <label class="span2">Search</label>
        <input class="form-control" type="text" placeholder="Search Product" onkeyup="searchProduct($(this).val())">
        <!--<button type="button"><i class="fas fa-search"></i></button>-->
    </div>
    <div class="search-result" style="display:none"> <!-- Add "active" class to show -->
        <a href="javascript:void(0)" onclick="hideSearchResult()"><i class="fas fa-times" ></i></a>
        <ul></ul>
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
            $('.search-result').show();
            $('.search-result ul').html('');
            $.ajax({
                type: 'POST',
                url: '/admin/Products/searchProduct',
                headers: { Accept: 'application/json; charset=utf-8' },
                data: { 'searchtext': searchtext }, // serializes the form's elements.
                success: function(data)
                {
                    $('#loader-img').hide();
                    var html = '<div>';
                    for (var i = 0; i < data.length; i++) {
                        html += `<li><a class="k-link product-thumbs" onclick="bindProduct(<?=$id?>, ${data[i].id})"><img src="${data[i].product_image}" width=50><span></i>${data[i].name}</span></li></a>`;
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
    function bindProduct(id, product_id)
    {
        // $('#loader-img').show();
        $.ajax({
            type: 'POST',
            url: '/admin/Products/ProviderProductBind/<?=$id?>',
            headers: { Accept: 'application/json; charset=utf-8' },
            data: { product_id: product_id },
            success: function(data)
            {
                $('#loader-img').hide();
                hideSearchResult();
                if (data.success) {
                    var grid = $('#product-grid').data('kendoGrid');
                    grid.dataSource.read();
                    grid.refresh();
                }
                $.magnificPopup.close();
            },
            error: function (error) {
            }
        });
    }
</script>
