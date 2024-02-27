<?php
include 'db_connect.php';


//to check if user is logged in
session_start();
if(isset($_SESSION['is_loggedin'])){
    if($_SESSION['is_loggedin'] == 1)
    {
        if(isset($_SESSION['register_access']))                             //if session id is set
        {
            if($_SESSION['register_access'] == "1") //teacher
            header("Location: personal.php");
            elseif($_SESSION['register_access'] == "2") //hod
                header("Location: personal.php");   
            elseif($_SESSION['register_access'] == "3")
                header("Location: index.php");
            exit;
        }
        else
        {
            // do nothing
        }
    }
}else
{
    session_destroy();
}


//check if usernamem and password is correct 
if(isset($_POST['submit'])){
    $email = mysqli_real_escape_string($con,htmlspecialchars($_POST['email']));
    $password = mysqli_real_escape_string($con,htmlspecialchars($_POST['password']));
    $sql = "SELECT * FROM register  WHERE register_email=BINARY '$email'and register_password=BINARY '$password'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_num_rows($result);
        
        if($row <1)
        {
            echo "<script>alert('Invalid email or password')</script>";
            mysqli_close($con);
        }
        else
        {
            $row2 = mysqli_fetch_assoc($result);
            //check if access level is approved

            if($row2['register_approve'] == 1){
            
            session_start();
            // remind 
            $_SESSION['is_loggedin'] = 1;
            
            //sessions
            $_SESSION['register_id'] = $row2['register_id'];
            $_SESSION['register_access'] = $row2['register_access'];
            $_SESSION['register_dept'] = $row2['register_dept'];
            $_SESSION['module'] = $row2['module_id'];
           
                if(isset($_SESSION['register_access']))                             //if session id is set
                {
                    if($_SESSION['register_access'] == "1") //teacher
                    header("Location: personal.php");
                    elseif($_SESSION['register_access'] == "2") //hod
                        header("Location: personal.php");   
                    elseif($_SESSION['register_access'] == "3")
                        header("Location: index.php");
                    exit;
                }
            }
            else if($row2['register_approve'] == 0)
            {
                echo "<script>alert('You are not approved yet')</script>";
                mysqli_close($con);
            }
            else
            {
                echo "<script>alert('You are rejected')</script>";
                mysqli_close($con);
            }
        }
}
?>

<html>
    
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
<body style="background-image: url('img/bg.jpg'); background-size: cover;">
<nav>
    <pre style="font-size: 20px; text-align:center; color:white; margin-top:10px;">Sharad Institute of Technology College of Engineering, Yadrav
    An Autonomous Institute 
    NBA Accredited Programmes. An ‘A’ Grade Institute Accredited By NAAC, 
    An ISO 9001:2015 Accredited Enstatite.  
    Recognized u/s 2(f) & 12(B) Of The UGC Act 1956
</pre>
</nav>

<div class="container card float-center" style="margin-top:5%;margin-left:30%;background-color:white;width:40%">

<form class="" style="padding:2%;" method="POST" action="login.php">
<h3 class="text-center" style="">Login</h3>
  <div class="form-group" style="color:white;">
  <label for= "email"><b>Email</b></label>
    <input type="email" class="form-control"  name="email"   required>
  </div>
  <br>
  <div class="form-group" style="color:white;">
  <label for= "cpassword"><b>Password</b></label>
    <input type="password" class="form-control"  name="password"   required>
  </div>
  <div class="text-center">
  <br>
  <button name="submit" value="submit" type="submit" class="btn btn-danger btn-fill">SUBMIT</button>

  <br><br>
 <p > New User? <a href="register.php" >Register</a></p>
 </div>
  
 
</form>
</div>
</body>
</html>