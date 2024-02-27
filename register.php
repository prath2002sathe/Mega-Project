<?php
require('db_connect.php');

if(isset($_POST['submit']) )
{
      $email = mysqli_real_escape_string($con,htmlspecialchars($_POST['email']));
      $dept = mysqli_real_escape_string($con,htmlspecialchars($_POST['dept']));
      $access = mysqli_real_escape_string($con,htmlspecialchars($_POST['access']));
      $module = mysqli_real_escape_string($con,htmlspecialchars($_POST['module']));
      $password = mysqli_real_escape_string($con,htmlspecialchars($_POST['cpassword']));
      
      /*if($access==1){
        if(isset($module)){
          echo "<script>alert('Module access is not available for Faculty!');</script>";
         exit();
        // header('Location:register.php');
        }
      }*/

      //validation 
      //remove if any spaces from email
      $email = str_replace(' ', '', $email);
      $email = strtolower($email);
      //check if .com or .in orelse reject 
      $check_extension = substr($email, strpos($email, ".") + 1);    
      //echo "<script>alert('".$check_extension."')</script>";
      if($check_extension == "com" || $check_extension == "in"){
          // continue

          //check if email id exists
          $check = "SELECT COUNT(register_email) as count1 FROM register WHERE register_email = '$email'";
          $count = mysqli_query($con,$check);
          $count = mysqli_fetch_assoc($count);
          $count = $count['count1'];
          if($count >= 1)
          {
            echo "<script>alert('Email ID Exists!');</script>";
          }
          else
          {
            //checking uniqueness for module incharge and main incharge. 
            //if an approved person is assigned then the system will throw an error.
            //if no approved person is in the position then a new user will get registered.
            if($access == 2 || $access == 3)
            {
              if($access==3){
                  $uniq = "SELECT COUNT(register_id) as num from `register` WHERE register_dept = '$dept'  AND register_access = '$access' AND register_approve = 1";
                }
              else{
                $uniq = "SELECT COUNT(register_id) as num from `register` WHERE module_id='$module' AND register_dept = '$dept'  AND register_access = '$access' AND register_approve = 1";
                
              } 
              $count1 = mysqli_query($con,$uniq);
              $count1 = mysqli_fetch_assoc($count1);
              $count1 = $count1['num'];

              if($count1 >= 1)
              {
                echo "<script>alert('There is a user appointed for this post!');</script>";
              }
              else
              {
                $sql="INSERT INTO register (register_email,register_dept,register_access,module_id,register_password) values ('$email','$dept','$access','$module','$password')";
                if(mysqli_query($con,$sql))
                {
                    echo "<script>alert('Successfully Registered!');</script>";
                    header('Location:login.php');
                }
                else
                {
                    echo "<script>alert('Something went wrong!');</script>";
                  // mysqli_error($con);
                }
              }
            }else{
              $sql="INSERT INTO register (register_email,register_dept,register_access,module_id,register_password) values ('$email','$dept','$access','$module','$password')";
              if(mysqli_query($con,$sql))
              {
                  echo "<script>alert('Successfully Registered!');</script>";
                  header('Location:login.php');
              }
              else
              {
                  echo "<script>alert('Something went wrong!');</script>";
                // mysqli_error($con);
              }
            }
          }
      }
      else{
          $error = "Fill correct email format";
          echo "<script>alert('".$error."')</script>";
      }
     // echo "<script>alert(".$error.")</script>";

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
<nav>
  <pre style="font-size: 20px; text-align:center; color:white; margin-top:15px;">Sharad Institute of Technology College of Engineering, Yadrav
    An Autonomous Institute 
    NBA Accredited Programmes. An ‘A’ Grade Institute Accredited By NAAC, 
    An ISO 9001:2015 Accredited Enstatite.  
    Recognized u/s 2(f) & 12(B) Of The UGC Act 1956
  </pre>
</nav>
<body style="background-image: url('img/bg.jpg'); background-size:cover;" >

<div class="container card float-left" style="margin-top:1%;margin-left:25%;background-color:white;width:50%">

<form class="" style="padding:2%;" method="POST" action="register.php">
<h3 class="text-center" style="">Registration</h3>
<br>
  
  <div class="form-group" style="color:white;">
  <label for= "email"><b>Email</b></label>
    <input type="email" class="form-control"  name="email"  required>
  </div>
  <br>

  <div class="form-group" style="color:white;">
    <label for="dept"><b>Department:</b></label>
   
        <select class="form-control" name="dept">
          <?php
         
          $sql1 = "SELECT * FROM `dept`";
          $fire1 = mysqli_query($con,$sql1);

          while($row = mysqli_fetch_array($fire1))
          {
          ?>
              <option value="<?php echo $row['dept_id'];?>"><?php echo htmlspecialchars($row['dept_name']); ?></option>
          <?php
          }
        ?>
          
        </select>
  </div>
  <br>
  <div class="form-group" style="color:white;">
  <label for="access"><b>Access:</b></label>
        <select class="form-control" id="tada" name="access" onchange="is_tada(this.value)">
          <?php
         
          $sql1 = "SELECT * FROM `access`";
          $fire1 = mysqli_query($con,$sql1);

          while($row = mysqli_fetch_array($fire1))
          {
          ?>
              <option value="<?php echo $row['access_id'];?>"><?php echo htmlspecialchars($row['access_name']); ?></option>
          <?php
          }
         
        ?>
         
        </select>
  </div>
  <br>
  <div class="form-group" id="show_this" style="display:none;color:white;">
  <label for="module"><b>Modules:</b></label>
        <select class="form-control" name="module">
          <?php
         
          $sql1 = "SELECT * FROM `module`";
          $fire1 = mysqli_query($con,$sql1);

          while($row = mysqli_fetch_array($fire1))
          {
          ?>
              <option value="<?php echo $row['module_id'];?>"><?php echo htmlspecialchars($row['module_name']); ?></option>
          <?php
          }
         
        ?>
         
        </select>
  </div>
  <br>
  <div class="form-group" style="color:white;">
  <label for= "cpassword"><b>Password</b></label>
    <input type="password" class="form-control"  name="cpassword" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"  required>
    <span style="color:white">Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters</span>
  </div>
 
  <br>
  <div class="text-center">
  <button name="submit" value="submit" type="submit" class="btn btn-danger btn-fill" >SUBMIT</button>
 

  <br><br>
 <p> Already have an account? <a href="login.php" >Login</a></p>
 </div>
 
</form>
</div>
</body>
</html>
<script>
//module incharge 
function is_tada(data)
{
    if(data == 2){
        document.getElementById('show_this').style.display = 'block';
    }   
    else
    {
        document.getElementById('show_this').style.display = 'none';
    }
}

  </script>