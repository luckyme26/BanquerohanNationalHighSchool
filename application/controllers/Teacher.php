<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Teacher extends CI_Controller{

	function __construct(){
		parent::__construct();
			//$this->load->database();
		}

	public function countOnline($id){

		if($this->db->query("SELECT * FROM accounts WHERE status = 'online' AND id != '$id' AND role != 'admin'")->num_rows() == 0){}
		else{
			echo $this->db->query("SELECT * FROM accounts WHERE status = 'online' AND id != '$id' AND role != 'admin'")->num_rows();
		}
	}

	################################################################################################################
	################################################################################################################

	public function OnlineList($id){
		echo '<ul class="w3-ul">';
		foreach ($this->db->query("SELECT * FROM accounts WHERE status = 'online' AND id != '$id' AND role != 'admin' LIMIT 10")->result_array() as $i) {
			foreach ($this->db->query("SELECT * FROM teachers WHERE id = '".$i['id']."'")->result_array() as $s) {
				$name = $s['fname'].' '.$s['lname'];
			}
			foreach ($this->db->query("SELECT * FROM jhsstudents WHERE lrn = '".$i['id']."'")->result_array() as $s) {
				$name = $s['fname'].' '.$s['lname'];
			}
			foreach ($this->db->query("SELECT * FROM shsstudents WHERE lrn = '".$i['id']."'")->result_array() as $s) {
				$name = $s['fname'].' '.$s['lname'];
			}

			echo '<li>'.$name.' <i class="fa fa-circle w3-text-green"></i></li>';
		}
		echo '</ul>';
	}

	################################################################################################################
	################################################################################################################

	public function countconcern($id){

		if($this->db->query("SELECT * FROM concerns WHERE receiver = '$id' AND status = 'pending'")->num_rows() == 0){}

		else{
			echo $this->db->query("SELECT * FROM concerns WHERE receiver = '$id' AND status = 'pending'")->num_rows();
		}

	}

	################################################################################################################
	################################################################################################################

	public function notifcounter($id){
		
		$query = $this->db->query("SELECT * FROM subject_teacher WHERE subj_teacher = '$id'");
		$a = 0;
		$c = 0;

		if($query->num_rows() == 0){}

		else{
			foreach ($query->result_array() as $i) {
				if($this->db->query("SELECT * FROM logs WHERE made_for = '".$i['subj_code']."_".$i['gr_level']."_".$i['section']."' AND role != 'teacher' AND viewed NOT LIKE '%".$id."%'")->num_rows() == 0){
					$c = '';
				}else{
					$b = $this->db->query("SELECT * FROM logs WHERE made_for = '".$i['subj_code']."_".$i['gr_level']."_".$i['section']."' AND role != 'teacher' AND viewed NOT LIKE '%".$id."%'")->num_rows();

					$c = $b+$a;
					$a = $c;
				}
			}
			echo $c;
		}
	}

	################################################################################################################
	################################################################################################################

	public function notifitems($id){
		
		foreach ($this->db->query("SELECT sess_id FROM accounts WHERE id = '$id'")->result_array() as $sess) {
			$sessid = $sess['sess_id'];
		}

		$sessid = str_replace("/", "_47_", str_replace("=", "_50_", $sessid));

		echo '<ul class="w3-ul">';

		foreach ($this->db->query("SELECT * FROM logs WHERE id != '$id' AND role != 'teacher' AND made_for != 'admin' AND viewed NOT LIKE '%$id%' ORDER BY date DESC")->result_array() as $a) {
			
			foreach ($this->db->query("SELECT * FROM teachers WHERE id = '".$a['id']."'")->result_array() as $b) {
				$log = $b['fname'].' '.$b['lname'];
			}
			foreach ($this->db->query("SELECT * FROM jhsstudents WHERE lrn = '".$a['id']."'")->result_array() as $b) {
				$log = $b['fname'].' '.$b['lname'];
			}
			foreach ($this->db->query("SELECT * FROM shsstudents WHERE lrn = '".$a['id']."'")->result_array() as $b) {
				$log = $b['fname'].' '.$b['lname'];
			}
			

			$dat = explode("_", $a['made_for']);
			//print_r($dat);
			if($this->db->query("SELECT * FROM subject_teacher WHERE subj_code = '".$dat[0]."' AND gr_level = '".$dat[1]."' AND section = '".$dat[2]."' AND subj_teacher = '".$id."'")->num_rows() == 1) {
				
				echo '<li><a href="'.base_url().'Teacher/viewednotif/'.$sessid.'/'.$a['l_id'].'/'.$dat[0].'" class="w3-small"><b>'.$log.'</b> '.$a['description'].' '.$dat[1].' '.$dat[2].' | <small>('.date('M. j, Y h:i A', strtotime($a['date'])).') <br/> mark as read</small></a></li>';
			}
		}

		echo '</ul>';
		
	}

	################################################################################################################
	################################################################################################################

	public function viewednotif($sessid, $n_id, $subjcode){
		$id = str_replace("_47_", "/", str_replace("_50_", "=", $sessid));
		$decID = $this->encryption->decrypt($id);
		foreach ($this->db->query("SELECT * FROM logs WHERE l_id = $n_id")->result_array() as $a) {

			if(empty($a['viewed'])){

				$this->db->query("UPDATE logs SET viewed = '$decID' WHERE l_id = $n_id");
				header('Location:'.base_url().'Teacher/subjects/'.$subjcode.'/'.$sessid);

			}else{
				$viewers = array($a['viewed'], $decID);
				$newviewers = implode(', ', $viewers);

				$this->db->query("UPDATE logs SET viewed = '$newviewers' WHERE l_id = $n_id");
				header('Location:'.base_url().'Teacher/subjects/'.$subjcode.'/'.$sessid);
			}
		}
		
	}

	################################################################################################################
	################################################################################################################

	public function announcements($id){
		date_default_timezone_set("Asia/Manila");
		//start_date >= '".date("Y-m-01")."' AND 
		$chk = $this->db->query("SELECT * FROM announcements WHERE end_date >= '".date("Y-m-d")."' AND (audience = 'All' OR audience LIKE '%Teachers%') ORDER BY start_date ASC LIMIT 5");
		if($chk->num_rows() != 0){
			foreach ($chk->result_array() as $ann) {
				$strdate = strtotime($ann['start_date']);
				$enddate = strtotime($ann['end_date']);

				echo '<div class="w3-panel w3-pale-blue w3-leftbar w3-border-blue w3-border w3-small" style="text-align: justify;">
						<p class="w3-small">'.date('M. j, Y', $strdate).' - '.date('M. j, Y', $enddate).'</p>
						<p class="w3-small"><b>'.$ann['title'].'</b><br/>'.$ann['description'].'</p>';
				echo '</div>';
			}
		}else{
			echo '<div class="w3-container w3-padding w3-pale-yellow w3-margin-bottom w3-center">No announcement posted.</div>';
		}
	}
	################################################################################################################
	################################################################################################################
	################################################################################################################
	################################################################################################################


	################################################################################################################
	################################################################################################################
	################################################################################################################
	################################################################################################################
	//TEACHER DASHBOARD
	public function dashboard($sessid){
		$id = str_replace("_47_", "/", str_replace("_50_", "=", $sessid));
		$decID = $this->encryption->decrypt($id);
		foreach($this->db->query("SELECT account_status FROM accounts WHERE id = $decID")->result_array() as $got){
			$got['account_status'];
		}
		
		$sessid = str_replace("/", "_47_", str_replace("=", "_50_", $id));

		if(!empty($this->session->userdata('teacher'.$decID)) && $got['account_status']=='Active'){
			$this->load->model('Teachers_model');

			$data['title'] = 'Dashboard';
			$data['link'] = $sessid;

			extract($this->session->userdata('teacher'.$decID));

			$getInfo = $this->db->query("SELECT * FROM teachers WHERE id = '$id'");
			foreach ($getInfo->result_array() as $userInfo) {
				$data['name'] = $userInfo['fname'].' '.$userInfo['mname'].' '.$userInfo['lname'];
				$data['photo'] = $userInfo['photo'];
			}

			$data['id'] = $id;

			$this->load->library('calendar');
			$prefs = array(
						'show_next_prev'  => TRUE,
        				'next_prev_url'   => base_url().'teacher/dashboard/'.$data['link']
				);
			
			$this->calendar->initialize($prefs);

			$this->load->view('templates/header');
			$this->load->view('pages/teacher/dashboard', $data);
			$this->load->view('templates/footer');
			
		}else{
			redirect('/');
		}
	}

	################################################################################################################
	################################################################################################################
	################################################################################################################
	################################################################################################################


	################################################################################################################
	################################################################################################################
	################################################################################################################
	################################################################################################################
	//PROFILE
	public function profile($sessid){
		$sessid = str_replace("_47_", "/", str_replace("_50_", "=", $sessid));
		$decID = $this->encryption->decrypt($sessid);
		foreach($this->db->query("SELECT account_status FROM accounts WHERE id = $decID")->result_array() as $got){
			$got['account_status'];
		}

		$sessid = str_replace("/", "_47_", str_replace("=", "_50_", $sessid));

		if(!empty($this->session->userdata('teacher'.$decID)) && $got['account_status']=='Active'){
			$this->load->model('Teachers_model');

			$query = $this->db->query("SELECT * FROM teachers WHERE id = '$decID'");
			foreach ($query->result_array() as $info) {
				$data['id'] = $decID;
				$data['fname'] = $info['fname'];
				$data['mname'] = $info['mname'];
				$data['lname'] = $info['lname'];
				$data['sex'] = $info['sex'];
				$data['email'] = $info['email'];
				$data['major'] = $info['major'];
				$data['dept'] = $info['Department'];
				$data['rank'] = $info['Rank'];
				$data['load'] = $info['teach_load'];
				$data['photo'] = $info['photo'];
			}
			$data['title'] = 'Profile';
			$data['name'] = $info['fname'].' '.$info['mname'].' '.$info['lname'];
			$data['link'] = $sessid;

			$this->load->view('templates/header');
			$this->load->view('pages/teacher/profile', $data);
			$this->load->view('templates/footer');

		}else{
			redirect('/');
		}
	}

	################################################################################################################
	################################################################################################################

	public function UploadPic($id, $sessid){
		$sessid = str_replace("_47_", "/", str_replace("_50_", "=", $sessid));
		$decID = $this->encryption->decrypt($sessid);
		foreach($this->db->query("SELECT account_status FROM accounts WHERE id = $decID")->result_array() as $got){
			$got['account_status'];
		}

		$sessid = str_replace("/", "_47_", str_replace("=", "_50_", $sessid));

		if(!empty($this->session->userdata('teacher'.$decID)) && $got['account_status']=='Active'){
			$this->load->model('Teachers_model');

			$dir = 'ProfilePic/teachers/';
			if(!is_dir($dir)){
				mkdir($dir);
			}
			//echo $sessid;
			$tmpname = $_FILES['pic']['tmp_name'];
			$pic = $_FILES['pic']['name'];
			$imgtype = $_FILES['pic']['type'];

			if($imgtype == "image/jpeg" || $imgtype == "image/jpg" || $imgtype == "image/png"){
				$expname = explode(".", $pic);
                $newpic = time().rand(1,99999).".".end($expname);


                foreach ($this->db->query("SELECT * FROM teachers WHERE id = '$id'")->result_array() as $got) {
					$got['photo'];
				}
				if($got['photo'] != ''){
					unlink($dir.$got['photo']); //FILE DELETION
				}


                if(move_uploaded_file($tmpname, $dir.$newpic)){
                	$this->db->query("UPDATE teachers SET photo = '$newpic' WHERE id = '$id'");
                	$this->session->set_flashdata('success', 'Photo uploaded');
					header('Location:'.base_url().'Teacher/profile/'.$sessid);
                }else{
                	$this->session->set_flashdata('error', 'Error in uploading photo.');
					header('Location:'.base_url().'Teacher/profile/'.$sessid);
                }
			}else{
				$this->session->set_flashdata('error', 'Invalid File!');
				header('Location:'.base_url().'Teacher/profile/'.$sessid);
			}
				

		}else{
			redirect('/');
		}
	}

	################################################################################################################
	################################################################################################################

	public function editEmail($id, $sessid){
		$sessid = str_replace("_47_", "/", str_replace("_50_", "=", $sessid));
		$decID = $this->encryption->decrypt($sessid);
		foreach($this->db->query("SELECT account_status FROM accounts WHERE id = $decID")->result_array() as $got){
			$got['account_status'];
		}

		$sessid = str_replace("/", "_47_", str_replace("=", "_50_", $sessid));

		if(!empty($this->session->userdata('teacher'.$decID)) && $got['account_status']=='Active'){
			$this->load->model('Teachers_model');
			$this->load->library('email');

			$email = $_POST['email'];
			date_default_timezone_set('Asia/Manila');

			$token = md5($email).rand(10,9999);
			$key = md5($id);

			$message = "<!DOCTYPE html><html>
							<link rel='icon' href='".base_url()."'resource/img/logo.png'>
							<link rel='stylesheet' href='".base_url()."'resource/4w3.css'>
							<link rel='stylesheet' href='".base_url()."'resource/3w3.css'>
						<body>
							<div class='w3-container w3-card w3-round w3-padding' style='margin: auto; width: 80%'>
								<h2>HI USER!</h2><p>To complete editing your credentials please verify your email:</p>
								<a href='".base_url()."Pages/verifyemail/".$key."/".$token."'>VERIFY EMAIL</a>
								<p>Thanks!</p>
							</div>
						</body></html>";
			$config['mailtype'] = 'html';
			$this->email->initialize($config);

			$this->email->from('BanquerohanNationalHighSchool@gmail.com', 'Banquerohan National High School');
			$this->email->to($email);
			$this->email->subject("Email verification");
			
			$this->email->message($message);
			if($this->email->send()){
				$this->session->set_flashdata('success', 'Email has been changed. Please verify afterwards.');
				$this->db->query("UPDATE accounts SET ver_email = '$email', ver_key = '$key', ver_token = '$token', ver_status = 'Pending' WHERE id = '$id'");

				$this->db->query("INSERT INTO logs VALUES('', 'updated email', '', '".date('Y-m-d H:i:s')."', '$id', 'teacher', '')");
				
				header('Location:'.base_url().'Teacher/profile/'.$sessid);
			}else{
				$this->session->set_flashdata('error', 'Unexpected error while updating your email.');
				header('Location:'.base_url().'Teacher/profile/'.$sessid);
			}

		}else{
			redirect('/');
		}
	}

	################################################################################################################
	################################################################################################################

	public function verifypassword($id, $sessid){
		$sessid = str_replace("_47_", "/", str_replace("_50_", "=", $sessid));
		$decID = $this->encryption->decrypt($sessid);
		foreach($this->db->query("SELECT account_status FROM accounts WHERE id = $decID")->result_array() as $got){
			$got['account_status'];
		}

		$sessid = str_replace("/", "_47_", str_replace("=", "_50_", $sessid));

		if(!empty($this->session->userdata('teacher'.$decID)) && $got['account_status']=='Active'){

			$password = $_POST['password'];
			$id = $_POST['id'];
			if($this->db->query("SELECT * FROM accounts WHERE id = '$id' AND password = '$password'")->num_rows() == 1){
				header('Location:'.base_url().'Teacher/changepassword/'.$sessid);
			}

		}else{
			redirect('/');
		}
	}

	################################################################################################################
	################################################################################################################

	public function changepassword($sessid){
		$sessid = str_replace("_47_", "/", str_replace("_50_", "=", $sessid));
		$decID = $this->encryption->decrypt($sessid);
		foreach($this->db->query("SELECT account_status FROM accounts WHERE id = $decID")->result_array() as $got){
			$got['account_status'];
		}

		$sessid = str_replace("/", "_47_", str_replace("=", "_50_", $sessid));

		if(!empty($this->session->userdata('teacher'.$decID)) && $got['account_status']=='Active'){

			$data['title'] = 'Change password';

			$this->load->model('Teachers_model');

			$query = $this->db->query("SELECT * FROM teachers WHERE id = '$decID'");
			foreach ($query->result_array() as $info) {
				$data['id'] = $decID;
				$data['fname'] = $info['fname'];
				$data['mname'] = $info['mname'];
				$data['lname'] = $info['lname'];
				$data['photo'] = $info['photo'];
			}
			$data['name'] = $info['fname'].' '.$info['mname'].' '.$info['lname'];
			$data['link'] = $sessid;
			
			
			$this->load->view('templates/header');
			$this->load->view('pages/teacher/changepassword', $data);
			$this->load->view('templates/footer');

		}else{
			redirect('/');
		}
	}

	################################################################################################################
	################################################################################################################

	public function sendemail($sessid){
		$sessid = str_replace("_47_", "/", str_replace("_50_", "=", $sessid));
		$decID = $this->encryption->decrypt($sessid);
		foreach($this->db->query("SELECT account_status FROM accounts WHERE id = $decID")->result_array() as $got){
			$got['account_status'];
		}

		$sessid = str_replace("/", "_47_", str_replace("=", "_50_", $sessid));

		if(!empty($this->session->userdata('teacher'.$decID)) && $got['account_status']=='Active'){

			$idnum = $decID;
			$pass = $_POST['password'];
			date_default_timezone_set('Asia/Manila');

			foreach ($this->db->query("SELECT * FROM accounts WHERE id='$idnum' AND password='$pass'")->result_array() as $a) {
				$email = $a['ver_email'];
			}

			$token = md5($email).rand(10,9999);
			$key = md5($email);
			$message = "<!DOCTYPE html><html>
							<link rel='icon' href='".base_url()."'resource/img/logo.png'>
							<link rel='stylesheet' href='".base_url()."'resource/4w3.css'>
							<link rel='stylesheet' href='".base_url()."'resource/3w3.css'>
						<body>
							<div class='w3-container w3-card w3-round w3-padding' style='margin: auto; width: 80%'>
								<h3>Hi USER,</h3><p>To complete editing your credentials please verify your email:</p>
								<a href='".base_url()."Pages/verifyemail/".$key."/".$token."' class='w3-button w3-round w3-blue w3-hover-light-blue'>VERIFY EMAIL</a>
								<p>Thanks!</p>
							</div>
						</body></html>";
			$this->load->library('email');
			
			$this->email->from('babasachristian26@gmail.com', 'Banquerohan National High School');
			$this->email->to($email);
			$this->email->subject("Email verification");
			
			$this->email->message($message);
			if($this->email->send()){
				echo 'Email sent';
				$this->db->query("UPDATE accounts SET password = '$pass', account_status = 'Inactive', ver_key = '$key', ver_token = '$token', ver_status = 'Pending' WHERE id = '$idnum'");

				$this->db->query("INSERT INTO logs VALUES('', 'changes password', '', '".date('Y-m-d H:i:s')."', '$decID', 'teacher', '')");

				header('Refresh:1;url=logout');
			}else{
				echo 'Sending failed';
				header('Refresh:1;url=changepassword');
			}

		}else{
			redirect('/');
		}

	}

	################################################################################################################
	################################################################################################################
	################################################################################################################
	################################################################################################################


	################################################################################################################
	################################################################################################################
	################################################################################################################
	################################################################################################################
	public function advisory($sessid){
		$sessid = str_replace("_47_", "/", str_replace("_50_", "=", $sessid));
		$decID = $this->encryption->decrypt($sessid);
		foreach($this->db->query("SELECT account_status FROM accounts WHERE id = $decID")->result_array() as $got){
			$got['account_status'];
		}

		$sessid = str_replace("/", "_47_", str_replace("=", "_50_", $sessid));

		if(!empty($this->session->userdata('teacher'.$decID)) && $got['account_status']=='Active'){
			$this->load->model('Teachers_model');

			$data['title'] = 'Advisory Class';

			$data['link'] = $sessid;

			//USER INFO
			extract($this->session->userdata('teacher'.$decID));

			$getInfo = $this->db->query("SELECT * FROM teachers WHERE id = '$id'");
			foreach ($getInfo->result_array() as $userInfo) {
				$data['name'] = $userInfo['fname'].' '.$userInfo['mname'].' '.$userInfo['lname'];
				$data['photo'] = $userInfo['photo'];
			}

			$data['id'] = $id;
			//USER INFO - END

			foreach ($this->db->query("SELECT * FROM sections WHERE adviser = '$id'")->result_array() as $advcla) {
				$data['advgr'] = $advcla['gr_level'];
				$data['advsect'] = $advcla['sect_name'];
			}

			$this->load->view('templates/header');
			$this->load->view('pages/teacher/advisory', $data);
			$this->load->view('templates/footer');
			

		}else{
			redirect('/');
		}
	}

	################################################################################################################
	################################################################################################################

	//VIEW STUDENT PROFILE
	public function viewstudent($sessid, $lrn, $gradelvl, $prevlink){
		$sessid = str_replace("_47_", "/", str_replace("_50_", "=", $sessid));
		$decID = $this->encryption->decrypt($sessid);
		foreach($this->db->query("SELECT account_status FROM accounts WHERE id = $decID")->result_array() as $got){
			$got['account_status'];
		}

		$sessid = str_replace("/", "_47_", str_replace("=", "_50_", $sessid));

		if(!empty($this->session->userdata('teacher'.$decID)) && $got['account_status']=='Active'){

			$this->load->model('Teachers_model');

			$gradelvl = str_replace('%20', ' ', $gradelvl);

			if($gradelvl == 'Grade 7' || $gradelvl == 'Grade 8' || $gradelvl == 'Grade 9' || $gradelvl == 'Grade 10'){
				$query = $this->db->query("SELECT * FROM jhsstudents WHERE lrn = $lrn");
			}else{
				$query = $this->db->query("SELECT * FROM shsstudents WHERE lrn = $lrn");
			}

			
			if($query->num_rows()==1){
				foreach ($query->result_array() as $info) {
					$data['title'] = $info['fname']." ".$info['mname']." ".$info['lname'];
					$data['fname'] = $info['fname'];
					$data['mname'] = $info['mname'];
					$data['lname'] = $info['lname'];
					$data['lrn'] = $info['lrn'];
					$data['grade_level'] = $info['grade_level'];
					$data['section'] = $info['section'];
					$data['Birthdate'] = $info['Birthdate'];
					$data['sex'] = $info['sex'];
					$data['contact'] = $info['contact'];
					$data['address'] = $info['address'];
					$data['stat'] = $info['status'];
					$data['email'] = $info['email'];
					$data['studphoto'] = $info['photo'];
					$data['subj'] = $info['subjects'];
				}
				$data['prevlink'] = str_replace("%20", " ", $prevlink);

			//USER INFO
			$data['link'] = $sessid;
			extract($this->session->userdata('teacher'.$decID));

			$getInfo = $this->db->query("SELECT * FROM teachers WHERE id = '$id'");
			foreach ($getInfo->result_array() as $userInfo) {
				$data['name'] = $userInfo['fname'].' '.$userInfo['mname'].' '.$userInfo['lname'];
				$data['photo'] = $userInfo['photo'];
			}

			$data['id'] = $id;
			//USER INFO - END

				$this->load->view('templates/header');
				$this->load->view('pages/teacher/viewstudent', $data);
				$this->load->view('templates/footer');
			}else{
				redirect(base_url().'Teacher/dashboard/'.$sessid);
			}
				
		}else{
			redirect('/');
		}
	}
	################################################################################################################
	################################################################################################################
	################################################################################################################
	################################################################################################################


	################################################################################################################
	################################################################################################################
	################################################################################################################
	################################################################################################################
	//SUBJECTS
	public function subjects($subj, $sessid){
		$sessid = str_replace("_47_", "/", str_replace("_50_", "=", $sessid));
		$decID = $this->encryption->decrypt($sessid);
		foreach($this->db->query("SELECT account_status FROM accounts WHERE id = $decID")->result_array() as $got){
			$got['account_status'];
		}

		if(!empty($this->session->userdata('teacher'.$decID)) && $got['account_status']=='Active'){

			switch ($subj) {
				case 'overview':
					
					$this->load->model('Teachers_model');

					$data['title'] = 'Subjects';

					$data['link'] = str_replace("/", "_47_", str_replace("=", "_50_", $sessid));

					//USER INFO
					extract($this->session->userdata('teacher'.$decID));

					$getInfo = $this->db->query("SELECT * FROM teachers WHERE id = '$id'");
					foreach ($getInfo->result_array() as $userInfo) {
						$data['name'] = $userInfo['fname'].' '.$userInfo['mname'].' '.$userInfo['lname'];
						$data['photo'] = $userInfo['photo'];
					}

					$data['id'] = $id;
					//USER INFO - END

					$this->load->view('templates/header');
					$this->load->view('pages/teacher/subjects', $data);
					$this->load->view('templates/footer');

					break;
				
				default:

					$id = $this->encryption->decrypt($sessid);
					$subject = $this->db->query("SELECT * FROM subject_teacher WHERE subj_code = $subj AND subj_teacher = '$id'");
					foreach ($subject->result_array() as $s) {
						foreach ($this->db->query("SELECT * FROM subjects WHERE subj_code = '".$s['subj_code']."'")->result_array() as $sinfo) {

							$data['title'] = $sinfo['subj_title'];
							$data['desc'] = $sinfo['subj_desc'];
							$data['gr'] = $sinfo['gr_level'];
							$data['section'] = $s['section'];
							$data['code'] = $subj;
						}

					}

					$data['link'] = str_replace("/", "_47_", str_replace("=", "_50_", $sessid));

					//USER INFO
					extract($this->session->userdata('teacher'.$decID));

					$getInfo = $this->db->query("SELECT * FROM teachers WHERE id = '$id'");
					foreach ($getInfo->result_array() as $userInfo) {
						$data['name'] = $userInfo['fname'].' '.$userInfo['mname'].' '.$userInfo['lname'];
						$data['photo'] = $userInfo['photo'];
					}

					$data['id'] = $id;
					//USER INFO - END

					$this->load->model('Teachers_model');
					
					$this->load->view('templates/header');
					$this->load->view('pages/teacher/viewsubject', $data);
					$this->load->view('templates/footer');

					break;
			}

			
		}else{
			redirect('/');
		}
	}

	################################################################################################################
	################################################################################################################

	public function viewactivity($sessid, $subj, $gr, $sect, $act, $code, $lesson){
		$sessid = str_replace("_47_", "/", str_replace("_50_", "=", $sessid));
		$decID = $this->encryption->decrypt($sessid);
		foreach($this->db->query("SELECT account_status FROM accounts WHERE id = $decID")->result_array() as $got){
			$got['account_status'];
		}
		
		if(!empty($this->session->userdata('teacher'.$decID)) && $got['account_status']=='Active'){

			$this->load->model('Teachers_model');
			$data['title'] = str_replace("%20", " ", $act);
			$data['lesson'] = str_replace("%20", " ", $lesson);
			$data['subj_code'] = $code;
			$data['link'] = str_replace("/", "_47_", str_replace("=", "_50_", $sessid));
			$data['subj'] = str_replace("%20", " ", $subj);
			$data['grade'] = str_replace("%20", " ", $gr);
			$data['section'] = str_replace("%20", " ", $sect);

			//USER INFO
			extract($this->session->userdata('teacher'.$decID));

			$getInfo = $this->db->query("SELECT * FROM teachers WHERE id = '$id'");
			foreach ($getInfo->result_array() as $userInfo) {
				$data['name'] = $userInfo['fname'].' '.$userInfo['mname'].' '.$userInfo['lname'];
				$data['photo'] = $userInfo['photo'];
			}

			$data['id'] = $id;
			//USER INFO - END

			$this->load->view('templates/header');
			$this->load->view('pages/teacher/viewactivity', $data);
			$this->load->view('templates/footer');

		}else{
			redirect('/');
		}
	}

	################################################################################################################
	################################################################################################################

	public function viewquiz($sessid, $subj, $gr, $sect, $act, $code, $lesson){
		$sessid = str_replace("_47_", "/", str_replace("_50_", "=", $sessid));
		$decID = $this->encryption->decrypt($sessid);
		foreach($this->db->query("SELECT account_status FROM accounts WHERE id = $decID")->result_array() as $got){
			$got['account_status'];
		}
		
		if(!empty($this->session->userdata('teacher'.$decID)) && $got['account_status']=='Active'){

			$this->load->model('Teachers_model');
			$data['title'] = str_replace("%20", " ", $act);
			$data['lesson'] = str_replace("%20", " ", $lesson);
			$data['subj_code'] = $code;
			$data['link'] = str_replace("/", "_47_", str_replace("=", "_50_", $sessid));
			$data['subj'] = str_replace("%20", " ", $subj);
			$data['grade'] = str_replace("%20", " ", $gr);
			$data['section'] = str_replace("%20", " ", $sect);

			//USER INFO
			extract($this->session->userdata('teacher'.$decID));

			$getInfo = $this->db->query("SELECT * FROM teachers WHERE id = '$id'");
			foreach ($getInfo->result_array() as $userInfo) {
				$data['name'] = $userInfo['fname'].' '.$userInfo['mname'].' '.$userInfo['lname'];
				$data['photo'] = $userInfo['photo'];
			}

			$data['id'] = $id;
			//USER INFO - END

			$this->load->view('templates/header');
			$this->load->view('pages/teacher/viewquiz', $data);
			$this->load->view('templates/footer');

		}else{
			redirect('/');
		}
	}

	################################################################################################################
	################################################################################################################

	//UPLOADING A LESSON WITH MODULES
	public function UploadLesson($code, $subj, $sessid){
		$sessid = str_replace("_47_", "/", str_replace("_50_", "=", $sessid));
		$decID = $this->encryption->decrypt($sessid);
		foreach($this->db->query("SELECT account_status FROM accounts WHERE id = $decID")->result_array() as $got){
			$got['account_status'];
		}
		$sessid = str_replace("/", "_47_", str_replace("=", "_50_", $sessid));
		if(!empty($this->session->userdata('teacher'.$decID)) && $got['account_status']=='Active'){

			date_default_timezone_set('Asia/Manila');
			$sect = $_POST['section'];
			$gr = $_POST['gr'];
			$ok = 0;

			$dir = ''.str_replace("%20", " ", str_replace(":", "-", $subj)).'_'.$gr.'_'.$sect.'/';


			$count = count($_FILES['upFile']['name']);

			for($i = 0; $i < $count; $i++){

				if(!is_dir($dir)){
					mkdir($dir);
				}

				if($_FILES['upFile']['size'][$i] > 10000000/*10 MB*/){
					$this->session->set_flashdata('error', 'File too large');

					header('Location:'.base_url().'Teacher/subjects/'.$code.'/'.$sessid);
				}

				$filetype = pathinfo(basename($_FILES["upFile"]["name"][$i]),PATHINFO_EXTENSION);

				if($filetype != "pdf" && $filetype != "docx" && $filetype != "doc" && $filetype != "pptx" && $filetype != "ppt" && $filetype != "txt"){
					$this->session->set_flashdata('error', 'File is not allowed');

					header('Location:'.base_url().'Teacher/subjects/'.$code.'/'.$sessid);
				}

				$expname = explode(".", $_FILES['upFile']['name'][$i]);
				$newFile[$i] = str_replace(",", "_", $_POST['subtopic'][$i]).'.'.end($expname); 
				$savedfile[$i] = str_replace(" ", "-", str_replace(":", "-", $newFile[$i])); //To be saved in local storage

				
				if(file_exists($dir.basename($newFile[$i]))){
					$this->session->set_flashdata('error', 'File exists');

					header('Location:'.base_url().'Teacher/subjects/'.$code.'/'.$sessid);
				}
				


				$gr = str_replace(" ", "", $gr);
				$tbl = str_replace(" ", "", str_replace("-", "_", $sect)).'_'.str_replace(" ", "", $gr).'_'.$code;
				$laman = explode(" ", $_POST['maintopic']);
				echo $laman[0].' '.$laman[1];
				if($this->db->query("SELECT * FROM $tbl WHERE lesson LIKE '%".strtoupper($laman[0]).' '.strtoupper($laman[1])."%'")->num_rows() == 1){
					$this->session->set_flashdata('error', 'Duplicated lesson');

					header('Location:'.base_url().'Teacher/subjects/'.$code.'/'.$sessid);

				}else{
					$topic = $_POST['maintopic'];
					$topic = str_replace(":", "-", str_replace(",", "_", $topic));
					$dirtopic = $dir.$topic.'/';

					if(!is_dir($dirtopic)){
						mkdir($dirtopic);
					}

					
					//Saving file in the folder
					if(move_uploaded_file($_FILES['upFile']['tmp_name'][$i], $dirtopic.$savedfile[$i])){ //TMP name is for temp locating

						$ok = 1;

					}
				}
			
			}
			
			

			if($ok != 0){

				$mod_title = implode(", ", $newFile);
				$files = implode(", ",$savedfile);
				$gr = str_replace(" ", "", $gr);
				$tbl = str_replace(" ", "", str_replace("-", "_", $sect)).'_'.str_replace(" ", "", $gr).'_'.$code;
				$this->db->query("INSERT INTO $tbl(lesson, module) VALUES('".str_replace(",", "_", $_POST['maintopic'])."', '$mod_title')");

				$this->db->query("INSERT INTO logs VALUES('', 'new lesson was uploaded in ".str_replace("%20", " ", $subj)."', '".$code."_".$_POST['gr']."_".$sect."', '".date('Y-m-d H:i:s')."', '$decID', 'teacher', '')");

				$this->session->set_flashdata('success', 'Lesson uploaded');
				header('Location:'.base_url().'Teacher/subjects/'.$code.'/'.$sessid);

			}else{

				$this->session->set_flashdata('error', 'Error in uploading file');

				header('Location:'.base_url().'Teacher/subjects/'.$code.'/'.$sessid);

			}

		}else{
			redirect('/');
		}
	}

	################################################################################################################
	################################################################################################################

	//DELETE LESSON
	public function deleteLesson($sessid, $subj, $gr, $sect, $lesson, $code){
		$sessid = str_replace("_47_", "/", str_replace("_50_", "=", $sessid));
		$decID = $this->encryption->decrypt($sessid);
		foreach($this->db->query("SELECT account_status FROM accounts WHERE id = $decID")->result_array() as $got){
			$got['account_status'];
		}

		$sessid = str_replace("/", "_47_", str_replace("=", "_50_", $sessid));

		if(!empty($this->session->userdata('teacher'.$decID)) && $got['account_status']=='Active'){
			date_default_timezone_set('Asia/Manila');
			$grade = str_replace("%20", " ", $gr);
			$section = str_replace("%20", " ", $sect);

			$rdir = str_replace("%20", " ", str_replace(":", "-", $subj)).'_'.str_replace("%20", " ", $gr).'_'.str_replace("%20", " ", $sect).'/';
			$subdir = str_replace("%20", " ", str_replace(":", "-", $subj)).'_'.str_replace("%20", " ", $gr).'_'.str_replace("%20", " ", $sect).'/'.str_replace(":", "-", str_replace("%20", " ", $lesson)).'/';
			$lesson = str_replace("%20", " ", $lesson);
			$table = str_replace("%20", "", str_replace("-", "_", $sect)).'_'.str_replace("%20", "", $gr).'_'.$code;


			foreach ($this->db->query("SELECT * FROM $table WHERE lesson = '$lesson'")->result_array() as $got) {
				$got['module'];
				$act = $got['activity'];
				
			}

			//ACTIVITIES
			$activities = explode(", ", $act); //LIST OF ALL EXISTING ACTIVITIES
			
			for($a = 0; $a < count($activities); $a++){
				$actdir = str_replace(":", "-", $activities[$a]);

				//SUBMITTED ACTIVITY
				$querysubmittedact = $this->db->query("SELECT * FROM activities_submit WHERE subj_code = $code AND lesson_title = '$lesson' AND grade_level = '$grade' AND section = '$section' AND activity_title = '".$activities[$a]."'");
				
				if($querysubmittedact->num_rows() != 0){
					foreach ($querysubmittedact->result_array() as $z) {
						$dirlrn = $z['lrn'];
						$dirfile = $z['file_submitted'];
					}

					unlink($subdir.$actdir.'/Submitted Acts/'.$dirlrn.'/'.$dirfile);
					rmdir($subdir.$actdir.'/Submitted Acts/'.$dirlrn);
					rmdir($subdir.$actdir.'/Submitted Acts');

				}else{
					rmdir($subdir.$actdir.'/Submitted Acts');
				}
				//SUBMITTED ACTIVITY | END
				
				$queryact = $this->db->query("SELECT * FROM activities WHERE subj_code = $code AND lesson_title = '$lesson' AND grade_level = '$grade' AND section = '$section' AND activity_title = '".$activities[$a]."'");
				
				if($queryact->num_rows() != 0){
					foreach($queryact->result_array() as $g){
						$relfile = $g['related_file'];
					}
					
					unlink($subdir.$actdir.'/'.$relfile);
				}
				
				rmdir($subdir.'/'.$actdir);
			}
			//ACTIVITIES | END



			//MODULE
			$module = explode(", ", $got['module']);

			for($i = 0; count($module) > $i; $i++){
				$file = str_replace(" ", "-", str_replace(":", "-", $module[$i]));
				
				unlink($subdir.$file); //FILE DELETION
			}
			//MODULE | END
			
			rmdir($subdir);
			rmdir($rdir);


			
			$this->db->query("DELETE FROM activities_submit WHERE subj_code = $code AND lesson_title = '$lesson' AND grade_level = '$grade' AND section = '$section'");
			$this->db->query("DELETE FROM activities WHERE subj_code = $code AND lesson_title = '$lesson' AND grade_level = '$grade' AND section = '$section'");
			

			$this->db->query("DELETE FROM quiz_submit WHERE subj_code = $code AND lesson_title = '$lesson' AND grade_level = '$grade' AND section = '$section'");
			$this->db->query("DELETE FROM quiz WHERE subj_code = $code AND lesson_title = '$lesson' AND grade_level = '$grade' AND section = '$section'");
			
			$this->db->query("DELETE FROM $table WHERE lesson = '$lesson'");

			$this->db->query("INSERT INTO logs VALUES('', 'a lesson was removed in ".str_replace("%20", " ", $subj)."', '".$code."_".$grade."_".$section."', '".date('Y-m-d H:i:s')."', '$decID', 'teacher', '')");

			header('Location:'.base_url().'Teacher/subjects/'.$code.'/'.$sessid);
		}else{
			redirect('/');
		}
	}

	################################################################################################################
	################################################################################################################

	//ADDING MODULES UNDER THE SAME LESSON
	public function addModule($code, $subj, $sessid){
		$sessid = str_replace("_47_", "/", str_replace("_50_", "=", $sessid));
		$decID = $this->encryption->decrypt($sessid);
		foreach($this->db->query("SELECT account_status FROM accounts WHERE id = $decID")->result_array() as $got){
			$got['account_status'];
		}
		$sessid = str_replace("/", "_47_", str_replace("=", "_50_", $sessid));
		if(!empty($this->session->userdata('teacher'.$decID)) && $got['account_status']=='Active'){

			if($_POST['but'] == "rem"){
				header('Location:'.base_url().'Teacher/subjects/'.$code.'/'.$sessid);
			
			}else{
				$this->load->library('upload');
				date_default_timezone_set('Asia/Manila');
				$tbl = str_replace(" ", "", str_replace("-", "_", $_POST['section'])).'_'.str_replace(" ", "", $_POST['gr']).'_'.$code;

				foreach ($this->db->query("SELECT module FROM $tbl WHERE lesson = '".$_POST['lesson']."'")->result_array() as $got){
					$module = $got['module'];
				}

				$dir = str_replace("%20", " ", str_replace(":", "-", $subj)).'_'.$_POST['gr'].'_'.$_POST['section'].'/';
				$count = count($_FILES['addFile']['name']);
				
				/*$topic = str_replace(":", "-", $_POST['lesson']);

				$dirtopic = $dir.$topic;

				echo $count;
				if(file_exists($dirtopic)){
					for($i = 0; $i < $count; $i++){
						$filetoupload = $_FILES['addFile']['name'][$i];
						$exp = explode(".", $_FILES['addFile']['name'][$i]);
						$filenametosave = str_replace(":", "-", str_replace(",", "_", $_POST['addsubtopic'][$i]));
						
		                if (!$this->upload->do_upload($filenametosave.'.'.end($exp))){

		                    $this->session->set_flashdata('error', 'Unexpected error while uploading your file.');

		                    header('Location:'.base_url().'Teacher/subjects/'.$code.'/'.$sessid);

		                }else{

		                	$config['upload_path'] = ''.$dirtopic.'/';
							$config['allowed_types'] = 'xlsx|xls|doc|docx|ppt|pptx|txt|pdf';
							$config['file_name'] = $filenametosave.'.'.end($exp);
							$config['max_size'] = '102400';

							$this->upload->initialize($config);

		                    $this->session->set_flashdata('success', 'File uploaded');

		                    header('Location:'.base_url().'Teacher/subjects/'.$code.'/'.$sessid);
		                }
	            	}
	            }else{
					$this->session->set_flashdata('error', 'Directory does not exists.');
					header('Location:'.base_url().'Teacher/subjects/'.$code.'/'.$sessid);
				}*/

				if(file_exists($dir.str_replace(":", "-", $_POST['lesson']))){
					for($i = 0; $i < $count; $i++){

						if($_FILES['addFile']['size'][$i] > 10000000){ // IN KB (10 MB)

							$this->session->set_flashdata('error', 'File too large');

							header('Location:'.base_url().'Teacher/subjects/'.$code.'/'.$sessid);
						}


						$filetype = pathinfo(basename($_FILES["addFile"]["name"][$i]),PATHINFO_EXTENSION);

						if($filetype != "pdf" && $filetype != "docx" && $filetype != "doc" && $filetype != "pptx" && $filetype != "ppt" && $filetype != "txt"){
							$this->session->set_flashdata('error', 'File is not allowed');

							header('Location:'.base_url().'Teacher/subjects/'.$code.'/'.$sessid);
						}


						$expname = explode(".", $_FILES['addFile']['name'][$i]);
						$newFile[$i] = str_replace(",", "_", $_POST['addsubtopic'][$i]).'.'.end($expname); 
						$savedfile[$i] = str_replace(" ", "-", str_replace(":", "-", $newFile[$i])); //To be saved in local storage
						
						if(file_exists($dir.str_replace(":", "-", $_POST['lesson']).'/'.$savedfile[$i])){
							$this->session->set_flashdata('error', 'File exists');

							header('Location:'.base_url().'Teacher/subjects/'.$code.'/'.$sessid);

						}else{

							$topic = str_replace(":", "-", $_POST['lesson']);
							$dirtopic = $dir.$topic.'/';

							if(move_uploaded_file($_FILES['addFile']['tmp_name'][$i], $dirtopic.$savedfile[$i])){	//TMP name is for temp locating

								if(empty($module)){
									$modules = $newFile;
								}else{
									$newmod = implode(", ", $newFile);
									$modules = array($module, $newmod);
								}
								
								$updatedmodules = implode(", ", $modules);

								$this->db->query("UPDATE $tbl SET module = '$updatedmodules' WHERE lesson = '".$_POST['lesson']."'");

								$this->db->query("INSERT INTO logs VALUES('', 'added a module in ".str_replace("%20", " ", $subj)."', '".$code."_".$_POST['gr']."_".$_POST['section']."', '".date('Y-m-d H:i:s')."', '$decID', 'teacher', '')");

								$this->session->set_flashdata('success', 'File uploaded');
								header('Location:'.base_url().'Teacher/subjects/'.$code.'/'.$sessid);
							}
							
						}
					}

				}else{
					$this->session->set_flashdata('error', 'Directory does not exists.');
					header('Location:'.base_url().'Teacher/subjects/'.$code.'/'.$sessid);
				}
			}

		}else{
			redirect('/');
		}
	}

	################################################################################################################
	################################################################################################################

	//DELETE MODULE
	public function deleteModule($sessid, $subj, $gr, $sect, $module, $lesson, $code){
		$sessid = str_replace("_47_", "/", str_replace("_50_", "=", $sessid));
		$decID = $this->encryption->decrypt($sessid);
		foreach($this->db->query("SELECT account_status FROM accounts WHERE id = $decID")->result_array() as $got){
			$got['account_status'];
		}

		$sessid = str_replace("/", "_47_", str_replace("=", "_50_", $sessid));

		if(!empty($this->session->userdata('teacher'.$decID)) && $got['account_status']=='Active'){
			date_default_timezone_set('Asia/Manila');
			$gr = str_replace("%20", " ", $gr);
			$sect = str_replace("%20", " ", $sect);
			$module = str_replace("%20", " ", $module);
			$lesson = str_replace("%20", " ", $lesson);
			$subj = str_replace("%20", " ", $subj);
			
			$tbl = str_replace(" ", "", str_replace("-", "_", $sect)).'_'.str_replace(" ", "", $gr).'_'.$code;
			$dir = str_replace(":", "-", $subj).'_'.$gr.'_'.$sect.'/'.str_replace(":", "-", $lesson).'/';

			if($this->db->query("SHOW TABLES LIKE '$tbl'")->num_rows() == 1){
				
				$query = $this->db->query("SELECT * FROM $tbl WHERE lesson = '$lesson'");
				if($query->num_rows() == 1){

					foreach ($query->result_array() as $got) {
						$mod = $got['module'];
					}

					$modules = explode(", ", $mod);
					for($a=0;$a < count($modules); $a++){
						if($module == $modules[$a]){
							$toremove = str_replace(" ", "-", str_replace(":", "-", $modules[$a]));
							unlink($dir.$toremove);
							unset($modules[$a]);
						}
					}
					$newmod = implode(", ", $modules);
					$this->db->query("UPDATE $tbl SET module = '$newmod' WHERE lesson = '$lesson'");

					$this->db->query("INSERT INTO logs VALUES('', 'removed a module in ".$subj."', '".$code."_".$gr."_".$sect."', '".date('Y-m-d H:i:s')."', '$decID', 'teacher', '')");

					$this->session->set_flashdata('success', 'Successfully removed');
					header('Location:'.base_url().'Teacher/subjects/'.$code.'/'.$sessid);

				}else{
					$this->session->set_flashdata('error', 'Lesson does not exists!');
					header('Location:'.base_url().'Teacher/subjects/'.$code.'/'.$sessid);
				}
			}

		}else{
			redirect('/');
		}
	}

	################################################################################################################
	################################################################################################################

	public function addref($subjcode, $title, $sessid){
		
		$sessid = str_replace("_47_", "/", str_replace("_50_", "=", $sessid));
		$decID = $this->encryption->decrypt($sessid);
		foreach($this->db->query("SELECT account_status FROM accounts WHERE id = $decID")->result_array() as $got){
			$got['account_status'];
		}

		$sessid = str_replace("/", "_47_", str_replace("=", "_50_", $sessid));

		if(!empty($this->session->userdata('teacher'.$decID)) && $got['account_status']=='Active'){

			$tbl = str_replace(" ", "", str_replace("-", "_", $_POST['section'])).'_'.str_replace(" ", "", $_POST['gr']).'_'.$subjcode;
			
			if(!isset($_POST['linkss'])){
				header('Location:'.base_url().'Teacher/subjects/'.$subjcode.'/'.$sessid);
			
			}else{
				foreach ($this->db->query("SELECT addref FROM $tbl WHERE lesson = '".$_POST['lesson']."'")->result_array() as $a) {
					$p = $a['addref'];
				}

				if(empty($p)){
					$this->db->query("UPDATE $tbl SET addref = '".$_POST['linkss']."' WHERE lesson = '".$_POST['lesson']."'");

					$this->db->query("INSERT INTO logs VALUES('', 'added a content in ".$subj."', '".$subjcode."_".$_POST['gr']."_".$_POST['section']."', '".date('Y-m-d H:i:s')."', '$decID', 'teacher', '')");

					$this->session->set_flashdata('success', 'Added successfully.');
					header('Location:'.base_url().'Teacher/subjects/'.$subjcode.'/'.$sessid);
				}else{
					$new = array($p, $_POST['linkss']);
					$newcon = implode(", ", $new);

					$this->db->query("UPDATE $tbl SET addref = '".$newcon."' WHERE lesson = '".$_POST['lesson']."'");

					$this->db->query("INSERT INTO logs VALUES('', 'added a content in ".$subj."', '".$subjcode."_".$_POST['gr']."_".$_POST['section']."', '".date('Y-m-d H:i:s')."', '$decID', 'teacher', '')");

					$this->session->set_flashdata('success', 'Added successfully.');
					header('Location:'.base_url().'Teacher/subjects/'.$subjcode.'/'.$sessid);
				}
			}

		}else{
			redirect('/');
		}

	}

	################################################################################################################
	################################################################################################################

	public function deleteref($sessid, $gr, $sect, $refe, $lesson, $code){
		$sessid = str_replace("_47_", "/", str_replace("_50_", "=", $sessid));
		$decID = $this->encryption->decrypt($sessid);
		foreach($this->db->query("SELECT account_status FROM accounts WHERE id = $decID")->result_array() as $got){
			$got['account_status'];
		}

		$sessid = str_replace("/", "_47_", str_replace("=", "_50_", $sessid));

		if(!empty($this->session->userdata('teacher'.$decID)) && $got['account_status']=='Active'){
			date_default_timezone_set('Asia/Manila');
			$gr = str_replace("%20", " ", $gr);
			$sect = str_replace("%20", " ", $sect);
			$refe = str_replace("%20", " ", str_replace("--", "//", str_replace("_gte", "/",$refe)));
			$lesson = str_replace("%20", " ", $lesson);
			
			$tbl = str_replace(" ", "", str_replace("-", "_", $sect)).'_'.str_replace(" ", "", $gr).'_'.$code;
			echo $refe;
			if($this->db->query("SHOW TABLES LIKE '$tbl'")->num_rows() == 1){
				
				$query = $this->db->query("SELECT * FROM $tbl WHERE lesson = '$lesson'");
				if($query->num_rows() == 1){

					foreach ($query->result_array() as $got) {
						$ref = $got['addref'];
					}

					$refs = explode(",", $ref);
					for($a = 0;$a < count($refs); $a++){
						if($refe == $refs[$a]){
							unset($refs[$a]);
						}
					}
					$newref = implode(", ", $refs);
					$this->db->query("UPDATE $tbl SET addref = '$newref' WHERE lesson = '$lesson'");

					$this->session->set_flashdata('success', 'Successfully removed');
					header('Location:'.base_url().'Teacher/subjects/'.$code.'/'.$sessid);

				}else{
					$this->session->set_flashdata('error', 'Lesson does not exists!');
					header('Location:'.base_url().'Teacher/subjects/'.$code.'/'.$sessid);
				}
			}

		}else{
			redirect('/');
		}
	}

	################################################################################################################
	################################################################################################################

	//Upload activity
	public function uploadActivity($code, $subj, $sessid){
		$sessid = str_replace("_47_", "/", str_replace("_50_", "=", $sessid));
		$decID = $this->encryption->decrypt($sessid);
		foreach($this->db->query("SELECT account_status FROM accounts WHERE id = $decID")->result_array() as $got){
			$got['account_status'];
		}

		$sessid = str_replace("/", "_47_", str_replace("=", "_50_", $sessid));

		if(!empty($this->session->userdata('teacher'.$decID)) && $got['account_status']=='Active'){

			if($_POST['but'] == "rem"){
				header('Location:'.base_url().'Teacher/subjects/'.$code.'/'.$sessid);

			}else{
				date_default_timezone_set('Asia/Manila');
				$tbl = str_replace(" ", "", str_replace("-", "_", $_POST['act_section'])).'_'.str_replace(" ", "", $_POST['act_gr']).'_'.$code;

				//RUBRICS
				$tot = 0;
				for($a = 0; $a < count($_POST['percent']); $a++){
					$tot = $_POST['percent'][$a] + $tot;
				}
				//RUBRICS | END


				if($tot < 100 && $tot > 100){
					$this->session->set_flashdata('error', 'Please validate your rubrics.');
					header('Location:'.base_url().'Teacher/subjects/'.$code.'/'.$sessid);
				}else{
					if($this->db->query("SHOW TABLES LIKE '$tbl'")->num_rows() == 1){

						$acttitle = str_replace(",", "_", $_POST['act_title']);
						$lesson = $_POST['act_lesson'];
						$inst = $_POST['act_inst'];
						$due = $_POST['act_due'];
						$grlvl = $_POST['act_gr'];
						$sect = $_POST['act_section'];
						$attempt = $_POST['act_attempt'];
						$filetoaccept = $_POST['filetoaccept'];

						for($a = 0; $a < count($_POST['criterion']); $a++){
							$rub[] = $_POST['criterion'][$a].': '.$_POST['percent'][$a];
						}
						$rubrics = implode(", ", $rub);


						$actdir = str_replace("%20", " ", str_replace(":", "-", $subj)).'_'.$grlvl.'_'.$sect.'/'.str_replace(":", "-", $lesson).'/'.str_replace(":", "-", $acttitle).'/';
						$submitDir = str_replace("%20", " ", str_replace(":", "-", $subj)).'_'.$grlvl.'_'.$sect.'/'.str_replace(":", "-", $lesson).'/'.str_replace(":", "-", $acttitle).'/Submitted Acts/';

						if(!is_dir($actdir) && !is_dir($submitDir)){ //Create directory if does not exist
							mkdir($actdir);
							mkdir($submitDir);
						}

						if(isset($_FILES['act_relfile']['name'])){
							$relfile = $_FILES['act_relfile']['name'];

							$savedfile = str_replace(" ", "-", str_replace(":", "-", $relfile));
							move_uploaded_file($_FILES['act_relfile']['tmp_name'], $actdir.$savedfile); //TMP name is for temp locating

						}else{
							$relfile = '';
						}

						
						$query = $this->db->query("SELECT * FROM $tbl WHERE lesson = '$lesson'");
						if($query->num_rows() == 1){
							foreach ($query->result_array() as $got) {
								$acts = $got['activity'];
							}

							if(empty($got['activity'])){
								$newacts = $acttitle;
							}else{
								$conc = array($acts, $acttitle);
								$newacts = implode(", ", $conc);
							}
							

							if($this->db->query("UPDATE $tbl SET activity = '$newacts' WHERE lesson = '$lesson'")){
								$this->db->query("INSERT INTO activities VALUES($code, '$lesson', '$grlvl', '$sect', '$acttitle', '$due', '$filetoaccept', '$inst', $attempt, '$relfile', '$rubrics')");

								$this->db->query("INSERT INTO logs VALUES('', 'new activity was uploaded in ".str_replace("%20", " ", $subj)."', '".$code."_".$grlvl."_".$sect."', '".date('Y-m-d H:i:s')."', '$decID', 'teacher', '')");

								$this->session->set_flashdata('success', 'Uploaded successfully');
								header('Location:'.base_url().'Teacher/subjects/'.$code.'/'.$sessid);

							}else{
								$this->session->set_flashdata('error', 'Unexpected error while uploading.');
								header('Location:'.base_url().'Teacher/subjects/'.$code.'/'.$sessid);
							}

						}else{
							$this->session->set_flashdata('error', 'Lesson does not exists!');
							header('Location:'.base_url().'Teacher/subjects/'.$code.'/'.$sessid);
						}

					}else{
						$this->session->set_flashdata('error', 'Table does not exists. Please report to the Administrator.');
						header('Location:'.base_url().'Teacher/subjects/'.$code.'/'.$sessid);
					}
				}

			}
				
		}else{
			redirect('/');
		}
	}

	################################################################################################################
	################################################################################################################

	//DELETE ACTIVITY
	public function deleteActivity($sessid, $subj, $gr, $sect, $activity, $lesson, $code){
		$sessid = str_replace("_47_", "/", str_replace("_50_", "=", $sessid));
		$decID = $this->encryption->decrypt($sessid);
		foreach($this->db->query("SELECT account_status FROM accounts WHERE id = $decID")->result_array() as $got){
			$got['account_status'];
		}

		$sessid = str_replace("/", "_47_", str_replace("=", "_50_", $sessid));

		if(!empty($this->session->userdata('teacher'.$decID)) && $got['account_status']=='Active'){
			date_default_timezone_set('Asia/Manila');
			$gr = str_replace("%20", " ", $gr);
			$sect = str_replace("%20", " ", $sect);
			$activity = str_replace("%20", " ", $activity);
			$lesson = str_replace("%20", " ", $lesson);
			$subj = str_replace("%20", " ", $subj);
			
			$tbl = str_replace(" ", "", str_replace("-", "_", $sect)).'_'.str_replace(" ", "", $gr).'_'.$code;

			if($this->db->query("SHOW TABLES LIKE '$tbl'")->num_rows() == 1){
			
				$query = $this->db->query("SELECT * FROM $tbl WHERE lesson = '$lesson'");
				if($query->num_rows() == 1){

					foreach ($query->result_array() as $got) {
						$act = $got['activity'];
					}

					$dir = str_replace(":", "-", $subj).'_'.$gr.'_'.$sect.'/'.str_replace(":", "-", $lesson).'/'.str_replace(":", "-", $activity).'/';
					$subdir = str_replace(":", "-", $subj).'_'.$gr.'_'.$sect.'/'.str_replace(":", "-", $lesson).'/'.str_replace(":", "-", $activity).'/Submitted Acts/';
					$activities = explode(", ", $act); //LIST OF ALL EXISITING ACTIVITIES
					for($a = 0; $a < count($activities); $a++){
						if($activity == $activities[$a]){

							if($this->db->query("SELECT * FROM activities_submit WHERE subj_code = $code AND lesson_title = '$lesson' AND grade_level = '$gr' AND section = '$sect' AND activity_title = '".$activities[$a]."'")->num_rows() > 0){
								foreach ($this->db->query("SELECT * FROM activities_submit WHERE subj_code = $code AND lesson_title = '$lesson' AND grade_level = '$gr' AND section = '$sect' AND activity_title = '".$activities[$a]."'")->result_array() as $act_s) {
									$dirlrn = $act_s['lrn'];
									$dirfile = $act_s['file_submitted'];
								}

								unlink($subdir.$dirlrn.'/'.str_replace(" ", "-", str_replace(":", "-", $dirfile)));
								rmdir($subdir.$dirlrn.'/');
							}
							

							foreach($this->db->query("SELECT * FROM activities WHERE subj_code = $code AND lesson_title = '$lesson' AND grade_level = '$gr' AND section = '$sect' AND activity_title = '".$activities[$a]."'")->result_array() as $g){
								$file = $g['related_file'];
							}
							
							$toremove = $activities[$a];
							unset($activities[$a]);
							unlink($dir.str_replace(" ", "-", str_replace(":", "-", $file)));
							rmdir($subdir);
							rmdir($dir);

						}
					}
					$newactivity = implode(", ", $activities);
					$this->db->query("UPDATE $tbl SET activity = '$newactivity' WHERE lesson = '$lesson'");
					$this->db->query("DELETE FROM activities WHERE subj_code = $code AND lesson_title = '$lesson' AND grade_level = '$gr' AND section = '$sect' AND activity_title = '$toremove'");
					$this->db->query("DELETE FROM activities_submit WHERE subj_code = $code AND lesson_title = '$lesson' AND grade_level = '$gr' AND section = '$sect' AND activity_title = '$toremove'");

					$this->db->query("INSERT INTO logs VALUES('', 'an activity was removed in ".$subj."', '".$code."_".$gr."_".$sect."', '".date('Y-m-d H:i:s')."', '$decID', 'teacher', '')");

					$this->session->set_flashdata('success', 'Successfully removed');
					header('Location:'.base_url().'Teacher/subjects/'.$code.'/'.$sessid);

				}else{
					$this->session->set_flashdata('error', 'Lesson does not exists!');
					header('Location:'.base_url().'Teacher/subjects/'.$code.'/'.$sessid);
				}
			}

		}else{
			redirect('/');
		}
	}

	################################################################################################################
	################################################################################################################

	public function Removequestion($sessid, $subj_code){
		$sessid = str_replace("_47_", "/", str_replace("_50_", "=", $sessid));
		$decID = $this->encryption->decrypt($sessid);
		foreach($this->db->query("SELECT account_status FROM accounts WHERE id = $decID")->result_array() as $got){
			$got['account_status'];
		}
		$sessid = str_replace("/", "_47_", str_replace("=", "_50_", $sessid));
		if(!empty($this->session->userdata('teacher'.$decID)) && $got['account_status']=='Active'){
			
			$type = $_POST['type'];

			if($type == 'multiplechoice'){
				$query = $this->db->query("SELECT * FROM question_bank_mult WHERE subj_code = $subj_code");
			
			}else if($type == 'identification'){
				$query = $this->db->query("SELECT * FROM question_bank_ident WHERE subj_code = $subj_code");
			
			}else if($type == 'enumeration'){
				$query = $this->db->query("SELECT * FROM question_bank_enum WHERE subj_code = $subj_code");
			
			}else if($type == 'matchingtype'){
				$query = $this->db->query("SELECT * FROM question_bank_match WHERE subj_code = $subj_code");
			
			}else{
				$query = $this->db->query("SELECT * FROM question_bank_truefalse WHERE subj_code = $subj_code");
			}

			$questions = $_POST['quest'];
			$subj = $_POST['subj'];
			$gr = $_POST['gr'];
			//print_r($questions);

			if($query->num_rows() != 0){

				###############################################################################################
				//multiplechoice ##############################################################################
				if($type == 'multiplechoice'){
					foreach ($query->result_array() as $q) {

						$cont = $q['content'];

			            $contpart = explode(", ", $cont);
			           	
			            for ($b = 0; $b < count($contpart); $b++) {
			                for ($c = 0; $c < count($questions); $c++) { 
			                	if($contpart[$b] == $questions[$c]){
									$contdata[$b] = explode(" _ ", $contpart[$b]);
									$contdata[$b] = str_replace("[", "", str_replace("]", "", $contdata[$b]));

									$qi = explode(" img ", $contdata[$b][0]);

		                            for ($d = 1; $d <= 4; $d++) {
		                            	$li = explode(" img ", $contdata[$b][$d]);

		                                if(!empty($li[1])) {
		                                	$adir = str_replace(":", "-", $subj).'_'.$gr.'/'.str_replace("?", " qmark", $qi[0]).'/';
		                                	unlink($adir.$li[1]);
		                                }
		                            }

		                            if(!empty($qi[1])) {
		                            	$dir = str_replace(":", "-", $subj).'_'.$gr.'/'.str_replace("?", " qmark", $qi[0]).'/';
		                                unlink($dir.$qi[1]);
		                                
		                                if(is_dir_empty($dir)) {
		                                	rmdir($dir);
		                                }
		                            }

			                		unset($contpart[$b]);
			                		$contpart = array_values($contpart);
			                	}
			                }      		
			            }
			            $new = implode(", ", $contpart);
			    	}
			    	if($this->db->query("UPDATE question_bank_mult SET content = '".$new."' WHERE subj_code = '".$subj_code."'")){
			    		$this->session->set_flashdata('success', 'Successfully removed');
			    		header('Location:'.base_url().'Teacher/subjects/'.$subj_code.'/'.$sessid);

			    	}else{
			    		$this->session->set_flashdata('error', 'There was a problem encountered while updating the questions.');
			    		header('Location:'.base_url().'Teacher/subjects/'.$subj_code.'/'.$sessid);
			    	}
			    	
			    }
			    //multiplechoice | END

			    ###############################################################################################
				//enumeration #################################################################################
				if($type == 'enumeration'){
					foreach ($query->result_array() as $q) {

						$cont = $q['content'];

			            $contpart = explode(", ", $cont);
			           	
			            for ($b = 0; $b < count($contpart); $b++) {
			                for ($c = 0; $c < count($questions); $c++) { 
			                	if($contpart[$b] == $questions[$c]){
									//$contdata[$b] = explode(" _ ", $contpart[$b]);
									//$contdata[$b] = str_replace("[", "", str_replace("]", "", $contdata[$b]));

			                		unset($contpart[$b]);
			                		$contpart = array_values($contpart);
			                	}
			                }      		
			            }
			            $new = implode(", ", $contpart);
			    	}
			    	if($this->db->query("UPDATE question_bank_enum SET content = '".$new."' WHERE subj_code = '".$subj_code."'")){
			    		$this->session->set_flashdata('success', 'Successfully removed');
			    		header('Location:'.base_url().'Teacher/subjects/'.$subj_code.'/'.$sessid);

			    	}else{
			    		$this->session->set_flashdata('error', 'There was a problem encountered while updating the questions.');
			    		header('Location:'.base_url().'Teacher/subjects/'.$subj_code.'/'.$sessid);
			    	}
			    	
			    }
			    //enumeration | END

			    ###############################################################################################
				//identification ##############################################################################
				if($type == 'identification'){
					foreach ($query->result_array() as $q) {

						$cont = $q['content'];

			            $contpart = explode(", ", $cont);
			           	
			            for ($b = 0; $b < count($contpart); $b++) {
			                for ($c = 0; $c < count($questions); $c++) { 
			                	if($contpart[$b] == $questions[$c]){
									//$contdata[$b] = explode(" _ ", $contpart[$b]);
									//$contdata[$b] = str_replace("[", "", str_replace("]", "", $contdata[$b]));

			                		unset($contpart[$b]);
			                		$contpart = array_values($contpart);
			                	}
			                }      		
			            }
			            $new = implode(", ", $contpart);
			    	}
			    	if($this->db->query("UPDATE question_bank_ident SET content = '".$new."' WHERE subj_code = '".$subj_code."'")){
			    		$this->session->set_flashdata('success', 'Successfully removed');
			    		header('Location:'.base_url().'Teacher/subjects/'.$subj_code.'/'.$sessid);

			    	}else{
			    		$this->session->set_flashdata('error', 'There was a problem encountered while updating the questions.');
			    		header('Location:'.base_url().'Teacher/subjects/'.$subj_code.'/'.$sessid);
			    	}
			    	
			    }
			    //identification | END

			    ###############################################################################################
				//matchingtype ##############################################################################
				if($type == 'matchingtype'){
					foreach ($query->result_array() as $q) {

						$cont = $q['content'];

			            $contpart = explode(", ", $cont);
			           	
			            for ($b = 0; $b < count($contpart); $b++) {
			                for ($c = 0; $c < count($questions); $c++) { 
			                	if($contpart[$b] == $questions[$c]){
									//$contdata[$b] = explode(" _ ", $contpart[$b]);
									//$contdata[$b] = str_replace("[", "", str_replace("]", "", $contdata[$b]));

			                		unset($contpart[$b]);
			                		$contpart = array_values($contpart);
			                	}
			                }      		
			            }
			            $new = implode(", ", $contpart);
			    	}
			    	if($this->db->query("UPDATE question_bank_match SET content = '".$new."' WHERE subj_code = '".$subj_code."'")){
			    		$this->session->set_flashdata('success', 'Successfully removed');
			    		header('Location:'.base_url().'Teacher/subjects/'.$subj_code.'/'.$sessid);

			    	}else{
			    		$this->session->set_flashdata('error', 'There was a problem encountered while updating the questions.');
			    		header('Location:'.base_url().'Teacher/subjects/'.$subj_code.'/'.$sessid);
			    	}
			    	
			    }
			    //matchingtype | END

			    ###############################################################################################
				//trueorfalse #################################################################################
				if($type == 'trueorfalse'){
					foreach ($query->result_array() as $q) {

						$cont = $q['content'];

			            $contpart = explode(", ", $cont);
			           	
			            for ($b = 0; $b < count($contpart); $b++) {
			                for ($c = 0; $c < count($questions); $c++) { 
			                	if($contpart[$b] == $questions[$c]){
									//$contdata[$b] = explode(" _ ", $contpart[$b]);
									//$contdata[$b] = str_replace("[", "", str_replace("]", "", $contdata[$b]));

			                		unset($contpart[$b]);
			                		$contpart = array_values($contpart);
			                	}
			                }      		
			            }
			            $new = implode(", ", $contpart);
			    	}
			    	if($this->db->query("UPDATE question_bank_truefalse SET content = '".$new."' WHERE subj_code = '".$subj_code."'")){
			    		$this->session->set_flashdata('success', 'Successfully removed');
			    		header('Location:'.base_url().'Teacher/subjects/'.$subj_code.'/'.$sessid);

			    	}else{
			    		$this->session->set_flashdata('error', 'There was a problem encountered while updating the questions.');
			    		header('Location:'.base_url().'Teacher/subjects/'.$subj_code.'/'.$sessid);
			    	}
			    	
			    }
			    //trueorfalse | END
		    }else{
				echo '<p class="w3-padding w3-pale-yellow w3-center">No questions were created.</p>';
				header('Location:'.base_url().'Teacher/subjects/'.$subj_code.'/'.$sessid);
			}

		}else{
			redirect('/');
		}
	}

	################################################################################################################
	################################################################################################################

	//CONFIRM ACTIVITY GRADE
	public function confirmActgrade($sessid, $lrn, $subjcode, $lesson, $gr, $sect, $act, $subj){
		$sessid = str_replace("_47_", "/", str_replace("_50_", "=", $sessid));
		$decID = $this->encryption->decrypt($sessid);
		foreach($this->db->query("SELECT account_status FROM accounts WHERE id = $decID")->result_array() as $got){
			$got['account_status'];
		}
		$sessid = str_replace("/", "_47_", str_replace("=", "_50_", $sessid));
		if(!empty($this->session->userdata('teacher'.$decID)) && $got['account_status']=='Active'){
			date_default_timezone_set('Asia/Manila');

			$lesson = str_replace("%20", " ", $lesson);
			$gr = str_replace("%20", " ", $gr);
			$sect = str_replace("%20", " ", $sect);
			$act = str_replace("%20", " ", $act);

			$query = $this->db->query("SELECT * FROM activities_submit WHERE subj_code = $subjcode AND lesson_title = '$lesson' AND grade_level = '$gr' AND section = '$sect' AND activity_title = '$act' AND lrn = '$lrn'");
			if($query->num_rows() == 1){

				$total = 0;
				for ($i=0; $i < count($_POST['score']); $i++) { 
					$total = $_POST['score'][$i] + $total;
				}

				$this->db->query("UPDATE activities_submit SET grade = $total WHERE subj_code = $subjcode AND lesson_title = '$lesson' AND grade_level = '$gr' AND section = '$sect' AND activity_title = '$act' AND lrn = '$lrn'");

				$this->db->query("INSERT INTO logs VALUES('', 'has graded an activity in ".str_replace('%20', ' ', $subj)."', '$lrn', '".date('Y-m-d H:i:s')."', '$decID', 'teacher', '')");

				$this->session->set_flashdata('success', 'Graded successfully');
				header('Location:'.base_url().'Teacher/viewactivity/'.$sessid.'/'.$subj.'/'.$gr.'/'.$sect.'/'.$act.'/'.$subjcode.'/'.$lesson);
				
			}else{
				$this->session->set_flashdata('error', 'No activity found!');
				header('Location:'.base_url().'Teacher/viewactivity/'.$sessid.'/'.$subj.'/'.$gr.'/'.$sect.'/'.$act.'/'.$subjcode.'/'.$lesson);
			}
		}else{
			redirect('/');
		}
	}

	################################################################################################################
	################################################################################################################

	//EXAM CREATION
	public function examcreation($subj_code, $subj, $sessid){
		$sessid = str_replace("_47_", "/", str_replace("_50_", "=", $sessid));
		$decID = $this->encryption->decrypt($sessid);
		foreach($this->db->query("SELECT account_status FROM accounts WHERE id = $decID")->result_array() as $got){
			$got['account_status'];
		}
		$sessid = str_replace("/", "_47_", str_replace("=", "_50_", $sessid));
		if(!empty($this->session->userdata('teacher'.$decID)) && $got['account_status']=='Active'){

			$tbl = str_replace(" ", "", str_replace("-", "_", $_POST['exam_section'])).'_'.str_replace(" ", "", $_POST['exam_gr']).'_'.$subj_code;
			
			$title = str_replace(",", "_", $_POST['exam_title']);
			$duration = $_POST['exam_duration'];
			$due = $_POST['exam_deadline'];
			$attempt = $_POST['exam_attempt'];
			$noOftypes = $_POST['ExamnoOfTypes'];
			$section = $_POST['exam_section'];
			$gr = $_POST['exam_gr'];
			$lesson = $_POST['exam_lesson'];


			if($this->db->query("SHOW TABLES LIKE '$tbl'")->num_rows() == 1){
				
				if($this->db->query("SELECT quiz FROM $tbl WHERE quiz LIKE '%".$title."%'")->num_rows() == 1){
					$this->session->set_flashdata('error', 'Quiz/exam title cannot be duplicated');
					header('Location:'.base_url().'Teacher/subjects/'.$subj_code.'/'.$sessid);

				}else{
					
					header('Location:'.base_url().'Teacher/CreateExam/'.$sessid.'/'.$subj_code.'/'.$title.'/'.$duration.'/'.$due.'/'.$attempt.'/'.$noOftypes.'/'.$section.'/'.$gr.'/'.$lesson);
				}

			}else{
				$this->session->set_flashdata('error', 'Table does not exists. Please report to the Administrator.');
				header('Location:'.base_url().'Teacher/subjects/'.$subj_code.'/'.$sessid);
			}

		}else{
			redirect('/');
		}
	}

	################################################################################################################
	################################################################################################################

	//CREATE EXAM PAGE
	public function CreateExam($sessid, $subj_code, $exam_title, $duration, $due, $attempt, $noOftypes, $sect, $gr, $lesson){
		$sessid = str_replace("_47_", "/", str_replace("_50_", "=", $sessid));
		$decID = $this->encryption->decrypt($sessid);
		foreach($this->db->query("SELECT account_status FROM accounts WHERE id = $decID")->result_array() as $got){
			$got['account_status'];
		}
		
		if(!empty($this->session->userdata('teacher'.$decID)) && $got['account_status']=='Active'){

			$this->load->model('Teachers_model');
			$data['subj_code'] = $subj_code;
			$data['title'] = str_replace("%20", " ", $exam_title);
			$data['duration'] = $duration;
			$data['due'] = str_replace('T', ' ', $due);
			$data['attempt'] = $attempt;
			$data['noOftypes'] = $noOftypes;
			$data['sect'] = str_replace("%20", " ", $sect);
			$data['gr'] = str_replace("%20", " ", $gr);
			$data['lesson'] = str_replace("%20", " ", $lesson);
			$data['link'] = str_replace("/", "_47_", str_replace("=", "_50_", $sessid));

			//USER INFO
			extract($this->session->userdata('teacher'.$decID));

			$getInfo = $this->db->query("SELECT * FROM teachers WHERE id = '$id'");
			foreach ($getInfo->result_array() as $userInfo) {
				$data['name'] = $userInfo['fname'].' '.$userInfo['mname'].' '.$userInfo['lname'];
				$data['photo'] = $userInfo['photo'];
			}

			$data['id'] = $id;
			//USER INFO - END

			$this->load->view('templates/header');
			$this->load->view('pages/teacher/create_exam', $data);
			$this->load->view('templates/footer');

		}else{
			redirect('/');
		}
	}

	################################################################################################################
	################################################################################################################

	/*public function questions($type, $subj_code){
		
		$query = $this->db->query("SELECT * FROM quiz WHERE subj_code = $subj_code");

			if($query->num_rows() != 0){
				
				foreach ($query->result_array() as $q) {

					//$types = explode(", ", $q['typeofexam']);
					$cont = explode(" + ", $q['content']);

					for ($z=0; $z < count($cont); $z++) { 
						$part[$z] = explode(" => ", $cont[$z]);
					}
					echo '<form>';
					for ($a=0; $a < count($part); $a++) { 

						$types[$a] = str_replace("{", "", str_replace("}", "", str_replace("%20", " ", $part[$a][0])));

						if($type == $types[$a]){//multiplechoice
	                        
	                        $contpart = explode(", ", str_replace("[", "", str_replace("]", "", $part[$a][1])));

	                        for ($b=0; $b < count($contpart); $b++) {
	                            
	                           	$contdata[$b] = explode(" _ ", $contpart[$b]);
	                                		
	                            for ($c=0; $c < count($contdata[$b]); $c++) { 
	                                if($c == 0){
	                                	$contdata[$b]['question'] = $contdata[$b][$c];
	                                	unset($contdata[$b][$c]);
	                                }
	                                if($c+1 == count($contdata[$b])){
	                                	$contdata[$b]['correct'] = str_replace(" = ", "", $contdata[$b][$c]);
	                                	unset($contdata[$b][$c]);
	                                }
	                             }
	                        }

	                        for ($b = 0; $b < count($contpart); $b++) {
	                        echo '<div class="w3-container w3-padding">
	                        		<input type="checkbox" name="" class="w3-check"> ';
	                            echo '<label>'.$contdata[$b]['question'].'</label><br/>';
	                            for ($c = 1; $c <= 4; $c++) {
	                                if($contdata[$b]['correct'] == $contdata[$b][$c]){
	                                    $selected = 'checked';
	                                }else{
	                                    $selected = '';
	                                }
	                                echo '<input type="radio" '.$selected.' disabled> '.$contdata[$b][$c].' </label>';
	                            }
	                        echo '</div>';
	                        }
	                    }
					}
					echo '</form>';

					for($a = 0; $a < count($types); $a++){
						$types[$a] = str_replace("{", "", str_replace("}", "", str_replace("%20", " ", $types[$a])));

	                    //echo '<div class="w3-margin-bottom w3-border w3-padding">';

	                            if($type == 'multiplechoice'){//multiplechoice
	                                
	                                	$contpart = explode(", ", str_replace("[", "", str_replace("]", "", $part[$a][1])));

	                                	for ($b=0; $b < count($contpart); $b++) {
	                                		$contdata[$b] = explode(" _ ", $contpart[$b]);
	                                		
	                                		for ($c=0; $c < count($contdata[$b]); $c++) { 
	                                			if($c == 0){
	                                				$contdata[$b]['question'] = $contdata[$b][$c];
	                                				unset($contdata[$b][$c]);
	                                			}
	                                			if($c+1 == count($contdata[$b])){
	                                				$contdata[$b]['correct'] = str_replace(" = ", "", $contdata[$b][$c]);
	                                				unset($contdata[$b][$c]);
	                                			}
	                                		}
	                                	}

	                                    for ($b = 0; $b < count($contpart); $b++) {
	                                        echo '<pre>'.$contdata[$b]['question'].'</pre>';
	                                        for ($c = 1; $c <= 4; $c++) {
	                                            if($contdata[$b]['correct'] == $contdata[$b][$c]){
	                                               $selected = 'checked';
	                                            }else{
	                                                $selected = '';
	                                            }
	                                            echo '<input type="radio" class="w3-radio" '.$selected.' disabled> '.$contdata[$b][$c].' ';
	                                        }
	                                        //echo '</p>';
	                                    }
	                            }

	                            else if($type == 'enumeration'){//enumeration

	                                	$contpart = explode(", ", str_replace("[", "", str_replace("]", "", $part[$a][1])));

	                                	$contdata['instruction'] = $contpart[0];
	                                	for ($b=1; $b < count($contpart); $b++) { 
	                                		$contdata[$b] = explode(" = ", $contpart[$b]);

	                                		$contdata[$b]['question'] = $contdata[$b][0];
	                                		unset($contdata[$b][0]);
	                                		$contdata[$b]['correct'] = str_replace(" _ ", ", ", $contdata[$b][1]);
	                                		unset($contdata[$b][1]);
	                                	}
	                                	
	                                    echo '<pre><b>Instruction: </b>'.$contdata['instruction'].'</pre>';
	                                    for ($b = 1; $b < count($contpart); $b++) {
	                                        $num = $b;
	                                        
	                                        echo '<pre><b>'.$num.'.</b> '.$contdata[$b]['question'].'</pre>';
	                                        echo '<p><b>Answer: </b>';
	                                        echo '<input type="text" class="w3-input w3-border w3-round" value="'.$contdata[$b]['correct'].'" disabled>';
	                                        echo '</p>';
	                                        $num++;
	                                    }
	                            }

								else if($type == 'identification'){//identification

	                                	$contpart = explode(", ", str_replace("[", "", str_replace("]", "", $part[$a][1])));

	                                	for ($b=0; $b < count($contpart); $b++) {
	                                		$contdata[$b] = explode(" = ", $contpart[$b]);
	                                		
	                                		for ($c=0; $c < count($contdata[$b]); $c++) { 
	                                			if($c == 0){
	                                				$contdata[$b]['question'] = $contdata[$b][$c];
	                                				unset($contdata[$b][$c]);
	                                			}
	                                			if($c+1 == count($contdata[$b])){
	                                				$contdata[$b]['correct'] = str_replace(" = ", "", $contdata[$b][$c]);
	                                				unset($contdata[$b][$c]);
	                                			}
	                                		}
	                                	}


	                                    for ($b = 0; $b < count($contpart); $b++) {
	                                        $num = $b+1;
	                                        echo '<pre><b>'.$num.'.</b> '.$contdata[$b]['question'].'</pre>';
	                                        
	                                            echo '<select class="w3-select w3-border w3-round" disabled>';
	                                                echo '<option>'.$contdata[$b]['correct'].'</option>';
	                                            echo '</select>';
	                                        
	                                        $num++;
	                                    }
	                            }    
	                                

	                            else if($type == 'true or false'){//true or false
	                                	$contpart = explode(", ", str_replace("[", "", str_replace("]", "", $part[$a][1])));
	                                	
	                                	for ($b=0; $b < count($contpart); $b++) {
	                                		$contdata[$b] = explode(" = ", $contpart[$b]);
	                                		
	                                		for ($c=0; $c < count($contdata[$b]); $c++) { 
	                                			if($c == 0){
	                                				$contdata[$b]['question'] = $contdata[$b][$c];
	                                				unset($contdata[$b][$c]);
	                                			}
	                                			if($c+1 == count($contdata[$b])){
	                                				$contdata[$b]['correct'] = str_replace(" = ", "", $contdata[$b][$c]);
	                                				unset($contdata[$b][$c]);
	                                			}
	                                		}
	                                	}


	                                    for ($b = 0; $b < count($contpart); $b++) {
	                                        $num = $b+1;
	                                        $selected = '';
	                                        echo '<pre><b>'.$num.'.</b> '.$contdata[$b]['question'].'</pre>';

	                                        if($contdata[$b]['correct'] == "True"){
	                                            $selectedtrue = 'checked';
	                                            $selectedfalse = '';
	                                        }else{
	                                            $selectedfalse = 'checked';
	                                            $selectedtrue = '';
	                                        }
	                                        echo '<input type="radio" '.$selectedtrue.' disabled> True<br/>';
	                                        echo '<input type="radio" '.$selectedfalse.' disabled> False<br/>';
	                                        //echo '</p>';
	                                        
	                                        $num++;
	                                    }
	                                    
	                            }
	                            
					}
				}

			}

	}*/

	################################################################################################################
	################################################################################################################

	public function postcreateexam($sessid, $exam_title, $duration, $due, $attempt, $noOftypes, $subj_code, $sect, $gr, $lesson){
		$sessid = str_replace("_47_", "/", str_replace("_50_", "=", $sessid));
		$decID = $this->encryption->decrypt($sessid);
		foreach($this->db->query("SELECT account_status FROM accounts WHERE id = $decID")->result_array() as $got){
			$got['account_status'];
		}
		
		if(!empty($this->session->userdata('teacher'.$decID)) && $got['account_status']=='Active'){

			$this->load->model('Teachers_model');
			$data['subj_code'] = $subj_code;
			$data['title'] = str_replace("%20", " ", $exam_title);
			$data['duration'] = $duration;
			$data['due'] = str_replace("%20", " ", $due);
			$data['attempt'] = $attempt;
			$data['noOftypes'] = $noOftypes;
			$data['sect'] = str_replace("%20", " ", $sect);
			$data['gr'] = str_replace("%20", " ", $gr);
			$data['lesson'] = str_replace("%20", " ", $lesson);
			$data['link'] = str_replace("/", "_47_", str_replace("=", "_50_", $sessid));
			$data['typesofquestion'] = $_POST['types'];
			$data['noOfitems'] = $_POST['items'];

			//USER INFO
			extract($this->session->userdata('teacher'.$decID));

			$getInfo = $this->db->query("SELECT * FROM teachers WHERE id = '$id'");
			foreach ($getInfo->result_array() as $userInfo) {
				$data['name'] = $userInfo['fname'].' '.$userInfo['mname'].' '.$userInfo['lname'];
				$data['photo'] = $userInfo['photo'];
			}

			$data['id'] = $id;
			//USER INFO - END

			$this->load->view('templates/header');
			$this->load->view('pages/teacher/post_create_exam', $data);
			$this->load->view('templates/footer');

		}else{
			redirect('/');
		}
	}

	################################################################################################################
	################################################################################################################

	public function previewexam($sessid, $exam_title, $duration, $due, $attempt, $noOftypes, $subj_code, $sect, $gr, $lesson, $typesofquestion, $noOfitems){
		$sessid = str_replace("_47_", "/", str_replace("_50_", "=", $sessid));
		$decID = $this->encryption->decrypt($sessid);
		foreach($this->db->query("SELECT account_status FROM accounts WHERE id = $decID")->result_array() as $got){
			$got['account_status'];
		}
		
		if(!empty($this->session->userdata('teacher'.$decID)) && $got['account_status']=='Active'){
			
			$this->load->model('Teachers_model');
			$data['subj_code'] = $subj_code;
			foreach ($this->db->query("SELECT subj_title FROM subjects WHERE subj_code = $subj_code")->result_array() as $a) {
				$data['subj_title'] = $a['subj_title'];
			}
			$data['title'] = str_replace("%20", " ", $exam_title);
			$data['duration'] = $duration;
			$data['due'] = str_replace("%20", " ", $due);
			$data['attempt'] = $attempt;
			$data['noOftypes'] = $noOftypes;
			$data['sect'] = str_replace("%20", " ", $sect);
			$data['gr'] = str_replace("%20", " ", $gr);
			$data['lesson'] = str_replace("%20", " ", $lesson);
			$data['link'] = str_replace("/", "_47_", str_replace("=", "_50_", $sessid));
			$data['typesofquestion'] = str_replace("%20", " ", $typesofquestion);
			$data['noOfitems'] = $noOfitems;

			
			if(isset($_POST['mult'])){
				$data['mult'] = $_POST['mult'];
				$mult = $_POST['mult'];
				//print_r($_POST['mult']);
				if(isset($_FILES['questimage'])){
					$data['questimage'] = $_FILES['questimage'];
					$images = $_FILES['questimage'];

					for($i = 0; $i < count($mult); $i++){
						
						if(!empty($images['name'][$i]['qimage'])){

							$dir = str_replace(":", "-", $data['subj_title']).'_'.$data['gr'];
							//$adir = $dir.'/'.str_replace(":", "-", str_replace(",", "_", $data['lesson']));
							$adir = $dir.'/'.str_replace("?", " qmark", $mult[$i]['question']).'/';

                            if(!is_dir($dir)){
                                mkdir($dir);
                            }

                            if(!is_dir($adir)){
                                mkdir($adir);
                            }
                            
                                      
                            $tmpname = $images['tmp_name'][$i]['qimage'];
                            $qpic = $images['name'][$i]['qimage'];

                            $expname = explode(".", $qpic);
                            $newpic = str_replace("?", " qmark", $mult[$i]['question']).'_'.$expname[0].".".end($expname);

                            if(!file_exists($newpic)){
                            	move_uploaded_file($tmpname, $adir.$newpic);
                            }
						}

						for ($j = 1; $j <= 4; $j++) { 
							//echo $images['name'][$i]['choice'.$j];

							if(!empty($images['name'][$i]['choice'.$j])){
								
								$cdir = str_replace(":", "-", $data['subj_title']).'_'.$data['gr'];
								$ddir = $cdir.'/'.str_replace("?", " qmark", $mult[$i]['question']).'/';

	                            if(!is_dir($cdir)){
	                                mkdir($cdir);
	                            }

	                            if(!is_dir($ddir)){
	                                mkdir($ddir);
	                            }
	                                      
	                            $ctmpname = $images['tmp_name'][$i]['choice'.$j];
	                            $cpic = $images['name'][$i]['choice'.$j];

	                            $cexpname = explode(".", $cpic);
	                            $cnewpic = $mult[$i][$j].'_'.$cexpname[0].".".end($cexpname);

	                            if(!file_exists($cnewpic)){
	                            	move_uploaded_file($ctmpname, $ddir.$cnewpic);
	                            }
							}
						}
					}
					
				}
				
			}
			if(isset($_POST['ident'])){
				$data['ident'] = $_POST['ident'];
				//print_r($_POST['ident']);
			}
			if(isset($_POST['match'])){
				$data['match'] = $_POST['match'];
				//print_r($_POST['ident']);
			}
			if(isset($_POST['enum'])){
				$data['enum'] = $_POST['enum'];
				//print_r($_POST['enum']);
			}
			if(isset($_POST['truefalse'])){
				$data['truefalse'] = $_POST['truefalse'];
				//print_r($_POST['truefalse']);
			}
			

			//USER INFO
			extract($this->session->userdata('teacher'.$decID));

			$getInfo = $this->db->query("SELECT * FROM teachers WHERE id = '$id'");
			foreach ($getInfo->result_array() as $userInfo) {
				$data['name'] = $userInfo['fname'].' '.$userInfo['mname'].' '.$userInfo['lname'];
				$data['photo'] = $userInfo['photo'];
			}

			$data['id'] = $id;
			//USER INFO - END

			$this->load->view('templates/header');
			$this->load->view('pages/teacher/preview_exam', $data);
			$this->load->view('templates/footer');
			
		}else{
			redirect('/');
		}
	}

	################################################################################################################
	################################################################################################################

	public function saveexam($sessid, $exam_title, $duration, $due, $attempt, $noOftypes, $subj_code, $sect, $gr, $lesson, $typesofquestion){
		$sessid = str_replace("_47_", "/", str_replace("_50_", "=", $sessid));
		$decID = $this->encryption->decrypt($sessid);
		foreach($this->db->query("SELECT account_status FROM accounts WHERE id = $decID")->result_array() as $got){
			$got['account_status'];
		}
		$sessid = str_replace("/", "_47_", str_replace("=", "_50_", $sessid));
		if(!empty($this->session->userdata('teacher'.$decID)) && $got['account_status']=='Active'){
			date_default_timezone_set('Asia/Manila');
			$exam_title = str_replace("%20", " ", $exam_title);
			$lesson = str_replace("%20", " ", $lesson);
			$gr = str_replace("%20", " ", $gr);
			$sect = str_replace("%20", " ", $sect);
			$due = str_replace("%20", " ", $due);
			
			$types = explode("_", $typesofquestion);
			
			$content[] = '';
			//$forqbank[][] = '';
			
			for ($a = 0; $a < count($types); $a++) { 
				
				if($types[$a] == 'multiplechoice'){
					$mult = $_POST['mult'];
					
					$types[$a] = '{'.$types[$a].'}';

					for ($b = 0; $b < count($mult); $b++) {

						if(isset($_POST['questimg'])){
							$imgs = $_POST['questimg'];

							if(isset($imgs[$b]['qimage'])){
								$mult[$b]['question'] = array($mult[$b]['question'], $imgs[$b]['qimage']);
								$mult[$b]['question'] = implode(' [img] ', $mult[$b]['question']);
								
							}

							for ($c = 1; $c <= 4; $c++) { 
								if(!empty($imgs[$b]['choice'.$c])){
									$mult[$b][$c] = array($mult[$b][$c], $imgs[$b]['choice'.$c]);
									$mult[$b][$c] = implode(' [img] ', $mult[$b][$c]);//echo $imgs[$b]['choice'.$c];
									
								}
							}
						
						}
						

						if($mult[$b]['correct']){
							$mult[$b]['correct'] = ' = '.$mult[$b]['correct'];
						}
						$setmult[$b] = '['.implode(" _ ", $mult[$b]).']';
						//echo $setmult[$b];
						//if($trigger == 0 && $trig == 0){
							if($this->db->query("SELECT * FROM question_bank_mult WHERE subj_code = $subj_code AND content LIKE '%".$setmult[$b]."%'")->num_rows() == 0){

								$forqbankmult[$b] = $setmult[$b];
								
							}
						//}
					}
					if(!empty($forqbankmult)){

						if($this->db->query("SELECT * FROM question_bank_mult WHERE subj_code = $subj_code")->num_rows() == 1){
							foreach ($this->db->query("SELECT * FROM question_bank_mult WHERE subj_code = $subj_code")->result_array() as $mcont) {
								$multprev = $mcont['content'];
							}
							$multcurr = implode(", ", $forqbankmult);
							if(empty($multprev)){
								$multpr = $multcurr;
								$multnew = $multpr;
							}else{
								$multpr = array($multprev, $multcurr);
								$multnew = implode(", ", $multpr);
							}
							
							
							$this->db->query("UPDATE question_bank_mult SET content = '".$multnew."' WHERE subj_code = $subj_code");

						}else{
							$multcurr = implode(", ", $forqbankmult);
							$this->db->query("INSERT INTO question_bank_mult VALUES($subj_code, '".$multcurr."')");
						}
					}

					$combinemult = implode(", ", $setmult);
					$new = array($types[$a], $combinemult);
					$content[$a] = implode(" => ", $new);
				}

				######################################################################################################################
				######################################################################################################################

				if($types[$a] == 'identification'){
					$ident = $_POST['ident'];

					$types[$a] = '{'.$types[$a].'}';

					for ($b = 0; $b < count($ident); $b++) { 
						$setident[$b] = '['.implode(" = ", $ident[$b]).']';

						if($this->db->query("SELECT * FROM question_bank_ident WHERE subj_code = $subj_code AND content LIKE '%".$setident[$b]."%'")->num_rows() == 0){
								
							$forqbankident[$b] = $setident[$b];

						}
						
					}

					if(!empty($forqbankident)){
						if($this->db->query("SELECT * FROM question_bank_ident WHERE subj_code = $subj_code")->num_rows() == 1){
							foreach ($this->db->query("SELECT * FROM question_bank_ident WHERE subj_code = $subj_code")->result_array() as $icont) {
								$identprev = $icont['content'];
							}
							$identcurr = implode(", ", $forqbankident);
							if(empty($identprev)){
								$identpr = $identcurr;
								$identnew = $identpr;
							}else{
								$identpr = array($identprev, $identcurr);
								$identnew = implode(", ", $identpr);
							}
							
							$this->db->query("UPDATE question_bank_ident SET content = '".$identnew."' WHERE subj_code = $subj_code");

						}else{
							$identcurr = implode(", ", $forqbankident);
							$this->db->query("INSERT INTO question_bank_ident VALUES($subj_code, '".$identcurr."')");
						}
					}

					$combineident = implode(", ", $setident);
					$new = array($types[$a], $combineident);
					$content[$a] = implode(" => ", $new);
				}

				######################################################################################################################
				######################################################################################################################

				if($types[$a] == 'matchingtype'){
					$match = $_POST['match'];

					$types[$a] = '{'.$types[$a].'}';

					for ($b=0; $b < count($match); $b++) { 
						$setmatch[$b] = '['.implode(" = ", $match[$b]).']';
						
						if($this->db->query("SELECT * FROM question_bank_match WHERE subj_code = $subj_code AND content LIKE '%".$setmatch[$b]."%'")->num_rows() == 0){

							$forqbankmt[$b] = $setmatch[$b];

						}
						
					}

					if(!empty($forqbankmt)){
						if($this->db->query("SELECT * FROM question_bank_match WHERE subj_code = $subj_code")->num_rows() == 1){
							foreach ($this->db->query("SELECT * FROM question_bank_match WHERE subj_code = $subj_code")->result_array() as $mtcont) {
								$mtprev = $mtcont['content'];
							}
							$mtcurr = implode(", ", $forqbankmt);
							if(empty($mtprev)){
								$mtpr = $mtcurr;
								$mtnew = $mtpr;
							}else{
								$mtpr = array($mtprev, $mtcurr);
								$mtnew = implode(", ", $mtpr);
							}

							$this->db->query("UPDATE question_bank_match SET content = '".$mtnew."' WHERE subj_code = $subj_code");

						}else{
							$mtcurr = implode(", ", $forqbankmt);
							$this->db->query("INSERT INTO question_bank_match VALUES($subj_code, '".$mtcurr."')");
						}
					}

					$combinematch = implode(", ", $setmatch);
					$new = array($types[$a], $combinematch);
					$content[$a] = implode(" => ", $new);
				}

				######################################################################################################################
				######################################################################################################################

				if($types[$a] == 'enumeration'){
					$enum = $_POST['enum'];
					
					$types[$a] = '{'.$types[$a].'}';

					for ($b=0; $b < count($enum); $b++) {
						if($b == 0){
							//$setenum[$b] = '['.implode(" = ", $enum[$b]).']';
						}
						else if($enum[$b]['correct']){
							$ha = explode(", ", $enum[$b]['correct']);
							$enum[$b]['correct'] = implode(" _ ", $ha);

						}
						$setenum[$b] = '['.implode(" = ", $enum[$b]).']';
						if($this->db->query("SELECT * FROM question_bank_enum WHERE subj_code = $subj_code AND content LIKE '%".$setenum[$b]."%'")->num_rows() == 0){
								
							$forqbankenum[$b] = $setenum[$b];

						}
					}

					if(!empty($forqbankenum)){
						if($this->db->query("SELECT * FROM question_bank_enum WHERE subj_code = $subj_code")->num_rows() == 1){
							foreach ($this->db->query("SELECT * FROM question_bank_enum WHERE subj_code = $subj_code")->result_array() as $enumcont) {
								$enumprev = $enumcont['content'];
							}
							$enumcurr = implode(", ", $forqbankenum);
							if(empty($enumprev)){
								$enumpr = $enumcurr;
								$enumnew = $enumpr;
							}else{
								$enumpr = array($enumprev, $enumcurr);
								$enumnew = implode(", ", $enumpr);
							}

							$this->db->query("UPDATE question_bank_enum SET content = '".$enumnew."' WHERE subj_code = $subj_code");

						}else{
							$enumcurr = implode(", ", $forqbankenum);
							$this->db->query("INSERT INTO question_bank_enum VALUES($subj_code, '".$enumcurr."')");
						}
					}

					$combineenum = implode(", ", $setenum);
					$new = array($types[$a], $combineenum);
					$content[$a] = implode(" => ", $new);
				}

				######################################################################################################################
				######################################################################################################################

				if($types[$a] == 'true%20or%20false'){
					$truefalse = $_POST['truefalse'];
					
					$types[$a] = '{'.$types[$a].'}';

					for ($b = 0; $b < count($truefalse); $b++) {
						$settruefalse[$b] = '['.implode(" = ", $truefalse[$b]).']';

						if($this->db->query("SELECT * FROM question_bank_truefalse WHERE subj_code = $subj_code AND content LIKE '%".$settruefalse[$b]."%'")->num_rows() == 0){
							
							$forqbanktruefalse[$b] = $settruefalse[$b];
						}
						
					}

					if(!empty($forqbanktruefalse)){
						if($this->db->query("SELECT * FROM question_bank_truefalse WHERE subj_code = $subj_code")->num_rows() == 1){
							foreach ($this->db->query("SELECT * FROM question_bank_truefalse WHERE subj_code = $subj_code")->result_array() as $truefalsecont) {
								$truefalseprev = $truefalsecont['content'];
							}
							$truefalsecurr = implode(", ", $forqbanktruefalse);
							if(empty($truefalseprev)){
								$truefalsepr = $truefalsecurr;
								$truefalsenew = $truefalsepr;
							}else{
								$truefalsepr = array($truefalseprev, $truefalsecurr);
								$truefalsenew = implode(", ", $truefalsepr);
							}
							
							$this->db->query("UPDATE question_bank_truefalse SET content = '".$truefalsenew."' WHERE subj_code = $subj_code");

						}else{
							$truefalsecurr = implode(", ", $forqbanktruefalse);
							$this->db->query("INSERT INTO question_bank_truefalse VALUES($subj_code, '".$truefalsecurr."')");
						}
					}

					$combinetruefalse = implode(", ", $settruefalse);
					$new = array($types[$a], $combinetruefalse);
					$content[$a] = implode(" => ", $new);
				}
			}

			$laman = implode(" + ", $content);
			
			foreach ($this->db->query("SELECT subj_title FROM subjects WHERE subj_code = $subj_code")->result_array() as $a) {
				$subj = $a['subj_title'];
			}

			$table = str_replace(" ", "", str_replace("-", "_", $sect)).'_'.str_replace(" ", "", $gr).'_'.$subj_code;
			$query = $this->db->query("SELECT * FROM $table WHERE lesson = '$lesson'");
			if($query->num_rows() == 1){
				foreach ($query->result_array() as $got) {
					$quiz = $got['quiz'];
				}

				if(empty($got['quiz'])){
					$newquiz = $exam_title;

				}else{
					$conc = array($quiz, $exam_title);
					$newquiz = implode(", ", $conc);

				}
						

				if($this->db->query("UPDATE $table SET quiz = '$newquiz' WHERE lesson = '$lesson'")){
					$this->db->query("INSERT INTO quiz VALUES($subj_code, '$lesson', '$gr', '$sect', '$exam_title', $duration, '$due', $attempt, '".implode(", ", $types)."', '".$laman."')");


					$this->db->query("INSERT INTO logs VALUES('', 'new exam was created in ".$subj."', '".$subj_code."_".$gr."_".$sect."', '".date('Y-m-d H:i:s')."', '$decID', 'teacher', '')");

					$this->session->set_flashdata('success', 'Exam uploaded');
					header('Location:'.base_url().'Teacher/subjects/'.$subj_code.'/'.$sessid);

				}else{
					$this->session->set_flashdata('error', 'Unexpected error while uploading.');
					header('Location:'.base_url().'Teacher/subjects/'.$subj_code.'/'.$sessid);
				}

			}else{
				$this->session->set_flashdata('error', 'Lesson does not exists!');
				header('Location:'.base_url().'Teacher/subjects/'.$subj_code.'/'.$sessid);
			}

		}else{
			redirect('/');
		}
	}

	################################################################################################################
	################################################################################################################

	//DELETE QUIZ
	public function deletequiz($sessid, $subj, $gr, $sect, $quiz, $lesson, $code){
		$sessid = str_replace("_47_", "/", str_replace("_50_", "=", $sessid));
		$decID = $this->encryption->decrypt($sessid);
		foreach($this->db->query("SELECT account_status FROM accounts WHERE id = $decID")->result_array() as $got){
			$got['account_status'];
		}

		$sessid = str_replace("/", "_47_", str_replace("=", "_50_", $sessid));

		if(!empty($this->session->userdata('teacher'.$decID)) && $got['account_status']=='Active'){
			date_default_timezone_set('Asia/Manila');
			$gr = str_replace("%20", " ", $gr);
			$sect = str_replace("%20", " ", $sect);
			$quiz = str_replace("%20", " ", $quiz);
			$lesson = str_replace("%20", " ", $lesson);
			$subj = str_replace("%20", " ", $subj);
			
			$tbl = str_replace(" ", "", str_replace("-", "_", $sect)).'_'.str_replace(" ", "", $gr).'_'.$code;

			if($this->db->query("SHOW TABLES LIKE '$tbl'")->num_rows() == 1){
			
				$query = $this->db->query("SELECT * FROM $tbl WHERE lesson = '$lesson'");
				if($query->num_rows() == 1){

					foreach ($query->result_array() as $got) {
						$quizzes = $got['quiz'];
					}

					$quizzes = explode(", ", $quizzes); //LIST OF ALL EXISITING ACTIVITIES
					for($a = 0; $a < count($quizzes); $a++){
						if($quiz == $quizzes[$a]){
							
							$toremove = $quizzes[$a];
							unset($quizzes[$a]);

						}
					}
					$newquiz = implode(", ", $quizzes);
					$this->db->query("UPDATE $tbl SET quiz = '$newquiz' WHERE lesson = '$lesson'");
					$this->db->query("DELETE FROM quiz WHERE subj_code = $code AND lesson_title = '$lesson' AND grade_level = '$gr' AND section = '$sect' AND quiz_title = '$toremove'");
					/*$this->db->query("DELETE FROM activities_submit WHERE subj_code = $code AND lesson_title = '$lesson' AND grade_level = '$gr' AND section = '$sect' AND activity_title = '$toremove'");*/

					$this->db->query("INSERT INTO logs VALUES('', 'exam was removed in ".$subj."', '".$code."_".$gr."_".$sect."', '".date('Y-m-d H:i:s')."', '$decID', 'teacher', '')");

					$this->session->set_flashdata('success', 'Successfully removed');
					header('Location:'.base_url().'Teacher/subjects/'.$code.'/'.$sessid);

				}else{
					$this->session->set_flashdata('error', 'Lesson does not exists!');
					header('Location:'.base_url().'Teacher/subjects/'.$code.'/'.$sessid);
				}
			}

		}else{
			redirect('/');
		}
	}

	################################################################################################################
	################################################################################################################

	################################################################################################################
	################################################################################################################

	//FILE DOWNLOAD
	public function downloadFile($sessid, $subj, $gr, $sect, $module, $lesson, $code){
		$sessid = str_replace("_47_", "/", str_replace("_50_", "=", $sessid));
		$decID = $this->encryption->decrypt($sessid);
		foreach($this->db->query("SELECT account_status FROM accounts WHERE id = $decID")->result_array() as $got){
			$got['account_status'];
		}
		$sessid = str_replace("/", "_47_", str_replace("=", "_50_", $sessid));
		if(!empty($this->session->userdata('teacher'.$decID)) && $got['account_status']=='Active'){
			$this->load->helper('download');

			$mod = str_replace(":", "-", str_replace("%20", "-", $module));

			$dir = str_replace("%20", " ", $subj).'_'.str_replace("%20", " ", $gr).'_'.str_replace("%20", " ", $sect).'/'.str_replace(":", "-", str_replace("%20", " ", $lesson)).'/';
			
			$file = $mod;
			$data = file_get_contents($dir.$mod);
			force_download($mod, $data);
			//force_download($dir.str_replace(":", "-", str_replace("%20", "-", $module)), NULL);

			header('Location:'.base_url().'Teacher/subjects/'.$code.'/'.$sessid);

		}else{
			redirect('/');
		}
	}

	public function downloadAttach($sessid, $subj, $gr, $sect, $act, $lesson, $acttitle, $code){
		$sessid = str_replace("_47_", "/", str_replace("_50_", "=", $sessid));
		$decID = $this->encryption->decrypt($sessid);
		foreach($this->db->query("SELECT account_status FROM accounts WHERE id = $decID")->result_array() as $got){
			$got['account_status'];
		}
		$sessid = str_replace("/", "_47_", str_replace("=", "_50_", $sessid));
		if(!empty($this->session->userdata('teacher'.$decID)) && $got['account_status']=='Active'){
			$this->load->helper('download');

			$a = str_replace(":", "-", str_replace("%20", "-", $act));

			$dir = str_replace("%20", " ", str_replace(":", "-", $subj)).'_'.str_replace("%20", " ", $gr).'_'.str_replace("%20", " ", $sect).'/'.str_replace(":", "-", str_replace("%20", " ", $lesson)).'/'.str_replace(":", "-", str_replace("%20", " ", $acttitle)).'/';
			
			$b = $a;
			$data = file_get_contents($dir.$a);
			force_download($a, $data);
			//force_download($dir.str_replace(":", "-", str_replace("%20", "-", $act)), NULL);

			header('Location:'.base_url().'Teacher/viewactivity/'.$sessid.'/'.$subj.'/'.$gr.'/'.$sect.'/'.$act.'/'.$code.'/'.$lesson);
		}else{
			redirect('/');
		}
	}


	//FILE SUBMITTED BY STUDENTS
	public function downloadSubmitAct($sessid, $subj, $gr, $sect, $file, $lesson, $acttitle, $code, $lrn){
		$sessid = str_replace("_47_", "/", str_replace("_50_", "=", $sessid));
		$decID = $this->encryption->decrypt($sessid);
		foreach($this->db->query("SELECT account_status FROM accounts WHERE id = $decID")->result_array() as $got){
			$got['account_status'];
		}
		$sessid = str_replace("/", "_47_", str_replace("=", "_50_", $sessid));
		if(!empty($this->session->userdata('teacher'.$decID)) && $got['account_status']=='Active'){
			$this->load->helper('download');

			$a = str_replace(":", "-", str_replace("%20", "-", $file));

			$dir = str_replace("%20", " ", str_replace(":", "-", $subj)).'_'.str_replace("%20", " ", $gr).'_'.str_replace("%20", " ", $sect).'/'.str_replace(":", "-", str_replace("%20", " ", $lesson)).'/'.str_replace(":", "-", str_replace("%20", " ", $acttitle)).'/Submitted Acts/'.$lrn.'/';
			
			$b = $a;
			$data = file_get_contents($dir.$a);
			force_download($a, $data);

			//force_download($dir.str_replace(":", "-", str_replace("%20", "-", $file)), NULL);

			header('Location:'.base_url().'Teacher/viewactivity/'.$sessid.'/'.$subj.'/'.$gr.'/'.$sect.'/'.$act.'/'.$code.'/'.$lesson);
		}else{
			redirect('/');
		}
	}
	//SUBJECTS | END
	################################################################################################################
	################################################################################################################
	################################################################################################################
	################################################################################################################


	################################################################################################################
	################################################################################################################
	################################################################################################################
	################################################################################################################

	public function grading($sessid){
		
		$sessid = str_replace("_47_", "/", str_replace("_50_", "=", $sessid));
		$decID = $this->encryption->decrypt($sessid);
		foreach($this->db->query("SELECT account_status FROM accounts WHERE id = $decID")->result_array() as $got){
			$got['account_status'];
		}

		$sessid = str_replace("/", "_47_", str_replace("=", "_50_", $sessid));
		
		if(!empty($this->session->userdata('teacher'.$decID)) && $got['account_status']=='Active'){

			$this->load->model('Teachers_model');
			$data['link'] = $sessid;
			$data['title'] = 'Grades';
			//USER INFO
			extract($this->session->userdata('teacher'.$decID));

			$getInfo = $this->db->query("SELECT * FROM teachers WHERE id = '$id'");
			foreach ($getInfo->result_array() as $userInfo) {
				$data['name'] = $userInfo['fname'].' '.$userInfo['mname'].' '.$userInfo['lname'];
				$data['photo'] = $userInfo['photo'];
			}

			$data['id'] = $id;
			//USER INFO - END

			$this->load->view('templates/header');
			$this->load->view('pages/teacher/grades', $data);
			$this->load->view('templates/footer');

		}else{
			redirect('/');
		}

	}

	################################################################################################################
	################################################################################################################

	public function subjectstograde($subjcode, $sessid){
		$sessid = str_replace("_47_", "/", str_replace("_50_", "=", $sessid));
		$decID = $this->encryption->decrypt($sessid);
		foreach($this->db->query("SELECT account_status FROM accounts WHERE id = $decID")->result_array() as $got){
			$got['account_status'];
		}

		$sessid = str_replace("/", "_47_", str_replace("=", "_50_", $sessid));
		
		if(!empty($this->session->userdata('teacher'.$decID)) && $got['account_status']=='Active'){

			$subject = $this->db->query("SELECT * FROM subject_teacher WHERE subj_code = $subjcode AND subj_teacher = '$decID'");

			foreach ($subject->result_array() as $s) {

				foreach ($this->db->query("SELECT * FROM subjects WHERE subj_code = '".$s['subj_code']."'")->result_array() as $sinfo) {

					$data['title'] = $sinfo['subj_title'];
					$data['gr'] = $sinfo['gr_level'];
					$data['section'] = $s['section'];
					$data['code'] = $subjcode;
				}

			}

			$data['link'] = str_replace("/", "_47_", str_replace("=", "_50_", $sessid));

			//USER INFO
			extract($this->session->userdata('teacher'.$decID));

			$getInfo = $this->db->query("SELECT * FROM teachers WHERE id = '$decID'");
			foreach ($getInfo->result_array() as $userInfo) {
				$data['name'] = $userInfo['fname'].' '.$userInfo['mname'].' '.$userInfo['lname'];
				$data['photo'] = $userInfo['photo'];
			}

			$data['id'] = $id;
			//USER INFO - END

			$this->load->model('Teachers_model');
					
			$this->load->view('templates/header');
			$this->load->view('pages/teacher/subjecttograde', $data);
			$this->load->view('templates/footer');

		}else{
			redirect('/');
		}
	}

	################################################################################################################
	################################################################################################################
	################################################################################################################
	################################################################################################################


	################################################################################################################
	################################################################################################################
	################################################################################################################
	################################################################################################################

	public function concerns($sessid){
		$sessid = str_replace("_47_", "/", str_replace("_50_", "=", $sessid));
		$decID = $this->encryption->decrypt($sessid);
		foreach($this->db->query("SELECT account_status FROM accounts WHERE id = $decID")->result_array() as $got){
			$got['account_status'];
		}

		$sessid = str_replace("/", "_47_", str_replace("=", "_50_", $sessid));
		
		if(!empty($this->session->userdata('teacher'.$decID)) && $got['account_status']=='Active'){

			$this->load->model('Teachers_model');
			$data['link'] = $sessid;
			$data['title'] = 'Concerns';
			//USER INFO
			extract($this->session->userdata('teacher'.$decID));

			$getInfo = $this->db->query("SELECT * FROM teachers WHERE id = '$id'");
			foreach ($getInfo->result_array() as $userInfo) {
				$data['name'] = $userInfo['fname'].' '.$userInfo['mname'].' '.$userInfo['lname'];
				$data['photo'] = $userInfo['photo'];
			}

			$data['id'] = $id;
			//USER INFO - END

			$this->load->view('templates/header');
			$this->load->view('pages/teacher/concern', $data);
			$this->load->view('templates/footer');

		}else{
			redirect('/');
		}
	}

	################################################################################################################
	################################################################################################################

	public function postconcern($sessid){
		
		$sessid = str_replace("_47_", "/", str_replace("_50_", "=", $sessid));
		$decID = $this->encryption->decrypt($sessid);
		foreach($this->db->query("SELECT account_status FROM accounts WHERE id = $decID")->result_array() as $got){
			$got['account_status'];
		}

		$sessid = str_replace("/", "_47_", str_replace("=", "_50_", $sessid));
		
		if(!empty($this->session->userdata('teacher'.$decID)) && $got['account_status']=='Active'){
			date_default_timezone_set('Asia/Manila');

			$rec = htmlspecialchars(stripslashes(trim($_POST['rec'])));
			$concern = htmlspecialchars(stripslashes(trim($_POST['concern'])));
			$desc = htmlspecialchars(stripslashes(trim($_POST['desc'])));
			$date = date('Y-m-d H:i A');

			if($rec != $decID){

				$this->db->query("INSERT INTO concerns VALUES('', '$concern', '$desc', '$date', '$decID', '$rec', 'pending')");
				$this->session->set_flashdata('success', 'Posted successfully');
				header('Location:'.base_url().'Teacher/concerns/'.$sessid);

			}else{
				$this->session->set_flashdata('error', 'Error in posting!');
				header('Location:'.base_url().'Teacher/concerns/'.$sessid);
			}

		}else{
			redirect('/');
		}

	}

	################################################################################################################
	################################################################################################################

	public function concernssent($id){

		foreach ($this->db->query("SELECT sess_id FROM accounts WHERE id = '$id'")->result_array() as $info) {
			$sessid = $info['sess_id'];
		}
		$sessid = str_replace("/", "_47_", str_replace("=", "_50_", $sessid));

		$query = $this->db->query("SELECT * FROM concerns WHERE sender = '$id' ORDER BY date DESC");
			
		if($query->num_rows() != 0){
			foreach ($query->result_array() as $i) {

				if($i['receiver'] == 'Administrator'){
					$name = 'Administrator';
					$img = "<span class='fa fa-user-circle-o' style='font-size:4em;'></span>";

				}else{
					foreach ($this->db->query("SELECT * FROM teachers WHERE id = '".$i['receiver']."'")->result_array() as $info) {
						$name = $info['fname'].' '.$info['mname'].' '.$info['lname'];
						$id = $info['id'];

						if(empty($info['photo'])){
		 					$img = "<span class='fa fa-user-circle-o' style='font-size:4em;'></span>";
		 				}else{
		 					$img = '<img src="'.base_url().'ProfilePic/teachers/'.$info['photo'].'" style="max-width:4em;width:100%;max-height:4em" class="w3-circle">';
		 				}
					}

					foreach ($this->db->query("SELECT * FROM jhsstudents WHERE lrn = '".$i['receiver']."'")->result_array() as $info) {
						$name = $info['fname'].' '.$info['mname'].' '.$info['lname'];
						$id = $info['lrn'];

						if(empty($info['photo'])){
		 					$img = "<span class='fa fa-user-circle-o' style='font-size:4em;'></span>";
		 				}else{
		 					$img = '<img src="'.base_url().'ProfilePic/students/'.$info['photo'].'" style="max-width:4em;width:100%;max-height:4em" class="w3-circle">';
		 				}
					}

					foreach ($this->db->query("SELECT * FROM shsstudents WHERE lrn = '".$i['receiver']."'")->result_array() as $info) {
						$name = $info['fname'].' '.$info['mname'].' '.$info['lname'];
						$id = $info['lrn'];

						if(empty($info['photo'])){
		 					$img = "<span class='fa fa-user-circle-o' style='font-size:4em;'></span>";
		 				}else{
		 					$img = '<img src="'.base_url().'ProfilePic/students/'.$info['photo'].'" style="max-width:4em;width:100%;max-height:4em" class="w3-circle">';
		 				}
					}
				}

				//CANCEL BUTTON
				if($i['status'] == 'pending'){
					$rem = '<input type="submit" value="Cancel" name="button" class="w3-button w3-small w3-red w3-round w3-hover-pale-red">';
				}else{
					$rem = '';
				}
				//CANCEL BUTTON | END

				/*if($i['status'] == 'pending'){
					$stat = 'w3-red';
					$button = '<input type="submit" value="click here if resolved" name="button" class="w3-button w3-small w3-round w3-blue w3-hover-light-blue"> | <input type="submit" value="Decline" name="button" class="w3-button w3-small w3-round w3-red w3-hover-pale-red">';
					$border = 'w3-border-blue';
					$color = 'w3-pale-blue';
				}*/

				if($i['status'] == 'pending'){
					$stat = 'w3-red';
				}

				else if($i['status'] == 'declined'){
					$stat = 'w3-yellow';
				}

				else{
					$stat = 'w3-green';
				}

				echo '<div class="w3-row w3-border w3-padding w3-margin-bottom w3-margin-top w3-white">
						<div class="w3-col w3-margin-right" style="width:4em">';
							echo $img;
				echo '</div>
						<div class="w3-rest">
							<form action="'.base_url().'Teacher/viewedconcern/'.$sessid.'/'.$i['c_id'].'" method="post">
							<b>'.$name.'</b> | <span class="w3-badge w3-round w3-small '.$stat.'">'.$i['status'].'</span> '.$rem.'<br/>
							<b>'.$i['subject'].'</b>
							<p style="text-align: justify;">'.$i['description'].'</p>
							<small>'.date('M. j, Y - h:i A', strtotime($i['date'])).'</small>
							</form>
						</div>
					</div>';

			}
		}else{
			echo '<p class="w3-padding w3-pale-yellow w3-center">Empty</p>';
		}
		
	}

	################################################################################################################
	################################################################################################################

	public function concernspending($id){

		foreach ($this->db->query("SELECT sess_id FROM accounts WHERE id = '$id'")->result_array() as $info) {
			$sessid = $info['sess_id'];
		}
		$sessid = str_replace("/", "_47_", str_replace("=", "_50_", $sessid));

		$query = $this->db->query("SELECT * FROM concerns WHERE receiver = '$id' AND status = 'pending' ORDER BY date DESC");
			
		if($query->num_rows() != 0){
			foreach ($query->result_array() as $i) {

				if($i['sender'] == 'Administrator'){
					$name = 'Administrator';
					$img = "<span class='fa fa-user-circle-o' style='font-size:4em;'></span>";

				}else{
					foreach ($this->db->query("SELECT * FROM teachers WHERE id = '".$i['sender']."'")->result_array() as $info) {
						$name = $info['fname'].' '.$info['mname'].' '.$info['lname'];
						$id = $info['id'];

						if(empty($info['photo'])){
			 				$img = "<span class='fa fa-user-circle-o' style='font-size:4em;'></span>";
			 			}else{
			 				$img = '<img src="'.base_url().'ProfilePic/teachers/'.$info['photo'].'" style="max-width:4em;width:100%;max-height:4em" class="w3-circle">';
			 			}

					}
					foreach ($this->db->query("SELECT * FROM jhsstudents WHERE lrn = '".$i['sender']."'")->result_array() as $info) {
						$name = $info['fname'].' '.$info['mname'].' '.$info['lname'];
						$id = $info['lrn'];

						if(empty($info['photo'])){
			 				$img = "<span class='fa fa-user-circle-o' style='font-size:4em;'></span>";
			 			}else{
			 				$img = '<img src="'.base_url().'ProfilePic/students/'.$info['photo'].'" style="max-width:4em;width:100%;max-height:4em" class="w3-circle">';
			 			}
					}
					foreach ($this->db->query("SELECT * FROM shsstudents WHERE lrn = '".$i['sender']."'")->result_array() as $info) {
						$name = $info['fname'].' '.$info['mname'].' '.$info['lname'];
						$id = $info['lrn'];

						if(empty($info['photo'])){
			 				$img = "<span class='fa fa-user-circle-o' style='font-size:4em;'></span>";
			 			}else{
			 				$img = '<img src="'.base_url().'ProfilePic/students/'.$info['photo'].'" style="max-width:4em;width:100%;max-height:4em" class="w3-circle">';
			 			}
					}
				}
				

				$stat = 'w3-red';
				$button = '<input type="submit" value="click here if resolved" name="button" class="w3-button w3-small w3-round w3-blue w3-hover-light-blue"> | <input type="submit" value="Decline" name="button" class="w3-button w3-small w3-round w3-red w3-hover-pale-red">';
				

				echo '<div class="w3-row w3-border w3-padding w3-margin-bottom w3-margin-top w3-white">
						<div class="w3-col w3-margin-right" style="width:4em">';
							echo $img;
				echo '</div>
						<div class="w3-rest">
							<form action="'.base_url().'Teacher/viewedconcern/'.$sessid.'/'.$i['c_id'].'" method="post">
							<b>'.$name.'</b> | <span class="w3-badge w3-round w3-small '.$stat.'">'.$i['status'].'</span> '.$button.'<br/>
							<b>'.$i['subject'].'</b>
							<p style="text-align: justify;">'.$i['description'].'</p>
							<small>'.date('M. j, Y - h:i A', strtotime($i['date'])).'</small>
							</form>
						</div>
					</div>';

			}
		}else{
			echo '<p class="w3-padding w3-pale-yellow w3-center">Empty</p>';
		}
	}

	################################################################################################################
	################################################################################################################

	public function concernsdeclined($id){

		foreach ($this->db->query("SELECT sess_id FROM accounts WHERE id = '$id'")->result_array() as $info) {
			$sessid = $info['sess_id'];
		}
		$sessid = str_replace("/", "_47_", str_replace("=", "_50_", $sessid));

		$query = $this->db->query("SELECT * FROM concerns WHERE receiver = '$id' AND status = 'declined' ORDER BY date DESC");
			
		if($query->num_rows() != 0){
			foreach ($query->result_array() as $i) {

				if($i['sender'] == 'Administrator'){
					$name = 'Administrator';
					$img = "<span class='fa fa-user-circle-o' style='font-size:4em;'></span>";

				}else{
					foreach ($this->db->query("SELECT * FROM teachers WHERE id = '".$i['sender']."'")->result_array() as $info) {
						$name = $info['fname'].' '.$info['mname'].' '.$info['lname'];
						$id = $info['id'];

						if(empty($info['photo'])){
			 				$img = "<span class='fa fa-user-circle-o' style='font-size:4em;'></span>";
			 			}else{
			 				$img = '<img src="'.base_url().'ProfilePic/teachers/'.$info['photo'].'" style="max-width:4em;width:100%;max-height:4em" class="w3-circle">';
			 			}

					}
					foreach ($this->db->query("SELECT * FROM jhsstudents WHERE lrn = '".$i['sender']."'")->result_array() as $info) {
						$name = $info['fname'].' '.$info['mname'].' '.$info['lname'];
						$id = $info['lrn'];

						if(empty($info['photo'])){
			 				$img = "<span class='fa fa-user-circle-o' style='font-size:4em;'></span>";
			 			}else{
			 				$img = '<img src="'.base_url().'ProfilePic/students/'.$info['photo'].'" style="max-width:4em;width:100%;max-height:4em" class="w3-circle">';
			 			}
					}
					foreach ($this->db->query("SELECT * FROM shsstudents WHERE lrn = '".$i['sender']."'")->result_array() as $info) {
						$name = $info['fname'].' '.$info['mname'].' '.$info['lname'];
						$id = $info['lrn'];

						if(empty($info['photo'])){
			 				$img = "<span class='fa fa-user-circle-o' style='font-size:4em;'></span>";
			 			}else{
			 				$img = '<img src="'.base_url().'ProfilePic/students/'.$info['photo'].'" style="max-width:4em;width:100%;max-height:4em" class="w3-circle">';
			 			}
					}
				}
				

				echo '<div class="w3-row w3-border w3-padding w3-margin-bottom w3-margin-top w3-white">
						<div class="w3-col w3-margin-right" style="width:4em">';
							echo $img;
				echo '</div>
						<div class="w3-rest">
							<form action="'.base_url().'Teacher/viewedconcern/'.$sessid.'/'.$i['c_id'].'" method="post">
							<b>'.$name.'</b> | <span class="w3-badge w3-round w3-yellow w3-small">'.$i['status'].'</span><br/>
							<b>'.$i['subject'].'</b>
							<p style="text-align: justify;">'.$i['description'].'</p>
							<small>'.date('M. j, Y - h:i A', strtotime($i['date'])).'</small>
							</form>
						</div>
					</div>';

			}
		}else{
			echo '<p class="w3-padding w3-pale-yellow w3-center">Empty</p>';
		}
	}

	################################################################################################################
	################################################################################################################

	public function concernsresolved($id){

		foreach ($this->db->query("SELECT sess_id FROM accounts WHERE id = '$id'")->result_array() as $info) {
			$sessid = $info['sess_id'];
		}
		$sessid = str_replace("/", "_47_", str_replace("=", "_50_", $sessid));

		$query = $this->db->query("SELECT * FROM concerns WHERE receiver = '$id' AND status = 'resolved' ORDER BY date DESC");
			
		if($query->num_rows() != 0){
			foreach ($query->result_array() as $i) {

				if($i['sender'] == 'Administrator'){
					$name = 'Administrator';
					$img = "<span class='fa fa-user-circle-o' style='font-size:4em;'></span>";

				}else{
					foreach ($this->db->query("SELECT * FROM teachers WHERE id = '".$i['sender']."'")->result_array() as $info) {
						$name = $info['fname'].' '.$info['mname'].' '.$info['lname'];
						$id = $info['id'];

						if(empty($info['photo'])){
			 				$img = "<span class='fa fa-user-circle-o' style='font-size:4em;'></span>";
			 			}else{
			 				$img = '<img src="'.base_url().'ProfilePic/teachers/'.$info['photo'].'" style="max-width:4em;width:100%;max-height:4em" class="w3-circle">';
			 			}

					}
					foreach ($this->db->query("SELECT * FROM jhsstudents WHERE lrn = '".$i['sender']."'")->result_array() as $info) {
						$name = $info['fname'].' '.$info['mname'].' '.$info['lname'];
						$id = $info['lrn'];

						if(empty($info['photo'])){
			 				$img = "<span class='fa fa-user-circle-o' style='font-size:4em;'></span>";
			 			}else{
			 				$img = '<img src="'.base_url().'ProfilePic/students/'.$info['photo'].'" style="max-width:4em;width:100%;max-height:4em" class="w3-circle">';
			 			}
					}
					foreach ($this->db->query("SELECT * FROM shsstudents WHERE lrn = '".$i['sender']."'")->result_array() as $info) {
						$name = $info['fname'].' '.$info['mname'].' '.$info['lname'];
						$id = $info['lrn'];

						if(empty($info['photo'])){
			 				$img = "<span class='fa fa-user-circle-o' style='font-size:4em;'></span>";
			 			}else{
			 				$img = '<img src="'.base_url().'ProfilePic/students/'.$info['photo'].'" style="max-width:4em;width:100%;max-height:4em" class="w3-circle">';
			 			}
					}
				}
				

				echo '<div class="w3-row w3-border w3-padding w3-margin-bottom w3-margin-top w3-white">
						<div class="w3-col w3-margin-right" style="width:4em">';
							echo $img;
				echo '</div>
						<div class="w3-rest">
							<form action="'.base_url().'Teacher/viewedconcern/'.$sessid.'/'.$i['c_id'].'" method="post">
							<b>'.$name.'</b> | <span class="w3-badge w3-round w3-green w3-small">'.$i['status'].'</span><br/>
							<b>'.$i['subject'].'</b>
							<p style="text-align: justify;">'.$i['description'].'</p>
							<small>'.date('M. j, Y - h:i A', strtotime($i['date'])).'</small>
							</form>
						</div>
					</div>';

			}
		}else{
			echo '<p class="w3-padding w3-pale-yellow w3-center">Empty</p>';
		}
	}

	################################################################################################################
	################################################################################################################

	public function viewedconcern($sessid, $cid){
		$sessid = str_replace("_47_", "/", str_replace("_50_", "=", $sessid));
		$decID = $this->encryption->decrypt($sessid);
		foreach($this->db->query("SELECT account_status FROM accounts WHERE id = $decID")->result_array() as $got){
			$got['account_status'];
		}

		$sessid = str_replace("/", "_47_", str_replace("=", "_50_", $sessid));
		
		if(!empty($this->session->userdata('teacher'.$decID)) && $got['account_status']=='Active'){

			if(isset($_POST['button'])){
				if($_POST['button'] == 'Cancel'){
					$this->db->query("DELETE FROM concerns WHERE c_id = $cid");

					$this->session->set_flashdata('success', 'Concern has been cancelled.');
					header('Location:'.base_url().'Teacher/concerns/'.$sessid);
				
				}else if($_POST['button'] == 'click here if resolved'){
					$this->db->query("UPDATE concerns SET status = 'resolved' WHERE c_id = $cid");

					$this->session->set_flashdata('success', 'Concern has been resolved.');
					header('Location:'.base_url().'Teacher/concerns/'.$sessid);

				}else if($_POST['button'] == 'Decline'){
					$this->db->query("UPDATE concerns SET status = 'declined' WHERE c_id = $cid");

					$this->session->set_flashdata('success', 'Declined.');
					header('Location:'.base_url().'Teacher/concerns/'.$sessid);

				}else{
					$this->session->set_flashdata('error', 'Unexpected error.');
					header('Location:'.base_url().'Teacher/concerns/'.$sessid);
				}
			}

		}else{
			redirect('/');
		}

	}

	################################################################################################################
	################################################################################################################
	################################################################################################################
	################################################################################################################
	public function logout($id){
		
		$this->db->query("UPDATE accounts SET status = 'offline' WHERE id = '$id'");
		$this->session->unset_userdata('teacher'.$id);
		redirect('/');
	}
}
?>