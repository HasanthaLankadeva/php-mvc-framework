<?php

function fields($module) {
	$widgateData = $GLOBALS['widgateData'];
	
	foreach ($widgateData->children() as $child) {
		$role = $child->attributes();
		
		if($role == $module){
			
			foreach($child->fields->field as $value) {
				$label = $value->label;
				$name = $value->name;
				
				switch ($name) {
					case "itemImage":
						$GLOBALS['itemImage'] = 'true';
						$GLOBALS['itemImageLabel'] = $label;
						break;
					case "content":
						$GLOBALS['content'] = 'true';
						$GLOBALS['contentLabel'] = $label;
						break;
					case "contentOne":
						$GLOBALS['contentOne'] = 'true';
						$GLOBALS['contentOneLabel'] = $label;
						break;
					case "contentTwo":
						$GLOBALS['contentTwo'] = 'true';
						$GLOBALS['contentTwoLabel'] = $label;
						break;
					case "lineOne":
						$GLOBALS['lineOne'] = 'true';
						$GLOBALS['lineOneLabel'] = $label;
						break;
					case "lineTwo":
						$GLOBALS['lineTwo'] = 'true';
						$GLOBALS['lineTwoLabel'] = $label;
						break;
					case "lineThree":
						$GLOBALS['lineThree'] = 'true';
						$GLOBALS['lineThreeLabel'] = $label;
						break;
					case "lineFour":
						$GLOBALS['lineFour'] = 'true';
						$GLOBALS['lineFourLabel'] = $label;
						break;
					case "lineFive":
						$GLOBALS['lineFive'] = 'true';
						$GLOBALS['lineFiveLabel'] = $label;
						break;
					case "lineSix":
						$GLOBALS['lineSix'] = 'true';
						$GLOBALS['lineSixLabel'] = $label;
						break;
					case "lineSeven":
						$GLOBALS['lineSeven'] = 'true';
						$GLOBALS['lineSevenLabel'] = $label;
						break;
					case "lineEight":
						$GLOBALS['lineEight'] = 'true';
						$GLOBALS['lineEightLabel'] = $label;
						break;
					case "lineNine":
						$GLOBALS['lineNine'] = 'true';
						$GLOBALS['lineNineLabel'] = $label;
						break;
					case "lineTen":
						$GLOBALS['lineTen'] = 'true';
						$GLOBALS['lineTenLabel'] = $label;
						break;
					case "lineEleven":
						$GLOBALS['lineEleven'] = 'true';
						$GLOBALS['lineElevenLabel'] = $label;
						break;
					case "lineTwelve":
						$GLOBALS['lineTwelve'] = 'true';
						$GLOBALS['lineTwelveLabel'] = $label;
						break;
					case "lineThirteen":
						$GLOBALS['lineThirteen'] = 'true';
						$GLOBALS['lineThirteenLabel'] = $label;
						break;
					case "lineFourteen":
						$GLOBALS['lineFourteen'] = 'true';
						$GLOBALS['lineFourteenLabel'] = $label;
						break;
					case "lineFifteen":
						$GLOBALS['lineFifteen'] = 'true';
						$GLOBALS['lineFifteenLabel'] = $label;
						break;
					case "itemKey":
						$GLOBALS['itemKey'] = 'true';
						$GLOBALS['itemKeyLabel'] = $label;
						break;
					case "itemCategory":
						$GLOBALS['itemCategory'] = 'true';
						$GLOBALS['itemCategoryLabel'] = $label;
						break;
					case "attachments":
						$GLOBALS['attachments'] = 'true';
						$GLOBALS['attachmentsLabel'] = $label;
						break;
					case "startDate":
						$GLOBALS['startDate'] = 'true';
						$GLOBALS['startDateLabel'] = $label;
						break;
					case "endDate":
						$GLOBALS['endDate'] = 'true';
						$GLOBALS['endDateLabel'] = $label;
						break;
					default:
						$GLOBALS['itemTitle'] = 'true';
						$GLOBALS['itemTitleLabel'] = $label;
				}
			}
			
			foreach($child as $key => $value) {
				if($key == "mapping"){
					$GLOBALS['mapping'] = 'true';
					$GLOBALS['mappingTable'] = $value->attributes()->name;
					$GLOBALS['mappingTableLabel'] = $value->attributes()->label;
				}
			}
		}
		
	}
}

$GLOBALS['checkBox'] = '';

