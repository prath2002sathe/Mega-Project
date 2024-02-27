<?php
require ('auth.php');
include 'db_connect.php';
//check if data is already present 

$register_id = $_SESSION['register_id'];
$sql2="SELECT * FROM register WHERE register_id = $register_id";
$fire = mysqli_query($con,$sql2);
$row = mysqli_fetch_assoc($fire);
$r = mysqli_num_rows($fire);
 if($r>0)
 {
   $name= $row['register_name'];
   $email = $row['register_email'];
   $mobile = $row['register_mobile'];
   $address = $row['register_address'];
   $dob = $row['register_dob'];
   $doj = $row['register_doj'];
   $designation = $row['register_designation'];
   $proof =$row['register_upload'];
   //$access = $row['personal_access'];
 }


if(isset($_POST['submit'])){

    
  $target_dir = 'uploads/';
  $proof = $target_dir . basename($_FILES["filepath"]["name"]);
  $imageFileType = pathinfo($proof,PATHINFO_EXTENSION);
  
  move_uploaded_file($_FILES["filepath"]["tmp_name"], $proof);
  $target_dir = 'uploads/';
  $proof = $target_dir . basename($_FILES["filepath"]["name"]);
  $imageFileType = pathinfo($proof,PATHINFO_EXTENSION);
 

  $sql = "UPDATE register SET register_upload = '$proof' WHERE register_id = '$register_id'";
  $result = mysqli_query($con,$sql);
  $row = mysqli_affected_rows($con);
  if($row > 0)
  {
      //upload file 
      echo "<script>alert('Uploaded Successfully');</script>";
  }
  else
  {
    echo "<script>alert('Something went wrong/Nothing uploaded');</script>";
  }
  
}

?>
  <?php
      require 'header.php';
  ?>
  <html>
<body>
<!--Personal information  form begin-->
<div class="container card" style="margin-top: 50px;width:85%;margin-left:50px;">
    <h2 class="text-center" style="margin-left: px;">Personal Details</h2>
    </br>
    <form id="personal" class="was-validated">
    <input type="hidden" id="reg_id" value="<?php echo $register_id; ?>"/> 
    <div class="form-group" style="width:70%">
        <label for="pname">Full Name:</label>
        <input type="text" class="form-control"  id="name" required="true"  value="<?php if($r>0){echo $name;} ?>" required>
    </div>
    <div class="form-group" style="width:70%">
        <label for="email">Email:</label>
        <input type="email" class="form-control" id="email" required="true" value="<?php if($r>0){echo $email;} ?>" required>
    </div>
    <div class="form-group" style="width:70%">
        <label for="phone">Contact:</label>
        <input type="tel" maxlength="10" minlength="10" class="form-control" id="mobile" required="true" value="<?php if($r>0){echo $mobile;} ?>" required>
    </div>
    <div class="form-group" style="width:70%">
        <label for="per_address">Address:</label>
        <input type="text" class="form-control" id="address" required="true" value="<?php if($r>0){echo $address;} ?>">
    </div>
    <div style="width:70%">
        <label for="d_birth">Date Of Birth:</label>
        <input type="date" class="form-control" id="dob" required="true" value="<?php if($r>0){echo $dob;} ?>">
    </div>
    <br>
    <div style="width:70%">
        <label for="d_join">Date Of Joining:</label>
        <input type="date" class="form-control" id="doj" required="true" value="<?php if($r>0){echo $doj;} ?>">
    </div>
    <br>
    <div class="form-group" style="width:70%">
        <label for="design">Current Designation:</label>
        <input type="text" class="form-control" id="designation" required="true" value="<?php if($r>0){echo $designation;} ?>" required>
    </div>
    
    <br>
    <input type="submit" class="btn btn-success btn-fill">  
    <br><br>
    </form>
    
    <form action="personal.php" method="POST" enctype="multipart/form-data">
        <div class="" style="width:70%">
            <label for="proof">Upload Profile:</label>
            <input type="file"  name="filepath" id="filepath" required="true">
        </div>
        <br>
        <input type="submit" name="submit" class="btn btn-success btn-fill" value="Submit" style="margin-left: px;">  
    
        </form>
        <br>
        <?php if(($proof!=NULL) || ($proof!="")){ ?>
    <a href="<?php echo $proof; ?>" target="_blank">View Profile</a>
    <?php } ?>
    <br>
</div>
<!--end-->
</br>
</div>
</body>
</html>
 
<script>
   document.getElementById("per").className += "active";   
</script>

<!--ajax-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
 $('#personal').bind('submit', function (e) {
 e.preventDefault();
  var name = document.getElementById("name").value;
  var reg_id = document.getElementById("reg_id").value;
  var email = document.getElementById("email").value;
  var contact = document.getElementById("mobile").value;
  var address = document.getElementById("address").value;
  var birth = document.getElementById("dob").value;
  var joining = document.getElementById("doj").value;
  var designation = document.getElementById("designation").value;
  //var filepath = document.getElementById("filepath").value;
 // var filepath = document.getElementById("filepath").files[0].name; 

  $.ajax({
            type: 'post',
            url: 'form.php',
            data: {
                'settings':1,
                'reg_id':reg_id,
                'name':name,
                'email':email,
                'contact':contact,
                'address':address,
                'birth':birth,
                'joining':joining,
                'designation':designation
                
            },
            success: function (response) {
             alert(response);
            }
      })
 });


</script>
