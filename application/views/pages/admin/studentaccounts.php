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


	    <!-- ACCORDION FOR ACCOUNTS -->
	    <a onclick="accounts();" class="w3-bar-item w3-button w3-text-white w3-hover-text-white w3-hover-none w3-padding-16" style="border-radius: 30px 0px 0px 30px;">
	    	<span class="fa fa-user-circle-o w3-margin-left"></span>&nbsp;&nbsp;Accounts <i class="fa fa-caret-down"></i>
	    </a>
	    <div id="accounts_items" class="w3-container w3-show">
	    	<a href="<?php echo base_url();?>admin/studentaccounts" onclick="w3_close()" class="w3-bar-item w3-button w3-white w3-text-blue w3-hover-text-blue w3-hover-white w3-padding w3-small w3-margin-left" style="border-radius: 30px 0px 0px 30px;">
	    		<span class="fa fa-users w3-margin-left"></span>&nbsp;&nbsp;Students
	    	</a>
	    	<a href="<?php echo base_url();?>admin/teacheraccounts" onclick="w3_close()" class="w3-bar-item w3-button w3-margin-left w3-hover-text-blue w3-hover-white w3-small" style="border-radius: 30px 0px 0px 30px;">
	    		<span class="fa fa-users w3-margin-left"></span>&nbsp;&nbsp;Teachers
	    	</a>
	    </div>
	    <!-- END | ACCORDION FOR ACCOUNTS -->


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


	    <a href="<?php echo base_url();?>admin/enrolledstudents" onclick="w3_close()" class="w3-bar-item w3-button w3-text-white w3-hover-text-blue w3-hover-white w3-padding-16" style="border-radius: 30px 0px 0px 30px;">
	      	<span class="fa fa-users w3-margin-left"></span>&nbsp;&nbsp;Enrolled students
	    </a> 


	    <!-- ACCORDION FOR OTHERS -->
	    <a onclick="others();" class="w3-bar-item w3-button w3-text-white w3-hover-text-white w3-hover-none w3-padding-16" style="border-radius: 30px 0px 0px 30px;">
	    	<span class="fa fa-sliders w3-margin-left"></span>&nbsp;&nbsp;Others <i class="fa fa-caret-down"></i>
	    </a> 
	    <div id="others_items" class="w3-container w3-show">
	    	<a href="<?php echo base_url();?>admin/concerns" onclick="w3_close()" class="w3-bar-item w3-button w3-margin-left w3-hover-text-blue w3-hover-white w3-small" style="border-radius: 30px 0px 0px 30px;">
	    		<span class="fa fa-bookmark w3-margin-left"></span>&nbsp;&nbsp;Concerns <span class="w3-badge w3-circle w3-white" id="adminconcerncounter">
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
<!-- | END | Sidebar/menu | -->


