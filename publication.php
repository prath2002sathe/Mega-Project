<?php
require ('auth.php');
include 'db_connect.php';
require 'header.php';
if(!isset($_GET['type']))
{
    //send back to previous page
    //pending 
}

if(isset($_POST['publication'])){
   //check form type
   if($_POST['form_type'] == 1)
   {
    $reg_id = $_POST['reg_id'];
    $journal_type = $_POST['journal_type'];
    $journal_title = $_POST['journal_title'];
    $journal_name = $_POST['journal_name'];
    $journal_doa = $_POST['journal_doa'];
    $journal_dop = $_POST['journal_dop'];
    $journal_impact = $_POST['journal_impact'];
    $journal_vol = $_POST['journal_vol'];
    $journal_issn = $_POST['journal_issn'];
    $journal_status = $_POST['journal_status'];
    $journal_isbn = $_POST['journal_isbn'];
    $journal_author = $_POST['journal_author'];
    $dept_id = $_SESSION['register_dept'];

    if($_FILES["journal_certificate"]["name"] != "")
    {  
        $target_dir = 'uploads/';
        $journal_certificate = $target_dir . basename($_FILES["journal_certificate"]["name"]);
        $imageFileType = pathinfo($journal_certificate,PATHINFO_EXTENSION);
        
        move_uploaded_file($_FILES["journal_certificate"]["tmp_name"], $journal_certificate);
        $target_dir = 'uploads/';
        $journal_certificate = $target_dir . basename($_FILES["journal_certificate"]["name"]);
        $imageFileType = pathinfo($journal_certificate,PATHINFO_EXTENSION);
    }
    else
    {
        $journal_certificate = NULL;
    }

    //move journal abstract image
    if($_FILES["journal_abstract"]["name"] != "")
    {  
        $target_dir = 'uploads/';
        $journal_abstract = $target_dir . basename($_FILES["journal_abstract"]["name"]);
        $imageFileType = pathinfo($journal_abstract,PATHINFO_EXTENSION);
        
        move_uploaded_file($_FILES["journal_abstract"]["tmp_name"], $journal_abstract);
        $target_dir = 'uploads/';
        $journal_abstract = $target_dir . basename($_FILES["journal_abstract"]["name"]);
        $imageFileType = pathinfo($journal_abstract,PATHINFO_EXTENSION);
    }
    else
    {
        $journal_abstract = NULL;
    }
    		
    $sql = "INSERT INTO journal (register_id, dept_id, journal_type, journal_title, journal_name, journal_doa, journal_dop, journal_impact_factor, journal_vol_no, journal_issn, journal_certificate, journal_abstract, journal_status, journal_isbn, journal_other_authors) VALUES ('$reg_id', '$dept_id', '$journal_type', '$journal_title', '$journal_name', '$journal_doa','$journal_dop','$journal_impact','$journal_vol','$journal_issn','$journal_certificate','$journal_abstract','$journal_status','$journal_isbn','$journal_author')";
    $result = mysqli_query($con, $sql);
    $row = mysqli_affected_rows($con);
    //check if data is inserted
    if($row > 0)
    {
        echo "<script>alert('Journal Added Succesfully')</script>";
        echo "<script>location.href='?type=1'</script>";
    }
    else
    {
        echo "<script>alert('Something Went Wrong')</script>";
    }


   }
   else if($_POST['form_type'] == 2){
    $reg_id = $_POST['reg_id'];
    $con_title = $_POST['con_title'];
    $con_name = $_POST['con_name'];
    $con_doa = $_POST['con_doa'];
    $con_dop = $_POST['con_dop'];
    $con_author = $_POST['con_author'];
    $dept_id = $_SESSION['register_dept'];

    $sql = "INSERT INTO conference (register_id, dept_id, con_title, con_name, con_doa, con_dop, con_auth_name) VALUES ('$reg_id', '$dept_id', '$con_title', '$con_name', '$con_doa', '$con_dop','$con_author')";
   
    $result = mysqli_query($con, $sql);
    $row = mysqli_affected_rows($con);
    //check if data is inserted
    if($row > 0)
    {
        echo "<script>alert('Conference Added Succesfully')</script>";
        echo "<script>location.href='?type=2'</script>";
    }
    else
    {
        echo "<script>alert('Something Went Wrong')</script>";
    }
   }
}

