<?php
	/* creat folder */
	if(isset($_POST['inputVal'])){
		$folder = (!empty($_POST['inputVal']) ? $_POST['inputVal'] : '');
		$dir = $_POST['dir'];
		$dirPath = 'img/uploads'.$dir.'/'.preg_replace('/[^a-z0-9\-\']/', '', $folder);

		if(!is_dir($dirPath)){
			mkdir($dirPath);
		}
	}
	
	if(isset($_POST['delete']))
	{
		//(is_dir($_POST['delete'])) ? rmdir($_POST['delete']) : unlink($_POST['delete']);
		$target = $_POST['delete'];
		if(is_dir($target)){
			$files = glob( $target . '*', GLOB_MARK ); //GLOB_MARK adds a slash to directories returned
	
			foreach( $files as $file ){
				delete_files( $file );      
			}
	
			rmdir( $target );
		} elseif(is_file($target)) {
			unlink( $target );  
		}
	}
	
	
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
	
	function humanFileSize($size,$unit="") {
	  if( (!$unit && $size >= 1<<30) || $unit == "GB")
		return number_format($size/(1<<30),2)."GB";
	  if( (!$unit && $size >= 1<<20) || $unit == "MB")
		return number_format($size/(1<<20),2)."MB";
	  if( (!$unit && $size >= 1<<10) || $unit == "KB")
		return number_format($size/(1<<10),2)."KB";
	  return number_format($size)." bytes";
	}
	
	/* loop through media items */
	while (($file = readdir($dh)) !== false) {
		
		$exten = pathinfo($file, PATHINFO_EXTENSION);
		
		if($file != "." && $file != "..") {
			if ($exten != ""){
				$fullpath = 'img/uploads'.$sub.'/'.$file;
				$size = filesize($fullpath);
				$bytes = humanFileSize($size);
				$modtime = date("M j Y g:i A", filemtime($fullpath));
				$ext = pathinfo($file, PATHINFO_EXTENSION);
				
				if($ext == 'pdf'){
					$thumbPath = '<span class="image-wrapper pdf" style="background-image:url(img/icons/pdf.png)"></span>';
				} else if($ext == 'docx' || $ext == 'doc' || $ext == 'odt'){
					$thumbPath = '<span class="image-wrapper doc" style="background-image:url(img/icons/doc.png)"></span>';
				} else if($ext == 'xlsx' || $ext == 'xlsm' || $ext == 'xlsb' || $ext == 'xls' || $ext == 'csv'){
					$thumbPath = '<span class="image-wrapper excel" style="background-image:url(img/icons/excel.png)"></span>';
				} else {
					$dimention = getimagesize($fullpath);
					$bytes = $dimention[0].' x '.$dimention[1];
					$thumbPath = '<span class="image-wrapper" style="background-image:url('.$fullpath.')"></span>';
				}
				
				$item .= "<li class=\"image\"><div class=\"thumb-wrapper\" title=\"$file\" data-href='$fullpath'>";
					$item .= $thumbPath;
					$item .= "<span>$file</span>";
					$item .= "<div class=\"media-info\">";
						$item .= "<span>Size : $bytes</span>";
						$item .= "<span>Modified : $modtime</span>";
					$item .= "</div>";
					
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
?>

<p class="cms-window-header">MEDIA MANAGER <span class="close"></span></p>
<div id="cms-popup">
	<div class="popup-header">
    	<span class="home <?=$activeClass;?>" data-dir="/" title="Home"></span>
    	<span class="dir <?=$activeClass;?>" data-dir="<?=$backLink;?>" title="Back"></span>
        <span class="creat" title="Creat Folder">
        	<span class="create-folder" data-dir="<?=$pathUrl[1];?>"></span>
            <input type="text"  name="folder" id="folder" />
        </span>
        <span class="path">Path : <span class="url"><?=$pathUrl[1];?></span></span>
    </div>
	<div class="left-coll float-l">
		<ul class="cms-popup">
        	
            <?php echo $item; ?>
        	
        </ul>
    </div>
	<div class="add-this-menu disable float-l">
        <ul class="no-bullets">
            <li class="file-path"><a href="" target="_blank">View File</a></li>
            <li class="add-this" data-href="">Add This</li>
        </ul>
        <div class="uploader">
            <div class="">
                <form action="upload.php" method="post" enctype="multipart/form-data" id="upload" class="upload">
                    <fieldset>
                        <legend>Upload files</legend>
						<div class="file-upload">
							<input type="file" id="file" name="file[]" required multiple>
						</div>
						<input type="hidden" id="path" name="path" required value="<?=$pathUrl[1];?>">
						<input type="submit" id="submit" name="submit" value="Upload">
                    </fieldset>
                    <div class="bar">
                        <span class="bar-fill" id="pb"><span class="bar-fill-text" id="pt"></span></span>
                    </div>
                </form>
            </div>
        </div>
      </div>
</div>
<script src="js/upload.js"></script>
<script type="text/javascript">
jQuery(document).ready(function() {
	
	/* create folder */
	jQuery('body').on('click', '.create-folder', function() {
		var dir = jQuery(this).data('dir'),
      		inputVal = jQuery(this).siblings('#folder').val();
	 	jQuery.ajax
		({ 
			url: 'attachment.php',
			data: {"inputVal": inputVal, "dir": dir},
			type: 'post',
			success:function(data){
				jQuery("#media").html(data);
			}
		});
	});
	
	/* go to a folder or home */
	jQuery('#media .dir, #media .home').not('.deleteM').click(function(e){
		var dir = jQuery(this).data('dir');
		//console.log(e.target.get(0));
		jQuery.ajax
		({ 
			url: 'attachment.php',
			data: {"dir": dir},
			type: 'post',
			success:function(data){
				jQuery("#media").html(data);
			}
		});
	});
	
	/* delete item */
	jQuery('body').on('click', '.deleteM', function(){
		var dir = jQuery(this).data('href')
	 	jQuery.ajax
		({ 
			url: 'attachment.php',
			data: {"delete": dir},
			type: 'post',
			success:function(data){
				jQuery("#media").html(data);
			}
		});
	});
	
	/* thumb on click */
	jQuery('#media .image .thumb-wrapper').click(function(){
		var url = jQuery(this).data('href');
		jQuery('#media .image').removeClass('active');
		jQuery(this).parent().addClass('active');
		
		if(jQuery('#media .image').hasClass('active')){
			var infor = jQuery(this).find('.media-info').html();
			jQuery('.add-this-menu .media-info').remove();
			jQuery('<div class="media-info">'+infor+'</div>').insertBefore(jQuery('.add-this-menu .uploader'));
			jQuery('.add-this-menu .file-path a').attr('href', url);
			jQuery('.add-this-menu .add-this').attr('data-href', url);
			jQuery('.add-this-menu').removeClass('disable');
		} else {
			jQuery('.add-this-menu .file-path a').attr('href', '');
			jQuery('.add-this-menu .add-this').attr('data-href', '');
			jQuery('.add-this-menu .media-info').remove();
			jQuery('.add-this-menu').addClass('disable');
		}
	});
	
	/* add selected thumb */
	jQuery('#media .add-this-menu .add-this').click(function(){
		var dir = jQuery(this).attr('data-href');
		jQuery("#media .close").click();
	
		if(jQuery('.filediv').hasClass('active')){
			jQuery('.filediv.active .imagePreview').css("background-image", "url("+dir+")");
			jQuery('.filediv.active .dir').val(dir);

			if(!jQuery('.filediv.active').hasClass('hasAttachment')){
				jQuery('.filediv.active').addClass('hasAttachment');
				newItem();
			}
		} else {
			jQuery('.mainImage').val(dir);
			jQuery('.mainImagePreview').css("background-image", "url("+dir+")");
			jQuery('.mainImagePreview').addClass('hasAttachment');
		}
	});
	
	jQuery("#media .close").click(function(){
		jQuery("#media").removeClass('active');
		jQuery("#media .cms-popup .image").removeClass('active');
		jQuery('.add-this-menu .file-path a').attr('href', '');
		jQuery('.add-this-menu .add-this').attr('data-href', '');
		jQuery('.add-this-menu').addClass('disable');
	});
	
	jQuery('.mainImagePreview').click(function(){
		jQuery("#media").addClass('active');
		jQuery( function() {
			jQuery("#media").draggable({
				containment: ".holder",
				handle:'.cms-window-header'
			})
		});
	});
	
	document.getElementById('submit').addEventListener('click', function(e){
			e.preventDefault();

			var f = document.getElementById('file'),
				p = document.getElementById('path'),
				pb = document.getElementById('pb'),
				pt = document.getElementById('pt');

			app.uploader({
				files: f,
				path: p,
				progressBar: pb,
				progressText: pt,
				processor: 'upload.php',
				finished: function(data){
					jQuery.ajax
					({ 
						url: 'attachment.php',
						data: {"dir": path.defaultValue},
						type: 'post',
						success:function(data){
							console.log(path.defaultValue);
							jQuery("#media").html(data);
						}
					});
				},
				error: function(){
					console.log('Not working.');
				}
			});			
		});
	
	function myFunction(){
		if(!jQuery(this).parents('.filediv').hasClass('hasAttachment')){
			jQuery("#media").addClass('active');
			jQuery('.filediv').removeClass('active');
			jQuery(this).parents('.filediv').addClass('active');
			jQuery( function() {
				jQuery("#media").draggable({
					containment: ".holder",
					handle:'.cms-window-header'
				})
			});
		}
	}
	
	function newItem(){
		var val = jQuery('.filediv.active').attr('id'),
			id = val.split('-');
			i = parseInt(id[1])+1;
		
		jQuery('.filediv:last-child').after(jQuery("<div/>", {id: 'filediv-'+i, class: 'filediv'}).fadeIn('slow').append(
			//jQuery("<div/>", {class: 'imagePreview attachment'}),
			//jQuery("<input/>", {name: 'file[]', type: 'hidden'})
			'<div class="image-wrapper"><div class="imagePreview attachment" style="background-image:url()"></div><input name="file[]" type="hidden" class="dir" value=""><input name="attachID" type="hidden" value="'+i+'"></div><div class="attachment-detail"><span>Title : </span><input type="text" name="file_data'+i+'[]" value="" /><span>Title Description : </span><textarea name="file_data'+i+'[]" value=""></textarea><span>Alt Text : </span><input type="text" name="file_data'+i+'[]" value="" /></div><div class="remove-item" title="Remove"></div>'
		));
		jQuery('.filediv').removeClass('active');
		jQuery('.attachment').click(myFunction);
	}
	
	jQuery('.uploader p').click(function(){
		var id = jQuery(this).data('id');
		jQuery(this).removeClass('active');
		jQuery(this).siblings().addClass('active');
		
		jQuery.when(jQuery('.upload-form .input-file').fadeOut('slow')).done(function () {
			jQuery('.upload-form .input-file#'+id).fadeIn('slow');
		});
	});
	
});
</script>