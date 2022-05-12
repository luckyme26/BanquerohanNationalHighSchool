<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<title><?= $title; ?></title>

<body onload="LoadAll(<?php echo $id; ?>)">
<!-- | Sidebar/menu | -->
<nav class="w3-sidebar w3-blue w3-collapse w3-top w3-large w3-animate-left" style="z-index:3;width:245px;font-weight:bold;" id="mySidebar"><br>
 	<div class="w3-container w3-margin-bottom">
        <center>
            <?php
                if($photo == ''){
                    $img = '<span class="fa fa-user-circle-o" style="font-size:6em;"></span>';
                }else{
                    $img = '<img src="'.base_url().'ProfilePic/teachers/'.$photo.'" class="w3-circle" style="max-width:6em;width:100%;max-height:6em;">';
                }
                echo $img;
            ?>
            <h5 class="w3-text-white"><?php echo strtoupper($name);?></h5>
        </center>
    </div>

  	<div class="w3-bar-block">
        <a href="<?php echo base_url();?>Teacher/dashboard/<?php echo $link;?>"  onclick="w3_close()" class="w3-bar-item w3-button w3-text-white w3-hover-text-blue w3-hover-white w3-padding-16" style="border-radius: 30px 0px 0px 30px;">
            <span class="fa fa-dashboard w3-margin-left"></span>&nbsp;&nbsp;Dashboard
        </a>


        <a href="<?php echo base_url();?>Teacher/profile/<?php echo $link;?>" onclick="w3_close()" class="w3-bar-item w3-button w3-text-white w3-hover-text-blue w3-hover-white w3-padding-16" style="border-radius: 30px 0px 0px 30px;">
            <span class="fa fa-user-circle-o w3-margin-left"></span>&nbsp;&nbsp;Profile
        </a>

        <?php
            $this->Teachers_model->ifadviser($id, $link);
        ?>
        <!--<a href="<?php echo base_url();?>Teacher/advisory/<?php echo $link;?>"  onclick="w3_close()" class="w3-bar-item w3-button w3-white w3-text-blue w3-hover-text-blue w3-hover-white w3-padding-16" style="border-radius: 30px 0px 0px 30px;">
            <span class="fa fa-users w3-margin-left"></span>&nbsp;&nbsp;Advisory class 
        </a>-->


        <a href="<?php echo base_url();?>Teacher/subjects/overview/<?php echo $link; ?>" onclick="w3_close()" class="w3-bar-item w3-button w3-text-white w3-hover-text-blue w3-hover-white w3-padding-16" style="border-radius: 30px 0px 0px 30px;">
            <span class="fa fa-graduation-cap w3-margin-left"></span>&nbsp;&nbsp;Subjects
        </a>



        <a href="<?php echo base_url();?>Teacher/grading/<?php echo $link;?>" onclick="w3_close()" class="w3-bar-item w3-button w3-text-white w3-hover-text-blue w3-hover-white w3-padding-16" style="border-radius: 30px 0px 0px 30px;">
            <span class="fa fa-th-list w3-margin-left"></span>&nbsp;&nbsp;Grades
        </a> 


        <a href="<?php echo base_url();?>Teacher/concerns/<?php echo $link;?>"  onclick="w3_close()" class="w3-bar-item w3-button w3-text-white w3-hover-text-blue w3-hover-white w3-padding-16" style="border-radius: 30px 0px 0px 30px;">
            <span class="fa fa-bookmark w3-margin-left"></span>&nbsp;&nbsp;Concerns <span class="w3-badge w3-circle w3-white" id="counter"></span>
        </a> 


        <!--<a href="<?php echo base_url();?>Teacher/announcement/<?php echo $link;?>" onclick="w3_close()" class="w3-bar-item w3-button w3-text-white w3-hover-text-blue w3-hover-white w3-padding-16" style="border-radius: 30px 0px 0px 30px;">
            <span class="fa fa-bullhorn w3-margin-left"></span>&nbsp;&nbsp;Announcement
        </a> -->

        <a href="<?php echo base_url();?>Teacher/logout/<?php echo $id;?>" onclick="w3_close()" class="w3-bar-item w3-button w3-text-white w3-hover-text-blue w3-hover-white w3-padding-16" style="border-radius: 30px 0px 0px 30px;">
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
	    	<div class="w3-dropdown-click w3-right w3-margin-top">
                <button class="w3-button w3-hover-blue w3-blue fa fa-bell w3-large" onclick="dropdownsmall()"><span class="w3-badge w3-circle w3-red" id="notifsmall"></button>

                <div id="itemssmall" class="w3-dropdown-content w3-bar-block w3-border" style="right: 0; width: 20em"></div>
            </div>
	    	<h3>
	    		<a href="javascript:void(0)" class="fa fa-bars w3-button w3-blue w3-margin-right w3-xlarge w3-left w3-hover-light-blue w3-round" onclick="w3_open()"></a>
	    	</h3>
	  	</span>
	</header>

	<!-- Overlay effect when opening sidebar on small screens -->
	<div class="w3-overlay w3-hide-large" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>
	<!-- END | Top menu on small screens-->

	<br class="w3-hide-large"><br class="w3-hide-large"><br class="w3-hide-large">



