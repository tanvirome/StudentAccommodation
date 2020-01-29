<?php

include "../includes/db_connect.inc.php";
include "../includes/header.inc.php";
include "../includes/footer.inc.php";

session_start();

if (!isset($_SESSION["username"])) {
	header("Location: index.php");
}

$username = $_SESSION["username"];
$user_id = $_SESSION["user_id"];
// $_SESSION['username'] = $username;

// Variable for showing data

$user_full_name = $user_email = $user_phone = $user_nid = $user_status = $user_address = $user_gender = $user_dob = $user_religion = $student_id = $institute = $user_password = "";

// variable for store DB data

$usernameInDB = $user_emailInDB = $usernameInDB1 = $user_emailInDB1 = $user_passwordInDB = "";

// variable for error

$err1 = $err2 = $err3 = "";
$errmsg1 = $errmsg2 = $errmsg3 = "";

$successmsg1 = $successmsg2 = $successmsg3 = "";

// details variable
$username_details = $email_details = $information_details = $delete_details = "";

$sqlUserCheck = "SELECT * FROM student WHERE username = '$username'";
$result = mysqli_query($conn, $sqlUserCheck);
$rowCount = mysqli_num_rows($result);

while ($row = mysqli_fetch_assoc($result)) {
	$user_email = $row['email'];
	$user_full_name = $row['name'];
	$user_phone = $row['phone'];
	$user_nid = $row['nid'];
	$user_gender = $row['gender'];
	$user_dob = $row['date_of_birth'];
	$user_religion = $row['religion'];
	$user_address = $row['address'];
	$user_status = $row['status'];
	$student_id = $row['student_id'];
	$institute = $row['institute'];
}

