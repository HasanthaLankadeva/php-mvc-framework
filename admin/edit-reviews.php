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
                <a class="fa fa-home" href="home.php"></a> <span>/</span> <a href="adminTools.php">Admin Tools</a> <span>/</span> <a href="reviewData.php?m=module_reviews">Reviews Data</a> <span>/</span> <span>Edit Reviews</span>
            </div>
			<div class="dev">
				<a class="fa fa-desktop" href="<?=SERVER;?>" title="Preview Site" target="_blank"></a>
			</div>         
			<div class="live">
				<a class="fa fa-globe" href="<?=LIVE_SERVER;?>" title="Live Site" target="_blank"></a>
			</div>
        </div>
        <div class="inner-wrapper">
			<div class="page-title-wrapper">
				<div class="page-title">Review</div>
			</div>
			
			<?php
			
				/* read data */
				
				$id = $_GET['id'];
				$sql = 'SELECT * FROM module_reviews WHERE id="'.$id.'"';
				$q = $DB->query($sql);
				$q->setFetchMode(PDO::FETCH_ASSOC);
				
				while ($row = $q->fetch()){
					$id = $row['id'];
					$user_name = $row['user_name'];
					$user_email = $row['user_email'];
					$rating = $row['rate'];
					$comment = $row['comment'];
					$featured = ($row['featured'] == 'yes') ? 'checked' : '';
				}
				
				if (isset($_POST['submit'])){
					
					$user_name = $_POST['user_name'];
					$rate = $_POST['rate'];
					$comment = $_POST['comment'];
					$featured = $_POST['featured'];
					$row_id = $_POST['id'];
					
					try {
						$sql = "UPDATE module_reviews SET user_name='".$user_name."', rate='".$rate."', comment='".$comment."', featured='".$featured."' WHERE id='".$row_id."'";
						
						$sth = $DB->query($sql);
					} catch(PDOException $e) {
						echo $e->getMessage();
					}
					
					echo '<script type="text/javascript">window.location.href = "reviewData.php?m=module_reviews";</script>';
				}
				
			?>
			
			<form class="module-form" name="review-list" method="post" action="<?php $_PHP_SELF ?>" />
				<ul>
					<li>
						<label for="user_name">Name</label>
						<input type="text" name="user_name" value="<?=$user_name;?>" />
					</li>
					<li>
						<label for="user_email">Email</label>
						<input type="text" readonly name="user_email" value="<?=$user_email;?>" />
					</li>
					<li>
						<label for="rating">Rate</label>
						<input type="text" name="rate" value="<?=$rating;?>" />
					</li>
					<li>
						<label for="comment">Comment</label>
						<textarea type="text" name="comment"><?php echo $comment; ?></textarea>
					</li>
					<li>
						<label for="Comment">Category</label>
						<div class="checkbox">
							<input type="checkbox" name="featured" value="yes" <?=$featured;?>><span>Featured Home</span>
						</div>
					</li>
				</ul>
				
				<ul>
					<li class="button-row review-data">
						<input type="hidden" name="id" value="<?=$id;?>" />
						<input name="submit" type="submit" id="add" value="Save">
					</li>
				</ul>
			</form>
        </div>
	</div>
</div>
</body>
</html>