<!-- PAGE CONTENT -->
<div class="w3-main w3-animate-right w3-margin-bottom" style="margin-left: 245px;">
  
  	<!-- HEADER -->
  	<div class="w3-container w3-white w3-hide-small w3-hide-medium" style="box-shadow: 2px 0px 5px 1px gray;">
	    <span>
	    	<h3 class="w3-left w3-padding"><b>STUDENT PROFILE</b></h3>
			<div class="w3-dropdown-click w3-right w3-margin-top">
                <button class="w3-button w3-hover-white w3-white fa fa-bell w3-large w3-padding-large" onclick="dropdownlarge()"><span class="w3-badge w3-circle w3-red" id="notiflarge"></button>

                <div id="items" class="w3-dropdown-content w3-bar-block w3-border" style="right: 0; width: 30em"></div>
            </div>
		</span>
  	</div>

  	<!-- MAIN CONTENT -->
  	<div class="w3-container">

  		<div class="w3-container w3-padding w3-border w3-margin-bottom w3-margin-top">
  			

  				<?php
  					//echo "<h4><b>".strtoupper($grade_level)." - ".strtoupper($section)."</b></h4>";

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

  					//echo "<a class='w3-text-blue w3-small' style='text-decoration: none;' href=".base_url()."admin/".$grade."/".str_replace(" ", "%20", $section).">".$section."</a> / <span class='w3-small'>".$fname." ".$lname."</span><hr/>";
  					echo "<a class='w3-text-blue w3-small' style='text-decoration: none;' href='javascript:void()' onclick='goback()'>".$prevlink."</a> / <span class='w3-small'>".$fname." ".$lname."</span>";
  				?>

  				<div class="w3-container w3-border w3-padding-large w3-margin-bottom w3-margin-top">
  					<?php
  						if($stat=='Enrolled'){
		  					$color = 'w3-green';
		  				}else if($stat == 'Dropped'){
		  					$color = 'w3-red';
		  				}else{
		  					$color = 'w3-yellow';
		  				}

                        if($studphoto == ''){
                            $img = '<span class="fa fa-user-circle-o w3-margin-right w3-left" id="img1" style="font-size:7em;"></span>';
                        }else{
                            $img = '<img src="'.base_url().'ProfilePic/Students/'.$studphoto.'" id="img1" class="w3-circle w3-margin-right w3-left" style="max-width:7em; width:100%; max-height:7em">';
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

				<div class="w3-container w3-border w3-padding-large w3-margin-bottom">
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
												echo '<li>'.$sub['subj_title'].'</li>';
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


	function dropdownsmall() {
        var x = document.getElementById("itemssmall");
        if (x.className.indexOf("w3-show") == -1) {
            x.className += " w3-show";
        } else { 
            x.className = x.className.replace(" w3-show", "");
        }
    }

    function dropdownlarge() {
        var x = document.getElementById("items");
        if (x.className.indexOf("w3-show") == -1) {
            x.className += " w3-show";
        } else { 
            x.className = x.className.replace(" w3-show", "");
        }
    }

    //TEACHER
    function LoadAll(a) {
        /*var str = "" + 1;
        var pad = "0000000";
        var x = pad.substring(0, pad.length - str.length) + str;*/
        var x = String(a).padStart(7, '0');

        setInterval(function(){
            
            //NOTIFICATION
            var notificationcounter = new XMLHttpRequest();
            notificationcounter.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("notifsmall").innerHTML = this.responseText;
                    document.getElementById("notiflarge").innerHTML = this.responseText;
                }
            };

            notificationcounter.open("GET", "https://"+window.location.hostname+"/BanquerohanNationalHighSchool/Teacher/notifcounter/"+x, true);
            notificationcounter.send();


            var notificationitems = new XMLHttpRequest();
            notificationitems.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("itemssmall").innerHTML = this.responseText;
                    document.getElementById("items").innerHTML = this.responseText;
                }
            };

            notificationitems.open("POST", "https://"+window.location.hostname+"/BanquerohanNationalHighSchool/Teacher/notifitems/"+x, true);
            notificationitems.send();
            //NOTIFICATION | END


            var countcern = new XMLHttpRequest();
            countcern.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("counter").innerHTML = this.responseText;
                }
            };

            countcern.open("GET", "https://"+window.location.hostname+"/BanquerohanNationalHighSchool/Teacher/countconcern/"+x, true);
            countcern.send();

        }, 1000);
    }
    //TEACHER | END
</script>
</body>