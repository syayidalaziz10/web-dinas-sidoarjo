<?php

require('../conf/config.php');
require('../conf/phpFunction.php');

$_apiId = $_GET['api'];
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

$getApi = $mysqli->query("SELECT sos_url FROM pub_socials WHERE sos_id = $_apiId");
$apiurl = $getApi->fetch_assoc();

?>

<!doctype html>
<html lang="en">
<head>
   <!-- Your head section here -->
</head>
<body data-spy="scroll" data-target=".site-navbar-target" data-offset="100" class="bg-light">

   <?php 
      require_once('views/navbar.php');
      require_once('views/visitor.php');
      require_once('views/social.php');
   ?>
   
   <div class="untree_co-hero mb-0" id="home-section">
      <!-- Hero content here -->
   </div>

   <div class="container" data-aos="fade-up" data-aos-delay="100">
      <div class="row gutter-2 gallery justify-content-start align-items-center detail-news" id="apiDataContainer">
         <!-- API data will be loaded here -->
      </div>
   </div>

   <nav class="my-5">
      <ul class="pagination justify-content-center" id="paginationContainer">
         <!-- Pagination controls will be loaded here -->
      </ul>
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
      let apiurl = <?= json_encode($apiurl['sos_url']) ?>;
      let currentPage = <?= $page ?>;
      let itemsPerPage = 5;
      let apiData = [];

      // Fetch data from API
      fetch(apiurl)
         .then(response => {
               if (!response.ok) {
                  throw new Error('Failed to fetch data from API');
               }
               return response.json();
         })
         .then(data => {
               console.log('Data fetched from API:', data);
               if (data && Array.isArray(data.data)) {
                  apiData = data.data;
                  renderPage(currentPage);
                  renderPagination();
               } else {
                  console.error('Data format is not as expected:', data);
               }
         })
         .catch(error => {
               console.error('Error fetching data from API:', error);
         });

      // Render the specified page
      function renderPage(page) {
         let startIndex = (page - 1) * itemsPerPage;
         let endIndex = startIndex + itemsPerPage;
         let paginatedItems = apiData.slice(startIndex, endIndex);

         let apiDataContainer = document.getElementById('apiDataContainer');
         apiDataContainer.innerHTML = '';

         paginatedItems.forEach(peng => {
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

      // Render pagination controls
      function renderPagination() {
         let totalPages = Math.ceil(apiData.length / itemsPerPage);
         let paginationContainer = document.getElementById('paginationContainer');
         paginationContainer.innerHTML = '';

         let createPageItem = (page, label = page) => {
               let li = document.createElement('li');
               li.className = `page-item${page === currentPage ? ' active' : ''}`;
               li.innerHTML = `<a class="page-link" href="get-${<?= $_apiId ?>}/halaman-${page}">${label}</a>`;
               li.onclick = (event) => {
                  event.preventDefault();
                  currentPage = page;
                  renderPage(currentPage);
                  renderPagination();
               };
               return li;
         };

         // First and Previous buttons
         if (currentPage > 1) {
               paginationContainer.appendChild(createPageItem(1, 'First'));
               paginationContainer.appendChild(createPageItem(currentPage - 1, '&laquo;'));
         } else {
               let liFirst = document.createElement('li');
               liFirst.className = 'page-item disabled';
               liFirst.innerHTML = '<a class="page-link" href="#">First</a>';
               paginationContainer.appendChild(liFirst);

               let liPrev = document.createElement('li');
               liPrev.className = 'page-item disabled';
               liPrev.innerHTML = '<a class="page-link" href="#"><span aria-hidden="true">&laquo;</span></a>';
               paginationContainer.appendChild(liPrev);
         }

         // Page number buttons
         let startPage = Math.max(1, currentPage - 2);
         let endPage = Math.min(totalPages, currentPage + 2);
         for (let i = startPage; i <= endPage; i++) {
               paginationContainer.appendChild(createPageItem(i));
         }

         // Next and Last buttons
         if (currentPage < totalPages) {
               paginationContainer.appendChild(createPageItem(currentPage + 1, '&raquo;'));
               paginationContainer.appendChild(createPageItem(totalPages, 'Last'));
         } else {
               let liNext = document.createElement('li');
               liNext.className = 'page-item disabled';
               liNext.innerHTML = '<a class="page-link" href="#"><span aria-hidden="true">&raquo;</span></a>';
               paginationContainer.appendChild(liNext);

               let liLast = document.createElement('li');
               liLast.className = 'page-item disabled';
               liLast.innerHTML = '<a class="page-link" href="#">Last</a>';
               paginationContainer.appendChild(liLast);
         }
      }
   </script>
</body>
</html>
