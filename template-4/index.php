<?php


  require('../conf/config.php');
  require('../conf/phpFunction.php');

  $queryProfile    = $mysqli->query('SELECT * FROM pub_profile');
  $profileData     = $queryProfile->fetch_all(MYSQLI_ASSOC);


  $pengumuman =  $mysqli->query('SELECT COUNT(*) as pengumuman FROM pub_post WHERE ca_id="003" AND _active="1" AND post_datex >= CURDATE()');
  $count = mysqli_fetch_assoc($pengumuman);

  $event =  $mysqli->query('SELECT COUNT(*) as event FROM pub_post WHERE ca_id="002" AND _active="1" AND post_datex >= CURDATE()');
  $countEvent = mysqli_fetch_assoc($event);



  
  if ($count['pengumuman'] == 0)
  
  {
    echo "<script src='https://code.jquery.com/jquery-3.6.0.min.js'></script>";
    echo 
    "<script type='text/javascript'>
      $(document).ready(function () {
          $('#announcementModal').modal('show');
      });
    </script>";
  }

?>


<!DOCTYPE html>
<html>
<head>


  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta charset="utf-8">
  <meta name="description" content="">

  
  
  <link rel="shortcut icon" type="image/x-icon" href="images/default/logo.png">
  
  <link rel="stylesheet" media="screen"  href="assets/css/nicepage.css">
  <link rel="stylesheet" href="assets/css/fontawesome.css">
  <link rel="stylesheet" href="assets/css/card.css">
  <link rel="stylesheet" type="text/css" href="assets/css/table.css">
  <link rel="stylesheet" type="text/css" href="assets/css/color.css">
  <link rel="stylesheet" type="text/css" href="assets/css/responsive.css">
  <link rel="stylesheet" type="text/css" href="assets/css/owl.carousel.css">
  <link rel="stylesheet" type="text/css" href="assets/css/animate.css">
  <link rel="stylesheet" type="text/css" href="assets/css/jquery.mCustomScrollbar.css">
  <link rel="stylesheet" type="text/css" href="assets/css/jquery.bxslider.css">
  <link rel="stylesheet" type="text/css" href="assets/css/custom.css">
  <link rel="stylesheet" media="screen"  href="assets/css/beranda.css">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  
  
  <script class="u-script" type="text/javascript" src="assets/js/jquery.js" defer=""></script>
  <script class="u-script" type="text/javascript" src="assets/js/nicepage.js" defer=""></script>
  

  <link id="u-theme-google-font" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i|Open+Sans:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i">
  <link id="u-page-google-font" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i|Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i">

  <script language="JavaScript">
    var txt="<?=$profileData[0]['prof_lnm']?>";
    var kecepatan=100;
    var segarkan=null;

    function bergerak() {
      document.title=txt;
      txt= txt.substring(1,txt.length)+txt.charAt(0);
      segarkan=setTimeout("bergerak()",kecepatan);
    }
    bergerak();

  </script>

  <meta name="theme-color" content="#478ac9">
  <meta property="og:title" content="Pengumuman">
  <meta property="og:type" content="website">
  <meta data-intl-tel-input-cdn-path="intlTelInput/">

</head>