$sql = "SELECT * FROM institution;";
$institutionResult = mysqli_query($conn, $sql);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

	if (isset($_POST['update_username_button'])) {
		$username_details = "open";
		if (!empty($_POST['username'])) {
			$username = mysqli_real_escape_string($conn, $_POST['username']);
		} else {
			$err1 = "This field can't be empty";
		}

		if ($err1 == "") {
			$sqlUserCheck = "SELECT username FROM student WHERE username = '$username' and state = 'active';";
			$sqlUserCheck1 = "SELECT username FROM owner WHERE username = '$username' and state = 'active';";

			$result = mysqli_query($conn, $sqlUserCheck);
			$result1 = mysqli_query($conn, $sqlUserCheck1);

			while ($row = mysqli_fetch_assoc($result)) {
				$usernameInDB = $row['username'];
			}
			while ($row = mysqli_fetch_assoc($result1)) {
				$usernameInDB1 = $row['username'];
			}

			if ($usernameInDB == $username || $usernameInDB1 == $username) {
				$errmsg1 = "Username already exist!";
			} else {
				$sql = "UPDATE student SET username='$username', status='unverified' WHERE user_id = '$user_id';";

				mysqli_query($conn, $sql);
				$_SESSION['username'] = $username;
				$_SESSION['user_id'] = $user_id;
				$successmsg1 = "username update successfully.";
			}
		}
	}

	if (isset($_POST['update_email_button'])) {
		$email_details = "open";
		if (!empty($_POST['user_email'])) {
			$user_email = mysqli_real_escape_string($conn, $_POST['user_email']);
		} else {
			$err2 = "This field can't be empty";
		}

		if ($err2 == "") {
			$sqlUserCheck1 = "SELECT email FROM owner WHERE email = '$user_email' and state = 'active';";
			$sqlUserCheck = "SELECT email FROM student WHERE email = '$user_email' and state = 'active';";

			$result = mysqli_query($conn, $sqlUserCheck);
			$result1 = mysqli_query($conn, $sqlUserCheck1);

			while ($row = mysqli_fetch_assoc($result)) {
				$user_emailInDB = $row['email'];
			}
			while ($row = mysqli_fetch_assoc($result1)) {
				$user_emailInDB1 = $row['email'];
			}

			if ($user_emailInDB == $user_email || $user_emailInDB1 == $user_email) {
				$errmsg2 = "email already exist!";
			} else {
				$sql = "UPDATE student SET email='$user_email', status='unverified' WHERE user_id = '$user_id';";

				mysqli_query($conn, $sql);
				$_SESSION['username'] = $username;
				$_SESSION['user_id'] = $user_id;
				$successmsg2 = "email update successfully.";
			}
		}
	}

	if (isset($_POST['update_info_button'])) {
		$information_details = "open";
		if (!empty($_POST['user_name'])) {
			$user_full_name = mysqli_real_escape_string($conn, $_POST['user_name']);
		}

		if (!empty($_POST['user_phone'])) {
			$user_phone = mysqli_real_escape_string($conn, $_POST['user_phone']);
		}

		if (!empty($_POST['user_sid'])) {
			$student_id = mysqli_real_escape_string($conn, $_POST['user_sid']);
		}

		if (!empty($_POST['user_institute'])) {
			$institute = mysqli_real_escape_string($conn, $_POST['user_institute']);
		}

		if (!empty($_POST['user_nid'])) {
			$user_nid = mysqli_real_escape_string($conn, $_POST['user_nid']);
		}

		if (!empty($_POST['user_address'])) {
			$user_address = $_POST['user_address'];
			// $user_address = mysqli_real_escape_string($conn, $_POST['user_address']);
		}

		if (!empty($_POST['user_gender'])) {
			$user_gender = mysqli_real_escape_string($conn, $_POST['user_gender']);
		}

		if (!empty($_POST['user_dob'])) {
			$user_dob = mysqli_real_escape_string($conn, $_POST['user_dob']);
		}

		if (!empty($_POST['user_religion'])) {
			$user_religion = mysqli_real_escape_string($conn, $_POST['user_religion']);
		}

		$sql = "UPDATE student SET name='$user_full_name', religion='$user_religion', phone='$user_phone', student_id='$student_id', institute='$institute', nid='$user_nid', address='$user_address', gender='$user_gender', date_of_birth='$user_dob', status='unverified' WHERE username = '$username';";

		mysqli_query($conn, $sql);
		$_SESSION['username'] = $username;
		$_SESSION['user_id'] = $user_id;
		$_SESSION['name'] = $user_full_name;
		$successmsg3 = "information update successfully.";
	}

	if (isset($_POST['delete_btn'])) {
		$delete_details = "open";
		if (!empty($_POST['user_password'])) {
			$user_password = mysqli_real_escape_string($conn, $_POST['user_password']);
		} else {
			$err3 = "This field can't be empty";
		}
		if ($err3 == "") {
			$sqlUserCheck = "SELECT password FROM student WHERE username = '$username';";
			$result = mysqli_query($conn, $sqlUserCheck);
			while ($row = mysqli_fetch_assoc($result)) {
				$user_passwordInDB = $row['password'];
			}
			if (password_verify($user_password, $user_passwordInDB)) {
				$sql = "UPDATE student SET state='deactive', status='unverified' WHERE username = '$username';";

				mysqli_query($conn, $sql);
				header("location: logout.php");
			} else {
				$errmsg3 = "Wrong Password!!!";
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
	<title>Edit Information</title>
</head>

<body>
	<?php echo after_login_student_header("dashboard"); ?>

	<section id="edit_information_section">
		<div class="container">
			<div class="side_navigation">
				<h4><strong>Dashboard</strong></h4>
				<nav>
					<ul>
						<li id="profile_li">
							<a href="student_profile.php" id="profile_a">Profile</a>
						</li>
						<li id="security_li">
							<a href="student_security.php" id="security_a">Security</a>
						</li>
						<li class="current" id="information_li">
							<a href="student_edit_information.php" id="information_a">Edit Information</a>
						</li>
					</ul>
				</nav>
			</div>

			<div class="edit_information">
				<fieldset>
					<details id="details1" onclick="details1()" <?php echo $username_details ?>>
						<summary>Change Username</summary>
						<span style="margin: 15px 0 15px 20px; color: #33cc33;"><?php echo $successmsg1; ?></span>
						<form action="" method="POST">
							<table>
								<tr>
									<td class="label">
										<label>Userame : </label>
									</td>
									<td>
										<input type="text" name="username" id="username" placeholder="Username" value="<?php echo $username ?>" class="edit_info_input" required />
										<br />
										<span style="color:red;"><?php echo $errmsg1; ?></span>
										<span style="color:red;"><?php echo $err1; ?></span>
									</td>
								</tr>
								<tr>
									<td colspan="2" align="center">
										<button type="submit" id="update_username_button" name="update_username_button" class="update_info_button">
											Update
										</button>
									</td>
								</tr>
							</table>
						</form>
					</details>
				</fieldset>

				<fieldset>
					<details id="details2" onclick="details2()" <?php echo $email_details ?>>
						<summary>Change E-mail</summary>
						<span style="margin: 15px 0 15px 20px; color: #33cc33;"><?php echo $successmsg2; ?></span>

						<form action="" method="POST">
							<table>
								<tr>
									<td class="label">
										<label>E-mail : </label>
									</td>
									<td>
										<input type="email" name="user_email" id="user_email" placeholder="E-mail" value="<?php echo $user_email ?>" class="edit_info_input" required />
										<br />
										<span style="color:red;"><?php echo $errmsg2; ?></span>
										<span style="color:red;"><?php echo $err2; ?></span>
									</td>
								</tr>
								<tr>
									<td colspan="2" align="center">
										<button type="submit" id="update_email_button" name="update_email_button" class="update_info_button">
											Update
										</button>
									</td>
								</tr>
							</table>
						</form>
					</details>
				</fieldset>

				<fieldset>
					<details id="details3" onclick="details3()" <?php echo $information_details ?>>
						<summary>General Information</summary>
						<span style="margin: 15px 0 15px 20px; color: #33cc33;"><?php echo $successmsg3; ?></span>
						<form action="student_edit_information.php" method="POST">
							<table>
								<tr>
									<td class="label">
										<label>Name : </label>
									</td>
									<td>
										<input type="text" name="user_name" id="user_name" placeholder="Name" value="<?php echo $user_full_name ?>" class="edit_info_input" />
									</td>
								</tr>

								<tr>
									<td class="label">
										<label>Phone : </label>
									</td>
									<td>
										<input type="tel" pattern="[0-9]{11}" maxlength="11" name="user_phone" id="user_phone" placeholder="e.g. 01*-********" value="<?php echo $user_phone ?>" class="edit_info_input" />
									</td>
								</tr>

								<tr>
									<td class="label">
										<label>Institute : </label>
									</td>
									<td>
										<select name="user_institute" id="user_institute" class="edit_info_input" required>
											<option value="" disabled selected>
												Select Institute Name</option>
											<?php
											while ($row = mysqli_fetch_assoc($institutionResult)) { ?>
												<option value="<?php echo $row['institute_name']; ?>" <?php if ($institute == $row['institute_name']) {
																																																																			echo "selected";
																																																																		} ?>>
													<?php echo $row['institute_name']; ?></option>
											<?php } ?>

										</select>
									</td>
								</tr>
								<tr>
									<td class="label">
										<label>Student ID : </label>
									</td>
									<td class="profile_show_info">
										<input type="text" name="user_sid" id="user_sid" placeholder="Student ID" value="<?php echo $student_id; ?>" class="edit_info_input" required />
									</td>
								</tr>

								<tr>
									<td class="label">
										<label>NID : </label>
									</td>
									<td>
										<input type="number" name="user_nid" id="user_nid" placeholder="National ID" value="<?php echo $user_nid ?>" class="edit_info_input" />
									</td>
								</tr>
								<tr>
									<td class="label" style="vertical-align: top;">
										<label>Address : </label>
									</td>
									<td>
										<textarea name="user_address" id="user_address" cols="40" rows="7" placeholder="Address" style="font-size: 16px;"><?php echo $user_address ?></textarea>
									</td>
								</tr>
								<tr>
									<td class="label">
										<label>Gender : </label>
									</td>
									<td>
										<select name="user_gender" id="user_gender" class="edit_info_input1">
											<option value="male" <?Php if ($user_gender == "male") { ?> selected <?php } ?>>Male </option>
											<option value="female" <?Php if ($user_gender == "female") { ?> selected <?php } ?>> Female</option>
										</select>
									</td>
								</tr>
								<tr>
									<td class="label">
										<label>DOB : </label>
									</td>
									<td>
										<input type="date" name="user_dob" id="user_dob" max="2050-12-31" value="<?php echo $user_dob ?>" class="edit_info_input1" />
									</td>
								</tr>
								<tr>
									<td class="label">
										<label>Religion : </label>
									</td>
									<td>
										<select name="user_religion" id="user_religion " class="edit_info_input1">
											<option value="islam" <?Php if ($user_religion == "islam") { ?> selected <?php } ?>>Islam </option>
											<option value="hindu" <?Php if ($user_religion == "hindu") { ?> selected <?php } ?>>Hindu </option>
											<option value="buddhist" <?Php if ($user_religion == "buddhist") { ?> selected <?php } ?>> Buddhist</option>
										</select>
									</td>
								</tr>
								<tr>
									<td colspan="2" align="center">
										<button type="submit" id="update_info_button" name="update_info_button" class="update_info_button">
											Update
										</button>
									</td>
								</tr>
							</table>
						</form>
					</details>
				</fieldset>

				<fieldset>
					<details id="details4" onclick="details4()" <?php echo $delete_details ?>>
						<summary id="delete_summary">Delete Your Account</summary>
						<span style="color:red;"><?php echo $errmsg3; ?></span>
						<!-- <input type="radio" name="delete_radio" id="delete_radio" value="delete" /> -->
						<!-- <strong>Permanently Delete Account</strong> -->
						<div class="delete_account">
							<strong>Deleting your account is permanent.</strong>
							<p>
								When you delete your account, you won't be able to retrieve
								the content or information you've shared.
							</p>
							<!-- Button to Open the Modal -->
							<button type="button" class="btn continue_btn" id="modalBtn">
								Continue
							</button>

							<!-- The Modal -->
							<div class="modal fade" id="myModal">
								<div class="modal-dialog">
									<div class="modal-content">
										<!-- Modal Header -->
										<div class="modal-header">
											<span class="modal-title">Delete Account</span>
											<button type="button" class="close">
												&times;
											</button>
										</div>

										<!-- Modal body -->
										<form action="student_edit_information.php" method="POST">
											<div class="modal-body">
												<p><b>Verify your password</b></p>
												<input type="password" name="user_password" placeholder="Password" id="user_password" class="user_password" />
												<br>
												<span style="color:red;"><?php echo $err3; ?></span>
											</div>

											<!-- Modal footer -->
											<div class="modal-footer">
												<button type="button" class="btn cancel_btn cancel">
													Cancel
												</button>
												<button type="submit" class="btn delete_btn" name="delete_btn" id="delete_btn">
													Delete
												</button>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</details>
				</fieldset>
			</div>
		</div>
	</section>

	<?php echo footer(); ?>

	<script>
		var profile_li = document.getElementById("profile_li");
		var profile_a = document.getElementById("profile_a");
		var security_li = document.getElementById("security_li");
		var security_a = document.getElementById("security_a");
		var information_li = document.getElementById("information_li");
		var information_a = document.getElementById("information_a");

		profile_li.addEventListener("click", function() {
			profile_a.click();
		});
		security_li.addEventListener("click", function() {
			security_a.click();
		});
		information_li.addEventListener("click", function() {
			information_a.click();
		});
	</script>

	<script src="../JavaScript/edit_information.js"></script>
	<!-- <script src="../JavaScript/header.js"></script> -->
</body>

</html>