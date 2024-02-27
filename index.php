<?php
include ('auth.php');
include 'db_connect.php';
require 'header.php';
?>

<html>
<body>
    <div class="container mt-5"> 
        <?php 
            $query = "SELECT  DATEDIFF(CURRENT_DATE(), MAX(seminar_date)) as date_diff FROM seminar WHERE register_id = ".$_SESSION['register_id'];

            $data1 = mysqli_query($con, $query);
            $num_rows =  mysqli_num_rows($data1);
           
            $row1 = mysqli_fetch_array($data1);
            $date_diff = $row1[0];
            if($date_diff>120 || $date_diff==NULL)
            {
                echo "<marquee> <b style='color:red'> You have not uploaded any seminars in the last 4 months. Please upload it...!! </b> </marquee>";
            }

        ?>
    </div>


     <div class="container mt-1"> 
        <?php 
            $query = "SELECT  DATEDIFF(CURRENT_DATE(), MAX(workshop_date)) as date_diff FROM workshop WHERE register_id = ".$_SESSION['register_id'];

            $data1 = mysqli_query($con, $query);
             $num_rows =  mysqli_num_rows($data1);
          
            $row1 = mysqli_fetch_array($data1);
            $date_diff = $row1[0];
           if($date_diff>120 || $date_diff==NULL)
            {
                echo "<marquee> <b style='color:red'> You have not uploaded any Workshop in the last 4 months. Please upload it...!! </b> </marquee>";
            }

        ?>
    </div>

        <div class="container mt-1"> 
        <?php 
            $query = "SELECT  DATEDIFF(CURRENT_DATE(), MAX(con_doa)) as date_diff FROM conference WHERE register_id = ".$_SESSION['register_id'];

            $data1 = mysqli_query($con, $query);
             $num_rows =  mysqli_num_rows($data1);
          
            $row1 = mysqli_fetch_array($data1);
            $date_diff = $row1[0];
           if($date_diff>120 || $date_diff==NULL)
            {
                echo "<marquee> <b style='color:red'> You have not uploaded any Conference in the last 4 months. Please upload it...!! </b> </marquee>";
            }

        ?>
    </div>

     <div class="container mt-1"> 
        <?php 
            $query = "SELECT  DATEDIFF(CURRENT_DATE(), MAX(fdp_date)) as date_diff FROM fdp WHERE register_id = ".$_SESSION['register_id'];



            $data1 = mysqli_query($con, $query);
             $num_rows =  mysqli_num_rows($data1);
            
            $row1 = mysqli_fetch_array($data1);
            $date_diff = $row1[0];
             if($date_diff>120 || $date_diff==NULL)
            {
                echo "<marquee> <b style='color:red'> You have not uploaded any FDP in the last 4 months. Please upload it...!! </b> </marquee>";
            }

        ?>
    </div>

      <div class="container mt-1"> 
        <?php 
            $query = "SELECT  DATEDIFF(CURRENT_DATE(), MAX(journal_doa)) as date_diff FROM journal WHERE register_id = ".$_SESSION['register_id'];



            $data1 = mysqli_query($con, $query);
             $num_rows =  mysqli_num_rows($data1);
            
            $row1 = mysqli_fetch_array($data1);
            $date_diff = $row1[0];
             if($date_diff>120 || $date_diff==NULL)
            {
                echo "<marquee> <b style='color:red'> You have not uploaded any Journal in the last 4 months. Please upload it...!! </b> </marquee>";
            }

        ?>
    </div>



    <div class="table-responsive container table-bordered mb-3" style="margin-left:-1">
        <h2> Seminar Count </h2>
        <div class="">
            <table id="print" class="table table-dark" style="width:100%">
                <thead class=" " style="background-color:#9775D9;font-size:0.9em;">
                    <tr class ="text-white" style="padding:2px;">
                        <th scope="col" class="sort  text-white" data-sort="serial_no">Sr. No</th>
                        <th scope="col" class="sort  text-white" data-sort="date">Department</th>
                        <th scope="col" class="sort  text-white" data-sort="proof">Count</th>
                    </tr>
                </thead>
                <tbody class="list">
                    <?php 
                    $sql="SELECT COUNT(*) as total_count, (SELECT dept.dept_name FROM dept WHERE dept.dept_id= seminar.dept_id) as dept_name  FROM seminar GROUP BY seminar.dept_id;";

                    $result = mysqli_query($con, $sql);
                    $i=1;
                    while($row = mysqli_fetch_array($result))
                    {

                        ?>
                        <tr>
                            <td><?php echo $i?></td>
                            <td><?php echo $row['dept_name']; ?></td>
                            <td><?php echo $row['total_count']; ?></td>
                        </tr>
                        <?php
                        $i++;
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>


     <div class="table-responsive container table-bordered mb-3" style="margin-left:-1">
        <h2> Workshop Count </h2>
        <div class="">
            <table id="print" class="table table-dark" style="width:100%">
                <thead class=" " style="background-color:#9775D9;font-size:0.9em;">
                    <tr class ="text-white" style="padding:2px;">
                        <th scope="col" class="sort  text-white" data-sort="serial_no">Sr. No</th>
                        <th scope="col" class="sort  text-white" data-sort="date">Department</th>
                        <th scope="col" class="sort  text-white" data-sort="proof">Count</th>
                    </tr>
                </thead>
                <tbody class="list">
                    <?php 
                    $sql="SELECT COUNT(*) as total_count, (SELECT dept.dept_name FROM dept WHERE dept.dept_id= workshop.dept_id) as dept_name  FROM workshop GROUP BY workshop.dept_id;";

                    $result = mysqli_query($con, $sql);
                    $i=1;
                    while($row = mysqli_fetch_array($result))
                    {

                        ?>
                        <tr>
                            <td><?php echo $i?></td>
                            <td><?php echo $row['dept_name']; ?></td>
                            <td><?php echo $row['total_count']; ?></td>
                        </tr>
                        <?php
                        $i++;
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>


     <div class="table-responsive container table-bordered mb-3" style="margin-left:-1">
        <h2> Journal Count </h2>
        <div class="">
            <table id="print" class="table table-dark" style="width:100%">
                <thead class=" " style="background-color:#9775D9;font-size:0.9em;">
                    <tr class ="text-white" style="padding:2px;">
                        <th scope="col" class="sort  text-white" data-sort="serial_no">Sr. No</th>
                        <th scope="col" class="sort  text-white" data-sort="date">Department</th>
                        <th scope="col" class="sort  text-white" data-sort="proof">Count</th>
                    </tr>
                </thead>
                <tbody class="list">
                    <?php 
                    $sql="SELECT COUNT(*) as total_count, (SELECT dept.dept_name FROM dept WHERE dept.dept_id= journal.dept_id) as dept_name  FROM journal GROUP BY journal.dept_id;";

                    $result = mysqli_query($con, $sql);
                    $i=1;
                    while($row = mysqli_fetch_array($result))
                    {

                        ?>
                        <tr>
                            <td><?php echo $i?></td>
                            <td><?php echo $row['dept_name']; ?></td>
                            <td><?php echo $row['total_count']; ?></td>
                        </tr>
                        <?php
                        $i++;
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>


     <div class="table-responsive container table-bordered mb-3" style="margin-left:-1">
        <h2> Conference Count </h2>
        <div class="">
            <table id="print" class="table table-dark" style="width:100%">
                <thead class=" " style="background-color:#9775D9;font-size:0.9em;">
                    <tr class ="text-white" style="padding:2px;">
                        <th scope="col" class="sort  text-white" data-sort="serial_no">Sr. No</th>
                        <th scope="col" class="sort  text-white" data-sort="date">Department</th>
                        <th scope="col" class="sort  text-white" data-sort="proof">Count</th>
                    </tr>
                </thead>
                <tbody class="list">
                    <?php 
                    $sql="SELECT COUNT(*) as total_count, (SELECT dept.dept_name FROM dept WHERE dept.dept_id= conference.dept_id) as dept_name  FROM conference GROUP BY conference.dept_id;";

                    $result = mysqli_query($con, $sql);
                    $i=1;
                    while($row = mysqli_fetch_array($result))
                    {

                        ?>
                        <tr>
                            <td><?php echo $i?></td>
                            <td><?php echo $row['dept_name']; ?></td>
                            <td><?php echo $row['total_count']; ?></td>
                        </tr>
                        <?php
                        $i++;
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>


    <div class="table-responsive container table-bordered mb-3" style="margin-left:-1">
        <h2> FDP Count </h2>
        <div class="">
            <table id="print" class="table table-dark" style="width:100%">
                <thead class=" " style="background-color:#9775D9;font-size:0.9em;">
                    <tr class ="text-white" style="padding:2px;">
                        <th scope="col" class="sort  text-white" data-sort="serial_no">Sr. No</th>
                        <th scope="col" class="sort  text-white" data-sort="date">Department</th>
                        <th scope="col" class="sort  text-white" data-sort="proof">Count</th>
                    </tr>
                </thead>
                <tbody class="list">
                    <?php 
                    $sql="SELECT COUNT(*) as total_count, (SELECT dept.dept_name FROM dept WHERE dept.dept_id= fdp.dept_id) as dept_name  FROM fdp GROUP BY fdp.dept_id;";

                    $result = mysqli_query($con, $sql);
                    $i=1;
                          
                    while($row = mysqli_fetch_array($result))
                    {

                        ?>
                        <tr>
                            <td><?php echo $i?></td>
                            <td><?php echo $row['dept_name']; ?></td>
                            <td><?php echo $row['total_count']; ?></td>
                        </tr>
                        <?php
                        $i++;
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>