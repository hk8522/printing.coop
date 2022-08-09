<div class="content-wrapper" style="min-height: 687px;">
    <section class="content">
        <div class="row" style="display: flex;justify-content: center;align-items: center;">
            <div class="col-md-12 col-xs-12">
                <div class="box box-success box-solid">
                    <div class="box-body">
                        <div class="inner-head-section">
                            <div class="inner-title">
                                <span>Discount List</span>
                            </div>
                        </div>
                        <div class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                            <div class="custom-mini-table">
                                <table id="example1" class="table table-bordered table-striped dataTable no-footer" role="grid" aria-describedby="example1">
                                    <thead>
                                        <tr role="row">
                                            <th>Discount Code</th>
                                            <th>Categories</th>
                                            <th>Brands</th>
                                            <th>Products</th>
                                            <th>Discount Type</th>
                                            <th>Discount Valid From</th>
                                            <th>Discount Valid Till</th>
                                            <th>Minimum Quantity</th>
                                            <th>Maximum Quantity</th>
                                            <th>Discount Limit</th>
                                            <th>Created On</th>
                                            <th>Updated On</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Discount Code</td>
                                            <td>Categories</td>
                                            <td>Brands</td>
                                            <td>Products</td>
                                            <td>Discount Type</td>
                                            <td>Discount Valid From</td>
                                            <td>Discount Valid Till</td>
                                            <td>Minimum Quantity</td>
                                            <td>Maximum Quantity</td>
                                            <td>Discount Limit</td>
                                            <td>26 Aug 2019 15:18:45</td>
                                            <td>26 Aug 2019 15:18:45</td>
                                            <td>
                                                <a href="#">
                                                     <button type="submit" class="custon-active">Active</button>
                                                </a>
                                            </td>
                                            <td>
                                                <div class="action-btns">
                                                       <a href="#" style="color:#3c8dbc;padding: 5px;" title="view">
                                                        <i class="fa far fa-eye fa-lg"></i>
                                                       </a>
                                                       <a href="#" style="color:green;padding: 5px;" title="edit">
                                                        <i class="fa far fa-edit fa-lg"></i>
                                                       </a>
                                                       <a href="#" style="color:#d71b23;padding: 5px;" title="delete">
                                                         <i class="fa fa-trash fa-lg"></i>
                                                       </a>
                                               </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Discount Code</td>
                                            <td>Categories</td>
                                            <td>Brands</td>
                                            <td>Products</td>
                                            <td>Discount Type</td>
                                            <td>Discount Valid From</td>
                                            <td>Discount Valid Till</td>
                                            <td>Minimum Quantity</td>
                                            <td>Maximum Quantity</td>
                                            <td>Discount Limit</td>
                                            <td>26 Aug 2019 15:18:45</td>
                                            <td>26 Aug 2019 15:18:45</td>
                                            <td>
                                                   <a href="#">
                                                     <button type="submit" class="custon-delete">Inactive</button>
                                                   </a>
                                            </td>
                                            <td>
                                                <div class="action-btns">
                                                       <a href="#" style="color:#3c8dbc;padding: 5px;" title="view">
                                                        <i class="fa far fa-eye fa-lg"></i>
                                                       </a>
                                                       <a href="#" style="color:green;padding: 5px;" title="edit">
                                                        <i class="fa far fa-edit fa-lg"></i>
                                                       </a>
                                                       <a href="#" style="color:#d71b23;padding: 5px;" title="delete">
                                                         <i class="fa fa-trash fa-lg"></i>
                                                       </a>
                                               </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div><!-- /.box -->
            </div><!-- /.col-->
        </div><!-- ./row -->
    </section><!-- /.content -->
 </div>

<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function() {
    $('#example1').DataTable({
        "order": [[ 3, "asc" ]]
    });
});
</script>
