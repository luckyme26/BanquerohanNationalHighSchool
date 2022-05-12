<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	class Users_model extends CI_Model {
		/*function __construct(){
			parent::__construct();
			//$this->load->database();
		}*/
 

		//CHECKING USER IF EXISTING
		public function login($id, $password){

			$query = $this->db->query("SELECT * FROM accounts WHERE id = '$id' AND password = '$password' AND account_status = 'Active'");
			return $query->row_array();
		}

		//FOR ADMIN
		public function verifyAdmin($key, $token){
			
			$query = $this->db->query("SELECT * FROM accounts WHERE ver_key = '$key' AND ver_token = '$token'");
			return $query->row_array();

		}

		####################################################################################################
		####################################################################################################
		####################################################################################################
		####################################################################################################
		//SCHOOL STATS | DASHBOARD PAGE
		public function countexist($dept){
			switch ($dept) {
			case 'Junior High School Teacher':
				echo '<span class="w3-right"><h1>'.$this->db->query("SELECT * FROM teachers WHERE Department = '$dept'")->num_rows().'</h1></span>';
				break;
				
			case 'Senior High School Teacher':
				echo '<span class="w3-right"><h1>'.$this->db->query("SELECT * FROM teachers WHERE Department = '$dept'")->num_rows().'</h1></span>';
				break;

			case 'Junior High School Student':
				echo '<span class="w3-right"><h1>'.$this->db->query("SELECT * FROM jhsstudents WHERE status = 'Enrolled'")->num_rows().'</h1></span>';
				break;

			case 'Senior High School Student':
				echo '<span class="w3-right"><h1>'.$this->db->query("SELECT * FROM shsstudents WHERE status = 'Enrolled'")->num_rows().'</h1></span>';
				break;

			case 'Droppedjhs':
				echo '<span class="w3-right"><h1>'.$this->db->query("SELECT * FROM jhsstudents WHERE status = 'Dropped'")->num_rows().'</h1></span>';
				break;

			case 'Droppedshs':
				echo '<span class="w3-right"><h1>'.$this->db->query("SELECT * FROM shsstudents WHERE status = 'Dropped'")->num_rows().'</h1></span>';
				break;
			}
		}
		
		################################################################################################################
		################################################################################################################
	
		//Querying | THIS DAY | announcement | Dashboard page
		public function getAnnounce(){
			date_default_timezone_set("Asia/Manila");

			//$count = $this->db->query("SELECT * FROM announcements WHERE start_date AND end_date BETWEEN '".date("Y-m-d")."' AND '".date("Y-m-t")."'")->num_rows();
			$count = $this->db->query("SELECT * FROM announcements WHERE end_date >= '".date("Y-m-d")."'")->num_rows();
			//start_date >= '".date("Y-m-01")."' AND 
			if($count > 0){
				$query = $this->db->query("SELECT * FROM announcements WHERE end_date >= '".date("Y-m-d")."' ORDER BY start_date ASC LIMIT 3");

				foreach ($query->result_array() as $announce){
					$strdate = strtotime($announce['start_date']);
					$enddate = strtotime($announce['end_date']);

					echo '<div class="w3-panel w3-pale-blue w3-leftbar w3-border-blue w3-border w3-margin-bottom w3-padding" style="text-align: justify;">
							<p><b>'.$announce['title'].'</b>
							<br/><b>To:</b> '.$announce['audience'].'</p>
							<p class="w3-margin-left" style="text-indent:50px;">'.$announce['description'].'</p>
							<p>- '.$announce['role'].'</p>
							<small>'.date('M. j, Y', $strdate).' - '.date('M. j, Y', $enddate).'</small>';
					echo '</div>';
				}
				echo '<a href="'.base_url().'admin/announcement" class="w3-small">Show more</a>';
			}else{
				echo '<div class="w3-container w3-padding w3-pale-yellow"><a href="announcement">Post announcement</a></div>';
			}
		}

		################################################################################################################
		################################################################################################################

		//QUERYING ALL EVENTS WITHIN THE MONTH | DASHBOARD PAGE
		public function getEventsWithinMonth(){
			date_default_timezone_set("Asia/Manila");

			//$count = $this->db->query("SELECT * FROM events WHERE start_date AND end_date BETWEEN '".date("Y-m-d")."' AND '".date("Y-m-t")."'")->num_rows();
			$count = $this->db->query("SELECT * FROM events WHERE end_date >= '".date("Y-m-d")."'")->num_rows();

			if($count > 0){
				$query = $this->db->query("SELECT * FROM events WHERE end_date >= '".date("Y-m-d")."' ORDER BY start_date ASC LIMIT 3");

				foreach ($query->result_array() as $events){
					$strdate = strtotime($events['start_date']);
					$enddate = strtotime($events['end_date']);

					echo '<div class="w3-panel w3-pale-blue w3-leftbar w3-border-blue w3-border w3-padding">
						<p class="w3-small">'.date('M. j, Y', $strdate).' - '.date('M. j, Y', $enddate).'</p>
						<p class="w3-small"><b>'.$events['description'].'</b></p>';
					echo '</div>';
				}
				echo '<a href="'.base_url().'admin/events" class="w3-small">Show more</a>';

			}else{
				echo '<div class="w3-container w3-pale-yellow w3-padding w3-center">No events posted this month.</div>';
			}
		}

		####################################################################################################
		####################################################################################################
		####################################################################################################
		####################################################################################################


		####################################################################################################
		####################################################################################################
		####################################################################################################
		####################################################################################################
		//Querying THIS MONTH announcement for Announcement page
		public function getAllAnnounceThisMonth(){
			date_default_timezone_set("Asia/Manila");

			//$query = $this->db->query("SELECT * FROM announcements WHERE start_date BETWEEN '".date("Y-m-01")."' AND '".date("Y-m-t")."' ORDER BY start_date");
			$query = $this->db->query("SELECT * FROM announcements WHERE end_date >= '".date("Y-m-t")."' ORDER BY start_date");
			if($query->num_rows() != 0){

				foreach ($query->result_array() as $announce){
					$strdate = strtotime($announce['start_date']);
					$enddate = strtotime($announce['end_date']);

					echo '<div class="w3-panel w3-pale-blue w3-leftbar w3-border-blue w3-border w3-margin-bottom w3-padding" style="text-align: justify;">
							<h5><b>'.$announce['title'].'</b></h5>
							<p><b>To:</b> '.$announce['audience'].'</p>
							<p class="w3-margin-left" style="text-indent:50px;">'.$announce['description'].'</p>
							<p>- '.$announce['role'].'</p>
							<small>'.date('M. j, Y', $strdate).' - '.date('M. j, Y', $enddate).'</small>';
					echo '</div>';
				}

			}else{
				echo '<div class="w3-container w3-padding w3-pale-yellow w3-center">No announcement posted this month.</div>';;
			}
		}

		################################################################################################################
		################################################################################################################

		//Querying ALL POSTED announcement for Announcement page
		public function getAllAnnounce(){
			date_default_timezone_set("Asia/Manila");

			$count = $this->db->count_all('announcements');
				
			if($count >= 1){
				$query = $this->db->query("SELECT * FROM announcements ORDER BY start_date DESC");

				foreach ($query->result_array() as $announce){
					$strdate = strtotime($announce['start_date']);
					$enddate = strtotime($announce['end_date']);

					echo '<div class="w3-panel w3-leftbar w3-border-gray w3-border w3-padding" style="text-align: justify;">
							<h6><b>Subject: '.$announce['title'].'</b></h6>
							<p><b>To:</b> '.$announce['audience'].'</p>
							<p class="w3-margin-left" style="text-indent:50px;">'.$announce['description'].'</p>
							<p>- '.$announce['role'].'</p>
							<small>'.date('M. j, Y', $strdate).' to '.date('M. j, Y', $enddate).'</small> | ';
					//echo '<a href="'.base_url().'admin/editAnnouncement/'.$announce['a_id'].'" onclick="javascript: return confirm(\'Edit announcement?\')" class="w3-small">edit</a>';
					echo '<a href="'.base_url().'admin/deletePost/'.$announce['a_id'].'" onclick="javascript: return confirm(\'Delete announcement?\')" class="w3-small">Delete</a>';
					echo '</div>';
				}

			}else{
				echo '<div class="w3-container w3-padding w3-pale-yellow">Post Announcement.</div>';
			}
		}

		################################################################################################################
		################################################################################################################

		//POSTING ANNOUNCEMENT
		public function postAnnounce($strdate, $enddate, $rec, $description, $title, $role, $id){
			$data = array(
				'a_id' => '',
	        	'role' => $role,
	        	'title' => $title,
	        	'audience' => $rec,
	        	'start_date' => $strdate,
	        	'end_date' => $enddate,
	        	'id' => $id,
	        	'description' => $description
			);

			$query = $this->db->insert('announcements', $data);
			return $query;
				
		}

		public function deletepost($id){
			$query = $this->db->delete('announcements', array('a_id' => $id));
			return $query;
		}
		//END | Managing post
		
		//END | QUERYING ANNOUNCEMENTS
		####################################################################################################
		####################################################################################################
		####################################################################################################
		####################################################################################################


		####################################################################################################
		####################################################################################################
		####################################################################################################
		####################################################################################################
		//EVENTS
		public function EventsThisMonth(){
			date_default_timezone_set("Asia/Manila");

			$query = $this->db->query("SELECT * FROM events WHERE start_date BETWEEN '".date("Y-m-01")."' AND '".date("Y-m-t")."' ORDER BY start_date");
				
			if($query->num_rows() > 0){
				foreach ($query->result_array() as $events){
					$strdate = strtotime($events['start_date']);
					$enddate = strtotime($events['end_date']);

					echo '<div class="w3-panel w3-pale-blue w3-leftbar w3-border-blue w3-border w3-padding">
							<p>'.date('M. j, Y', $strdate).' - '.date('M. j, Y', $enddate).'</p>
							<p><b>'.$events['description'].'</b></p>';
					echo '</div>';
				}
			}else{
				echo '<div class="w3-container w3-pale-yellow w3-padding w3-center">No events posted this month.</div>';
			}

		}

		################################################################################################################
		################################################################################################################

		//QUERYING ALL EVENTS WITHIN THE MONTH | EVENTS PAGE
		public function allevents(){
			$this->load->library('encryption');
			date_default_timezone_set("Asia/Manila");

			$exec = $this->db->query("SELECT * FROM events ORDER BY start_date DESC");

			if($exec->num_rows() > 0){
				foreach ($exec->result_array() as $events){
					$strdate = strtotime($events['start_date']);
					$enddate = strtotime($events['end_date']);

					echo '<div class="w3-panel w3-pale-gray w3-leftbar w3-border w3-padding-bottom">
						<p><b>'.$events['description'].'</b></p>
						'.date('M. j, Y', $strdate).' - '.date('M. j, Y', $enddate).' | <a href="'.base_url().'admin/deleteEvents/'.$events['description'].'" onclick="javascript: return confirm(\'Delete events?\')">Delete</a>';
					echo '</div>';
				}
			}else{
				echo '<div class="w3-container w3-pale-yellow w3-padding w3-center">Create Events</div>';
			}
		}
		//END | EVENTS
		####################################################################################################
		####################################################################################################
		####################################################################################################
		####################################################################################################


		####################################################################################################
		####################################################################################################
		####################################################################################################
		####################################################################################################
		//STUDENTS
 		
 		//ADD SHS
	 		public function addSHSStudent($lname, $mname, $fname, $bday, $email, $lrn, $address, $sex, $grlevel, $track11, $track12){

	 			if($grlevel == 'Grade 11' || $grlevel == 'Grade 12'){
	 				$checkshs = $this->db->query("SELECT * FROM shsstudents WHERE lrn = $lrn");
	 				$checkjhs = $this->db->query("SELECT * FROM jhsstudents WHERE lrn = $lrn");

	 				if($checkshs->num_rows() != 1 && $checkjhs->num_rows() != 1){
	 					switch($grlevel){
	 						case 'Grade 11':
	 							$track = $track11;
	 							break;
	 						case 'Grade 12':
	 							$track = $track12;
	 							break;

	 					}
	 					$data = array(
	 						'lrn'	=>	$lrn,
	 						'fname'	=>	$fname,
	 						'mname'	=>	$mname,
	 						'lname'	=>	$lname,
	 						'sex'	=>	$sex,
	 						'Birthdate'	=>	$bday,
	 						'grade_level'	=>	$grlevel,
	 						'section'	=>	$track,
	 						'email'	=>	$email,
	 						'address'	=>	$address,
	 						'status'	=>	'Enrolled');

	 					$query = $this->db->insert('shsstudents', $data);
						return $query;

	 				}
	 			}
	 		}

	 	################################################################################################################
		################################################################################################################

 		//ADD JHS
	 		public function addJHSStudent($lname, $mname, $fname, $bday, $email, $lrn, $address, $sex, $grlevel, $s7, $s8, $s9, $s10){

	 			$checkjhs = $this->db->query("SELECT * FROM jhsstudents WHERE lrn = $lrn");
	 			$checkshs = $this->db->query("SELECT * FROM shsstudents WHERE lrn = $lrn");

	 				//CHECKING IF STUDENT DOES NOT EXISTS
	 				if($checkjhs->num_rows() != 1 && $checkshs->num_rows() != 1){

	 				
	 					switch($grlevel){
		 					case 'Grade 7':
		 							$section = $s7;
		 							break;
		 					case 'Grade 8':
		 							$section = $s8;
		 							break;
		 					case 'Grade 9':
		 							$section = $s9;
		 							break;
		 					case 'Grade 10':
		 							$section = $s10;
		 							break;
		 					}

		 				
		 						$data = array(
		 						'lrn'	=>	$lrn,
		 						'fname'	=>	$fname,
		 						'mname'	=>	$mname,
		 						'lname'	=>	$lname,
		 						'sex'	=>	$sex,
		 						'Birthdate'	=>	$bday,
		 						'grade_level'	=>	$grlevel,
		 						'section'	=>	$section,
		 						'email'	=>	$email,
		 						'address'	=>	$address,
		 						'status'	=>	'Enrolled');

		 				$query = $this->db->insert('jhsstudents', $data);
						return $query;

		 				}
		 					/*$data = array(
		 						'lrn'	=>	$lrn,
		 						'fname'	=>	$fname,
		 						'mname'	=>	$mname,
		 						'lname'	=>	$lname,
		 						'sex'	=>	$sex,
		 						'Birthdate'	=>	$bday,
		 						'grade_level'	=>	$grlevel,
		 						'section'	=>	$section,
		 						'contact'	=>	$contact,
		 						'address'	=>	$address,
		 						'status'	=>	'Enrolled');

		 					$query = $this->db->insert('jhsstudents', $data);
							return $query;*/
	 					
						
	 				
	 		}

	 	####################################################################################################
		####################################################################################################

	 	//ADD TEACHER
	 	public function AddGuro($lname, $fname, $mname, $rank, $email, $id, $major, $dept, $sex){

	 		$checkTeacher = $this->db->query("SELECT * FROM teachers WHERE id = $id");

	 		if($checkTeacher->num_rows() != 1){
	 			$data = array(
	 				'id'	=>	$id,
	 				'fname'	=>	$fname,
	 				'mname'	=>	$mname,
	 				'lname'	=>	$lname,
	 				'sex'	=>	$sex,
	 				'email'	=>	$email,
	 				'major'	=>	$major,
	 				'Department'	=>	$dept,
	 				'Rank'	=>	$rank);

	 			$query = $this->db->insert('teachers', $data);
	 			return 1;
	 		}
	 	}

	 	####################################################################################################
		####################################################################################################
 		public function getAllgr7(){
 			$query = $this->db->query("SELECT * FROM jhsstudents WHERE grade_level = 'Grade 7' AND status = 'Enrolled'");
 			echo $query->num_rows();
 		}

	 	###################################################################################################
	 	###################################################################################################

	 	public function getAllgr8(){
 			$query = $this->db->query("SELECT * FROM jhsstudents WHERE grade_level = 'Grade 8' AND status = 'Enrolled'");
 			echo $query->num_rows();
 		}

	 	###################################################################################################
	 	###################################################################################################

	 	public function getAllgr9(){
 			$query = $this->db->query("SELECT * FROM jhsstudents WHERE grade_level = 'Grade 9' AND status = 'Enrolled'");
 			echo $query->num_rows();
 		}

	 	##################################################################################################################
	 	##################################################################################################################

	 	public function getAllgr10(){
 			$query = $this->db->query("SELECT * FROM jhsstudents WHERE grade_level = 'Grade 10' AND status = 'Enrolled'");
 			echo $query->num_rows();
 		}

	 	####################################################################################################
		####################################################################################################

	 	public function getAllgr11(){
 			$query = $this->db->query("SELECT * FROM shsstudents WHERE grade_level = 'Grade 11' AND status = 'Enrolled'");
 			echo $query->num_rows();
 		}

 		####################################################################################################
		####################################################################################################

	 	public function getAllgr12(){
 			$query = $this->db->query("SELECT * FROM shsstudents WHERE grade_level = 'Grade 12' AND status = 'Enrolled'");
 			echo $query->num_rows();
 		}



 		


	 	####################################################################################################
		####################################################################################################
	 	//DROP STUDENT
	 	public function DropStudent($lrn, $gr){
	 		if($gr == 'Grade 11' || $gr == 'Grade 12'){
	 			$query = $this->db->query("UPDATE shsstudents SET status = 'Dropped' WHERE lrn = $lrn");
	 			return $query;
	 		}else{
	 			$query = $this->db->query("UPDATE jhsstudents SET status = 'Dropped' WHERE lrn = $lrn");
	 			return $query;
	 		}
	 		
	 	}
 		//END | STUDENTS
 		################################################################################################################
		################################################################################################################
		################################################################################################################
		################################################################################################################


		################################################################################################################
		################################################################################################################
		################################################################################################################
		################################################################################################################
	 	//STATUS OF EACH SECTIONS (ENROLLED STUDENTS)
 		public function getSections($title){

 			$count = $this->db->query("SELECT * FROM sections WHERE gr_level = '$title'");

 			if($count->num_rows() >= 1){
 				foreach ($count->result_array() as $sectionInfo) {

 					$section = $sectionInfo["sect_name"];

 					if($title == 'Grade 7'||$title == 'Grade 8'||$title == 'Grade 9'||$title == 'Grade 10'){
 						$count = $this->db->query("SELECT * FROM jhsstudents WHERE section = '$section' AND grade_level = '$title' AND status = 'Enrolled'");
 					}else{
 						$count = $this->db->query("SELECT * FROM shsstudents WHERE section = '$section' AND grade_level = '$title' AND status = 'Enrolled'");
 					}
		    		
		    		$res = $count->num_rows();
					

		    		if($res >= 25){
		    			$disable = 'style="pointer-events: none;"';
		    			$color = 'w3-pale-red';
		    		}else{
		    			$disable = '';
		    			$color = 'w3-red';
		    		}



					if($res >= 1){
						$shout = '\nBy proceeding, you are advised to re-enroll these students.';
					}else{
						$shout = '';
					}

		    		$gr = str_replace(" ", "", $title);
					$grade = str_replace("G", "g", $gr);

 					echo '<div class="w3-col m4">';
 						echo '<div class="w3-card w3-round w3-margin-bottom w3-padding">';
 							echo '<div class="w3-container w3-padding">';
 								echo '<h5><b>'.strtoupper($sectionInfo['sect_name']).'</b></h5>';
 								echo '<a href="'.base_url().'admin/'.$grade.'/'.$sectionInfo["sect_name"].'" class="w3-button w3-small w3-round-large w3-blue w3-hover-light-blue">View</a> ';
 								echo '<a href="'.base_url().'admin/Dissolve/'.$title.'/'.$sectionInfo["sect_name"].'" onclick="javascript: return confirm(\'\nDissolve '.$sectionInfo['sect_name'].' section? There are '.$res.' student/s enrolled on this section. '.$shout.'\')" class="w3-button w3-small w3-round-large '.$color.' w3-hover-pale-red" '.$disable.'>Dissolve</a>';
 								echo '<small class="w3-right w3-padding">
		    						<b>'.$res.'</b> out of 50</small>';
 							echo '</div>';
 						echo '</div>';
 					echo '</div>';
 				}
 			}
 		}

 		################################################################################################################
		################################################################################################################

 		//ENROLLING A STUDENT PROCESS | FETCHING GRADE 7 SECTIONS
 		public function getSectionName7(){
 			$exec = $this->db->query("SELECT * FROM sections WHERE gr_level = 'Grade 7'");

 			if($exec){
 				
 				foreach ($exec->result_array() as $sname) {

 					$s_name = $sname['sect_name'];
 					$sect = $this->db->query("SELECT section FROM jhsstudents WHERE section = '$s_name'");

 					if($sect->num_rows() >= 50){$dis = 'disabled';}else{$dis = '';}//TO SET A LIMIT OF 50 STUDENTS THAT SHOULD BE ENROLLED IN EACH SECTIONS
 					
 					echo '<option '.$dis.'>'.$sname['sect_name'].'</option>';
 				}
 			}
 		}

 		################################################################################################################
		################################################################################################################

 		//ENROLLING A STUDENT PROCESS | FETCHING GRADE 8 SECTIONS
 		public function getSectionName8(){
 			$exec = $this->db->query("SELECT * FROM sections WHERE gr_level = 'Grade 8'");

 			if($exec){
 				foreach ($exec->result_array() as $sname) {

 					$s_name = $sname['sect_name'];
 					$sect = $this->db->query("SELECT section FROM jhsstudents WHERE section = '$s_name'");

 					if($sect->num_rows() >= 50){$dis = 'disabled';}else{$dis = '';}//TO SET A LIMIT OF 50 STUDENTS THAT SHOULD BE ENROLLED IN EACH SECTIONS
 					
 					echo '<option '.$dis.'>'.$sname['sect_name'].'</option>';
 				}
 			}
 		}

 		################################################################################################################
		################################################################################################################

 		//ENROLLING A STUDENT PROCESS | FETCHING GRADE 9 SECTIONS
 		public function getSectionName9(){
 			$exec = $this->db->query("SELECT * FROM sections WHERE gr_level = 'Grade 9'");

 			if($exec){
 				foreach ($exec->result_array() as $sname) {
 					
 					$s_name = $sname['sect_name'];
 					$sect = $this->db->query("SELECT section FROM jhsstudents WHERE section = '$s_name'");

 					if($sect->num_rows() >= 50){$dis = 'disabled';}else{$dis = '';}//TO SET A LIMIT OF 50 STUDENTS THAT SHOULD BE ENROLLED IN EACH SECTIONS
 					
 					echo '<option '.$dis.'>'.$sname['sect_name'].'</option>';
 				}
 			}
 		}

 		################################################################################################################
		################################################################################################################

 		//ENROLLING A STUDENT PROCESS | FETCHING GRADE 10 SECTIONS
 		public function getSectionName10(){
 			$exec = $this->db->query("SELECT * FROM sections WHERE gr_level = 'Grade 10'");

 			if($exec){
 				foreach ($exec->result_array() as $sname) {
 					
 					$s_name = $sname['sect_name'];
 					$sect = $this->db->query("SELECT section FROM jhsstudents WHERE section = '$s_name'");

 					if($sect->num_rows() >= 50){$dis = 'disabled';}else{$dis = '';}//TO SET A LIMIT OF 50 STUDENTS THAT SHOULD BE ENROLLED IN EACH SECTIONS
 					
 					echo '<option '.$dis.'>'.$sname['sect_name'].'</option>';
 				}
 			}
 		}

 		################################################################################################################
		################################################################################################################

 		//ENROLLING A STUDENT PROCESS | FETCHING GRADE 11 SECTIONS
 		public function getSectionName11(){
 			$exec = $this->db->query("SELECT * FROM sections WHERE gr_level = 'Grade 11'");

 			if($exec){
 				foreach ($exec->result_array() as $sname) {
 					
 					$s_name = $sname['sect_name'];
 					$sect = $this->db->query("SELECT section FROM shsstudents WHERE section = '$s_name'");

 					if($sect->num_rows() >= 50){$dis = 'disabled';}else{$dis = '';}//TO SET A LIMIT OF 50 STUDENTS THAT SHOULD BE ENROLLED IN EACH SECTIONS
 					
 					echo '<option '.$dis.'>'.$sname['sect_name'].'</option>';
 				}
 			}
 		}

 		################################################################################################################
		################################################################################################################

 		//ENROLLING A STUDENT PROCESS | FETCHING GRADE 12 SECTIONS
 		public function getSectionName12(){
 			$exec = $this->db->query("SELECT * FROM sections WHERE gr_level = 'Grade 12'");

 			if($exec){
 				foreach ($exec->result_array() as $sname) {
 					
 					$s_name = $sname['sect_name'];
 					$sect = $this->db->query("SELECT section FROM jhsstudents WHERE section = '$s_name'");

 					if($sect->num_rows() >= 50){$dis = 'disabled';}else{$dis = '';}//TO SET A LIMIT OF 50 STUDENTS THAT SHOULD BE ENROLLED IN EACH SECTIONS
 					
 					echo '<option '.$dis.'>'.$sname['sect_name'].'</option>';
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
 		//QUERYING FOR SECTION PREVIEWS | THE CONTENT
 		public function getStudInSection($section, $grade_level){

 			if($grade_level == 'Grade 7' || $grade_level == 'Grade 8' || $grade_level == 'Grade 9' || $grade_level == 'Grade 10'){

 				$exec = $this->db->query("SELECT * FROM jhsstudents WHERE section = '$section' && grade_level = '$grade_level' ORDER BY lname ASC");

 			}else{
 				$exec = $this->db->query("SELECT * FROM shsstudents WHERE section = '$section' && grade_level = '$grade_level' ORDER BY lname ASC");
 			}

 				if($exec->num_rows() >= 1){
 					echo "<div class='w3-row-padding'>";

 					$i = 0;
 					foreach ($exec->result_array() as $studInfo) {

 						if($studInfo['status'] == 'Dropped'){
	 						$stat = 'w3-grey';
	 						$status = '<span class="w3-small w3-tag w3-round w3-red">Dropped</span>';
	 						$button = '';
	 					}else{
	 						$stat = '';
	 						$button = '<a href="'.base_url().'admin/DropStudent/'.$studInfo['lrn'].'/'.$grade_level.'" onclick="javascript: return confirm(\'Drop Student?\')" class="w3-button w3-small w3-round-large w3-red w3-hover-pale-red w3-hide" id="link'.$i.'">Drop</a>';
	 						$status = '';
	 					}

	 					if(empty($studInfo['photo'])){
	 						$img = "<span class='fa fa-user-circle-o' style='font-size:6em;' id='image'".$i."'></span>";
	 					}else{
	 						$img = '<img src="'.base_url().'ProfilePic/students/'.$studInfo['photo'].'" style="max-width:6em;width:100%;max-height:6em" class="w3-circle">';
	 					}


	 					echo "<div class='w3-container w3-third w3-margin-bottom'>";
	 						echo "<div class='w3-card w3-round w3-padding ".$stat."'>";
	 							echo "<div class='w3-row' style='height: 7em;'>";
	 								echo "<div class='w3-col w3-margin-right' style='width:6em'>";
		 								echo "<div class='w3-display-container' onmouseover='showDelete(".$i.")' onmouseout='hideDelete(".$i.")' style='max-width:7em;'>";
		 									echo $img;
		 									echo $button;
		 								echo "</div>";
	 								echo "</div>";
	 								echo "<div class='w3-rest'>";
	 									echo "<p><a href='".base_url()."admin/viewstudent/".$studInfo['lrn']."/".$studInfo['grade_level']."/".$section."'><b>".$studInfo['lname'].", ".$studInfo['fname']." ".$studInfo['mname']."</b></a><br/>".$studInfo['lrn'].' '.$status.'</p>';
	 								echo "</div>";
	 							echo "</div>
	 							</div>
	 						</div>";

	 					$i++;
 					}

 					echo '</div>';
 				}else{
 					echo '<div class="w3-panel w3-pale-yellow w3-padding">There are no students enrolled in this section.</div>';
 				}
 		}

 		################################################################################################################
		################################################################################################################

 		public function getSubjectsInSection($section_name, $grade_level){
 			$checksubj = $this->db->query("SELECT * FROM subject_teacher WHERE gr_level = '$grade_level' AND section = '$section_name'");
 			if($checksubj->num_rows() > 0){

 				echo "<div class='w3-row-padding'>";
 				$i = 0;
	 			foreach ($checksubj->result_array() as $subj) {
	 				$subj['subj_teacher'];
	 				$subj['subj_code'];

	 				$getTeach = $this->db->query("SELECT * FROM teachers WHERE id = '".$subj['subj_teacher']."'");
	 				foreach ($getTeach->result_array() as $TeachInfo) {
	 					$name = $TeachInfo['fname'].' '.$TeachInfo['mname'].' '.$TeachInfo['lname'].' - '.$TeachInfo['Rank'];
	 					$id = $TeachInfo['id'];

	 					$getsubj = $this->db->query("SELECT * FROM subjects WHERE subj_code = '".$subj['subj_code']."'");
	 					foreach ($getsubj->result_array() as $subjInfo) {
	 						$subj_name = $subjInfo['subj_title'];
	 						$src = $subjInfo['subj_img'];
	 						$link = $subjInfo['subj_code'];
	 					}
	 				}
	 				echo "<div class='w3-col m4 w3-margin-bottom'>";
		 				//echo "<div class='w3-card w3-round'>";
		 					echo "<div class='w3-display-container w3-card' onmouseover='showDesc(".$i.")' onmouseout='hideDesc(".$i.")'>";
		 						echo "<img src='".base_url()."Subject_image/".$src."' load='lazy' style='max-width:24em;width:100%;max-height:12em;'>";
		 						echo "<div class='w3-hide' id='subjDesc".$i."' style='width:100%;'><a href='".base_url()."admin/subjects/".$link."'><p>".strtoupper($subj_name)."</a><br/>".$name."</p></div>";
	 						echo "</div>
	 						</div>
	 					";
	 				$i++;
	 			}
	 			echo '</div>';
 			}else{
 				echo '<div class="w3-panel w3-pale-yellow w3-padding">No subjects and Teachers assigned.</div>';
 			}

 		}

 		################################################################################################################
		################################################################################################################

 		public function getAssignedAdviser($section_name, $grade_level){
 			
 			$chkAdv = $this->db->query("SELECT * FROM sections WHERE sect_name = '$section_name' AND gr_level = '$grade_level' AND adviser IS NOT NULL");
 			if($chkAdv->num_rows() == 1){
 				foreach ($chkAdv->result_array() as $Adv) {
 					$info = $this->db->query("SELECT * FROM teachers WHERE id = '".$Adv['adviser']."'");
 					foreach ($info->result_array() as $tinfo) {
 						$name = $tinfo['fname'].' '.$tinfo['mname'].' '.$tinfo['lname'];
 						$id = $tinfo['id'];
 						$rank = $tinfo['Rank'];
 						$major = $tinfo['major'];
 					}

 					if(empty($tinfo['photo'])){
 						$img = "<span class='fa fa-user-circle-o' style='font-size:6em;'></span>";
 					}else{
 						$img = '<img src="'.base_url().'ProfilePic/teachers/'.$tinfo['photo'].'" class="w3-circle" style="max-width:6em;width:100%;max-height:6em;">';
 					}

 						echo "<div class='w3-half w3-padding'>";
 							echo "<div class='w3-card w3-round w3-padding'>";
	 							echo "<div class='w3-row'>";
	 								echo "<div class='w3-col w3-margin-right w3-margin-bottom' style='width:6em'>";
		 									echo $img;
	 								echo "</div>";
	 								echo "<div class='w3-rest'>";
	 									echo "<p><a href='".base_url()."admin/viewteacher/".$Adv['adviser']."' style='font-size: 1em;'><b>".$name."</b></a> <a href='".base_url()."admin/removeAdviser/".$Adv['adviser']."/".$grade_level."/".$section_name."' class='w3-right w3-small w3-button w3-circle w3-red w3-hover-pale-red fa fa-times' title='Remove adviser' onclick='javascript: return confirm(\"Remove adviser?\")'></a><br/>";
		 								echo $id.'<br/>'.$rank.' - '.$major.'</p>';
		 								echo "";
	 								echo "</div>";

	 							echo "</div>
	 						</div>
	 					</div>";
 				}
 			}else{
 				echo '<div class="w3-panel w3-pale-yellow w3-padding">Assign Adviser for this section. <a href="javascript:void(0)" onclick="document.getElementById(\'AssignAdviser\').style.display=\'block\'" class="w3-text-blue">Assign</a></div>';
 			}
 			
 			$y = 0;
 			$ids = array();
 			$allAdv = $this->db->query("SELECT * FROM sections WHERE adviser IS NOT NULL");
 			if($allAdv->num_rows() > 0){

 				foreach ($allAdv->result_array() as $allAdvId) {
	 				$ids[$y] = '"'.$allAdvId['adviser'].'"';
	 				$y++;
	 			}
	 			$gotId = implode(", ", $ids);

 			}else{
 				$gotId = "0";
 			}
	 			
 			

 			echo '<div class="w3-modal" id="AssignAdviser">
 					<div class="w3-modal-content w3-animate-top" style="width:40%">
 						<header class="w3-container w3-blue">
							<h3>ASSIGN ADVISER FOR THIS SECTION</h3>
					    </header>
					    <div class="w3-container">';
						    if($grade_level == 'Grade 7' || $grade_level == 'Grade 8' || $grade_level == 'Grade 9' || $grade_level == 'Grade 10'){
						    	$dept = 'Junior High School Teacher';
						    }else{
						    	$dept = 'Senior High School Teacher';
						    }

						    echo '<p>Available <span class="w3-tag w3-light-blue">'.$dept.'</span> to be assigned:</p><form action="'.base_url().'admin/assignAdviser/'.$grade_level.'/'.$section_name.'" method="post">';

						    $teachersByDept = $this->db->query("SELECT * FROM teachers WHERE Department = '$dept' AND id NOT IN(".$gotId.")");
						    
						    if($teachersByDept->num_rows() > 0){
						    	$dis = '';
						    }else{
						    	echo '<div class="w3-panel w3-pale-yellow w3-center">None! Please add a teacher.</div>';
						    	$dis = 'disabled';
						    }

						    foreach ($teachersByDept->result_array() as $TeacherInfo) {
						    	echo '<p><input type="radio" class="w3-radio" name="adviser" value="'.$TeacherInfo['id'].'" required><label> ('.$TeacherInfo['id'].') ('.$TeacherInfo['teach_load'].') '.$TeacherInfo['fname'].' '.$TeacherInfo['mname'].' '.$TeacherInfo['lname'].'</label></p>';
						    }

						echo '<div class="w3-right w3-container w3-margin-bottom"><input type="submit" class="w3-button w3-blue w3-hover-light-blue w3-round-large" value="Assign" '.$dis.'> ';
						echo '<input type="button" onclick="document.getElementById(\'AssignAdviser\').style.display=\'none\'" class="w3-button w3-red w3-hover-pale-red w3-round-large" value="Cancel"></div>';
					    echo '</form></div>
					    <footer class="w3-container w3-padding-large w3-blue"></footer>
 					</div>

 			</div>';
 			
 			
 		}
 		################################################################################################################
		################################################################################################################
		################################################################################################################
		################################################################################################################


 		################################################################################################################
		################################################################################################################
		################################################################################################################
		################################################################################################################
 		//SUBJECT PAGE | MANAGES SUBJECT TEACHERS PER SECTION 
 		public function getSubj_teach($gr, $code, $title){
 			
 			$section = $this->db->query("SELECT sect_name FROM sections WHERE gr_level = '$gr'")->result_array();

 			$count = $this->db->query("SELECT * FROM subject_teacher WHERE gr_level = '$gr' AND subj_code = $code");
 			$ex = count($count->result_array()); //EXISTING FROM SUBJECT TEACHER THAT MATCHES GRADE LEVEL AND SUBJECT CODE
 			
 			$x = 0;
 			if($ex > 0){
	 			foreach ($count->result_array() as $tss) {
	 				$hay[$x] = '"'.$tss['subj_teacher'].'"';
	 				$x++;
	 			}
	 			$hmp = implode(", ", $hay);
 			}else{
 				$hmp = "0";
 			}
 			

 			echo "<div class='w3-row-padding'>";

 			$i = 0;
 			$arr = array();
 			//echo $ex;
 			//START OF FOREACH FOR SECTION LIST
 			foreach ($section as $sect_list) {

 				$chksectionOnSubjT = $this->db->query("SELECT * FROM subject_teacher WHERE section = '".$sect_list['sect_name']."' AND subj_code = $code AND gr_level = '$gr'");
 				
 				//CHECKING IF SECTION EXISTS IN subject_teacher TABLE || WILL LOOP DEPENDING ON THE NUMBER OF SECTIONS
 				if($chksectionOnSubjT->num_rows() >= 1){
 					foreach ($chksectionOnSubjT->result_array() as $gotOnSubjT) {
	 					$gotOnSubjT['section'];
	 					$gotOnSubjT['subj_teacher']; // teachers' id

	 					$tinfo = $this->db->query("SELECT * FROM teachers WHERE id = '".$gotOnSubjT['subj_teacher']."'");
	 					foreach ($tinfo->result_array() as $teacherInfo) {

	 						$name = $teacherInfo['fname'].' '.$teacherInfo['mname'].' '.$teacherInfo['lname'];
	 						$teacher_rank = $teacherInfo['Rank'];

	 					}
	 				}
	 				
	 				$assign = '<a href="'.base_url().'admin/removeTeach/'.$gotOnSubjT['subj_teacher'].'/'.$code.'/'.$sect_list['sect_name'].'/'.$title.'/'.$gr.'" onclick="javascript: return confirm(\'Remove subject teacher?\')" class="w3-button w3-round w3-red w3-hover-pale-red w3-right w3-small"><small>Remove</small></a>';

	 				$enroll = '<a href="javascript:void(0)" onclick="document.getElementById(\'enroll'.$i.'\').style.display=\'block\'" class="w3-button w3-round w3-blue w3-hover-pale-blue w3-right w3-small"><small>Enroll</small></a>';
	 				
 				}else{
 					$assign = ' <a href="javascript:void(0)" class="w3-button w3-round w3-blue w3-hover-light-blue w3-right w3-small" onclick="document.getElementById(\'assign'.$i.'\').style.display=\'block\'">Assign</a>';
 					$enroll = '';
 					$name = '';
 					$teacher_rank = '';
 				}

 					
 				//MODAL FOR ASSIGNING
 					echo '<div class="w3-modal" id="assign'.$i.'">
		 					<div class="w3-modal-content w3-card-4 w3-animate-top" style="max-width:600px">
		 						<header class="w3-container w3-blue">
					    			<span onclick="document.getElementById(\'assign'.$i.'\').style.display=\'none\'" class="w3-button w3-display-topright w3-blue w3-hover-light-blue">&times;</span>
							        	<h4>ASSIGN '.strtoupper($title).' TEACHER FOR <span class="w3-round w3-light-blue">'.strtoupper($sect_list['sect_name']).'</span></h4>
					    		</header>
					    		<div class="w3-container w3-padding-large w3-margin-top">
									<form action="'.base_url().'admin/assignTeach" method="post">
									    <label>Available teacher/s:</label>';

									    		$teach = $this->db->query("SELECT * FROM teachers WHERE teach_load < 6");

									    		if($teach->num_rows() >= 1){
								 					foreach ($teach->result_array() as $teach_info){
												    	
												 	$complete_name = '('.$teach_info['id'].') ('.$teach_info['teach_load'].') ('.$teach_info['major'].') '.$teach_info['fname'].' '.$teach_info['mname'].' '.$teach_info['lname'];
								 					$INFO = array($teach_info['id'], $teach_info['teach_load']);

												 	echo '<p><input type="radio" name="assigned" value="'.implode(' ',$INFO).'" class="w3-radio" required><label> '.$complete_name.'
												 			<input type="hidden" value="'.$code.'" name="code">
												 			<input type="hidden" value="'.$gr.'" name="gr">
												 			<input type="hidden" value="'.$sect_list['sect_name'].'" name="sect">
												 			<input type="hidden" value="'.$title.'" name="subj">
												 			</label></p>';
												 	}
												 	$dis = '';
												}else{
													echo '<div class="w3-panel w3-pale-yellow w3-center">None! Please add a teacher.</div>';
									 				$dis = 'disabled';
												}

										echo '<div class="w3-container w3-right"><input type="submit" class="w3-button w3-blue w3-hover-light-blue w3-round-large" value="Assign" '.$dis.'> ';
										echo '<input type="button" onclick="document.getElementById(\'assign'.$i.'\').style.display=\'none\'" class="w3-button w3-red w3-hover-pale-red w3-round-large" value="Cancel"></div>
									</form>
								</div>
								<footer class="w3-container w3-blue w3-padding-large"></footer>
		 					</div>
		 				</div>';
		 			
 				//MODAL FOR ASSIGNING | END


		 		//MODAL FOR ENROLLING STUD
		 			echo '<div class="w3-modal" id="enroll'.$i.'">
		 					<div class="w3-modal-content w3-card-4 w3-animate-top" style="max-width:600px">
		 						<header class="w3-container w3-blue">
					    			<span onclick="document.getElementById(\'enroll'.$i.'\').style.display=\'none\'" class="w3-button w3-display-topright w3-blue w3-hover-light-blue">&times;</span>
							        	<h3>ENROLL STUDENTS FROM <span class="w3-round w3-light-blue">'.strtoupper($sect_list['sect_name']).'</span></h3>
					    		</header>
					    		<div class="w3-container w3-padding-large w3-margin-top">
									<form action="'.base_url().'admin/AddstudinSubj/'.$code.'/'.$sect_list['sect_name'].'" method="post" name="world">';

										$ids = 0;

										foreach ($this->db->query("SELECT * FROM subject_students WHERE subj_code = $code AND gr_level = '$gr' AND section = '".$sect_list['sect_name']."'")->result_array() as $existing) {

									    	$ids = explode(", ", $existing['students']);
									    }

										    if($gr == 'Grade 11' || $gr == 'Grade 12'){
										    	for ($a = 0; $a < count($ids); $a++) { 
													$var[] = "'".$ids[$a]."'";
												}
										    	
										    	$query = $this->db->query("SELECT * FROM shsstudents WHERE lrn NOT IN(".implode(", ", $var).") AND grade_level = '$gr' AND section = '".$sect_list['sect_name']."'");

										    }else{
										    	for ($a = 0; $a < count($ids); $a++) { 
													$var[] = "'".$ids[$a]."'";
												}
										    	
										    	$query = $this->db->query("SELECT * FROM jhsstudents WHERE lrn NOT IN(".implode(", ", $var).") AND grade_level = '$gr' AND section = '".$sect_list['sect_name']."'");
										    }

										if($query->num_rows() == 0){
											echo '<div class="w3-panel w3-pale-yellow w3-center">No available students.</div>';
											$dis = 'disabled';
										
										}else{
											foreach ($query->result_array() as $stud) {
												echo '<input type="checkbox" class="w3-check" name="val[]" value="'.$stud['lrn'].'"> '.$stud['fname'].' '.$stud['mname'].' '.$stud['lname'].' ('.$stud['lrn'].') - '.$stud['section'].'<br/>';
												echo '<input type="hidden" name="lvl" value="'.$stud['grade_level'].'">';
											}
											$dis = '';
										}
										

									    echo '<div class="w3-container w3-right w3-margin-top">
									    	<input type="submit" id="enrbutton" class="w3-button w3-blue w3-hover-light-blue w3-round-large" value="Enroll" '.$dis.'> ';
										echo '<input type="button" onclick="document.getElementById(\'enroll'.$i.'\').style.display=\'none\'" class="w3-button w3-red w3-hover-pale-red w3-round-large" value="Cancel"></div>
									</form>
								</div>
								<footer class="w3-container w3-blue w3-padding-large"></footer>
		 					</div>
		 				</div>';
		 			$i++;
		 		//MODAL FOR ENROLLING STUD | END

 				//LOOPED CONTENT
 				echo "<div class='w3-col m4 w3-margin-bottom'>";
	 				echo "<div class='w3-card w3-round w3-padding' style='height:120px;'>";
	 					echo "<div class='w3-container w3-padding'>";

			 			echo '<b>'.strtoupper($sect_list['sect_name']).'</b>'.$assign.' '.$enroll;
 					echo '<p>'.$name.'<br/><small><b>'.$teacher_rank.'</b></small></p>';
 				echo '</div></div></div>';
		 		//LOOPED CONTENT | END


			}
			//END OF FOREACH FOR SECTION LIST
			echo '</div>';
			
		}

		################################################################################################################
		################################################################################################################

		//SUBJECT PAGE | ENROLLED STUDENTS IN SUBJ
		public function getStud_subj($gr, $code){

			//CHECK IF THERE ARE ASSIGNED SUBJECT TEACHERS
			if($this->db->query("SELECT * FROM subject_teacher WHERE subj_code = $code AND subj_teacher != ''")->num_rows() >= 1){
				echo '<div class="w3-container">
						<input type="text" class="w3-input w3-border w3-round w3-half w3-margin-bottom" placeholder="Search student..." onkeyup="functionSearchLastname()" id="StudLN">
					</div>';
				

				$query = $this->db->query("SELECT * FROM subject_students WHERE subj_code = $code AND gr_level = '$gr' AND students != ''");
				//Check if there are no students enrolled
				if($query->num_rows() == 0){
					echo '<p class="w3-padding w3-pale-yellow w3-center">No students enrolled in this subject.</p>';
					$stud = 0;

				}else{
					echo '<div class="w3-container" style="overflow-x:auto;"><table class="w3-table-all w3-small w3-border" id="listofstudents">
						<thead>
				      	<tr class="w3-light-grey">
					        <th>LRN</th>
					        <th>Name</th>
					        <th>Grade &amp; Section</th>
					        <th>Action</th>
				      	</tr>
				    	</thead>';
					//QUERYING ALL ENROLLED STUDENTS IN THIS SUBJECT
					foreach($query->result_array() as $er){
						$stud = explode(", ", $er['students']);

						for ($i=0; $i < count($stud); $i++) { 
						
							if($gr == "Grade 11" || $gr == "Grade 12"){
								$query = $this->db->query("SELECT * FROM shsstudents WHERE lrn = '".$stud[$i]."' AND grade_level = '$gr'");
							}else{
								$query = $this->db->query("SELECT * FROM jhsstudents WHERE lrn = '".$stud[$i]."' AND grade_level = '$gr'");
							}

							echo '<tr>';
							foreach ($query->result_array() as $studInfo) {
								echo '<td>'.$studInfo['lrn'].'</td>';
								echo '<td>'.$studInfo['lname'].', '.$studInfo['fname'].' '.$studInfo['mname'].'</td>';
								echo '<td>'.$studInfo['grade_level'].' - '.$studInfo['section'].'</td>';
								echo '<td><a href="'.base_url().'admin/DeletestudinSubj/'.$code.'/'.$studInfo['lrn'].'/'.$studInfo['grade_level'].'/'.$studInfo['section'].'" class="fa fa-remove w3-button w3-red w3-hover-pale-red w3-circle w3-small" title="Unenroll student in this subject" onclick="javascript: return confirm(\'Remove student?\')"></a></td>';
							}
							echo '</tr>';
						}
					}
					echo '</table>
					</div>';
					//QUERYING ALL ENROLLED STUDENTS IN THIS SUBJECT | END	
				}

			}else{
				echo '<p class="w3-padding w3-pale-yellow w3-center">Please assign atleast 1 subject teacher for this subject.</p>';
			}


		}

		################################################################################################################
		################################################################################################################

 		//SUBJECT PAGE | SUBJECTS EACH GRADE LEVEL
 		public function subjectsof($grade){
 			$subjs = $this->db->query("SELECT * FROM subjects WHERE gr_level = '$grade'");
 			$dir = base_url().'Subject_image/';

 			
 			if($subjs->num_rows() >= 1){
 				foreach ($subjs->result_array() as $s_info) {
 					$i = $s_info['subj_code']; //FOR PASALI

	 				echo '<div class="w3-row w3-margin-bottom">';
	 					echo '<div class="w3-col w3-margin-right" style="width:7em">';

	 					echo '<div class="w3-display-container" onmouseover="showDelete('.$i.')" onmouseout="hideDelete('.$i.')">';
	 						echo '<img id="image'.$i.'" load="lazy" class="w3-image" src="'.$dir.$s_info['subj_img'].'" style="max-width:7em;">';
	 						echo '<a href="'.base_url().'admin/deleteSubject/'.$s_info['subj_code'].'" onclick="javascript: return confirm(\'Delete subject?\')" class="w3-hide" id="link'.$i.'">Delete</a>';
	 					echo '</div>';

	 					echo '</div>';

	 					echo '<div class="w3-rest">';
	 						echo '<a href="'.base_url().'admin/subjects/'.$s_info['subj_code'].'"><h6><b>'.strtoupper($s_info['subj_title']).'</b></h6></a>';

	 						if(strlen($s_info['subj_desc']) >= 200){
	 							$ellep = "...";
	 						}else{
	 							$ellep = "";
	 						}
	 						
	 						echo '<i style="color:#666666;">'.substr($s_info['subj_desc'], 0, 200).$ellep.'</i>';
	 					echo '</div>';
	 				echo '</div>';
 				}
 			}else{
 				echo '<div class="w3-panel w3-pale-yellow">';
 				echo 'No subject previews';
 				echo '</div>';
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

 		public function subjectGr($grade){
 			$exec = $this->db->query("SELECT subj_title FROM subjects WHERE gr_level = '$grade'");

 			foreach ($exec->result_array() as $subj) {
 				echo '<option>'.$subj['subj_title'].'</option>';
 			}
 		}

 		################################################################################################################
		################################################################################################################
		################################################################################################################
		################################################################################################################

		/*public function postedconcerns(){

			$query = $this->db->query("SELECT * FROM concerns WHERE receiver = 'Administrator' OR sender = 'Administrator' ORDER BY date DESC");

			
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
					if($i['sender'] == 'Administrator' && $i['status'] != 'resolved'){
						$rem = '<input type="submit" value="Cancel" name="button" class="w3-button w3-small w3-red w3-round w3-hover-pale-red">';
					}else{
						$rem = '';
					}
					//CANCEL BUTTON | END

					if($i['status'] == 'pending' && $i['receiver'] == 'Administrator'){
						$stat = 'w3-red';
						$button = '<input type="submit" value="click here if resolved" name="button" class="w3-button w3-small w3-round w3-blue w3-hover-light-blue"> | <input type="submit" value="Decline" name="button" class="w3-button w3-small w3-round w3-red w3-hover-pale-red">';
						$border = 'w3-border-blue';
						$color = 'w3-pale-blue';
					}

					else if($i['status'] == 'pending'){
						$stat = 'w3-red';
						$button = '';
						$border = '';
						$color = '';
					}

					else if($i['status'] == 'declined'){
						$stat = 'w3-yellow';
						$button = '';
						$border = '';
						$color = '';
					}

					else{
						$stat = 'w3-green';
						$button = '';
						$border = '';
						$color = '';
					}

					echo '<div class="w3-row w3-border '.$border.' '.$color.' w3-padding w3-margin-bottom">
							<div class="w3-col w3-margin-right" style="width:4em">';
								echo $img;
						echo '
							</div>
							<div class="w3-rest">
								<form action="'.base_url().'Admin/viewedconcern/'.$i['c_id'].'" method="post">
								<p>'.$name.' | <span class="w3-badge w3-round '.$stat.'">'.$i['status'].'</span> '.$button.' '.$rem.'<br/>
								<b>'.$i['subject'].'</b></p>
								<p style="text-align: justify;">'.$i['description'].'</p>
								<small>'.date('M. j, Y - h:i A', strtotime($i['date'])).'</small>
								</form>
							</div>
						</div>';

				}
			}else{
				echo '<p class="w3-padding w3-pale-yellow w3-center">Empty</p>';
			}
			
		}*/

	}
?>