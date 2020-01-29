<?php

function ads_comments($ads_id, $ads_type, $user_id, $username, $name)
{
	include "../includes/db_connect.inc.php";

	$commentsCount = 0;

	$sql = "SELECT * FROM ads_comments WHERE ads_id = '$ads_id' AND ads_type = '$ads_type';";
	$result = mysqli_query($conn, $sql);
	$commentsCount = mysqli_num_rows($result);

?>

	<section class="comments_section">
		<div class="container">
			<div class="container">
				<div style="margin: 20px 0;">
					<form method="POST" id="comment_form">
						<input type="text" name="comment_content" id="comment_content" placeholder="Write your comment..." required class="comment_input" />

						<input type="hidden" name="ads_id" id="ads_id" value="<?php echo $ads_id; ?>" />
						<input type="hidden" name="ads_type" id="ads_type" value="<?php echo $ads_type; ?>" />
						<input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id; ?>" />
						<input type="hidden" name="username" id="username" value="<?php echo $username; ?>" />
						<input type="hidden" name="name" id="name" value="<?php echo $name; ?>" />
						<!-- <button type="button" class="btn post_btn" name="post_btn" id="post_btn">POST</button> -->
						<button type="submit" class="btn post_btn" name="post_btn" id="post_btn" value="post_btn">POST</button>
						<br>
						<span id="comment_message"></span>
					</form>
				</div>
			</div>
		</div>

		<div class="container">
			<div class="container">
				<div id="showComments">
					<?php
					if ($commentsCount != 0) { ?>
						<div>
							<h3>Comments</h3>
							<div style="margin: 10px 0; border-top: #000000 1px solid;"></div>
						</div>
						<?php
						while ($row = mysqli_fetch_assoc($result)) { ?>
							<div class="showComments">
								<div style="margin: 20px 0;">
									<span class="user_name"><?php echo $row['name']; ?></span>
									<br />
									<br />
									<span class="comments">
										<?php echo $row['comments']; ?>
									</span>
								</div>
								<div style="margin: 10px 0; border-bottom: #000000 1px solid;"></div>
							</div>
					<?php
						}
					} ?>
				</div>
			</div>
		</div>

	</section>
	<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
	<script>
		$(document).ready(function() {
			$('#comment_form').on('submit', function(event) {
				event.preventDefault();
				var form_data = $(this).serialize();
				$.ajax({
					url: "../includes/addComment.inc.php",
					method: "POST",
					data: form_data,
					dataType: "JSON",
					success: function(data) {
						if (data.error != '') {
							// document.getElementById("comment_content").value = "";
							$('#comment_message').html(data.error);
						}
					}
				})
				document.getElementById("comment_content").value = "";

			});

			$('#comment_form').on('submit', function(event) {
				var id = document.getElementById("ads_id").value;
				var type = document.getElementById('ads_type').value;
				$('#showComments').load('../includes/fetch_comment.inc.php', {
					'ads_id': id,
					'ads_type': type
				});
			});


			// $(document).on('click', '.reply', function() {
			// 	var comment_id = $(this).attr("id");
			// 	$('#comment_id').val(comment_id);
			// 	$('#comment_name').focus();
			// });

		});
	</script>
<?php
}
?>