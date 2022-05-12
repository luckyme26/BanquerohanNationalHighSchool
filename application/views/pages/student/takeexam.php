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
</style>
<body onload="haha(<?php echo $duration; ?>)">
<!-- | Sidebar/menu | -->
<nav class="w3-sidebar w3-blue w3-collapse w3-top w3-large w3-animate-left" style="z-index:3;width:13em;font-weight:bold;" id="mySidebar"><br>
    <div class="w3-container w3-margin-bottom">
        <center>
            <?php
                if($photo == ''){
                    $img = '<span class="fa fa-user-circle-o" style="font-size:6em;"></span>';
                }else{
                    $img = '<img src="'.base_url().'ProfilePic/students/'.$photo.'" class="w3-circle" style="max-width:6em;width:100%;max-height:6em;">';
                }
                echo $img;
            ?>
            <h5 class="w3-text-white"><?php echo strtoupper($name);?></h5>
        </center>
    </div>

    <!--| LINKS |-->
    <div class="w3-bar-block">
        <a href="<?php echo base_url();?>Student/dashboard/<?php echo $link;?>"  onclick="w3_close()" class="w3-bar-item w3-button w3-text-white w3-hover-text-blue w3-hover-white w3-padding-16" style="border-radius: 30px 0px 0px 30px;">
            <span class="fa fa-dashboard w3-margin-left"></span>&nbsp;&nbsp;Dashboard
        </a>
        

        <a href="<?php echo base_url();?>Student/profile/<?php echo $link;?>" onclick="w3_close()" class="w3-bar-item w3-button w3-text-white w3-hover-text-blue w3-hover-white w3-padding-16" style="border-radius: 30px 0px 0px 30px;">
            <span class="fa fa-user-circle-o w3-margin-left"></span>&nbsp;&nbsp;Profile
        </a>

        
        <?php
            $this->Student_model->ifadviser($section, $grade, $link);
        ?>

        
        <a href="<?php echo base_url();?>Student/subjects/overview/<?php echo $link; ?>" onclick="w3_close()" class="w3-bar-item w3-button w3-white w3-text-blue w3-hover-text-blue w3-hover-white w3-padding-16" style="border-radius: 30px 0px 0px 30px;">
            <span class="fa fa-graduation-cap w3-margin-left"></span>&nbsp;&nbsp;Subjects
        </a>

        
        <a href="<?php echo base_url();?>Student/grading/<?php echo $link;?>" onclick="w3_close()" class="w3-bar-item w3-button w3-text-white w3-hover-text-blue w3-hover-white w3-padding-16" style="border-radius: 30px 0px 0px 30px;">
            <span class="fa fa-th-list w3-margin-left"></span>&nbsp;&nbsp;Grading
        </a> 

        
        <a href="<?php echo base_url();?>Student/concerns/<?php echo $link;?>"  onclick="w3_close()" class="w3-bar-item w3-button w3-text-white w3-hover-text-blue w3-hover-white w3-padding-16" style="border-radius: 30px 0px 0px 30px;">
            <span class="fa fa-bookmark w3-margin-left"></span>&nbsp;&nbsp;Concerns
        </a> 

        <!--<a href="<?php echo base_url();?>Student/announcement/<?php echo $link;?>" onclick="w3_close()" class="w3-bar-item w3-button w3-text-white w3-hover-text-blue w3-hover-white w3-padding-16" style="border-radius: 30px 0px 0px 30px;">
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
              <a href="javascript:void(0)" class="fa fa-bars w3-button w3-blue w3-xlarge w3-left w3-hover-light-blue w3-round" onclick="w3_open()"></a></h3>
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
            <h3 class="w3-left w3-padding"></h3>
        </span>  
    </div>
    <!-- END OF HEADER -->



    <!-- MAIN CONTENT -->

    <div class="w3-container">
        <div class="w3-padding-6 w3-hide-large"></div>
        <br/>

        <div class="w3-container w3-border w3-padding w3-margin-bottom">
            <span class="w3-small">Subjects</span> / <span class="w3-small"><?php echo $subj; ?></span> / <span class="w3-small"><?php echo $title; ?></span>
                  

            <?php
                echo '<div class="w3-container">';
                    echo '<h3 style="display: inline-block"><b>'.strtoupper($title).'</b></h3><span style="display: inline-block" class="w3-container w3-light-blue w3-right w3-padding w3-round w3-margin-top"><b>Timer: </b><span id="timer">'.$duration.':00</span></span>';

                    echo '<form action="'.base_url().'Student/submitexam/'.$link.'/'.$subj.'/'.$subj_code.'/'.$lesson.'/'.$grade.'/'.$section.'/'.$title.'" method="post" target="_self" name="examform">';

                    $types = explode(", ", $types);
                    $cont = explode(" + ", $content);

                    for ($z=0; $z < count($cont); $z++) { 
                        $part[$z] = explode(" => ", $cont[$z]);
                    }


                    for($a = 0; $a < count($types); $a++){
                        $types[$a] = str_replace("{", "", str_replace("}", "", str_replace("%20", " ", $types[$a])));
                        $prt = $a+1;
                        echo '<div class="w3-margin-bottom w3-border w3-padding">
                                <p><b>PART '.$prt.': '.strtoupper($types[$a]).'</b></p>';

                                switch($types[$a]){
                                    case 'multiplechoice':
                                    
                                        $contpart = explode(", ", str_replace("[", "", str_replace("]", "", $part[$a][1])));

                                        for ($b=0; $b < count($contpart); $b++) {
                                            $contdata[$b] = explode(" _ ", $contpart[$b]);
                                            
                                            for ($c=0; $c < count($contdata[$b]); $c++) { 
                                                if($c == 0){
                                                    $contdata[$b]['question'] = $contdata[$b][$c];
                                                    unset($contdata[$b][$c]);
                                                }
                                                if($c+1 == count($contdata[$b])){
                                                    $lm = explode(" img ", $contdata[$b][$c]);
                                                    $contdata[$b]['correct'] = str_replace(" = ", "", $lm[0]);
                                                    unset($contdata[$b][$c]);
                                                }
                                            }
                                        }

                                        for ($b = 0; $b < count($contpart); $b++) {
                                            $num = $b+1;
                                            
                                            $qi = explode(" img ", $contdata[$b]['question']);

                                            echo '<div class="w3-container w3-light-grey w3-margin-bottom">
                                                    <pre><b>'.$num.'.</b> '.$qi[0].'</pre>
                                                    <div class="w3-container w3-margin-right">';
                                            $dir = $subj.'_'.$grade.'/';
                                            
                                            if(isset($qi[1])){
                                                echo '<img src="'.base_url().$dir.str_replace("?", " qmark", $qi[0]).'/'.$qi[1].'" class="w3-image" style="max-width:10em;width:100%;max-height:10em;" load="lazy"><br/><br/>';
                                            }

                                            for ($c = 1; $c <= 4; $c++) {
                                                $lm = explode(" img ", $contdata[$b][$c]);

                                                if(isset($lm[1])){
                                                    echo '<label><input type="radio" name="multanswer['.$b.']" value="'.$lm[0].'"> </label> <img src="'.base_url().$dir.str_replace("?", " qmark", $qi[0]).'/'.$lm[1].'" class="w3-image" style="max-width:10em;width:100%;max-height:10em;" load="lazy"><br/>';
                                                }else{
                                                    echo '<label><input type="radio" name="multanswer['.$b.']" value="'.$contdata[$b][$c].'"> '.$lm[0].'</label><br/>';
                                                }

                                                //echo '<label><input type="radio" name="multanswer['.$b.']" value="'.$contdata[$b][$c].'"> '.$contdata[$b][$c].'</label><br/>';
                                            }
                                            echo '</div></div>';
                                        }
                                        
                                    break;

                                    ############################################################################################################
                                    ############################################################################################################

                                    case 'enumeration':
                                        $contpart = explode(", ", str_replace("[", "", str_replace("]", "", $part[$a][1])));
                                        $contdata['instruction'] = $contpart[0];
                                        for ($b=1; $b < count($contpart); $b++) { 
                                            $contdata[$b] = explode(" = ", $contpart[$b]);

                                            $contdata[$b]['question'] = $contdata[$b][0];
                                            unset($contdata[$b][0]);
                                        }

                                        echo '<pre><b>Instruction: </b>'.$contdata['instruction'].'</pre>';
                                        for ($b = 1; $b < count($contpart); $b++) {
                                            $num = $b;
                                            
                                            echo '<div class="w3-container w3-light-grey w3-margin-bottom">
                                                    <pre><b>'.$num.'.</b> '.$contdata[$b]['question'].'</pre>';
                                            echo '<div class="w3-container w3-margin-right w3-margin-bottom"><input type="text" class="w3-input w3-border w3-round" name="enumanswer['.$b.']" placeholder="Separate your answers with comma" autocomplete="off"></div>';
                                            echo '</div>';
                                            $num++;
                                        }
                                        
                                    break;

                                    ############################################################################################################
                                    ############################################################################################################

                                    case 'identification':

                                        $contpart = explode(", ", str_replace("[", "", str_replace("]", "", $part[$a][1])));

                                        for ($b=0; $b < count($contpart); $b++) {
                                            $contdata[$b] = explode(" = ", $contpart[$b]);
                                            
                                            for ($c=0; $c < count($contdata[$b]); $c++) { 
                                                if($c == 0){
                                                    $contdata[$b]['question'] = $contdata[$b][$c];
                                                    unset($contdata[$b][$c]);
                                                }
                                                if($c+1 == count($contdata[$b])){
                                                    $contdata[$b]['correct'] = str_replace(" = ", "", $contdata[$b][$c]);
                                                    unset($contdata[$b][$c]);
                                                }
                                            }
                                        }
                                        

                                        for ($b = 0; $b < count($contpart); $b++) {
                                            $num = $b+1;
                                            echo '<div class="w3-container w3-light-grey w3-margin-bottom"><pre><b>'.$num.'.</b> '.$contdata[$b]['question'].'</pre>';
                                                
                                                echo '<div class="w3-container w3-margin-right">
                                                        <select class="w3-select w3-border w3-round" name="identansw['.$b.']">';
                                                    echo '<option value="" selected disabled>Choose...</option>';
                                                    for ($c=0; $c < count($contdata); $c++) {    
                                                        echo '<option value="'.$contdata[$c]['correct'].'">'.$contdata[$c]['correct'].'</option>';
                                                    }
                                                echo '</select></div>
                                            </p></div>';

                                            $num++;
                                        }
                                        
                                    break;

                                    ############################################################################################################
                                    ############################################################################################################

                                    case 'matchingtype':

                                        $contpart = explode(", ", str_replace("[", "", str_replace("]", "", $part[$a][1])));

                                        for ($b=0; $b < count($contpart); $b++) {
                                            $contdata[$b] = explode(" = ", $contpart[$b]);
                                            
                                            for ($c=0; $c < count($contdata[$b]); $c++) { 
                                                if($c == 0){
                                                    $contdata[$b]['question'] = $contdata[$b][$c];
                                                    unset($contdata[$b][$c]);
                                                }
                                                if($c+1 == count($contdata[$b])){
                                                    $contdata[$b]['correct'] = str_replace(" = ", "", $contdata[$b][$c]);
                                                    unset($contdata[$b][$c]);
                                                }
                                            }
                                        }


                                        //CHOICES

                                        echo '<div class="w3-container w3-light-grey w3-margin-bottom">';
                                            echo '<div class="w3-container w3-white w3-padding-large w3-border w3-round">';
                                            for ($b = 0; $b < count($contpart); $b++) {
                                                $hmp = $b+1;
                                                $ts = count($contpart) + $hmp;
                                                echo '<div class="w3-padding">';
                                                    echo '<input type="text" class="w3-input w3-border w3-round" draggable="true" ondragstart="drag(event)" id="choice'.$ts.'" disabled value="'.$contdata[$b]['correct'].'">';
                                                echo '</div>';
                                            }
                                            echo '</div>';
                                        echo '</div>';

                                        //CHOICES

                                        for ($b = 0; $b < count($contpart); $b++) {
                                            $num = $b+1;

                                            echo '<div class="w3-container w3-light-grey w3-margin-bottom w3-padding"><pre><b>'.$num.'.</b> '.$contdata[$b]['question'].'</pre>';
                                                
                                                echo '<div class="w3-container w3-white w3-border w3-round w3-padding-large" id="div'.$num.'" ondrop="drop(event, '.$num.')" ondragover="allowDrop(event)">
                                                        <input type="hidden" value="" id="choice'.$num.'" name="matchans['.$b.']">
                                                    </div>
                                                </div>';

                                            $num++;
                                        }
                                    break;

                                    ############################################################################################################
                                    ############################################################################################################

                                    case 'true or false':
                                        $contpart = explode(", ", str_replace("[", "", str_replace("]", "", $part[$a][1])));
                                        
                                        for ($b=0; $b < count($contpart); $b++) {
                                            $contdata[$b] = explode(" = ", $contpart[$b]);
                                            
                                            for ($c=0; $c < count($contdata[$b]); $c++) { 
                                                if($c == 0){
                                                    $contdata[$b]['question'] = $contdata[$b][$c];
                                                    unset($contdata[$b][$c]);
                                                }
                                            }
                                        }


                                        for ($b = 0; $b < count($contpart); $b++) {
                                            $num = $b+1;
                                            $selected = '';
                                            echo '<div class="w3-container w3-light-grey w3-margin-bottom"><pre><b>'.$num.'.</b> '.$contdata[$b]['question'].'</pre><div class="w3-container w3-margin-right">';

                                            echo '<input type="radio" name="truefalse['.$b.']" value="True"> True<br/>';
                                            echo '<input type="radio" name="truefalse['.$b.']" value="False"> False<br/>';
                                            echo '</div></div>';
                                            
                                            $num++;
                                        }
                                        
                                        
                                    break;
                                }
                                
                        echo '</div>';
                    }
                    echo '<input type="submit" onclick="return confirm(\'Please double check your answers before proceeding.\')" value="Submit" class="w3-button w3-blue w3-round w3-hover-light-blue" id="submitbutton">';
                    echo '</form>';
                echo '</div>';
            ?>
        </div>
    </div>

