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
							<h2 class="card-title">Delete appointments having amount less than 50 </h2><br>
						</div> <!-- /.card-header -->

						<form role="form" name="form" action="delete_appointment.php" method="POST">
							<div class="card-body">
								<div class="row form-group">

									<div class="col-sm-2">
										<input type="submit" class="btn btn-primary no-print " name="submit" value="Delete Appointments"/><br>
									</div>

									<div class="col-sm-2">
										<button class="btn btn-warning no-print" name="exit" onClick="window.location = 'delete_appointment.php';"> Cancel</button>
									</div>
								</form>
								<?php

								if (isset($_POST["submit"])) {
									
									$sql = "DELETE FROM appointment WHERE amount < 50";
									$data = mysqli_query($conn, $sql);

									if ($data) {
										?>
										<script >
											alert("Appointments Deleted Successfully!!!");
										</script>    
										<?php
										header("Location:delete_appointment.php");
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