<?php 



$categoryURL = isset($_GET['kategori']) ? $_GET['kategori'] : '';

$dirLink = '';

if(empty($categoryURL)) {
   $dirLink = '';
} else {
   $dirLink = '../';
}

$current_page = $_SERVER['REQUEST_URI'];
$siteUrl = ($current_page === '') ? '' : '../';



$dir_prof  = $_dirProf.$profileData[0]['prof_lg'];


if ((!empty($profileData[0]['prof_lg'])) && file_exists($dir_prof)){
   $image = $_dirProf . $profileData[0]['prof_lg'];
} else {
   $image = $_dirProf . 'default.png';
}


?>



<header id="header" class="fixed-top d-flex align-items-center shadow">
   <div class="container-fluid d-flex align-items-center px-lg-5 px-3">
      <div class="logo me-auto">
         <div class="d-flex justify-content-start align-items-center gap-3">
            <img src=" <?=$dirLink.$image?> " class="logo">
            <small class="title-short text-uppercase">
                        <?= $profileData[0]['prof_snm']?>
                     </small>
                     <small class="title-long text-uppercase">
                        <?= $profileData[0]['prof_lnm']?>
            </small>
         </div>
      </div>

      <nav id="navbar" class="navbar order-last order-lg-0">
         <ul>
            <li><a class="nav-link" href="/">Beranda</a></li>
            <?php
               $result = $mysqli->query('SELECT * from set_menu WHERE _active=1');
               $rows = $result->fetch_all(MYSQLI_ASSOC);
               menu($rows);

               function menu($data, $parent_id=0){
                  foreach ($data as $key => $value) {
                     if ($value['parent'] == $parent_id) {
                        html($data, $value);
                     }
                  }
               }

               function html($data, $menu){
                  $count = 0;

                  foreach ($data as $key => $value) {
                     if ($value['parent'] == $menu['mn_id']) {
                        $count++;
                     }
                  }

                  if ($count > 0) {
                     echo '<li class="dropdown">
                           <a href="'.$siteUrl.$menu['mn_url'].'">'.$menu['mn_txt'].'<i class="fa fa-angle-right"></i></a>
                              <ul>';
                                 menu($data, $menu['mn_id']);
                        echo '</ul>
                        </li>';
                  }

                  else{
                     echo '<li><a class="nav-link" target="'.$menu['mn_tar'].'" href="'.$siteUrl.$menu['mn_url'].'">'.$menu['mn_txt'].'</a></li>';
                  }
               }
            ?>
         </ul>
         <i class="fa-solid fa-bars mobile-nav-toggle"></i>
      </nav>
      <!-- .navbar -->
   </div>
</header>