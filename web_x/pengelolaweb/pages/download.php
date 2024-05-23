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
            <h2>Pengaturan Download</h2>
            <ul class="breadcrumb p-l-0 p-b-0 ">
              <li class="breadcrumb-item"><a href="."><i class="icon-home"></i></a></li>
              <li class="breadcrumb-item"><a href=".?_pg=<?=$_GET['_pg'] ?>">Master</a></li>
              <li class="breadcrumb-item active">Pengaturan Download</li>
            </ul>
          </div>
          <div class="col-lg-6 col-md-4 col-sm-12 text-right">
            <a href=".?_pg=<?=$_GET['_pg'] ?>&_act=<?= encodeUrl('add_download') ?>" class="btn btn-primary btn-round btn-simple float-right hidden-xs m-l-10">Tambah Download</a>
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
                <th>File</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              $list = Settings::DownloadShow($dbCon);
              foreach ($list as $key => $value) {
              ?>
                <tr>
                  <td style="width: 40px"><?= $no++ ?></td>
                  <td>
                    <b><?= htmlentities($value->title) ?></b> <br>
                    <?= substr(htmlentities($value->description), 0, 100)."..." ?>
                  </td>
                  <td style="width: 110px"><?= htmlentities($value->file) ?></td>
                  <td style="width: 40px">
                    <a href=".?_pg=<?=$_GET['_pg'] ?>&_act=<?=encodeUrl('edit_download') ?>&_ews=<?=$value->id ?>" ><i class="material-icons">create</i></a> &nbsp;&nbsp;
                    <a href=".?_pg=<?=$_GET['_pg'] ?>&_act=<?=$_GET['_act'] ?>&_ds=<?=encodeUrl('delete_uploads') ?>&_ews=<?=$value->id ?>&_fls=<?=$value->file ?>" ><i class="material-icons">delete_sweep</i></a> &nbsp;&nbsp;
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
<?php if(decodeUrl(@$_GET['_ds']) === 'delete_uploads') {
  $id = (int)@$_GET['_ews'];
  Settings::DownloadDelete($id, $dbCon, @$_GET['_fls']);
} ?>
