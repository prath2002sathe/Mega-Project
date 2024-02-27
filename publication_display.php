<?php 
require('auth.php');
require('header.php');
require('db_connect.php');
$register_access = $_SESSION['register_access'];


?>
<div class="container" style="margin-top:250px;">
    <div class="row text-center">
        <div class="col-sm-6 ">
            <?php if ($_SESSION['register_access'] != "1"){?>
            <a href="journal_display.php" class="btn btn-lg btn-primary btn-fill"> <i class="nc-icon nc-single-copy-04"></i> JOURNAL</a>
           
            <?php 
        }
        else{?>
            <a href="publication.php?type=1 " class="btn  btn-primary btn-fill">JOURNAL</a>
        <?php }?>
        </div>
        <div class="col-sm-6">
        <?php if ($_SESSION['register_access'] != "1"){?>
            <a href="conference_display.php" class="btn btn-lg btn-primary btn-fill"><i class="nc-icon nc-single-copy-04"></i> CONFERENCE</a>
            <?php }
        else{?>
             <a href="publication.php?type=2" class="btn btn-primary btn-fill">CONFERENCE</a>
        <?php }?>
        </div>
    </div>
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
   document.getElementById("pub").className += "active";
    
</script>
