<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<title><?= $title; ?></title>

<body onload="LoadAll()">
<!-- | Sidebar/menu | -->
<nav class="w3-sidebar w3-blue w3-collapse w3-top w3-large w3-animate-left" style="z-index:3;width:245px;font-weight:bold;" id="mySidebar"><br>
 	<div class="w3-container">
		<center>
			<span class="fa fa-user-circle-o" style="font-size:100px;"></span>
      		<h5 class="w3-text-white">ADMINISTRATOR</h5>
    	</center>
  	</div>
  	<br/>

  	<div class="w3-bar-block">  
	    <a href="<?php echo base_url();?>admin/dashboard" onclick="w3_close()" class="w3-bar-item w3-button w3-text-white w3-hover-text-blue w3-hover-white w3-padding-16" style="border-radius: 30px 0px 0px 30px;">
	    	<span class="fa fa-dashboard w3-margin-left"></span>&nbsp;&nbsp;Dashboard
	    </a> 


	    <a onclick="accounts();" class="w3-bar-item w3-button w3-text-white w3-hover-text-blue w3-hover-white w3-padding-16" style="border-radius: 30px 0px 0px 30px;">
	    	<span class="fa fa-user-circle-o w3-margin-left"></span>&nbsp;&nbsp;Accounts <i class="fa fa-caret-down"></i>
	    </a>
	    <div id="accounts_items" class="w3-container w3-hide">
	    	<a href="<?php echo base_url();?>admin/studentaccounts" onclick="w3_close()" class="w3-bar-item w3-button w3-margin-left w3-hover-text-blue w3-hover-white w3-small" style="border-radius: 30px 0px 0px 30px;">
	    		<span class="fa fa-users w3-margin-left"></span>&nbsp;&nbsp;Students
	    	</a>
	    	<a href="<?php echo base_url();?>admin/teacheraccounts" onclick="w3_close()" class="w3-bar-item w3-button w3-margin-left w3-hover-text-blue w3-hover-white w3-small" style="border-radius: 30px 0px 0px 30px;">
	    		<span class="fa fa-users w3-margin-left"></span>&nbsp;&nbsp;Teachers
	    	</a>
	    </div>


	    <!-- ACCORDION FOR SECTIONS -->
	    <a onclick="section();" class="w3-bar-item w3-button w3-text-white w3-hover-text-blue w3-hover-white w3-padding-16" style="border-radius: 30px 0px 0px 30px;">
	    	<span class="fa fa-th-list w3-margin-left"></span>&nbsp;&nbsp;Sections <i class="fa fa-caret-down"></i>
	    </a>
	    <div id="sections" class="w3-container w3-hide">
	    	<a href="<?php echo base_url(); ?>admin/grade7/List" onclick="w3_close()" class="w3-bar-item w3-button w3-margin-left w3-hover-text-blue w3-hover-white w3-small" style="border-radius: 30px 0px 0px 30px;">
	    		<span class="fa fa-users w3-margin-left"></span>&nbsp;&nbsp;Grade 7
	    	</a>
	    	<a href="<?php echo base_url(); ?>admin/grade8/List" onclick="w3_close()" class="w3-bar-item w3-button w3-margin-left w3-hover-text-blue w3-hover-white w3-small" style="border-radius: 30px 0px 0px 30px;">
	    		<span class="fa fa-users w3-margin-left"></span>&nbsp;&nbsp;Grade 8
	    	</a>
	    	<a href="<?php echo base_url(); ?>admin/grade9/List" onclick="w3_close()" class="w3-bar-item w3-button w3-margin-left w3-hover-text-blue w3-hover-white w3-small" style="border-radius: 30px 0px 0px 30px;">
	    		<span class="fa fa-users w3-margin-left"></span>&nbsp;&nbsp;Grade 9
	    	</a>
	    	<a href="<?php echo base_url(); ?>admin/grade10/List" onclick="w3_close()" class="w3-bar-item w3-button w3-margin-left w3-hover-text-blue w3-hover-white w3-small" style="border-radius: 30px 0px 0px 30px;">
	    		<span class="fa fa-users w3-margin-left"></span>&nbsp;&nbsp;Grade 10
	    	</a>
	    	<a href="<?php echo base_url(); ?>admin/grade11/List" onclick="w3_close()" class="w3-bar-item w3-button w3-margin-left w3-hover-text-blue w3-hover-white w3-small" style="border-radius: 30px 0px 0px 30px;">
	    		<span class="fa fa-users w3-margin-left"></span>&nbsp;&nbsp;Grade 11
	    	</a>
	    	<a href="<?php echo base_url(); ?>admin/grade12/List" onclick="w3_close()" class="w3-bar-item w3-button w3-margin-left w3-hover-text-blue w3-hover-white w3-small" style="border-radius: 30px 0px 0px 30px;">
	    		<span class="fa fa-users w3-margin-left"></span>&nbsp;&nbsp;Grade 12
	    	</a>
	    </div>
	    <!-- END OF ACCORDION FOR SECTIONS -->


	    <a href="<?php echo base_url();?>admin/subjects/overview" onclick="w3_close()" class="w3-bar-item w3-button w3-text-white w3-hover-text-blue w3-hover-white w3-padding-16" style="border-radius: 30px 0px 0px 30px;">
	      	<span class="fa fa-graduation-cap w3-margin-left"></span>&nbsp;&nbsp;Subjects
	    </a>


	    <a href="<?php echo base_url();?>admin/teachers" onclick="w3_close()" class="w3-bar-item w3-button w3-text-white w3-hover-text-blue w3-hover-white w3-padding-16" style="border-radius: 30px 0px 0px 30px;">
	      	<span class="fa fa-users w3-margin-left"></span>&nbsp;&nbsp;Teachers
	    </a> 


	    <a href="<?php echo base_url();?>admin/enrolledstudents" onclick="w3_close()" class="w3-bar-item w3-white w3-button w3-text-blue w3-hover-text-blue w3-hover-white w3-padding-16" style="border-radius: 30px 0px 0px 30px;">
	      	<span class="fa fa-users w3-margin-left"></span>&nbsp;&nbsp;Enrolled students
	    </a> 


	    <!-- ACCORDION FOR OTHERS -->
	    <a onclick="others();" class="w3-bar-item w3-button w3-text-white w3-hover-text-white w3-hover-none w3-padding-16" style="border-radius: 30px 0px 0px 30px;">
	    	<span class="fa fa-sliders w3-margin-left"></span>&nbsp;&nbsp;Others <i class="fa fa-caret-down"></i>
	    </a> 
	    <div id="others_items" class="w3-container w3-show">
	    	<a href="<?php echo base_url();?>admin/concerns" onclick="w3_close()" class="w3-bar-item w3-button w3-margin-left w3-hover-text-blue w3-hover-white w3-small" style="border-radius: 30px 0px 0px 30px;">
	    		<span class="fa fa-bookmark w3-margin-left"></span>&nbsp;&nbsp;Concerns <span class="w3-badge w3-circle w3-white" id="adminconcerncounter"></span>
	    	</a>
	    	<a href="<?php echo base_url();?>admin/announcement" onclick="w3_close()" class="w3-bar-item w3-button w3-margin-left w3-hover-text-blue w3-hover-white w3-small" style="border-radius: 30px 0px 0px 30px;">
	    		<span class="fa fa-bullhorn w3-margin-left"></span>&nbsp;&nbsp;Announcement
	    	</a>
	    	<a href="<?php echo base_url();?>admin/events" onclick="w3_close()" class="w3-bar-item w3-button w3-margin-left w3-hover-text-blue w3-hover-white w3-small" style="border-radius: 30px 0px 0px 30px;">
	    		<span class="fa fa-calendar w3-margin-left"></span>&nbsp;&nbsp;Events
	    	</a>
	    	<a href="javascript:void(0)" onclick="document.getElementById('Confirmation').style.display='block'" class="w3-bar-item w3-button w3-margin-left w3-hover-text-blue w3-hover-white w3-small" style="border-radius: 30px 0px 0px 30px;">
	    		<span class="fa fa-pencil-square-o w3-margin-left"></span>&nbsp;&nbsp;Edit credentials
	    	</a>
	    </div>
	    <!-- END OF ACCORDION FOR OTHERS -->


	    <a href="<?php echo base_url(); ?>admin/logout" onclick="w3_close()" class="w3-bar-item w3-button w3-text-white w3-hover-text-blue w3-hover-white w3-padding-16" style="border-radius: 30px 0px 0px 30px;">
	    	<span class=" fa fa-sign-out w3-margin-left"></span>&nbsp;&nbsp;Log Out
	    </a> 
  	</div>
