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
 <title>Student Accommodation | Terms & Conditions</title>
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

 <section id="termsAndConditions">
  <div class="container">
   <div class="asked">
    <div class="container">
     <h3>Terms & Conditions</h3>

     <div class="questions">
      <!-- <h5>1. What is StudentAccommodation.com?</h5> -->
      <p>
       Please read these terms and conditions carefully before using the
       StudentAccommodation
      </p>
      <p>
       Your access to and use of the service is conditioned on your acceptance
       of and compliance with these terms. These terms apply to all visitors,
       users and others who access or use the service.
      </p>
      <p>
       By accessing or using the service you agree to be bound by these terms.
       If you disagree with any part of the terms then you may not access the
       service.
      </p>
     </div>

     <div class="questions">
      <h5>Termination</h5>
      <p>
       We may terminate or suspend access to our service immediately, without
       prior notice or liability, for any reason whatsoever, including without
       limitation if you breach the terms.
      </p>
      <p>
       All provisions of the terms which by their nature should survive
       termination shall survive termination, including, without limitation,
       ownership provisions, warranty disclaimers, indemnity and limitations of
       liability.
      </p>
     </div>

     <div class="questions">
      <h5>Links To other web sites</h5>
      <p>
       StudentAccommodation provides you with links to other websites for your
       convenience and information. You access these websites at your own risk
       and StudentAccommodation is not responsible for these websites.
       StudentAccommodation cannot control or be responsible for the policies of
       other sites we may link to, or the use of any Customer Data you may
       share with them. Please note that the StudentAccommodation Privacy Policy
       does not cover these other websites, and StudentAccommodation would recommend
       that you are apprised of their specific policies.
      </p>
      <p>
       We strongly advise you to read the terms and conditions and privacy
       policies of third-party web sites or services that you visit.
      </p>
     </div>

     <div class="questions">
      <h5>Content and Images for Free Ads</h5>
      <p>
       If anybody submits unrelated content and image that will not be publish
       or delete without any notice.
      </p>
      <p>
       If you want to sell/buy your house, land, products or commercial
       property online free simply register to sell/buy your house, land,
       products or commercial property, fill in a simple form with the details
       of your information.
      </p>
      <p>
       Completely free! No listing fees or commission for free Ads.
      </p>
     </div>

     <div class="questions">
      <h5>
       Advertiser Position, Project Gallery, Top Gallery and Basic Gallery
      </h5>
      <p>
       After creation of these, if not responsible response within 30 days, it
       will consider as fake. We want to help you sell your house, land,
       products or property for the best price possible. It is online
       marketplace to sell/buy your house, land, products or commercial
       property and now rent your house, flat or apartment. It is not possible
       without your help. If you stay and help us, we will go ahead to make
       this. Thanks for your valuable contribution in our website.
      </p>
     </div>

     <div class="questions">
      <h5>
       Changes
      </h5>
      <p>
       We reserve the right, at our sole discretion, to modify or replace these
       terms at any time. If a revision is material we will try to provide at
       least 30 days notice prior to any new terms taking effect, What
       constitutes a material change will be determined at our sole discretion.
       By continuing to access or use our service after those revisions become
       effective, you agree to be bound by the revised terms. If you do not
       agree to the new terms, please stop using the service.
      </p>
     </div>

     <div class="questions">
      <h5>Terms of Use</h5>
      <p>
       It is a free right to use and access website. Users accept and agree
       about the terms of these Terms and Conditions when users access the
       website. If you are not interested to the Terms and Conditions, Please
       do not accept to service and browse the Website. It is not responsible
       to provide the correct information of user and user related information.
       Visitor and user want to share their information to help the individual
       / company / research / other's purpose in the website. User creates
       account with details information and he can update, delete and
       deactivate his account. If user face any problem, Please inform about
       it. We try to create the bridge between user and
       company/organization/owner's of land or house sharing their information
       in the website. So please carefully upload user/visitor information in
       the website. Any payment will not be refunded. So please read carefully
       the Terms and Conditions. It does not warrant that it is error-free
       information or it's website and server are free of viruses or other
       harmful mechanisms. If user access and use it, we are not responsible
       for that reason. When user access and use it, we collect user
       information (IP address, use time, browser information etc.). Collecting
       user information and database, we use it for our service and sharing
       information for relevant business purposes. It is not error-free for
       user. Please wait for next version.
      </p>
     </div>
    </div>
   </div>
  </div>
 </section>

 <?php echo footer(); ?>

 <!-- <script src="../JavaScript/header.js"></script> -->
</body>

</html>