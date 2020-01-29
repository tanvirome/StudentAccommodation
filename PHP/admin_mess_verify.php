<?php

include "../includes/db_connect.inc.php";
include "../includes/header.inc.php";

session_start();
if (!isset($_SESSION["admin_username"])) {
 header("Location: admin_login.php");
}

$sql = "SELECT * from mess;";
$result = mysqli_query($conn, $sql);

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
 <!-- <link rel="stylesheet" href="../CSS/style.css" /> -->
 <link rel="stylesheet" href="../CSS/style.css" />
 <!-- Ajax -->
 <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
 <title>Mess Verify</title>
</head>

<body>
 <?php echo after_login_admin_header("veirfy"); ?>

 <section class="mess_verify_section">
  <div class="container">
   <div class="verify_details">
    <div class="left_section" id="left_section">
     <div>
      <h1>Mess Details</h1>
     </div>
     <div id="left_section_information">
      <div class="left_section_information">
       <table class="left_section_table">
        <tr>
         <td align="right" class="label"><span>Title : </span></td>
         <td align="left" class="show_data"><span id="title"></span></td>
        </tr>
        <tr>
         <td align="center" colspan="2">
          <!-- <div class="full_image">
           <img src="../images/image5.jpg" alt="ads image" class="main_full_image" />
          </div> -->
         </td>
        </tr>
        <tr>
         <td align="center" colspan="2">
          <!-- <div class="small_images">
           <div class="small_image">
            <img src="../images/image1.jpg" alt="ads image" class="images" />
           </div>
           <div class="small_image">
            <img src="../images/image3.jpg" alt="ads image" class="images" />
           </div>
          </div> -->
         </td>
        </tr>
        <tr>
         <td align="right" class="label"><span>Available From : </span></td>
         <td align="left" class="show_data"><span></span></td>
        </tr>
        <tr>
         <td align="right" class="label"><span>Ads For : </span></td>
         <td align="left" class="show_data"><span></span></td>
        </tr>
        <tr>
         <td align="right" class="label"><span>Rent : </span></td>
         <td align="left" class="show_data"><span></span></td>
        </tr>
        <tr>
         <td align="right" class="label"><span>Rent Type : </span></td>
         <td align="left" class="show_data"><span></span></td>
        </tr>
        <tr>
         <td align="right" class="label"><span>Address : </span></td>
         <td align="left" class="show_data">
          <address></address>
         </td>
        </tr>
        <tr>
         <td align="right" class="label"><span>City : </span></td>
         <td align="left" class="show_data"><span></span></td>
        </tr>
        <tr>
         <td align="right" class="label"><span>Area : </span></td>
         <td align="left" class="show_data"><span></span></td>
        </tr>
        <tr>
         <td align="right" class="label"><span>Details : </span></td>
         <td align="left" class="show_data">
          <address></address>
         </td>
        </tr>
        <tr>
         <td align="center" colspan="2" class="label">
          <h2><u>Contact Information</u></h2>
         </td>
        </tr>
        <tr>
         <td align="right" class="label"><span>Name : </span></td>
         <td align="left" class="show_data"><span></span></td>
        </tr>
        <tr>
         <td align="right" class="label"><span>Phone : </span></td>
         <td align="left" class="show_data"><span></span></td>
        </tr>
        <tr>
         <td align="right" class="label"><span>E-mail : </span></td>
         <td align="left" class="show_data"><span></span></td>
        </tr>
       </table>
      </div>
      <div class="left_section_button">
       <button name="approve" id="approve_btn" class="btn approve_btn" value="">Approve</button>
       <button name="disapprove" id="disapprove_btn" class="btn disapprove_btn" value="">
        Disapprove
       </button>
       <button name="delete" id="left_delete_btn" class="btn delete_btn" value="">Delete</button>
      </div>
     </div>
    </div>
    <div class="right_section">
     <div class="right_section_button">
      <button name="all" id="all_btn" class="btn all_btn">All</button>
      <button name="verified" id="verified_btn" class="btn verified_btn">Verified</button>
      <button name="unverified" id="unverified_btn" class="btn unverified_btn">Unverified</button>
      <button name="delete" id="delete_btn" class="btn delete_btn">Deleted</button>
     </div>
     <div class="right_section_information" id="right_section_information">
      <table class="right_section_table" id="right_section_table">
       <thead>
        <tr>
         <th class="ads_id">Mess ID</th>
         <th class="ads_title">Title</th>
         <th class="ads_status">Status</th>
         <th class="ads_state">State</th>
        </tr>
       </thead>
       <?php
       while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
         <td class="ads_id"><?php echo $row['ads_id']; ?></td>
         <td class="ads_title"><?php echo $row['title']; ?></td>
         <td class="ads_status"><?php echo $row['status']; ?></td>
         <td class="ads_state"><?php echo $row['state']; ?></td>
        </tr>
       <?php }
       ?>
      </table>
     </div>
    </div>
   </div>
  </div>
  <div id="load_details"></div>
 </section>

 <footer>
  <div class="container">
   <p>
    Copyright &copy; 2019 | All Rights Reserved by Student Accommodation
   </p>
  </div>
 </footer>

 <!-- <script src="../JavaScript/header.js"></script> -->

 <script>
  $(document).ready(function () {
   var table = document.getElementById("right_section_table");
   var allButton = document.getElementById("all_btn");
   var verifiedButton = document.getElementById("verified_btn");
   var unverifiedButton = document.getElementById("unverified_btn");
   var deleteButton = document.getElementById("delete_btn");
   var leftSectionDetails = "clicked";
   var prevRowClicked = 0;
   var rowClicked = 0;

   for(var i = 1; i< table.rows.length; i++){
    table.rows[i].onclick = function() {
     prevRowClicked = rowClicked;
     rowClicked = this.rowIndex;

     if(prevRowClicked >= 0){
      table.rows[prevRowClicked].classList.toggle("selected");
     }
      table.rows[rowClicked].classList.toggle("selected");

     var adsId = this.cells[0].innerHTML;
     $('#left_section_information').load('../includes/load_admin_mess_verify_details.inc.php', {
      'mess_ads_id': adsId
     });
    }
   }

   allButton.addEventListener('click', viewAllDetails);
   verifiedButton.addEventListener('click', viewVerifiedDetails);
   unverifiedButton.addEventListener('click', viewUnverifiedDetails);
   deleteButton.addEventListener('click', viewDeleteDetails);

   function viewAllDetails(event) {
    var allButtonValue = event.target.innerText;

    $('#right_section_information').load('../includes/load_admin_mess_verify_details.inc.php', {
     'btn_click': allButtonValue
    });

    $('#left_section').load('../includes/load_admin_mess_verify_details.inc.php', {
     'left_section': leftSectionDetails
    });
   }

   function viewVerifiedDetails(event) {
    var verifiedButtonValue = event.target.innerText;

    $('#right_section_information').load('../includes/load_admin_mess_verify_details.inc.php', {
     'btn_click': verifiedButtonValue
    });

    $('#left_section').load('../includes/load_admin_mess_verify_details.inc.php', {
     'left_section': leftSectionDetails
    });
   }

   function viewUnverifiedDetails(event) {
    var unverifiedButtonValue = event.target.innerText;

    $('#right_section_information').load('../includes/load_admin_mess_verify_details.inc.php', {
     'btn_click': unverifiedButtonValue
    });

    $('#left_section').load('../includes/load_admin_mess_verify_details.inc.php', {
     'left_section': leftSectionDetails
    });
   }

   function viewDeleteDetails(event) {
    var deleteButtonValue = event.target.innerText;

    $('#right_section_information').load('../includes/load_admin_mess_verify_details.inc.php', {
     'btn_click': deleteButtonValue
    });

    $('#left_section').load('../includes/load_admin_mess_verify_details.inc.php', {
     'left_section': leftSectionDetails
    });
   }


   var approveButton = document.getElementById("approve_btn");
   var disapproveButton = document.getElementById("disapprove_btn");
   var leftDeleteButton = document.getElementById("left_delete_btn");
   var adsType = 'mess';

   approveButton.addEventListener('click', approveButtonClicked);
   disapproveButton.addEventListener('click', disapproveButtonClicked);
   leftDeleteButton.addEventListener('click', leftDeleteButtonClicked);

   function approveButtonClicked(event) {
    var buttonText = event.target.innerText;
    var buttonValue = event.target.value;

    $('#load_details').load('../includes/load_admin_mess_verify_details.inc.php', {
     'button_value': buttonValue,
     'button_text': buttonText,
     'ads_type': adsType
    });
    document.getElementById("verified_btn").click();
    document.getElementById("verified_btn").click();

    // $('#left_section_information').load('../includes/load_admin_mess_verify_details.inc.php', {
    //  'mess_ads_id': buttonValue
    // });
   }

   function disapproveButtonClicked(event) {
    var buttonText = event.target.innerText;
    var buttonValue = event.target.value;

    $('#load_details').load('../includes/load_admin_mess_verify_details.inc.php', {
     'button_value': buttonValue,
     'button_text': buttonText,
     'ads_type': adsType
    });
    document.getElementById("unverified_btn").click();
    document.getElementById("unverified_btn").click();

    // $('#left_section_information').load('../includes/load_admin_mess_verify_details.inc.php', {
    //  'mess_ads_id': buttonValue
    // });
   }

   function leftDeleteButtonClicked(event) {
    var buttonText = event.target.innerText;
    var buttonValue = event.target.value;

    $('#load_details').load('../includes/load_admin_mess_verify_details.inc.php', {
     'button_value': buttonValue,
     'button_text': buttonText,
     'ads_type': adsType
    });
    document.getElementById("delete_btn").click();
    document.getElementById("delete_btn").click();

    // $('#left_section_information').load('../includes/load_admin_mess_verify_details.inc.php', {
    //  'mess_ads_id': buttonValue
    // });
   }
  });
 </script>
</body>

</html>