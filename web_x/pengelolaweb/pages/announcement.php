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
            <h2>Pengumuman</h2>
            <ul class="breadcrumb p-l-0 p-b-0 ">
              <li class="breadcrumb-item"><a href="."><i class="icon-home"></i></a></li>
              <li class="breadcrumb-item"><a href=".?_pg=<?=$_GET['_pg'] ?>">Pengumuman</a></li>
            </ul>
          </div>
          <div class="col-lg-6 col-md-4 col-sm-12 text-right">
            <a href=".?_pg=<?=$_GET['_pg'] ?>&_act=<?= encodeUrl('add_announcement') ?>" class="btn btn-primary btn-round btn-simple float-right hidden-xs m-l-10">Tambah Pengumuman</a>
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
                <th>Author</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              $list = Announcement::Show($dbCon);
              foreach ($list as $key => $value) { ?>
                <tr>
                  <td style="width: 40px"><?= $no++ ?></td>
                  <td>
                    <b><?= htmlentities($value->title) ?></b><br/>
                    <i><?= $value->date ?> sampai <?= $value->datex ?> </i><br/>
                    <?= substr(htmlentities($value->description), 0, 100)."..." ?>
                  </td>
                  <td style="width: 110px"><?= $value->full_name ?></td>
                  <td>
                    <?php if($value->status === 1){ ?>
                      <span class="badge badge-success">Aktif</span>
                    <?php } else { ?>
                      <span class="badge badge-danger">Nonaktif</span>
                    <?php } ?>
                  </td>
                  <td style="width: 110px">
                    <a href=".?_pg=<?=$_GET['_pg'] ?>&_act=<?=encodeUrl('edit_announcement') ?>&_nid=<?=$value->idnews ?>"><i class="material-icons">create</i></a> &nbsp;&nbsp;
                    <a href=".?_pg=<?=$_GET['_pg'] ?>&_ds=<?=encodeUrl('delete_ann') ?>&_ews=<?=$value->idnews ?>" onclick="return confirm('Hapus item ?')" ><i class="material-icons">delete_sweep</i></a>
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
<?php if(decodeUrl(@$_GET['_ds']) === 'delete_ann') {
  $id = (int)$_GET['_ews'];
  Announcement::Delete($id, $dbCon);
} ?>
