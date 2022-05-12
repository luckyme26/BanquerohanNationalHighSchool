<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Student extends CI_Controller{
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
		foreach ($this->db->query("SELECT * FROM jhsstudents WHERE lrn = '$id'")->result_array() as $t) {
			$sect = $t['section'];
			$gr = $t['grade_level'];
			$subj = $t['subjects'];
		}
		foreach ($this->db->query("SELECT * FROM shsstudents WHERE lrn = '$id'")->result_array() as $t) {
			$sect = $t['section'];
			$gr = $t['grade_level'];
			$subj = $t['subjects'];
		}

		$subjects = explode(", ", $subj);

		for ($i=0; $i < count($subjects); $i++) { 
			if($this->db->query("SELECT * FROM logs WHERE id != '$id' AND role != 'student' AND made_for = '".$subjects[$i]."_".$gr."_".$sect."' AND viewed NOT LIKE '%$id%'")->num_rows() == 0){}

			else{
				echo $this->db->query("SELECT * FROM logs WHERE id != '$id' AND role != 'student' AND made_for = '".$subjects[$i]."_".$gr."_".$sect."' AND viewed NOT LIKE '%$id%'")->num_rows();
			}
		}
	}

	################################################################################################################
	################################################################################################################

	public function notifitems($id){
		date_default_timezone_set("Asia/Manila");

		foreach ($this->db->query("SELECT sess_id FROM accounts WHERE id = '$id'")->result_array() as $sess) {
			$sessid = $sess['sess_id'];
		}

		$sessid = str_replace("/", "_47_", str_replace("=", "_50_", $sessid));


		foreach ($this->db->query("SELECT * FROM jhsstudents WHERE lrn = '$id'")->result_array() as $t) {
			$sect = $t['section'];
			$gr = $t['grade_level'];
			$subj = $t['subjects'];
		}
		foreach ($this->db->query("SELECT * FROM shsstudents WHERE lrn = '$id'")->result_array() as $t) {
			$sect = $t['section'];
			$gr = $t['grade_level'];
			$subj = $t['subjects'];
		}

		$subjects = explode(", ", $subj);

		echo '<ul class="w3-ul">';

		for ($i=0; $i < count($subjects); $i++) { 
			if($this->db->query("SELECT * FROM logs WHERE id != '$id' AND role != 'student' AND made_for = '".$subjects[$i]."_".$gr."_".$sect."' AND viewed NOT LIKE '%$id%' ORDER BY date DESC")->num_rows() == 0){}

			else{
				foreach ($this->db->query("SELECT * FROM logs WHERE id != '$id' AND role != 'student' AND made_for = '".$subjects[$i]."_".$gr."_".$sect."' AND viewed NOT LIKE '%$id%' ORDER BY date DESC")->result_array() as $a) {
			
					/*foreach ($this->db->query("SELECT * FROM jhsstudents WHERE lrn = '".$a['id']."'")->result_array() as $b) {
						$log = $b['fname'].' '.$b['lname'];
					}
					foreach ($this->db->query("SELECT * FROM shsstudents WHERE lrn = '".$a['id']."'")->result_array() as $b) {
						$log = $b['fname'].' '.$b['lname'];
					}*/

					$dat = explode("_", $a['made_for']);
					echo '<li><a href="'.base_url().'Student/viewednotif/'.$sessid.'/'.$a['l_id'].'/'.$dat[0].'" class="w3-small">'.$a['description'].' | <small>('.date('M. j, Y h:i A', strtotime($a['date'])).') <br/> mark as read</small></a></li>';
				}
			}	
		}
		echo '</ul>';
	}

	################################################################################################################
	################################################################################################################

	public function announcements($id){
		date_default_timezone_set("Asia/Manila");

		foreach ($this->db->query("SELECT * FROM jhsstudents WHERE lrn = '$id'")->result_array() as $i) {
			$grade = $i['grade_level'];
		}
		foreach ($this->db->query("SELECT * FROM shsstudents WHERE lrn = '$id'")->result_array() as $i) {
			$grade = $i['grade_level'];
		}
		//start_date >= '".date("Y-m-01")."'
		$chk = $this->db->query("SELECT * FROM announcements WHERE end_date >= '".date("Y-m-d")."' AND (audience = 'All' OR audience LIKE '%".$grade."%') ORDER BY start_date ASC LIMIT 5");
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

	public function todo($id){
		date_default_timezone_set("Asia/Manila");

		foreach ($this->db->query("SELECT sess_id FROM accounts WHERE id = '$id'")->result_array() as $sess) {
			$sessid = $sess['sess_id'];
		}

		foreach ($this->db->query("SELECT * FROM jhsstudents WHERE lrn = '$id'")->result_array() as $t) {
			$sect = $t['section'];
			$gr = $t['grade_level'];
			$subj = $t['subjects'];
		}
		foreach ($this->db->query("SELECT * FROM shsstudents WHERE lrn = '$id'")->result_array() as $t) {
			$sect = $t['section'];
			$gr = $t['grade_level'];
			$subj = $t['subjects'];
		}

		$subjects = explode(", ", $subj);

		echo '<div class="w3-container w3-border w3-margin-bottom">';
			echo '<p><b>ACTIVITIES</b></p>';

			echo '<ul class="w3-ul w3-margin-left">';

			for ($i=0; $i < count($subjects); $i++) {

				foreach ($this->db->query("SELECT * FROM subjects WHERE subj_code = ".$subjects[$i]."")->result_array() as $a) {
					$actsubjtitle = $a['subj_title'];
				}
				echo '<p><b>'.$actsubjtitle.'</b></p>';
				$zz = $this->db->query("SELECT * FROM activities WHERE subj_code = ".$subjects[$i]." AND grade_level = '$gr' AND section = '$sect' ORDER BY subj_code ASC");

				if($zz->num_rows() == 0){
					echo '<div class="w3-container w3-padding w3-pale-yellow w3-margin-bottom w3-center w3-small">No activities posted.</div>';

				}else{
					foreach ($zz->result_array() as $ac) {
						
						$checkact = $this->db->query("SELECT * FROM activities_submit WHERE subj_code = ".$subjects[$i]." AND lesson_title = '".$ac['lesson_title']."' AND grade_level = '$gr' AND section = '$sect' AND lrn = '$id' ORDER BY subj_code ASC");


						if($checkact->num_rows() == 0){ //IF HINDI NAGSUBMIT
							if(date('Y-m-d H:i A', strtotime($ac['due_date'])) < date('Y-m-d H:i A')){
								$actstat = '<span class="w3-tag w3-red w3-round">Terminated</span>';
								
							}else{
								$actstat = '<span class="w3-tag w3-green w3-round">Ongoing</span>';
								
							}
							$actsub = '<span class="w3-tag w3-red w3-round">Not submitted</span>';
							$cont = '';

						}else{
							foreach ($checkact->result_array() as $submitted) {

								if(date('Y-m-d H:i A', strtotime($ac['due_date'])) < date('Y-m-d H:i A')){
									$actstat = '<span class="w3-tag w3-red w3-round">Terminated</span>';

								}else{
									$actstat = '<span class="w3-tag w3-green w3-round">Ongoing</span>';
								}

								if($ac['activity_title'] == $submitted['activity_title']){
									$actsub = '<span class="w3-tag w3-green w3-round">Submitted</span>';
								
								}else{
									$actsub = '<span class="w3-tag w3-red w3-round">Not submitted</span>';
								}
								//$file = $submitted['file_submitted'];
								//$grade = $submitted['grade'];
								//$datesubmit = date('Y-m-d H:i A', strtotime($submitted['date_submitted']));
							}
							
							//$cont = $file.' | '.$datesubmit.' | '.$grade;

						}

						echo '<p class="w3-margin-left"><a href="'.base_url().'Student/viewactivity/'.$sessid.'/'.$actsubjtitle.'/'.$gr.'/'.$sect.'/'.$ac['activity_title'].'/'.$subjects[$i].'/'.$ac['lesson_title'].'">'.str_replace("_", ",", $ac['activity_title']).'</a> '.$actstat.' '.$actsub.'<br/><small>'
						.date('M. j, Y h:i A', strtotime($ac['due_date'])).'</small><br/></p>';
					}
				}
			}
			echo '</ul>';
		echo '</div>';



		echo '<div class="w3-container w3-border w3-margin-bottom">';
			echo '<p><b>EXAMS/QUIZZES</b></p>';
			echo '<ul class="w3-ul w3-margin-left">';

			for ($j=0; $j < count($subjects); $j++) {

				foreach ($this->db->query("SELECT * FROM subjects WHERE subj_code = ".$subjects[$j]."")->result_array() as $a) {
					$subj = $a['subj_title'];
				}
				echo '<p><b>'.$subj.'</b></p>';

				$aa = $this->db->query("SELECT * FROM quiz WHERE subj_code = ".$subjects[$j]." AND grade_level = '$gr' AND section = '$sect' ORDER BY quiz_title ASC");

				if($aa->num_rows() == 0){
					echo '<div class="w3-container w3-padding w3-pale-yellow w3-margin-bottom w3-center w3-small">No quiz/exam posted.</div>';

				}else{

					foreach ($aa->result_array() as $q) {
						
						$checkquiz = $this->db->query("SELECT * FROM quiz_submit WHERE subj_code = ".$subjects[$j]." AND grade_level = '$gr' AND quiz_title = '".$q['quiz_title']."' AND lesson_title = '".$q['lesson_title']."' AND section = '$sect' AND lrn = '$id' ORDER BY quiz_title ASC");

						if($checkquiz->num_rows() == 0){
							if(date('Y-m-d H:i A', strtotime($q['deadline'])) < date('Y-m-d H:i A')){
								$quizstat = '<span class="w3-tag w3-red w3-round">Terminated</span>';
								
							}else{
								$quizstat = '<span class="w3-tag w3-green w3-round">Ongoing</span>';

							}
							$quizsub = '<span class="w3-tag w3-red w3-round">Not submitted</span>';
							$cont = '';

						}else{
							foreach ($checkquiz->result_array() as $submitted) {
								if(date('Y-m-d H:i A', strtotime($q['deadline'])) < date('Y-m-d H:i A')){
									$quizstat = '<span class="w3-tag w3-red w3-round">Terminated</span>';

								}else{
									$quizstat = '<span class="w3-tag w3-green w3-round">Ongoing</span>';
								}

								if($q['quiz_title'] == $submitted['quiz_title']){
									//$grade = $submitted['score'];
									//$datesubmit = date('M. j, Y h:i A', strtotime($submitted['date_submitted']));
									$quizsub = '<span class="w3-tag w3-green w3-round">Submitted</span>';
									//$cont = '<small><b>Submitted last: '.$datesubmit.'</b> | <b>SCORE: '.$grade.'</b></small>';
								
								}else{
									//$grade = '';
									//$datesubmit = '';
									$quizsub = '<span class="w3-tag w3-red w3-round">Not submitted</span>';
									//$cont = '';
								}
								
							}

						}
						
						echo '<p class="w3-margin-left"><a href="'.base_url().'Student/viewquiz/'.$sessid.'/'.$subj.'/'.$gr.'/'.$sect.'/'.$q['quiz_title'].'/'.$subjects[$j].'/'.$q['lesson_title'].'">'.str_replace("_", ",", $q['quiz_title']).'</a> '.$quizstat.' '.$quizsub.'<br/><small>'
						.date('M. j, Y h:i A', strtotime($q['deadline'])).'</small></p>';
					}
				}
					
			}

			echo '</ul>';
		echo '</div>';
	}

	################################################################################################################
	################################################################################################################

	public function viewednotif($sessid, $n_id, $subjcode){
		$id = str_replace("_47_", "/", str_replace("_50_", "=", $sessid));
		$decID = $this->encryption->decrypt($id);
		foreach ($this->db->query("SELECT * FROM logs WHERE l_id = $n_id")->result_array() as $a) {

			if(empty($a['viewed'])){
				$this->db->query("UPDATE logs SET viewed = '$decID' WHERE l_id = $n_id");
				header('Location:'.base_url().'Student/subjects/'.$subjcode.'/'.$sessid);

			}else{
				$viewers = array($a['viewed'], $decID);
				$newviewers = implode(', ', $viewers);

				$this->db->query("UPDATE logs SET viewed = '$newviewers' WHERE l_id = $n_id");
				header('Location:'.base_url().'Student/subjects/'.$subjcode.'/'.$sessid);
			}
		}
	}

	################################################################################################################
	################################################################################################################
	################################################################################################################
	################################################################################################################
	//STUDENT DASHBOARD
	public function dashboard($sessid){
		$id = str_replace("_47_", "/", str_replace("_50_", "=", $sessid));
		$decID = $this->encryption->decrypt($id);
		foreach($this->db->query("SELECT account_status FROM accounts WHERE id = $decID")->result_array() as $got){
			$got['account_status'];
		}

		$sessid = str_replace("/", "_47_", str_replace("=", "_50_", $id));
		
		if(!empty($this->session->userdata('student'.$decID)) && $got['account_status']=='Active'){
			$this->load->model('Student_model');

			$data['title'] = 'Dashboard';
			$data['link'] = $sessid;

			//user info
			extract($this->session->userdata('student'.$decID));
			if($role == 'JHSstudent'){
				$getInfo = $this->db->query("SELECT * FROM jhsstudents WHERE lrn = '$id'");
			}else{
				$getInfo = $this->db->query("SELECT * FROM shsstudents WHERE lrn = '$id'");
			}
			
			foreach ($getInfo->result_array() as $userInfo) {
				$data['name'] = $userInfo['fname'].' '.$userInfo['mname'].' '.$userInfo['lname'];
				$data['gradelvl'] = $userInfo['grade_level'];
				$data['section'] = $userInfo['section'];
				$data['photo'] = $userInfo['photo'];
			}
			$data['id'] = $id;
			//user info

			$this->load->library('calendar');
			$prefs = array(
						'show_next_prev'  => TRUE,
        				'next_prev_url'   => base_url().'student/dashboard/'.$sessid
				);
			
			$this->calendar->initialize($prefs);

			$this->load->view('templates/header');
			$this->load->view('pages/student/dashboard', $data);
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

		if(!empty($this->session->userdata('student'.$decID)) && $got['account_status']=='Active'){
			$this->load->model('Student_model');


			$data['title'] = 'Profile';
			$data['link'] = $sessid;

			//user info
			extract($this->session->userdata('student'.$decID));
			if($role == 'JHSstudent'){
				$getInfo = $this->db->query("SELECT * FROM jhsstudents WHERE lrn = '$decID'");
			}else{
				$getInfo = $this->db->query("SELECT * FROM shsstudents WHERE lrn = '$decID'");
			}
			
			foreach ($getInfo->result_array() as $userInfo) {
				$data['name'] = $userInfo['fname'].' '.$userInfo['mname'].' '.$userInfo['lname'];
				$data['gradelvl'] = $userInfo['grade_level'];
				$data['section'] = $userInfo['section'];
				$data['photo'] = $userInfo['photo'];
				$data['sex'] = $userInfo['sex'];
				$data['email'] = $userInfo['email'];
				$data['bday'] = $userInfo['Birthdate'];
				$data['contact'] = $userInfo['contact'];
				$data['address'] = $userInfo['address'];
				$data['subjects'] = $userInfo['subjects'];

			}
			$data['lrn'] = $decID;
			//user info

			$this->load->view('templates/header');
			$this->load->view('pages/student/profile', $data);
			$this->load->view('templates/footer');

		}else{
			redirect('/');
		}
	}

	################################################################################################################
	################################################################################################################

	public function UploadPic($id, $sessid, $grlvl){
		$sessid = str_replace("_47_", "/", str_replace("_50_", "=", $sessid));
		$decID = $this->encryption->decrypt($sessid);
		foreach($this->db->query("SELECT account_status FROM accounts WHERE id = $decID")->result_array() as $got){
			$got['account_status'];
		}

		$sessid = str_replace("/", "_47_", str_replace("=", "_50_", $sessid));

		if(!empty($this->session->userdata('student'.$decID)) && $got['account_status']=='Active'){
			$this->load->model('Student_model');

			$dir = 'ProfilePic/students/';
			if(!is_dir($dir)){
				mkdir($dir);
			}

			$tmpname = $_FILES['pic']['tmp_name'];
			$pic = $_FILES['pic']['name'];
			$imgtype = $_FILES['pic']['type'];
			$gr = str_replace("%20", " ", $grlvl);

			if($imgtype == "image/jpeg" || $imgtype == "image/jpg" || $imgtype == "image/png"){
				$expname = explode(".", $pic);
                $newpic = time().rand(1,99999).".".end($expname);

                if($gr == 'Grade 11' || $gr == 'Grade 12'){
                	$query = $this->db->query("SELECT * FROM shsstudents WHERE lrn = '$id'");
                }else{
                	$query = $this->db->query("SELECT * FROM jhsstudents WHERE lrn = '$id'");
                }

                foreach ($query->result_array() as $got) {
					$got['photo'];
				}
				if($got['photo'] != ''){
					unlink($dir.$got['photo']); //FILE DELETION
				}


                if(move_uploaded_file($tmpname, $dir.$newpic)){
                	if($gr == 'Grade 11' || $gr == 'Grade 12'){
	                	$this->db->query("UPDATE shsstudents SET photo = '$newpic' WHERE lrn = '$id'");
	                }else{
	                	$this->db->query("UPDATE jhsstudents SET photo = '$newpic' WHERE lrn = '$id'");
	                }
                	$this->session->set_flashdata('success', 'Photo uploaded');
					header('Location:'.base_url().'Student/profile/'.$sessid);
                }else{
                	$this->session->set_flashdata('error', 'Error in uploading photo.');
					header('Location:'.base_url().'Student/profile/'.$sessid);
                }
			}else{
				$this->session->set_flashdata('error', 'Invalid File!');
				header('Location:'.base_url().'Student/profile/'.$sessid);
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

		if(!empty($this->session->userdata('student'.$decID)) && $got['account_status']=='Active'){
			$this->load->model('Teachers_model');
			$this->load->library('email');

			$email = htmlspecialchars(stripslashes(trim($_POST['email'])));

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

				$this->db->query("INSERT INTO logs VALUES('', 'updated email', 'admin', '".date('Y-m-d H:i:s')."', '$id', 'student', '')");

				header('Location:'.base_url().'Student/profile/'.$sessid);
			}else{
				$this->session->set_flashdata('error', 'Unexpected error while updating your email.');
				header('Location:'.base_url().'Student/profile/'.$sessid);
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

		if(!empty($this->session->userdata('student'.$decID)) && $got['account_status']=='Active'){

			$password = htmlspecialchars(stripslashes(trim($_POST['password'])));
			$id = htmlspecialchars(stripslashes(trim($_POST['id'])));
			if($this->db->query("SELECT * FROM accounts WHERE id = '$decID' AND password = '$password'")->num_rows() == 1){
				$this->session->set_flashdata('confirmed', 'Account confirmed!');
				header('Location:'.base_url().'Student/changepassword/'.$sessid);
			}else{
				header('Location:'.base_url().'Student/profile/'.$sessid);
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

		if(!empty($this->session->userdata('student'.$decID)) && $got['account_status']=='Active'){

			$data['title'] = 'Change password';

			$this->load->model('Student_model');


			//USER INFO
			extract($this->session->userdata('student'.$decID));
			if($role == 'JHSstudent'){
				$getInfo = $this->db->query("SELECT * FROM jhsstudents WHERE lrn = '$decID'");
			}else{
				$getInfo = $this->db->query("SELECT * FROM shsstudents WHERE lrn = '$decID'");
			}

			foreach ($getInfo->result_array() as $userInfo) {
				$data['id'] = $decID;
				$data['gradelvl'] = $userInfo['grade_level'];
				$data['section'] = $userInfo['section'];
				$data['fname'] = $userInfo['fname'];
				$data['mname'] = $userInfo['mname'];
				$data['lname'] = $userInfo['lname'];
				$data['photo'] = $userInfo['photo'];
			}
			$data['name'] = $userInfo['fname'].' '.$userInfo['mname'].' '.$userInfo['lname'];
			$data['link'] = $sessid;
			//$data['id'] = $decID;
			//USER INFO - END
			
			
			$this->load->view('templates/header');
			$this->load->view('pages/student/changepassword', $data);
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

		if(!empty($this->session->userdata('student'.$decID)) && $got['account_status']=='Active'){

			$idnum = $decID;
			$pass = $_POST['password'];
			date_default_timezone_set('Asia/Manila');

			$this->db->query("UPDATE accounts SET password = '$pass' WHERE id = '$idnum'");

			$this->db->query("INSERT INTO logs VALUES('', 'changes password', 'admin', '".date('Y-m-d H:i:s')."', '$decID', 'student', '')");

			header('Location:'.base_url().'Student/logout/'.$decID);
			
		}else{
			redirect('/');
		}

	}

	################################################################################################################
	################################################################################################################

	public function updateprofile($sessid){
		$sessid = str_replace("_47_", "/", str_replace("_50_", "=", $sessid));
		$decID = $this->encryption->decrypt($sessid);
		foreach($this->db->query("SELECT account_status FROM accounts WHERE id = $decID")->result_array() as $got){
			$got['account_status'];
		}

		$sessid = str_replace("/", "_47_", str_replace("=", "_50_", $sessid));

		if(!empty($this->session->userdata('student'.$decID)) && $got['account_status']=='Active'){

			$address = htmlspecialchars(stripslashes(trim($_POST['address'])));
			$cp = htmlspecialchars(stripslashes(trim($_POST['cp'])));
			$bday = htmlspecialchars(stripslashes(trim($_POST['bday'])));

			if($this->db->query("SELECT * FROM jhsstudents WHERE lrn = '$decID'")->num_rows() == 1){
				$this->db->query("UPDATE jhsstudents SET address = '$address', contact = '$cp', Birthdate = '$bday' WHERE lrn = '$decID'");

			}else{
				$this->db->query("UPDATE shsstudents SET address = '$address', contact = '$cp', Birthdate = '$bday' WHERE lrn = '$decID'");
			}

			$this->db->query("INSERT INTO logs VALUES('', 'updates profile', 'admin', '".date('Y-m-d H:i:s')."', '$decID', 'student', '')");

			$this->session->set_flashdata('success', 'Your profile has been updated.');
			header('Location:'.base_url().'Student/profile/'.$sessid);

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

		if(!empty($this->session->userdata('student'.$decID)) && $got['account_status']=='Active'){
			$this->load->model('Student_model');

			$data['link'] = $sessid;

			//USER INFO
			extract($this->session->userdata('student'.$decID));
			if($role == 'JHSstudent'){
				$getInfo = $this->db->query("SELECT * FROM jhsstudents WHERE lrn = '$decID'");
			}else{
				$getInfo = $this->db->query("SELECT * FROM shsstudents WHERE lrn = '$decID'");
			}

			foreach ($getInfo->result_array() as $userInfo) {
				$data['name'] = $userInfo['fname'].' '.$userInfo['mname'].' '.$userInfo['lname'];
				$data['gradelvl'] = $userInfo['grade_level'];
				$data['section'] = $userInfo['section'];
				$data['photo'] = $userInfo['photo'];
				$data['subj'] = $userInfo['subjects'];
			}

			$data['id'] = $decID;
			//USER INFO - END

			$data['title'] = $userInfo['section'];

			/*foreach ($this->db->query("SELECT * FROM sections WHERE adviser = '$id'")->result_array() as $advcla) {
				$data['advgr'] = $advcla['gr_level'];
				$data['advsect'] = $advcla['sect_name'];
			}*/

			$this->load->view('templates/header');
			$this->load->view('pages/student/advisory', $data);
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
	//SUBJECTS
	public function subjects($subj, $sessid){
		$sessid = str_replace("_47_", "/", str_replace("_50_", "=", $sessid));
		$decID = $this->encryption->decrypt($sessid);
		foreach($this->db->query("SELECT account_status FROM accounts WHERE id = $decID")->result_array() as $got){
			$got['account_status'];
		}

		$sessid = str_replace("/", "_47_", str_replace("=", "_50_", $sessid));

		if(!empty($this->session->userdata('student'.$decID)) && $got['account_status']=='Active'){

			switch ($subj) {
				case 'overview':
					
					$this->load->model('Student_model');

					$data['title'] = 'Subjects';
					$data['link'] = $sessid;

					//USER INFO
					extract($this->session->userdata('student'.$decID));
					if($role == 'JHSstudent'){
						$getInfo = $this->db->query("SELECT * FROM jhsstudents WHERE lrn = '$decID'");
					}else{
						$getInfo = $this->db->query("SELECT * FROM shsstudents WHERE lrn = '$decID'");
					}

					foreach ($getInfo->result_array() as $userInfo) {
						$data['name'] = $userInfo['fname'].' '.$userInfo['mname'].' '.$userInfo['lname'];
						$data['gradelvl'] = $userInfo['grade_level'];
						$data['section'] = $userInfo['section'];
						$data['photo'] = $userInfo['photo'];
						$data['subj'] = $userInfo['subjects'];
					}

					$data['id'] = $decID;
					//USER INFO - END

					$this->load->view('templates/header');
					$this->load->view('pages/student/subjects', $data);
					$this->load->view('templates/footer');

					break;
				
				default:
					$this->load->model('Student_model');

					$id = $this->encryption->decrypt($sessid);
					$subject = $this->db->query("SELECT * FROM subject_students WHERE subj_code = $subj AND students LIKE '%$id%'");
					foreach ($subject->result_array() as $s) {
						foreach ($this->db->query("SELECT * FROM subjects WHERE subj_code = '".$s['subj_code']."'")->result_array() as $sinfo) {

							$data['title'] = $sinfo['subj_title'];
							$data['desc'] = $sinfo['subj_desc'];
							$data['code'] = $subj;
						}

					}

					$data['link'] = $sessid;

					//USER INFO
					extract($this->session->userdata('student'.$decID));
					if($role == 'JHSstudent'){
						$getInfo = $this->db->query("SELECT * FROM jhsstudents WHERE lrn = '$id'");
					}else{
						$getInfo = $this->db->query("SELECT * FROM shsstudents WHERE lrn = '$id'");
					}
					foreach ($getInfo->result_array() as $userInfo) {
						$data['name'] = $userInfo['fname'].' '.$userInfo['mname'].' '.$userInfo['lname'];
						$data['gradelvl'] = $userInfo['grade_level'];
						$data['section'] = $userInfo['section'];
						$data['photo'] = $userInfo['photo'];
						$data['subj'] = $userInfo['subjects'];
					}

					$data['id'] = $id;
					//USER INFO - END
					
					$this->load->view('templates/header');
					$this->load->view('pages/student/viewsubject', $data);
					$this->load->view('templates/footer');

					break;
			}

			
		}else{
			redirect('/');
		}
	}

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
		if(!empty($this->session->userdata('student'.$decID)) && $got['account_status']=='Active'){
			
			$this->load->helper('download');

			$mod = str_replace(":", "-", str_replace("%20", "-", $module));

			$dir = str_replace("%20", " ", $subj).'_'.str_replace("%20", " ", $gr).'_'.str_replace("%20", " ", $sect).'/'.str_replace(":", "-", str_replace("%20", " ", $lesson)).'/';
			
			$file = $mod;
			$data = file_get_contents($dir.$mod);
			force_download($mod, $data);

			//force_download(''.$dir.$mod.'', NULL);
			
			header('Location:'.base_url().'Student/subjects/'.$code.'/'.$sessid);

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
		
		if(!empty($this->session->userdata('student'.$decID)) && $got['account_status']=='Active'){

			$this->load->model('Student_model');
			$data['title'] = str_replace("%20", " ", $act);
			$data['lesson'] = str_replace("%20", " ", $lesson);
			$data['subj_code'] = $code;
			$data['link'] = str_replace("/", "_47_", str_replace("=", "_50_", $sessid));
			$data['subj'] = str_replace("%20", " ", $subj);
			$data['grade'] = str_replace("%20", " ", $gr);
			$data['section'] = str_replace("%20", " ", $sect);

			//USER INFO
			extract($this->session->userdata('student'.$decID));
				
			if($role == 'JHSstudent'){
				$getInfo = $this->db->query("SELECT * FROM jhsstudents WHERE lrn = '$id'");
			}else{
				$getInfo = $this->db->query("SELECT * FROM shsstudents WHERE lrn = '$id'");
			}
			foreach ($getInfo->result_array() as $userInfo) {
				$data['name'] = $userInfo['fname'].' '.$userInfo['mname'].' '.$userInfo['lname'];
				$data['gradelvl'] = $userInfo['grade_level'];
				$data['section'] = $userInfo['section'];	
				$data['photo'] = $userInfo['photo'];
			}

			$data['id'] = $id;
			//USER INFO - END

			$this->load->view('templates/header');
			$this->load->view('pages/student/viewactivity', $data);
			$this->load->view('templates/footer');

		}else{
			redirect('/');
		}
	}

	################################################################################################################
	################################################################################################################

	public function viewquiz($sessid, $subj, $gr, $sect, $quiz, $code, $lesson){
		$sessid = str_replace("_47_", "/", str_replace("_50_", "=", $sessid));
		$decID = $this->encryption->decrypt($sessid);
		foreach($this->db->query("SELECT account_status FROM accounts WHERE id = $decID")->result_array() as $got){
			$got['account_status'];
		}
		
		if(!empty($this->session->userdata('student'.$decID)) && $got['account_status']=='Active'){

			$this->load->model('Student_model');
			$data['title'] = str_replace("%20", " ", $quiz);
			$data['lesson'] = str_replace("%20", " ", $lesson);
			$data['subj_code'] = $code;
			$data['link'] = str_replace("/", "_47_", str_replace("=", "_50_", $sessid));
			$data['subj'] = str_replace("%20", " ", $subj);
			$data['grade'] = str_replace("%20", " ", $gr);
			$data['section'] = str_replace("%20", " ", $sect);

			//USER INFO
			extract($this->session->userdata('student'.$decID));

			if($role == 'JHSstudent'){
				$getInfo = $this->db->query("SELECT * FROM jhsstudents WHERE lrn = '$id'");
			}else{
				$getInfo = $this->db->query("SELECT * FROM shsstudents WHERE lrn = '$id'");
			}
			foreach ($getInfo->result_array() as $userInfo) {
				$data['name'] = $userInfo['fname'].' '.$userInfo['mname'].' '.$userInfo['lname'];
				$data['photo'] = $userInfo['photo'];
			}

			$data['id'] = $id;
			//USER INFO - END

			$this->load->view('templates/header');
			$this->load->view('pages/student/viewquiz', $data);
			$this->load->view('templates/footer');

		}else{
			redirect('/');
		}
	}

	################################################################################################################
	################################################################################################################

	public function takeexam($sessid){
		$sessid = str_replace("_47_", "/", str_replace("_50_", "=", $sessid));
		$decID = $this->encryption->decrypt($sessid);
		foreach($this->db->query("SELECT account_status FROM accounts WHERE id = $decID")->result_array() as $got){
			$got['account_status'];
		}

		$sessid = str_replace("/", "_47_", str_replace("=", "_50_", $sessid));

		if(!empty($this->session->userdata('student'.$decID)) && $got['account_status']=='Active'){
			date_default_timezone_set('Asia/Manila');

			$code = $_POST['subjcode'];
			$subj = $_POST['subj'];
			$lesson = $_POST['lesson'];
			$gr = $_POST['gr'];
			$sect = $_POST['sect'];
			$quiz = $_POST['quiz'];

			foreach ($this->db->query("SELECT * FROM quiz WHERE subj_code = $code AND lesson_title = '$lesson' AND grade_level = '$gr' AND section = '$sect' AND quiz_title = '$quiz'")->result_array() as $gotquiz) {
				$data['duration'] = $gotquiz['duration'];
				$data['types'] = $gotquiz['typeofexam'];
				$data['content'] = $gotquiz['content'];
				$attempt = $gotquiz['attempt'];
			}

			$query = $this->db->query("SELECT * FROM quiz_submit WHERE subj_code = $code AND lesson_title = '$lesson' AND grade_level = '$gr' AND section = '$sect' AND quiz_title = '$quiz' AND lrn = '$decID'");
			
			/*if($query->num_rows() > 1){
				$this->db->query("DELETE FROM quiz_submit WHERE subj_code = $code AND lesson_title = '$lesson' AND grade_level = '$gr' AND section = '$sect' AND quiz_title = '$quiz' AND lrn = '$decID'");

			}*/

				foreach ($query->result_array() as $a) {
					$current_attempt = $a['attempt'];
				}

				if(empty($current_attempt)){
					$current_attempt = 0;
				}

				/*if(empty($current_attempt)){
					$this->db->query("INSERT INTO quiz_submit VALUES($code, '$lesson', '$gr', '$sect', '$quiz', 1, '', '', '', '$decID')");
					$this->load->model('Student_model');
						$data['title'] = $quiz;
						$data['lesson'] = $lesson;
						$data['subj_code'] = $code;
						$data['link'] = $sessid;
						$data['subj'] = $subj;
						$data['grade'] = $gr;
						$data['section'] = $sect;

						//USER INFO
						extract($this->session->userdata($decID));

						if($role == 'JHSstudent'){
							$getInfo = $this->db->query("SELECT * FROM jhsstudents WHERE lrn = '$id'");
						}else{
							$getInfo = $this->db->query("SELECT * FROM shsstudents WHERE lrn = '$id'");
						}
						foreach ($getInfo->result_array() as $userInfo) {
							$data['name'] = $userInfo['fname'].' '.$userInfo['mname'].' '.$userInfo['lname'];
							$data['photo'] = $userInfo['photo'];
						}

						$data['id'] = $id;
						//USER INFO - END

						$this->load->view('templates/header');
						$this->load->view('pages/student/takeexam', $data);
						$this->load->view('templates/footer');
				}else{*/
					$res = $attempt - $current_attempt;
					if($res == 0){
						header('Location:'.base_url().'student/viewquiz/'.$sessid.'/'.$subj.'/'.$gr.'/'.$sect.'/'.$quiz.'/'.$code.'/'.$lesson);
					}else{
						$this->db->query("INSERT INTO quiz_submit VALUES($code, '$lesson', '$gr', '$sect', '$quiz', $current_attempt+1, '".date("Y-m-d H:i:s")."', '', '', '', '$decID')");
						//$this->db->query("UPDATE quiz_submit SET attempt = ".$current_attempt."+1 WHERE subj_code = $code AND lesson_title = '$lesson' AND grade_level = '$gr' AND section = '$sect' AND quiz_title = '$quiz' AND lrn = '$decID'");
						$this->load->model('Student_model');
						$data['title'] = $quiz;
						$data['lesson'] = $lesson;
						$data['subj_code'] = $code;
						$data['link'] = $sessid;
						$data['subj'] = $subj;
						$data['grade'] = $gr;
						$data['section'] = $sect;

						//USER INFO
						extract($this->session->userdata('student'.$decID));

						if($role == 'JHSstudent'){
							$getInfo = $this->db->query("SELECT * FROM jhsstudents WHERE lrn = '$id'");
						}else{
							$getInfo = $this->db->query("SELECT * FROM shsstudents WHERE lrn = '$id'");
						}
						foreach ($getInfo->result_array() as $userInfo) {
							$data['name'] = $userInfo['fname'].' '.$userInfo['mname'].' '.$userInfo['lname'];
							$data['photo'] = $userInfo['photo'];
						}

						$data['id'] = $id;
						//USER INFO - END

						$this->load->view('templates/header');
						$this->load->view('pages/student/takeexam', $data);
						$this->load->view('templates/footer');
					}
				//}
			


		}else{
			redirect('/');
		}
	}

	################################################################################################################
	################################################################################################################

	public function submitexam($sessid, $subj, $code, $lesson, $gr, $sect, $quiz){
		$sessid = str_replace("_47_", "/", str_replace("_50_", "=", $sessid));
		$decID = $this->encryption->decrypt($sessid);
		foreach($this->db->query("SELECT account_status FROM accounts WHERE id = $decID")->result_array() as $got){
			$got['account_status'];
		}

		$sessid = str_replace("/", "_47_", str_replace("=", "_50_", $sessid));

		if(!empty($this->session->userdata('student'.$decID)) && $got['account_status']=='Active'){
			
			date_default_timezone_set("Asia/Manila");
			$lesson = str_replace("%20", " ", $lesson);
			$subj = str_replace("%20", " ", $subj);
			$gr = str_replace("%20", " ", $gr);
			$sect = str_replace("%20", " ", $sect);
			$quiz = str_replace("%20", " ", $quiz);

			if(isset($_POST['multanswer'])){
				$multanswer = $_POST['multanswer'];
			}else{
				$multanswer = null;
			}

			if(isset($_POST['enumanswer'])){
				$enumanswer = $_POST['enumanswer'];
			}else{
				$enumanswer = null;
			}

			if(isset($_POST['identansw'])){
				$identansw = $_POST['identansw'];
			}else{
				$identansw = null;
			}

			if(isset($_POST['matchans'])){
				$matchans = $_POST['matchans'];
			}else{
				$matchans = null;
			}

			if(isset($_POST['truefalse'])){
				$truefalse = $_POST['truefalse'];
			}else{
				$truefalse = null;
			}


			foreach ($this->db->query("SELECT * FROM quiz WHERE subj_code = $code AND lesson_title = '$lesson' AND grade_level = '$gr' AND section = '$sect' AND quiz_title = '$quiz'")->result_array() as $q) {
				$types = $q['typeofexam'];
				$content = $q['content'];
			}

			$types = explode(", ", $types);
			$cont = explode(" + ", $content);
			$score = 0;
			$tot = 0;
			$itemanalysis[] = '';

            for ($a=0; $a < count($cont); $a++) { 
				$part[$a] = explode(" => ", $cont[$a]);
            }

            for($a = 0; $a < count($types); $a++){
                $types[$a] = str_replace("{", "", str_replace("}", "", str_replace("%20", " ", $types[$a])));
		
				 switch($types[$a]){
					
					case 'multiplechoice':            
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
									$tot++;
								}
							}

							if($contdata[$b]['correct'] == $multanswer[$b]){
								$score++;
								$ansmult[$b] = '[ '.$contdata[$b]['question'].' = correct ]';
							}else{
								$ansmult[$b] = '[ '.$contdata[$b]['question'].' = incorrect ]';
							}
						}
						$types[$a] = '{'.$types[$a].'}';
						$new = array($types[$a], implode(", ", $ansmult));
						$itemanalysis[$a] = implode(" => ", $new);

					break;


					case 'enumeration':
						$contpart = explode(", ", str_replace("[", "", str_replace("]", "", $part[$a][1])));
						$contdata['instruction'] = $contpart[0];
						for ($b=1; $b < count($contpart); $b++) { 
							$contdata[$b] = explode(" = ", $contpart[$b]);

							$contdata[$b]['question'] = $contdata[$b][0];
							unset($contdata[$b][0]);
							$contdata[$b]['correct'] = str_replace(" _ ", ", ", $contdata[$b][1]);
							$total = explode(",", $contdata[$b]['correct']);
							unset($contdata[$b][1]);
							$tot = $tot+count($total);
							
							$ans = explode(",", $enumanswer[$b]);
							$ans = array_unique($ans);
							for ($c=0; $c < count($ans); $c++) { 

								if(strpos(strtoupper($contdata[$b]['correct']), strtoupper($ans[$c])) !== false) {
									$score++;
									$ansenum[$b] = '[ '.$contdata[$b]['question'].' = correct ]';
								}else{
									$ansenum[$b] = '[ '.$contdata[$b]['question'].' = incorrect ]';
								}
								
							}
						}
						$types[$a] = '{'.$types[$a].'}';
						$new = array($types[$a], implode(", ", $ansenum));
						$itemanalysis[$a] = implode(" => ", $new);
	                break;


					case 'identification':

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
									$tot++;
								}
							}

							if($contdata[$b]['correct'] == $identansw[$b]){
								$score++;
								$ansident[$b] = '[ '.$contdata[$b]['question'].' = correct ]';
							}else{
								$ansident[$b] = '[ '.$contdata[$b]['question'].' = incorrect ]';
							}
						}
						$types[$a] = '{'.$types[$a].'}';
						$new = array($types[$a], implode(", ", $ansident));
						$itemanalysis[$a] = implode(" => ", $new);
					break;


					case 'matchingtype':

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
									$tot++;
								}
							}
							
							if($contdata[$b]['correct'] == $matchans[$b]){
								$score++;
								$ansmatch[$b] = '[ '.$contdata[$b]['question'].' = correct ]';
							}else{
								$ansmatch[$b] = '[ '.$contdata[$b]['question'].' = incorrect ]';
							}
						}
						$types[$a] = '{'.$types[$a].'}';
						$new = array($types[$a], implode(", ", $ansmatch));
						$itemanalysis[$a] = implode(" => ", $new);
					break;


					case 'true or false':

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
									$tot++;
								}
							}

							if($contdata[$b]['correct'] == $truefalse[$b]){
								$score++;
								$anstf[$b] = '[ '.$contdata[$b]['question'].' = correct ]';
							}else{
								$anstf[$b] = '[ '.$contdata[$b]['question'].' = incorrect ]';
							}
						}
						$types[$a] = '{'.$types[$a].'}';
						$new = array($types[$a], implode(", ", $anstf));
						$itemanalysis[$a] = implode(" => ", $new);
					break;

				}
                       
            }
            $answers = implode(" + ", $itemanalysis);
            
            echo $answers;
            foreach ($this->db->query("SELECT * FROM quiz_submit WHERE subj_code = $code AND lesson_title = '$lesson' AND grade_level = '$gr' AND section = '$sect' AND quiz_title = '$quiz' AND lrn = $decID")->result_array() as $ex) {
            	$attempt = $ex['attempt'];
            }

            /*if($this->db->query("UPDATE quiz_submit SET score = $score, date_submitted = '".date('Y-m-d H:i A')."', answers = '".$answers."', total = $tot, attempt = $attempt WHERE subj_code = $code AND lesson_title = '$lesson' AND grade_level = '$gr' AND section = '$sect' AND quiz_title = '$quiz' AND lrn = $decID AND attempt = $attempt")){
            	//date_submitted = '0000-00-00 00:00:00'
            	$this->db->query("INSERT INTO logs VALUES('', 'took an exam in ".$subj."', '".$code."_".$gr."_".$sect."', '".date('Y-m-d H:i:s')."', '$decID', 'student', '')");

            	header('Location:'.base_url().'Student/viewquiz/'.$sessid.'/'.$subj.'/'.$gr.'/'.$sect.'/'.$quiz.'/'.$code.'/'.$lesson);
            }*/

		}else{
			redirect('/');
		}
	}

	################################################################################################################
	################################################################################################################

	public function downloadAttach($sessid, $subj, $gr, $sect, $attach, $lesson, $code, $act){
		$sessid = str_replace("_47_", "/", str_replace("_50_", "=", $sessid));
		$decID = $this->encryption->decrypt($sessid);
		foreach($this->db->query("SELECT account_status FROM accounts WHERE id = $decID")->result_array() as $got){
			$got['account_status'];
		}
		$sessid = str_replace("/", "_47_", str_replace("=", "_50_", $sessid));
		if(!empty($this->session->userdata('student'.$decID)) && $got['account_status']=='Active'){
			$this->load->helper('download');

			$a = str_replace(":", "-", str_replace("%20", "-", $attach));

			$dir = str_replace("%20", " ", $subj).'_'.str_replace("%20", " ", $gr).'_'.str_replace("%20", " ", $sect).'/'.str_replace(":", "-", str_replace("%20", " ", $lesson)).'/'.str_replace("%20", " ", str_replace(":", "-", $act)).'/';
			
			$b = $a;
			$data = file_get_contents($dir.$a);
			force_download($a, $data);
			//force_download($dir.str_replace(":", "-", str_replace("%20", "-", $attach)), NULL);

			header('Location:'.base_url().'Student/viewactivity/'.$sessid.'/'.$subj.'/'.$gr.'/'.$sect.'/'.$act.'/'.$code.'/'.$lesson);
		}else{
			redirect('/');
		}
	}

	################################################################################################################
	################################################################################################################

	public function downloadSubmitted($sessid, $subj, $gr, $sect, $attach, $lesson, $code, $act){
		$sessid = str_replace("_47_", "/", str_replace("_50_", "=", $sessid));
		$decID = $this->encryption->decrypt($sessid);
		foreach($this->db->query("SELECT account_status FROM accounts WHERE id = $decID")->result_array() as $got){
			$got['account_status'];
		}
		$sessid = str_replace("/", "_47_", str_replace("=", "_50_", $sessid));
		if(!empty($this->session->userdata('student'.$decID)) && $got['account_status']=='Active'){
			$this->load->helper('download');

			$a = str_replace(":", "-", str_replace("%20", "-", $attach));

			$dir = str_replace("%20", " ", $subj).'_'.str_replace("%20", " ", $gr).'_'.str_replace("%20", " ", $sect).'/'.str_replace(":", "-", str_replace("%20", " ", $lesson)).'/'.str_replace("%20", " ", str_replace(":", "-", $act)).'/Submitted Acts/'.$decID.'/';
			
			$b = $a;
			$data = file_get_contents($dir.$a);
			force_download($a, $data);
			//force_download($dir.str_replace(":", "-", str_replace("%20", "-", $attach)), NULL);

			header('Location:'.base_url().'Student/viewactivity/'.$sessid.'/'.$subj.'/'.$gr.'/'.$sect.'/'.$act.'/'.$code.'/'.$lesson);
		}else{
			redirect('/');
		}
	}
	################################################################################################################
	################################################################################################################

	public function Submitactivity($sessid){
		$sessid = str_replace("_47_", "/", str_replace("_50_", "=", $sessid));
		$decID = $this->encryption->decrypt($sessid);
		foreach($this->db->query("SELECT account_status FROM accounts WHERE id = $decID")->result_array() as $got){
			$got['account_status'];
		}
		$sessid = str_replace("/", "_47_", str_replace("=", "_50_", $sessid));
		if(!empty($this->session->userdata('student'.$decID)) && $got['account_status']=='Active'){
			date_default_timezone_set("Asia/Manila");

			$file = $_FILES['filetosubmit']['name'];
			$subjcode = $_POST['subjcode'];
			$subj = $_POST['subj'];
			$lesson = $_POST['lesson'];
			$gr = $_POST['gr'];
			$sect = $_POST['sect'];
			$act = $_POST['act'];
			$acceptfile = $_POST['acceptfile'];
			$datesubmit = date('Y-m-d H:i A');

			//$dir = str_replace("%20", " ", str_replace(":", "-", $subj)).'_'.$gr.'_'.$sect.'/'.str_replace(":", "-", $lesson).'/'.str_replace(":", "-", $act).'/Submitted Acts';
			$adir = str_replace("%20", " ", str_replace(":", "-", $subj)).'_'.$gr.'_'.$sect.' /'.str_replace(":", "-", $lesson).'/'.str_replace(":", "-", $act).'/Submitted Acts/'.$decID.'/';
			
			$filetype = pathinfo(basename($_FILES["filetosubmit"]["name"]),PATHINFO_EXTENSION);

			if(substr_count($acceptfile, $filetype) < 0){
				$this->session->set_flashdata('error', 'File is not allowed');
				header('Location:'.base_url().'Student/viewactivity/'.$sessid.'/'.$subj.'/'.$gr.'/'.$sect.'/'.$act.'/'.$subjcode.'/'.$lesson);
			
			}else{
				
				if($filetype != "pdf" && $filetype != "docx" && $filetype != "doc" && $filetype != "pptx" && $filetype != "ppt" && $filetype != "xlsx" && $filetype != "xls"){
					$this->session->set_flashdata('error', 'File is not allowed');
					header('Location:'.base_url().'Student/viewactivity/'.$sessid.'/'.$subj.'/'.$gr.'/'.$sect.'/'.$act.'/'.$subjcode.'/'.$lesson);
				}else{

					if(!is_dir($adir)){
						mkdir($adir);
					}
					
					$query = $this->db->query("SELECT * FROM activities_submit WHERE subj_code = $subjcode AND lesson_title = '$lesson' AND grade_level = '$gr' AND section = '$sect' AND activity_title = '$act' AND lrn = '$decID'");
					
					if($query->num_rows() == 1){
						foreach ($query->result_array() as $prev) {
							$prev_file = $prev['file_submitted'];
							$prev_attempt = $prev['attempt'];
						}

						unlink($adir.str_replace(" ", "-", $prev_file));

						$savedfile = str_replace(" ", "-", str_replace(":", "-", $file));
						if(move_uploaded_file($_FILES['filetosubmit']['tmp_name'], $adir.$savedfile)){
							$this->db->query("UPDATE activities_submit SET subj_code = $subjcode, lesson_title = '$lesson', grade_level = '$gr', section = '$sect', activity_title = '$act', date_submitted = '$datesubmit', file_submitted = '$file', attempt = $prev_attempt+1, lrn = '$decID' WHERE subj_code = $subjcode AND lesson_title = '$lesson' AND grade_level = '$gr' AND section = '$sect' AND activity_title = '$act' AND lrn = '$decID'");

							$this->db->query("INSERT INTO logs VALUES('', 'submitted an Activity in ".str_replace("%20", " ", $subj)."', '".$subjcode."_".$gr."_".$sect."', '".date('Y-m-d H:i:s')."', '$decID', 'student', '')");

							$this->session->set_flashdata('success', 'Submitted');
							header('Location:'.base_url().'Student/viewactivity/'.$sessid.'/'.$subj.'/'.$gr.'/'.$sect.'/'.$act.'/'.$subjcode.'/'.$lesson);
							
						}else{
							$this->session->set_flashdata('error', 'Unexpexted error occur while uploading your file.');
							header('Location:'.base_url().'Student/viewactivity/'.$sessid.'/'.$subj.'/'.$gr.'/'.$sect.'/'.$act.'/'.$subjcode.'/'.$lesson);
						}

					}else{
						$savedfile = str_replace(" ", "-", str_replace(":", "-", $file));

						if(move_uploaded_file($_FILES['filetosubmit']['tmp_name'], $adir.$savedfile)){
							$this->db->query("INSERT INTO activities_submit VALUES($subjcode, '$lesson', '$gr', '$sect', '$act', '$datesubmit', '$file', 1, 0, '$decID')");

							$this->db->query("INSERT INTO logs VALUES('', 'submitted an Activity in ".str_replace("%20", " ", $subj)."', '".$subjcode."_".$gr."_".$sect."', '".date('Y-m-d H:i:s')."', '$decID', 'student', '')");

							$this->session->set_flashdata('success', 'Submitted');
							header('Location:'.base_url().'Student/viewactivity/'.$sessid.'/'.$subj.'/'.$gr.'/'.$sect.'/'.$act.'/'.$subjcode.'/'.$lesson);
						}else{
							$this->session->set_flashdata('error', 'Unexpexted error occur while uploading your file.');
							header('Location:'.base_url().'Student/viewactivity/'.$sessid.'/'.$subj.'/'.$gr.'/'.$sect.'/'.$act.'/'.$subjcode.'/'.$lesson);
						}
					}
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


	################################################################################################################
	################################################################################################################
	################################################################################################################
	################################################################################################################

	public function grading($sessid){
		
		$sessid = str_replace("_47_", "/", str_replace("_50_", "=", $sessid));
		$decID = $this->encryption->decrypt($sessid);
		foreach($this->db->query("SELECT account_status FROM accounts WHERE id = '$decID'")->result_array() as $got){
			$got['account_status'];
		}

		$sessid = str_replace("/", "_47_", str_replace("=", "_50_", $sessid));
		
		if(!empty($this->session->userdata('student'.$decID)) && $got['account_status']=='Active'){

			$this->load->model('Student_model');
			$data['link'] = $sessid;
			$data['title'] = 'Grades';

			//USER INFO
			extract($this->session->userdata('student'.$decID));

			if($role == 'JHSstudent'){
				$getInfo = $this->db->query("SELECT * FROM jhsstudents WHERE lrn = '$id'");
			}else{
				$getInfo = $this->db->query("SELECT * FROM shsstudents WHERE lrn = '$id'");
			}
			foreach ($getInfo->result_array() as $userInfo) {
				$data['name'] = $userInfo['fname'].' '.$userInfo['mname'].' '.$userInfo['lname'];
				$data['gradelvl'] = $userInfo['grade_level'];
				$data['section'] = $userInfo['section'];
				$data['photo'] = $userInfo['photo'];
				$data['subj'] = $userInfo['subjects'];
			}

			$data['id'] = $id;
			//USER INFO - END

			$this->load->view('templates/header');
			$this->load->view('pages/student/grades', $data);
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
		foreach($this->db->query("SELECT account_status FROM accounts WHERE id = '$decID'")->result_array() as $got){
			$got['account_status'];
		}

		$sessid = str_replace("/", "_47_", str_replace("=", "_50_", $sessid));
		
		if(!empty($this->session->userdata('student'.$decID)) && $got['account_status']=='Active'){

			$this->load->model('Student_model');
			$data['link'] = $sessid;
			$data['title'] = 'Concerns';

			//USER INFO
			extract($this->session->userdata('student'.$decID));

			if($role == 'JHSstudent'){
				$getInfo = $this->db->query("SELECT * FROM jhsstudents WHERE lrn = '$id'");
			}else{
				$getInfo = $this->db->query("SELECT * FROM shsstudents WHERE lrn = '$id'");
			}
			foreach ($getInfo->result_array() as $userInfo) {
				$data['name'] = $userInfo['fname'].' '.$userInfo['mname'].' '.$userInfo['lname'];
				$data['photo'] = $userInfo['photo'];
				$data['gradelvl'] = $userInfo['grade_level'];
				$data['section'] = $userInfo['section'];
			}

			$data['id'] = $id;
			//USER INFO - END

			$this->load->view('templates/header');
			$this->load->view('pages/student/concerns', $data);
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
		foreach($this->db->query("SELECT account_status FROM accounts WHERE id = '$decID'")->result_array() as $got){
			$got['account_status'];
		}

		$sessid = str_replace("/", "_47_", str_replace("=", "_50_", $sessid));
		
		if(!empty($this->session->userdata('student'.$decID)) && $got['account_status']=='Active'){
			date_default_timezone_set('Asia/Manila');

			$rec = htmlspecialchars(stripslashes(trim($_POST['rec'])));
			$concern = htmlspecialchars(stripslashes(trim($_POST['concern'])));
			$desc = htmlspecialchars(stripslashes(trim($_POST['desc'])));
			$date = date('Y-m-d H:i A');

			if($rec != $decID){

				$this->db->query("INSERT INTO concerns VALUES('', '$concern', '$desc', '$date', '$decID', '$rec', 'pending')");
				$this->session->set_flashdata('success', 'Posted successfully');
				header('Location:'.base_url().'Student/concerns/'.$sessid);

			}else{
				$this->session->set_flashdata('error', 'Error in posting!');
				header('Location:'.base_url().'Student/concerns/'.$sessid);
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
							<form action="'.base_url().'Student/viewedconcern/'.$sessid.'/'.$i['c_id'].'" method="post">
							<b>'.$name.'</b> | <span class="w3-badge w3-round '.$stat.'">'.$i['status'].'</span> '.$rem.'<br/>
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
							<form action="'.base_url().'Student/viewedconcern/'.$sessid.'/'.$i['c_id'].'" method="post">
							<b>'.$name.'</b> | <span class="w3-badge w3-round '.$stat.'">'.$i['status'].'</span> '.$button.'<br/>
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
							<form action="'.base_url().'Student/viewedconcern/'.$sessid.'/'.$i['c_id'].'" method="post">
							<b>'.$name.'</b> | <span class="w3-badge w3-round w3-yellow">'.$i['status'].'</span><br/>
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
							<form action="'.base_url().'Student/viewedconcern/'.$sessid.'/'.$i['c_id'].'" method="post">
							<b>'.$name.'</b> | <span class="w3-badge w3-round w3-green">'.$i['status'].'</span><br/>
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

	public function viewedconcern($sessid, $c_id){
		$sessid = str_replace("_47_", "/", str_replace("_50_", "=", $sessid));
		$decID = $this->encryption->decrypt($sessid);
		foreach($this->db->query("SELECT account_status FROM accounts WHERE id = $decID")->result_array() as $got){
			$got['account_status'];
		}

		$sessid = str_replace("/", "_47_", str_replace("=", "_50_", $sessid));
		
		if(!empty($this->session->userdata('student'.$decID)) && $got['account_status']=='Active'){
			$cid = htmlspecialchars(stripslashes(trim($c_id)));
			
			if(isset($_POST['button'])){
				if($_POST['button'] == 'Cancel'){
					$this->db->query("DELETE FROM concerns WHERE c_id = $cid");

					$this->session->set_flashdata('success', 'Concern has been cancelled.');
					header('Location:'.base_url().'Student/concerns/'.$sessid);
				
				}else if($_POST['button'] == 'click here if resolved'){
					$this->db->query("UPDATE concerns SET status = 'resolved' WHERE c_id = $cid");

					$this->session->set_flashdata('success', 'Concern has been resolved.');
					header('Location:'.base_url().'Student/concerns/'.$sessid);

				}else if($_POST['button'] == 'Decline'){
					$this->db->query("UPDATE concerns SET status = 'declined' WHERE c_id = $cid");

					$this->session->set_flashdata('success', 'Declined.');
					header('Location:'.base_url().'Student/concerns/'.$sessid);

				}else{
					$this->session->set_flashdata('error', 'Unexpected error.');
					header('Location:'.base_url().'Student/concerns/'.$sessid);
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
		$this->session->unset_userdata('student'.$id);
		redirect('/');
	}
}
?>