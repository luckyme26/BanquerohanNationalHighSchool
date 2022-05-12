<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<title><?= $title;?></title>

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
  	
  	<!--| LINKS |-->
  	<div class="w3-bar-block">  
	    <a href="<?php echo base_url();?>admin/dashboard" onclick="w3_close()" class="w3-bar-item w3-button w3-white w3-text-blue w3-hover-text-blue w3-hover-white w3-padding-16" style="border-radius: 30px 0px 0px 30px;">
	    	<span class="fa fa-dashboard w3-margin-left"></span>&nbsp;&nbsp;Dashboard
	    </a> 


	    <!-- ACCORDION FOR ACCOUNTS -->
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
	    <!-- END | ACCORDION FOR SECTIONS -->


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
	    	<a href="javascript:void(0)" onclick="document.getElementById('Confirmation').style.display='block'" class="w3-bar-item w3-button w3-margin-left w3-hover-text-blue w3-hover-white w3-small" style="border-radius: 30px 0px 0px 30px;"><span class="fa fa-pencil-square-o w3-margin-left"></span>&nbsp;&nbsp;Edit credentials</a>
	    </div>
	    <!-- END | ACCORDION FOR OTHERS -->


	    <a href="<?php echo base_url(); ?>admin/logout" onclick="w3_close()" class="w3-bar-item w3-button w3-text-white w3-hover-text-blue w3-hover-white w3-padding-16" style="border-radius: 30px 0px 0px 30px;">
	    	<span class=" fa fa-sign-out w3-margin-left"></span>&nbsp;&nbsp;Log Out
	    </a> 
  	</div>
  	<!--| END OF LINKS |-->

</nav>
<!-- | END of Sidebar/menu | -->


