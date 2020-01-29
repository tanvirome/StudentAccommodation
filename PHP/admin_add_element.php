<?php

include "../includes/db_connect.inc.php";
include "../includes/header.inc.php";

session_start();

if (!isset($_SESSION["admin_username"])) {
	header("Location: admin_login.php");
}

$institute_name = $area_name = $successmsg = $errmsg = "";
$flag = 0;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (isset($_POST['institute_add_btn'])) {
		if (!empty($_POST['institute_name'])) {
			$institute_name = $_POST['institute_name'];
		}
		$sql = "SELECT * from institution";
		$result = mysqli_query($conn, $sql);
		while ($row = mysqli_fetch_assoc($result)) {
			if ($row['institute_name'] == $institute_name) {
				$flag = 1;
			}
		}

		if ($flag == 1) {
			$errmsg = "'" . $institute_name . "'" . " Already inserted.";
		} else {
			$sql = "INSERT into institution (institute_name) VALUES ('$institute_name');";
			mysqli_query($conn, $sql);
			$successmsg = "'" . $institute_name . "'" . " Insert Successfully!";
		}
	}

	if (isset($_POST['area_add_btn'])) {
		if (!empty($_POST['area_name'])) {
			$area_name = $_POST['area_name'];
		}
		$sql = "SELECT * from area";
		$result = mysqli_query($conn, $sql);
		while ($row = mysqli_fetch_assoc($result)) {
			if ($row['area_name'] == $area_name) {
				$flag = 1;
			}
		}

		if ($flag == 1) {
			$errmsg = "'" . $area_name . "'" . " Already inserted.";
		} else {
			$sql = "INSERT into area (area_name) VALUES ('$area_name');";
			mysqli_query($conn, $sql);
			$successmsg = "'" . $area_name . "'" . " Insert Successfully!";
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
	<title>Add Element</title>
</head>

<body>

	<?php echo after_login_admin_header("addelement"); ?>
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
        <a href="admin.html">Add Element</a>
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

	<section class="add_element_section">
		<div class="container">
			<div class="add_element">
				<span style="color: #29a329"><?php echo $successmsg; ?></span>
				<span style="color: #ff3300"><?php echo $errmsg; ?></span>
				<table>
					<tr>
						<td align="right">
							<label style="font-size: 16px;"><b>Institute Name: </b></label>
						</td>
						<td>
							<form action="admin_add_element.php" method="post">
								<div class="add_institute">
									<input type="text" placeholder="Institution Name" name="institute_name" id="institute_name" class="add_element_input" required />
									<button type="submit" class="btn submit institute_add_btn" name="institute_add_btn">Add</button>
								</div>
							</form>
						</td>
					</tr>
					<tr>
						<td align="right">
							<label style="font-size: 16px;"><b>Area Name: </b></label>
						</td>
						<td>
							<form action="admin_add_element.php" method="post">
								<div class="add_area">
									<input type="text" placeholder="Area Name" name="area_name" id="area_name" class="add_element_input" required />
									<button type="submit" class="btn submit area_add_btn" name="area_add_btn">Add</button>
								</div>
							</form>
						</td>
					</tr>
				</table>
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
</body>

</html>