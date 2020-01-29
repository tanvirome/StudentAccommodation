<?php

include "../includes/db_connect.inc.php";
include "../includes/header.inc.php";

session_start();
if (!isset($_SESSION["admin_username"])) {
	header("Location: admin_login.php");
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
	<title>Student Accommodation | Admin</title>
</head>

<body>
	<?php echo after_login_admin_header("home"); ?>
	<!-- <header id="header">
  <div class="container">
   <div id="website_logo">
    <a href="owner_homepage.html">
     <img src="../images/website_logo.png" alt="Student Accommodation" width="250px" height="70px" id="logo" />
    </a>
   </div>
   <div id="header_navigation">
    <nav id="header_nav">
     <ul>
      <span id="header_nav_list">
       <li class="current">
        <a href="admin.html">Home</a>
       </li>
       <li id="separator"><b>|</b></li>

       <li>
        <a href="admin_profile.html">Dashboard</a>
       </li>
      </span>
      <span id="header_logout">
       <li>
        <a href="index.html">
         <i class="fas fa-sign-out-alt fa-lg"></i>
        </a>
       </li>
      </span>
     </ul>
    </nav>
   </div>
  </div>
 </header> -->

	<section id="categories">
		<div class="container">
			<div class="category">
				<p id="admin_selection">Select To Verify</p>
				<div class="admin">
					<ul>
						<li>
							<form action="admin_flat_verify.php" method="GET">
								<input name="flat" type="image" alt="Flat Ads" class="verify_icon" src="../images/admin_flat.png" onmouseover="this.src='../images/admin_flat_hover.png'" onmouseout="this.src='../images/admin_flat.png'">
							</form>
						</li>

						<li>
							<form action="admin_mess_verify.php" method="GET">
								<input name="mess" type="image" alt="Mess Ads" class="verify_icon" src="../images/admin_mess.png" onmouseover="this.src='../images/admin_mess_hover.png'" onmouseout="this.src='../images/admin_mess.png'">
							</form>
						</li>

						<li>
							<form action="admin_sublet_verify.php" method="GET">
								<input name="sublet" type="image" alt="Sublet Ads" class="verify_icon" src="../images/admin_sublet.png" onmouseover="this.src='../images/admin_sublet_hover.png'" onmouseout="this.src='../images/admin_sublet.png'">
							</form>
						</li>

						<li>
							<form action="admin_student_verify.php" method="GET">
								<input name="student" type="image" alt="Student" class="verify_icon" src="../images/admin_student.png" onmouseover="this.src='../images/admin_student_hover.png'" onmouseout="this.src='../images/admin_student.png'">
							</form>
						</li>

						<li>
							<form action="admin_owner_verify.php" method="GET">
								<input name="owner" type="image" alt="Owners" class="verify_icon" src="../images/admin_owner.png" onmouseover="this.src='../images/admin_owner_hover.png'" onmouseout="this.src='../images/admin_owner.png'">
							</form>
						</li>
					</ul>
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
</body>

</html>