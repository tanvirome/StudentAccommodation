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
$user_name = $_SESSION["name"];
// $_SESSION['username'] = $username;

$user_full_name = $user_email = $user_phone = $user_nid = $user_status = $user_address = $user_gender = $user_dob = $user_religion = $student_id = $institute = "";

$sqlUserCheck = "SELECT * FROM student WHERE username = '$username'";
$result = mysqli_query($conn, $sqlUserCheck);
// $rowCount = mysqli_num_rows($result);

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
	<title>Profile</title>
</head>

<body>
	<?php echo after_login_student_header("dashboard"); ?>

	<section id="profile_section">
		<div class="container">
			<div class="side_navigation">
				<h4><strong>Dashboard</strong></h4>
				<nav>
					<ul>
						<li class="current" id="profile_li">
							<a href="student_profile.php" id="profile_a">Profile</a>
						</li>
						<li id="security_li">
							<a href="student_security.php" id="security_a">Security</a>
						</li>
						<li id="information_li">
							<a href="student_edit_information.php" id="information_a">Edit Information</a>
						</li>
					</ul>
				</nav>
			</div>

			<div class="show_profile">
				<table>
					<tr>
						<td class="label">
							<label>Name :</label>
						</td>
						<td class="profile_show_info">
							<label><?php echo $user_full_name ?></label>
						</td>
					</tr>
					<tr>
						<td class="label">
							<label>Userame :</label>
						</td>
						<td class="profile_show_info1">
							<label><?php echo $username ?></label>
						</td>
					</tr>
					<tr>
						<td class="label">
							<label>E-mail :</label>
						</td>
						<td class="profile_show_info1">
							<label><?php echo $user_email ?></label>
						</td>
					</tr>
					<tr>
						<td class="label">
							<label>Phone :</label>
						</td>
						<td class="profile_show_info">
							<label><?php echo $user_phone ?></label>
						</td>
					</tr>
					<tr>
						<td class="label">
							<label>Institute :</label>
						</td>
						<td class="profile_show_info">
							<label><?php echo $institute ?></label>
						</td>
					</tr>
					<tr>
						<td class="label">
							<label>Student ID :</label>
						</td>
						<td class="profile_show_info">
							<label><?php echo $student_id ?></label>
						</td>
					</tr>
					<tr>
						<td class="label">
							<label>NID :</label>
						</td>
						<td class="profile_show_info">
							<label><?php echo $user_nid ?></label>
						</td>
					</tr>
					<tr>
						<td class="label">
							<label>Status :</label>
						</td>
						<td class="profile_show_info">
							<label><?php echo $user_status ?></label>
						</td>
					</tr>
					<tr>
						<td class="label">
							<label>Address :</label>
						</td>
						<td class="profile_show_info">
							<label>
								<?php echo $user_address ?>
							</label>
						</td>
					</tr>
					<tr>
						<td class="label">
							<label>Gender :</label>
						</td>
						<td class="profile_show_info">
							<label><?php echo $user_gender ?></label>
						</td>
					</tr>
					<tr>
						<td class="label">
							<label>DOB :</label>
						</td>
						<td class="profile_show_info">
							<label><?php echo $user_dob ?></label>
						</td>
					</tr>
					<tr>
						<td class="label">
							<label>Religion :</label>
						</td>
						<td class="profile_show_info">
							<label><?php echo $user_religion ?></label>
						</td>
					</tr>
					<!-- <tr>
       <td class="label">
        <label>Nationality :</label>
       </td>
       <td class="profile_show_info">
        <label>Bangladesh</label>
       </td>
      </tr> -->
				</table>
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

	<!-- <script src="../JavaScript/header.js"></script> -->
</body>

</html>