<?php 
	$title = 'Edit Profile';
	$activeProfile = $isLogin = 1;
	$username = $_SESSION['username'];
	include "./application/inc/header.php";
	$action = "edit_profile";

?>

<h3> <b> Profile Correction </b></h3>
<?php include "./application/inc/input.php"; ?>
<input type = "submit" name = "submit", value = "Edit"> <br><br>
</form>
<form action = "index", method = "post">
<input type = "submit" name = "cancel" value = "Cancel"> <br><br>