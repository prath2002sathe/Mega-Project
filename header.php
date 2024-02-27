
<?php 
include('db_connect.php');
$register_id = $_SESSION['register_id'];
$register_access = $_SESSION['register_access'];
$module = $_SESSION['module'];

$query = "SELECT u.register_upload,register_dept,register_name FROM register AS u WHERE register_id = '$register_id'";
$result_array = mysqli_fetch_assoc(mysqli_query($con, $query)); 
$actual_image_name = $result_array['register_upload'];
?>
 
 <!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8" />
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Dashboard</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
    <!-- CSS Files -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/css/light-bootstrap-dashboard.css?v=2.0.0 " rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="assets/css/demo.css" rel="stylesheet" />
</head>

<body id="sidebarr" style="background-color:whitesmoke;">
<input id="is_hidden" type="hidden" name="is_hidden" value="0">

    <div class="wrapper">

        <div  class="sidebar" data-image="">
            <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | blue | green | orange | red"

        Tip 2: you can also add an image using data-image tag
    -->
            <div class="sidebar-wrapper"  >
                <div class="logo">
                    <a href="" class="simple-text">
                        SITCOE
                    </a>
                   
                   
                </div>
                <ul class="nav">
                      <li class="nav-item ">
                        <a class="nav-link    " href="index.php" id="">
                            <i class="nc-icon nc-chart-pie-35"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    
                <?php if($_SESSION['register_access'] == "1") //faculty
                {
                ?>
                    <li class="nav-item ">
                        <a class="nav-link    " href="index.php" id="">
                            <i class="nc-icon nc-chart-pie-35"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link    " href="personal.php" id="per">
                            <i class="nc-icon nc-badge"></i>
                            <p>Personal Details</p>
                        </a>
                    </li>
                   <li class="nav-item ">
                        <a class="nav-link    " href="publication_display.php" id="">
                            <i class="nc-icon nc-notes"></i>
                            <p>Publication</p>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link    " href="seminar.php" id="sem">
                            <i class="nc-icon nc-notes"></i>
                            <p>Seminar</p>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link    " href="workshop.php" id="">
                            <i class="nc-icon nc-notes"></i>
                            <p>Workshop</p>
                        </a>
                          
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link    " href="fdp.php" id="fdp">
                            <i class="nc-icon nc-notes"></i>
                            <p>FDP</p>
                        </a>
                          
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link    " href="form_display.php" id="fdp">
                            <i class="nc-icon nc-single-copy-04"></i>
                            <p>FILLED DATA</p>
                        </a>
                          
                    </li> 
                    <?php 
                    } 
                    ?>
                   
                     <?php if($_SESSION['register_access'] == "2") //module incharge
                    {
                        if($_SESSION['module'] == "1"){
                    ?>
                    <li class="nav-item ">
                        <a class="nav-link    " href="personal.php" id="per">
                            <i class="nc-icon nc-badge"></i>
                            <p>Personal Details</p>
                        </a>
                    </li>
                  <!--   <li class="nav-item ">
                        <a class="nav-link    " href="publication_display.php" id="">
                            <i class="nc-icon nc-notes"></i>
                            <p>Publication</p>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link    " href="seminar.php" id="sem">
                            <i class="nc-icon nc-notes"></i>
                            <p>Seminar</p>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link    " href="workshop.php">
                            <i class="nc-icon nc-notes"></i>
                            <p>Workshop</p>
                        </a>
                          

                    </li>
                    <li class="nav-item ">
                        <a class="nav-link    " href="fdp.php" id="fdp">
                            <i class="nc-icon nc-notes"></i>
                            <p>FDP</p>
                        </a>
                          
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link    " href="form_display.php" id="fdp">
                            <i class="nc-icon nc-single-copy-04"></i>
                            <p>FILLED DATA</p>
                        </a>
                          
                    </li>  -->
                    <?php 
                    } 

                    ?>
                    <?php 
                    if($_SESSION['module'] == "2"){
                    ?>
                    <li class="nav-item ">
                        <a class="nav-link    " href="personal.php" id="per">
                            <i class="nc-icon nc-badge"></i>
                            <p>Personal Details</p>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link    " href="publication_display.php" id="">
                            <i class="nc-icon nc-notes"></i>
                            <p>Publication</p>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link    " href="seminar_display.php" id="sem">
                            <i class="nc-icon nc-notes"></i>
                            <p>Seminar</p>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link    " href="workshop.php">
                            <i class="nc-icon nc-notes"></i>
                            <p>Workshop</p>
                        </a>
                          
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link    " href="fdp.php" id="fdp">
                            <i class="nc-icon nc-notes"></i>
                            <p>FDP</p>
                        </a>
                          
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link    " href="form_display.php" id="fdp">
                            <i class="nc-icon nc-single-copy-04"></i>
                            <p>FILLED DATA</p>
                        </a>
                          
                    </li>
                    <?php 
                    } 
                    
                    ?>
                     <?php 
                    if($_SESSION['module'] == "3"){
                    ?>


                    <li class="nav-item ">
                        <a class="nav-link    " href="personal.php" id="per">
                            <i class="nc-icon nc-badge"></i>
                            <p>Personal Details</p>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link    " href="publication_display.php" id="">
                            <i class="nc-icon nc-notes"></i>
                            <p>Publication</p>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link    " href="seminar.php" id="sem">
                            <i class="nc-icon nc-notes"></i>
                            <p>Seminar</p>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link    " href="workshop_display.php">
                            <i class="nc-icon nc-notes"></i>
                            <p>Workshop</p>
                        </a>
                          
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link    " href="fdp.php" id="fdp">
                            <i class="nc-icon nc-notes"></i>
                            <p>FDP</p>
                        </a>
                          
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link    " href="form_display.php" id="fdp">
                            <i class="nc-icon nc-single-copy-04"></i>
                            <p>FILLED DATA</p>
                        </a>
                          
                    </li>
                    <?php 
                    } 
                    
                    ?>
                     <?php 
                    if($_SESSION['module'] == "4"){
                    ?>
                    <li class="nav-item ">
                        <a class="nav-link    " href="personal.php" id="per">
                            <i class="nc-icon nc-badge"></i>
                            <p>Personal Details</p>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link    " href="publication_display.php" id="">
                            <i class="nc-icon nc-notes"></i>
                            <p>Publication</p>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link    " href="seminar.php" id="sem">
                            <i class="nc-icon nc-notes"></i>
                            <p>Seminar</p>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link    " href="workshop.php">
                            <i class="nc-icon nc-notes"></i>
                            <p>Workshop</p>
                        </a>
                          
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link    " href="fdp_display.php" id="fdp">
                            <i class="nc-icon nc-notes"></i>
                            <p>FDP</p>
                        </a>
                          
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link    " href="form_display.php" id="fdp">
                            <i class="nc-icon nc-single-copy-04"></i>
                            <p>FILLED DATA</p>
                        </a>
                          
                    </li>
                    <?php 
                    } 
                    }
                    ?>
                     <?php if($_SESSION['register_access'] == "3") //main incharge
                    {
                    
                    if($_SESSION['register_id']!=1){
                    ?>
                    <li class="nav-item ">
                        <a class="nav-link    " href="personal.php" id="per">
                            <i class="nc-icon nc-badge"></i>
                            <p>Personal Details</p>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link    " href="publication_display.php" id="">
                            <i class="nc-icon nc-notes"></i>
                            <p>Publication</p>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link    " href="seminar_display.php" id="sem">
                            <i class="nc-icon nc-notes"></i>
                            <p>Seminar</p>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link    " href="workshop_display.php">
                            <i class="nc-icon nc-notes"></i>
                            <p>Workshop</p>
                        </a>
                          
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link    " href="fdp_display.php" id="fdp">
                            <i class="nc-icon nc-notes"></i>
                            <p>FDP</p>
                        </a>
                          
                    </li>
                    <?php } ?>
                    <li class="nav-item ">
                        <a class="nav-link    " href="approval.php" id="app">
                            <i class="nc-icon nc-single-copy-04"></i>
                            <p>ACCESS GRANT</p>
                        </a>
                          
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link    " href="form_display.php" id="fdp">
                            <i class="nc-icon nc-single-copy-04"></i>
                            <p>FILLED DATA</p>
                        </a>
                          
                    </li>
                    <?php 
                    } 
                    ?>
                    <li>
                        <a class="nav-link" href="settings.php">
                            <i class="nc-icon nc-settings-gear-64"></i>
                            <p>Settings</p>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link" href="logout.php">
                            <i class="nc-icon nc-button-power"></i>
                            <p>Logout</p>
                        </a>
                    </li>
                   
                </ul>
            </div>
        </div>
        <div class="main-panel">
        <nav class="navbar navbar-expand-lg " color-on-scroll="500">
                <div class="container-fluid">
                <div class=""style="color:black;">
                        <?php if($_SESSION['register_access'] == "1"){echo "Faculty";} else if($_SESSION['register_access'] == "2"){echo "Module Incharge";} else if($_SESSION['register_access'] == "3"){echo "Main Incharge";}else {}?>
                    </div>
                    <div class=""style="color:black;">
                        <?php if($result_array['register_dept'] == 1){echo "(Computer Science)";} else if($result_array['register_dept'] == 2){echo "(Mechanical)";} else if($result_array['register_dept'] == 3){echo "(Civil)";}else if($result_array['register_dept'] == 4){echo "(Chemical)";}else if($result_array['register_dept'] == 5){echo "(E&TC)";}else {}?>
                    </div>
                   
                    <button  id="toggler" href="" style="display:block;" class="navbar-toggler navbar-toggler-left" type="button" onclick="hideshow()" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-bar burger-lines"></span>
                        <span class="navbar-toggler-bar burger-lines"></span>
                        <span class="navbar-toggler-bar burger-lines"></span>
                    </button>
                </div>
                <?php 
                   
                    echo  $result_array['register_name'];
                    if($_SESSION['register_id']!="1"){
                        echo '<img src="' . $actual_image_name . '" style="width:50px;height:50px;border-radius: 50%;margin-left:5px"/>';
                    }
                ?>
        </nav>
         

