<?php
	$sql = "SELECT * FROM admin_accounts";
	$stmt = $DB->prepare($sql);
	$stmt->execute();
	$adminAccounts = $stmt->rowCount();
	
	$path = 'img/uploads';
	$dh = opendir($path);
	$fileCount = 0;
	
	/* loop through media items */
	while (($file = readdir($dh)) !== false) {
		
		if($file != "." && $file != "..") {
			if (substr($file, -4, -3) =="."){
				$fileCount++;
			}else{            
				
			}	
		}
	}
	
	closedir($dh);
	
	function count_files($path) {
 
		// (Ensure that the path contains an ending slash)
	 
		$file_count = 0;
	 
		$dir_handle = opendir($path);
	 
		if (!$dir_handle) return -1;
	 
		while ($file = readdir($dir_handle)) {
	 
			if ($file == '.' || $file == '..') continue;
	 
			if (is_dir($path . $file)){      
				$file_count += count_files($path . $file . DIRECTORY_SEPARATOR);
			}
			else {
				$file_count++; // increase file count
			}
		}
	 
		closedir($dir_handle);
	 
		return $file_count;
	}
?>