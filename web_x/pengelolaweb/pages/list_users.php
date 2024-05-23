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
            <h2>Daftar User</h2>
            <ul class="breadcrumb p-l-0 p-b-0 ">
              <li class="breadcrumb-item"><a href="."><i class="icon-home"></i></a></li>
              <li class="breadcrumb-item"><a href=".?_pg=<?=$_GET['_pg'] ?>">Master</a></li>
              <li class="breadcrumb-item active">Daftar User</li>
            </ul>
          </div>
          <?php if($_SESSION['LEVEL'] === 1){ ?>
            <div class="col-lg-6 col-md-4 col-sm-12 text-right">
              <a href=".?_pg=<?=$_GET['_pg'] ?>&_act=<?= encodeUrl('add_user') ?>" class="btn btn-primary btn-round btn-simple float-right hidden-xs m-l-10">Tambah User</a>
            </div>
          <?php } ?>
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
                <th>Email</th>
                <th>Status</th>
                <th>Tipe</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              $list = Settings::UserShow($dbCon);
              foreach ($list as $key => $value) { ?>
                <tr>
                  <td style="width: 40px"><?= $no++ ?></td>
                  <td style="width: 110px"><?= htmlentities($value->full_name) ?></td>
                  <td style="width: 110px"><?= htmlentities($value->email) ?></td>
                  <td style="width: 110px">
                    <?php if($value->status === 1){ ?>
                      <span class="badge badge-success">Aktif</span>
                    <?php } else { ?>
                      <span class="badge badge-danger">Nonaktif</span>
                    <?php } ?>
                  </td>
                  <td style="width: 110px">
                    <?php
                    if($value->level === 1){
                      echo "Administrator";
                    } else if($value->level === 2){
                      echo "Editor";
                    }
                    ?>
                  </td>
                  <td style="width: 20px">
                    <?php if($_SESSION['LEVEL'] === 1){ ?>
                      <a href=".?_pg=<?=$_GET['_pg'] ?>&_act=<?=encodeUrl('edit_user') ?>&_uid=<?=$value->id ?>" ><i class="material-icons">create</i></a> &nbsp;&nbsp;
                      <a href=".?_pg=<?=$_GET['_pg'] ?>&_act=<?=encodeUrl('pass_user') ?>&_uid=<?=$value->id ?>" ><i class="material-icons">https</i></a> &nbsp;&nbsp;
                      <a href=".?_pg=<?=$_GET['_pg'] ?>&_act=<?=$_GET['_act'] ?>&_ds=<?=encodeUrl('delete_user') ?>&_uid=<?=$value->id ?>" onclick="return confirm('Hapus item ?')" ><i class="material-icons">delete_sweep</i></a>
                      <?php
                    } else {
                      if($value->id === $_SESSION['UID']){
                        ?>
                        <a href=".?_pg=<?=$_GET['_pg'] ?>&_act=<?=encodeUrl('edit_user') ?>&_uid=<?=$value->id ?>" ><i class="material-icons">create</i></a> &nbsp;&nbsp;
                        <a href=".?_pg=<?=$_GET['_pg'] ?>&_act=<?=encodeUrl('pass_user') ?>&_uid=<?=$value->id ?>" ><i class="material-icons">https</i></a> &nbsp;&nbsp;
                      <?php } } ?>
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
  <?php if(decodeUrl(@$_GET['_ds']) === 'delete_user') {
    $id = (int)$_GET['_uid'];
    Settings::UserDelete($id, $dbCon);
  } ?>
