<?php 
$adminPage = "userManager";
require("includes/admin-header-open.php");
?>
<body>
<div class="holder">
    <div class="sidebar">
		<?php 
            include('includes/sideBar.php'); 
        ?>
    </div>
    <div class="content-wrapper">
    	<div class="top-bar">
            <div class="breadcrumb">
                <a class="fa fa-home" href="home.php"></a> <span>/</span> <span>User Manager</span>
            </div>
            <div class="dev">
				<a class="fa fa-desktop" href="<?=SERVER;?>" title="Preview Site" target="_blank"></a>
			</div>         
			<div class="live">
				<a class="fa fa-globe" href="<?=LIVE_SERVER;?>" title="Live Site" target="_blank"></a>
			</div>
        </div>
        <div class="inner-wrapper">  
            <?php include('includes/user-list.php'); ?>
        </div>
    </div>
</div>
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/dataTables.bootstrap.min.js"></script>


<script type="text/javascript">

$(document).ready(function() {

	$('#example').DataTable();

});
</script>



</body>
</html>