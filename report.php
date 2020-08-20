<?php
include_once ("header.php");
include_once ("navbar.php");
?>  

<style type="text/css">
  th { 
   text-align:center; 
 } 

 th, td { 
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
              <h2 class="card-title">Transactions Report</h2><br>
            </div> <!-- /.card-header -->

            <form role="form" name="form" action="report.php" method="POST">
              <div class="card-body">
                <h4>Select the Parameter for Sorting Data</h4>
                <div class="row form-group">                  
                  <div class="col-sm-2">
                    <select name='clinic' class="form-control" id='clinic'  required>
                      <option selected disabled>Select Clinic</option>  
                      <option value="all">All</option>
                      <?php
                      $data1= mysqli_query($conn, "select * from clinic;");
                      $total1= mysqli_num_rows($data1);
                      if ($total1!= 0) {
                        while ($result = mysqli_fetch_assoc($data1)){ 
                          $cname = $result["clinicname"];
                          $cid = $result["clinicid"];
                          echo '<option value="'.$cid.'">'.$cname.'</option>';
                        }   
                      }
                      ?>
                    </select>
                  </div>
                  <div class="col-sm-2">
                    <select name="provision" class="form-control">
                      <option selected disabled>Select Provider id</option>
                      <option value="all">All</option>
                      <?php
                      $data1= mysqli_query($conn, "select * from transaction;");
                      $total1= mysqli_num_rows($data1);
                      if ($total1!= 0) {
                        while ($result1 = mysqli_fetch_assoc($data1)){ 
                          $prov = $result1["provision"];
                          echo '<option value="'.$prov.'">'.$prov.'</option>';
                        }   
                      }
                      ?>
                    </select>
                  </div>
                  <div class="col-sm-2"> 
                    <select name="year" class="form-control">
                      <option selected disabled>Select Year</option>   
                      <?php
                      $yearArray = range(2020, 2000);
                      ?>                      
                      <?php
                      foreach ($yearArray as $year) {
                        $selected = ($year == 2020) ? 'selected' : '';
                        echo '<option '.$selected.' value="'.$year.'">'.$year.'</option>';
                      }
                      ?>                            
                      <?php
                      $data1= mysqli_query($conn, "select * from transaction;");
                      $total1= mysqli_num_rows($data1);
                      if ($total1!= 0) {
                        while ($result = mysqli_fetch_assoc($data1)){ 
                          $year = date( "Y",strtotime($result['proceduredate']));
                          // $val = $result['proceduredate'];
                          // echo '<option value="'.$val.'">'.$val.'</option>';
                          // echo $year;
                        }   
                      }
                      ?>
                    </select>
                  </div>



                  <div class="col-sm-2"> <!-- //This is Month Code -->
                    <?php
                    $formattedMonthArray = array(
                      "01" => "January", "02" => "February", "03" => "March", "04" => "April",
                      "05" => "May", "06" => "June", "07" => "July", "08" => "August",
                      "09" => "September", "10" => "October", "11" => "November", "12" => "December",
                    );
                    ?>
                    <select name="month" class="form-control">
                      <option selected disabled value="">Select By Month</option>                       
                      <?php
                      foreach ($monthArray as $month) {        
                        $selected = ($month == 8) ? 'selected' : '';
                        echo '<option '.$selected.' value="'.$month.'">'.$formattedMonthArray[$month].'</option>';
                      }
                      ?>       
                      <?php
                      $data1= mysqli_query($conn, "select * from transaction;");
                      $total1= mysqli_num_rows($data1);
                      if ($total1!= 0) {
                        while ($result = mysqli_fetch_assoc($data1)){ 
                          $month = date( "M",strtotime($result['proceduredate']));
                        // $val = $result['proceduredate'];
                          // echo '<option value="'.$val.'">'.$val.'</option>';
                          // echo $month;
                        }   
                      }
                      ?>
                    </select>
                  </div>
                  <!-- <div class="col-sm-2">
                    <input type="date" class="form-control" name="date" id="date" required/>
                  </div> -->

                  <input type="submit" class="btn btn-primary no-print " name="submit" value="Submit"/><br>
                  <button class="btn btn-warning no-print" name="exit" onClick="window.location = 'report.php';"> Cancel</button>

                  <div class="col-sm-12">
                    <button type="button" class="btn btn-success no-print float-right" onclick="window.print();" style=" margin-right: 5px;">
                      <i class="fas fa-print"></i> Print Report</button>
                    </div>
                  </div>
                </form>
                <?php

                if (isset($_POST["submit"])) {                  
                 $clinic = (isset($_POST['clinic']) ? $_POST['clinic'] : '');
                 $prov = (isset($_POST['prov']) ? $_POST['prov'] : '');
                 $year = (isset($_POST['year']) ? $_POST['year'] : '');
                 $month = (isset($_POST['month']) ? $_POST['month'] : '');


                 if ($clinic != "" || $prov != "" || $year != "" || $month != "") {
                  if($clinic == "all")
                  {
                    $sql = "SELECT * FROM transaction";
                  }
                  else if($clinic == "1")
                  {
                   $sql = "SELECT * FROM transaction WHERE clinicid = 1";
                 }
                 else if($clinic == "2")
                 {
                   $sql = "SELECT * FROM transaction WHERE clinicid = 2";
                 }

                 else if($prov == "all")
                 {
                  $sql = "SELECT * FROM transaction";
                }
                else if($prov == "$prov")
                {
                 $sql = "SELECT * FROM transaction WHERE prov = '$prov'";
               }
               else if ($year == "$selected") {
                $sql = "SELECT * FROM transaction WHERE proceduredate = '$selected' ";
              }else if ($month == "$selected") {
               $sql = "SELECT * FROM transaction WHERE proceduredate = '$selected'";
             }

             $data = mysqli_query($conn, $sql);
             $total = mysqli_num_rows($data);
           }
         }

         ?>


         <!-- Table row -->
         <div class="col-12 table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Sr. No</th>
                <th>Procedure types</th>
                <th>Clinic Name (Id)</th>
                <th>Provider Name</th>
                <th>Year</th>
                <th>Month</th>
                <th>Amounts</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <?php
                $i=0;                
                if ($total != 0) {
                  while ($result = mysqli_fetch_assoc($data)) {
                    $i += 1;
                    ?>
                    <td>
                      <?php echo $i; ?>

                    </td>
                    <td>
                      <?php echo $result['proceduretype']; ?>

                    </td>
                    <td>
                      <?php echo $result['clinicid']; ?> <!-- #clinicname -->

                    </td>
                    <td>
                      <?php echo $result['prov']; ?>

                    </td>
                    <td>
                      <?php echo date( "Y",strtotime($result['proceduredate'])); ?>

                    </td>
                    <td>
                      <?php echo date( "M",strtotime($result['proceduredate'])); ?>

                    </td>
                    <td>
                      <?php echo $result['amount']; ?>

                    </td>                                                                                        
                  </tr>
                  <?php
                }
              } else {
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