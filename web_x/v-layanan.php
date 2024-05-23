<!--INNER BANNER START-->
<?php
$id = (int)$_GET['id'];
$data = FrontEnd::ServicesGetID($id,$dbCon);

if(empty($data)){
  echo "<script> window.location.href= '.?page=error' </script>";
}
?>
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
   <li class="active"><a href="?page=layanan">Layanan</a></li>
  </ol>
 </div>
</div>
<!--INNER BANNER END-->

<!--MAIN START-->
<div id="main">
 <!--DEPARTMENTS SECTION START-->
 <section class="profil-section">
  <div class="hoLder">
   <div class="container">
    <div class="row">
     <div class="box">
      <div class="col-md-12 col-sm-8"><br>
       <div class="heading-style-1">
        <h2 style="font-size:22px;"><?=$data->name?></h2>
       </div><br><br>
       <div class="link-widget">
        <em>
         <p><?=$data->description?></p>
        </em>
       </div>
      </div>
     </div>
    </div>
   </div>
  </div>
 </section>
 <!--MAIN END-->
</div>
