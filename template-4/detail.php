<?php


require('conf/config.php');
require('conf/phpFunction.php');

$queryProfile    = $mysqli->query('SELECT * FROM pub_profile');
$profileData     = $queryProfile->fetch_all(MYSQLI_ASSOC);



$url = $_SERVER['REQUEST_URI'];

$getURL = explode('/', $url);
$categoryURL = $getURL[count($getURL) - 2];


$post_id  = $_GET['post_id'];


$url_awal = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";




$getCategory  = $mysqli->query("SELECT ca_nm, ca_icon FROM set_category  WHERE ca_id = $categoryURL");
$category     = $getCategory->fetch_assoc();

$query    = $mysqli->query("SELECT * from pub_post WHERE ca_id=$categoryURL AND post_id=$post_id");
$result   = $query->fetch_assoc();

if (!$result) {
   header("Location: ../error.php");
   exit();
}

postSee($post_id);


$id 		  = $result['post_id'];
$title  	= $result['post_judul'];
$desk 	  = $result['post_desk'];
$date 	  = $result['post_publish'];
$dateEnd 	= $result['post_datex'];
$count 	  = $result['post_see'];
$image 	  = $result['post_img'];

$dir_image  = 'images/post/'.$result['post_img'];


// VARIABEL NEED OPERATION

if (!empty($image && file_exists($dir_image) )) {
   $src = '../images/post/'.$image;
} else {
   $src = '../images/post/default.png';
}


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
               <h1>LAYANAN</h1>
               <p>Seluruh Layanan Dalam Dinas Kominfo Sidoarjo</p>
            </div>
            <div class="col-4">
               <img src="../images/vector detail/layanan.png" class="img-fluid" alt="alt"/>
            </div>
         </div>
      </div>
   </section>

   <section class="detail-content">
      <div class="container">
         <div class="row justify-content-start align-items-start gap-5">
            <div class="col-lg-7">
               <div class="post-content">
                  <img src="<?= $src?>" alt="" class="img-fluid">
                  <h3 class="mt-5"><?= $title?></h3>
                  <?= $desk?>
               </div>
               <div class="share-box">
                  <strong class="title">Share This :</strong>
               </div>
            </div>
            <div class="col-lg-4 mt-3">
               <?php 
               require_once('views/side.php')
               ?>
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