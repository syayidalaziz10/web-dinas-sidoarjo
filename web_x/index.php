<?php
session_start();
if(empty($_SESSION["token"])){
 $_SESSION["token"] = base64_encode(openssl_random_pseudo_bytes(32));
}
include_once "backend/dbConfig.php";
include_once "backend/frontend.class.php";
include_once "baseapp.php";
?>
<!DOCTYPE html>
<html>
<head>
 <meta charset="utf-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <script language="JavaScript">
 var txt="<?=$option[1]->value?> Kabupaten Sidoarjo - <?=$option[2]->value?> ";
 var kecepatan=100;
 var segarkan=null;
 function bergerak() {
  document.title=txt;
  txt= txt.substring(1,txt.length)+txt.charAt(0);
  segarkan=setTimeout("bergerak()",kecepatan);
 }
 bergerak();
</script>
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
<link href="css/table.css" rel="stylesheet" type="text/css">
<link href="css/custom.css" rel="stylesheet" type="text/css">
<link href="css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="css/color.css" rel="stylesheet" type="text/css">
<link href="css/responsive.css" rel="stylesheet" type="text/css">
<link href="css/owl.carousel.css" rel="stylesheet" type="text/css">
<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="css/animate.css" rel="stylesheet" type="text/css">
<link href="css/jquery.mCustomScrollbar.css" rel="stylesheet" type="text/css">
<link href="css/jquery.bxslider.css" rel="stylesheet" type="text/css">
<link rel="shortcut icon" type="image/x-icon" href="images/default/logo.png">
<script
src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
integrity="sha256-3edrmyuQ0w65f8gfBsqowzjJe2iM6n0nKciPUp8y+7E="
crossorigin="anonymous"></script>

</head>

