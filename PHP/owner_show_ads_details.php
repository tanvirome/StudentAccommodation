<?php

include "../includes/db_connect.inc.php";
include "../includes/header.inc.php";
include "../includes/footer.inc.php";
include "../includes/flat_details.inc.php";
include "../includes/mess_details.inc.php";
include "../includes/sublet_details.inc.php";
include "../includes/ads_comments.inc.php";

session_start();

if (!isset($_SESSION["username"])) {
 header("Location: index.php");
}

$username = $_SESSION['username'];
$user_id = $_SESSION['user_id'];
$user_name = $_SESSION['name'];
$user_type = $_SESSION['user_type'];

$details_btn_data = $ads_id = $ads_type = $comment = "";

if (isset($_SESSION["details_btn"])) {
 $details_btn_data = $_SESSION["details_btn"];
 $details_btn_data_array = explode(",", $details_btn_data);
 $ads_id = current($details_btn_data_array);
 $ads_type = end($details_btn_data_array);
 unset($_SESSION['details_btn']);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
 if(isset($_POST['details_btn'])){
  $details_btn_data = $_POST['details_btn'];
  $details_btn_data_array = explode(",", $details_btn_data);
  $ads_id = current($details_btn_data_array);
  $ads_type = end($details_btn_data_array);
 }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <meta http-equiv="X-UA-Compatible" content="ie=edge">
 <!-- To Add Icon -->
 <link rel="stylesheet" href="../icon/fontawesome_icon/css/all.css" />
 <!-- CSS -->
 <link rel="stylesheet" href="../CSS/style.css" />
 <title>Ads Details</title>
</head>

<body>

 <?php echo after_login_owner_header("myads"); ?>

 <?php
 if ($ads_type == "flat") {
  echo flat_details($ads_id, $ads_type, $user_type);
 }
 if ($ads_type == "mess") {
  echo mess_details($ads_id, $ads_type, $user_type);
 }
 if ($ads_type == "sublet") {
  echo sublet_details($ads_id, $ads_type, $user_type);
 }
 ?>

 <?php echo ads_comments($ads_id, $ads_type, $user_id, $username, $user_name); ?>

 <?php echo footer(); ?>

</body>

</html>