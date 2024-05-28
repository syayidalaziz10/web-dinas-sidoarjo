<?php 


  require('../../conf/config.php');
  require('../../conf/phpFunction.php');

  // if(!empty(loadRecText('prof_sty', 'pub_profile', '_active=1'))){
	// $_urlTemp = explode('/', $_SERVER['REQUEST_URI']);
	// if(loadRecText('prof_sty', 'pub_profile', '_active=1') != $_urlTemp[1]){
	// 	echo '<meta content="0; url=http://'.$_SERVER['SERVER_NAME'].'/'.loadRecText('prof_sty', 'pub_profile', '_active=1').'" http-equiv="refresh">';	
	// }
  // } else {
	// echo '<meta content="0; url=http://'.$_SERVER['SERVER_NAME'].'/template-1" http-equiv="refresh">';	
  // }

  $queryProfile    = $mysqli->query('SELECT * FROM pub_profile');
  $profileData     = $queryProfile->fetch_all(MYSQLI_ASSOC);


?>


<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <link rel="shortcut icon" href="images/profile/<?= $profileData[0]['prof_lg']?>">

  <title><?= $profileData[0]['prof_lnm'];?></title>

  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" media="screen"  href="../assets/css/nicepage.css">
  <link rel="stylesheet" href="../assets/css/fontawesome.css">
  <link rel="stylesheet" type="text/css" href="../assets/css/responsive.css">
  <link rel="stylesheet" type="text/css" href="../assets/css/custom.css">
  <link rel="stylesheet" media="screen"  href="../assets/css/beranda.css">
  <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="../assets/css/jquery.fancybox.min.css">

  <script class="u-script" type="text/javascript" src="../assets/js/jquery.js" defer=""></script>
  <script class="u-script" type="text/javascript" src="../assets/js/nicepage.js" defer=""></script>

  <link id="u-theme-google-font" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i|Open+Sans:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i">
  <link id="u-page-google-font" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i|Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i">


</head>
<body>



  <!-- ======= Header ======= -->
  <?php 
  
    include_once('../views/navbar.php')
  
  ?>
  <!-- End Header -->

  <section class="detail-header-section">
    <div class="container">
      <div class="row d-flex justify-content-center align-items-center">
        <div class="col-8 detail-header-teks" >
          <h1 style="text-transform: uppercase;">Galeri Kegiatan</h1>
        </div>
        <div class="col-4">
          <img src="../../images/vector detail/agenda.png" class="img-fluid" alt="alt"/>
        </div>
      </div>
    </div>
  </section>

  <div class="py-5">
    <div class="container">
      <div class="row">
        <?php

          $page = (isset($_GET['page']))? $_GET['page'] : 1;
          $limit = 6; 
          $limit_start = ($page - 1) * $limit;
          $no = $limit_start + 1;

          $query = "SELECT * FROM pub_banner WHERE ban_stat=002 AND _active=1 ORDER BY _cre DESC LIMIT $limit_start, $limit";
          $video = $mysqli->prepare($query);
          $video->execute();
          $res1 = $video->get_result();

          while ($row = $res1->fetch_assoc()) {
            $id = $row['sos_id'];
            $url = $row['sos_url'];
            $queryString = parse_url($url, PHP_URL_QUERY);
            parse_str($queryString, $params);
            $videoId = $params['v'];
          ?>

          <div class="col-lg-6 col-md-6 align-self-center mb-30 event_outer design">
              <a href="<?= $image?>" class="gal-item mb-4" data-fancybox="gal" data-caption="<?= $title?>"><img src="<?= $image?>" alt="Image" class="img-fluid"></a>
          </div>

        <?php } ?>
      </div>
      <div class="row pt-5">
        <div class="col-md-12">
          <nav class="my-5">
            <ul class="pagination justify-content-center">
              <?php
                $countVid = "SELECT count(*) AS jumlah FROM pub_banner WHERE ban_stat=002 AND _active=1";
                $video = $mysqli->prepare($countVid);
                $video->execute();
                $res1 = $video->get_result();
                $row = $res1->fetch_assoc();
                $total_records = $row['jumlah'];

                $jumlah_page = ceil($total_records / $limit);
                $jumlah_number = 2;
                $start_number = ($page > $jumlah_number)? $page - $jumlah_number : 1;
                $end_number = ($page < ($jumlah_page - $jumlah_number))? $page + $jumlah_number : $jumlah_page;
                
                if($page == 1){
                  echo '<li class="page-item disabled"><a class="page-link" href="#"><span aria-hidden="true">&laquo;</span></a></li>';
                } else {
                  $link_prev = ($page > 1)? $page - 1 : 1;
                  echo '<li class="page-item"><a class="page-link" href="halaman-'.$link_prev.'" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>';
                }


                for($i = $start_number; $i <= $end_number; $i++){
                  $link_active = ($page == $i)? ' active' : '';
                  echo '<li class="page-item '.$link_active.'"><a class="page-link" href="halaman-'.$i.'">'.$i.'</a></li>';
                }
                
                if($page == $jumlah_page){
                  echo '<li class="page-item disabled"><a class="page-link" href="#"><span aria-hidden="true">&raquo;</span></a></li>';
                } else {
                  $link_next = ($page < $jumlah_page)? $page + 1 : $jumlah_page;
                  echo '<li class="page-item"><a class="page-link" href="halaman-'.$link_next.'" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>';
                }
              ?>
            </ul>
          </nav>
        </div>
      </div>
    </div>
  </div>

    <!-- footer start -->


    <?php 
    
    include_once('../views/visitor.php');
    include_once('../views/social.php');
    include_once('../views/footer.php');
    
    
    ?>


    <!-- footer end -->

  <!-- Bootstrap core JavaScript -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>


  <!-- Scripts -->
  <script src="../assets/js/jquery-1.11.3.js"></script>
  <script src="../assets/js/header.js"></script>
  <script src="../assets/js/custom.js"></script>
  <script src="../assets/js/jquery.fancybox.min.js"></script>




  </body>
</html>
