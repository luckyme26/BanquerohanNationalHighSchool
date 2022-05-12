<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<title><?= $title; ?></title>

<body>
<!-- | Sidebar/menu | -->
<nav class="w3-sidebar w3-blue w3-collapse w3-top w3-large w3-animate-left" style="z-index:3;width:13em;font-weight:bold;" id="mySidebar"><br>
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

    <!--| LINKS |-->
    <div class="w3-bar-block">
        <a href="<?php echo base_url();?>Teacher/dashboard/<?php echo $link;?>"  onclick="w3_close()" class="w3-bar-item w3-button w3-text-white w3-hover-text-blue w3-hover-white w3-padding-16" style="border-radius: 30px 0px 0px 30px;">
            <span class="fa fa-dashboard w3-margin-left"></span>&nbsp;&nbsp;Dashboard
        </a>
        <a href="<?php echo base_url();?>Teacher/profile/<?php echo $link;?>" onclick="w3_close()" class="w3-bar-item w3-button w3-white w3-text-blue w3-hover-text-blue w3-hover-white w3-padding-16" style="border-radius: 30px 0px 0px 30px;">
            <span class="fa fa-user-circle-o w3-margin-left"></span>&nbsp;&nbsp;Profile
        </a>

        <?php
            $this->Teachers_model->ifadviser($id, $link);
        ?>

        <a href="<?php echo base_url();?>Teacher/subjects/overview/<?php echo $link; ?>" onclick="w3_close()" class="w3-bar-item w3-button w3-text-white w3-hover-text-blue w3-hover-white w3-padding-16" style="border-radius: 30px 0px 0px 30px;">
            <span class="fa fa-graduation-cap w3-margin-left"></span>&nbsp;&nbsp;Subjects
        </a>

        <a href="<?php echo base_url();?>Teacher/grading/<?php echo $link;?>" onclick="w3_close()" class="w3-bar-item w3-button w3-text-white w3-hover-text-blue w3-hover-white w3-padding-16" style="border-radius: 30px 0px 0px 30px;">
            <span class="fa fa-th-list w3-margin-left"></span>&nbsp;&nbsp;Grading
        </a> 

        <a href="<?php echo base_url();?>Teacher/concerns/<?php echo $link;?>"  onclick="w3_close()" class="w3-bar-item w3-button w3-text-white w3-hover-text-blue w3-hover-white w3-padding-16" style="border-radius: 30px 0px 0px 30px;">
            <span class="fa fa-bookmark w3-margin-left"></span>&nbsp;&nbsp;Concerns
        </a> 

        <a href="<?php echo base_url();?>Teacher/announcement/<?php echo $link;?>" onclick="w3_close()" class="w3-bar-item w3-button w3-text-white w3-hover-text-blue w3-hover-white w3-padding-16" style="border-radius: 30px 0px 0px 30px;">
            <span class="fa fa-bullhorn w3-margin-left"></span>&nbsp;&nbsp;Announcement
        </a> 
        <a href="<?php echo base_url();?>Teacher/logout/<?php echo $id;?>" onclick="w3_close()" class="w3-bar-item w3-button w3-text-white w3-hover-text-blue w3-hover-white w3-padding-16" style="border-radius: 30px 0px 0px 30px;">
            <span class=" fa fa-sign-out w3-margin-left"></span>&nbsp;&nbsp;Log Out
        </a> 
    </div>
    <!--| END OF LINKS |-->
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



<!-- PAGE CONTENT -->
<div class="w3-main w3-animate-right w3-margin-bottom" style="margin-left: 14.5em;">
  
  	<!-- HEADER -->
  	<div class="w3-container w3-white w3-hide-small" style="box-shadow: 2px 0px 5px 1px gray;">
	    <span>
	       <h3 class="w3-left w3-padding"><b></b></h3></span>
	       <span class="fa fa-bell w3-large w3-right w3-padding-large w3-margin-top w3-margin-right"><span class="w3-badge w3-right w3-small w3-red">3</span>
        </span>
  	</div>

  	<!-- MAIN CONTENT -->
  	<div class="w3-container">
	    <div class="w3-padding-6 w3-hide-large w3-hide-medium"><br/><br/><br/></div>
	    <br/>

	    <div class="w3-container w3-card w3-padding w3-round" style="width:70%; margin: auto;">
	    <?php
	    	extract($this->session->userdata('teacher'.$id));
	    ?>
	    <h3>LOG IN CREDENTIALS</h3><hr/>
	    <form action="<?php echo base_url().'Teacher/sendemail/'.$link; ?>" method="post">
	    	<div class="w3-row-padding">
		    	<div class="w3-container w3-half w3-margin-bottom">
		    		<label>ID number:</label>
		    		<input type="text" class="w3-input w3-border w3-round" value="<?php echo $id;?>" placeholder="ID number" disabled>
		    	</div>

		    	<div class="w3-container w3-half w3-margin-bottom">
		    		<label>Password:</label>
		    		<input type="password" class="w3-input w3-border w3-round" name="password" pattern="^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$" placeholder="Password" required>
                    <span class="w3-small"><i>Password must contain atleast special character, number, lowercase letter and Uppercase letter.</i></span>
		    	</div>
		    </div>
		    <div class="w3-container w3-margin-bottom">
		    	<label>Confirmation email:</label>
		    	<input type="email" class="w3-input w3-border w3-round" value="<?php echo $ver_email;?>" placeholder="Confirmation email" disabled>
		    </div>
		    <hr/>
		    <small><b>Note: </b>Please make sure that the email is active.</small>
		    <button class="w3-button w3-block w3-blue w3-section w3-padding w3-round w3-hover-light-blue" type="submit">Save</button>
	    </form>
		</div>

	</div>
</div>

</body>