<?php 

require('../conf/config.php');
require('../conf/phpFunction.php');

// Ambil data dari API
$url = "https://www.sidoarjokab.go.id/api/getpengumuman";
$data = file_get_contents($url);
$pengumuman = json_decode($data, true);

// Periksa jika data pengumuman berhasil diambil
if (!$pengumuman || !isset($pengumuman['data'])) {
// Tindakan jika gagal mengambil data, misalnya redirect ke halaman error
header("Location: ../error.php");
exit();
}

$_kategori = $_GET['kategori'];

// ...

?>

<!doctype html>
<html lang="en">
<head>
   <!-- Head section here -->
</head>
<body>
   <!-- Navbar, visitor section, social section here -->

   <!-- Hero section -->
   <div class="untree_co-hero mb-0" id="home-section">
      <!-- Hero content here -->
   </div>

   <!-- Main content section -->
   <div class="container" data-aos="fade-up" data-aos-delay="100">
      <div class="row gutter-2 gallery justify-content-start align-items-center detail-news">
         <?php foreach ($pengumuman['data'] as $peng) : ?>
         <div class="col-lg-4 mb-4">
               <div class="news-item bg-white">
                  <div class="news-contents my-4">
                     <a href="<?= $peng['url'] ?>"><h3><?= $peng['judul'] ?></h3></a>
                     <p><?= $peng['deskripsi'] ?></p>
                     <span>
                           <?= date('l, d F Y', strtotime($peng['tanggal'])) ?>
                           <span class="icon-eye ml-3 mr-2"></span> <?= $peng['views'] ?>
                     </span>
                  </div>
                  <p class="mb-0">
                     <a href="<?= $peng['url'] ?>" class="read-more-arrow">
                           <svg class="bi bi-arrow-right" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                              <!-- SVG path here -->
                           </svg>
                     </a>
                  </p>
               </div>
         </div>
         <?php endforeach; ?>
      </div>
   </div>

   <!-- Pagination section -->
   <nav class="my-5">
      <!-- Pagination code here -->
   </nav>

   <!-- Footer section -->
   <?php require_once('views/footer.php')?>

   <!-- Loader script and other JavaScript includes -->
</body>
</html>
