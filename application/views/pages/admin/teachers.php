<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<title><?= $title; ?></title>
<style type="text/css">
	table {
	    border-collapse: collapse;
	    width: 100%;
	}th, td {
    	text-align: left;
   		padding: 8px;
	}
</style>
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


	    <a href="<?php echo base_url();?>admin/teachers" onclick="w3_close()" class="w3-bar-item w3-button w3-white w3-text-blue w3-hover-text-blue w3-hover-white w3-padding-16" style="border-radius: 30px 0px 0px 30px;">
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


	<!--Top menu on small screens-->
	<header class="w3-container w3-top w3-hide-large w3-blue w3-padding">
		<span>
	    	<img class="w3-circle w3-right" src="<?php echo base_url()?>resource/img/Logo.png" alt="School Logo" style="max-width:60px; width:100%;">
	    	
	    		<div class="w3-dropdown-click w3-right w3-margin-top">
                    <button class="w3-button w3-hover-blue w3-blue fa fa-bell w3-large" onclick="dropdownsmall()"><span class="w3-badge w3-circle w3-red" id="AdminNotifSmall"></button>

                    <div id="AdminItemsSmall" class="w3-dropdown-content w3-bar-block w3-border" style="right: 0; width: 20em; height: 30em; overflow: scroll"></div>
                </div>

	    	<h3>
	    		<a href="javascript:void(0)" class="fa fa-bars w3-button w3-blue w3-xlarge w3-left w3-hover-light-blue w3-round" onclick="w3_open()"></a>TEACHERS
	    	</h3>
	  	</span>
	</header>

	<!-- Overlay effect when opening sidebar on small screens -->
	<div class="w3-overlay w3-hide-large" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>
	<!-- END | Top menu on small screens-->

	<br class="w3-hide-large"><br class="w3-hide-large"><br class="w3-hide-large">


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
	    	<h3 class="w3-left w3-padding"><b>TEACHERS</b></h3>
	    	
	    	<div class="w3-dropdown-click w3-right w3-margin-top">
                <button class="w3-button w3-hover-white w3-white fa fa-bell w3-large w3-padding-large" onclick="dropdownlarge()"><span class="w3-badge w3-circle w3-red" id="AdminNotifLarge"></span></button>

                <div id="AdminNotifLargeItems" class="w3-dropdown-content w3-bar-block w3-border" style="right: 0; width: 30em; height:35em; overflow: scroll"></div>
            </div>
		</span>
  	</div>

  	<!-- MAIN CONTENT -->
  	<div class="w3-container">

	    <div class="w3-container w3-card w3-padding-large w3-round w3-margin-top">
	    	<form action="<?php echo base_url();?>admin/searchTeacher/teachers" method="post">	
		    	<label class="w3-left w3-margin-right w3-hide-small"><b>Search:</b></label>
		    	<input type="text" class="w3-input w3-border w3-round w3-left" name="lastname" id="myInput" onkeyup="functionSearch()" style="width:15em;" placeholder="Last name" required>

		    	<button class="w3-button w3-round-large w3-blue w3-hover-light-blue w3-left w3-margin-right" id="searchButton"><i class="fa fa-search"></i></button>
		    </form>

	    	<button class="w3-button w3-round-large w3-blue w3-hover-light-blue w3-left w3-hide-small" onclick="document.getElementById('addGuro').style.display='block'"><i class="fa fa-user-plus"></i> Teacher
	    	</button>

	    	<!-- FOR SMALL SCREENS -->
	    	<button class="w3-button w3-round-large w3-blue w3-hover-light-blue w3-left w3-hide-medium w3-hide-large" onclick="document.getElementById('addGuro').style.display='block'"><i class="fa fa-user-plus"></i>
	    	</button>
	    	<!-- FOR SMALL SCREENS | END -->

	    	<div class="w3-container">
	    	<!-- Flashdata for Added teacher or not -->
			    <?php if($this->session->flashdata('added')){;?>
			    <p class="w3-panel w3-pale-green w3-center">
			        <?php echo $this->session->flashdata('added'); header("Refresh:1;url=teachers");?>
			    </p>
				<?php };?>
				<?php if($this->session->flashdata('error')){;?>
			    <p class="w3-panel w3-pale-red w3-center">
			        <?php echo $this->session->flashdata('error'); header("Refresh:1;url=teachers");?>
			    </p>
				<?php };?>
			<!-- END Flashdata -->
			</div>
	    </div>

	    <!-- ADD A TEACHER MODAL -->
	    <div id="addGuro" class="w3-modal">
		    <div class="w3-modal-content w3-card-4 w3-animate-top">
		      	<header class="w3-container w3-blue"> 
			        <span onclick="document.getElementById('addGuro').style.display='none'" class="w3-button w3-display-topright w3-blue w3-hover-light-blue">&times;</span>
			        <h3>ADD TEACHER</h3>
		      	</header>
		      	<div class="w3-container">
		      		<br/>
			        <form action="<?php echo base_url(); ?>admin/addTeacher" method="post">
			        	<div class="w3-row-padding" style="width:100%;">
				        	<div class="w3-third w3-margin-bottom">
					        	<label>Last Name: </label>
					        	<input type="text" class="w3-input w3-border w3-round" name="lname" required pattern="\S+"> <!--one or more char that is not whitespace-->
					        </div>
					        <div class="w3-third w3-margin-bottom">
					        	<label>First Name: </label>
					        	<input type="text" class="w3-input w3-border w3-round" name="fname" required>
				        	</div>
				        	<div class="w3-third w3-margin-bottom">
					        	<label>Middle Name: </label>
					        	<input type="text" class="w3-input w3-border w3-round" name="mname" required pattern="\S+">
				        	</div>
			        	</div>
			        	<div class="w3-row-padding" style="width:100%;">
				        	<div class="w3-third w3-margin-bottom" required>
					        	<label>Rank:</label>
					        	<input type="text" name="rank" class="w3-input w3-border w3-round" required>
				        	</div>
				        	<div class="w3-third w3-margin-bottom">
				        		<label>Email:</label>
					        	<input type="email" name="email" class="w3-input w3-border w3-round" required>
					        	<small><b>Note:</b> Email cannot be duplicated.</small>
				        	</div>
				        	<div class="w3-third w3-margin-bottom">
				        		<label>Employee number:</label>
					        	<input type="text" name="idnumber" class="w3-input w3-border w3-round" minlength="7" maxlength="7" required>
				        	</div>
			        	</div>

			        	<div class="w3-row-padding" style="width:100%;">
				        	<div class="w3-third w3-margin-bottom">
				        		<label>Major: </label>
				        		<input type="text" class="w3-input w3-border w3-round" name="major" required>
				        	</div>
				        	<div class="w3-third w3-margin-bottom">
				        		<label>Department: </label>
				        		<select name="dept" class="w3-input w3-border w3-round">
				        			<option selected disabled>Choose...</option>
				        			<option value="Junior High School Teacher">JHS Teacher</option>
				        			<option value="Senior High School Teacher">SHS Teacher</option>
				        		</select>
				        	</div>
				        	<div class="w3-third w3-margin-bottom">
				        		<label>Sex: </label><br>
				        		<div class="w3-left">
					        		<input type="radio" class="w3-radio" name="sex" value="Male" required> Male
					        		<input type="radio" class="w3-radio w3-margin-left" name="sex" value="Female"> Female
				        		</div>
				        	</div>
			        	</div>

			        	<div class="w3-container w3-margin-top w3-margin-bottom w3-right">
				        	<input type="submit" class="w3-button w3-blue w3-hover-light-blue w3-round-large" value="Add">
				        	<input type="reset" class="w3-button w3-red w3-hover-pale-red w3-round-large" value="Clear">
			        	</div>
			        </form>
			       	
		      	</div>
		      	<footer class="w3-container w3-blue">
		        	<br/>
		      	</footer>
		    </div>
  		</div>
  		<!--END MODAL-->




  		<!---------------------------------------------------------------------------------------------------------------->
  		<!---------------------------------------------------------------------------------------------------------------->
  		<!---------------------------------------------------------------------------------------------------------------->
  		<?php 
  			if(!empty($this->session->flashdata('Teachers'))){
  				$res = $this->session->flashdata('Teachers');
  				$count = count($res);

  				echo '<div class="w3-container w3-card w3-margin-top w3-round w3-padding" style="overflow-x:auto;">
	  					
	  					'.'Result/s: <b>('.$count.')</b>
	  					<table class="w3-table-all w3-small w3-margin-bottom">
	  						<thead>
	  						<tr class="w3-light-grey">
	  							<th>Employee number</th>
	  							<th>Last Name</th>
	  							<th>First Name</th>
	  							<th>Middel Name</th>
	  							<th>Email</th>
	  							<th>Department</th>
	  							<th>Major</th>
	  							<th>Rank</th>
	  							<th>Load</th>
	  							<th>Adviser</th>
	  							<th>Action</th>
	  						</tr></thead>';

	  			$q_t = 1;
	  			foreach ($res as $resinfo){
	  				$query = $this->db->query("SELECT * FROM sections WHERE adviser = '".$resinfo['id']."'");
		  			if($query->num_rows() == 1){
		  				foreach ($query->result_array() as $got) {
		  					$adviser = $got['gr_level'].' - '.$got['sect_name'];
		  				}
		  			}else{
		  				$adviser = '';
		  			}
	  				
  					echo '<tr>';
			    	echo '<td>'.$resinfo['id'].'</td>';
			    	echo '<td>'.$resinfo['lname'].'</td>';
			    	echo '<td>'.$resinfo['fname'].'</td>';
			    	echo '<td>'.$resinfo['mname'].'</td>';
			    	echo '<td>'.$resinfo['email'].'</td>';
			    	echo '<td>'.$resinfo['Department'].'</td>';
			    	echo '<td>'.$resinfo['major'].'</td>';
			    	echo '<td>'.$resinfo['Rank'].'</td>';
			    	echo '<td>'.$resinfo['teach_load'].'</td>';
			    	echo '<td>'.$adviser.'</td>';
			    	echo '<td><a href="'.base_url().'admin/viewteacher/'.$resinfo['id'].'" class="w3-small w3-text-blue">View</a> | 
			    			<a href="javascript:void(0)" onclick="document.getElementById(\'editMe'.$q_t.'\').style.display=\'block\'" class="w3-small w3-text-blue">Edit</a> |  
			    			<a href="'.base_url().'admin/deleteTeacher/'.$resinfo['id'].'" class="w3-small w3-text-blue" onclick="javascript: return confirm(\'Delete Teacher ['.$resinfo['id'].'] ?\')">Delete</a></td>';
			    	echo '</tr>';


			    ###########################################################################################################
			    ###########################################################################################################
			    //EDIT MODAL | START
			    echo '<div id="editMe'.$q_t.'" class="w3-modal">
							<div class="w3-modal-content w3-animate-top">
								<header class="w3-container w3-blue"> 
			        				<span onclick="document.getElementById(\'editMe'.$q_t.'\').style.display=\'none\'" class="w3-button w3-display-topright w3-blue w3-hover-light-blue">&times;</span>
			        					<h3>EDIT TEACHER\'S INFO</h3>
		      					</header>
		      					<div class="w3-container w3-padding">
		      						<br/>
			        				<form action="'; echo base_url(); echo 'admin/UpdateTeacherInfo/'.$resinfo['id'].'" method="post">
			        				<div class="w3-row-padding" style="width:100%;">
							        	<div class="w3-third w3-margin-bottom">
								        	<label>Last Name: </label>
								        	<input type="text" class="w3-input w3-border w3-round" value="'.$resinfo['lname'].'" name="lname" required pattern="\S+"> <!--one or more char that is not whitespace-->
								        </div>
								        <div class="w3-third w3-margin-bottom">
								        	<label>First Name: </label>
								        	<input type="text" class="w3-input w3-border w3-round" value="'.$resinfo['fname'].'" name="fname" required>
							        	</div>
							        	<div class="w3-third w3-margin-bottom">
								        	<label>Middle Name: </label>
								        	<input type="text" class="w3-input w3-border w3-round" value="'.$resinfo['mname'].'" name="mname" required pattern="\S+">
							        	</div>
						        	</div>
						        	<div class="w3-row-padding" style="width:100%;">
							        	<div class="w3-third w3-margin-bottom">
								        	<label>Rank:</label>
								        	<input type="text" value="'.$resinfo['Rank'].'" name="rank" class="w3-input w3-border w3-round" required>
							        	</div>
							        	<div class="w3-third w3-margin-bottom">
							        		<label>Email:</label>
								        	<input type="email" name="email" value="'.$resinfo['email'].'" class="w3-input w3-border w3-round" required>
							        	</div>
							        	<div class="w3-third w3-margin-bottom">
							        		<label>Employee number:</label>
								        	<input type="text" value="'.$resinfo['id'].'" class="w3-input w3-border w3-round" maxlength="7" disabled>
								        	<input type="hidden" value="'.$resinfo['id'].'" name="idnumber">
							        	</div>
						        	</div>

						        	<div class="w3-row-padding" style="width:100%;">
							        	<div class="w3-third w3-margin-bottom">
							        		<label>Major: </label>
							        		<input type="text" value="'.$resinfo['major'].'" class="w3-input w3-border w3-round" name="major" required>
							        	</div>
							        	<div class="w3-third w3-margin-bottom">
							        		<label>Department: </label>';

							        		if($resinfo['Department']=="Junior High School Teacher"){
							        			$selectedJHS = "selected";
							        			$selectedSHS = "";
							        		}else{
							        			$selectedJHS = "";
							        			$selectedSHS = "selected";
							        		}

							        	echo	'<select name="dept" class="w3-input w3-border w3-round" required>
							        			<option value="Junior High School Teacher" '.$selectedJHS.'>JHS Teacher</option>
							        			<option value="Senior High School Teacher" '.$selectedSHS.'>SHS Teacher</option>
							        		</select>
							        	</div>
							        	<div class="w3-third w3-margin-bottom">
							        		<label>Sex: </label><br>
							        		<div class="w3-left">';
							        		if($resinfo['sex']=="Male"){
							        			$checkM = "checked";
							        			$checkF = "";
							        		}else{
							        			$checkF = "checked";
							        			$checkM = "";
							        		}
								        	echo	'<input type="radio" class="w3-radio" name="sex" value="Male" '.$checkM.' required> Male
								        		<input type="radio" class="w3-radio w3-margin-left" name="sex" value="Female" '.$checkF.'> Female
							        		</div>
							        	</div>
						        	</div>

						        	<div class="w3-container w3-margin-top w3-right">
							        	<input type="submit" class="w3-button w3-blue w3-hover-light-blue w3-round-large" value="Update">
							        	<input type="button" onclick="document.getElementById(\'editMe'.$q_t.'\').style.display=\'none\'" class="w3-button w3-red w3-hover-pale-red w3-round-large" value="Cancel">
						        	</div>
						        </form>
						       	
					      	</div>
					      	<footer class="w3-container w3-blue">
					        	<br/>
					      	</footer>';
			    echo '</div>';
			    //EDIT MODAL | END

			    $q_t++;    				
  				}
				echo '</table></div>';
  			}else{
  				if(!empty($this->session->flashdata('none'))){
			    	echo '<div class="w3-container w3-card w3-padding-large w3-round w3-margin-top">
				  			<div class="w3-container w3-pale-red">
				  				<center><b>'.$this->session->flashdata('none').'</b></center>
				  			</div>
				  		</div>';
				  		header('Refresh:1;url=teachers');
			    }
  			}
  			
  		?>
  		<!---------------------------------------------------------------------------------------------------------------->
  		<!---------------------------------------------------------------------------------------------------------------->
  		<!---------------------------------------------------------------------------------------------------------------->




  		<div class="w3-container w3-card w3-padding w3-round w3-margin-top">
	    	<div class="w3-container">
	    		<span>
					<h6><b>LIST OF TEACHERS</b>
						<?php
	  						echo '<span class="w3-right w3-margin-bottom">'.$this->pagination->create_links().'</span>';
	  						echo '<br/>';
  						?>
					</h6>
				</span>
	    	</div>
	  		<?php
	  		//LIST OF TEACHERS
	  		###################################################################################################################
	  		###################################################################################################################
	  		echo "<div style='overflow-x:auto;'>";
		    echo '<table class="w3-table-all w3-small" id="listOfStud">';
		    echo '<thead><tr class="w3-light-grey"><th>Employee number</th><th>Last name</th><th>First name</th><th>Middle name</th><th>Email</th><th>Department</th><th>Major</th><th>Rank</th><th>Load</th><th>Adviser</th><th>Action</th></tr></thead>';


	  		$i = 1;
	  		foreach ($teachersRecord->result_array() as $t_info) {
	  			$query = $this->db->query("SELECT * FROM sections WHERE adviser = '".$t_info['id']."'");
	  			if($query->num_rows() == 1){
	  				foreach ($query->result_array() as $got) {
	  					$adviser = $got['gr_level'].' - '.$got['sect_name'];
	  				}
	  			}else{
	  				$adviser = '';
	  			}

	  			echo '<tr>';
			    	echo '<td>'.$t_info['id'].'</td>';
			    	echo '<td>'.$t_info['lname'].'</td>';
			    	echo '<td>'.$t_info['fname'].'</td>';
			    	echo '<td>'.$t_info['mname'].'</td>';
			    	echo '<td>'.$t_info['email'].'</td>';
			    	echo '<td>'.$t_info['Department'].'</td>';
			    	echo '<td>'.$t_info['major'].'</td>';
			    	echo '<td>'.$t_info['Rank'].'</td>';
			    	echo '<td>'.$t_info['teach_load'].'</td>';
			    	echo '<td>'.$adviser.'</td>';
			    	echo '<td><a href="'.base_url().'admin/viewteacher/'.$t_info['id'].'" class="w3-small w3-text-blue">View</a> | 
			    			<a href="javascript:void(0)" onclick="document.getElementById(\'editMe'.$i.'\').style.display=\'block\'" class="w3-small w3-text-blue">Edit</a> |  
			    			<a href="'.base_url().'admin/deleteTeacher/'.$t_info['id'].'" class="w3-small w3-text-blue" onclick="javascript: return confirm(\'Delete Teacher ['.$t_info['id'].'] ?\')">Delete</a></td>';
			    	echo '</tr>';


			    ###########################################################################################################
			    ###########################################################################################################
			    //EDIT MODAL | START
			    echo '<div id="editMe'.$i.'" class="w3-modal">
							<div class="w3-modal-content w3-animate-top">
								<header class="w3-container w3-blue"> 
			        				<span onclick="document.getElementById(\'editMe'.$i.'\').style.display=\'none\'" class="w3-button w3-display-topright w3-blue w3-hover-light-blue">&times;</span>
			        					<h3>EDIT TEACHERS\' INFO</h3>
		      					</header>
		      					<div class="w3-container w3-padding">
		      						<br/>
			        				<form action="'; echo base_url(); echo 'admin/UpdateTeacherInfo/'.$t_info['id'].'" method="post">
			        				<div class="w3-row-padding" style="width:100%;">
							        	<div class="w3-third w3-margin-bottom">
								        	<label>Last Name: </label>
								        	<input type="text" class="w3-input w3-border w3-round" value="'.$t_info['lname'].'" name="lname" required pattern="\S+"> <!--one or more char that is not whitespace-->
								        </div>
								        <div class="w3-third w3-margin-bottom">
								        	<label>First Name: </label>
								        	<input type="text" class="w3-input w3-border w3-round" value="'.$t_info['fname'].'" name="fname" required>
							        	</div>
							        	<div class="w3-third w3-margin-bottom">
								        	<label>Middle Name: </label>
								        	<input type="text" class="w3-input w3-border w3-round" value="'.$t_info['mname'].'" name="mname" required pattern="\S+">
							        	</div>
						        	</div>
						        	<div class="w3-row-padding" style="width:100%;">
							        	<div class="w3-third w3-margin-bottom">
								        	<label>Rank:</label>
								        	<input type="text" value="'.$t_info['Rank'].'" name="rank" class="w3-input w3-border w3-round" required>
							        	</div>
							        	<div class="w3-third w3-margin-bottom">
							        		<label>Email:</label>
								        	<input type="email" name="email" value="'.$t_info['email'].'" class="w3-input w3-border w3-round" required>
							        	</div>
							        	<div class="w3-third w3-margin-bottom">
							        		<label>Employee number:</label>
								        	<input type="text" value="'.$t_info['id'].'" class="w3-input w3-border w3-round" maxlength="7" disabled>
								        	<input type="hidden" value="'.$t_info['id'].'" name="idnumber">
							        	</div>
						        	</div>

						        	<div class="w3-row-padding" style="width:100%;">
							        	<div class="w3-third w3-margin-bottom">
							        		<label>Major: </label>
							        		<input type="text" value="'.$t_info['major'].'" class="w3-input w3-border w3-round" name="major" required>
							        	</div>
							        	<div class="w3-third w3-margin-bottom">
							        		<label>Department: </label>';

							        		if($t_info['Department']=="Junior High School Teacher"){
							        			$selectedJHS = "selected";
							        			$selectedSHS = "";
							        		}else{
							        			$selectedJHS = "";
							        			$selectedSHS = "selected";
							        		}

							        	echo	'<select name="dept" class="w3-input w3-border w3-round" required>
							        			<option value="Junior High School Teacher" '.$selectedJHS.'>JHS Teacher</option>
							        			<option value="Senior High School Teacher" '.$selectedSHS.'>SHS Teacher</option>
							        		</select>
							        	</div>
							        	<div class="w3-third w3-margin-bottom">
							        		<label>Sex: </label><br>
							        		<div class="w3-left">';
							        		if($t_info['sex']=="Male"){
							        			$checkM = "checked";
							        			$checkF = "";
							        		}else{
							        			$checkF = "checked";
							        			$checkM = "";
							        		}
								        	echo	'<input type="radio" class="w3-radio" name="sex" value="Male" '.$checkM.' required> Male
								        		<input type="radio" class="w3-radio w3-margin-left" name="sex" value="Female" '.$checkF.'> Female
							        		</div>
							        	</div>
						        	</div>

						        	<div class="w3-container w3-margin-top w3-right">
							        	<input type="submit" class="w3-button w3-blue w3-hover-light-blue w3-round-large" value="Update">
							        	<input type="button" onclick="document.getElementById(\'editMe'.$i.'\').style.display=\'none\'" class="w3-button w3-red w3-hover-pale-red w3-round-large" value="Cancel">
						        	</div>
						        </form>
						       	
					      	</div>
					      	<footer class="w3-container w3-blue">
					        	<br/>
					      	</footer>';
			    echo '</div>';
			    //EDIT MODAL | END

			    $i++;    				
	  		}

	  		###################################################################################################################
	  		###################################################################################################################
	  		##LIST OF TEACHERS | END

	  		echo '</table></div>';
	  		?>

	  	</div>
	</div>
	<!-- END MAIN CONTENT -->

