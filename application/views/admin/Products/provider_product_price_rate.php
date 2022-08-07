<form id="price-rate-form" method="post" action="/admin/Products/ProviderProductPriceRate/<?= $product->id?>">
    <div class="card">
        <div class="card-header">
            <h3>Update Price Rate</h3>
        </div>
        <div class="card-body">
            <div class="form-horizontal">
                <div class="form-body">
                    <div class="form-group">
                        <label for="price_rate" class="control-label">Price Rate</label>
                        <input class="form-control" type="text" placeholder="Price Rate" name="price_rate" value="<?= $product->price_rate?>">
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer section-divide1">
            <div class="stats"></div>
            <button class="btn btn-success filter-submit" type="submit">
                <i class="fa fa-check"></i> Update
            </button>
        </div>
    </div>
</form>
<script>
    $(document).ready(function () {
        $('#price-rate-form').on('submit', function (e) {
            e.preventDefault();
            $("#loader-img").show();
            $.post('/admin/Products/ProviderProductPriceRate/<?= $product->id?>', $(this).serialize())
            .done(function (response) {
                if (!response)
                    kendo.alert('Error occurred.');
                else if (!response.success)
                    kendo.alert(response.message);
                refreshGrid('products-grid');
                $("#loader-img").hide();
                $.magnificPopup.close();
            }).fail(function (error) {
                kendo.alert(error);
                refreshGrid('products-grid');
                $("#loader-img").hide();
            });
        });
    });
</script>
