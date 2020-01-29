<?php

include "../includes/db_connect.inc.php";
include "../includes/header.inc.php";
include "../includes/footer.inc.php";

session_start();

if (isset($_SESSION["username"])) {
	$type = $_SESSION["user_type"];
	if ($type == "owner") {
		header("Location: owner_homepage.php");
	} else if ($type == "student") {
		header("Location: student_homepage.php");
	}
}

$user_type = $user_full_name = $username = $user_email = $user_password = $confirm_user_password = $usernameInDB = $user_emailInDB = $usernameInDB1 = $user_emailInDB1 = "";

$errmsg1 = $errmsg2 = $errmsg3 = $errmsg4 = "";
$err1 = $err2 = $err3 = $err4 = $err5 = $err6 = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

	if (!empty($_POST['user_type'])) {
		$user_type = mysqli_real_escape_string($conn, $_POST['user_type']);
	} else {
		$err1 = "This field can't be empty";
	}

	if (!empty($_POST['user_full_name'])) {
		$user_full_name = mysqli_real_escape_string($conn, $_POST['user_full_name']);
	} else {
		$err2 = "This field can't be empty";
	}

	if (!empty($_POST['username'])) {
		$username = mysqli_real_escape_string($conn, $_POST['username']);
	} else {
		$err3 = "This field can't be empty";
	}

	if (!empty($_POST['user_email'])) {
		$user_email = mysqli_real_escape_string($conn, $_POST['user_email']);
	} else {
		$err4 = "This field can't be empty";
	}

	if (!empty($_POST['user_password'])) {
		$user_password = mysqli_real_escape_string($conn, $_POST['user_password']);
	} else {
		$err5 = "This field can't be empty";
	}

	if (!empty($_POST['confirm_user_password'])) {
		$confirm_user_password = mysqli_real_escape_string($conn, $_POST['confirm_user_password']);
	} else {
		$err6 = "This field can't be empty";
	}

	$sqlUserCheck = "SELECT username FROM owner WHERE username = '$username';";
	$sqlUserCheck1 = "SELECT email FROM owner WHERE email = '$user_email';";
	$sqlUserCheck2 = "SELECT username FROM student WHERE username = '$username';";
	$sqlUserCheck3 = "SELECT email FROM student WHERE email = '$user_email';";

	$result = mysqli_query($conn, $sqlUserCheck);
	$result1 = mysqli_query($conn, $sqlUserCheck1);
	$result2 = mysqli_query($conn, $sqlUserCheck2);
	$result3 = mysqli_query($conn, $sqlUserCheck3);

	while ($row = mysqli_fetch_assoc($result)) {
		$usernameInDB = $row['username'];
	}

	while ($row = mysqli_fetch_assoc($result1)) {
		$user_emailInDB = $row['email'];
	}

	while ($row = mysqli_fetch_assoc($result2)) {
		$usernameInDB1 = $row['username'];
	}

	while ($row = mysqli_fetch_assoc($result3)) {
		$user_emailInDB1 = $row['email'];
	}

	if ($err1 == "" && $err2 == "" && $err3 == "" && $err4 == "" && $err5 == "" && $err6 == "") {
		if ($usernameInDB == $username || $usernameInDB1 == $username) {
			$errmsg1 = "UserName already exists!";
		} else if ($user_emailInDB == $user_email || $user_emailInDB1 == $user_email) {
			$errmsg2 = "E-mail already exists!";
		} else if (empty($_POST['accept_terms'])) {
			$errmsg3 = "Please read our terms & conditions and check the box.";
		} else {
			if ($user_password == $confirm_user_password) {
				$user_passwordToDB = password_hash($user_password, PASSWORD_DEFAULT);
				if ($user_type == "owner") {
					$sql = "INSERT INTO owner (username, email, name, password) VALUES ('$username','$user_email','$user_full_name','$user_passwordToDB');";

					if (mysqli_query($conn, $sql)) {
						$user_last_id = mysqli_insert_id($conn);

						$user_id_folder = "../images/Ad_images/owner/" . $user_last_id;

						mkdir($user_id_folder, 0777);
						mkdir($user_id_folder . "/flat", 0777);
						mkdir($user_id_folder . "/mess", 0777);
						mkdir($user_id_folder . "/sublet", 0777);

						header("location: registration_successful.php");
						// echo "New record created successfully. Last inserted ID is: " . $last_id;
					} else {
						echo "Error: " . $sql . "<br>" . mysqli_error($conn);
					}

					//mysqli_query($conn, $sql);
					// header("location: registration_successful.php");
				} else if ($user_type == "student") {
					$sql = "INSERT INTO student (username, email, name, password) VALUES ('$username','$user_email','$user_full_name','$user_passwordToDB');";

					// if (mysqli_query($conn, $sql)) {
					// 	$user_last_id = mysqli_insert_id($conn);

					// 	$user_id_folder = "../images/Ad_images/owner/" . $user_last_id;

					// 	mkdir($user_id_folder, 0777);
					// 	mkdir($user_id_folder . "/flat", 0777);
					// 	mkdir($user_id_folder . "/mess", 0777);
					// 	mkdir($user_id_folder . "/sublet", 0777);

					// 	header("location: registration_successful.php");
					// 	// echo "New record created successfully. Last inserted ID is: " . $last_id;
					// } else {
					// echo "Error: " . $sql . mysqli_error($conn);
					// }

					mysqli_query($conn, $sql);
					header("location: registration_successful.php");
				}
			} else {
				$errmsg4 = "Password not match!";
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
	<title>Student Accommodation | Sign Up</title>
</head>

<body>
	<?php echo before_login_header("registration"); ?>
	<!-- <header id="header">
    <div class="container">
      <div id="website_logo">
        <a href="index.php">
          <img src="../images/website_logo.png" alt="Student Accommodation" width="250px" height="70px" id="logo" />
        </a>
      </div>
      <nav id="header_nav">
        <ul>
          <span id="header_nav_list">
            <li><a href="index.php">Login</a></li>
            <li id="separator"><b>|</b></li>
            <li class="current">
              <a href="registration.php">Create an Account</a>
            </li>
          </span>
        </ul>
      </nav>
    </div>
  </header> -->

	<section id="registration_section">
		<div class="container">
			<div class="registration_form">
				<form action="registration.php" method="POST">
					<table align="center">
						<tr>
							<td>
								<h2>User Registration</h2>
							</td>
						</tr>
						<tr>
							<td>
								<label for="user_type" class="label">
									Sign Up As <span class="required">*</span>
								</label>
							</td>
						</tr>
						<tr>
							<td>
								<select name="user_type" id="user_type" class="user_info" required>
									<option value="" disabled selected>User Type</option>
									<option value="student" <?php if ($user_type == "student") { ?> selected <?php } ?>>Student</option>
									<option value="owner" <?php if ($user_type == "owner") { ?> selected <?php } ?>>House Owner</option>
								</select>
								<br />
								<span style="color:red;"><?php echo $err1; ?></span>
							</td>
						</tr>
						<tr>
							<td>
								<label for="user_full_name" class="label">
									Name <span class="required">*</span>
								</label>
							</td>
						</tr>
						<tr>
							<td>
								<input type="text" name="user_full_name" id="user_full_name" placeholder="Type Your Full Name" class="user_info" value="<?php echo $user_full_name ?>" required />
								<br />
								<span style="color:red;"><?php echo $err2; ?></span>
							</td>
						</tr>
						<tr>
							<td>
								<label for="username" class="label">
									Userame <span class="required">*</span>
								</label>
							</td>
						</tr>
						<tr>
							<td>
								<input type="text" name="username" id="username" placeholder="Userame" class="user_info" value="<?php echo $username ?>" required />
								<br />
								<span style="color:red;"><?php echo $err3; ?></span>
								<span style="color:red;"><?php echo $errmsg1; ?></span>
							</td>
						</tr>
						<tr>
							<td>
								<label for="user_email" class="label">
									E-mail <span class="required">*</span>
								</label>
							</td>
						</tr>
						<tr>
							<td>
								<input type="email" name="user_email" id="user_email" placeholder="Enter Your Valid E-mail" class="user_info" value="<?php echo $user_email ?>" required />
								<br />
								<span style="color:red;"><?php echo $err4; ?></span>
								<span style="color:red;"><?php echo $errmsg2; ?></span>
							</td>
						</tr>
						<tr>
							<td>
								<label for="user_password" class="label">
									Password <span class="required">*</span>
								</label>
							</td>
						</tr>
						<tr>
							<td>
								<input type="password" name="user_password" id="user_password" placeholder="Password" class="user_info" value="<?php echo $user_password ?>" required />
								<br />
								<span style="color:red;"><?php echo $err5; ?></span>
							</td>
						</tr>
						<tr>
							<td>
								<label for="confirm_user_password" class="label">
									Confirm Password <span class="required">*</span>
								</label>
							</td>
						</tr>
						<tr>
							<td>
								<input type="password" name="confirm_user_password" id="confirm_user_password" placeholder="Confirm Password" class="user_info" value="<?php echo $confirm_user_password ?>" required />
								<br />
								<span style="color:red;"><?php echo $err6; ?></span>
								<span style="color:red;"><?php echo $errmsg4; ?></span>
							</td>
						</tr>
						<tr>
							<td>
								<input type="checkbox" name="accept_terms" id="accept_terms" required />
								<label for="accept_terms" id="accept_terms_label">
									By clicking registration button, you accept our</label>
								<a href="termscondition.php" target="_blank" id="checkbox_label">Terms & Conditions.</a>
								<br />
								<span style="color:red;"><?php echo $errmsg3; ?></span>
							</td>
						</tr>
						<tr>
							<td align="center">
								<button type="submit" name="registration_button" id="registration_button">
									Register
								</button>
							</td>
						</tr>
					</table>
				</form>
			</div>
		</div>
	</section>

	<?php echo footer(); ?>

	<!-- <script src="../JavaScript/header.js"></script> -->
</body>

</html>