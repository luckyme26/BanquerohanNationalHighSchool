<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<title><?= $title;?></title>

<body onload="LoadConcerns()">
<!-- | Sidebar/menu | -->
<nav class="w3-sidebar w3-blue w3-collapse w3-top w3-large w3-animate-left" style="z-index:3;width:245px;font-weight:bold;" id="mySidebar"><br>
    <div class="w3-container w3-margin-bottom">
        <center>
            <span class="fa fa-user-circle-o" style="font-size:100px;"></span>
            <h5 class="w3-text-white">ADMINISTRATOR</h5>
        </center>
    </div>

    <!--| LINKS |-->
    <div class="w3-bar-block">  
        <a href="<?php echo base_url();?>admin/dashboard" onclick="w3_close()" class="w3-bar-item w3-button w3-text-white w3-hover-text-blue w3-hover-white w3-padding-16" style="border-radius: 30px 0px 0px 30px;">
            <span class="fa fa-dashboard w3-margin-left"></span>&nbsp;&nbsp;Dashboard
        </a> 


        <!-- ACCORDION FOR ACCOUNTS -->
        <a onclick="accounts();" class="w3-bar-item w3-button w3-text-white w3-hover-text-blue w3-hover-white w3-padding-16" style="border-radius: 30px 0px 0px 30px;">
            <span class="fa fa-user-circle-o w3-margin-left"></span>&nbsp;&nbsp;Accounts <i class="fa fa-caret-down"></i>
        </a>
        <div id="accounts_items" class="w3-container w3-hide">
            <a href="<?php echo base_url();?>admin/studentaccounts" onclick="w3_close()" class="w3-bar-item w3-button w3-margin-left w3-hover-text-blue w3-hover-white w3-small" style="border-radius: 30px 0px 0px 30px;"><span class="fa fa-users w3-margin-left"></span>&nbsp;&nbsp;Students</a>
            <a href="<?php echo base_url();?>admin/teacheraccounts" onclick="w3_close()" class="w3-bar-item w3-button w3-margin-left w3-hover-text-blue w3-hover-white w3-small" style="border-radius: 30px 0px 0px 30px;"><span class="fa fa-users w3-margin-left"></span>&nbsp;&nbsp;Teachers</a>
        </div>
        <!-- END | ACCORDION FOR ACCOUNTS -->


        <!-- ACCORDION FOR SECTIONS -->
        <a onclick="section();" class="w3-bar-item w3-button w3-text-white w3-hover-text-blue w3-hover-white w3-padding-16" style="border-radius: 30px 0px 0px 30px;">
            <span class="fa fa-th-list w3-margin-left"></span>&nbsp;&nbsp;Sections <i class="fa fa-caret-down"></i>
        </a>
        <div id="sections" class="w3-container w3-hide">
            <a href="<?php echo base_url(); ?>admin/grade7/List" onclick="w3_close()" class="w3-bar-item w3-button w3-margin-left w3-hover-text-blue w3-hover-white w3-small" style="border-radius: 30px 0px 0px 30px;">
                <span class="fa fa-users w3-margin-left"></span>&nbsp;&nbsp;Grade 7
            </a>
            <a href="<?php echo base_url(); ?>admin/grade8/List" onclick="w3_close()" class="w3-bar-item w3-button w3-margin-left w3-hover-text-blue w3-hover-white w3-small" style="border-radius: 30px 0px 0px 30px;">
                <span class="fa fa-users w3-margin-left"></span>&nbsp;&nbsp;Grade 8
            </a>
            <a href="<?php echo base_url(); ?>admin/grade9/List" onclick="w3_close()" class="w3-bar-item w3-button w3-margin-left w3-hover-text-blue w3-hover-white w3-small" style="border-radius: 30px 0px 0px 30px;">
                <span class="fa fa-users w3-margin-left"></span>&nbsp;&nbsp;Grade 9
            </a>
            <a href="<?php echo base_url(); ?>admin/grade10/List" onclick="w3_close()" class="w3-bar-item w3-button w3-margin-left w3-hover-text-blue w3-hover-white w3-small" style="border-radius: 30px 0px 0px 30px;">
                <span class="fa fa-users w3-margin-left"></span>&nbsp;&nbsp;Grade 10
            </a>
            <a href="<?php echo base_url(); ?>admin/grade11/List" onclick="w3_close()" class="w3-bar-item w3-button w3-margin-left w3-hover-text-blue w3-hover-white w3-small" style="border-radius: 30px 0px 0px 30px;">
                <span class="fa fa-users w3-margin-left"></span>&nbsp;&nbsp;Grade 11
            </a>
            <a href="<?php echo base_url(); ?>admin/grade12/List" onclick="w3_close()" class="w3-bar-item w3-button w3-margin-left w3-hover-text-blue w3-hover-white w3-small" style="border-radius: 30px 0px 0px 30px;">
                <span class="fa fa-users w3-margin-left"></span>&nbsp;&nbsp;Grade 12
            </a>
        </div>
        <!-- END | ACCORDION FOR SECTIONS -->


        <a href="<?php echo base_url();?>admin/subjects/overview" onclick="w3_close()" class="w3-bar-item w3-button w3-text-white w3-hover-text-blue w3-hover-white w3-padding-16" style="border-radius: 30px 0px 0px 30px;">
            <span class="fa fa-graduation-cap w3-margin-left"></span>&nbsp;&nbsp;Subjects
        </a>


        <a href="<?php echo base_url();?>admin/teachers" onclick="w3_close()" class="w3-bar-item w3-button w3-text-white w3-hover-text-blue w3-hover-white w3-padding-16" style="border-radius: 30px 0px 0px 30px;">
            <span class="fa fa-users w3-margin-left"></span>&nbsp;&nbsp;Teachers
        </a> 


        <a href="<?php echo base_url();?>admin/enrolledstudents" onclick="w3_close()" class="w3-bar-item w3-button w3-text-white w3-hover-text-blue w3-hover-white w3-padding-16" style="border-radius: 30px 0px 0px 30px;">
            <span class="fa fa-users w3-margin-left"></span>&nbsp;&nbsp;Enrolled students
        </a> 


        <!-- ACCORDION FOR OTHERS -->
        <a onclick="others();" class="w3-bar-item w3-button w3-text-white w3-hover-text-blue w3-hover-white w3-padding-16" style="border-radius: 30px 0px 0px 30px;">
            <span class="fa fa-sliders w3-margin-left"></span>&nbsp;&nbsp;Others <i class="fa fa-caret-down"></i>
        </a> 
        <div id="others_items" class="w3-container w3-show">
            <a href="<?php echo base_url();?>admin/concerns" onclick="w3_close()" class="w3-bar-item w3-button w3-white w3-text-blue w3-hover-text-blue w3-hover-white w3-padding w3-small w3-margin-left" style="border-radius: 30px 0px 0px 30px;">
                <span class="fa fa-bookmark w3-margin-left"></span>&nbsp;&nbsp;Concerns
            </a>
            <a href="<?php echo base_url();?>admin/announcement" onclick="w3_close()" class="w3-bar-item w3-button w3-margin-left w3-hover-text-blue w3-hover-white w3-small" style="border-radius: 30px 0px 0px 30px;">
                <span class="fa fa-bullhorn w3-margin-left"></span>&nbsp;&nbsp;Announcement
            </a>
            <a href="<?php echo base_url();?>admin/events" onclick="w3_close()" class="w3-bar-item w3-button w3-margin-left w3-hover-text-blue w3-hover-white w3-small" style="border-radius: 30px 0px 0px 30px;">
                <span class="fa fa-calendar w3-margin-left"></span>&nbsp;&nbsp;Events
            </a>
            <a href="javascript:void(0)" onclick="document.getElementById('Confirmation').style.display='block'" class="w3-bar-item w3-button w3-margin-left w3-hover-text-blue w3-hover-white w3-small" style="border-radius: 30px 0px 0px 30px;">
                <span class="fa fa-pencil-square-o w3-margin-left"></span>&nbsp;&nbsp;Edit credentials
            </a>
        </div>
        <!-- END | ACCORDION FOR OTHERS -->


        <a href="<?php echo base_url(); ?>admin/logout" onclick="w3_close()" class="w3-bar-item w3-button w3-text-white w3-hover-text-blue w3-hover-white w3-padding-16" style="border-radius: 30px 0px 0px 30px;">
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
                <a href="javascript:void(0)" class="fa fa-bars w3-button w3-blue w3-xlarge w3-left w3-hover-light-blue w3-round" onclick="w3_open()"></a>CONCERNS
            </h3>
        </span>
    </header>

    <!-- Overlay effect when opening sidebar on small screens -->
    <div class="w3-overlay w3-hide-large" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

    <br class="w3-hide-large"><br class="w3-hide-large"><br class="w3-hide-large">
    <!-- END | Top menu on small screens-->

