<?php
require 'auth.php';
include 'db_connect.php';
require 'header.php';

if(isset($_POST['Workshop'])){

    $reg_id = $_POST['reg_id'];
    $workshop_name = $_POST['workshop_name'];
    $workshop_topic = $_POST['workshop_topic'];
    $workshop_duration = $_POST['workshop_duration'];
    $workshop_organiser = $_POST['workshop_organiser'];
    $workshop_date = $_POST['workshop_date'];
    $workshop_resource = $_POST['workshop_resource'];
   $dept_id = $_SESSION['register_dept'];

    //validations
    if(is_numeric($workshop_duration)){
        if(preg_match('~[0-9]+~', $workshop_organiser)){
            echo "<script>alert('Do not add any numbers in Organizer name')</script>";
        }
        else
        {
            if(preg_match('~[0-9]+~', $workshop_resource)){
                echo "<script>alert('Do not add any numbers in Resource Person name')</script>";
            }
            else
            {

                if($_FILES["workshop_certificate"]["name"] != "")
                {  
                    $target_dir = 'uploads/';
                    $proof = $target_dir . basename($_FILES["workshop_certificate"]["name"]);
                    $imageFileType = pathinfo($proof,PATHINFO_EXTENSION);
                    
                    move_uploaded_file($_FILES["workshop_certificate"]["tmp_name"], $proof);
                    $target_dir = 'uploads/';
                    $proof = $target_dir . basename($_FILES["workshop_certificate"]["name"]);
                    $imageFileType = pathinfo($proof,PATHINFO_EXTENSION);
                }
                else
                {
                    $proof = NULL;
                }

                //check yes or no 
                $workshop_tada = $_POST['workshop_tada'];
                if($workshop_tada == 1)
                {
                    $target_dir = 'uploads/';
                    $receipt = $target_dir . basename($_FILES["workshop_receipt"]["name"]);
                    $imageFileType = pathinfo($proof,PATHINFO_EXTENSION);
                    
                    move_uploaded_file($_FILES["workshop_receipt"]["tmp_name"], $proof);
                    $target_dir = 'uploads/';
                    $receipt = $target_dir . basename($_FILES["workshop_receipt"]["name"]);
                    $imageFileType = pathinfo($proof,PATHINFO_EXTENSION);
                }
                else
                {
                    $receipt = NULL;
                }

                                                        
                $sql = "INSERT INTO workshop (register_id, dept_id, workshop_name, workshop_topic, workshop_duration, workshop_organiser, workshop_date, workshop_certificate, workshop_resource, workshop_status, workshop_status_receipt) VALUES ('$reg_id', '$dept_id', '$workshop_name', '$workshop_topic', '$workshop_duration', '$workshop_organiser','$workshop_date','$proof','$workshop_resource','$workshop_tada','$receipt')";
                $result = mysqli_query($con, $sql);
                $row = mysqli_affected_rows($con);
                //check if data is inserted
                if($row > 0)
                {
                    echo "<script>alert('Workshop Added Succesfully')</script>";
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

  <h2 class="text-center" style="margin-left: px;">Workshop</h2>
    </br>
    <form action="workshop.php" method="POST" class="was-validated" enctype="multipart/form-data">
    <input type="hidden" name="reg_id" value="<?php echo $_SESSION['register_id']; ?>">
    <div class="form-group" style="width:70%">
        <label for="name">Name:</label>
        <input type="text" class="form-control" name="workshop_name" required="true" value="">
    </div>
    <div class="form-group" style="width:70%">
        <label for="topic">Topic:</label>
        <input type="text" class="form-control" name="workshop_topic" required="true" value="">
    </div>
    <div class="form-group" style="width:70%">
        <label for="duration">Duration(in days):</label>
        <input type="number" class="form-control" name="workshop_duration" required="true" value="">
    </div>
    <div class="form-group" style="width:70%">
        <label for="org_name">Organiser Name:</label>
        <input type="text" class="form-control" name="workshop_organiser" required="true" value="">
    </div>
    <div style="width:70%">
        <label for="date">Date:</label>
        <input type="date" class="form-control" name="workshop_date" required="true" value="">
    </div>
    <br>
    <div class="form-group" style="width:70%">
        <label for="resource">Resource Person:</label>
        <input type="text" class="form-control" name="workshop_resource" required="true" value="">
    </div>
    <div>
        <label for="proof">Upload Certificate:</label>
        <input type="file" name="workshop_certificate" value="">
    </div>
    <br>
    <div class="form-group" style="width:70%">
        <label for="type">Is TA/DA provided by College?:</label>
        <select id="tada" name="workshop_tada" onchange="is_tada(this.value)">                      
            <option value="1">Yes</option>
            <option value="2" selected>No</option>
        </select>
    </div>
    <!-- if yes then show this-->
    <div id="show_this" style="display:none;">
        <label for="proof">Upload Receipt:</label>
        <input  type="file" name="workshop_receipt" value="">
    </div>
    <input type="submit" name="Workshop" class="btn btn-success btn-fill" value="submit" style="margin-left: px;">  
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

document.getElementById("workshop").className += "active";


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
