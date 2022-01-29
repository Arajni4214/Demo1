<?php include('prop.php'); ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>ICT Projects Timeline & Schedule </title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <link rel="stylesheet" href="bower_components/bootstrap-datetimepicker-master/css/bootstrap-datetimepicker.min.css">
  <link rel="stylesheet" href="plugins/iCheck/all.css">
  <link rel="stylesheet" href="bower_components/select2/dist/css/select2.min.css">
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="plugins/pace/pace.min.css">
  <link rel="stylesheet" href="bower_components/aos.css">
  <link rel="stylesheet" href="bower_components/jquery-timepicker/1.10.0/jquery.timepicker.min.css">
  <link rel="stylesheet" href="prop.css?v=<?=hash_file('md5', 'prop.css');?>">
  <link rel="icon" type="image/x-icon" href="bower_components/di_faviconew.ico" />
  <link rel="shortcut icon" type="image/ico" href="bower_components/di_faviconew.ico" />
</head>
<body class="<?php echo $_SESSION['bodyStyleClass']; ?>" oncontextmenu="return false;" ondragstart="return false;" ondrop="return false;" onselectstart="return false;">
<noscript class="jsRequiredMessage"> <p class="jsRequiredMessage">This page uses Javascript.<br>Your browser either doesn't support Javascript or you have it turned off. To see this page as it is meant to appear, please use a Javascript enabled browser.</p> <style type="text/css"> .body { background: #1B76AA; background-image: url('bower_components/digitalNICPattern.png'); margin-left: -10px; margin-right: -10px; } body { background: url('dist/img/boxed-bg.jpg') repeat fixed } p { font-family: 'Comic Sans MS', 'Helvetica', 'sans-serif'; } p::first-letter { background-color: #666; color: #FFF; font-size: 24px; font-style:normal; display: inline-block; padding: 0 5px; border-radius: 3px; margin-right: 2px; font-family: Satisfy, cursive; } p::first-line { font-size: 18px; text-transform: smallcaps; font-style: italic; text-decoration: underline; } .jsRequired { display:none !important; } .jsRequiredMessage { display:block; background-color:#C00; color:#fff; width:100%; line-height:30px; text-align:center; font-size:16px; border:0 none; position: fixed; top: 25%; left: 50%; transform: translate(-50%, -50%); } #backtotop { display:none !important; } </style> </noscript>
<div class="wrapper jsRequired">
<header class="main-header"<?php echo ' '.$_SESSION['aosHeader']; ?>>
    <a onclick="redirectIt('logout.php<?php // https://digital.nic.in/DigitalNIC_new/dashboard.php ?><?php // echo $_SESSION['homepageURL']; ?>');" class="logo pointer">
      <span class="logo-mini"><b>D</b>NIC</span>
      <span class="logo-lg"><b>Digital</b>NIC</span>
    </a>
    <nav class="navbar navbar-static-top">
      <a onclick="redirectIt('#');" class="sidebar-toggle pointer" data-toggle="push-menu" role="button">
        <span class="sr-only">ICT Projects</span><?php // Awards Nomination System ?>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>
      <a class="pointer" onclick="redirectIt('<?php echo $_SESSION['homepageURL']; ?>');"><span style="font-family: fontAwesome;
    color: white;
    padding: 15px 15px 15px 0px;
    float: left;
    font-weight: 400;">ICT Projects<small> Timeline & Schedule</small></span></a>
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li class="dropdown user user-menu">
            <a onclick="redirectIt('#');" class="dropdown-toggle pointer" data-toggle="dropdown">
              <img src="<?php echo 'serveImage.php'; ?>" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $_SESSION['empName']; ?></span>
            </a>
            <ul class="dropdown-menu">
              <li class="user-header">
                <img src="<?php echo 'serveImage.php'; ?>" class="img-circle" alt="User Image">
                <p>
                  <?php echo $_SESSION['empName']; ?>
                  <small><?php echo $_SESSION['desgDesc']; ?></small>
                </p>
              </li>
              <li class="user-footer">
                <div class="pull-right">
                  <a onclick="redirectIt('logout.php<?php // https://digital.nic.in/DigitalNIC_new/dashboard.php ?><?php // logout.php ?>');" class="btn btn-default btn-flat pointer"><i class="fa fa-sign-out"></i><span> Digital</span></a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
<?php include('navigationBadges.php'); include('navigation.php'); ?>