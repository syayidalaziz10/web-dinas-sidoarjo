<?php 

require('../conf/config.php');
require('../conf/phpFunction.php');

if(!empty(loadRecText('prof_sty', 'pub_profile', '_active=1'))){
	$_urlTemp = explode('/', $_SERVER['REQUEST_URI']);
	if(loadRecText('prof_sty', 'pub_profile', '_active=1') != $_urlTemp[1]){
		echo '<meta content="0; url=http://'.$_SERVER['SERVER_NAME'].'/'.loadRecText('prof_sty', 'pub_profile', '_active=1').'" http-equiv="refresh">';	
	}
  } else {
	echo '<meta content="0; url=http://'.$_SERVER['SERVER_NAME'].'/template-1" http-equiv="refresh">';	
}

$profile =  $mysqli->query('SELECT * from pub_profile WHERE _active=1 ORDER BY _cre DESC');
$prof = $profile->fetch_all(MYSQLI_ASSOC);

$dir_image_prof = $dirProf.$prof[0]['prof_lg'];


if ((!empty($prof[0]['prof_lg'])) && file_exists($dir_image_prof)) {
    $src = '../images/profile/'.$prof[0]['prof_lg'];
} else {
    $src = '../images/profile/default.png';
}

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


$id 	= $result['post_id'];
$title 	= $result['post_judul'];
$desk 	= $result['post_desk'];
$date 	= $result['post_publish'];
$count 	= $result['post_see'];
$image 	= $result['post_img'];

$dir_image  = '../images/post/'.$result['post_img'];
  
  



?>





<!doctype html>
<html lang="en">



<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="author" content="Untree.co">
  <link rel="shortcut icon" href="../<?= $src?>">

  <meta name="description" content="" />
  <meta name="keywords" content="" />

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/owl.carousel.min.css">
  <link rel="stylesheet" href="../css/owl.theme.default.min.css">
  <link rel="stylesheet" href="../css/jquery.fancybox.min.css">
  <link rel="stylesheet" href="../fonts/icomoon/style.css">
  <link rel="stylesheet" href="../fonts/flaticon/font/flaticon.css">
  <link rel="stylesheet" href="../css/aos.css">
  <link rel="stylesheet" href="../css/style.css">

  <title><?= $prof[0]['prof_lnm']?></title>
</head>

