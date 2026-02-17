<?php
include "connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    $stmt = $connection->prepare("INSERT INTO contact_queries (name,email,subject,message) VALUES (?,?,?,?)");
    $stmt->bind_param("ssss", $name, $email, $subject, $message);

    if ($stmt->execute()) {
        echo "<script>alert('Your query has been submitted successfully'); window.location.href='contact.html';</script>";
    } else {
        echo "<script>alert('Error submitting query'); window.location.href='contact.html';</script>";
    }
}
?>
