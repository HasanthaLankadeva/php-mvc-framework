<?php require("includes/admin-header-open.php"); ?>
    <body>
        <div class="holder">
            <div class="sidebar">
            	<?php 
					$adminPage = "modules";
					include('includes/sideBar.php'); 
				?>
            </div>
            <div class="content-wrapper">
            	<div class="top-bar">
                	<div class="breadcrumb">
                    	<a class="fa fa-home" href="home.php"></a> <span>/</span> <span>Modules</span>
					</div>
                    <div class="dev">
						<a class="fa fa-desktop" href="<?=SERVER;?>" title="Preview Site" target="_blank"></a>
					</div>         
					<div class="live">
						<a class="fa fa-globe" href="<?=LIVE_SERVER;?>" title="Live Site" target="_blank"></a>
					</div>
                </div>
                <div class="inner-wrapper">
                	<h2 class="section-heading">List of Modules</h2>
                	<?php include('includes/moduleList.php'); ?>
            	</div>
            </div>
        </div>
    </body>
</html>