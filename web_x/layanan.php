<!--INNER BANNER START-->
<div id="inner-banner" style="background-image:url(images/uploads/banners/<?=$banner[2]->img?>);">
 <div class="container">
  <div class="inner-banner-heading">
   <h1>Layanan</h1>
   <em>Services :: <?=$option[1]->value?> Kabupaten Sidoarjo.</em>
  </div>
 </div>
 <div class="breadcrumb-col"> <a href="." class="btn-back"><i class="fa fa-home" aria-hidden="true"></i>Beranda</a>
  <ol class="breadcrumb">
   <li><a href=".">Beranda</a></li>
   <li class="active">Layanan</li>
  </ol>
 </div>
</div>
<!--INNER BANNER END-->

<!--MAIN START-->
<div id="main">
 <!--SERVICES BOARD SECTION START-->
 <section class="services-board">
  <div class="container">
   <div class="row">
    <?php
    $count  =  count($service);
    for ($i=0; $i < $count ; $i++) {
     ?>
     <div class="col-md-3 col-sm-6" >
      <div class="box" style="height: 340px;     background: <?= $service[$i]->colors ?> no-repeat right bottom; color: <?= $service[$i]->colors ?>;">
       <div class="round-icon"><i class="fa fa-link" aria-hidden="true"></i></div>
       <h3><a href="?page=v-layanan&id=<?=$service[$i]->id?>"><?=$service[$i]->name?></a> </h3>
      </div>
     </div>
    <?php } ?>
   </div>
  </div>
  <br>
  <br>
 </section>
</div>
<!--MAIN END-->
