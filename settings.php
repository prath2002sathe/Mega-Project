<?php
require ('auth.php');
include 'db_connect.php';
require 'header.php';
?>
<html>
<body>

<div class="container card" style="margin-top: 50px;width:85%;margin-left:50px;">
  <h2 class="text-center" style="margin-left: px;">Settings</h2>
    </br>
    <form action="settings.php" method="POST" class="was-validated">
    <div class="form-group" style="width:70%">
        <label for="password"><b>Old Password:</b></label>
        <input type="text" class="form-control" id="old" name="old_password" value="" required>
        <br>
        <label for="password"><b>New Password:</b></label>
        <input type="text" class="form-control" id="new" name="new_password" value="" required>
    </div>
    <div class="form-group" style="width:70%">
    <?php 
    /*<label for="dept"><b>Department:</b></label>
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
  <div class="form-group" style="width:50%">
  <label for="access"><b>Access:</b></label>
        <select class="form-control" name="access">
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
         */ ?>
    <br>
    <input value="Save" type="submit" class="btn btn-success btn-fill" style="margin-left: px;">  
    <br><br>
    </form>
</div>

</br>
</div>
</body>
</html>
 
<script>
   document.getElementById("setting").className += "active";
</script>
<!--ajax-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>

 $('form').bind('submit', function () {
  var old_pass = document.getElementById("old").value;
  var new_pass = document.getElementById("new").value;

  $.ajax({
            type: 'post',
            url: 'form.php',
            data: {
                'reset_pass':1,
                'old_pass':old_pass,
                'new_pass':new_pass
            },
            success: function (response) {
             alert(response);
            }
      })
 });

</script>