function readCat($module,$lang,$languages,$DB){
	$sql = 'SELECT * FROM category WHERE module="'.$module.'"';
	$q = $DB->query($sql);
	$q->setFetchMode(PDO::FETCH_ASSOC);
	$checkBox = '';
	while ($row = $q->fetch()){
		$GLOBALS['checkBox'] .= '<div class="checkbox"><span>'.$row['categoryTitle'].'</span><input type="checkbox" name="itemCategory[]" value="'.$row['categoryKey'].'"></div>';
	}
}

$GLOBALS['mapedItems'] = '';

function readMaping($mappingTable,$lang,$languages,$DB){
	$sql = "SELECT * FROM ".$mappingTable." WHERE lanID LIKE '".$lang."'";
	$q = $DB->query($sql);
	$q->setFetchMode(PDO::FETCH_ASSOC);
	$mappingOptions = '<option value="">Please Select</option>';
	while ($row = $q->fetch()){
		$mappingOptions .= '<option value="'.$row['itemTitle'].'@@'.$row['itemID'].'">'.$row['itemTitle'].'</option>';
	}
	$GLOBALS['mapedItems'] = '<select name="mapping">'.$mappingOptions.'</select>';
}

function readModule($module,$module_itemID,$lang,$mappingTable,$DB){
	$sql = "SELECT * FROM ".$module." WHERE itemID LIKE '%".$module_itemID."%' AND lanID LIKE '".$lang."'";
	$q = $DB->query($sql);
	$q->setFetchMode(PDO::FETCH_ASSOC);
				
	$module_itemTitle =  $module_itemImage = $module_content = $module_contentOne = $module_contentTwo = $module_lineOne = $module_lineTwo = $module_lineThree = $module_lineFour = $module_lineFive = $module_lineSix = $module_lineSeven = $module_lineEight = $module_lineNine = $module_lineTen = $module_lineEleven = $module_lineTwelve = $module_lineThirteen = $module_lineFourteen = $module_lineFifteen = $module_itemKey = $module_itemCategory = $module_mapping = $module_attachments = $endDate = $startDate = '';
				
	while ($row = $q->fetch()){
		if(!empty($row)){
			$GLOBALS['module_itemTitle'] = $row['itemTitle'];
			$GLOBALS['module_itemImage'] = $row['itemImage'];
			$GLOBALS['module_content'] = $row['content'];
			$GLOBALS['module_contentOne'] = $row['contentOne'];
			$GLOBALS['module_contentTwo'] = $row['contentTwo'];
			$GLOBALS['module_lineOne'] = $row['lineOne'];
			$GLOBALS['module_lineTwo'] = $row['lineTwo'];
			$GLOBALS['module_lineThree'] = $row['lineThree'];
			$GLOBALS['module_lineFour'] = $row['lineFour'];
			$GLOBALS['module_lineFive'] = $row['lineFive'];
			$GLOBALS['module_lineSix'] = $row['lineSix'];
			$GLOBALS['module_lineSeven'] = $row['lineSeven'];
			$GLOBALS['module_lineEight'] = $row['lineEight'];
			$GLOBALS['module_lineNine'] = $row['lineNine'];
			$GLOBALS['module_lineTen'] = $row['lineTen'];
			$GLOBALS['module_lineEleven'] = $row['lineEleven'];
			$GLOBALS['module_lineTwelve'] = $row['lineTwelve'];
			$GLOBALS['module_lineThirteen'] = $row['lineThirteen'];
			$GLOBALS['module_lineFourteen'] = $row['lineFourteen'];
			$GLOBALS['module_lineFifteen'] = $row['lineFifteen'];
			$GLOBALS['module_itemKey'] = $row['itemKey'];
			$GLOBALS['module_itemCategory'] = $row['itemCategory'];
			$GLOBALS['module_mapping'] = explode("@@",$row['mapping']);
			$GLOBALS['module_attachments'] = $row['attachments'];
			$GLOBALS['module_startDate'] = $row['startDate'];
			$GLOBALS['module_endDate'] = $row['endDate'];
		} 
	}
		
	$module_attachments = (!empty($module_attachments) ? explode(', ', $module_attachments) : '');
						
	$sql = 'SELECT * FROM category WHERE module="'.$module.'"';
	$q = $DB->query($sql);
	$q->setFetchMode(PDO::FETCH_ASSOC);	
				
	$selectedCategory = (!empty($GLOBALS['module_itemCategory']) ? explode(', ', $GLOBALS['module_itemCategory']) : '');
				
	$GLOBALS['checkBox'] = '';
	$categoryTitle = $category = array();
	
	while ($row = $q->fetch()){
		array_push($categoryTitle, $row['categoryTitle']);
		array_push($category, $row['categoryKey']);
	}
	
	if(!empty($category)){		
		$i = 0;
		foreach($category as $key=>$value){
			if(!empty($selectedCategory) && in_array($value,$selectedCategory)){
				$GLOBALS['checkBox'] .= '<div class="checkbox"><input type="checkbox" name="itemCategory[]" value="'.$value.'" checked><span>'.$categoryTitle[$i].'</span></div>';
			} else {
				$GLOBALS['checkBox'] .= '<div class="checkbox"><input type="checkbox" name="itemCategory[]" value="'.$value.'"><span>'.$categoryTitle[$i].'</span></div>';
			}
			$i++;
		}
	}
	
	if(!empty($mappingTable)){
		$sql = "SELECT * FROM ".$mappingTable." WHERE lanID LIKE '".$lang."'";
		$q = $DB->query($sql);
		$q->setFetchMode(PDO::FETCH_ASSOC);
		$mappingOptions = '<option value="">Please Select</option>';
		while ($row = $q->fetch()){
			if($GLOBALS['module_mapping'][1] == $row['itemID']){
				$mappingOptions .= '<option value="'.$row['itemTitle'].'@@'.$row['itemID'].'" selected="selected">'.$row['itemTitle'].'</option>';
			} else {
				$mappingOptions .= '<option value="'.$row['itemTitle'].'@@'.$row['itemID'].'">'.$row['itemTitle'].'</option>';
			}
			
		}
		$GLOBALS['mapedItems'] = '<select name="mapping">'.$mappingOptions.'</select>';
	}
}

