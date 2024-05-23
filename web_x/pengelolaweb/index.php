<?php
session_start();
if(empty($_SESSION["UID"]) && empty($_SESSION["FNAME"]) && empty($_SESSION["EMAIL"]) && empty($_SESSION["LEVEL"])){
  header("location: login.php");
  exit();
} else {
  include_once '../backend/loader.class.php';
  $dbCon = DB::Connect();
  ?>
  <!doctype html>
  <html class="no-js " lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Administrator Panel</title>


    <link href="assets/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
    <link rel="stylesheet" href="assets/plugins/jquery-datatable/dataTables.bootstrap4.min.css">
    <link rel="icon" href="logo.ico" type="image/x-icon"> <!-- Favicon-->
    <link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/cssblack/main.css">
    <link rel="stylesheet" href="assets/cssblack/color_skins.css">
    <link href="assets/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet" />
    <link href="assets/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
    <link rel="stylesheet" href="assets/plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"integrity="sha256-3edrmyuQ0w65f8gfBsqowzjJe2iM6n0nKciPUp8y+7E="crossorigin="anonymous"></script>
  </head>
  <body class="theme-blue">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
      <div class="loader">
        <div class="m-t-30"><img class="zmdi-hc-spin" src="assets/images/logo.svg" width="48" height="48" alt="sQuare"></div>
        <p>Please wait...</p>
      </div>
    </div>
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>

    <!-- Top Bar -->
    <nav class="top_navbar">
      <div class="container">
        <div class="row clearfix">
          <div class="col-12">
            <div class="navbar-logo">
              <a href="javascript:void(0);" class="bars"></a>
              <a class="navbar-brand" href="."><img src="../images/default/logo.png" width="30" alt="InfiniO"><span class="m-l-10">Administrator Panel</span></a>
            </div>
            <ul class="nav navbar-nav">
              <li><a href="javascript:void(0);" class="fullscreen hidden-sm" data-provide="fullscreen"><i class=" icon-size-fullscreen"></i></a></li>
              <li class="dropdown profile">
                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button">
                  <img class="rounded-circle" src="../images/default/userdefault.png" alt="User">
                </a>
                <ul class="dropdown-menu pullDown">
                  <li>
                    <div class="user-info">
                      <h6 class="user-name m-b-0"><?=$_SESSION["FNAME"] ?></h6>
                      <hr>
                    </div>
                  </li>
                  <li><a href=".?_ds=<?= encodeUrl('logout') ?>"><i class="icon-power m-r-10"></i><span>Sign Out</span></a></li>
                  <?php if(decodeUrl(@$_GET['_ds']) === 'logout' ) { Login::Logout(); }?>
                  </ul>
                </li>
                <li><a href="javascript:void(0);" class="js-right-sidebar"><i class="icon-equalizer"></i></a></li>
              </ul>
            </div>
          </div>
        </div>
      </nav>

      <aside id="leftsidebar" class="sidebar h_menu">
        <div class="container">
          <div class="row clearfix">
            <div class="col-12">
              <div class="menu">
                <ul class="list">
                  <li class="header">MAIN</li>
                  <li <?php if(@$_GET['_pg'] === null) echo "class='active open'"; ?> > <a href="."><i class="icon-speedometer"></i><span>Dashboard</span></a></li>
                  <li <?php if(decodeUrl(@$_GET['_pg']) === 'list_news') echo "class='active open'"; ?> > <a href=".?_pg=<?= encodeUrl('list_news') ?>"><i class="icon-grid"></i><span>Info</span></a></li>
                  <li <?php if(decodeUrl(@$_GET['_pg']) === 'list_events') echo "class='active open'"; ?> > <a href=".?_pg=<?= encodeUrl('list_events') ?>"><i class="icon-calendar"></i><span>Agenda</span></a></li>
                  <li <?php if(decodeUrl(@$_GET['_pg']) === 'edit_tupoksi') echo "class='active open'"; ?> > <a href=".?_pg=<?= encodeUrl('edit_tupoksi') ?>&_nid=1532315994"><i class="icon-star"></i><span>Tupoksi</span></a></li>
                  <li <?php if(decodeUrl(@$_GET['_pg']) === 'edit_visimisi') echo "class='active open'"; ?> > <a href=".?_pg=<?= encodeUrl('edit_visimisi') ?>&_nid=1532315995"><i class=" icon-notebook"></i><span>Visi & Misi</span></a></li>
                  <li <?php if(decodeUrl(@$_GET['_pg']) === 'edit_dasarhukum') echo "class='active open'"; ?> > <a href=".?_pg=<?= encodeUrl('edit_dasarhukum') ?>&_nid=1532315996"><i class=" icon-notebook"></i><span>Dasar Hukum</span></a></li>
                  <li <?php if(decodeUrl(@$_GET['_pg']) === 'inovasiprestasi') echo "class='active open'"; ?> > <a href=".?_pg=<?= encodeUrl('inovasiprestasi') ?>"><i class=" icon-notebook"></i><span>Prestasi & Inovasi</span></a></li>
                  <li <?php if(decodeUrl(@$_GET['_pg']) === 'announcement') echo "class='active open'"; ?> > <a href=".?_pg=<?= encodeUrl('announcement') ?>"><i class=" icon-notebook"></i><span>Pengumuman</span></a></li>
                  <li <?php if(decodeUrl(@$_GET['_pg']) === 'master') echo "class='active open'"; ?> > <a href=".?_pg=<?= encodeUrl('master') ?>"><i class="icon-settings"></i><span>Master</span></a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </aside>

      <!-- Right Sidebar -->
      <aside id="rightsidebar" class="right-sidebar">
        <div class="slim_scroll">
          <div class="card">
            <h6>Skins</h6>
            <ul class="choose-skin list-unstyled">
              <li data-theme="purple">
                <div class="purple"></div>
              </li>
              <li data-theme="blue">
                <div class="blue"></div>
              </li>
              <li data-theme="cyan" class="active">
                <div class="cyan"></div>
              </li>
              <li data-theme="green">
                <div class="green"></div>
              </li>
              <li data-theme="orange">
                <div class="orange"></div>
              </li>
              <li data-theme="blush">
                <div class="blush"></div>
              </li>
            </ul>
          </div>
          <div class="card theme-light-dark">
            <h6>Left Menu</h6>
            <button class="btn btn-default btn-block btn-round btn-simple t-light">Light</button>
            <button class="btn btn-default btn-block btn-round t-dark">Dark</button>
          </div>
          <div class="card">
            <h6>General Settings</h6>
            <ul class="setting-list list-unstyled">
              <li>
                <div class="checkbox">
                  <input id="checkbox1" type="checkbox">
                  <label for="checkbox1">Report Panel Usage</label>
                </div>
              </li>
              <li>
                <div class="checkbox">
                  <input id="checkbox2" type="checkbox" checked="">
                  <label for="checkbox2">Email Redirect</label>
                </div>
              </li>
              <li>
                <div class="checkbox">
                  <input id="checkbox3" type="checkbox" checked="">
                  <label for="checkbox3">Notifications</label>
                </div>
              </li>
              <li>
                <div class="checkbox">
                  <input id="checkbox4" type="checkbox" checked="">
                  <label for="checkbox4">Auto Updates</label>
                </div>
              </li>
              <li>
                <div class="checkbox">
                  <input id="checkbox5" type="checkbox" checked="">
                  <label for="checkbox5">Offline</label>
                </div>
              </li>
              <li>
                <div class="checkbox">
                  <input id="checkbox6" type="checkbox" checked="">
                  <label for="checkbox6">Location Permission</label>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </aside>


      <!-- Main Content -->
      <section class="content">
        <div class="container">
          <?php
          if(isset($_GET['_act'])){
            require_once 'pages/'.decodeUrl($_GET['_act']).'.php';
          } else {
            if(decodeUrl(@$_GET['_pg']) === 'master'){
              require_once 'pages/'.decodeUrl($_GET['_pg']).'.php';
            } else if(decodeUrl(@$_GET['_pg']) === 'edit_tupoksi'){
              require_once 'pages/'.decodeUrl($_GET['_pg']).'.php';
            } else if(decodeUrl(@$_GET['_pg']) === 'edit_visimisi'){
              require_once 'pages/'.decodeUrl($_GET['_pg']).'.php';
            } else if(decodeUrl(@$_GET['_pg']) === 'edit_dasarhukum'){
              require_once 'pages/'.decodeUrl($_GET['_pg']).'.php';
            } else if(decodeUrl(@$_GET['_pg']) === 'inovasiprestasi'){
              require_once 'pages/'.decodeUrl($_GET['_pg']).'.php';
            } else if(decodeUrl(@$_GET['_pg']) === 'announcement'){
              require_once 'pages/'.decodeUrl($_GET['_pg']).'.php';
            } else if(decodeUrl(@$_GET['_pg']) === 'list_news'){
              require_once 'pages/'.decodeUrl($_GET['_pg']).'.php';
            } else if(decodeUrl(@$_GET['_pg']) === 'list_events'){
              require_once 'pages/'.decodeUrl($_GET['_pg']).'.php';
            } else {
              require_once 'pages/dashboard.php';
            }
          }
          ?>
        </div>
      </section>



      <!-- Jquery Core Js -->
      <script src="assets/bundles/libscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js ( jquery.v3.2.1, Bootstrap4 js) -->
      <script src="assets/bundles/vendorscripts.bundle.js"></script> <!-- slimscroll, waves Scripts Plugin Js -->

      <script src="assets/bundles/mainscripts.bundle.js"></script>


      <script src="assets/plugins/ckeditor/ckeditor.js"></script>
      <script>
         $(document).ready(function(){
           CKEDITOR.replace( 'ckeditor' );
         })
      </script>
      <!-- Jquery DataTable Plugin Js -->
      <script src="assets/bundles/datatablescripts.bundle.js"></script>
      <script src="assets/js/pages/tables/jquery-datatable.js"></script>

      <script src="assets/plugins/momentjs/moment.js"></script> <!-- Moment Plugin Js -->
      <!-- Bootstrap Material Datetime Picker Plugin Js -->
      <script src="assets/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>
      <script src="assets/plugins/bootstrap-datetimepicker/moment-with-locales.js"></script>
      <script src="assets/plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.js"></script>

      <script src="assets/js/pages/forms/basic-form-elements.js"></script>

    </body>
    </html>

  <?php } ?>
