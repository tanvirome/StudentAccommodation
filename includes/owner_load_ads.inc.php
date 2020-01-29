<?php

include "../includes/db_connect.inc.php";

$user_type = $button_id = $user_id = $search_title = $search_area = $search_ads_type = $ads_perpage = "";
if (isset($_POST['button_id'])) {
	$button_id = $_POST['button_id'];
}
$user_id = $_POST['user_id'];
$user_type = $_POST['user_type'];

if (!empty($_POST['search_title'])) {
	$search_title = $_POST['search_title'];
}

if (!empty($_POST['search_area'])) {
	$search_area = $_POST['search_area'];
}

if (!empty($_POST['search_ads_type'])) {
	$search_ads_type = $_POST['search_ads_type'];
}

$ads_perpage = $_POST['ads_perpage'];

$start_value = 0;

if (isset($_POST['start_value'])) {
	$start_value = $_POST['start_value'];
} else {
	if ($button_id == 0) {
		$button_id = 1;
	}
	$button_id = $button_id - 1;
	$start_value = $button_id * $ads_perpage;
}


if ($user_type == "owner") {
	$sql = "SELECT * FROM all_ads WHERE owner_user_id = $user_id LIMIT $start_value, $ads_perpage;";
	$result = mysqli_query($conn, $sql);

	if ($search_ads_type == "" && $search_area == "" && $search_title == "") {
		$sql = "SELECT * FROM all_ads WHERE owner_user_id = $user_id LIMIT $start_value, $ads_perpage;";
		$result = mysqli_query($conn, $sql);
	} else if ($search_ads_type == "all") {
		if ($search_title == "" && $search_area == "all") {
			$sql = "SELECT * FROM all_ads WHERE owner_user_id = $user_id LIMIT $start_value, $ads_perpage;";
			$result = mysqli_query($conn, $sql);
		} else if ($search_title == "" && $search_area != "all") {
			$sql = "SELECT * FROM all_ads WHERE owner_user_id = $user_id AND area = '$search_area' LIMIT $start_value, $ads_perpage;";
			$result = mysqli_query($conn, $sql);
		} else if ($search_title != "" && $search_area == "all") {
			$sql = "SELECT * FROM all_ads WHERE owner_user_id = $user_id AND title LIKE '%$search_title%' LIMIT $start_value, $ads_perpage;";
			$result = mysqli_query($conn, $sql);
		} else if ($search_title != "" && $search_area != "all") {
			$sql = "SELECT * FROM all_ads WHERE owner_user_id = $user_id AND title LIKE '%$search_title%' AND area = '$search_area' LIMIT $start_value, $ads_perpage;";
			$result = mysqli_query($conn, $sql);
		}
	} else if ($search_ads_type != "all") {
		if ($search_title == "" && $search_area == "all") {
			$sql = "SELECT * FROM all_ads WHERE owner_user_id = $user_id AND ads_type = '$search_ads_type' LIMIT $start_value, $ads_perpage;";
			$result = mysqli_query($conn, $sql);
		} else if ($search_title == "" && $search_area != "all") {
			$sql = "SELECT * FROM all_ads WHERE owner_user_id = $user_id AND ads_type = '$search_ads_type' AND area = '$search_area' LIMIT $start_value, $ads_perpage;";
			$result = mysqli_query($conn, $sql);
		} else if ($search_title != "" && $search_area == "all") {
			$sql = "SELECT * FROM all_ads WHERE owner_user_id = $user_id AND ads_type = '$search_ads_type' AND title LIKE '%$search_title%' LIMIT $start_value, $ads_perpage;";
			$result = mysqli_query($conn, $sql);
		} else if ($search_title != "" && $search_area != "all") {
			$sql = "SELECT * FROM all_ads WHERE owner_user_id = $user_id AND ads_type = '$search_ads_type' AND title LIKE '%$search_title%' AND area = '$search_area' LIMIT $start_value, $ads_perpage;";
			$result = mysqli_query($conn, $sql);
		}
	}
} ?>



<?php
while ($row = mysqli_fetch_assoc($result)) { ?>
	<fieldset>
		<div class="ads_image">
			<?php
			$images_paths = $row['photo'];
			$images_path = explode(',', $images_paths);
			// $first_image_path = end($images_path);
			$first_image_path = current($images_path);
			?>
			<img src="<?php echo $first_image_path; ?>" alt="ads image" width="150px" height="150px" />
		</div>
		<div class="ads_details">
			<div class="ads_details_text">
				<!-- <label class="ads_details_text_label"><a href="" class="title"><?php echo $row['title']; ?></a>
				</label> -->
				<span class="ads_details_text_label title" id="title"><?php echo $row['title']; ?>
				</span>
				<br />
				<label class="ads_details_text_label">Ad Type: <?php echo $row['ads_type']; ?></label>
				<br />
				<label class="ads_details_text_label"><?php echo $row['area']; ?></label>
				<br />
				<label class="ads_details_text_label"><?php echo $row['ads_gender']; ?></label>
				<br />
				<label class="ads_details_text_label">Rent: <?php echo $row['rent']; ?> Tk./month</label>
			</div>
			<div class="ads_details_btn">
				<?php
				$ads_id = $row['ads_id'];
				$ads_type = $row['ads_type'];
				$details_btn_data = $ads_id . "," . $ads_type;
				?>

				<form action="owner_ads_edit.php" method="post">
					<button name="edit_btn" id="edit_btn" class="btn edit" value="<?php echo $details_btn_data; ?>">Edit</button>
				</form>
				<form action="owner_show_ads.php" method="post">
					<button name="delete_btn" id="delete_btn" class="btn delete" value="<?php echo $details_btn_data; ?>">Delete</button>
				</form>
				<form action="owner_show_ads_details.php" method="post">
					<button type="submit" class="btn details details_btn" name="details_btn" id="details_btn" value="<?php echo $details_btn_data; ?>">View Details</button>
				</form>
			</div>
		</div>
	</fieldset>

<?php
}
?>
<script>
	// $(document).ready(function() {
	var title = document.getElementsByClassName('title');
	for (var i = 0; i < title.length; i++) {
		var each_title = title[i];
		each_title.addEventListener('click', viewDetails);
	}

	function viewDetails(event) {
		var title = event.target;
		var ads_details = title.parentElement.parentElement;
		var details_btn = ads_details.getElementsByClassName('details_btn')[0];
		// console.log(details_btn);
		details_btn.click();
	}
	// });
</script>