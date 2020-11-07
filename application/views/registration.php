<?php 
	$title = "Registration";
	$activeRegister = 1;
	$pgname = "Register";
	include "./application/inc/header.php";
	$action = "register";
	include "./application/inc/input.php";
?>


	Username:
	<input id = "usr" name = "username", type = "text", value = <?php echo $data['users']['username']; ?>> 
	<span class = "error"> <?php echo $data['errors']['usrerr']; ?> </span> <br><br> 
	Password:
	<input id = "pass1" name = "pass1", type = "password", value = <?php echo $data['users']['pass1']; ?>>
	<span class = "error"> <?php echo $data['errors']['passerr']; ?> </span> <br><br> 
	Confirm Password:
	<input id = "pass2" name = "pass2", type = "password", value = <?php echo $data['users']['pass2']; ?>> 
	<span class = "error"> <?php echo $data['errors']['passerr']; ?> </span> <br><br> 
	Aadhar Card:
	<input id = "aadhar" name = "aadhar", type = "file"> <span class = "error"> <?php echo $data['errors']['img1err']; ?> </span> <br><br>
	Marksheet:
	<input id = "marksheet" name = "marksheet", type = "file"> <span class = "error"> <?php echo $data['errors']['img2err']; ?> </span> <br><br>
	<input type = "submit" name = "submit", value = "Submit"> <br><br>
</form>
<form action = "index", method = "post">
<input type = "submit" name = "cancel" value = "Cancel"> <br><br>