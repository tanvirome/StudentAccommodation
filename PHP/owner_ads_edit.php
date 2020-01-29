<?php

include "../includes/db_connect.inc.php";
include "../includes/header.inc.php";
include "../includes/footer.inc.php";
// include "../includes/flat_details.inc.php";
// include "../includes/mess_details.inc.php";
// include "../includes/sublet_details.inc.php";


session_start();

if (!isset($_SESSION["username"])) {
	header("Location: index.php");
}

$username = $_SESSION['username'];
$user_id = $_SESSION['user_id'];
$user_name = $_SESSION['name'];

$sql = "SELECT * FROM area;";
$areaResult = mysqli_query($conn, $sql);

$title = $photo = $date = $ads_for = $size = $bedroom = $corridor = $bathroom = $special_facility = $rent = $rent_type = $address = $city = $area = $details = $o_name = $o_phone = $o_email = $lift = $generator = $wifi = $file = "";
$ads_id = $ads_type = "";

$err1 = $err2 = $err3 = $err4 = $err5 = $err6 = $err7 = $err8 = $err9 = $err10 = $err11 = $err12 = $err13 = $err14 = $err15 = $err16 = "";
$successMsg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (isset($_POST['ads_delete_button'])) {
		$delete_btn_data = $_POST['ads_delete_button'];
		$btn_data = $delete_btn_data;
		$delete_btn_data_array = explode(",", $delete_btn_data);
		$delete_ads_id = current($delete_btn_data_array);
		$delete_ads_type = end($delete_btn_data_array);
		$sql = "UPDATE all_ads SET status ='unverified', state ='deactive' WHERE ads_id = $delete_ads_id AND ads_type = '$delete_ads_type';";
		mysqli_query($conn, $sql);
		$sql = "UPDATE $delete_ads_type SET status ='unverified', state ='deactive' WHERE ads_id = $delete_ads_id AND ads_type = '$delete_ads_type';";
		mysqli_query($conn, $sql);

		header("Location: owner_show_ads.php");
	} else if (isset($_POST['ads_update_button'])) {
		$update_btn_data = $_POST['ads_update_button'];
		$btn_data = $update_btn_data;
		$update_btn_data_array = explode(",", $update_btn_data);
		$ads_id = current($update_btn_data_array);
		$ads_type = end($update_btn_data_array);

		if (!empty($_POST['title'])) {
			$title = mysqli_real_escape_string($conn, $_POST['title']);
		} else {
			$err1 = "This field can't be empty";
		}

		if (!empty($_POST['date'])) {
			$date = mysqli_real_escape_string($conn, $_POST['date']);
		} else {
			$err3 = "This field can't be empty";
		}

		if (!empty($_POST['ads_for'])) {
			$ads_for = mysqli_real_escape_string($conn, $_POST['ads_for']);
		} else {
			$err4 = "This field can't be empty";
		}

		if ($ads_type == "flat") {
			if (!empty($_POST['size'])) {
				$size = mysqli_real_escape_string($conn, $_POST['size']);
			} else {
				$err5 = "This field can't be empty";
			}

			if (!empty($_POST['bedroom'])) {
				$bedroom = mysqli_real_escape_string($conn, $_POST['bedroom']);
			} else {
				$err6 = "This field can't be empty";
			}

			if (!empty($_POST['corridor'])) {
				$corridor = mysqli_real_escape_string($conn, $_POST['corridor']);
			} else {
				$err7 = "This field can't be empty";
			}

			if (!empty($_POST['bathroom'])) {
				$bathroom = mysqli_real_escape_string($conn, $_POST['bathroom']);
			} else {
				$err8 = "This field can't be empty";
			}
		}


		if (!empty($_POST['rent'])) {
			$rent = mysqli_real_escape_string($conn, $_POST['rent']);
		} else {
			$err9 = "This field can't be empty";
		}

		if (!empty($_POST['rent_type'])) {
			$rent_type = mysqli_real_escape_string($conn, $_POST['rent_type']);
		}

		if (!empty($_POST['address'])) {
			$address = mysqli_real_escape_string($conn, $_POST['address']);
		} else {
			$err10 = "This field can't be empty";
		}

		if (!empty($_POST['city'])) {
			$city = mysqli_real_escape_string($conn, $_POST['city']);
		} else {
			$err11 = "This field can't be empty";
		}

		if (!empty($_POST['area'])) {
			$area = mysqli_real_escape_string($conn, $_POST['area']);
		} else {
			$err12 = "This field can't be empty";
		}

		if (!empty($_POST['details'])) {
			$details = mysqli_real_escape_string($conn, $_POST['details']);
		} else {
			$err13 = "This field can't be empty";
		}

		if (!empty($_POST['o_name'])) {
			$o_name = mysqli_real_escape_string($conn, $_POST['o_name']);
		} else {
			$err14 = "This field can't be empty";
		}

		if (!empty($_POST['o_phone'])) {
			$o_phone = mysqli_real_escape_string($conn, $_POST['o_phone']);
		} else {
			$err15 = "This field can't be empty";
		}

		if (!empty($_POST['o_email'])) {
			$o_email = mysqli_real_escape_string($conn, $_POST['o_email']);
		} else {
			$err16 = "This field can't be empty";
		}

		if ($ads_type == "flat" || $ads_type == "sublet") {
			if (!empty($_POST['lift'])) {
				$lift = $_POST['lift'];
				if ($special_facility == "") {
					$special_facility = $_POST['lift'];
				} else {
					$special_facility = $special_facility . "," . $_POST['lift'];
				}
			}

			if (!empty($_POST['generator'])) {
				$generator = $_POST['generator'];
				if ($special_facility == "") {
					$special_facility = $_POST['generator'];
				} else {
					$special_facility = $special_facility . "," . $_POST['generator'];
				}
			}

			if (!empty($_POST['wifi'])) {
				$wifi = $_POST['wifi'];
				if ($special_facility == "") {
					$special_facility = $_POST['wifi'];
				} else {
					$special_facility = $special_facility . "," . $_POST['wifi'];
				}
			}
		}



		if ($err1 == "" && $err2 == "" && $err3 == "" && $err4 == "" && $err5 == "" && $err6 == "" && $err7 == "" && $err8 == "" && $err9 == "" && $err10 == "" && $err11 == "" && $err12 == "" && $err13 == "" && $err14 == "" && $err15 == "" && $err16 == "") {
			if ($ads_type == "flat") {
				$sql = "UPDATE $ads_type SET title='$title', date='$date', ads_gender='$ads_for', size='$size', bedroom='$bedroom', bathroom='$bathroom', corridor='$corridor', facility='$special_facility', rent='$rent', rent_type='$rent_type', address='$address', city='$city', area='$area', details='$details', owner_name='$o_name', owner_phone='$o_phone', owner_email='$o_email', status ='unverified' where ads_id = $ads_id;";

				mysqli_query($conn, $sql);

				$sql = "UPDATE all_ads SET title='$title', ads_gender='$ads_for', rent='$rent', rent_type='$rent_type', area='$area', status ='unverified' where ads_id = '$ads_id' AND ads_type = '$ads_type';";

				mysqli_query($conn, $sql);

				$successMsg = "Update Successfully!!!";
			} else if ($ads_type == "mess") {
				$sql = "UPDATE $ads_type SET title='$title', date='$date', ads_gender='$ads_for', rent='$rent', rent_type='$rent_type', address='$address', city='$city', area='$area', details='$details', owner_name='$o_name', owner_phone='$o_phone', owner_email='$o_email', status ='unverified' where ads_id = $ads_id;";

				mysqli_query($conn, $sql);

				$sql = "UPDATE all_ads SET title='$title', ads_gender='$ads_for', rent='$rent', rent_type='$rent_type', area='$area', status ='unverified' where ads_id = '$ads_id' AND ads_type = '$ads_type';";

				mysqli_query($conn, $sql);

				$successMsg = "Update Successfully!!!";
			} else if ($ads_type == "sublet") {
				$sql = "UPDATE $ads_type SET title='$title', date='$date', ads_gender='$ads_for',  facility='$special_facility', rent='$rent', rent_type='$rent_type', address='$address', city='$city', area='$area', details='$details', owner_name='$o_name', owner_phone='$o_phone', owner_email='$o_email', status ='unverified' where ads_id = $ads_id;";

				mysqli_query($conn, $sql);

				$sql = "UPDATE all_ads SET title='$title', ads_gender='$ads_for', rent='$rent', rent_type='$rent_type', area='$area', status ='unverified' where ads_id = '$ads_id' AND ads_type = '$ads_type';";

				mysqli_query($conn, $sql);

				$successMsg = "Update Successfully!!!";
			}
		}
	} else if (isset($_POST['edit_btn'])) {
		$edit_btn_data = $_POST['edit_btn'];
		$btn_data = $edit_btn_data;
		$edit_btn_data_array = explode(",", $edit_btn_data);
		$ads_id = current($edit_btn_data_array);
		$ads_type = end($edit_btn_data_array);
	}

	$sql = "SELECT * FROM $ads_type WHERE ads_id = $ads_id AND state ='active';";
	$result = mysqli_query($conn, $sql);
	if ($ads_type == "flat") {
		while ($row = mysqli_fetch_assoc($result)) {
			$title = $row['title'];
			$date = $row['date'];
			$ads_for = $row['ads_gender'];
			$size = $row['size'];
			$bedroom = $row['bedroom'];
			$bathroom = $row['bathroom'];
			$corridor = $row['corridor'];
			$special_facility = $row['facility'];
			$special_facility_data_array = explode(",", $special_facility);
			$lift = current($special_facility_data_array);
			$generator = next($special_facility_data_array);
			$wifi = end($special_facility_data_array);
			$rent = $row['rent'];
			$rent_type = $row['rent_type'];
			$address = $row['address'];
			$city = $row['city'];
			$area = $row['area'];
			$details = $row['details'];
			$o_name = $row['owner_name'];
			$o_phone = $row['owner_phone'];
			$o_email = $row['owner_email'];
		}
	} else if ($ads_type == "mess") {
		while ($row = mysqli_fetch_assoc($result)) {
			$title = $row['title'];
			$date = $row['date'];
			$ads_for = $row['ads_gender'];
			$rent = $row['rent'];
			$rent_type = $row['rent_type'];
			$address = $row['address'];
			$city = $row['city'];
			$area = $row['area'];
			$details = $row['details'];
			$o_name = $row['owner_name'];
			$o_phone = $row['owner_phone'];
			$o_email = $row['owner_email'];
		}
	} else if ($ads_type == "sublet") {
		while ($row = mysqli_fetch_assoc($result)) {
			$title = $row['title'];
			$date = $row['date'];
			$ads_for = $row['ads_gender'];
			$special_facility = $row['facility'];
			$special_facility_data_array = explode(",", $special_facility);
			$lift = current($special_facility_data_array);
			$generator = next($special_facility_data_array);
			$wifi = end($special_facility_data_array);
			$rent = $row['rent'];
			$rent_type = $row['rent_type'];
			$address = $row['address'];
			$city = $row['city'];
			$area = $row['area'];
			$details = $row['details'];
			$o_name = $row['owner_name'];
			$o_phone = $row['owner_phone'];
			$o_email = $row['owner_email'];
		}
	}
}

