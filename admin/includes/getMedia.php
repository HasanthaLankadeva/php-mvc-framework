<?php
/* Directory loop */
	$sub = (!empty($_POST['dir']) ? $_POST['dir'] : '');
	$path = 'img/uploads';
	$path = $path . "$sub";
	$dh = opendir($path);
	$item = "";
	
	/* Back link */
	$backString = explode("/", $sub);
	array_pop($backString);
	$backLink = implode("/",$backString);
	$backLink = (!empty($backLink) ? $backLink : '/');
	$back = (empty($sub) || $sub == '/' ? '' : $backLink);
	$activeClass = (!empty($back) ? 'active' : '');
	
	while (($file = readdir($dh)) !== false) {
		
		if($file != "." && $file != "..") {
			if (substr($file, -4, -3) =="."){
				$fullpath = 'img/uploads'.$sub.'/'.$file;
				$size = getimagesize($fullpath);
				
				
				$modtime = date("M j Y g:i A", filemtime($fullpath));
				
				$item .= "<li class=\"image\"><div class=\"thumb-wrapper\" title=\"$file\" data-href='$fullpath'>";
					$item .= "<span class=\"image-wrapper\" style=\"background-image:url($fullpath)\"></span>";
					$item .= "<span>$file</span>";
					$item .= "<span>({$size[0]} x {$size[1]} pixels)</span>";
					
					$item .= "<span>$modtime</span>";
					
				$item .= "</div>";
				$item .= "<span data-href='$fullpath' class=\"deleteM\"></span></li>";
			}else{            
				$item .= "<li class=\"dir\" data-dir=\"$sub/$file\"><span></span><span>$file</span><span data-href=\"img/uploads$sub/$file/\" class=\"deleteM\"></span></li>";
		  }
		}
	}
	closedir($dh);
	
	$url = preg_replace('~//+~', '/', $path);
	$pathUrl = explode("img/uploads", $url);
	$dr = preg_replace('~//+~', '/', $path);
	echo 'aaaa';
	echo $item;
?>