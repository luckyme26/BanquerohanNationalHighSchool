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
                echo '<b>Deadline:</b> '.date('M. j, Y h:i A', strtotime($due)).'<br/>';
                echo '<b>Attempt/s:</b> '.$attempt.'<br/>';
                echo '<b>Content:</b> '.$noOftypes.' type/s of exam</p><hr/>';

                echo '<form action="'.base_url().'Teacher/previewexam/'.$link.'/'.$title.'/'.$duration.'/'.$due.'/'.$attempt.'/'.$noOftypes.'/'.$subj_code.'/'.$sect.'/'.$gr.'/'.$lesson.'/'.implode("_", $typesofquestion).'/'.implode("_", $noOfitems).'" method="post" enctype="multipart/form-data">';


                for ($a=0; $a < $noOftypes; $a++) {
                    $prt = $a+1;

                    echo '<div class="w3-modal" id="multiplechoice'.$noOfitems[$a].'">
                            <div class="w3-modal-content w3-animate-top w3-margin-bottom">
                                <header class="w3-container w3-blue">
                                    <span onclick="document.getElementById(\'multiplechoice'.$noOfitems[$a].'\').style.display=\'none\'" class="w3-button w3-blue w3-hover-light-blue w3-display-topright">&times;</span>
                                    <h2>MULTIPLECHOICE</h2>
                                </header>
                                <div class="w3-container w3-padding">
                                    <span><b>Note:</b> Just select to add.</span>';
                                        echo $this->Teachers_model->questions($subj_code, $sect, $gr, $lesson, "multiplechoice", $noOfitems[$a]);
                            echo '</div>
                                <div class="w3-blue w3-padding"></div>
                            </div>
                        </div>';

                    echo '<div class="w3-modal" id="identification'.$noOfitems[$a].'">
                            <div class="w3-modal-content w3-animate-top w3-margin-bottom">
                                <header class="w3-container w3-blue">
                                    <span onclick="document.getElementById(\'identification'.$noOfitems[$a].'\').style.display=\'none\'" class="w3-button w3-blue w3-hover-light-blue w3-display-topright">&times;</span>
                                    <h2>IDENTIFICATION</h2>
                                </header>
                                <div class="w3-container w3-padding">
                                    <span><b>Note:</b> Just select to add.</span>';
                                    echo $this->Teachers_model->questions($subj_code, $sect, $gr, $lesson, "identification", $noOfitems[$a]);
                                echo '</div>
                                <div class="w3-blue w3-padding"></div>
                            </div>
                        </div>';

                    echo '<div class="w3-modal" id="matchingtype'.$noOfitems[$a].'">
                            <div class="w3-modal-content w3-animate-top w3-margin-bottom">
                                <header class="w3-container w3-blue">
                                    <span onclick="document.getElementById(\'matchingtype'.$noOfitems[$a].'\').style.display=\'none\'" class="w3-button w3-blue w3-hover-light-blue w3-display-topright">&times;</span>
                                    <h2>MATCHING TYPE</h2>
                                </header>
                                <div class="w3-container w3-padding">
                                    <span><b>Note:</b> Just select to add.</span>';
                                    echo $this->Teachers_model->questions($subj_code, $sect, $gr, $lesson, "matchingtype", $noOfitems[$a]);
                                echo '</div>
                                <div class="w3-blue w3-padding"></div>
                            </div>
                        </div>';

                    echo '<div class="w3-modal" id="enumeration'.$noOfitems[$a].'">
                            <div class="w3-modal-content w3-animate-top w3-margin-bottom">
                                <header class="w3-container w3-blue">
                                    <span onclick="document.getElementById(\'enumeration'.$noOfitems[$a].'\').style.display=\'none\'" class="w3-button w3-blue w3-hover-light-blue w3-display-topright">&times;</span>
                                    <h2>ENUMERATION</h2>
                                </header>
                                <div class="w3-container w3-padding">
                                    <span><b>Note:</b> Just select to add.</span>';
                                    echo $this->Teachers_model->questions($subj_code, $sect, $gr, $lesson, "enumeration", $noOfitems[$a]);
                                echo '</div>
                                <div class="w3-blue w3-padding"></div>
                            </div>
                        </div>';

                    echo '<div class="w3-modal" id="true or false'.$noOfitems[$a].'">
                            <div class="w3-modal-content w3-animate-top w3-margin-bottom">
                                <header class="w3-container w3-blue">
                                    <span onclick="document.getElementById(\'true or false'.$noOfitems[$a].'\').style.display=\'none\'" class="w3-button w3-blue w3-hover-light-blue w3-display-topright">&times;</span>
                                    <h2>TRUE OR FALSE</h2>
                                </header>
                                <div class="w3-container w3-padding">
                                    <span>Note: Just select to add.</span>';
                                    echo $this->Teachers_model->questions($subj_code, $sect, $gr, $lesson, "true%20or%20false", $noOfitems[$a]);
                            echo '</div>
                                <div class="w3-blue w3-padding"></div>
                            </div>
                        </div>';


                    echo '<div class="w3-margin-bottom w3-border w3-padding">
                            <p><b>PART '.$prt.': '.strtoupper($typesofquestion[$a]).'</b> <a href="javascript:void(0)" class="w3-button fa fa-list-ol w3-border w3-round" onclick="hm(\''.$typesofquestion[$a].'\', '.$noOfitems[$a].')"></a></p>';
                            
                            switch ($typesofquestion[$a]) {
                                case 'multiplechoice':
                                    echo '<p class="w3-text-red"><b>Note:</b> When setting image/s as the choices please choose the file first, then put the choice as the name of the image and then select the radio button of the correct answer.</p>';
                                    $i = 1;
                                    $num = 1;
                                    //create note
                                    for ($b = 0; $b < $noOfitems[$a]; $b++) {
                                    
                                    echo '<div class="w3-container w3-margin-bottom">
                                            <textarea class="w3-input w3-border w3-round" name="mult['.$b.'][question]" placeholder="Question" id="multtext'.$num.'" style="resize:none;" required></textarea>
                                            <input type="file" class="w3-border w3-round w3-input w3-margin-bottom" name="questimage['.$b.'][qimage]" accept=".jpg, .jpeg, .png">

                                            <div class="w3-row-padding">
                                                <div class="w3-col w3-center" style="width:50px">
                                                    <input type="radio" style="width:2em" name="mult['.$b.'][correct]" onclick="toRadiobutton('.$num.', '.$i.')" id="correct'.$num.$i.'" required value="">
                                                </div>
                                                <div class="w3-col" style="width:50%">
                                                    <input type="text" placeholder="choice" id="laman'.$i.'" name="mult['.$b.'][1]" class="w3-border w3-round w3-input" required autocomplete="off">
                                                </div>
                                                <div class="w3-rest">
                                                    <input type="file" name="questimage['.$b.'][choice1]" class="w3-border w3-round w3-input" accept=".jpg, .jpeg, .png">
                                                </div>
                                            </div>
                                            
                                            <i class="w3-hide">'.$i++.'</i>

                                            <div class="w3-row-padding">
                                                <div class="w3-col w3-center" style="width:50px">
                                                    <input type="radio" style="width:2em" name="mult['.$b.'][correct]" onclick="toRadiobutton('.$num.', '.$i.')" id="correct'.$num.$i.'" required value="">
                                                </div>
                                                <div class="w3-col" style="width:50%">
                                                    <input type="text" placeholder="choice" id="laman'.$i.'" name="mult['.$b.'][2]" class="w3-border w3-round w3-input" required autocomplete="off">
                                                </div>
                                                <div class="w3-rest">
                                                    <input type="file" name="questimage['.$b.'][choice2]" class="w3-border w3-round w3-input" accept=".jpg, .jpeg, .png">
                                                </div>
                                            </div>

                                            <i class="w3-hide">'.$i++.'</i>

                                            <div class="w3-row-padding">
                                                <div class="w3-col w3-center" style="width:50px">
                                                    <input type="radio" style="width:2em" name="mult['.$b.'][correct]" onclick="toRadiobutton('.$num.', '.$i.')" id="correct'.$num.$i.'" required value="">
                                                </div>
                                                <div class="w3-col" style="width:50%">
                                                    <input type="text" placeholder="choice" id="laman'.$i.'" name="mult['.$b.'][3]" class="w3-border w3-round w3-input" required autocomplete="off">
                                                </div>
                                                <div class="w3-rest">
                                                    <input type="file" name="questimage['.$b.'][choice3]" class="w3-border w3-round w3-input" accept=".jpg, .jpeg, .png">
                                                </div>
                                            </div>
                                            
                                            <i class="w3-hide">'.$i++.'</i>

                                            <div class="w3-row-padding">
                                                <div class="w3-col w3-center" style="width:50px">
                                                    <input type="radio" style="width:2em" name="mult['.$b.'][correct]" onclick="toRadiobutton('.$num.', '.$i.')" id="correct'.$num.$i.'" required value="">
                                                </div>
                                                <div class="w3-col" style="width:50%">
                                                    <input type="text" placeholder="choice" id="laman'.$i.'" name="mult['.$b.'][4]" class="w3-border w3-round w3-input" required autocomplete="off">
                                                </div>
                                                <div class="w3-rest">
                                                    <input type="file" name="questimage['.$b.'][choice4]" class="w3-border w3-round w3-input" accept=".jpg, .jpeg, .png">
                                                </div>
                                            </div>
                                            
                                            <i class="w3-hide">'.$i++.'</i>

                                        </div>';
                                    $num++;
                                    }

                                break;
                                
                                case 'enumeration':
                                    $num = 1;
                                    echo '<p><b>Note: </b>All the possible answers listed will be the number of points per item. Please separate them with comma and instruct the students to put comma when entering multiple answers to separate their answers. Do not enter abbreviations and double check the spelling of each words.</p>';
                                    echo '<textarea class="w3-input w3-border w3-round w3-margin-bottom" name="enum[0][instruction]" placeholder="Instruction" style="resize:none;" required></textarea>';

                                    for ($b=1; $b <= $noOfitems[$a]; $b++) {
                                        echo '<div class="w3-container w3-margin-bottom">
                                                <textarea class="w3-input w3-border w3-round" id="enumtext'.$num.'" name="enum['.$b.'][question]" placeholder="Question" style="resize:none;" required></textarea>

                                                <input type="text" id="enumlaman'.$num.'" class="w3-input w3-border w3-round" name="enum['.$b.'][correct]" placeholder="Answer" required autocomplete="off">
                                            </div>';
                                        $num++;
                                    }
                                break;

                                case 'identification':
                                    $num = 1;
                                    for ($b=0; $b < $noOfitems[$a]; $b++) {
                                    echo '<div class="w3-container w3-margin-bottom">
                                            <textarea class="w3-input w3-border w3-round" name="ident['.$b.'][question]" placeholder="Question" id="sampleident'.$num.'" style="resize:none;" required></textarea>

                                            <input type="text" id="identlaman'.$num.'" class="w3-input w3-border w3-round" name="ident['.$b.'][correct]" placeholder="Answer" required autocomplete="off">
                                        </div>';
                                        $num++;
                                    }
                                break;

                                case 'matchingtype':
                                    $num = 1;
                                    for ($b=0; $b < $noOfitems[$a]; $b++) {
                                    echo '<div class="w3-container w3-margin-bottom">
                                            <textarea class="w3-input w3-border w3-round" name="match['.$b.'][question]" placeholder="Question" id="samplematch'.$num.'" style="resize:none;" required></textarea>

                                            <input type="text" id="matchlaman'.$num.'" class="w3-input w3-border w3-round" name="match['.$b.'][correct]" placeholder="Answer" required autocomplete="off">
                                        </div>';
                                        $num++;
                                    }
                                break;

                                case 'true or false':
                                    $num = 1;
                                    for ($b=0; $b < $noOfitems[$a]; $b++) { 
                                        echo '<div class="w3-container w3-margin-bottom">
                                                <textarea class="w3-input w3-border w3-round" name="truefalse['.$b.'][question]" placeholder="Question" id="tftextarea'.$num.'" style="resize:none;" required></textarea>

                                                <input type="radio" name="truefalse['.$b.'][correct]" id="tcorrect'.$num.'" value="True" required> True<br/>
                                                <input type="radio" name="truefalse['.$b.'][correct]" id="tfalse'.$num.'" value="False" required> False
                                            </div>';
                                        $num++;
                                    }
                                break;
                            }
                            
                    echo '</div>';
                }
                    echo '<input type="submit" class="w3-button w3-round w3-blue w3-hover-light-blue" value="Preview">';
                echo '</form>';
            ?>

        </div>
    </div>

