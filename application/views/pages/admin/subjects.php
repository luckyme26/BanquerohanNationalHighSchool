<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<title><?= $title; ?></title>

<body onload="LoadAll()">
<!-- | Sidebar/menu | -->
<nav class="w3-sidebar w3-blue w3-collapse w3-top w3-large" style="z-index:3;width:245px;font-weight:bold;" id="mySidebar"><br>
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


	    <a href="<?php echo base_url();?>admin/subjects/overview" onclick="w3_close()" class="w3-bar-item w3-button w3-white w3-text-blue w3-hover-text-blue w3-hover-white w3-padding-16" style="border-radius: 30px 0px 0px 30px;">
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
	    		<a href="javascript:void(0)" class="fa fa-bars w3-button w3-blue w3-xlarge w3-left w3-hover-light-blue w3-round" onclick="w3_open()"></a>SUBJECTS
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
	    	<h3 class="w3-left w3-padding"><b>SUBJECTS</b></h3>

	    	<div class="w3-dropdown-click w3-right w3-margin-top">
                <button class="w3-button w3-hover-white w3-white fa fa-bell w3-large w3-padding-large" onclick="dropdownlarge()"><span class="w3-badge w3-circle w3-red" id="AdminNotifLarge"></span></button>

                <div id="AdminNotifLargeItems" class="w3-dropdown-content w3-bar-block w3-border" style="right: 0; width: 30em; height:35em; overflow: scroll"></div>
            </div>
	    </span>
  	</div>

  	<!-- MAIN CONTENT -->
  	<div class="w3-container">
	    <div class="w3-padding-6 w3-hide-large"></div>

	    <div class="w3-container w3-card w3-padding-large w3-round w3-margin-top">
	    	<h6><b>LIST OF SUBJECTS PER GRADE LEVEL</b></h6>
	    	<hr/>

	    	<button class="w3-button w3-round w3-blue w3-hover-light-blue" onclick="document.getElementById('addSubj').style.display = 'block'"><i class="fa fa-plus"></i> Add subject
	    	</button>

	    	<a href="<?php echo base_url()?>admin/downloadsubjs" class="w3-button w3-round w3-green w3-hover-pale-green">
	    		<i class="fa fa-download"></i> Download subjects
	    	</a>

	    		<?php if($this->session->flashdata('created')){;?>
			    <p class="w3-panel w3-pale-green w3-center w3-padding">
			        <?php echo $this->session->flashdata('created'); header('Refresh:1;url='.base_url().'admin/subjects/overview');?>
			    </p>
				<?php };?>
				<?php if($this->session->flashdata('error')){;?>
			    <p class="w3-panel w3-pale-red w3-center w3-padding">
			        <?php echo $this->session->flashdata('error'); header('Refresh:2;url='.base_url().'admin/subjects/overview');?>
			    </p>
				<?php };?>
	    	

	    	<?php
	    		$this->load->model('users_model');
	    	?>

	    	<div class="w3-section w3-border">
				<button onclick="accordionForSubj('gr7')" class="w3-button w3-block w3-left-align"><h6><b>GRADE 7</b></h6></button>
			  	<div id="gr7" class="w3-hide w3-container w3-margin-top">
			    	<?php
	    				echo $this->users_model->subjectsof('Grade 7');
	    			?>
			  	</div>
			</div>

			<div class="w3-section w3-border">
				<button onclick="accordionForSubj('gr8')" class="w3-button w3-block w3-left-align"><h6><b>GRADE 8</b></h6></button>
			  	<div id="gr8" class="w3-hide w3-container w3-margin-top">
			    	<?php
	    				echo $this->users_model->subjectsof('Grade 8');
	    			?>
			  	</div>
			</div>

			<div class="w3-section w3-border">
				<button onclick="accordionForSubj('gr9')" class="w3-button w3-block w3-left-align"><h6><b>GRADE 9</b></h6></button>
			  	<div id="gr9" class="w3-hide w3-container w3-margin-top">
			    	<?php
	    				echo $this->users_model->subjectsof('Grade 9');
	    			?>
			  	</div>
			</div>
	    	
			<div class="w3-section w3-border">
				<button onclick="accordionForSubj('gr10')" class="w3-button w3-block w3-left-align"><h6><b>GRADE 10</b></h6></button>
			  	<div id="gr10" class="w3-hide w3-container w3-margin-top">
			    	<?php
	    				echo $this->users_model->subjectsof('Grade 10');
	    			?>
			  	</div>
			</div>
	    	
			<div class="w3-section w3-border">
				<button onclick="accordionForSubj('gr11')" class="w3-button w3-block w3-left-align"><h6><b>GRADE 11</b></h6></button>
			  	<div id="gr11" class="w3-hide w3-container w3-margin-top">
			    	<?php
	    				echo $this->users_model->subjectsof('Grade 11');
	    			?>
			  	</div>
			</div>
	    	
			<div class="w3-section w3-border">
				<button onclick="accordionForSubj('gr12')" class="w3-button w3-block w3-left-align"><h6><b>GRADE 12</b></h6></button>
			  	<div id="gr12" class="w3-hide w3-container w3-margin-top">
			    	<?php
	    				echo $this->users_model->subjectsof('Grade 12');
	    			?>
			  	</div>
			</div>
	    	
	    		<!-- SUBJECT CREATION MODAL -->
	    		<div class="w3-modal" id="addSubj">
	    			<div class="w3-modal-content w3-card-4 w3-animate-top">
	    				<header class="w3-container w3-blue">
	    					<span onclick="document.getElementById('addSubj').style.display='none'" class="w3-button w3-display-topright w3-blue w3-hover-light-blue">&times;</span>
			        		<h3>CREATE SUBJECT</h3>
	    				</header>
	    				<div class="w3-container w3-padding w3-margin-top">
					        <form action="<?php echo base_url(); ?>admin/addSubject" method="post" enctype="multipart/form-data">
					        	<label>Grade level:</label>
					        	<select name="gr_level" class="w3-input w3-border w3-round" required>
					        		<option value="Grade 7">Grade 7</option>
					        		<option value="Grade 8">Grade 8</option>
					        		<option value="Grade 9">Grade 9</option>
					        		<option value="Grade 10">Grade 10</option>
					        		<option value="Grade 11">Grade 11</option>
					        		<option value="Grade 12">Grade 12</option>
					        	</select>
					        	<br/>
					        	<label>Subject Title:</label>
					        	<input type="text" name="subj_title" class="w3-input w3-border w3-round" required><br/>

					        	<label>Subject Photo:</label>
					        	<input type="file" name="subj_pic" class="w3-input w3-border w3-round" required><br/>

					        	<label>Subject Description:</label>
					        	<textarea name="subj_desc" style="resize: none; width: 100%; height: 150px;" required></textarea>

					        	<input type="submit" value="Create" class="w3-button w3-block w3-blue w3-round w3-margin-top w3-hover-light-blue">

					        </form>
					    </div>
					    <footer class="w3-container w3-blue w3-padding-large w3-margin-top"></footer>
	    			</div>
	    		</div>
	    		<!-- SUBJECT CREATION MODAL | END -->

	    </div>   


	</div>
	<!-- END MAIN CONTENT -->
</div>
<script type="text/javascript">
	function showDelete(x){
		//window.alert(x);
		var link = document.getElementById("link"+x);
		var img = document.getElementById("image"+x);
	
		link.className -= " w3-hide";
		link.className += " w3-button w3-round w3-red w3-hover-pale-red w3-display-middle w3-animate-opacity ";
		img.className += " w3-opacity-max";
	}

	function hideDelete(x){

		var link = document.getElementById("link"+x);
		var img = document.getElementById("image"+x);
	
		link.className += " w3-hide";
		img.className -= " w3-opacity-max";

	}

	function accordionForSubj(id) {
    var x = document.getElementById(id);
	    if (x.className.indexOf("w3-show") == -1) {
	        x.className += " w3-show";
	    } else { 
	        x.className = x.className.replace(" w3-show", "");
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

            notificationitems.open("POST", "https://"+window.location.hostname+"/BanquerohanNationalHighSchool/Admin/notifitems/subjects overview", true);
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