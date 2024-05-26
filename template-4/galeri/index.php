<?php 


  require('../../conf/config.php');
  require('../../conf/phpFunction.php');


  $queryProfile    = $mysqli->query('SELECT * FROM pub_profile');
  $profileData     = $queryProfile->fetch_all(MYSQLI_ASSOC);


  // GET PROFILE LOGO

  if ((!empty($profileData[0]['prof_lg'])) && file_exists($_dirProf.$profileData[0]['prof_lg'])){
    $logo = $_dirProf.$profileData[0]['prof_lg'];
  } else {
    $logo = $_dirProf . 'default.png';
  }


?>


<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <link rel="shortcut icon" href="<?= $logo?>">

  <title><?= $profileData[0]['prof_lnm'];?></title>


  <!-- Additional CSS Files -->
  <link rel="stylesheet" href="../assets/css/fontawesome.css">
  <link rel="stylesheet" href="../assets/css/jquery.fancybox.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <link rel="stylesheet" href="../assets/css/custom.css">
  

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
          <h1 style="text-transform: uppercase;">Galeri</h1>
        </div>
        <div class="col-4">
          <img src="../../images/vector detail/layanan.png" class="img-fluid" alt="alt"/>
        </div>
      </div>
    </div>
  </section>

  <div class="py-5">
    <div class="container">
      <div class="row detail-gallery">
        <div class="col-12">
          <div class="row">
            <?php

            $page = (isset($_GET['page']))? $_GET['page'] : 1;
            $limit = 6; 
            $limit_start = ($page - 1) * $limit;
            $no = $limit_start + 1;

            $query = "SELECT * FROM pub_banner WHERE ban_stat = '002' AND _active = 1 ORDER BY _cre_date DESC LIMIT ?, ?";
            $video = $mysqli->prepare($query);
            
            if ($video === false) {
                // Handle error if prepare fails
                die("Error in preparing query: " . $mysqli->error);
            }
            
            // Bind parameters
            $video->bind_param("ii", $limit_start, $limit);
            
            // Execute query
            $executeSuccess = $video->execute();
            
            if ($executeSuccess === false) {
                // Handle error if execution fails
                die("Error in executing query: " . $video->error);
            }
            
            $res1 = $video->get_result();


            while ($row = $res1->fetch_assoc()) {
              $title = $row['ban_title'];
              $image = '../images/banners/'.$row['ban_img'];
            ?>

            <div class="col-lg-6 col-md-6 align-self-center mb-30 event_outer design">
              <a href="<?= $image?>" class="gal-item mb-4" data-fancybox="gal" data-caption="<?= $title?>"><img src="<?= $image?>" alt="Image" class="img-fluid"></a>
            </div>

            <?php } ?>
          </div>

          <?php
            $countVid = "SELECT count(*) AS jumlah FROM pub_banner WHERE ban_stat=002 AND _active=1";
            $video = $mysqli->prepare($countVid);
            $video->execute();
            $res1 = $video->get_result();
            $row = $res1->fetch_assoc();
            $total_records = $row['jumlah'];
          ?>

          <div class="row justify-content-start pt-5">
            <div class="col-md-12">
              <nav class="my-5">
                <ul class="pagination justify-content-center">
                  <?php
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
    </div>
  </div>

    <!-- footer start -->


    <?php 
    
    include_once('../views/footer.php');
    include_once('../views/visitor.php')
    
    
    ?>


    <!-- footer end -->


  <!-- Bootstrap core JavaScript -->

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>

    <!-- Scripts -->
  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../assets/js/jquery.fancybox.min.js"></script>
  <script src="../assets/js/custom.js"></script>





  </body>
</html>
