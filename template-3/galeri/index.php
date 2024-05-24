<?php 

require('../../conf/config.php');
require('../../conf/phpFunction.php');

  $profile =  $mysqli->query('SELECT * from pub_profile WHERE _active=1 ORDER BY _cre DESC');
  $prof = $profile->fetch_all(MYSQLI_ASSOC);

  $dir_image_prof = $dirProf.$prof[0]['prof_lg'];
 
  
  if ((!empty($prof[0]['prof_lg'])) && file_exists($dir_image_prof)) {
    $src = '../images/profile/'.$prof[0]['prof_lg'];
  } else {
    $src = '../images/profile/default.png';
  }
?>



<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title><?= $prof[0]['prof_lnm']?></title>
    <link rel="shortcut icon" href="../<?= $src?>">
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <!-- <link href="assets/img/favicon.png" rel="icon"> -->
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Jost:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="../assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="../assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Main CSS File -->
    <link href="../assets/css/main.css" rel="stylesheet">
</head>

<body data-spy="scroll" data-target=".site-navbar-target" data-offset="100">


    <?php 
    require_once('../views/navbar_det.php');
  ?>



    <main class="main">
        <!-- Page Title -->
        <div class="page-title" data-aos="fade">
            <div class="container">
                <nav class="breadcrumbs">
                    <ol>
                        <li><a href="../index.php">Home</a></li>
                        <li class="current">Galeri Digital</li>
                    </ol>
                </nav>
                <h1>Galeri Digital</h1>
            </div>
        </div><!-- End Page Title -->

        <section id="portfolio" class="portfolio section">

            <div class="container" data-aos="fade-up" data-aos-delay="100">
                <div class="row gutter-2 gallery justify-content-start align-items-center">
                    <?php

      $page = (isset($_GET['page']))? $_GET['page'] : 1;
      $limit = 9; 
      $limit_start = ($page - 1) * $limit;
      $no = $limit_start + 1;

      $query = "SELECT * FROM pub_banner WHERE cat=002 AND _active=1 ORDER BY _cre_date DESC LIMIT $limit_start, $limit";
      $video = $mysqli->prepare($query);
      $video->execute();
      $res1 = $video->get_result();

      while ($row = $res1->fetch_assoc()) {
				$title = $row['ban_title'];
				$desk = $row['ban_desk'];
				$image = 'images/banners/'.$row['ban_img'];
      ?>


                    <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-app mb-3 rounded">
                        <img src="../<?= $image?>" class="img-fluid" alt="">
                        <div class="portfolio-info">
                            <h4><?= $title?></h4>
                            <p><?= $desk?></p>
                            <a href="../<?= $image?>" title="'.$title.'" data-gallery="portfolio-gallery-app"
                                class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                        </div>
                    </div>

                    <?php } ?>

                </div>
            </div>


            <?php
    $countVid = "SELECT count(*) AS jumlah FROM pub_banner WHERE cat=002 AND _active=1";
    $video = $mysqli->prepare($countVid);
    $video->execute();
    $res1 = $video->get_result();
    $row = $res1->fetch_assoc();
    $total_records = $row['jumlah'];
  ?>

            <nav class="my-5">
                <ul class="pagination justify-content-center">
                    <?php
        $jumlah_page = ceil($total_records / $limit);
        $jumlah_number = 2;
        $start_number = ($page > $jumlah_number)? $page - $jumlah_number : 1;
        $end_number = ($page < ($jumlah_page - $jumlah_number))? $page + $jumlah_number : $jumlah_page;
        
        if($page == 1){
          echo '<li class="page-item disabled"><a class="page-link" href="#">First</a></li>';
          echo '<li class="page-item disabled"><a class="page-link" href="#"><span aria-hidden="true">&laquo;</span></a></li>';
        } else {
          $link_prev = ($page > 1)? $page - 1 : 1;
          echo '<li class="page-item"><a class="page-link" href="?page=1">First</a></li>';
          echo '<li class="page-item"><a class="page-link" href="?page='.$link_prev.'" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>';
        }


        for($i = $start_number; $i <= $end_number; $i++){
          $link_active = ($page == $i)? ' active' : '';
          echo '<li class="page-item '.$link_active.'"><a class="page-link" href="?page='.$i.'">'.$i.'</a></li>';
        }
        
        if($page == $jumlah_page){
          echo '<li class="page-item disabled"><a class="page-link" href="#"><span aria-hidden="true">&raquo;</span></a></li>';
          echo '<li class="page-item disabled"><a class="page-link" href="#">Last</a></li>';
        } else {
          $link_next = ($page < $jumlah_page)? $page + 1 : $jumlah_page;
          echo '<li class="page-item"><a class="page-link" href="?page='.$link_next.'" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>';
          echo '<li class="page-item"><a class="page-link" href="?page='.$jumlah_page.'">Last</a></li>';
        }
      ?>
                </ul>
            </nav>

        </section>
    </main>
    <?php require_once('../views/footer_det.php')?>


    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>




    <!-- Vendor JS Files -->
    <script src="../assets/js/jquery.fancybox.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/vendor/php-email-form/validate.js"></script>
    <script src="../assets/vendor/aos/aos.js"></script>
    <script src="../assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="../assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="../assets/vendor/waypoints/noframework.waypoints.js"></script>
    <script src="../assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
    <script src="../assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


    <!-- Main JS File -->
    <script src="../assets/js/main.js"></script>
</body>

</html>