<?php

include "../includes/db_connect.inc.php";

$commentsCount = 0;
$ads_id = "";
$ads_type = "";
$output = '';

if (isset($_POST['ads_type']) && isset($_POST['ads_id'])) {
	$ads_type = $_POST['ads_type'];
	$ads_id = $_POST['ads_id'];
	$sql = "SELECT * FROM ads_comments WHERE ads_id = '$ads_id' AND ads_type = '$ads_type';";
	$result = mysqli_query($conn, $sql);
	$commentsCount = mysqli_num_rows($result);


	while ($row = mysqli_fetch_assoc($result)) {
		if ($commentsCount != 0) { ?>
			<div>
				<h3>Comments</h3>
				<div style="margin: 10px 0; border-top: #000000 1px solid;"></div>
			</div>
		<?php
					$commentsCount = 0;
				} ?>
		<div class="showComments">
			<div style="margin: 20px 0;">
				<span class="user_name"><?php echo $row["name"]; ?></span>
				<br />
				<br />
				<span class="comments">
					<?php echo $row["comments"]; ?>
				</span>
			</div>
			<div style="margin: 10px 0; border-bottom: #000000 1px solid;"></div>
		</div>
<?php
	}
}
?>