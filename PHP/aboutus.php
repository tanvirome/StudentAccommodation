<?php

include "../includes/db_connect.inc.php";
include "../includes/header.inc.php";
include "../includes/footer.inc.php";

session_start();

if (isset($_SESSION["username"])) {
 $type = $_SESSION["user_type"];
 // if ($type == "owner") {
 //  header("Location: owner_homepage.php");
 // } else if ($type == "student") {
 //  header("Location: student_homepage.php");
 // }
} else {
 $type = "";
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
 <title>Student Accommodation | About Us</title>
</head>

<body>
 <?php
 if ($type == "") {
  echo before_login_header("");
 } else {
  if ($type == "owner") {
   echo after_login_owner_header("");
  } else if ($type == "owner") {
   echo after_login_student_header("");
  }
 }
 ?>

 <section id="aboutus_section">
  <div class="container">
   <div class="container">
    <div class="asked">
     <h3>About Us</h3>
    </div>
    <div class="who-we-are">
     <div class="who-we-are-image">
      <img src="../images/who-we-are.png" alt="Who We ARe" />
     </div>
     <div class="who-we-are-text">
      <h2>Who We Are?</h2>
      <p>
       We are small real estate management web portal in Bangladesh. We do
       start in 2019 to remove rent give and take pain. We expect it will
       helpful for the people, basically who want to find his dream house
       easily and who want to give house rent to perfect person.
      </p>
     </div>
    </div>
    <div class="our-vision">
     <div class="our-vision-image">
      <img src="../images/vision.jpg" alt="Our Vision" />
     </div>
     <div class="our-vision-text">
      <h2>Our Vision</h2>
      <p>
       Our vision is to compose as bundle all house rent and require
       information by online activities and we want to give number one
       manageble facilities for all online user.
      </p>
     </div>
    </div>
   </div>
  </div>
 </section>

 <?php echo footer(); ?>

</body>

</html>