<?php 

require('../conf/config.php');
require('../conf/phpFunction.php');

  $profile =  $mysqli->query('SELECT * from pub_profile WHERE _active=1 ORDER BY _cre DESC');
  $prof = $profile->fetch_all(MYSQLI_ASSOC);

$getCategory  = $mysqli->query("SELECT ca_nm, ca_icon FROM set_category  WHERE ca_id ='001'");
$category     = $getCategory->fetch_assoc();


  $url = $_SERVER['REQUEST_URI'];

  $getURL = explode('/', $url);
  $categoryURL  = $getURL[2];
  $firstUrl     = $getURL[1];


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


  $id 		= $result['post_id'];
  $title 	= $result['post_judul'];
  $desk 	= $result['post_desk'];
  $date 	= $result['post_publish'];
  $count 	= $result['post_see'];
  $image 	= $result['post_img'];

  $dir_image  = 'images/post/'.$result['post_img'];



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title><?= $prof[0]['prof_lnm']?></title>
    <link rel="shortcut icon" href="../images/profile/<?= $prof[0]['prof_lg']?>">
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <!-- <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon"> -->

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Jost:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">

    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="../assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="../assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfobject/2.2.6/pdfobject.min.js"></script>



    <!-- Main CSS File -->
    <link href="../assets/css/main.css" rel="stylesheet">

    <!-- =======================================================
  * Template Name: Arsha
  * Template URL: https://bootstrapmade.com/arsha-free-bootstrap-html-template-corporate/
  * Updated: May 13 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="service-details-page">
    <?php 
        require_once('views/navbar_det.php');
        // require_once('views/visitor.php');
        // require_once('views/social.php');

    ?>
    <main class="main">
        <!-- Page Title -->
        <div class="page-title" data-aos="fade">
            <div class="container">
                <nav class="breadcrumbs">
                    <ol>
                        <li><a href="../index.php">Home</a></li>

                        <li class="current"> <a href="../<?= $categoryURL?>/" class="link"><?= $category['ca_nm']?></a>
                        </li>
                        <li class="current">Detail <?= $category['ca_nm']?></li>
                    </ol>
                </nav>
                <h1><?= $category['ca_nm']?></h1>
            </div>
        </div><!-- End Page Title -->

        <!-- Service Details Section -->
        <section id="service-details" class="service-details section">

            <div class="container">

                <div class="row gy-4">
                    <div class="col-lg-8" data-aos="fade-up" data-aos-delay="200">
                        <?php 

                                
                        if (!empty($image) && file_exists($dir_image)) {
                        echo '<img src="../images/post/'.$image.'" alt="" class="img-fluid services-img rounded shadow-sm">';
                        }

                        ?>
                        <h3><?= $title ?></h3>
                        <div class="d-flex flex-row justify-content-center align-items-center">
                            <div class="col">
                                <ul>
                                    <i class="bi bi-calendar-event-fill"></i> <?= dateToDay($date) ?>
                                    <i class="bi bi-eye-fill"></i> Dibaca <?= $count ?> kali
                                </ul>
                            </div>
                        </div>
                        <div style="text-align:justify ;">
                            <p><?= $desk ?></p>
                            <style>
                            .file-card {
                                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                                transition: all 0.3s ease;
                            }

                            .file-card:hover {
                                box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
                            }

                            .file-card .card-body {
                                display: flex;
                                flex-direction: column;
                                justify-content: space-between;
                            }

                            .file-card .btn {
                                margin-top: 10px;
                            }
                            </style>
                            <?php
