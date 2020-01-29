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

$user_type = $username = $user_password = "";

$err1 = $err2 = $err3 = "";
$errmsg1 = $errmsg2 = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

	if (isset($_POST['login_button'])) {
		if (!empty($_POST['user_type'])) {
			$user_type = mysqli_real_escape_string($conn, $_POST['user_type']);
		} else {
			$err1 = "This field can't be empty";
		}

		if (!empty($_POST['username'])) {
			$username = mysqli_real_escape_string($conn, $_POST['username']);
		} else {
			$err2 = "This field can't be empty";
		}


		if (!empty($_POST['user_password'])) {
			$user_password = mysqli_real_escape_string($conn, $_POST['user_password']);
		} else {
			$err3 = "This field can't be empty";
		}

		if ($err1 == "" && $err2 == "" && $err3 == "") {
			if ($user_type == "owner") {
				$sqlUserCheck = "SELECT username, password, user_id, name FROM owner WHERE username = '$username' and state = 'active';";
				$result = mysqli_query($conn, $sqlUserCheck);
				$rowCount = mysqli_num_rows($result);
			} else if ($user_type == "student") {
				$sqlUserCheck = "SELECT username, password, user_id, name FROM student WHERE username = '$username' and state = 'active';";
				$result = mysqli_query($conn, $sqlUserCheck);
				$rowCount = mysqli_num_rows($result);
			}
			if ($rowCount < 1) {
				$errmsg1 = "User does not exist!";
			} else {
				while ($row = mysqli_fetch_assoc($result)) {
					$user_passwordInDB = $row['password'];
					$user_id = $row['user_id'];
					$user_name = $row['name'];

					if (password_verify($user_password, $user_passwordInDB)) {
						$_SESSION['username'] = $username;
						$_SESSION['user_id'] = $user_id;
						$_SESSION['name'] = $user_name;
						$_SESSION['user_type'] = $user_type;
						if ($user_type == "owner") {
							header("Location: owner_homepage.php");
						} else if ($user_type == "student") {
							header("Location: student_homepage.php");
						}
					} else {
						$errmsg2 = "Wrong Password!";
					}
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
	<title>Student Accommodation | Log In</title>
</head>

<body>
	<?php echo before_login_header("login"); ?>

	<section id="login_section">
		<div class="container">
			<div class="login_form">
				<form action="index.php" method="POST" class="login_info">
					<div>
						<!-- <label>Login as : </label> -->
						<select name="user_type" id="user_type" required class="user_info">
							<option value="" disabled selected>Select user type</option>
							<option value="student" <?php if ($user_type == "student") { ?> selected <?php } ?>>Student</option>
							<option value="owner" <?php if ($user_type == "owner") { ?> selected <?php } ?>>House Owner</option>
						</select>
						<br />
						<span style="color:red;"><?php echo $err1; ?></span>
					</div>
					<div>
						<!-- <label for="user_email">Email Address</label> <br /> -->
						<input class="user_info" type="text" name="username" id="username" placeholder="Username" value="<?php echo $username ?>" required />
						<br />
						<span style="color:red;"><?php echo $err2; ?></span>
						<span style="color:red;"><?php echo $errmsg1; ?></span>
					</div>
					<div>
						<!-- <label for="user_password">Password</label> <br /> -->
						<input type="password" name="user_password" id="user_password" placeholder="Password" required class="user_info" />
						<br />
						<span style="color:red;"><?php echo $err3; ?></span>
						<span style="color:red;"><?php echo $errmsg2; ?></span>
					</div>
					<div>
						<input type="checkbox" name="show_password" id="show_password" onclick="myFunction()" />
						<span class="show_pass_text" id="show_pass_text">Show Password</span>
					</div>
					<div>
						<button type="submit" name="login_button" id="login_button">Log In</button>
					</div>
				</form>
			</div>
		</div>
	</section>

	<?php echo footer(); ?>

	<script>
		function myFunction() {
			var x = document.getElementById("user_password");
			if (x.type === "password") {
				x.type = "text";
			} else {
				x.type = "password";
			}
		}

		var show_password = document.getElementById("show_password");
		var show_pass_text = document.getElementById("show_pass_text");

		show_pass_text.addEventListener("click", function() {
			show_password.click();
		});
	</script>

	<script src="../JavaScript/header.js"></script>
</body>

</html>