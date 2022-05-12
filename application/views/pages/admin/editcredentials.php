<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<title><?= $title; ?></title>

<body>
<!-- | Sidebar/menu | -->
<nav class="w3-sidebar w3-blue w3-collapse w3-top w3-large w3-animate-left" style="z-index:3;width:245px;font-weight:bold;" id="mySidebar"><br>
  <!--<a href="javascript:void(0)" onclick="w3_close()" class="w3-button w3-hide-large w3-display-topleft" style="width:100%;font-size:22px">Close Menu</a>-->
 	<div class="w3-container">
		<center>
    		<span class="fa fa-user-circle-o" style="font-size:100px;"></span>
      		<h5 class="w3-text-white">ADMINISTRATOR</h5>
    	</center>
  	</div>
  	<br/>
  
  	<div class="w3-bar-block">  
	    <a href="<?php echo base_url();?>admin/dashboard"  onclick="w3_close()" class="w3-bar-item w3-button w3-text-white w3-hover-text-blue w3-hover-white w3-padding-16" style="border-radius: 30px 0px 0px 30px;">
	    	<span class="fa fa-dashboard w3-margin-left"></span>&nbsp;&nbsp;Dashboard
	    </a> 

	    <a onclick="accounts();" class="w3-bar-item w3-button w3-text-white w3-hover-text-blue w3-hover-white w3-padding-16" style="border-radius: 30px 0px 0px 30px;">
	    	<span class="fa fa-user-circle-o w3-margin-left"></span>&nbsp;&nbsp;Accounts <i class="fa fa-caret-down"></i>
	    </a>
	    <div id="accounts_items" class="w3-container w3-hide">
	    	<a href="<?php echo base_url();?>admin/studentaccounts" class="w3-bar-item w3-button w3-margin-left w3-hover-text-blue w3-hover-white w3-small" style="border-radius: 30px 0px 0px 30px;"><span class="fa fa-users w3-margin-left"></span>&nbsp;&nbsp;Students</a>
	    	<a href="<?php echo base_url();?>admin/teacheraccounts" class="w3-bar-item w3-button w3-margin-left w3-hover-text-blue w3-hover-white w3-small" style="border-radius: 30px 0px 0px 30px;"><span class="fa fa-users w3-margin-left"></span>&nbsp;&nbsp;Teachers</a>
	    </div>

	    <!-- ACCORDION FOR SECTIONS -->
	    <a onclick="section();" class="w3-bar-item w3-button w3-text-white w3-hover-text-blue w3-hover-white w3-padding-16" style="border-radius: 30px 0px 0px 30px;">
	    	<span class="fa fa-th-list w3-margin-left"></span>&nbsp;&nbsp;Sections <i class="fa fa-caret-down"></i>
	    </a>
	    <div id="sections" class="w3-container w3-hide">
	    	<a href="<?php echo base_url(); ?>admin/grade7/List" class="w3-bar-item w3-button w3-margin-left w3-hover-text-blue w3-hover-white w3-small" style="border-radius: 30px 0px 0px 30px;"><span class="fa fa-users w3-margin-left"></span>&nbsp;&nbsp;Grade 7</a>
	    	<a href="<?php echo base_url(); ?>admin/grade8/List" class="w3-bar-item w3-button w3-margin-left w3-hover-text-blue w3-hover-white w3-small" style="border-radius: 30px 0px 0px 30px;"><span class="fa fa-users w3-margin-left"></span>&nbsp;&nbsp;Grade 8</a>
	    	<a href="<?php echo base_url(); ?>admin/grade9/List" class="w3-bar-item w3-button w3-margin-left w3-hover-text-blue w3-hover-white w3-small" style="border-radius: 30px 0px 0px 30px;"><span class="fa fa-users w3-margin-left"></span>&nbsp;&nbsp;Grade 9</a>
	    	<a href="<?php echo base_url(); ?>admin/grade10/List" class="w3-bar-item w3-button w3-margin-left w3-hover-text-blue w3-hover-white w3-small" style="border-radius: 30px 0px 0px 30px;"><span class="fa fa-users w3-margin-left"></span>&nbsp;&nbsp;Grade 10</a>
	    	<a href="<?php echo base_url(); ?>admin/grade11/List" class="w3-bar-item w3-button w3-margin-left w3-hover-text-blue w3-hover-white w3-small" style="border-radius: 30px 0px 0px 30px;"><span class="fa fa-users w3-margin-left"></span>&nbsp;&nbsp;Grade 11</a>
	    	<a href="<?php echo base_url(); ?>admin/grade12/List" class="w3-bar-item w3-button w3-margin-left w3-hover-text-blue w3-hover-white w3-small" style="border-radius: 30px 0px 0px 30px;"><span class="fa fa-users w3-margin-left"></span>&nbsp;&nbsp;Grade 12</a>
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
	    	<a href="#" class="w3-bar-item w3-button w3-margin-left w3-hover-text-blue w3-hover-white w3-small" style="border-radius: 30px 0px 0px 30px;"><span class="fa fa-cogs w3-margin-left"></span>&nbsp;&nbsp;Logs
	    	</a>
	    	<a href="<?php echo base_url();?>admin/announcement" class="w3-bar-item w3-button w3-margin-left w3-hover-text-blue w3-hover-white w3-small" style="border-radius: 30px 0px 0px 30px;"><span class="fa fa-bullhorn w3-margin-left"></span>&nbsp;&nbsp;Announcement
	    	</a>
	    	<a href="<?php echo base_url();?>admin/events" class="w3-bar-item w3-button w3-margin-left w3-hover-text-blue w3-hover-white w3-small" style="border-radius: 30px 0px 0px 30px;"><span class="fa fa-calendar w3-margin-left"></span>&nbsp;&nbsp;Events
	    	</a>
	    	<a href="<?php echo base_url();?>admin/editcredentials" class="w3-bar-item w3-button w3-white w3-text-blue w3-hover-text-blue w3-hover-white w3-padding w3-small w3-margin-left" style="border-radius: 30px 0px 0px 30px;"><span class="fa fa-pencil-square-o w3-margin-left"></span>&nbsp;&nbsp;Edit credentials
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
		<header class="w3-container w3-top w3-hide-large w3-blue w3-xlarge w3-padding">
			<span>
		    	<img class="w3-circle w3-right" src="<?php echo base_url()?>resource/img/Logo.png" alt="School Logo" style="max-width:60px; width:100%;">
		    	<h3>
		    		<a href="javascript:void(0)" class="fa fa-bars w3-button w3-blue w3-xlarge w3-left w3-hover-light-blue w3-round" onclick="w3_open()"></a>
		    	</h3>
		  	</span>
		</header>

		<!-- Overlay effect when opening sidebar on small screens -->
		<div class="w3-overlay w3-hide-large" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>
	<!-- END | Top menu on small screens-->
	<br class="w3-hide-large"/><br class="w3-hide-large"/><br class="w3-hide-large"/>


