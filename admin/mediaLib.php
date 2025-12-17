<?php require("includes/admin-header-open.php"); ?>
<body>
<div class="holder">
    <div class="sidebar">
		<?php 
            $adminPage = "mediaLib";
            include('includes/sideBar.php'); 
        ?>
    </div>
    <div class="content-wrapper">
    	<div class="top-bar">
            <div class="breadcrumb">
                <a class="fa fa-home" href="home.php"></a> <span>/</span> <span>Media Manager</span>
            </div>
            <div class="dev">
				<a class="fa fa-desktop" href="<?=SERVER;?>" title="Preview Site" target="_blank"></a>
			</div>         
			<div class="live">
				<a class="fa fa-globe" href="<?=LIVE_SERVER;?>" title="Live Site" target="_blank"></a>
			</div>
        </div>
        <div class="inner-wrapper media-lib">
            <div id="media">
            	<?php include('attachment.php'); ?>
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