<script>
function functionSearch() {
  var input, filter, table, tr, td, i, j;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("listOfStud");
  tr = table.getElementsByTagName("tr");
  
  //negative 1 if no match
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}


function role(){
	var x = document.getElementById('teach_role').value;
	var y = document.getElementById('gradelevel').value;
	
	switch(x){
		case 'Adviser':
			document.getElementById('gradelevel').disabled = false;
			document.getElementById('s7').disabled = false;
			document.getElementById('subjects').disabled = true;
			
			switch(y){
				case 'Grade 7':
				document.getElementById('s7').style.display = 'block';
				document.getElementById('s8').style.display = 'none';
				document.getElementById('s9').style.display = 'none';
				document.getElementById('s10').style.display = 'none';
				document.getElementById('s11').style.display = 'none';
				document.getElementById('s12').style.display = 'none';
				break;

				case 'Grade 8':
				document.getElementById('s7').style.display = 'none';
				document.getElementById('s8').style.display = 'block';
				document.getElementById('s9').style.display = 'none';
				document.getElementById('s10').style.display = 'none';
				document.getElementById('s11').style.display = 'none';
				document.getElementById('s12').style.display = 'none';
				break;

				case 'Grade 9':
				document.getElementById('s7').style.display = 'none';
				document.getElementById('s8').style.display = 'none';
				document.getElementById('s9').style.display = 'block';
				document.getElementById('s10').style.display = 'none';
				document.getElementById('s11').style.display = 'none';
				document.getElementById('s12').style.display = 'none';
				break;

				case 'Grade 10':
				document.getElementById('s7').style.display = 'none';
				document.getElementById('s8').style.display = 'none';
				document.getElementById('s9').style.display = 'none';
				document.getElementById('s10').style.display = 'block';
				document.getElementById('s11').style.display = 'none';
				document.getElementById('s12').style.display = 'none';
				break;

				case 'Grade 11':
				document.getElementById('s7').style.display = 'none';
				document.getElementById('s8').style.display = 'none';
				document.getElementById('s9').style.display = 'none';
				document.getElementById('s10').style.display = 'none';
				document.getElementById('s11').style.display = 'block';
				document.getElementById('s12').style.display = 'none';
				break;

				case 'Grade 12':
				document.getElementById('s7').style.display = 'none';
				document.getElementById('s8').style.display = 'none';
				document.getElementById('s9').style.display = 'none';
				document.getElementById('s10').style.display = 'none';
				document.getElementById('s11').style.display = 'none';
				document.getElementById('s12').style.display = 'block';
				break;
			}
		break;

		case 'Subject Teacher':
			document.getElementById('gradelevel').disabled = false;
			document.getElementById('s7').disabled = false;
			document.getElementById('subjects').disabled = false;
			
				document.getElementById('s7').style.display = 'none';	
				document.getElementById('s8').style.display = 'none';
				document.getElementById('s9').style.display = 'none';
				document.getElementById('s10').style.display = 'none';
				document.getElementById('s11').style.display = 'none';
				document.getElementById('s12').style.display = 'none';
		break;
	}
}


