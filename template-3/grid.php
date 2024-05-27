<?php 
session_start();

require('../conf/config.php');
require('../conf/phpFunction.php');


$profile  =  $mysqli->query('SELECT * from pub_profile WHERE _active=1 ORDER BY _cre DESC');
$prof     = $profile->fetch_all(MYSQLI_ASSOC);

$kategori = $_GET['kategori'];


$getCategory  = $mysqli->query("SELECT ca_nm FROM set_category  WHERE ca_id =$kategori");
$category     = $getCategory->fetch_assoc();



function truncateWords($text, $limit) {
    $words = explode(' ', $text, $limit + 1);
    if (count($words) > $limit) {
        array_pop($words);
    }
    return implode(' ', $words);
}

// Get the current page number
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$limit = 6; 
$limit_start = ($page - 1) * $limit;
$no = $limit_start + 1;

// Handle the search query and date range
if (isset($_POST['search'])) {
    $_SESSION['search'] = $_POST['search'];
    $_SESSION['start_date'] = $_POST['start_date'];
    $_SESSION['end_date'] = $_POST['end_date'];
} elseif (isset($_GET['clear_search'])) {
    unset($_SESSION['search']);
    unset($_SESSION['start_date']);
    unset($_SESSION['end_date']);
}

$search = isset($_SESSION['search']) ? $_SESSION['search'] : '';
$start_date = isset($_SESSION['start_date']) ? $_SESSION['start_date'] : '';
$end_date = isset($_SESSION['end_date']) ? $_SESSION['end_date'] : '';

// Construct the SQL query with search filter and date range
$query = "SELECT * FROM pub_post WHERE ca_id=$kategori";
if (!empty($search)) {
    $query .= " AND post_judul LIKE '%$search%'";
}
if (!empty($start_date) && !empty($end_date)) {
    $query .= " AND post_publish BETWEEN '$start_date' AND '$end_date'";
}
$query .= " ORDER BY post_publish DESC LIMIT $limit_start, $limit";

// Execute the query
$video = $mysqli->prepare($query);
$video->execute();
$res1 = $video->get_result();

// Save the query results in an array
$results = [];
while ($row = $res1->fetch_assoc()) {
    $results[] = $row;
}

// Count total records for pagination
$countVid = "SELECT count(*) AS jumlah FROM pub_post WHERE ca_id=$kategori";
if (!empty($search)) {
    $countVid .= " AND post_judul LIKE '%$search%'";
}
if (!empty($start_date) && !empty($end_date)) {
    $countVid .= " AND post_publish BETWEEN '$start_date' AND '$end_date'";
}
$videoCount = $mysqli->prepare($countVid);
$videoCount->execute();
$resCount = $videoCount->get_result();
$rowCount = $resCount->fetch_assoc();
$total_records = $rowCount['jumlah'];


