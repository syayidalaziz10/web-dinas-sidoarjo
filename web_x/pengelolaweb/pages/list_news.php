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
            <h2>Daftar Info</h2>
            <ul class="breadcrumb p-l-0 p-b-0 ">
              <li class="breadcrumb-item"><a href="."><i class="icon-home"></i></a></li>
              <li class="breadcrumb-item"><a href="javascript:void(0);">Info</a></li>
              <li class="breadcrumb-item active">Daftar</li>
            </ul>
          </div>
          <div class="col-lg-6 col-md-4 col-sm-12 text-right">
            <a href=".?_pg=<?=$_GET['_pg'] ?>&_act=<?= encodeUrl('add_news') ?>" class="btn btn-primary btn-round btn-simple float-right hidden-xs m-l-10">Tambah Info</a>
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
                <th>Image</th>
                <th>Author</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              $list = News::Show($dbCon);
              foreach ($list as $key => $value) { ?>
                <tr>
                  <td style="width: 40px"><?= $no++ ?></td>
                  <td>
                    <b><?= htmlentities($value->title) ?></b><br/>
                    <i><?= $value->date ?></i><br/>
                    <?= substr(htmlentities($value->description), 0, 100)."..." ?>
                  </td>
                  <td style="width: 110px">
                    <?php if($value->img !== ""){ ?>
                      <img src="../images/uploads/news/<?= $value->img ?>" style="width: 100px; height: 70px;" />
                    <?php } else { ?>
                      <img src="../images/default/noimage.png" style="width: 100px; height: 70px;" />
                    <?php } ?>
                  </td>
                  <td style="width: 110px"><?= $value->full_name ?></td>
                  <td style="width: 110px">
                    <a href=".?_pg=<?=$_GET['_pg'] ?>&_act=<?=encodeUrl('edit_news') ?>&_nid=<?=$value->idnews ?>" class="btn btn-primary btn-simple btn-sm" alt="Hapus" ><i class="material-icons">create</i></a> &nbsp;&nbsp;
                    <?php if($_SESSION['FNAME'] === $value->full_name){ ?>
                      <a href=".?_pg=<?=$_GET['_pg'] ?>&_ds=<?=encodeUrl('delete_news') ?>&_nid=<?=$value->idnews ?>&_img=<?=$value->img ?>" onclick="return confirm('Hapus item ?')" class="btn btn-primary btn-simple btn-sm" alt="Hapus" ><i class="material-icons">delete_sweep</i></a>
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
<?php if(decodeUrl(@$_GET['_ds']) === 'delete_news') {
  $id = (int)$_GET['_nid'];
  News::Delete($id, $dbCon, $_GET['_img']);
} ?>
