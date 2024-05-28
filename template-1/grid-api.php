<?php

require('../conf/config.php');
require('../conf/phpFunction.php');

$_apiId = $_GET['api'];

$getApi = $mysqli->query("SELECT sos_url FROM pub_socials WHERE sos_id = $_apiId");
$apiurl = $getApi->fetch_assoc();

?>

<!doctype html>
<html lang="en">



<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <meta name="author" content="Untree.co">
   <link rel="shortcut icon" href="../<?=$src?>">

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

<body data-spy="scroll" data-target=".site-navbar-target" data-offset="100" class="bg-light">


   <?php 
      require_once('views/navbar.php');
      require_once('views/visitor.php');
      require_once('views/social.php');
   ?>
   <!-- Navbar, visitor section, social section here -->

   <!-- Hero section -->
   <div class="untree_co-hero mb-0" id="home-section">
      <!-- Hero content here -->
   </div>

   <!-- Main content section -->
   <div class="container" data-aos="fade-up" data-aos-delay="100">
      <div class="row gutter-2 gallery justify-content-start align-items-center detail-news" id="apiDataContainer">
         <!-- API data will be loaded here -->
      </div>
   </div>

   <!-- Pagination section -->
   <nav class="my-5">
      <!-- Pagination code here -->
   </nav>

   <?php require_once('views/footer.php')?>

   

   <div id="overlayer"></div>
   <div class="loader">
      <div class="spinner-border" role="status">
         <span class="sr-only">Loading...</span>
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

   <script src="../js/custom.js"></script>
   
   <script>
      // Mengambil URL API dari PHP
      let apiurl = <?= json_encode($apiurl['sos_url']) ?>;

      // Memuat data dari API menggunakan JavaScript
      fetch(apiurl)
         .then(response => {
               if (!response.ok) {
                  throw new Error('Failed to fetch data from API');
               }
               return response.json();
         })
         .then(data => {
               console.log('Data fetched from API:', data); // Print the data to console
               // Check if data is wrapped in an object and has an array
               if (data && Array.isArray(data.data)) {
                  populateData(data.data); // Adjust according to actual structure
               } else {
                  console.error('Data format is not as expected:', data);
               }
         })
         .catch(error => {
               console.error('Error fetching data from API:', error);
         });

      function populateData(data) {
         let apiDataContainer = document.getElementById('apiDataContainer');
         data.forEach(peng => {
            let html = `
               <div class="col-lg-4 mb-4">
                  <div class="news-item bg-white">
                     <img src="${peng.gambar}" alt="${peng.judul}" class="img-fluid">
                     <div class="news-contents my-4">
                        <a href="${peng.url}"><h3>${peng.judul}</h3></a>
                        <p>${peng.deskripsi || ''}</p>
                        <span>
                           ${new Date(peng.tanggal).toLocaleDateString('en-US', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' })}
                        </span>
                     </div>
                     <p class="mb-0">
                        <a href="${peng.url}" class="read-more-arrow">
                           <svg class="bi bi-arrow-right" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                              <!-- SVG path here -->
                           </svg>
                        </a>
                     </p>
                  </div>
               </div>
            `;
            apiDataContainer.innerHTML += html;
         });
      }
   </script>


</body>
</html>
