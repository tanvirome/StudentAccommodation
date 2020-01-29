<?php

include "../includes/db_connect.inc.php";
include "../includes/header.inc.php";
include "../includes/footer.inc.php";

session_start();

if (!isset($_SESSION["username"])) {
	header("Location: index.php");
}

$username = $_SESSION['username'];
$user_id = $_SESSION['user_id'];
$user_name = $_SESSION['name'];

$sql = "SELECT * FROM area;";
$areaResult = mysqli_query($conn, $sql);

$search_title = $search_area = $search_ads_type = $ads_type = $ads_id = "";

$flat_ads_count = $mess_ads_count = $sublet_ads_count = $total_ads = 0;
$ads_perpage = 3;
$page_count = 0;

$sql = "SELECT * FROM all_ads WHERE owner_user_id = $user_id AND state = 'active' LIMIT $ads_perpage;";
$result1 = mysqli_query($conn, $sql);

$query = "SELECT * FROM all_ads where owner_user_id = $user_id AND state = 'active';";
$total_ads = mysqli_num_rows(mysqli_query($conn, $query));

$page_count = ceil($total_ads / $ads_perpage);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (isset($_POST['apply_filter_btn'])) {

		$search_title = $_POST['search_title'];
		$search_area = $_POST['search_area'];
		$search_ads_type = $_POST['search_ads_type'];

		if ($search_ads_type == "all") {
			if ($search_title == "" && $search_area == "all") {
				$sql = "SELECT * FROM all_ads WHERE owner_user_id = $user_id LIMIT $ads_perpage;";
				$result1 = mysqli_query($conn, $sql);

				$query = "SELECT * FROM all_ads where owner_user_id = $user_id;";
				$total_ads = mysqli_num_rows(mysqli_query($conn, $query));

				$page_count = ceil($total_ads / $ads_perpage);
			} else if ($search_title == "" && $search_area != "all") {
				$sql = "SELECT * FROM all_ads WHERE owner_user_id = $user_id AND area = '$search_area' LIMIT $ads_perpage;";
				$result1 = mysqli_query($conn, $sql);

				$query = "SELECT * FROM all_ads where owner_user_id = $user_id AND area = '$search_area';";
				$total_ads = mysqli_num_rows(mysqli_query($conn, $query));

				$page_count = ceil($total_ads / $ads_perpage);
			} else if ($search_title != "" && $search_area == "all") {
				$sql = "SELECT * FROM all_ads WHERE owner_user_id = $user_id AND title LIKE '%$search_title%' LIMIT $ads_perpage;";
				$result1 = mysqli_query($conn, $sql);

				$query = "SELECT * FROM all_ads where owner_user_id = $user_id AND title LIKE '%$search_title%';";
				$total_ads = mysqli_num_rows(mysqli_query($conn, $query));

				$page_count = ceil($total_ads / $ads_perpage);
			} else if ($search_title != "" && $search_area != "all") {
				$sql = "SELECT * FROM all_ads WHERE owner_user_id = $user_id AND title LIKE '%$search_title%' AND area = '$search_area' LIMIT $ads_perpage;";
				$result1 = mysqli_query($conn, $sql);

				$query = "SELECT * FROM all_ads where owner_user_id = $user_id AND title LIKE '%$search_title%' AND area = '$search_area';";
				$total_ads = mysqli_num_rows(mysqli_query($conn, $query));

				$page_count = ceil($total_ads / $ads_perpage);
			}
		} else if ($search_ads_type != "all") {
			if ($search_title == "" && $search_area == "all") {
				$sql = "SELECT * FROM all_ads WHERE owner_user_id = $user_id AND ads_type = '$search_ads_type' LIMIT $ads_perpage;";
				$result1 = mysqli_query($conn, $sql);

				$query = "SELECT * FROM all_ads WHERE owner_user_id = $user_id AND ads_type = '$search_ads_type';";
				$total_ads = mysqli_num_rows(mysqli_query($conn, $query));

				$page_count = ceil($total_ads / $ads_perpage);
			} else if ($search_title == "" && $search_area != "all") {
				$sql = "SELECT * FROM all_ads WHERE owner_user_id = $user_id AND ads_type = '$search_ads_type' AND area = '$search_area' LIMIT $ads_perpage;";
				$result1 = mysqli_query($conn, $sql);

				$query = "SELECT * FROM all_ads WHERE owner_user_id = $user_id AND ads_type = '$search_ads_type' AND area = '$search_area';";
				$total_ads = mysqli_num_rows(mysqli_query($conn, $query));

				$page_count = ceil($total_ads / $ads_perpage);
			} else if ($search_title != "" && $search_area == "all") {
				$sql = "SELECT * FROM all_ads WHERE owner_user_id = $user_id AND ads_type = '$search_ads_type' AND title LIKE '%$search_title%' LIMIT $ads_perpage;";
				$result1 = mysqli_query($conn, $sql);

				$query = "SELECT * FROM all_ads WHERE owner_user_id = $user_id AND ads_type = '$search_ads_type' AND title LIKE '%$search_title%';";
				$total_ads = mysqli_num_rows(mysqli_query($conn, $query));

				$page_count = ceil($total_ads / $ads_perpage);
			} else if ($search_title != "" && $search_area != "all") {
				$sql = "SELECT * FROM all_ads WHERE owner_user_id = $user_id AND ads_type = '$search_ads_type' AND title LIKE '%$search_title%' AND area = '$search_area' LIMIT $ads_perpage;";
				$result1 = mysqli_query($conn, $sql);

				$query = "SELECT * FROM all_ads WHERE owner_user_id = $user_id AND ads_type = '$search_ads_type' AND title LIKE '%$search_title%' AND area = '$search_area';";
				$total_ads = mysqli_num_rows(mysqli_query($conn, $query));

				$page_count = ceil($total_ads / $ads_perpage);
			}
		}
	} else if (isset($_POST['delete_btn'])) {
		$delete_btn_data = $_POST['delete_btn'];
		$delete_btn_data_array = explode(",", $delete_btn_data);
		$delete_ads_id = current($delete_btn_data_array);
		$delete_ads_type = end($delete_btn_data_array);
		$sql = "UPDATE all_ads SET status ='unverified', state ='deactive' WHERE ads_id = $delete_ads_id AND ads_type = '$delete_ads_type';";
		mysqli_query($conn, $sql);
		$sql = "UPDATE $delete_ads_type SET status ='unverified', state ='deactive' WHERE ads_id = $delete_ads_id AND ads_type = '$delete_ads_type';";
		mysqli_query($conn, $sql);

		$sql = "SELECT * FROM all_ads WHERE owner_user_id = $user_id AND state = 'active' LIMIT $ads_perpage;";
		$result1 = mysqli_query($conn, $sql);

		$query = "SELECT * FROM all_ads where owner_user_id = $user_id AND state = 'active';";
		$total_ads = mysqli_num_rows(mysqli_query($conn, $query));

		$page_count = ceil($total_ads / $ads_perpage);
	}
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta http-equiv="X-UA-Compatible" content="ie=edge" />
	<!-- To Add Icon -->
	<link rel="stylesheet" href="../icon/fontawesome_icon/css/all.css" />
	<!-- CSS -->
	<link rel="stylesheet" href="../CSS/style.css" />
	<!-- Ajax -->
	<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
	<title>Show Ads</title>
