<?php
//If directory doesnot exists create it.
$dir = (isset($_POST["path"]) ? $_POST["path"] : '');
$output_dir = "img/uploads".$dir."/";
echo $output_dir;

if(isset($_FILES["file"]))
{
	$ret = array();
	$error = $_FILES["file"]["error"];
   {
    	if(!is_array($_FILES["file"]['name'])) //single file
    	{
       	 	$fileName = $_FILES["file"]["name"];
       	 	move_uploaded_file($_FILES["file"]["tmp_name"],$output_dir. str_replace(" ","_",$_FILES["file"]["name"]));
       	 	$ret[$fileName]= $output_dir.$fileName;
    	} else {
			$fileCount = count($_FILES["file"]['name']);
			for($i=0; $i < $fileCount; $i++)
			{
				$fileName = $_FILES["file"]["name"][$i];
			 	$ret[$fileName]= $output_dir.$fileName;
				move_uploaded_file($_FILES["file"]["tmp_name"][$i],$output_dir.str_replace(" ","_",$fileName) );
			}
    	}
    }
    echo json_encode($ret);
}


?>