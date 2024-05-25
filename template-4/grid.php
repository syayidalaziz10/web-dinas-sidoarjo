<?php 


require('../conf/config.php');
require('../conf/phpFunction.php');

$queryProfile    = $mysqli->query('SELECT * FROM pub_profile');
$profileData     = $queryProfile->fetch_all(MYSQLI_ASSOC);


$kategori = $_GET['kategori'];


$getCategory  = $mysqli->query("SELECT ca_nm, ca_desk FROM set_category  WHERE ca_id = $kategori");
$category     = $getCategory->fetch_assoc();



?>


<!DOCTYPE html>
<html>
<head>


<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="utf-8">
<meta name="description" content="">



<link rel="shortcut icon" type="image/x-icon" href="images/default/logo.png">

<link rel="stylesheet" media="screen"  href="../assets/css/nicepage.css">
<link rel="stylesheet" href="../assets/css/fontawesome.css">
<link rel="stylesheet" href="../assets/css/card.css">
<link rel="stylesheet" type="text/css" href="../assets/css/table.css">
<link rel="stylesheet" type="text/css" href="../assets/css/color.css">
<link rel="stylesheet" type="text/css" href="../assets/css/responsive.css">
<link rel="stylesheet" type="text/css" href="../assets/css/owl.carousel.css">
<link rel="stylesheet" type="text/css" href="../assets/css/animate.css">
<link rel="stylesheet" type="text/css" href="../assets/css/jquery.mCustomScrollbar.css">
<link rel="stylesheet" type="text/css" href="../assets/css/jquery.bxslider.css">
<link rel="stylesheet" type="text/css" href="../assets/css/custom.css">
<link rel="stylesheet" media="screen"  href="../assets/css/beranda.css">

<link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css">

<script class="u-script" type="text/javascript" src="../assets/js/jquery.js" defer=""></script>
<script class="u-script" type="text/javascript" src="../assets/js/nicepage.js" defer=""></script>


<link id="u-theme-google-font" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i|Open+Sans:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i">
<link id="u-page-google-font" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i|Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i">

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

<meta name="theme-color" content="#478ac9">
<meta property="og:title" content="Pengumuman">
<meta property="og:type" content="website">
<meta data-intl-tel-input-cdn-path="intlTelInput/">

</head>


<body data-path-to-root="./" data-include-products="false" class="u-body u-xl-mode" data-lang="en">





   <?php 

   include_once "views/navbar.php";

   ?>

   <section class="detail-header-section">
      <div class="container">
         <div class="row d-flex justify-content-center align-items-center">
            <div class="col-8 detail-header-teks" >
               <h1 style="text-transform: uppercase;"><?= $category['ca_nm']?></h1>
               <p><?= $category['ca_desk']?></p>
            </div>
            <div class="col-4">
               <img src="../../images/vector detail/layanan.png" class="img-fluid" alt="alt"/>
            </div>
         </div>
      </div>
   </section>

   <section class="detail-grid-section">
      <div class="container">
         <div class="row">
            <?php

               $page = (isset($_GET['page']))? $_GET['page'] : 1;
               $limit = 6; 
               $limit_start = ($page - 1) * $limit;
               $no = $limit_start + 1;

               $query = "SELECT * FROM pub_post WHERE ca_id=$kategori AND _active=1 ORDER BY post_publish DESC LIMIT $limit_start, $limit";
               $video = $mysqli->prepare($query);
               $video->execute();
               $res1 = $video->get_result();

               while ($row = $res1->fetch_assoc()) {
                  $id 		    = $row['post_id'];
                  $title 	    = $row['post_judul'];
                  $desk 	    = $row['post_desk'];
                  $date 	    = $row['post_publish'];
                  $count 	    = $row['post_see'];

                  $dir_image   = '../'.$_dirPost.$row['post_img'];
				
				
                  if ((!empty($row['post_img'])) && file_exists($dir_image)){
                     $image = $dir_image;
                  } else {
                     $image = '../'.$_dirPost . 'default-template-2.png';
                  }

                  // CUT DESCRIPTION WHERE MAX LEGHT > 100

                  $title = strip_tags($title);

                  if (strlen($title) > 70) {
                     $title = substrwords($title, 70);
                  }

            ?>

                  <div class="col-lg-4 col-md-6 mb-5">
                     <div class="rounded overflow-hidden">
                        <div class="position-relative overflow-hidden">
                           <img class="img-fluid w-100" src="<?= $image?>" alt="" style="height: 230px; object-fit: cover;">
                        </div>
                        <div class="p-4" style="background-color: #f6f4f9; height: 200px;">
                           <div class="d-flex justify-content-start align-items-start gap-3">
                              <p class="fw-medium mb-2"><i class="fa-solid fa-calendar-days"></i>  <?= dateToDMY($date)?></p>
                              <p><i class="fa-solid fa-eye"></i> <?= $count?></p>
                           </div>
                           <a href="<?= $id?>" class="text-decoration-none">
                              <h4 class="lh-base mb-0 fw-bolder"><?= $title?></a>
                           </a>
                        </div>
                     </div>
                  </div>


            <?php } ?>
            </div>
            <div class="col-md-12">
               <nav class="my-5">
                  <ul class="pagination justify-content-center">
                  <?php
                     $countVid = "SELECT count(*) AS jumlah FROM pub_post WHERE ca_id=$kategori AND _active=1";
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


   </section>




   <?php 

   include_once "views/footer.php";

   ?>



<script src="../assets/js/jquery-1.11.3.js"></script>
<script src="../assets/js/bootstrap.min.js"></script>
<script src="../assets/js/owl.carousel.min.js"></script>
<script src="../assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
<script src="../assets/js/jquery.bxslider.min.js"></script>
<script src="../assets/js/jquery.flexslider.js" defer ></script>
<script src="../assets/js/custom.js"></script>
<script src="../assets/js/jquery.accordion.js"></script>

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
