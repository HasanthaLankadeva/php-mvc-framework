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
		require_once('includes/languages.php');
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
                <a class="fa fa-home" href="home.php"></a> <span>/</span> <a href="modules.php">Modules</a> <span>/</span> <a href="items.php?m=<?=$module;?>&n=<?=$moduleName;?>"><?=$moduleName;?></a> <span>/</span> <span>Manage Tashed Items</span>
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
                        <li><a href="addcategory.php?m=<?=$module;?>&n=<?=$moduleName;?>">Add New Category</a></li>
                        <li><a href="category.php?m=<?=$module;?>&n=<?=$moduleName;?>">Manage Categories</a></li>
                        <li class="active"><a href="trash.php?m=<?=$module;?>&n=<?=$moduleName;?>">Manage Trashed Items</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="right-coll float-r">
                <?php 
                    if(isset($_POST["save"])) {
                        if(!empty($_POST['check_list'])){
                            foreach($_POST['check_list'] as $selected){
                                try {
                                    $sql = "UPDATE ".$module." SET status='published' WHERE itemID=". $selected;
                                    $sth = $DB->query($sql);
                                } catch(PDOException $e) {
                                    echo $e->getMessage();
                                }
                            }
                        };
                    } else if(isset($_POST['delete']) && !empty($_POST['check_list'])){
                        foreach($_POST['check_list'] as $selected){
                            try {
                                $sql = "DELETE FROM ".$module." WHERE itemID=". $selected;
                                $sth = $DB->query($sql);
                            } catch(PDOException $e) {
                                echo $e->getMessage();
                            }
                        }
                    }
                    //WHERE lanID LIKE 'en'
                    $sql = "SELECT * FROM ".$module." WHERE lanID LIKE '".$lang."' ORDER BY status ASC, rowOrder ASC";
                    $q = $DB->query($sql);
                    $q->setFetchMode(PDO::FETCH_ASSOC);
                ?>
                
                <form id="module-list" name="module-list" method = "post" action="<?php $_PHP_SELF ?>" />
                    <div class="page-title-wrapper">
                        <div class="page-title">Manage Items</div>
                        <div class="button-wrapper">
                            <input type="submit" class="save" name="save" value="Publish" onClick="saveOrder();" />
                            <input type="submit" class="delete" name="delete" value="Delete" />
                        </div>
                    </div>
                
                    <input type = "hidden" name="row_order" id="row_order" />
                    <ul class="no-bullets module-item-list">
                    
                        <?php 
                        $drafts = '';
                        while ($row = $q->fetch()){ 
                            if($row['status'] != 'published'){
                                $drafts .= '<li id="'.$row["itemID"].'"><input name="check_list[]" type="checkbox" value="'.$row["itemID"].'" /><a href="edit-module-item.php?m='.$module.'&n='.$moduleName.'&itemID='.$row["itemID"].'">'.$row["itemTitle"].' <span class="status '.$row["status"].'">'.$row["status"].'</span></a></li>';
                            }
                        } 

                        echo $drafts;
                        ?>
                    </ul>
                </form>
            
            </div>
        </div>
    </div>
</div>
</body>
</html>