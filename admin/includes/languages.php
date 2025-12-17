<?php
header('Cache-control: private'); // IE 6 FIX

if(isset($_POST['lang']))
{
	$lang = $_POST['lang'];
	
	// register the session and set the cookie
	$_SESSION['lang'] = $lang;
	
	setcookie("lang", $lang, time() + (3600 * 24 * 30));
}
else if(isset($_SESSION['lang']))
{
	$lang = $_SESSION['lang'];
}
else if(isset($_COOKIE['lang']))
{
	$lang = $_COOKIE['lang'];
}

$i = '0';
$widgateData = $GLOBALS['widgateData'];						
foreach($widgateData->children() as $child) {
	$role = $child->attributes();
	foreach($child as $key => $value) {
		if($role == 'module_languages'){
			$fields = explode(", ",$value);
			$active = $defaultLan = '';
			if(empty($lang)){
				$lang = $fields[0];
			}
			$langItems = '';
			$languages = array();

			foreach($fields as $field) {
				$active = ($lang == $field)?'active':'';
				array_push($languages,$field);
				//$languages[] = $field;
				$langItems .= '<li class="'.$active.'" data-lan="'.$field.'">'.$field.'</li>';
				$i++;
			}
		}
	}
}
if($i > 1){
	
	echo "<ul id=\"languages\" class=\"no-bullets\"><li class=\"placeholder\"></li>".$langItems."</ul>";
}


?>