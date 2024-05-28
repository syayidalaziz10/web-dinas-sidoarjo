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
      <div class="row gutter-2 gallery justify-content-start align-items-center detail-news" id="apiDataContainer">
         <!-- API data will be loaded here -->
      </div>
   </div>

   <!-- Pagination section -->
   <nav class="my-5">
      <!-- Pagination code here -->
   </nav>

   <!-- Footer section -->
   <?php require_once('views/footer.php') ?>

   <!-- Loader script and other JavaScript includes -->
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
               // Mengisi data dari API ke dalam konten HTML
               let apiDataContainer = document.getElementById('apiDataContainer');
               data.forEach(peng => {
                  let html = `
                     <div class="col-lg-4 mb-4">
                           <div class="news-item bg-white">
                              <div class="news-contents my-4">
                                 <a href="${peng.url}"><h3>${peng.judul}</h3></a>
                                 <p>${peng.deskripsi}</p>
                                 <span>
                                       ${new Date(peng.tanggal).toLocaleDateString('en-US', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' })}
                                       <span class="icon-eye ml-3 mr-2"></span> ${peng.views}
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
         })
         .catch(error => {
               console.error('Error fetching data from API:', error);
         });
   </script>
</body>

</html>
