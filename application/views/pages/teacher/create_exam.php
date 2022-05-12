<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<title><?= $title;?></title>
<style>
    pre{
        font-family: 'Poppins', 'Arial';
        font-weight: normal;
        font-size: 16px;
    }
    table {
        border-collapse: collapse;
        width: 100%;
    }
    th, td {
        text-align: left;
        padding: 8px;
    }
</style>
<body onload="LoadAll('<?php echo $id; ?>')">
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
        <a href="<?php echo base_url();?>Teacher/dashboard/<?php echo $link;?>" onclick="w3_close()" class="w3-bar-item w3-button w3-text-white w3-hover-text-blue w3-hover-white w3-padding-16" style="border-radius: 30px 0px 0px 30px;">
            <span class="fa fa-dashboard w3-margin-left"></span>&nbsp;&nbsp;Dashboard
        </a>


        <a href="<?php echo base_url();?>Teacher/profile/<?php echo $link;?>" onclick="w3_close()" class="w3-bar-item w3-button w3-text-white w3-hover-text-blue w3-hover-white w3-padding-16" style="border-radius: 30px 0px 0px 30px;">
            <span class="fa fa-user-circle-o w3-margin-left"></span>&nbsp;&nbsp;Profile
        </a>


        <?php
            $this->Teachers_model->ifadviser($id, $link);
        ?>


        <a href="<?php echo base_url();?>Teacher/subjects/overview/<?php echo $link; ?>" onclick="w3_close()" class="w3-bar-item w3-button w3-white w3-text-blue w3-hover-text-blue w3-hover-white w3-padding-16" style="border-radius: 30px 0px 0px 30px;">
            <span class="fa fa-graduation-cap w3-margin-left"></span>&nbsp;&nbsp;Subjects
        </a>


        <a href="<?php echo base_url();?>Teacher/grading/<?php echo $link;?>" onclick="w3_close()" class="w3-bar-item w3-button w3-text-white w3-hover-text-blue w3-hover-white w3-padding-16" style="border-radius: 30px 0px 0px 30px;">
            <span class="fa fa-th-list w3-margin-left"></span>&nbsp;&nbsp;Grades
        </a> 


        <a href="<?php echo base_url();?>Teacher/concerns/<?php echo $link;?>" onclick="w3_close()" class="w3-bar-item w3-button w3-text-white w3-hover-text-blue w3-hover-white w3-padding-16" style="border-radius: 30px 0px 0px 30px;">
            <span class="fa fa-bookmark w3-margin-left"></span>&nbsp;&nbsp;Concerns <span class="w3-badge w3-circle w3-white" id="counter"></span>
        </a> 


        <!--<a href="<?php echo base_url();?>Teacher/announcement/<?php echo $link;?>" onclick="w3_close()" class="w3-bar-item w3-button w3-text-white w3-hover-text-blue w3-hover-white w3-padding-16" style="border-radius: 30px 0px 0px 30px;">
            <span class="fa fa-bullhorn w3-margin-left"></span>&nbsp;&nbsp;Announcement
        </a>--> 


        <a href="<?php echo base_url();?>Teacher/logout/<?php echo $id;?>" onclick="w3_close()" class="w3-bar-item w3-button w3-text-white w3-hover-text-blue w3-hover-white w3-padding-16" style="border-radius: 30px 0px 0px 30px;">
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
                <a href="javascript:void(0)" class="fa fa-bars w3-button w3-blue w3-xlarge w3-left w3-hover-light-blue w3-round" onclick="w3_open()"></a>SUBJECTS
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
            <h3>EXAM CREATION</h3><hr/>

            <?php
                echo '<p><b>Title:</b> '.$title.'<br/>';
                echo '<b>Duration:</b> '.$duration.' minutes<br/>';
                echo '<b>Deadline:</b> '.date('M. j, Y h:i A', strtotime($due)).' <br/>';
                echo '<b>Attempt/s:</b> '.$attempt.'<br/>';
                echo '<b>Content:</b> '.$noOftypes.' type/s of exam</p><hr/>';

                echo '<form action="'.base_url().'Teacher/postcreateexam/'.$link.'/'.$title.'/'.$duration.'/'.$due.'/'.$attempt.'/'.$noOftypes.'/'.$subj_code.'/'.$sect.'/'.$gr.'/'.$lesson.'" method="post">';
                for ($a=1; $a <= $noOftypes; $a++) {
                    echo '<div class="w3-margin-bottom w3-border w3-padding">
                            <b>PART '.$a.'</b>
                            <div class="w3-row-padding">
                                <div class="w3-third w3-margin-bottom">
                                    <select id="typesofquestion'.$a.'" class="w3-select w3-border w3-round" name="types[]" required>
                                        <option value="" selected disabled> Choose type...</option>
                                        <option value="multiplechoice"> Multiple Choice</option>
                                        <option value="identification"> Identification</option>
                                        <option value="enumeration"> Enumeration</option>
                                        <option value="matchingtype"> Matching type</option>
                                        <option value="true or false"> True of False</option>
                                    </select>
                                </div>
                                <div class="w3-third w3-margin-bottom">
                                    <input type="number" class="w3-input w3-border w3-round" name="items[]" min="2" placeholder="No. of items" required id="number'.$a.'">
                                </div>
                            </div>
                        </div>';
                }
                echo '<input type="submit" class="w3-button w3-blue w3-round w3-hover-light-blue" value="Proceed"></form>';
            ?>

        </div>
    </div> 

</div>

<!-- End PAGE CONTENT -->
<script src="<?= base_url(); ?>resource/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
    /*function hm(a){
        var b = 0;
        for(b = 1; b <= a; b++){
            var y = document.getElementById('number'+b).value;
            var z = document.getElementById('typesofquestion'+b).value;

            if(y != '' && z != ''){

                window.alert(z);
            }
        }
        
        
        $('input[type=checkbox]').on('change', function(e){
        if($('input[type=checkbox]:checked').length > y){
            $(this).prop('checked', false);
        }
        });
        
        
            switch(z){
                case 'multiplechoice':
                    document.getElementById('multiplechoice').style.display = 'block';
                    var mult = new XMLHttpRequest();
                    mult.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            document.getElementById("multquestions").innerHTML = this.responseText;
                        }
                    };

                    mult.open("POST", "https://"+window.location.hostname+"/BanquerohanNationalHighSchool/Teacher/questions/"+z+"/"+a, true);
                    mult.send();
                break;


                case 'identification':
                    document.getElementById('identification').style.display = 'block';
                    var ident = new XMLHttpRequest();
                    ident.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            document.getElementById("identquestions").innerHTML = this.responseText;
                        }
                    };

                    ident.open("POST", "https://"+window.location.hostname+"/BanquerohanNationalHighSchool/Teacher/questions/"+z+"/"+a, true);
                    ident.send();
                break;
            }  
    }*/

    


    $('select').on('change', function(){
        //to enable the disabled
        $('option[disabled]').prop('disabled', false);

        //loop each select
        $('select').each(function(){

            //to disable on every select the selected option
            $('select').not(this).find('option[value="' + this.value + '"]').prop('disabled', true);
        });
    });


    //TEACHER
    function LoadAll(a) {
        var x = String(a).padStart(7, '0');

        setInterval(function(){
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
<!-- Mirrored from www.w3schools.com/w3css/tryit.asp?filename=tryw3css_templates_interior_design&stacked=h, 2017-07-01 04:11:38 GMT -->
