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
            <h2>Master</h2>
            <ul class="breadcrumb p-l-0 p-b-0 ">
              <li class="breadcrumb-item"><a href="."><i class="icon-home"></i></a></li>
              <li class="breadcrumb-item active">Master</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row clearfix">
  <div class="col-lg-3 col-md-6 col-sm-12">
    <div class="card">
      <div class="body text-center">
        <div class="chart easy-pie-chart-1" data-percent="75"> <span><img src="../images/default/settings.ico" alt="user" class="rounded-circle"/></span> </div>
        <a href=".?_pg=<?=$_GET['_pg'] ?>&_act=<?=encodeUrl('web_settings') ?>"><h6>Pengaturan Website</h6></a>
        <small>Atur site name, slogan dll</small>
      </div>
    </div>
  </div>
  <div class="col-lg-3 col-md-6 col-sm-12">
    <div class="card">
      <div class="body text-center">
        <div class="chart easy-pie-chart-1" data-percent="67"> <span><img src="../images/default/userdefault.png" alt="user" class="rounded-circle"/></span> </div>
        <a href=".?_pg=<?=$_GET['_pg'] ?>&_act=<?=encodeUrl('list_users') ?>"><h6>Pengaturan User</h6></a>
        <small>Tambah user, edit atau hapus</small>
      </div>
    </div>
  </div>
  <div class="col-lg-3 col-md-6 col-sm-12">
    <div class="card">
      <div class="body text-center">
        <div class="chart easy-pie-chart-1" data-percent="23"> <span><img src="../images/default/download-icon.png" alt="user" class="rounded-circle"/></span> </div>
        <a href=".?_pg=<?=$_GET['_pg'] ?>&_act=<?=encodeUrl('download') ?>"><h6>Pengaturan Download</h6></a>
        <small>Daftar download</small>
      </div>
    </div>
  </div>
  <div class="col-lg-3 col-md-6 col-sm-12">
    <div class="card">
      <div class="body text-center">
        <div class="chart easy-pie-chart-1" data-percent="49"> <span><img src="../images/default/resfulapi.png" alt="user" class="rounded-circle"/></span> </div>
        <a href=".?_pg=<?=$_GET['_pg'] ?>&_act=<?=encodeUrl('list_api') ?>"><h6>Pengaturan Link Api</h6></a>
        <small>Tambah, edit, hapus url link api</small>
      </div>
    </div>
  </div>
</div>
<div class="row clearfix">
  <div class="col-lg-3 col-md-6 col-sm-12">
    <div class="card">
      <div class="body text-center">
        <div class="chart easy-pie-chart-1" data-percent="75"> <span><img src="../images/default/banner.png" alt="user" class="rounded-circle"/></span> </div>
        <a href=".?_pg=<?=$_GET['_pg'] ?>&_act=<?=encodeUrl('banner_settings') ?>"><h6>Pengaturan Banner</h6></a>
        <small>Atur banner, deskripsi dll</small>
      </div>
    </div>
  </div>
  <div class="col-lg-3 col-md-6 col-sm-12">
    <div class="card">
      <div class="body text-center">
        <div class="chart easy-pie-chart-1" data-percent="67"> <span><img src="../images/default/services.png" alt="user" class="rounded-circle"/></span> </div>
        <a href=".?_pg=<?=$_GET['_pg'] ?>&_act=<?=encodeUrl('services_sets') ?>"><h6>Pengaturan Layanan</h6></a>
        <small>Tambah, edit, hapus Layanan</small>
      </div>
    </div>
  </div>
  <div class="col-lg-3 col-md-6 col-sm-12">
    <div class="card">
      <div class="body text-center">
        <div class="chart easy-pie-chart-1" data-percent="23"> <span><img src="../images/default/video.png" alt="user" class="rounded-circle"/></span> </div>
        <a href=".?_pg=<?=$_GET['_pg'] ?>&_act=<?=encodeUrl('video_settings') ?>"><h6>Pengaturan video</h6></a>
        <small>Tambah, edit, hapus video</small>
      </div>
    </div>
  </div>
  <div class="col-lg-3 col-md-6 col-sm-12">
    <div class="card">
      <div class="body text-center">
        <div class="chart easy-pie-chart-1" data-percent="49"> <span><img src="../images/default/employees.png" alt="user" class="rounded-circle"/></span> </div>
        <a href=".?_pg=<?=$_GET['_pg'] ?>&_act=<?=encodeUrl('employees') ?>"><h6>Pengaturan Daftar Pegawai</h6></a>
        <small>Tambah, edit, hapus pegawai</small>
      </div>
    </div>
  </div>
  <div class="col-lg-3 col-md-6 col-sm-12">
    <div class="card">
      <div class="body text-center">
        <div class="chart easy-pie-chart-1" data-percent="49"> <span><img src="../images/default/leader.png" alt="user" class="rounded-circle"/></span> </div>
        <a href=".?_pg=<?=$_GET['_pg'] ?>&_act=<?=encodeUrl('profil_pimpinan') ?>"><h6>Pengaturan Profil Pimpinan</h6></a>
        <small>Tambah, edit, hapus Profil</small>
      </div>
    </div>
  </div>
  <div class="col-lg-3 col-md-6 col-sm-12">
    <div class="card">
      <div class="body text-center">
        <div class="chart easy-pie-chart-1" data-percent="49"> <span><img src="../images/default/dinas.png" alt="user" class="rounded-circle"/></span> </div>
        <a href=".?_pg=<?=$_GET['_pg'] ?>&_act=<?=encodeUrl('dinas') ?>"><h6>Pengaturan Dinas Terkait</h6></a>
        <small>Tambah, edit, hapus Dinas</small>
      </div>
    </div>
  </div>
</div>
