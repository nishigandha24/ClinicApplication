<?php
include_once ("header.php");
include_once ("navbar.php");
?>  

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
              <h2 class="card-title">Calculate Age & Update Patient Age Group</h2><br>
            </div> <!-- /.card-header -->

            <form role="form" name="form" action="update.php" method="POST">
              <div class="card-body">
                <div class="row form-group">
                  <div class="col-sm-2">
                    <input type="submit" class="btn btn-primary no-print " name="submit" value="Update Age & Patient Age Group"/><br>
                  </div>
                </form>
                <?php

                if (isset($_POST["submit"])) {
                  $sql = "UPDATE patient SET age = TIMESTAMPDIFF( YEAR, birthdate, CURDATE() ) WHERE 1";
                  $data = mysqli_query($conn, $sql);

                  $data1= mysqli_query($conn, "select age from patient;");
                  $total1= mysqli_num_rows($data1);
                  if ($total1!= 0) {
                    while ($result1 = mysqli_fetch_assoc($data1)){ 
                      if ($result1["age"] < 18 )
                      {
                        $sql2 = "UPDATE patient SET patientagegroup = 'Minor' WHERE age < 18";
                      }
                      else
                      {
                        $sql2 = "UPDATE patient SET patientagegroup = 'Adult' WHERE age >= 18";
                      }
                      $data2 = mysqli_query($conn, $sql2);
                    }   
                  }

                  if ($data && $data2) {
                    ?>
                    <script >
                      alert("Age & Patient Age Group Updated Successfully!!!");
                    </script>    
                    <?php
                    header("Location:update.php");
                  }
                }
                ?>

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