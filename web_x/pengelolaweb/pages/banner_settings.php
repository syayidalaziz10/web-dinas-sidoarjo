<?php
if(empty($_SESSION["UID"]) && empty($_SESSION["FNAME"]) && empty($_SESSION["EMAIL"]) && empty($_SESSION["LEVEL"]) && $_SESSION["SNAME"] !== $_SERVER['SERVER_NAME']){
  echo "Forbidden page";
  exit();
}
?>
<div class="row clearfix">
  <div class="col-lg-12">
    <div class="card">
      <div class="body block-header">
        <div class="row">
          <div class="col-lg-6 col-md-8 col-sm-12">
            <h2>Pengaturan Banner</h2>
            <ul class="breadcrumb p-l-0 p-b-0 ">
              <li class="breadcrumb-item"><a href="."><i class="icon-home"></i></a></li>
              <li class="breadcrumb-item"><a href=".?_pg=<?=$_GET['_pg'] ?>">Master</a></li>
              <li class="breadcrumb-item active">Pengaturan Banner</li>
            </ul>
          </div>
          <div class="col-lg-6 col-md-4 col-sm-12 text-right">
            <a href=".?_pg=<?=$_GET['_pg'] ?>&_act=<?= encodeUrl('add_banner') ?>" class="btn btn-primary btn-round btn-simple float-right hidden-xs m-l-10">Tambah Banner Slider</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row clearfix">
  <div class="col-lg-12">
    <div class="card">
      <div class="body">
        <div class="table-responsive">
          <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
            <thead>
              <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Gambar</th>
                <th>Pixel</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              $list = Settings::BannerShow($dbCon);
              foreach ($list as $key => $value) { ?>
                <tr>
                  <td style="width: 20px"><?= $no++ ?></td>
                  <td style="width: 110px">
                    <b><?= htmlentities($value->title) ?></b> <br>
                    <?= strlen($value->description) > 60 ? substr($value->description, 0, 60)."..." : $value->description ?>
                  </td>
                  <td style="width: 150px">
                    <?php if($value->img !== ""){ ?>
                      <img src="../images/uploads/banners/<?=$value->img ?>" style="height: 80px; width: 150px" alt="">
                    <?php } else { ?>
                      <img src="../images/default/noimage.png" style="height: 80px; width: 150px" alt="">

                    <?php } ?>
                  </td>
                  <td style="width: 1%"><?= htmlentities($value->ukuran) ?></td>
                  <td style="width: 20px">
                    <?php
                    if($value->status === 1){
                      echo "<span class='badge badge-success'>Aktif</span>";
                    } else {
                      echo "<span class='badge badge-danger'>Nonaktif</span>";
                    } ?>
                  </td>
                  <td style="width: 20px">
                    <a href=".?_pg=<?=$_GET['_pg'] ?>&_act=<?=encodeUrl('edit_banner') ?>&_ews=<?=$value->id ?>" ><i class="material-icons">create</i></a> &nbsp;&nbsp;
                    <?php if($value->category === 2) { ?>
                      <a href=".?_pg=<?=$_GET['_pg'] ?>&_act=<?=$_GET['_act'] ?>&_ds=<?=encodeUrl('delete_slider') ?>&_uid=<?=$value->id ?>&_img=<?=$value->img?>" onclick="return confirm('Hapus item ?')" ><i class="material-icons">delete_sweep</i></a>
                    <?php } ?>
                  </td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<?php if(decodeUrl(@$_GET['_ds']) === 'delete_slider') {
  $id = (int)$_GET['_uid'];
  Settings::BannerDelete($id, $dbCon, $_GET['_img']);
} ?>
