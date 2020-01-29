<?php
function after_login_owner_header($current)
{ ?>
	<!-- <button onclick="topFunction()" id="goTopBtn" class="goTopBtn" title="Go to top"><i class="fas fa-angle-up fa-3x"></i></button> -->
	<header id="header">
		<div class="container">
			<div id="website_logo">
				<a href="owner_homepage.php">
					<img src="../images/website_logo.png" alt="Student Accommodation" width="250px" height="70px" id="logo" />
				</a>
			</div>
			<div id="header_navigation">
				<nav id="header_nav">
					<ul>
						<span id="header_nav_list">
							<li>
								<a href="owner_homepage.php" class="<?php if ($current == "home") {
																																													echo "current";
																																												} ?>">Home</a>
							</li>
							<li id="separator1" class="separator"><b>|</b></li>
							<li class="dropdown">
								<a href="#" class="<?php if ($current == "postads") {
																												echo "current";
																											} ?>">Post Ads <i class="fa fa-caret-down"></i></a>
								<div class="dropdown-content">
									<a href="owner_flat_ads.php">Flat Ads</a>
									<a href="owner_mess_ads.php">Mess Ads</a>
									<a href="owner_sublet_ads.php">Sublet Ads</a>
								</div>
							</li>
							<li id="separator2" class="separator"><b>|</b></li>
							<li>
								<a href="owner_show_ads.php" <?php if ($current == "myads") { ?> class="current" <?php } ?>>My Ads</a>
							</li>
							<li id="separator3" class="separator"><b>|</b></li>
							<li>
								<a href="owner_profile.php" <?php if ($current == "dashboard") { ?> class="current" <?php } ?>>Dashboard</a>
							</li>
						</span>
						<span id="header_logout">
							<li>
								<a href="logout.php">
									<i class="fas fa-sign-out-alt fa-lg"></i>
								</a>
								<!-- <a href="#">
          <i class="fas fa-user-circle fa-2x"></i>
         </a>
        </li> -->
							</li>
						</span>
					</ul>
				</nav>
			</div>
		</div>
	</header>
	<script src="../JavaScript/header.js"></script>
	<!-- <script>
		//Get the button
		var mybutton = document.getElementById("goTopBtn");

		// When the user scrolls down 20px from the top of the document, show the button
		window.onscroll = function() {
			scrollFunction()
		};

		function scrollFunction() {
			if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
				mybutton.style.display = "block";
			} else {
				mybutton.style.display = "none";
			}
		}

		// When the user clicks on the button, scroll to the top of the document
		function topFunction() {
			document.body.scrollTop = 0;
			document.documentElement.scrollTop = 0;
		}
	</script> -->
<?php } ?>

<?php
function after_login_student_header($current)
{ ?>
	<!-- <button onclick="topFunction()" id="goTopBtn" class="goTopBtn" title="Go to top"><i class="fas fa-angle-up fa-3x"></i></button> -->
	<header id="header">
		<div class="container">
			<div id="website_logo">
				<a href="student_homepage.php">
					<img src="../images/website_logo.png" alt="Student Accommodation" width="250px" height="70px" id="logo" />
				</a>
			</div>
			<div id="header_navigation">
				<nav id="header_nav">
					<ul>
						<span id="header_nav_list">
							<li>
								<a href="student_homepage.php" <?php if ($current == "home") { ?> class="current" <?php } ?>>Home</a>
							</li>

							<li id="separator"><b>|</b></li>
							<li class="dropdown">
								<a href="#" class="<?php if ($current == "showads") {
																												echo "current";
																											} ?>">Show Ads <i class="fa fa-caret-down"></i></a>
								<div class="dropdown-content">
									<a href="show_flat_ads.php">Flat Ads</a>
									<a href="show_mess_ads.php">Mess Ads</a>
									<a href="show_sublet_ads.php">Sublet Ads</a>
								</div>
							</li>

							<li id="separator"><b>|</b></li>

							<li>
								<a href="student_profile.php" <?php if ($current == "dashboard") { ?> class="current" <?php } ?>>Dashboard</a>
							</li>
						</span>
						<span id="header_logout">
							<li>
								<a href="logout.php">
									<i class="fas fa-sign-out-alt fa-lg"></i>
								</a>
								<!-- <a href="#">
          <i class="fas fa-user-circle fa-2x"></i>
         </a>
        </li> -->
							</li>
						</span>
					</ul>
				</nav>
			</div>
		</div>
	</header>
	<script src="../JavaScript/header.js"></script>
	<!-- <script>
		//Get the button
		var mybutton = document.getElementById("goTopBtn");

		// When the user scrolls down 20px from the top of the document, show the button
		window.onscroll = function() {
			scrollFunction()
		};

		function scrollFunction() {
			if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
				mybutton.style.display = "block";
			} else {
				mybutton.style.display = "none";
			}
		}

		// When the user clicks on the button, scroll to the top of the document
		function topFunction() {
			document.body.scrollTop = 0;
			document.documentElement.scrollTop = 0;
		}
	</script> -->

