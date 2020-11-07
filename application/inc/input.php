

<form name = "myform" action = "<?php echo $action; ?>" , method = "post", onsubmit = "return validate()" enctype = "multipart/form-data">
	<p style = "color:red"> * fields are mandatory </p>
	Name: 
	<input id = "name" name = "name", type = "text", value = <?php echo $data['records']['name']; ?>>
	<span class = "error"><?php echo $data['errors']['namerr']; ?></span> <br><br>
	Gender:
	<input id = "male" name = "gender", type = "radio", value = 'M', <?php echo ($data['records']['gender'] == 'M') ? 'checked' : ''; ?> >Male 
	<input id = "female" name = "gender", type = "radio", value = 'F', <?php echo ($data['records']['gender'] == 'F') ? 'checked' : ''; ?> >Female 
	<input id = "other" name = "gender", type = "radio", value = 'O', <?php echo ($data['records']['gender'] == 'O') ? 'checked' : ''; ?> >Other
	<span class = "error"><?php echo " ".$data['errors']['generr']; ?> </span><br><br>
	Email ID:
	<input id = "email" name = "email_id", type = "text", value = <?php echo $data['records']['email_id']; ?>>
	<span class = "error"> <?php echo $data['errors']['emailerr']; ?> </span> <br><br>
	Mobile Number:
	<input id = "mob" name = "mobile_num", type = "text", value = <?php echo $data['records']['mobile_num']; ?>>
	<span class = "error"> <?php echo $data['errors']['moberr']; ?> </span> <br><br>
	Current Sem:
	<select name = "current_sem", id = "sem">
		<option value = "">---Select---</option>
		<?php for ( $i = 1;  $i <= 8 ;  $i++) { ?>
			<option value = <?php echo $i; ?> <?php echo ($data['records']['current_sem'] == $i) ? 'selected' : ''; ?>> <?php echo $i; ?> </option>
		<?php } ?>		
	</select> <span class = "error"> <?php echo $data['errors']['semerr']; ?> </span> <br><br>  
	Department:
	<select name = "department", id = "dept">
		<option value = "">---Select---</option>
		<option value = "EC" <?php echo ($data['records']['department'] == "EC") ? 'selected' : ''; ?>>EC</option>
		<option value = "CE" <?php echo ($data['records']['department'] == "CE") ? 'selected' : ''; ?>>CE</option>
		<option value = "IT" <?php echo ($data['records']['department'] == "IT") ? 'selected' : ''; ?>>IT</option>
		<option value = "MH" <?php echo ($data['records']['department'] == "MH") ? 'selected' : ''; ?>>MH</option>
		<option value = "CH" <?php echo ($data['records']['department'] == "CH") ? 'selected' : ''; ?>>CH</option>
		<option value = "BBA" <?php echo ($data['records']['department'] == "BBA") ? 'selected' : '';?>>BBA</option>
		<option value = "BCA" <?php echo ($data['records']['department'] == "BCA") ? 'selected' : '';?>>BCA</option>
	</select> <span class = "error"> <?php echo $data['errors']['depterr']; ?> </span> <br><br> 