function assign_role(){
	var x = document.getElementById('gradelevel').value;

	switch(x){
		case 'Grade 7':
		document.getElementById('s7').style.display = 'block';
		document.getElementById('s8').style.display = 'none';
		document.getElementById('s9').style.display = 'none';
		document.getElementById('s10').style.display = 'none';
		document.getElementById('s11').style.display = 'none';
		document.getElementById('s12').style.display = 'none';
		break;

		case 'Grade 8':
		document.getElementById('s7').style.display = 'none';
		document.getElementById('s8').style.display = 'block';
		document.getElementById('s9').style.display = 'none';
		document.getElementById('s10').style.display = 'none';
		document.getElementById('s11').style.display = 'none';
		document.getElementById('s12').style.display = 'none';
		break;

		case 'Grade 9':
		document.getElementById('s7').style.display = 'none';
		document.getElementById('s8').style.display = 'none';
		document.getElementById('s9').style.display = 'block';
		document.getElementById('s10').style.display = 'none';
		document.getElementById('s11').style.display = 'none';
		document.getElementById('s12').style.display = 'none';
		break;

		case 'Grade 10':
		document.getElementById('s7').style.display = 'none';
		document.getElementById('s8').style.display = 'none';
		document.getElementById('s9').style.display = 'none';
		document.getElementById('s10').style.display = 'block';
		document.getElementById('s11').style.display = 'none';
		document.getElementById('s12').style.display = 'none';
		break;

		case 'Grade 11':
		document.getElementById('s7').style.display = 'none';
		document.getElementById('s8').style.display = 'none';
		document.getElementById('s9').style.display = 'none';
		document.getElementById('s10').style.display = 'none';
		document.getElementById('s11').style.display = 'block';
		document.getElementById('s12').style.display = 'none';
		break;

		case 'Grade 12':
		document.getElementById('s7').style.display = 'none';
		document.getElementById('s8').style.display = 'none';
		document.getElementById('s9').style.display = 'none';
		document.getElementById('s10').style.display = 'none';
		document.getElementById('s11').style.display = 'none';
		document.getElementById('s12').style.display = 'block';
		break;
	}
}



	function dropdownsmall() {
        var x = document.getElementById("AdminItemsSmall");
        if (x.className.indexOf("w3-show") == -1) {
            x.className += " w3-show";
        } else { 
            x.className = x.className.replace(" w3-show", "");
        }
    }

	function dropdownlarge() {
        var x = document.getElementById("AdminNotifLargeItems");
        if (x.className.indexOf("w3-show") == -1) {
            x.className += " w3-show";
        } else { 
            x.className = x.className.replace(" w3-show", "");
        }
    }

	//Note:
    /*4: request finished and response is ready
    200: "OK"*/

    //ADMIN
    function LoadAll() {
    	setInterval(function(){
            
            //NOTIFICATIONS
            var notificationcounter = new XMLHttpRequest();
            notificationcounter.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("AdminNotifSmall").innerHTML = this.responseText;
                    document.getElementById("AdminNotifLarge").innerHTML = this.responseText;
                }
            };

            notificationcounter.open("GET", "https://"+window.location.hostname+"/BanquerohanNationalHighSchool/Admin/notifcounter", true);
            notificationcounter.send();

            var notificationitems = new XMLHttpRequest();
            notificationitems.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("AdminItemsSmall").innerHTML = this.responseText;
                    document.getElementById("AdminNotifLargeItems").innerHTML = this.responseText;
                }
            };

            notificationitems.open("POST", "https://"+window.location.hostname+"/BanquerohanNationalHighSchool/Admin/notifitems/teachers", true);
            notificationitems.send();
            //NOTIFICATIONS | END


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
</div>
</body>