<body data-path-to-root="./" data-include-products="false" class="u-body u-xl-mode" data-lang="en">



  <?php 
  
  include_once ("views/navbar.php");
  
  ?>
  
  <!-- BANNER -->
  <section class="skrollable u-align-center u-clearfix u-shading u-video u-video-cover u-section-1" id="carousel_d7ac">
    <?=requestRecTemplate4('ban_title, ban_img', 'pub_banner', 'ban_stat=003 AND _active=1', '_cre_date DESC', 1, 1)?>
    <div class="data-layout-selected u-clearfix u-expanded-width u-gutter-0 u-layout-wrap u-layout-wrap-1">
      <div class="u-gutter-0 u-layout">
        <div class="u-layout-row py-lg-5 py-0">
          <div class="u-align-left u-container-style u-layout-cell u-shape-rectangle u-size-32 u-layout-cell-1 mt-lg-5 mt-0">
            <div class="u-container-layout u-container-layout-1">
              <img class="u-align-center u-image u-image-default u-image-1" src="../images/logodiskominfoout.png" alt="" data-image-width="581" data-image-height="508" data-animation-name="customAnimationIn" data-animation-duration="1000">
            </div>
          </div>
          <div class="u-container-style u-layout-cell u-size-28 u-layout-cell-2 text-content-banner mt-lg-5 mt-0">
            <div class="u-container-layout u-container-layout-2">
              <h1 class="u-align-left u-text u-text-body-alt-color u-text-1" data-animation-name="customAnimationIn" data-animation-duration="1000" data-animation-delay="0"><span style="font-weight: 700; font-style: italic;">
                <?= $profileData[0]['prof_lnm']?>
              </span>
            </h1>
            <ul class="u-align-left u-custom-list u-text u-text-body-alt-color u-text-2" data-animation-name="customAnimationIn" data-animation-duration="1000" data-animation-delay="250">Website Resmi <?= $profileData[0]['prof_lnm']?></ul>
            </div>
          </div>
        </div>
      </div>
    </div>

  </section>
  <!-- END BANNER -->


  <!-- LAYANAN BARU -->
  <section class="skrollable u-clearfix u-container-align-center-lg u-container-align-center-md u-container-align-center-sm u-container-align-center-xl u-image u-parallax u-section-2" id="carousel_6077" data-image-width="1497" data-image-height="1000">
    <div class="u-clearfix u-sheet u-sheet-1">
      <h1 class="u-text u-text-default u-text-1" data-animation-name="customAnimationIn" data-animation-duration="1000" data-animation-delay="0" style="font-size: 1.5rem;">
        <span style="font-weight: 700;">Layanan</span> <span style="font-weight: 400; color: color: #d33030;"> <?= $profileData[0]['prof_lnm']?> </span> apa aja ya?
      </h1>
      <div class="data-layout-selected u-clearfix u-expanded-width u-gutter-14 u-layout-wrap u-layout-wrap-1">
        <div class="u-gutter-0 u-layout">
          <div class="u-layout-col">
            <div class="u-size-30">
              <div class="u-layout-row">
                <div class="u-align-left u-container-style u-layout-cell u-size-30 u-layout-cell-1">
                  <div class="u-container-layout u-container-layout-1">
                    <h1 style="font-size: 1.5rem;" class="u-text u-text-2" data-animation-name="customAnimationIn" data-animation-duration="1000" data-animation-delay="0">Layanan <span style="font-weight: 700;">Masyarakat</span>
                    </h1>
                    <p class="u-text u-text-body-color u-text-default u-text-3" data-animation-name="customAnimationIn" data-animation-duration="1000" data-animation-delay="250" data-toggle="modal" data-target="#myModal2" style="font-size : 1rem;">Berikut merupakan layanan - layanan dari Dinas Komunikasi dan Informatika Kab. Sidoarjo untuk masyarakat umum.</p>
                    <a href="#myModal2" class="u-active-palette-1-base u-align-left u-border-none u-btn u-btn-round u-button-style  u-hover-black u-palette-1-base u-radius u-text-active-white u-text-body-alt-color u-text-hover-white u-btn-1" data-animation-name="fadeIn" data-animation-duration="1000" data-animation-delay="500" data-toggle="modal" data-target="#myModal2">lihat</a>
                    <span class=" u-file-icon u-icon u-icon-circle u-palette-1-base u-text-white u-icon-1" data-animation-name="customAnimationIn" data-animation-duration="1000" data-animation-delay="750"><img src="../images/33308-67bffd37.png" alt="" data-toggle="modal" data-target="#myModal2"></span>
                  </div>
                </div>
                <div class="u-align-center u-container-style u-image u-layout-cell u-size-30 u-image-1" data-image-width="1042" data-image-height="1042" data-animation-name="customAnimationIn" data-animation-duration="1000" data-animation-delay="0">
                  <div class="u-container-layout u-valign-middle u-container-layout-2"></div>
                </div>
              </div>
            </div>
            <div class="u-size-30">
              <div class="u-layout-row">
                <div class="u-container-style u-image u-layout-cell u-size-30 u-image-2" data-image-width="1042" data-image-height="1042" data-animation-name="customAnimationIn" data-animation-duration="1000" data-animation-delay="0">
                  <div class="u-container-layout u-valign-middle u-container-layout-3"></div>
                </div>
                <div class="u-container-style u-layout-cell u-shape-rectangle u-size-30 u-layout-cell-4">
                  <div class="u-container-layout u-container-layout-4">
                    <h1 style="font-size: 1.5rem;" class="u-align-left u-text u-text-4" data-animation-name="customAnimationIn" data-animation-duration="1000" data-animation-delay="0">Layanan <span style="font-weight: 700;">Pemerintahan</span>
                    </h1>
                    <p class="u-align-left u-text u-text-5" data-animation-name="customAnimationIn" data-animation-duration="1000" data-animation-delay="250" style="font-size : 1rem; color: black;"> Berikut merupakan layanan - layanan dari Dinas Komunikasi dan Informatika Kab. Sidoarjo untuk sesama instansi pemerintahan.</p><span class="u-file-icon u-icon u-icon-circle u-palette-1-base u-text-white u-icon-2" data-animation-name="customAnimationIn" data-animation-duration="1000" data-animation-delay="750" data-toggle="modal" data-target="#myModal1"><img src="../images/2910791-89a00c96.png" alt=""></span>
                    <div data-toggle="modal" data-target="#myModal1" class="u-active-palette-1-base u-align-left-lg u-align-left-md u-align-left-sm u-align-left-xl u-border-none u-btn u-btn-round u-button-style u-hover-black u-palette-1-base u-radius u-text-active-white u-text-body-alt-color u-text-hover-white u-btn-2" data-animation-name="customAnimationIn" data-animation-duration="1000" data-animation-delay="1000">lihat</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- END LAYANAN BARU -->


  <!-- PPID -->
  <section class="u-align-center u-clearfix u-palette-1-base u-section-3" id="carousel_13aa">
    <div class="u-clearfix u-sheet u-sheet-1">
      <img class="u-image u-image-contain u-image-default u-image-1" src="../images/28788633_02june22_megaphone_icon_02.png" alt="" data-image-width="1300" data-image-height="1454" data-custom-animation="{&quot;animation&quot;:{&quot;XXL&quot;:{&quot;steps&quot;:[],&quot;hidden&quot;:false,&quot;start&quot;:{&quot;at&quot;:&quot;bottom&quot;,&quot;off&quot;:0},&quot;end&quot;:{&quot;at&quot;:&quot;top&quot;,&quot;off&quot;:0}},&quot;XL&quot;:{&quot;steps&quot;:[{&quot;dist&quot;:0.5,&quot;blur&quot;:0,&quot;sticky&quot;:false,&quot;fixed&quot;:false,&quot;mx&quot;:&quot;154&quot;,&quot;my&quot;:0,&quot;op&quot;:1,&quot;rot&quot;:&quot;0&quot;,&quot;sx&quot;:1.96,&quot;sy&quot;:1.96,&quot;bgy&quot;:0}],&quot;hidden&quot;:false,&quot;start&quot;:{&quot;at&quot;:&quot;bottom&quot;,&quot;off&quot;:0},&quot;end&quot;:{&quot;at&quot;:&quot;top&quot;,&quot;off&quot;:0}},&quot;LG&quot;:{&quot;steps&quot;:[],&quot;hidden&quot;:false,&quot;start&quot;:{&quot;at&quot;:&quot;bottom&quot;,&quot;off&quot;:0},&quot;end&quot;:{&quot;at&quot;:&quot;top&quot;,&quot;off&quot;:0}},&quot;MD&quot;:{&quot;steps&quot;:[],&quot;hidden&quot;:false,&quot;start&quot;:{&quot;at&quot;:&quot;bottom&quot;,&quot;off&quot;:0},&quot;end&quot;:{&quot;at&quot;:&quot;top&quot;,&quot;off&quot;:0}},&quot;SM&quot;:{&quot;steps&quot;:[],&quot;hidden&quot;:false,&quot;start&quot;:{&quot;at&quot;:&quot;bottom&quot;,&quot;off&quot;:0},&quot;end&quot;:{&quot;at&quot;:&quot;top&quot;,&quot;off&quot;:0}},&quot;XS&quot;:{&quot;steps&quot;:[],&quot;hidden&quot;:false,&quot;start&quot;:{&quot;at&quot;:&quot;bottom&quot;,&quot;off&quot;:0},&quot;end&quot;:{&quot;at&quot;:&quot;top&quot;,&quot;off&quot;:0}}},&quot;container&quot;:&quot;&quot;}">
      <h2 class="u-align-center u-text u-text-default u-text-1" data-animation-name="customAnimationIn" data-animation-duration="1500">
        <span style="font-weight: 700; font-size: 1.5rem; color: white;">PPID </span> <span style="color: white; font-size: 1.5rem;">Kabupaten Sidoarjo</span>
      </h2>
      <p class="u-align-center u-text u-text-default u-text-2" data-animation-name="customAnimationIn" data-animation-duration="1000" data-animation-delay="500"> <span style="color: white; font-size : 1rem;">Pejabat Pengelola Informasi dan Dokumentasi (PPID)</p> </span>
      <a href="https://ppid.sidoarjokab.go.id/" class="u-border-2 u-border-hover-palette-4-light-1 u-border-white u-btn u-btn-round u-button-style u-hover-palette-1-base u-none u-radius u-btn-1" target="_blank" data-animation-name="customAnimationIn" data-animation-duration="1000" data-animation-delay="0">selengkapnya</a>
    </div>
  </section>
  <!-- END PPID -->

    <!-- BERITA -->

  <section class="news-section my-5">
    <div class="container">
      <div class="heading-style-1">
        <h2 class="u-text u-text-custom-color-1 u-text-default u-text-1" data-animation-name="customAnimationIn" data-animation-duration="1500">
          <span style="font-weight: 700; font-size: 1.5rem">Berita Terbaru</span>
        </h2>
      </div>
      <em></em> <a href="001/" class="btn-style-1">Lainnya</a>
      <div class="row owl-carousel owl-news">
        <?=requestRecTemplate4('post_id, post_judul, post_desk, post_publish, post_see, post_img', 'pub_post', 'ca_id=001 AND _active=1', 'post_publish DESC',4, 4)?>
      </div>
    </div>
  </section>
  <!-- END BERITA -->



  <!-- START BIDANG -->
  <section class="u-align-center u-clearfix u-section-4" id="carousel_486e">
    <div class="u-clearfix u-sheet u-sheet-1"">
      <h2 style="font-size: 1.5rem;" class="u-align-center u-text u-text-1" data-animation-name="customAnimationIn" data-animation-duration="1500"><b><i>BIDANG <span style="font-weight: 400;"> <?= $profileData[0]['prof_lnm']?> </span></i></b>
      </h2>
      <p class="u-align-center u-text u-text-2" data-animation-name="customAnimationIn" data-animation-duration="1000" data-animation-delay="250" style="font-size : 1rem;">Keseluruhan Bidang yang ada pada <?= $profileData[0]['prof_lnm']?></p>
      <div class="u-expanded-width u-list u-list-1">
        <div class="u-repeater u-repeater-1 d-flex justify-content-center align-items-center flex-wrap">
          <?=requestRecTemplate4('jab_nm, stat', 'set_jabdept', 'stat=2 AND _active=1', '', '', 14)?>
        </div>
      </div>
    </div>
  </section>
  <!-- END BIDANG -->


  <!-- PIMPINAN -->
  <section class="u-align-center u-clearfix u-white u-section-5" id="sec-1873">
    <div class="u-clearfix u-sheet u-sheet-1">
      <?=requestRecTemplate4('emp_nm, emp_desk, emp_lhkpn, jab_id, emp_img', 'pub_employees', 'jab_id=001 AND _active=1', '',1, 2)?>
    </div>
  </section>
  <!-- END PIMPINAN -->


  <section class="u-clearfix u-white u-section-6" id="carousel_f528">
    <div class="u-expanded-width u-palette-1-base u-shape u-shape-rectangle u-shape-1"></div>
      <div class="custom-expanded u-carousel u-gallery u-gallery-slider u-layout-carousel u-lightbox u-no-transition u-show-text-on-hover u-gallery-1" id="carousel-e0e9" data-interval="5000" data-u-ride="carousel">
        <div class="u-carousel-inner u-gallery-inner" role="listbox">
            <div class="container">
              <div class="row justify-content-center align-items-center gal">
                <div class="owl-carousel owl-gallery">
                  <?=requestRecTemplate4('ban_title, ban_img', 'pub_banner', 'ban_stat=001 AND _active=1', '_cre_date DESC',5, 7)?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="u-align-left u-container-align-left u-container-style u-group u-radius-20 u-shape-round u-white u-group-1" data-animation-name="customAnimationIn" data-animation-duration="1500" data-animation-delay="500" style="box-shadow: 0px 13px 40px 6px rgba(128,128,128,0.8);">
        <div class="u-container-layout u-valign-middle u-container-layout-1">
          <h3 style="font-size: 1.5rem;" class="u-align-left u-text u-text-1"> Galeri Kegiatan<br>
          </h3>
          <p class="u-align-left u-text u-text-default u-text-2" style="font-size: 1rem;">Dokumentasi kegiatan  <?= $profileData[0]['prof_lnm']?></b>
          </p>
        </div>
    </div>
  </section>



  <!-- AGENDA -->
  <section class="u-align-center-lg u-align-center-md u-align-center-sm u-align-center-xs u-clearfix u-container-align-center-sm u-container-align-center-xs u-section-7" id="carousel_1fa5">
    <div class="u-clearfix u-sheet u-sheet-1">
      <h2 style="font-size: 1.5rem;" class="u-align-center u-text u-text-1" data-animation-name="customAnimationIn" data-animation-duration="1500"><b><i>BIDANG <span style="font-weight: 400;"> <?= $profileData[0]['prof_lnm']?> </span></i></b></h2>
      <p class="u-align-center u-text u-text-2" data-animation-name="customAnimationIn" data-animation-duration="1000" data-animation-delay="250" style="font-size : 1rem;">Agenda kegiatan dalam <?= $profileData[0]['prof_lnm']?></p>
      <div class="u-list u-list-1">
        <div class="u-repeater u-repeater-1">
          <?= requestRecTemplate4('post_id, post_judul, post_desk, post_publish, post_datex, post_img', 'pub_post', 'ca_id=002 AND _active=1', 'post_publish DESC', 4, 9) ?>
        </div>
      </div>
    </div>
  </section>
  <!-- END AGENDA -->


  <section >
    <div class="container">
      <div class="row justify-content-start align-items-center gap-5" data-animation-name="customAnimationIn" data-animation-duration="1000" data-animation-delay="0">
        <div class="col-lg-5">
          <img src="../images/form-message.svg" alt="..." class="img-fluid" height="20px;"/>
          <h5 class="text-danger">KRITIK DAN SARAN</h5>
          <h2 style="font-weight: 700;">Kirim kritik dan saran melalui form ini</h2>
          <p class="text-muted">Senin - Jumat, 08.00 - 16.00 Wib</p>
        </div>
        <div class="col-lg-6">
          <form class="row" data-animation-name="customAnimationIn" data-animation-duration="1000" data-animation-delay="0">
            <div class="mb-2">
              <label class="form-label visually-hidden" for="inputName">Name</label>
              <input class="form-control form-quriar-control" id="inputName" type="text" placeholder="Name" />
            </div>
            <div class="mb-2">
              <label class="form-label visually-hidden" for="inputEmail">Another label</label>
              <input class="form-control form-quriar-control" id="inputEmail" type="email" placeholder="Email" />
            </div>
            <div class="mb-5">
              <label class="form-label visually-hidden" for="validationTextarea">Message</label>
              <textarea class="form-control form-quriar-control is-invalid border-400" id="validationTextarea" placeholder="Message" style="height: 150px" required="required"></textarea>
            </div>
            <div class="d-grid">
              <button class="btn text-white p-3" style="background-color: #478ac9;" type="submit">Kirim Kritik atau Saran<i class="fas fa-paper-plane ms-2"></i></button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>


  <?php 
  include_once "views/footer.php";
  ?>


  <!-- MODAL SECTION -->


  <!-- START ANNOUNCEMENT MODAL -->
  <div class="modal fade overflow-hidden" id="announcementModal" tabindex="-1" aria-labelledby="pengumumanModal" aria-hidden="true">
    <div class="modal-dialog modal modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header border-0">
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body p-0">
          <div class="owl-carousel owl-announcement owl-theme">
            <?=requestRecTemplate4('post_id, post_img', 'pub_post', 'ca_id=003 AND _active=1', '', 1, 8)?>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- END ANNOUNCEMENT MODAL -->



  <script src="assets/js/jquery-1.11.3.js"></script>
  <script src="assets/js/owl.carousel.min.js"></script>
  <script src="assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
  <script src="assets/js/jquery.bxslider.min.js"></script>
  <script src="assets/js/jquery.flexslider.js" defer ></script>
  <script src="assets/js/jquery.accordion.js"></script>
  <script src="assets/js/custom.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>

  <script type="text/javascript">
    
  $(document).ready(function(){
    var widthdoc  = $( document ).width();
    console.log(widthdoc);
    if(widthdoc > 480){
      $("#ann").remove();
    }
  })


</body>
</html>
