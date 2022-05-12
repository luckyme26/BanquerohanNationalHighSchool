<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_CONTROLLER{

	function __construct(){
		parent::__construct();
		//$this->load->model('users_model');
	}

	//LANDING PAGE
	public function view(){

		$page = "index";
		if(!file_exists(APPPATH.'views/pages/'.$page.'.php')){
			show_404();
		}

		$data['title'] = "Banquerohan National High School";

		$this->load->view('templates/header');
		$this->load->view('pages/'.$page, $data);
		//$this->load->view('templates/footer');

	}

	//FOR ADMIN
	public function verifyemail($key, $token){

		echo '<link rel="icon" href="'.base_url().'resource/img/logo.png">';
		echo "<title>Account Verification</title>";
		$this->load->model('users_model');
		$this->load->view('templates/header');

		$data = $this->users_model->verifyAdmin($key, $token);
		if($data){
			$this->db->query("UPDATE accounts SET account_status = 'Active', ver_status = 'Verified' WHERE ver_key = '$key' AND ver_token = '$token'");

			extract($data);
			if($role == 'admin'){
				echo '<div class="w3-display-container w3-display-middle w3-card w3-round w3-padding" style="margin: auto;width:80%">
					<h1 class="w3-hide-small">ACCOUNT VERIFIED</h1>
					<h3 class="w3-hide-large w3-hide-medium">ACCOUNT VERIFIED</h3><hr/>
					<p class="w3-panel w3-pale-green w3-padding">Your account has been verified! Please proceed to the Home page.</p>
					<a href="'.base_url().'" class="w3-button w3-round w3-blue w3-hover-light-blue">Proceed</a>
				</div>';

			}else{
				echo '<div class="w3-display-container w3-display-middle w3-card w3-round w3-padding" style="margin: auto;width:80%">
						<h1 class="w3-hide-small">ACCOUNT VERIFIED</h1>
						<h3 class="w3-hide-large w3-hide-medium">ACCOUNT VERIFIED</h3><hr/>
						<p class="w3-panel w3-pale-green w3-padding">Your account has been verified! Please visit the Administrator for your Log-in credentials.</p>
						<a href="'.base_url().'" class="w3-button w3-round w3-blue w3-hover-light-blue">Proceed</a>
					</div>';
			}
		}else{

			echo '<div class="w3-display-container w3-display-middle w3-card w3-round w3-padding" style="margin: auto;width:80%">
					<h1 class="w3-hide-small">VERIFICATION FAILED</h1>
					<h3 class="w3-hide-large w3-hide-medium">VERIFICATION FAILED</h3><hr/>
					<p class="w3-panel w3-pale-red w3-padding">There was a problem while verifying your account. Please report to the Administrator.</p><hr/>
					<a href="'.base_url().'" class="w3-button w3-round w3-blue w3-hover-light-blue">Proceed</a>
				</div>';

		}

	}

	//LOG IN PROCESS
	public function verify(){
		
		if(isset($_POST['IDnum'])&&isset($_POST['password'])){

			$id = htmlspecialchars(stripslashes(trim($_POST['IDnum'])));
			$password = htmlspecialchars(stripslashes(trim($_POST['password'])));

			$this->load->model('users_model');
			$data = $this->users_model->login($id, $password);

			if($data){
				$this->load->library('session');
				$this->load->library('encryption');
				extract($data);

				switch($role){
					case 'admin':
						$this->db->query("UPDATE accounts SET status = 'online' WHERE id = '$id'");

						$this->session->set_userdata('Home of the braves@2022:admin', $data);
						redirect('admin/dashboard');
						break;

					case 'Senior High School Teacher':
						$this->db->query("UPDATE accounts SET status = 'online' WHERE id = '$id'");
						
						$this->session->set_userdata('teacher'.$id, $data);
						redirect('teacher/dashboard/'.$sess_id);
						break;

					case 'Junior High School Teacher':
						$this->db->query("UPDATE accounts SET status = 'online' WHERE id = '$id'");
						
						$this->session->set_userdata('teacher'.$id, $data);
						redirect('teacher/dashboard/'.$sess_id);
						break;

					case 'JHSstudent':
						$this->db->query("UPDATE accounts SET status = 'online' WHERE id = '$id'");
						
						$this->session->set_userdata('student'.$id, $data);
						redirect('student/dashboard/'.$sess_id);
						break;

					case 'SHSstudent':
						$this->db->query("UPDATE accounts SET status = 'online' WHERE id = '$id'");
						
						$this->session->set_userdata('student'.$id, $data);
						redirect('student/dashboard/'.$sess_id);
						break;
				}
				
				//redirect(''.$role.'/dashboard');
			}else{
				$this->session->set_flashdata('error','Invalid login. User not found');
				header('location:'.base_url().$this->view());
			}

		}else{
			header('location:'.base_url().$this->view());
		}
	}



	public function forgotpassword(){

		$this->load->view('templates/header');
		echo '<link rel="icon" href="'.base_url().'resource/img/logo.png">';
		echo "<title>Forgot Password</title>";
		$this->load->model('users_model');

		echo '<nav>
		        <div class="w3-top">
				  	<div class="w3-bar w3-blue w3-padding w3-text-white" style="box-shadow: 2px 0px 5px 1px grey">
					    <img class="w3-circle w3-left" load="lazy" src="'.base_url().'resource/img/logo.png" alt="School Logo" style= "max-width:70px;width:100%">
					    <h1 class="w3-left w3-margin-left w3-hide-small w3-hide-medium">BANQUEROHAN NATIONAL HIGH SCHOOL</h1>
				    </div>
				</div>
			</nav>';

		echo '<div class="w3-container w3-margin-top">
			    <div class="w3-padding-6 w3-hide-large w3-hide-medium"><br/><br/><br/></div>
			    <br/>
			   
			    <br/><br/><br/>
			    <div class="w3-display-container w3-display-middle w3-card w3-padding w3-round" style="width:70%; margin: auto;">
				    <h3>FORGOT PASSWORD</h3><hr/>
				    <form action="'.base_url().'Pages/checkemail" method="post">
				    	<div class="w3-container">
					    	<div class="w3-container">
					    		<input type="text" class="w3-input w3-half w3-border w3-round" name="id" placeholder="Enter ID number" required>
					    		<input type="email" class="w3-input w3-half w3-border w3-round" name="email" placeholder="Enter Email address" required>
					    	</div>
					    	<button class="w3-button w3-block w3-blue w3-section w3-padding w3-round w3-hover-light-blue" type="submit">Proceed</button>
					    </div>
				    </form>
				    <hr/>
				</div>
			</div>';
	}


	public function checkemail(){
		$this->load->library('email');

		$email = htmlspecialchars(stripslashes(trim($_POST['email'])));
		$id = htmlspecialchars(stripslashes(trim($_POST['id'])));

		if($this->db->query("SELECT * FROM accounts WHERE id = '$id' AND ver_email = '$email'")->num_rows() == 1){
			$alpha = "1234567890";
			$code = substr(str_shuffle($alpha),0 ,6);

			$message = "<!DOCTYPE html><html>
							<head>
								<link rel='icon' href='".base_url()."'resource/img/logo.png'>
								<link rel='stylesheet' href='".base_url()."'resource/4w3.css'>
								<link rel='stylesheet' href='".base_url()."'resource/3w3.css'>
							</head>
							<body>
								<div class='w3-container w3-card w3-round w3-padding w3-border' style='margin: auto; width: 80%'>
									<h3>HI USER!</h3><p>Please enter this code to reset your password.</p>
									<p><b>".$code."</b></p>
									<p>Thanks!</p>
								</div>
							</body></html>";

			$config['mailtype'] = 'html';
			$this->email->initialize($config);

			$this->email->from('BanquerohanNationalHighSchool@gmail.com', 'Banquerohan National High School');
			$this->email->to($email);
			$this->email->subject("Password reset code");
			$this->email->message($message);

			if($this->email->send()){
				if($this->db->query("INSERT INTO forgot_password VALUES('$id', '$email', '$code')")){
					header("Location:".base_url()."Pages/confirmcode/".$id);

				}else{
					echo 'Can\'t contact database.';
					header("Location:".base_url().$this->view());
				}

			}else{
				echo 'Unexpected error while sending email.';
				header("Location:".base_url().$this->view());
			}
		
		}else{
			redirect('/');
		}
	}


	public function confirmcode($id){
		$this->load->view('templates/header');
		echo '<link rel="icon" href="'.base_url().'resource/img/logo.png">';
		echo "<title>Forgot Password</title>";
		$this->load->model('users_model');

		echo '<nav>
		        <div class="w3-top">
				  	<div class="w3-bar w3-blue w3-padding w3-text-white" style="box-shadow: 2px 0px 5px 1px grey">
					    <img class="w3-circle w3-left" load="lazy" src="'.base_url().'resource/img/logo.png" alt="School Logo" style= "max-width:70px;width:100%">
					    <h1 class="w3-left w3-margin-left w3-hide-small w3-hide-medium">BANQUEROHAN NATIONAL HIGH SCHOOL</h1>
				    </div>
				</div>
			</nav>';

		echo '<div class="w3-container w3-margin-top">
			    <div class="w3-padding-6 w3-hide-large w3-hide-medium"><br/><br/><br/></div>
			    <br/>
			   
			    <br/><br/><br/>
			    <div class="w3-display-container w3-display-middle w3-card w3-padding w3-round" style="width:70%; margin: auto;">
				    <h3>FORGOT PASSWORD</h3><hr/>
				    <form action="'.base_url().'Pages/verifycode/'.$id.'" method="post">
				    	<div class="w3-container">
					    	<div class="w3-container">
					    		<input type="text" class="w3-input w3-border w3-round" name="code" max="6" placeholder="Enter 6 digit code" required>
					    	</div>
					    	<button class="w3-button w3-block w3-blue w3-section w3-padding w3-round w3-hover-light-blue" type="submit">Verify</button>
					    </div>
				    </form>
				    <hr/>
				</div>
			</div>';
	}


	public function verifycode($x){
		$code = htmlspecialchars(stripslashes(trim($_POST['code'])));
		$id = htmlspecialchars(stripslashes(trim($x)));

		if($this->db->query("SELECT * FROM forgot_password WHERE id = '$id' AND code = '$code'")->num_rows() == 1){
			header("Location:".base_url()."Pages/updatepassword/".$id);

		}else{
			echo 'Try again.';
			$this->db->query("DELETE FROM forgot_password WHERE id = '$id' AND code = '$code'");
			header("Location:".base_url().$this->view());
		}
	}


	public function updatepassword($x){
		$id = htmlspecialchars(stripslashes(trim($x)));

		$this->load->view('templates/header');
		echo '<link rel="icon" href="'.base_url().'resource/img/logo.png">';
		echo "<title>Forgot Password</title>";
		$this->load->model('users_model');

		echo '<nav>
		        <div class="w3-top">
				  	<div class="w3-bar w3-blue w3-padding w3-text-white" style="box-shadow: 2px 0px 5px 1px grey">
					    <img class="w3-circle w3-left" load="lazy" src="'.base_url().'resource/img/logo.png" alt="School Logo" style= "max-width:70px;width:100%">
					    <h1 class="w3-left w3-margin-left w3-hide-small w3-hide-medium">BANQUEROHAN NATIONAL HIGH SCHOOL</h1>
				    </div>
				</div>
			</nav>';

		echo '<div class="w3-container w3-margin-top">
			    <div class="w3-padding-6 w3-hide-large w3-hide-medium"><br/><br/><br/></div>
			    <br/>
			   
			    <br/><br/><br/>
			    <div class="w3-display-container w3-display-middle w3-card w3-padding w3-round" style="width:70%; margin: auto;">
				    <h3>FORGOT PASSWORD</h3><hr/>
				    <form action="'.base_url().'Pages/confirmpassword/'.$id.'" name="myform" method="post">
				    	<div class="w3-container">
					    	<div class="w3-container">
					    		<input type="password" class="w3-input w3-border w3-round w3-margin-bottom" name="password" pattern="^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$" placeholder="Enter new password" required>

					    		<p><b>Note:</b> <i>Password must be atleast 8 characters long and must contain atleast 1 Uppercase letter, lowercase letter, special character, and number.</i></p>
					    		<p id="mes"></p>
					    	</div>
					    	<button class="w3-button w3-block w3-blue w3-section w3-padding w3-round w3-hover-light-blue" type="submit">Confirm</button>
					    </div>
				    </form>
				    <hr/>
				</div>
			</div>';
	}


	public function confirmpassword($x){
		date_default_timezone_set('Asia/Manila');
		
		$id = htmlspecialchars(stripslashes(trim($x)));
		$password = htmlspecialchars(stripslashes(trim($_POST['password'])));

		if($this->db->query("UPDATE accounts SET password = '$password' WHERE id = '$id'")){
			$this->db->query("INSERT INTO logs VALUES('', 'changes password through forgot password', 'admin', '".date('Y-m-d H:i:s')."', '$id', '', '')");
			$this->db->query("DELETE FROM forgot_password WHERE id = '$id'");

			redirect('/');
			
		}else{
			echo 'Unexpected error.';
			redirect('/');
		}
	}





	/*public function check_user(){
		$username_id = $this->input->post('user');
		$password = $this->input->post('pass');

		$this->load->model('login_model');
		$login = $this->login_model->login($username_id, $password);

		if($login){
			$sess_data = array(
				'account_name' => $login['role'],
				'isLogged' => TRUE
			);
			$this->session->set_userdata($sess_data);
			return true;
		}else{
			return false;
		}
	}*/

	//END OF LOG IN PROCESS
}

?>