function updateModule($module,$module_itemID,$files,$lang,$languages,$DB,$moduleName,$dir) {
	$cats = (empty($_POST['itemCategory']) ? '' : $_POST['itemCategory']);	
		$prefix = $itemCat = '';
		if(!empty($cats)){
			foreach ($cats as $catValue)
			{
				$itemCat .= $prefix . $catValue;
				$prefix = ', ';
			}
		}
		
	$i = 0;
	$item_attachment = $attTitle = $attDes = $alt = '';
	
	if(!empty($_POST['file'])){
		
		$files = $_POST['file'];
		
		foreach($files as $attachment) {
			if($attachment == ''){
				break;
			}
			$item_attachment .= (!empty($attachment) ? $attachment : '');
			$datas = array($_POST['file_data'.$i]);
			foreach($datas as $data) {
				$attTitle .= (!empty($data['0']) ? $data['0'] : '');
				$attDes .= (!empty($data['1']) ? $data['1'] : '');
				$alt .= (!empty($data['2']) ? $data['2'] : '');
			}
			$i++;
		}
	}
	
	$GLOBALS['status'] = (isset($_POST['draft']) ? 'draft' : 'published');
	$GLOBALS['itemID'] =  $_GET['itemID'];
	$GLOBALS['itemTitle'] = (empty($_POST['itemTitle']) ? '' : $_POST['itemTitle']);
	$GLOBALS['mainImage'] = (empty($_POST['mainImage']) ? '' : $_POST['mainImage']);
	$GLOBALS['content'] = (empty($_POST['content']) ? '' : $_POST['content']);
	$GLOBALS['contentOne'] = (empty($_POST['contentOne']) ? '' : $_POST['contentOne']);
	$GLOBALS['contentTwo'] = (empty($_POST['contentTwo']) ? '' : $_POST['contentTwo']);
	$GLOBALS['lineOne'] = (empty($_POST['lineOne']) ? '' : $_POST['lineOne']);
	$GLOBALS['lineTwo'] = (empty($_POST['lineTwo']) ? '' : $_POST['lineTwo']);
	$GLOBALS['lineThree'] = (empty($_POST['lineThree']) ? '' : $_POST['lineThree']);
	$GLOBALS['lineFour'] = (empty($_POST['lineFour']) ? '' : $_POST['lineFour']);
	$GLOBALS['lineFive'] = (empty($_POST['lineFive']) ? '' : $_POST['lineFive']);
	$GLOBALS['lineSix'] = (empty($_POST['lineSix']) ? '' : $_POST['lineSix']);
	$GLOBALS['lineSeven'] = (empty($_POST['lineSeven']) ? '' : $_POST['lineSeven']);
	$GLOBALS['lineEight'] = (empty($_POST['lineEight']) ? '' : $_POST['lineEight']);
	$GLOBALS['lineNine'] = (empty($_POST['lineNine']) ? '' : $_POST['lineNine']);
	$GLOBALS['lineTen'] = (empty($_POST['lineTen']) ? '' : $_POST['lineTen']);
	$GLOBALS['lineEleven'] = (empty($_POST['lineEleven']) ? '' : $_POST['lineEleven']);
	$GLOBALS['lineTwelve'] = (empty($_POST['lineTwelve']) ? '' : $_POST['lineTwelve']);
	$GLOBALS['lineThirteen'] = (empty($_POST['lineThirteen']) ? '' : $_POST['lineThirteen']);
	$GLOBALS['lineFourteen'] = (empty($_POST['lineFourteen']) ? '' : $_POST['lineFourteen']);
	$GLOBALS['lineFifteen'] = (empty($_POST['lineFifteen']) ? '' : $_POST['lineFifteen']);
	$GLOBALS['itemKey'] = (empty($_POST['itemKey']) ? '' : $_POST['itemKey']);
	$GLOBALS['mapping'] = (empty($_POST['mapping']) ? '' : $_POST['mapping']);
	$GLOBALS['category'] = $itemCat;
	$GLOBALS['attachment'] = $item_attachment;
	$GLOBALS['attachmentTitle'] = $attTitle;
	$GLOBALS['attachmentDesc'] = $attDes;
	$GLOBALS['attachmentAlt'] = $alt;
	$GLOBALS['startDate'] = (empty($_POST['startDate']) ? '' : $_POST['startDate']);
	$GLOBALS['endDate'] = (empty($_POST['endDate']) ? '' : $_POST['endDate']);

	try {
		$sql = "UPDATE " . $module . " SET itemTitle='".$GLOBALS['itemTitle']."', itemImage='".$GLOBALS['mainImage']."', content='".$GLOBALS['content']."', contentOne='".$GLOBALS['contentOne']."', contentTwo='".$GLOBALS['contentTwo']."', lineOne='".$GLOBALS['lineOne']."', lineTwo='".$GLOBALS['lineTwo']."', lineThree='".$GLOBALS['lineThree']."', lineFour='".$GLOBALS['lineFour']."', lineFive='".$GLOBALS['lineFive']."', lineSix='".$GLOBALS['lineSix']."', lineSeven='".$GLOBALS['lineSeven']."', lineEight='".$GLOBALS['lineEight']."', lineNine='".$GLOBALS['lineNine']."', lineTen='".$GLOBALS['lineTen']."', lineEleven='".$GLOBALS['lineEleven']."', lineTwelve='".$GLOBALS['lineTwelve']."', lineThirteen='".$GLOBALS['lineThirteen']."', lineFourteen='".$GLOBALS['lineFourteen']."', lineFifteen='".$GLOBALS['lineFifteen']."', itemKey='".$GLOBALS['itemKey']."', itemCategory='".$GLOBALS['category']."', mapping='".$GLOBALS['mapping']."', startDate='".$GLOBALS['startDate']."', endDate='".$GLOBALS['endDate']."' WHERE itemID='".$module_itemID."' AND lanID='".$lang."'";
		$sth = $DB->query($sql);
	} catch(PDOException $e) {
		echo $e->getMessage();
	}
	
	if($GLOBALS['attachments'] = 'true'){
		$sql = 'DELETE FROM attachments WHERE module="'.$module.'" AND itemID="'.$module_itemID.'"';
		$q = $DB->query($sql);
		$q->setFetchMode(PDO::FETCH_ASSOC);			
		
		foreach($languages as $language) {
			$i = 0;
			if(!empty($_POST['file'])){
				foreach($files as $attachment) {
					if($attachment == ''){
						break;
					}
					$item_attachment = $attachment;
					
					$datas = array($_POST['file_data'.$i]);
					foreach($datas as $data) {
						$attTitle = $data['0'];
						$attDes = $data['1'];
						$alt = $data['2'];
					}
					$i++;
					
					if(!empty($item_attachment)){
						if($lang == $language){
							try {							
								$sql = "INSERT INTO attachments (lanID, module, itemID, attachment, attTitle, attDes, alt) VALUES ('$language', '$module', '$module_itemID', '$item_attachment', '$attTitle', '$attDes', '$alt')";
								$sth = $DB->query($sql);
							} catch(PDOException $e) {
								echo $e->getMessage();
							}
						} else {
							try {
								$sql = "INSERT INTO attachments (lanID, module, itemID, attachment) VALUES ('$language', '$module', '$module_itemID', '$item_attachment')";
								$sth = $DB->query($sql);
							} catch(PDOException $e) {
								echo $e->getMessage();
							}
						}
					}
				}
			}
		}
	};
	
	$DB = null;
	echo '<script type="text/javascript">window.location.href = "items.php?m='.$module.'&n='.$moduleName.'";</script>';
}

?>