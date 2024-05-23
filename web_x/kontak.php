<!--INNER BANNER START-->
<div id="inner-banner" style="background-image:url(images/uploads/banners/<?=$banner[2]->img?>);">
 <div class="container">
  <div class="inner-banner-heading">
   <h1>Kontak Kami</h1>
   <em>Contact us :: <?=$option[1]->value?> Kabupaten Sidoarjo.</em>
  </div>
 </div>
 <div class="breadcrumb-col"> <a href="." class="btn-back"><i class="fa fa-home" aria-hidden="true"></i>Beranda</a>
  <ol class="breadcrumb">
   <li><a href=".">Beranda</a></li>
   <li><a href="#">Profil</a></li>
   <li class="active">Kontak</li>
  </ol>
 </div>
</div>
<!--INNER BANNER END-->

<!--MAIN START-->
<div id="main">
 <!--CONTACT PAGE START-->
 <section class="contact-style-2">
  <div class="map-box-2">
   <div class="container">
    <?= $option[10]->value  ?>
   </div>
  </div>
  <div class="address-style-2">
   <div class="container">
    <div class="row">
     <div class="col-md-7 col-sm-7">
      <div class="heading-style-1">
       <h2>Informasi Kontak <span style="font-size:22px;"> Contact Information</span></h2>
      </div>
      <p></p>
      <div class="box"> <i class="fa fa-clock-o" aria-hidden="true"></i>
       <div class="text-box">
        <h3>Jam Kerja</h3>
        <p style="height: 65px"><?=$option[8]->value?></p>
       </div>
      </div>
      <div class="box"> <i class="fa fa-envelope" aria-hidden="true"></i>
       <div class="text-box">
        <h3>Email</h3>
        <p style="height: 65px"><?=$option[4]->value?></p>
       </div>
      </div>
      <div class="box"> <i class="fa fa-phone" aria-hidden="true"></i>
       <div class="text-box">
        <h3>Telepon</h3>
        <p style="height: 65px"><?=$option[6]->value?><p>
        </div>
       </div>
       <div class="box"> <i class="fa fa-map-marker" aria-hidden="true"></i>
        <div class="text-box">
         <h3>Alamat</h3>
         <p style="height: 65px"><?=$option[5]->value?></p>
        </div>
       </div>
      </div>
      <div class="col-md-5 col-sm-5">
       <div class="frame"><img src="images/uploads/banners/contact-bg.jpg" alt="img"></div>
      </div>
     </div>
    </div>
   </div>
  </section>
 </div>
<script type="text/javascript">
  $(document).ready(function(){
    $('iframe').width('100%')
    $('iframe').height(350)
  })
</script>
