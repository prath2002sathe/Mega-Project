<?php 
require('auth.php');
require('header.php');
require('db_connect.php');


//approve 
if(isset($_GET['approve']) && isset($_GET['reg_id'])){
    if( $_GET['approve'] == 1){
        //write query to update 
        $reg_id = $_GET['reg_id'];
        $sql="UPDATE register SET register_approve = 1 WHERE register_id = '$reg_id'"; 
        $result = mysqli_query($con, $sql);

        echo "<script>alert('Approved')</script>";
        echo "<script>location.href='approval.php'</script>";
    }
}

//reject
if(isset($_GET['reject']) && isset($_GET['reg_id'])){
    if( $_GET['reject'] == 1){
        //write query to update 
        $reg_id = $_GET['reg_id'];
        $sql="UPDATE register SET register_approve = 3 WHERE register_id = '$reg_id'"; 
        $result = mysqli_query($con, $sql);

        echo "<script>alert('Rejected')</script>";
        echo "<script>location.href='approval.php'</script>";
    }
}
?>
<div class="container" style="margin-top:50px;">
<h2 class="text-center"><b>ACCESS GRANT</b></h2>
<div class="table-responsive container  text-center table-bordered " style="margin-left:-15px;" >
    <table id="print" class="  " style="width:104%">
    <thead class=" " style="background-color:#9775D9;font-size:0.9em;">
            <tr class ="" style="padding:2px;">
                <th scope="col" class="sort text-center" data-sort="serial_no">Serial No.</th>
                <th scope="col" class="sort text-center" data-sort="facname">Email</th>
                <th scope="col" class="sort text-center" data-sort="title">Department</th>
                <th scope="col" class="sort text-center" data-sort="name">Access Level</th>
                <th scope="col" class="sort text-center" data-sort="dop">Action</th>
              
            </tr>
        </thead>
        <tbody class="list"  style="background-color:white;padding:2px;">
            <?php 
            $dept_id = $_SESSION['register_dept'];
            $register_id = $_SESSION['register_id'];
        
           // if($_SESSION['register_id']!=1){
                $sql="SELECT * FROM register INNER JOIN dept ON register.register_dept = dept.dept_id WHERE  register_dept = '$dept_id' AND register_id != '$register_id'";   
            //}
            //super user 
            // else 
            // {
            //     $sql="SELECT * FROM register INNER JOIN dept ON register.register_dept = dept.dept_id WHERE register_approve = 0  AND register_id != '$register_id' AND register_access = 3";  

            // }
            $i = 0;
            $result = mysqli_query($con, $sql);
            $no = mysqli_num_rows($result);
            if($no == 0){
                //if no data is aval 
                //echo "<script>alert('NO RESULTS AVAILABLE');</script>";
                echo "NO RESULTS AVAILABLE";
            }
            else{
            while($row = mysqli_fetch_array($result))
            {
            $i++;
            ?>
            <tr>
                <td><?php echo $i ?></td>
                <td><?php echo $row['register_email']; ?></td>
                <td><?php echo $row['dept_name']; ?></td>
                <td><?php if($row['register_access'] == 1){echo "Faculty";} else if($row['register_access'] == 2){echo "Module Incharge";} else{echo "Main Incharge";} ?></td>
              <td><button  class="btn btn-success btn-fill" onclick="approve(<?php echo $row['register_id']; ?>)">Approve</button>
               <button  class="btn btn-danger btn-fill" onclick="reject(<?php echo $row['register_id']; ?>)">Reject</button></td>
                 <td> </td>
            </tr>
            <?php
            }
        }
            ?>
            
        </tbody>
    </table>
    </div>
</div>


<!-- Argon Scripts -->
<!-- Core -->
<script src="assets/vendor/jquery/dist/jquery.min.js"></script>
<script src="assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/js-cookie/js.cookie.js"></script>
<script src="assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
<script src="assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
<!-- Argon JS -->
<script src="assets/js/argon.js?v=1.2.0"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


<script>
   document.getElementById("app").className += "active";
        //function to approve 
        function approve(id){
            var register_id = id;
            location.href = "?approve=1&reg_id="+register_id;
        }

        //function to approve 
        function reject(id){
            var register_id = id;
            location.href = "?reject=1&reg_id="+register_id;
        }
</script>