</div>
<!-- End PAGE CONTENT -->
<script>
$(function() {
    $(document).keydown(function(e){
        return (e.which || e.keyCode) !== 116;
    });
});

function haha(x){
    var myVar = setInterval(myTimer, 1000);
    var e_sec = 60;
    var e_min = x-1;
    localStorage.removeItem("seconds");
    localStorage.removeItem("minutes");
    
    function myTimer() {
        var d = new Date();
        var sec = d.getSeconds();

        if(sec){

            if(localStorage.getItem("seconds")&&localStorage.getItem("minutes")){
                e_sec = localStorage.getItem("seconds");
                e_min = localStorage.getItem("minutes");


            }else{
                localStorage.setItem("seconds", e_sec);
                localStorage.setItem("minutes", e_min);
            }

            

            if(e_sec < 1 && e_min > 0){
                e_sec = 59;
                localStorage.setItem("seconds", e_sec);
                e_min = e_min - 1;
                localStorage.setItem("minutes", e_min);

            }else if(e_sec == 0 && e_min == 0){
                e_sec = "00";
                e_min = "00";
                window.alert('Time is up!');
                window.clearInterval(myVar);
                localStorage.removeItem("seconds");
                localStorage.removeItem("minutes");

                document.forms['examform'].submit();
                //document.getElementById("examform").submit();
                //document.getElementById('examform').formTarget = '_blank';
                //window.top.close();

            }else{
                e_sec--;
                localStorage.setItem("seconds", e_sec);
                localStorage.setItem("minutes", e_min);
                if(e_sec.toString().length == 1){
                    e_sec = "0"+e_sec;
                }
                if(e_min.toString().length == 1){
                    e_min = "0"+e_min;
                }
            }
            document.getElementById("timer").innerHTML = e_min + ":" + e_sec + " min.";
        }
    }
}



function allowDrop(ev) {
    ev.preventDefault();
}

function drag(ev) {
    ev.dataTransfer.setData("text", ev.target.id);
}

function drop(ev, a) {
    ev.preventDefault();
    var data = ev.dataTransfer.getData("text");
    
    //alert(document.getElementById(ev.target.id).value);
    /*if( !== ''){
        alert('Not empty');
    }else{
        alert('Empty');
    }*/
    //alert(document.getElementById(ev.target.id).value);

    //if(document.getElementById('choice'+a).value == ''){
        //$('#'+ev.target.id).html(new_img);
        document.getElementById('choice'+a).value = document.getElementById(data).value;
        
        ev.target.appendChild(document.getElementById(data));
        //$('#'+ev.target.id).html(new_img);
        
    //}
    
    //ev.target.appendChild(document.getElementById(data));
    //alert(ev.target.id);
    ///alert(ev.target.id);
    //alert(document.getElementById(ev.target.id).value);
    
}

</script>

</body>
<!-- Mirrored from www.w3schools.com/w3css/tryit.asp?filename=tryw3css_templates_interior_design&stacked=h, 2017-07-01 04:11:38 GMT -->
