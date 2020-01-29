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

$user_status = "";

$sql = "SELECT status FROM student WHERE username = '$username';";
$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_assoc($result)) {
	$user_status = $row['status'];
}

// $_SESSION['username'] = $username;

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
	<title>Student Accommodation | Home</title>
</head>

<body>
	<?php echo after_login_student_header("home"); ?>

	<section id="slider_section">
		<div class="container">
			<div class="load"></div>
			<div class="slider_text">
				<h1>WELCOME TO <br />STUDENT ACCOMMODATION</h1>
				<p>
					<!-- We Are All Over The Dhaka City -->
					We Are Everywhere
				</p>
			</div>
			<!-- <div id="slide_text">
     <strong>Now In Mirpur</strong>
    </div> -->
		</div>
	</section>
	<section id="categories">
		<div class="container">
			<?php
			if ($user_status == "unverified") { ?>
				<div style="margin-top: 10px;">
					<!-- <marquee behavior="alternate">Please update your information and wait 48 hours to varified your account.</marquee> -->
					<span style="color: red; margin-top: 10px">
						Please update your information and wait 48 hours to verified your account.
					</span>
				</div>
			<?php } ?>

			<div class="category">
				<p id="post_ads">Select Your Desired Category</p>
				<div>
					<ul>
						<li>
							<form action="show_flat_ads.php" method="GET">
								<input name="flat" type="image" alt="Flat Ads" class="ad_icon" src="../images/flat-icon.png" onmouseover="this.src='../images/flat_hover_icon.png'" onmouseout="this.src='../images/flat-icon.png'" />
							</form>
							<!-- <a href="owner_flat_ads.php">
								<img src="../images/flat_icon.png" alt="Flat Ads" id="flat_icon" class="ad_icon" />
								<br />
								<label for="flat_icon" class="ad_icon_label">FLAT</label>
							</a> -->
							<!-- <br />
        <a href="owner_flat_ads.php">
         <label for="flat_icon" class="ad_icon_label">FLAT</label>
        </a> -->
						</li>
						<li>
							<form action="show_mess_ads.php" method="GET">
								<input name="mess" type="image" alt="Mess Ads" class="ad_icon" src="../images/mess-icon.png" onmouseover="this.src='../images/mess_hover_icon.png'" onmouseout="this.src='../images/mess-icon.png'" />
							</form>
							<!-- <a href="owner_mess_ads.php">
								<img src="../images/mess_icon.png" alt="Mess Ads" id="mess_icon" class="ad_icon" />
								<br />
								<label for="mess_icon" class="ad_icon_label">MESS</label>
							</a> -->
							<!-- <br />
        <label for="mess_icon" class="ad_icon_label">MESS</label> -->
						</li>
						<li>
							<form action="show_sublet_ads.php" method="GET">
								<input name="sublet" type="image" alt="Sublet Ads" class="ad_icon" src="../images/sublet-icon.png" onmouseover="this.src='../images/sublet_hover_icon.png'" onmouseout="this.src='../images/sublet-icon.png'" />
							</form>
							<!-- <a href="owner_sublet_ads.php">
								<img src="../images/sublet_icon.png" alt="Sublet Ads" id="sublet_icon" class="ad_icon" />
								<br />
								<label for="sublet_icon" class="ad_icon_label">SUBLET</label>
							</a> -->
							<!-- <br />
        <label for="sublet_icon" class="ad_icon_label">SUBLET</label> -->
						</li>
					</ul>
				</div>
			</div>
		</div>
	</section>

	<?php echo footer(); ?>

	<!-- <script src="../JavaScript/header.js"></script> -->
</body>

</html>