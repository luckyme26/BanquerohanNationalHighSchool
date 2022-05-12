<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	class Teachers_model extends CI_Model {
		/*function __construct(){
			parent::__construct();
			//$this->load->database();
		}*/

		public function ifadviser($id, $link){
			$query = $this->db->query("SELECT * FROM sections WHERE adviser = '$id'");
			if(count($query->result_array()) == 1){
				echo '<a href="'.base_url().'Teacher/advisory/'.$link.'" class="w3-bar-item w3-button w3-text-white w3-hover-text-blue w3-hover-white w3-padding-16" style="border-radius: 30px 0px 0px 30px;"><span class="fa fa-users w3-margin-left"></span>&nbsp;&nbsp;Advisory Class</a>';
			}else{
				echo '';
			}
		}

		################################################################################################################
		################################################################################################################
		################################################################################################################
		################################################################################################################
		//DASHBOARD CONTENT
		public function subj_overview($id, $link){
			$chk = $this->db->query("SELECT * FROM subject_teacher WHERE subj_teacher = '$id' LIMIT 2");
			$count = $this->db->query("SELECT * FROM subject_teacher WHERE subj_teacher = '$id'")->result_array();
			
			if($chk->num_rows() != 0){
				if(count($count) > 2){
					$slink = '<a href="'.base_url().'Teacher/subjects/overview/'.$link.'" class="w3-small">Show all</a>';
				}else{
					$slink = '';
				}

				echo '<div class="w3-row">';
				
				$i=0;
				foreach ($chk->result_array() as $subj) {
					
					foreach ($this->db->query("SELECT * FROM subjects WHERE subj_code = ".$subj['subj_code']." ORDER BY gr_level ASC")->result_array() as $subjInfo){
						$subjInfo['subj_title'];
						$subjInfo['subj_img'];
						$subjInfo['subj_desc'];
						$subjInfo['gr_level'];
						$subjInfo['subj_code'];
					}
					echo "<div class='w3-half w3-container w3-margin-bottom'>";
		 				
		 					echo "<div class='w3-display-container' onmouseover='showDesc(".$i.")' onmouseout='hideDesc(".$i.")'>";
		 						echo "<img src='".base_url()."Subject_image/".$subjInfo['subj_img']."' load='lazy' style='max-width:23em;width:100%;max-height:12em;'>";
		 						echo "<div class='w3-hide' id='subjDesc".$i."' style='max-width:23em;width:100%;'><a href='".base_url()."Teacher/subjects/".$subjInfo['subj_code']."/".$link."'>".strtoupper($subjInfo['subj_title'])."</a><br/>".$subjInfo['gr_level']." - ".$subj['section']."</div>";
	 						echo "</div>
	 						
	 					</div>";
	 					
	 				$i++;
				}
			echo '<p>'.$slink.'</p></div>';

			}else{
				echo '<div class="w3-container w3-padding w3-pale-yellow w3-margin-bottom w3-center">You are not assigned to any subjects.</div>';
			}
		}

		################################################################################################################
		################################################################################################################

		//EVENTS
		public function getEventsWithinMonth(){
			date_default_timezone_set("Asia/Manila");

			$query = $this->db->query("SELECT * FROM events WHERE start_date >= '".date("Y-m-01")."' AND end_date >= '".date("Y-m-d")."' ORDER BY start_date ASC LIMIT 3");
				
			if($query->num_rows() != 0){
				foreach ($query->result_array() as $events){
					$strdate = strtotime($events['start_date']);
					$enddate = strtotime($events['end_date']);

					echo '<div class="w3-panel w3-pale-blue w3-leftbar w3-border-blue w3-border w3-small w3-padding">
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
		public function getClassAdv($id, $sessid, $advgr, $advsect){
			
			if($advgr == 'Grade 11' || $advgr == 'Grade 12'){
				$i = 1;
				echo '<div class="w3-row-padding">';
				foreach ($this->db->query("SELECT * FROM shsstudents WHERE grade_level = '$advgr' AND section = '$advsect' ORDER BY lname")->result_array() as $stud) {
					
					if($stud['status'] == 'Dropped'){
	 					$stat = 'w3-grey';
	 					$status = '<span class="w3-small w3-tag w3-round w3-red w3-display-middle"><b>Dropped</b></span>';
	 					$con = '';
	 					$drop = '';
	 				}else{
	 					$stat = '';
	 					$status = '';
	 					$con = '<a href="javascript:void(0)" onclick="document.getElementById(\'postconcern'.$i.'\').style.display = \'block\'" class="w3-hide" id="message'.$i.'" title="Send concern"><i class="fa fa-envelope"></i></a>';
	 					$drop = '<a href="javascript:void(0)" onclick="document.getElementById(\'requestdrop'.$i.'\').style.display = \'block\'" class="w3-hide" id="drop'.$i.'" title="Request for Drop"><i class="fa fa-times"></i></a>';
	 				}

					if(empty($stud['photo'])){
						$img = "<i class='fa fa-user-circle-o' style='font-size:6em;'></i>";
	 				}else{
	 					$img = '<img src="'.base_url().'ProfilePic/students/'.$photo.'" class="w3-circle" style="max-width:6em;width:100%;max-height:6em;">';
	 				}

					echo '<div class="w3-third w3-container w3-margin-bottom">
							<div class="w3-row w3-border w3-padding '.$stat.'" style="height:7em">
								<div class="w3-col w3-margin-right" style="width:6em">';
									echo '<div class="w3-display-container" onmouseover="showButtons('.$i.')" onmouseout="hideButtons('.$i.')">';
									echo $img;
									echo $status;
									echo $con;
									echo $drop;
									echo '</div>';
								echo '</div>
								<div class="w3-rest">
									<p><a href="'.base_url().'Teacher/viewstudent/'.$sessid.'/'.$stud['lrn'].'/'.$stud['grade_level'].'/'.$stud['section'].'">'.$stud['fname'].' '.$stud['mname'].' '.$stud['lname'].'</a><br/>
									('.$stud['lrn'].')</p>
								</div>
							</div>
						</div>';


					echo '<div class="w3-modal" id="postconcern'.$i.'">
				            <div class="w3-modal-content w3-animate-top">
				                <header class="w3-container w3-blue">
				                    <span onclick="document.getElementById(\'postconcern'.$i.'\').style.display=\'none\'" 
				                class="w3-button w3-display-topright w3-blue w3-hover-light-blue">&times;</span>
				                    <h3>SEND CONCERN TO '.strtoupper($stud['fname']).' '.strtoupper($stud['lname']).'</h3>
				                </header>
				                <div class="w3-container w3-padding-large">
				                    <form action="'.base_url().'Teacher/postconcern/'.$sessid.'" method="post" class="w3-padding">
				                        <input type="text" name="rec" class="w3-input w3-border w3-round" placeholder="Recepient id" required autocomplete="off" value="'.$stud['lrn'].'">
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


				    echo '<div class="w3-modal" id="requestdrop'.$i.'">
				            <div class="w3-modal-content w3-animate-top">
				                <header class="w3-container w3-blue">
				                    <span onclick="document.getElementById(\'requestdrop'.$i.'\').style.display=\'none\'" 
				                class="w3-button w3-display-topright w3-blue w3-hover-light-blue">&times;</span>
				                    <h3>REQUEST TO DROP '.strtoupper($stud['fname']).' '.strtoupper($stud['lname']).'</h3>
				                </header>
				                <div class="w3-container w3-padding-large">
				                    <form action="'.base_url().'Teacher/postconcern/'.$sessid.'" method="post" class="w3-padding">
				                        <input type="text" name="rec" class="w3-input w3-border w3-round" required value="Administrator" disabled>
				                        <input type="hidden" name="rec" value="Administrator">
				                        <br/>
				                        <input type="text" name="concern" class="w3-input w3-border w3-round" placeholder="Concern" required autocomplete="off" value="Request to Drop '.$stud['fname'].' '.$stud['lname'].' ('.$stud['lrn'].') - '.$stud['grade_level'].' '.$stud['section'].'">
				                        <br/>
				                        <textarea class="w3-input w3-border w3-round" name="desc" placeholder="Please state your reason..." style="resize: none; width: 100%; height: 150px;" required></textarea>
				                        <br/>
				                        <input type="submit" class="w3-button w3-block w3-blue w3-round w3-hover-light-blue" value="Post concern">
				                    </form>
				                </div>
				                <footer class="w3-container w3-blue w3-padding-large"></footer>
				            </div>
				        </div>';


					$i++;
				}
				echo '</div>';

			}else{
				$i = 1;
				echo '<div class="w3-row-padding">';
				foreach ($this->db->query("SELECT * FROM jhsstudents WHERE grade_level = '$advgr' AND section = '$advsect' ORDER BY lname ASC")->result_array() as $stud) {
					
					if($stud['status'] == 'Dropped'){
	 					$stat = 'w3-grey';
	 					$status = '<span class="w3-small w3-tag w3-round w3-red w3-display-middle">Dropped</span>';
	 					$con = '';
	 					$drop = '';
	 				}else{
	 					$stat = '';
	 					$status = '';
	 					$con = '<a href="javascript:void(0)" onclick="document.getElementById(\'postconcern'.$i.'\').style.display = \'block\'" class="w3-hide" id="message'.$i.'" title="Send concern"><i class="fa fa-envelope"></i></a>';
	 					$drop = '<a href="javascript:void(0)" onclick="document.getElementById(\'requestdrop'.$i.'\').style.display = \'block\'" class="w3-hide" id="drop'.$i.'" title="Request for Drop"><i class="fa fa-times"></i></a>';
	 				}

					if(empty($stud['photo'])){
						$img = "<i class='fa fa-user-circle-o' style='font-size:6em;'></i>";
	 				}else{
	 					$img = '<img src="'.base_url().'ProfilePic/students/'.$stud['photo'].'" load="lazy" class="w3-circle" style="max-width:6em;width:100%;max-height:6em;">';
	 				}


					echo '<div class="w3-container w3-third w3-margin-bottom">
							<div class="w3-row w3-border w3-padding '.$stat.'" style="height:7em">
								<div class="w3-col w3-margin-right" style="width:6em">';
									echo '<div class="w3-display-container" onmouseover="showButtons('.$i.')" onmouseout="hideButtons('.$i.')">';
									echo $img;
									echo $status;
									echo $con;
									echo $drop;
									echo '</div>';
								echo '</div>
								<div class="w3-rest">
									<p><a href="'.base_url().'Teacher/viewstudent/'.$sessid.'/'.$stud['lrn'].'/'.$stud['grade_level'].'/'.$stud['section'].'">'.$stud['fname'].' '.$stud['mname'].' '.$stud['lname'].'</a><br/>
									('.$stud['lrn'].')</p>
								</div>
							</div>
						</div>';


					echo '<div class="w3-modal" id="postconcern'.$i.'">
				            <div class="w3-modal-content w3-animate-top">
				                <header class="w3-container w3-blue">
				                    <span onclick="document.getElementById(\'postconcern'.$i.'\').style.display=\'none\'" 
				                class="w3-button w3-display-topright w3-blue w3-hover-light-blue">&times;</span>
				                    <h3>SEND CONCERN TO '.strtoupper($stud['fname']).' '.strtoupper($stud['lname']).'</h3>
				                </header>
				                <div class="w3-container w3-padding-large">
				                    <form action="'.base_url().'Teacher/postconcern/'.$sessid.'" method="post" class="w3-padding">
				                        <input type="text" name="rec" class="w3-input w3-border w3-round" placeholder="Recepient id" required autocomplete="off" value="'.$stud['lrn'].'">
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


				    echo '<div class="w3-modal" id="requestdrop'.$i.'">
				            <div class="w3-modal-content w3-animate-top">
				                <header class="w3-container w3-blue">
				                    <span onclick="document.getElementById(\'requestdrop'.$i.'\').style.display=\'none\'" 
				                class="w3-button w3-display-topright w3-blue w3-hover-light-blue">&times;</span>
				                    <h3>REQUEST TO DROP '.strtoupper($stud['fname']).' '.strtoupper($stud['lname']).'</h3>
				                </header>
				                <div class="w3-container w3-padding-large">
				                    <form action="'.base_url().'Teacher/postconcern/'.$sessid.'" method="post" class="w3-padding">
				                        <input type="text" name="rec" class="w3-input w3-border w3-round" required value="Administrator" disabled>
				                        <input type="hidden" name="rec" value="Administrator">
				                        <br/>
				                        <input type="text" name="concern" class="w3-input w3-border w3-round" placeholder="Concern" required autocomplete="off" value="Request to Drop '.$stud['fname'].' '.$stud['lname'].' ('.$stud['lrn'].') - '.$stud['grade_level'].' '.$stud['section'].'">
				                        <br/>
				                        <textarea class="w3-input w3-border w3-round" name="desc" placeholder="Please state your reason..." style="resize: none; width: 100%; height: 150px;" required></textarea>
				                        <br/>
				                        <input type="submit" class="w3-button w3-block w3-blue w3-round w3-hover-light-blue" value="Post concern">
				                    </form>
				                </div>
				                <footer class="w3-container w3-blue w3-padding-large"></footer>
				            </div>
				        </div>';


					$i++;
				}
				echo '</div>';
			}
		}

		################################################################################################################
		################################################################################################################

		public function getClassAdvSubj($id, $sessid, $advgr, $advsect){
			$query = $this->db->query("SELECT * FROM subject_teacher WHERE gr_level = '$advgr' AND section = '$advsect'");

			if($query->num_rows() > 0){
				
				echo "<div class='w3-row-padding'>";
 				$i = 0;
	 			foreach ($query->result_array() as $subj) {
	 				$subj['subj_teacher'];
	 				$subj['subj_code'];

	 				$getTeach = $this->db->query("SELECT * FROM teachers WHERE id = '".$subj['subj_teacher']."'");
	 				foreach ($getTeach->result_array() as $TeachInfo) {
	 					$name = $TeachInfo['fname'].' '.$TeachInfo['mname'].' '.$TeachInfo['lname'].' - '.$TeachInfo['Rank'];
	 					$tid = $TeachInfo['id'];
	 					
	 					if($id == $tid){
	 						$name = '(You)';
	 					}

	 					$getsubj = $this->db->query("SELECT * FROM subjects WHERE subj_code = '".$subj['subj_code']."'");
	 					foreach ($getsubj->result_array() as $subjInfo) {
	 						$subj_name = $subjInfo['subj_title'];
	 						$src = $subjInfo['subj_img'];
	 						$link = $subjInfo['subj_code'];
	 					}
	 				}
	 				echo "<div class='w3-col m4 w3-margin-bottom'>";
		 				echo "<div class='w3-display-container' onmouseover='showDesc(".$i.")' onmouseout='hideDesc(".$i.")'>";
		 					echo "<img src='".base_url()."Subject_image/".$src."' load='lazy' style='max-width:24em;width:100%;max-height:12em;'>";
		 					echo "<div class='w3-display-bottomleft w3-padding w3-blue' style='width:100%;'><p>".strtoupper($subj_name)."<br/>".$name."</p></div>";
	 					echo "</div>
	 				</div>";

	 				$i++;
	 			}
	 			echo '</div>';
				
			}else{
				echo '<p class="w3-pale-yellow w3-padding">No Subject teachers assigned.</p>';
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
		public function listOfSubjs($id, $link){
			$query = $this->db->query("SELECT * FROM subject_teacher WHERE subj_teacher = '$id' ORDER BY LENGTH(gr_level), gr_level"); // NATURAL SORTING IN MYSQL
			$dir = base_url().'Subject_image/';

			if(count($query->result_array()) != 0){
				foreach ($query->result_array() as $subj) {

					foreach ($this->db->query("SELECT * FROM subjects WHERE subj_code = '".$subj['subj_code']."'")->result_array() as $subjInfo) {
						
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
	 						echo '<a href="'.base_url().'Teacher/subjects/'.$subjInfo['subj_code'].'/'.$link.'" style="text-decoration:none;"><h3>'.strtoupper($subjInfo['subj_title']).' ('.strtoupper($subjInfo['gr_level']).' - '.strtoupper($subj['section']).')</h3></a>';

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
				echo '<div class="w3-container w3-padding w3-pale-yellow w3-margin w3-center">You are not assigned to any subjects.</div>';
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
					$j = 0;
					$k = 0;
					$l = 0;
					$a = 0;
					for ($y = 0; $y < count($sortedlesson); $y++) { 
						
						foreach ($this->db->query("SELECT * FROM $table WHERE lesson = '$sortedlesson[$y]'")->result_array() as $content) {
							
							echo '<div class="w3-border w3-padding w3-margin-top w3-margin-bottom">
									'.strtoupper('<h3>'.str_replace("_", ", ", $content['lesson'])).' (<small><a href="'.base_url().'Teacher/deleteLesson/'.$link.'/'.$title.'/'.$gr.'/'.$section.'/'.$content['lesson'].'/'.$code.'" class="w3-text-red fa fa-remove" style="text-decoration:none;" title="Delete Lesson" onclick="return confirm(\'Please proceed with caution.\')"></a></small>)</h3>';
							echo '<div>
									<div class="w3-padding">';

							//MODULE SECTION
							if(!empty($content['module'])){
								$module = explode(", ", $content['module']);
								natsort($module); //NATURAL SORTING
								$sort = implode(", ", $module);
								$sorted = explode(", ", $sort);
								//$file = explode(". ", $content['filename']);
								$dir = $title.'_'.$gr.'_'.$section;

								for($i = 0; count($module) > $i; $i++){
									echo '<a href="'.base_url().'Teacher/downloadFile/'.$link.'/'.$title.'/'.$gr.'/'.$section.'/'.$sorted[$i].'/'.$content['lesson'].'/'.$code.'" class="w3-padding w3-hover-text-blue" style="text-decoration: none;">
											<span class="fa fa-files-o"></span> '.str_replace(".pdf", "", str_replace(".doc", "", str_replace(".docx", "", str_replace(".txt", "", str_replace(".ppt", "", str_replace(".pptx", "", str_replace("_", ",", $sorted[$i]))))))).'
										</a>
										(<a href="'.base_url().'Teacher/deleteModule/'.$link.'/'.$title.'/'.$gr.'/'.$section.'/'.$sorted[$i].'/'.$content['lesson'].'/'.$code.'" style="text-decoration: none;" class="fa fa-remove w3-text-red" onclick="return confirm(\'Please proceed with caution.\')" title="Delete Module"></a>)<br/>';
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
									echo '<a href="'.base_url().'Teacher/viewactivity/'.$link.'/'.$title.'/'.$gr.'/'.$section.'/'.$sortedacts[$m].'/'.$code.'/'.$content['lesson'].'" class="w3-padding w3-hover-text-blue" style="text-decoration: none;">
											<span class="fa fa-file-text-o"></span> '.str_replace("_", ",", $sortedacts[$m]).'
										</a>
										(<a href="'.base_url().'Teacher/deleteActivity/'.$link.'/'.$title.'/'.$gr.'/'.$section.'/'.$sortedacts[$m].'/'.$content['lesson'].'/'.$code.'" style="text-decoration: none;" class="fa fa-remove w3-text-red" onclick="return confirm(\'Please proceed with caution. There might submitted activities here. Kindly double-check.\')" title="Delete Activity"></a>)<br/>';
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
									echo '<a href="'.base_url().'Teacher/viewquiz/'.$link.'/'.$title.'/'.$gr.'/'.$section.'/'.$sortedquiz[$n].'/'.$code.'/'.$content['lesson'].'" class="w3-padding w3-hover-text-blue" style="text-decoration: none;">
											<span class="fa fa-file-text"></span> '.$sortedquiz[$n].'
										</a>
										(<a href="'.base_url().'Teacher/deletequiz/'.$link.'/'.$title.'/'.$gr.'/'.$section.'/'.$sortedquiz[$n].'/'.$content['lesson'].'/'.$code.'" style="text-decoration: none;" class="fa fa-remove w3-text-red" onclick="return confirm(\'Please proceed with caution.\')" title="Delete quiz"></a>)<br/>';
								}
							}
							//QUIZ SECTION | END
							

							//REF SECTION
							if(!empty($content['addref'])){
								$ref = explode(",", $content['addref']);
								natsort($ref);
								$sortref = implode(", ", $ref);
								$sortedref = explode(", ", $sortref);

								echo '<br/>';
								for ($o=0; count($ref) > $o ; $o++) { 
									echo '<a href="'.$sortedref[$o].'" class="w3-padding w3-hover-text-blue" style="text-decoration: none;" target="_blank">'.$sortedref[$o].'</a>
										(<a href="'.base_url().'Teacher/deleteref/'.$link.'/'.$gr.'/'.$section.'/'.str_replace("//","--", str_replace("/", "_gte", $sortedref[$o])).'/'.$content['lesson'].'/'.$code.'" style="text-decoration: none;" class="fa fa-remove w3-text-red" title="Delete reference"></a>)
										</br/>';
								}
							}
							//REF SECTION | END
							
							

							echo '<br/>';
							echo '<a href="javascript:void(0)" onclick="document.getElementById(\'AddActivity'.$k.'\').style.display = \'block\'" class="w3-padding w3-text-blue"><small>Add Activity</small></a>';
							echo '<a href="javascript:void(0)" onclick="document.getElementById(\'Addquiz'.$l.'\').style.display = \'block\'" class="w3-padding w3-text-blue"><small>Add Quiz/Exam</small></a>';
							echo '<a href="javascript:void(0)" onclick="document.getElementById(\'Addmodule'.$j.'\').style.display = \'block\'" class="w3-padding w3-text-blue"><small>Add Module</small></a>';
							echo '<a href="javascript:void(0)" onclick="document.getElementById(\'Addref'.$a.'\').style.display = \'block\'" class="w3-padding w3-text-blue"><small>Additional Reference/s</small></a>';
							
							echo '</div>
								</div></div>';

							//ADD MODULE MODAL
							echo '<div class="w3-modal" id="Addmodule'.$j.'">
									<div class="w3-modal-content w3-animate-top">
										<header class="w3-container w3-blue">
									      	<span onclick="document.getElementById(\'Addmodule'.$j.'\').style.display=\'none\'" class="w3-button w3-blue w3-hover-light-blue w3-display-topright">&times;</span>
									      	<h2>ADD LESSON CONTENT</h2>
									    </header>
									    <div class="w3-container">
									    	<fieldset class="w3-round w3-margin-top w3-margin-bottom"><h3>'.strtoupper($content['lesson']).'</h3></fieldset>
									    	<form action="'.base_url().'Teacher/addModule/'.$code.'/'.$title.'/'.$link.'" method="post" enctype="multipart/form-data">
									    		<fieldset class="w3-round">
									    		<button class="w3-button w3-small w3-blue w3-hover-light-blue w3-margin" onclick="create_trB(\'AddModuleContent'.$j.'\')">Add field</button>
									    		
						                        <table class="w3-table" id="addmoduletablefiles'.$j.'">
						                            <tbody id="AddModuleContent'.$j.'">
						                                <tr>
						                                    <td>
						                                        <input type="file" class="w3-input w3-border w3-round" name="addFile[]" accept=".xlsx, .xls, .doc, .docx, .ppt, .pptx, .txt, .pdf" required>
						                                    </td>
						                                    <td>
						                                        <input type="text" name="addsubtopic[]" class="w3-input w3-border w3-round" placeholder="Title: e.g., Module 1: Some text..." required>
						                                    </td>
						                                    <td>
						                                        <button class="w3-button w3-circle w3-red w3-hover-pale-red w3-small" onclick="remove_trB(this)" name="but" value="rem">&times;</button>
						                                    </td>
						                                </tr>
						                            </tbody>
						                        </table>
	                        					</fieldset>
	                        					<input type="hidden" name="section" value="'.$section.'">
												<input type="hidden" name="gr" value="'.$gr.'">
	                        					<input type="hidden" name="lesson" value="'.$content['lesson'].'">
	                        					<p class="w3-small w3-margin-left"><i>File size is limited to 10MB.</i></p>
	                        					<input type="submit" name="but" class="w3-button w3-block w3-round w3-margin-top w3-blue w3-hover-light-blue" value="Add">
									    	</form>
									    	<br/>
									    </div>
									    <footer class="w3-container w3-padding w3-blue">
									    </footer>
									</div>
							</div>';
							//ADD MODULE MODAL | END
							$j++;

							//ADD QUIZ MODAL
							echo '<div class="w3-modal" id="Addquiz'.$l.'">
									<div class="w3-modal-content w3-animate-top w3-margin-bottom">
										<header class="w3-container w3-blue">
									      	<span onclick="document.getElementById(\'Addquiz'.$l.'\').style.display=\'none\'" class="w3-button w3-blue w3-hover-light-blue w3-display-topright">&times;</span>
									      	<h2>CREATE QUIZ/EXAM</h2>
									    </header>
									    <div class="w3-container">
									    	<fieldset class="w3-round w3-margin-top w3-margin-bottom"><h3>'.strtoupper($content['lesson']).'</h3></fieldset>
									    	<form action="'.base_url().'Teacher/examcreation/'.$code.'/'.$title.'/'.$link.'" method="post">
									    	<fieldset class="w3-round w3-margin-bottom">
									    	<legend>Content</legend>
									    			<div class="w3-row-padding">
									    				<div class="w3-third w3-margin-bottom">
									    					<label>Title:</label>
									    					<input type="text" name="exam_title" class="w3-input w3-border w3-round" placeholder="Quiz|Major Exam" required>
									    				</div>
									    				<div class="w3-third w3-margin-bottom">
									    					<label>Duration(by minutes): </label>
									    					<input type="number" name="exam_duration" min="5" max="120" class="w3-input w3-border w3-round" required>
									    				</div>
									    				<div class="w3-third w3-margin-bottom">
									    					<label>Deadline:</label>
									    					<input type="datetime-local" name="exam_deadline" class="w3-input w3-border w3-round" required>
									    				</div>
									    			</div>
									    			<div class="w3-row-padding">
									    				<div class="w3-half w3-margin-bottom">
									    					<label>No. of attempt/s:</label>
									    					<input type="number" name="exam_attempt" class="w3-input w3-border w3-round" min="1" max="3" required>
									    				</div>
									    				<div class="w3-half w3-margin-bottom">
										    				<label>How many types of exam?</label><br/>
										    				<input type="number" name="ExamnoOfTypes" class="w3-input w3-border w3-round" min="1" max="5" required>
										    			</div>
									    			</div>
									    	</fieldset>
									    	<input type="hidden" name="exam_section" value="'.$section.'">
											<input type="hidden" name="exam_gr" value="'.$gr.'">
	                        				<input type="hidden" name="exam_lesson" value="'.$content['lesson'].'">
									    	<input type="submit" value="Proceed to Exam creation" class="w3-button w3-block w3-blue w3-hover-light-blue w3-round w3-margin-bottom">
									    	</form>
									    </div>
									    <footer class="w3-container w3-padding w3-blue">
									    </footer>
									</div>
							</div>';
							//ADD QUIZ MODAL | END
							$l++;


							//ADD ACTIVITY MODAL
							echo '<div class="w3-modal" id="AddActivity'.$k.'">
									<div class="w3-modal-content w3-animate-top w3-margin-bottom">
										<header class="w3-container w3-blue">
									      	<span onclick="document.getElementById(\'AddActivity'.$k.'\').style.display=\'none\'" class="w3-button w3-blue w3-hover-light-blue w3-display-topright">&times;</span>
									      	<h2>CREATE ACTIVITY</h2>
									    </header>
									    <div class="w3-container">
									    	<fieldset class="w3-round w3-margin-top w3-margin-bottom"><h3>'.strtoupper($content['lesson']).'</h3></fieldset>
									    	<form action="'.base_url().'Teacher/uploadActivity/'.$code.'/'.$title.'/'.$link.'" method="post" enctype="multipart/form-data">
									    	<fieldset class="w3-round w3-margin-bottom">
									    	<legend>Content</legend>
									    			<div class="w3-row-padding">
									    				<div class="w3-third w3-margin-bottom">
									    					<label>Title:</label>
									    					<input type="text" name="act_title" class="w3-input w3-border w3-round" placeholder="Activity 1: ..." required>
									    				</div>
									    				<div class="w3-third w3-margin-bottom">
									    					<label>Deadline:</label>
									    					<input type="datetime-local" name="act_due" class="w3-input w3-border w3-round" required>
									    				</div>
									    				<div class="w3-third w3-margin-bottom">
									    					<label>Attempt:</label>
									    					<input type="number" name="act_attempt" class="w3-input w3-border w3-round" min="1" max="3" required>
									    				</div>
									    			</div>
									    			<div class="w3-container w3-margin-bottom">
									    				<label>Instruction/s:</label><br/>
									    				<textarea name="act_inst" class="w3-input w3-border w3-round" style="resize: none;width: 100%; height: 150px;" required></textarea>
									    			</div>
									    			<div class="w3-row-padding">
									    				<div class="w3-half w3-margin-bottom">
										    				<label>Add related file (optional):</label><br/>
										    				<input type="file" name="act_relfile" class="w3-input w3-border w3-round" accept=".doc, .docx, .txt, .pdf">
									    				</div>
									    				<div class="w3-half w3-margin-bottom">
									    					<label>File to accept:</label><br/>
									    					<input type="radio" class="w3-radio" value="all" name="filetoaccept" required> All&nbsp;&nbsp;
									    					<input type="radio" class="w3-radio" value="pdf" name="filetoaccept" required> .pdf&nbsp;&nbsp;
									    					<input type="radio" class="w3-radio" value="docx" name="filetoaccept" required> .docx&nbsp;&nbsp;
									    					<input type="radio" class="w3-radio" value="ppt" name="filetoaccept" required> .ppt&nbsp;&nbsp;
									    					<input type="radio" class="w3-radio" value="excel" name="filetoaccept" required> .xlxs
									    				</div>
									    			</div>
									    		<p><small><b>Note:</b> Kindly instruct your students to always add their name in their filenames when submitting.</small></p>
									    	</fieldset>
									    	<fieldset class="w3-round w3-margin-bottom">
									    	<legend>Rubrics</legend>
									    	<small><b>Note:</b> Just put the whole number for the percentage.</small>
									    		<table class="w3-table">
												    <tbody id="rubrics'.$k.'">
			                                			<tr>
			                                    			<td>
						                                        <input type="text" placeholder="Criterion" pattern="^[^,]+$" class="w3-input w3-border w3-round" name="criterion[]" required>
						                                    </td>
						                                    <td>
						                                        <input type="text" placeholder="Percentage" name="percent[]" class="w3-input w3-border w3-round" required>
						                                    </td>
						                                    <td>
						                                        <button name="but" value="rem" class="w3-button w3-circle w3-red w3-hover-pale-red w3-small" onclick="remove_trC(this)">&times;</button>
						                                    </td>
						                                </tr>
						                            </tbody>
									    		</table>
									    		<button class="w3-button w3-small w3-blue w3-hover-light-blue w3-margin" onclick="create_trC(\'rubrics'.$k.'\')">Add field</button>
									    	</fieldset>
									    	<input type="hidden" name="act_section" value="'.$section.'">
											<input type="hidden" name="act_gr" value="'.$gr.'">
	                        				<input type="hidden" name="act_lesson" value="'.$content['lesson'].'">
									    	<input type="submit" name="but" value="Post activity" class="w3-button w3-block w3-blue w3-hover-light-blue w3-round w3-margin-bottom">
									    	</form>
									    </div>
									    <footer class="w3-container w3-padding w3-blue">
									    </footer>
									</div>
							</div>';
							//ADD ACTIVITY MODAL | END
							$k++;


							//ADD REF MODAL
							echo '<div class="w3-modal" id="Addref'.$a.'">
									<div class="w3-modal-content w3-animate-top">
										<header class="w3-container w3-blue">
									      	<span onclick="document.getElementById(\'Addref'.$a.'\').style.display=\'none\'" class="w3-button w3-blue w3-hover-light-blue w3-display-topright">&times;</span>
									      	<h2>ADDITIONAL REFERENCE/S</h2>
									    </header>
									    <div class="w3-container">
									    	<fieldset class="w3-round w3-margin-top w3-margin-bottom"><h3>'.strtoupper($content['lesson']).'</h3></fieldset>
									    	<form action="'.base_url().'Teacher/addref/'.$code.'/'.$title.'/'.$link.'" method="post">
									    		<b>Note:</b> Separate with comma when adding multiple references.
									    		<textarea name="linkss" class="w3-round" style="resize: none; width: 100%; height: 10em;" required></textarea>
	                        					<input type="hidden" name="section" value="'.$section.'">
												<input type="hidden" name="gr" value="'.$gr.'">
	                        					<input type="hidden" name="lesson" value="'.$content['lesson'].'">
	                        					<input type="submit" name="but" class="w3-button w3-block w3-round w3-margin-top w3-blue w3-hover-light-blue" value="Add">
									    	</form>
									    	<br/>
									    </div>
									    <footer class="w3-container w3-padding w3-blue">
									    </footer>
									</div>
							</div>';
							//ADD REF MODAL | END
							$j++;

						}
					}
					
					
				}else{
					echo "<p class='w3-pale-yellow w3-padding w3-center'>No content found.</p>";
				}

			}else{
				echo '<p class="w3-text-red">No table found. Contact the Admin for this error.</p>';
			}

		}

		################################################################################################################
		################################################################################################################

		//GET ENROLLED STUDENTS IN SUBJECT
		public function getEnrolledinSubj($id, $sessid, $code, $gr, $section, $title){

			if($gr == 'Grade 11' || $gr == 'Grade 12'){
				$query = $this->db->query("SELECT * FROM shsstudents WHERE subjects LIKE '%$code%' AND grade_level = '$gr' AND section = '$section' ORDER BY lname ASC");
				if($query->num_rows() == 0){
					echo '<p class="w3-pale-yellow w3-center w3-padding">No students enrolled.</p>';
				}else{
					echo '<div class="w3-row-padding">';
					$i = 1;
					foreach ($query->result_array() as $studInfo) {
						$lrn = $studInfo['lrn'];
						$name = $studInfo['fname'].' '.$studInfo['mname'].' '.$studInfo['lname'];

						if($studInfo['status'] == 'Dropped'){
	 						$stat = 'w3-grey';
	 						$status = '<span class="w3-small w3-tag w3-round w3-red">Dropped</span>';
	 						$con = '';
	 						$drop = '';
	 					}else{
	 						$stat = '';
	 						$status = '';
	 						$con = '<a href="javascript:void(0)" onclick="document.getElementById(\'postconcern'.$i.'\').style.display = \'block\'" class="w3-hide" id="message'.$i.'" title="Send concern"><i class="fa fa-envelope"></i></a>';
	 						$drop = '<a href="javascript:void(0)" onclick="document.getElementById(\'requestdrop'.$i.'\').style.display = \'block\'" class="w3-hide" id="drop'.$i.'" title="Request to remove from this Subject"><i class="fa fa-times"></i></a>';
	 					}

						if(empty($studInfo['photo'])){
	 						$img = "<span class='fa fa-user-circle-o' style='font-size:6em;'></span>";
	 					}else{
	 						$img = '<img src="'.base_url().'ProfilePic/students/'.$studInfo['photo'].'" style="max-width:6em;width:100%;max-height:6em" class="w3-circle">';
	 					}

						echo '<div class="w3-container w3-third w3-margin-bottom">';
							echo '<div class="w3-row w3-border w3-padding '.$stat.'" style="height:7em">
									<div class="w3-col w3-margin-right" style="width:6em">';
										echo '<div class="w3-display-container" onmouseover="showButtons('.$i.')" onmouseout="hideButtons('.$i.')">';
										echo $img;
										echo $con;
										echo $drop;
									echo '</div></div>
									<div class="w3-rest">
										<p><a href="'.base_url().'Teacher/viewstudent/'.$sessid.'/'.$studInfo['lrn'].'/'.$studInfo['grade_level'].'/'.$studInfo['section'].'">'.$name.'</a><br/>
										('.$lrn.')<br/>'.$status.'</p>
									</div>
								</div>';
						echo '</div>';

					echo '<div class="w3-modal" id="postconcern'.$i.'">
				            <div class="w3-modal-content w3-animate-top">
				                <header class="w3-container w3-blue">
				                    <span onclick="document.getElementById(\'postconcern'.$i.'\').style.display=\'none\'" 
				                class="w3-button w3-display-topright w3-blue w3-hover-light-blue">&times;</span>
				                    <h3>SEND A CONCERN TO '.strtoupper($studInfo['fname']).' '.strtoupper($studInfo['lname']).'</h3>
				                </header>
				                <div class="w3-container w3-padding-large">
				                    <form action="'.base_url().'Teacher/postconcern/'.$sessid.'" method="post" class="w3-padding">
				                        <input type="text" name="rec" class="w3-input w3-border w3-round" placeholder="Recepient id" required autocomplete="off" value="'.$studInfo['lrn'].'">
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


				    echo '<div class="w3-modal" id="requestdrop'.$i.'">
				            <div class="w3-modal-content w3-animate-top">
				                <header class="w3-container w3-blue">
				                    <span onclick="document.getElementById(\'requestdrop'.$i.'\').style.display=\'none\'" 
				                class="w3-button w3-display-topright w3-blue w3-hover-light-blue">&times;</span>
				                    <h3>REQUEST TO DROP '.strtoupper($studInfo['fname']).' '.strtoupper($studInfo['lname']).'</h3>
				                </header>
				                <div class="w3-container w3-padding-large">
				                    <form action="'.base_url().'Teacher/postconcern/'.$sessid.'" method="post" class="w3-padding">
				                        <input type="text" name="rec" class="w3-input w3-border w3-round" required value="Administrator" disabled>
				                        <input type="hidden" name="rec" value="Administrator">
				                        <br/>
				                        <input type="text" name="concern" class="w3-input w3-border w3-round" placeholder="Concern" required autocomplete="off" value="Request to remove '.$studInfo['fname'].' '.$studInfo['lname'].' ('.$studInfo['lrn'].') in '.$title.' ('.$studInfo['grade_level'].' '.$studInfo['section'].')">
				                        <br/>
				                        <textarea class="w3-input w3-border w3-round" name="desc" placeholder="Please state your reason..." style="resize: none; width: 100%; height: 150px;" required></textarea>
				                        <br/>
				                        <input type="submit" class="w3-button w3-block w3-blue w3-round w3-hover-light-blue" value="Post concern">
				                    </form>
				                </div>
				                <footer class="w3-container w3-blue w3-padding-large"></footer>
				            </div>
				        </div>';

						$i++; 
					}
					echo '</div>';
				}

			}else{
				$query = $this->db->query("SELECT * FROM jhsstudents WHERE subjects LIKE '%$code%' AND grade_level = '$gr' AND section = '$section' ORDER BY lname ASC");
				if($query->num_rows() == 0){
					echo '<p class="w3-pale-yellow w3-center w3-padding">No students enrolled.</p>';
				}else{
					echo '<div class="w3-row-padding">';
					$i = 1;
					foreach ($query->result_array() as $studInfo) {
						$lrn = $studInfo['lrn'];
						$name = $studInfo['fname'].' '.$studInfo['mname'].' '.$studInfo['lname'];


						if($studInfo['status'] == 'Dropped'){
	 						$stat = 'w3-grey';
	 						$status = '<span class="w3-small w3-tag w3-round w3-red">Dropped</span>';
	 						$con = '';
	 						$drop = '';
	 					}else{
	 						$stat = '';
	 						$status = '';
	 						$con = '<a href="javascript:void(0)" onclick="document.getElementById(\'postconcern'.$i.'\').style.display = \'block\'" class="w3-hide" id="message'.$i.'" title="Send concern"><i class="fa fa-envelope"></i></a>';
	 						$drop = '<a href="javascript:void(0)" onclick="document.getElementById(\'requestdrop'.$i.'\').style.display = \'block\'" class="w3-hide" id="drop'.$i.'" title="Request to remove from this Subject"><i class="fa fa-times"></i></a>';
	 					}


						if(empty($studInfo['photo'])){
	 						$img = "<span class='fa fa-user-circle-o' style='font-size:6em;'></span>";
	 					}else{
	 						$img = '<img src="'.base_url().'ProfilePic/students/'.$studInfo['photo'].'" style="max-width:6em;width:100%;max-height:6em" class="w3-circle">';
	 					}

						echo '<div class="w3-container w3-third w3-margin-bottom">';
							echo '<div class="w3-row w3-border w3-padding '.$stat.'" style="height:7em">
									<div class="w3-col w3-margin-right" style="width:6em">';
										echo '<div class="w3-display-container" onmouseover="showButtons('.$i.')" onmouseout="hideButtons('.$i.')">';
										echo $img;
										echo $con;
										echo $drop;
										echo '</div>';
									echo '</div>
									<div class="w3-rest">
										<p><a href="'.base_url().'Teacher/viewstudent/'.$sessid.'/'.$studInfo['lrn'].'/'.$studInfo['grade_level'].'/'.$studInfo['section'].'">'.$name.'</a><br/>
										('.$lrn.')<br/>'.$status.'</p>
									</div>
								</div>';
						echo '</div>';


					echo '<div class="w3-modal" id="postconcern'.$i.'">
				            <div class="w3-modal-content w3-animate-top">
				                <header class="w3-container w3-blue">
				                    <span onclick="document.getElementById(\'postconcern'.$i.'\').style.display=\'none\'" 
				                class="w3-button w3-display-topright w3-blue w3-hover-light-blue">&times;</span>
				                    <h3>SEND A CONCERN TO '.strtoupper($studInfo['fname']).' '.strtoupper($studInfo['lname']).'</h3>
				                </header>
				                <div class="w3-container w3-padding-large">
				                    <form action="'.base_url().'Teacher/postconcern/'.$sessid.'" method="post" class="w3-padding">
				                        <input type="text" name="rec" class="w3-input w3-border w3-round" placeholder="Recepient id" required autocomplete="off" value="'.$studInfo['lrn'].'">
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


				    echo '<div class="w3-modal" id="requestdrop'.$i.'">
				            <div class="w3-modal-content w3-animate-top">
				                <header class="w3-container w3-blue">
				                    <span onclick="document.getElementById(\'requestdrop'.$i.'\').style.display=\'none\'" 
				                class="w3-button w3-display-topright w3-blue w3-hover-light-blue">&times;</span>
				                    <h3>REQUEST TO DROP '.strtoupper($studInfo['fname']).' '.strtoupper($studInfo['lname']).'</h3>
				                </header>
				                <div class="w3-container w3-padding-large">
				                    <form action="'.base_url().'Teacher/postconcern/'.$sessid.'" method="post" class="w3-padding">
				                        <input type="text" name="rec" class="w3-input w3-border w3-round" required value="Administrator" disabled>
				                        <input type="hidden" name="rec" value="Administrator">
				                        <br/>
				                        <input type="text" name="concern" class="w3-input w3-border w3-round" placeholder="Concern" required autocomplete="off" value="Request to remove '.$studInfo['fname'].' '.$studInfo['lname'].' ('.$studInfo['lrn'].') in '.$title.' ('.$studInfo['grade_level'].' '.$studInfo['section'].')">
				                        <br/>
				                        <textarea class="w3-input w3-border w3-round" name="desc" placeholder="Please state your reason..." style="resize: none; width: 100%; height: 150px;" required></textarea>
				                        <br/>
				                        <input type="submit" class="w3-button w3-block w3-blue w3-round w3-hover-light-blue" value="Post concern">
				                    </form>
				                </div>
				                <footer class="w3-container w3-blue w3-padding-large"></footer>
				            </div>
				        </div>';


						$i++;
					}
					echo '</div>';
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
		public function getActivityContent($sessid, $code, $title, $gr, $section, $lesson, $subj){
			$table = str_replace(" ", "", str_replace("-", "_", $section)).'_'.str_replace(" ", "", $gr).'_'.$code;

			if($this->db->query("SHOW TABLES LIKE '$table'")->num_rows() == 1){
				date_default_timezone_set("Asia/Manila");

				foreach($this->db->query("SELECT * FROM activities WHERE subj_code = $code AND lesson_title = '$lesson' AND grade_level = '$gr' AND section = '$section' AND activity_title = '$title'")->result_array() as $got){

					$convert = strtotime($got['due_date']);
					$due = date('M. j, Y - h:i A', $convert);

					if(!empty($got['related_file'])){
						$file = '<p><b>Attached file:</b> <a href="'.base_url().'Teacher/downloadAttach/'.$sessid.'/'.$subj.'/'.$gr.'/'.$section.'/'.$got['related_file'].'/'.$lesson.'/'.$got['activity_title'].'/'.$code.'" class="w3-hover-text-blue">'.$got['related_file'].'</a></p>';
					}else{
						$file = '';
					}


					if(date('Y-m-d H:i A', $convert) < date('Y-m-d H:i A')){
						$stat = '<span class="w3-tag w3-red w3-round">Terminated</span>';
					}else{
						$stat = '<span class="w3-tag w3-green w3-round">Ongoing</span>';
					}
					echo '<p><b>Deadline: </b>'.$due.' '.$stat.'</p>';
					echo '<p><b>Description:</b></p>';
					echo '<pre style="overflow: auto; white-space: pre-wrap; word-wrap: break-word; text-align: justify;">'.$got['instruction'].'</pre>';
					echo $file;
					echo '<p><b>Attempt/s: </b>'.$got['attempt'].'</p>';
					echo '<b>Rubrics: </b><br/>';

					$rub = explode(", ", $got['Rubrics']);
					echo '<table class="w3-table-all w3-centered w3-border">
					<thead><tr class="w3-light-grey"><th>Criteria</th><th>Percentage</th></tr></thead>';
					for($a = 0; $a < count($rub); $a++) {
						$hmp = explode(": ", $rub[$a]);
						echo '<tr>';
						for ($b = 0; $b < count($hmp); $b++) { 
							echo '<td>'.$hmp[$b].'</td>';
						}
						echo '</tr>';
					}
					echo '</table>';
					
					$submitDir = str_replace("%20", " ", str_replace(":", "-", $subj)).'_'.$gr.'_'.$section.'/'.str_replace(":", "-", $lesson).'/'.str_replace(":", "-", $got['activity_title']).'/Submitted Acts/';

					$query = $this->db->query("SELECT * FROM activities_submit WHERE subj_code = $code AND lesson_title = '$lesson' AND grade_level = '$gr' AND section = '$section' AND activity_title = '$title'");
					if($query->num_rows() >= 1){

						echo '<hr/>';
						echo '<div style="overflow-x:auto;">';
						echo '<input type="text" class="w3-input w3-border w3-round w3-third" placeholder="Search student..." onkeyup="functionSearchName()" id="Studname">';
						echo '<table class="w3-table-all w3-margin-bottom" id="listofstudents">
						<thead><tr class="w3-light-grey"><th>LRN</th><th>Name</th><th>Grade Level</th><th>Section</th><th>Date submitted</th><th>Mark</th><th>Action</th></tr></thead>';
						$i = 0;

						foreach ($query->result_array() as $submitted) {

							//if($got['filetoaccept'] == 'pdf'){
							if(substr_count($submitted['file_submitted'], 'pdf') == 1){
								$view = ' | <a href="'.base_url().$submitDir.$submitted['lrn'].'/'.str_replace(" ", "-", str_replace(":", "-", $submitted['file_submitted'])).'" target="_blank" class="fa fa-eye w3-xlarge" style="text-decoration: none;"></a>';
							}else{
								$view = '';
							}

							if($gr == 'Grade 11' || $gr == 'Grade 12'){
								foreach ($this->db->query("SELECT * FROM shsstudents WHERE lrn = '".$submitted['lrn']."'")->result_array() as $studinfo) {
									$name = $studinfo['fname'].' '.$studinfo['mname'].' '.$studinfo['lname'];
									$g = $studinfo['grade_level'];
									$s = $studinfo['section'];	
								}
							}else{
								foreach ($this->db->query("SELECT * FROM jhsstudents WHERE lrn = '".$submitted['lrn']."'")->result_array() as $studinfo) {
									$name = $studinfo['fname'].' '.$studinfo['mname'].' '.$studinfo['lname'];
									$g = $studinfo['grade_level'];
									$s = $studinfo['section'];	
								}
							}

							if($submitted['grade'] == 0){
								$mark = 'Not graded';
							}else{
								$mark = $submitted['grade'].'/100';
							}


							//MODAL FOR GRADING
							echo '<div class="w3-modal" id="putMark'.$i.'">
		 					<div class="w3-modal-content w3-card-4 w3-animate-top" style="max-width:600px">
		 						<header class="w3-container w3-blue">
					    			<span onclick="document.getElementById(\'putMark'.$i.'\').style.display=\'none\'" class="w3-button w3-display-topright w3-blue w3-hover-light-blue">&times;</span>
							        	<h3>GRADING</h3>
					    		</header>
					    		<div class="w3-container w3-padding-large">
					    			<p><b>'.$title.'</b></p><p><b>Student: </b>'.$name.'</p><p><b>Submitted file: </b>'.$submitted['file_submitted'].'</p><p><b>Date submitted: </b>'.date('M. j, Y - h:i A', strtotime($submitted['date_submitted'])).'</p>
									<form action="'.base_url().'Teacher/confirmActgrade/'.$sessid.'/'.$submitted['lrn'].'/'.$code.'/'.$lesson.'/'.$g.'/'.$s.'/'.$title.'/'.$subj.'" method="post">';
										echo '<p><b>Rubrics: </b></p>';

												for($c = 0; $c < count($rub); $c++){
													echo '<div class="w3-container w3-half">';
														echo $rub[$c].'%';
													echo '</div>';
													
													$hmp = explode(": ", $rub[$c]);
													for ($d = 0; $d < count($hmp); $d++) {
														//To get every first value of the exploded array rubric
														if($d == 0){
															continue;
														}
													echo '<div class="w3-container w3-half">';
														echo '<input type="number" name="score[]" max='.$hmp[$d].' min=0 class="w3-input w3-border w3-round" placeholder="Score" required>';
													echo '</div>';
													}

												}

									    echo '<input type="submit" value="Confirm grade" class="w3-button w3-blue w3-hover-light-blue w3-round w3-margin-top">
									</form>
								</div>
									<footer class="w3-container w3-blue w3-padding-large"></footer>
		 						</div>
		 					</div>';
							//MODAL FOR GRADING | END


							echo '<tr>
									<td>'.$submitted['lrn'].'</td>
									<td>'.$name.'</td>
									<td>'.$g.'</td>
									<td>'.$s.'</td>
									<td>'.date('M. j, Y - h:i A', strtotime($submitted['date_submitted'])).'</td>
									<td>'.$mark.'</td>
									<td><a href="javascript:void(0)" onclick="document.getElementById(\'putMark'.$i.'\').style.display = \'block\'" style="text-decoration: none;" class="fa fa-edit w3-xlarge"></a> | <a href="'.base_url().'Teacher/downloadSubmitAct/'.$sessid.'/'.$subj.'/'.$gr.'/'.$section.'/'.$submitted['file_submitted'].'/'.$lesson.'/'.$title.'/'.$code.'/'.$submitted['lrn'].'" class="fa fa-download w3-xlarge" style="text-decoration: none;"></a>'.$view.'</td>
								</tr>';
						$i++;
						}
						echo '</table></div>';
					}
					
				}

			}else{
				$this->session->set_flashdata('error', 'Table not found.');
				header('Location:'.base_url().'Teacher/subjects/'.$code.'/'.$sessid);
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
		public function getQuizContent($sessid, $code, $title, $gr, $section, $lesson, $subj){
			$table = str_replace(" ", "", str_replace("-", "_", $section)).'_'.str_replace(" ", "", $gr).'_'.$code;

			if($this->db->query("SHOW TABLES LIKE '$table'")->num_rows() == 1){
				date_default_timezone_set("Asia/Manila");

				foreach($this->db->query("SELECT * FROM quiz WHERE subj_code = $code AND lesson_title = '$lesson' AND grade_level = '$gr' AND section = '$section' AND quiz_title = '$title'")->result_array() as $got){

					$convert = strtotime($got['deadline']);
					$due = date('M. j, Y - h:i A', $convert);


					if(date('Y-m-d H:i A', $convert) < date('Y-m-d H:i A')){
						$stat = '<span class="w3-tag w3-red w3-round">Terminated</span>';
					}else{
						$stat = '<span class="w3-tag w3-green w3-round">Ongoing</span>';
					}
					echo '<p><b>Deadline: </b>'.$due.' '.$stat.'<br/>';
					//echo '<pre style="overflow: auto; white-space: pre-wrap; word-wrap: break-word; text-align: justify;">'.$got['typeofexam'].'</pre>';
					echo '<b>Attempt/s: </b>'.$got['attempt'].'</p>';

					echo '<details><summary><p><b>Content:</b> <span class="fa fa-caret-down"></span></p></summary>';
					echo '<p>';
					$types = explode(", ", $got['typeofexam']);
					$cont = explode(" + ", $got['content']);

					for ($z=0; $z < count($cont); $z++) { 
						$part[$z] = explode(" => ", $cont[$z]);
					}


					for($a = 0; $a < count($types); $a++) {
						$types[$a] = str_replace("{", "", str_replace("}", "", str_replace("%20", " ", $types[$a])));
						$prt = $a+1;
	                    echo '<div class="w3-margin-bottom w3-border w3-padding">
	                            <p><b>PART '.$prt.': '.strtoupper($types[$a]).'</b></p>';

	                            switch($types[$a]) {
	                                case 'multiplechoice':
	                                	
	                                	$contpart = explode(", ", str_replace("[", "", str_replace("]", "", $part[$a][1])));
	                                	
	                                	for ($b = 0; $b < count($contpart); $b++) {
	                                		$contdata[$b] = explode(" _ ", $contpart[$b]);
	                                		
	                                		for ($c=0; $c < count($contdata[$b]); $c++) { 
	                                			if($c == 0) {
	                                				$contdata[$b]['question'] = $contdata[$b][$c];
	                                				unset($contdata[$b][$c]);
	                                			}
	                                			if($c+1 == count($contdata[$b])) {
	                                				$lm = explode(" img ", $contdata[$b][$c]);
	                                				$contdata[$b]['correct'] = str_replace(" = ", "", $lm[0]);
	                                				unset($contdata[$b][$c]);
	                                			}
	                                		}
	                                	}

	                                	//print_r($contdata);

	                                    for ($b = 0; $b < count($contpart); $b++) {
	                                        $num = $b+1;

	                                        $qi = explode(" img ", $contdata[$b]['question']);

	                                        echo '<pre><b>'.$num.'.</b> '.$qi[0].'</pre>';
	                                        $dir = $subj.'_'.$gr.'/';

	                                        if(isset($qi[1])){
	                                        	echo '<img src="'.base_url().$dir.str_replace("?", " qmark", $qi[0]).'/'.$qi[1].'" class="w3-image" style="max-width:10em;width:100%;max-height:10em;" load="lazy"><br/><br/>';
	                                        }

	                                        for ($c = 1; $c <= 4; $c++) {
	                                        	$lm = explode(" img ", $contdata[$b][$c]);
	                                            if($contdata[$b]['correct'] == $lm[0]){
	                                               $selected = 'checked';
	                                            }else{
	                                                $selected = '';
	                                            }

	                                            if(isset($lm[1])){
	                                            	echo '<input type="radio" '.$selected.' disabled> <img src="'.base_url().$dir.str_replace("?", " qmark", $qi[0]).'/'.$lm[1].'" class="w3-image" style="max-width:10em;width:100%;max-height:10em;" load="lazy"><br/>';
	                                            }else{
	                                            	echo '<input type="radio" '.$selected.' disabled> '.$lm[0].'<br/>';
	                                            }
	                                            
	                                        }
	                                        //echo '</p>';
	                                    }
	                                    
	                                break;

	                                case 'enumeration':
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

	                                        echo '<div class="w3-container"><input type="text" class="w3-input w3-border w3-round" value="'.$contdata[$b]['correct'].'" disabled></div>';

	                                        $num++;
	                                    }
	                                    
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
	                                    
	                                break;

	                                case 'matchingtype':

	                                	$contpart = explode(", ", str_replace("[", "", str_replace("]", "", $part[$a][1])));

	                                	for ($b=0; $b < count($contpart); $b++) {
	                                		$contdata[$b] = explode(" = ", $contpart[$b]);
	                                		
	                                		for ($c = 0; $c < count($contdata[$b]); $c++) { 
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
	                                        
	                                            //echo '<select class="w3-select w3-border w3-round" disabled>';
	                                        echo '<div class="w3-container"><input type="text" class="w3-input w3-border w3-round" value="'.$contdata[$b]['correct'].'" disabled></div>';
	                                            //echo '</select>';
	                                        
	                                        $num++;
	                                    }
	                                    
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
	                                    
	                                    
	                                break;
	                            }
	                            
	                            
	                    echo '</div>';
					}
					echo '</p></details>';


					$query = $this->db->query("SELECT *, MAX(score) FROM quiz_submit WHERE subj_code = $code AND lesson_title = '$lesson' AND grade_level = '$gr' AND section = '$section' AND quiz_title = '$title' GROUP BY lrn");
					
					if($this->db->query("SELECT * FROM quiz_submit WHERE subj_code = $code AND lesson_title = '$lesson' AND grade_level = '$gr' AND section = '$section' AND quiz_title = '$title'")->num_rows() > 0){
						echo '<hr/>';
						echo '<div style="overflow-x:auto;">';
						echo '<div class="w3-row">';
						echo '<div class="w3-half"><input type="text" class="w3-input w3-border w3-round" placeholder="Search student..." onkeyup="functionSearchName()" id="Studname"></div>';

						echo '<div class="w3-half"><button class="w3-button w3-small w3-round w3-blue w3-hover-light-blue" onclick="document.getElementById(\'itemanalysis\').style.display = \'block\'">Item analysis</button></div>';
						echo '</div>';
						echo '<table class="w3-table-all w3-margin-bottom" id="listofstudents">
						<thead><tr class="w3-light-grey"><th>LRN</th><th>Name</th><th>Grade Level</th><th>Section</th><th>Date submitted</th><th>Score</th></tr></thead>';
						
						foreach ($query->result_array() as $submitted) {
							if($gr == 'Grade 11' || $gr == 'Grade 12'){
								foreach ($this->db->query("SELECT * FROM shsstudents WHERE lrn = '".$submitted['lrn']."'")->result_array() as $studinfo){
									$name = $studinfo['fname'].' '.$studinfo['mname'].' '.$studinfo['lname'];
									$g = $studinfo['grade_level'];
									$s = $studinfo['section'];	
								}
							}else{
								foreach ($this->db->query("SELECT * FROM jhsstudents WHERE lrn = '".$submitted['lrn']."'")->result_array() as $studinfo){
									$name = $studinfo['fname'].' '.$studinfo['mname'].' '.$studinfo['lname'];
									$g = $studinfo['grade_level'];
									$s = $studinfo['section'];	
								}
							}

							$mark = $submitted['MAX(score)'].'/'.$submitted['total'];

							echo '<tr>
									<td>'.$submitted['lrn'].'</td>
									<td>'.$name.'</td>
									<td>'.$g.'</td>
									<td>'.$s.'</td>
									<td>'.date('M. j, Y - h:i A', strtotime($submitted['date_submitted'])).'</td>
									<td>'.$mark.'</td>
									
								</tr>';
						}
						echo '</table></div>';


						echo '<div class="w3-modal" id="itemanalysis">
								<div class="w3-modal-content w3-animate-top">
									<header class="w3-container w3-blue">
				                        <span onclick="document.getElementById(\'itemanalysis\').style.display=\'none\'" class="w3-button w3-blue w3-hover-light-blue w3-display-topright">&times;</span>
				                        <h3>ITEM ANALYSIS</h3>
				                    </header>
				                    <div class="w3-container">';
				                    	$queryy = $this->db->query("SELECT answers FROM quiz_submit WHERE score IN (SELECT MAX(score) FROM quiz_submit WHERE subj_code = $code AND lesson_title = '$lesson' AND grade_level = '$gr' AND section = '$section' AND quiz_title = '$title' GROUP BY lrn)");
				                    	if($queryy->num_rows() > 0) {
				                    		$correct = 0;
				                    		$takers = $queryy->num_rows();
				                    		foreach ($queryy->result_array() as $itemsforanalysis) {
					                    		
					                    		$itemsforanalysis['answers'];
					                    		foreach ($this->db->query("SELECT content FROM quiz WHERE subj_code = $code AND lesson_title = '$lesson' AND grade_level = '$gr' AND section = '$section' AND quiz_title = '$title'")->result_array() as $quiz) {
					                    			
					                    			$quizcont = explode(" + ", $quiz['content']);
					                    			for ($b = 0; $b < count($quizcont); $b++) { 
														$quizpart[$b] = explode(" => ", $quizcont[$b]);
														print_r($quizpart[$b]);
													}

					                    		}
					                    	}

				                    	}else {
				                    		echo '<p>Nothing to display.</p>';
				                    	}
				                    	
				              echo '</div>
				                    <footer class="w3-container w3-padding w3-blue"></footer>
								</div>
						</div>';
					}
					
				}

			}else{
				$this->session->set_flashdata('error', 'Table not found.');
				header('Location:'.base_url().'Teacher/subjects/'.$code.'/'.$sessid);
			}

		}

		################################################################################################################
		################################################################################################################

		public function questions($subj_code, $sect, $gr, $lesson, $type, $items){
			if($type == 'multiplechoice'){
				$query = $this->db->query("SELECT * FROM question_bank_mult WHERE subj_code = $subj_code AND content != ''");
			
			}else if($type == 'identification'){
				$query = $this->db->query("SELECT * FROM question_bank_ident WHERE subj_code = $subj_code AND content != ''");
			
			}else if($type == 'enumeration'){
				$query = $this->db->query("SELECT * FROM question_bank_enum WHERE subj_code = $subj_code AND content != ''");
			
			}else if($type == 'matchingtype'){
				$query = $this->db->query("SELECT * FROM question_bank_match WHERE subj_code = $subj_code AND content != ''");
			
			}else{
				$query = $this->db->query("SELECT * FROM question_bank_truefalse WHERE subj_code = $subj_code AND content != ''");
			
			}


			if($query->num_rows() != 0){
				
				foreach ($query->result_array() as $q) {

					$cont = $q['content'];
					
					//for ($a = 0; $a < count($part); $a++) { 

						//$types[$a] = str_replace("{", "", str_replace("}", "", str_replace("%20", " ", $part[$a][0])));
						
						###############################################################################################
						//multiplechoice ##############################################################################
						if($type == 'multiplechoice'){
	                        
	                        $contpart = explode(", ", str_replace("[", "", str_replace("]", "", $cont)));

	                        for ($b = 0; $b < count($contpart); $b++) {
	                            
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
	                        
	                        $d = 1;
	                        for ($b = 0; $b < count($contpart); $b++) {
		                        echo '<div class="w3-container w3-padding">	
		                        		<input type="checkbox" onclick="submitmult('.$d.', '.$items.')" class="w3-check mult" id="m'.$d.'" value="'.$contdata[$b]['question'].'"> ';

		                            echo '<label>'.$contdata[$b]['question'].'</label><br/>';
		                            for ($c = 1; $c <= 4; $c++) {
		                            	$li = explode(" img ", $contdata[$b][$c]);
		                            	
		                                if($contdata[$b]['correct'] == $li[0]){
		                                    $selected = 'checked';
		                                }else{
		                                    $selected = '';
		                                }
		                                echo '<input type="radio" id="ch'.$d.$c.'" value="'.$contdata[$b][$c].'" '.$selected.' disabled> '.$contdata[$b][$c].' </label>';
		                            }
		                        echo '</div>';
		                        $d++;
	                        }
	                    }
	                    //multiplechoice | END

	                    ###############################################################################################
	                    //enumeration##################################################################################
	                    else if($type == 'enumeration'){

	                        $contpart = explode(", ", str_replace("[", "", str_replace("]", "", $cont)));

	                        for ($b = 1; $b < count($contpart); $b++) { 

	                        	$contdata[$b] = explode(" = ", $contpart[$b]);

	                        	for ($c = 0; $c < count($contdata[$b]); $c++) { 
	                                if($c == 0){
	                                	$contdata[$b]['question'] = $contdata[$b][$c];
	                                	unset($contdata[$b][$c]);
	                                }
	                                if($c+1 == count($contdata[$b])){
	                                	$contdata[$b]['correct'] = $contdata[$b][$c];
	                                	unset($contdata[$b][$c]);
	                                }
	                            }
	                        }
	                              

	                        $d = 1;
	                        for ($b = 1; $b < count($contpart); $b++) {

	                            echo '<div class="w3-container w3-padding">
	                        			<input type="checkbox" id="e'.$d.'" onclick="submitenum('.$d.', '.$items.')" class="w3-check enum" value="'.$contdata[$b]['question'].'"> ';
	                                echo '<label>'.$contdata[$b]['question'].'</label>';

	                                echo '<input type="text" id="cenum'.$d.'" class="w3-input w3-border w3-round" value="'.$contdata[$b]['correct'].'" disabled>';
	                            echo '</div>';
	                            $d++;
	                        }
	                    }
	                    //enumeration | END

	                    ###############################################################################################
	                    //identification###############################################################################
	                    else if($type == 'identification'){

	                        $contpart = explode(", ", str_replace("[", "", str_replace("]", "", $cont)));
	                        
	                        for ($b = 0; $b < count($contpart); $b++) {

	                            $contdata[$b] = explode(" = ", $contpart[$b]);
	                            
	                            //for ($c = 0; $c < count($contdata[$b]); $c++) { 
	                                //if($c == 0){
	                                	$contdata[$b]['question'] = $contdata[$b][0];
	                                	unset($contdata[$b][0]);
	                                //}
	                                //if($c+1 == count($contdata[$b])){
	                                	$contdata[$b]['correct'] = $contdata[$b][1];
	                                	unset($contdata[$b][1]);
	                                //}
	                            //}
	                        }

	                        $d = 1;
	                        for ($b = 0; $b < count($contpart); $b++) {
	                            echo '<div class="w3-container w3-padding">
	                            		<input type="checkbox" id="i'.$d.'" onclick="submitident('.$d.', '.$items.')" class="w3-check ident" value="'.$contdata[$b]['question'].'"> ';
		                            echo '<label>'.$contdata[$b]['question'].'</label>';
		                                        
		                            echo '<input type="text" class="w3-input w3-border w3-round" id="CHident'.$d.'" disabled value="'.$contdata[$b]['correct'].'">';
	                            echo '</div>';
	                            $d++;
	                        }
	                    }
	                    //identification | END

	                    ###############################################################################################
	                    //matchingtype#################################################################################
	                    else if($type == 'matchingtype'){

	                        $contpart = explode(", ", str_replace("[", "", str_replace("]", "", $cont)));
	                        
	                        for ($b = 0; $b < count($contpart); $b++) {

	                            $contdata[$b] = explode(" = ", $contpart[$b]);
	                            
	                            //for ($c = 0; $c < count($contdata[$b]); $c++) { 
	                                //if($c == 0){
	                                	$contdata[$b]['question'] = $contdata[$b][0];
	                                	unset($contdata[$b][0]);
	                                //}
	                                //if($c+1 == count($contdata[$b])){
	                                	$contdata[$b]['correct'] = $contdata[$b][1];
	                                	unset($contdata[$b][1]);
	                                //}
	                            //}
	                        }

	                        $d = 1;
	                        for ($b = 0; $b < count($contpart); $b++) {
	                            echo '<div class="w3-container w3-padding">
	                            		<input type="checkbox" id="matype'.$d.'" onclick="submitmatch('.$d.', '.$items.')" class="w3-check match" value="'.$contdata[$b]['question'].'"> ';
		                            echo '<label>'.$contdata[$b]['question'].'</label>';
		                                        
		                            echo '<input type="text" class="w3-input w3-border w3-round" id="CHmatch'.$d.'" disabled value="'.$contdata[$b]['correct'].'">';
	                            echo '</div>';
	                            $d++;
	                        }
	                    }
	                    //matchingtype | END

	                    ###############################################################################################
	                    //true or false################################################################################
	                    else if(str_replace("%20", " ", $type) == 'true or false'){

	                        $contpart = explode(", ", str_replace("[", "", str_replace("]", "", $cont)));
	                                	
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

	                        $d = 1;
	                        for ($b = 0; $b < count($contpart); $b++) {

	                            echo '<div class="w3-container w3-padding">
	                            		<input type="checkbox" id="tf'.$d.'" onclick="submittrufals('.$d.', '.$items.')" value="'.$contdata[$b]['question'].'" class="w3-check trufals"> ';
	                            
	                            echo '<label>'.$contdata[$b]['question'].'</label><br/>';

	                            if($contdata[$b]['correct'] == "True"){
	                                $selectedtrue = 'checked';
	                                $selectedfalse = '';
	                            
	                            }else{
	                                $selectedfalse = 'checked';
	                                $selectedtrue = '';
	                            }

	                            echo '<input type="radio" id="t'.$d.'" '.$selectedtrue.' disabled> True<br/>';
	                            echo '<input type="radio" id="f'.$d.'" '.$selectedfalse.' disabled> False<br/>';

	                            echo '</div>';
	                            $d++;
	                        }
	                                    
	                    }
					//}
					
				}

			}else{
				echo '<p class="w3-padding w3-pale-yellow w3-center">No questions were created.</p>';
			}
		}


		################################################################################################################
		################################################################################################################

		public function questionsss($id, $link, $subj_code, $gr, $section, $title, $type){
			if($type == 'multiplechoice') {
				$query = $this->db->query("SELECT * FROM question_bank_mult WHERE subj_code = $subj_code AND content != ''");
			
			}else if($type == 'identification') {
				$query = $this->db->query("SELECT * FROM question_bank_ident WHERE subj_code = $subj_code AND content != ''");
			
			}else if($type == 'enumeration') {
				$query = $this->db->query("SELECT * FROM question_bank_enum WHERE subj_code = $subj_code AND content != ''");
			
			}else if($type == 'matchingtype') {
				$query = $this->db->query("SELECT * FROM question_bank_match WHERE subj_code = $subj_code AND content != ''");
			
			}else{
				$query = $this->db->query("SELECT * FROM question_bank_truefalse WHERE subj_code = $subj_code AND content != ''");
			
			}


			if($query->num_rows() != 0) {
				
				foreach ($query->result_array() as $q) {

					$cont = $q['content'];
					
					//for ($a = 0; $a < count($part); $a++) { 

						//$types[$a] = str_replace("{", "", str_replace("}", "", str_replace("%20", " ", $part[$a][0])));
						
						###############################################################################################
						//multiplechoice ##############################################################################
						if($type == 'multiplechoice') {

	                        $toSub = explode(", ", $cont);
	                        $contpart = explode(", ", str_replace("[", "", str_replace("]", "", $cont)));

	                        for ($b = 0; $b < count($contpart); $b++) {
	                            
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
		                        		<input type="checkbox" class="w3-check mult" value="'.$toSub[$b].'" name="quest[]"> ';

		                            $qi = explode(" img ", $contdata[$b]['question']);
		                            echo '<label>'.$qi[0].'</label><br/>';
		                            
		                            if(!empty($qi[1])){
		                            	$dir = str_replace(":", "-", $title).'_'.$gr.'/'.str_replace("?", " qmark", $qi[0]).'/';
		                                
		                                echo '<img src="'.base_url().$dir.$qi[1].'" style="max-width:8em;width:100%;max-height:8em;" load="lazy"><br/><br/>';
		                            }

		                            for ($c = 1; $c <= 4; $c++) {
		                            	$li = explode(" img ", $contdata[$b][$c]);
		                            	
		                                if($contdata[$b]['correct'] == $li[0]){
		                                    $selected = 'checked';
		                                }else{
		                                    $selected = '';
		                                }

		                                if(!empty($li[1])){
		                                	$adir = str_replace(":", "-", $title).'_'.$gr.'/'.str_replace("?", " qmark", $qi[0]).'/';
		                                	echo '<input type="radio" value="'.$contdata[$b][$c].'" '.$selected.' disabled> ';
		                                	echo '<img src="'.base_url().$adir.$li[1].'" style="max-width:8em;width:100%;max-height:8em;" load="lazy"> ';

		                                }else{
		                                	echo '<input type="radio" value="'.$contdata[$b][$c].'" '.$selected.' disabled> '.$contdata[$b][$c].' </label>';
		                            	}
		                            }
		                        echo '</div>';
		                        
	                        }
	                        echo '<input type="hidden" name="type" value="multiplechoice">';

	                    }
	                    //multiplechoice | END

	                    ###############################################################################################
	                    //enumeration##################################################################################
	                    else if($type == 'enumeration'){

	                    	$toSub = explode(", ", $cont);
	                        $contpart = explode(", ", str_replace("[", "", str_replace("]", "", $cont)));

	                        for ($b = 1; $b < count($contpart); $b++) { 

	                        	$contdata[$b] = explode(" = ", $contpart[$b]);

	                        	for ($c = 0; $c < count($contdata[$b]); $c++) { 
	                                if($c == 0){
	                                	$contdata[$b]['question'] = $contdata[$b][$c];
	                                	unset($contdata[$b][$c]);
	                                }
	                                if($c+1 == count($contdata[$b])){
	                                	$contdata[$b]['correct'] = $contdata[$b][$c];
	                                	unset($contdata[$b][$c]);
	                                }
	                            }
	                        }
	                              
	                       
	                        for ($b = 1; $b < count($contpart); $b++) {

	                            echo '<div class="w3-container w3-padding">
	                        			<input type="checkbox" class="w3-check enum" value="'.$toSub[$b].'" name="quest[]"> ';
	                                echo '<label>'.$contdata[$b]['question'].'</label>';

	                                echo '<input type="text" class="w3-input w3-border w3-round" value="'.$contdata[$b]['correct'].'" disabled>';
	                            echo '</div>';
	                            
	                        }
	                        echo '<input type="hidden" name="type" value="enumeration">';
	                        
	                    }
	                    //enumeration | END

	                    ###############################################################################################
	                    //identification###############################################################################
	                    else if($type == 'identification'){

	                    	$toSub = explode(", ", $cont);
	                        $contpart = explode(", ", str_replace("[", "", str_replace("]", "", $cont)));
	                        
	                        for ($b = 0; $b < count($contpart); $b++) {

	                            $contdata[$b] = explode(" = ", $contpart[$b]);
	                            
	                            //for ($c = 0; $c < count($contdata[$b]); $c++) { 
	                                //if($c == 0){
	                                	$contdata[$b]['question'] = $contdata[$b][0];
	                                	unset($contdata[$b][0]);
	                                //}
	                                //if($c+1 == count($contdata[$b])){
	                                	$contdata[$b]['correct'] = $contdata[$b][1];
	                                	unset($contdata[$b][1]);
	                                //}
	                            //}
	                        }

	                        for ($b = 0; $b < count($contpart); $b++) {
	                            echo '<div class="w3-container w3-padding">
	                            		<input type="checkbox" class="w3-check ident" value="'.$toSub[$b].'" name="quest[]"> ';
		                            echo '<label>'.$contdata[$b]['question'].'</label>';
		                                        
		                            echo '<input type="text" class="w3-input w3-border w3-round" disabled value="'.$contdata[$b]['correct'].'">';
	                            echo '</div>';
	                            
	                        }
	                        echo '<input type="hidden" name="type" value="identification">';
	                    }
	                    //identification | END

	                    ###############################################################################################
	                    //matchingtype#################################################################################
	                    else if($type == 'matchingtype'){

	                    	$toSub = explode(", ", $cont);
	                        $contpart = explode(", ", str_replace("[", "", str_replace("]", "", $cont)));
	                        
	                        for ($b = 0; $b < count($contpart); $b++) {

	                            $contdata[$b] = explode(" = ", $contpart[$b]);
	                            
	                            //for ($c = 0; $c < count($contdata[$b]); $c++) { 
	                                //if($c == 0){
	                                	$contdata[$b]['question'] = $contdata[$b][0];
	                                	unset($contdata[$b][0]);
	                                //}
	                                //if($c+1 == count($contdata[$b])){
	                                	$contdata[$b]['correct'] = $contdata[$b][1];
	                                	unset($contdata[$b][1]);
	                                //}
	                            //}
	                        }

	                        for ($b = 0; $b < count($contpart); $b++) {
	                            echo '<div class="w3-container w3-padding">
	                            		<input type="checkbox" class="w3-check match" value="'.$toSub[$b].'" name="quest[]"> ';
		                            echo '<label>'.$contdata[$b]['question'].'</label>';
		                                        
		                            echo '<input type="text" class="w3-input w3-border w3-round" disabled value="'.$contdata[$b]['correct'].'">';
	                            echo '</div>';
	                        }
	                        echo '<input type="hidden" name="type" value="matchingtype">';
	                    }
	                    //matchingtype | END

	                    ###############################################################################################
	                    //true or false################################################################################
	                    else if(str_replace("%20", " ", $type) == 'true or false') {

	                    	$toSub = explode(", ", $cont);
	                        $contpart = explode(", ", str_replace("[", "", str_replace("]", "", $cont)));
	                                	
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

	                            echo '<div class="w3-container w3-padding">
	                            		<input type="checkbox" value="'.$toSub[$b].'" class="w3-check truefalse" name="quest[]"> ';
	                            
	                            echo '<label>'.$contdata[$b]['question'].'</label><br/>';

	                            if($contdata[$b]['correct'] == "True"){
	                                $selectedtrue = 'checked';
	                                $selectedfalse = '';
	                            
	                            }else{
	                                $selectedfalse = 'checked';
	                                $selectedtrue = '';
	                            }

	                            echo '<input type="radio" '.$selectedtrue.' disabled> True<br/>';
	                            echo '<input type="radio" '.$selectedfalse.' disabled> False<br/>';

	                            echo '</div>';
	                            
	                        }
	                        echo '<input type="hidden" name="type" value="trueorfalse">';          
	                    }
					//}
					
				}
				echo '<input type="hidden" name="gr" value="'.$gr.'">';
				echo '<input type="hidden" name="subj" value="'.$title.'">';
				//echo '<input type="submit" id="rmvbut" class="w3-button w3-blue w3-round w3-hover-light-blue w3-margin-top w3-margin-bottom" value="Remove" disabled>';
			}else{
				echo '<p class="w3-padding w3-pale-yellow w3-center">No questions were created.</p>';
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
		//FOR GRADING
		public function listOfSubjectsToGrade($id, $link){
			$query = $this->db->query("SELECT * FROM subject_teacher WHERE subj_teacher = '$id' ORDER BY LENGTH(gr_level), gr_level"); // NATURAL SORTING IN MYSQL
			$dir = base_url().'Subject_image/';

			if(count($query->result_array()) != 0){
				foreach ($query->result_array() as $subj) {

					foreach ($this->db->query("SELECT * FROM subjects WHERE subj_code = '".$subj['subj_code']."'")->result_array() as $subjInfo) {
						
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
	 						echo '<a href="'.base_url().'Teacher/subjectstograde/'.$subjInfo['subj_code'].'/'.$link.'" style="text-decoration:none;"><h3>'.strtoupper($subjInfo['subj_title']).' ('.strtoupper($subjInfo['gr_level']).' - '.strtoupper($subj['section']).')</h3></a>';

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
				echo '<div class="w3-container w3-padding w3-pale-yellow w3-margin w3-center">You are not assigned to any subjects.</div>';
			}
		}

		################################################################################################################
		################################################################################################################

		public function studentlist($id, $sessid, $code, $gr, $section, $title){
			$table = str_replace(" ", "", str_replace("-", "_", $section)).'_'.str_replace(" ", "", $gr).'_'.$code;

			if($this->db->query("SHOW TABLES LIKE '$table'")->num_rows() == 1){

				if($gr == 'Grade 11' || $gr == 'Grade 12'){
					$query = $this->db->query("SELECT * FROM shsstudents WHERE subjects LIKE '%$code%' AND grade_level = '$gr' AND section = '$section' AND status = 'Enrolled' ORDER BY lname ASC");

				}else{
					$query = $this->db->query("SELECT * FROM jhsstudents WHERE subjects LIKE '%$code%' AND grade_level = '$gr' AND section = '$section' AND status = 'Enrolled' ORDER BY lname ASC");	
				}

				if($query->num_rows() == 0){
					echo '<p class="w3-pale-yellow w3-center w3-padding">No students enrolled.</p>';

				}else{

					echo '<div class="w3-margin-bottom" style="overflow-x:auto;"><table class="w3-table-all w3-small">';
					
						
						echo '<thead><tr class="w3-light-grey"><td></td>';
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
							echo '<td>'.$st['fname'].' '.$st['lname'].'</td>';

							foreach ($this->db->query("SELECT * FROM $table")->result_array() as $a) {
								$acts = explode(", ", $a['activity']);
								
								for ($b=0; $b < count($acts); $b++) { 
									if (empty($acts[$b])) {}
									else{
										
										$check = $this->db->query("SELECT *, MAX(grade) AS mgrade FROM activities_submit WHERE subj_code = $code AND lesson_title = '".$a['lesson']."' AND grade_level = '$gr' AND section = '$section' AND activity_title = '".$acts[$b]."' AND lrn = '".$st['lrn']."'");

										if($check->num_rows() == 0){
											echo '<td></td>';
										
										}else{
											foreach ($check->result_array() as $info) {
												echo '<td>'.$info['mgrade'].'</td>';
											}
										}
									}
								}

								$quiz = explode(", ", $a['quiz']);
								for ($c=0; $c < count($quiz); $c++) { 
									if (empty($quiz[$c])) {}
									else{
										$check = $this->db->query("SELECT *, MAX(score) AS mscore FROM quiz_submit WHERE subj_code = $code AND lesson_title = '".$a['lesson']."' AND grade_level = '$gr' AND section = '$section' AND quiz_title = '".$quiz[$c]."' AND lrn = '".$st['lrn']."'");

										if($check->num_rows() == 0){
											echo '<td></td>';
										
										}else{
											foreach ($check->result_array() as $info) {
												echo '<td>'.$info['mscore'].'</td>';
											}
										}
									}
								}
							}
							echo '</tr>';
						}
						
					
					

						//foreach ($query->result_array() as $s) {
							


						//}


				
					echo '</table></div>';
				}

			}else{
				$this->session->set_flashdata('error', 'Table not found.');
				header('Location:'.base_url().'Teacher/subjectstograde/'.$code.'/'.$sessid);
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
		public function postedconcerns($sessid){
			
			$ID = str_replace("_47_", "/", str_replace("_50_", "=", $sessid));
			$decID = $this->encryption->decrypt($ID);
			$query = $this->db->query("SELECT * FROM concerns WHERE receiver = '$decID' OR sender = '$decID' ORDER BY date DESC");

			
			if($query->num_rows() != 0){
				foreach ($query->result_array() as $i) {

					if($i['receiver'] == 'Administrator' || $i['sender'] == 'Administrator'){
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
					if($i['sender'] == $decID && $i['status'] != 'resolved' && $i['status'] != 'declined'){
						$rem = '<input type="submit" value="Cancel" name="button" class="w3-button w3-small w3-red w3-round w3-hover-pale-red">';
					}else{
						$rem = '';
					}
					//CANCEL BUTTON | END

					if($i['status'] == 'pending' && $i['receiver'] == $decID){
						$stat = 'w3-red';
						$button = '<input type="submit" value="click here if resolved" name="button" class="w3-button w3-small w3-round w3-blue w3-hover-light-blue">';
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
								<form action="'.base_url().'Teacher/viewedconcern/'.$sessid.'/'.$i['c_id'].'" method="post">
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
			
		}

	}
?>