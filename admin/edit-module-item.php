<?php require("includes/admin-header-open.php"); ?>
<body>
<div class="holder">
	<?php 
		$dir = dirname($_SERVER['PHP_SELF']);
		if (isset($_GET['m']) && isset($_GET['n'])){
			$module = $_GET['m'];
			$moduleName = $_GET['n'];
		} else {
			echo '<script type="text/javascript">window.location.href = "home.php";</script>';
		}
		require_once('functions/global-functions.php');
		require_once('includes/languages.php');	
		if(!empty($module)) {
			fields($module);			
		}
		if(!empty($_GET['itemID'])) {
			$module_itemID = $_GET['itemID'];
			$mappingTable = (isset($mappingTable)) ? $mappingTable : '' ;
			readModule($module,$module_itemID,$lang,$mappingTable,$DB);
		}
		if(isset($_POST['submit']) || isset($_POST['draft'])) {
			$files = (empty($_POST['file']) ? '' : $_POST['file']);
			updateModule($module,$module_itemID,$files,$lang,$languages,$DB,$moduleName,$dir);
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
                <a class="fa fa-home" href="home.php"></a> <span>/</span> <a href="modules.php">Modules</a> <span>/</span> <a href="items.php?m=<?=$module;?>&n=<?=$moduleName;?>"><?=$moduleName;?></a> <span>/</span> <span>Edit Item - <?=$module_itemTitle;?></span>
            </div>
            <div class="dev">
                <a class="fa fa-desktop" href="/"></a>
            </div>
            <div class="live">
                <a class="fa fa-globe" href="/"></a>
            </div>
        </div>
        <div class="inner-wrapper">
            <div class="left-coll float-l">
                <div class="module-menu">
                    <ul>
						<?php if($module != 'module_lectures') { ?>
                        <li><a href="additem.php?m=<?=$module;?>&n=<?=$moduleName;?>">Add New Item</a></li>
						<?php } ?>
                        <li class="active"><a href="items.php?m=<?=$module;?>&n=<?=$moduleName;?>">Manage Items</a></li>
                        <li><a href="addcategory.php?m=<?=$module;?>&n=<?=$moduleName;?>">Add New Category</a></li>
                        <li><a href="category.php?m=<?=$module;?>&n=<?=$moduleName;?>">Manage Categories</a></li>
                        <li><a href="trash.php?m=<?=$module;?>&n=<?=$moduleName;?>">Manage Trashed Items</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="right-coll float-r">
                
                 <div class="page-title-wrapper">
                    <div class="page-title">Manage Items</div>
                </div>
                <div id="media">
                    <?php include('attachment.php'); ?>
                </div>
                <form class="module-form" method = "post" action="<?php $_PHP_SELF ?>" enctype='multipart/form-data'>
                    <ul>
                        <?php if(isset($itemTitle) && $itemTitle=='true'): ?>
                            <li>
                                <label for="itemTitle"><?=$itemTitleLabel;?></label>
                                <input type="text" name="itemTitle" value="<?=$module_itemTitle;?>" />
                            </li>
                        <?php endif; ?>
                
                        <?php if(isset($itemImage) && $itemImage=='true'): ?>
                            <li>
                                <label for="itemImage"><?=$itemImageLabel;?></label>               
                                <div class="item-image-wrapper">
                                    <div class="imagePreview mainImagePreview" style="background-image:url('<?=$module_itemImage;?>')"></div>
                                    <input name="mainImage" type="hidden" class="mainImage" value="<?=$module_itemImage;?>">
                                </div>
                            </li>
                        <?php endif; ?>
                
                        <?php if(isset($content) && $content=='true'): ?>
                            <li>
                                <label for="content"><?=$contentLabel;?></label>
                                <textarea class="content" name="content"><?=$module_content;?></textarea>
                            </li>
                        <?php endif; ?>
                
                        <?php if(isset($contentOne) && $contentOne=='true'): ?>
                            <li>
                                <label for="contentOne"><?=$contentOneLabel;?></label>
                                <textarea class="content" name="contentOne"><?=$module_contentOne;?></textarea>
                            </li>
                        <?php endif; ?>
                
                        <?php if(isset($contentTwo) && $contentTwo=='true'): ?>
                            <li>
                                <label for="contentTwo"><?=$contentTwoLabel;?></label>
                                <textarea class="content" name="contentTwo"><?=$module_contentTwo;?></textarea>
                            </li>
                        <?php endif; ?>
                        
                        <?php if(isset($lineOne) && $lineOne=='true'): ?>
                            <li>
                                <label for="lineOne"><?=$lineOneLabel;?></label>
                                <input type="text" name="lineOne" value="<?=$module_lineOne;?>" />
                            </li>
                        <?php endif; ?>
                        
                        <?php if(isset($lineTwo) && $lineTwo=='true'): ?>
                            <li>
                                <label for="lineTwo"><?=$lineTwoLabel;?></label>
                                <input type="text" name="lineTwo" value="<?=$module_lineTwo;?>" />
                            </li>
                        <?php endif; ?>
                        
                        <?php if(isset($lineThree) && $lineThree=='true'): ?>
                            <li>
                                <label for="lineThree"><?=$lineThreeLabel;?></label>
                                <input type="text" name="lineThree" value="<?=$module_lineThree;?>" />
                            </li>
                        <?php endif; ?>
						
						<?php if(isset($lineFour) && $lineFour=='true'): ?>
                            <li>
                                <label for="lineFour"><?=$lineFourLabel;?></label>
                                <input type="text" name="lineFour" value="<?=$module_lineFour;?>" />
                            </li>
                        <?php endif; ?>
						
						<?php if(isset($lineFive) && $lineFive=='true'): ?>
                            <li>
                                <label for="lineFive"><?=$lineFiveLabel;?></label>
                                <input type="text" name="lineFive" value="<?=$module_lineFive;?>" />
                            </li>
                        <?php endif; ?>
						
						<?php if(isset($lineSix) && $lineSix=='true'): ?>
                            <li>
                                <label for="lineSix"><?=$lineSixLabel;?></label>
                                <input type="text" name="lineSix" value="<?=$module_lineSix;?>" />
                            </li>
                        <?php endif; ?>
						
						<?php if(isset($lineSeven) && $lineSeven=='true'): ?>
                            <li>
                                <label for="lineSeven"><?=$lineSevenLabel;?></label>
                                <input type="text" name="lineSeven" value="<?=$module_lineSeven;?>" />
                            </li>
                        <?php endif; ?>
						
						<?php if(isset($lineEight) && $lineEight=='true'): ?>
                            <li>
                                <label for="lineEight"><?=$lineEightLabel;?></label>
                                <input type="text" name="lineEight" value="<?=$module_lineEight;?>" />
                            </li>
                        <?php endif; ?>
						
						<?php if(isset($lineNine) && $lineNine=='true'): ?>
                            <li>
                                <label for="lineNine"><?=$lineNineLabel;?></label>
                                <input type="text" name="lineNine" value="<?=$module_lineNine;?>" />
                            </li>
                        <?php endif; ?>
						
						<?php if(isset($lineTen) && $lineTen=='true'): ?>
                            <li>
                                <label for="lineTen"><?=$lineTenLabel;?></label>
                                <input type="text" name="lineTen" value="<?=$module_lineTen;?>" />
                            </li>
                        <?php endif; ?>
						
						<?php if(isset($lineEleven) && $lineEleven=='true'): ?>
                            <li>
                                <label for="lineEleven"><?=$lineElevenLabel;?></label>
                                <input type="text" name="lineEleven" value="<?=$module_lineEleven;?>" />
                            </li>
                        <?php endif; ?>
						
						<?php if(isset($lineTwelve) && $lineTwelve=='true'): ?>
                            <li>
                                <label for="lineTwelve"><?=$lineTwelveLabel;?></label>
                                <input type="text" name="lineTwelve" value="<?=$module_lineTwelve;?>" />
                            </li>
                        <?php endif; ?>
						
						<?php if(isset($lineThirteen) && $lineThirteen=='true'): ?>
                            <li>
                                <label for="lineThirteen"><?=$lineThirteenLabel;?></label>
                                <input type="text" name="lineThirteen" value="<?=$module_lineThirteen;?>" />
                            </li>
                        <?php endif; ?>
						
						<?php if(isset($lineFourteen) && $lineFourteen=='true'): ?>
                            <li>
                                <label for="lineFourteen"><?=$lineFourteenLabel;?></label>
                                <input type="text" name="lineFourteen" value="<?=$module_lineFourteen;?>" />
                            </li>
                        <?php endif; ?>
						
						<?php if(isset($lineFifteen) && $lineFifteen=='true'): ?>
                            <li>
                                <label for="lineFifteen"><?=$lineFifteenLabel;?></label>
                                <input type="text" name="lineFifteen" value="<?=$module_lineFifteen;?>" />
                            </li>
                        <?php endif; ?>
						
                        <?php if(isset($itemKey) && $itemKey=='true'): ?>
                            <li>
                                <label for="itemKey"><?=$itemKeyLabel;?></label>
                                <input type="text" name="itemKey" value="<?=$module_itemKey;?>" />
                            </li>
                        <?php endif; ?>
                        
                        <?php if(isset($itemCategory) && $itemCategory=='true'): ?>
                            <li class="checkbox-wrapper">
                                <label for="itemCategory"><?=$itemCategoryLabel;?></label>
                                <?=$checkBox;?>
                            </li>
                        <?php endif; ?>
                        
                        <?php if(isset($mapping) && $mapping=='true'): ?>
                            <li>
                                <label for="itemMapping"><?=$mappingTableLabel;?></label>
                                <?=$mapedItems;?>
                            </li>
                        <?php endif; ?>
                        
                        <?php if(isset($attachments) && $attachments=='true'): ?>
                            <li>
                                <label for="attachment"><?=$attachmentsLabel;?></label>
                                <div id="sortable">
                                    <?php 
                                    $sql = "SELECT * FROM attachments WHERE module LIKE '%".$module."%' AND lanID LIKE '%".$lang."%' AND itemID LIKE '%".$module_itemID."%'";
                                    $sq = $DB->query($sql);
                                    $sq->setFetchMode(PDO::FETCH_ASSOC);
                                    $j = 0;
                                    $k = $j+1;
                                    while ($row = $sq->fetch()):
                                    ?>
                                        <div id="filediv-<?=$j;?>" class="filediv hasAttachment">
                                            <div class="image-wrapper">
                                                <div class="imagePreview attachment" style="background-image:url(<?=$row['attachment'];?>)"></div>
                                                <input name="file[]" type="hidden" class="dir" value="<?=$row['attachment'];?>">
                                                <input name="attachID" type="hidden" value="<?=$j;?>">
                                            </div>
                                            <div class="attachment-detail">
                                                <span>Title : </span><input type="text" name="file_data<?=$j;?>[]" value="<?=$row['attTitle'];?>" />
                                                <span>Title Description : </span><textarea name="file_data<?=$j;?>[]" value=""><?=$row['attDes'];?></textarea>
                                                <span>Alt Text : </span><input type="text" name="file_data<?=$j;?>[]" value="<?=$row['alt'];?>" />
                                            </div>
                                            <div class="remove-item" title="Remove"></div>
                                        </div>
                                    <?php $j++; endwhile; ?>
                                        <div id="filediv-<?=$k;?>" class="filediv">
                                            <div class="image-wrapper">
                                                <div class="imagePreview attachment" style="background-image:url(<?=$row['attachment'];?>)"></div>
                                                <input name="file[]" type="hidden" class="dir" value="">
                                                <input name="attachID" type="hidden" value="<?=$k;?>">
                                            </div>
                                            <div class="attachment-detail">
                                                <span>Title : </span><input type="text" name="file_data<?=$j;?>[]" value="<?=$row['attTitle'];?>" />
                                                <span>Title Description : </span><textarea name="file_data<?=$j;?>[]" value=""><?=$row['attDes'];?></textarea>
                                                <span>Alt Text : </span><input type="text" name="file_data<?=$j;?>[]" value="<?=$row['alt'];?>" />
                                            </div>
                                            <div class="remove-item" title="Remove"></div>
                                        </div>
                                </div>
                            </li>
                        <?php endif; ?>
                        <?php if(isset($startDate) && $startDate=='true'): ?>
                        	<li>
                                <label for="startDate"><?=$startDateLabel;?></label>
                                <input type="date" name="startDate" value="<?=$module_startDate;?>" />
                            </li>
                        <?php endif; ?>
                        <?php if(isset($endDate) && $endDate=='true'): ?>
                            <li>
                                <label for="endDate"><?=$endDateLabel;?></label>
                                <input type="date" name="endDate" value="<?=$module_endDate;?>" />
                            </li>
                        <?php endif; ?>
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

<script type="text/javascript">

$(document).ready(function() {

jQuery('.imagePreview').each(function() {
	$mainElement = jQuery(this); // memorize $(this)
	$sibling = $mainElement.next('input'); // find a sibling to $this.
	$sibling.change(function($mainElement) {
		return function() {
			var files = !!this.files ? this.files : [];
			if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support
	 
			if (/^image/.test( files[0].type)){ // only image file
				var reader = new FileReader(); // instance of the FileReader
				reader.readAsDataURL(files[0]); // read the local file
				reader.onloadend = function(){ // set image data as background of div
					$mainElement.css("background-image", "url("+this.result+")");
				}
			}
		}
	}($mainElement));
});

function myFunction(){
	jQuery("#media").addClass('active');
	jQuery(this).parents('.filediv').addClass('active');
	jQuery( function() {
		jQuery("#media").draggable({
                containment: ".holder",
				handle:'.cms-window-header'
            })
	});	
}



jQuery(".attachment").bind("click", myFunction);

$('#sortable').sortable({
	axis: 'y',
	opacity: 0.7,
	 /*update: function(event, ui) {
		var list_sortable = $(this).sortable('toArray').toString();
	 console.log(list_sortable);
		
		$.ajax({
			url: '#',
			type: 'POST',
			data: {list_order:list_sortable},
			success: function(data) {
				//finished
			}
		});
	}*/
}); // fin sortable


	
});
</script>
