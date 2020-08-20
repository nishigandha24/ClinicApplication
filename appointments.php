<?php
include_once ("header.php");
include_once ("navbar.php");
?>  

<style type="text/css">
 th, td { 
  text-align:center; 
  width:150px; 
  padding:0px;
  margin: 0px; 
} 
</style> 

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- section Alter-modal  -->
  <!-- Main content -->
  <section class="content">
    <div  class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card card-primary" align="center">
            <div class="card-header">
              <h2 class="card-title">Appointments</h2><br>
            </div> <!-- /.card-header -->

            <form role="form" name="form" action="appointments.php" method="POST">
              <div class="card-body">
                <div class="row form-group">
                  <div class="col-sm-2">
                    <select name='clinic' class="form-control" id='clinic'  required>
                      <option selected disabled>Select Clinic</option>  
                      <option value="all">All</option>
                      <?php
                      $data1= mysqli_query($conn, "select * from clinic;");
                      $total1= mysqli_num_rows($data1);
                      if ($total1!= 0) {
                        while ($result1 = mysqli_fetch_assoc($data1)){ 
                          $cname = $result1["clinicname"];
                          $cid = $result1["clinicid"];
                          echo '<option value="'.$cid.'">'.$cname.'</option>';
                        }   
                      }
                      ?>
                    </select>
                  </div>

                  <?php
                  $yearArray = range(2020, 2000);
                  ?>  
                  <div class="col-sm-2">
                    <select name="year" class="form-control">
                      <option selected disabled>Select Year</option>
                      <option value="all">All</option>                      
                      <?php
                      foreach ($yearArray as $year) {
                        $selected = ($year == 2020) ? 'selected' : '';
                        echo '<option value="'.$year.'">'.$year.'</option>';
                      }
                      ?>          
                    </select>
                  </div>

                  <?php 
                  $i = 1;
                  $monthsArray = array(1 => "January", 2 => "February", 3 => "March", 4 => "April", 5 => "May", 6 => "June", 7 => "July", 8 => "August", 9 => "September", 10 => "October", 11 => "November", 12 => "December");
                  ?>
                  <div class="col-sm-2">
                    <select name="month" class="form-control">
                     <option selected disabled>Select Month</option>
                     <option value="all">All</option>
                     <?php
                     while ($i < 13) {
                      echo '<option value="'.$i.'">'.$monthsArray[$i].'</option>';
                      $i = $i + 1;
                    }
                    ?>
                  </select>
                </div>

                <div class="col-sm-1">
                  <input type="submit" class="btn btn-primary no-print " name="submit" value="Submit"/><br>
                </div>

                <div class="col-sm-1">
                  <button class="btn btn-warning no-print" name="exit" onClick="window.location = 'appointments.php';"> Cancel</button>
                </div>

                <div class="col-sm-12">
                  <button type="button" class="btn btn-success no-print float-right" onclick="window.print();" style=" margin-right: 5px;">
                    <i class="fas fa-print"></i> Print Report</button>
                  </div>
                </form>
                <?php

                if (isset($_POST["submit"])) {
                  $clinic = (isset($_POST['clinic']) ? $_POST['clinic'] : '');
                  $years = (isset($_POST['year']) ? $_POST['year'] : '');
                  $months = (isset($_POST['month']) ? $_POST['month'] : '');
                  
                  if ($clinic != "" && $years != "" && $months != "") {
                    if($clinic == "all" && $years == "all" && $months == "all")
                    {
                      $sql = "select * from appointment";
                    }
                    else if($clinic == "all" && $years == "all")
                    {
                      $sql = "select * from appointment where (DAYOFMONTH(apptdate) BETWEEN 01 AND 31) AND (MONTH(apptdate) = '$months') AND (YEAR(apptdate) BETWEEN 2000 AND 2020)";
                    }
                    else if($clinic == "all" && $months == "all")
                    {
                      $sql = "select * from appointment where (DAYOFMONTH(apptdate) BETWEEN 01 AND 31) AND (MONTH(apptdate) BETWEEN 01 AND 12) AND (YEAR(apptdate) = '$years')";
                    }
                    else if($years == "all" && $months == "all")
                    {
                      $sql = "select * from appointment where (DAYOFMONTH(apptdate) BETWEEN 01 AND 31) AND (MONTH(apptdate) BETWEEN 01 AND 12) AND (YEAR(apptdate) BETWEEN 2000 AND 2020) AND clinicid='$clinic'";
                    }
                    else if($clinic == "all")
                    {
                      $sql = "select * from appointment where (DAYOFMONTH(apptdate) BETWEEN 01 AND 31) AND (MONTH(apptdate) = '$months') AND (YEAR(apptdate) = '$years')";
                    }
                    else if($years == "all")
                    {
                      $sql = "select * from appointment where (DAYOFMONTH(apptdate) BETWEEN 01 AND 31) AND (MONTH(apptdate) = '$months') AND (YEAR(apptdate) BETWEEN 2000 AND 2020) AND clinicid='$clinic'";
                    }
                    else if($months == "all")
                    {
                     $sql = "select * from appointment where (DAYOFMONTH(apptdate) BETWEEN 01 AND 31) AND (MONTH(apptdate) BETWEEN 01 AND 12) AND (YEAR(apptdate) = '$years') AND clinicid='$clinic'";
                   }
                   else
                   {
                    $sql = "select * from appointment where (DAYOFMONTH(apptdate) BETWEEN 01 AND 31) AND (MONTH(apptdate) = '$months') AND (YEAR(apptdate) = '$years') AND clinicid='$clinic'";
                  }
                }
              }
              ?>

              <!-- Table row -->
              <div class="col-12 table-responsive">
                <table class="table table-striped">
                 <?php
                 $i=0;
                 if ($total != 0) {
                  ?>
                  <thead>
                    <tr>
                      <th>Sr. No</th>
                      <th>Patient Id</th>
                      <th>Appointment Id</th>
                      <th>Appointment Date</th>
                      <th>Operatory</th>
                      <th>Provider</th>
                      <th>Appointment Time</th>
                      <th>Appointment Length</th>
                      <th>Amount</th>
                      <th>Clinic Id</th> 
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    while ($result = mysqli_fetch_assoc($data)) {
                      $i = $i + 1;
                      ?>
                      <tr>
                        <td>
                          <?php echo $i; ?>
                        </td>
                        <td>
                          <?php echo $result['patientid']; ?>
                        </td>
                        <td>
                          <?php echo $result['apptid']; ?>
                        </td>
                        <td>
                          <?php echo date("d M Y", strtotime($result['apptdate'])); ?>
                        </td>
                        <td>
                          <?php echo $result['operatory']; ?>
                        </td>
                        <td>
                          <?php echo $result['provider']; ?>
                        </td>    
                        <td>
                          <?php echo date("h:i:sa", strtotime($result['appttime'])); ?>
                        </td>
                        <td>
                          <?php echo $result['apptlength']; ?>
                        </td>
                        <td>
                          <?php echo $result['amount']; ?>
                        </td>
                        <td>
                          <?php echo $result['clinicid']; ?>
                        </td> 
                      </tr>
                      <?php
                    }
                  }
                  else {
                    ?>
                    <script>
                      alert("No Records Found!!!");
                    </script>
                    <?php
                  }
                  ?>
                </tbody>
              </table>
            </div>
            <!-- /.col -->
          </div> <!-- /.row -->             
        </div>  <!-- /.card-body -->
      </div> <!-- /.card -->
    </div> <!-- /.col -->
  </div><!-- /.row -->
</div><!-- /.content -fluid -->
</section>
</div>
<!-- /.content-wrapper -->

<?php
include_once ("footer.php");
?>