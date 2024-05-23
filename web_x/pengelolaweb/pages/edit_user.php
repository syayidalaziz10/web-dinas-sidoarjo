<?php
if(empty($_SESSION["UID"]) && empty($_SESSION["FNAME"]) && empty($_SESSION["EMAIL"]) && empty($_SESSION["LEVEL"]) && $_SESSION["SNAME"] !== $_SERVER['SERVER_NAME']){
  echo "Forbidden page";
  exit();
}


$id = (int)$_GET['_uid'];
$data = Settings::UserGetID($id, $dbCon);

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
                <h2>Edit User <b><?=$data->full_name ?> </h2>
                <ul class="breadcrumb p-l-0 p-b-0 ">
                  <li class="breadcrumb-item"><a href="."><i class="icon-home"></i></a></li>
                  <li class="breadcrumb-item"><a href=".?_pg=<?=$_GET['_pg'] ?>">Master</a></li>
                  <li class="breadcrumb-item"><a href=".?_pg=<?=$_GET['_pg'] ?>&_act=<?= encodeUrl('list_users') ?>">Pengaturan User</a></li>
                  <li class="breadcrumb-item active">Edit User <b><?=$data->full_name ?> </b></li>
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
              <div class="row clearfix">
                <div class="col-sm-1"> </div>
                <div class="col-sm-9">
                  <div class="form-group">
                    <input type="text" class="form-control" name="fname" value="<?=$data->full_name ?>" placeholder="Nama lenkap" required />
                  </div>
                  <div class="form-group">
                    <input type="text" disabled class="form-control" name="email" value="<?=$data->email ?>" placeholder="Email" required />
                  </div>
                  <div class="form-group">
                    <select class="form-control show-tick" required  name="level" >
                      <option value="">-- Hak akses user --</option>
                      <option <?php if($data->level === 1){ echo "selected"; } ?> value="1">Administrator</option>
                      <option <?php if($data->level === 2){ echo "selected"; } ?> value="2">Editor</option>
                    </select>
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
            </div>
          </form>
        </div>
      </div>
      <!-- #END# CKEditor -->
    </div>
    <div id="notif" >

    </div>
  </section>
  <?php
  if(isset($_POST['tambah'])){
    Settings::UserUpdate($_POST, $dbCon, $id);
  } ?>