<!-- | CONTENT | -->
	<!--Top menu on small screens-->
	<header class="w3-container w3-top w3-hide-large w3-blue w3-padding">
		<span>
	    	<img class="w3-circle w3-right" src="<?php echo base_url()?>resource/img/Logo.png" alt="School Logo" style="max-width:60px; width:100%;">

            <div class="w3-dropdown-click w3-right w3-margin-top">
                <button class="w3-button w3-hover-blue w3-blue fa fa-bell w3-large" onclick="dropdownsmall()"><span class="w3-badge w3-circle w3-red" id="AdminNotifSmall"></button>

                <div id="AdminItemsSmall" class="w3-dropdown-content w3-bar-block w3-border" style="right: 0; width: 20em; height: 30em; overflow: scroll"></div>
            </div>
	    	<h3>
	    		<a href="javascript:void(0)" class="fa fa-bars w3-button w3-blue w3-xlarge w3-left w3-hover-light-blue w3-round" onclick="w3_open()"></a>DASHBOARD
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
		    <h3 class="w3-left w3-padding"><b>DASHBOARD</b></h3>

            <div class="w3-dropdown-click w3-right w3-margin-top">
                <button class="w3-button w3-hover-white w3-white fa fa-bell w3-large w3-padding-large" onclick="dropdownlarge()"><span class="w3-badge w3-circle w3-red" id="AdminNotifLarge"></span></button>

                <div id="AdminNotifLargeItems" class="w3-dropdown-content w3-bar-block w3-border" style="right: 0; width: 30em; height:35em; overflow: scroll"></div>
            </div>
		</span>
  	</div>
  	<!-- END OF HEADER -->


  	<!-- MAIN CONTENT -->
  	<div class="w3-container">
	    <div class="w3-padding-6 w3-hide-large"></div>
	    <br/>

	    <div class="w3-row-padding">
	    	<div class="w3-col m3 w3-margin-bottom">
	    		<div class="w3-container w3-card w3-round w3-blue">
	    			
	    			<h6>
	    				<?php
	    					$this->users_model->countexist('Junior High School Teacher');
	    				?>
	    			JUNIOR HIGH SCHOOL TEACHERS
	    			</h6>
	    			
	    		</div>
	    	</div>

	    	<div class="w3-col m3 w3-margin-bottom">
	    		<div class="w3-container w3-card w3-round w3-teal">
	    				
	    			<h6>
	    				<?php
	    					$this->users_model->countexist('Senior High School Teacher');
	    				?>
					SENIOR HIGH SCHOOL TEACHERS
	    			</h6>
	    				
	    		</div>
	    	</div>

	    	<div class="w3-col m3 w3-margin-bottom">
	    		<div class="w3-container w3-card w3-round w3-blue">
	    			
	    			<h6>
	    				<?php
	    					$this->users_model->countexist('Junior High School Student');
	    				?>
	    			JUNIOR HIGH SCHOOL STUDENTS
	    			</h6>

	    		</div>
	    	</div>

	    	<div class="w3-col m3 w3-margin-bottom">
	    		<div class="w3-container w3-card w3-round w3-teal">
	    			
	    			<h6>
	    				<?php
	    					$this->users_model->countexist('Senior High School Student');
	    				?>
	    			SENIOR HIGH SCHOOL STUDENTS
	    			</h6>

	    		</div>
	    	</div>	    	
	    </div>

	    <div class="w3-row-padding">
	    	<div class="w3-col m3 w3-margin-bottom">
	    		<div class="w3-container w3-card w3-round w3-red">
	    			
	    			<h6>
	    				<?php
	    					$this->users_model->countexist('Droppedjhs');
	    				?>
	    			DROPPED JUNIOR HIGH SCHOOL STUDENTS
	    			</h6>
	    		</div>
	    	</div>

	    	<div class="w3-col m3 w3-margin-bottom">
	    		<div class="w3-container w3-card w3-round w3-red">
	    			
	    			<h6>
	    				<?php
	    					$this->users_model->countexist('Droppedshs');
	    				?>
	    			DROPPED SENIOR HIGH SCHOOL STUDENTS
	    			</h6>
	    		</div>
	    	</div>
	    </div>

	    <!-- | FIRST ROW | -->
	    <div class="w3-row-padding">
	    	<div class="w3-col m8 w3-margin-bottom">
	    		<div class="w3-card w3-round">
	    			<div class="w3-container w3-padding">
	    				<h5><b>ANNOUNCEMENTS</b></h5>
	    				<?php 
						    $this->users_model->getAnnounce();	//retrieving all created announcement from today to the last
	    				?>
	    				
	    			</div>
	    		</div>
	    	</div>

	    	<div class="w3-col m4">
	    		<div class="w3-card w3-round w3-margin-bottom">
	    			<div class="w3-container">
	    				<h5><b>LOGS</b> <a href="javascript:void(0)" onclick="document.getElementById('fullloglist').style.display = 'block'" class="w3-small">see all</a></h5>
				        <div id="logslist"></div>
	    			</div>
	    		</div>
	    	</div>
	    </div>
	    <!-- | END OF FIRST ROW | -->


	    <!-- MODAL FOR FULL LOG LIST -->
	    <div class="w3-modal" id="fullloglist">
	    	<div class="w3-modal-content w3-animate-top">
	    		<header class="w3-container w3-blue">
		    		<span onclick="document.getElementById('fullloglist').style.display='none'" class="w3-button w3-display-topright w3-blue w3-hover-light-blue" title="Close Modal">&times;</span>
		            <h3>FULL LOG LIST</h3>
	        	</header>
	    		<div id="fulllist"></div>
	    		<footer class="w3-container w3-padding w3-blue"></footer>
	    	</div>
	    </div>


	    <!-- | SECOND ROW | -->
	    <div class="w3-row-padding">
	    	<div class="w3-col m8 w3-margin-bottom">
	    		<div class="w3-card w3-round">
	    			<div class="w3-container w3-padding">
	    				<div class="w3-row-padding">
	    					<h5><b>CALENDAR OF EVENTS</b></h5>
	    					<div class="w3-col m5">
	    						<div class="w3-padding">
	    							
				    				<?php 
				    				
				    					echo '<center>';
				    					echo $this->calendar->generate($this->uri->segment(3), $this->uri->segment(4));
				    					echo '</center>';
				    				?>

	    						</div>
	    					</div>
	    					<div class="w3-col m7">
	    						<div class="w3-round">

	    							<?php
	    								$this->users_model->getEventsWithinMonth();
	    							?>

	    						</div>
	    					</div>
	    				</div>
	    				
	    			</div>
	    		</div>
	    	</div>

	    	<div class="w3-col m4">
	    		<div class="w3-card w3-round w3-margin-bottom">
	    			<div class="w3-container">
	    				<h5><b>ONLINE</b> <span id="online" class="w3-badge w3-circle w3-green w3-small"></span></h5>
	    				<div id="onlinelist"></div>
	    			</div>
	    		</div>
	    	</div>
	    </div>
	    <!-- | END OF SECOND ROW | -->


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

            notificationitems.open("POST", "https://"+window.location.hostname+"/BanquerohanNationalHighSchool/Admin/notifitems/dashboard", true);
            notificationitems.send();
            //NOTIFICATIONS | END

            
            //ONLINE USERS
            var countonlineuser = new XMLHttpRequest();
            countonlineuser.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("online").innerHTML = this.responseText;
                }
            };

            countonlineuser.open("GET", "https://"+window.location.hostname+"/BanquerohanNationalHighSchool/Admin/countOnline", true);
            countonlineuser.send();

            var onlineuserlist = new XMLHttpRequest();
            onlineuserlist.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("onlinelist").innerHTML = this.responseText;
                }
            };

            onlineuserlist.open("POST", "https://"+window.location.hostname+"/BanquerohanNationalHighSchool/Admin/OnlineList", true);
            onlineuserlist.send();
            //ONLINE USERS | END


            var countpostedconcern = new XMLHttpRequest();
            countpostedconcern.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("adminconcerncounter").innerHTML = this.responseText;
                }
            };

            countpostedconcern.open("GET", "https://"+window.location.hostname+"/BanquerohanNationalHighSchool/Admin/countconcern", true);
            countpostedconcern.send();


            //LOG LIST
            var adminloglist = new XMLHttpRequest();
            adminloglist.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("logslist").innerHTML = this.responseText;
                }
            };

            adminloglist.open("POST", "https://"+window.location.hostname+"/BanquerohanNationalHighSchool/Admin/Adminlogs", true);
            adminloglist.send();


            var fullloglist = new XMLHttpRequest();
            fullloglist.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("fulllist").innerHTML = this.responseText;
                }
            };

            fullloglist.open("POST", "https://"+window.location.hostname+"/BanquerohanNationalHighSchool/Admin/Adminlogslist", true);
            fullloglist.send();
            //LOG LIST | END

        }, 5000);
    }
    //ADMIN | END

</script>
</body>