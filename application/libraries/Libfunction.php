<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	function test_input($data) {
		$data = trim($data);
  		$data = stripslashes($data);
		$data = htmlspecialchars($data);
	return $data;
	}
	class Libfunction {
		public function checkName($name) {
			$err = '';
			$name = test_input($name);
			if (empty($name)) {
				$err = "Name is mandatory.";
				return $err;
			}
			else {
				if (!preg_match("/^[a-zA-z\ ]*$/", $name)) {
					$err = "Numbers and special characters are not allowed.";
				}
				return $err;
			}
		}

		public function checkGender($gender) {
			$err = '';
			if(empty($gender)) {
				$err = 1;
				$err = 'This field is required';
			}
			return $err;
		}

		public function checkEmail($email) {
			$err = '';
			$email = test_input($email);
			if (empty($email)) {
				$err = "Email is mandatory.";
				return $err;
			}
			else {
				if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {  
	                $err = "Invalid email entered.";  
	                return $err;
	            }
	            else {
	            	$CI = get_instance();
	        		if(count($CI->Dbconnect->getData('student', 'email_id', $email))) {
	        			$err = 'Email already exists!';
	        			return $err;
	        		}
	            }
	        }
		}

		public function checkMob($mob) {
			$err = '';
			$mob = test_input($mob);
			if (empty($mob)) {
				$err = "Mobile number is mandatory.";
				return $err;
			} 
			else {
				if (!preg_match ("/^[0-9]*$/", $mob) ) {  
	            	$err = "Only numbers are allowd."; 
	            	return $err;
	            }
	            if (strlen ($mob) != 10) {  
	            	$err = "Mobile number must contain 10 digits.";  
	            	return $err;
	            } 
	            return $err;
			}
		}

		public function checkSem($sem) {
			$err = '';
			if(empty($sem)) {
				$err = 'This field is required';
			}
			return $err;
		}

		public function checkDept($dept) {
			$err = '';
			if(empty($dept)) {
				$err = 'This field is required';
			}
			return $err;
		}

		public function checkUser($username) {
			$err = '';
			$username = test_input($username);
			if (strlen($username) == 0) {
				$err = "Username cannot be empty.";
				return $err;
			}
			if (preg_match('/[^a-z_\-0-9]/i', $username)) {
				$err = "Username can have numbers and alphabates Only.";
				return $err;
			}
			if ($username == "admin" || $username == "Admin") {
				$err = "Student cannot create admin account";
				return $err;
			}
			$CI = get_instance();
	        if(count($CI->Dbconnect->getData('users', 'username', $username))) {
	        	$err = 'Username already exists!';
	        	return $err;
	        }
		}

		public function checkPass($pass1, $pass2) {
			$err = '';
			$pass1 = test_input($pass1);
			$pass2 = test_input($pass2);
			if (!((isset($pass1)) && (isset($pass2)))) {
				$err = "Password cannot be null.";
				return $err;
			}
			if (strlen($pass1) < 8 || strlen($pass1) > 20) {
				$err = "Password must be in range of 8-20 chaeacters";
				return $err;
			}
			if (strcmp($pass1, $pass2)) {
				$err = "Password does not match with confirm password.";
				return $err;
			}
			$uppercase = preg_match('@[A-Z]@', $pass1);	
			$lowercase = preg_match('@[a-z]@', $pass1);
			$number    = preg_match('@[0-9]@', $pass1);
			$specialChars = preg_match('@[^\w]@', $pass1);

			if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($pass1) < 8) {
			    $err = "Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.";
			    return $err;
			}
		}

		public function checkImage($imgname)  {
			if (isset($_FILES['file'])) {
				$err = '';
				$fileinfo = getimagesize($_FILES[$imgname]["tmp_name"]);
				$allowed_image_extension = array("png", "jpg", "jpeg");
				$file_extension = pathinfo($_FILES[$imgname]["name"], PATHINFO_EXTENSION);
				if (! file_exists($_FILES[$imgname]["tmp_name"])) {
					$err = "Choose image file to upload.";
					return $err;
				}    
				else if (! in_array($file_extension, $allowed_image_extension)) {
					$err = "Upload valid images. Only PNG and JPEG are allowed.";
					return $err;
				}   
				else if (($_FILES[$imgname]["size"] > 2000000)) {
					$err = "Image size exceeds 2MB";
					return $err;
				}    
			}
		}

		public function uploadImage($filename, $usrname) {
			$uploadDir = "./application/Uploads/".$filename."/";
			$fname = $usrname.basename($_FILES[$filename]["name"]);
			move_uploaded_file($_FILES[$filename]["tmp_name"], $uploadDir.$fname);
			return $uploadDir.$fname;
		}

		public function checkLogin($data) {
			$err = "";
			$usr = test_input($data['username']);
			$CI = get_instance();
			$temp = $CI->Dbconnect->getData('users', 'username', $usr);
			if ((count($temp)) && (md5($data['password']) == $temp[0]->pass)) {
				 return $err;
			}
			else {
				$err = "Invalid Credentials";
				return $err;
			}
		}

		public function checkSession() {
			if(!isset(($_SESSION['username']))) {
				redirect('university/login_view');
			}
		}

	}
?>