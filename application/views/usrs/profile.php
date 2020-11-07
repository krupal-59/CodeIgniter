<?php 
	$title = 'Profile';
	$activeProfile = $isLogin = 1;
	$username = $_SESSION['username'];
	include "./application/inc/header.php";
?>

<style>
#t01 tr:nth-child(even) {
  background-color: #eee;
}
#t01 tr:nth-child(odd) {
  background-color: #fff;
}
#t01 th {
  color: black;
  background-color: lightblue;
}
</style>
<h3> <b> Hi, <?php echo $username; ?> </b> </h3> 
<table id = "t01" style="width:30%">

	<?php foreach ($data as $key => $value) { ?>
		<tr>
			<th> <?php echo $key; ?> </th>
			<th> <?php echo $value; ?> </th>
		</tr>
	<?php } ?>
</table>
<br>
<b>Application Status:<br></b>
P = Pending <br>
R = Rejected <br>
A = Accepted <br> <br>
Click <a href = "http://localhost/codeigniter/index.php/university/edit_profile_view">here</a> to Edit Profile.
