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


	    <a href="<?php echo base_url();?>admin/teachers" onclick="w3_close()" class="w3-bar-item w3-white w3-button w3-text-blue w3-hover-text-blue w3-hover-white w3-padding-16" style="border-radius: 30px 0px 0px 30px;">
	      	<span class="fa fa-users w3-margin-left"></span>&nbsp;&nbsp;Teachers
	    </a> 


	    <a href="<?php echo base_url();?>admin/enrolledstudents" onclick="w3_close()" class="w3-bar-item w3-button w3-text-white w3-hover-text-blue w3-hover-white w3-padding-16" style="border-radius: 30px 0px 0px 30px;">
	      	<span class="fa fa-users w3-margin-left"></span>&nbsp;&nbsp;Enrolled students
	    </a> 


	    <!-- ACCORDION FOR OTHERS -->
	    <a onclick="others();" class="w3-bar-item w3-button w3-text-white w3-hover-text-white w3-hover-none w3-padding-16" style="border-radius: 30px 0px 0px 30px;">
	    	<span class="fa fa-sliders w3-margin-left"></span>&nbsp;&nbsp;Others <i class="fa fa-caret-down"></i>
	    </a> 
	    <div id="others_items" class="w3-container w3-show">
	    	<a href="<?php echo base_url();?>admin/concerns" class="w3-bar-item w3-button w3-margin-left w3-hover-text-blue w3-hover-white w3-small" style="border-radius: 30px 0px 0px 30px;">
	    		<span class="fa fa-bookmark w3-margin-left"></span>&nbsp;&nbsp;Concerns <span class="w3-badge w3-circle w3-white" id="adminconcerncounter"></span>
	    	</a>
	    	<a href="<?php echo base_url();?>admin/announcement" class="w3-bar-item w3-button w3-margin-left w3-hover-text-blue w3-hover-white w3-small" style="border-radius: 30px 0px 0px 30px;">
	    		<span class="fa fa-bullhorn w3-margin-left"></span>&nbsp;&nbsp;Announcement
	    	</a>
	    	<a href="<?php echo base_url();?>admin/events" class="w3-bar-item w3-button w3-margin-left w3-hover-text-blue w3-hover-white w3-small" style="border-radius: 30px 0px 0px 30px;">
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
	    	<h3 class="w3-left w3-padding"><b>TEACHER PROFILE</b></h3>
		</span>
	    <!--<span class="fa fa-bell w3-large w3-right w3-padding-large w3-margin-top w3-margin-right">
	    	<span class="w3-badge w3-right w3-small w3-red">3</span>
		</span>-->
  	</div>

  	<!-- MAIN CONTENT -->
  	<div class="w3-container">

  		<div class="w3-container w3-card w3-round w3-margin-bottom w3-margin-top">

  				<?php

  					echo "<p><a class='w3-text-blue w3-small' style='text-decoration: none;' href='".base_url()."admin/teachers'>Teachers</a> / <span class='w3-small'>".$fname." ".$lname."</span></p>";

  					if($photo == ''){
  						$img = '<span class="fa fa-user-circle-o w3-margin-right w3-left" style="font-size:7em;"></span>';
  					}else{
  						$img = '<img src="'.base_url().'ProfilePic/teachers/'.$photo.'" class="w3-circle w3-margin-right w3-left" style="max-width:7em;width:100%;max-height:7em;">';
  					}
  				?>

  				<div class="w3-container w3-card w3-padding-large w3-round w3-margin-bottom w3-margin-top">
		  			<?php echo $img; ?>
		  			
		  			<?php
		  			echo '<div class="w3-left" style="line-height: 1.5em;">';
			    		echo '<h2>'.$fname.' '.$mname.' '.$lname,'</h2>';
			    		echo '<p>'.$rank.'<br/>'.$tid.'</p>';
			    	echo '</div>';
			    	?>

				</div>

				<div class="w3-container w3-card w3-padding-large w3-round w3-margin-bottom">
					<div>
						<?php
							
							echo '<div class="w3-row w3-section">
							  		<div class="w3-col w3-center" style="width:50px">
							  			<i class="w3-xlarge fa fa-graduation-cap w3-center"></i>
							  		</div>
							    	<div class="w3-rest">';
							      		echo 'Major in '.$major;
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
							  			<i class="w3-xlarge fa fa-envelope"></i>
							  		</div>
							    	<div class="w3-rest">';
							      		echo $email;
							echo '</div>
							</div>';

							echo '<div class="w3-row w3-section">
							  		<div class="w3-col w3-center" style="width:50px">
							  			<i class="w3-xlarge fa fa-th-large"></i>
							  		</div>
							    	<div class="w3-rest">';
							      		echo $Department;
							echo '</div>
							</div>';							
							
							$chkadv = $this->db->query("SELECT * FROM sections WHERE adviser = '$tid'");
							if($chkadv->num_rows() == 1){
								foreach ($chkadv->result_array() as $sectinfo) {
									$sectinfo['gr_level'];
									$sectinfo['sect_name'];
								}
								echo '<div class="w3-row w3-section">
								  		<div class="w3-col w3-center" style="width:50px">
								  			<i class="w3-xlarge fa fa-users"></i>
								  		</div>
								    	<div class="w3-rest">';
								      		echo 'Class adviser of <a href="'.base_url().'admin/'.str_replace(" ", "", $sectinfo['gr_level']).'/'.$sectinfo['sect_name'].'">'.$sectinfo['gr_level'].' - '.$sectinfo['sect_name'].'</a>';
								echo '</div>
								</div>';	
							}

							if($teach_load >= 1){
								echo '<div class="w3-row w3-section">
								  		<div class="w3-col w3-center" style="width:50px">
								  			<i class="w3-xlarge fa fa-tasks"></i>
								  		</div>
								    	<div class="w3-rest">';
								      		echo 'Subject teacher of:<ul>';
								
										foreach ($this->db->query("SELECT * FROM subject_teacher WHERE subj_teacher = '$tid'")->result_array() as $subj) {
											
											foreach ($this->db->query("SELECT * FROM subjects WHERE subj_code = '".$subj['subj_code']."'")->result_array() as $subjinfo) {
												echo '<li><a href="'.base_url().'admin/subjects/'.$subj['subj_code'].'">'.$subjinfo['subj_title'].'</a> ( '.$subj['gr_level'].' - '.$subj['section'].' ) </li>';
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