</div>
<!-- End PAGE CONTENT -->
<script type="text/javascript">
    function toRadiobutton(num, x) {
        /******
        x is for the id of the radio buttons
        ******/

        if(document.getElementById("correct"+num+x).checked === true){

            document.getElementById("correct"+num+x).value = document.getElementById("laman"+x).value;
        
        }
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

    function submitmult(id, items) {
        
        for (var j = 1; j <= items; j++) {
            
            /**********************************
            id is for the selected question


            var j is the items
            var a is the end number for the choices
            var b is the starting point
            **********************************/

            if((document.getElementById('multtext'+j).value).length == 0){
                
                if((document.getElementById('multtext1').value).length == 0){
                    var a = 4;
                    var b = 1;

                }else{
                    var a = j * 4;
                    var b = a - 3;
                }

                document.getElementById('multtext'+j).value = document.getElementById('m'+id).value;
                //document.getElementById('m'+id).style.display = 'none';
                var c = 1;
                for (var i = b; i <= a; i++) {
                    document.getElementById('laman'+i).value = document.getElementById('ch'+id+c).value;

                    if(document.getElementById('ch'+id+c).checked === true){
                        
                        document.getElementById('correct'+j+i).checked = true;
                        toRadiobutton(j, i);

                    }
                    c++;
                }
                break;
            }
        }
        items = 0;
    }


    function submitident(id, items) {
        
        for (var j = 1; j <= items; j++) {

            if((document.getElementById('sampleident'+j).value).length == 0){

                document.getElementById('sampleident'+j).value = document.getElementById('i'+id).value;
                document.getElementById('identlaman'+j).value = document.getElementById('CHident'+id).value;
                //document.getElementById('i'+id).style.display = 'none';
                break;
            }
        }
    }


    function submitmatch(id, items) {
        
        for (var j = 1; j <= items; j++) {

            if((document.getElementById('samplematch'+j).value).length == 0){

                document.getElementById('samplematch'+j).value = document.getElementById('matype'+id).value;
                document.getElementById('matchlaman'+j).value = document.getElementById('CHmatch'+id).value;
                //document.getElementById('matype'+id).style.display = 'none';
                break; 
            }
        }
    }


    function submitenum(id, items) {
        
        for (var j = 1; j <= items; j++) {

            if((document.getElementById('enumtext'+j).value).length == 0){

                document.getElementById('enumtext'+j).value = document.getElementById('e'+id).value;
                document.getElementById('enumlaman'+j).value = document.getElementById('cenum'+id).value;
                //document.getElementById('e'+id).style.display = 'none';
                break;
            }
        }
    }


    function submittrufals(id, items){

        for (var j = 1; j <= items; j++) {
            
            if((document.getElementById('tftextarea'+j).value).length == 0){

                document.getElementById('tftextarea'+j).value = document.getElementById('tf'+id).value;
                if(document.getElementById('t'+id).checked === true){
                    document.getElementById('tcorrect'+j).checked = true;
                }else{
                    document.getElementById('tfalse'+j).checked = true;
                }
                //document.getElementById('tf'+id).style.display = 'none';
                break;
            }
        }
    }



    function hm(type, items){
        
        document.getElementById(type+items).style.display = 'block';

        var num = items;
        var rem;
        if(type == 'multiplechoice'){
            
            for (var i = 1; i <= items; i++) {
                if((document.getElementById('multtext'+i).value).length != 0){
                    num = num - 1;
                    rem = num;

                }else{
                    rem = num;
                }
            }

            $('input.mult').on('change', function(e){
                if($('input.mult:checked').length > rem){
                    $(this).prop('checked', false);
                }
            });


        }else if(type == 'identification'){

            for (var i = 1; i <= items; i++) {
                if((document.getElementById('sampleident'+i).value).length != 0){
                    num = num - 1;
                    rem = num;

                }else{
                    rem = num;
                }
            }

            $('input.ident').on('change', function(e){
                if($('input.ident:checked').length > rem){
                    $(this).prop('checked', false);
                }
            });
        

        }else if(type == 'matchingtype'){

            for (var i = 1; i <= items; i++) {
                if((document.getElementById('samplematch'+i).value).length != 0){
                    num = num - 1;
                    rem = num;

                }else{
                    rem = num;
                }
            }

            $('input.match').on('change', function(e){
                if($('input.match:checked').length > rem){
                    $(this).prop('checked', false);
                }
            });


        }else if(type == 'enumeration'){
            for (var i = 1; i <= items; i++) {
                if((document.getElementById('enumtext'+i).value).length != 0){
                    num = num - 1;
                    rem = num;

                }else{
                    rem = num;
                }
            }

            $('input.enum').on('change', function(e){
                if($('input.enum:checked').length > rem){
                    $(this).prop('checked', false);
                }
            });
        

        }else{
            for (var i = 1; i <= items; i++) {
                if((document.getElementById('tftextarea'+i).value).length != 0){
                    num = num - 1;
                    rem = num;

                }else{
                    rem = num;
                }
            }
            $('input.trufals').on('change', function(e){
                if($('input.trufals:checked').length > rem){
                    $(this).prop('checked', false);
                }
            });
        }
    }
    /*function create_trA(table_id1) {

        let table_body = document.getElementById(table_id1),
            first_tr   = table_body.firstElementChild,
            tr_clone   = first_tr.cloneNode(true);

        table_body.appendChild(tr_clone);
        clean_first_trA(table_body.firstElementChild); //cloning the first row of the table

    }
    function clean_first_trA(firstTr) {
        let children  = firstTr.children;
        
        children      = Array.isArray(children) ? children : Object.values(children);
        children.forEach(x=>{
            if(x !== firstTr.lastElementChild)
            {
                x.firstElementChild.value = '';
            }
        });
    }
    function remove_trA(This) {
        if(This.closest('tbody').childElementCount == 1){
            window.alert("You don't have permission to delete this.");

        }else{
            This.closest('tr').remove();
        }
    }*/
</script>
</body>
<!-- Mirrored from www.w3schools.com/w3css/tryit.asp?filename=tryw3css_templates_interior_design&stacked=h, 2017-07-01 04:11:38 GMT -->
