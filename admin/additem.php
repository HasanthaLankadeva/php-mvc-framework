<?php 
	require("includes/admin-header-open.php");
	require_once('includes/languages.php');
?>
<body>
<div class="holder">
	<?php 
		if (isset($_GET['m']) && isset($_GET['n'])){
			$module = $_GET['m'];
			$moduleName = $_GET['n'];
		} else {
			echo '<script type="text/javascript"> window.location = "home.php"</script>';
		}
		require_once('functions/global-functions.php');
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
                <a class="fa fa-home" href="home.php"></a> <span>/</span> <a href="modules.php">Modules</a> <span>/</span> <a href="items.php?m=<?php echo $module;?>&n=<?php echo $moduleName;?>"><?php echo $moduleName;?></a> <span>/</span> <span>Add New Item</span>
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
                        <li class="active"><a href="additem.php?m=<?=$module;?>&n=<?=$moduleName;?>">Add New Item</a></li>
						<?php } ?>
                        <li><a href="items.php?m=<?=$module;?>&n=<?=$moduleName;?>">Manage Items</a></li>
                        <li><a href="addcategory.php?m=<?=$module;?>&n=<?=$moduleName;?>">Add New Category</a></li>
                        <li><a href="category.php?m=<?=$module;?>&n=<?=$moduleName;?>">Manage Categories</a></li>
                        <li><a href="trash.php?m=<?=$module;?>&n=<?=$moduleName;?>">Manage Trashed Items</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="right-coll float-r">
                <?php
                //$widgateData = simplexml_load_file("area.xml");						
                if(!empty($_GET['m'])) {
                    fields($module);
                    readCat($module,$lang,$languages,$DB);
					
					if(isset($mapping) && $mapping=='true'){ 
						readMaping($mappingTable,$lang,$languages,$DB);		
                	}
                }
				
                if(isset($_POST['save']) || isset($_POST['draft'])) {	
                
                    function UserID()
                    {
                        $x = 3; // Amount of digits
                        $min = pow(10,$x);
                        $max = pow(10,$x+1)-1;
                        $uID = rand($min, $max);
                        return $uID;
                    }
                    
                    $status = (isset($_POST['draft']) ? 'draft' : 'published');
                    $itemID =  UserID();
                    $itemTitle = (empty($_POST['itemTitle']) ? '' : $_POST['itemTitle']);
                    $mainImage = (empty($_POST['mainImage']) ? '' : $_POST['mainImage']);
                    $content = (empty($_POST['content']) ? '' : $_POST['content']);
                    $contentOne = (empty($_POST['contentOne']) ? '' : $_POST['contentOne']);
                    $contentTwo = (empty($_POST['contentTwo']) ? '' : $_POST['contentTwo']);
                    $lineOne = (empty($_POST['lineOne']) ? '' : $_POST['lineOne']);
                    $lineTwo = (empty($_POST['lineTwo']) ? '' : $_POST['lineTwo']);
                    $lineThree = (empty($_POST['lineThree']) ? '' : $_POST['lineThree']);
					$lineFour = (empty($_POST['lineFour']) ? '' : $_POST['lineFour']);
                    $lineFive = (empty($_POST['lineFive']) ? '' : $_POST['lineFive']);
                    $lineSix = (empty($_POST['lineSix']) ? '' : $_POST['lineSix']);
                    $lineSeven = (empty($_POST['lineSeven']) ? '' : $_POST['lineSeven']);
                    $lineEight = (empty($_POST['lineEight']) ? '' : $_POST['lineEight']);
                    $lineNine = (empty($_POST['lineNine']) ? '' : $_POST['lineNine']);
					$lineTen = (empty($_POST['lineTen']) ? '' : $_POST['lineTen']);
                    $lineEleven = (empty($_POST['lineEleven']) ? '' : $_POST['lineEleven']);
                    $lineTwelve = (empty($_POST['lineTwelve']) ? '' : $_POST['lineTwelve']);
					$lineThirteen = (empty($_POST['lineThirteen']) ? '' : $_POST['lineThirteen']);
                    $lineFourteen = (empty($_POST['lineFourteen']) ? '' : $_POST['lineFourteen']);
                    $lineFifteen = (empty($_POST['lineFifteen']) ? '' : $_POST['lineFifteen']);
					$itemKey = (empty($_POST['itemKey']) ? '' : $_POST['itemKey']);
                                    
                    $category = (empty($_POST['itemCategory']) ? '' : $_POST['itemCategory']);
                    $prefix = $itemCat = '';
                    if(!empty($category)){
                        foreach ($category as $catValue)
                        {
                            $itemCat .= $prefix . $catValue;
                            $prefix = ', ';
                        }
                    }
                    
					$mapping = (empty($_POST['mapping']) ? '' : $_POST['mapping']);
					$startDate = (empty($_POST['startDate']) ? '' : $_POST['startDate']);
					$endDate = (empty($_POST['endDate']) ? '' : $_POST['endDate']);
					
                    // send attachment data to attachment table
                    $files = (empty($_POST['file']) ? '' : $_POST['file']);
                    $attachID = (empty($_POST['attachID']) ? '' : $_POST['attachID']);
					
                    $table = 'attachments';
                    if(!empty($attachID)){
                        
                        foreach($languages as $language) {
                            $i = 0;
                            foreach($files as $attachment) {
                                /*if($attachment == ''){
                                    break;
                                }*/
                                $item_attachment = $attachment;
                                
                                $datas = array($_POST['file_data'.$attachID]);
                                foreach($datas as $data) {
                                    $attTitle = $data['0'];
                                    $attDes = $data['1'];
                                    $alt = $data['2'];
									
									if($lang == $language){
                                        try {
                                            $sql = "INSERT INTO ".$table." (lanID, module, itemID, attachment, attTitle, attDes, alt) VALUES ('$lang', '$module', '$itemID', '$item_attachment', '$attTitle', '$attDes', '$alt')";
                                            $sth = $DB->query($sql);
                                        } catch(PDOException $e) {
                                            echo $e->getMessage();
                                        }
                                    } else {
                                        try {
                                            $sql = "INSERT INTO ".$table." (lanID, module, itemID, attachment) VALUES ('$language', '$module', '$itemID', '$item_attachment')";
                                            $sth = $DB->query($sql);
                                        } catch(PDOException $e) {
                                            echo $e->getMessage();
                                        }
                                    }
                                }
                                $i++;
                            }
                        }
                    }
                    
                    foreach($languages as $language) {
                        if($lang == $language){
                            try {
                                $sql = "INSERT INTO ".$module." (status, itemID, lanID, itemTitle, itemImage, content, contentOne, contentTwo, lineOne, lineTwo, lineThree, lineFour, lineFive, lineSix, lineSeven, lineEight, lineNine, lineTen, lineEleven, lineTwelve, lineThirteen, lineFourteen, lineFifteen, itemKey, itemCategory, mapping, startDate, endDate) VALUES ('$status', '$itemID', '$lang', '$itemTitle', '$mainImage', '$content', '$contentOne', '$contentTwo', '$lineOne', '$lineTwo', '$lineThree', '$lineFour', '$lineFive', '$lineSix', '$lineSeven', '$lineEight', '$lineNine', '$lineTen', '$lineEleven', '$lineTwelve', '$lineThirteen', '$lineFourteen', '$lineFifteen', '$itemKey', '$itemCat', '$mapping', '$startDate', '$endDate')";
                                $sth = $DB->query($sql);
                            } catch(PDOException $e) {
                                echo $e->getMessage();
                            }
                        } else {
                            try {
                                $sql = "INSERT INTO ".$module." (itemID, lanID, itemImage, itemCategory) VALUES ('$itemID', '$language', '$mainImage', '$itemCat')";
                                $sth = $DB->query($sql);
                            } catch(PDOException $e) {
                                echo $e->getMessage();
                            }
                        }
                    }
                                    
                    $DB = null;
					
					echo '<script type="text/javascript">window.location.href = "items.php?m='.$module.'&n='.$moduleName.'";</script>';
					
                }
                ?>
    
                <div id="media">
                    <?php include('attachment.php'); ?>
                </div>
                    
                <form class="module-form" method="post" action="<?php $_PHP_SELF ?>" enctype='multipart/form-data'>
                    <ul>
                        <?php if(isset($itemTitle) && $itemTitle=='true'): ?>
                            <li>
                                <label for="itemTitle"><?=$itemTitleLabel;?></label>
                                <input type="text" name="itemTitle" value="" />
                            </li>
                        <?php endif; ?>
						
                        <?php if(isset($itemImage) && $itemImage=='true'): ?>
                            <li>
                                <label for="itemImage"><?=$itemImageLabel;?></label>               
                                <div class="item-image-wrapper">
                                    <div class="imagePreview mainImagePreview"></div>
                                    <input name="mainImage" type="hidden" class="mainImage" value="">
                                </div>
                            </li>
                        <?php endif; ?>
						
                        <?php if(isset($content) && $content=='true'): ?>
                            <li>
                                <label for="content"><?=$contentLabel;?></label>
                                <textarea class="content" name="content"></textarea>
                            </li>
                        <?php endif; ?>
                
                        <?php if(isset($contentOne) && $contentOne=='true'): ?>
                            <li>
                                <label for="contentOne"><?=$contentOneLabel;?></label>
                                <textarea class="content" name="contentOne"></textarea>
                            </li>
                        <?php endif; ?>
                
                        <?php if(isset($contentTwo) && $contentTwo=='true'): ?>
                            <li>
                                <label for="contentTwo"><?=$contentTwoLabel;?></label>
                                <textarea class="content" name="contentTwo"></textarea>
                            </li>
                        <?php endif; ?>
						
                        <?php if(isset($lineOne) && $lineOne=='true'): ?>
                            <li>
                                <label for="lineOne"><?=$lineOneLabel;?></label>
                                <input type="text" name="lineOne" value="" />
                            </li>
                        <?php endif; ?>
						
                        <?php if(isset($lineTwo) && $lineTwo=='true'): ?>
                            <li>
                                <label for="lineTwo"><?=$lineTwoLabel;?></label>
                                <input type="text" name="lineTwo" value="" />
                            </li>
                        <?php endif; ?>
                        
                        <?php if(isset($lineThree) && $lineThree=='true'): ?>
                            <li>
                                <label for="lineThree"><?=$lineThreeLabel;?></label>
                                <input type="text" name="lineThree" value="" />
                            </li>
                        <?php endif; ?>
						
                        <?php if(isset($lineFour) && $lineFour=='true'): ?>
                            <li>
                                <label for="lineFour"><?=$lineFourLabel;?></label>
                                <input type="text" name="lineFour" value="" />
                            </li>
                        <?php endif; ?>
                        
                        <?php if(isset($lineFive) && $lineFive=='true'): ?>
                            <li>
                                <label for="lineFive"><?=$lineFiveLabel;?></label>
                                <input type="text" name="lineFive" value="" />
                            </li>
                        <?php endif; ?>
                        
                        <?php if(isset($lineSix) && $lineSix=='true'): ?>
                            <li>
                                <label for="lineSix"><?=$lineSixLabel;?></label>
                                <input type="text" name="lineSix" value="" />
                            </li>
                        <?php endif; ?>
						
						<?php if(isset($lineSeven) && $lineSeven=='true'): ?>
                            <li>
                                <label for="lineSeven"><?=$lineSevenLabel;?></label>
                                <input type="text" name="lineSeven" value="" />
                            </li>
                        <?php endif; ?>
						
						<?php if(isset($lineEight) && $lineEight=='true'): ?>
                            <li>
                                <label for="lineEight"><?=$lineEightLabel;?></label>
                                <input type="text" name="lineEight" value="" />
                            </li>
                        <?php endif; ?>
						
						<?php if(isset($lineNine) && $lineNine=='true'): ?>
                            <li>
                                <label for="lineNine"><?=$lineNineLabel;?></label>
                                <input type="text" name="lineNine" value="" />
                            </li>
                        <?php endif; ?>
						
						<?php if(isset($lineTen) && $lineTen=='true'): ?>
                            <li>
                                <label for="lineTen"><?=$lineTenLabel;?></label>
                                <input type="text" name="lineTen" value="" />
                            </li>
                        <?php endif; ?>
						
						<?php if(isset($lineEleven) && $lineEleven=='true'): ?>
                            <li>
                                <label for="lineEleven"><?=$lineElevenLabel;?></label>
                                <input type="text" name="lineEleven" value="" />
                            </li>
                        <?php endif; ?>
						
						<?php if(isset($lineTwelve) && $lineTwelve=='true'): ?>
                            <li>
                                <label for="lineTwelve"><?=$lineTwelveLabel;?></label>
                                <input type="text" name="lineTwelve" value="" />
                            </li>
                        <?php endif; ?>
						
						<?php if(isset($lineThirteen) && $lineThirteen=='true'): ?>
                            <li>
                                <label for="lineThirteen"><?=$lineThirteenLabel;?></label>
                                <input type="text" name="lineThirteen" value="" />
                            </li>
                        <?php endif; ?>
						
						<?php if(isset($lineFourteen) && $lineFourteen=='true'): ?>
                            <li>
                                <label for="lineFourteen"><?=$lineFourteenLabel;?></label>
                                <input type="text" name="lineFourteen" value="" />
                            </li>
                        <?php endif; ?>
						
						<?php if(isset($lineFifteen) && $lineFifteen=='true'): ?>
                            <li>
                                <label for="lineFifteen"><?=$lineFifteenLabel;?></label>
                                <input type="text" name="lineFifteen" value="" />
                            </li>
                        <?php endif; ?>

                        <?php if(isset($itemKey) && $itemKey=='true'): ?>
                            <li>
                                <label for="itemKey"><?=$itemKeyLabel;?></label>
                                <input type="text" name="itemKey" value="" />
                            </li>
                        <?php endif; ?>
                        
                        <?php if(isset($itemCategory) && $itemCategory=='true'): ?>
                            <li>
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
                                    <div id="filediv-0" class="filediv">
                                        <div class="image-wrapper">
                                            <div class="imagePreview attachment" style="background-image:url()"></div>
                                            <input name="file[]" type="hidden" class="dir" value="">
                                            <input name="attachID" type="hidden" value="0">
                                        </div>
                                        <div class="attachment-detail">
                                            <span>Title : </span><input type="text" name="file_data0[]" value="" />
                                            <span>Title Description : </span><textarea name="file_data0[]" value=""></textarea>
                                            <span>Alt Text : </span><input type="text" name="file_data0[]" value="" />
                                        </div>
                                        <div class="remove-item" title="Remove"></div>
                                    </div>
                                </div>
                            </li>
                        <?php endif; ?>
						
                        <?php if(isset($startDate) && $startDate=='true'): ?>
                        	<li>
                                <label for="startDate"><?=$startDateLabel;?></label>
                                <input type="date" name="startDate" value="" />
                            </li>
                        <?php endif; ?>
						
                        <?php if(isset($endDate) && $endDate=='true'): ?>
                            <li>
                                <label for="endDate"><?=$endDateLabel;?></label>
                                <input type="date" name="endDate" value="" />
                            </li>
                        <?php endif; ?>
                        
                            <li class="button-row">
                                <input name="save" type="submit" id="add" value="Save">
                                <input name="draft" type="submit" id="add" class="draft" value="Draft">
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