</nav>
<!-- | END of Sidebar/menu | -->


<!-- | CONTENT | -->

	<!--Top menu on small screens-->
	<header class="w3-container w3-top w3-hide-large w3-blue w3-padding">
		<span>
	    	<img class="w3-circle w3-right" src="<?php echo base_url()?>resource/img/Logo.png" alt="School Logo" style="max-width:60px; width:100%;">
	    	<h3>
	    		<a href="javascript:void(0)" class="fa fa-bars w3-button w3-blue w3-margin-right w3-xlarge w3-left w3-hover-light-blue w3-round" onclick="w3_open()"></a>
	    	</h3>
	  	</span>
	</header>

	<!-- Overlay effect when opening sidebar on small screens -->
	<div class="w3-overlay w3-hide-large" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

	<br class="w3-hide-large"><br class="w3-hide-large"><br class="w3-hide-large">
	<!-- END | Top menu on small screens-->



<!-- FOR EDIT CREDENTIAL MODAL -->
<?php
	extract($this->session->userdata('Home of the braves@2022:admin'));
?>
<div class="w3-container">
	<div class="w3-modal" id="Confirmation">
		<div class="w3-modal-content w3-card-4 w3-animate-top w3-white w3-round" style="max-width:600px">
	        <header class="w3-container w3-blue">
	    		<span onclick="document.getElementById('Confirmation').style.display='none'" class="w3-button w3-display-topright w3-blue w3-hover-light-blue" title="Close Modal">&times;</span>
	            <h3>CONFIRM YOUR PASSWORD</h3>
	        </header>

          	<div class="w3-container">
	            <form method="post" action="<?php echo base_url();?>admin/confirmpassword">
	              	<div class="w3-section">
	                	<input class="w3-input w3-border w3-round" type="password" placeholder="Enter Password" name="password" pattern="\S+" required>
	                	<input type="hidden" name="id" value="<?php echo $id;?>">
	                	<button class="w3-button w3-block w3-blue w3-section w3-padding w3-round w3-hover-light-blue" type="submit">Confirm</button>
	              	</div>
	            </form>
          	</div>

        	<div class="w3-container w3-padding w3-blue">
            	<span class="w3-right w3-padding"></span>
        	</div>
          
      	</div>
	</div>