$dir_image = $dirProf.$prof[0]['prof_lg'];
 
  
if ((!empty($prof[0]['prof_lg'])) && file_exists($dir_image)) {
    $src = '../../images/profile/'.$prof[0]['prof_lg'];
  } else {
    $src = '../../images/profile/default.png';
  }


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title><?= $prof[0]['prof_lnm']?></title>
    <link rel="shortcut icon" href="<?= $src ?>">
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
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="../assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="../assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

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
        require_once('views/visitor.php');
        require_once('views/social.php');

    ?>
    <main class="main">
        <!-- Page Title -->
        <div class="page-title" data-aos="fade">
            <div class="container">
                <nav class="breadcrumbs">
                    <ol>
                        <li><a href="../index.php">Home</a></li>
                        <li class="current"><?= $category['ca_nm']?></li>
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
                        <h4>
                            Search <?= $category['ca_nm']?>
                        </h4>
                        <!-- query for search -->

                        <!-- end query for search -->
                        <form class="d-flex mb-3" method="POST" action="">
                            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search"
                                name="search" value="<?= htmlspecialchars($search) ?>">
                            <input class="form-control me-2" type="date" name="start_date"
                                value="<?= htmlspecialchars($start_date) ?>">
                            <input class="form-control me-2" type="date" name="end_date"
                                value="<?= htmlspecialchars($end_date) ?>">
                            <button class="btn btn-outline-primary" type="submit"><i class="bi bi-search"></i></button>

                        </form>

                        <div class="row">

                            <?php
                    if (count($results) > 0) {
                        foreach ($results as $row) {
                            $id = $row['post_id'];
                            $title = $row['post_judul'];
                            $desk = $row['post_desk'];
                            $date = $row['post_publish'];
                            $count = $row['post_see'];
                            $date_up = $row['_cre_date'];

                            $dir_image = 'images/post/'.$row['post_img'];
                            $date_update = strtotime($date_up);

                            // Set the image source
                            if (!empty($row['post_img']) && file_exists($dir_image)) {
                                $src = '../../images/post/'.$row['post_img'];
                            } else {
                                $src = '../../images/post/default_3.png';
                            }

                            $deskToStr = strip_tags($desk);
                            $title_cut = truncateWords($title, 10);
                            $desk = truncateWords($deskToStr, 10);
                            ?>

                            <div class="col-lg-6 mb-4" data-order="<?= $no ?>">
                                <div class="card h-100 shadow">
                                    <!-- Menambahkan kelas shadow untuk efek bayangan -->
                                    <img src="<?= $src ?>" alt="" class="card-img-top card-img"
                                        style="height: 300px; object-fit: cover;">

                                    <div class="card-body d-flex flex-column justify-content-between">
                                        <a href="<?= $id?>">
                                            <h5 class="card-title"><?= $title_cut ?></h5>
                                        </a>
                                        <p class="card-text"><?= $desk ?></p>
                                        <div class="row mt-auto">
                                            <!-- Menggunakan class "row" -->
                                            <div class="col">
                                                <!-- Menggunakan class "col" -->
                                                <ul class="list-unstyled d-flex mb-0">
                                                    <li class="d-flex align-items-center me-3"><i
                                                            class="bi bi-clock"></i> <a href="blog-details.html"><?php
                                                if ($date !== NULL && $date !== '0000-00-00') {
                                                    echo dateToDay($date);
                                                }
                                            ?></a></li>
                                                    <li class="d-flex align-items-center"><i class="bi bi-eye-fill"></i>
                                                        <a href="blog-details.html"><?= $count?></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="mt-3 mb-3 align-self-start">
                                            <!-- Untuk menempatkan detail berita di bottom right -->
                                            <a href="<?= $id?>" class="btn btn-success">Detail <?= $category['ca_nm']?>
                                                <i class="bi bi-arrow-bar-right"></i></a>
                                        </div>
                                        <div class="card-footer">
                                            <small class="text-muted">Last updated <?= date("1 F Y", $date_update) ?>
                                                ago</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php 
                            } } else{
                                ?>
                            <div class="col-lg-12">
                                <div class="card h-100 shadow-sm text-center">
                                    <img src="../images/post/default_3.png" alt="no results"
                                        class="card-img-top card-img">
                                    <div class="card-body">
                                        <h5 class="card-title">Data yang dicari tidak ada</h5>
                                        <p class="card-text">Maaf, kami tidak menemukan hasil untuk pencarian Anda.</p>
                                    </div>
                                </div>
                            </div>
                            <?php
                            }
                            ?>
                        </div>
                        <!-- paggination -->
                        <?php
$countVid = "SELECT count(*) AS jumlah FROM pub_post WHERE ca_id=$kategori";
$video = $mysqli->prepare($countVid);
$video->execute();
$res1 = $video->get_result();
$row = $res1->fetch_assoc();
$total_records = $row['jumlah'];
?>

                        <div class="container mt-3">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination justify-content-center">
                                    <?php
            $jumlah_page = ceil($total_records / $limit);
            $jumlah_number = 2;
            $start_number = ($page > $jumlah_number) ? $page - $jumlah_number : 1;
            $end_number = ($page < ($jumlah_page - $jumlah_number)) ? $page + $jumlah_number : $jumlah_page;
            $link_prev = ($page > 1) ? $page - 1 : 1;
            $link_next = ($page < $jumlah_page) ? $page + 1 : $jumlah_page;

            // Tambahkan tombol "First" dan "Previous"
            if ($page == 1) {
                echo '<li class="page-item disabled"><a class="page-link" href="#" aria-label="First"><span aria-hidden="true">First</span></a></li>';
                echo '<li class="page-item disabled"><a class="page-link" href="#" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>';
            } else {
                echo '<li class="page-item"><a class="page-link" href="halaman-1" aria-label="First"><span aria-hidden="true">First</span></a></li>';
                echo '<li class="page-item"><a class="page-link" href="halaman-' . $link_prev . '" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>';
            }

            // Tampilkan halaman pagination
            for ($i = $start_number; $i <= $end_number; $i++) {
                $link_active = ($page == $i) ? ' active' : '';
                echo '<li class="page-item' . $link_active . '"><a class="page-link" href="halaman-' . $i . '">' . $i . '</a></li>';
            }

            // Tambahkan tombol "Last" dan "Next"
            if ($page == $jumlah_page) {
                echo '<li class="page-item disabled"><a class="page-link" href="#" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>';
                echo '<li class="page-item disabled"><a class="page-link" href="#" aria-label="Last"><span aria-hidden="true">Last</span></a></li>';
            } else {
                echo '<li class="page-item"><a class="page-link" href="halaman-' . $link_next . '" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>';
                echo '<li class="page-item"><a class="page-link" href="halaman-' . $jumlah_page . '" aria-label="Last"><span aria-hidden="true">Last</span></a></li>';
            }
            ?>
                                </ul>
                            </nav>
                        </div>
                        <!-- end paggination -->

                    </div>
                    <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                        <?php 
                                require_once('views/detail_left.php');
                            ?>
                    </div>
                </div>
            </div>


        </section><!-- /Service Details Section -->

    </main>

    <!-- footer -->
    <?php require_once('views/footer_det.php')?>
    <!-- end footer -->

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>

    <!-- Vendor JS Files -->
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

</body>

</html>