<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<title><?= $title;?></title>

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


        <a href="<?php echo base_url();?>Student/subjects/overview/<?php echo $link; ?>" onclick="w3_close()" class="w3-bar-item w3-button w3-text-white w3-hover-text-blue w3-hover-white w3-padding-16" style="border-radius: 30px 0px 0px 30px;">
            <span class="fa fa-graduation-cap w3-margin-left"></span>&nbsp;&nbsp;Subjects
        </a>


        <a href="<?php echo base_url();?>Student/grading/<?php echo $link.'/'.$gradelvl;?>" onclick="w3_close()" class="w3-bar-item w3-button w3-text-white w3-hover-text-blue w3-hover-white w3-padding-16" style="border-radius: 30px 0px 0px 30px;">
            <span class="fa fa-th-list w3-margin-left"></span>&nbsp;&nbsp;Grades
        </a> 


        <a href="<?php echo base_url();?>Student/concerns/<?php echo $link;?>" onclick="w3_close()" class="w3-bar-item w3-button w3-white w3-text-blue w3-hover-text-blue w3-hover-white w3-padding-16" style="border-radius: 30px 0px 0px 30px;">
            <span class="fa fa-bookmark w3-margin-left"></span>&nbsp;&nbsp;Concerns
        </a> 


        <!--<a href="<?php echo base_url();?>Student/announcement/<?php echo $link;?>" onclick="w3_close()" class="w3-bar-item w3-button w3-text-white w3-hover-text-blue w3-hover-white w3-padding-16" style="border-radius: 30px 0px 0px 30px;">
            <span class="fa fa-bullhorn w3-margin-left"></span>&nbsp;&nbsp;Announcement
        </a> -->


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
            <div class="w3-dropdown-click w3-right w3-margin-top">
                <button class="w3-button w3-hover-blue w3-blue fa fa-bell w3-large" onclick="dropdownsmall()"><span class="w3-badge w3-circle w3-red" id="notifsmall"></button>

                <div id="itemssmall" class="w3-dropdown-content w3-bar-block w3-border" style="right: 0; width: 20em; height: 30em; overflow: scroll"></div>
            </div>
            <h3>
              <a href="javascript:void(0)" class="fa fa-bars w3-button w3-blue w3-xlarge w3-left w3-hover-light-blue w3-round" onclick="w3_open()"></a>CONCERNS
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
            <h3 class="w3-left w3-padding"><b>CONCERNS</b></h3>
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

        <div class="w3-modal" id="postconcern">
            <div class="w3-modal-content w3-animate-top">
                <header class="w3-container w3-blue">
                    <span onclick="document.getElementById('postconcern').style.display='none'" 
                class="w3-button w3-display-topright w3-blue w3-hover-light-blue">&times;</span>
                    <h3>POST CONCERN</h3>
                </header>
                <div class="w3-container w3-padding-large">
                    <form action="<?php echo base_url()?>Student/postconcern/<?php echo $link; ?>" method="post" class="w3-padding">
                        <input type="text" name="rec" class="w3-input w3-border w3-round" placeholder="Recepient id" required autocomplete="off">
                        <br/>
                        <input type="text" name="concern" class="w3-input w3-border w3-round" placeholder="Concern" required autocomplete="off">
                        <br/>
                        <textarea class="w3-input w3-border w3-round" name="desc" placeholder="Description" style="resize: none; width: 100%; height: 150px;" required></textarea>
                        <br/>
                        <input type="submit" class="w3-button w3-block w3-blue w3-round w3-hover-light-blue" value="Post concern">
                    </form>
                </div>
                <footer class="w3-container w3-blue w3-padding-large"></footer>
            </div>
        </div>

        <div class="w3-container w3-border w3-padding w3-margin-bottom">

            <h3>POSTED CONCERNS <button class="w3-button w3-small w3-round-xxlarge w3-blue w3-hover-light-blue" onclick="document.getElementById('postconcern').style.display = 'block'"><i class="fa fa-plus"></i></button></h3>

            <?php if($this->session->flashdata('success')){;?>
                <p class="w3-panel w3-pale-green w3-center">
                    <?php echo $this->session->flashdata('added'); header("Refresh:1;url = ".base_url()."Student/concerns/".$link);?>
                </p>
            <?php };?>
            <?php if($this->session->flashdata('error')){;?>
                <p class="w3-panel w3-pale-red w3-center">
                    <?php echo $this->session->flashdata('error'); header("Refresh:1;url = ".base_url()."Student/concerns/".$link);?>
                </p>
            <?php }; ?>


            <div class="w3-border">
                <div class="w3-bar w3-light-grey">
                    <button class="w3-bar-item w3-button tablink w3-white w3-hover-light-grey" onclick="Categories(event,'Sent')">Sent</button>
                    <button class="w3-bar-item w3-button tablink w3-hover-light-grey" onclick="Categories(event,'Pending')">Pending <small>(requests)</small></button>
                    <button class="w3-bar-item w3-button tablink w3-hover-light-grey" onclick="Categories(event,'Declined')">Declined <small>(requests)</small></button>
                    <button class="w3-bar-item w3-button tablink w3-hover-light-grey" onclick="Categories(event,'Resolved')">Resolved <small>(requests)</small></button>
                </div>  
                  

                <div id="Sent" class="w3-container cat">
                    <div id="concernslistSent"></div>
                </div>

                <div id="Pending" class="w3-container cat" style="display:none">
                    <div id="concernslistPending"></div>
                </div>

                <div id="Declined" class="w3-container cat" style="display:none">
                    <div id="concernslistDeclined"></div>
                </div>

                <div id="Resolved" class="w3-container cat" style="display:none">
                    <div id="concernslistResolved"></div>
                </div>
            </div>
            <?php
                //$this->Student_model->postedconcerns($link);
            ?>


        </div>
    </div>

