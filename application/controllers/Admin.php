<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Admin extends CI_Controller{

	function __construct(){
		parent::__construct();
			//$this->load->database();
		}
	/*############################################################################
	/*############################################################################
	ADMIN FILE for the processes and pages of administrator
	*/

	public function countOnline(){

		if($this->db->query("SELECT * FROM accounts WHERE status = 'online' AND role != 'admin'")->num_rows() == 0){}
		else{
			echo $this->db->query("SELECT * FROM accounts WHERE status = 'online' AND role != 'admin'")->num_rows();
		}
	}

	################################################################################################################
	################################################################################################################

	public function OnlineList(){
		echo '<ul class="w3-ul">';
		foreach ($this->db->query("SELECT * FROM accounts WHERE status = 'online' AND role != 'admin' LIMIT 20")->result_array() as $i) {
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

	public function countconcern(){

		if($this->db->query("SELECT * FROM concerns WHERE receiver = 'Administrator' AND status == 'pending'")->num_rows() == 0){}
		else{
			echo $this->db->query("SELECT * FROM concerns WHERE receiver = 'Administrator' AND status == 'pending'")->num_rows();
		}
	}

	################################################################################################################
	################################################################################################################

	public function notifcounter(){

		if($this->db->query("SELECT * FROM logs WHERE viewed NOT LIKE '%admin%'")->num_rows() == 0){ }
		else{
			echo $this->db->query("SELECT * FROM logs WHERE viewed NOT LIKE '%admin%'")->num_rows();
		}

		/*if($this->db->query("SELECT * FROM concerns WHERE receiver = 'Administrator' AND status != 'resolved' AND status != 'declined'")->num_rows() == 0){ $concern = 0; }
		else{
			$concern = $this->db->query("SELECT * FROM concerns WHERE receiver = 'Administrator' AND status != 'resolved'")->num_rows();
		}

		if($logs == 0 && $concern == 0){}
		else{ echo $logs+$concern; }*/
	}

	################################################################################################################
	################################################################################################################

	public function notifitems($page){

		echo '<ul class="w3-ul">';

		foreach ($this->db->query("SELECT * FROM logs WHERE viewed NOT LIKE '%admin%' ORDER BY date DESC")->result_array() as $a) {
			foreach ($this->db->query("SELECT * FROM teachers WHERE id = '".$a['id']."'")->result_array() as $b) {
				$log = $b['fname'].' '.$b['lname'];
			}
			foreach ($this->db->query("SELECT * FROM jhsstudents WHERE lrn = '".$a['id']."'")->result_array() as $b) {
				$log = $b['fname'].' '.$b['lname'];
			}
			foreach ($this->db->query("SELECT * FROM shsstudents WHERE lrn = '".$a['id']."'")->result_array() as $b) {
				$log = $b['fname'].' '.$b['lname'];
			}
			
			echo '<li><a href="'.base_url().'Admin/viewdnotif/admin/'.$a['l_id'].'/'.$page.'" class="w3-small"><b>'.$log.'</b> '.$a['description'].' ('.str_replace("_", " ", $a['made_for']).') | <small>('.date('M. j, Y h:i A', strtotime($a['date'])).') <br/> mark as read</small></a></li>';
		}

		echo '</ul>';

		//CONCERNS
		/*foreach ($this->db->query("SELECT * FROM concerns WHERE receiver = 'Administrator' AND status != 'resolved' AND status != 'declined'")->result_array() as $i) {
			foreach ($this->db->query("SELECT * FROM teachers WHERE id = '".$i['sender']."'")->result_array() as $s) {
				$sender = $s['fname'].' '.$s['lname'];
			}
			foreach ($this->db->query("SELECT * FROM jhsstudents WHERE lrn = '".$i['sender']."'")->result_array() as $s) {
				$sender = $s['fname'].' '.$s['lname'];
			}
			foreach ($this->db->query("SELECT * FROM shsstudents WHERE lrn = '".$i['sender']."'")->result_array() as $s) {
				$sender = $s['fname'].' '.$s['lname'];
			}
			echo '<li><b>'.$sender.'</b> posted a concern: <b>'.$i['subject'].'</b></li>';
		}*/
		//CONCERNS | END
	}

	################################################################################################################
	################################################################################################################

	public function Adminlogs(){
		echo '<ul class="w3-ul">';
		foreach ($this->db->query("SELECT * FROM logs ORDER BY date DESC LIMIT 5")->result_array() as $a) {
			foreach ($this->db->query("SELECT * FROM teachers WHERE id = '".$a['id']."'")->result_array() as $b) {
				$log = $b['fname'].' '.$b['lname'];
			}
			foreach ($this->db->query("SELECT * FROM jhsstudents WHERE lrn = '".$a['id']."'")->result_array() as $b) {
				$log = $b['fname'].' '.$b['lname'];
			}
			foreach ($this->db->query("SELECT * FROM shsstudents WHERE lrn = '".$a['id']."'")->result_array() as $b) {
				$log = $b['fname'].' '.$b['lname'];
			}
			
			echo '<li class="w3-small"><b>'.$log.'</b> '.$a['description'].' '.str_replace("_", " ", $a['made_for']).' | <small>('.date('M. j, Y h:i A', strtotime($a['date'])).')</small></li>';
		}
		echo '</ul>';
	}

	################################################################################################################
	################################################################################################################

	public function Adminlogslist(){
		echo '<ul class="w3-ul">';
		foreach ($this->db->query("SELECT * FROM logs ORDER BY date DESC")->result_array() as $a) {
			foreach ($this->db->query("SELECT * FROM teachers WHERE id = '".$a['id']."'")->result_array() as $b) {
				$log = $b['fname'].' '.$b['lname'];
			}
			foreach ($this->db->query("SELECT * FROM jhsstudents WHERE lrn = '".$a['id']."'")->result_array() as $b) {
				$log = $b['fname'].' '.$b['lname'];
			}
			foreach ($this->db->query("SELECT * FROM shsstudents WHERE lrn = '".$a['id']."'")->result_array() as $b) {
				$log = $b['fname'].' '.$b['lname'];
			}
			
			echo '<li class="w3-small"><b>'.$log.'</b> '.$a['description'].' '.str_replace("_", " ", $a['made_for']).' | ('.date('M. j, Y h:i A', strtotime($a['date'])).')</li>';
		}
		echo '</ul>';
	}

	################################################################################################################
	################################################################################################################

	public function viewdnotif($viewer, $n_id, $page){

		foreach ($this->db->query("SELECT * FROM logs WHERE l_id = $n_id")->result_array() as $a) {
			
			if(empty($a['viewed'])){

				$this->db->query("UPDATE logs SET viewed = 'admin' WHERE l_id = $n_id");
				header('Location:'.base_url().'admin/'.str_replace("%20", "/", $page));

			}else{
				$viewers = array($a['viewed'], 'admin');
				$newviewers = implode(', ', $viewers);

				$this->db->query("UPDATE logs SET viewed = '$newviewers' WHERE l_id = $n_id");
				header('Location:'.base_url().'admin/'.str_replace("%20", "/", $page));
			}

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
	//DASHBOARD
	public function dashboard(){
		if($this->session->userdata('Home of the braves@2022:admin')){
			$data['title'] = 'Dashboard';

			$this->load->model('users_model');

			$this->load->library('calendar');

				$prefs = array(
						'show_next_prev'  => TRUE,
        				'next_prev_url'   => base_url().'admin/dashboard/'
				);


			$this->calendar->initialize($prefs);

			$this->load->view('templates/header');
			$this->load->view('pages/admin/dashboard', $data);
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
	public function export_excel($section, $gr){
		$gr = str_replace("%20", " ", $gr);
		$section = str_replace("%20", " ", $section);
		if($gr == 'Grade 7' || $gr == 'Grade 8' || $gr == 'Grade 9' || $gr == 'Grade 10'){
			$result = $this->db->query("SELECT * FROM jhsstudents WHERE section = '$section' AND grade_level = '$gr'")->result_array();
		}else{
			$result = $this->db->query("SELECT * FROM shsstudents WHERE section = '$section' AND grade_level = '$gr'")->result_array();
		}
		
		$filename = 'Enrolled_'.$section.'_'.$gr.'.xls';

		header("Content-Type: application/vnd.ms-excel");
		header("Content-Disposition: attachment; filename=\"$filename\"");

		$isPrintHeader = false;
		foreach ($result as $row) {
			if(!$isPrintHeader){
				echo implode("\t", array_keys($row))."\n";
				$isPrintHeader = true;
			}
			echo implode("\t", array_values($row))."\n";
		}
		exit();
	}


	public function downloadsubjs(){
		
		$result = $this->db->query("SELECT * FROM subjects ORDER BY gr_level ASC")->result_array();
		
		$filename = 'Uploaded subjects.xls';

		header("Content-Type: application/vnd.ms-excel");
		header("Content-Disposition: attachment; filename=\"$filename\"");

		$isPrintHeader = false;
		foreach ($result as $row) {
			if(!$isPrintHeader){
				echo implode("\t", array_keys($row))."\n";
				$isPrintHeader = true;
			}
			echo implode("\t", array_values($row))."\n";
		}
		exit();
	}
	################################################################################################################
	################################################################################################################
	################################################################################################################
	################################################################################################################

	################################################################################################################
	################################################################################################################
	################################################################################################################
	################################################################################################################
	//STUDENT ACCOUNTS
	public function studentaccounts(){

		if($this->session->userdata('Home of the braves@2022:admin')){

			$this->load->model('users_model');
			$this->load->library('pagination');

			$data['title'] = 'Student Accounts';

			$data['base_url'] = base_url().'admin/studentaccounts/';
			//$data['total_rows'] = $this->db->get('accounts')->num_rows();
			$data['per_page'] = 20;
			
			$data['total_rows'] = $this->db->query('SELECT * FROM accounts WHERE role IN("JHSstudent", "SHSstudent")')->num_rows() - $data['per_page'];
			
			if($data['total_rows'] <= 0){
				$data['next_link'] = '';
				$data['prev_link'] = '';
			}else{
				$data['full_tag_open'] = '<div class="w3-bar w3-border w3-padding w3-round">';
				$data['full_tag_close'] = '</div>';
				$data['next_link'] = '<span class="fa">&#xf105;</span>';
				$data['prev_link'] = '<span class="fa">&#xf104;</span>';
			}

			//Customizing pagination
			/*$data['full_tag_open'] = '<div class="w3-bar w3-border w3-padding w3-round">';
			$data['full_tag_close'] = '</div>';
			$data['next_link'] = '<span class="fa">&#xf105;</span>';
			$data['prev_link'] = '<span class="fa">&#xf104;</span>';*/
			$data['cur_tag_open'] = '<span class="w3-padding-left"><b>';
			$data['cur_tag_close'] = '</b></span>';
			$data['next_tag_open'] = '<span class="w3-padding-left">';
			$data['next_tag_close'] = '<span>';
			$data['num_tag_open'] = '<span class="w3-padding-left">';
			$data['num_tag_close'] = '<span>';
			$data['first_link'] = '<span class="fa w3-padding-right">&#xf100;</span>';
			$data['last_link'] = '<span class="fa w3-padding-left">&#xf101;</span>';

			$data['recordSHS'] = $this->db->get('shsstudents', $data['per_page'], $this->uri->segment(3));
			$data['recordJHS'] = $this->db->get('jhsstudents', $data['per_page'], $this->uri->segment(3));
			//$data['recordSHS'] = $this->db->get_where('accounts', 'role = "SHSstudent"', $data['per_page'], $this->uri->segment(3));
			//$data['recordJHS'] = $this->db->get_where('accounts', 'role = "JHSstudent"', $data['per_page'], $this->uri->segment(3));

			$this->pagination->initialize($data);
			
			$this->load->view('templates/header');
			$this->load->view('pages/admin/studentaccounts', $data);
			$this->load->view('templates/footer');

		}else{
			redirect('/');
		}
	}

	################################################################################################################
	################################################################################################################

	//STUDENT ACCOUNTS | DEACTIVATE STUDENT ACCOUNT
	public function studAccDeact($lrn){
		if($this->session->userdata('Home of the braves@2022:admin')){

			$this->db->query("UPDATE accounts SET account_status = 'Inactive' WHERE id = '$lrn'");
			header('Location:'.base_url().'admin/studentaccounts');

		}else{
			redirect('/');
		}

	}

	################################################################################################################
	################################################################################################################

	//STUDENT ACCOUNTS | ACTIVATE STUDENT ACCOUNT
	public function studAccActivate($lrn){
		if($this->session->userdata('Home of the braves@2022:admin')){

			$this->db->query("UPDATE accounts SET account_status = 'Active' WHERE id = '$lrn'");
			header('Location:'.base_url().'admin/studentaccounts');

		}else{
			redirect('/');
		}
	}

	################################################################################################################
	################################################################################################################

	//STUDENT ACCOUNTS | SEARCH STUDENTS
	public function searchStudent(){
		if($this->session->userdata('Home of the braves@2022:admin')){

			$lname = $_POST['lastname'];
			
			$shoutjhs = $this->db->query("SELECT * FROM jhsstudents WHERE lname = '$lname'");
			$shoutshs = $this->db->query("SELECT * FROM shsstudents WHERE lname = '$lname'");

			if($shoutjhs->num_rows() >= 1 && $shoutshs->num_rows() >= 1){

				$this->session->set_flashdata('JHS', $shoutjhs->result_array());
				$this->session->set_flashdata('SHS', $shoutshs->result_array());
				header('location:'.base_url().'admin/studentaccounts/');
			
			}
			elseif ($shoutshs->num_rows() >= 1) {
				
				$this->session->set_flashdata('SHS', $shoutshs->result_array());
				header('location:'.base_url().'admin/studentaccounts/');


			}elseif($shoutjhs->num_rows() >= 1){

				$this->session->set_flashdata('JHS', $shoutjhs->result_array());
				header('location:'.base_url().'admin/studentaccounts/');

			}
			else{
				$this->session->set_flashdata('none', 'No matches!');
				header('location:'.base_url().'admin/studentaccounts/');
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
	//TEACHERS' ACCOUNT
	public function teacheraccounts(){

		if($this->session->userdata('Home of the braves@2022:admin')){

			$this->load->model('users_model');

			$data['title'] = 'Teachers\' Accounts';
			$this->load->library('pagination');

			$data['base_url'] = base_url().'admin/teacheraccounts/';
			$data['per_page'] = 20;

			$data['total_rows'] = $this->db->query('SELECT * FROM accounts WHERE role IN("Junior High School Teacher", "Senior High School Teacher")')->num_rows() - $data['per_page'];
			
			if($data['total_rows'] <= 0){
				$data['next_link'] = '';
				$data['prev_link'] = '';
			}else{
				$data['full_tag_open'] = '<div class="w3-bar w3-border w3-padding w3-round">';
				$data['full_tag_close'] = '</div>';
				$data['next_link'] = '<span class="fa">&#xf105;</span>';
				$data['prev_link'] = '<span class="fa">&#xf104;</span>';
			}
			//$data['num_links'] = 10;

			//Customizing pagination
			$data['cur_tag_open'] = '<span class="w3-padding-left"><b>';
			$data['cur_tag_close'] = '</b></span>';
			$data['next_tag_open'] = '<span class="w3-padding-left">';
			$data['next_tag_close'] = '<span>';
			$data['num_tag_open'] = '<span class="w3-padding-left">';
			$data['num_tag_close'] = '<span>';
			$data['first_link'] = '<span class="fa w3-padding-right">&#xf100;</span>';
			$data['last_link'] = '<span class="fa w3-padding-left">&#xf101;</span>';

			//$this->db->where('Department', 'Junior High School Teacher');
			$data['recordJHSTeacher'] = $this->db->get_where('teachers', 'Department = "Junior High School Teacher"', $data['per_page'], $this->uri->segment(3));

			//$this->db->where('Department', 'Senior High School Teacher');
			$data['recordSHSTeacher'] = $this->db->get_where('teachers', 'Department = "Senior High School Teacher"', $data['per_page'], $this->uri->segment(3));

			//$data['recordSHS'] = $this->db->get_where('accounts', 'role = "SHSstudent"', $data['per_page'], $this->uri->segment(3));

			$this->pagination->initialize($data);
			
			$this->load->view('templates/header');
			$this->load->view('pages/admin/teacheraccounts', $data);
			$this->load->view('templates/footer');

		}else{
			redirect('/');
		}
	}

	################################################################################################################
	################################################################################################################

	//TEACHERS' ACCOUNT | SEARCH TEACHER'S ACCOUNT
	public function searchTeacher($redirect){

		if($this->session->userdata('Home of the braves@2022:admin')){
			$lname = $_POST['lastname'];
			
			$shoutTeach = $this->db->query("SELECT * FROM teachers WHERE lname = '$lname'");

			if($shoutTeach->num_rows() >= 1){

				$this->session->set_flashdata('Teachers', $shoutTeach->result_array());
				header('location:'.base_url().'admin/'.$redirect.'/');
			
			}else{

				$this->session->set_flashdata('none', 'No matches!');
				header('location:'.base_url().'admin/'.$redirect.'/');
			}

		}else{
			redirect('/');
		}
	}

	################################################################################################################
	################################################################################################################

	public function teachAccDeact($id){
		if($this->session->userdata('Home of the braves@2022:admin')){

			$this->db->query("UPDATE accounts SET account_status = 'Inactive' WHERE id = '$id'");
			header('Location:'.base_url().'admin/teacheraccounts');

		}else{
			redirect('/');
		}
	}

	################################################################################################################
	################################################################################################################

	public function teachAccActivate($id){
		if($this->session->userdata('Home of the braves@2022:admin')){

			$this->db->query("UPDATE accounts SET account_status = 'Active' WHERE id = '$id'");
			header('Location:'.base_url().'admin/teacheraccounts');

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
	public function createSect(){
		if($this->session->userdata('Home of the braves@2022:admin')){

			$Sect_name = trim($_POST['sectname'], " ");
			$gr_lvl = $_POST['grlvl'];

			$check_ifexits = $this->db->query("SELECT * FROM sections WHERE sect_name = '$Sect_name' AND gr_level = '$gr_lvl'");			
			

			if($check_ifexits->num_rows() != 1){

				$create_Section = $this->db->query("INSERT INTO sections VALUES('$Sect_name', '$gr_lvl', NULL)");
				$gr = str_replace(" ", "", $gr_lvl);
				$grade = str_replace("G", "g", $gr);

				header('location:'.base_url().'admin/'.$grade.'/List');
			}else{
				$gr = str_replace(" ", "", $gr_lvl);
				$grade = str_replace("G", "g", $gr);
				header('location:'.base_url().'admin/'.$grade.'/List');
			}

		}else{
			redirect('/');
		}
	}

	################################################################################################################
	################################################################################################################

	public function Dissolve($grade, $section){
		if($this->session->userdata('Home of the braves@2022:admin')){

			$section = str_replace('%20', ' ', $section);
			$grade = str_replace('%20', ' ', $grade);
			
			//CHECKING OF CONTENT
			$chkadviser = $this->db->query("SELECT * FROM sections WHERE sect_name = '$section' AND gr_level = '$grade' AND adviser IS NOT NULL")->num_rows();
			$chksubj = $this->db->query("SELECT * FROM subject_teacher WHERE section = '$section' AND gr_level = '$grade'")->num_rows();

			$chkstudsubj = $this->db->query("SELECT * FROM subject_students WHERE section = '$section' AND gr_level = '$grade'")->num_rows();
			

			if($grade == 'Grade 11' || $grade == 'Grade 12'){
				$chkstud = $this->db->query("SELECT * FROM shsstudents WHERE section = '$section' AND grade_level = '$grade'")->num_rows();
			}else{
				$chkstud = $this->db->query("SELECT * FROM jhsstudents WHERE section = '$section' AND grade_level = '$grade'")->num_rows();
			}
			//CHECKING OF CONTENT | END


			if($chkadviser == 0 && $chksubj == 0 && $chkstud == 0 && $chkstudsubj){

				$this->db->query("DELETE FROM sections WHERE sect_name = '$section'");
				header('location:'.base_url().'admin/'.str_replace(" ", "", $grade).'/List');

			}else{
				//CHECKING IF ADVISER EXISTS
				if($this->db->query("SELECT * FROM sections WHERE sect_name = '$section' AND gr_level = '$grade'")->num_rows() == 1){
					$this->db->query("DELETE FROM sections WHERE sect_name = '$section' AND gr_level = '$grade'");
				}
				//CHECKING IF ADVISER EXISTS | END


				//SUBJECTS AND TEACHERS
				if($this->db->query("SELECT * FROM subject_teacher WHERE section = '$section' AND gr_level = '$grade'")->num_rows() >= 1){
					$result = $this->db->query("SELECT * FROM subject_teacher WHERE section = '$section' AND gr_level = '$grade'");

					foreach ($result->result_array() as $toDelete) {
						$toDelete['subj_code'];


						//UPDATE TEACHERS LOAD
						foreach ($this->db->query("SELECT * FROM teachers WHERE id = '".$toDelete['subj_teacher']."'")->result_array() as $tinfo) {
							$load = $tinfo['teach_load'];

							$this->db->query("UPDATE teachers SET teach_load = '$load'-1 WHERE id = '".$toDelete['subj_teacher']."'");
						}
						$this->db->query("DELETE FROM subject_teacher WHERE gr_level = '$grade' AND section = '$section'");


						//GET SUBJECT INFO THEN DELETE ITS CONTENT
						foreach($this->db->query("SELECT * FROM subjects WHERE subj_code = '".$toDelete['subj_code']."'")->result_array() as $subjInfo){
							$subjInfo['subj_title'];
						}

						$fordir = $subjInfo['subj_title'];
						$code = $toDelete['subj_code'];
						$table = str_replace("-", "_", str_replace(" ", "", $section)).'_'.str_replace(" ", "", $grade).'_'.$code;

				
						if($this->db->query("SHOW TABLES LIKE '$table'")->num_rows() >= 1){
							
							$content = $this->db->query("SELECT * FROM $table");
							if($content->num_rows() == 0){

								$this->db->query("DROP TABLE $table");

							}else{
								$dir = str_replace("%20", " ", $fordir).'_'.str_replace("%20", " ", $grade).'_'.str_replace("%20", " ", $section).'/';

								foreach ($content->result_array() as $got) {

									//$filedir = $dir.str_replace(":", "-", str_replace("%20", " ", $got['lesson'])).'/';
									$rdir = str_replace("%20", " ", str_replace(":", "-", $fordir)).'_'.str_replace("%20", " ", $grade).'_'.str_replace("%20", " ", $section).'/';
									$subdir = str_replace("%20", " ", str_replace(":", "-", $fordir)).'_'.str_replace("%20", " ", $grade).'_'.str_replace("%20", " ", $section).'/'.str_replace(":", "-", str_replace("%20", " ", $got['lesson'])).'/';

									//$module = explode(", ", $got['module']);


									//ACTIVITIES
									$activities = explode(", ", $got['activity']);//LIST OF ALL EXISTING ACTIVITIES
									
									for($a = 0; $a < count($activities); $a++){
										$actdir = str_replace(":", "-", $activities[$a]);

										//SUBMITTED ACTIVITY
										$querysubmittedact = $this->db->query("SELECT * FROM activities_submit WHERE subj_code = $code AND lesson_title = '".$got['lesson']."' AND grade_level = '$grade' AND section = '$section' AND activity_title = '".$activities[$a]."'");
										
										if($querysubmittedact->num_rows() != 0){
											foreach ($querysubmittedact->result_array() as $z) {
												$dirlrn = $z['lrn'];
												$dirfile = str_replace(" ", "-", str_replace(":", "-", $z['file_submitted']));
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
									
									$this->db->query("DELETE FROM activities_submit WHERE subj_code = $code AND lesson_title = '".$got['lesson']."' AND grade_level = '$grade' AND section = '$section'");
									$this->db->query("DELETE FROM activities WHERE subj_code = $code AND lesson_title = '".$got['lesson']."' AND grade_level = '$grade' AND section = '$section'");
									

									$this->db->query("DELETE FROM quiz_submit WHERE subj_code = $code AND lesson_title = '".$got['lesson']."' AND grade_level = '$grade' AND section = '$section'");
									$this->db->query("DELETE FROM quiz WHERE subj_code = $code AND lesson_title = '".$got['lesson']."' AND grade_level = '$grade' AND section = '$section'");
									
									$this->db->query("DELETE FROM $table WHERE lesson = '".$got['lesson']."'");
								}

							}

						}
						
					}
				}
				//SUBJECTS AND TEACHERS | END

				//STUDENTS ENROLLED
				if($chkstud >= 1){
					if($grade == 'Grade 11' || $grade == 'Grade 12'){
						$this->db->query("UPDATE shsstudents SET section = '', status = 'Queued' WHERE section = '$section' AND grade_level = '$grade' AND status = 'Enrolled'");

					}else{
						$this->db->query("UPDATE jhsstudents SET section = '', status = 'Queued' WHERE section = '$section' AND grade_level = '$grade' AND status = 'Enrolled'");
					}
				}

				$this->db->query("DELETE FROM subject_students WHERE section = '$section'");

				header('location:'.base_url().'admin/'.str_replace(" ", "", $grade).'/List');
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
	//GRADE 7 - SECTIONS
	public function grade7($method){

		if($this->session->userdata('Home of the braves@2022:admin')){

			switch($method){
				case "List":
					$data['title'] = 'Grade 7';

					$this->load->model('users_model');
					
					$this->load->view('templates/header');
					$this->load->view('pages/admin/grade7', $data);
					$this->load->view('templates/footer');
					break;
	
				default:
					$method = str_replace("%20", " ", $method);
					$data['title'] = $method;

					$getSection = $this->db->query("SELECT * FROM sections WHERE sect_name = '$method' AND gr_level = 'Grade 7'");

					if($getSection->num_rows() == 1){
						foreach ($getSection->result_array() as $sect) {
							$data['section_name'] = $sect['sect_name'];
							$data['grade_level'] = $sect['gr_level'];
							$data['adviser'] = $sect['adviser'];
						}
						$this->load->model('users_model');

						$this->load->view('templates/header');
						$this->load->view('pages/admin/grade7/SectionsPreview', $data);
						$this->load->view('templates/footer');
					}
			}

		}else{
			redirect('/');
		}
	}
	//END | GRADE 7 SECTIONS

	################################################################################################################
	################################################################################################################

	//GRADE 8 SECTIONS
	public function grade8($method){

		if($this->session->userdata('Home of the braves@2022:admin')){

			switch($method){
				case "List":
					$data['title'] = 'Grade 8';

					$this->load->model('users_model');
					
					$this->load->view('templates/header');
					$this->load->view('pages/admin/grade8', $data);
					$this->load->view('templates/footer');
					break;

				default:
					$section = str_replace("%20", " ", $method);

					$data['title'] = $section;

					$getSection = $this->db->query("SELECT * FROM sections WHERE sect_name = '$section' AND gr_level = 'Grade 8'");

					if($getSection->num_rows() == 1){
						foreach ($getSection->result_array() as $sect) {
							$data['section_name'] = $sect['sect_name'];
							$data['grade_level'] = $sect['gr_level'];
							$data['adviser'] = $sect['adviser'];
						}
						$this->load->model('users_model');

						$this->load->view('templates/header');
						$this->load->view('pages/admin/grade8/SectionsPreview', $data);
						$this->load->view('templates/footer');
					}
			}

		}else{
			redirect('/');
		}
	}
	//END | GRADE 8 SECTIONS

	################################################################################################################
	################################################################################################################

	//GRADE 9 SECTIONS
	public function Grade9($method){

		if($this->session->userdata('Home of the braves@2022:admin')){

			switch($method){
				case "List":
					$data['title'] = 'Grade 9';

					$this->load->model('users_model');
					
					$this->load->view('templates/header');
					$this->load->view('pages/admin/grade9', $data);
					$this->load->view('templates/footer');
					break;

				default:
					$section = str_replace("%20", " ", $method);

					$data['title'] = $section;

					$getSection = $this->db->query("SELECT * FROM sections WHERE sect_name = '$section' AND gr_level = 'Grade 9'");

					if($getSection->num_rows() == 1){
						foreach ($getSection->result_array() as $sect) {
							$data['section_name'] = $sect['sect_name'];
							$data['grade_level'] = $sect['gr_level'];
							$data['adviser'] = $sect['adviser'];
						}
						$this->load->model('users_model');

						$this->load->view('templates/header');
						$this->load->view('pages/admin/grade9/SectionsPreview', $data);
						$this->load->view('templates/footer');
					}
			}

		}else{
			redirect('/');
		}
	}
	//END | GRADE 9 SECTIONS

	################################################################################################################
	################################################################################################################

	//GRADE 10 SECTIONS
	public function Grade10($method){

		if($this->session->userdata('Home of the braves@2022:admin')){

			switch($method){
				case "List":
					$data['title'] = 'Grade 10';

					$this->load->model('users_model');
					
					$this->load->view('templates/header');
					$this->load->view('pages/admin/grade10', $data);
					$this->load->view('templates/footer');
					break;

				default:
					$section = str_replace("%20", " ", $method);

					$data['title'] = $section;

					$getSection = $this->db->query("SELECT * FROM sections WHERE sect_name = '$section' AND gr_level = 'Grade 10'");

					if($getSection->num_rows() == 1){
						foreach ($getSection->result_array() as $sect) {
							$data['section_name'] = $sect['sect_name'];
							$data['grade_level'] = $sect['gr_level'];
							$data['adviser'] = $sect['adviser'];
						}
						$this->load->model('users_model');

						$this->load->view('templates/header');
						$this->load->view('pages/admin/grade10/SectionsPreview', $data);
						$this->load->view('templates/footer');
					}
			}
		}else{
			redirect('/');
		}
	}
	//END | GRADE 10 SECTIONS

	################################################################################################################
	################################################################################################################

	//GRADE 11 SECTIONS
	public function Grade11($method){

		if($this->session->userdata('Home of the braves@2022:admin')){

			switch($method){
				case "List":
					$data['title'] = 'Grade 11';

					$this->load->model('users_model');
					
					$this->load->view('templates/header');
					$this->load->view('pages/admin/grade11', $data);
					$this->load->view('templates/footer');
					break;

				default:
					$section = str_replace("%20", " ", $method);

					$data['title'] = $section;

					$getSection = $this->db->query("SELECT * FROM sections WHERE sect_name = '$section' AND gr_level = 'Grade 11'");

					if($getSection->num_rows() == 1){
						foreach ($getSection->result_array() as $sect) {
							$data['section_name'] = $sect['sect_name'];
							$data['grade_level'] = $sect['gr_level'];
							$data['adviser'] = $sect['adviser'];
						}
						$this->load->model('users_model');

						$this->load->view('templates/header');
						$this->load->view('pages/admin/grade11/SectionsPreview', $data);
						$this->load->view('templates/footer');
					}
			}

		}else{
			redirect('/');
		}
	}
	//END | GRADE 11 SECTIONS

	################################################################################################################
	################################################################################################################

	//GRADE 12 SECTIONS
	public function Grade12($method){

		if($this->session->userdata('Home of the braves@2022:admin')){

			switch($method){
				case "List":
					$data['title'] = 'Grade 12';

					$this->load->model('users_model');
					
					$this->load->view('templates/header');
					$this->load->view('pages/admin/grade12', $data);
					$this->load->view('templates/footer');
					break;

				default:
					$section = str_replace("%20", " ", $method);

					$data['title'] = $section;

					$getSection = $this->db->query("SELECT * FROM sections WHERE sect_name = '$section' AND gr_level = 'Grade 12'");

					if($getSection->num_rows() == 1){
						foreach ($getSection->result_array() as $sect) {
							$data['section_name'] = $sect['sect_name'];
							$data['grade_level'] = $sect['gr_level'];
							$data['adviser'] = $sect['adviser'];
						}
						$this->load->model('users_model');

						$this->load->view('templates/header');
						$this->load->view('pages/admin/grade12/SectionsPreview', $data);
						$this->load->view('templates/footer');
					}
			}

		}else{
			redirect('/');
		}
	}
	//END | GRADE 12 SECTIONS
	################################################################################################################
	################################################################################################################
	################################################################################################################
	################################################################################################################

	################################################################################################################
	################################################################################################################
	################################################################################################################
	################################################################################################################
	//VIEW STUDENT PROFILE
	public function viewstudent($lrn, $gradelvl, $prevlink){
		if($this->session->userdata('Home of the braves@2022:admin')){

			$this->load->model('users_model');

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
					$data['photo'] = $info['photo'];
					$data['subj'] = $info['subjects'];
				}
				$data['prevlink'] = str_replace("%20", " ", $prevlink);

				$this->load->view('templates/header');
				$this->load->view('pages/admin/viewstudent', $data);
				$this->load->view('templates/footer');
			}else{
				redirect(base_url().'admin/dashboard');
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
	//TEACHERS
	public function teachers(){

		if($this->session->userdata('Home of the braves@2022:admin')){

			$data['title'] = 'Teachers';

			$this->load->model('users_model');
			
			$this->load->library('pagination');


			$data['base_url'] = base_url().'admin/teachers/';
			$data['per_page'] = 20;
			$data['total_rows'] = $this->db->get('teachers')->num_rows();
			//$data['num_links'] = 10;

			//Customizing pagination
			$data['full_tag_open'] = '<div class="w3-bar w3-border w3-padding w3-round">';
			$data['full_tag_close'] = '</div>';
			$data['next_link'] = '<span class="fa">&#xf105;</span>';
			$data['prev_link'] = '<span class="fa">&#xf104;</span>';
			$data['cur_tag_open'] = '<span class="w3-padding-left"><b>';
			$data['cur_tag_close'] = '</b></span>';
			$data['next_tag_open'] = '<span class="w3-padding-left">';
			$data['next_tag_close'] = '<span>';
			$data['num_tag_open'] = '<span class="w3-padding-left">';
			$data['num_tag_close'] = '<span>';
			$data['first_link'] = '<span class="fa w3-padding-right">&#xf100;</span>';
			$data['last_link'] = '<span class="fa w3-padding-left">&#xf101;</span>';


			$data['teachersRecord'] = $this->db->get('teachers', $data['per_page'], $this->uri->segment(3));

			$this->pagination->initialize($data);


			$this->load->view('templates/header');
			$this->load->view('pages/admin/teachers', $data);
			$this->load->view('templates/footer');

		}else{
			redirect('/');
		}
	}

	################################################################################################################
	################################################################################################################

	public function viewteacher($id){

		if($this->session->userdata('Home of the braves@2022:admin')){

			foreach($this->db->query("SELECT * FROM teachers WHERE id = '$id'")->result_array() as $info){
				
				$data['title'] = $info['fname']." ".$info['mname']." ".$info['lname'];
				$data['tid'] = $id;
				$data['fname'] = $info['fname'];
				$data['mname'] = $info['mname'];
				$data['lname'] = $info['lname'];
				$data['sex'] = $info['sex'];
				$data['email'] = $info['email'];
				$data['major'] = $info['major'];
				$data['Department'] = $info['Department'];
				$data['rank'] = $info['Rank'];
				$data['teach_load'] = $info['teach_load'];
				$data['photo'] = $info['photo'];
			}

			$this->load->model('users_model');
			
			$this->load->view('templates/header');
			$this->load->view('pages/admin/viewteacher', $data);
			$this->load->view('templates/footer');

		}else{
			redirect('/');
		}
	}

	################################################################################################################
	################################################################################################################

	//TEACHERS | ADD TEACHER
	public function addTeacher(){
		if($this->session->userdata('Home of the braves@2022:admin')){

			$lname = $_POST['lname'];
			$mname = $_POST['mname'];
			$fname = $_POST['fname'];
			$rank = $_POST['rank'];
			$email = $_POST['email'];
			$dept = $_POST['dept'];
			$id = $_POST['idnumber'];
			$major = $_POST['major'];
			$sex = $_POST['sex'];

			if($this->db->query("SELECT * FROM accounts WHERE ver_email = '$email'")->num_rows() == 1){
				$this->session->set_flashdata('error', 'Email cannot be duplicated.');
				header('location:'.base_url().'admin/teachers');

			}else{	
				if(isset($lname)&&isset($fname)&&isset($mname)&&isset($rank)&&isset($email)&&isset($dept)&&isset($id)&&isset($major)&&isset($sex)){
					$this->load->model('users_model');
					$this->load->library('email');

					//SENDING VERIFICATION EMAIL
					$token = md5($email).rand(10,9999);
					$key = md5($id);
					$message = "<!DOCTYPE html><html>
								<link rel='icon' href='".base_url()."'resource/img/logo.png'>
								<link rel='stylesheet' href='".base_url()."'resource/4w3.css'>
								<link rel='stylesheet' href='".base_url()."'resource/3w3.css'>
							<body>
								<div class='w3-container w3-card w3-round w3-padding w3-border' style='margin: auto; width: 80%'>
									<h3>HI USER!</h3><p>Please verify your email to complete your sign up.</p>
									<a href='".base_url()."Pages/verifyemail/".$key."/".$token."' class='w3-button w3-round w3-blue w3-hover-light-blue'>VERIFY EMAIL</a>
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

						$addGuro = $this->users_model->AddGuro($lname, $fname, $mname, $rank, $email, $id, $major, $dept, $sex);
						if(is_null($addGuro) != 1){

							$alpha = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890!@*";

							$password = substr(str_shuffle($alpha),0 ,10);
							$sessid = $this->encryption->encrypt($id);
							$sessid = str_replace("=", "_50_", str_replace("/", "_47_", $sessid));
							$this->db->query("INSERT INTO accounts VALUES('$id', '$password', '$dept', 'Inactive', 'offline', '$email', '$key', '$token', 'Pending', '$sessid')");


							$this->session->set_flashdata('added', 'Teacher was added successfully!');
							header('location:'.base_url().'admin/teachers');

						}else{

							$this->session->set_flashdata('error', 'Teacher already exists!');
							header('location:'.base_url().'admin/teachers');

						}

					}else{
						$this->session->set_flashdata('error', 'There was a problem while sending the verification email.');
						header('location:'.base_url().'admin/teachers');
					}
					
				}
			}

		}else{
			redirect('/');
		}
	}

	################################################################################################################
	################################################################################################################

	//TEACHERS | DELETE TEACHER
	public function deleteTeacher($id){
		if($this->session->userdata('Home of the braves@2022:admin')){

			$checkfromsubj = $this->db->query("SELECT * FROM subject_teacher WHERE subj_teacher = '$id'");
			$checkfromsect = $this->db->query("SELECT * FROM sections WHERE adviser = '$id'");

			if($checkfromsubj->num_rows() >= 1){
				foreach ($checkfromsubj->result_array() as $res) {
					$res['subj_code'];
					$res['gr_level'];
					$res['section'];
				}
				$table = str_replace(" ", "", str_replace("-", "_", $res['section'])).'_'.str_replace(" ", "", $res['gr_level']).'_'.$res['subj_code'];

				foreach ($this->db->query("SELECT * FROM subjects WHERE subj_code = '".$res['subj_code']."'")->result_array() as $subjtitle) {
					$subjtitle['subj_title'];
				}

					$content = $this->db->query("SELECT * FROM $table");
					if($content->num_rows() == 0){
						
						$this->db->query("DROP TABLE $table");

					}else{
						$dir = $subjtitle['subj_title'].'_'.str_replace(" ", "", $res['gr_level']).'_'.str_replace(" ", "", $res['section']);
								
						foreach ($content->result_array() as $got) {

							$filedir = $dir.str_replace(":", "-", str_replace("%20", " ", $got['lesson'])).'/';
									
							$module = explode(", ", $got['module']);
									
								for($i = 0; count($module) > $i; $i++){

									$file = str_replace(" ", "-", str_replace(":", "-", $module[$i]));
									unlink($filedir.$file); //FILE DELETION
									
								}
								rmdir($dir);
						}
					}

				$this->db->query("DELETE FROM subject_teacher WHERE subj_teacher = '$id'");

			}

		if($checkfromsect == 1){
			$this->db->query("UPDATE sections SET adviser = NULL WHERE adviser = '$id'");
		}

		$this->db->query("DELETE FROM teachers WHERE id = '$id'");
		$this->db->query("DELETE FROM accounts WHERE id = '$id'");

		header('location:'.base_url().'admin/teachers');

		}else{
			redirect('/');
		}
	}
	//TEACHERS | DELETE TEACHER | END

	################################################################################################################
	################################################################################################################

	//TEACHERS | UPDATE TEACHER
	public function UpdateTeacherInfo($id){
		if($this->session->userdata('Home of the braves@2022:admin')){

			$lname = $_POST['lname'];
			$mname = $_POST['mname'];
			$fname = $_POST['fname'];
			$rank = $_POST['rank'];
			$email = $_POST['email'];
			$dept = $_POST['dept'];
			//$id = $_POST['idnumber'];
			$major = $_POST['major'];
			$sex = $_POST['sex'];
			
			$this->db->query("UPDATE teachers SET fname = '$fname', mname = '$mname', lname = '$lname', sex = '$sex', email = '$email', major = '$major', Department = '$dept', Rank = '$rank' WHERE id = '$id'");
			$this->db->query("UPDATE accounts SET ver_email = '$email', ver_key = '".md5($email)."', ver_token = '".md5($email).rand(10,9999)."', role = '$dept' WHERE id = '$id'");

			//$this->db->query("UPDATE accounts SET role = '$dept' WHERE id = '$id'");

			header('location:'.base_url().'admin/teachers');

		}else{
			redirect('/');
		}
	}

	################################################################################################################
	################################################################################################################

	//ASSIGNING TEACHER TO A SUBJECT THEN CREATE ITS TABLE
	public function assignTeach(){
		if($this->session->userdata('Home of the braves@2022:admin')){
			$_POST['code'];
			$_POST['gr'];
			$_POST['sect'];
			$_POST['assigned']; //complete name of teacher
			$_POST['subj'];

			$haynako = explode(" ", $_POST['assigned']);
			
			$subjcode = $_POST['code'];
			$gr = str_replace(" ", "", $_POST['gr']);
			$sect = str_replace(" ", "", str_replace("-", "_", $_POST['sect']));
			$tbl = $sect."_".$gr."_".$subjcode;

			if($this->db->query("INSERT INTO subject_teacher VALUES('".$_POST['code']."', '".$_POST['gr']."', '".$_POST['sect']."', '".$haynako[0]."')")){

				if($this->db->query("SHOW TABLES LIKE '".$tbl."'")->num_rows() == 0){
					
					$this->db->query("CREATE TABLE ".$tbl." (lesson varchar(100), module TEXT, activity TEXT, quiz TEXT, addref TEXT)");
				
				}else{
					echo 'existing';
				}

				$this->db->query("UPDATE teachers SET teach_load = ".$haynako[1]."+1 WHERE id = '".$haynako[0]."'");
			}

			header('location:'.base_url().'admin/subjects/'.$_POST['code'].'');
		}else{
			redirect('/');
		}
	}

	################################################################################################################
	################################################################################################################

	//REMOVING TEACHERS FROM ITS ASSIGNED SUBJECT TOGETHER WITH ITS CREATED TABLE
	public function removeTeach($id, $code, $sect, $subj, $gr){
		if($this->session->userdata('Home of the braves@2022:admin')){

			$sect = str_replace("%20", " ", $sect);

			if($this->db->query("DELETE FROM subject_teacher WHERE subj_teacher = '$id' AND subj_code = $code AND section = '$sect'")){
				$load = $this->db->query("SELECT teach_load FROM teachers WHERE id = '$id'");
				foreach ($load->result_array() as $t_load) {
					$tload = $t_load['teach_load'];
				}
				
				$rdir = str_replace("%20", " ", str_replace(":", "-", $subj)).'_'.str_replace("%20", " ", $gr).'_'.str_replace("%20", " ", $sect).'/';
				$table = str_replace(" ", "", str_replace("%20", "", str_replace("-", "_", $sect))).'_'.str_replace("%20", "", $gr).'_'.$code;

				$this->db->query("UPDATE teachers SET teach_load = '$tload'-1 WHERE id = '$id'");

				//$gr = str_replace("%20", "", $gr);
				//$sect = str_replace(" ", "", str_replace("-", "_", $sect));
				//$tbl = $sect.'_'.$gr.'_'.$code;

				foreach ($this->db->query("SELECT * FROM $table")->result_array() as $got) {
					$lesson = $got['lesson'];

					$subdir = str_replace("%20", " ", str_replace(":", "-", $subj)).'_'.str_replace("%20", " ", $gr).'_'.str_replace("%20", " ", $sect).'/'.str_replace(":", "-", str_replace("%20", " ", $got['lesson'])).'/';
					$lesson = str_replace("%20", " ", $lesson);

					foreach ($this->db->query("SELECT * FROM $table WHERE lesson = '$lesson'")->result_array() as $got) {
						$mod = $got['module'];
						$act = $got['activity'];
						//FIX THIS WHEN DONE WITH QUIZ | REMOVE EVERYTHING INSIDE THE LESSON WHEN DELETED
					}

					//ACTIVITIES
					$activities = explode(", ", $act); //LIST OF ALL EXISTING ACTIVITIES
					
					for($a = 0; $a < count($activities); $a++){
						$actdir = str_replace(":", "-", $activities[$a]);

						//SUBMITTED ACTIVITY
						$querysubmittedact = $this->db->query("SELECT * FROM activities_submit WHERE subj_code = $code AND lesson_title = '$lesson' AND grade_level = '".str_replace("%20", " ", $gr)."' AND section = '$sect' AND activity_title = '".$activities[$a]."'");
						
						if($querysubmittedact->num_rows() != 0){
							foreach ($querysubmittedact->result_array() as $z) {
								$dirlrn = $z['lrn'];
								$dirfile = str_replace(" ", "-", str_replace(":", "-", $z['file_submitted']));
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
					$module = explode(", ", $mod);

					for($i = 0; count($module) > $i; $i++){
						$file = str_replace(" ", "-", str_replace(":", "-", $module[$i]));
						
						unlink($subdir.$file); //FILE DELETION
					}
					//MODULE | END
			
					rmdir($subdir);
					rmdir($rdir);
				}

				$this->db->query("DELETE FROM activities_submit WHERE subj_code = $code AND lesson_title = '$lesson' AND grade_level = '".str_replace("%20", " ", $gr)."' AND section = '$sect'");
				$this->db->query("DELETE FROM activities WHERE subj_code = $code AND lesson_title = '$lesson' AND grade_level = '".str_replace("%20", " ", $gr)."' AND section = '$sect'");
				

				$this->db->query("DELETE FROM quiz_submit WHERE subj_code = $code AND lesson_title = '$lesson' AND grade_level = '".str_replace("%20", " ", $gr)."' AND section = '$sect'");
				$this->db->query("DELETE FROM quiz WHERE subj_code = $code AND lesson_title = '$lesson' AND grade_level = '".str_replace("%20", " ", $gr)."' AND section = '$sect'");

				$this->db->query("DELETE FROM logs WHERE made_for = '".$code."_".str_replace("%20", " ", $gr)."_".str_replace("%20", " ", $sect)."'");

				$this->db->query("DROP TABLE $table");
			}

			header('location:'.base_url().'admin/subjects/'.$code.'');

		}else{
			redirect('/');
		}
	}

	################################################################################################################
	################################################################################################################

	public function assignAdviser($gr, $sect){
		if($this->session->userdata('Home of the braves@2022:admin')){

			$gr = str_replace("%20", " ", $gr);
			$sect = str_replace("%20", " ", $sect);

			$this->db->query("UPDATE sections SET adviser = '".$_POST['adviser']."' WHERE sect_name = '$sect' AND gr_level = '$gr'");

			$gr = str_replace(" ", "", $gr);
			$sec = str_replace(" ", "%20", $sect);

			header('location:'.base_url().'admin/'.$gr.'/'.$sec.'');

		}else{
			redirect('/');
		}
	}

	################################################################################################################
	################################################################################################################

	public function removeAdviser($id, $gr, $sect){
		if($this->session->userdata('Home of the braves@2022:admin')){

			$this->db->query("UPDATE sections SET adviser = NULL WHERE adviser = '$id'");

			$gr = str_replace("%20", "", $gr);
			$sec = str_replace(" ", "%20", $sect);

			echo $gr.$sec;
			header('location:'.base_url().'admin/'.$gr.'/'.$sec.'');

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
	public function subjects($param){

		if($this->session->userdata('Home of the braves@2022:admin')){

			switch ($param) {
				case 'overview':
					$data['title'] = 'Subjects';

					$this->load->model('users_model');
					
					$this->load->view('templates/header');
					$this->load->view('pages/admin/subjects', $data);
					$this->load->view('templates/footer');
					break;
				
				default:

					$subject = $this->db->query("SELECT * FROM subjects WHERE subj_code = $param");
					foreach ($subject->result_array() as $sinfo) {
						$data['title'] = $sinfo['subj_title'];
						$data['desc'] = $sinfo['subj_desc'];
						$data['gr'] = $sinfo['gr_level'];
						$data['code'] = $param;
					}

					$this->load->model('users_model');
					
					$this->load->view('templates/header');
					$this->load->view('pages/admin/viewsubject', $data);
					$this->load->view('templates/footer');

					break;
			}
				


		}else{
			redirect('/');
		}
	}

	################################################################################################################
	################################################################################################################

	//SUBJECTS | CREATE SUBJECT
	public function addSubject(){
		if($this->session->userdata('Home of the braves@2022:admin')){

			if(isset($_POST['gr_level'])&&isset($_POST['subj_title'])&&isset($_POST['subj_desc'])){
				//$pic = $_FILES['subj_pic'];
				$lvl = $_POST['gr_level'];
				$title = $_POST['subj_title'];
				$desc = $_POST['subj_desc'];

				$check = $this->db->query("SELECT * FROM subjects WHERE gr_level = '$lvl' AND subj_title = '$title'");
				if($check->num_rows() != 1){

					//$dir = 'application/views/pages/Subject_image/';
					$dir = 'Subject_image/';

					if(!is_dir($dir)){
						mkdir($dir);
					}

					$tmpfile=$_FILES["subj_pic"]["tmp_name"];
                    $fixfile=$_FILES["subj_pic"]["name"];	//Previous image name
                    $imagetype=$_FILES["subj_pic"]["type"];

                    if($imagetype=="image/jpeg" || $imagetype=="image/png" || $imagetype=="image/jpg"){
                    	$expname = explode(".", $fixfile);
                        $newfixfile= time().rand(1,99999).".".end($expname);

                        move_uploaded_file($tmpfile, $dir.$newfixfile);
                        
                        $insert = $this->db->query("INSERT INTO subjects VALUES('$title', '$newfixfile', '$desc', '$lvl', '')");
						if($insert){
							$this->session->set_flashdata('created', 'Subject created.');
							header('Location:'.base_url().'admin/subjects/overview');
						}else{
							header('Location:'.base_url().'admin/subjects/overview');
						}
                    }

				}else{
					$this->session->set_flashdata('error', 'Subject exists!');
					header('Location:'.base_url().'admin/subjects/overview');
				}
			}

		}else{
			redirect('/');
		}
	}

	################################################################################################################
	################################################################################################################

	//SUBJECTS | DELETE SUBJECT
	public function deleteSubject($subj_code){
		if($this->session->userdata('Home of the braves@2022:admin')){

			if($this->db->query("SHOW TABLES LIKE '%$subj_code%'")->num_rows() > 0){
				
				$this->session->set_flashdata('error', 'Please remove everything inside the subject before deleting.');
				header('Location:'.base_url().'admin/subjects/overview');

			}else{

				$this->db->query("DELETE FROM subjects WHERE subj_code = $subj_code");

				$chk = $this->db->query("SELECT subj_teacher FROM subject_teacher WHERE subj_code = $subj_code");
				if($chk->num_rows() >= 1){
					foreach ($chk->result_array() as $in) {
						$get = $this->db->query("SELECT teach_load FROM teachers WHERE id = '".$in['subj_teacher']."'");
						foreach ($get->result_array() as $load)

						$this->db->query("UPDATE teachers SET teach_load = ".$load['teach_load']."-1 WHERE id = '".$in['subj_teacher']."'");
					}
					$this->db->query("DELETE FROM subject_teacher WHERE subj_code = $subj_code");
				}

				$this->session->set_flashdata('created', 'Subject removed.');
				header('Location:'.base_url().'admin/subjects/overview');
			}

		}else{
			redirect('/');
		}
	}

	################################################################################################################
	################################################################################################################

	//ADDNG STUDENTS IN SUBJECT
	public function AddstudinSubj($code, $sect){
		//CODE FOR STUDENTS DATABASE IF THERE ARE EXISTING SUBJECTS
		if($this->session->userdata('Home of the braves@2022:admin')){

			if(isset($_POST['val'])&&isset($_POST['lvl'])){
				$stud = implode(", ", $_POST['val']);
				$count = explode(", ", $stud); //number and lrn of the students to be added
				$lvl = $_POST['lvl'];
				$section = str_replace("%20", " ", $sect);
				
				$query = $this->db->query("SELECT * FROM subject_students WHERE subj_code = $code AND gr_level = '$lvl' AND section = '$section'");
				
				if($query->num_rows() == 1){

					if(count($count) > 1){

						for ($i=0; $i < count($count); $i++) {
							if($lvl == "Grade 11" || $lvl == "Grade 12"){
								foreach ($this->db->query("SELECT * FROM shsstudents WHERE lrn = '".$count[$i]."' AND subjects NOT LIKE '%".$code."%'")->result_array() as $checksubjs) {
									$subj = $checksubjs['subjects'];
								}

								if(empty($checksubjs['subjects'])){
									$newsubjs = $code;

								}else{
									$subjs = array($subj, $code);
									$newsubjs = implode(", ", $subjs);
								}
								
								$this->db->query("UPDATE shsstudents SET subjects = '$newsubjs' WHERE lrn = '".$count[$i]."'");

							}else{
								foreach ($this->db->query("SELECT * FROM jhsstudents WHERE lrn = '".$count[$i]."' AND subjects NOT LIKE '%".$code."%'")->result_array() as $checksubjs) {
									$subj = $checksubjs['subjects'];
								}
								if(empty($checksubjs['subjects'])){
									$newsubjs = $code;

								}else{
									$subjs = array($subj, $code);
									$newsubjs = implode(", ", $subjs);
								}
								
								$this->db->query("UPDATE jhsstudents SET subjects = '$newsubjs' WHERE lrn = '".$count[$i]."'");
							}
							$subj = '';
						}

						foreach ($query->result_array() as $val) {
							$val['students'];
						}

						//TO ADD THE NEW VALUE TO THE EXISTING ENROLLED STUDENTS IN THE SUBJECT
						if(empty($val['students'])){
							$students = $stud;

						}else{
							$student = array($stud, $val['students']);
							$students = implode(", ", $student);
						}

						$this->db->query("UPDATE subject_students SET students = '$students' WHERE subj_code = $code AND gr_level = '$lvl' AND section = '$section'");
						//TO ADD THE NEW VALUE TO THE EXISTING ENROLLED STUDENTS IN THE SUBJECT | END

					}else{
						if($lvl == "Grade 11" || $lvl == "Grade 12"){
							foreach ($this->db->query("SELECT * FROM shsstudents WHERE lrn = '$stud' AND subjects NOT LIKE '%".$code."%'")->result_array() as $checksubjs) {
								$subj = $checksubjs['subjects'];
							}

								if(empty($checksubjs['subjects'])){
									$newsubjs = $code;

								}else{
									$subjs = array($subj, $code);
									$newsubjs = implode(", ", $subjs);
								}

							$this->db->query("UPDATE shsstudents SET subjects = '$newsubjs' WHERE lrn = '$stud'");

						}else{
							foreach ($this->db->query("SELECT * FROM jhsstudents WHERE lrn = '$stud'")->result_array() as $checksubjs) {
								$subj = $checksubjs['subjects'];
							}

							if(empty($checksubjs['subjects'])){
								$newsubjs = $code;

							}else{
								$subjs = array($subj, $code);
								$newsubjs = implode(", ", $subjs);
							}

							$this->db->query("UPDATE jhsstudents SET subjects = '$newsubjs' WHERE lrn = '$stud'");
						}

						foreach ($query->result_array() as $val) {
							$val['students'];
						}
						//TO ADD THE NEW VALUE TO THE EXISTING ENROLLED STUDENTS IN THE SUBJECT
						if(empty($val['students'])){
							$students = $stud;

						}else{
							$student = array($stud, $val['students']);
							$students = implode(", ", $student);
						}

						$this->db->query("UPDATE subject_students SET students = '$students' WHERE subj_code = $code AND gr_level = '$lvl' AND section = '$section'");
						//TO ADD THE NEW VALUE TO THE EXISTING ENROLLED STUDENTS IN THE SUBJECT | END
					}

					header('Location:'.base_url().'admin/subjects/'.$code);

				}else{
					
					if(count($count) > 1){

						for ($i=0; $i < count($count); $i++) {
							if($lvl == "Grade 11" || $lvl == "Grade 12"){
								foreach ($this->db->query("SELECT * FROM shsstudents WHERE lrn = '".$count[$i]."' AND subjects NOT LIKE '%".$code."%'")->result_array() as $checksubjs) {
									$subj = $checksubjs['subjects'];
								}

								if(empty($checksubjs['subjects'])){
									$newsubjs = $code;

								}else{
									$subjs = array($subj, $code);
									$newsubjs = implode(", ", $subjs);
								}
								$this->db->query("UPDATE shsstudents SET subjects = '$newsubjs' WHERE lrn = '".$count[$i]."'");

							}else{
								foreach ($this->db->query("SELECT * FROM jhsstudents WHERE lrn = '".$count[$i]."' AND subjects NOT LIKE '%".$code."%'")->result_array() as $checksubjs) {
									$subj = $checksubjs['subjects'];
								}

								if(empty($checksubjs['subjects'])){
									$newsubjs = $code;

								}else{
									$subjs = array($subj, $code);
									$newsubjs = implode(", ", $subjs);
								}
								$this->db->query("UPDATE jhsstudents SET subjects = '$newsubjs' WHERE lrn = '".$count[$i]."'");
							}
							$subj = '';
						}

					}else{
						if($lvl == "Grade 11" || $lvl == "Grade 12"){
							foreach ($this->db->query("SELECT * FROM shsstudents WHERE lrn = '$stud' AND subjects NOT LIKE '%".$code."%'")->result_array() as $checksubjs) {
								$subj = $checksubjs['subjects'];
							}

							if(empty($checksubjs['subjects'])){
								$newsubjs = $code;

							}else{
								$subjs = array($subj, $code);
								$newsubjs = implode(", ", $subjs);
							}

							$this->db->query("UPDATE shsstudents SET subjects = '$newsubjs' WHERE lrn = '$stud'");

						}else{
							foreach ($this->db->query("SELECT * FROM jhsstudents WHERE lrn = '$stud' AND subjects NOT LIKE '%".$code."%'")->result_array() as $checksubjs) {
								$subj = $checksubjs['subjects'];
							}

							if(empty($checksubjs['subjects'])){
								$newsubjs = $code;

							}else{
								$subjs = array($subj, $code);
								$newsubjs = implode(", ", $subjs);
							}

							$this->db->query("UPDATE jhsstudents SET subjects = '$newsubjs' WHERE lrn = '$stud'");
						}
					}
					//INSERT SUBJECT IF ITS NOT EXISTING
					$this->db->query("INSERT INTO subject_students VALUES($code, '$lvl', '$section', '$stud')");
					header('Location:'.base_url().'admin/subjects/'.$code);
				}
			}else{
				//header('Location:'.base_url().'admin/subjects/'.$code);
			}

		}else{
			redirect('/');
		}
	}

	################################################################################################################
	################################################################################################################

	public function DeletestudinSubj($code, $lrn, $gr, $sect){
		if($this->session->userdata('Home of the braves@2022:admin')){
			$grade = str_replace("%20", " ", $gr);
			$section = str_replace("%20", " ", $sect);
			
			if($grade == 'Grade 11' || $grade == 'Grade 12'){
				foreach($this->db->query("SELECT * FROM shsstudents WHERE lrn = '$lrn'")->result_array() as $in){
					$subjects = $in['subjects'];

					$subj = explode(", ", $subjects);
					for ($a=0; $a < count($subj); $a++) { 
						if($subj[$a] == $code){
							unset($subj[$a]);
						}
					}
					$newsubjs = implode(", ", $subj);
					$this->db->query("UPDATE shsstudents SET subjects = '$newsubjs' WHERE lrn = '$lrn'");


					foreach ($this->db->query("SELECT * FROM subject_students WHERE subj_code = $code AND gr_level = '$grade' AND section = '$section'")->result_array() as $en) {
						$students = $en['students'];

						$stud = explode(", ", $students);
						for ($b=0; $b < count($stud); $b++) { 
							if($stud[$b] == $lrn){
								unset($stud[$b]);
							}
						}
						$newstudensts = implode(", ", $stud);
						$this->db->query("UPDATE subject_students SET students = '$newstudensts' WHERE subj_code = $code AND gr_level = '$grade' AND section = '$section'");
					}
				}

			}else{
				foreach($this->db->query("SELECT * FROM jhsstudents WHERE lrn = '$lrn'")->result_array() as $in){
					$subjects = $in['subjects'];

					$subj = explode(", ", $subjects);
					for ($a=0; $a < count($subj); $a++) { 
						if($subj[$a] == $code){
							unset($subj[$a]);
						}
					}
					$newsubjs = implode(", ", $subj);
					$this->db->query("UPDATE jhsstudents SET subjects = '$newsubjs' WHERE lrn = '$lrn'");
				}


				foreach ($this->db->query("SELECT * FROM subject_students WHERE subj_code = $code AND gr_level = '$grade' AND section = '$section'")->result_array() as $en) {
					$students = $en['students'];

					$stud = explode(", ", $students);
					for ($b=0; $b < count($stud); $b++) { 
						if($stud[$b] == $lrn){
							unset($stud[$b]);
						}
					}
					$newstudensts = implode(", ", $stud);
					$this->db->query("UPDATE subject_students SET students = '$newstudensts' WHERE subj_code = $code AND gr_level = '$grade' AND section = '$section'");
				}
			}
			header('Location:'.base_url().'admin/subjects/'.$code);

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
	//ENROLLED STUDENTS | SHOW ENROLLED
	public function enrolledstudents(){

		if($this->session->userdata('Home of the braves@2022:admin')){

			$data['title'] = 'Enrolled Students';

			$this->load->model('users_model');


			$this->load->library('pagination');

			$a = $this->db->get('shsstudents')->num_rows();
			$b = $this->db->get('jhsstudents')->num_rows();
			
			$data['base_url'] = base_url().'admin/enrolledstudents/';
			$data['per_page'] = 20;
			$data['total_rows'] = ($a + $b) - $data['per_page'];
			//$data['num_links'] = 10;

			if($data['total_rows'] <= 0){
				$data['next_link'] = '';
				$data['prev_link'] = '';
			}else{
				$data['full_tag_open'] = '<div class="w3-bar w3-border w3-padding w3-round">';
				$data['full_tag_close'] = '</div>';
				$data['next_link'] = '<span class="fa">&#xf105;</span>';
				$data['prev_link'] = '<span class="fa">&#xf104;</span>';
			}

			//Customizing pagination
			/*$data['full_tag_open'] = '<div class="w3-bar w3-border w3-padding w3-round">';
			$data['full_tag_close'] = '</div>';
			$data['next_link'] = '<span class="fa">&#xf105;</span>';
			$data['prev_link'] = '<span class="fa">&#xf104;</span>';*/
			$data['cur_tag_open'] = '<span class="w3-padding-left"><b>';
			$data['cur_tag_close'] = '</b></span>';
			$data['next_tag_open'] = '<span class="w3-padding-left">';
			$data['next_tag_close'] = '<span>';
			$data['num_tag_open'] = '<span class="w3-padding-left">';
			$data['num_tag_close'] = '<span>';
			$data['first_link'] = '<span class="fa w3-padding-right">&#xf100;</span>';
			$data['last_link'] = '<span class="fa w3-padding-left">&#xf101;</span>';


			$data['recordSHS'] = $this->db->get('shsstudents', $data['per_page'], $this->uri->segment(3));
			$data['recordJHS'] = $this->db->get('jhsstudents', $data['per_page'], $this->uri->segment(3));

			$this->pagination->initialize($data);

			$this->load->view('templates/header');
			$this->load->view('pages/admin/enrolledstudents', $data);
			$this->load->view('templates/footer');

		}else{
			redirect('/');
		}
	}

	################################################################################################################
	################################################################################################################

	//ENROLLED STUDENTS | DELETE STUDENT PROCESS
	public function deleteStudent($lrn, $gradelvl){
		if($this->session->userdata('Home of the braves@2022:admin')){

			$grade = str_replace("%20", " ", $gradelvl);

			if($grade == "Grade 11" || $grade == "Grade 12"){
				$this->db->query("DELETE FROM shsstudents WHERE lrn = '$lrn' AND grade_level = '$grade'");
				$this->db->query("DELETE FROM accounts WHERE id = '$lrn'");
				header('location:'.base_url().'admin/enrolledstudents');
			}else{
				$this->db->query("DELETE FROM jhsstudents WHERE lrn = '$lrn' AND grade_level = '$grade'");
				$this->db->query("DELETE FROM accounts WHERE id = '$lrn'");
				header('location:'.base_url().'admin/enrolledstudents');
			}

		}else{
			redirect('/');
		}
	}

	################################################################################################################
	################################################################################################################

	//ENROLLED STUDENTS | UPDATE STUDENT PROCESS
	public function UpdateStudentInfo($gradelvl){
		if($this->session->userdata('Home of the braves@2022:admin')){

			$lname = $_POST['lname'];
			$mname = $_POST['mname'];
			$fname = $_POST['fname'];
			$bday = $_POST['bday'];
			$lrn = $_POST['lrn'];
			$email = $_POST['email'];
			$address = $_POST['address'];
			$sex = $_POST['sex'];

			$grade = str_replace("%20", " ", $gradelvl);

			//UPDATING SHS STUDENT
			if($grade == "Grade 11" || $grade == "Grade 12"){
				if($grade == "Grade 11"){
					$track11 = $_POST['track11'];
					if($track11 != ''){
						$stat = 'Enrolled';
					}else{
						$stat = 'Queued';
					}
					$this->db->query("UPDATE shsstudents SET fname = '$fname', mname = '$mname', lname = '$lname', sex = '$sex', Birthdate = '$bday', section = '$track11', email = '$email', address = '$address', status = '$stat' WHERE lrn = '$lrn'");
					$this->db->query("UPDATE accounts SET ver_email = '$email', ver_key = '".md5($email)."', ver_token = '".md5($email).rand(10,9999)."' WHERE id = '$lrn'");

					header('location:'.base_url().'admin/enrolledstudents');
				}else{
					$track12 = $_POST['track12'];
					if($track12 != ''){
						$stat = 'Enrolled';
					}else{
						$stat = 'Queued';
					}
					$this->db->query("UPDATE shsstudents SET fname = '$fname', mname = '$mname', lname = '$lname', sex = '$sex', Birthdate = '$bday', section = '$track12', email = '$email', address = '$address', status = '$stat' WHERE lrn = '$lrn'");
					$this->db->query("UPDATE accounts SET ver_email = '$email', ver_key = '".md5($email)."', ver_token = '".md5($email).rand(10,9999)."' WHERE id = '$lrn'");

					header('location:'.base_url().'admin/enrolledstudents');
				}
				
			//UPDATING JHS STUDENT
			}else{

				switch ($grade) {
					case 'Grade 7':
						$sect = $_POST['seven'];
						break;
					
					case 'Grade 8':
						$sect = $_POST['eight'];
						break;

					case 'Grade 9':
						$sect = $_POST['nine'];
						break;

					case 'Grade 10':
						$sect = $_POST['ten'];
						break;
				}
				if($sect != ''){
					$stat = 'Enrolled';
				}else{
					$stat = 'Queued';
				}
				$this->db->query("UPDATE jhsstudents SET lrn = '$lrn', fname = '$fname', mname = '$mname', lname = '$lname', sex = '$sex', Birthdate = '$bday', section = '$sect', email = '$email', address = '$address', status = '$stat' WHERE lrn = '$lrn' AND grade_level = '$grade'");
				$this->db->query("UPDATE accounts SET ver_email = '$email', ver_key = '".md5($email)."', ver_token = '".md5($email).rand(10,9999)."' WHERE id = '$lrn'");

				header('location:'.base_url().'admin/enrolledstudents');
			}

		}else{
			redirect('/');
		}
	}

	################################################################################################################
	################################################################################################################

	//ENROLLED STUDENTS | ADD STUDENT PROCESS
	public function addstud(){
		if($this->session->userdata('Home of the braves@2022:admin')){

			$this->load->library('email');
			$this->load->model('users_model');

			$lname = $_POST['lname'];
			$mname = $_POST['mname'];
			$fname = $_POST['fname'];
			$bday = $_POST['bday'];
			$email = $_POST['email'];
			$lrn = $_POST['lrn'];
			$address = $_POST['address'];
			$sex = $_POST['sex'];
			$grlevel = $_POST['grlevel'];

			if($this->db->query("SELECT * FROM accounts WHERE ver_email = '$email'")->num_rows() == 1){
				
				$this->session->set_flashdata('error', 'Email cannot be duplicated.');
				header('location:'.base_url().'admin/enrolledstudents/');
			
			}else{
				if(isset($lname)&&isset($fname)&&isset($lrn)&&isset($grlevel)){

					//ADDING SHS STUDENT PROCESS
					if($grlevel == 'Grade 11' || $grlevel == 'Grade 12'){
						
						$track11 = $_POST['track11'];
						$track12 = $_POST['track12'];

						//SENDING VERIFICATION EMAIL
						$token = md5($email).rand(10,9999);
						$key = md5($lrn);
						$message = "<!DOCTYPE html><html>
							<head>
								<link rel='icon' href='".base_url()."'resource/img/logo.png'>
								<link rel='stylesheet' href='".base_url()."'resource/4w3.css'>
								<link rel='stylesheet' href='".base_url()."'resource/3w3.css'>
							</head>
							<body>
								<div class='w3-container w3-card w3-round w3-padding w3-border' style='margin: auto; width: 80%'>
									<h3>HI USER!</h3><p>Please verify your email address to complete your sign up.</p>
									<a href='".base_url()."Pages/verifyemail/".$key."/".$token."' class='w3-button w3-round w3-blue w3-hover-light-blue'>VERIFY EMAIL</a>
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

							$add = $this->users_model->addSHSStudent($lname, $mname, $fname, $bday, $email, $lrn, $address, $sex, $grlevel, $track11, $track12);
							if($add){
								//generate password
								$alpha = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890!@*";

								$password = substr(str_shuffle($alpha),0 ,10);
								$sessid = $this->encryption->encrypt($lrn);
								$sessid = str_replace("=", "_50_", str_replace("/", "_47_", $sessid));
								
								$this->db->query("INSERT INTO accounts VALUES('$lrn', '$password', 'SHSstudent', 'Inactive', 'offline', '$email', '$key', '$token', 'Pending', '$sessid')");

								$this->session->set_flashdata('added','Student was added successfully!');
								header('location:'.base_url().'admin/enrolledstudents');

							}else{

								$this->session->set_flashdata('error','Student already exists!');
								header('location:'.base_url().'admin/enrolledstudents');

							}
							
							
						}else{

							$this->session->set_flashdata('error','Unexpected error while sending verification email.');
							header('location:'.base_url().'admin/enrolledstudents');

						}

						
					}
					//ADDING SHS STUDENT PROCESS | END

					//ADDING JHS STUDENT PROCESS
					else{
						$s7 = $_POST['seven'];
						$s8 = $_POST['eight'];
						$s9 = $_POST['nine'];
						$s10 = $_POST['ten'];


						//SENDING VERIFICATION EMAIL
						$token = md5($email).rand(10,9999);
						$key = md5($lrn);
						$message = "<!DOCTYPE html><html>
							<head>
								<link rel='icon' href='".base_url()."'resource/img/logo.png'>
								<link rel='stylesheet' href='".base_url()."'resource/4w3.css'>
								<link rel='stylesheet' href='".base_url()."'resource/3w3.css'>
							</head>
							<body>
								<div class='w3-container w3-card w3-round w3-padding w3-border' style='margin: auto; width: 80%'>
									<h3>HI USER!</h3><p>Please verify your email address to complete your sign up.</p>
									<a href='".base_url()."Pages/verifyemail/".$key."/".$token."' class='w3-button w3-round w3-blue w3-hover-light-blue'>VERIFY EMAIL</a>
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
							
							$add = $this->users_model->addJHSStudent($lname, $mname, $fname, $bday, $email, $lrn, $address, $sex, $grlevel, $s7, $s8, $s9, $s10);

							if($add){
								//generate password
								$alpha = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890!@*";

								$password = substr(str_shuffle($alpha),0 ,10);
								$sessid = $this->encryption->encrypt($lrn);
								$sessid = str_replace("=", "_50_", str_replace("/", "_47_", $sessid));
								
								$this->db->query("INSERT INTO accounts VALUES('$lrn', '$password', 'JHSstudent', 'Inactive', 'offline', '$email', '$key', '$token', 'Pending', '$sessid')");


								$this->session->set_flashdata('added','Student was added successfully!');
								header('location:'.base_url().'admin/enrolledstudents');
							}else{

								$this->session->set_flashdata('error','Student already exists!');
								header('location:'.base_url().'admin/enrolledstudents');

							}
						}else{

							$this->session->set_flashdata('error','Unexpected error while sending verification email.');
							header('location:'.base_url().'admin/enrolledstudents');

						}
					}
					//ADDING JHS STUDENT PROCESS | END
				}
			}

		}else{
			redirect('/');
		}
	}

	################################################################################################################
	################################################################################################################

	//ENROLLED STUDENTS | SEARCH STUDENT
	public function searchStud(){
		if($this->session->userdata('Home of the braves@2022:admin')){

			$lname = $_POST['lastname'];

			
			$shoutjhs = $this->db->query("SELECT * FROM jhsstudents WHERE lname = '$lname'");
			$shoutshs = $this->db->query("SELECT * FROM shsstudents WHERE lname = '$lname'");

			if($shoutjhs->num_rows() >= 1 && $shoutshs->num_rows() >= 1){

				$this->session->set_flashdata('JHS', $shoutjhs->result_array());
				$this->session->set_flashdata('SHS', $shoutshs->result_array());
				header('location:'.base_url().'admin/enrolledstudents/');
			
			}
			elseif ($shoutshs->num_rows() >= 1) {
				
				$this->session->set_flashdata('SHS', $shoutshs->result_array());
				header('location:'.base_url().'admin/enrolledstudents/');


			}elseif($shoutjhs->num_rows() >= 1){

				$this->session->set_flashdata('JHS', $shoutjhs->result_array());
				header('location:'.base_url().'admin/enrolledstudents/');

			}
			else{
				$this->session->set_flashdata('none', 'No matches!');
				header('location:'.base_url().'admin/enrolledstudents/');
			}

		}else{
			redirect('/');
		}
	}

	################################################################################################################
	################################################################################################################

	//DROP STUDENT
	public function DropStudent($lrn, $gr){
		if($this->session->userdata('Home of the braves@2022:admin')){

			$this->load->model('users_model');
			$gr = str_replace("%20", " ", $gr);

			if($gr == 'Grade 11' || $gr == 'Grade 12'){
				$res = $this->db->query("SELECT grade_level, section FROM shsstudents WHERE lrn = $lrn");
			}else{
				$res = $this->db->query("SELECT grade_level, section FROM jhsstudents WHERE lrn = $lrn");
			}

			foreach ($res->result_array() as $result) {
				$sect = $result['section'];
				//$gr = $result['grade_level'];
			}

			$drop = $this->users_model->DropStudent($lrn, $gr);

			if($drop){
				$this->db->query("UPDATE accounts SET account_status = 'Dropped' WHERE id = '$lrn'");
				header('location:'.base_url().'admin/'.str_replace(' ', '', $gr).'/'.str_replace(' ', '%20', $sect).'');
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
	public function concerns(){
		
		if($this->session->userdata('Home of the braves@2022:admin')){

			$data['title'] = 'Concerns';

			$this->load->model('users_model');
			
			$this->load->view('templates/header');
			$this->load->view('pages/admin/concerns', $data);
			$this->load->view('templates/footer');

		}else{
			redirect('/');
		}

	}

	################################################################################################################
	################################################################################################################

	//POSTING PROCESS
	public function postconcern(){
		
		if($this->session->userdata('Home of the braves@2022:admin')){
			date_default_timezone_set('Asia/Manila');

			$rec = $_POST['rec'];
			$concern = $_POST['concern'];
			$desc = $_POST['desc'];
			$date = date('Y-m-d H:i A');

			if($rec != 'Administrator'){

				$this->db->query("INSERT INTO concerns VALUES('', '$concern', '$desc', '$date', 'Administrator', '$rec', 'pending')");
				$this->session->set_flashdata('success', 'Posted successfully');
				header('Location:'.base_url().'Admin/concerns/');

			}else{
				$this->session->set_flashdata('error', 'Error in posting!');
				header('Location:'.base_url().'Admin/concerns/');
			}

		}else{
			redirect('/');
		}

	}

	################################################################################################################
	################################################################################################################

	public function concernssent(){

		$query = $this->db->query("SELECT * FROM concerns WHERE sender = 'Administrator' ORDER BY date DESC");
			
		if($query->num_rows() != 0){
			foreach ($query->result_array() as $i) {

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
				

				//CANCEL BUTTON
				if($i['status'] == 'pending'){
					$rem = '<input type="submit" value="Cancel" name="button" class="w3-button w3-small w3-red w3-round w3-hover-pale-red">';
				}else{
					$rem = '';
				}
				//CANCEL BUTTON | END

				/*if($i['status'] == 'pending' && $i['receiver'] == 'Administrator'){
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
					echo '
						</div>
						<div class="w3-rest">
							<form action="'.base_url().'Admin/viewedconcern/'.$i['c_id'].'" method="post">
							'.$name.' | <span class="w3-badge w3-round '.$stat.'">'.$i['status'].'</span> '.$rem.'<br/>
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

	public function concernspending(){

		$query = $this->db->query("SELECT * FROM concerns WHERE receiver = 'Administrator' AND status = 'pending' ORDER BY date DESC");
			
		if($query->num_rows() != 0){
			foreach ($query->result_array() as $i) {

				
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
				

				$stat = 'w3-red';
				$button = '<input type="submit" value="click here if resolved" name="button" class="w3-button w3-small w3-round w3-blue w3-hover-light-blue"> | <input type="submit" value="Decline" name="button" class="w3-button w3-small w3-round w3-red w3-hover-pale-red">';
				

				echo '<div class="w3-row w3-border w3-padding w3-margin-bottom w3-margin-top w3-white">
						<div class="w3-col w3-margin-right" style="width:4em">';
							echo $img;
					echo '
						</div>
						<div class="w3-rest">
							<form action="'.base_url().'Admin/viewedconcern/'.$i['c_id'].'" method="post">
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

	public function concernsdeclined(){

		$query = $this->db->query("SELECT * FROM concerns WHERE receiver = 'Administrator' AND status = 'declined' ORDER BY date DESC");
			
		if($query->num_rows() != 0){
			foreach ($query->result_array() as $i) {

				
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
				

				echo '<div class="w3-row w3-border w3-padding w3-margin-bottom w3-margin-top w3-white">
						<div class="w3-col w3-margin-right" style="width:4em">';
							echo $img;
					echo '
						</div>
						<div class="w3-rest">
							<form action="'.base_url().'Admin/viewedconcern/'.$i['c_id'].'" method="post">
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

	public function concernsresolved(){

		$query = $this->db->query("SELECT * FROM concerns WHERE receiver = 'Administrator' AND status = 'resolved' ORDER BY date DESC");
			
		if($query->num_rows() != 0){
			foreach ($query->result_array() as $i) {

				
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
				

				echo '<div class="w3-row w3-border w3-padding w3-margin-bottom w3-margin-top w3-white">
						<div class="w3-col w3-margin-right" style="width:4em">';
							echo $img;
					echo '
						</div>
						<div class="w3-rest">
							<form action="'.base_url().'Admin/viewedconcern/'.$i['c_id'].'" method="post">
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

	public function viewedconcern($cid){
		if($this->session->userdata('Home of the braves@2022:admin')){

			if(isset($_POST['button'])){
				if($_POST['button'] == 'Cancel'){
					$this->db->query("DELETE FROM concerns WHERE c_id = $cid");

					$this->session->set_flashdata('success', 'Concern has been cancelled.');
					header('Location:'.base_url().'Admin/concerns/');
				
				}else if($_POST['button'] == 'click here if resolved'){
					$this->db->query("UPDATE concerns SET status = 'resolved' WHERE c_id = $cid");

					$this->session->set_flashdata('success', 'Concern has been resolved.');
					header('Location:'.base_url().'Admin/concerns/');

				}else if($_POST['button'] == 'Decline'){
					$this->db->query("UPDATE concerns SET status = 'declined' WHERE c_id = $cid");

					$this->session->set_flashdata('success', 'Declined.');
					header('Location:'.base_url().'Admin/concerns/');

				}else{
					$this->session->set_flashdata('error', 'Unexpected error.');
					header('Location:'.base_url().'Admin/concerns/');
				}
			}else{
				header('Location:'.base_url().'Admin/concerns/');
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
	//ANNOUNCEMENT PAGE
	public function announcement(){

		if($this->session->userdata('Home of the braves@2022:admin')){

			$data['title'] = 'Announcements';

			$this->load->model('users_model');
			
			$this->load->view('templates/header');
			$this->load->view('pages/admin/announcement', $data);
			$this->load->view('templates/footer');

		}else{
			redirect('/');
		}
	}

	################################################################################################################
	################################################################################################################

	//ANNOUNCEMENT PAGE | ANNOUNCEMENT UPLOADING PROCESS
	public function uploadPost(){
		if($this->session->userdata('Home of the braves@2022:admin')){

	    	$description = htmlspecialchars($_POST['description']);
	    	$title = htmlspecialchars($_POST['title']);

			if(isset($_POST['start_date'])&&isset($_POST['end_date'])&&isset($description)&&isset($title)&&isset($_POST['val'])){
				$strdate = $_POST['start_date'];
				$enddate = $_POST['end_date'];

				$user_info = $this->session->userdata('Home of the braves@2022:admin');
				extract($user_info); 

				if($strdate <= $enddate){
					$rec = implode(', ', $_POST['val']); //adding comma for multiple receipients

					$this->load->model('users_model');
					$post = $this->users_model->postAnnounce($strdate, $enddate, $rec, $description, $title, $role, $id);

					if($post){
						$this->session->set_flashdata('uploaded','Uploaded successfully!');
						redirect(''.base_url().'admin/announcement');
					}
				}else{
					$this->session->set_flashdata('error','Error in posting!');
					header('location:'.base_url().'admin/announcement');
				}
			}else{
				$this->session->set_flashdata('error','Incomplete inputs!');
				header('location:'.base_url().'admin/announcement');
			}

		}else{
			redirect('/');
		}
	}

	################################################################################################################
	################################################################################################################

	//ANNOUNCEMENT PAGE | DELETE POST
	public function deletePost($id){
		if($this->session->userdata('Home of the braves@2022:admin')){

			$this->load->model('users_model');

			$post = $this->users_model->deletepost($id);
			if($post){
				$this->session->set_flashdata('uploaded','Successfully removed!');
				header('location:'.base_url().'admin/announcement');
			}else{
				$this->session->set_flashdata('error','Error in Deleting announcement!');
				header('location:'.base_url().'admin/announcement');
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
	//EVENT PAGE
	public function events(){

		if($this->session->userdata('Home of the braves@2022:admin')){

			$data['title'] = 'Events';

			$this->load->model('users_model');
			
			$this->load->view('templates/header');
			$this->load->view('pages/admin/events', $data);
			$this->load->view('templates/footer');

		}else{
			redirect('/');
		}
	}

	################################################################################################################
	################################################################################################################

	//EVENT PAGE | DELETE EVENT
	public function deleteEvents($description){
		if($this->session->userdata('Home of the braves@2022:admin')){

			$exec = $this->db->query("DELETE FROM events WHERE description = '$description'");

			if($exec){
				header('location:'.base_url().'admin/events');
			}

		}else{
			redirect('/');
		}
	}

	################################################################################################################
	################################################################################################################

	//EVENT PAGE | CREATE EVENT
	public function createEvent(){
		if($this->session->userdata('Home of the braves@2022:admin')){

			$str = $_POST['start_date'];
			$end = $_POST['end_date'];
			$desc = $_POST['description'];

			if($str <= $end){
				$this->db->query("INSERT INTO events VALUES('$desc', '$str', '$end')");
				$this->session->set_flashdata('uploaded', 'Created successfully!');
				header('location:'.base_url().'admin/events');
			}else{
				$this->session->set_flashdata('error', 'Error in uploading!');
				header('location:'.base_url().'admin/events');
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
	//EDIT CREDENTIALS
	public function editcredentials(){

		if($this->session->userdata('Home of the braves@2022:admin')){

			$data['title'] = 'Edit Credentials';

			$this->load->model('users_model');
			
			//extract($this->session->userdata('Home of the braves@2022:admin'));
			
			$this->load->view('templates/header');
			$this->load->view('pages/admin/editcredentials', $data);
			$this->load->view('templates/footer');

		}else{
			redirect('/');
		}
	}

	################################################################################################################
	################################################################################################################

	//FOR PASSWORD CHANGE
	public function confirmpassword(){

		if($this->session->userdata('Home of the braves@2022:admin')){

			$pw = $_POST['password'];
			$id = $_POST['id'];

			if($this->db->query("SELECT * FROM accounts WHERE id = $id AND password = '$pw'")->num_rows() == 1){
				$this->session->set_flashdata('confirmed', 'Account confirmed! You may now edit your log in credentials.');
				header('location:'.base_url().'admin/editcredentials');
			}else{
				header('location:'.base_url().'admin/dashboard');
			}

		}else{
			redirect('/');
		}
	}

	################################################################################################################
	################################################################################################################
	//FOR ADMIN
	public function sendemail(){
		
		if($this->session->userdata('Home of the braves@2022:admin')){

			$this->load->library('email');
			
			$email = $_POST['email'];
			$idnum = $_POST['idNum'];
			$previd = $_POST['prevId'];
			$pass = $_POST['password'];
			
			
			/*$config['protocol']	= 'smtp';
			$config['smtp_host'] = 'ssl://smtp.gmail.com';
			$config['smtp_port'] = '465';
			$config['smtp_timeout'] = '30';

			$config['smtp_user'] = 'babasachristian26@gmail.com';
			$config['smtp_pass'] = 'ulsuoetqkjqsmzth';

			$config['charset'] = 'utf-8';
			$config['newline'] = '\r\n';
			$config['mailtype'] = 'html';
			//$config['mailpath'] = '/usr/sbin/sendmail';
			$config['validation'] = TRUE;
			//$config['wordwrap'] = TRUE;*/

			$token = md5($email).rand(10,9999);
			$key = md5($email);
			$message = "<!DOCTYPE html><html>
							<link rel='icon' href='".base_url()."'resource/img/logo.png'>
							<link rel='stylesheet' href='".base_url()."'resource/4w3.css'>
							<link rel='stylesheet' href='".base_url()."'resource/3w3.css'>
						<body>
							<div class='w3-container w3-card w3-round w3-padding' style='margin: auto; width: 80%'>
								<h3>Hi Admin!</h3><p>To complete editing your credentials please verify your email:</p>
								<a href='".base_url()."Pages/verifyemail/".$key."/".$token."' class='w3-button w3-round w3-blue w3-hover-light-blue'>VERIFY EMAIL</a>
								<p>Thanks!</p>
							</div>
						</body></html>";
			$config['mailtype'] = 'html';
			$this->email->initialize($config);
			
			//$this->email->initialize($config);
			//$this->email->initialize($config);
			//$this->email->from('302257@deped.gov.ph', 'Banquerohan National High School');
			$this->email->from('babasachristian26@gmail.com', 'Banquerohan National High School');
			$this->email->to($email);
			$this->email->subject("Email verification");
			//$this->email->message("Hi Admin, \nPlease click the on the below URL to verify your account.\n\n".base_url()."Pages/verifyemail/".$key."/".$token."\n\nThanks!");
			$this->email->message($message);


			if($idnum == $previd){
				if($this->email->send()){
					echo 'Email sent';
					$this->db->query("UPDATE accounts SET id = '$idnum', password = '$pass', account_status = 'Inactive', ver_email = '$email', ver_key = '$key', ver_token = '$token', ver_status = 'Pending' WHERE id = '$previd'");
					header('Refresh:1;url='.base_url().'admin/logout');

				}else{
					echo 'Sending failed';
					header('Refresh:1;url='.base_url().'admin/editcredentials');
				}

			}else{

				if($this->db->query("SELECT * FROM accounts WHERE id = '$idnum'")->num_rows() == 1){
					echo 'Please double check your Employee number.';
					header('Refresh:1;url='.base_url().'admin/editcredentials');

				}else{
					if($this->email->send()){
						echo 'Email sent';
						$sessid = $this->encryption->encrypt($idnum);

						$this->db->query("UPDATE accounts SET id = '$idnum', password = '$pass', account_status = 'Inactive', ver_email = '$email', ver_key = '$key', ver_token = '$token', ver_status = 'Pending', sess_id = '$sessid' WHERE id = '$previd'");
						header('Refresh:1;url='.base_url().'admin/logout');

					}else{
						echo 'Sending failed';
						header('Refresh:1;url='.base_url().'admin/editcredentials');
					}
				}
			}


			/**/
			
			/*if(mail($email, "Trial", "Hi!\n\nThis is a sample email.\n\nhttps://BanquerohanNationalHighSchool/verify\n" , "From: Tester")){
				echo 'sent';
				header('Refresh:1;url=editcredentials');
			}else{
				echo 'failed';
				header('Refresh:1;url=editcredentials');
			}*/

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
	public function logout(){
		
		$this->load->library('session');
		extract($this->session->userdata('Home of the braves@2022:admin'));

		$this->db->query("UPDATE accounts SET status = 'offline' WHERE id = '$id'");

		$this->session->unset_userdata('Home of the braves@2022:admin');
		
		redirect('/');
	}
}
?>