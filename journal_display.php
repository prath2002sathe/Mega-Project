<?php 
require('auth.php');
require('header.php');
require('db_connect.php');
$register_id = $_SESSION['register_id'];
$register_dept = $_SESSION['register_dept'];

?>
<div class="container" style="margin-top:50px;">
<a href="publication.php?type=1" class="btn btn-primary btn-fill float-right">ADD JOURNAL</a>
 <!-- Search form -->
    <form action="journal_display.php" method="GET">
            <div class="form-group" style="width:50%;">
                <label for="date">Date From:</label>
                <input type="date" class="form-control" value="<?php if(isset($_POST['sdate'])){ echo $_POST['sdate'];}else{ echo date('Y-m-d', strtotime('-7 days'));} ?>" name="sdate" required="true">
            </div>
            <div class="form-group" style="width:50%;">    
                <label for="date">Date To:</label>
                <input type="date" class="form-control" value="<?php if(isset($_POST['ldate'])){ echo $_POST['ldate'];}else{ echo date('Y-m-d');} ?>" name="ldate" required="true">
            </div>
            <div class="form-group mb-0" style="width:50%;">
              <div class="input-group input-group-alternative input-group-merge">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class=""></i></span>
                </div>
                <input class="form-control" placeholder="Search" type="text" id="search" value="" name="searchvalue">
              </div>
            </div>
            <br>
            <button type="submit" value="1" name="search" class="btn btn-success btn-fill">Search</button>
    </form>
   <br>
  
    
    <div class="table-responsive container  text-center table-bordered " style="margin-left:-15px;" >
    <table id="print" class="  " style="width:104%">
    <thead class=" " style="background-color:#9775D9;font-size:0.9em;">
            <tr class ="" style="padding:2px;">
            <th scope="col" class="sort text-center" data-sort="serial">Sr No.</th>
                
                <!-- <th scope="col" class="sort text-center" data-sort="facname">Faculty Name</th> -->
                <th scope="col" class="sort text-center" data-sort="type">Type</th>
                <th scope="col" class="sort text-center" data-sort="title">Title</th>
                <th scope="col" class="sort text-center" data-sort="name">Name</th>
                <th scope="col" class="sort text-center" data-sort="doa">Date of Acceptance</th>
                <th scope="col" class="sort text-center" data-sort="dop">Date of Publication</th>
                <th scope="col" class="sort text-center" data-sort="impact">Impact Factor</th>
                <th scope="col" class="sort text-center" data-sort="vol">Volume No</th>
                <th scope="col" class="sort text-center" data-sort="issn">ISSN</th>
                <th scope="col" class="sort text-center" data-sort="cert">Certificate</th>
                <th scope="col" class="sort text-center" data-sort="abstract">Abstract</th>
                <th scope="col" class="sort text-center" data-sort="organiser">Status</th>
                <th scope="col" class="sort text-center" data-sort="isbn">ISBN</th>
                <th scope="col" class="sort text-center" data-sort="auth_name">Other Authors</th>
            </tr>
        </thead>
        <tbody class="list" style="background-color:white;padding:2px;">
            <?php 
            if(isset($_GET['sdate']))
            {
              
              $sdate =  mysqli_real_escape_string($con, $_GET['sdate']);
              $ldate =  $_GET['ldate'];
                 //search 
                if(isset($_GET['search'])){
                    if($_GET['search'] == 1){
                        if(isset($_GET['searchvalue'])){
                            if($_GET['searchvalue'] != ""){
                                $searchvalue = $_GET['searchvalue'];
                                //check search , sdate last date 
                                    $sql="SELECT * FROM journal INNER JOIN register WHERE journal.register_id = register.register_id AND  register.register_dept = $register_dept  AND register.register_name LIKE '%".$searchvalue."%'";
                                   
                             }
                             else
                             {
                                 // sdate last date 
                                 $sql="SELECT * FROM journal INNER JOIN register WHERE journal.register_id = register.register_id  AND  register.register_dept = $register_dept AND journal.journal_dop BETWEEN '$sdate' AND '$ldate'";
                             }
                        }
                      
                    } 
                }
                else{
                    //no filtres are enabled 
                    $sql="SELECT * FROM journal INNER JOIN register WHERE journal.register_id = register.register_id  AND  register.register_dept = $register_dept";
                 }
            }
            else{
                 //no filtres are enabled 
                 $sql="SELECT * FROM journal INNER JOIN register WHERE journal.register_id = register.register_id  AND  register.register_dept = $register_dept";
     
             }
            $i = 0;
            $result = mysqli_query($con, $sql);
            $no = mysqli_num_rows($result);
            if($no == 0){
                //if no data is aval 
                echo "<script>alert('NO RESULTS AVAILABLE');</script>";
                echo "NO RESULTS AVAILABLE";
            }
            else{
            while($row = mysqli_fetch_array($result))
            {
              
            if(isset($_GET['self'])){
                if($_GET['self'] == 1){
                    if($_SESSION['register_access'] == "1" || $_SESSION['register_access'] == "2" || $_SESSION['register_access'] == "3"){
                        if($row['register_id'] == $_SESSION['register_id']){
                            //code here 
                            $flag = 1;
                            $i++;
                        }
                        else{
                            $flag = 0;
                        }
                    }
                }
            }
            else{
            $i++;
            }
            ?>
            <tr>
            <td><?php echo $i?></td>
                <!-- <td><?php echo $row['register_name']; ?></td> -->
                <td><?php if($row['journal_type'] == "1"){echo "National";}else if($row['journal_type'] == "2"){echo "International";}else{echo "NULL";}  ?></td>
                <td><?php echo $row['journal_title']; ?></td>
                <td><?php echo $row['journal_name']; ?></td>
                <td><?php echo $row['journal_doa']; ?></td>
                <td><?php echo $row['journal_dop']; ?></td>
                <td><?php echo $row['journal_impact_factor']; ?></td>
                <td><?php echo $row['journal_vol_no']; ?></td>
                <td><?php echo $row['journal_issn']; ?></td>
                <td><a href="<?php echo $row['journal_certificate']; ?>" target="_blank">View Document</a></td>
                <td><a href="<?php echo $row['journal_abstract']; ?>" target="_blank">View Abstract</a></td>
                <td><?php echo $row['journal_status']; ?></td>
                <td><?php echo $row['journal_isbn']; ?></td>
                <td><?php echo $row['journal_other_authors']; ?></td>
           
            </tr>
            <?php
            }
        }
            ?>
            
        </tbody>
    </table>
    </div>
</div>
<br>
<?php require 'convertors.php'; ?> 

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
   document.getElementById("pub").className += "active";
    
</script>
