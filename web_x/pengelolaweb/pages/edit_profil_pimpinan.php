<?php
if(empty($_SESSION["UID"]) && empty($_SESSION["FNAME"]) && empty($_SESSION["EMAIL"]) && empty($_SESSION["LEVEL"]) && $_SESSION["SNAME"] !== $_SERVER['SERVER_NAME']){
  echo "Forbidden page";
  exit();
}


$id = (int)$_GET['_pid'];
$data = Profil::GetID($id, $dbCon);

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
                <h2>Edit Profil</h2>
                <ul class="breadcrumb p-l-0 p-b-0 ">
                  <li class="breadcrumb-item"><a href="."><i class="icon-home"></i></a></li>
                  <li class="breadcrumb-item"><a href=".?_pg=<?=$_GET['_pg'] ?>">Master</a></li>
                  <li class="breadcrumb-item"><a href=".?_pg=<?=$_GET['_pg'] ?>&_act=<?= encodeUrl('profil_pimpinan') ?>">Pengauran Profil Pimpinan</a></li>
                  <li class="breadcrumb-item active">Edit Profil <b><?=$data->name ?> </b></li>
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
          <form class="" method="post" enctype="multipart/form-data">
            <div class="header">
              <input type="hidden" value="<?=$_SESSION["token"] ?>" name="token" required />
              <input type="hidden" value="<?=$data->img ?>" name="imgNow" required />
              <div class="row clearfix">
                <div class="col-sm-1"> </div>
                <div class="col-sm-9">
                  <div class="form-group">
                    <input type="text" class="form-control" name="fname" value="<?=$data->name ?>" placeholder="Nama lengkap" required />
                  </div>
                  <div class="form-group">
                    <input type="text" class="form-control" name="jabatan" value="<?=$data->jabatan ?>" placeholder="Jabatan" required />
                  </div>
                  <div class="form-group">
                    <input type="text" class="form-control" name="tahun" value="<?=$data->periode ?>" placeholder="Tahun <?=date("Y") ?> - <?=date("Y", strtotime('+ 5 years')) ?>" required />
                  </div>
                  <div class="form-group">
                    <input type="file" class="form-control" name="image" id="image" />
                  </div>
                  <div class="form-group">
                    <select class="form-control show-tick" required  name="status" >
                      <option value="">-- Status user --</option>
                      <option <?php if($data->status === 1){ echo "selected"; } ?> value="1">Aktif</option>
                      <option <?php if($data->status === 0){ echo "selected"; } ?> value="0">Nonaktif</option>
                    </select>
                  </div>
                </div>
                <div class="col-sm-2">
                  <div class="form-group">
                    <button type="submit" id="submit" name="tambah" class="btn btn-raised btn-primary btn-round waves-effect">Simpan</button>
                  </div>
                </div>
              </div>
              <div class="body">
                <textarea id="ckeditor" name="desc"><?=$data->description ?></textarea>
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
      if(ext !== 'image/jpeg' && ext !== 'image/png'){
        alert('File not allowed')
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
    Profil::Update($_POST, $dbCon, $id);
  } ?>