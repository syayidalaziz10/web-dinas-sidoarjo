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


<header id="header" class="fixed-top d-flex align-items-center">

   <div class="container d-flex align-items-center">



      <div class="logo me-auto">

         <div class="d-flex justify-content-start align-items-center gap-3">

            <img src="images/profile/<?= $profileData[0]['prof_lg']?>" class="logo">
			<?=$rLink?>
            <small class="title-short text-uppercase">

                        <?= $profileData[0]['prof_snm']?>

                     </small>

                     <small class="title-long text-uppercase">

                        <?= $profileData[0]['prof_lnm']?>

                        <br>

                        Kabupaten Sidoarjo

            </small>

         </div>

         <!-- Uncomment below if you prefer to use an image logo -->

         <!-- <a href="index.html"><img src="images/profile/sidoarjo.png" alt="" class="img-fluid"></a> -->

      </div>





      <nav id="navbar" class="navbar order-last order-lg-0">

         <ul>

            <li><a class="nav-link scrollto" href="/">Beranda</a></li>

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

                           <a href="javascript:void(0)">'.$menu['mn_txt'].'<i class="fa fa-angle-right"></i></a>

                              <ul>';

                                 menu($data, $menu['mn_id']);

                        echo '</ul>

                        </li>';

                  }



                  else{
					//$couURI = strlen($_SERVER['REQUEST_URI']);
					if(strlen($_SERVER['REQUEST_URI']) > 12){
						$rLink = '../';
					} else {
						$rLink = '';
					}
					  
                     echo '<li><a class="nav-link scrollto active" target="'.$menu['mn_tar'].'" href="'.$rLink.$menu['mn_url'].'">'.$menu['mn_txt'].'</a></li>';

                  }

               }

            ?>

         </ul>

         <i class="fa-solid fa-bars mobile-nav-toggle"></i>

      </nav><!-- .navbar -->  





   </div>

</header>








