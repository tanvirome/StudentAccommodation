<?php

$visitor_email = $_POST['feedback_email'];
$message = $_POST['feedback_msg'];


$email_from = 'ome0011@gmail.com';

$email_subject = "Feedback From StudentAccommodation User";

// "User Name: $name.\n".
$email_body = "You have a feedback message from " . $visitor_email . "\n\n" . "Feedback Message: $message.\n";

// $to = 'ome0011@gmail.com';
$to = "tanvirome878@gmail.com";
// $to = "sbirouzumaki@hotmail.com";

$headers = "From: " . $email_from;

// $headers .= "Reply To: $visitor_email \r\n";

mail($to, $email_subject, $email_body, $headers);

// header("Location: Website Name");
