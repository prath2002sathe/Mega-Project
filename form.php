<?php
include 'db_connect.php';
session_start();
//check if old password matches and if yes change password
if(isset($_POST['reset_pass'])){
    $old_pass = $_POST['old_pass'];
    $new_pass = $_POST['new_pass'];
    $reg_id = $_SESSION['register_id'];
  
    $sql = "SELECT * FROM register  WHERE register_id= '$reg_id' and register_password= '$old_pass'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_num_rows($result);
  
    //check if old password is correct 
    if($row <1)
    {
        echo "Old password is not correct";
    }
    else
    {
      $sql="UPDATE register SET register_password = '$new_pass' WHERE register_id = '$reg_id'"; 
      $result = mysqli_query($con, $sql);

      echo "Password changed";
    }
}

//personal page code
if(isset($_POST['settings'])){
    //check 
    if($_POST['settings'] == 1){

     

        $reg_id = $_POST['reg_id'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $contact = $_POST['contact'];
        $address = $_POST['address'];
        $birth = $_POST['birth'];
        $joining = $_POST['joining'];
        $designation = $_POST['designation'];
        
        //validation 

        //email validation 
         //remove if any spaces from email
      $email = str_replace(' ', '', $email);
      $email = strtolower($email);
      //check if .com or .in orelse reject 
      $check_extension = substr($email, strpos($email, ".") + 1);    
      //echo "<script>alert('".$check_extension."')</script>";
      if($check_extension == "com" || $check_extension == "in"){
          // continue
      }
      else{
          $error = "Fill correct email format";
          echo $error;
          exit();
      }
     // echo "<script>alert(".$error.")</script>";

        //check date of joining for birthday and joining month
        //find age of user
        $dateOfBirth = $birth;
        $today = date("Y-m-d");
        $diff = date_diff(date_create($dateOfBirth), date_create($today));
        if(($diff->format('%y')) <= 25 )
        {
            $error = "User can only be greater than 25 years of age";
            echo $error;
            exit();
        }
        else
        {
            $time = strtotime(date("Y-m-d"));
            $final = date("Y-m-d", strtotime("+1 month", $time));
            if($final < $joining)
            {
                echo "Date of joining should be less than one month";
                exit();
            }
        }
        

        //update
        $sql = "UPDATE register SET register_email = '$email', register_name = '$name', register_mobile = '$contact', register_address = '$address', register_dob = '$birth', register_doj = '$joining', register_designation = '$designation' WHERE register_id = '$reg_id'";
        $result = mysqli_query($con,$sql);
        $row = mysqli_affected_rows($con);
        if($row > 0)
        {
            //upload file 
            echo 'Saved Successfully';
        }
        else
        {
            echo 'Something went wrong / Nothing Updated';
        }
    }
}

?>