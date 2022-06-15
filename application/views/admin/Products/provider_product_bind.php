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
    function searchProduct(searchtext) {
        if (searchtext !='') {
            $("#loder-img").show();
            var url ='/admin/Products/searchProduct';
            $("#searchDiv").show();
            $("#ProductListUl").html('');
            $.ajax({
                type: "POST",
                url: url,
                data:{'searchtext':searchtext}, // serializes the form's elements.
                success: function(data)
                {
                    $("#loder-img").hide();
                    $("#ProductListUl").html(data);
                },
                error: function (error) {
                }
            });
        } else {
            $("#searchDiv").hide();
            $("#ProductListUl").html('');
            $("#searchSgedProductTextBox").val('');
        }
    }
    function hidesearchDiv() {
        $("#searchDiv").hide();
        $("#ProductListUl").html('');
    }
</script>
