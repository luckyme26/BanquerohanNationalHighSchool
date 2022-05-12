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


	    <a href="<?php echo base_url();?>admin/teachers" onclick="w3_close()" class="w3-bar-item w3-button w3-text-white w3-hover-text-blue w3-hover-white w3-padding-16" style="border-radius: 30px 0px 0px 30px;">
	      	<span class="fa fa-users w3-margin-left"></span>&nbsp;&nbsp;Teachers
	    </a> 


	    <a href="<?php echo base_url();?>admin/enrolledstudents" onclick="w3_close()" class="w3-bar-item w3-button w3-white w3-text-blue w3-hover-text-blue w3-hover-white w3-padding-16" style="border-radius: 30px 0px 0px 30px;">
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
	    	<a href="javascript:void(0)" onclick="document.getElementById('Confirmation').style.display = 'block'" class="w3-bar-item w3-button w3-margin-left w3-hover-text-blue w3-hover-white w3-small" style="border-radius: 30px 0px 0px 30px;">
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
	    		<a href="javascript:void(0)" class="fa fa-bars w3-button w3-blue w3-xlarge w3-left w3-hover-light-blue w3-round" onclick="w3_open()"></a>ENROLLED STUDENTS
	    	</h3>
	  	</span>
	</header>

	<!-- Overlay effect when opening sidebar on small screens -->
	<div class="w3-overlay w3-hide-large" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

	<br class="w3-hide-large"><br class="w3-hide-large"><br class="w3-hide-large"><br class="w3-hide-large">
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
	    	<h3 class="w3-left w3-padding"><b>ENROLLED STUDENTS</b></h3>

	    	<div class="w3-dropdown-click w3-right w3-margin-top">
                <button class="w3-button w3-hover-white w3-white fa fa-bell w3-large w3-padding-large" onclick="dropdownlarge()"><span class="w3-badge w3-circle w3-red" id="AdminNotifLarge"></span></button>

                <div id="AdminNotifLargeItems" class="w3-dropdown-content w3-bar-block w3-border" style="right: 0; width: 30em; height:35em; overflow: scroll"></div>
            </div>
		</span>
  	</div>

  	<!-- MAIN CONTENT -->
  	<div class="w3-container">
	    
  		
	    <div class="w3-container w3-card w3-padding-large w3-round w3-margin-top">
	    	<form action="<?php echo base_url();?>admin/searchStud" method="post">	
		    	<label class="w3-left w3-hide-small w3-margin-right"><b>Search:</b></label>
		    	<input type="text" class="w3-input w3-border w3-round w3-left" name="lastname" id="myInput" onkeyup="functionSearch()" style="width:15em;" placeholder="Last name" required>

		    	<button class="w3-button w3-round-large w3-blue w3-hover-light-blue w3-left w3-margin-right" id="searchButton"><i class="fa fa-search"></i></button>
		    </form>

	    	<button class="w3-button w3-round-large w3-blue w3-hover-light-blue w3-left w3-hide-small" onclick="document.getElementById('addStudent').style.display='block'"><i class="fa fa-user-plus"></i> Enroll a student
	    	</button>
	    	<!-- FOR SMALL SCREENS -->
	    	<button class="w3-button w3-round-large w3-blue w3-hover-light-blue w3-left w3-hide-medium w3-hide-large" onclick="document.getElementById('addStudent').style.display='block'"><i class="fa fa-user-plus"></i>
	    	</button>
	    	<div class="w3-container">
	    	<!-- Flashdata -->
			    <?php if($this->session->flashdata('added')){;?>
			    <p class="w3-panel w3-pale-green w3-center">
			        <?php echo $this->session->flashdata('added'); header("Refresh:1;url=enrolledstudents");?>
			    </p>
				<?php };?>
				<?php if($this->session->flashdata('error')){;?>
			    <p class="w3-panel w3-pale-red w3-center">
			        <?php echo $this->session->flashdata('error'); header("Refresh:1;url=enrolledstudents");?>
			    </p>
				<?php }; ?>
			<!-- END Flashdata -->
			</div>
	    </div>


	    <!-- ENROLL A STUDENT MODAL -->
	    <div id="addStudent" class="w3-modal">
		    <div class="w3-modal-content w3-card-4 w3-animate-top">
		      	<header class="w3-container w3-blue"> 
			        <span onclick="document.getElementById('addStudent').style.display='none'" class="w3-button w3-display-topright w3-blue w3-hover-light-blue">&times;</span>
			        <h3>ENROLL A STUDENT</h3>
		      	</header>
		      	<div class="w3-container w3-padding">
		      		<br/>
			        <form action="<?php echo base_url(); ?>admin/addstud" method="post">
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
					        	<input type="text" class="w3-input w3-border w3-round" name="mname" required>
				        	</div>
			        	</div>	
			        	<div class="w3-row-padding" style="width:100%;">
				        	<div class="w3-third w3-margin-bottom">
					        	<label>Birthdate:</label>
					        	<input type="date" name="bday" class="w3-input w3-border w3-round">
				        	</div>
				        	<div class="w3-third w3-margin-bottom">
				        		<label>Email:</label>
					        	<input type="email" name="email" class="w3-input w3-border w3-round" required>
					        	<small><b>Note:</b> Email cannot be duplicated.</small>
				        	</div>
				        	<div class="w3-third w3-margin-bottom">
				        		<label>LRN:</label>
					        	<input type="text" name="lrn" class="w3-input w3-border w3-round" pattern="^(?=.*?[0-9]).{12,}$" maxlength="12" required>
				        	</div>
			        	</div>
			        	<div class="w3-row-padding" style="width:100%;">
				        	<div class="w3-twothird w3-margin-bottom">
				        		<label>Address: </label>
				        		<input type="text" class="w3-input w3-border w3-round" name="address">
				        	</div>
				        	<div class="w3-third w3-margin-bottom">
				        		<label>Sex: </label><br>
				        		<div class="w3-left">
					        		<input type="radio" class="w3-radio" name="sex" value="Male" required> Male
					        		<input type="radio" class="w3-radio w3-margin-left" name="sex" value="Female"> Female
				        		</div>
				        	</div>
			        	</div>
			        	<div class="w3-row-padding" style="width:100%;">
			        		<div class="w3-third w3-margin-bottom">
			        			<label>Grade level:</label>
			        			<select id="GradeLevel" class="w3-input w3-border w3-round" name="grlevel" onchange="ShowSectorBlock()" required>
			        				<option disabled selected value="">Choose...</option>
			        				<option value="Grade 7">Grade 7</option>
			        				<option value="Grade 8">Grade 8</option>
			        				<option value="Grade 9">Grade 9</option>
			        				<option value="Grade 10">Grade 10</option>
			        				<option value="Grade 11">Grade 11</option>
			        				<option value="Grade 12">Grade 12</option>
			        			</select>
			        		</div>

			        		<div class="w3-third w3-margin-bottom">
			        			<label>Track - Strand:</label>
			        			<select id="section11" class="w3-input w3-border w3-round" name="track11" disabled required>
			        				<?php
			        					$this->users_model->getSectionName11();
			        				?>
			        			</select>
			        			<select id="section12" class="w3-input w3-border w3-round" style="display: none;" name="track12" disabled required>
			        				<?php
			        					$this->users_model->getSectionName12();
			        				?>
			        			</select>
			        		</div>

			        		<div class="w3-third w3-margin-bottom">
			        			<label>Section/Block:</label>
			        			<select class="w3-input w3-border w3-round" id="Empty">
			        				<option>Choose...</option>
			        			</select>

			        			<select id="section7" name="seven" class="w3-input w3-border w3-round" style="display: none;" required>
			        				<?php
			        					$this->users_model->getSectionName7();
			        				?>
			        			</select>
			        			<select id="section8" name="eight" class="w3-input w3-border w3-round" style="display: none;" required>
			        				<?php
			        					$this->users_model->getSectionName8();
			        				?>
			        			</select>
			        			<select id="section9" name="nine" class="w3-input w3-border w3-round" style="display: none;" required>
			        				<?php
			        					$this->users_model->getSectionName9();
			        				?>
			        			</select>
			        			<select id="section10" name="ten" class="w3-input w3-border w3-round" style="display: none;" required>
			        				<?php
			        					$this->users_model->getSectionName10();
			        				?>
			        			</select>
			        		</div>
			        	</div>

			        	<div class="w3-container w3-margin-top w3-right">
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
  		<!-- END | ENROLL A STUDENT MODAL -->



  		<!---------------------------------------------------------------------------------------------------------------->
  		<!---------------------------------------------------------------------------------------------------------------->
  		<!---------------------------------------------------------------------------------------------------------------->
  		<?php
  			//FOR BOTH QUERIED
  			if(!empty($this->session->flashdata('JHS'))&&!empty($this->session->flashdata('SHS'))){
  				$JHS = $this->session->flashdata('JHS');
  				$SHS = $this->session->flashdata('SHS');
  				$count = count($JHS)+count($SHS);


  				echo '<div class="w3-container w3-card w3-padding w3-round w3-margin-top" style="overflow-x:auto;">
	  				<div class="w3-container">
	  					'.'Result/s: <b>('.$count.')</b>
	  					<table class="w3-table-all w3-small">
	  						<thead>
	  						<tr class="w3-light-grey">
	  							<th>LRN</th>
	  							<th>First Name</th>
	  							<th>Middle Name</th>
	  							<th>Last Name</th>
	  							<th>Grade Level</th>
	  							<th>Section</th>
	  							<th>Email</th>
	  							<th>Status</th>
	  							<th>Action</th>
	  						</tr></thead>';


  				//QUERIED JHS STUDENT | BOTH
  				$q_jhs = 1;
  				foreach ($JHS as $jhs){
  					if($jhs['status'] == 'Enrolled'){
	    				$color = "w3-green";
	    				$button = '| <a href="javascript:void(0)" onclick="document.getElementById(\'editMe'.$q_jhs.'\').style.display=\'block\'" class="w3-small w3-text-blue">Edit</a>';
	    			}elseif($jhs['status'] == 'Queued'){
	    				$color = "w3-yellow";
	    				$button = '| <a href="javascript:void(0)" onclick="document.getElementById(\'editMe'.$q_jhs.'\').style.display=\'block\'" class="w3-small w3-text-blue">Edit</a>';
	    			}else{
	    				$color = "w3-red";
	    				$button = '';
	    			}
  					echo '<tr>';
		    			echo '<td>'.$jhs['lrn'].'</td>';
		    			echo '<td>'.$jhs['fname'].'</td>';
		    			echo '<td>'.$jhs['mname'].'</td>';
		    			echo '<td>'.$jhs['lname'].'</td>';
		    			echo '<td>'.$jhs['grade_level'].'</td>';
		    			echo '<td>'.$jhs['section'].'</td>';
		    			echo '<td>'.$jhs['email'].'</td>';
		    			echo '<td><span class="w3-tag w3-round '.$color.'">'.$jhs['status'].'</span></td>';
		    			echo '<td><a href="'.base_url().'admin/viewstudent/'.$jhs['lrn'].'/'.$jhs['grade_level'].'/Enrolled students" class="w3-small w3-text-blue">View</a> '.$button.' | <a href="'.base_url().'admin/deleteStudent/'.$jhs['lrn'].'/'.$jhs['grade_level'].'" class="w3-small w3-text-blue" onclick="javascript: return confirm(\'Delete Student ['.$jhs['lrn'].'] ?\')">Delete</a></td>';
		    		echo '</tr>';


		    		echo '<div id="editMe'.$q_jhs.'" class="w3-modal">
							<div class="w3-modal-content w3-animate-top">
								<header class="w3-container w3-blue"> 
			        				<span onclick="document.getElementById(\'editMe'.$q_jhs.'\').style.display=\'none\'" class="w3-button w3-display-topright w3-blue w3-hover-light-blue">&times;</span>
			        					<h3>EDIT STUDENT DATA</h3>
		      					</header>
		      					<div class="w3-container w3-padding">
		      						<br/>
			        				<form action="'; echo base_url(); echo 'admin/UpdateStudentInfo/'.$jhs['grade_level'].'" method="post">
			        				<div class="w3-row-padding" style="width:100%;">
				        				<div class="w3-third w3-margin-bottom">
					        				<label>Last Name: </label>
					        				<input type="text" class="w3-input w3-border w3-round" value="'.$jhs['lname'].'" name="lname" required pattern="\S+">
					        			</div>
					        			<div class="w3-third w3-margin-bottom">
					        				<label>First Name: </label>
					        				<input type="text" class="w3-input w3-border w3-round" value="'.$jhs['fname'].'" name="fname" required>
				        				</div>
				        				<div class="w3-third w3-margin-bottom">
					        				<label>Middle Name: </label>
					        				<input type="text" class="w3-input w3-border w3-round" value="'.$jhs['mname'].'" name="mname" required pattern="\S+">
				        				</div>
			        				</div>
			        				<div class="w3-row-padding" style="width:100%;">
				        				<div class="w3-third w3-margin-bottom">
					        				<label>Birthdate:</label>
					        				<input type="date" value="'.$jhs['Birthdate'].'" name="bday" class="w3-input w3-border w3-round">
				        				</div>
							        	<div class="w3-third w3-margin-bottom">
							        		<label>Email:</label>
								        	<input type="email" value="'.$jhs['email'].'" name="email" class="w3-input w3-border w3-round">
							        	</div>
							        	<div class="w3-third w3-margin-bottom">
							        		<label>LRN:</label>
								        	<input type="text" value="'.$jhs['lrn'].'" class="w3-input w3-border w3-round" disabled>
								        	<input type="hidden" value="'.$jhs['lrn'].'" name="lrn">
							        	</div>
			        				</div>
						        	<div class="w3-row-padding" style="width:100%;">
							        	<div class="w3-twothird w3-margin-bottom">
							        		<label>Address: </label>
							        		<input type="text" class="w3-input w3-border w3-round" value="'.$jhs['address'].'" name="address">
							        	</div>
							        	<div class="w3-third w3-margin-bottom">
							        		<label>Sex: </label><br>
							        		<div class="w3-left">';
							        		if($jhs['sex']=="Male"){
							        			$checkM = "checked";
							        			$checkF = "";
							        		}else{
							        			$checkF = "checked";
							        			$checkM = "";
							        		}
							        		echo '
								        		<input type="radio" class="w3-radio" name="sex" value="Male" '.$checkM.' required> Male
								        		<input type="radio" class="w3-radio w3-margin-left" name="sex" '.$checkF.' value="Female"> Female
							        		</div>
							        	</div>
						        	</div>';
			        				

						        	if($jhs['section']==''){
						        		echo '<div class="w3-row-padding" style="width:100%;">
								        		<div class="w3-third w3-margin-bottom">
								        			<label>Grade level:</label>
								        			<select class="w3-input w3-border w3-round" name="grlevel" disabled>
								        				<option selected value="'.$jhs['grade_level'].'">'.$jhs['grade_level'].'</option>
								        			</select>
								        		</div>';

								        		echo '<div class="w3-third w3-margin-bottom">
								        				<label>Section/Block:</label>';

								        		switch($jhs['grade_level']){
								        			case 'Grade 7':
								        			echo '<select id="section7" name="seven" class="w3-input w3-border w3-round" required>';
								        					$this->users_model->getSectionName7();
								        			echo '</select>';
								        			break;

								        			case 'Grade 8';
								        			echo '<select id="section8" name="eight" class="w3-input w3-border w3-round" required>';
								        					$this->users_model->getSectionName8();
								        			echo '</select>';
								        			break;

								        			case 'Grade 9';
								        			echo '<select id="section9" name="nine" class="w3-input w3-border w3-round" required>';
								        					$this->users_model->getSectionName9();
								        			echo '</select>';
								        			break;

								        			case 'Grade 10';
								        			echo '<select id="section10" name="ten" class="w3-input w3-border w3-round" required>';
								        					$this->users_model->getSectionName10();
								        			echo '</select>';
								        			break;
								        		}
								        		echo '</div>
								        	</div>';
						        	}else{
						        		echo '<div class="w3-row-padding" style="width:100%;">
								        		<div class="w3-third w3-margin-bottom">
								        			<label>Grade level:</label>
								        			<select class="w3-input w3-border w3-round" name="grlevel" disabled>
								        				<option selected value="'.$jhs['grade_level'].'">'.$jhs['grade_level'].'</option>
								        			</select>
								        		</div>';

								        		echo '<div class="w3-third w3-margin-bottom">
								        				<label>Section/Block:</label>';

								        		switch($jhs['grade_level']){
								        			case 'Grade 7':
								        			echo '<select id="section7" name="seven" class="w3-input w3-border w3-round" required>';
								        					echo '<option selected>'.$jhs['section'].'</option>';
								        			echo '</select>';
								        			break;

								        			case 'Grade 8';
								        			echo '<select id="section8" name="eight" class="w3-input w3-border w3-round" required>';
								        					echo '<option selected>'.$jhs['section'].'</option>';
								        			echo '</select>';
								        			break;

								        			case 'Grade 9';
								        			echo '<select id="section9" name="nine" class="w3-input w3-border w3-round" required>';
								        					echo '<option selected>'.$jhs['section'].'</option>';
								        			echo '</select>';
								        			break;

								        			case 'Grade 10';
								        			echo '<select id="section10" name="ten" class="w3-input w3-border w3-round" required>';
								        					echo '<option selected>'.$jhs['section'].'</option>';
								        			echo '</select>';
								        			break;
								        		}
								        		echo '</div>
								        	</div>';
						        	}



						       echo '<div class="w3-container w3-margin-top w3-margin-bottom w3-right">
							        	<input type="submit" class="w3-button w3-blue w3-hover-light-blue w3-round-large" value="Update">
							        	<input type="button" onclick="document.getElementById(\'editMe'.$q_jhs.'\').style.display=\'none\'" class="w3-button w3-red w3-hover-pale-red w3-round-large" value="Cancel">
						        	</div>
						        </form>
		      					</div>
		      					<footer class="w3-container w3-blue"><br></footer>
							</div>
						</div>';

						$q_jhs++;

		    	}

		    	//QUERIED SHS STUDENTS | BOTH
		    	$q_shs = 0;
		    	$q_shs = $q_jhs+$q_shs;
		    	foreach ($SHS as $shs){
		    		if($shs['status'] == 'Enrolled'){
	    				$color = "w3-green";
	    				$button = '| <a href="javascript:void(0)" onclick="document.getElementById(\'editMe'.$q_shs.'\').style.display=\'block\'" class="w3-small w3-text-blue">Edit</a>';
	    			}elseif($shs['status'] == 'Queued'){
	    				$color = "w3-yellow";
	    				$button = '| <a href="javascript:void(0)" onclick="document.getElementById(\'editMe'.$q_shs.'\').style.display=\'block\'" class="w3-small w3-text-blue">Edit</a>';
	    			}else{
	    				$color = "w3-red";
	    				$button = '';
	    			}
		    		echo '<tr>';
		    			echo '<td>'.$shs['lrn'].'</td>';
		    			echo '<td>'.$shs['fname'].'</td>';
		    			echo '<td>'.$shs['mname'].'</td>';
		    			echo '<td>'.$shs['lname'].'</td>';
		    			echo '<td>'.$shs['grade_level'].'</td>';
		    			echo '<td>'.$shs['section'].'</td>';
		    			echo '<td>'.$shs['email'].'</td>';
		    			echo '<td><span class="w3-tag w3-round '.$color.'">'.$shs['status'].'</span></td>';
		    			echo '<td><a href="'.base_url().'admin/viewstudent/'.$shs['lrn'].'/'.$shs['grade_level'].'/Enrolled students" class="w3-small w3-text-blue">View</a> '.$button.' | <a href="'.base_url().'admin/deleteStudent/'.$shs['lrn'].'/'.$shs['grade_level'].'" class="w3-small w3-text-blue" onclick="javascript: return confirm(\'Delete Student ['.$shs['lrn'].'] ?\')">Delete</a></td>';
		    		echo '</tr>';


		    		echo '<div id="editMe'.$q_shs.'" class="w3-modal">
							<div class="w3-modal-content w3-animate-top">
								<header class="w3-container w3-blue"> 
			        				<span onclick="document.getElementById(\'editMe'.$q_shs.'\').style.display=\'none\'" class="w3-button w3-display-topright w3-blue w3-hover-light-blue">&times;</span>
			        					<h3>EDIT STUDENT DATA</h3>
		      					</header>
		      					<div class="w3-container w3-padding">
		      						<br/>
			        				<form action="'; echo base_url(); echo 'admin/UpdateStudentInfo/'.$shs['grade_level'].'" method="post">
			        				<div class="w3-row-padding" style="width:100%;">
				        				<div class="w3-third w3-margin-bottom">
					        				<label>Last Name: </label>
					        				<input type="text" class="w3-input w3-border w3-round" value="'.$shs['lname'].'" name="lname" required pattern="\S+">
					        			</div>
					        			<div class="w3-third w3-margin-bottom">
					        				<label>First Name: </label>
					        				<input type="text" class="w3-input w3-border w3-round" value="'.$shs['fname'].'" name="fname" required>
				        				</div>
				        				<div class="w3-third w3-margin-bottom">
					        				<label>Middle Name: </label>
					        				<input type="text" class="w3-input w3-border w3-round" value="'.$shs['mname'].'" name="mname" required pattern="\S+">
				        				</div>
			        				</div>
			        				<div class="w3-row-padding" style="width:100%;">
				        				<div class="w3-third w3-margin-bottom">
					        				<label>Birthdate:</label>
					        				<input type="date" value="'.$shs['Birthdate'].'" name="bday" class="w3-input w3-border w3-round">
				        				</div>
							        	<div class="w3-third w3-margin-bottom">
							        		<label>Email:</label>
								        	<input type="email" value="'.$shs['email'].'" name="email" class="w3-input w3-border w3-round">
							        	</div>
							        	<div class="w3-third w3-margin-bottom">
							        		<label>LRN:</label>
								        	<input type="text" value="'.$shs['lrn'].'" class="w3-input w3-border w3-round" disabled>
								        	<input type="hidden" value="'.$shs['lrn'].'" name="lrn">
							        	</div>
			        				</div>
						        	<div class="w3-row-padding" style="width:100%;">
							        	<div class="w3-twothird w3-margin-bottom">
							        		<label>Address: </label>
							        		<input type="text" class="w3-input w3-border w3-round" value="'.$shs['address'].'" name="address">
							        	</div>
							        	<div class="w3-third w3-margin-bottom">
							        		<label>Sex: </label><br>
							        		<div class="w3-left">';
							        		if($shs['sex']=="Male"){
							        			$checkM = "checked";
							        			$checkF = "";
							        		}else{
							        			$checkF = "checked";
							        			$checkM = "";
							        		}
							        		echo '
								        		<input type="radio" class="w3-radio" name="sex" value="Male" '.$checkM.' required> Male
								        		<input type="radio" class="w3-radio w3-margin-left" name="sex" '.$checkF.' value="Female"> Female
							        		</div>
							        	</div>
						        	</div>';
			        				

			        				if($shs['section']==''){
						        		echo '<div class="w3-row-padding" style="width:100%;">
								        		<div class="w3-third w3-margin-bottom">
								        			<label>Grade level:</label>
								        			<select class="w3-input w3-border w3-round" name="grlevel" disabled>
								        				<option selected value="'.$shs['grade_level'].'">'.$shs['grade_level'].'</option>
								        			</select>
								        		</div>';

								        		echo '<div class="w3-third w3-margin-bottom">
								        				<label>Track - Strand:</label>';

								        		switch($shs['grade_level']){
								        			case 'Grade 11':
								        			echo '<select id="section11" name="track11" class="w3-input w3-border w3-round" required>';
								        					$this->users_model->getSectionName11();
								        			echo '</select>';
								        			break;

								        			case 'Grade 12';
								        			echo '<select id="section12" name="track12" class="w3-input w3-border w3-round" required>';
								        					$this->users_model->getSectionName12();
								        			echo '</select>';
								        			break;
								        		}
								        		echo '</div>
								        	</div>';
						        	}else{
						        		echo '<div class="w3-row-padding" style="width:100%;">
								        		<div class="w3-third w3-margin-bottom">
								        			<label>Grade level:</label>
								        			<select class="w3-input w3-border w3-round" name="grlevel" disabled>
								        				<option selected value="'.$shs['grade_level'].'">'.$shs['grade_level'].'</option>
								        			</select>
								        		</div>';

								        		echo '<div class="w3-third w3-margin-bottom">
								        				<label>Track - Strand:</label>';

								        		switch($shs['grade_level']){
								        			case 'Grade 11':
								        			echo '<select id="section11" name="track11" class="w3-input w3-border w3-round" required>';
								        					echo '<option selected value="'.$shs['section'].'">'.$shs['section'].'</option>';
								        			echo '</select>';
								        			break;

								        			case 'Grade 12';
								        			echo '<select id="section12" name="track12" class="w3-input w3-border w3-round" required>';
								        					echo '<option selected value="'.$shs['section'].'">'.$shs['section'].'</option>';
								        			echo '</select>';
								        			break;
								        		}
								        		echo '</div>
								        	</div>';
						        	}




						       echo '<div class="w3-container w3-margin-top w3-margin-bottom w3-right">
							        	<input type="submit" class="w3-button w3-blue w3-hover-light-blue w3-round-large" value="Update">
							        	<input type="button" onclick="document.getElementById(\'editMe'.$q_shs.'\').style.display=\'none\'" class="w3-button w3-red w3-hover-pale-red w3-round-large" value="Cancel">
						        	</div>
						        </form>
		      					</div>
		      					<footer class="w3-container w3-blue"><br></footer>
							</div>
						</div>';

						$q_shs++;
			    	}
	  						

	  			echo '</table></div></div>';

	  			}
	  		//FOR BOTH QUERIED | ENDS HERE
  	



  	
  			//QUERIED SHS STUDENT | STARTS
  			elseif(!empty($this->session->flashdata('SHS'))){
  				$SHS = $this->session->flashdata('SHS');
  				$count = count($SHS);


	  			echo '<div class="w3-container w3-card w3-padding w3-round w3-margin-top" style="overflow-x:auto;">
		  				<div class="w3-container">
		  					'.'Result/s: <b>('.$count.')</b>
		  					<table class="w3-table-all w3-small">
		  						<thead><tr class="w3-light-grey">
		  							<th>LRN</th>
		  							<th>First Name</th>
		  							<th>Middle Name</th>
		  							<th>Last Name</th>
		  							<th>Grade Level</th>
		  							<th>Section</th>
		  							<th>Email</th>
		  							<th>Status</th>
		  							<th>Action</th>
		  						</tr></thead>';


	  			$q_shs = 1;
			    	foreach ($SHS as $shs){
			    		if($shs['status'] == 'Enrolled'){
	    					$color = "w3-green";
	    					$button = '| <a href="javascript:void(0)" onclick="document.getElementById(\'editMe'.$q_shs.'\').style.display=\'block\'" class="w3-small w3-text-blue">Edit</a>';
		    			}elseif($shs['status'] == 'Queued'){
		    				$color = "w3-yellow";
		    				$button = '| <a href="javascript:void(0)" onclick="document.getElementById(\'editMe'.$q_shs.'\').style.display=\'block\'" class="w3-small w3-text-blue">Edit</a>';
		    			}else{
		    				$color = "w3-red";
		    				$button = '';
		    			}
			    		echo '<tr>';
			    			echo '<td>'.$shs['lrn'].'</td>';
			    			echo '<td>'.$shs['fname'].'</td>';
			    			echo '<td>'.$shs['mname'].'</td>';
			    			echo '<td>'.$shs['lname'].'</td>';
			    			echo '<td>'.$shs['grade_level'].'</td>';
			    			echo '<td>'.$shs['section'].'</td>';
			    			echo '<td>'.$shs['email'].'</td>';
			    			echo '<td><span class="w3-tag w3-round '.$color.'">'.$shs['status'].'</span></td>';
			    			echo '<td><a href="'.base_url().'admin/viewstudent/'.$shs['lrn'].'/'.$shs['grade_level'].'/Enrolled students" class="w3-small w3-text-blue">View</a> '.$button.' | <a href="'.base_url().'admin/deleteStudent/'.$shs['lrn'].'/'.$shs['grade_level'].'" class="w3-small w3-text-blue" onclick="javascript: return confirm(\'Delete Student ['.$shs['lrn'].'] ?\')">Delete</a></td>';
			    		echo '</tr>';


			    		echo '<div id="editMe'.$q_shs.'" class="w3-modal">
								<div class="w3-modal-content w3-animate-top">
									<header class="w3-container w3-blue"> 
				        				<span onclick="document.getElementById(\'editMe'.$q_shs.'\').style.display=\'none\'" class="w3-button w3-display-topright w3-blue w3-hover-light-blue">&times;</span>
				        					<h3>EDIT STUDENT DATA</h3>
			      					</header>
			      					<div class="w3-container w3-padding">
			      						<br/>
				        				<form action="'; echo base_url(); echo 'admin/UpdateStudentInfo/'.$shs['grade_level'].'" method="post">
				        				<div class="w3-row-padding" style="width:100%;">
					        				<div class="w3-third w3-margin-bottom">
						        				<label>Last Name: </label>
						        				<input type="text" class="w3-input w3-border w3-round" value="'.$shs['lname'].'" name="lname" required pattern="\S+">
						        			</div>
						        			<div class="w3-third w3-margin-bottom">
						        				<label>First Name: </label>
						        				<input type="text" class="w3-input w3-border w3-round" value="'.$shs['fname'].'" name="fname" required>
					        				</div>
					        				<div class="w3-third w3-margin-bottom">
						        				<label>Middle Name: </label>
						        				<input type="text" class="w3-input w3-border w3-round" value="'.$shs['mname'].'" name="mname" required pattern="\S+">
					        				</div>
				        				</div>
				        				<div class="w3-row-padding" style="width:100%;">
					        				<div class="w3-third w3-margin-bottom">
						        				<label>Birthdate:</label>
						        				<input type="date" value="'.$shs['Birthdate'].'" name="bday" class="w3-input w3-border w3-round">
					        				</div>
								        	<div class="w3-third w3-margin-bottom">
								        		<label>Email:</label>
									        	<input type="email" value="'.$shs['email'].'" name="email" class="w3-input w3-border w3-round">
								        	</div>
								        	<div class="w3-third w3-margin-bottom">
								        		<label>LRN:</label>
									        	<input type="text" value="'.$shs['lrn'].'" class="w3-input w3-border w3-round" disabled>
									        	<input type="hidden" value="'.$shs['lrn'].'" name="lrn">
								        	</div>
				        				</div>
							        	<div class="w3-row-padding" style="width:100%;">
								        	<div class="w3-twothird w3-margin-bottom">
								        		<label>Address: </label>
								        		<input type="text" class="w3-input w3-border w3-round" value="'.$shs['address'].'" name="address">
								        	</div>
								        	<div class="w3-third w3-margin-bottom">
								        		<label>Sex: </label><br>
								        		<div class="w3-left">';
								        		if($shs['sex']=="Male"){
								        			$checkM = "checked";
								        			$checkF = "";
								        		}else{
								        			$checkF = "checked";
								        			$checkM = "";
								        		}
								        		echo '
									        		<input type="radio" class="w3-radio" name="sex" value="Male" '.$checkM.' required> Male
									        		<input type="radio" class="w3-radio w3-margin-left" name="sex" '.$checkF.' value="Female"> Female
								        		</div>
								        	</div>
							        	</div>';
				        			
				        				if($shs['section']==''){
						        		echo '<div class="w3-row-padding" style="width:100%;">
								        		<div class="w3-third w3-margin-bottom">
								        			<label>Grade level:</label>
								        			<select class="w3-input w3-border w3-round" name="grlevel" disabled>
								        				<option selected value="'.$shs['grade_level'].'">'.$shs['grade_level'].'</option>
								        			</select>
								        		</div>';

								        		echo '<div class="w3-third w3-margin-bottom">
								        				<label>Track - Strand:</label>';

								        		switch($shs['grade_level']){
								        			case 'Grade 11':
								        			echo '<select id="section11" name="track11" class="w3-input w3-border w3-round" required>';
								        					$this->users_model->getSectionName11();
								        			echo '</select>';
								        			break;

								        			case 'Grade 12';
								        			echo '<select id="section12" name="track12" class="w3-input w3-border w3-round" required>';
								        					$this->users_model->getSectionName12();
								        			echo '</select>';
								        			break;
								        		}
								        		echo '</div>
								        	</div>';
						        	}else{
						        		echo '<div class="w3-row-padding" style="width:100%;">
								        		<div class="w3-third w3-margin-bottom">
								        			<label>Grade level:</label>
								        			<select class="w3-input w3-border w3-round" name="grlevel" disabled>
								        				<option selected value="'.$shs['grade_level'].'">'.$shs['grade_level'].'</option>
								        			</select>
								        		</div>';

								        		echo '<div class="w3-third w3-margin-bottom">
								        				<label>Track - Strand:</label>';

								        		switch($shs['grade_level']){
								        			case 'Grade 11':
								        			echo '<select id="section11" name="track11" class="w3-input w3-border w3-round" required>';
								        					echo '<option selected value="'.$shs['section'].'">'.$shs['section'].'</option>';
								        			echo '</select>';
								        			break;

								        			case 'Grade 12';
								        			echo '<select id="section12" name="track12" class="w3-input w3-border w3-round" required>';
								        					echo '<option selected value="'.$shs['section'].'">'.$shs['section'].'</option>';
								        			echo '</select>';
								        			break;
								        		}
								        		echo '</div>
								        	</div>';
						        	}



							       echo '<div class="w3-container w3-margin-top w3-margin-bottom w3-right">
								        	<input type="submit" class="w3-button w3-blue w3-hover-light-blue w3-round-large" value="Update">
								        	<input type="button" onclick="document.getElementById(\'editMe'.$q_shs.'\').style.display=\'none\'" class="w3-button w3-red w3-hover-pale-red w3-round-large" value="Cancel">
							        	</div>
							        </form>
			      					</div>
			      					<footer class="w3-container w3-blue"><br></footer>
								</div>
							</div>';

							$q_shs++;
				    	}
				    echo '</table></div></div>';
			    }

  			//QUERIED SHS STUDENT | ENDS HERE
  		



  			//QUERIED JHS STUDENT | STARTS HERE
		    elseif(!empty($this->session->flashdata('JHS'))){
		    	$JHS = $this->session->flashdata('JHS');
  				$count = count($JHS);


  				echo '<div class="w3-container w3-card w3-padding w3-round w3-margin-top" style="overflow-x:auto;">
	  				<div class="w3-container">
	  					'.'Result/s: <b>('.$count.')</b>
	  					<table class="w3-table-all w3-small">
	  						<thead><tr class="w3-light-grey">
	  							<th>LRN</th>
	  							<th>First Name</th>
	  							<th>Middle Name</th>
	  							<th>Last Name</th>
	  							<th>Grade Level</th>
	  							<th>Section</th>
	  							<th>Email</th>
	  							<th>Status</th>
	  							<th>Action</th>
	  						</tr></thead>';


  				//QUERIED JHS STUDENT
  				$q_jhs = 1;
  				foreach ($JHS as $jhs){
  					if($jhs['status'] == 'Enrolled'){
	    				$color = "w3-green";
	    				$button = '| <a href="javascript:void(0)" onclick="document.getElementById(\'editMe'.$q_jhs.'\').style.display=\'block\'" class="w3-small w3-text-blue">Edit</a>';
	    			}elseif($jhs['status'] == 'Queued'){
	    				$color = "w3-yellow";
	    				$button = '| <a href="javascript:void(0)" onclick="document.getElementById(\'editMe'.$q_jhs.'\').style.display=\'block\'" class="w3-small w3-text-blue">Edit</a>';
	    			}else{
	    				$color = "w3-red";
	    				$button = '';
	    			}
  					echo '<tr>';
		    			echo '<td>'.$jhs['lrn'].'</td>';
		    			echo '<td>'.$jhs['fname'].'</td>';
		    			echo '<td>'.$jhs['mname'].'</td>';
		    			echo '<td>'.$jhs['lname'].'</td>';
		    			echo '<td>'.$jhs['grade_level'].'</td>';
		    			echo '<td>'.$jhs['section'].'</td>';
		    			echo '<td>'.$jhs['email'].'</td>';
		    			echo '<td><span class="w3-tag w3-round '.$color.'">'.$jhs['status'].'</span></td>';
		    			echo '<td><a href="'.base_url().'admin/viewstudent/'.$jhs['lrn'].'/'.$jhs['grade_level'].'/Enrolled students" class="w3-small w3-text-blue">View</a> '.$button.' | <a href="'.base_url().'admin/deleteStudent/'.$jhs['lrn'].'/'.$jhs['grade_level'].'" class="w3-small w3-text-blue" onclick="javascript: return confirm(\'Delete Student ['.$jhs['lrn'].'] ?\')">Delete</a></td>';
		    		echo '</tr>';


		    		echo '<div id="editMe'.$q_jhs.'" class="w3-modal">
							<div class="w3-modal-content w3-animate-top">
								<header class="w3-container w3-blue"> 
			        				<span onclick="document.getElementById(\'editMe'.$q_jhs.'\').style.display=\'none\'" class="w3-button w3-display-topright w3-blue w3-hover-light-blue">&times;</span>
			        					<h3>EDIT STUDENT DATA</h3>
		      					</header>
		      					<div class="w3-container w3-padding">
		      						<br/>
			        				<form action="'; echo base_url(); echo 'admin/UpdateStudentInfo/'.$jhs['grade_level'].'" method="post">
			        				<div class="w3-row-padding" style="width:100%;">
				        				<div class="w3-third w3-margin-bottom">
					        				<label>Last Name: </label>
					        				<input type="text" class="w3-input w3-border w3-round" value="'.$jhs['lname'].'" name="lname" required pattern="\S+">
					        			</div>
					        			<div class="w3-third w3-margin-bottom">
					        				<label>First Name: </label>
					        				<input type="text" class="w3-input w3-border w3-round" value="'.$jhs['fname'].'" name="fname" required>
				        				</div>
				        				<div class="w3-third w3-margin-bottom">
					        				<label>Middle Name: </label>
					        				<input type="text" class="w3-input w3-border w3-round" value="'.$jhs['mname'].'" name="mname" required pattern="\S+">
				        				</div>
			        				</div>
			        				<div class="w3-row-padding" style="width:100%;">
				        				<div class="w3-third w3-margin-bottom">
					        				<label>Birthdate:</label>
					        				<input type="date" value="'.$jhs['Birthdate'].'" name="bday" class="w3-input w3-border w3-round">
				        				</div>
							        	<div class="w3-third w3-margin-bottom">
							        		<label>Email:</label>
								        	<input type="email" value="'.$jhs['email'].'" name="email" class="w3-input w3-border w3-round">
							        	</div>
							        	<div class="w3-third w3-margin-bottom">
							        		<label>LRN:</label>
								        	<input type="text" value="'.$jhs['lrn'].'" class="w3-input w3-border w3-round" disabled>
								        	<input type="hidden" value="'.$jhs['lrn'].'" name="lrn">
							        	</div>
			        				</div>
						        	<div class="w3-row-padding" style="width:100%;">
							        	<div class="w3-twothird w3-margin-bottom">
							        		<label>Address: </label>
							        		<input type="text" class="w3-input w3-border w3-round" value="'.$jhs['address'].'" name="address">
							        	</div>
							        	<div class="w3-third w3-margin-bottom">
							        		<label>Sex: </label><br>
							        		<div class="w3-left">';
							        		if($jhs['sex']=="Male"){
							        			$checkM = "checked";
							        			$checkF = "";
							        		}else{
							        			$checkF = "checked";
							        			$checkM = "";
							        		}
							        		echo '
								        		<input type="radio" class="w3-radio" name="sex" value="Male" '.$checkM.' required> Male
								        		<input type="radio" class="w3-radio w3-margin-left" name="sex" '.$checkF.' value="Female"> Female
							        		</div>
							        	</div>
						        	</div>';
			        				

						        	if($jhs['section']==''){
						        		echo '<div class="w3-row-padding" style="width:100%;">
								        		<div class="w3-third w3-margin-bottom">
								        			<label>Grade level:</label>
								        			<select class="w3-input w3-border w3-round" name="grlevel" disabled>
								        				<option selected value="'.$jhs['grade_level'].'">'.$jhs['grade_level'].'</option>
								        			</select>
								        		</div>';

								        		echo '<div class="w3-third w3-margin-bottom">
								        				<label>Section/Block:</label>';

								        		switch($jhs['grade_level']){
								        			case 'Grade 7':
								        			echo '<select id="section7" name="seven" class="w3-input w3-border w3-round" required>';
								        					$this->users_model->getSectionName7();
								        			echo '</select>';
								        			break;

								        			case 'Grade 8';
								        			echo '<select id="section8" name="eight" class="w3-input w3-border w3-round" required>';
								        					$this->users_model->getSectionName8();
								        			echo '</select>';
								        			break;

								        			case 'Grade 9';
								        			echo '<select id="section9" name="nine" class="w3-input w3-border w3-round" required>';
								        					$this->users_model->getSectionName9();
								        			echo '</select>';
								        			break;

								        			case 'Grade 10';
								        			echo '<select id="section10" name="ten" class="w3-input w3-border w3-round" required>';
								        					$this->users_model->getSectionName10();
								        			echo '</select>';
								        			break;
								        		}
								        		echo '</div>
								        	</div>';
						        	}else{
						        		echo '<div class="w3-row-padding" style="width:100%;">
								        		<div class="w3-third w3-margin-bottom">
								        			<label>Grade level:</label>
								        			<select class="w3-input w3-border w3-round" name="grlevel" disabled>
								        				<option selected value="'.$jhs['grade_level'].'">'.$jhs['grade_level'].'</option>
								        			</select>
								        		</div>';

								        		echo '<div class="w3-third w3-margin-bottom">
								        				<label>Section/Block:</label>';

								        		switch($jhs['grade_level']){
								        			case 'Grade 7':
								        			echo '<select id="section7" name="seven" class="w3-input w3-border w3-round" required>';
								        					echo '<option selected>'.$jhs['section'].'</option>';
								        			echo '</select>';
								        			break;

								        			case 'Grade 8';
								        			echo '<select id="section8" name="eight" class="w3-input w3-border w3-round" required>';
								        					echo '<option selected>'.$jhs['section'].'</option>';
								        			echo '</select>';
								        			break;

								        			case 'Grade 9';
								        			echo '<select id="section9" name="nine" class="w3-input w3-border w3-round" required>';
								        					echo '<option selected>'.$jhs['section'].'</option>';
								        			echo '</select>';
								        			break;

								        			case 'Grade 10';
								        			echo '<select id="section10" name="ten" class="w3-input w3-border w3-round" required>';
								        					echo '<option selected>'.$jhs['section'].'</option>';
								        			echo '</select>';
								        			break;
								        		}
								        		echo '</div>
								        	</div>';
						        	}




						       echo '<div class="w3-container w3-margin-top w3-margin-bottom w3-right">
							        	<input type="submit" class="w3-button w3-blue w3-hover-light-blue w3-round-large" value="Update">
							        	<input type="button" onclick="document.getElementById(\'editMe'.$q_jhs.'\').style.display=\'none\'" class="w3-button w3-red w3-hover-pale-red w3-round-large" value="Cancel">
						        	</div>
						        </form>
		      					</div>
		      					<footer class="w3-container w3-blue"><br></footer>
							</div>
						</div>';

						$q_jhs++;

			    	}
			    	echo '</table></div></div>';


			    }
		    //QUERIED JHS STUDENT | ENDS HERE
			    else{
			    	if(!empty($this->session->flashdata('none'))){
			    		echo '<div class="w3-container w3-card w3-padding-large w3-round w3-margin-top">
				  				<div class="w3-container">
				  					<center><b>'.$this->session->flashdata('none').'</b></center>
				  				</div>
				  			</div>';
			    	}
			    }
  			
  		?>
  		<!---------------------------------------------------------------------------------------------------------------->
  		<!---------------------------------------------------------------------------------------------------------------->
  		<!---------------------------------------------------------------------------------------------------------------->



	    <div class="w3-container w3-card w3-padding w3-round w3-margin-top">
	    	<div class="w3-container">
	    		<span>
					<h6><b>LIST OF STUDENTS</b>
						<?php
	  						echo '<span class="w3-right w3-margin-bottom">'.$this->pagination->create_links().'</span>';
	  						echo '<br/>';
  						?>
					</h6>
				</span>
	    	</div>

	    	

	    	<?php
	    		echo "<div class='w3-card-4 w3-padding w3-round' style='overflow-x:auto;'>";
	    		echo "<h6><b>SENIOR HIGH SCHOOL STUDENTS</b></h6>";
	    		echo '<table class="w3-table-all w3-small" id="listOfStud">';
	    		echo '<thead><tr class="w3-light-grey"><th>LRN</th><th>First Name</th><th>Middle Name</th><th>Last Name</th><th>Grade Level</th><th>Section</th><th>Email</th><th>Status</th><th>Action</th></tr></thead>';
	    		$i = 1;
	    		foreach ($recordSHS->result_array() as $info) {
	    			if($info['status'] == 'Enrolled'){
	    				$color = "w3-green";
	    				$button = '| <a href="javascript:void(0)" onclick="document.getElementById(\'editMe'.$i.'\').style.display=\'block\'" class="w3-small w3-text-blue">Edit</a>';
	    			}elseif($info['status'] == 'Queued'){
	    				$color = "w3-yellow";
	    				$button = '| <a href="javascript:void(0)" onclick="document.getElementById(\'editMe'.$i.'\').style.display=\'block\'" class="w3-small w3-text-blue">Edit</a>';
	    			}else{
	    				$color = "w3-red";
	    				$button = '';
	    			}
	    			echo '<tr>';
	    			echo '<td>'.$info['lrn'].'</td>';
	    			echo '<td>'.$info['fname'].'</td>';
	    			echo '<td>'.$info['mname'].'</td>';
	    			echo '<td>'.$info['lname'].'</td>';
	    			echo '<td>'.$info['grade_level'].'</td>';
	    			echo '<td>'.$info['section'].'</td>';
	    			echo '<td>'.$info['email'].'</td>';
	    			echo '<td><span class="w3-tag w3-round '.$color.'">'.$info['status'].'</span></td>';
	    			echo '<td><a href="'.base_url().'admin/viewstudent/'.$info['lrn'].'/'.$info['grade_level'].'/Enrolled students" class="w3-small w3-text-blue">View</a> 
	    					'.$button.' | 
	    					<a href="'.base_url().'admin/deleteStudent/'.$info['lrn'].'/'.$info['grade_level'].'" class="w3-small w3-text-blue" onclick="javascript: return confirm(\'Delete Student ['.$info['lrn'].'] ?\')">Delete</a></td>';
	    			echo '</tr>';
					

					echo '<div id="editMe'.$i.'" class="w3-modal">
							<div class="w3-modal-content w3-animate-top">
								<header class="w3-container w3-blue"> 
			        				<span onclick="document.getElementById(\'editMe'.$i.'\').style.display=\'none\'" class="w3-button w3-display-topright w3-blue w3-hover-light-blue">&times;</span>
			        					<h3>EDIT STUDENT DATA</h3>
		      					</header>
		      					<div class="w3-container w3-padding">
		      						<br/>
			        				<form action="'; echo base_url(); echo 'admin/UpdateStudentInfo/'.$info['grade_level'].'" method="post">
			        				<div class="w3-row-padding" style="width:100%;">
				        				<div class="w3-third w3-margin-bottom">
					        				<label>Last Name: </label>
					        				<input type="text" class="w3-input w3-border w3-round" value="'.$info['lname'].'" name="lname" required pattern="\S+">
					        			</div>
					        			<div class="w3-third w3-margin-bottom">
					        				<label>First Name: </label>
					        				<input type="text" class="w3-input w3-border w3-round" value="'.$info['fname'].'" name="fname" required>
				        				</div>
				        				<div class="w3-third w3-margin-bottom">
					        				<label>Middle Name: </label>
					        				<input type="text" class="w3-input w3-border w3-round" value="'.$info['mname'].'" name="mname" required pattern="\S+">
				        				</div>
			        				</div>
			        				<div class="w3-row-padding" style="width:100%;">
				        				<div class="w3-third w3-margin-bottom">
					        				<label>Birthdate:</label>
					        				<input type="date" value="'.$info['Birthdate'].'" name="bday" class="w3-input w3-border w3-round">
				        				</div>
							        	<div class="w3-third w3-margin-bottom">
							        		<label>Email:</label>
								        	<input type="email" value="'.$info['email'].'" name="email" class="w3-input w3-border w3-round">
							        	</div>
							        	<div class="w3-third w3-margin-bottom">
							        		<label>LRN:</label>
								        	<input type="text" value="'.$info['lrn'].'" class="w3-input w3-border w3-round" disabled>
								        	<input type="hidden" value="'.$info['lrn'].'" name="lrn">
							        	</div>
			        				</div>
						        	<div class="w3-row-padding" style="width:100%;">
							        	<div class="w3-twothird w3-margin-bottom">
							        		<label>Address: </label>
							        		<input type="text" class="w3-input w3-border w3-round" value="'.$info['address'].'" name="address">
							        	</div>
							        	<div class="w3-third w3-margin-bottom">
							        		<label>Sex: </label><br>
							        		<div class="w3-left">';
							        		if($info['sex']=="Male"){
							        			$checkM = "checked";
							        			$checkF = "";
							        		}else{
							        			$checkF = "checked";
							        			$checkM = "";
							        		}
							        		echo '
								        		<input type="radio" class="w3-radio" name="sex" value="Male" '.$checkM.' required> Male
								        		<input type="radio" class="w3-radio w3-margin-left" name="sex" '.$checkF.' value="Female"> Female
							        		</div>
							        	</div>
						        	</div>';
			        				

						        	if($info['section']==''){
						        		echo '<div class="w3-row-padding" style="width:100%;">
								        		<div class="w3-third w3-margin-bottom">
								        			<label>Grade level:</label>
								        			<select class="w3-input w3-border w3-round" name="grlevel" disabled>
								        				<option selected value="'.$info['grade_level'].'">'.$info['grade_level'].'</option>
								        			</select>
								        		</div>';

								        		echo '<div class="w3-third w3-margin-bottom">
								        				<label>Track - Strand:</label>';

								        		switch($info['grade_level']){
								        			case 'Grade 11':
								        			echo '<select id="section11" name="track11" class="w3-input w3-border w3-round" required>';
								        					$this->users_model->getSectionName11();
								        			echo '</select>';
								        			break;

								        			case 'Grade 12';
								        			echo '<select id="section12" name="track12" class="w3-input w3-border w3-round" required>';
								        					$this->users_model->getSectionName12();
								        			echo '</select>';
								        			break;
								        		}
								        		echo '</div>
								        	</div>';
						        	}else{
						        		echo '<div class="w3-row-padding" style="width:100%;">
								        		<div class="w3-third w3-margin-bottom">
								        			<label>Grade level:</label>
								        			<select class="w3-input w3-border w3-round" name="grlevel" disabled>
								        				<option selected value="'.$info['grade_level'].'">'.$info['grade_level'].'</option>
								        			</select>
								        		</div>';

								        		echo '<div class="w3-third w3-margin-bottom">
								        				<label>Track - Strand:</label>';

								        		switch($info['grade_level']){
								        			case 'Grade 11':
								        			echo '<select id="section11" name="track11" class="w3-input w3-border w3-round" required>';
								        					echo '<option selected value="'.$info['section'].'">'.$info['section'].'</option>';
								        			echo '</select>';
								        			break;

								        			case 'Grade 12';
								        			echo '<select id="section12" name="track12" class="w3-input w3-border w3-round" required>';
								        					echo '<option selected value="'.$info['section'].'">'.$info['section'].'</option>';
								        			echo '</select>';
								        			break;
								        		}
								        		echo '</div>
								        	</div>';
						        	}


						        echo '<div class="w3-container w3-margin-top w3-margin-bottom w3-right">
							        	<input type="submit" class="w3-button w3-blue w3-hover-light-blue w3-round-large" value="Update">
							        	<input type="button" onclick="document.getElementById(\'editMe'.$i.'\').style.display=\'none\'" class="w3-button w3-red w3-hover-pale-red w3-round-large" value="Cancel">
						        	</div>
						        </form>
		      					</div>
		      					<footer class="w3-container w3-blue"><br></footer>
							</div>
						</div>';	 	   			

	 	   			$i++;

	    		}
	    		echo '</table></div><br/>';
	    	?>


	    	<?php
	    		echo "<div class='w3-card-4 w3-padding w3-round' style='overflow-x:auto;'>";
	    		echo "<h6><b>JUNIOR HIGH SCHOOL STUDENTS</b></h6>";
	    		echo '<table class="w3-table-all w3-small" id="listOfStud1">';
	    		echo '<thead><tr class="w3-light-grey"><th>LRN</th><th>First Name</th><th>Middle Name</th><th>Last Name</th><th>Grade Level</th><th>Section</th><th>Email</th><th>Status</th><th>Action</th></tr></thead>';

	    		$j=0;
	    		$j=$i+$j;

	    		foreach ($recordJHS->result_array() as $info) {
	    			if($info['status'] == 'Enrolled'){
	    				$color = "w3-green";
	    				$button = '| <a href="javascript:void(0)" onclick="document.getElementById(\'editMe'.$j.'\').style.display=\'block\'" class="w3-small w3-text-blue">Edit</a>';
	    			}elseif($info['status'] == 'Queued'){
	    				$color = "w3-yellow";
	    				$button = '| <a href="javascript:void(0)" onclick="document.getElementById(\'editMe'.$j.'\').style.display=\'block\'" class="w3-small w3-text-blue">Edit</a>';
	    			}else{
	    				$color = "w3-red";
	    				$button = '';
	    			}
	    			echo '<tr>';
	    			echo '<td>'.$info['lrn'].'</td>';
	    			echo '<td>'.$info['fname'].'</td>';
	    			echo '<td>'.$info['mname'].'</td>';
	    			echo '<td>'.$info['lname'].'</td>';
	    			echo '<td>'.$info['grade_level'].'</td>';
	    			echo '<td>'.$info['section'].'</td>';
	    			echo '<td>'.$info['email'].'</td>';
	    			echo '<td><span class="w3-tag w3-round '.$color.'">'.$info['status'].'</span></td>';
	    			echo '<td><a href="'.base_url().'admin/viewstudent/'.$info['lrn'].'/'.$info['grade_level'].'/Enrolled students" class="w3-small w3-text-blue">View</a> 
	    					'.$button.' | 
	    					<a href="'.base_url().'admin/deleteStudent/'.$info['lrn'].'/'.$info['grade_level'].'" class="w3-small w3-text-blue" onclick="javascript: return confirm(\'Delete Student ['.$info['lrn'].'] ?\')">Delete</a></td>';
	    			echo '</tr>';
					

					echo '<div id="editMe'.$j.'" class="w3-modal">
							<div class="w3-modal-content w3-animate-top">
								<header class="w3-container w3-blue"> 
			        				<span onclick="document.getElementById(\'editMe'.$j.'\').style.display=\'none\'" class="w3-button w3-display-topright w3-blue w3-hover-light-blue">&times;</span>
			        					<h3>EDIT STUDENT DATA</h3>
		      					</header>
		      					<div class="w3-container w3-padding">
		      						<br/>
			        				<form action="'; echo base_url(); echo 'admin/UpdateStudentInfo/'.$info['grade_level'].'" method="post">
			        				<div class="w3-row-padding" style="width:100%;">
				        				<div class="w3-third w3-margin-bottom">
					        				<label>Last Name: </label>
					        				<input type="text" class="w3-input w3-border w3-round" value="'.$info['lname'].'" name="lname" required pattern="\S+">
					        			</div>
					        			<div class="w3-third w3-margin-bottom">
					        				<label>First Name: </label>
					        				<input type="text" class="w3-input w3-border w3-round" value="'.$info['fname'].'" name="fname" required>
				        				</div>
				        				<div class="w3-third w3-margin-bottom">
					        				<label>Middle Name: </label>
					        				<input type="text" class="w3-input w3-border w3-round" value="'.$info['mname'].'" name="mname" required pattern="\S+">
				        				</div>
			        				</div>
			        				<div class="w3-row-padding" style="width:100%;">
				        				<div class="w3-third w3-margin-bottom">
					        				<label>Birthdate:</label>
					        				<input type="date" value="'.$info['Birthdate'].'" name="bday" class="w3-input w3-border w3-round">
				        				</div>
							        	<div class="w3-third w3-margin-bottom">
							        		<label>Email:</label>
								        	<input type="email" value="'.$info['email'].'" name="email" class="w3-input w3-border w3-round">
							        	</div>
							        	<div class="w3-third w3-margin-bottom">
							        		<label>LRN:</label>
								        	<input type="text" value="'.$info['lrn'].'" class="w3-input w3-border w3-round" disabled>
								        	<input type="hidden" value="'.$info['lrn'].'" name="lrn">
							        	</div>
			        				</div>
						        	<div class="w3-row-padding" style="width:100%;">
							        	<div class="w3-twothird w3-margin-bottom">
							        		<label>Address: </label>
							        		<input type="text" class="w3-input w3-border w3-round" value="'.$info['address'].'" name="address">
							        	</div>
							        	<div class="w3-third w3-margin-bottom">
							        		<label>Sex: </label><br>
							        		<div class="w3-left">';
							        		if($info['sex']=="Male"){
							        			$checkM = "checked";
							        			$checkF = "";
							        		}else{
							        			$checkF = "checked";
							        			$checkM = "";
							        		}
							        		echo '
								        		<input type="radio" class="w3-radio" name="sex" value="Male" '.$checkM.' required> Male
								        		<input type="radio" class="w3-radio w3-margin-left" name="sex" '.$checkF.' value="Female"> Female
							        		</div>
							        	</div>
						        	</div>';
			        				
						        	if($info['section']==''){
						        		echo '<div class="w3-row-padding" style="width:100%;">
								        		<div class="w3-third w3-margin-bottom">
								        			<label>Grade level:</label>
								        			<select class="w3-input w3-border w3-round" name="grlevel" disabled>
								        				<option selected value="'.$info['grade_level'].'">'.$info['grade_level'].'</option>
								        			</select>
								        		</div>';

								        		echo '<div class="w3-third w3-margin-bottom">
								        				<label>Section/Block:</label>';

								        		switch($info['grade_level']){
								        			case 'Grade 7':
								        			echo '<select id="section7" name="seven" class="w3-input w3-border w3-round" required>';
								        					$this->users_model->getSectionName7();
								        			echo '</select>';
								        			break;

								        			case 'Grade 8';
								        			echo '<select id="section8" name="eight" class="w3-input w3-border w3-round" required>';
								        					$this->users_model->getSectionName8();
								        			echo '</select>';
								        			break;

								        			case 'Grade 9';
								        			echo '<select id="section9" name="nine" class="w3-input w3-border w3-round" required>';
								        					$this->users_model->getSectionName9();
								        			echo '</select>';
								        			break;

								        			case 'Grade 10';
								        			echo '<select id="section10" name="ten" class="w3-input w3-border w3-round" required>';
								        					$this->users_model->getSectionName10();
								        			echo '</select>';
								        			break;
								        		}
								        		echo '</div>
								        	</div>';
						        	}else{
						        		echo '<div class="w3-row-padding" style="width:100%;">
								        		<div class="w3-third w3-margin-bottom">
								        			<label>Grade level:</label>
								        			<select class="w3-input w3-border w3-round" name="grlevel" disabled>
								        				<option selected value="'.$info['grade_level'].'">'.$info['grade_level'].'</option>
								        			</select>
								        		</div>';

								        		echo '<div class="w3-third w3-margin-bottom">
								        				<label>Section/Block:</label>';

								        		switch($info['grade_level']){
								        			case 'Grade 7':
								        			echo '<select id="section7" name="seven" class="w3-input w3-border w3-round" required>';
								        					echo '<option selected>'.$info['section'].'</option>';
								        			echo '</select>';
								        			break;

								        			case 'Grade 8';
								        			echo '<select id="section8" name="eight" class="w3-input w3-border w3-round" required>';
								        					echo '<option selected>'.$info['section'].'</option>';
								        			echo '</select>';
								        			break;

								        			case 'Grade 9';
								        			echo '<select id="section9" name="nine" class="w3-input w3-border w3-round" required>';
								        					echo '<option selected>'.$info['section'].'</option>';
								        			echo '</select>';
								        			break;

								        			case 'Grade 10';
								        			echo '<select id="section10" name="ten" class="w3-input w3-border w3-round" required>';
								        					echo '<option selected>'.$info['section'].'</option>';
								        			echo '</select>';
								        			break;
								        		}
								        		echo '</div>
								        	</div>';
						        	}


						        	echo '<div class="w3-container w3-margin-top w3-margin-bottom w3-right">
								        	<input type="submit" onclick="javascript: return confirm(\'Update student information?\')" class="w3-button w3-blue w3-hover-light-blue w3-round-large" value="Update">
								        	<input type="button" onclick="document.getElementById(\'editMe'.$j.'\').style.display=\'none\'" class="w3-button w3-red w3-hover-pale-red w3-round-large" value="Cancel">
						        		</div>
						        </form>
		      					</div>
		      					<footer class="w3-container w3-blue"><br></footer>
							</div>
						</div>';	 	   			

	 	   			$j++;

	    		
	    		}
	    		echo '</table></div>';
	    		
	    	?>
	    </div>

	</div>
	<!-- END MAIN CONTENT -->

<script type="text/javascript">
	function functionSearch() {
  		var input, filter, table, tr, td, i, j;
  		input = document.getElementById("myInput");
  		filter = input.value.toUpperCase();
  		table = document.getElementById("listOfStud");
  		tr = table.getElementsByTagName("tr");
  
	  	//negative 1 if no match
	  	for (i = 0; i < tr.length; i++) {
	    	td = tr[i].getElementsByTagName("td")[3];
	    	if (td) {
		      	if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
		        	tr[i].style.display = "";
		      	} else {
		        	tr[i].style.display = "none";
		      	}
	    	}
	  	}

	  	table1 = document.getElementById("listOfStud1");
	  	tr1 = table1.getElementsByTagName("tr");
	  	for (j = 0; j < tr1.length; j++) {
	    	td = tr1[j].getElementsByTagName("td")[3];
	    	if (td) {
		      	if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
		        	tr1[j].style.display = "";

		      	} else {
		        	tr1[j].style.display = "none";
		      	}
	    	}
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

            notificationitems.open("POST", "https://"+window.location.hostname+"/BanquerohanNationalHighSchool/Admin/notifitems/enrolledstudents", true);
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