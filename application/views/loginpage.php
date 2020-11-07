<?php 
	$pgname = $title = 'Login';
	$activeRegister = 1;
	include './application/inc/header.php';
	echo '<br>';
?>

<form action = 'login_action', method = 'post', onsubmit = 'return validate()'>
	<span class = "error"><?php echo $data['errors']; ?></span> 
	<br><br>
	Username:
	<input type = 'text' name = 'username', value = '<?php echo $data['users']['username']; ?>'><br><br>
	Password: 
	<input type = 'password' name = 'password'> <br><br>
	<input type = "submit" name = "submit" value = "Login"><br><br>
</form>

<a href = 'http://localhost/codeigniter/index.php/university/register_view'>Don't have an account?</a>