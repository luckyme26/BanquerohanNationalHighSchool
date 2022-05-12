<script>
    // Script to open and close sidebar
    function w3_open() {
        document.getElementById("mySidebar").style.display = "block";
        document.getElementById("myOverlay").style.display = "block";
    }

    function w3_close() {
        document.getElementById("mySidebar").style.display = "none";
        document.getElementById("myOverlay").style.display = "none";
    }
    //END | Script to open and close sidebar

    function showYrlvl(str){
        window.location = ""+str+"";
    }

    //ACCOUNTS
    function accounts() {
        var x = document.getElementById("accounts_items");

        if (x.className.indexOf("w3-show") == -1) {
            x.className += " w3-show";
        } else { 
            x.className = x.className.replace(" w3-show", "");
        }
    }

    //SECTIONS
    function section() {
        var x = document.getElementById('sections');

        if (x.className.indexOf("w3-show") == -1) {
            x.className += " w3-show";
        } else { 
            x.className = x.className.replace(" w3-show", "");
        }
    }

    //OTHERS
    /*function others() {
        var x = document.getElementById('others_items');

        if (x.className.indexOf("w3-show") == -1) {
            x.className += " w3-show";
        } else { 
            x.className = x.className.replace(" w3-show", "");
        }
    }*/

    function myFunction(id) {
        var x = document.getElementById(id);
        if (x.className.indexOf("w3-show") == -1) {
            x.className += " w3-show";
        } else {
            x.className = x.className.replace(" w3-show", "");
        }
    }
    

    function ShowSectorBlock(){
        var x = document.getElementById('GradeLevel').value;

        
        if(x == "Grade 11"){
            document.getElementById('section11').disabled = false;
            document.getElementById('section11').style.display = 'block';
            document.getElementById('section12').disabled = true;
            document.getElementById('section12').style.display = 'none';
            document.getElementById('section7').disabled = true;
            document.getElementById('section8').disabled = true;
            document.getElementById('section9').disabled = true;
            document.getElementById('section10').disabled = true;
            document.getElementById('Empty').disabled = true;
        }
        else if(x == "Grade 12"){
            document.getElementById('section12').disabled = false;
            document.getElementById('section12').style.display = 'block';
            document.getElementById('section11').disabled = true;
            document.getElementById('section11').style.display = 'none';
            document.getElementById('section7').disabled = true;
            document.getElementById('section8').disabled = true;
            document.getElementById('section9').disabled = true;
            document.getElementById('section10').disabled = true;
            document.getElementById('Empty').disabled = true;
        }
        else if(x == "Grade 7"){
            document.getElementById('section7').disabled = false;
            document.getElementById('section7').style.display = 'block';
            document.getElementById('Empty').style.display = 'none';
            document.getElementById('section8').style.display = 'none';
            document.getElementById('section9').style.display = 'none';
            document.getElementById('section10').style.display = 'none';
            document.getElementById('section11').disabled = true;
            document.getElementById('section12').disabled = true;
        }
        else if(x == "Grade 8"){
            document.getElementById('section8').disabled = false;
            document.getElementById('section8').style.display = 'block';
            document.getElementById('Empty').style.display = 'none';
            document.getElementById('section7').style.display = 'none';
            document.getElementById('section9').style.display = 'none';
            document.getElementById('section10').style.display = 'none';
            document.getElementById('section11').disabled = true;
            document.getElementById('section12').disabled = true;
        }
        else if(x == "Grade 9"){
            document.getElementById('section9').disabled = false;
            document.getElementById('section9').style.display = 'block';
            document.getElementById('Empty').style.display = 'none';
            document.getElementById('section7').style.display = 'none';
            document.getElementById('section8').style.display = 'none';
            document.getElementById('section10').style.display = 'none';
            document.getElementById('section11').disabled = true;
            document.getElementById('section12').disabled = true;
        }
        else if(x == "Grade 10"){
            document.getElementById('section10').disabled = false;
            document.getElementById('section10').style.display = 'block';
            document.getElementById('Empty').style.display = 'none';
            document.getElementById('section7').style.display = 'none';
            document.getElementById('section8').style.display = 'none';
            document.getElementById('section9').style.display = 'none';
            document.getElementById('section11').disabled = true;
            document.getElementById('section12').disabled = true;
        }
        else{
            document.getElementById('section11').disabled = true;
            document.getElementById('section12').disabled = true;
            document.getElementById('Empty').style.display = 'block';
            document.getElementById('section10').style.display = 'none';
            document.getElementById('section7').style.display = 'none';
            document.getElementById('section8').style.display = 'none';
            document.getElementById('section9').style.display = 'none';
        }

    }

    //CHECKBOX FOR POSTING ANNOUNCEMENT
    function dis(){
        var chk = document.getElementById('all');
        var chk1 = document.getElementById('disb');
        var chk2 = document.getElementById('disb1');
        var chk3 = document.getElementById('disb2');
        var chk4 = document.getElementById('disb3');
        var chk5 = document.getElementById('disb4');
        var chk6 = document.getElementById('disb5');
        var chk7 = document.getElementById('disb6');
        if(chk.checked){
            chk1.disabled=true;
            chk2.disabled=true;
            chk3.disabled=true;
            chk4.disabled=true;
            chk5.disabled=true;
            chk6.disabled=true;
            chk7.disabled=true;
        }
        else{
            chk1.disabled=false;
            chk2.disabled=false;
            chk3.disabled=false;
            chk4.disabled=false;
            chk5.disabled=false;
            chk6.disabled=false;
            chk7.disabled=false;
        }

        if(chk1.checked||chk2.checked||chk3.checked||chk4.checked||chk5.checked||chk6.checked||chk7.checked){
            document.getElementById('all').style.display='none';
            document.getElementById('alllabel').style.display='none';
            chk.disabled=true;
        }else{
            document.getElementById('all').style.display='inline';
            document.getElementById('alllabel').style.display='inline';
            chk.disabled=false;
        }

        if(chk1.checked&&chk2.checked&&chk3.checked&&chk4.checked&&chk5.checked&&chk6.checked&&chk7.checked){
            document.getElementById('all').style.display='inline';
            document.getElementById('alllabel').style.display='inline';
            chk.disabled=false;
            chk.checked=true;
            chk1.checked=false;
            chk2.checked=false;
            chk3.checked=false;
            chk4.checked=false;
            chk5.checked=false;
            chk6.checked=false;
            chk7.checked=false;
            chk1.disabled=true;
            chk2.disabled=true;
            chk3.disabled=true;
            chk4.disabled=true;
            chk5.disabled=true;
            chk6.disabled=true;
            chk7.disabled=true;
        }

    }

</script>
<footer class="w3-center w3-pale-blue w3-padding w3-hide-small w3-hide-medium" style="margin-left: 14.5em;">
    <p><small>Banquerohan National High School <i class="fa fa-copyright"></i> <?php echo date("Y"); ?></small></p>
</footer>

<footer class="w3-center w3-pale-blue w3-padding w3-hide-large">
    <p><small>Banquerohan National High School <i class="fa fa-copyright"></i> <?php echo date("Y"); ?></small></p>
</footer>
</body>
<!-- Mirrored from www.w3schools.com/w3css/tryit.asp?filename=tryw3css_templates_gourmet_catering&stacked=h, 2017-07-01 04:11:04 GMT -->
</html>