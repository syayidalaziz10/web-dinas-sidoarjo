<?php
if(empty($_SESSION["UID"]) && empty($_SESSION["FNAME"]) && empty($_SESSION["EMAIL"]) && empty($_SESSION["LEVEL"]) && $_SESSION["SNAME"] !== $_SERVER['SERVER_NAME']){
  echo "Forbidden page";
  exit();
}

if(empty($_SESSION["token"])){
  $_SESSION["token"] = base64_encode(openssl_random_pseudo_bytes(32));
}
?>
<section class="content">
  <div class="container">
    <div class="row clearfix">
      <div class="col-lg-12">
        <div class="card">
          <div class="body block-header">
            <div class="row">
              <div class="col-lg-6 col-md-8 col-sm-12">
                <h2>Pengaturan Dinas Terkait  </h2>
                <ul class="breadcrumb p-l-0 p-b-0 ">
                  <li class="breadcrumb-item"><a href="."><i class="icon-home"></i></a></li>
                  <li class="breadcrumb-item"><a href=".?_pg=<?=$_GET['_pg'] ?>&_act=<?= encodeUrl('master') ?>">Master</a></li>
                  <li class="breadcrumb-item"><a href=".?_pg=<?=$_GET['_pg'] ?>&_act=<?= encodeUrl('dinas') ?>">Dinas Terkait</a></li>
                  <li class="breadcrumb-item active">Tambah Dinas</li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- CKEditor -->
    <div class="row clearfix">
      <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="card">
          <form class="" action="" method="post" enctype="multipart/form-data">
            <div class="header">
              <input type="hidden" value="<?=$_SESSION["token"] ?>" name="token" required />
              <div class="form-group">
                <input type="text" class="form-control" name="dinas" placeholder="Singkatan Dinas" required />
              </div>
              <div class="form-group">
                <input type="file" class="form-control" name="image" id="image" />
              </div>
              <div class="body">
                <textarea class="form-control" placeholder="url dinas : https://example.com/" name="desc" required></textarea>
              </div>
              <div class="row clearfix">
                <div class="col-sm-2" style="margin-left: 1%" >
                  <div class="form-group">
                    <button type="submit" id="submit" name="tambah" class="btn btn-raised btn-primary btn-round waves-effect">Simpan</button>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
      <!-- #END# CKEditor -->
    </div>
    <div id="notif" >

    </div>
  </section>
  <script type="text/javascript">
  $(document).ready(function(){
    var img, ext, btn, size
    img = $("#image")
    btn = $("#submit")
    img.on("change", function(){
      console.log(img[0]['files'][0])
      ext = img[0]['files'][0]['type']
      size = img[0]['files'][0]['size']
      if(ext !== 'image/png'){
        alert('Only png files')
        img[0].value = ""
      }
      if(size > 800000){
        alert('Ukuran file maksimal 800 KB')
        img[0].value = ""
      }
    })
  });
  </script>
  <?php
  if(isset($_POST['tambah'])){
    Dinas::Add($_POST, $dbCon);
  } ?>