<!-- | CONTENT | -->
	<!--Top menu on small screens-->
	<header class="w3-container w3-top w3-hide-large w3-blue w3-padding">
		<span>
	    	<img class="w3-circle w3-right" src="<?php echo base_url()?>resource/img/Logo.png" alt="School Logo" style="max-width:60px; width:100%;">

            <div class="w3-dropdown-click w3-right w3-margin-top">
                <button class="w3-button w3-hover-blue w3-blue fa fa-bell w3-large" onclick="dropdownsmall()"><span class="w3-badge w3-circle w3-red" id="AdminNotifSmall"></button>

                <div id="AdminItemsSmall" class="w3-dropdown-content w3-bar-block w3-border" style="right: 0; width: 20em; height:35em; overflow: scroll"></div>
            </div>
	    	<h3>
	    		<a href="javascript:void(0)" class="fa fa-bars w3-button w3-blue w3-xlarge w3-left w3-hover-light-blue w3-round" onclick="w3_open()"></a>STUDENT ACCOUNTS
	    	</h3>
	  	</span>
	</header>

	<!-- Overlay effect when opening sidebar on small screens -->
	<div class="w3-overlay w3-hide-large" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>
	<!-- END | Top menu on small screens-->

	<br class="w3-hide-large"><br class="w3-hide-large"><br class="w3-hide-large"><br class="w3-hide-large">

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
	    	<h3 class="w3-left w3-padding"><b>STUDENT ACCOUNTS</b></h3></span>
	    	<div class="w3-dropdown-click w3-right w3-margin-top">
                <button class="w3-button w3-hover-white w3-white fa fa-bell w3-large w3-padding-large" onclick="dropdownlarge()"><span class="w3-badge w3-circle w3-red" id="AdminNotifLarge"></button>

                <div id="AdminNotifLargeItems" class="w3-dropdown-content w3-bar-block w3-border" style="right: 0; width: 30em; height:35em; overflow: scroll"></div>
            </div>
		</span>
  	</div>

  	<!-- MAIN CONTENT -->
  	<div class="w3-container">
	    <div class="w3-padding-6 w3-hide-large"></div>
	    <br/>

	    <div class="w3-container w3-card w3-padding-large w3-round">
	    	<form action="<?php echo base_url();?>admin/searchStudent" method="post">	
		    	
		    	<label class="w3-left w3-margin-right w3-hide-small"><b>Search:</b></label>
		    	
		    	<input type="text" class="w3-input w3-border w3-round w3-left" name="lastname" id="myInput" style="width:15em;" onkeyup="functionSearch()" placeholder="Last name" required>
		    	<button class="w3-button w3-round-large w3-blue w3-hover-light-blue w3-left w3-margin-right"><i class="fa fa-search"></i></button>
		   		
		    </form>
	    </div>
	   



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
	  						<thead><tr class="w3-light-grey">
	  							<th>LRN</th>
	  							<th>First Name</th>
	  							<th>Middle Name</th>
	  							<th>Last Name</th>
	  							<th>Grade Level</th>
	  							<th>Section</th>
	  							<th>Acc. status</th>
	  							<th>Action</th>
	  						</tr></thead>';


  				//QUERIED JHS STUDENT | BOTH
  				$q_jhs = 1;
  				foreach ($JHS as $jhs){
  					$jhsid = $jhs['lrn'];
  					$juniors = $this->db->query("SELECT * FROM accounts WHERE id = '$jhsid'");
	    			foreach($juniors->result_array() as $jhsinfo)

  					echo '<tr>';
		    			echo '<td>'.$jhsinfo['id'].'</td>';
		    			echo '<td>'.$jhs['fname'].'</td>';
		    			echo '<td>'.$jhs['mname'].'</td>';
		    			echo '<td>'.$jhs['lname'].'</td>';
		    			echo '<td>'.$jhs['grade_level'].'</td>';
		    			echo '<td>'.$jhs['section'].'</td>';
		    			echo '<td>'.$jhsinfo['account_status'].'</td>';
		    			if($jhsinfo['account_status'] == "Active"){
	    				$showbutton = '<a href="javascript:void(0)" onclick="document.getElementById(\'ViewAccount'.$q_jhs.'\').style.display=\'block\'" class="w3-small w3-text-blue">View</a> | <a href="'.base_url().'admin/studAccDeact/'.$jhsinfo['id'].'" onclick="javascript: return confirm(\'Deactivate account? \')" class="w3-small w3-text-blue">Deactivate</a>';
		    			}elseif($jhsinfo['account_status'] == "Inactive"){
		    				$showbutton = '<a href="'.base_url().'admin/studAccActivate/'.$jhsinfo['id'].'" onclick="javascript: return confirm(\'Activate account? \')" class="w3-small w3-text-blue">Activate</a>';
		    			}else{
		    				$showbutton = '';
		    			}

		    			echo '<td>'.$showbutton.'</td>';
	    			echo '</tr>';


		    		echo '<div id="ViewAccount'.$q_jhs.'" class="w3-modal">
							<div class="w3-modal-content w3-animate-top" style="max-width:600px">
								<header class="w3-container w3-blue"> 
			        				<span onclick="document.getElementById(\'ViewAccount'.$q_jhs.'\').style.display=\'none\'" class="w3-button w3-display-topright w3-blue w3-hover-light-blue">&times;</span>
			        					<h3>ACCOUNT LOGIN CREDENTIALS</h3>
		      					</header>
		      					<div class="w3-container w3-margin-left w3-padding">
		      						<center><h4><b>'.$jhs['fname'].' '.$jhs['mname'].' '.$jhs['lname'].'</b> account login credentials.</h4></center>
		      						<div class="w3-left w3-margin-right" style="width:45%;">
					        			<label>LRN: </label>
					        			<input type="text" class="w3-input w3-border w3-round" value="'.$jhsinfo['id'].'" disabled>
					        		</div>
					        		<div class="w3-left w3-margin-right w3-margin-bottom" style="width:45%;">
					        			<label>Password: </label>
					        			<input type="text" class="w3-input w3-border w3-round" value="'.$jhsinfo['password'].'" disabled>
				        			</div>
		      					</div>
		      					<footer class="w3-container w3-blue w3-padding"></footer>
		      				</div>
		      			</div>';

						$q_jhs++;

		    	}

		    	//QUERIED SHS STUDENTS | BOTH
		    	$q_shs = 0;
		    	$q_shs = $q_jhs+$q_shs;
		    	foreach ($SHS as $shs){
		    		$shsid = $shs['lrn'];
	    			$seniors = $this->db->query("SELECT * FROM accounts WHERE id = '$shsid'");
	    			foreach($seniors->result_array() as $shsinfo)

		    		echo '<tr>';
		    			echo '<td>'.$shsinfo['id'].'</td>';
		    			echo '<td>'.$shs['fname'].'</td>';
		    			echo '<td>'.$shs['mname'].'</td>';
		    			echo '<td>'.$shs['lname'].'</td>';
		    			echo '<td>'.$shs['grade_level'].'</td>';
		    			echo '<td>'.$shs['section'].'</td>';
		    			echo '<td>'.$shsinfo['account_status'].'</td>';
		    			if($shsinfo['account_status'] == "Active"){
	    				$showbutton = '<a href="javascript:void(0)" onclick="document.getElementById(\'ViewAccount'.$q_shs.'\').style.display=\'block\'" class="w3-small w3-text-blue">View</a> | <a href="'.base_url().'admin/studAccDeact/'.$shsinfo['id'].'" onclick="javascript: return confirm(\'Deactivate account? \')" class="w3-small w3-text-blue">Deactivate</a>';
		    			}elseif($shsinfo['account_status'] == "Inactive"){
		    				$showbutton = '<a href="'.base_url().'admin/studAccActivate/'.$shsinfo['id'].'" onclick="javascript: return confirm(\'Activate account? \')" class="w3-small w3-text-blue">Activate</a>';
		    			}else{
		    				$showbutton = '';
		    			}

		    			echo '<td>'.$showbutton.'</td>';
			    		echo '</tr>';


		    		echo '<div id="ViewAccount'.$q_shs.'" class="w3-modal">
							<div class="w3-modal-content w3-animate-top" style="max-width:600px">
								<header class="w3-container w3-blue"> 
			        				<span onclick="document.getElementById(\'ViewAccount'.$q_shs.'\').style.display=\'none\'" class="w3-button w3-display-topright w3-blue w3-hover-light-blue">&times;</span>
			        					<h3>ACCOUNT LOGIN CREDENTIALS</h3>
		      					</header>
		      					<div class="w3-container w3-margin-left w3-padding">
		      						<center><h4><b>'.$shs['fname'].' '.$shs['mname'].' '.$shs['lname'].'</b> account login credentials.</h4></center>
		      						<div class="w3-left w3-margin-right" style="width:45%;">
					        			<label>LRN: </label>
					        			<input type="text" class="w3-input w3-border w3-round" value="'.$shsinfo['id'].'" disabled>
					        		</div>
					        		<div class="w3-left w3-margin-right w3-margin-bottom" style="width:45%;">
					        			<label>Password: </label>
					        			<input type="text" class="w3-input w3-border w3-round" value="'.$shsinfo['password'].'" disabled>
				        			</div>
		      					</div>
		      					<footer class="w3-container w3-blue w3-padding"></footer>
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
		  							<th>Acc. status</th>
		  							<th>Action</th>
		  						</tr></thead>';


	  			$q_shs = 1;
			    	foreach ($SHS as $shs){
			    	$shsid = $shs['lrn'];
	    			$seniors = $this->db->query("SELECT * FROM accounts WHERE id = '$shsid'");
	    			foreach($seniors->result_array() as $shsinfo)

		    		echo '<tr>';
		    			echo '<td>'.$shsinfo['id'].'</td>';
		    			echo '<td>'.$shs['fname'].'</td>';
		    			echo '<td>'.$shs['mname'].'</td>';
		    			echo '<td>'.$shs['lname'].'</td>';
		    			echo '<td>'.$shs['grade_level'].'</td>';
		    			echo '<td>'.$shs['section'].'</td>';
		    			echo '<td>'.$shsinfo['account_status'].'</td>';
		    			if($shsinfo['account_status'] == "Active"){
	    				$showbutton = '<a href="javascript:void(0)" onclick="document.getElementById(\'ViewAccount'.$q_shs.'\').style.display=\'block\'" class="w3-small w3-text-blue">View</a> | <a href="'.base_url().'admin/studAccDeact/'.$shsinfo['id'].'" onclick="javascript: return confirm(\'Deactivate account? \')" class="w3-small w3-text-blue">Deactivate</a>';
		    			}elseif($shsinfo['account_status'] == "Inactive"){
		    				$showbutton = '<a href="'.base_url().'admin/studAccActivate/'.$shsinfo['id'].'" onclick="javascript: return confirm(\'Activate account? \')" class="w3-small w3-text-blue">Activate</a>';
		    			}else{
		    				$showbutton = '';
		    			}

		    			echo '<td>'.$showbutton.'</td>';
			    		echo '</tr>';


		    		echo '<div id="ViewAccount'.$q_shs.'" class="w3-modal">
							<div class="w3-modal-content w3-animate-top" style="max-width:600px">
								<header class="w3-container w3-blue"> 
			        				<span onclick="document.getElementById(\'ViewAccount'.$q_shs.'\').style.display=\'none\'" class="w3-button w3-display-topright w3-blue w3-hover-light-blue">&times;</span>
			        					<h3>ACCOUNT LOGIN CREDENTIALS</h3>
		      					</header>
		      					<div class="w3-container w3-margin-left w3-padding">
		      						<center><h4><b>'.$shs['fname'].' '.$shs['mname'].' '.$shs['lname'].'</b> account login credentials.</h4></center>
		      						<div class="w3-left w3-margin-right" style="width:45%;">
					        			<label>LRN: </label>
					        			<input type="text" class="w3-input w3-border w3-round" value="'.$shsinfo['id'].'" disabled>
					        		</div>
					        		<div class="w3-left w3-margin-right w3-margin-bottom" style="width:45%;">
					        			<label>Password: </label>
					        			<input type="text" class="w3-input w3-border w3-round" value="'.$shsinfo['password'].'" disabled>
				        			</div>
		      					</div>
		      					<footer class="w3-container w3-blue w3-padding"></footer>
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
	  							<th>Contact</th>
	  							<th>Action</th>
	  						</tr></thead>';


  				//QUERIED JHS STUDENT
  				$q_jhs = 1;
  				foreach ($JHS as $jhs){
  					$jhsid = $jhs['lrn'];
  					$juniors = $this->db->query("SELECT * FROM accounts WHERE id = '$jhsid'");
	    			foreach($juniors->result_array() as $jhsinfo)

  					echo '<tr>';
		    			echo '<td>'.$jhsinfo['id'].'</td>';
		    			echo '<td>'.$jhs['fname'].'</td>';
		    			echo '<td>'.$jhs['mname'].'</td>';
		    			echo '<td>'.$jhs['lname'].'</td>';
		    			echo '<td>'.$jhs['grade_level'].'</td>';
		    			echo '<td>'.$jhs['section'].'</td>';
		    			echo '<td>'.$jhsinfo['account_status'].'</td>';
		    			if($jhsinfo['account_status'] == "Active"){
	    				$showbutton = '<a href="javascript:void(0)" onclick="document.getElementById(\'ViewAccount'.$q_jhs.'\').style.display=\'block\'" class="w3-small w3-text-blue">View</a> | <a href="'.base_url().'admin/studAccDeact/'.$jhsinfo['id'].'" onclick="javascript: return confirm(\'Deactivate account? \')" class="w3-small w3-text-blue">Deactivate</a>';
		    			}elseif($jhsinfo['account_status'] == "Inactive"){
		    				$showbutton = '<a href="'.base_url().'admin/studAccActivate/'.$jhsinfo['id'].'" onclick="javascript: return confirm(\'Activate account? \')" class="w3-small w3-text-blue">Activate</a>';
		    			}else{
		    				$showbutton = '';
		    			}

		    			echo '<td>'.$showbutton.'</td>';
	    			echo '</tr>';


		    		echo '<div id="ViewAccount'.$q_jhs.'" class="w3-modal">
							<div class="w3-modal-content w3-animate-top" style="max-width:600px">
								<header class="w3-container w3-blue"> 
			        				<span onclick="document.getElementById(\'ViewAccount'.$q_jhs.'\').style.display=\'none\'" class="w3-button w3-display-topright w3-blue w3-hover-light-blue">&times;</span>
			        					<h3>ACCOUNT LOGIN CREDENTIALS</h3>
		      					</header>
		      					<div class="w3-container w3-margin-left w3-padding">
		      						<center><h4><b>'.$jhs['fname'].' '.$jhs['mname'].' '.$jhs['lname'].'</b> account login credentials.</h4></center>
		      						<div class="w3-left w3-margin-right" style="width:45%;">
					        			<label>LRN: </label>
					        			<input type="text" class="w3-input w3-border w3-round" value="'.$jhsinfo['id'].'" disabled>
					        		</div>
					        		<div class="w3-left w3-margin-right w3-margin-bottom" style="width:45%;">
					        			<label>Password: </label>
					        			<input type="text" class="w3-input w3-border w3-round" value="'.$jhsinfo['password'].'" disabled>
				        			</div>
		      					</div>
		      					<footer class="w3-container w3-blue w3-padding"></footer>
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





	    <div class="w3-container w3-card w3-round w3-margin-top">
	    	<div class="w3-container">
	    		<span>
					<h6>
						<b>LIST OF STUDENTS</b>
						<?php
	  						echo '<span class="w3-right w3-margin-bottom">'.$this->pagination->create_links().'</span>';
	  						//echo "<br/>";
  						?>
					</h6>
				</span>
	    	</div>

	    	<?php
	    		if(!empty($count)){
	    			$i = $count + 1;
	    		}else{
	    			$i = 1;
	    		}
	    		echo "<div class='w3-card-4 w3-padding w3-round' style='overflow-x:auto;'>";
	    		echo "<h6><b>SENIOR HIGH SCHOOL STUDENTS</b></h6>";
	    		echo '<table class="w3-table-all w3-small" id="listOfStud">';
	    		echo '<thead><tr class="w3-light-grey"><th>LRN</th><th>First Name</th><th>Middle Name</th><th>Last Name</th><th>Grade Level</th><th>Section</th><th>Acc. status</th><th>Action</th></tr></thead>';
	    		//$i = 1;
	    		foreach ($recordSHS->result_array() as $info) {
	    			$shsid = $info['lrn'];
	    			$shs = $this->db->query("SELECT * FROM accounts WHERE id = '$shsid'");
	    			foreach($shs->result_array() as $shsinfo)

	    			echo '<tr>';
	    			echo '<td>'.$shsinfo['id'].'</td>';
	    			echo '<td>'.$info['fname'].'</td>';
	    			echo '<td>'.$info['mname'].'</td>';
	    			echo '<td>'.$info['lname'].'</td>';
	    			echo '<td>'.$info['grade_level'].'</td>';
	    			echo '<td>'.$info['section'].'</td>';
	    			echo '<td>'.$shsinfo['account_status'].'</td>';

	    			if($shsinfo['account_status'] == "Active"){
	    				$showbutton = '<a href="javascript:void(0)" onclick="document.getElementById(\'ViewAccount'.$i.'\').style.display=\'block\'" class="w3-small w3-text-blue">View</a> | <a href="'.base_url().'admin/studAccDeact/'.$shsinfo['id'].'" onclick="javascript: return confirm(\'Deactivate account? \')" class="w3-small w3-text-blue">Deactivate</a>';
	    			}elseif($shsinfo['account_status'] == 'Inactive'){
	    				$showbutton = '<a href="'.base_url().'admin/studAccActivate/'.$shsinfo['id'].'" onclick="javascript: return confirm(\'Activate account? \')" class="w3-small w3-text-blue">Activate</a>';
	    			}else{
	    				$showbutton = '';
	    			}

	    			echo '<td>'.$showbutton.'</td>';
	    			echo '</tr>';


	    			echo '<div id="ViewAccount'.$i.'" class="w3-modal">
							<div class="w3-modal-content w3-animate-top" style="max-width:600px">
								<header class="w3-container w3-blue"> 
			        				<span onclick="document.getElementById(\'ViewAccount'.$i.'\').style.display=\'none\'" class="w3-button w3-display-topright w3-blue w3-hover-light-blue">&times;</span>
			        					<h3>ACCOUNT LOGIN CREDENTIALS</h3>
		      					</header>
		      					<div class="w3-container w3-margin-left w3-padding">
		      						<center><h4><b>'.$info['fname'].' '.$info['mname'].' '.$info['lname'].'</b> account login credentials.</h4></center>
		      						<div class="w3-left w3-margin-right" style="width:45%;">
					        			<label>LRN: </label>
					        			<input type="text" class="w3-input w3-border w3-round" value="'.$shsinfo['id'].'" disabled>
					        		</div>
					        		<div class="w3-left w3-margin-right w3-margin-bottom" style="width:45%;">
					        			<label>Password: </label>
					        			<input type="text" class="w3-input w3-border w3-round" value="'.$shsinfo['password'].'" disabled>
				        			</div>
		      					</div>
		      					<footer class="w3-container w3-blue w3-padding"></footer>
		      				</div>
		      			</div>';

		      		$i++;
	    		}
	    		echo '</table></div><br/>';

	    	?>

	    	
	    	<?php
	    		echo "<div class='w3-card-4 w3-padding w3-round w3-margin-bottom' style='overflow-x:auto;'>";
	    		echo "<h6><b>JUNIOR HIGH SCHOOL STUDENTS</h6></b>";
	    		echo '<table class="w3-table-all w3-small" id="listOfStud1">';
	    		echo '<thead><tr class="w3-light-grey"><th>LRN</th><th>First Name</th><th>Middle Name</th><th>Last Name</th><th>Grade Level</th><th>Section</th><th>Acc. status</th><th>Action</th></tr></thead>';

	    		$j=$i;

	    		foreach ($recordJHS->result_array() as $info){
	    			$jhsid = $info['lrn'];
	    			$jhs = $this->db->query("SELECT * FROM accounts WHERE id = '$jhsid'");
	    			foreach ($jhs->result_array() as $jhsinfo) 

	    			echo '<tr>';
	    			echo '<td>'.$jhsinfo['id'].'</td>';
	    			echo '<td>'.$info['fname'].'</td>';
	    			echo '<td>'.$info['mname'].'</td>';
	    			echo '<td>'.$info['lname'].'</td>';
	    			echo '<td>'.$info['grade_level'].'</td>';
	    			echo '<td>'.$info['section'].'</td>';
	    			echo '<td>'.$jhsinfo['account_status'].'</td>';

	    			if($jhsinfo['account_status'] == "Active"){
	    				$showbutton = '<a href="javascript:void(0)" onclick="document.getElementById(\'ViewAccount'.$j.'\').style.display=\'block\'" class="w3-small w3-text-blue">View</a> | <a href="'.base_url().'admin/studAccDeact/'.$jhsinfo['id'].'" onclick="javascript: return confirm(\'Deactivate account? \')" class="w3-small w3-text-blue">Deactivate</a>';
	    			}elseif($jhsinfo['account_status'] == "Inactive"){
	    				$showbutton = '<a href="'.base_url().'admin/studAccActivate/'.$jhsinfo['id'].'" onclick="javascript: return confirm(\'Activate account? \')" class="w3-small w3-text-blue">Activate</a>';
	    			}else{
	    				$showbutton = '';
	    			}

	    			echo '<td>'.$showbutton.'</td>';
	    			echo '</tr>';

	    			
	    			echo '<div id="ViewAccount'.$j.'" class="w3-modal">
							<div class="w3-modal-content w3-animate-top" style="max-width:600px">
								<header class="w3-container w3-blue"> 
			        				<span onclick="document.getElementById(\'ViewAccount'.$j.'\').style.display=\'none\'" class="w3-button w3-display-topright w3-blue w3-hover-light-blue">&times;</span>
			        					<h3>ACCOUNT LOGIN CREDENTIALS</h3>
		      					</header>
		      					<div class="w3-container w3-margin-left w3-padding">
		      						<center><h4><b>'.$info['fname'].' '.$info['mname'].' '.$info['lname'].'</b> account login credentials.</h4></center>
		      						<div class="w3-left w3-margin-right" style="width:45%;">
					        			<label>LRN: </label>
					        			<input type="text" class="w3-input w3-border w3-round" value="'.$jhsinfo['id'].'" disabled>
					        		</div>
					        		<div class="w3-left w3-margin-right w3-margin-bottom" style="width:45%;">
					        			<label>Password: </label>
					        			<input type="text" class="w3-input w3-border w3-round" value="'.$jhsinfo['password'].'" disabled>
				        			</div>
		      					</div>
		      					<footer class="w3-container w3-blue w3-padding"></footer>
		      				</div>
		      			</div>';

		      		$j++;
	    		}
	    		echo '</table></div>';
	    	?>
	    	<p><small><b>Note:</b> As DEFAULT, all student accounts are INACTIVE after being enrolled until VERIFIED.</small></p>
	    </div>

	</div>
	<!-- END MAIN CONTENT -->
</div>

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

            notificationitems.open("POST", "https://"+window.location.hostname+"/BanquerohanNationalHighSchool/Admin/notifitems/studentaccounts", true);
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
</body>