<body data-spy="scroll" data-target=".site-navbar-target" data-offset="100">


  <?php 
    require_once('views/navbar.php');
    require_once('views/visitor.php');
    require_once('views/social.php');
  ?>



  <div class="untree_co-hero mb-0" id="home-section">
    <div class="container">
      <div class="row">
        <div class="col-12 p-0 mb-5">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item">
                <a href="../" class="d-flex align-items-center">
                  <span class="icon-home2 mr-2"></span>
                  <span>Beranda</span>
                </a>
              </li>
              <li class="breadcrumb-item">
                <a href="../<?= $categoryURL?>/" class="d-flex align-items-center">
                  <?php 
                  
                  if (!empty($category['ca_icon'])) {
                    echo '<img class="cat-image mr-2" src="../images/category/'.$category['ca_icon'].'"></img>';
                  } 
                  
                  ?>
                  <span><?= $category['ca_nm']?></span>
                </a>
              </li>
              <li class="breadcrumb-item active" aria-current="page">Detail <?= $category['ca_nm']?></li>
            </ol>
          </nav>
        </div>
        <div class="col-lg-7 mr-lg-5">
          <?php 

          
          if (!empty($image) && file_exists($dir_image)) {
            echo '<img src="../images/post/'.$image.'" alt="" class="img-fluid rounded-lg detail-img-banner">';
          }
          
          ?>
          <h3 class="mb-4 text-justify my-5"><?= $title ?></h3>
          <div class="d-flex justify-content-between align-items-center flex-wrap mb-5">
              <div class="fst-italic text-left mr-lg-0 mr-5">
              <?php
                if ($date !== NULL && $date !== '0000-00-00') {
                    echo '<p style="font-size: 0.9rem">Publish ' . dateToDay($date) . '</p>';
                }
              ?>
              </div>
              <div class="text-left">
                <p style="font-size: 0.9rem">
                  Dibaca <?= $count ?> kali
                </p>
              </div>
          </div>
          <div class="desk-detail text-justify">
              <?= $desk ?>

              <?php
                  if ($categoryURL == "004") {
                ?>
                  <div class="row mb-5">
                    <div class="col-12">
                      <h5 class="my-4">Unduh dokumen</h5>
                      <div class="files-table">
                        <div class="files-table-header">
                          <div class="column-header table-cell">Nama</div>
                          <div class="column-header table-cell size-cell">Download</div>
                          <div class="column-header table-cell">Opsi</div>
                          <div class="column-header table-cell"></div>
                        </div>
                        <?php
                        $query = $mysqli->query("SELECT * FROM pub_files WHERE post_id=$post_id ORDER BY files_nm");
                        $news = $query->fetch_all(MYSQLI_ASSOC);
                        
                        foreach ($news as $row) {
                            $title  = $row['files_nm'];
                            $count  = $row['files_down'];
                            if (!empty($title)) { // Tambahkan kondisi ini untuk memeriksa apakah $title tidak kosong
                        ?>
                            <div class="files-table-row">
                                <div class="table-cell name-cell pdf"><?= $title ?></div>
                                <div class="table-cell"><?= $count ?></div>
                                <div class="table-cell">
                                    <span class="icon-eye mr-2"></span>
                                    <a href="#" data-toggle="modal" data-target="#pdfModal" data-pdfsrc="../images/files/<?= $title ?>">Lihat</a>
                                </div>
                                <div class="table-cell">
                                    <span class="icon-download mr-2"></span>
                                    <a href="../images/files/force.php?file=<?= urlencode($title) ?>">Download</a>
                                </div>
                            </div>
                        <?php
                            } // Penutup dari if
                        } // Penutup dari foreach
                        ?>

                      </div>
                    </div>
                  </div>
                <?php
                    }
                ?>
          </div>
          <div class="row my-4 justify-content-start">
            <div class="col-12 d-flex justify-content-start align-items-center">
                <p class="mr-3">Bagikan : </p>
                <ul class="list-unstyled social-icons light">
                  <li><a href="<?= generateShareLink('facebook', $current_url); ?>" target="_blank"><span class="icon-facebook"></span></a></li>
                  <li><a href="<?= generateShareLink('twitter', $current_url); ?>" target="_blank"><span class="icon-twitter"></span></a></li>
                  <li><a href="<?= generateShareLink('whatsapp', $current_url); ?>" target="_blank"><span class="icon-whatsapp"></span></a></li>
                  <li><a href="<?= generateShareLink('instagram', $current_url); ?>" target="_blank"><span class="icon-instagram"></span></a></li>
                </ul>
              </div>
          </div>
          <div class="d-flex justify-content-between align-items-center">
              <?php

                $previousSql = "SELECT post_id FROM pub_post WHERE post_id < $id AND ca_id=$categoryURL AND _active=1 ORDER BY post_id DESC LIMIT 1";
                $previousResult = $mysqli->query($previousSql);
                $previousRow = $previousResult->fetch_assoc();
                $previousPostId = isset($previousRow['post_id']) ? $previousRow['post_id'] : null;

                $nextSql = "SELECT post_id FROM pub_post WHERE post_id > $id AND ca_id=$categoryURL AND _active=1 ORDER BY post_id ASC LIMIT 1";
                $nextResult = $mysqli->query($nextSql);
                $nextRow = $nextResult->fetch_assoc();
                $nextPostId = isset($nextRow['post_id']) ? $nextRow['post_id'] : null;

                if ($previousPostId !== null) {
                    echo '<a href="' . $previousPostId . '" class="read-more">Sebelumnya</a>';
                }

                if ($nextPostId !== null) {
                    echo '<a href="' . $nextPostId . '" class="read-more">Selanjutnya</a>';
                }
              ?>
          </div>
        </div>


        <?php require_once('views/side-detail.php')?>


      </div>
    </div>
  </div>



  <?php require_once('views/footer.php')?>

  

  <div id="overlayer"></div>
  <div class="loader">
    <div class="spinner-border" role="status">
      <span class="sr-only">Loading...</span>
    </div>
  </div>

  <!-- Modal View PDF -->
  <div class="modal fade" id="pdfModal" tabindex="-1" aria-labelledby="pdfModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header border-0">
          <h5 class="modal-title" id="pdfModalLabel">PDF Preview</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body d-flex justify-content-center align-items-center">
          <div id="pdfViewer"></div>
        </div>
        <div class="modal-footer border-0">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <script src="../js/jquery-3.4.1.min.js"></script>
  <script src="../js/jquery-migrate-3.0.1.min.js"></script>
  <script src="../js/popper.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <script src="../js/owl.carousel.min.js"></script>
  <script src="../js/jquery.easing.1.3.js"></script>
  <script src="../js/jquery.animateNumber.min.js"></script>
  <script src="../js/jquery.waypoints.min.js"></script>
  <script src="../js/jquery.fancybox.min.js"></script>
  <script src="../js/aos.js"></script>
  <script src="../js/pdfobject.min.js"></script>
  
  <script src="../js/custom.js"></script>


  <script>
    
    $(document).ready(function(){
      // Update the PDFObject when the modal is shown
      $('#pdfModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var pdfSrc = button.data('pdfsrc'); // Extract info from data-* attributes
        PDFObject.embed(pdfSrc, "#pdfViewer", { pdfOpenParams: { toolbar: 0 } }); // Embed the PDF using PDFObject with toolbar hidden
      });
    });

    function redirectPrevious() {
      var currentUrl = window.location.href;
      var urlParams = new URLSearchParams(currentUrl.split('?')[1]);
      var postId = urlParams.get('post_id');
      
      var previousPostId = parseInt(postId) - 1;
      var previousUrl = 'http://localhost/app/pengumuman/detail.php?post_id=' + previousPostId;
      window.location.href = previousUrl;
    }

  </script>
  
</body>

</html>