</head>

<body>
	<?php echo after_login_owner_header("myads"); ?>

	<section class="filter_section">
		<div class="container">
			<div class="filtering">
				<form action="owner_show_ads.php" method="POST">
					<input type="text" name="search_title" id="search_title" class="search_title" placeholder="Search by Title..." value="<?php echo $search_title ?>" />
					<label for="" class="search_area_label label">Area : </label>
					<select name="search_area" id="search_area" class="search_area search_combo">
						<option value="all" selected>All</option>
						<?php
						while ($row = mysqli_fetch_assoc($areaResult)) { ?>
							<option value="<?php echo $row['area_name']; ?>" <?php if ($search_area == $row['area_name']) {
																																																									echo "selected";
																																																								} ?>>
								<?php echo $row['area_name']; ?></option>
						<?php } ?>
					</select>
					<label for="" class="search_ads_type_label label">Ads Type : </label>
					<select name="search_ads_type" id="search_ads_type" class="search_ads_type search_combo">
						<option value="all" selected>All</option>
						<option value="flat" <?php if ($search_ads_type == "flat") {
																												echo "selected";
																											} ?>>Flat</option>
						<option value="mess" <?php if ($search_ads_type == "mess") {
																												echo "selected";
																											} ?>>Mess</option>
						<option value="sublet" <?php if ($search_ads_type == "sublet") {
																														echo "selected";
																													} ?>>Sublet</option>
					</select>
					<button type="submit" class="btn details" name="apply_filter_btn" id="apply_filter_btn">Apply Filter</button>
				</form>
			</div>
		</div>
	</section>

	<section class="showads_section">
		<div class="container">
			<div class="showads">
				<div id="showads">
					<?php
					while ($row = mysqli_fetch_assoc($result1)) { ?>
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
						// $flat_ads_count = $flat_ads_count - 1;
					} ?>



				</div>
			</div>
		</div>
	</section>

	<section class="pagination_section">
		<div class="container">
			<div class="center">
				<div class="pagination">
					<!-- <a href="#">&laquo;</a> -->
					<button name="prevBtn" id="prevBtn" class="prevBtn">&laquo;</button>

					<?php
					for ($i = 1; $i <= $page_count; $i++) {
					?>
						<button name="pagination_button" id="<?php echo $i; ?>" class="pagination_button"><?php echo $i; ?></button>
					<?php } ?>
					<button name="nextBtn" id="nextBtn" class="nextBtn">&raquo;</button>
				</div>
			</div>
		</div>
	</section>

	<?php echo footer(); ?>

	<script>
		$(document).ready(function() {
			var allPaginationButton = document.getElementsByClassName('pagination_button');
			var nextButton = document.getElementById('nextBtn');
			var prevButton = document.getElementById('prevBtn');
			var startValue = 0;
			var prevButtonValue = 0;
			var nextButtonValue = 1;
			var totalPage = parseInt("<?php echo $page_count; ?>");
			// console.log(document.getElementById('nextBtn'));
			var buttonClickValue = "1";

			document.getElementById('1').classList.toggle('active');
			document.getElementById('1').disabled = true;
			document.getElementById('1').style.cursor = "not-allowed";

			nextButton.addEventListener('click', paginationNextButtonClicked);
			prevButton.addEventListener('click', paginationprevButtonClicked);

			for (var i = 0; i < allPaginationButton.length; i++) {
				var paginationButton = allPaginationButton[i];
				paginationButton.addEventListener('click', paginationButtonClicked);
			}

			function paginationButtonClicked(event) {
				var prevButtonClickValue = buttonClickValue;
				var button = event.target;
				var buttonId = button.id;
				buttonClickValue = buttonId;

				document.getElementById(buttonClickValue).classList.toggle('active');
				document.getElementById(buttonClickValue).disabled = true;
				document.getElementById(buttonClickValue).style.cursor = "not-allowed";
				// if (prevButtonClickValue != "0") {
				document.getElementById(prevButtonClickValue).classList.toggle('active');
				document.getElementById(prevButtonClickValue).disabled = false;
				document.getElementById(prevButtonClickValue).style.cursor = "pointer";
				// }

				prevButtonValue = parseInt(buttonId);
				nextButtonValue = parseInt(buttonId);
				// alert(prevButtonValue);
				var userId = parseInt("<?php echo $user_id; ?>");
				var searchTitle = "<?php echo $search_title; ?>";
				var searchArea = "<?php echo $search_area; ?>";
				var searchAdsType = "<?php echo $search_ads_type; ?>";
				var adsPerPage = parseInt("<?php echo $ads_perpage; ?>");
				var userType = "owner";
				// alert(userType);
				startValue = (buttonId - 1) * adsPerPage;
				// alert(startValue);
				// alert(totalPage);


				if (prevButtonValue <= 1) {
					prevButton.disabled = true;
					prevButton.style.cursor = "not-allowed";
				} else if (prevButtonValue > 1) {
					prevButton.disabled = false;
					prevButton.style.cursor = "pointer";
					// alert(buttonId);
				}

				if (nextButtonValue >= totalPage) {
					nextButton.disabled = true;
					nextButton.style.cursor = "not-allowed";
				} else if (nextButtonValue < totalPage) {
					nextButton.disabled = false;
					nextButton.style.cursor = "pointer";
					// alert(buttonId);
				}


				$('#showads').load('../includes/owner_load_ads.inc.php', {
					'button_id': buttonId,
					'user_id': userId,
					'search_title': searchTitle,
					'search_area': searchArea,
					'search_ads_type': searchAdsType,
					'ads_perpage': adsPerPage,
					'user_type': userType
				});
			}

			function paginationNextButtonClicked(event) {
				// var button = event.target;
				// var buttonId = button.id;
				var userId = parseInt("<?php echo $user_id; ?>");
				var searchTitle = "<?php echo $search_title; ?>";
				var searchArea = "<?php echo $search_area; ?>";
				var searchAdsType = "<?php echo $search_ads_type; ?>";
				var adsPerPage = parseInt("<?php echo $ads_perpage; ?>");
				var userType = "owner";
				startValue = startValue + parseInt(adsPerPage);
				// alert(startValue);
				nextButtonValue = nextButtonValue + 1;

				var prevButtonClickValue = buttonClickValue;
				buttonClickValue = nextButtonValue;

				document.getElementById(buttonClickValue).classList.toggle('active');
				document.getElementById(buttonClickValue).disabled = true;
				document.getElementById(buttonClickValue).style.cursor = "not-allowed";
				// if (prevButtonClickValue != "0") {
				document.getElementById(prevButtonClickValue).classList.toggle('active');
				document.getElementById(prevButtonClickValue).disabled = false;
				document.getElementById(prevButtonClickValue).style.cursor = "pointer";
				// }

				if (prevButtonValue == 0) {
					prevButtonValue = prevButtonValue + 2;
				} else {
					prevButtonValue = prevButtonValue + 1;
				}



				if (nextButtonValue >= totalPage) {
					nextButton.disabled = true;
					nextButton.style.cursor = "not-allowed";
				} else if (nextButtonValue < totalPage) {
					nextButton.disabled = false;
					nextButton.style.cursor = "pointer";
					// alert(buttonId);
				}

				if (prevButtonValue <= 1) {
					prevButton.disabled = true;
					prevButton.style.cursor = "not-allowed";
				} else if (prevButtonValue > 1) {
					prevButton.disabled = false;
					prevButton.style.cursor = "pointer";
				}

				$('#showads').load('../includes/owner_load_ads.inc.php', {
					// 'button_id': buttonId,
					'user_id': userId,
					'search_title': searchTitle,
					'search_area': searchArea,
					'search_ads_type': searchAdsType,
					'ads_perpage': adsPerPage,
					'user_type': userType,
					'start_value': startValue
				});
			}

			function paginationprevButtonClicked(event) {
				// var button = event.target;
				// var buttonId = button.id;
				var userId = parseInt("<?php echo $user_id; ?>");
				var searchTitle = "<?php echo $search_title; ?>";
				var searchArea = "<?php echo $search_area; ?>";
				var searchAdsType = "<?php echo $search_ads_type; ?>";
				var adsPerPage = parseInt("<?php echo $ads_perpage; ?>");
				var userType = "owner";
				startValue = startValue - parseInt(adsPerPage);

				// alert(startValue);
				prevButtonValue = prevButtonValue - 1;
				nextButtonValue = nextButtonValue - 1;

				var prevButtonClickValue = buttonClickValue;
				buttonClickValue = prevButtonValue;

				document.getElementById(buttonClickValue).classList.toggle('active');
				document.getElementById(buttonClickValue).disabled = true;
				document.getElementById(buttonClickValue).style.cursor = "not-allowed";
				// if (prevButtonClickValue != "0") {
				document.getElementById(prevButtonClickValue).classList.toggle('active');
				document.getElementById(prevButtonClickValue).disabled = false;
				document.getElementById(prevButtonClickValue).style.cursor = "pointer";
				// }

				if (prevButtonValue <= 1) {
					prevButton.disabled = true;
					prevButton.style.cursor = "not-allowed";
				} else if (prevButtonValue > 1) {
					prevButton.disabled = false;
					prevButton.style.cursor = "pointer";
				}

				if (nextButtonValue >= totalPage) {
					nextButton.disabled = true;
					nextButton.style.cursor = "not-allowed";
				} else if (nextButtonValue < totalPage) {
					nextButton.disabled = false;
					nextButton.style.cursor = "pointer";
					// alert(buttonId);
				}

				$('#showads').load('../includes/owner_load_ads.inc.php', {
					// 'button_id': buttonId,
					'user_id': userId,
					'search_title': searchTitle,
					'search_area': searchArea,
					'search_ads_type': searchAdsType,
					'ads_perpage': adsPerPage,
					'user_type': userType,
					'start_value': startValue
				});
			}
			if (prevButtonValue <= 1) {
				prevButton.disabled = true;
				prevButton.style.cursor = "not-allowed";
			}
		});
	</script>

	<script>
		$(document).ready(function() {
			var title = document.getElementsByClassName('title');
			for (var i = 0; i < title.length; i++) {
				var each_title = title[i];
				each_title.addEventListener('click', viewDetails);
			}

			function viewDetails(event) {
				var title = event.target;
				var ads_details = title.parentElement.parentElement;
				var details_btn = ads_details.getElementsByClassName('details_btn')[0];
				details_btn.click();
			}
		});
	</script>
</body>

</html>