if ($categoryURL == "004") {
?>
                            <div class="row mb-5">
                                <div class="col-12">
                                    <h5 class="my-4">Unduh dokumen</h5>
                                    <div class="row">
                                        <?php
                $query = $mysqli->query("SELECT * FROM pub_files WHERE post_id=$post_id ORDER BY files_nm");
                $news = $query->fetch_all(MYSQLI_ASSOC);

                foreach ($news as $row) {
                    $title  = $row['files_nm'];
                    $count  = $row['files_down'];

                    // VARIABEL NEED OPERATION

                    $parts = explode(".", $title);

                    if (count($parts) > 2 && is_numeric($parts[0])) {
                        $file_name = implode(".", array_slice($parts, 1));
                    } else {
                        $file_name = $title;
                    }
                ?>
                                        <div class="col-md-12 mb-4">
                                            <div class="card file-card">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <h5 class="card-title mb-0"><?= $file_name ?></h5>
                                                        <div class="d-flex flex-column">
                                                            <button type="button" class="btn btn-primary mx-2"
                                                                data-toggle="modal" data-target="#pdfModal"
                                                                data-pdfsrc="../files/<?= $title ?>">
                                                                View PDF
                                                            </button>
                                                            <a href="#" class="btn btn-success mx-2"
                                                                data-bs-toggle="modal" data-bs-target="#downloadModal"
                                                                data-filename="<?= urlencode($title) ?>">
                                                                Download
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <ul class="mt-2">
                                                        <li>
                                                            <i class="bi bi-file-earmark-arrow-down-fill"></i> Download
                                                            count: <?= $count ?>
                                                        </li>
                                                    </ul>
                                                    <style>
                                                    #pdfViewer {
                                                        width: 100%;
                                                        height: 500px;
                                                    }
                                                    </style>
                                                </div>
                                            </div>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>

                            <?php
}
?>

                            <!-- end desk -->

                        </div>
                        <hr>
                        <!-- untuk sosial media forwad -->
                        <div class="mr-3">
                            <h6>Forwad Berita ini Ke Plaform dibawah ini :</h6>
                            <a class=" btn btn-primary mt-1"
                                href="<?= generateShareLink('instagram', $current_url); ?>"><i
                                    class="bi bi-instagram"></i> instagram</a>
                            <a class=" btn btn-primary mt-1"
                                href="<?= generateShareLink('twitter', $current_url); ?>"><i class="bi bi-twitter"></i>
                                twitter</a>
                            <a class=" btn btn-primary mt-1"
                                href="<?= generateShareLink('whatsapp', $current_url); ?>"><i
                                    class="bi bi-whatsapp"></i> whatsapp</a>
                            <a class=" btn btn-primary mt-1 "
                                href="<?= generateShareLink('facebook', $current_url); ?>"><i
                                    class="bi bi-facebook"></i> facebook</a>
                        </div>
                        <!-- untuk next and prev -->
                        <div>
                            <?php 

                $previousSql = "SELECT post_id FROM pub_post WHERE post_id < $id AND ca_id=$categoryURL AND _active=1 ORDER BY post_id DESC LIMIT 1";
                $previousResult = $mysqli->query($previousSql);
                $previousRow = $previousResult->fetch_assoc();
                $previousPostId = isset($previousRow['post_id']) ? $previousRow['post_id'] : null;

                $nextSql = "SELECT post_id FROM pub_post WHERE post_id > $id AND ca_id=$categoryURL AND _active=1 ORDER BY post_id ASC LIMIT 1";
                $nextResult = $mysqli->query($nextSql);
                $nextRow = $nextResult->fetch_assoc();
                $nextPostId = isset($nextRow['post_id']) ? $nextRow['post_id'] : null;
                ?>
                            <!-- previous post -->
                            <div class="d-flex col-12 mt-3">
                                <div class="col-6">
                                    <?php if ($previousPostId) : ?>
                                    <div class=" mb-3">
                                        <img src="<?= $image?>" class="card-img-top rounded shadow-sm" alt=""
                                            style="max-width: 100px;">
                                        <div class="card-body mt-3">
                                            <h5 class="card-title"><?= $title?></h5>

                                            <i class="bi bi-arrow-bar-left"></i> <a
                                                href="<?= $previousPostId?>"><?= $category['ca_nm']?>
                                                Sebelumnya</a>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                </div>
                                <!-- next post -->
                                <div class="col-6">
                                    <?php if ($nextPostId) : ?>
                                    <div class=" mb-3 text-end">
                                        <img src="<?= $image?>" class="card-img-top rounded shadow-sm" alt=""
                                            style="max-width: 100px;">
                                        <div class="card-body mt-3">
                                            <h5 class="card-title"><?= $title?></h5>
                                            <a href="<?= $nextPostId ?>"><?= $category['ca_nm']?>
                                                Selanjutnya</a> <i class="bi bi-arrow-bar-right"></i>

                                        </div>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                        <?php 
                            require_once('views/new_det_left.php');
                        ?>
                    </div>
                </div>

        </section><!-- /Service Details Section -->


        <!-- Modal View PDF -->
        <!-- Modal -->
        <div class="modal fade" id="pdfModal" tabindex="-1" role="dialog" aria-labelledby="pdfModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="pdfModalLabel">PDF Viewer</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="pdfViewer"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>


        <!-- Modal View Form Download -->
        <div class="modal fade" id="downloadModal" tabindex="-1" aria-labelledby="downloadModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="downloadModalLabel">Isi Formulir untuk Mengunduh</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="downloadForm" method="POST" action="process_download.php">
                            <input type="hidden" id="fileNameInput" name="file" value="">
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="usia" class="form-label">Usia</label>
                                <input type="text" class="form-control" id="usia" name="usia" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Kirim</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </main>

    <!-- footer -->
    <?php require_once('views/footer_det.php')?>
    <!-- end footer -->

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>


    <!-- extend script -->
    <script>
    $(document).ready(function() {
        // Update the PDFObject when the modal is shown
        $('#pdfModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var pdfSrc = button.data('pdfsrc'); // Extract info from data-* attributes
            PDFObject.embed(pdfSrc, "#pdfViewer", {
                pdfOpenParams: {
                    toolbar: 0
                }
            }); // Embed the PDF using PDFObject with toolbar hidden
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

    <!-- Vendor JS Files -->

    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/vendor/php-email-form/validate.js"></script>
    <script src="../assets/vendor/aos/aos.js"></script>
    <script src="../assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="../assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="../assets/vendor/waypoints/noframework.waypoints.js"></script>
    <script src="../assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
    <script src="../assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <!-- <script src="../assets/vendor/pdf/pdfobject.min.js"></script> -->


    <!-- Main JS File -->
    <script src="../assets/js/main.js"></script>





</body>

</html>