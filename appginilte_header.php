<?php include 'appginilte/appginilte.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo APP_TITLE . (isset($x->TableTitle) ? ' | ' . $x->TableTitle : ''); ?></title>
  <!-- Favicon icon -->
  <link rel="icon" type="image/png" sizes="16x16" href="appginilte/dist/img/AdminLTELogo.png">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="appginilte/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="appginilte/dist/css/adminlte.min.css">
  <style>
    .responsive-iframe {
      width: 100%;
      display: block;
      border: none;
    }
  </style>
</head>

<body class="hold-transition sidebar-mini">
  <!-- Site wrapper -->
  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="index.php" class="nav-link">Dashboard</a>
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">

        <!-- UserMenu Dropdown: Contains- Admin area, profile, csv import and sign out menus -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-user fa-1x"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-item dropdown-header"><?php echo APP_TITLE . ' | ' . $username; ?></span>
            <div class="dropdown-divider"></div>
            <?php
            $userprofileLink = "appginilte_view.php?page=membership_profile.php?Embedded=true";
            if ($group == "Admins") {
              # code...
              $adminareaLink = PREPEND_PATH . "admin/pageHome.php";
              #display admin area button/link below here
              echo ' <a href="' . $adminareaLink . '" class="dropdown-item">
            <i class="fas fa-lock mr-2"></i> Admin Area
            <span class="float-right text-muted text-sm fa fa-arrow-right"></span>
          </a>
          <div class="dropdown-divider"></div>';
              echo ' <a href="appginilte_settings.php" class="dropdown-item">
            <i class="fas fa-cog mr-2"></i> AppginiLTE Settings
            <span class="float-right text-muted text-sm fa fa-arrow-right"></span>
          </a>
          <div class="dropdown-divider"></div>';
            }
            echo ' <a href="' . $userprofileLink . '" class="dropdown-item">
          <i class="fas fa-user mr-2"></i> Profile
          <span class="float-right text-muted text-sm fa fa-arrow-right"></span>
        </a>
        <div class="dropdown-divider"></div>';
            if (userCanImport()) {
              $csvlink = "appginilte_view.php?page=import-csv.php?Embedded=true";
              echo ' <a href="' . $csvlink . '" class="dropdown-item">
          <i class="fas fa-file mr-2"></i> Import CSV
          <span class="float-right text-muted text-sm fa fa-arrow-right"></span>
        </a>
        <div class="dropdown-divider"></div>';
            }
            ?>
            <div class="dropdown-divider"></div>
            <a href="index.php?signOut=1" class="dropdown-item dropdown-footer"> <svg id="icon-logout" xmlns="http://www.w3.org/2000/svg" class="text-dark" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                <polyline points="16 17 21 12 16 7"></polyline>
                <line x1="21" y1="12" x2="9" y2="12"></line>
              </svg> Sign Out</a>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
            <i class="fas fa-th-large"></i>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="index.php" class="brand-link"  style="white-space: nowrap; width: 100%; overflow: hidden;text-overflow: ellipsis;">
        <img src="appginilte/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light"><?php echo APP_TITLE; ?></span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="https://ui-avatars.com/api/?name=<?php echo $username; ?>&background=random" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="<?php echo $userprofileLink; ?>" class="d-block"><?php echo $username; ?></a>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <?php include 'appginilte/aside.php'; ?>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>