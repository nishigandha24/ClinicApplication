
<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light border-bottom">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="index.php"><i class="fas fa-bars"></i></a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
      <a href="index.php" class="nav-link">Home</a>
    </li>
  </ul>

  <!-- SEARCH FORM -->
  
</nav>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="#" class="brand-link">
    <span class="brand-text font-weight-light">Clinic Application</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="dist/img/avatar5.png" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block">Admin</a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
           with font-awesome or any other icon font library -->

           <li class="nav-item has-treeview">
            <a href="patients.php" class="nav-link">
             <i class="far fa-circle nav-icon fa fa-users"></i>
             <p> Patients</p>
           </a>
         </li>

         <li class="nav-item has-treeview">
          <a href="appointments.php" class="nav-link">
            <i class="nav-icon fas fa-book"></i>
            <p> Appointments</p>
          </a>
        </li>     
        <li class="nav-item has-treeview">
          <a href="delete_appointment.php" class="nav-link">
            <i class="nav-icon fas fa-book"></i>
            <p> Delete Appointments</p>
          </a>
        </li>   

        <li class="nav-item has-treeview">
          <a href="report.php" class="nav-link">
           <i class="nav-icon fa fa-tachometer-alt"></i>
           <p> Report</p>
         </a>
       </li>

       <li class="nav-item has-treeview">
        <a href="update.php" class="nav-link">
          <i class="nav-icon fas fa-copy"></i>
          <p> Update Age & Patient Age Group</p>
        </a>
      </li>       
    </ul>
  </nav>
  <!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->
</aside>
