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
            <h2>Pengaturan Dinas</h2>
            <ul class="breadcrumb p-l-0 p-b-0 ">
              <li class="breadcrumb-item"><a href="."><i class="icon-home"></i></a></li>
              <li class="breadcrumb-item"><a href=".?_pg=<?=$_GET['_pg'] ?>&_act=<?= encodeUrl('master') ?>">Master</a></li>
              <li class="breadcrumb-item active">Pengaturan Dinas</li>
            </ul>
          </div>
          <div class="col-lg-6 col-md-4 col-sm-12 text-right">
            <a href=".?_pg=<?=$_GET['_pg'] ?>&_act=<?= encodeUrl('add_dinas') ?>" class="btn btn-primary btn-round btn-simple float-right hidden-xs m-l-10">Tambah Dinas</a>
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
                <th>Nama</th>
                <th>Url</th>
                <th>Image</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              $list = Dinas::Show($dbCon);
              foreach ($list as $key => $value) { ?>
                <tr>
                  <td style="width: 40px"><?= $no++ ?></td>
                  <td style="width: 100px"><?= htmlentities($value->name) ?></td>
                  <td style="width: 110px"><?= htmlentities($value->description) ?></td>
                  <td style="width: 110px">
                    <?php if($value->img !== ""){ ?>
                      <img src="../images/uploads/inst/<?= $value->img ?>" style="width: 100px; height: 70px;" />
                    <?php } else { ?>
                      <img src="../images/default/noimage.png" style="width: 100px; height: 70px;" />
                    <?php } ?>
                  </td>
                  <td style="width: 40px">
                    <a href=".?_pg=<?=$_GET['_pg'] ?>&_act=<?=encodeUrl('edit_dinas') ?>&_ews=<?=$value->id ?>" ><i class="material-icons">create</i></a> &nbsp;&nbsp;
                    <a href=".?_pg=<?=$_GET['_pg'] ?>&_act=<?=$_GET['_act'] ?>&_ds=<?=encodeUrl('delete_dinas') ?>&_ews=<?=$value->id ?>&_img=<?=$value->img ?>" onclick="return confirm('Hapus item ?')" ><i class="material-icons">delete_sweep</i></a>
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
<?php
if(decodeUrl(@$_GET['_ds']) === 'delete_dinas') {
  $id = (int)$_GET['_ews'];
  Dinas::Delete($id, $dbCon, $_GET['_img']);
}
?>
