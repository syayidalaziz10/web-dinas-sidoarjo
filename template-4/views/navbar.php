<section class="py-3 d-none d-sm-block">
   <div class="container">
      <div class="row align-items-center">
         <div class="col d-flex justify-content-start align-items-center gap-3">
            <img src="images/profile/<?= $profileData[0]['prof_lg']?>" class="logo-nav" width="90px">
         </div>
         <div class="col-auto d-none d-lg-block">
         <div class="col-auto">         
         <div class="runtext-container rounded-pill border border-secondary px-3">
            <div><i class="fa-solid fa-bullhorn"></i></div>
            <div class="main-runtext">
               <marquee direction="" onmouseover="this.stop();" onmouseout="this.start();">
                  <div class="holder">
                     <?= requestRecTemplate4('post_id, post_judul', 'pub_post', 'ca_id=003 AND _active=1', 'post_publish DESC', 1, 15) ?>
                  </div>
               </marquee>
            </div>
         </div>
      </div>
         </div>
      </div>
   </div>
</section>


<nav class="navbar navbar-expand-lg sticky-top d-block" data-navbar-on-scroll="data-navbar-on-scroll">
   <div class="container">
      <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-content">
         <div class="hamburger-toggle">
            <div class="hamburger">
               <span></span>
               <span></span>
               <span></span>
            </div>
         </div>
      </button>
      <div class="collapse navbar-collapse" id="navbar-content">
         <ul class="navbar-nav my-2">
            <li class="nav-item"><a class="nav-link text-uppercase text-black" aria-current="page" href="../index.php">Beranda</a></li>
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
                     echo '
                     <li class="nav-item dropdown">' .
                        '<a class="nav-link text-uppercase text-black dropdown-toggle" href="#" data-bs-toggle="dropdown" data-bs-auto-close="outside">' . $menu['mn_txt'] . '</a>' .
                        '<ul class="dropdown-menu px-2 shadow">';
                           menu($data, $menu['mn_id']);
                        echo '</ul></li>';
                     
                  } else {
                     echo '<li class="nav-item"><a class="nav-link text-uppercase text-black" href="../'.$menu['mn_url'].'">'.$menu['mn_txt'].'</a></li>';
                  }
               }
            ?>
         </ul>
      </div>
   </div>
</nav>









