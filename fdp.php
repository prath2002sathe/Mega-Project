<?php
require ('auth.php');
include 'db_connect.php';
require 'header.php';

if(isset($_POST['fdp_submit'])){

    $reg_id = $_POST['reg_id'];
    $fdp_name = $_POST['fdp_name'];
    $fdp_topic = $_POST['fdp_topic'];
    $fdp_duration = $_POST['fdp_duration'];
    $fdp_organiser = $_POST['fdp_organiser'];
    $fdp_date = $_POST['fdp_date'];
    $fdp_resource = $_POST['fdp_resource'];
    $dept_id = $_SESSION['register_dept']; 

    //validations
    if(is_numeric($fdp_duration)){
        if(preg_match('~[0-9]+~', $fdp_organiser)){
            echo "<script>alert('Do not add any numbers in Organizer name')</script>";
        }
        else
        {
            if(preg_match('~[0-9]+~', $fdp_resource)){
                echo "<script>alert('Do not add any numbers in Resource Person name')</script>";
            }
            else
            {
                if($_FILES["fdp_certificate"]["name"] != "")
                {  
                    $target_dir = 'uploads/';
                    $proof = $target_dir . basename($_FILES["fdp_certificate"]["name"]);
                    $imageFileType = pathinfo($proof,PATHINFO_EXTENSION);
                    
                    move_uploaded_file($_FILES["fdp_certificate"]["tmp_name"], $proof);
                    $target_dir = 'uploads/';
                    $proof = $target_dir . basename($_FILES["fdp_certificate"]["name"]);
                    $imageFileType = pathinfo($proof,PATHINFO_EXTENSION);
                }
                else
                {
                    $proof = NULL;
                }

                //check yes or no 
                $fdp_tada = $_POST['fdp_tada'];
                if($fdp_tada == 1)
                {
                    $target_dir = 'uploads/';
                    $receipt = $target_dir . basename($_FILES["fdp_receipt"]["name"]);
                    $imageFileType = pathinfo($proof,PATHINFO_EXTENSION);
                    
                    move_uploaded_file($_FILES["fdp_receipt"]["tmp_name"], $proof);
                    $target_dir = 'uploads/';
                    $receipt = $target_dir . basename($_FILES["fdp_receipt"]["name"]);
                    $imageFileType = pathinfo($proof,PATHINFO_EXTENSION);
                }
                else
                {
                    $receipt = NULL;
                }

                                                        
                $sql = "INSERT INTO fdp (register_id, dept_id, fdp_name, fdp_topic, fdp_duration, fdp_organiser, fdp_date, fdp_certificate, fdp_resource, fdp_status, fdp_status_receipt) VALUES ('$reg_id','$dept_id', '$fdp_name', '$fdp_topic', '$fdp_duration', '$fdp_organiser','$fdp_date','$proof','$fdp_resource','$fdp_tada','$receipt')";
                $result = mysqli_query($con, $sql);
                $row = mysqli_affected_rows($con);
                //check if data is inserted
                if($row > 0)
                {
                    echo "<script>alert('FDP Added Succesfully')</script>";
                }
                else
                {
                    echo "<script>alert('Something Went Wrong')</script>";
                }
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

  <h2  class="text-center" style="margin-left: px;">Faculty Development Program</h2>
    </br>
    <form action="fdp.php" method="POST" class="was-validated" enctype="multipart/form-data">
    <input type="hidden" name="reg_id" value="<?php echo $_SESSION['register_id']; ?>">
    <div class="form-group" style="width:70%">
        <label for="name">Name:</label>
        <input type="text" class="form-control" name="fdp_name" required="true" value="">
    </div>
    <div class="form-group" style="width:70%">
        <label for="topic">Topic:</label>
        <input type="text" class="form-control" name="fdp_topic" required="true" value="">
    </div>
    <div class="form-group" style="width:70%">
        <label for="duration">Duration(in days):</label>
        <input type="number" class="form-control" name="fdp_duration" required="true" value="">
    </div>
    <div class="form-group" style="width:70%">
        <label for="org_name">Organiser Name:</label>
        <input type="text" class="form-control" name="fdp_organiser" required="true" value="">
    </div>
    <div style="width:70%">
        <label for="date">Date:</label>
        <input type="date" class="form-control" name="fdp_date" required="true" value="">
    </div>
    <br>
    <div class="form-group" style="width:70%">
        <label for="resource">Resource Person:</label>
        <input type="text" class="form-control" name="fdp_resource" required="true" value="">
    </div>
    <div>
        <label for="proof">Upload Certificate:</label>
        <input type="file" name="fdp_certificate" value="">
    </div>
    <br>
    <div class="form-group" style="width:70%">
        <label for="type">Is TA/DA provided by College?:</label>
        <select id="tada" name="fdp_tada" onchange="is_tada(this.value)">                      
            <option value="1">Yes</option>
            <option value="2" selected>No</option>
        </select>
    </div>
    <!-- if yes then show this-->
    <div id="show_this" style="display:none;">
        <label for="proof">Upload Receipt:</label>
        <input type="file" name="fdp_receipt" value="">
    </div>
    <input type="submit" name="fdp_submit" class="btn btn-success btn-fill" value="submit" style="margin-left: px;">  
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

document.getElementById("fdp").className += "active";

//TA/DA 
function is_tada(data)
{
    if(data == 1){
        document.getElementById('show_this').style.display = 'block';
    }   
    else
    {
        document.getElementById('show_this').style.display = 'none';
    }
}

</script>
