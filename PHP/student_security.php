<?php

include "../includes/db_connect.inc.php";
include "../includes/header.inc.php";
include "../includes/footer.inc.php";

session_start();

if (!isset($_SESSION["username"])) {
 header("Location: index.php");
}

$username = $_SESSION["username"];
$user_id = $_SESSION["user_id"];
// $_SESSION['username'] = $username;

$old_pass = $new_pass = $confirm_new_pass = $user_DB_pass = "";

$err1 = $err2 = $err3 = "";
$errmsg1 = $errmsg2 = "";

$success_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
 if (isset($_POST['pass_change_button'])) {
  if (!empty($_POST['old_pass'])) {
   $old_pass = mysqli_real_escape_string($conn, $_POST['old_pass']);
  } else {
   $err1 = "This field can't be empty";
  }

  if (!empty($_POST['new_pass'])) {
   $new_pass = mysqli_real_escape_string($conn, $_POST['new_pass']);
  } else {
   $err2 = "This field can't be empty";
  }

  if (!empty($_POST['confirm_new_pass'])) {
   $confirm_new_pass = mysqli_real_escape_string($conn, $_POST['confirm_new_pass']);
  } else {
   $err3 = "This field can't be empty";
  }

  if ($err1 == "" && $err2 == "" && $err3 == "") {
   $sqlUserCheck = "SELECT password FROM student WHERE username = '$username' and state = 'active';";
   $result = mysqli_query($conn, $sqlUserCheck);
   $rowCount = mysqli_num_rows($result);
   while ($row = mysqli_fetch_assoc($result)) {
    $user_DB_pass = $row['password'];
   }
   if (password_verify($old_pass, $user_DB_pass)) {
    if ($new_pass == $confirm_new_pass) {
     $user_passwordToDB = password_hash($new_pass, PASSWORD_DEFAULT);
     $sql = "UPDATE student SET password='$user_passwordToDB' WHERE username = '$username';";

     mysqli_query($conn, $sql);
     $_SESSION['username'] = $username;
     $_SESSION['user_id'] = $user_id;
     $success_message = "Password Changed Successfully!!!";
    } else {
     $errmsg2 = "New Password Not Match!";
    }
   } else {
    $errmsg1 = "Wrong Password!";
   }
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
 <title>Security</title>
</head>

<body>
 <?php echo after_login_student_header("dashboard"); ?>

 <section id="security_section">
  <div class="container">
   <div class="side_navigation">
    <h4><strong>Dashboard</strong></h4>
    <nav>
     <ul>
      <li id="profile_li">
       <a href="student_profile.php" id="profile_a">Profile</a>
      </li>
      <li class="current" id="security_li">
       <a href="student_security.php" id="security_a">Security</a>
      </li>
      <li id="information_li">
       <a href="student_edit_information.php" id="information_a">Edit Information</a>
      </li>
     </ul>
    </nav>
   </div>

   <div class="change_password">
    <span style="margin: 15px 0 15px 20px; color: #33cc33;"><?php echo $success_message; ?></span>
    <form action="owner_security.php" method="post">
     <table>
      <tr>
       <td class="label">
        <label for="old_pass">
         Old Password : <span class="required">*</span>
        </label>
       </td>
       <td>
        <input type="password" name="old_pass" id="old_pass" class="change_pass_input" required />
       </td>
      </tr>

      <tr>
       <td style="height:fit-content"></td>
       <td style="height:fit-content; font-size:13px">
        <span style="color:red;"><?php echo $errmsg1; ?></span>
        <span style="color:red;"><?php echo $err1; ?></span>
       </td>
      </tr>

      <tr>
       <td class="label">
        <label for="new_pass">
         New Password : <span class="required">*</span>
        </label>
       </td>
       <td>
        <input type="password" name="new_pass" id="new_pass" class="change_pass_input" required />
       </td>
      </tr>

      <tr>
       <td style="height:fit-content"></td>
       <td style="height:fit-content; font-size:13px">
        <span style="color:red;"><?php echo $err2; ?></span>
       </td>
      </tr>

      <tr>
       <td class="label">
        <label for="confirm_new_pass">
         Confirm New Password : <span class="required">*</span>
        </label>
       </td>
       <td>
        <input type="password" name="confirm_new_pass" id="confirm_new_pass" class="change_pass_input" required />
       </td>
      </tr>

      <tr>
       <td style="height:fit-content"></td>
       <td style="height:fit-content; font-size:13px">
        <span style="color:red;"><?php echo $errmsg2; ?></span>
        <span style="color:red;"><?php echo $err3; ?></span>
       </td>
      </tr>

      <tr>
       <td colspan="2">
        <button type="submit" id="pass_change_button" name="pass_change_button">
         Change Password
        </button>
       </td>
      </tr>
     </table>
    </form>

   </div>
  </div>
 </section>

 <?php echo footer(); ?>

 <script>
  var profile_li = document.getElementById("profile_li");
  var profile_a = document.getElementById("profile_a");
  var security_li = document.getElementById("security_li");
  var security_a = document.getElementById("security_a");
  var information_li = document.getElementById("information_li");
  var information_a = document.getElementById("information_a");

  profile_li.addEventListener("click", function() {
   profile_a.click();
  });
  security_li.addEventListener("click", function() {
   security_a.click();
  });
  information_li.addEventListener("click", function() {
   information_a.click();
  });
 </script>
 <!-- <script src="../JavaScript/header.js"></script> -->
</body>

</html>