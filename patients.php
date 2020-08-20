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
              <h2 class="card-title">Patients who do not have appointments in the future</h2><br>
            </div> <!-- /.card-header -->

            <div class="card-body">
              <div class="row form-group">
                <div class="col-sm-12">
                  <button type="button" class="btn btn-success no-print float-right" onclick="window.print();" style=" margin-right: 5px;">
                    <i class="fas fa-print"></i> Print Report</button>
                  </div>

                  <?php
                  $sql = "select * from patient LEFT JOIN appointment ON patient.patientid = appointment.patientid where (appointment.apptdate BETWEEN DATE_FORMAT('2000-01-01', '%y-%m-%d') AND DATE_FORMAT(CURDATE(), '%y-%m-%d')) AND (appointment.appttime > '00:00:00' OR appointment.appttime < CURTIME())";

                  $data = mysqli_query($conn, $sql);
                  $total = mysqli_num_rows($data);
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
                          <th>Sr. No.</th>
                          <th>Patient Id</th>
                          <th>practice Id</th>
                          <th>Name</th>
                          <th>City</th>
                          <th>State</th>
                          <th>Gender</th>
                          <th>Patient Age Group</th>
                          <th>Birth Date</th> 
                          <th>Age</th>
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
                              <?php echo $result['practiceid']; ?>
                            </td>
                            <td>
                              <?php echo $result['firstname']." ".$result['lastname']; ?>
                            </td>
                            <td>
                              <?php echo $result['city']; ?>
                            </td>    
                            <td>
                              <?php echo $result['state']; ?>
                            </td>
                            <td>
                              <?php echo $result['gender']; ?>
                            </td>
                            <td>
                              <?php echo $result['patientagegroup']; ?>
                            </td> 
                            <td>
                              <?php echo date("d M Y", strtotime($result['birthdate'])); ?>
                            </td>
                            <td>
                              <?php echo $result['age']; ?>
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