<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<title><?= $title;?></title>

<body onload="LoadAll('<?php echo $lrn; ?>')">
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


        <a href="<?php echo base_url();?>Student/profile/<?php echo $link;?>" onclick="w3_close()" class="w3-bar-item w3-button w3-white w3-text-blue w3-hover-text-blue w3-hover-white w3-padding-16" style="border-radius: 30px 0px 0px 30px;">
            <span class="fa fa-user-circle-o w3-margin-left"></span>&nbsp;&nbsp;Profile
        </a>


        <?php
            $this->Student_model->ifadviser($section, $gradelvl, $link);
        ?>


        <a href="<?php echo base_url();?>Student/subjects/overview/<?php echo $link; ?>" onclick="w3_close()" class="w3-bar-item w3-button w3-text-white w3-hover-text-blue w3-hover-white w3-padding-16" style="border-radius: 30px 0px 0px 30px;">
            <span class="fa fa-graduation-cap w3-margin-left"></span>&nbsp;&nbsp;Subjects
        </a>


        <a href="<?php echo base_url();?>Student/grading/<?php echo $link.'/'.$gradelvl;?>" onclick="w3_close()" class="w3-bar-item w3-button w3-text-white w3-hover-text-blue w3-hover-white w3-padding-16" style="border-radius: 30px 0px 0px 30px;">
            <span class="fa fa-th-list w3-margin-left"></span>&nbsp;&nbsp;Grades
        </a> 


        <a href="<?php echo base_url();?>Student/concerns/<?php echo $link;?>" onclick="w3_close()" class="w3-bar-item w3-button w3-text-white w3-hover-text-blue w3-hover-white w3-padding-16" style="border-radius: 30px 0px 0px 30px;">
            <span class="fa fa-bookmark w3-margin-left"></span>&nbsp;&nbsp;Concerns <span class="w3-badge w3-circle w3-white" id="counter"></span>
        </a> 


        <!--<a href="<?php echo base_url();?>Student/announcement/<?php echo $link;?>" onclick="w3_close()" class="w3-bar-item w3-button w3-text-white w3-hover-text-blue w3-hover-white w3-padding-16" style="border-radius: 30px 0px 0px 30px;">
            <span class="fa fa-bullhorn w3-margin-left"></span>&nbsp;&nbsp;Announcement
        </a> -->


        <a href="<?php echo base_url();?>Student/logout/<?php echo $lrn;?>" onclick="w3_close()" class="w3-bar-item w3-button w3-text-white w3-hover-text-blue w3-hover-white w3-padding-16" style="border-radius: 30px 0px 0px 30px;">
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
            <div class="w3-dropdown-click w3-right w3-margin-top">
                <button class="w3-button w3-hover-blue w3-blue fa fa-bell w3-large" onclick="dropdownsmall()"><span class="w3-badge w3-circle w3-red" id="notifsmall"></button>

                <div id="itemssmall" class="w3-dropdown-content w3-bar-block w3-border" style="right: 0; width: 20em; height: 30em; overflow: scroll"></div>
            </div>
            <h3>
                <a href="javascript:void(0)" class="fa fa-bars w3-button w3-blue w3-xlarge w3-left w3-hover-light-blue w3-round" onclick="w3_open()"></a>PROFILE
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
            <h3 class="w3-left w3-padding"><b>PROFILE</b></h3></span>
            <div class="w3-dropdown-click w3-right w3-margin-top">
                <button class="w3-button w3-hover-white w3-white fa fa-bell w3-large w3-padding-large" onclick="dropdownlarge()"><span class="w3-badge w3-circle w3-red" id="notiflarge"></button>

                <div id="items" class="w3-dropdown-content w3-bar-block w3-border" style="right: 0; width: 30em; height:35em; overflow: scroll"></div>
            </div>
        </span>
    </div>
    <!-- END OF HEADER -->



    <!-- MAIN CONTENT -->

    <div class="w3-container">
        <div class="w3-padding-6 w3-hide-large"></div>
            <br/>
            <?php
                if($this->session->flashdata('success')){
                    echo '<p class="w3-pale-green w3-padding w3-center">'.$this->session->flashdata('success').'</p>';
                    header("Refresh:2;url=".base_url()."Student/profile/".$link);
                }
                if($this->session->flashdata('error')){
                    echo '<p class="w3-pale-red w3-padding w3-center">'.$this->session->flashdata('error').'</p>';
                    header("Refresh:2;url=".base_url()."Student/profile/".$link);
                }
            ?>
            <div class="w3-container w3-border w3-margin-bottom">
                
                <div class="w3-container w3-border w3-padding-large w3-margin-bottom w3-margin-top">
                    
                    <?php
                        if($photo == ''){
                            $img = '<span class="fa fa-user-circle-o w3-margin-right w3-left" id="img1" style="font-size:7em;"></span>';
                        }else{
                            $img = '<img src="'.base_url().'ProfilePic/Students/'.$photo.'" id="img1" class="w3-circle w3-margin-right w3-left" style="max-width:7em; width:100%; max-height:7em">';
                        }

                        echo "<div class='w3-row'>";
                            echo "<div class='w3-col w3-margin-right' style='max-width:7em;'>";
                                echo "<div class='w3-display-container' style='height:7em;' onmouseover='showEdit()' onmouseout='hideEdit()'>";
                                        echo $img;
                                        echo '<a href="javascript:void(0)" onclick="document.getElementById(\'uploadPic\').style.display = \'block\'" class="w3-hide" id="link1"><i class="fa fa-pencil"></i></a>';
                                echo "</div>";
                            echo "</div>";
                            echo "<div class='w3-rest w3-left' style='line-height: 1.5em;'>";
                                echo '<h2>'.$name,'</h2>';
                            echo '<p>'.$gradelvl.' - '.$section.'<br/>'.$lrn.'</p>';
                            echo "</div>";

                        echo "</div>";

                    ?>    

                </div>

                <!-- | UPLOAD PIC MODAL | -->
                <div class="w3-modal" id="uploadPic">
                    <div class="w3-modal-content w3-animate-top" style="max-width:600px">
                        <header class="w3-container w3-blue">
                            <span onclick="document.getElementById('uploadPic').style.display='none'" class="w3-button w3-display-topright w3-blue w3-hover-light-blue" title="Close Modal">&times;</span>
                            <h3>UPLOAD PHOTO</h3>
                        </header>
                        
                        <div class="w3-container w3-padding">
                            <form action="<?php echo base_url();?>Student/UploadPic/<?php echo $lrn.'/'.$link.'/'.$gradelvl; ?>" method="post" enctype="multipart/form-data">
                                <label>Choose photo:</label>
                                <input type="file" name="pic" class="w3-input w3-border w3-round w3-margin-bottom" accept=".jpg, .jpeg, .png" required>
                                <p><small><b>Note:</b> only .jpg, .jpeg, .png are allowed.</small></p>
                                <input type="submit" value="Upload" class="w3-button w3-block w3-blue w3-round w3-hover-light-blue">
                            </form>
                        </div>

                        <div class="w3-container w3-padding w3-blue"></div>
                    </div>
                </div>
                <!-- | UPLOAD PIC MODAL | END -->

                <!-- | EDIT MAIL | -->
                <div class="w3-modal" id="editemail">
                    <div class="w3-modal-content w3-animate-top" style="max-width:600px">
                        <header class="w3-container w3-blue">
                            <span onclick="document.getElementById('editemail').style.display='none'" class="w3-button w3-display-topright w3-blue w3-hover-light-blue" title="Close Modal">&times;</span>
                            <h3>EDIT EMAIL ADDRESS</h3>
                        </header>
                        
                        <div class="w3-container w3-padding">
                            <form action="<?php echo base_url();?>Student/editEmail/<?php echo $lrn.'/'.$link; ?>" method="post">
                                <input type="email" name="email" class="w3-input w3-border w3-round w3-margin-bottom w3-margin-top" placeholder="Email address" required>
                                <p><small><b>Note:</b> Please make sure that your email address is active.</small></p>
                                <input type="submit" value="Save" class="w3-button w3-block w3-blue w3-round w3-hover-light-blue">
                            </form>
                        </div>

                        <div class="w3-container w3-padding w3-blue"></div>
                    </div>
                </div>
                <!-- | EDIT MAIL | END -->

                <!-- | CHANGE PASSWORD | -->
                <div class="w3-modal" id="changepass">
                    <div class="w3-modal-content w3-animate-top" style="max-width:600px">
                        <header class="w3-container w3-blue">
                            <span onclick="document.getElementById('changepass').style.display='none'" class="w3-button w3-display-topright w3-blue w3-hover-light-blue" title="Close Modal">&times;</span>
                            <h3>CONFIRM YOUR PASSWORD</h3>
                        </header>
                        
                        <div class="w3-container w3-padding">
                            <form action="<?php echo base_url();?>Student/verifypassword/<?php echo $lrn.'/'.$link; ?>" method="post">
                                <input type="password" name="password" class="w3-input w3-border w3-round w3-margin-bottom w3-margin-top" placeholder="Enter password" required>
                                <input type="hidden" name="id" value="<?php echo $lrn; ?>">
                                <input type="submit" value="Proceed" class="w3-button w3-block w3-blue w3-round w3-hover-light-blue">
                            </form>
                        </div>

                        <div class="w3-container w3-padding w3-blue"></div>
                    </div>
                </div>
                <!-- | CHANGE PASSWORD | END -->


                <!-- | UPDATE PROFILE | -->
                <div class="w3-modal" id="updateprofile">
                    <div class="w3-modal-content w3-animate-top" style="max-width:600px">
                        <header class="w3-container w3-blue">
                            <span onclick="document.getElementById('updateprofile').style.display='none'" class="w3-button w3-display-topright w3-blue w3-hover-light-blue" title="Close Modal">&times;</span>
                            <h3>UPDATE BASIC INFORMATIONS</h3>
                        </header>
                        
                        <div class="w3-container w3-padding">
                            <form action="<?php echo base_url();?>Student/updateprofile/<?php echo $link; ?>" method="post">
                                <input type="text" name="address" class="w3-input w3-border w3-round w3-margin-bottom w3-margin-top" placeholder="Address" value="<?php echo $address; ?>" required>
                                <input type="text" name="cp" class="w3-input w3-border w3-round w3-margin-bottom w3-margin-top" placeholder="Contact" value="<?php echo $contact; ?>" required>
                                <input type="date" name="bday" class="w3-input w3-border w3-round w3-margin-bottom w3-margin-top" placeholder="Birthdate" value="<?php echo $bday; ?>" required>

                                <input type="submit" value="Proceed" class="w3-button w3-block w3-blue w3-round w3-hover-light-blue">
                            </form>
                        </div>

                        <div class="w3-container w3-padding w3-blue"></div>
                    </div>
                </div>
                <!-- | UPDATE PROFILE | END -->

                <div class="w3-container w3-border w3-padding-large w3-margin-bottom">
                    <?php
                            
                            echo '<div class="w3-row w3-section">
                                    <div class="w3-col w3-center" style="width:50px">
                                        <i class="w3-xlarge fa fa-map-marker w3-center"></i>
                                    </div>
                                    <div class="w3-rest">';
                                        if(!empty($address)){
                                            echo $address;
                                        }else{
                                            echo 'Not set';
                                        }
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
                                        <i class="w3-xlarge fa fa-envelope"></i>
                                    </div>
                                    <div class="w3-rest">';
                                        echo $email;
                                        echo ' <a href="javascript:void(0)" onclick="document.getElementById(\'editemail\').style.display = \'block\'" class="fa fa-pencil w3-round w3-button w3-blue w3-hover-light-blue w3-small"></a>';
                            echo '</div>
                            </div>';

                            echo '<div class="w3-row w3-section">
                                    <div class="w3-col w3-center" style="width:50px">
                                        <i class="w3-xlarge fa fa-phone"></i>
                                    </div>
                                    <div class="w3-rest">';
                                        if(!empty($contact)){
                                            echo $contact;
                                        }else{
                                            echo 'Not set';
                                        }
                            echo '</div>
                            </div>';    

                            echo '<div class="w3-row w3-section">
                                    <div class="w3-col w3-center" style="width:50px">
                                        <i class="w3-xlarge fa fa-calendar"></i>
                                    </div>
                                    <div class="w3-rest">';
                                        if(!empty($bday)){
                                            echo $bday;
                                        }else{
                                            echo 'Not set';
                                        }
                            echo '</div>
                            </div>';                        
                            

                            if($subjects != ''){
                                $subj = explode(", ", $subjects);
                                echo '<div class="w3-row w3-section">
                                        <div class="w3-col w3-center" style="width:50px">
                                            <i class="w3-xlarge fa fa-book"></i>
                                        </div>
                                        <div class="w3-rest">';
                                            echo 'Enrolled subjects:<ul>';
                                
                                        for($i = 0; $i < count($subj); $i++) {
                                            
                                            foreach ($this->db->query("SELECT * FROM subjects WHERE subj_code = '".$subj[$i]."'")->result_array() as $subjinfo) {
                                                echo '<li><a href="'.base_url().'Student/subjects/'.$subj[$i].'/'.$link.'">'.$subjinfo['subj_title'].'</a></li>';
                                            }

                                        }
                                        echo '</ul>
                                        </div>
                                    </div>';
                            }

                            echo '<hr/>
                                <a href="javascript:void(0)" onclick="document.getElementById(\'changepass\').style.display = \'block\'" class="w3-button w3-blue w3-round-large w3-hover-light-blue w3-small"><i class=" fa fa-pencil w3-large"></i> Change Password
                                </a>
                                <a href="javascript:void(0)" onclick="document.getElementById(\'updateprofile\').style.display = \'block\'" class="w3-button w3-blue w3-round-large w3-hover-light-blue w3-small"><i class=" fa fa-edit w3-large"></i> Update basic informations
                                </a>';
                        ?>
                </div>

            </div>
    </div>
    <!-- MAIN CONTENT | END -->

