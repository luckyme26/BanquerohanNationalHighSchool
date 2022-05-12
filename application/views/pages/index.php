<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<title><?= $title;?></title>
<!-- | CONTENT | -->
<body class="w3-white">
    <!-- Navbar | ON LARGE SCREEN | (sit on top) -->
    <nav>
        <div class="w3-top w3-margin-bottom">
		    <div class="w3-bar w3-blue w3-padding w3-text-white" style="box-shadow: 2px 0px 5px 1px grey">
			    <img class="w3-circle w3-left" load="lazy" src="<?= base_url();?>resource/img/logo.png" alt="School Logo" style= "max-width:70px;width:100%">
			    <h1 class="w3-left w3-margin-left w3-hide-small w3-hide-medium">BANQUEROHAN NATIONAL HIGH SCHOOL</h1>
                <!--<h3 class="w3-left w3-margin-left w3-hide-small w3-hide-large">BANQUEROHAN NATIONAL HIGH SCHOOL</h3>-->

    			<div class="w3-container w3-margin-top w3-right">
    				<a href="#about us" class="w3-bar-item w3-button w3-margin-bottom w3-round w3-hover-blue" style="font-size:12px">About Us</a>
    				        
                    <a href="#contacts" class="w3-bar-item w3-button w3-margin-bottom w3-round w3-hover-blue" style="font-size:12px">Contacts</a>
    				        
                    <a onclick="document.getElementById('LogInModal').style.display='block'" class="w3-bar-item w3-button w3-margin-bottom w3-round w3-hover-blue" style="font-size:12px;">Log In&nbsp;
                        <span class="fa fa-sign-in"></span>
    				</a>
    			</div>
		    </div>
		</div>
	</nav>
    <!-- END Navbar | ON LARGE SCREEN | (sit on top) -->

