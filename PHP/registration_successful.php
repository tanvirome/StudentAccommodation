<?php

include "../includes/header.inc.php";
include "../includes/footer.inc.php";

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
	<title>Registration Successful</title>

	<style>
		#success_section {
			background-color: #e6e6e6;
		}

		.success {
			background-color: #ffdd99;
			padding: 5px 30px;
			margin: 10px 0px;
		}

		.success h3 {
			font-size: 24px;
			letter-spacing: 3px;
		}

		.success p {
			font-size: 17px;
		}
	</style>

</head>

<body>
	<?php echo before_login_header(""); ?>
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
						<li>
							<a href="registration.php">Create an Account</a>
						</li>
					</span>
				</ul>
			</nav>
		</div>
	</header> -->

	<section id="success_section">
		<div class="container">
			<div class="success">
				<h3>Registration Successful!!!</h3>
				<p>Your account has been created successfully!</p>
				<p>Note that you must activate your account by giving your information in DASHBOARD section in your account for further activity.</p>
			</div>
		</div>
	</section>

	<?php echo footer(); ?>

	<!-- <script src="../JavaScript/header.js"></script> -->
</body>

</html>