<?php

include "../includes/db_connect.inc.php";

$error = '';
$comment_content = '';
$ads_id = $_POST["ads_id"];
$ads_type = $_POST["ads_type"];
// echo $ads_id;
// echo $ads_type;
$user_id = $_POST["user_id"];
$username = $_POST["username"];
$name = $_POST["name"];

if (empty($_POST["comment_content"])) {
 $error .= '<p class="text-danger">Comment is required</p>';
} else {
 $comment_content = $_POST["comment_content"];
}

if ($error == '') {
 $sql = "INSERT INTO ads_comments (ads_id, ads_type, username, user_id, name, comments) VALUES ('$ads_id', '$ads_type', '$username', '$user_id', '$name', '$comment_content');";

 mysqli_query($conn, $sql);
 $error = 'Comment Added';
}

$data = array(
 'error'  => $error
);

echo json_encode($data);

?>

<!-- <label class="text-success">Comment Added</label> -->