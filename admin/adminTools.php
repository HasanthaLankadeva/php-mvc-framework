<?php 
	require("includes/admin-header-open.php"); 
	$moduleName = 'module_products';
	include('includes/tblRowData.php');
?>
<body>
<div class="holder">
    <div class="sidebar">
		<?php 
            $adminPage = "adminTools";
            include('includes/sideBar.php'); 
        ?>
    </div>
    <div class="content-wrapper">
    	<div class="top-bar">
            <div class="breadcrumb">
                <a class="fa fa-home" href="home.php"></a> <span>/</span> <span>Admin Tools</span>
            </div>
            <div class="dev">
				<a class="fa fa-desktop" href="<?=SERVER;?>" title="Preview Site" target="_blank"></a>
			</div>         
			<div class="live">
				<a class="fa fa-globe" href="<?=LIVE_SERVER;?>" title="Live Site" target="_blank"></a>
			</div>
        </div>
        <div class="inner-wrapper">
         	<h2 class="section-heading">Tools</h2>
            <ul class="modules">
				<li><a href='reviewData.php?m=module_produxts'><span class="icon-font fa fa-birthday-cake">Orders</span><span class="details">Total records: <?php echo $rrow['num']; ?></span></a></li>
				<li><a href='reviewData.php?m=module_reviews'><span class="icon-font fa fa-address-card-o">Reviews</span><span class="details">Total records: <?php echo $rrow['num'];?></span></a></li>
            </ul>
        </div>
    </div>
</div>  
</body>
</html>

