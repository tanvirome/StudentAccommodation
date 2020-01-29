<?php

include "../includes/db_connect.inc.php";
include "../includes/header.inc.php";
include "../includes/footer.inc.php";
// include "../includes/load_ads.inc.php";
include "../includes/unverified_modal.inc.php";

session_start();

if (!isset($_SESSION["username"])) {
	header("Location: index.php");
}

$username = $_SESSION['username'];
// $user_id = $_SESSION['user_id'];
$user_name = $_SESSION['name'];

$search_title = $search_area = $min_rent = $max_rent = $ads_id = $rent_range = "";
$ads_type = "mess";

$flat_ads_count = $mess_ads_count = $sublet_ads_count = $total_ads = 0;
$ads_perpage = 3;
$page_count = 0;

$user_status = "";

$sql = "SELECT status FROM student WHERE username = '$username';";
$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_assoc($result)) {
	$user_status = $row['status'];
}
if ($user_status == "unverified") {
	echo unverified_modal("show_mess_ads.php");
	// header("Location: owner_homepage.php");
}

$sql = "SELECT * FROM area;";
$areaResult = mysqli_query($conn, $sql);

$sql = "SELECT * FROM all_ads WHERE ads_type = '$ads_type' AND status = 'verified' AND state = 'active' LIMIT $ads_perpage;";
$result1 = mysqli_query($conn, $sql);

$query = "SELECT * FROM all_ads where ads_type = '$ads_type' AND status = 'verified' AND state = 'active';";
$total_ads = mysqli_num_rows(mysqli_query($conn, $query));

