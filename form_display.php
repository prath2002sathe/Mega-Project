<?php 
require('auth.php');
require('header.php');
require('db_connect.php');
$register_access = $_SESSION['register_access'];


?>
<div class="container text-center" style="margin-top:250px;">
    
    <a href="journal_display.php?self=1" class="btn btn-lg btn-primary btn-fill"> JOURNAL</a>
    <a href="conference_display.php?self=1" class="btn btn-lg btn-primary btn-fill">CONFERENCE </a>
    <a href="workshop_display.php?self=1" class="btn btn-lg btn-primary btn-fill">WORKSHOP </a>
    <a href="seminar_display.php?self=1" class="btn btn-lg btn-primary btn-fill">SEMINAR </a>
    <a href="fdp_display.php?self=1" class="btn btn-lg btn-primary btn-fill">FDP </a>
           
         
</div>


<!-- Argon Scripts -->
<!-- Core -->
<script src="assets/vendor/jquery/dist/jquery.min.js"></script>
<script src="assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/js-cookie/js.cookie.js"></script>
<script src="assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
<script src="assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
<!-- Argon JS -->
<script src="assets/js/argon.js?v=1.2.0"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
   document.getElementById("form").className += "active";
    
</script>