<body>
 <div id="wrapper">
  <header id="header">
   <section class="top-row">
    <div class="container">
     <div class="left-box">
      <ul>
       <li><a href="?page=pengumuman"><i class="fa fa-bullhorn " aria-hidden="true"></i>Pengumuman</a></li>
       <li><a href="?page=informasi&p=1"><i class="fa fa-newspaper-o" aria-hidden="true"></i>Info</a></li>
       <li><a href="?page=profil-pimpinan&p=1"><i class="fa fa-user" aria-hidden="true"></i>Pimpinan</a></li>
       <li><a href="?page=video&p=1"><i class="fa fa-video-camera" aria-hidden="true"></i>Video</a></li>
       <li><a href="?page=kontak"><i class="fa fa-map-marker" aria-hidden="true"></i>Peta</a></li>
      </ul>
     </div>
     <a href="?page=kontak" class="btn-style-1">Kontak</a></div>
    </section>
    <section class="logo-row">
     <div class="container"> <strong class="logo"><a href="."><img src="images/uploads/banners/<?=$banner[0]->img?>" class="img-responsive" alt="img"></a></strong>
      <div class="menu-col">
       <div class="menu-col-top">
        <ul>
         <li>Telepon: <a href=""><?=$option[6]->value?></a></li>
         <li>Email: <a href=""><?=$option[4]->value?></a></li>
        </ul>
       </div>
       <div class="btm-row">
        <div class="cp-burger-nav">
         <div id="cp_side-menu-btn" class="cp_side-menu"><a href="#"><i class="fa fa-bars" aria-hidden="true"></i></a></div>

         <div id="cp_side-menu"> <a href="#" id="cp-close-btn" class="crose"><i class="fa fa-close"></i></a>
          <div class="content mCustomScrollbar">
           <div id="content-1" class="content">
            <div class="cp_side-navigation">
             <nav>
              <ul class="navbar-nav">
               <li class="active"><a href=".">Beranda</a></li>
               <li><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Profil<span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                 <li><a href="?page=visi-misi">Visi Misi</a></li>
                 <li><a href="?page=struktur-organisasi">Struktur Organisasi</a></li>
                 <li><a href="?page=pegawai&p=1">Daftar Pegawai</a></li>
                 <li><a href="?page=kontak">Kontak</a></li>
                 <li><a href="?page=profil-pimpinan&p=1">Profil Pimpinan</a></li>
                 <li><a href="?page=tupoksi">Tugas &amp; Fungsi</a></li>
                 <li><a href="?page=prestasi-inovasi&p=1">Prestasi &amp; Inovasi</a></li>
                 <li><a href="?page=dasar-hukum">Dasar Hukum</a></li>
                </ul>
               </li>
               <li><a href="?page=layanan">Layanan</a></li>
               <li><a href="?page=informasi&p=1">Info</a></li>
               <li><a href="?page=agenda&p=1">Agenda</a></li>
               <li><a href="?page=pengumuman">Pengumuman</a></li>
               <li><a href="?page=download">Download</a></li>
              </ul>
             </nav>
            </div>
           </div>
          </div>
          <strong class="copy">Telepon: <?=$option[6]->value?></strong> <strong class="copy">Email: <a href=""><?=$option[4]->value?></a></strong>
          <div class="sidebar-social">
           <ul>
            <li><a href="<?=$socmed[1]->value?>"><i class="fa fa-twitter-square" aria-hidden="true"></i></a></li>
            <li><a href="<?=$socmed[0]->value?>"><i class="fa fa-facebook-square" aria-hidden="true"></i></a></li>
            <li><a href="<?=$socmed[2]->value?>"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
           </ul>
          </div>
         </div>

        </div>
        <nav class="navbar navbar-inverse">
         <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
         </div>
         <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav" id="nav">
           <li class="active"><a href=".">Beranda</a></li>
           <li><a href="#">Profil</a>
            <ul>
             <li><a href="?page=visi-misi">Visi &amp; Misi</a></li>
             <li><a href="?page=struktur-organisasi">Struktur Organisasi</a></li>
             <li><a href="?page=pegawai&p=1">Daftar Pegawai</a></li>
             <li><a href="?page=kontak">Kontak</a></li>
             <li><a href="?page=profil-pimpinan&p=1">Profil Pimpinan</a></li>
             <li><a href="?page=tupoksi">Tugas &amp; Fungsi</a></li>
             <li><a href="?page=prestasi-inovasi&p=1">Prestasi &amp; Inovasi</a></li>
             <li><a href="?page=dasar-hukum">Dasar Hukum</a></li>
            </ul>
           </li>
           <li><a href="?page=layanan">Layanan</a></li>
           <li><a href="?page=informasi&p=1">Info</a></li>
            <li><a href="?page=agenda&p=1">Agenda</a></li>
            <li id="ann"><a href="?page=pengumuman">Pengumuman</a></li>
            <li><a href="?page=download">Download</a></li>
           </ul>
          </div>
         </nav>
        </div>
       </div>
      </div>
     </section>
    </header>
    <?php
    $arrPages = array('visi-misi','struktur-organisasi','pegawai','kontak','profil-pimpinan','tupoksi','prestasi-inovasi','dasar-hukum','layanan','informasi','agenda','download','v-agenda','v-berita','v-inpres','v-layanan','error','pengumuman','video');
    $page = @$_GET['page'];
    if(isset($page)){
     if (in_array($page, $arrPages)){
      require_once $page.".php";
     } else {
      echo "<script> window.location.href= '.?page=error' </script>";
     }
    } else {
     require_once "beranda.php";
    }
    ?>
    <footer id="footer">
     <section class="footer-section-1">
      <div class="container">
       <div class="row">
        <div class="col-md-4 col-sm-6">
         <div class="footer-box"> <strong class="footer-logo"><a href=".">
          <img src="images/uploads/banners/<?=$banner[1]->img?>" class="img-responsive" alt="img">
         </a></strong>
         <div class="text-col">
          <p>Sidoarjo dulu dikenal sebagai pusat Kerajaan Janggala. Pada masa kolonialisme Hindia Belanda, daerah Sidoarjo bernama Sidokare, yang merupakan bagian dari Kabupaten Surabaya.</p>
         </div>
        </div>
       </div>
       <div class="col-md-2 col-sm-6">
        <div class="footer-box">
         <h3>Pengunjung</h3>
         <div class="news-widget">
          <?= $option[9]->value ?>
         </div>
        </div>
       </div>
       <div class="col-md-3 col-sm-6">
        <div class="footer-box">
         <h3>Telepon Penting</h3>
         <div class="links-widget">
           <font color="#fff">
            <ul>
              <?php foreach ($telp as $data) { ?>
                <li><strong><?=$data->name ?> :</strong> <?=$data->value ?></li>
              <?php } ?>
            </ul>
           </font>
         </div>
        </div>
       </div>
       <div class="col-md-3 col-sm-6">
        <div class="footer-box">
         <h3>Kontak Kami</h3>
         <div class="link-widget">
          <font color="#fff">
           <ul>
            <li><strong>Email</strong>   : <?=$option[4]->value?></li>
            <li><strong>Telepon</strong>   : <?=$option[6]->value?></li>
            <li><strong>Fax</strong>     : <?=$option[7]->value?></li>
            <li><strong>Alamat</strong> : <?=$option[5]->value?></li>
           </ul>
          </font>
         </div>
        </div>
       </div>
      </div>
     </div>
    </section>

    <section class="footer-section-2">
     <div class="container">
      <div class="footer-social"> <strong class="title">Be Social:</strong><ul>
       <li><a href="<?=$socmed[1]->value?>"><i class="fa fa-twitter social-color-1" aria-hidden="true"></i>Follow</a></li>
       <li><a href="<?=$socmed[0]->value?>"><i class="fa fa-facebook social-color-2" aria-hidden="true"></i>Like</a></li>
       <li><a href="<?=$socmed[2]->value?>"><i class="fa fa-instagram social-color-3" aria-hidden="true"></i>Follow</a></li>
      </ul>
     </div>
    </div>
   </section>

   <section class="footer-section-3">
    <div class="container"><strong class="copyrights">&copy; 2018 Copyrights <?=$option[1]->value?> Kabupaten Sidoarjo All Rights reserved.</strong></div>
   </section>
  </footer>
 </div>
 <script type="text/javascript">
   $(document).ready(function(){
     var widthdoc  = $( document ).width();
     console.log(widthdoc);
     if(widthdoc > 480){
       $("#ann").remove();
     }
   })
 </script>
 <script src="js/jquery-1.11.3.js"></script>
 <script src="js/bootstrap.min.js"></script>
 <script src="js/owl.carousel.min.js"></script>
 <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
 <script src="js/jquery.bxslider.min.js"></script>
 <script defer src="js/jquery.flexslider.js"></script>
 <script src="js/custom.js"></script>
 <script src="js/jquery.accordion.js"></script>
</body>
</html>
