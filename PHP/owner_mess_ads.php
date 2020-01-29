<?php

include "../includes/db_connect.inc.php";
include "../includes/header.inc.php";
include "../includes/footer.inc.php";
include "../includes/unverified_modal.inc.php";

session_start();

if (!isset($_SESSION["username"])) {
	header("Location: index.php");
}

$username = $_SESSION["username"];
$user_id = $_SESSION["user_id"];

$sql = "SELECT * FROM area;";
$areaResult = mysqli_query($conn, $sql);

$user_status = "";

$sql = "SELECT status FROM owner WHERE username = '$username';";
$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_assoc($result)) {
	$user_status = $row['status'];
}


if ($user_status == "unverified") {
	echo unverified_modal("owner_mess_ads.php");
	// header("Location: owner_homepage.php");
}

// $_SESSION['username'] = $username;

// Variable for fetch data
// $size = $bedroom = $corridor = $bathroom = $special_facility = $lift = $generator = $wifi = 

$title = $photo = $date = $ads_for = $rent = $rent_type = $address = $city = $area = $details = $o_name = $o_phone = $o_email = $file = "";
$flag = 0;
// variable for store DB data

$imageLinkToDB = "";

// $usernameInDB = $user_emailInDB = $usernameInDB1 = $user_emailInDB1 = "";

// variable for error

$err1 = $err2 = $err3 = $err4 = $err5 = $err6 = $err7 = $err8 = $err9 = $err10 = $err11 = $err12 = $err13 = "";

$errmsg1 = "";

$sqlUserCheck = "SELECT email, name, phone FROM owner WHERE username = '$username'";
$result = mysqli_query($conn, $sqlUserCheck);