?>
<html>
<body>
<button class="btn btn-sm btn-danger float-right btn-fill" style="margin-right:10px;margin-top:5px;" onclick="goBack()">Go Back</button>
<div class="container card" style="margin-top: 50px;width:85%;margin-left:50px;">

  <h2 class="text-center"style="margin-left: px;">Publication</h2>
    </br>
    <form action="publication.php" method="POST" class=" align-items-center was-validated" enctype="multipart/form-data" >
    <input type="hidden" name="reg_id" value="<?php echo $_SESSION['register_id']; ?>">
    <input type="hidden" name="form_type" value="<?php echo $_GET['type']; ?>">
    <?php 
    if(isset($_GET['type'])){
    if($_GET['type'] == 1){
    ?>
    <!--if journal is selected-->
    <div class="" style="width:70%">
        <label for="type">Type:</label>
        <select id="type" name="journal_type">                      
            <option value="1">National</option>
            <option value="2">International</option>
        </select>
    </div>
    <div class="form-group" style="width:70%">
        <label for="title">Title:</label>
        <input type="text" class="form-control" name="journal_title" required="true" value="">
    </div>
    <div class="form-group" style="width:70%">
        <label for="name">Name:</label>
        <input type="text" class="form-control" name="journal_name" required="true" value="">
    </div>
    <div style="width:70%">
        <label for="date">Date of Acceptance:</label>
        <input type="date" class="form-control" name="journal_doa" required="true" value="">
    </div>
    <br>
    <div style="width:70%">
        <label for="date">Date of Publication:</label>
        <input type="date" class="form-control" name="journal_dop" required="true" value="">
    </div>
    <br>
    <div class="form-group" style="width:70%">
        <label for="impact">Impact Factor:</label>
        <input type="text" class="form-control" name="journal_impact" value="">
    </div>
    <div class="form-group" style="width:50%">
        <label for="volume">Volume No:</label>
        <input type="text" class="form-control" name="journal_vol" value="">
    </div>
    <div style="width:50%">
        <label for="issn">Issue No[ISSN]:</label>
        <input type="text" class="form-control" name="journal_issn" value="">
    </div>
    <br>
    <div>
        <label for="proof">Upload Certificate:</label>
        <input type="file" name="journal_certificate" value="">
    </div>
    <br>
    <div>
        <label for="proof">Upload Abstract:</label>
        <input type="file" name="journal_abstract" value="" required>
    </div>
    <br>
    <div class="form-group" style="width:50%">
        <label for="status">Status:</label>
        <select id="status" name="journal_status" required>                      
            <option value="1">Paid</option>
            <option value="2" selected>Unpaid</option>
        </select>
    </div>
    <div  style="width:50%;">
        <label for="isbn">ISBN No:</label>
        <input type="text" class="form-control" name="journal_isbn" value="">
    </div>
    <div style="width:50%">
        <label for="author">Other Author Names:</label>
        <input type="text" class="form-control" name="journal_author" value="" placeholder="Ram,Shiv">
    </div>
    <!--journal end-->
    <?php 
    }
    else if($_GET['type'] == 2)
    {
    ?>
    <!--if conference is selected-->
    <div class="form-group" style="width:50%">
        <label for="title">Title:</label>
        <input type="text" class="form-control" name="con_title" required="true" value="">
    </div>
    <div class="form-group" style="width:50%">
        <label for="name">Name:</label>
        <input type="text" class="form-control" name="con_name" required="true" value="">
    </div>
    <div style="width:50%">
        <label for="date">Date of Acceptance:</label>
        <input type="date" class="form-control" name="con_doa" required="true" value="">
    </div>
    <br>
    <div style="width:50%">
        <label for="date">Date of Publication:</label>
        <input type="date" class="form-control" name="con_dop" required="true" value="">
    </div>
    <div style="width:50%">
        <label for="author">Other Author Names:</label>
        <input type="text" class="form-control" name="con_author" value="" placeholder="Ram,Shiv">
    </div>
    <br>
    <!--conference end-->
    <?php 
    }}
    ?>

    <br>
    <input type="submit" name="publication" class="btn btn-success btn-fill" value="submit" style="margin-left: px;">  
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

document.getElementById("pub").className += "active";

</script>
