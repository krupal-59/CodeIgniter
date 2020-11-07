<?php 
	$title = 'Welcome';
	$activeHome = $isLogin = 1;
	$username = $_SESSION['username'];
	include "./application/inc/header.php";
?>

<h3><b> Welcome <?php echo $_SESSION["username"]; ?> </b></h3>
</body>
</html>


<br>
Your application is received. To check status of your application, Go to Profile.
<br><br>
