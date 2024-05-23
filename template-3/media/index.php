<!doctype html>
<html lang="en">

<?php 

  require('../conf/config.php');
  require('../conf/phpFunction.php');

  
  $profile  =  $mysqli->query('SELECT * from pub_profile WHERE _active=1 ORDER BY _cre DESC');
  $prof     = $profile->fetch_all(MYSQLI_ASSOC);

?>



<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title><?= $prof[0]['prof_lnm']?></title>
    <link rel="shortcut icon" href="images/profile/<?= $prof[0]['prof_lg']?>">
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
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css" />

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
                        <li class="current">Media Digital</li>
                    </ol>
                </nav>
                <h1>Media Digital</h1>
            </div>
        </div><!-- End Page Title -->

        <section>

            <div class="container" data-aos="fade-up" data-aos-delay="100">
                <div class="row justify-content-start align-items-center">
                    <?php
        require_once('../conf/config.php');

        $page = (isset($_GET['page'])) ? $_GET['page'] : 1;
        $limit = 9;
        $limit_start = ($page - 1) * $limit;
        $no = $limit_start + 1;

        $query = "SELECT * FROM pub_videos ORDER BY _cre DESC LIMIT $limit_start, $limit";
        $video = $mysqli->prepare($query);
        $video->execute();
        $res1 = $video->get_result();

        while ($row = $res1->fetch_assoc()) {
            $id = $row['vd_id'];
            $url = $row['vd_url'];
            $queryString = parse_url($url, PHP_URL_QUERY);
            parse_str($queryString, $params);
            $videoId = $params['v'];
        ?>
                    <div class="col-lg-4 col-md-6 col-12 mb-4">
                        <style>
                        .video-link {
                            cursor: pointer;
                            position: relative;
                            display: inline-block;
                        }

                        .play-icon {
                            position: absolute;
                            top: 50%;
                            left: 50%;
                            transform: translate(-50%, -50%);
                            font-size: 3rem;
                            color: #fff;
                        }

                        /* Define the animation */
                        @keyframes play-icon-animation {
                            0% {
                                transform: translate(-50%, -50%) scale(1);
                            }

                            50% {
                                transform: translate(-50%, -50%) scale(1.2);
                            }

                            100% {
                                transform: translate(-50%, -50%) scale(1);
                            }
                        }

                        /* Apply the animation to .play-icon when hovered */
                        .play-icon:hover {
                            animation: play-icon-animation 0.5s infinite alternate;
                            /* Play the animation infinitely */
                        }
                        </style>
                        <div class="card h-100 shadow-sm">
                            <div class="card-body p-0">
                                <p class="video-link"
                                    data-src="https://www.youtube.com/embed/<?= $videoId ?>?autoplay=1&rel=0">
                                    <img src="https://img.youtube.com/vi/<?= $videoId ?>/hqdefault.jpg"
                                        class="img-fluid" alt="YouTube Thumbnail">
                                    <span class="play-icon"><i class="bi bi-play-circle-fill"></i></span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>

            <?php
    $countVid = "SELECT count(*) AS jumlah FROM pub_videos";
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


    <!-- Scroll Top -->
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

    <!-- Main JS File -->
    <script src="../assets/js/main.js"></script>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
    <script>
    $(document).ready(function() {
        $(".video-link").click(function() {
            var videoSrc = $(this).data("src");
            $.fancybox.open({
                src: videoSrc,
                type: 'iframe',
                opts: {
                    iframe: {
                        preload: false
                    }
                }
            });
        });
    });
    </script>

</body>

</html>