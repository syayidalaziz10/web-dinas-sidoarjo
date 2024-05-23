<!--INNER BANNER START-->
<div id="inner-banner" style="background-image:url(images/uploads/banners/<?=$banner[2]->img?>);">
 <div class="container">
  <div class="inner-banner-heading">
   <h1>Prestasi &amp; Inovasi</h1>
   <em>Achievement &amp; Innovation :: <?=$option[1]->value?> Kabupaten Sidoarjo.</em>
  </div>
 </div>
 <div class="breadcrumb-col"> <a href="." class="btn-back"><i class="fa fa-home" aria-hidden="true"></i>Beranda</a>
  <ol class="breadcrumb">
   <li><a href=".">Beranda</a></li>
   <li><a href="#">Profil</a></li>
   <li class="active">Prestasi & Inovasi</li>
  </ol>
 </div>
</div>
<!--INNER BANNER END-->

<!--MAIN START-->
<div id="main">
 <!--ABOUT PAGE START-->
 <section class="about-section">
  <div class="container">
   <?php
   $hal = (int)@$_GET['p'];
   $page = !isset($hal) ? 1 : $hal;
   $limit = 4;
   $offset = ($page - 1) * $limit;
   $total_items = count($prestasi);
   $total_pages = ceil($total_items / $limit);
   $array = array_splice($prestasi, $offset, $limit);
   $countArr = count($array);
   $newLimit = $countArr < 4 ? $countArr : $limit;
   for ($i=0; $i < $newLimit ; $i++) {
    ?>
    <div class="row">
     <div class="col-md-6 col-sm-6">
      <div class="text-box">
       <div class="heading-style-1">
        <h3><?=$array[$i]->title?><span></span></h3>
       </div>
       <em></em>
       <p><?=$array[$i]->description?></p>
      </div>
     </div>
     <div class="col-md-6 col-sm-6">
      <div>
       <?php if($array[$i]->img !== ""){ ?>
        <img src="images/uploads/prestasi/<?=$array[$i]->img?>" class="img-responsive"/>
       <?php } else { ?>
        <img src="images/default/noimage.png" class="img-responsive"/>
       <?php } ?>
      </div>
     </div>
    </div>
    <br><br>
   <?php }; ?>
   <div class="pagination-col">
    <nav aria-label="Page navigation">
     <?php
     echo '<ul class="pagination">';
     if($hal > 1)
     echo "<li><a href='?page=prestasi-inovasi&p=".($hal - 1)."'>Prev</a></li>&nbsp;";
     for($page = 1; $page <=$total_pages; $page++){
      if((($page >= $hal - 3) && ($page <= $hal + 3)) || ($page === 1) || ($page === $total_pages)){
       if(($hal >= 1) && ($page >= 2 ));
       if (($hal !== ($total_pages - 1 )) && ($page === $total_pages));
       if($page === $hal)
       echo "<li class='active'><a href='#'>".$page."</a></li>&nbsp;";
       else
       echo "<li><a href='.?page=prestasi-inovasi&p=".$page."'>".$page."</a></li>&nbsp;";
      }
     }
     if($hal < $total_pages)
     echo "<li><a href='?page=prestasi-inovasi&p=".($hal + 1)."'>Next</a></li>";
     echo '</ul>';
     ?>
    </nav>
   </div>
  </div>
 </section>
