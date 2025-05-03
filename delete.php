<?php
// include database connection file
include_once("config.php");
 
// Get id from URL 
$id = $_GET['id'];
 
// Delete user row 
$result = mysqli_query($mysqli, "DELETE FROM users WHERE id=$id");
 
// redirect
header("Location:index.php");
?>