while ($row = mysqli_fetch_assoc($result)) {
	$o_email = $row['email'];
	$o_name = $row['name'];
	$o_phone = $row['phone'];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

	if (isset($_POST['okay_btn'])) {
		header("Location: owner_homepage.php");
	}

	if (isset($_POST['ads_post_button'])) {
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

		// if (!empty($_POST['size'])) {
		//  $size = mysqli_real_escape_string($conn, $_POST['size']);
		// } else {
		//  $err5 = "This field can't be empty";
		// }

		// if (!empty($_POST['bedroom'])) {
		//  $bedroom = mysqli_real_escape_string($conn, $_POST['bedroom']);
		// } else {
		//  $err6 = "This field can't be empty";
		// }

		// if (!empty($_POST['corridor'])) {
		//  $corridor = mysqli_real_escape_string($conn, $_POST['corridor']);
		// } else {
		//  $err7 = "This field can't be empty";
		// }

		// if (!empty($_POST['bathroom'])) {
		//  $bathroom = mysqli_real_escape_string($conn, $_POST['bathroom']);
		// } else {
		//  $err8 = "This field can't be empty";
		// }

		if (!empty($_POST['rent'])) {
			$rent = mysqli_real_escape_string($conn, $_POST['rent']);
		} else {
			$err5 = "This field can't be empty";
		}

		if (!empty($_POST['rent_type'])) {
			$rent_type = mysqli_real_escape_string($conn, $_POST['rent_type']);
		}

		if (!empty($_POST['address'])) {
			$address = $_POST['address'];
			// $address = mysqli_real_escape_string($conn, $_POST['address']);
		} else {
			$err6 = "This field can't be empty";
		}

		if (!empty($_POST['city'])) {
			$city = mysqli_real_escape_string($conn, $_POST['city']);
		} else {
			$err7 = "This field can't be empty";
		}

		if (!empty($_POST['area'])) {
			$area = mysqli_real_escape_string($conn, $_POST['area']);
		} else {
			$err8 = "This field can't be empty";
		}

		if (!empty($_POST['details'])) {
			$details = $_POST['details'];
			// $details = mysqli_real_escape_string($conn, $_POST['details']);
		} else {
			$err9 = "This field can't be empty";
		}

		if (!empty($_POST['o_name'])) {
			$o_name = mysqli_real_escape_string($conn, $_POST['o_name']);
		} else {
			$err10 = "This field can't be empty";
		}

		if (!empty($_POST['o_phone'])) {
			$o_phone = mysqli_real_escape_string($conn, $_POST['o_phone']);
		} else {
			$err11 = "This field can't be empty";
		}

		if (!empty($_POST['o_email'])) {
			$o_email = mysqli_real_escape_string($conn, $_POST['o_email']);
		} else {
			$err12 = "This field can't be empty";
		}

		// if (!empty($_POST['lift'])) {
		//  $lift = $_POST['lift'];
		//  if ($special_facility == "") {
		//   $special_facility = $_POST['lift'];
		//  } else {
		//   $special_facility = $special_facility . ", " . $_POST['lift'];
		//  }
		// }

		// if (!empty($_POST['generator'])) {
		//  $generator = $_POST['generator'];
		//  if ($special_facility == "") {
		//   $special_facility = $_POST['generator'];
		//  } else {
		//   $special_facility = $special_facility . ", " . $_POST['generator'];
		//  }
		// }

		// if (!empty($_POST['wifi'])) {
		//  $wifi = $_POST['wifi'];
		//  if ($special_facility == "") {
		//   $special_facility = $_POST['wifi'];
		//  } else {
		//   $special_facility = $special_facility . ", " . $_POST['wifi'];
		//  }
		// }



		if (!empty($_FILES['photos']['name'][0])) {
			if (count($_FILES['photos']['name']) > 5) {
				$err13 = "You are allowed to upload maximum 5 photos.";
			} else {
				$file = $_FILES['photos'];
				// $flag = 0;
				// $file = $_FILES['photos'];

				$allowed = array('jpg', 'jpeg', 'png');

				foreach ($file['name'] as $position => $fileName) {
					$fileTmpName = $file['tmp_name'][$position];
					$fileSize = $file['size'][$position];
					$fileError = $file['error'][$position];

					$fileExt = explode('.', $fileName);
					$fileActualExt = strtolower(end($fileExt));

					if (in_array($fileActualExt, $allowed)) {
						if ($fileError === 0) {
							if ($fileSize <= 500000) {
								// 500000 = 500KB
								$flag = 0;
							} else {
								// echo "Your file is too big";
								$flag = 1;
								break;
							}
						} else {
							// echo "There was an error uploading your file";
							$flag = 1;
							break;
						}
					} else {
						// echo "you can not upload this type file";
						$flag = 1;
						break;
					}
				}
			}
		} else {
			$err2 = "This field can't be empty";
		}

		if ($err1 == "" && $err2 == "" && $err3 == "" && $err4 == "" && $err5 == "" && $err6 == "" && $err7 == "" && $err8 == "" && $err9 == "" && $err10 == "" && $err11 == "" && $err12 == "" && $err13 == "") {

			if ($flag == 1) {
				$errmsg1 = "Please keep your each file size < 500KB";
			} else {
				$sql = "INSERT INTO mess (title, date, ads_gender, rent, rent_type, address, city, area, details, owner_username, owner_user_id, owner_name, owner_phone, owner_email) VALUES ('$title','$date', '$ads_for', '$rent', '$rent_type', '$address', '$city', '$area', '$details', '$username', '$user_id', '$o_name', '$o_phone', '$o_email');";

				if (mysqli_query($conn, $sql)) {
					$last_id = mysqli_insert_id($conn);

					$folderPath = "../images/Ad_images/owner/" . $user_id . "/mess/";
					$folderPath1 = $folderPath . $last_id;
					mkdir($folderPath1, 0777);

					foreach ($file['name'] as $position => $fileName) {
						$fileTmpName = $file['tmp_name'][$position];

						$fileExt = explode('.', $fileName);
						$fileActualExt = strtolower(end($fileExt));

						$fileNameNew = "image" . $position . "." . $fileActualExt;

						$fileDestination = $folderPath1 . '/' . $fileNameNew;

						move_uploaded_file($fileTmpName, $fileDestination);

						if ($imageLinkToDB == "") {
							$imageLinkToDB = $fileDestination;
						} else {
							$imageLinkToDB = $imageLinkToDB . "," . $fileDestination;
						}
					}

					$sql = "UPDATE mess SET photo='$imageLinkToDB' WHERE ads_id = '$last_id';";

					mysqli_query($conn, $sql);

					$ads_type = "mess";
					$status = "unverified";

					$sql = "INSERT INTO all_ads (ads_id, ads_type, title, ads_gender, rent, rent_type, area, photo, status, owner_username, owner_user_id) VALUES ('$last_id', '$ads_type', '$title', '$ads_for', '$rent','$rent_type', '$area', '$imageLinkToDB', '$status', '$username', '$user_id');";

					mysqli_query($conn, $sql);

					$details_btn_data = $last_id . "," . $ads_type;
					$_SESSION['details_btn'] = $details_btn_data;
					header("location: owner_show_ads_details.php");
				} else {
					echo "Error: " . $sql . "<br>" . mysqli_error($conn);
				}
			}
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
	<title>Mess Ads</title>
</head>

<body>
	<?php echo after_login_owner_header("postads"); ?>

	<section id="ad_section">
		<div class="container">
			<div class="post_ads_information">
				<form action="owner_mess_ads.php" method="POST" enctype="multipart/form-data">
					<div>
						<h1 align="center">Post Your Mess AD</h1>
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
							</tr>

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
									<button type="submit" id="ads_post_button" name="ads_post_button">Post AD</button>
								</td>
							</tr>
						</table>
					</div>
				</form>
			</div>
		</div>
	</section>

	<?php echo footer(); ?>

	<!-- <script src="../JavaScript/header.js"></script> -->

	<script src="../JavaScript/unverified_modal.js"></script>
</body>

</html>