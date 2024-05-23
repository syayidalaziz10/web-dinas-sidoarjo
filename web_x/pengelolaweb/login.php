<?php
session_start();
if(!empty($_SESSION["UID"]) && !empty($_SESSION["FNAME"]) && !empty($_SESSION["EMAIL"]) && !empty($_SESSION["LEVEL"])){
  echo "<script>window.location.href = '.'</script>";
  exit();
} else {
  include_once '../backend/dbConfig.php';
  include_once '../backend/login.class.php';
  $dbCon = DB::Connect();
  if(empty($_SESSION["token"])){
    $_SESSION["token"] = base64_encode(openssl_random_pseudo_bytes(32));
  }
  ?>
  <!doctype html>
  <html class="no-js " lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="description" content="Responsive Bootstrap 4 and web Application ui kit.">

    <title>Login Page</title>
    <!-- Favicon-->
    <link rel="icon" href="logo.ico" type="image/x-icon">
    <link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">

    <!-- Custom Css -->
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/color_skins.css">
  </head>
  <body class="theme-purple">
    <div class="authentication">
      <div class="container">
        <div class="col-md-12 content-center">
          <div class="row clearfix">
            <div class="col-lg-6 col-md-12">
              <div class="company_detail">
                <h4 class="logo"><img src="../images/default/logo.png" alt="Logo"> DISKOMINFO Sidoarjo</h4>
                <h3>Login <strong>Administrator</strong> Dashboard</h3>
                <p>Gunakan aplikasi dashboard dengan bijak.</p>
                <div class="footer">
                  <ul  class="social_link list-unstyled">
                    <li><a href="" title="ThemeMakker"><i class="zmdi zmdi-globe"></i></a></li>
                    <li><a href="" title="Themeforest"><i class="zmdi zmdi-shield-check"></i></a></li>
                    <li><a href="" title="LinkedIn"><i class="zmdi zmdi-linkedin"></i></a></li>
                    <li><a href="" title="Facebook"><i class="zmdi zmdi-facebook"></i></a></li>
                    <li><a href="" title="Twitter"><i class="zmdi zmdi-twitter"></i></a></li>
                    <li><a href="" title="Google plus"><i class="zmdi zmdi-google-plus"></i></a></li>
                    <li><a href="" title="Behance"><i class="zmdi zmdi-behance"></i></a></li>
                  </ul>
                  <hr>
                  <ul class="list-unstyled">
                    <li><a href="" target="_blank">Contact Us</a></li>
                    <li><a href="" target="_blank">About Us</a></li>
                    <li><a href="" target="_blank">Services</a></li>
                    <li><a href="">FAQ</a></li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-lg-5 col-md-12 offset-lg-1">
              <div class="card-plain">
                <div class="header">
                  <h5>Log in</h5>
                </div>
                <form class="form" method="post">
                  <input type="hidden" name="token" value="<?=$_SESSION["token"] ?>">
                  <div class="input-group">
                    <input type="text" class="form-control" name="email"  placeholder="Username / Email">
                    <span class="input-group-addon"><i class="zmdi zmdi-account-circle"></i></span>
                  </div>
                  <div class="input-group">
                    <input type="password" placeholder="Password" name="password" class="form-control" />
                    <span class="input-group-addon"><i class="zmdi zmdi-lock"></i></span>
                  </div>
                  <div class="footer">
                    <button type="submit" name="login" class="btn btn-primary btn-round btn-block">Login</button>
                  </div>
                  <?php if(isset($_POST['login'])){ Login::Check($_POST, $dbCon); } ?>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div id="particles-js"></div>
      </div>
      <!-- Jquery Core Js -->
      <script src="assets/bundles/libscripts.bundle.js"></script>
      <script src="assets/bundles/vendorscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js -->

      <script src="assets/plugins/particles-js/particles.min.js"></script>
      <script src="assets/plugins/particles-js/particles.js"></script>
    </body>
    </html>
  <?php } ?>
