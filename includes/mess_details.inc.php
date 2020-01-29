<?php

function mess_details($ads_id, $ads_type, $user_type)
{
 include "../includes/db_connect.inc.php";

 $image1 = $image2 = $image3 = $image4 = $image5 = "";

 $sql = "SELECT * FROM $ads_type WHERE ads_id = $ads_id;";
 $result = mysqli_query($conn, $sql);


 while ($row = mysqli_fetch_assoc($result)) {

  $image = $row['photo'];
  $image = explode(",", $image);
  $image1 = current($image);
  ?>
  <!-- $image2 = next($image);
		$image3 = next($image);
		$image4 = next($image);
		$image5 = end($image); -->

  <section class="flat_details_section">
   <div class="container">
    <div style="margin-top: 20px;">
     <div class="ads_images">
      <div class="full_image">
       <img src="<?php echo $image1; ?>" alt="ads image" class="main_full_image" />
      </div>
      <div class="small_images">
       <?php
         for ($i = 0; $i < count($image); $i++) { ?>
        <div class="small_image">
         <img src="<?php echo $image[$i]; ?>" alt="ads image" class="images" />
        </div>
       <?php } ?>
       <!-- <div class="small_image">
								<img src="../images/image1.jpg" alt="ads image" />
							</div>
							<div class="small_image">
								<img src="../images/image2.jpg" alt="ads image" />
							</div>
							<div class="small_image">
								<img src="../images/image3.jpg" alt="ads image" />
							</div>
							<div class="small_image">
								<img src="../images/image1.jpg" alt="ads image" />
							</div>
							<div class="small_image">
								<img src="../images/image2.jpg" alt="ads image" />
							</div> -->
      </div>
     </div>
     <div class="ads_information">
      <h3 class="information ads_title"><?php echo $row['title']; ?></h3>
      <br />
      <label class="information"><b>Area:</b> <?php echo $row['area']; ?>, <?php echo $row['city']; ?></label>
      <br />
      <label class="information"><b>Category:</b> <?php echo $row['ads_type']; ?></label>
      <br />
      <label class="information"><b>Rent:</b> <?php echo $row['rent']; ?> Taka/month (<b><?php echo $row['rent_type']; ?></b>)</label>
      <br />
      <?php if($user_type == "owner"){ ?>
        <label class="information"><b>Status:</b> <?php echo $row['status']; ?> </label>
      <br />
      <?php } ?>
      <label class="information"><b>Gender Preferable:</b> <?php echo $row['ads_gender']; ?></label>
      <br />
      <label class="information"><b>Available From:</b> <?php echo $row['date']; ?></label>
      <br />
      <address class="information">
       <b>Address:</b> <?php echo $row['address']; ?>
      </address>
      <address class="information">
       <b>Details:</b> <?php echo $row['details']; ?>
      </address>
     </div>
    </div>
   </div>
   <div class="container">
    <div>
     <div class="ads_contact_information">
      <h2><u>Contact Information</u></h2>
      <label class="information info"><b>Name:</b> <?php echo $row['owner_name']; ?></label>
      <br />
      <label class="information info"><b>Phone number:</b> <?php echo $row['owner_phone']; ?></label>
      <br />
      <label class="information info"><b>E-mail:</b> <?php echo $row['owner_email']; ?></label>
     </div>
    </div>
   </div>
  </section>

  <script>
   var image_btn = document.getElementsByClassName('images');

   for (var i = 0; i < image_btn.length; i++) {
    var images_click = image_btn[i];
    images_click.addEventListener('click', imagesClicked);
   }

   function imagesClicked(event) {
    var image = event.target;
    var small_image_src = image.src;
    var parent = image.parentElement.parentElement.parentElement;
    // var main_image_src = parent.getElementsByClassName('main_full_image')[0].src;
    parent.getElementsByClassName('main_full_image')[0].src = small_image_src;
   }
  </script>
<?php
 }
}
?>