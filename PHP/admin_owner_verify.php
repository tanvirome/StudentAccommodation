<?php

include "../includes/db_connect.inc.php";
include "../includes/header.inc.php";

session_start();
if (!isset($_SESSION["admin_username"])) {
 header("Location: admin_login.php");
}

$sql = "SELECT * from owner;";
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
 <title>Owner Verify</title>
</head>

<body>
 <?php echo after_login_admin_header("veirfy"); ?>

 <section class="owner_verify_section">
  <div class="container">
   <div class="verify_details">
    <div class="left_section" id="left_section">
     <div>
      <h1>Owner Details</h1>
     </div>
     <div id="left_section_information">
      <div class="left_section_information">
       <table class="left_section_table">
        <tr>
         <td align="right" class="label"><span>Name : </span></td>
         <td align="left" class="show_data"><span id="name"></span></td>
        </tr>
        <tr>
         <td align="right" class="label"><span>Username : </span></td>
         <td align="left" class="show_data"><span></span></td>
        </tr>
        <tr>
         <td align="right" class="label"><span>E-mail : </span></td>
         <td align="left" class="show_data"><span></span></td>
        </tr>
        <tr>
         <td align="right" class="label"><span>Phone : </span></td>
         <td align="left" class="show_data"><span></span></td>
        </tr>
        <tr>
         <td align="right" class="label"><span>NID : </span></td>
         <td align="left" class="show_data"><span></span></td>
        </tr>
        <!-- <tr>
         <td align="right" class="label"><span>Status : </span></td>
         <td align="left" class="show_data"><span></span></td>
        </tr>
        <tr>
         <td align="right" class="label"><span>State : </span></td>
         <td align="left" class="show_data"><span></span></td>
        </tr> -->
        <tr>
         <td align="right" class="label"><span>Address : </span></td>
         <td align="left" class="show_data">
          <address></address>
         </td>
        </tr>
        <tr>
         <td align="right" class="label"><span>Gender : </span></td>
         <td align="left" class="show_data"><span></span></td>
        </tr>
        <tr>
         <td align="right" class="label"><span>Date of Birth : </span></td>
         <td align="left" class="show_data">
          <address></address>
         </td>
        </tr>
        <tr>
         <td align="right" class="label"><span>Religion : </span></td>
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
         <th class="user_id">Owner ID</th>
         <th class="user_name">Name</th>
         <th class="user_status">Status</th>
         <th class="user_state">State</th>
        </tr>
       </thead>
       <?php
       while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
         <td class="user_id"><?php echo $row['user_id']; ?></td>
         <td class="user_name"><?php echo $row['name']; ?></td>
         <td class="user_status"><?php echo $row['status']; ?></td>
         <td class="user_state"><?php echo $row['state']; ?></td>
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

     var userId = this.cells[0].innerHTML;
     $('#left_section_information').load('../includes/load_admin_owner_verify_details.inc.php', {
      'user_id': userId
     });
    }
   }

   allButton.addEventListener('click', viewAllDetails);
   verifiedButton.addEventListener('click', viewVerifiedDetails);
   unverifiedButton.addEventListener('click', viewUnverifiedDetails);
   deleteButton.addEventListener('click', viewDeleteDetails);

   function viewAllDetails(event) {
    var allButtonValue = event.target.innerText;

    $('#right_section_information').load('../includes/load_admin_owner_verify_details.inc.php', {
     'btn_click': allButtonValue
    });

    $('#left_section').load('../includes/load_admin_owner_verify_details.inc.php', {
     'left_section': leftSectionDetails
    });
   }

   function viewVerifiedDetails(event) {
    var verifiedButtonValue = event.target.innerText;

    $('#right_section_information').load('../includes/load_admin_owner_verify_details.inc.php', {
     'btn_click': verifiedButtonValue
    });

    $('#left_section').load('../includes/load_admin_owner_verify_details.inc.php', {
     'left_section': leftSectionDetails
    });
   }

   function viewUnverifiedDetails(event) {
    var unverifiedButtonValue = event.target.innerText;

    $('#right_section_information').load('../includes/load_admin_owner_verify_details.inc.php', {
     'btn_click': unverifiedButtonValue
    });

    $('#left_section').load('../includes/load_admin_owner_verify_details.inc.php', {
     'left_section': leftSectionDetails
    });
   }

   function viewDeleteDetails(event) {
    var deleteButtonValue = event.target.innerText;

    $('#right_section_information').load('../includes/load_admin_owner_verify_details.inc.php', {
     'btn_click': deleteButtonValue
    });

    $('#left_section').load('../includes/load_admin_owner_verify_details.inc.php', {
     'left_section': leftSectionDetails
    });
   }


   var approveButton = document.getElementById("approve_btn");
   var disapproveButton = document.getElementById("disapprove_btn");
   var leftDeleteButton = document.getElementById("left_delete_btn");

   approveButton.addEventListener('click', approveButtonClicked);
   disapproveButton.addEventListener('click', disapproveButtonClicked);
   leftDeleteButton.addEventListener('click', leftDeleteButtonClicked);

   function approveButtonClicked(event) {
    var buttonText = event.target.innerText;
    var buttonValue = event.target.value;

    $('#load_details').load('../includes/load_admin_owner_verify_details.inc.php', {
     'button_value': buttonValue,
     'button_text': buttonText
    });
    document.getElementById("verified_btn").click();
    document.getElementById("verified_btn").click();

    // $('#left_section_information').load('../includes/load_admin_owner_verify_details.inc.php', {
    //  'user_id': buttonValue
    // });
   }

   function disapproveButtonClicked(event) {
    var buttonText = event.target.innerText;
    var buttonValue = event.target.value;

    $('#load_details').load('../includes/load_admin_owner_verify_details.inc.php', {
     'button_value': buttonValue,
     'button_text': buttonText
    });
    document.getElementById("unverified_btn").click();
    document.getElementById("unverified_btn").click();

    // $('#left_section_information').load('../includes/load_admin_owner_verify_details.inc.php', {
    //  'user_id': buttonValue
    // });
   }

   function leftDeleteButtonClicked(event) {
    var buttonText = event.target.innerText;
    var buttonValue = event.target.value;

    $('#load_details').load('../includes/load_admin_owner_verify_details.inc.php', {
     'button_value': buttonValue,
     'button_text': buttonText
    });
    document.getElementById("delete_btn").click();
    document.getElementById("delete_btn").click();

    // $('#left_section_information').load('../includes/load_admin_owner_verify_details.inc.php', {
    //  'user_id': buttonValue
    // });
   }
  });
 </script>
</body>

</html>