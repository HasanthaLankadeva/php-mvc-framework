<?php require("includes/admin-header-open.php"); ?>
<body>
<div class="holder">
	<?php 
		if (isset($_GET['m']) && isset($_GET['n'])){
			$module = $_GET['m'];
			$moduleName = $_GET['n'];
		} else {
			echo '<script type="text/javascript">window.location.href = "home.php";</script>';
		}
		if(isset($_POST['submit'])) {
			$categoryTitle = $_POST['categoryTitle'];
			$categoryKey = $_POST['categoryKey'];
			try {
				$sql = "INSERT INTO category (status, module, categoryTitle, categoryKey) VALUES ('published', '$module', '$categoryTitle', '$categoryKey')";
				$sth = $DB->query($sql);
			} catch(PDOException $e) {
				echo $e->getMessage();
			}
			$DB = null;
			echo '<script type="text/javascript">window.location.href = "category.php?m="'.$module.'"&n="'.$moduleName.'";</script>';
		}		
	?>
    <div class="sidebar">
		<?php 
            $adminPage = "modules";
            include('includes/sideBar.php'); 
        ?>
    </div>
    <div class="content-wrapper">
    	<div class="top-bar">
            <div class="breadcrumb">
                <a class="fa fa-home" href="home.php"></a> <span>/</span> <a href="modules.php">Modules</a> <span>/</span> <a href="items.php?m=<?=$module;?>&n=<?=$moduleName;?>"><?=$moduleName;?></a> <span>/</span> <span>Add New Category</span>
            </div>
           <div class="dev">
				<a class="fa fa-desktop" href="<?=SERVER;?>" title="Preview Site" target="_blank"></a>
			</div>         
			<div class="live">
				<a class="fa fa-globe" href="<?=LIVE_SERVER;?>" title="Live Site" target="_blank"></a>
			</div>
        </div>
        <div class="inner-wrapper">
            <div class="left-coll float-l">
                <div class="module-menu">
                    <ul>
						<?php if($module != 'module_lectures') { ?>
                        <li><a href="additem.php?m=<?=$module;?>&n=<?=$moduleName;?>">Add New Item</a></li>
						<?php } ?>
                        <li><a href="items.php?m=<?=$module;?>&n=<?=$moduleName;?>">Manage Items</a></li>
                        <li class="active"><a href="addcategory.php?m=<?=$module;?>&n=<?=$moduleName;?>">Add New Category</a></li>
                        <li><a href="category.php?m=<?=$module;?>&n=<?=$moduleName;?>">Manage Categories</a></li>
                        <li><a href="trash.php?m=<?=$module;?>&n=<?=$moduleName;?>">Manage Trashed Items</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="right-coll float-r">
                <form class="module-form" method = "post" action="<?php $_PHP_SELF ?>" enctype='multipart/form-data'>
                    <ul>
                        <li>
                            <label for="categoryTitle">Category Title</label>
                            <input type="text" name="categoryTitle" value="" />
                        </li>
                        <li>
                            <label for="categoryKey">Category Key</label>
                            <input type="text" name="categoryKey" value="" />
                        </li>
                        <li class="button-row">
                            <input name="submit" type="submit" id="add" value="Save">
                        </li>
                    </ul>
                </form>
            </div>
        </div>
	</div>
</div>
</body>
</html>