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
                <a class="fa fa-home" href="home.php"></a> <span>/</span> <a href="modules.php">Modules</a> <span>/</span> <a href="items.php?m=<?=$module;?>&n=<?=$moduleName;?>"><?=$moduleName;?></a> <span>/</span> <span>Manage Categories</span>
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
                        <li class="active"><a href="category.php?m=<?=$module;?>&n=<?=$moduleName;?>">Manage Categories</a></li>
                        <li><a href="trash.php?m=<?=$module;?>&n=<?=$moduleName;?>">Manage Trashed Items</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="right-coll float-r">
            <?php 
                if(isset($_POST["save"])) {
                    $id_ary = explode(",",$_POST["row_order"]);
                    for($i=0;$i<count($id_ary);$i++) {
                        try {
                            $sql = "UPDATE category SET rowOrder='" . $i . "' WHERE id=". $id_ary[$i];
                            $sth = $DB->query($sql);
                        } catch(PDOException $e) {
                            echo $e->getMessage();
                        }
                    }
                    
                    
                    if(!empty($_POST['check_list'])){
                        foreach($_POST['check_list'] as $selected){
							$item = (explode("@@",$selected));
                            try {
                                $sql = "UPDATE category SET status='published' WHERE id=". $item[0];
                                $sth = $DB->query($sql);
                            } catch(PDOException $e) {
                                echo $e->getMessage();
                            }
                        }
                    };
                } else if(isset($_POST['delete']) && !empty($_POST['check_list'])){
                    foreach($_POST['check_list'] as $selected){
						$item = (explode("@@",$selected));
						if($item[1] == 'trashed'){                        
							try {
								//$sql = "UPDATE category SET status='trashed' WHERE id=". $item[0];
								$sql = "DELETE FROM category WHERE id=". $item[0];
								$sth = $DB->query($sql);
							} catch(PDOException $e) {
								echo $e->getMessage();
							}
						} else {
							try {
								$sql = "UPDATE category SET status='trashed' WHERE id=". $item[0];
								$sth = $DB->query($sql);
							} catch(PDOException $e) {
								echo $e->getMessage();
							}
						}
                    }
                } else if(isset($_POST['trash']) && !empty($_POST['check_list'])){
                    foreach($_POST['check_list'] as $selected){
						$item = (explode("@@",$selected));
                        try {
                            $sql = "UPDATE category SET status='trashed' WHERE id=". $item[0];
                            $sth = $DB->query($sql);
                        } catch(PDOException $e) {
                            echo $e->getMessage();
                        }
                    }
                }
                $sql = "SELECT * FROM category WHERE module='".$module."' ORDER BY status ASC, rowOrder ASC";
                $q = $DB->query($sql);
                $q->setFetchMode(PDO::FETCH_ASSOC);
                $items = '';
            ?>
            <form id="module-list" name="module-list" method = "post" action="<?php $_PHP_SELF ?>" />
                <div class="page-title-wrapper">
                    <div class="page-title">Manage Items</div>
                    <div class="button-wrapper">
                        <input type="submit" class="save" name="save" value="Save" onClick="saveOrder();" />
                        <input type="submit" class="delete" name="delete" value="Delete" />
                        <input type="submit" class="trash" name="trash" value="Trash" />
                    </div>
                </div>
                <input type = "hidden" name="row_order" id="row_order" />
                <ul id="sortable" class="no-bullets">
                    <?php while ($row = $q->fetch()){ ?>
                        <li id="<?=$row["id"];?>"><input name="check_list[]" type="checkbox" value="<?=$row["id"];?>@@<?=$row['status'];?>" /><a href="edit_cat.php?m=<?=$module;?>&n=<?=$moduleName;?>&id=<?=$row["id"];?>"><?=$row['categoryTitle'];?> <span class="status <?=$row['status'];?>"><?=$row['status'];?></span></a></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<script>
/*
jQuery('.save').click(function(event){
	jQuery('form .save').click();
	event.preventBubble=true;
})
*/


function saveOrder() {
	var selectedLanguage = new Array();
	$('#sortable li').each(function() {
		selectedLanguage.push($(this).attr("id"));
	});
	document.getElementById("row_order").value = selectedLanguage;
}


</script>
</body>
</html>