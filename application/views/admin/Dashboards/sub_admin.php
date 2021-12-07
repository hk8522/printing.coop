<div class="content-wrapper" style="min-height: 687px;">
    <section class="content">
        <div class="top-home">
            <div class="marque">
                <marquee>
                    <i class="fas fa-glass-martini-alt"></i> Welcome to  <?php echo WEBSITE_NAME;?>  admin panel 
                   
                </marquee>
            </div>
        </div>
		<?php if($this->session->flashdata('url_error')){?>
		<div class="alert alert-danger" role="alert">
         <?php echo $this->session->flashdata('url_error');?>
        </div>
        <?php }?>
        <!--<div class="home-small-sections">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header card-header-warning card-header-icon">
                            <div class="card-icon">
                                <i class="fas fa-twitter"></i>
                            </div>
                            <p class="card-category">All Orders</p>
                            <h3 class="card-title"><?php echo $totalOrder;?></h3>
                        </div>
                        <div class="card-footer">
                            <div class="stats">
                                Till now
                             </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header card-header-success card-header-icon">
                            <div class="card-icon">
                                <i class="fas fa-twitter"></i>
                            </div>
                            <p class="card-category">Sales</p>
                            <h3 class="card-title">$<?php echo number_format($totalSale,2);?></h3>
                        </div>
                        <div class="card-footer">
                            <div class="stats">
                                Last 24 Hours
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header card-header-danger card-header-icon">
                            <div class="card-icon">
                                <i class="fas fa-twitter"></i>
                            </div>
                            <p class="card-category">Cancelled Orders</p>
                            <h3 class="card-title"><?php echo $totalCancelOrder?></h3>
                        </div>
                        <div class="card-footer">
                            <div class="stats">
                                Last 24 Hours
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header card-header-info card-header-icon">
                            <div class="card-icon">
                                <i class="fas fa-twitter"></i>
                            </div>
                            <p class="card-category">All Users</p>
                            <h3 class="card-title">+<?php echo $totalUser?></h3>
                        </div>
                        <div class="card-footer">
                            <div class="stats">
                                Till now
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="charts-section">
            <div class="row">
                <div class="col-md-4">
                    <div class="card card-chart">
                        <div class="card-header card-header-success">
                            <div class="ct-chart" id="dailySalesChart"></div>
                        </div>
                        <!--<div class="card-body">
                            <h4 class="card-title">Support  Queries</h4>
							
                            <p class="card-category"> Unresolved tickets</p>
							<div class="product-number">
                                <span>100</span>
                            </div>
							
                        </div>
						<div class="card-body section-divide">
                            <div class="card-body-info">
                                <h4 class="card-title">Support  Queries</h4>
                                <p class="card-category">Unresolved tickets</p>
                            </div>
                            <div class="product-number">
                                <span><?php echo $totalUnresolvedTicket?></span>
                            </div>
                        </div>
                        <div class="card-footer section-divide1">
                            <div class="stats">
                               Till now
                            </div>
                            <div class="view-btn view-green">
                                <a href="<?php echo $BASE_URL.'admin/Tickets/index/'?>"><button>View</button></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-chart">
                        <div class="card-header card-header-warning">
                            <div class="ct-chart" id="websiteViewsChart"></div>
                        </div>
                        <div class="card-body section-divide">
                            <div class="card-body-info">
                                <h4 class="card-title">Subscribers</h4>
                                <p class="card-category">Total Subscribers</p>
                            </div>
                            <div class="product-number">
                                <span><?php echo $totalSubscribeEmail?></span>
                            </div>
                        </div>
                        <div class="card-footer section-divide1">
                            <div class="stats">
                                Till now 
                            </div>
                            <div class="view-btn view-yellow">
                                <a href="<?php echo $BASE_URL_ADMIN ?>Products/subscribeEmail"><button>View</button></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-chart">
                        <div class="card-header card-header-danger">
                            <div class="ct-chart" id="completedTasksChart"></div>
                        </div>
                        <div class="card-body section-divide">
                            <div class="card-body-info">
                                <h4 class="card-title">Products</h4>
                                <p class="card-category">Total Products</p>
                            </div>
                            <div class="product-number">
                                <span><?php echo $totalProducts?></span>
                            </div>
                        </div>
                        <div class="card-footer section-divide1">
                            <div class="stats">
                               Till now 
                            </div>
                            <div class="view-btn view-red">
                                <a href="<?php echo $BASE_URL_ADMIN ?>Products"><button>View</button></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="status-section">
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <div class="card">
                        <div class="card-header card-header-tabs card-header-primary">
                            <div class="nav-tabs-navigation">
                                <div class="nav-tabs-wrapper">
                                    <ul class="nav nav-tabs" data-tabs="tabs">
                                        <li class="nav-item">
                                            <a class="nav-link active" href="#profile" data-toggle="tab" onclick="getOrdersByStatus('<?php echo base64_encode(2)?>')">
                                                New Orders
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#messages" data-toggle="tab" onclick="getOrdersByStatus('<?php echo base64_encode(5)?>')">
                                                Delivered Orders
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#settings" data-toggle="tab" onclick="getOrdersByStatus('<?php echo base64_encode(6)?>')">
                                                Cancelled Orders
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane active" id="profile">
                                    <table class="table">
									   <thead class="text-warning">
                                        <tr>
                                        <th>Order Id</th>
                                        <th>Customer Name</th>
                                        <th>Order Amount</th>
										<th>Total Items</th>
                                        <th>Created On</th>
                                        </tr>
                                        </thead>
                                        <tbody id="listOrderData">
                                            <tr>
                                                <td class="text-center" colspan="4">   
                                      			Please wait	loading orders...								
                                                </td>           
                                            </tr>
											
                                        </tbody>
                                    </table>
									<div class="view-btn view-blue text-right">
                                       <a href="<?php echo $BASE_URL_ADMIN ?>Orders/index/all"><button>View</button></a>
                                   </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="card">
                        <div class="card-header card-header-warning custom-h">
                            <h4 class="card-title">New Registered Customers</h4>
                        </div>
                        <div class="card-body table-responsive">
                            <table class="table table-hover">
                                <thead class="text-warning">
                                    <tr>
                                        <th>Sn</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Registered On</th>
                                    </tr>
                                </thead>
                                <tbody>
								    <?php 
									if(!empty($userList)){
									$i=1;	
									foreach($userList as $list){?>
										<tr>
											<td><?php echo $i;
											$i++;?></td>
											<td><?php echo $list['name'];
											?></td>
											<td><?php echo $list['email'];
											?></td>
											<td><?php echo dateFormate($list['created']);?></td>
										</tr>
                                    <?php 
									}
									}else{?>
									   <tr>
											<td colspan="4" class="text-center">List empty</td>
											
										</tr> 
									<?php }?>
                                </tbody>
                            </table>
							<div class="view-btn view-orange text-right">
                                <a href="<?php echo $BASE_URL_ADMIN ?>Users"><button>View</button></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>-->
    </section>
</div>

<script>
var BASE_URL='<?php echo $BASE_URL_ADMIN;?>';
var status='<?php echo base64_encode(2);?>';
getOrdersByStatus(status);

function getOrdersByStatus(order_status){
	
	    var url =BASE_URL+'Orders/getOrdersByStatus/'+order_status;
		$.ajax({
			    type: "GET",
			    url: url,
			    success: function(data)
			    {    
			      $("#listOrderData").html(data);  
			    },
			    error: function (error) {
					
			    }
		});
		
}
</script>