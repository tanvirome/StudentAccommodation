<?php

include "../includes/db_connect.inc.php";

if (isset($_POST['user_id'])) {
	$user_id = $_POST['user_id'];
	$sql = "SELECT * from owner where user_id = $user_id;";
	$result = mysqli_query($conn, $sql);
	while ($row = mysqli_fetch_assoc($result)) {
		?>
		<div class="left_section_information">
			<table class="left_section_table">
				<tr>
					<td align="right" class="label"><span>Name : </span></td>
					<td align="left" class="show_data"><span id="name"><?php echo $row['name']; ?></span></td>
				</tr>
				<tr>
					<td align="right" class="label"><span>Username : </span></td>
					<td align="left" class="show_data"><span><?php echo $row['username']; ?></span></td>
				</tr>
				<tr>
					<td align="right" class="label"><span>E-mail : </span></td>
					<td align="left" class="show_data"><span><?php echo $row['email']; ?></span></td>
				</tr>
				<tr>
					<td align="right" class="label"><span>Phone : </span></td>
					<td align="left" class="show_data"><span><?php echo $row['phone']; ?></span></td>
				</tr>
				<tr>
					<td align="right" class="label"><span>NID : </span></td>
					<td align="left" class="show_data"><span><?php echo $row['nid']; ?></span></td>
				</tr>
				<!-- <tr>
					<td align="right" class="label"><span>Status : </span></td>
					<td align="left" class="show_data"><span><?php echo $row['status']; ?></span></td>
				</tr> -->
				<!-- <tr>
					<td align="right" class="label"><span>State : </span></td>
					<td align="left" class="show_data"><span><?php echo $row['state']; ?></span></td>
				</tr> -->
				<tr>
					<td align="right" class="label"><span>Address : </span></td>
					<td align="left" class="show_data">
						<address><?php echo $row['address']; ?></address>
					</td>
				</tr>
				<tr>
					<td align="right" class="label"><span>Gender : </span></td>
					<td align="left" class="show_data"><span><?php echo $row['gender']; ?></span></td>
				</tr>
				<tr>
					<td align="right" class="label"><span>Date of Birth : </span></td>
					<td align="left" class="show_data">
						<span><?php echo $row['date_of_birth']; ?></span>
					</td>
				</tr>
				<tr>
					<td align="right" class="label"><span>Religion : </span></td>
					<td align="left" class="show_data"><span><?php echo $row['religion']; ?></span></td>
				</tr>
			</table>
		</div>
		<div class="left_section_button">
			<button name="approve" id="approve_btn" class="btn approve_btn" value="<?php echo $user_id; ?>">Approve</button>
			<button name="disapprove" id="disapprove_btn" class="btn disapprove_btn" value="<?php echo $user_id; ?>">
				Disapprove
			</button>
			<button name="delete" id="left_delete_btn" class="btn delete_btn" value="<?php echo $user_id; ?>">Delete</button>
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
		</script>

	<?php
		}
	} else if (isset($_POST['btn_click'])) {
		$button_value = $_POST['btn_click'];
		if ($button_value == "All") {
			$sql = "SELECT * FROM owner;";
			$result = mysqli_query($conn, $sql);
		} else if($button_value == "Verified"){
			$sql = "SELECT * FROM owner WHERE status = 'verified' AND state = 'active';";
			$result = mysqli_query($conn, $sql);
		} else if($button_value == "Unverified"){
			$sql = "SELECT * FROM owner WHERE status = 'unverified' AND state = 'active';";
			$result = mysqli_query($conn, $sql);
		} else if($button_value == "Deleted"){
			$sql = "SELECT * FROM owner WHERE state = 'deactive';";
			$result = mysqli_query($conn, $sql);
		}
			?>
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

     var userId = this.cells[0].innerHTML;
     $('#left_section_information').load('../includes/load_admin_owner_verify_details.inc.php', {
      'user_id': userId
     });
    }
   }
		</script>
	<?php
	} else if (isset($_POST['button_text'])) {
		$button_value = $_POST['button_text'];
		$user_id = $_POST['button_value'];

		if ($button_value == "Approve") {
			$sql = "UPDATE owner SET status='verified', state = 'active' WHERE user_id = $user_id;";
			mysqli_query($conn, $sql);
		} else if ($button_value == "Disapprove") {
			$sql = "UPDATE owner SET status='unverified' WHERE user_id = $user_id;";
			mysqli_query($conn, $sql);
		} else if ($button_value == "Delete") {
			$sql = "UPDATE owner SET state = 'deactive' WHERE user_id = $user_id;";
			mysqli_query($conn, $sql);
		}

	} else if (isset($_POST['left_section'])) {
		?>
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
<?php
}
?>