</div>
<!-- FOR EDIT CREDENTIAL MODAL | END -->


<!-- PAGE CONTENT -->
<div class="w3-main w3-animate-right w3-margin-bottom" style="margin-left: 245px;">
  
  	<!-- HEADER -->
  	<div class="w3-container w3-white w3-hide-small w3-hide-medium" style="box-shadow: 2px 0px 5px 1px gray;">
	    <span>
	    	<h3 class="w3-left w3-padding"><b>STUDENT PROFILE</b></h3>
		</span>
  	</div>

  	<!-- MAIN CONTENT -->
  	<div class="w3-container">

  		<div class="w3-container w3-card w3-round w3-margin-bottom w3-margin-top">
  			

  			<?php
  				if($grade_level == 'Grade 7'){
  					$grade = 'grade7';
  				}
  				if($grade_level == 'Grade 8'){
  					$grade = 'grade8';
  				}
  				if($grade_level == 'Grade 9'){
  					$grade = 'grade9';
  				}
  				if($grade_level == 'Grade 10'){
  					$grade = 'grade10';
  				}
  				if($grade_level == 'Grade 11'){
  					$grade = 'grade11';
  				}
  				if($grade_level == 'Grade 12'){
  					$grade = 'grade12';
  				}

  				echo "<p><a class='w3-text-blue w3-small' style='text-decoration: none;' href='javascript:void()' onclick='goback()'>".$prevlink."</a> / <span class='w3-small'>".$fname." ".$lname."</span></p>";
  			?>

  			<div class="w3-container w3-card w3-padding-large w3-round w3-margin-bottom w3-margin-top">
  				<?php
  					if($stat=='Enrolled'){
		  				$color = 'w3-green';
		  			}else if($stat == 'Dropped'){
		  				$color = 'w3-red';
		  			}else{
		  				$color = 'w3-yellow';
		  			}

                    if($photo == ''){
                        $img = '<span class="fa fa-user-circle-o w3-margin-right w3-left" id="img1" style="font-size:7em;"></span>';
                    }else{
                        $img = '<img src="'.base_url().'ProfilePic/Students/'.$photo.'" id="img1" class="w3-circle w3-margin-right w3-left" style="max-width:7em; width:100%; max-height:7em">';
                    }

                    echo "<div class='w3-row'>";
                        echo "<div class='w3-col w3-margin-right' style='max-width:7em;'>";
                            echo "<div class='w3-display-container' style='height:7em;' onmouseover='showEdit()' onmouseout='hideEdit()'>";
                                	echo $img;
                                    echo '<a href="javascript:void(0)" onclick="document.getElementById(\'uploadPic\').style.display = \'block\'" class="w3-hide" id="link1"><i class="fa fa-pencil"></i></a>';
                            echo "</div>";
                        echo "</div>";
                        echo "<div class='w3-rest w3-left' style='line-height: 1.5em;'>";
                            echo '<h2>'.$fname.' '.$mname.' '.$lname.' <span class="w3-medium w3-tag w3-round '.$color.'"> ('.$stat.')</span><br/><br/>'.$lrn.'</h2>';
                            
                        echo "</div>";

                    echo "</div>";
                ?>
			</div>

			<div class="w3-container w3-card w3-padding-large w3-round w3-margin-bottom">
				<div>
					<?php
						if($address==''){
							$address = 'Not set';
						}
						if($contact==''){
							$contact = 'Not set';
						}
						if($email==''){
							$email = 'Not set';
						}

							echo '<div class="w3-row w3-section">
							  		<div class="w3-col w3-center" style="width:50px">
							  			<i class="w3-xlarge fa fa-graduation-cap w3-center"></i>
							  		</div>
							    	<div class="w3-rest">';
							      		echo $grade_level." - ".$section;
							echo '</div>
							</div>';

							echo '<div class="w3-row w3-section">
							  		<div class="w3-col w3-center" style="width:50px">
							  			<i class="w3-xlarge fa fa-map-marker"></i>
							  		</div>
							    	<div class="w3-rest">';
							      		echo $address;
							echo '</div>
							</div>';

							echo '<div class="w3-row w3-section">
							  		<div class="w3-col w3-center" style="width:50px">
							  			<i class="w3-xlarge fa fa-calendar"></i>
							  		</div>
							    	<div class="w3-rest">';
							      		echo $Birthdate;
							echo '</div>
							</div>';

							echo '<div class="w3-row w3-section">
							  		<div class="w3-col w3-center" style="width:50px">
							  			<i class="w3-xlarge fa fa-intersex"></i>
							  		</div>
							    	<div class="w3-rest">';
							      		echo $sex;
							echo '</div>
							</div>';

							echo '<div class="w3-row w3-section">
							  		<div class="w3-col w3-center" style="width:50px">
							  			<i class="w3-xlarge fa fa-phone"></i>
							  		</div>
							    	<div class="w3-rest">';
							      		echo $contact;
							echo '</div>
							</div>';

							echo '<div class="w3-row w3-section">
							  		<div class="w3-col w3-center" style="width:50px">
							  			<i class="w3-xlarge fa fa-envelope"></i>
							  		</div>
							    	<div class="w3-rest">';
							      		echo $email;
							echo '</div>
							</div>';

							if($subj != ''){
								echo '<div class="w3-row w3-section">
								  		<div class="w3-col w3-center" style="width:50px">
								  			<i class="w3-xlarge fa fa-book"></i>
								  		</div>
								    	<div class="w3-rest">';
								      		echo 'Subject/s enrolled:<ul>';

										$subj = explode(", ", $subj);
										for ($i=0; $i < count($subj); $i++) { 
											
											foreach ($this->db->query("SELECT * FROM subjects WHERE subj_code = '".$subj[$i]."'")->result_array() as $sub) {
												echo '<li><a href="'.base_url().'admin/subjects/'.$subj[$i].'">'.$sub['subj_title'].'</a></li>';
											}

										}
										echo '</ul>
										</div>
									</div>';
							}
							
						?>
					</div>
				</div>
		</div>
	</div>
	<!-- END MAIN CONTENT -->
</div>
<script type="text/javascript">
	function goback(){
		window.history.back();
	}

	//ADMIN
    function LoadAll() {
    	setInterval(function(){
            
            var countpostedconcern = new XMLHttpRequest();
            countpostedconcern.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("adminconcerncounter").innerHTML = this.responseText;
                }
            };

            countpostedconcern.open("GET", "https://"+window.location.hostname+"/BanquerohanNationalHighSchool/Admin/countconcern", true);
            countpostedconcern.send();

        }, 5000);
    }
    //Counter();
    //ADMIN | END
</script>
</body>