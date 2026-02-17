<?php
include "../connection.php";

$id = $_POST['id'];
$reply = $_POST['reply'];

// get user email
$q = mysqli_query($connection, "SELECT email FROM contact_queries WHERE id=$id");
$row = mysqli_fetch_assoc($q);
$userEmail = $row['email'];

// save reply in DB
mysqli_query($connection, "UPDATE contact_queries 
SET admin_reply='$reply', status='Replied' WHERE id=$id");

// send email
$subject = "Response to your query";
$message = "Admin Reply:\n\n".$reply;
$headers = "From: fooddonation@gmail.com";

mail($userEmail, $subject, $message, $headers);

echo "<script>alert('Reply sent to user email'); window.location.href='contact_queries.php';</script>";
?>
