<?php

include "../includes/db_connect.inc.php";

$user_type = $button_id = $search_title = $search_area = $ads_perpage = $ads_type = $min_rent = $max_rent = "";
if (isset($_POST['button_id'])) {
 $button_id = $_POST['button_id'];
}
$user_type = $_POST['user_type'];

if (!empty($_POST['search_title'])) {
 $search_title = $_POST['search_title'];
}

if (!empty($_POST['search_area'])) {
 $search_area = $_POST['search_area'];
}

if (!empty($_POST['min_rent'])) {
 $min_rent = $_POST['min_rent'];
}

if (!empty($_POST['max_rent'])) {
 $max_rent = $_POST['max_rent'];
}

if (!empty($_POST['ads_type'])) {
 $ads_type = $_POST['ads_type'];
}

$ads_perpage = $_POST['ads_perpage'];

$start_value = 0;

if (isset($_POST['start_value'])) {
 $start_value = $_POST['start_value'];
} else {
 if ($button_id == 0) {
  $button_id = 1;
 }
 $button_id = $button_id - 1;
 $start_value = $button_id * $ads_perpage;
}


if ($user_type == "student") {
 $sql = "SELECT * FROM all_ads WHERE ads_type = '$ads_type' AND status = 'verified' AND state = 'active' LIMIT $start_value, $ads_perpage;";
 $result = mysqli_query($conn, $sql);

 if ($min_rent == "" && $max_rent == "" && $search_area == "" && $search_title == "") {
  $sql = "SELECT * FROM all_ads WHERE ads_type = '$ads_type' AND status = 'verified' AND state = 'active' LIMIT $start_value, $ads_perpage;";
  $result = mysqli_query($conn, $sql);
 } else {
  if ($search_title == "" && $search_area == "all" && $min_rent == "" && $max_rent == "") {
   $sql = "SELECT * FROM all_ads WHERE ads_type = '$ads_type' AND status = 'verified' AND state = 'active' LIMIT $ads_perpage;";
   $result = mysqli_query($conn, $sql);
  } else if ($search_title == "" && $search_area != "all" && $min_rent == "" && $max_rent == "") {
   $sql = "SELECT * FROM all_ads WHERE ads_type = '$ads_type' AND status = 'verified' AND state = 'active' AND area = '$search_area' LIMIT $ads_perpage;";
   $result = mysqli_query($conn, $sql);
  } else if ($search_title != "" && $search_area == "all" && $min_rent == "" && $max_rent == "") {
   $sql = "SELECT * FROM all_ads WHERE ads_type = '$ads_type' AND status = 'verified' AND state = 'active' AND title LIKE '%$search_title%' LIMIT $ads_perpage;";
   $result = mysqli_query($conn, $sql);
  } else if ($search_title == "" && $search_area == "all" && $min_rent != "" && $max_rent != "") {
   $sql = "SELECT * FROM all_ads WHERE ads_type = '$ads_type' AND status = 'verified' AND state = 'active' AND rent between $min_rent AND $max_rent LIMIT $ads_perpage;";
   $result = mysqli_query($conn, $sql);
  } else if ($search_title != "" && $search_area != "all" && $min_rent == "" && $max_rent == "") {
   $sql = "SELECT * FROM all_ads WHERE ads_type = '$ads_type' AND status = 'verified' AND state = 'active' AND title LIKE '%$search_title%' AND area = '$search_area' LIMIT $ads_perpage;";
   $result = mysqli_query($conn, $sql);
  } else if ($search_title != "" && $search_area == "all" && $min_rent != "" && $max_rent != "") {
   $sql = "SELECT * FROM all_ads WHERE ads_type = '$ads_type' AND status = 'verified' AND state = 'active' AND title LIKE '%$search_title%' AND rent between $min_rent AND $max_rent LIMIT $ads_perpage;";
   $result = mysqli_query($conn, $sql);
  } else if ($search_title == "" && $search_area != "all" && $min_rent != "" && $max_rent != "") {
   $sql = "SELECT * FROM all_ads WHERE ads_type = '$ads_type' AND status = 'verified' AND state = 'active' AND area = '$search_area' AND rent between $min_rent AND $max_rent LIMIT $ads_perpage;";
   $result = mysqli_query($conn, $sql);
  } else if ($search_title != "" && $search_area != "all" && $min_rent != "" && $max_rent != "") {
   $sql = "SELECT * FROM all_ads WHERE ads_type = '$ads_type' AND status = 'verified' AND state = 'active' AND title LIKE '%$search_title%' AND area = '$search_area' AND rent between $min_rent AND $max_rent LIMIT $ads_perpage;";
   $result = mysqli_query($conn, $sql);
  }
 }
} ?>

<?php
while ($row = mysqli_fetch_assoc($result)) { ?>
 <fieldset>
  <div class="ads_image">
   <?php
   $images_paths = $row['photo'];
   $images_path = explode(',', $images_paths);
   // $first_image_path = end($images_path);
   $first_image_path = current($images_path);
   ?>
   <img src="<?php echo $first_image_path; ?>" alt="ads image" width="150px" height="150px" />
  </div>
  <div class="ads_details">
   <div class="ads_details_text">
    <!-- <label class="ads_details_text_label"><a href="" class="title"><?php echo $row['title']; ?></a>
    </label> -->
    <span class="ads_details_text_label title" id="title"><?php echo $row['title']; ?>
    </span>
    <br />
    <label class="ads_details_text_label">Ad Type: <?php echo $row['ads_type']; ?></label>
    <br />
    <label class="ads_details_text_label"><?php echo $row['area']; ?></label>
    <br />
    <label class="ads_details_text_label"><?php echo $row['ads_gender']; ?></label>
    <br />
    <label class="ads_details_text_label">Rent: <?php echo $row['rent']; ?> Tk./month</label>
   </div>
   <div class="ads_details_btn">
    <?php
    $ads_id = $row['ads_id'];
    $ads_type = $row['ads_type'];
    $details_btn_data = $ads_id . "," . $ads_type;
    ?>
    <form action="student_show_ads_details.php" method="post" class="details_btn1">
     <button type="submit" class="btn details details_btn" name="details_btn" value="<?php echo $details_btn_data; ?>">View Details</button>
    </form>
   </div>
  </div>
 </fieldset>
<?php
 // $flat_ads_count = $flat_ads_count - 1;
} ?>

<script>
 // $(document).ready(function() {
 var title = document.getElementsByClassName('title');
 for (var i = 0; i < title.length; i++) {
  var each_title = title[i];
  each_title.addEventListener('click', viewDetails);
 }

 function viewDetails(event) {
  var title = event.target;
  var ads_details = title.parentElement.parentElement;
  var details_btn = ads_details.getElementsByClassName('details_btn')[0];
  details_btn.click();
 }
 // });
</script>