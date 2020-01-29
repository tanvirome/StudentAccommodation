<?php

include "../includes/db_connect.inc.php";

if (isset($_POST['mess_ads_id'])) {
	$ads_id = $_POST['mess_ads_id'];
	$sql = "SELECT * from mess where ads_id = '$ads_id';";
	$result = mysqli_query($conn, $sql);
	while ($row = mysqli_fetch_assoc($result)) {
		$image = $row['photo'];
		$image = explode(",", $image);
		$image1 = current($image);
		?>
		<div class="left_section_information">
			<table class="left_section_table">
				<tr>
					<td align="right" class="label"><span>Title : </span></td>
					<td align="left" class="show_data"><span id="title"><?php echo $row['title']; ?></span></td>
				</tr>
				<tr>
					<td align="center" colspan="2">
						<div class="full_image">
							<img src="<?php echo $image1; ?>" alt="ads image" class="main_full_image" />
						</div>
					</td>
				</tr>
				<tr>
					<td align="center" colspan="2">
						<div class="small_images">
							<?php
									for ($i = 0; $i < count($image); $i++) { ?>
								<div class="small_image">
									<img src="<?php echo $image[$i]; ?>" alt="ads image" class="images" />
								</div>
							<?php } ?>
						</div>
					</td>
				</tr>
				<tr>
					<td align="right" class="label"><span>Available From : </span></td>
					<td align="left" class="show_data"><span><?php echo $row['date']; ?></span></td>
				</tr>
				<tr>
					<td align="right" class="label"><span>Ads For : </span></td>
					<td align="left" class="show_data"><span><?php echo $row['ads_gender']; ?></span></td>
				</tr>
				<tr>
					<td align="right" class="label"><span>Rent : </span></td>
					<td align="left" class="show_data"><span><?php echo $row['rent']; ?></span></td>
				</tr>
				<tr>
					<td align="right" class="label"><span>Rent Type : </span></td>
					<td align="left" class="show_data"><span><?php echo $row['rent_type']; ?></span></td>
				</tr>
				<tr>
					<td align="right" class="label"><span>Address : </span></td>
					<td align="left" class="show_data">
						<address><?php echo $row['address']; ?></address>
					</td>
				</tr>
				<tr>
					<td align="right" class="label"><span>City : </span></td>
					<td align="left" class="show_data"><span><?php echo $row['city']; ?></span></td>
				</tr>
				<tr>
					<td align="right" class="label"><span>Area : </span></td>
					<td align="left" class="show_data"><span><?php echo $row['area']; ?></span></td>
				</tr>
				<tr>
					<td align="right" class="label"><span>Details : </span></td>
					<td align="left" class="show_data">
						<address><?php echo $row['details']; ?></address>
					</td>
				</tr>
				<tr>
					<td align="center" colspan="2" class="label">
						<h2><u>Contact Information</u></h2>
					</td>
				</tr>
				<tr>
					<td align="right" class="label"><span>Name : </span></td>
					<td align="left" class="show_data"><span><?php echo $row['owner_name']; ?></span></td>
				</tr>
				<tr>
					<td align="right" class="label"><span>Phone : </span></td>
					<td align="left" class="show_data"><span><?php echo $row['owner_phone']; ?></span></td>
				</tr>
				<tr>
					<td align="right" class="label"><span>E-mail : </span></td>
					<td align="left" class="show_data"><span><?php echo $row['owner_email']; ?></span></td>
				</tr>
			</table>
		</div>
		<div class="left_section_button">
			<button name="approve" id="approve_btn" class="btn approve_btn" value="<?php echo $ads_id; ?>">Approve</button>
			<button name="disapprove" id="disapprove_btn" class="btn disapprove_btn" value="<?php echo $ads_id; ?>">
				Disapprove
			</button>
			<button name="delete" id="left_delete_btn" class="btn delete_btn" value="<?php echo $ads_id; ?>">Delete</button>
		</div>

		<script>
			var image_btn = document.getElementsByClassName('images');

			for (var i = 0; i < image_btn.length; i++) {
				var images_click = image_btn[i];
				images_click.addEventListener('click', imagesClicked);
			}

			function imagesClicked(event) {
				var image = event.target;
				var small_image_src = image.src;
				// console.log(image.src);
				var parent = image.parentElement.parentElement.parentElement.parentElement.parentElement;
				// console.log(image.parentElement.parentElement.parentElement);
				// var main_image_src = parent.getElementsByClassName('main_full_image')[0].src;
				parent.getElementsByClassName('main_full_image')[0].src = small_image_src;
			}
		</script>
		
		<script>
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
		</script>


	<?php
		}
	} else if (isset($_POST['btn_click'])) {
		$button_value = $_POST['btn_click'];
		if ($button_value == "All") {
			$sql = "SELECT * FROM mess;";
			$result = mysqli_query($conn, $sql);
		} else if($button_value == "Verified"){
			$sql = "SELECT * FROM mess WHERE status = 'verified' AND state = 'active';";
			$result = mysqli_query($conn, $sql);
		} else if($button_value == "Unverified"){
			$sql = "SELECT * FROM mess WHERE status = 'unverified' AND state = 'active';";
			$result = mysqli_query($conn, $sql);
		} else if($button_value == "Deleted"){
			$sql = "SELECT * FROM mess WHERE state = 'deactive';";
			$result = mysqli_query($conn, $sql);
		}
		?>
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
		<script>
			var table = document.getElementById("right_section_table");
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
     // this.classList.toggle("selected");

     var adsId = this.cells[0].innerHTML;
     $('#left_section_information').load('../includes/load_admin_mess_verify_details.inc.php', {
      'mess_ads_id': adsId
     });
    }
   }
		</script>
	
	<?php
	} else if (isset($_POST['button_text'])) {
		$button_value = $_POST['button_text'];
		$ads_id = $_POST['button_value'];
		$ads_type = $_POST['ads_type'];
		if ($button_value == "Approve") {
			$sql = "UPDATE all_ads SET status ='verified', state ='active' WHERE ads_id = $ads_id AND ads_type = '$ads_type';";
			mysqli_query($conn, $sql);
			$sql = "UPDATE mess SET status='verified', state ='active' WHERE ads_id = $ads_id;";
			mysqli_query($conn, $sql);
		} else if ($button_value == "Disapprove") {
			$sql = "UPDATE all_ads SET status ='unverified' WHERE ads_id = $ads_id AND ads_type = '$ads_type';";
			mysqli_query($conn, $sql);
			$sql = "UPDATE mess SET status='unverified' WHERE ads_id = $ads_id;";
			mysqli_query($conn, $sql);
		} else if ($button_value == "Delete") {
			$sql = "UPDATE all_ads SET state = 'deactive' WHERE ads_id = $ads_id AND ads_type = '$ads_type';";
			mysqli_query($conn, $sql);
			$sql = "UPDATE mess SET state = 'deactive' WHERE ads_id = $ads_id;";
			mysqli_query($conn, $sql);
		}
	} else if (isset($_POST['left_section'])) {
	?>
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
					</td>
				</tr>
				<tr>
					<td align="center" colspan="2">
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
			<button name="approve" class="btn approve_btn" value="">Approve</button>
			<button name="disapprove" class="btn disapprove_btn" value="">
				Disapprove
			</button>
			<button name="delete" class="btn delete_btn" value="">Delete</button>
		</div>
	</div>
<?php
}
?>