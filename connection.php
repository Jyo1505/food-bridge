

<?php
//change mysqli_connect(host_name,username, password); 
$connection = mysqli_connect("localhost", "root", "152005","foodbridge",3306);
$db = mysqli_select_db($connection, 'foodbridge');
?>