?>




<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<!-- To Add Icon -->
	<link rel="stylesheet" href="../icon/fontawesome_icon/css/all.css" />
	<!-- CSS -->
	<link rel="stylesheet" href="../CSS/style.css" />
	<title>Ads Edit</title>
</head>

<body>
	<?php echo after_login_owner_header("myads"); ?>

	<?php
	if ($ads_type == "flat") { ?>
		<section id="ad_section">
			<div class="container">
				<div class="post_ads_information">
					<form action="owner_ads_edit.php" method="POST">
						<div>
							<h1 align="center">Update Your Flat AD</h1>
							<h3 align="center"><?php echo $successMsg; ?></h3>
							<table align="center">
								<tr>
									<td align="right">
										<label for="title">
											<b>Title: <span class="required">*</span></b>
										</label>
									</td>
									<td>
										<input type="text" name="title" id="title" value="<?php echo $title; ?>" placeholder="Title..." style="width: 80%;" class="ads_input" required />
									</td>
								</tr>

								<!-- <tr>
         <td align="right">
          <label for="photo">
           <b>Photos: <span class="required">*</span></b>
          </label>
         </td>
         <td>
          <input type="file" name="photos[]" accept="image/*" multiple class="ads_input" required />
          <span style="color: red; margin-left: 20px"><?php echo $errmsg1; ?></span>
          <span style="color: red; margin-left: 20px"><?php echo $err17; ?></span>
         </td>
        </tr>
        <tr>
         <td></td>
         <td>
          <span style="color: #0066cc; margin-left: 20px">You can upload maximum 5 photos and keep your each photo size &lt 500 KB.</span>
         </td>
        </tr> -->

								<tr>
									<td align="right">
										<label for="date">
											<b>Available From: <span class="required">*</span></b>
										</label>
									</td>
									<td>
										<input type="date" name="date" id="date" min="2019-09-30" max="2050-12-31" style="width: 150px;" class="ads_input calendarDate" value="<?php echo $date; ?>" required />
									</td>
								</tr>

								<tr>
									<td align="right">
										<label for="ads_for">
											<b>ADs For: <span class="required">*</span></b>
										</label>
									</td>
									<td>
										<select name="ads_for" id="ads_for" class="ads_input" style="width: 160px; height: 32px;" required>
											<option value="" selected disabled> Select gender...</option>
											<option value="male" <?php if ($ads_for == "male") {
																																		echo "selected";
																																	} ?>>Male</option>
											<option value="female" <?php if ($ads_for == "female") {
																																				echo "selected";
																																			} ?>>Female</option>
										</select>
									</td>
								</tr>

								<tr>
									<td align="right">
										<label for="size">
											<b>Size: <span class="required">*</span></b>
										</label>
									</td>
									<td>
										<input type="number" name="size" id="size" value="<?php echo $size; ?>" min="0" placeholder="Size..." style="width: 150px;" class="ads_input" required />
										square ft.
									</td>
								</tr>
								<tr>
									<td style="width: 165px;" align="right">
										<label for="bedroom">
											<b>Number of Bedroom: <span class="required">*</span></b>
										</label>
									</td>
									<td align="left">
										<input type="number" name="bedroom" id="bedroom" value="<?php echo $bedroom; ?>" min="0" max="9" placeholder="Bedroom..." style="width: 150px;" class="ads_input" required />
									</td>
								</tr>

								<tr>
									<td align="right">
										<label for="corridor">
											<b>Number of Corridor: <span class="required">*</span></b>
										</label>
									</td>
									<td>
										<input type="number" name="corridor" id="corridor" value="<?php echo $corridor; ?>" min="0" max="9" style="width: 150px;" placeholder="Corridor..." class="ads_input" required />
									</td>
								</tr>
								<tr>
									<td>
										<label for="bathroom">
											<b>Number of Bathroom: <span class="required">*</span></b>
										</label>
									</td>
									<td>
										<input type="number" name="bathroom" id="bathroom" value="<?php echo $bathroom; ?>" min="0" max="9" style="width: 150px;" placeholder="Bathroom..." class="ads_input" required />
									</td>
								</tr>

								<tr>
									<td align="right">
										<label for="sfacility">
											<b>Special Facility: </b>
										</label>
									</td>
									<td>
										<input type="checkbox" name="lift" value="Lift" <?php if ($lift == "Lift") {
																																																												echo "checked";
																																																											} ?> /> Lift
										<input type="checkbox" name="generator" value="Generator" <?php if ($generator == "Generator") {
																																																																						echo "checked";
																																																																					} ?> /> Generator
										<input type="checkbox" name="wifi" value="Wi-Fi" <?php if ($wifi == "Wi-Fi") {
																																																													echo "checked";
																																																												} ?> /> Wi-Fi
									</td>
								</tr>

								<tr>
									<td align="right">
										<label for="rent">
											<b>Rent: <span class="required">*</span></b>
										</label>
									</td>
									<td>
										<input type="number" name="rent" id="rent" value="<?php echo $rent; ?>" style="width: 100px;" placeholder="Rent..." class="ads_input" min="0" required />
										<input type="radio" name="rent_type" value="Fixed" checked />
										Fixed
										<input type="radio" name="rent_type" value="Negotiable" <?php if ($rent_type == "Negotiable") {
																																																																				echo "checked";
																																																																			} ?> />
										Negotiable
									</td>
								</tr>

								<tr>
									<td align="right" style="vertical-align: top;">
										<label for="address">
											<b>Address: <span class="required">*</span></b>
										</label>
									</td>
									<td>
										<textarea name="address" id="address" cols="80" rows="6" style="width: 80%; font-size: 16px; padding: 2px 8px;" placeholder="Address..." required><?php echo $address; ?></textarea>
									</td>
								</tr>

								<tr>
									<td align="right">
										<label for="city">
											<b>City: <span class="required">*</span></b>
										</label>
									</td>
									<td>
										<select name="city" id="city" class="ads_input" style="width: 160px; height: 32px;" required>
											<option value="" selected disabled> Select a City...</option>
											<option value="Dhaka" <?php if ($city == "Dhaka") {
																																			echo "selected";
																																		} ?>>Dhaka</option>
										</select>
									</td>
								</tr>
								<tr>
									<td align="right">
										<label for="area">
											<b>Area: <span class="required">*</span></b>
										</label>
									</td>
									<td>
										<select name="area" id="area" class="ads_input" style="width: 160px; height: 32px;" required>
											<option value="" selected disabled> Select an Area...</option>
											<?php
												while ($row = mysqli_fetch_assoc($areaResult)) { ?>
												<option value="<?php echo $row['area_name']; ?>" <?php if ($area == $row['area_name']) {
																																																																echo "selected";
																																																															} ?>>
													<?php echo $row['area_name']; ?></option>
											<?php } ?>
										</select>
									</td>
								</tr>

								<tr>
									<td align="right" style="vertical-align: top;">
										<label for="details">
											<b>Details: <span class="required">*</span></b>
										</label>
									</td>
									<td>
										<textarea name="details" id="details" cols="80" rows="6" style="width: 80%; font-size: 16px; padding: 2px 8px;" placeholder="Details..." required><?php echo $details; ?></textarea>
									</td>
								</tr>
								<tr>
									<td colspan="2">
										<h1 align="center">
											<u><i>Contact Information</i></u>
										</h1>
									</td>
								</tr>
								<tr>
									<td align="right">
										<label for="o_name">
											<b>Name: <span class="required">*</span></b>
										</label>
									</td>
									<td>
										<input type="text" name="o_name" id="o_name" value="<?php echo $o_name; ?>" style="width: 80%;" placeholder="Name" class="ads_input" required />
									</td>
								</tr>
								<tr>
									<td align="right">
										<label for="o_phone">
											<b>Phone: <span class="required">*</span></b>
										</label>
									</td>
									<td>
										<input type="tel" name="o_phone" pattern="[0-9]{11}" maxlength="11" style="width: 80%;" placeholder="e.g. 01*-********" class="ads_input" value="<?php echo $o_phone; ?>" required />
									</td>
								</tr>
								<tr>
									<td align="right">
										<label for="o_email">
											<b>E-mail: <span class="required">*</span></b>
										</label>
									</td>
									<td>
										<input type="email" name="o_email" id="o_email" value="<?php echo $o_email; ?>" style="width: 80%;" placeholder="E-mail" class="ads_input" required />
									</td>
								</tr>
								<tr>
									<td colspan="2" align="center">
										<a href="owner_show_ads.php"><input type="button" value="Back" class="btn basic" name="back_button" id="back_button"></a>
										<!-- <button id="back_button" class="btn basic" name="back_button">Back</button> -->
										<button type="submit" id="ads_update_button" class="btn submit" name="ads_update_button" value="<?php echo $btn_data; ?>">Update</button>
										<button id="ads_delete_button" class="btn danger" name="ads_delete_button" value="<?php echo $btn_data; ?>">Delete</button>
									</td>
								</tr>
							</table>
						</div>
					</form>
				</div>
			</div>
		</section>
	<?php } else if ($ads_type == "mess") { ?>
		<section id="ad_section">
			<div class="container">
				<div class="post_ads_information">
					<form action="owner_ads_edit.php" method="POST" enctype="multipart/form-data">
						<div>
							<h1 align="center">Update Your Mess AD</h1>
							<h3 align="center"><?php echo $successMsg; ?></h3>
							<table align="center">
								<tr>
									<td align="right">
										<label for="title">
											<b>Title: <span class="required">*</span></b>
										</label>
									</td>
									<td>
										<input type="text" name="title" id="title" value="<?php echo $title; ?>" placeholder="Title..." style="width: 80%;" class="ads_input" required />
									</td>
								</tr>

								<!-- <tr>
									<td align="right">
										<label for="photo">
											<b>Photos: <span class="required">*</span></b>
										</label>
									</td>
									<td>
										<input type="file" name="photos[]" accept="image/*" multiple class="ads_input" required />
										<span style="color: red; margin-left: 20px"><?php echo $errmsg1; ?></span>
										<span style="color: red; margin-left: 20px"><?php echo $err13; ?></span>
									</td>
								</tr>
								<tr>
									<td></td>
									<td>
										<span style="color: #0066cc; margin-left: 20px">You can upload maximum 5 photos and keep your each photo size &lt 500 KB.</span>
									</td>
								</tr> -->

								<tr>
									<td align="right">
										<label for="date">
											<b>Available From: <span class="required">*</span></b>
										</label>
									</td>
									<td>
										<input type="date" name="date" id="date" value="<?php echo $date; ?>" min="2019-09-30" max="2050-12-31" style="width: 150px;" class="ads_input" required />
									</td>
								</tr>

								<tr>
									<td align="right">
										<label for="ads_for">
											<b>ADs For: <span class="required">*</span></b>
										</label>
									</td>
									<td>
										<select name="ads_for" id="ads_for" class="ads_input" style="width: 160px; height: 32px;" required>
											<option value="" selected disabled> Select gender...</option>
											<option value="male" <?php if ($ads_for == "male") {
																																		echo "selected";
																																	} ?>>Male</option>
											<option value="female" <?php if ($ads_for == "female") {
																																				echo "selected";
																																			} ?>>Female</option>
										</select>
									</td>
								</tr>

								<tr>
									<td align="right">
										<label for="rent">
											<b>Rent: <span class="required">*</span></b>
										</label>
									</td>
									<td>
										<input type="number" name="rent" id="rent" value="<?php echo $rent; ?>" style="width: 100px;" placeholder="Rent..." class="ads_input" min="0" required />

										<input type="radio" name="rent_type" value="Fixed" checked /> Fixed
										<input type="radio" name="rent_type" value="Negotiable" <?php if ($rent_type == "Negotiable") {
																																																																				echo "checked";
																																																																			} ?> /> Negotiable
									</td>
								</tr>

								<tr>
									<td align="right" style="vertical-align: top;">
										<label for="address">
											<b>Address: <span class="required">*</span></b>
										</label>
									</td>
									<td>
										<textarea name="address" id="address" cols="80" rows="6" style="width: 80%; font-size: 16px; padding: 2px 8px;" placeholder="Address..." required><?php echo $address; ?></textarea>
									</td>
								</tr>

								<tr>
									<td align="right">
										<label for="city">
											<b>City: <span class="required">*</span></b>
										</label>
									</td>
									<td>
										<select name="city" id="city" class="ads_input" style="width: 160px; height: 32px;" required>
											<option value="" selected disabled>Select a City...</option>
											<option value="Dhaka" <?php if ($city == "Dhaka") {
																																			echo "selected";
																																		} ?>>Dhaka</option>
										</select>
									</td>
								</tr>
								<tr>
									<td align="right">
										<label for="area">
											<b>Area: <span class="required">*</span></b>
										</label>
									</td>
									<td>
										<select name="area" id="area" class="ads_input" style="width: 160px; height: 32px;" required>
											<option value="" selected disabled>Select an Area...</option>
											<?php
												while ($row = mysqli_fetch_assoc($areaResult)) { ?>
												<option value="<?php echo $row['area_name']; ?>" <?php if ($area == $row['area_name']) {
																																																																echo "selected";
																																																															} ?>>
													<?php echo $row['area_name']; ?></option>
											<?php } ?>
											<!-- <option value="Dhanmondi">Dhanmondi</option>
          <option value="Mirpur">Mirpur</option>
          <option value="Banani">Banani</option>
          <option value="Uttara">Uttara</option> -->
										</select>
									</td>
								</tr>

								<tr>
									<td align="right" style="vertical-align: top;">
										<label for="details">
											<b>Details: <span class="required">*</span></b>
										</label>
									</td>
									<td>
										<textarea name="details" id="details" cols="80" rows="6" style="width: 80%; font-size: 16px; padding: 2px 8px;" placeholder="Details..." required><?php echo $details; ?></textarea>
									</td>
								</tr>
								<tr>
									<td colspan="2">
										<h1 align="center">
											<u><i>Contact Information</i></u>
										</h1>
									</td>
								</tr>
								<tr>
									<td align="right">
										<label for="o_name">
											<b>Name: <span class="required">*</span></b>
										</label>
									</td>
									<td>
										<input type="text" name="o_name" id="o_name" value="<?php echo $o_name; ?>" style="width: 80%;" placeholder="Name" class="ads_input" required />
									</td>
								</tr>
								<tr>
									<td align="right">
										<label for="o_phone">
											<b>Phone: <span class="required">*</span></b>
										</label>
									</td>
									<td>
										<input type="tel" name="o_phone" pattern="[0-9]{11}" value="<?php echo $o_phone; ?>" maxlength="11" style="width: 80%;" placeholder="e.g. 01*-********" class="ads_input" required />
									</td>
								</tr>
								<tr>
									<td align="right">
										<label for="o_email">
											<b>E-mail: <span class="required">*</span></b>
										</label>
									</td>
									<td>
										<input type="email" name="o_email" id="o_email" value="<?php echo $o_email; ?>" style="width: 80%;" placeholder="E-mail" class="ads_input" required />
									</td>
								</tr>
								<tr>
									<td colspan="2" align="center">
										<a href="owner_show_ads.php"><input type="button" value="Back" class="btn basic" name="back_button" id="back_button"></a>
										<!-- <button id="back_button" class="btn basic" name="back_button">Back</button> -->
										<button type="submit" id="ads_update_button" class="btn submit" name="ads_update_button" value="<?php echo $btn_data; ?>">Update</button>
										<button id="ads_delete_button" class="btn danger" name="ads_delete_button" value="<?php echo $btn_data; ?>">Delete</button>
									</td>
								</tr>
							</table>
						</div>
					</form>
				</div>
			</div>
		</section>
	<?php
	} else if ($ads_type == "sublet") { ?>
		<section id="ad_section">
			<div class="container">
				<div class="post_ads_information">
					<form action="owner_ads_edit.php" method="POST">
						<div>
							<h1 align="center">Update Your Sublet AD</h1>
							<h3 align="center"><?php echo $successMsg; ?></h3>
							<table align="center">
								<tr>
									<td align="right">
										<label for="title">
											<b>Title: <span class="required">*</span></b>
										</label>
									</td>
									<td>
										<input type="text" name="title" id="title" value="<?php echo $title; ?>" placeholder="Title..." style="width: 80%;" class="ads_input" required />
									</td>
								</tr>

								<tr>
									<td align="right">
										<label for="date">
											<b>Available From: <span class="required">*</span></b>
										</label>
									</td>
									<td>
										<input type="date" name="date" id="date" min="2019-09-30" max="2050-12-31" style="width: 150px;" class="ads_input calendarDate" value="<?php echo $date; ?>" required />
									</td>
								</tr>

								<tr>
									<td align="right">
										<label for="ads_for">
											<b>ADs For: <span class="required">*</span></b>
										</label>
									</td>
									<td>
										<select name="ads_for" id="ads_for" class="ads_input" style="width: 160px; height: 32px;" required>
											<option value="" selected disabled> Select gender...</option>
											<option value="male" <?php if ($ads_for == "male") {
																																		echo "selected";
																																	} ?>>Male</option>
											<option value="female" <?php if ($ads_for == "female") {
																																				echo "selected";
																																			} ?>>Female</option>
										</select>
									</td>
								</tr>
								<tr>
									<td align="right">
										<label for="sfacility">
											<b>Special Facility: </b>
										</label>
									</td>
									<td>
										<input type="checkbox" name="lift" value="Lift" <?php if ($lift == "Lift") {
																																																												echo "checked";
																																																											} ?> /> Lift
										<input type="checkbox" name="generator" value="Generator" <?php if ($generator == "Generator") {
																																																																						echo "checked";
																																																																					} ?> /> Generator
										<input type="checkbox" name="wifi" value="Wi-Fi" <?php if ($wifi == "Wi-Fi") {
																																																													echo "checked";
																																																												} ?> /> Wi-Fi
									</td>
								</tr>

								<tr>
									<td align="right">
										<label for="rent">
											<b>Rent: <span class="required">*</span></b>
										</label>
									</td>
									<td>
										<input type="number" name="rent" id="rent" value="<?php echo $rent; ?>" style="width: 100px;" placeholder="Rent..." class="ads_input" min="0" required />
										<input type="radio" name="rent_type" value="Fixed" checked />
										Fixed
										<input type="radio" name="rent_type" value="Negotiable" <?php if ($rent_type == "Negotiable") {
																																																																				echo "checked";
																																																																			} ?> />
										Negotiable
									</td>
								</tr>

								<tr>
									<td align="right" style="vertical-align: top;">
										<label for="address">
											<b>Address: <span class="required">*</span></b>
										</label>
									</td>
									<td>
										<textarea name="address" id="address" cols="80" rows="6" style="width: 80%; font-size: 16px; padding: 2px 8px;" placeholder="Address..." required><?php echo $address; ?></textarea>
									</td>
								</tr>

								<tr>
									<td align="right">
										<label for="city">
											<b>City: <span class="required">*</span></b>
										</label>
									</td>
									<td>
										<select name="city" id="city" class="ads_input" style="width: 160px; height: 32px;" required>
											<option value="" selected disabled> Select a City...</option>
											<option value="Dhaka" <?php if ($city == "Dhaka") {
																																			echo "selected";
																																		} ?>>Dhaka</option>
										</select>
									</td>
								</tr>
								<tr>
									<td align="right">
										<label for="area">
											<b>Area: <span class="required">*</span></b>
										</label>
									</td>
									<td>
										<select name="area" id="area" class="ads_input" style="width: 160px; height: 32px;" required>
											<option value="" selected disabled> Select an Area...</option>
											<?php
												while ($row = mysqli_fetch_assoc($areaResult)) { ?>
												<option value="<?php echo $row['area_name']; ?>" <?php if ($area == $row['area_name']) {
																																																																echo "selected";
																																																															} ?>>
													<?php echo $row['area_name']; ?></option>
											<?php } ?>
										</select>
									</td>
								</tr>

								<tr>
									<td align="right" style="vertical-align: top;">
										<label for="details">
											<b>Details: <span class="required">*</span></b>
										</label>
									</td>
									<td>
										<textarea name="details" id="details" cols="80" rows="6" style="width: 80%; font-size: 16px; padding: 2px 8px;" placeholder="Details..." required><?php echo $details; ?></textarea>
									</td>
								</tr>
								<tr>
									<td colspan="2">
										<h1 align="center">
											<u><i>Contact Information</i></u>
										</h1>
									</td>
								</tr>
								<tr>
									<td align="right">
										<label for="o_name">
											<b>Name: <span class="required">*</span></b>
										</label>
									</td>
									<td>
										<input type="text" name="o_name" id="o_name" value="<?php echo $o_name; ?>" style="width: 80%;" placeholder="Name" class="ads_input" required />
									</td>
								</tr>
								<tr>
									<td align="right">
										<label for="o_phone">
											<b>Phone: <span class="required">*</span></b>
										</label>
									</td>
									<td>
										<input type="tel" name="o_phone" pattern="[0-9]{11}" maxlength="11" style="width: 80%;" placeholder="e.g. 01*-********" class="ads_input" value="<?php echo $o_phone; ?>" required />
									</td>
								</tr>
								<tr>
									<td align="right">
										<label for="o_email">
											<b>E-mail: <span class="required">*</span></b>
										</label>
									</td>
									<td>
										<input type="email" name="o_email" id="o_email" value="<?php echo $o_email; ?>" style="width: 80%;" placeholder="E-mail" class="ads_input" required />
									</td>
								</tr>
								<tr>
									<td colspan="2" align="center">
										<a href="owner_show_ads.php"><input type="button" value="Back" class="btn basic" name="back_button" id="back_button"></a>
										<!-- <button id="back_button" class="btn basic" name="back_button">Back</button> -->
										<button type="submit" id="ads_update_button" class="btn submit" name="ads_update_button" value="<?php echo $btn_data; ?>">Update</button>
										<button id="ads_delete_button" class="btn danger" name="ads_delete_button" value="<?php echo $btn_data; ?>">Delete</button>
									</td>
								</tr>
							</table>
						</div>
					</form>
				</div>
			</div>
		</section>
	<?php
	}
	?>

	<?php echo footer(); ?>
</body>

</html>