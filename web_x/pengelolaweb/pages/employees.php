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
            <h2>Daftar Pegawai</h2>
            <ul class="breadcrumb p-l-0 p-b-0 ">
              <li class="breadcrumb-item"><a href="."><i class="icon-home"></i></a></li>
              <li class="breadcrumb-item"><a href=".?_pg=<?=$_GET['_pg'] ?>">Master</a></li>
              <li class="breadcrumb-item active">Daftar Pegawai</li>
            </ul>
          </div>
          <div class="col-lg-6 col-md-4 col-sm-12 text-right">
            <a href=".?_pg=<?=$_GET['_pg'] ?>&_act=<?= encodeUrl('add_employees') ?>" class="btn btn-primary btn-round btn-simple float-right hidden-xs m-l-10">Tambah Pegawai</a>
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
                <th>Bagian</th>
                <th>Jabatan</th>
                <th>Tahun</th>
                <th>Foto</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Bagian</th>
                <th>Jabatan</th>
                <th>Tahun</th>
                <th>Foto</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </tfoot>
            <tbody>
              <?php
              $no = 1;
              $list = Settings::EmployeesShow($dbCon);
              foreach ($list as $key => $value) { ?>
                <tr>
                  <td style="width: 20px"><?= $no++ ?></td>
                  <td style="width: 110px"><?= htmlentities($value->name) ?></td>
                  <td style="width: 110px"><?= htmlentities($value->bagian) ?></td>
                  <td style="width: 110px"><?= htmlentities($value->jabatan) ?></td>
                  <td style="width: 110px"><?= htmlentities($value->tahun) ?></td>
                  <td style="width: 110px">
                    <?php if($value->img !== ""){ ?>
                      <img src="../images/uploads/employees/<?= $value->img ?>" style="width: 100px; height: 120px">
                    <?php } else { ?>
                      <img src="../images/default/userdefault.png" style="width: 100px; height: 120px">
                    <?php } ?>
                  </td>
                  <td style="width: 20px">
                    <?php if($value->status === 1){ ?>
                      <span class="badge badge-success">Aktif</span>
                    <?php } else { ?>
                      <span class="badge badge-danger">Nonaktif</span>
                    <?php } ?>
                  </td>
                </td>
                <td style="width: 20px">
                  <a href=".?_pg=<?=$_GET['_pg'] ?>&_act=<?=encodeUrl('edit_employees') ?>&_pid=<?=$value->id ?>" ><i class="material-icons">create</i></a> &nbsp;&nbsp;
                  <a href=".?_pg=<?=$_GET['_pg'] ?>&_act=<?=$_GET['_act'] ?>&_ds=<?=encodeUrl('delete_employees') ?>&_pid=<?=$value->id ?>&_img=<?=$value->img ?>" onclick="return confirm('Hapus item ?')" ><i class="material-icons">delete_sweep</i></a>
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
<?php if(decodeUrl(@$_GET['_ds']) === 'delete_employees') {
  $id = (int)@$_GET['_pid'];
  Settings::EmployeesDelete($id, $dbCon, @$_GET['_img']);
} ?>
