<?php
	echo '<form id="students-list" name="students-list" method="post" action="$_PHP_SELF" />
			<div class="page-title-wrapper">
				<div class="page-title">Manage Admin Accounts</div>
				<div class="button-wrapper">
					<input type="submit" class="save" name="save" value="Publish" />
				</div>
			</div>';
		
			/* update status */
			if(isset($_POST['status'])){
				foreach($_POST['status'] as $selected){
					$fields = explode("@@",$selected);
					try {
						$sql = "UPDATE ".$module." SET status='".$fields[0]."' WHERE user_id=".$fields[1];
						$sth = $DB->query($sql);
					} catch(PDOException $e) {
						echo $e->getMessage();
					}
				}
			};
			
			$sql = "SELECT * FROM admin_accounts ORDER BY type ASC, id ASC";
			$q = $DB->query($sql);
			$q->setFetchMode(PDO::FETCH_ASSOC);
               
			echo '<table id="example" class="table table-striped table-bordered" style="width:100%">
				<thead>
					<tr>
						<th>User Name</th>
						<th>Email</th>
						<th>Type</th>
						<th>Registerd Date</th>
						<th>Status</th>
					</tr>
				</thead>
				<tbody>';
		
			$published = '';
			
			while ($row = $q->fetch()){ 
			
				$toggle = '<div class="switch">
				  <input class="cmn-toggle cmn-toggle-round" type="checkbox" value="">				  
				  <label for="cmn-toggle-1"></label>
				  <input type="hidden" value="deactive@@'.$row["id"].'" name="status[]">
				</div>';
				
			
				$published .= '<tr>
									
									<td>'.$row["username"].'</td>
									<td>'.$row["email"].'</td>
									<td>'.$row["type"].'</td>
									<td>'.$row["created_at"].'</td>
									<td>'.$toggle.'</td>
								</tr>';
			} 
			
				echo $published;
			
			echo '</tbody>
		</table>';
	
	echo '</form>';
?>