<!-- | PAGE CONTENT | -->
<div class="w3-container">
<br/>

  <!-- LOG IN Section | MODAL -->
    <div class="w3-container">
        <div id="LogInModal" class="w3-modal">
            <div class="w3-modal-content w3-card-4 w3-animate-top w3-white w3-round" style="max-width:600px">
                <header class="w3-container w3-blue">
          		      <span onclick="document.getElementById('LogInModal').style.display='none'" class="w3-button w3-display-topright w3-blue w3-hover-light-blue" title="Close Modal">&times;</span>
                    <h3>LOG IN</h3>
                </header>

                <!-- | LOG IN FORM FOR ADMIN|INSTRUCTOR|STUDENT | -->
                <div class="w3-container">
                    <center><span class="fa fa-user-circle-o w3-padding w3-jumbo"></span></center>

                    <form method="post" action="<?php echo base_url();?>Pages/verify">
                        <div class="w3-section">
                            <input class="w3-input w3-border w3-margin-bottom w3-round" type="text" placeholder="ID number" name="IDnum" maxlength="12" required>

                            <input class="w3-input w3-border w3-round" type="password" placeholder="Password" name="password" pattern="\S+" required>

                            <button class="w3-button w3-block w3-blue w3-section w3-padding w3-round w3-hover-light-blue" type="submit">Login</button>
                        </div>
                    </form>

                    <?php
                        if($this->session->flashdata('error')){
                    ?>
                        <div class="w3-panel w3-pale-red w3-center">
                            <?php echo $this->session->flashdata('error'); ?>
                        </div>
                    <?php
                        }
                    ?>
                </div>
                <div class="w3-container w3-padding w3-blue">
                    <span class="w3-right w3-padding"> <a href="<?php echo base_url()?>Pages/forgotpassword">Forgot password?</a></span>
                </div>
                <!-- | END OF LOG IN FORM FOR ADMIN|INSTRUCTOR|STUDENT | -->
            </div>
        </div>
    </div>
    <!-- Sign In Section | MODAL END -->


    <div class="w3-display-container w3-content w3-wide w3-hide-small" style="max-width:1600px;min-width:400px;"><br><br><br><br>
        <img class="w3-image" src="<?= base_url();?>resource/img/BNHS.png" load="lazy" alt="School" style="width:100%">
    </div>

    <div class="w3-display-container w3-content w3-wide w3-hide-large w3-hide-medium" style="max-width:600px;"><br><br><br>
        <img class="w3-image" src="<?= base_url();?>resource/img/BNHS.png" load="lazy" alt="School" style="width:100%">
    </div>

    <div class="w3-margin-top w3-topbar w3-border-blue"></div>
    <br/>
  
  <!-- MVVS -->
    <!-- LARGE -->
    <div class="w3-row-padding w3-padding-16 w3-card-2 w3-round w3-white">
        <div class="w3-col m4 w3-margin-bottom">
            <div class="w3-round">
                <div class="w3-container">
                    <h2 class="w3-center w3-blue">MISSION</h2>
                    <p class="w3-justify" style="text-indent: 25px;">To protect and promote the right of every Filipino to quality, equitable, culture-based, and complete basic education where:
                      	<p class="w3-center">Students learn in a child-friendly, gender-sensitive, safe, and motivating environment.</p>
                        <p class="w3-center">Teachers facilitate learning and constantly nurture every learner.</p>
                        <p class="w3-center">Administrators and staff, as stewards of the institution, ensure an enabling and supportive environment for effective learning to happen.</p>
                        <p class="w3-center">Family, community, and other stakeholders are actively engaged and share responsibility for developing life-long learnes.</p>
                    </p>
                </div>
            </div>
        </div>
      
        <div class="w3-col m4 w3-margin-bottom">
            <div class="w3-round">
                <div class="w3-container">
                    <h2 class="w3-center w3-blue">VISION</h2>
                    <p class="w3-justify" style="text-indent: 25px;"> We dream of Filipinos
                    who passionately love their country and whose values and competencies enable them to realize their full potential and contribute meaningfully to building the nation. As a learner-centered public institutionn, the Department of Education continuously imrpoves itself to better serve its stakeholders.
                    </p>
                </div>
            </div>
        </div>

        <div class="w3-col m4">
            <div class="w3-round">
                <div class="w3-container">
                    <h2 class="w3-center w3-blue">CORE VALUES</h2>
                    <p class="w3-center">MAKA-DIYOS<br>
                      MAKA-TAO<br>
                      MAKAKALIKASAN<br>
                      MAKABANSA
                    </p>
                </div>
            </div>
        </div>
    </div>


  <!-- SMALL -->
  <!--  
  <div class="w3-row-padding w3-padding-16 w3-card-2 w3-round w3-hide-large">
    <div class="w3-col m4 w3-margin-bottom">
      <div class="w3-round">
        <div class="w3-container w3-pale-blue">
          <h5 class="w3-center"><b>MISSION</b></h5>
          <p class="w3-justify" style="text-indent: 25px;">To protect and promote the right of every Filipino to quality, equitable, culture-based, and complete basic education where:
            <p class="w3-center">Students learn in a child-friendly, gender-sensitive, safe, and motivating environment.</p>
            <p class="w3-center">Teachers facilitate learning and constantly nurture every learner.</p>
            <p class="w3-center">Administrators and staff, as stewards of the institution, ensure an enabling and supportive environment for effective learning to happen.</p>
            <p class="w3-center">Family, community, and other stakeholders are actively engaged and share responsibility for developing life-long learnes.</p>
         </p>
        </div>
      </div>
    </div>
    
    <div class="w3-col m4 w3-margin-bottom">
      <div class="w3-round">
        <div class="w3-container w3-pale-blue">
          <h5 class="w3-center"><b>VISION</b></h5>
          <p class="w3-justify" style="text-indent: 25px;"> We dream of Filipinos
            who passionately love their country and whose values and competencies enable them to realize their full potential and contribute meaningfully to building the nation. As a learner-centered public institutionn, the Department of Education continuously imrpoves itself to better serve its stakeholders.
          </p>
        </div>
      </div>
    </div>

    <div class="w3-col m4">
      <div class="w3-round">
        <div class="w3-container w3-pale-blue">
          <h5 class="w3-center"><b>CORE VALUES</b></h5>
          <p class="w3-center">MAKA-DIYOS<br>
            MAKA-TAO<br>
            MAKAKALIKASAN<br>
            MAKABANSA
          </p>
        </div>
      </div>
    </div>
  </div>-->
  <!-- END OF MVVS -->

    <a id="about us"></a>
    <br/>
    <!-- ABOUT US -->
    <div class="w3-row-padding w3-padding-16 w3-card-2 w3-round w3-white">
        <div class="w3-col m4 w3-margin-top w3-center">
            <img src="<?php base_url()?>resource/img/logo.png" class="w3-circle w3-image" alt="School logo" style="max-width:60%;">
        </div>

        <div class="w3-col m8">
            <h2>ABOUT US</h2>
            <div class="w3-panel w3-pale-blue">
              <span style="font-size:150px;line-height:0.6em;opacity:0.3">❝</span>
              <p class="w3-justify" style="text-indent: 25px;margin-top:-50px;">The Banquerohan National High School was opened through the request of the parents and barangay council of Banquerohan and the residents of the neighboring barangays who believed that the start of the secondary education whithin the locality would improve the quality of life of the depressed, disadvantaged and underpriviliged (DDU) catchment barangays.</p>

              <p class="w3-justify" style="text-indent: 25px;">The preparation was done in 1989 through a formal request and constant follow-up with the then City Mayor Benny Imperial. June 4, 1990 marked the formal opening of the school. Republic Act 07043, An Act establishing a High Shcool in Banquerohan, Legazpi City, to be known as the <strong>Banquerohan High School</strong>, and appropriating funds therefore, was approved on June 19, 1991.</p>
            </div>
        </div>
    </div>
    <!-- END OF ABOUT US -->

    <!-- CONTACT US -->
    <a id="contacts"></a>
    <br/>
    <div class="w3-padding-16 w3-card-2 w3-round w3-white">
        <div class="w3-container" style="max-width:900px; margin: auto;">
            <h2 class="w3-wide w3-center">CONTACT US</h2>
            <div class="w3-center w3-margin-bottom">
                <span class="fa fa-map-marker" style="width:30px"></span>Zone 2 Banquerohan, Legazpi City<br>
                <i class="fa fa-phone" style="width:30px"></i>09760353090<br>
                <i class="fa fa-envelope" style="width:30px"></i><a href="mailto:302257@deped.gov.ph" style="text-decoration: none;">302257@deped.gov.ph</a><br>
                <i class="fa fa-globe" style="width:30px"></i><a href="http://deped.in/BNHSLegazpiCity" target="_blank" style="text-decoration: none;">BNHS DepEd site</a>
            </div>
        </div>
    </div>
    <!-- END | CONTACT US -->

</div>
<br/>
<footer class="w3-center w3-pale-blue w3-padding">
    <p><small>Banquerohan National High School <i class="fa fa-copyright"></i> <?php echo date("Y"); ?></small></p>
</footer>
</body>