<!--   Core JS Files   -->
<script src="assets/js/core/jquery.3.2.1.min.js" type="text/javascript"></script>
<script src="assets/js/core/popper.min.js" type="text/javascript"></script>
<script src="assets/js/core/bootstrap.min.js" type="text/javascript"></script>
<!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
<script src="assets/js/plugins/bootstrap-switch.js"></script>
<!--  Google Maps Plugin    -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
<!--  Chartist Plugin  -->
<script src="assets/js/plugins/chartist.min.js"></script>
<!--  Notifications Plugin    -->
<script src="assets/js/plugins/bootstrap-notify.js"></script>
<!-- Control Center for Light Bootstrap Dashboard: scripts for the example pages etc -->
<script src="assets/js/light-bootstrap-dashboard.js?v=2.0.0 " type="text/javascript"></script>
<!-- Light Bootstrap Dashboard DEMO methods, don't include it in your project! -->
<script src="assets/js/demo.js"></script>


</html>

<script>
/* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
var dropdown = document.getElementsByClassName("dropdown-btn");
var i;

for (i = 0; i < dropdown.length; i++) {
  dropdown[i].addEventListener("click", function() {
  this.classList.toggle("active");
  var dropdownContent = this.nextElementSibling;
  if (dropdownContent.style.display === "block") {
  dropdownContent.style.display = "none";
  } else {
  dropdownContent.style.display = "block";
  }
  });
}



function hideshow(){
    var m = document.getElementById("is_hidden").value
    if (m == 0){
        document.getElementById("sidebarr").style.marginLeft = "-18%";
        document.getElementById("toggler").style.display = "block";
        document.getElementById("is_hidden").value = 1;
        
    }
    else if(m == 1)
    {
        document.getElementById("sidebarr").style.marginLeft = "0";
        document.getElementById("toggler").style.display = "block";
        document.getElementById("is_hidden").value = 0;
    }
    
}
</script>
