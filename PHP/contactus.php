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
 <title>Student Accommodation | Contact Us</title>
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

 <section id="contactus_section">
  <div class="container">
   <div class="asked">
    <h3>Contact Us</h3>
   </div>
   <div class="office-address">
    <div class="office-map">
     <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14602.337055592287!2d90.35426817055254!3d23.79781426816561!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755c0e86515f907%3A0x6ed21ca7bc93746!2zMjPCsDQ3JzUxLjkiTiA5MMKwMjEnMTUuMCJF!5e0!3m2!1sen!2sbd!4v1577033460615!5m2!1sen!2sbd" width="700" height="450" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
    </div>
    <div class="head-office-address">
     <h3>Head Office & Addminstration</h3>
     <p>Block G, 2nd Floor, Mirpur 1</p>
     <p>Dhaka, Bangladesh.</p>
    </div>
   </div>
  </div>
 </section>

 <section class="contact-us-information">
  <div class="container">
   <div class="content">
    <div class="customer-support contact-info">
     <div class="circle">
      <div class="incontent">
       <i class="fa fa-users" aria-hidden="true"></i>
      </div>
     </div>
     <div class="linecontent">Customer Support</div>
     <p class="phonetxt"><i class="fa fa-phone"></i> +880-1714452058</p>
    </div>
    <div class="helpline contact-info">
     <div class="circle">
      <div class="incontent">
       <i class="fa fa-question" aria-hidden="true"></i>
      </div>
     </div>
     <div class="linecontent">Help Line</div>
     <p class="phonetxt"><i class="fa fa-phone"></i> +880-1521429878</p>
    </div>
   </div>
  </div>
 </section>

 <?php echo footer(); ?>
</body>

</html>