$page_count = ceil($total_ads / $ads_perpage);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (isset($_POST['okay_btn'])) {
		header("Location: student_homepage.php");
	}
	if (isset($_POST['apply_filter_btn'])) {

		$search_title = $_POST['search_title'];
		$search_area = $_POST['search_area'];
		$rent_range = $_POST['rent_range'];
		if ($rent_range == "all") {
			$min_rent = $max_rent = "";
		} else {
			$rent_range_data_array = explode("-", $rent_range);
			$min_rent = current($rent_range_data_array);
			$max_rent = end($rent_range_data_array);
		}

		// $min_rent = $_POST['min_rent'];
		// $max_rent = $_POST['max_rent'];

		if ($search_title == "" && $search_area == "all" && $min_rent == "" && $max_rent == "") {
			$sql = "SELECT * FROM all_ads WHERE ads_type = '$ads_type' AND status = 'verified' AND state = 'active' LIMIT $ads_perpage;";
			$result1 = mysqli_query($conn, $sql);

			$query = "SELECT * FROM all_ads where ads_type = '$ads_type' AND status = 'verified' AND state = 'active';";
			$total_ads = mysqli_num_rows(mysqli_query($conn, $query));

			$page_count = ceil($total_ads / $ads_perpage);
		} else if ($search_title == "" && $search_area != "all" && $min_rent == "" && $max_rent == "") {
			$sql = "SELECT * FROM all_ads WHERE ads_type = '$ads_type' AND area = '$search_area' AND status = 'verified' AND state = 'active' LIMIT $ads_perpage;";
			$result1 = mysqli_query($conn, $sql);

			$query = "SELECT * FROM all_ads WHERE ads_type = '$ads_type' AND area = '$search_area' AND status = 'verified' AND state = 'active';";
			$total_ads = mysqli_num_rows(mysqli_query($conn, $query));

			$page_count = ceil($total_ads / $ads_perpage);
		} else if ($search_title != "" && $search_area == "all" && $min_rent == "" && $max_rent == "") {
			$sql = "SELECT * FROM all_ads WHERE ads_type = '$ads_type' AND status = 'verified' AND state = 'active' AND title LIKE '%$search_title%' LIMIT $ads_perpage;";
			$result1 = mysqli_query($conn, $sql);

			$query = "SELECT * FROM all_ads where ads_type = '$ads_type' AND status = 'verified' AND state = 'active' AND title LIKE '%$search_title%';";
			$total_ads = mysqli_num_rows(mysqli_query($conn, $query));

			$page_count = ceil($total_ads / $ads_perpage);
		} else if ($search_title == "" && $search_area == "all" && $min_rent != "" && $max_rent != "") {
			$sql = "SELECT * FROM all_ads WHERE ads_type = '$ads_type' AND status = 'verified' AND state = 'active' AND rent between $min_rent AND $max_rent LIMIT $ads_perpage;";
			$result1 = mysqli_query($conn, $sql);

			$query = "SELECT * FROM all_ads where ads_type = '$ads_type' AND status = 'verified' AND state = 'active' AND rent between $min_rent AND $max_rent;";
			$total_ads = mysqli_num_rows(mysqli_query($conn, $query));

			$page_count = ceil($total_ads / $ads_perpage);
		} else if ($search_title != "" && $search_area != "all" && $min_rent == "" && $max_rent == "") {
			$sql = "SELECT * FROM all_ads WHERE ads_type = '$ads_type' AND status = 'verified' AND state = 'active' AND title LIKE '%$search_title%' AND area = '$search_area' LIMIT $ads_perpage;";
			$result1 = mysqli_query($conn, $sql);

			$query = "SELECT * FROM all_ads where ads_type = '$ads_type' AND status = 'verified' AND state = 'active' AND title LIKE '%$search_title%' AND area = '$search_area';";
			$total_ads = mysqli_num_rows(mysqli_query($conn, $query));

			$page_count = ceil($total_ads / $ads_perpage);
		} else if ($search_title != "" && $search_area == "all" && $min_rent != "" && $max_rent != "") {
			$sql = "SELECT * FROM all_ads WHERE ads_type = '$ads_type' AND status = 'verified' AND state = 'active' AND title LIKE '%$search_title%' AND rent between $min_rent AND $max_rent LIMIT $ads_perpage;";
			$result1 = mysqli_query($conn, $sql);

			$query = "SELECT * FROM all_ads where ads_type = '$ads_type' AND status = 'verified' AND state = 'active' AND title LIKE '%$search_title%' AND rent between $min_rent AND $max_rent;";
			$total_ads = mysqli_num_rows(mysqli_query($conn, $query));

			$page_count = ceil($total_ads / $ads_perpage);
		} else if ($search_title == "" && $search_area != "all" && $min_rent != "" && $max_rent != "") {
			$sql = "SELECT * FROM all_ads WHERE ads_type = '$ads_type' AND status = 'verified' AND state = 'active' AND area = '$search_area' AND rent between $min_rent AND $max_rent LIMIT $ads_perpage;";
			$result1 = mysqli_query($conn, $sql);

			$query = "SELECT * FROM all_ads where ads_type = '$ads_type' AND status = 'verified' AND state = 'active' AND area = '$search_area' AND rent between $min_rent AND $max_rent;";
			$total_ads = mysqli_num_rows(mysqli_query($conn, $query));

			$page_count = ceil($total_ads / $ads_perpage);
		} else if ($search_title != "" && $search_area != "all" && $min_rent != "" && $max_rent != "") {
			$sql = "SELECT * FROM all_ads WHERE ads_type = '$ads_type' AND status = 'verified' AND state = 'active' AND title LIKE '%$search_title%' AND area = '$search_area' AND rent between $min_rent AND $max_rent LIMIT $ads_perpage;";
			$result1 = mysqli_query($conn, $sql);

			$query = "SELECT * FROM all_ads where ads_type = '$ads_type' AND status = 'verified' AND state = 'active' AND title LIKE '%$search_title%' AND area = '$search_area' AND rent between $min_rent AND $max_rent;";
			$total_ads = mysqli_num_rows(mysqli_query($conn, $query));

			$page_count = ceil($total_ads / $ads_perpage);
		}
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
	<?php echo after_login_student_header("showads"); ?>

	<section class="filter_section">
		<div class="container">
			<div class="filtering">
				<form action="show_mess_ads.php" method="POST">
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
						<!-- <option value="Mirpur">Mirpur</option>
      <option value="Dhanmondi">Dhanmondi</option>
      <option value="Uttara">Uttara</option>
      <option value="Banani">Banani</option> -->
					</select>

					<label for="rent_range" class="rent_range label">Rent Range : </label>
					<select name="rent_range" id="rent_range" class="search_rent_range">
						<option value="all" selected>Any range of rent</option>
						<option value="0-10000" <?php if ($rent_range == "0-10000") {
																															echo "selected";
																														} ?>>1 to 10,000</option>
						<option value="10001-20000" <?php if ($rent_range == "10001-20000") {
																																			echo "selected";
																																		} ?>>10,001 to 20,000</option>
						<option value="20001-30000" <?php if ($rent_range == "20001-30000") {
																																			echo "selected";
																																		} ?>>20,001 to 30,000</option>
						<option value="30001-50000" <?php if ($rent_range == "30001-50000") {
																																			echo "selected";
																																		} ?>>30,001 to 50,000</option>
						<option value="50001-999999" <?php if ($rent_range == "50001-999999") {
																																				echo "selected";
																																			} ?>>50,000+</option>
					</select>

					<!-- <label for="" class="rent_range label">Price range : </label>
					<input type="number" name="min_rent" id="min_rent" class="min_rent" placeholder="Min Price" value="<?php echo $min_rent ?>" />
					<span style="margin: 0 5px;">To</span>
					<input type="number" name="max_rent" id="max_rent" class="max_rent" placeholder="Max Price" value="<?php echo $max_rent ?>" /> -->

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
					if ($total_ads < 1) { ?>
						<h2 style="text-align: center;">No result Found</h2>
						<?php
					} else {
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
										<form action="student_show_ads_details.php" method="post" class="details_btn1">
											<button type="submit" class="btn details details_btn" name="details_btn" value="<?php echo $details_btn_data; ?>">View Details</button>
										</form>
									</div>
								</div>
							</fieldset>
					<?php
							// $flat_ads_count = $flat_ads_count - 1;
						}
					}
					?>



				</div>
			</div>
		</div>
	</section>

	<section class="pagination_section">
		<div class="container">
			<div class="center">
				<div class="pagination">
					<!-- <a href="#">&laquo;</a> -->
					<!-- <button name="prevBtn" id="prevBtn" class="prevBtn">&laquo;</button> -->
					<?php if ($page_count > 1) { ?>
						<button name="prevBtn" id="prevBtn" class="prevBtn">&laquo;</button>
					<?php
					} ?>

					<?php
					for ($i = 1; $i <= $page_count; $i++) {
					?>
						<button name="pagination_button" id="<?php echo $i; ?>" class="pagination_button"><?php echo $i; ?></button>
					<?php } ?>
					<!-- <a href="#">1</a>
     <a href="#" class="active">2</a>
     <a href="#">3</a>
     <a href="#">4</a>
     <a href="#">5</a>
     <a href="#">6</a> -->
					<!-- <a href="#">&raquo;</a> -->
					<!-- <button name="nextBtn" id="nextBtn" class="nextBtn">&raquo;</button> -->

					<?php if ($page_count > 1) { ?>
						<button name="nextBtn" id="nextBtn" class="nextBtn">&raquo;</button>
					<?php
					} ?>
				</div>
			</div>
		</div>
	</section>

	<!-- Show Footer -->
	<?php echo footer(); ?>


	<!-- <script src="../JavaScript/header.js"></script> -->

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

			var searchTitle = "<?php echo $search_title; ?>";
			var searchArea = "<?php echo $search_area; ?>";
			var minRent = "<?php echo $min_rent; ?>";
			var maxRent = "<?php echo $max_rent; ?>";
			var adsPerPage = parseInt("<?php echo $ads_perpage; ?>");
			var userType = "student";
			var adsType = "mess";
			var buttonClickValue = "1";

			document.getElementById('1').classList.toggle('active');
			document.getElementById('1').disabled = true;
			document.getElementById('1').style.cursor = "not-allowed";
			nextButton.addEventListener('click', paginationNextButtonClicked);
			prevButton.addEventListener('click', paginationPrevButtonClicked);

			for (var i = 0; i < allPaginationButton.length; i++) {
				var paginationButton = allPaginationButton[i];
				paginationButton.addEventListener('click', paginationButtonClicked);
			}

			function paginationButtonClicked(event) {
				var prevButtonClickValue = buttonClickValue;
				var button = event.target;
				buttonId = button.id;
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

				startValue = (buttonId - 1) * adsPerPage;

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

				$('#showads').load('../includes/load_student_ads.inc.php', {
					'button_id': buttonId,
					'search_title': searchTitle,
					'search_area': searchArea,
					'min_rent': minRent,
					'max_rent': maxRent,
					'ads_perpage': adsPerPage,
					'user_type': userType,
					'ads_type': adsType
				});




			}

			function paginationNextButtonClicked(event) {
				// var button = event.target;
				// var buttonId = button.id;

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
				}

				if (prevButtonValue <= 1) {
					prevButton.disabled = true;
					prevButton.style.cursor = "not-allowed";
				} else if (prevButtonValue > 1) {
					prevButton.disabled = false;
					prevButton.style.cursor = "pointer";
				}

				$('#showads').load('../includes/load_student_ads.inc.php', {
					// 'button_id': buttonId,
					'search_title': searchTitle,
					'search_area': searchArea,
					'min_rent': minRent,
					'max_rent': maxRent,
					'ads_perpage': adsPerPage,
					'user_type': userType,
					'ads_type': adsType,
					'start_value': startValue
				});
			}

			function paginationPrevButtonClicked(event) {
				// var button = event.target;
				// var buttonId = button.id;

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

				$('#showads').load('../includes/load_student_ads.inc.php', {
					// 'button_id': buttonId,
					'search_title': searchTitle,
					'search_area': searchArea,
					'min_rent': minRent,
					'max_rent': maxRent,
					'ads_perpage': adsPerPage,
					'user_type': userType,
					'ads_type': adsType,
					'start_value': startValue
				});
			}
			if (prevButtonValue <= 1) {
				prevButton.disabled = true;
				prevButton.style.cursor = "not-allowed";
			}
		});
	</script>

	<script src="../JavaScript/unverified_modal.js"></script>

	<script>
		// $(document).ready(function() {
		var title = document.getElementsByClassName('title');
		for (var i = 0; i < title.length; i++) {
			var each_title = title[i];
			each_title.addEventListener('click', viewDetails);
		}

		function viewDetails(event) {
			console.log("clicked1");
			var title = event.target;
			var ads_details = title.parentElement.parentElement;
			var details_btn = ads_details.getElementsByClassName('details_btn')[0];
			details_btn.click();
		}
		// });
	</script>


</body>

</html>