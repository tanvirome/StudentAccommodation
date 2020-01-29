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
 <title>Student Accommodation | FAQ</title>
</head>

<body>
 <!-- <header id="header">
  <div class="container">
   <div id="website_logo">
    <a href="index.html">
     <img src="../images/website_logo.png" alt="Student Accommodation" width="250px" height="70px" id="logo" />
    </a>
   </div>
   <nav id="header_nav">
    <ul>
     <span id="header_nav_list">
      <li><a href="index.html">Login</a></li>
      <li id="separator"><b>|</b></li>
      <li>
       <a href="registration.html">Create an Account</a>
      </li>
     </span>
    </ul>
   </nav>
  </div>
 </header> -->

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

 <section id="faq_section">
  <div class="container">
   <div class="asked">
    <div class="container">
     <h3>Frequently Asked Questions</h3>

     <div class="questions">
      <h5>1. What is StudentAccommodation.com?</h5>
      <p>
       StudentAccommodation.com is a platform for connecting between students
       and homeowners. Here the students on one side can find suitable
       accommodation for their residence and on the other hand, the homeowners
       can rent a house from sit in the house without affix a leaflet
      </p>
     </div>

     <div class="questions">
      <h5>2. What kind of ads can be given at StudentAccommodation.com?</h5>
      <p>
       Any kinds of property for students can be posted as ads such as flat,
       room, sublet, hostel, mess etc in StudentAccommodation.com
      </p>
     </div>

     <div class="questions">
      <h5>3. How to advertise rentals at StudentAccommodation.com?</h5>
      <p>
       Visit StudentAccommodation.com and click 'Create an Account' and open
       the free account and fill out the form with detailed information about
       you and click submit. Then login to your account to give more details
       and wait for verification. After verification post your desire ads and
       find appropriate tenants.
      </p>
     </div>

     <div class="questions">
      <h5>4. How to take rent from StudentAccommodation.com?</h5>
      <p>
       Visit StudentAccommodation.com and click 'Create an Account' and open
       the free account and fill out the form with detailed information about
       you and click submit. Then login to your account to give more details
       and wait for verification. After verification you can search your desire
       accommodation.
      </p>
     </div>

     <div class="questions">
      <h5>5. Do you take any money to pay rent / sale ads?</h5>
      <p>
       Rental / sale advertising does not cost any money, but there is a small
       amount to pay for the feature ad. Call for feature ad: 01521-433801
      </p>
     </div>

     <div class="questions">
      <h5>
       6. How to find the necessary ads easily at StudentAccommodation.com?
      </h5>
      <p>
       To find the necessary ads easily, visit StudentAccommodation.com with a
       registered account and click on the desire category from homepage. Give
       your desire credentials and press the search button and easily find your
       favorite residence.
      </p>
     </div>

     <div class="questions">
      <h5>7. How many photos can be uploaded to an ad?</h5>
      <p>
       Many images can be uploaded to an advertisement. However, while
       uploading the images, it should be kept in mind that the pictures are
       clear and accurate or otherwise it will not be verified.
      </p>
     </div>

     <div class="questions">
      <h5>8. Why use StudentAccommodation.com?</h5>
      <p>
       Use StudentAccommodation.com to keep your city clean, to save the cost
       of leaflets, get hassle free accommodation and remain tension free.
      </p>
     </div>
    </div>
   </div>
  </div>
 </section>

 <?php echo footer(); ?>
</body>

</html>