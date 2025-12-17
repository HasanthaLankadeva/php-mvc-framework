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
$back = (empty($sub) || $sub == '/' ? '' : '<span class="dir" data-dir="'.$backLink.'">Back</span>');


while (($file = readdir($dh)) !== false) {
	
	//$item .= "<ul>";
	
    if($file != "." && $file != "..") {
		if (substr($file, -4, -3) =="."){
			$fullpath = 'img/uploads'.$sub.'/'.$file;
			$size = getimagesize($fullpath);
			
			$item .= "<li class=\"image\"><a href='admin/$fullpath' target='_blank'>";
				$item .= "<span style=\"background-image:url(admin/$fullpath)\"></span>";
				$item .= "<span>$file</span>";
				$item .= "<span>({$size[0]} x {$size[1]} pixels)</span>";
			$item .= "</a></li>";
		}else{            
			$item .= "<li class=\"dir\" data-dir=\"$sub/$file\"><span></span><span>$file</span></li>";
	  }
    }
	//$item .= "</ul>";
}
closedir($dh);
?>




<p class="cms-window-header">MEDIA MANAGER</p>
<div id="cms-popup">
	<?php 
	$dr = preg_replace('~//+~', '/', $path);
	echo '<span>'.preg_replace('~//+~', '/', $path).'</span>';
    echo '<ul class="cms-popup">'.$item.'</ul>';
    echo $back;
	?>
 
<form id="form" method="post" enctype="multipart/form-data">
    <input type="text"  name="folder[]" id="folder_0" /><br />
    <input name="add" type="submit" id="add" value="Save Page">
    <input type="hidden" name="dr" value="<?=$dr;?>" />
</form>
   
        <!--a href="memberlist.php">Memberlist</a><br /> 
        <a href="edit_account.php">Edit Account</a><br /--> 
        

</div>

<script type="text/javascript">
$("#form")[0].reset();
var i = 0;

function changeIt(){
i++;

var table=document.getElementById("itemdetail");

var row=table.insertRow();

var cell1=row.insertCell();

cell1.innerHTML="<input type='text' name='folder[]' id=folder_"+i+"'/>";

}


jQuery('#media .dir').click(function(){
	var dir = jQuery(this).data('dir');
	
	jQuery.ajax
	({ 
		url: 'admin/media.php',
		data: {"dir": dir},
		type: 'post',
		success:function(data){
			jQuery("#media").html(data);
		}
	});
});


</script>