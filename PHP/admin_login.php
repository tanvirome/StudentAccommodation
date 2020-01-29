<?php

include "../includes/db_connect.inc.php";
include "../includes/header.inc.php";

session_start();

if (isset($_SESSION['admin_username'])) {
	header("Location: admin_homepage.php");
}

$admin_email = $admin_password = $full_name = $admin_username = $usernameInDB = $user_emailInDB =  $user_passwordToDB = "";

$username = $user_password = "";
$tab_value = "";

$err1 = $err2 = $err3 = $err4 = $err5 = $err6 = "";
$errmsg1 = $errmsg2 = $errmsg3 = $errmsg4 = $successmsg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	// $tab_value = $_POST['tab'];

	if (isset($_POST['login_button'])) {
		$tab_value = "1";
		if (!empty($_POST['username'])) {
			$username = mysqli_real_escape_string($conn, $_POST['username']);
		} else {
			$err1 = "This field can't be empty";
		}


		if (!empty($_POST['user_password'])) {
			$user_password = mysqli_real_escape_string($conn, $_POST['user_password']);
		} else {
			$err2 = "This field can't be empty";
		}

		if ($err1 == "" && $err2 == "") {
			$sqlUserCheck = "SELECT password, admin_id, name FROM admin WHERE username = '$username' and state = 'active';";
			$result = mysqli_query($conn, $sqlUserCheck);
			$rowCount = mysqli_num_rows($result);

			if ($rowCount < 1) {
				$errmsg1 = "User does not exist!";
			} else {
				while ($row = mysqli_fetch_assoc($result)) {
					$user_passwordInDB = $row['password'];
					$admin_id = $row['admin_id'];
					$user_name = $row['name'];

					if (password_verify($user_password, $user_passwordInDB)) {
						$_SESSION['admin_username'] = $username;
						$_SESSION['admin_id'] = $admin_id;
						$_SESSION['name'] = $user_name;
						header("Location: admin_homepage.php");
					} else {
						$errmsg2 = "Wrong Password!";
					}
				}
			}
		}
	}
	if (isset($_POST['signup_button'])) {
		$tab_value = "2";
		if (!empty($_POST['full_name'])) {
			$full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
		} else {
			$err3 = "This field can't be empty";
		}
		if (!empty($_POST['admin_username'])) {
			$admin_username = mysqli_real_escape_string($conn, $_POST['admin_username']);
		} else {
			$err4 = "This field can't be empty";
		}
		if (!empty($_POST['admin_email'])) {
			$admin_email = mysqli_real_escape_string($conn, $_POST['admin_email']);
		} else {
			$err5 = "This field can't be empty";
		}
		if (!empty($_POST['admin_password'])) {
			$admin_password = mysqli_real_escape_string($conn, $_POST['admin_password']);
			$user_passwordToDB = password_hash($admin_password, PASSWORD_DEFAULT);
		} else {
			$err6 = "This field can't be empty";
		}

		$sqlUserCheck = "SELECT username FROM admin WHERE username = '$admin_username';";
		$sqlUserCheck1 = "SELECT email FROM admin WHERE email = '$admin_email';";

		$result = mysqli_query($conn, $sqlUserCheck);
		$result1 = mysqli_query($conn, $sqlUserCheck1);

		while ($row = mysqli_fetch_assoc($result)) {
			$usernameInDB = $row['username'];
		}

		while ($row = mysqli_fetch_assoc($result1)) {
			$user_emailInDB = $row['email'];
		}

		if ($err3 == "" && $err4 == "" && $err5 == "" && $err6 == "") {
			if ($user_emailInDB == $admin_email && $usernameInDB == $admin_username) {
				$errmsg3 = "UserName already exists!";
				$errmsg4 = "E-mail already exists!";
			} else if ($usernameInDB == $admin_username) {
				$errmsg3 = "UserName already exists!";
			} else if ($user_emailInDB == $admin_email) {
				$errmsg4 = "E-mail already exists!";
			} else {
				$sql = "INSERT INTO admin (username, email, name, password) VALUES ('$admin_username','$admin_email','$full_name','$user_passwordToDB');";

				mysqli_query($conn, $sql);
				$successmsg = "Register Successfully!!!";
				$admin_email = $admin_password = $full_name = $admin_username = "";
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
	<title>Student Accommodation | Log In</title>
</head>

<body>
	<header id="header">
		<div class="container">
			<div id="website_logo">
				<a href="admin_login.php">
					<img src="../images/website_logo.png" alt="Student Accommodation" width="250px" height="70px" id="logo" />
				</a>
	</header>

	<section class="admin_login" id="admin_login">
		<div class="container">
			<div class="admin_form">
				<input id="tab_1" type="radio" name="tab" class="sign_in" value="1" checked <?php if ($tab_value == "1") echo "checked" ?> />
				<label for="tab_1" id="tab_1_label" class="tab" onclick="tab1Clicked()">Sign In</label>
				<input id="tab_2" type="radio" name="tab" class="sign_up" value="2" <?php if ($tab_value == "2") echo "checked" ?> />
				<label for="tab_2" id="tab_2_label" class="tab" onclick="tab2Clicked()">Sign Up</label>

				<div class="login_signup_form" id="login_signup_form">
					<div class="login_form">
						<h2><u>Admin Login</u></h2>
						<form action="admin_login.php" method="POST" autocomplete="off" id="login_form">
							<div class="inputBox">
								<input type="text" name="username" required autocomplete="off" value="<?php echo $username; ?>" />
								<label>Username</label>
							</div>

							<?php if ($errmsg1 != "" || $err1 != "") { ?>
								<div style="color: red; margin-top: -23px; margin-bottom: 10px; font-size: 12px;">
									<span><?php echo $err1; ?></span>
									<span><?php echo $errmsg1; ?></span>
								</div>
							<?php } ?>

							<div class="inputBox">
								<input type="password" name="user_password" required autocomplete="off" value="<?php echo $user_password; ?>" />
								<label>Password</label>
							</div>

							<?php if ($errmsg2 != "" || $err2 != "") { ?>
								<div style="color: red; margin-top: -23px; margin-bottom: 10px; font-size: 12px;">
									<span><?php echo $err2; ?></span>
									<span><?php echo $errmsg2; ?></span>
								</div>
							<?php } ?>

							<button type="submit" name="login_button" class="btn admin_login_button">
								Login
							</button>
							<!-- <input type="submit" name="login_button" value="Login" /> -->
						</form>
					</div>
					<div class="signup_form">
						<span style="color: #009900; position: none;"><?php echo $successmsg; ?></span>
						<h2><u>Admin Signup</u></h2>
						<form action="admin_login.php" method="POST" autocomplete="off" id="sign_form">
							<div class="inputBox">
								<input type="text" name="full_name" required autocomplete="off" value="<?php echo $full_name; ?>" />
								<label>Full Name</label>
							</div>

							<?php if ($err3 != "") { ?>
								<div style="color: red; margin-top: -23px; margin-bottom: 10px; font-size: 12px;">
									<span><?php echo $err3; ?></span>
								</div>
							<?php } ?>

							<div class="inputBox">
								<input type="text" name="admin_username" required autocomplete="off" value="<?php echo $admin_username; ?>" />
								<label>Username</label>
							</div>

							<?php if ($err4 != "") { ?>
								<div style="color: red; margin-top: -23px; margin-bottom: 10px; font-size: 12px;">
									<span><?php echo $err4; ?></span>
								</div>
							<?php } ?>
							<!-- <span style="color: #009900; position: none;"/*<?php echo $errmsg3; ?>*/</span> -->
							<div class="inputBox">
								<input type="text" name="admin_email" required autocomplete="off" value="<?php echo $admin_email; ?>" />
								<label>E-mail</label>
							</div>

							<?php if ($err5 != "") { ?>
								<div style="color: red; margin-top: -23px; margin-bottom: 10px; font-size: 12px;">
									<span><?php echo $err5; ?></span>
								</div>
							<?php } ?>
							<!-- <span style="color: #009900; position: none;"><?php echo $errmsg4; ?></span> -->
							<div class="inputBox">
								<input type="password" name="admin_password" required autocomplete="off" value="<?php echo $admin_password; ?>" />
								<label>Password</label>
							</div>

							<?php if ($err6 != "") { ?>
								<div style="color: red; margin-top: -23px; margin-bottom: 10px; font-size: 12px;">
									<span><?php echo $err6; ?></span>
								</div>
							<?php } ?>

							<button type="submit" name="signup_button" class="btn admin_login_button">
								Signup
							</button>
							<!-- <input type="submit" name="login_button" value="Login" /> -->
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>

	<footer>
		<div class="container">
			<p>
				Copyright &copy; 2019 | All Rights Reserved by Student Accommodation
			</p>
		</div>
	</footer>

	<script src="../JavaScript/header.js"></script>

	<script>
		// window.document.getElementById("login_form").disableAutoFill;

		function tab1Clicked() {
			document.getElementById("login_signup_form").style.height = "235px";
		}

		function tab2Clicked() {
			document.getElementById("login_signup_form").style.height = "370px";
		}

		var value = parseInt("<?php echo $tab_value; ?>");
		if (value == 2) {
			document.getElementById("login_signup_form").style.height = "380px";
		}

		window.onload = function() {
			document.getElementById("admin_login").click();
			// document.getElementById("website_logo").click();

		};
	</script>


</body>

</html>