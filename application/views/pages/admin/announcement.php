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


	    <a href="<?php echo base_url();?>admin/enrolledstudents" onclick="w3_close()" class="w3-bar-item w3-button w3-text-white w3-hover-text-blue w3-hover-white w3-padding-16" style="border-radius: 30px 0px 0px 30px;">
	      	<span class="fa fa-users w3-margin-left"></span>&nbsp;&nbsp;Enrolled students
	    </a> 


	    <!-- ACCORDION FOR OTHERS -->
	    <a class="w3-bar-item w3-button w3-text-white w3-hover-text-white w3-hover-none w3-padding-16" style="border-radius: 30px 0px 0px 30px;">
	    	<span class="fa fa-sliders w3-margin-left"></span>&nbsp;&nbsp;Others <i class="fa fa-caret-down"></i>
	    </a> 
	    <div id="others_items" class="w3-container w3-show">
	    	<a href="<?php echo base_url();?>admin/concerns" class="w3-bar-item w3-button w3-margin-left w3-hover-text-blue w3-hover-white w3-small" style="border-radius: 30px 0px 0px 30px;">
	    		<span class="fa fa-bookmark w3-margin-left"></span>&nbsp;&nbsp;Concerns <span class="w3-badge w3-circle w3-white" id="adminconcerncounter">
	    	</a>
	    	<a href="<?php echo base_url();?>admin/announcement" class="w3-bar-item w3-button w3-white w3-text-blue w3-hover-text-blue w3-hover-white w3-padding w3-small w3-margin-left" style="border-radius: 30px 0px 0px 30px;">
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
	<header class="w3-container w3-top w3-hide-large w3-blue w3-large w3-padding">
		<span>
		    <img class="w3-circle w3-right" src="<?php echo base_url()?>resource/img/Logo.png" alt="School Logo" style="max-width:60px; width:100%;">
		    	<div class="w3-dropdown-click w3-right w3-margin-top">
                    <button class="w3-button w3-hover-blue w3-blue fa fa-bell w3-large" onclick="dropdownsmall()"><span class="w3-badge w3-circle w3-red" id="AdminNotifSmall"></button>

                    <div id="AdminItemsSmall" class="w3-dropdown-content w3-bar-block w3-border" style="right: 0; width: 20em; height: 30em; overflow: scroll"></div>
                </div>
		    <h3>
		    	<a href="javascript:void(0)" class="fa fa-bars w3-button w3-blue w3-xlarge w3-left w3-hover-light-blue w3-round" onclick="w3_open()"></a>ANNOUNCEMENTS
			</h3>
		</span>
	</header>

	<!-- Overlay effect when opening sidebar on small screens -->
	<div class="w3-overlay w3-hide-large" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>
	<!-- END | Top menu on small screens-->

	<br class="w3-hide-large"/><br class="w3-hide-large"/><br class="w3-hide-large"/>

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
	    	<h3 class="w3-left w3-padding"><b>ANNOUNCEMENTS</b></h3>
	    	
	    	<div class="w3-dropdown-click w3-right w3-margin-top">
                <button class="w3-button w3-hover-white w3-white fa fa-bell w3-large w3-padding-large" onclick="dropdownlarge()"><span class="w3-badge w3-circle w3-red" id="AdminNotifLarge"></span></button>

                <div id="AdminNotifLargeItems" class="w3-dropdown-content w3-bar-block w3-border" style="right: 0; width: 30em; height:35em; overflow: scroll"></div>
            </div>
		</span>
  	</div>

  	<!-- MAIN CONTENT -->
  	<div class="w3-container">
	    <div class="w3-padding-6 w3-hide-large w3-hide-medium"></div>
	    <br/>

	    <button onclick="document.getElementById('create').style.display='block'" class="w3-button w3-round w3-blue w3-hover-light-blue w3-hover-text-white"><span class="fa fa-pencil-square-o"></span>&nbsp;&nbsp;Post announcement</button>
	    
	    <!-- Flashdata -->
	    <?php if($this->session->flashdata('uploaded')){;?>
	    <p class="w3-panel w3-pale-green w3-center w3-padding">
	        <?php echo $this->session->flashdata('uploaded'); header("Refresh:1;url=announcement");?>
	    </p>
		<?php };?>
		<?php if($this->session->flashdata('error')){;?>
	    <div class="w3-panel w3-pale-red w3-center w3-padding">
	        <?php echo $this->session->flashdata('error'); header("Refresh:1;url=announcement");?>
	    </div>
		<?php };?>
		<!-- END Flashdata -->

	    <!-- | FIRST ROW | -->
	    <div class="w3-row-padding w3-margin-top">
	    	<div class="w3-card w3-round w3-padding">
	    		<h5><b>POSTED ANNOUNCEMENTS THIS MONTH</b></h5>

	    		<?php 
				   $this->users_model->getAllAnnounceThisMonth();
	    		?>
	    	</div>
	    </div>

	    <div class="w3-row-padding w3-margin-top">
	    	<div class="w3-card w3-round w3-padding">
	    		<h5><b>POSTED ANNOUNCEMENTS</b></h5>

	    		<?php 
				   $this->users_model->getAllAnnounce();	//retrieving all created announcement
	    		?>
	    	</div>
	    </div>
	    <!-- | END OF FIRST ROW | -->
	   
	    <!--| POST MODAL |-->
	    <div id="create" class="w3-modal">
		    <div class="w3-modal-content w3-card-4 w3-animate-top">
		     	<header class="w3-container w3-blue"> 
		        	<span onclick="document.getElementById('create').style.display='none'" 
		        class="w3-button w3-display-topright w3-blue w3-hover-light-blue">&times;</span>
		        	<h2>POST ANNOUNCEMENT</h2>
		      	</header>
	              
		      	<div class="w3-container">
		        	<form method="post" action="<?php echo base_url(); ?>admin/uploadPost" class="w3-container">
			         	<div class="w3-section">
			         		<fieldset class="w3-container w3-padding-16 w3-round">
			         			<legend><b>Announcement Duration</b></legend>
			         			<div class="w3-row-padding">
			         				<div class="w3-half">
					         			<label>Start date</label>		
										<input class="w3-input w3-border w3-margin-bottom w3-round" type="date" name="start_date" value="<?php echo date('Y-m-d'); ?>" required>
									</div>

									<div class="w3-half">
										<label>End date</label>
										<input class="w3-input w3-border w3-margin-bottom w3-round" type="date" name="end_date" value="<?php echo date("Y-m-d", strtotime('next day'));?>" required>
									</div>
								</div>
			         		</fieldset>
							<br/>
			         		
							<fieldset class="w3-container w3-padding-16 w3-round">
								<legend><b>Recepients</b></legend>

								<input class="w3-check" type="checkbox" name="val[]" value="All" onclick="dis()" id="all">
								<label id="alllabel">All&nbsp;&nbsp;&nbsp;&nbsp;</label>
				            	<input class="w3-check" type="checkbox" name="val[]" value="Grade 7" onclick="dis()" id="disb">
								<label>Grade 7</label>&nbsp;&nbsp;&nbsp;&nbsp;
								<input class="w3-check" type="checkbox" name="val[]" value="Grade 8" onclick="dis()" id="disb1">
								<label>Grade 8</label>&nbsp;&nbsp;&nbsp;&nbsp;
								<input class="w3-check" type="checkbox" name="val[]" value="Grade 9" onclick="dis()" id="disb2">
								<label>Grade 9</label>&nbsp;&nbsp;&nbsp;&nbsp;
								<input class="w3-check" type="checkbox" name="val[]" value="Grade 10" onclick="dis()" id="disb3">
								<label>Grade 10</label>&nbsp;&nbsp;&nbsp;&nbsp;
								<input class="w3-check" type="checkbox" name="val[]" value="Grade 11" onclick="dis()" id="disb4">
								<label>Grade 11</label>&nbsp;&nbsp;&nbsp;&nbsp;
				            	<input class="w3-check" type="checkbox" name="val[]" value="Grade 12" onclick="dis()" id="disb5">
								<label>Grade 12</label>&nbsp;&nbsp;&nbsp;&nbsp;
								<input class="w3-check" type="checkbox" name="val[]" value="Teachers" onclick="dis()" id="disb6">
								<label>Teachers</label>
							</fieldset>
							<br/>

							<fieldset class="w3-container w3-padding-16 w3-round">
								<legend><b>Content</b></legend>

								<label>Subject:</label><br/>
								<input class="w3-input w3-border w3-margin-bottom w3-round" type="text" name="title" style="width:100%" required>
								<label>Description:</label><br/>
								<textarea class="w3-input w3-border w3-round" style="resize: none; width: 100%; height: 150px;" name="description" required></textarea>
							</fieldset>
							
			            	<button class="w3-button w3-block w3-blue w3-section w3-padding w3-round w3-hover-light-blue" type="submit">Post</button>
			          </div>
			        </form>
		      	</div>

		      	<footer class="w3-container w3-blue w3-padding">
		        	
		      	</footer>
		    </div>
  		</div>
  		<!--| END OF MODAL |-->


	</div>
</div>
<script type="text/javascript">
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
</body>