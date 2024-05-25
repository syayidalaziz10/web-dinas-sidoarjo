<?php 

   require('../conf/config.php');
   require('../conf/phpFunction.php');

   $profile    =  $mysqli->query('SELECT * from pub_profile WHERE _active=1 ORDER BY _cre DESC');
   $profileData = $profile->fetch_assoc();



?>



<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="shortcut icon" href="../images/profile/<?= $profileData['prof_lg']?>">

   <link rel="preconnect" href="https://fonts.googleapis.com">
   <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
   <title>404 NOT FOUND</title>


</head>
<body>

   <main>
      <div class="container">
         <div class="row">
            <div class="col-12">
               <div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
                  <div class="d-flex flex-column align-items-center">
                     <img src="../images/404-page.png" alt="" class="mb-5" style="width: 25rem;">
                     <h1 class="mt-5">404 ERROR</h1>
                     <p>Maaf, halaman ini tidak tersedia</p>
                     <a href="../" class="btn btn-primary">Kembali ke beranda</a>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </main>

</body>
</html>