</div>
<!-- End PAGE CONTENT -->
<script type="text/javascript">
    function showEdit(){
        
        var link = document.getElementById("link1");
    
        link.className -= "w3-hide";
        link.className += " w3-button w3-round-large w3-blue w3-hover-pale-blue w3-display-middle w3-animate-opacity ";
    }

    function hideEdit(){

        var link = document.getElementById("link1");
    
        link.className += "w3-hide";
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

    //STUDENT
    function LoadAll(a) {
        /*var str = "" + a;
        var pad = "000000000000";
        var x = pad.substring('0', pad.length - str.length) + str;*/
        //
        var z = parseInt(a.toString(8), 10);
        var x = String(z).padStart(12, '0');
        
        setInterval(function(){
            
            //NOTIFICATION
            var notificationcounter = new XMLHttpRequest();
            notificationcounter.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("notifsmall").innerHTML = this.responseText;
                    document.getElementById("notiflarge").innerHTML = this.responseText;
                }
            };

            notificationcounter.open("GET", "https://"+window.location.hostname+"/BanquerohanNationalHighSchool/Student/notifcounter/"+x, true);
            notificationcounter.send();


            var notificationitems = new XMLHttpRequest();
            notificationitems.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("itemssmall").innerHTML = this.responseText;
                    document.getElementById("items").innerHTML = this.responseText;
                }
            };

            notificationitems.open("POST", "https://"+window.location.hostname+"/BanquerohanNationalHighSchool/Student/notifitems/"+x, true);
            notificationitems.send();
            //NOTIFICATION | END


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
