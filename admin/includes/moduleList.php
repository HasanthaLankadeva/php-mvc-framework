<?php
$widgateData = simplexml_load_file(ADMIN_URL."area.xml");
require_once('includes/languages.php');

echo "<ul class=\"modules\">";

	foreach ($widgateData->module as $moduleItems) {
		$label = $moduleItems->attributes()->label;
		$moduleName = $moduleItems->attributes()->name;
		
		if(str_contains($moduleName, '_page') && $moduleName != 'module_languages'){
			
			include('tblRowData.php');
			
			echo "<li><a href='items.php?m=".$moduleName."&n=".$label."'><span class=\"icon-font ".$moduleName. "\">". $label."</span><span class=\"details\">Total records: ".$row['num']."</span></a></li>";
		}
	}
	
echo "</ul>";

?>