<?php } ?>

<?php
function before_login_header($current)
{ ?>
	<!-- <button onclick="topFunction()" id="goTopBtn" class="goTopBtn" title="Go to top"><i class="fas fa-angle-up fa-3x"></i></button> -->
	<header id="header">
		<div class="container">
			<div id="website_logo">
				<a href="index.php">
					<img src="../images/website_logo.png" alt="Student Accommodation" width="250px" height="70px" id="logo" />
				</a>
			</div>
			<nav id="header_nav">
				<ul>
					<span id="header_nav_list">
						<li><a href="index.php" <?php if ($current == "login") { ?> class="current" <?php } ?>>Login</a></li>
						<li id="separator"><b>|</b></li>
						<li>
							<a href="registration.php" <?php if ($current == "registration") { ?> class="current" <?php } ?>>Create an Account</a>
						</li>
					</span>
				</ul>
			</nav>
		</div>
	</header>
	<script src="../JavaScript/header.js"></script>
	<!-- <script>
		//Get the button
		var mybutton = document.getElementById("goTopBtn");

		// When the user scrolls down 20px from the top of the document, show the button
		window.onscroll = function() {
			scrollFunction()
		};

		function scrollFunction() {
			if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
				mybutton.style.display = "block";
			} else {
				mybutton.style.display = "none";
			}
		}

		// When the user clicks on the button, scroll to the top of the document
		function topFunction() {
			document.body.scrollTop = 0;
			document.documentElement.scrollTop = 0;
		}
	</script> -->

<?php } ?>

<?php
function after_login_admin_header($current)
{ ?>
	<!-- <button onclick="topFunction()" id="goTopBtn" class="goTopBtn" title="Go to top"><i class="fas fa-angle-up fa-3x"></i></button> -->
	<header id="header">
		<div class="container">
			<div id="website_logo">
				<a href="admin_homepage.php">
					<img src="../images/website_logo.png" alt="Student Accommodation" width="250px" height="70px" id="logo" />
				</a>
			</div>
			<div id="header_navigation">
				<nav id="header_nav">
					<ul>
						<span id="header_nav_list">
							<li>
								<a href="admin_homepage.php" class="<?php if ($current == "home") {
																																													echo "current";
																																												} ?>">Home</a>
							</li>
							<li id="separator1" class="separator"><b>|</b></li>
							<li class="dropdown">
								<a href="#" class="<?php if ($current == "veirfy") {
																												echo "current";
																											} ?>">Verify <i class="fa fa-caret-down"></i></a>
								<div class="dropdown-content">
									<a href="admin_flat_verify.php">Flat Ads</a>
									<a href="admin_mess_verify.php">Mess Ads</a>
									<a href="admin_sublet_verify.php">Sublet Ads</a>
									<a href="admin_owner_verify.php">Owner</a>
									<a href="admin_student_verify.php">Student</a>
								</div>
							</li>
							<li id="separator2" class="separator"><b>|</b></li>
							<li>
								<a href="admin_add_element.php" <?php if ($current == "addelement") { ?> class="current" <?php } ?>>Add Element</a>
							</li>
							<li id="separator3" class="separator"><b>|</b></li>
							<li>
								<a href="admin_profile.php" <?php if ($current == "dashboard") { ?> class="current" <?php } ?>>Dashboard</a>
							</li>
						</span>
						<span id="header_logout">
							<li>
								<a href="admin_logout.php">
									<i class="fas fa-sign-out-alt fa-lg"></i>
								</a>
								<!-- <a href="#">
          <i class="fas fa-user-circle fa-2x"></i>
         </a>
        </li> -->
							</li>
						</span>
					</ul>
				</nav>
			</div>
		</div>
	</header>
	<script src="../JavaScript/header.js"></script>
	<!-- <script>
		//Get the button
		var mybutton = document.getElementById("goTopBtn");

		// When the user scrolls down 20px from the top of the document, show the button
		window.onscroll = function() {
			scrollFunction()
		};

		function scrollFunction() {
			if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
				mybutton.style.display = "block";
			} else {
				mybutton.style.display = "none";
			}
		}

		// When the user clicks on the button, scroll to the top of the document
		function topFunction() {
			document.body.scrollTop = 0;
			document.documentElement.scrollTop = 0;
		}
	</script> -->

<?php } ?>