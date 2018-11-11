<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>College Library Serial Monitoring System</title>

  <!-- Favicons -->
  <link href="img/clsms.png" rel="icon" type="image/png">

  <!-- Bootstrap core CSS -->
  <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!--external css-->
  <link href="lib/font-awesome/css/font-awesome.css" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="css/zabuto_calendar.css">
  <link rel="stylesheet" type="text/css" href="lib/gritter/css/jquery.gritter.css" />

  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet">
  <link href="css/style-responsive.css" rel="stylesheet">

  <!--Override CSS-->
    <link href="css/custom.css" rel="stylesheet">
    <link href="css/morris.css" rel="stylesheet">
    <link rel="stylesheet" href="Datatable/css/dataTables.bootstrap.min.css">

</head>
<body>
  <section id="container">
    <!-- **********************************************************************************************************************************************************
        TOP BAR CONTENT & NOTIFICATIONS
        *********************************************************************************************************************************************************** -->
    <!--header start-->
    <header class="header black-bg">
      <!--logo start-->
      <a href="index.php" class="logo"><b><span>CL</span>SMS</b></a>
      <!--logo end-->
      <div class="nav notify-row" id="top_menu">
      </div>
      <div class="top-menu">
        <ul class="nav pull-right top-menu">
          <li><a class="logout" href="php_codes/logout.php">Logout</a></li>
          <script>
          </script>
        </ul>
      </div>
    </header>
    <!--header end-->
    <!--sidebar start-->
    <?php include 'Includes/left-sidebar.php';?>
    <!--sidebar end-->

<section id="main-content">
  <section class="wrapper">
    <div class="main-chart">