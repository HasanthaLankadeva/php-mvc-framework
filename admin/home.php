<?php 
	require("includes/admin-header-open.php");
?>
    <body>
        <div class="holder">
            <div class="sidebar">
            	<?php 
					$adminPage = "home";
					include('includes/sideBar.php');
					include('includes/homePageStats.php');
				?>
            </div>
            <div class="content-wrapper">
            	<div class="top-bar">
                	<div class="breadcrumb">
                    	<a class="fa fa-home" href="home.php"></a>
					</div>
                    <div class="dev">
                    	<a class="fa fa-desktop" href="<?=SERVER;?>" title="Preview Site" target="_blank"></a>
                    </div>         
                    <div class="live">
                    	<a class="fa fa-globe" href="<?=LIVE_SERVER;?>" title="Live Site" target="_blank"></a>
                    </div>
                </div>
                
                <!-- start - include -->
                
                <div class="dash-board-items-wrapper">
				
					<!-- start - highlights -->
					
                	<ul class="no-bullets">
                        <li class="dash-board-item modules-block">
                        	<a href="modules.php" title="MODULES">
                                <div class="item-content-wrapper">
                                    <div class="item-content-inner-wrapper">
                                        <div class="icon-wrapper">
                                            <span class="icon fa fa-pencil-square-o"></span>
                                        </div>
                                        <div class="flex-wrapper">
                                            <h3>PAGES</h3>
                                            <p>Manage your content...</p>
                                            <p>Total Pages: 4</p>
                                        </div>
                                    </div>
                                </div>
                             </a>
                        </li>
                        <li class="dash-board-item media-block">
                        	<a href="mediaLib.php" title="MEDIA">
                                <div class="item-content-wrapper">
                                    <div class="item-content-inner-wrapper">
                                        <div class="icon-wrapper">
                                            <span class="icon fa fa-file-image-o"></span>
                                        </div>
                                        <div class="flex-wrapper">
                                            <h3>MEDIA MANAGER</h3>
                                            <p>Manage files stored in the media folder...</p>
                                            <p>Total Files: <?=count_files('img/uploads/');?></p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="dash-board-item admin-block">
                        	<a href="adminTools.php" title="ADMIN TOOLS">
                                <div class="item-content-wrapper">
                                    <div class="item-content-inner-wrapper">
                                        <div class="icon-wrapper">
                                            <span class="icon fa fa-cubes"></span>
                                        </div>
                                        <div class="flex-wrapper">
                                            <h3>ADMIN TOOLS</h3>
                                            <p>Access the CMS administration tools...</p>
                                            <p>Total Tools: 2</p>
                                        </div>
                                    </div>
                                </div>
                             </a>
                        </li>
                        <li class="dash-board-item access-block">
                        	<a href="userManager.php" title="USER MANAGEE">
                                <div class="item-content-wrapper">
                                    <div class="item-content-inner-wrapper">
                                        <div class="icon-wrapper">
                                            <span class="icon fa fa-users"></span>
                                        </div>
                                        <div class="flex-wrapper">
                                            <h3>USER MANAGER</h3>
                                            <p>Manage admin accounts...</p>
                                        	<p>Total Acounts: <?=$adminAccounts;?></p>
                                        </div>
                                    </div>
                                </div>
                             </a>
                        </li>
                    </ul>
					
					<!-- end - highlights -->
					
					<!-- start - widgets -->
					
					<div class="dash-board-widget-wrapper">
					
						<div class="grid-stack-item-content">
						  <div class="card">
							<div class="card-header">Latest orders</div>
							<div class="card-block">
							  <table class="table">
								<thead>
								  <tr>
									<th width="1">#</th>
									<th>Product</th>
									<th>Status</th>
									<th>Date received</th>
									<th>Total</th>
									<th>Action</th>
								  </tr>
								</thead>
								<tbody>
								  <tr>
									<td scope="row" class="text-center">1</td>
									<td>Sample product</td>
									<td width="100" title="processing">processing</td>
									<td width="150" title="3 weeks ago">3 weeks ago</td>
									<td width="150">
									  <span class="price" title="$3,843.00">$3,843.00</span>
									</td>
									<td class="text-center" width="70">
									  <a href="/admin/home.php?module=order/order&amp;order_id=76" class="btn btn-icon btn-outline-primary btn-sm" title="Edit">
										<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
									  </a>

									</td>
								  </tr>
								  <tr>
									<td scope="row" class="text-center">2</td>
									<td>Sample product</td>
									<td width="100" title="processing">processing</td>
									<td width="150" title="3 weeks ago">3 weeks ago</td>
									<td width="150">
									  <span class="price" title="$3,843.00">$3,843.00</span>
									</td>
									<td class="text-center" width="70">
									  <a href="/admin/home.php?module=order/order&amp;order_id=76" class="btn btn-icon btn-outline-primary btn-sm" title="Edit">
										<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
									  </a>

									</td>
								  </tr>
								  <tr>
									<td scope="row" class="text-center">3</td>
									<td>Sample product</td>
									<td width="100" title="processing">processing</td>
									<td width="150" title="3 weeks ago">3 weeks ago</td>
									<td width="150">
									  <span class="price" title="$3,843.00">$3,843.00</span>
									</td>
									<td class="text-center" width="70">
									  <a href="/admin/home.php?module=order/order&amp;order_id=76" class="btn btn-icon btn-outline-primary btn-sm" title="Edit">
										<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
									  </a>

									</td>
								  </tr>
								  <tr>
									<td scope="row" class="text-center">4</td>
									<td>Sample product</td>
									<td width="100" title="processing">processing</td>
									<td width="150" title="3 weeks ago">3 weeks ago</td>
									<td width="150">
									  <span class="price" title="$3,843.00">$3,843.00</span>
									</td>
									<td class="text-center" width="70">
									  <a href="/admin/home.php?module=order/order&amp;order_id=76" class="btn btn-icon btn-outline-primary btn-sm" title="Edit">
										<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
									  </a>

									</td>
								  </tr>
								  <tr>
									<td scope="row" class="text-center">5</td>
									<td>Sample product</td>
									<td width="100" title="processing">processing</td>
									<td width="150" title="3 weeks ago">3 weeks ago</td>
									<td width="150">
									  <span class="price" title="$3,843.00">$3,843.00</span>
									</td>
									<td class="text-center" width="70">
									  <a href="/admin/home.php?module=order/order&amp;order_id=76" class="btn btn-icon btn-outline-primary btn-sm" title="Edit">
										<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
									  </a>

									</td>
								  </tr>
								</tbody>
								
							  </table>
							</div>
						  </div>
						</div>
						
						<div class="grid-stack-item-content">
						  <div class="card salse-card">
							<div class="card-header">Salse</div>
								<div class="card-block">
									<canvas id="salesChart" width="400" height="200"></canvas>
								</div>
							</div>
						</div>
					</div>
					
					<!-- end - widgets -->
					
    			</div>
                
                <!-- end - include -->
				
            </div>
        </div>
		
		<script>
			const ctx = document.getElementById('salesChart');

			new Chart(ctx, {
			  type: 'line',
			  data: {
				labels: [
				  'January', 'February', 'March', 'April', 'May', 'June',
				  'July', 'August', 'September', 'October', 'November', 'December'
				],
				datasets: [{
				  label: 'Sales ($)',
				  data: [1200, 1500, 1300, 1700, 1800, 1600, 2000, 2100, 1900, 2200, 2400, 2300],
				  borderWidth: 2,
				  borderColor: 'rgba(75, 192, 192, 1)',
				  backgroundColor: 'rgba(75, 192, 192, 0.2)',
				  tension: 0.3  // smooth curve
				}]
			  },
			  options: {
				responsive: true,
				scales: {
				  y: {
					beginAtZero: true
				  }
				}
			  }
			});
		</script>
    </body>
</html>