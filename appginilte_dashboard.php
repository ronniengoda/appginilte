<?php include 'appginilte_header.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Hello, Welcome to <?php echo APP_TITLE; ?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active"><?php echo APP_TITLE; ?></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <!--Content Above Home Links  -->
        <?php include 'appginilte/above_homelinks.php'; ?>
      <!--Content Above Home Links  -->
      <!-- Home Links -->
      <?php include 'appginilte/home_links.php'; ?>
      <!-- Home Links -->
      <!--Content Below Home Links  -->
      <?php include 'appginilte/below_homelinks.php'; ?>
      <!--Content Below Home Links  -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php include 'appginilte_footer.php'; ?>