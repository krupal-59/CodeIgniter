<?php
session_start();
	class University extends CI_Controller {
		function __construct() {
			parent:: __construct();
			$this->load->database();
		}
		public function index () {
			$this->load->view('homepage');
		}
	
		public function register_view () {
			$data['records'] = array(
				'name' => '',
				'gender' => '',
				'email_id' => '',
				'mobile_num' => '',
				'current_sem' => '',
				'department' => ''
			);
			$data['users'] = array(
				'username' => '',
				'pass1' => '',
				'pass2' => ''
			);
			$data['docs'] = array(
				'aadhar' => '',
				'marksheet' => ''
			);
			$data['errors'] = array(
				'namerr' => '',
				'generr' => '',
				'emailerr' => '',
				'moberr' => '',
				'depterr' => '',
				'semerr' => '',
				'usrerr' => '',
				'passerr' => '',
				'img1err' => '',
				'img2err' => ''
			); 
			$this->load->view('registration', ['data' => $data]);
		}

		public function register() {
			$data['records'] = array(
				'name' => $this->input->post('name'),
				'gender' => $this->input->post('gender'),
				'email_id' => $this->input->post('email_id'),
				'mobile_num' => $this->input->post('mobile_num'),
				'current_sem' => $this->input->post('current_sem'),
				'department' => $this->input->post('department')
			);
			$data['users'] = array(
				'username' => $this->input->post('username'),
				'pass1' => $this->input->post('pass1'),
				'pass2' => $this->input->post('pass2')
			);
			$data['docs'] = array(
				'student_id' => '',
				'aadhar' => 'aadhar',
				'marksheet' => 'marksheet'
			);
			$data['user'] = array(
				'student_id' => '',
				'username' => '',
				'pass' => ''
				);

			$img1err = $img2err = '';
			$data['errors']['namerr'] = $this->libfunction->checkName($data['records']['name']);
			$data['errors']['generr'] = $this->libfunction->checkGender($data['records']['gender']);
			$data['errors']['emailerr'] = $this->libfunction->checkEmail($data['records']['email_id']);
			$data['errors']['moberr'] = $this->libfunction->checkMob($data['records']['mobile_num']);
			$data['errors']['depterr'] = $this->libfunction->checkSem($data['records']['current_sem']);
			$data['errors']['semerr'] = $this->libfunction->checkDept($data['records']['department']);
			$data['errors']['usrerr'] = $this->libfunction->checkUser($data['users']['username']);
			$data['errors']['passerr'] = $this->libfunction->checkPass($data['users']['pass1'], $data['users']['pass2']);
			$data['errors']['img1err'] = $this->libfunction->checkImage('aadhar');
			$data['errors']['img2err'] = $this->libfunction->checkImage('marksheet');
			
			if(!($data['errors']['namerr'] || $data['errors']['generr'] || $data['errors']['emailerr'] || $data['errors']['moberr'] || $data['errors']['depterr'] || $data['errors']['semerr'] || $data['errors']['usrerr'] || $data['errors']['passerr'] || $data['errors']['img1err'] || $data['errors']['img2err'])) {
				$data['docs']['aadhar'] = $this->libfunction->uploadImage("aadhar", $data['users']['username']);
				$data['docs']['marksheet'] = $this->libfunction->uploadImage("marksheet", $data['users']['username']);
				$this->Dbconnect->writeData("student", $data['records']);
				$data['user']['username'] = $data['users']['username'];
				$data['user']['pass'] = md5($data['users']['pass1']);
				$_SESSION['student_id'] = $data['user']['student_id'] = $data['docs']['student_id'] = $id = $this->Dbconnect->getID('student', 'email_id', $data['records']['email_id']);
				$this->Dbconnect->writeData('users', $data['user']);
				$this->Dbconnect->writeData('documents', $data['docs']);
				$_SESSION['isLogin'] = 1;
				$_SESSION['username'] = $data['user']['username'];
				$_SESSION['records'] = $data['records'];
				$this->load->view('usrs/welcome', ['data' => $data['records']]);
			}
			else {
				$this->load->view('registration', ['data' => $data]);
			}
		}
		public function login_view() {
			$data['users'] = array('username' => '', 'password' => '');
			$data['errors'] = '';
			$this->load->view('loginpage', ['data' => $data]);
		}
		public function login_action() {
				$data['users'] = array('username' => $this->input->post('username'),
					'password' => $this->input->post('password')
				);
				$data['errors'] = $this->libfunction->checkLogin($data['users']);
				if ($data['errors'] == '') {
					$temp = $this->Dbconnect->getData('users', 'username', $data['users']['username']);
					$id = $temp[0]->student_id;
					$temp = $this->Dbconnect->getData('student', 'student_id', $id);
					$_SESSION['student_id'] = $id;
					$_SESSION['records'] = $output = json_decode(json_encode($temp[0]), true);
					$_SESSION['username'] = $data['users']['username'];
					$this->load->view('usrs/welcome', ['data' => $output]);
				}
				else {
					$this->load->view('loginpage', ['data' => $data]);
				}
			}

		public function welcome() {
			$this->libfunction->checkSession();
			$this->load->view('usrs/welcome', ['data' => $_SESSION['records']]);
		}

		public function profile_view() {
			$this->libfunction->checkSession();
			$this->load->view('usrs/profile', ['data' => $_SESSION['records']]);
		}
		public function edit_profile_view() {
			$this->libfunction->checkSession();
			$data['records'] = $_SESSION['records'];
			$data['errors'] = array(
				'namerr' => '',
				'generr' => '',
				'emailerr' => '',
				'moberr' => '',
				'depterr' => '',
				'semerr' => '');
			$this->load->view('usrs/edit', ['data' => $data]);
		}
		public function edit_profile() {
			$this->libfunction->checkSession();
			$data['records'] = array(
				'name' => $this->input->post('name'),
				'gender' => $this->input->post('gender'),
				'email_id' => $this->input->post('email_id'),
				'mobile_num' => $this->input->post('mobile_num'),
				'current_sem' => $this->input->post('current_sem'),
				'department' => $this->input->post('department')
			);
			$data['errors']['namerr'] = $this->libfunction->checkName($data['records']['name']);
			$data['errors']['generr'] = $this->libfunction->checkGender($data['records']['gender']);
			$data['errors']['emailerr'] = $this->libfunction->checkEmail($data['records']['email_id']);
			$data['errors']['moberr'] = $this->libfunction->checkMob($data['records']['mobile_num']);
			$data['errors']['depterr'] = $this->libfunction->checkSem($data['records']['current_sem']);
			$data['errors']['semerr'] = $this->libfunction->checkDept($data['records']['department']);

			if(!($data['errors']['namerr'] || $data['errors']['generr'] || $data['errors']['moberr'] || $data['errors']['depterr'] || $data['errors']['semerr'])) {
				if ($data['errors']['emailerr']) { 
					if($data['errors']['emailerr'] == 'Email already exists!') {
						$temp = $this->Dbconnect->getData('student', 'email_id', $data['records']['email_id']);
						if ($temp[0]->student_id == $_SESSION['student_id']) {
							$this->Dbconnect->updateData('student', $data['records'], 'student_id', $_SESSION['student_id']);
							$_SESSION['records'] = $data['records'];
							$this->load->view('usrs/profile', ['data' => $data['records']]);
						}
						else {
							$this->load->view('usrs/edit', ['data' => $data]);
						}
					}
					else {
						$this->load->view('usrs/edit', ['data' => $data]);
					}
				}
				else {
					$this->Dbconnect->updateData('student', $data['records'], 'student_id', $_SESSION['student_id']);
					$_SESSION['records'] = $data['records'];
					$this->load->view('usrs/profile', ['data' => $data['records']]);
				}
			}
			else {
				$this->load->view('usrs/edit', ['data' => $data]);
			}

		}
		public function logout() {
			$_SESSION = array();
			$_SESSION["islogin"] = false;
			session_destroy();
			$this->load->view('homepage');
		}
	}
?>