<!-- FOR EDIT CREDENTIAL MODAL -->
<?php
    extract($this->session->userdata('Home of the braves@2022:admin'));
?>
<div class="w3-container">
    <div class="w3-modal" id="Confirmation">
        <div class="w3-modal-content w3-card-4 w3-animate-top w3-white w3-round" style="max-width:600px">
            <header class="w3-container w3-blue">
                <span onclick="document.getElementById('Confirmation').style.display='none'" class="w3-button w3-display-topright w3-blue w3-hover-light-blue" title="Close Modal">&times;</span>
                <h3>CONFIRM YOUR PASSWORD</h3>
            </header>

            <div class="w3-container">
                <form method="post" action="<?php echo base_url();?>admin/confirmpassword">
                    <div class="w3-section">
                        <input class="w3-input w3-border w3-round" type="password" placeholder="Enter Password" name="password" pattern="\S+" required>
                        <input type="hidden" name="id" value="<?php echo $id;?>">
                        <button class="w3-button w3-block w3-blue w3-section w3-padding w3-round w3-hover-light-blue" type="submit">Confirm</button>
                    </div>
                </form>
            </div>

            <div class="w3-container w3-padding w3-blue">
                <span class="w3-right w3-padding"></span>
            </div>
          
        </div>
    </div>
