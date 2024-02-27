<?php
include 'db_connect.php';
require ('auth.php');
require 'header.php'; 

if(isset($_POST['Seminar'])){

    $reg_id = $_POST['reg_id'];
    $sem_name = $_POST['sem_name'];
    $sem_duration = $_POST['sem_duration'];
    $sem_organiser = $_POST['sem_organiser'];
    $sem_date = $_POST['sem_date'];
    $dept_id = $_SESSION['register_dept'];

    $query1= "SELECT register_dept FROM register WHERE register_id = ".$reg_id;
    $data1 = mysqli_query($con, $query1);
    $row1 = mysqli_fetch_array($data1);
  
    $dept_id = $row1[0];
    
    //validations
    if(is_numeric($sem_duration)){
        if(preg_match('~[0-9]+~', $sem_organiser)){
            echo "<script>alert('Do not add any numbers in Organizer name')</script>";
        }
        else
        {
            $target_dir = 'uploads/';
            $proof = $target_dir . basename($_FILES["filepath"]["name"]);
            $imageFileType = pathinfo($proof,PATHINFO_EXTENSION);
            
            move_uploaded_file($_FILES["filepath"]["tmp_name"], $proof);
            $target_dir = 'uploads/';
            $proof = $target_dir . basename($_FILES["filepath"]["name"]);
            $imageFileType = pathinfo($proof,PATHINFO_EXTENSION);
            
            $sql = "INSERT INTO seminar (register_id, dept_id, seminar_name, seminar_duration, seminar_organiser, seminar_date, seminar_certificate) VALUES ('$reg_id', '$dept_id','$sem_name', '$sem_duration', '$sem_organiser', '$sem_date','$proof')";
            $result = mysqli_query($con, $sql);
            $row = mysqli_affected_rows($con);
            //check if data is inserted
            if($row > 0)
            {
                echo "<script>alert('Seminar Added Succesfully')</script>";
            }
            else
            {
                echo "<script>alert('Something Went Wrong')</script>";
            }
        }
    }
    else{
        echo "<script>alert('Duration should be in numbers')</script>";
    }
}
   
?>
<html>
<body>
<button class="btn btn-sm btn-danger float-right btn-fill" style="margin-right:10px;margin-top:5px;" onclick="goBack()">Go Back</button>
<div class="container card" style="margin-top: 50px;width:85%;margin-left:50px;">

  <h2 class="text-center" style="margin-left: px;">Seminar</h2>
    </br>
    <form  method="POST" action="seminar.php" class="was-validated" enctype="multipart/form-data">
    <input type="hidden" name="reg_id" value="<?php echo $_SESSION['register_id']; ?>">
    <div class="form-group" style="width:70%">
        <label for="name">Name:</label>
        <input type="text" class="form-control" name="sem_name" required="true" value="">
    </div>
    <div class="form-group" style="width:70%">
        <label for="duration">Duration(in days):</label>
        <input type="number" class="form-control" name="sem_duration" required="true" value="">
    </div>
    <div class="form-group" style="width:70%">
        <label for="org_name">Organiser Name:</label>
        <input type="text" class="form-control" name="sem_organiser" required="true" value="">
    </div>
    <div style="width:70%">
        <label for="date">Date:</label>
        <input type="date" class="form-control" name="sem_date" required="true" value="">
    </div>
    <br>
    <div>
        <label for="proof">Upload Certificate:</label>
        <input type="file"  name="filepath" name="filepath" required="true">
    </div>
    <br>
    <input type="submit" name="Seminar" class="btn btn-success btn-fill" value="Submit" style="margin-left: px;">  
    <br><br>
    </form>
</div>

</br>
</div>
</body>
</html>
<script>
function goBack() {
  window.history.back();
}
</script>
<script>
   document.getElementById("sem").className += "active";
</script>
