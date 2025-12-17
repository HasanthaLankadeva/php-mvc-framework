<?php 
$adminPage = "adminTools";
require("includes/admin-header-open.php");

require_once('includes/languages.php');
?>
    <body>
        <div class="holder">
             <div class="sidebar">
            	<?php 
					include('includes/sideBar.php'); 
				?>
            </div>
	<?php 
		if (isset($_GET['m'])){
			$module = $_GET['m'];
		} else {
			echo '<script type="text/javascript">window.location.href = "home.php";</script>';
		}
	?>
    <div class="content-wrapper">
    	<div class="top-bar">
            <div class="breadcrumb">
                <a class="fa fa-home" href="home.php"></a> <span>/</span> <a href="adminTools.php">Admin Tools</a> <span>/</span> <span>Manage Reviews</span>
            </div>
			<div class="dev">
				<a class="fa fa-desktop" href="<?=SERVER;?>" title="Preview Site" target="_blank"></a>
			</div>         
			<div class="live">
				<a class="fa fa-globe" href="<?=LIVE_SERVER;?>" title="Live Site" target="_blank"></a>
			</div>
        </div>
        <div class="inner-wrapper">
        		<form id="review-list" name="review-list" method="post" action="<?php $_PHP_SELF ?>" />
                    <div class="page-title-wrapper">
                        <div class="page-title">Reviews Data</div>
						<div class="button-wrapper">
                            <input type="submit" class="save" name="save" value="Save Changes" />
                        </div>
                    </div>
                <?php
					/* update status */
					if(isset($_POST['status'])){
						foreach($_POST['status'] as $selected){
							$fields = explode("@@",$selected);
							try {
								$sql = "UPDATE ".$module." SET status='".$fields[0]."' WHERE id=".$fields[1];
								$sth = $DB->query($sql);
							} catch(PDOException $e) {
								echo $e->getMessage();
							}
						}
					};
					
                    $sql = "SELECT * FROM ".$module." ORDER BY id DESC";
                    $q = $DB->query($sql);
                    $q->setFetchMode(PDO::FETCH_ASSOC);
               
					echo '<table id="example" class="table table-striped table-bordered" style="width:100%">
						<thead>
							<tr>
								<th style="display: none;">ID</th>
								<th>Name</th>
								<th>Email</th>
								<th>Rating</th>
								<th>Comment</th>
								<th>Featured</th>
								<th>Edit</th>
								<th>Status</th>
							</tr>
						</thead>
						<tbody>';
                
                    $published = '';
                    
                    while ($row = $q->fetch()){ 
                    
                        if($row["status"] == 'active'){
                            $toggle = '<div class="switch">
                              <input class="cmn-toggle cmn-toggle-round" type="checkbox" checked value="">
                              <label for="cmn-toggle-1"></label>
							  <input type="hidden" value="active@@'.$row["id"].'" name="status[]">
							  <span style="display:none">active</span>
                            </div>';
                        } else {
                            $toggle = '<div class="switch">
                              <input class="cmn-toggle cmn-toggle-round" type="checkbox" value="">				  
                              <label for="cmn-toggle-1"></label>
							  <input type="hidden" value="deactive@@'.$row["id"].'" name="status[]">
							  <span style="display:none">deactive</span>
                            </div>';
                        }
                    
                        $published .= '<tr>
                                            <td style="display: none;">'.$row["id"].'</td>
											<td>'.$row["user_name"].'</td>
											<td>'.$row["user_email"].'</td>
											<td>'.$row["rate"].' ★</td>
											<td>'.$row["comment"].'</td>
											<td>'.$row["featured"].'</td>
											<td class="attachment-td"><a href="edit-reviews.php?m='.$module.'=&id='.$row["id"].'"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
</a></td>
                                            <td>'.$toggle.'</td>
                                        </tr>';
                    } 
                    
                   		echo $published;
                    
					echo '</tbody>
					<tfoot>
						<tr>
							<th style="display: none;">ID</th>
							<th>Name</th>
							<th>Email</th>
							<th>Rating</th>
							<th>Comment</th>
							<th>Featured</th>
							<th>Edit</th>
							<th>Status</th>
						</tr>
					</tfoot>
				</table>';
				
				?>
             </form>
        </div>
	</div>
</div>
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/dataTables.buttons.min.js"></script>
<script src="js/buttons.flash.min.js "></script>
<script src="js/jszip.min.js"></script>
<script src="js/pdfmake.min.js"></script>
<script src="js/vfs_fonts.js"></script>
<script src="js/buttons.html5.min.js"></script>
<script src="js/buttons.print.min.js"></script>
<script src="js/dataTables.bootstrap.min.js"></script>

<script>
jQuery(document).ready(function(){

	$('#example').DataTable({
		"order": [[ 0, "DESC" ]],
		"displayLength": 25,
		dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });
	
	$('#review-list .cmn-toggle-round').on('change', function() {
		var data = $(this).siblings('input').attr('value').split('@@');
		var currentStatus = $(this).siblings('span').text();
		var newStatus = (this.checked) ? 'active' : 'deactive';
		var status = (currentStatus == newStatus) ? 'notchanged' : 'changed';
		
		$(this).siblings('input').attr('value', newStatus+'@@'+data[1]+'@@'+data[2]+'@@'+status);
	});
	

});
</script>
</body>
</html>