<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	class Student_model extends CI_Model {
		/*function __construct(){
			parent::__construct();
			//$this->load->database();
		}*/

		public function ifadviser($sect, $gr, $link){
			$query = $this->db->query("SELECT * FROM sections WHERE sect_name = '$sect' AND gr_level = '$gr'");
			if(count($query->result_array()) == 1){
				echo '<a href="'.base_url().'Student/advisory/'.$link.'" class="w3-bar-item w3-button w3-text-white w3-hover-text-blue w3-hover-white w3-padding-16" style="border-radius: 30px 0px 0px 30px;"><span class="fa fa-users w3-margin-left"></span>&nbsp;&nbsp;'.$sect.'</a>';
			}else{
				echo '';
			}
		}

		################################################################################################################
		################################################################################################################
		################################################################################################################
		################################################################################################################
		//DASHBOARD CONTENT
		public function subj_overview($lrn, $sessid, $gr){

			if($gr == 'Grade 11' || $gr == 'Grade 12'){
				$chk = $this->db->query("SELECT * FROM shsstudents WHERE lrn = '$lrn'");
			}else{
				$chk = $this->db->query("SELECT * FROM jhsstudents WHERE lrn = '$lrn'");
			}

			foreach ($chk->result_array() as $got) {
				$subjects = explode(", ", $got['subjects']);
			}
			
			if(!empty($got['subjects'])){
				echo '<div class="w3-row">';
				
				$i=0;
				
				for($a = 0; $a < count($subjects); $a++){
					foreach ($this->db->query("SELECT * FROM subjects WHERE subj_code = ".$subjects[$a]."")->result_array() as $subjInfo){
						$subjInfo['subj_title'];
						$subjInfo['subj_img'];
						$subjInfo['subj_desc'];
						$subjInfo['gr_level'];
						$subjInfo['subj_code'];
					}

					foreach ($this->db->query("SELECT * FROM subject_teacher WHERE subj_code = '".$subjInfo['subj_code']."'")->result_array() as $g) {
						foreach ($this->db->query("SELECT * FROM teachers WHERE id = '".$g['subj_teacher']."'")->result_array() as $teach) {
							$teachname = $teach['fname'].' '.$teach['mname'].' '.$teach['lname'];
						}
					}

					if(empty($teachname)){
						$teachname = 'No assigned Subject teacher';
					}

					echo "<div class='w3-third w3-container w3-margin-bottom'>";
		 				
		 					echo "<div class='w3-display-container' onmouseover='showDesc(".$i.")' onmouseout='hideDesc(".$i.")'>";
		 						echo "<img src='".base_url()."Subject_image/".$subjInfo['subj_img']."' load='lazy' style='max-width:23em;width:100%;max-height:12em;'>";
		 						echo "<div class='w3-hide' id='subjDesc".$i."' style='max-width:23em;width:100%;'>
		 								<a href='".base_url()."Student/subjects/".$subjInfo['subj_code']."/".$sessid."' style='text-decoration: none;'>".strtoupper($subjInfo['subj_title'])."</a><br/><small>".$teachname."</small></div>";
	 						echo "</div>
	 						
	 					</div>";
	 					
	 				$i++;
				}
			echo '</div>';

			}else{
				echo '<div class="w3-container w3-padding w3-pale-yellow w3-margin-bottom w3-center">You are not enrolled to any subjects.</div>';
			}
		}

		################################################################################################################
		################################################################################################################

		//ANNOUNCEMENTS
		public function get_announcement($gr){
			date_default_timezone_set("Asia/Manila");

			$chk = $this->db->query("SELECT * FROM announcements WHERE start_date >= '".date("Y-m-01")."' AND end_date >= '".date("Y-m-d")."' AND (audience = 'All' OR audience LIKE '%$gr%') ORDER BY start_date ASC LIMIT 2");
			if($chk->num_rows() != 0){
				foreach ($chk->result_array() as $ann) {
					$strdate = strtotime($ann['start_date']);
					$enddate = strtotime($ann['end_date']);

					echo '<div class="w3-panel w3-pale-blue w3-leftbar w3-border-blue w3-border" style="text-align: justify;">
							<p class="w3-small">'.date('M. j, Y', $strdate).' - '.date('M. j, Y', $enddate).'</p>
							<p class="w3-small"><b>'.$ann['title'].'</b><br/>'.$ann['description'].'</p>';
					echo '</div>';
				}
			}else{
				echo '<div class="w3-container w3-small w3-padding w3-pale-yellow w3-margin-bottom w3-center">No announcement posted.</div>';
			}
		}

		################################################################################################################
		################################################################################################################

		//EVENTS
		public function getEventsWithinMonth(){
			$query = $this->db->query("SELECT * FROM events WHERE start_date >= '".date("Y-m-01")."' AND end_date >= '".date("Y-m-d")."' ORDER BY start_date ASC LIMIT 3");

			if($query->num_rows() != 0){
				foreach ($query->result_array() as $events){
					$strdate = strtotime($events['start_date']);
					$enddate = strtotime($events['end_date']);

					echo '<div class="w3-panel w3-pale-blue w3-leftbar w3-border-blue w3-border w3-padding">
						<p class="w3-small">'.date('M. j, Y', $strdate).' - '.date('M. j, Y', $enddate).'</p>
						<p class="w3-small"><b>'.$events['description'].'</b></p>';
					echo '</div>';
				}
			}else{
				echo '<div class="w3-container w3-padding w3-pale-yellow w3-margin-bottom w3-center">No events posted.</div>';
			}
		}
		//DASHBOARD CONTENT | END
		################################################################################################################
		################################################################################################################
		################################################################################################################
		################################################################################################################


		################################################################################################################
		################################################################################################################
		################################################################################################################
		################################################################################################################
		//ADVISORY CLASS
		public function getClassAdv($id, $sessid, $gr, $sect){
			
			if($gr == 'Grade 11' || $gr == 'Grade 12'){
				$query = $this->db->query("SELECT * FROM shsstudents WHERE grade_level = '$gr' AND section = '$sect' ORDER BY lname");

			}else{

				$query = $this->db->query("SELECT * FROM jhsstudents WHERE grade_level = '$gr' AND section = '$sect' ORDER BY lname");
			}

			$i = 1;
			echo '<div class="w3-row-padding">';
				foreach ($query->result_array() as $stud) {
					
					if($stud['status'] == 'Dropped'){
	 					$stat = 'w3-grey';
	 					$status = '<span class="w3-small w3-tag w3-round w3-red w3-display-middle">Dropped</span>';
	 					
	 				}else{
	 					$stat = '';
	 					$status = '';
	 					//$con = '<a href="javascript:void(0)" onclick="document.getElementById(\'postconcern'.$i.'\').style.display = \'block\'" class="w3-hide" id="message'.$i.'" title="Send concern"><i class="fa fa-envelope"></i></a>';
	 					//$drop = '<a href="javascript:void(0)" onclick="document.getElementById(\'requestdrop'.$i.'\').style.display = \'block\'" class="w3-hide" id="drop'.$i.'" title="Request for Drop"><i class="fa fa-times"></i></a>';
	 				}

					if(empty($stud['photo'])){
						$img = "<i class='fa fa-user-circle-o' style='font-size:6em;'></i>";
	 				}else{
	 					$img = '<img src="'.base_url().'ProfilePic/students/'.$stud['photo'].'" load="lazy" class="w3-circle" style="max-width:6em;width:100%;max-height:6em;">';
	 				}

	 				if($stud['lrn'] == $id){
	 					$border = 'w3-border-blue';
	 				}else{
	 					$border = '';
	 				}


					echo '<div class="w3-container w3-third w3-margin-bottom">
							<div class="w3-row w3-border '.$border.' w3-padding '.$stat.'" style="height:7em">
								<div class="w3-col w3-margin-right" style="width:6em">';
									echo '<div class="w3-display-container">';
									echo $img;
									echo $status;
									//echo $con;
									//echo $drop;
									echo '</div>';
								echo '</div>
								<div class="w3-rest">
									<p>'.$stud['fname'].' '.$stud['mname'].' '.$stud['lname'].'<br/>
									('.$stud['lrn'].')</p>
								</div>
							</div>
						</div>';
					$i++;
				}
			echo '</div>';
		}

		################################################################################################################
		################################################################################################################

		public function getClassAdvSubj($id, $sessid, $gr, $sect){
			$query = $this->db->query("SELECT * FROM subject_teacher WHERE gr_level = '$gr' AND section = '$sect'");

			if($query->num_rows() > 0){
				
				echo "<div class='w3-row-padding'>";

	 			foreach ($query->result_array() as $subj) {

	 				$getTeach = $this->db->query("SELECT * FROM teachers WHERE id = '".$subj['subj_teacher']."'");
	 				foreach ($getTeach->result_array() as $TeachInfo) {
	 					$name = $TeachInfo['fname'].' '.$TeachInfo['mname'].' '.$TeachInfo['lname'].' - '.$TeachInfo['Rank'];
	 					$tid = $TeachInfo['id'];

	 					$getsubj = $this->db->query("SELECT * FROM subjects WHERE subj_code = '".$subj['subj_code']."'");
	 					foreach ($getsubj->result_array() as $subjInfo) {
	 						$subj_name = $subjInfo['subj_title'];
	 						$src = $subjInfo['subj_img'];
	 						$link = $subjInfo['subj_code'];
	 					}
	 				}
	 				echo "<div class='w3-col m4 w3-margin-bottom'>";
		 				echo "<div class='w3-display-container'>";
		 					echo "<img src='".base_url()."Subject_image/".$src."' load='lazy' style='max-width:24em;width:100%;max-height:12em;'>";
		 					echo "<div class='w3-display-bottomleft w3-padding w3-blue' style='width:100%;'><p>".strtoupper($subj_name)."<br/>".$name."</p></div>";
	 					echo "</div>
	 				</div>";
	 			}
	 			echo '</div>';
				
			}else{
				echo '<p class="w3-pale-yellow w3-padding w3-center">No Subject teachers assigned.</p>';
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
		public function listOfSubjs($id, $subj, $sessid){

			$subjects = explode(", ", $subj);

			$dir = base_url().'Subject_image/';

			if($subj != ''){
				for ($a = 0; $a < count($subjects); $a++) {

					foreach ($this->db->query("SELECT * FROM subjects WHERE subj_code = '".$subjects[$a]."'")->result_array() as $subjInfo) {
						
						if(strlen($subjInfo['subj_desc']) >= 200){
	 						$ellep = "...";
	 					}else{
	 						$ellep = "";
	 					}


	 					echo '<div class="w3-row w3-border w3-padding w3-margin-bottom w3-margin-top">';
	 					echo '<div class="w3-col w3-margin-right" style="width:8em">';

	 					
	 						echo '<img load="lazy" class="w3-image" src="'.$dir.$subjInfo['subj_img'].'" style="max-width:8em;height:8em;">';
	 					

	 					echo '</div>';

	 					echo '<div class="w3-rest">';
	 						echo '<a href="'.base_url().'Student/subjects/'.$subjInfo['subj_code'].'/'.$sessid.'" style="text-decoration:none;"><h3>'.strtoupper($subjInfo['subj_title']).'</h3></a>';

	 						if(strlen($subjInfo['subj_desc']) >= 200){
	 							$ellep = "...";
	 						}else{
	 							$ellep = "";
	 						}
	 						
	 						echo '<p><i style="color:#666666;">'.substr($subjInfo['subj_desc'], 0, 200).$ellep.'</i></p>';
	 					echo '</div>';
	 				echo '</div>';

					}
					
				}
			}else{
				echo '<div class="w3-container w3-padding w3-pale-yellow w3-margin w3-center">You are not enrolled to any subjects.</div>';
			}
		}

		################################################################################################################
		################################################################################################################

		//GET SUBJECT CONTENT
		public function getSubjectContent($id, $link, $code, $title, $gr, $section){

			$table = str_replace(" ", "", str_replace("-", "_", $section)).'_'.str_replace(" ", "", $gr).'_'.$code;
			
			if($this->db->query("SHOW TABLES LIKE '$table'")->num_rows() == 1){
				$this->load->helper('download');


				$query = $this->db->query("SELECT * FROM $table");

				if($query->num_rows() > 0){

					foreach ($query->result_array() as $content) {
					    $arr[] = $content['lesson'];
					}

					natsort($arr);
					$sortlesson = implode(", ", $arr);
					$sortedlesson = explode(", ", $sortlesson); //CHANGED INDEX
					for ($y = 0; $y < count($sortedlesson); $y++) { 
						
						foreach ($this->db->query("SELECT * FROM $table WHERE lesson = '".$sortedlesson[$y]."'")->result_array() as $content) {
							
							echo '<div class="w3-border w3-padding w3-margin-bottom">
									'.strtoupper('<h3>'.$content['lesson']).'</h3>';
							echo '<div class="w3-padding">';

							//MODULE SECTION
							if(!empty($content['module'])){
								$module = explode(", ", $content['module']);
								natsort($module); //NATURAL SORTING
								$sort = implode(", ", $module);
								$sorted = explode(", ", $sort);
								//$file = explode(". ", $content['filename']);
								$dir = $title.'_'.$gr.'_'.$section;

								for($i = 0; count($module) > $i; $i++){
									echo '<a href="'.base_url().'Student/downloadFile/'.$link.'/'.$title.'/'.$gr.'/'.$section.'/'.$sorted[$i].'/'.$content['lesson'].'/'.$code.'" class="w3-padding w3-hover-text-blue" style="text-decoration: none;"><span class="fa fa-files-o"></span> '.str_replace(".pdf", "", str_replace(".doc", "", str_replace(".docx", "", str_replace(".txt", "", str_replace(".ppt", "", str_replace(".pptx", "", str_replace("_", ",", $sorted[$i]))))))).'</a><br/>';
								}
							}
							//MODULE SECTION | END


							//ACTIVITY SECTION
							if(!empty($content['activity'])){
								$acts = explode(", ", $content['activity']);
								natsort($acts);
								$sortacts = implode(", ", $acts);
								$sortedacts = explode(", ", $sortacts);

								echo '<br/>';
								for ($m=0; count($acts) > $m ; $m++) { 
									echo '<a href="'.base_url().'Student/viewactivity/'.$link.'/'.$title.'/'.$gr.'/'.$section.'/'.$sortedacts[$m].'/'.$code.'/'.$content['lesson'].'" class="w3-padding w3-hover-text-blue" style="text-decoration: none;"><span class="fa fa-file-text-o"></span> '.str_replace("_", ",", $sortedacts[$m]).'</a><br/>';
								}
							}
							//ACTIVITY SECTION | END


							//QUIZ SECTION
							if(!empty($content['quiz'])){
								$quiz = explode(", ", $content['quiz']);
								natsort($quiz);
								$sortquiz = implode(", ", $quiz);
								$sortedquiz = explode(", ", $sortquiz);

								echo '<br/>';
								for ($n=0; count($quiz) > $n ; $n++) { 
									echo '<a href="'.base_url().'Student/viewquiz/'.$link.'/'.$title.'/'.$gr.'/'.$section.'/'.$sortedquiz[$n].'/'.$code.'/'.$content['lesson'].'" class="w3-padding w3-hover-text-blue" style="text-decoration: none;"><span class="fa fa-file-text"></span> '.str_replace("_", ",", $sortedquiz[$n]).'</a><br/>';
								}
							}
							//QUIZ SECTION | END


							//REF SECTION
							if(!empty($content['addref'])){
								$ref = explode(", ", $content['addref']);
								natsort($ref);
								$sortref = implode(", ", $ref);
								$sortedref = explode(", ", $sortref);

								echo '<br/>';
								for ($o=0; count($ref) > $o ; $o++) { 
									echo '<a href="'.$sortedref[$o].'" class="w3-padding w3-hover-text-blue" style="text-decoration: none;" target="_blank">'.$sortedref[$o].'</a><br/>';
								}
							}
							//REF SECTION | END
							
							echo '</div></div>';

						}
					}
					
					
				}else{
					echo "<p class='w3-pale-yellow w3-padding w3-center'>No content found.</p>";
				}

				echo '<hr/>';


				//SUBJECT TEACHER
				echo '<div class="w3-container w3-border">';
				foreach ($this->db->query("SELECT * FROM subject_teacher WHERE subj_code = $code AND gr_level = '$gr' AND section = '$section'")->result_array() as $t_info) {
					foreach ($this->db->query("SELECT * FROM teachers WHERE id = '".$t_info['subj_teacher']."'")->result_array() as $TeacherInfo) {
						
						if(empty($TeacherInfo['photo'])){
	 						$img = "<span class='fa fa-user-circle-o' style='font-size:6em;'></span>";
	 					}else{
	 						$img = '<img src="'.base_url().'ProfilePic/teachers/'.$TeacherInfo['photo'].'" style="max-width:6em;width:100%;max-height:6em" class="w3-circle">';
	 					}

						
						echo '<div class="w3-row w3-margin-top">
								<div class="w3-col w3-margin-right" style="width:6em">';
							echo '<div class="w3-display-container" onmouseover="showButtons(1)" onmouseout="hideButtons(1)">';
								echo $img;
								echo '<a href="javascript:void(0)" onclick="document.getElementById(\'postconcern\').style.display = \'block\'" class="w3-hide" id="message1"><i class="fa fa-envelope" title="Send message"></i></a>';
							echo '</div>
								</div>
								<div class="w3-rest">
									<p><b>'.$TeacherInfo['fname'].' '.$TeacherInfo['mname'].' '.$TeacherInfo['lname'].'</b><br/>
										'.$TeacherInfo['email'].'<br/>
										'.$TeacherInfo['id'].'</p>
								</div>
							</div>';


						echo '<div class="w3-modal" id="postconcern">
				            <div class="w3-modal-content w3-animate-top">
				                <header class="w3-container w3-blue">
				                    <span onclick="document.getElementById(\'postconcern\').style.display=\'none\'" 
				                class="w3-button w3-display-topright w3-blue w3-hover-light-blue">&times;</span>
				                    <h3>SEND A CONCERN TO '.strtoupper($TeacherInfo['fname']).' '.strtoupper($TeacherInfo['lname']).'</h3>
				                </header>
				                <div class="w3-container w3-padding-large">
				                    <form action="'.base_url().'Student/postconcern/'.$link.'" method="post" class="w3-padding">
				                        <input type="text" name="rec" class="w3-input w3-border w3-round" placeholder="Recepient id" required autocomplete="off" value="'.$TeacherInfo['id'].'">
				                        <br/>
				                        <input type="text" name="concern" class="w3-input w3-border w3-round" placeholder="Concern" required autocomplete="off">
				                        <br/>
				                        <textarea class="w3-input w3-border w3-round" name="desc" placeholder="Description" style="resize: none; width: 100%; height: 150px;" required></textarea>
				                        <br/>
				                        <input type="submit" class="w3-button w3-block w3-blue w3-round w3-hover-light-blue" value="Post concern">
				                    </form>
				                </div>
				                <footer class="w3-container w3-blue w3-padding-large"></footer>
				            </div>
				        </div>';
						
					}
				}
				echo '</div>';
				//SUBJECT TEACHER | END

			}else{
				echo '<p class="w3-pale-yellow w3-padding w3-center">No assigned Subject Teacher.</p>';
			}

		}

		################################################################################################################
		################################################################################################################

		public function getActivityContent($id, $sessid, $code, $title, $gr, $section, $lesson, $subj){
			$table = str_replace(" ", "", str_replace("-", "_", $section)).'_'.str_replace(" ", "", $gr).'_'.$code;

			if($this->db->query("SHOW TABLES LIKE '$table'")->num_rows() == 1){
				date_default_timezone_set("Asia/Manila");
				
				foreach($this->db->query("SELECT * FROM activities WHERE subj_code = $code AND lesson_title = '$lesson' AND grade_level = '$gr' AND section = '$section' AND activity_title = '$title'")->result_array() as $got){

					$query = $this->db->query("SELECT * FROM activities_submit WHERE subj_code = $code AND lesson_title = '$lesson' AND grade_level = '$gr' AND section = '$section' AND activity_title = '$title' AND lrn = '$id'");

					//REMAINING ATTEMPTS
					if($query->num_rows() == 1){
						foreach ($query->result_array() as $res) {
							if($res['grade'] == 0){
								$remove = '';
							}else{
								$remove = '<br/><br/><b>Graded: </b>'.$res['grade'].'/100';
							}
							$submitted = '<p class="w3-padding w3-pale-green"><b>Submitted file:</b> <i class="fa fa-file-o"></i> <a href="'.base_url().'Student/downloadSubmitted/'.$sessid.'/'.$subj.'/'.$gr.'/'.$section.'/'.$res['file_submitted'].'/'.$lesson.'/'.$code.'/'.$title.'" class="w3-hover-text-blue">'.$res['file_submitted'].'</a> '.date("M. j, Y - h:i A", strtotime($res['date_submitted'])).' '.$remove.'</p>';
							$attempt = $got['attempt'] - $res['attempt'];

						}
					}else{
						$submitted = '';
						$attempt = $got['attempt'];
						$res['grade'] = 0;
					}
					//REMAINING ATTEMPTS | END

					
					$convert = strtotime($got['due_date']);
					$due = date('M. j, Y - h:i A', $convert);


					//ATTACHED FILE
					if(!empty($got['related_file'])){
						$dir = $subj.'_'.$gr.'_'.$section.'/'.str_replace(":", "-", $lesson).'/';
						$file = '<p><b>Related file:</b> <i class="fa fa-file-text-o"></i> <a href="'.base_url().'Student/downloadAttach/'.$sessid.'/'.$subj.'/'.$gr.'/'.$section.'/'.$got['related_file'].'/'.$lesson.'/'.$code.'/'.$title.'" class="w3-hover-text-blue">'.$got['related_file'].'</a></p>';
					}else{
						$file = '';
					}
					//ATTACHED FILE | END


					if($got['filetoaccept'] == 'pdf'){
						$acceptfile = '.pdf';
					}else if($got['filetoaccept'] == 'docx'){
						$acceptfile = '.doc, .docx';
					}else if($got['filetoaccept'] == 'ppt'){
						$acceptfile = '.ppt, .pptx';
					}else if($got['filetoaccept'] == 'excel'){
						$acceptfile = '.xlxs, .xls';
					}else{
						$acceptfile = '.docx, .doc, .pdf, .ppt, .pptx, .xlsx, .xls';
					}


					if(date('Y-m-d H:i A', $convert) < date('Y-m-d H:i A')){
						$stat = '<span class="w3-tag w3-red w3-round">Terminated</span>';
						
						$form = '<div class="w3-container w3-border w3-padding w3-light-grey"><p>This activity is terminated.</p></div>';
						
					}else{
						$stat = '<span class="w3-tag w3-green w3-round">Ongoing</span>';
						if($attempt == 0){
							$form = '<div class="w3-container w3-border w3-padding w3-light-grey"><p>You have no remaining attempts.</p></div>';
						}else if($res['grade'] != 0){
							$form = '<div class="w3-container w3-border w3-padding w3-light-grey"><p>Your activity has been graded.</p></div>';
						}else{
							$form = '<div class="w3-container w3-border w3-padding w3-light-grey">
							<form action="'.base_url().'Student/Submitactivity/'.$sessid.'" method="post" enctype="multipart/form-data" style="margin: auto; width: 80%"">
								<p><b>Attempt/s:</b> '.$attempt.'</p>
								<p><b>Attach a file to submit:</b></p>
								<input type="file" class="w3-input w3-border w3-round w3-margin-bottom" name="filetosubmit" accept="'.$acceptfile.'" required>
								<input type="hidden" name="subjcode" value="'.$code.'">
								<input type="hidden" name="subj" value="'.$subj.'">
								<input type="hidden" name="lesson" value="'.$lesson.'">
								<input type="hidden" name="gr" value="'.$gr.'">
								<input type="hidden" name="sect" value="'.$section.'">
								<input type="hidden" name="act" value="'.$title.'">
								<input type="hidden" name="acceptfile" value="'.$acceptfile.'">
								<input type="submit" value="Submit" class="w3-button w3-blue w3-hover-light-blue w3-round">
							</form>
							</div>';
						}
					}


					echo '<p><b>Deadline:</b> '.$due.' '.$stat.'</p>';
					echo '<p><b>Description:</b></p>';
					echo '<pre style="overflow: auto; white-space: pre-wrap; word-wrap: break-word; text-align: justify;">'.$got['instruction'].'</pre>';
					echo $file;
					echo '<p><b>Accepted filetype:</b> '.$acceptfile.'</p>';
					echo '<b>Rubrics: </b><br/>';

					$rub = explode(", ", $got['Rubrics']);
					echo '<table class="w3-table w3-bordered w3-centered w3-border">
					<tr class="w3-light-grey"><th>Criteria</th><th>Percentage</th></tr>';
					for($a = 0; $a < count($rub); $a++){
						$hmp = explode(": ", $rub[$a]);
						echo '<tr>';
						for ($b = 0; $b < count($hmp); $b++) { 
							echo '<td>'.$hmp[$b].'</td>';
						}
						echo '</tr>';
					}
					echo '</table>';

					echo '<hr/>';
					echo $submitted;
					echo $form;
					
				}

			}else{
				$this->session->set_flashdata('error', 'Table not found.');
				header('Location:'.base_url().'Student/subjects/'.$code.'/'.$sessid);
			}

		}

		################################################################################################################
		################################################################################################################

		public function getQuizContent($sessid, $code, $title, $gr, $section, $lesson, $subj, $id){
			$table = str_replace(" ", "", str_replace("-", "_", $section)).'_'.str_replace(" ", "", $gr).'_'.$code;

			if($this->db->query("SHOW TABLES LIKE '$table'")->num_rows() == 1){
				date_default_timezone_set("Asia/Manila");
				

				foreach($this->db->query("SELECT * FROM quiz WHERE subj_code = $code AND lesson_title = '$lesson' AND grade_level = '$gr' AND section = '$section' AND quiz_title = '$title'")->result_array() as $got){

					$query = $this->db->query("SELECT * FROM quiz_submit WHERE subj_code = $code AND lesson_title = '$lesson' AND grade_level = '$gr' AND section = '$section' AND quiz_title = '$title' AND lrn = '$id'");

					$convert = strtotime($got['deadline']);
					$due = date('M. j, Y - h:i A', $convert);

					//setTimeout(function(){window.location.reload();}, 10);
					//to take exam
					echo '<div class="w3-modal" id="takeexam">
						<div class="w3-modal-content w3-animate-zoom" style="width: 50%">
							<header class="w3-container w3-blue">
						    	<h2>'.$title.'</h2>
						    </header>

						    <div class="w3-container w3-margin">
						    	<p style="text-indent: 3em; text-align: justify">This is a timed exam/quiz. When you start, the timer will begin to count down and cannot be paused. You must finish your attempt before it expires. Are you sure you wish to start now?<br/><p class="w3-text-red"><b>Note: </b><i>Refreshing the page while taking the exam will use your attempt.</i></p></p><br/>
						      	<form action="'.base_url().'Student/takeexam/'.$sessid.'" method="post" target="_self" onsubmit="window.top.close()">
						      		<input type="hidden" name="subjcode" value="'.$code.'">
									<input type="hidden" name="subj" value="'.$subj.'">
									<input type="hidden" name="lesson" value="'.$lesson.'">
									<input type="hidden" name="gr" value="'.$gr.'">
									<input type="hidden" name="sect" value="'.$section.'">
									<input type="hidden" name="quiz" value="'.$title.'">
									<input type="submit" value="Start attempt" class="w3-button w3-blue w3-hover-light-blue w3-round">
									<input type="button" value="Cancel" class="w3-button w3-red w3-hover-pale-red w3-round" onclick="document.getElementById(\'takeexam\').style.display=\'none\'">
						      	</form>
									
						    </div>

						    <footer class="w3-container w3-blue">
						      	<p></p>
						    </footer>
						</div>
					</div>';
					//to take exam | end

					
					//REMAINING ATTEMPTS
					if($query->num_rows() != 0){
						foreach ($query->result_array() as $res) {
							$attempt = $got['attempt'] - $res['attempt'];
							$submitted[] = array($res['attempt'], $res['date_submitted'], $res['score'], $res['total']);
						}
					}else{
						$submitted[] = null;
						$attempt = $got['attempt'];
						$res['score'] = 0;
					}
					//REMAINING ATTEMPTS | END



					if(date('Y-m-d H:i A', $convert) < date('Y-m-d H:i A')){
						$stat = '<span class="w3-tag w3-red w3-round">Terminated</span>';
						
						$form = '<div class="w3-container w3-border w3-padding w3-light-grey"><p>This exam is terminated.</p></div>';
						
					}else{
						$stat = '<span class="w3-tag w3-green w3-round">Ongoing</span>';
						if($attempt == 0){
							$form = '<div class="w3-container w3-border w3-padding w3-light-grey"><p>You have no remaining attempts.</p></div>';
						}else{
							$form = '<div class="w3-container w3-border w3-padding w3-light-grey">
								<p><b>Duration:</b> '.$got['duration'].' minute/s<br/>
								<b>Attempt/s:</b> '.$attempt.'<br/>
								<b>Content:</b> '.str_replace("{", "", str_replace("}", "", str_replace("%20", " ", $got['typeofexam']))).'</p>
								<a href="javascript:void(0)" onclick="document.getElementById(\'takeexam\').style.display = \'block\'" class="w3-button w3-blue w3-hover-light-blue w3-round">Take exam</a>
							</div>';
						}
					}
					
					echo '<p><b>Deadline:</b> '.$due.' '.$stat.'</p>';
					if($this->db->query("SELECT * FROM quiz_submit WHERE subj_code = $code AND lesson_title = '$lesson' AND grade_level = '$gr' AND section = '$section' AND quiz_title = '$title' AND lrn = '$id'")->num_rows() > 0){
						for($i=0; $i < count($submitted); $i++){
								echo '<tr>';
								for ($j=0; $j < count($submitted[$i]); $j++) {
									if($j == 2){
										$scores[] = $submitted[$i][$j];
									}
								}
								echo '</tr>';
							}
						
							echo '<div class="w3-margin-bottom" style="overflow-x: auto;"><table class="w3-table w3-bordered w3-centered w3-border">';
							echo '<tr class="w3-light-grey"><th>Attempt</th><th>Date submitted</th><th>Score</th><th>Total</th></tr>';
							
							for($i=0; $i < count($submitted); $i++){
								echo '<tr>';
								for ($j=0; $j < count($submitted[$i]); $j++) {
									if($j == 1){
										$s = strtotime($submitted[$i][1]);
										$submitted[$i][$j] = date('M. j, Y - h:i A', $s);
									}
									
									if(max($scores) == $submitted[$i][2]){
										echo '<td class="w3-pale-green"><b>'.$submitted[$i][$j].'</b></td>';
									}else{
										echo '<td>'.$submitted[$i][$j].'</td>';
									}
									
								}
								echo '</tr>';
							}
						echo '</table></div>';
					}

					echo $form;
				}
			}else{
				$this->session->set_flashdata('error', 'Table not found.');
				header('Location:'.base_url().'Student/subjects/'.$code.'/'.$sessid);
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
		public function listOfSubjectsToGrade($sessid, $gr, $section){
			$ID = str_replace("_47_", "/", str_replace("_50_", "=", $sessid));
			$decID = $this->encryption->decrypt($ID);

			$sessid = str_replace("/", "_47_", str_replace("=", "_50_", $ID));

			if($gr == 'Grade 11' || $gr == 'Grade 12'){
				$query = $this->db->query("SELECT * FROM shsstudents WHERE lrn = '$decID' AND grade_level = '$gr'");
			}else{
				$query = $this->db->query("SELECT * FROM jhsstudents WHERE lrn = '$decID' AND grade_level = '$gr'");
			}

			foreach ($query->result_array() as $subj) {
				$subjs = explode(", ", $subj['subjects']);
			}


			if(empty($subj['subjects'])){
				echo '<p class="w3-center w3-pale-yellow w3-padding">You are not enrolled to any subjects.</p>';

			}else{
				for($i = 0; $i < count($subjs); $i++){
					$table = str_replace(" ", "", str_replace("-", "_", $section)).'_'.str_replace(" ", "", $gr).'_'.$subjs[$i];
					foreach ($this->db->query("SELECT * FROM subjects WHERE subj_code = $subjs[$i]")->result_array() as $t) {
						echo '<h4><b>'.$t['subj_title'].'</b></h4>';
					}
					if($this->db->query("SHOW TABLES LIKE '$table'")->num_rows() == 1){
						
						echo '<div class="w3-margin-bottom" style="overflow-x:auto;"><table class="w3-table-all w3-centered w3-small">';
								
							echo '<thead><tr class="w3-light-grey">';
								foreach ($this->db->query("SELECT * FROM $table")->result_array() as $a) {
									$acts = explode(", ", $a['activity']);
									for ($b=0; $b < count($acts); $b++) { 
										if (empty($acts[$b])) {}

										else{
											echo '<th>'.str_replace("_", ",", $acts[$b]).'</th>';
										}
									}

									$quiz = explode(", ", $a['quiz']);
									for ($c=0; $c < count($quiz); $c++) { 
										if (empty($quiz[$c])) {}

										else{
											echo '<th>'.str_replace("_", ",", $quiz[$c]).'</th>';
										}
									}
								}
							echo '</tr></thead>';

								foreach ($query->result_array() as $st) {
									echo '<tr>';

									foreach ($this->db->query("SELECT * FROM $table")->result_array() as $a) {
										$acts = explode(", ", $a['activity']);
										
										for ($b=0; $b < count($acts); $b++) { 
											if (empty($acts[$b])) {}
											
											else{
												$checka = $this->db->query("SELECT *, MAX(grade) AS mgrade FROM activities_submit WHERE subj_code = ".$subjs[$i]." AND lesson_title = '".$a['lesson']."' AND grade_level = '$gr' AND section = '$section' AND activity_title = '".$acts[$b]."' AND lrn = '".$st['lrn']."'");

												if($checka->num_rows() == 0){
													echo '<td></td>';
												
												}else{
													foreach ($checka->result_array() as $info) {
														if($acts[$b] == $info['activity_title']){
															echo '<td>'.$info['mgrade'].'</td>';

														}else{
															echo '<td></td>';
														}
													}
												}
											}
										}

										$quiz = explode(", ", $a['quiz']);
										for ($c=0; $c < count($quiz); $c++) { 
											if (empty($quiz[$c])) {}
											else{
												$checkq = $this->db->query("SELECT *, MAX(score) AS mscore FROM quiz_submit WHERE subj_code = ".$subjs[$i]." AND lesson_title = '".$a['lesson']."' AND grade_level = '$gr' AND section = '$section' AND quiz_title = '".$quiz[$c]."' AND lrn = '".$st['lrn']."'");

												if($checkq->num_rows() == 0){
													echo '<td></td>';
												
												}else{
													foreach ($checkq->result_array() as $info) {	
														if($quiz[$c] == $info['quiz_title']){
															echo '<td>'.$info['mscore'].'</td>';

														}else{
															echo '<td></td>';
														}
													}
												}
											}
										}
									}
									echo '</tr>';
								}
						
						echo '</table></div>';

					}else{
						echo '<p class="w3-center w3-pale-yellow w3-padding">No data to display.</p>';
						//$this->session->set_flashdata('error', 'Table not found.');
						//header('Location:'.base_url().'Student/grading/'.$sessid);
					}
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
		//SUBJECTS | END
		public function postedconcerns($sessid){
			
			$ID = str_replace("_47_", "/", str_replace("_50_", "=", $sessid));
			$decID = $this->encryption->decrypt($ID);
			$query = $this->db->query("SELECT * FROM concerns WHERE receiver = '$decID' OR sender = '$decID'");

			$sessid = str_replace("/", "_47_", str_replace("=", "_50_", $ID));

			if($query->num_rows() != 0){
				foreach ($query->result_array() as $i) {
					foreach ($this->db->query("SELECT * FROM teachers WHERE id = '".$i['sender']."'")->result_array() as $info) {
						$name = $info['fname'].' '.$info['mname'].' '.$info['lname'];
						$id = $info['id'];

						if(empty($info['photo'])){
	 						$img = "<span class='fa fa-user-circle-o' style='font-size:6em;'></span>";
	 					}else{
	 						$img = '<img src="'.base_url().'ProfilePic/teachers/'.$info['photo'].'" style="max-width:4em;width:100%;max-height:4em" class="w3-circle">';
	 					}

					}

					if($i['status'] == 'pending' && $i['receiver'] == $decID){
						$stat = 'w3-pale-red';
						$button = '<input type="submit" value="click here if resolved" class="w3-button w3-small w3-round w3-blue w3-hover-light-blue">';
					}

					else if($i['status'] == 'pending'){
						$stat = 'w3-pale-red';
						$button = '';
					}

					else{
						$stat = 'w3-pale-green';
						$button = '';
					}

					echo '<div class="w3-row w3-border w3-padding w3-margin-bottom">
							<div class="w3-col w3-margin-right" style="width:4em">';
								echo $img;
						echo '
							</div>
							<div class="w3-rest">
								<form action="'.base_url().'Student/viewedconcern/'.$sessid.'" method="post">
								<p>'.$name.' | <span class="w3-badge w3-round '.$stat.'">'.$i['status'].'</span> '.$button.'<br/>
								<input type="hidden" name="cid" value='.$i['c_id'].'>
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
			
		}
	}
?>