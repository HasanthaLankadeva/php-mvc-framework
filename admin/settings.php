<?php require("includes/admin-header-open.php"); ?>
<body>
<div class="holder">
    <div class="sidebar">
		<?php 
            $adminPage = "settings";
            include('includes/sideBar.php'); 
        ?>
    </div>
    <div class="content-wrapper">
    	<div class="top-bar">
            <div class="breadcrumb">
                <a class="fa fa-home" href="home.php"></a> <span>/</span> <span>Settings</span>
            </div>
			<div class="dev">
				<a class="fa fa-desktop" href="<?=SERVER;?>" title="Preview Site" target="_blank"></a>
			</div>         
			<div class="live">
				<a class="fa fa-globe" href="<?=LIVE_SERVER;?>" title="Live Site" target="_blank"></a>
			</div>
        </div>
        <div class="inner-wrapper site-config">  
        	<h2 class="section-heading">Site Confgurations</h2>
            <?php
            
                if (isset($_POST['save'])) 
                { 
                    $widgateData = simplexml_load_file("config.xml");
                    foreach ($widgateData->config as $configItems) {
                        if($configItems->attributes()->name == $_POST['block']){
                            $configItems->title = $_POST['title'];
                            $configItems->content = $_POST['content'];
                        }
                    }
                    $widgateData->asXML('config.xml');
                }
                
                $widgateData = simplexml_load_file("config.xml");
                    foreach ($widgateData->config as $configItems) {
                        echo '<div class="settings-block">
                        <form class="settings-form" method="post" action="" enctype="multipart/form-data">
                            <ul>
								<li>
                                    <input class="title" type="text" readonly name="title" value="'.$configItems->title.'" />
                                </li>
                                <li>
                                    <textarea class="content" name="content">'.$configItems->content.'</textarea>
                                </li>
                                <li>
                                    <input name="block" type="hidden" value="'.$configItems->attributes()->name.'">
                                    <input class="save" name="save" type="submit" value="Save">
                                </li>
							</ul>
                        </form>
                        </div>';
                    }

            ?>
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