</div>
<!-- End PAGE CONTENT -->


<script type="text/javascript">
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

    function Categories(evt, cate) {
        var i, x, tablinks;
        x = document.getElementsByClassName("cat");
        
        for (i = 0; i < x.length; i++) {
            x[i].style.display = "none";
        }
        
        tablinks = document.getElementsByClassName("tablink");
        for (i = 0; i < x.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" w3-white", "");
        }
        document.getElementById(cate).style.display = "block";
        evt.currentTarget.className += " w3-white";
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


            var concernssent = new XMLHttpRequest();
            concernssent.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("concernslistSent").innerHTML = this.responseText;
                }
            };

            concernssent.open("POST", "https://"+window.location.hostname+"/BanquerohanNationalHighSchool/Student/concernssent/"+x, true);
            concernssent.send();


            var concernspending = new XMLHttpRequest();
            concernspending.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("concernslistPending").innerHTML = this.responseText;
                }
            };

            concernspending.open("POST", "https://"+window.location.hostname+"/BanquerohanNationalHighSchool/Student/concernspending/"+x, true);
            concernspending.send();


            var concernsdeclined = new XMLHttpRequest();
            concernsdeclined.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("concernslistDeclined").innerHTML = this.responseText;
                }
            };

            concernsdeclined.open("POST", "https://"+window.location.hostname+"/BanquerohanNationalHighSchool/Student/concernsdeclined/"+x, true);
            concernsdeclined.send();


            var concernsresolved = new XMLHttpRequest();
            concernsresolved.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("concernslistResolved").innerHTML = this.responseText;
                }
            };

            concernsresolved.open("POST", "https://"+window.location.hostname+"/BanquerohanNationalHighSchool/Student/concernsresolved/"+x, true);
            concernsresolved.send();
        }, 1000);
    }
    //STUDENT | END
</script>

</body>
<!-- Mirrored from www.w3schools.com/w3css/tryit.asp?filename=tryw3css_templates_interior_design&stacked=h, 2017-07-01 04:11:38 GMT -->
