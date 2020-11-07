<!DOCTYPE html>
<html>
<head>
	<title> <?php echo $title; ?> </title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<style>
	body {
	  margin: 0;
	  font-family: Arial, Helvetica, sans-serif;
	}

	.error {color:red;} 

	.topnav {
	  overflow: hidden;
	  background-color: #333;
	}

	.topnav a {
	  float: left;
	  color: #f2f2f2;
	  text-align: center;
	  padding: 14px 16px;
	  text-decoration: none;
	  font-size: 17px;
	}

	.topnav a:hover {
	  background-color: #ddd;
	  color: black;
	}

	.topnav a.active {
	  background-color: #4CAF50;
	  color: white;
	}
	</style>

<?php 
$rurl = "http://localhost/codeigniter/index.php/university/login_view";
$hurl = "http://localhost/codeigniter/index.php/university/";
if (!isset($admin) && !isset($isLogin)) { ?>
	<body>
		<div class = "topnav">
	    <a <?php echo (isset($activeHome)) ? "class = active" : "href = $hurl"; ?> >Home</a>
	    <a <?php echo (isset($activeRegister)) ? "class = active" : "href = $rurl";?>><?php echo $pgname; ?></a>
	    <a href = "#contact">Contact</a>
	    <a href = "#about">About</a>
		</div>
<?php } 
$hurl = "http://localhost/codeigniter/index.php/university/welcome";
$purl = "http://localhost/codeigniter/index.php/university/profile_view";
if (isset($isLogin) && $isLogin == 1) {?>
	<body>
		<div class = "topnav">
	    <a <?php echo (isset($activeHome)) ? "class = active" : "href = $hurl"; ?> >Home</a>
	    <a <?php echo (isset($activeProfile)) ? "class = active" : "href = $purl"; ?> ><?php echo $username; ?></a>
	    <a href = "http://localhost/codeigniter/index.php/university/logout">Logout</a>
	    <a href = "#contact">Contact</a>
	    <a href = "#about">About</a>
		</div>
		<?php } ?>