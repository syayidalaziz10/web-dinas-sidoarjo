<?php
if(empty($_SESSION["UID"]) && empty($_SESSION["FNAME"]) && empty($_SESSION["EMAIL"]) && empty($_SESSION["LEVEL"]) && $_SESSION["SNAME"] !== $_SERVER['SERVER_NAME']){
  echo "Forbidden page";
  exit();
}


  $id = (int)$_GET['_nid'];
  $data = Tupoksi::GetID($id, $dbCon);

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
                  <h2>Edit Tupoksi</h2>
                  <ul class="breadcrumb p-l-0 p-b-0 ">
                    <li class="breadcrumb-item"><a href="."><i class="icon-home"></i></a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Tupoksi</a></li>
                    <li class="breadcrumb-item active">Edit Tupoksi</li>
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
                      <input type="text" class="form-control" name="title" value="<?=$data->title ?>" placeholder="Judul Tupoksi" required />
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
  <?php
  if(isset($_POST['tambah'])){
    Tupoksi::Update($_POST, $dbCon, $id);
  } ?>
