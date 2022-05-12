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


        <a href="<?php echo base_url();?>Teacher/concerns/<?php echo $link;?>"  onclick="w3_close()" class="w3-bar-item w3-button w3-text-white w3-hover-text-blue w3-hover-white w3-padding-16" style="border-radius: 30px 0px 0px 30px;">
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
                echo '<b>Deadline:</b> '.date('M. j, Y h:i A', strtotime($due)).'<br/>';
                echo '<b>Attempt/s:</b> '.$attempt.'<br/>';
                echo '<b>Content:</b> '.$noOftypes.' type/s of exam</p><hr/>';

                echo '<form action="'.base_url().'Teacher/saveexam/'.$link.'/'.$title.'/'.$duration.'/'.$due.'/'.$attempt.'/'.$noOftypes.'/'.$subj_code.'/'.$sect.'/'.$gr.'/'.$lesson.'/'.$typesofquestion.'" method="post" enctype="multipart/form-data">';
                $types = explode("_", $typesofquestion);
                $numberofitems = explode("_", $noOfitems);

                for ($a=0; $a < $noOftypes; $a++) {
                    $prt = $a+1;
                    echo '<div class="w3-margin-bottom w3-border w3-padding">
                            <p><b>PART '.$prt.': '.strtoupper($types[$a]).'</b></p>';

                            switch($types[$a]){
                                case 'multiplechoice':
                                    
                                    for ($b = 0; $b < $numberofitems[$a]; $b++) {
                                        $num = $b+1;
                                       
                                        echo '<p><b>'.$num.'.</b> '.$mult[$b]['question'].'</p>';

                                        if(!empty($questimage['name'][$b]['qimage'])){

                                            $dir = str_replace(":", "-", $subj_title).'_'.$gr.'/'.str_replace("?", " qmark", $mult[$b]['question']).'/';

                                            $qpic = $questimage['name'][$b]['qimage'];
                                            $expname = explode(".", $qpic);
                                            $newpic = str_replace("?", " qmark", $mult[$b]['question']).'_'.$expname[0].".".end($expname);
                                            
                                            echo '<img src="'.base_url().$dir.$newpic.'" class="w3-image" style="max-width:12em;width:100%;max-height:12em;" load="lazy"><br/><br/>';

                                            echo '<input type="hidden" name="questimg['.$b.'][qimage]" value="'.$newpic.'">';
                                        }

                                        echo '<input type="hidden" name="mult['.$b.'][question]" value="'.$mult[$b]['question'].'">';

                                        for ($c = 1; $c <= 4; $c++) {
                                            
                                            if($mult[$b]['correct'] == $mult[$b][$c]){
                                               $selected = 'checked';
                                            }else{
                                                $selected = '';
                                            }
                                            
                                            echo '<input type="hidden" name="mult['.$b.']['.$c.']" value="'.$mult[$b][$c].'">';

                                            if(!empty($questimage['name'][$b]['choice'.$c])){

                                                $adir = str_replace(":", "-", $subj_title).'_'.$gr.'/'.str_replace("?", " qmark", $mult[$b]['question']).'/';
                                            
                                                $cpic = $questimage['name'][$b]['choice'.$c];
                                                $cexpname = explode(".", $cpic);
                                                $cnewpic = $mult[$b][$c].'_'.$cexpname[0].".".end($cexpname);

                                                echo '<input type="radio" '.$selected.' disabled> ';
                                                echo '<img src="'.base_url().$adir.$cnewpic.'" style="max-width:10em;width:100%;max-height:10em;" load="lazy"><br/>';

                                                 echo '<input type="hidden" name="questimg['.$b.'][choice'.$c.']" value="'.$cnewpic.'">';

                                            }else{
                                                echo '<input type="radio" '.$selected.' disabled> '.$mult[$b][$c].'<br/>';
                                            }

                                        }
                                        echo '<input type="hidden" name="mult['.$b.'][correct]" value="'.$mult[$b]['correct'].'">';
                                        //echo '</p>';
                                        /*for ($c = 1; $c <= 4; $c++) {
                                            
                                            if($mult[$b]['question']['correct'] == $mult[$b]['correct'][$c]){
                                               $selected = 'checked';
                                            }else{
                                                $selected = '';
                                            }
                                            echo '<input type="radio" '.$selected.' disabled> '.$mult[$b]['correct'][$c].'<br/>';
                                            echo '<input type="hidden" name="mult['.$b.']['.$c.']" value="'.$mult[$b]['correct'][$c].'">';
                                        }
                                        echo '<input type="hidden" name="mult['.$b.'][question][correct]" value="'.$mult[$b]['question']['correct'].'">';*/
                                        //echo '</p>';
                                    }
                                    
                                break;

                                case 'enumeration':
                                    echo '<p><b>Instruction: </b>'.$enum[0]['instruction'].'</p>';
                                    echo '<input type="hidden" name="enum[0][instruction]" value="'.$enum[0]['instruction'].'">';
                                    for ($b = 1; $b <= $numberofitems[$a]; $b++) {
                                        $num = $b;
                                        
                                        echo '<p><b>'.$num.'.</b> '.$enum[$b]['question'].'<br/>';
                                        echo '<input type="hidden" name="enum['.$b.'][question]" value="'.$enum[$b]['question'].'">';
                                        echo '<b>Answer: </b>'.$enum[$b]['correct'];
                                        echo '<input type="hidden" name="enum['.$b.'][correct]" value="'.$enum[$b]['correct'].'">';
                                        echo '</p>';
                                        $num++;
                                    }
                                    
                                break;

                                case 'identification':
                                    for ($b = 0; $b < $numberofitems[$a]; $b++) {
                                        $num = $b+1;
                                        echo '<p><b>'.$num.'.</b> '.$ident[$b]['question'];
                                        echo '<input type="hidden" name="ident['.$b.'][question]" value="'.$ident[$b]['question'].'">';
                                        echo '<input type="hidden" name="ident['.$b.'][correct]" value="'.$ident[$b]['correct'].'">';
                                        
                                            echo '<select class="w3-select w3-border w3-round" disabled>';
                                                echo '<option>'.$ident[$b]['correct'].'</option>';
                                            echo '</select>
                                        </p>';
                                        
                                        $num++;
                                    }
                                    
                                break;

                                case 'matchingtype':
                                    for ($b = 0; $b < $numberofitems[$a]; $b++) {
                                        $num = $b+1;
                                        echo '<p><b>'.$num.'.</b> '.$match[$b]['question'];
                                        echo '<input type="hidden" name="match['.$b.'][question]" value="'.$match[$b]['question'].'">';
                                        echo '<input type="hidden" name="match['.$b.'][correct]" value="'.$match[$b]['correct'].'">';
                                        
                                            //echo '<select class="w3-select w3-border w3-round" disabled>';
                                                echo '<input type="text" class="w3-input w3-border w3-round" value="'.$match[$b]['correct'].'" disabled>';
                                            echo '
                                        </p>';
                                        
                                        $num++;
                                    }
                                    
                                break;

                                case 'true or false':
                                    for ($b = 0; $b < $numberofitems[$a]; $b++) {
                                        $num = $b+1;
                                        $selected = '';
                                        echo '<p><b>'.$num.'.</b> '.$truefalse[$b]['question'].'<br/>';
                                        echo '<input type="hidden" name="truefalse['.$b.'][question]" value="'.$truefalse[$b]['question'].'">';
                                        
                                        if($truefalse[$b]['correct']){
                                            $selected = 'checked';
                                        }else{
                                            $selected = '';
                                        }
                                        echo '<input type="radio" '.$selected.' disabled> '.$truefalse[$b]['correct'].'<br/>';
                                        echo '<input type="hidden" name="truefalse['.$b.'][correct]" value="'.$truefalse[$b]['correct'].'">';
                                        
                                        echo '<input type="hidden" name="truefalse['.$b.'][correct]" value="'.$truefalse[$b]['correct'].'">';
                                        echo '</p>';
                                        
                                        $num++;
                                    }
                                    
                                    
                                break;
                            }
                            
                            
                    echo '</div>';
                }

                //echo '<a href="javascript:void(0)" class="w3-button w3-round w3-blue w3-hover-light-blue" onclick="goback()">Back</a> ';
                echo '<input type="submit" class="w3-button w3-round w3-blue w3-hover-light-blue" value="Save">';
                echo '</form>';
            ?>

        </div>
    </div>

</div>
<!-- End PAGE CONTENT -->
<script type="text/javascript">
function toRadiobutton(x) {
    if(document.getElementById("correct"+x).checked == true){
        document.getElementById("correct"+x).value = document.getElementById("laman"+x).value;
    }
}

function goback(){
    window.history.back();
}


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