<!-- PAGE CONTENT -->
<div class="w3-main w3-animate-right w3-margin-bottom" style="margin-left: 245px;">
  
  	<!-- HEADER -->
  	<div class="w3-container w3-white w3-hide-small w3-hide-medium" style="box-shadow: 2px 0px 5px 1px gray;">
	    <span>
	    	<h3 class="w3-left w3-padding"><b></b></h3>
		</span>
  	</div>

  	<!-- MAIN CONTENT -->
  	<div class="w3-container">
	    <div class="w3-padding-6 w3-hide-large w3-hide-medium"></div>
	    <br/>

	    <div class="w3-container w3-card w3-padding w3-round" style="width:70%; margin: auto;">
	    <?php
            if($this->session->flashdata('confirmed')){
            
            	echo '<div class="w3-panel w3-pale-green">';
                	echo $this->session->flashdata('confirmed');
              	echo '</div>';
            
            }else{
            	header('Refresh:1;url='.base_url().'admin/dashboard');
            }
            
	    	extract($this->session->userdata('Home of the braves@2022:admin'));
	    ?>
	    <h4>LOG IN CREDENTIALS</h4><hr/>
	    <form action="<?php echo base_url().'admin/sendemail'?>" method="post">
	    	<div class="w3-row-padding">
		    	<div class="w3-container w3-half w3-margin-bottom">
		    		<label>Employee number:</label>
		    		<input type="text" class="w3-input w3-border w3-round" name="idNum" value="<?php echo $id;?>" placeholder="ID number" required>
		    		<input type="hidden" name="prevId" value="<?php echo $id;?>">
		    	</div>

		    	<div class="w3-container w3-half w3-margin-bottom">
		    		<label>Password:</label>
		    		<input type="password" class="w3-input w3-border w3-round" pattern="^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$" name="password" placeholder="Password" required>
		    		<span class="w3-small"><i>Password must contain atleast special character, number, lowercase letter and Uppercase letter.</i></span>
		    	</div>
		    </div>
		    <div class="w3-container w3-margin-bottom">
		    	<label>Confirmation email:</label>
		    	<input type="email" class="w3-input w3-border w3-round" name="email" value="<?php echo $ver_email;?>" placeholder="Confirmation email" required>
		    </div>
		    <hr/>
		    <small><b>Note: </b>Please make sure that the email is active.</small>
		    <button class="w3-button w3-block w3-blue w3-section w3-padding w3-round w3-hover-light-blue" type="submit">Save</button>
	    </form>
		</div>

	</div>
</div>

</body>