</div>
<!-- FOR EDIT CREDENTIAL MODAL | END -->


<!-- PAGE CONTENT -->
<div class="w3-main w3-margin-bottom" style="margin-left: 245px;">
 
    <!-- HEADER -->
    <div class="w3-container w3-white w3-hide-small w3-hide-medium" style="box-shadow: 2px 0px 5px 1px gray;">
        <span>
            <h3 class="w3-left w3-padding"><b>CONCERNS</b></h3></span>
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
                    <form action="<?php echo base_url()?>Admin/postconcern/" method="post" class="w3-padding">
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

        <div class="w3-container w3-card w3-round w3-padding w3-margin-bottom">

            <h3>POSTED CONCERNS <button class="w3-button w3-tiny w3-round-xxlarge w3-blue w3-hover-light-blue" onclick="document.getElementById('postconcern').style.display = 'block'"><i class="fa fa-plus"></i></button></h3>

            <?php if($this->session->flashdata('success')){;?>
                <p class="w3-panel w3-pale-green w3-center">
                    <?php echo $this->session->flashdata('success'); header("Refresh:1;url = ".base_url()."Admin/concerns/");?>
                </p>
            <?php };?>
            <?php if($this->session->flashdata('error')){;?>
                <p class="w3-panel w3-pale-red w3-center">
                    <?php echo $this->session->flashdata('error'); header("Refresh:1;url = ".base_url()."Admin/concerns/");?>
                </p>
            <?php }; ?>


            <div class="w3-border">
                <div class="w3-bar w3-light-grey">
                    <button class="w3-bar-item w3-button tablink w3-white w3-hover-light-grey" onclick="Categories(event,'Sent')">Sent</button>
                    <button class="w3-bar-item w3-button tablink w3-hover-light-grey" onclick="Categories(event,'Pending')">Pending (request)</button>
                    <button class="w3-bar-item w3-button tablink w3-hover-light-grey" onclick="Categories(event,'Declined')">Declined (request)</button>
                    <button class="w3-bar-item w3-button tablink w3-hover-light-grey" onclick="Categories(event,'Resolved')">Resolved (request)</button>
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

        </div>
    </div>

</div>
<!-- End PAGE CONTENT -->


<script type="text/javascript">

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


    function LoadConcerns(){
        setInterval(function(){

            var concernssent = new XMLHttpRequest();
            concernssent.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("concernslistSent").innerHTML = this.responseText;
                }
            };

            concernssent.open("POST", "https://"+window.location.hostname+"/BanquerohanNationalHighSchool/Admin/concernssent", true);
            concernssent.send();


            var concernspending = new XMLHttpRequest();
            concernspending.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("concernslistPending").innerHTML = this.responseText;
                }
            };

            concernspending.open("POST", "https://"+window.location.hostname+"/BanquerohanNationalHighSchool/Admin/concernspending", true);
            concernspending.send();


            var concernsdeclined = new XMLHttpRequest();
            concernsdeclined.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("concernslistDeclined").innerHTML = this.responseText;
                }
            };

            concernsdeclined.open("POST", "https://"+window.location.hostname+"/BanquerohanNationalHighSchool/Admin/concernsdeclined", true);
            concernsdeclined.send();


            var concernsresolved = new XMLHttpRequest();
            concernsresolved.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("concernslistResolved").innerHTML = this.responseText;
                }
            };

            concernsresolved.open("POST", "https://"+window.location.hostname+"/BanquerohanNationalHighSchool/Admin/concernsresolved", true);
            concernsresolved.send();

        }, 5000);
    }
</script>

</body>
<!-- Mirrored from www.w3schools.com/w3css/tryit.asp?filename=tryw3css_templates_interior_design&stacked=h, 2017-07-01 04:11:38 GMT -->
