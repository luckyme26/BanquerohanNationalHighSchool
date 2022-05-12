<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<title><?= $title;?></title>
<?php if(empty($title)){
        redirect(base_url().'Student/dashboard/'.$link);
    } 
?>
<body onload="LoadAll('<?php echo $id; ?>')">
<!-- | Sidebar/menu | -->
<nav class="w3-sidebar w3-blue w3-collapse w3-top w3-large w3-animate-left" style="z-index:3;width:13em;font-weight:bold;" id="mySidebar"><br>
    <div class="w3-container w3-margin-bottom">
        <center>
            <?php
                if($photo == ''){
                    $img = '<span class="fa fa-user-circle-o" style="font-size:6em;"></span>';
                }else{
                    $img = '<img src="'.base_url().'ProfilePic/students/'.$photo.'" load="lazy" class="w3-circle" style="max-width:6em;width:100%;max-height:6em;">';
                }
                echo $img;
            ?>
            <h5 class="w3-text-white"><?php echo strtoupper($name);?></h5>
        </center>
    </div>

    <!--| LINKS |-->
    <div class="w3-bar-block">
        <a href="<?php echo base_url();?>Student/dashboard/<?php echo $link;?>" onclick="w3_close()" class="w3-bar-item w3-button w3-text-white w3-hover-text-blue w3-hover-white w3-padding-16" style="border-radius: 30px 0px 0px 30px;">
            <span class="fa fa-dashboard w3-margin-left"></span>&nbsp;&nbsp;Dashboard
        </a>


        <a href="<?php echo base_url();?>Student/profile/<?php echo $link;?>" onclick="w3_close()" class="w3-bar-item w3-button w3-text-white w3-hover-text-blue w3-hover-white w3-padding-16" style="border-radius: 30px 0px 0px 30px;">
            <span class="fa fa-user-circle-o w3-margin-left"></span>&nbsp;&nbsp;Profile
        </a>


        <?php
            $this->Student_model->ifadviser($section, $gradelvl, $link);
        ?>


        <a href="<?php echo base_url();?>Student/subjects/overview/<?php echo $link; ?>" onclick="w3_close()" class="w3-bar-item w3-button w3-white w3-text-blue w3-hover-text-blue w3-hover-white w3-padding-16" style="border-radius: 30px 0px 0px 30px;">
            <span class="fa fa-graduation-cap w3-margin-left"></span>&nbsp;&nbsp;Subjects
        </a>


        <a href="<?php echo base_url();?>Student/grading/<?php echo $link.'/'.$gradelvl;?>" onclick="w3_close()" class="w3-bar-item w3-button w3-text-white w3-hover-text-blue w3-hover-white w3-padding-16" style="border-radius: 30px 0px 0px 30px;">
            <span class="fa fa-th-list w3-margin-left"></span>&nbsp;&nbsp;Grades
        </a> 


        <a href="<?php echo base_url();?>Student/concerns/<?php echo $link;?>" onclick="w3_close()" class="w3-bar-item w3-button w3-text-white w3-hover-text-blue w3-hover-white w3-padding-16" style="border-radius: 30px 0px 0px 30px;">
            <span class="fa fa-bookmark w3-margin-left"></span>&nbsp;&nbsp;Concerns <span class="w3-badge w3-circle w3-white" id="counter"></span>
        </a> 


        <!--<a href="#" onclick="w3_close()" class="w3-bar-item w3-button w3-text-white w3-hover-text-blue w3-hover-white w3-padding-16" style="border-radius: 30px 0px 0px 30px;">
            <span class="fa fa-bullhorn w3-margin-left"></span>&nbsp;&nbsp;Announcement
        </a>--> 


        <a href="<?php echo base_url();?>Student/logout/<?php echo $id;?>" onclick="w3_close()" class="w3-bar-item w3-button w3-text-white w3-hover-text-blue w3-hover-white w3-padding-16" style="border-radius: 30px 0px 0px 30px;">
            <span class=" fa fa-sign-out w3-margin-left"></span>&nbsp;&nbsp;Log Out
        </a> 
    </div>
    <!--| END OF LINKS |-->
</nav>
<!-- | END of Sidebar/menu | -->

    <!--Top menu on small screens-->
    <header class="w3-container w3-top w3-hide-large w3-blue w3-padding">
        <span>
            <img class="w3-circle w3-right" src="<?php echo base_url()?>resource/img/Logo.png" alt="School Logo" style="max-width:60px; width:100%;">
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
<div class="w3-main" style="margin-left: 14.5em;">
 
    <!-- HEADER -->
    <div class="w3-container w3-white w3-hide-small w3-hide-medium" style="box-shadow: 2px 0px 5px 1px gray;">
        <span>
            <h3 class="w3-left w3-padding"><b>SUBJECTS</b></h3>
        </span>
    </div>
    <!-- END OF HEADER -->



    <!-- MAIN CONTENT -->
    <div class="w3-container">
        <div class="w3-padding-6 w3-hide-large"></div>
        <br/>

        <div class="w3-container w3-border w3-padding w3-margin-bottom">
            <a href="<?php echo base_url(); ?>Student/subjects/overview/<?php echo $link; ?>" class="w3-small w3-text-blue" style="text-decoration: none;">Subjects</a> / <span class="w3-small"><?php echo $title; ?></span>
            <h3><b><?php echo strtoupper($title);?></b></h3>
            
            <p style="text-align: justify;text-indent: 40px;color: #666666;font-style: italic;"><?php echo $desc; ?></p>

            <?php
            /*if($this->session->flashdata('success')){
                echo '<p class="w3-pale-green w3-padding w3-center">'.$this->session->flashdata('success').'</p>';
                header("Refresh:2;url=".base_url()."Teacher/subjects/".$code."/".$link);
            }
            if($this->session->flashdata('error')){
                echo '<p class="w3-padding w3-pale-red w3-center">'.$this->session->flashdata('error').'</p>';
                header("Refresh:2;url=".base_url()."Teacher/subjects/".$code."/".$link);
            }*/
            ?>

            <hr/>

            <div class="w3-margin-bottom">
                <?php
                    $this->Student_model->getSubjectContent($id, $link, $code, $title, $gradelvl, $section);
                ?>
            </div>

        </div>

    </div>
    <!-- MAIN CONTENT | END -->


</div>
<!-- End PAGE CONTENT -->

<script type="text/javascript">
    function showButtons(x){
        
        var message = document.getElementById("message"+x);
    
        message.className -= "w3-hide";
        message.className += " w3-button w3-round-large w3-blue w3-hover-pale-blue w3-display-middle w3-animate-opacity w3-small ";
    }

    function hideButtons(x){

        var message = document.getElementById("message"+x);
       
        message.className += "w3-hide";
    }

    //STUDENT
    function LoadAll(a) {
        /*var str = "" + a;
        var pad = "000000000000";
        var x = pad.substring('0', pad.length - str.length) + str;*/
        //
        var z = parseInt(a.toString(8), 10);
        var x = String(z).padStart(12, '0');
        
        setInterval(function(){
            
            var countcern = new XMLHttpRequest();
            countcern.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("counter").innerHTML = this.responseText;
                }
            };

            countcern.open("GET", "https://"+window.location.hostname+"/BanquerohanNationalHighSchool/Student/countconcern/"+x, true);
            countcern.send();
        }, 1000);
    }
    //STUDENT | END
</script>

</body>
<!-- Mirrored from www.w3schools.com/w3css/tryit.asp?filename=tryw3css_templates_interior_design&stacked=h, 2017-07-01 04:11:38 GMT -->
