<?php
if(empty($_SESSION["UID"]) && empty($_SESSION["FNAME"]) && empty($_SESSION["EMAIL"]) && empty($_SESSION["LEVEL"]) && $_SESSION["SNAME"] !== $_SERVER['SERVER_NAME']){
  echo "Forbidden page";
  exit();
}


$id = (int)$_GET['_nid'];
$data = Announcement::GetID($id, $dbCon);

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
                <h2>Edit Pengumuman</h2>
                <ul class="breadcrumb p-l-0 p-b-0 ">
                  <li class="breadcrumb-item"><a href="."><i class="icon-home"></i></a></li>
                  <li class="breadcrumb-item"><a href=".?_pg=<?=$_GET['_pg'] ?>">Pengumuman</a></li>
                  <li class="breadcrumb-item active">Edit Pengumuman</li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- CKEditor -->
    <form class="" action="" method="post" enctype="multipart/form-data">
      <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12">
          <div class="card">
            <div class="header">
              <input type="hidden" value="<?=$_SESSION["token"] ?>" name="token" required />
              <div class="row clearfix">
                <div class="col-sm-1"> </div>
                <div class="col-sm-9">
                  <div class="form-group">
                    <input type="text" class="form-control" value="<?= $data->title ?>" name="title" placeholder="Judul Pengumuman" required />
                  </div>
                  <div class="row clearfix">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label style="color: white"> Tanggal Mulai</label>
                        <input type="date" name="date" value="<?= date('Y-m-d', strtotime($data->date)) ?>" class="form-control" required />
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label style="color: white"> Tanggal Akhir</label>
                        <input type="date" id="datex" value="<?= date('Y-m-d', strtotime($data->datex)) ?>" name="datex" class="form-control" required />
                      </div>
                    </div>
                  </div>
                  <select class="form-control show-tick" required  name="status" >
                    <option value="">-- Status Pengumuman --</option>
                    <option <?php if($data->status === 1){ echo "selected"; } ?> value="1">Aktif</option>
                    <option <?php if($data->status === 0){ echo "selected"; } ?> value="0">Nonaktif</option>
                  </select>
                </div>
                <div class="col-sm-2">
                  <div class="form-group">
                    <button type="submit" id="submit" name="tambah" class="btn btn-raised btn-primary btn-round waves-effect">Simpan</button>
                  </div>
                </div>
              </div>
              <div class="body">
                <textarea id="ckeditor" name="desc"> <?= $data->description ?></textarea>
              </div>
            </div>
          </div>
        </div>
      </form>
    </section>
    <script type="text/javascript">
      $(document).ready(function(){
        var datex = $("#datex")
        datex.on('change', function(rest){
          var datex, date
          datex = rest.target.value
          date = '<?= date('Y-m-d') ?>'
          if(datex < date){
            alert('Tidak dapat memilih tanggal sebelumnya')
            rest.target.value = ''
          }
        })
      })
    </script>
    <?php
    if(isset($_POST['tambah'])){
      Announcement::Update($_POST, $dbCon, $id);
    } ?>
