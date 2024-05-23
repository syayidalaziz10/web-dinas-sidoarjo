<?php
if(empty($_SESSION["UID"]) && empty($_SESSION["FNAME"]) && empty($_SESSION["EMAIL"]) && empty($_SESSION["LEVEL"]) && $_SESSION["SNAME"] !== $_SERVER['SERVER_NAME']){
  echo "Forbidden page";
  exit();
}

$berita = Dashboard::CountNews($dbCon);
$events = Dashboard::CountEvents($dbCon);
$services = Dashboard::CountServices($dbCon);
$users = Dashboard::ListUsers($dbCon);
$usersCount = Dashboard::CountUsers($dbCon);
?>
<div class="row clearfix">
  <div class="col-lg-12">
    <div class="card">
      <div class="body block-header">
        <div class="row">
          <div class="col-lg-6 col-md-8 col-sm-12">
            <h2>Selamat datang Administrator</h2>
            <ul class="breadcrumb p-l-0 p-b-0 ">
              <li class="breadcrumb-item"><a href="."><i class="icon-home"></i></a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row clearfix">
  <div class="col-lg-3 col-md-6 col-sm-12">
    <div class="card info-box-2">
      <div class="body">
        <div class="content">
          <div class="text">Total Berita</div>
          <div class="number"><span class="number count-to" data-from="0" data-to="<?=$berita->total; ?>" data-speed="2000" data-fresh-interval="700"><?=$berita->total; ?></span></div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-3 col-md-6 col-sm-12">
    <div class="card info-box-2">
      <div class="body">
        <div class="content">
          <div class="text">Total Agenda</div>
          <div class="number"><span class="number count-to" data-from="0" data-to="<?=$events->total; ?>" data-speed="2000" data-fresh-interval="700">-</span></div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-3 col-md-6 col-sm-12">
    <div class="card info-box-2">
      <div class="body">
        <div class="content">
          <div class="text">Total User</div>
          <div class="number"><span class="number count-to" data-from="0" data-to="<?=$usersCount->total; ?>" data-speed="2000" data-fresh-interval="700"><?=$usersCount->total; ?></span></div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-3 col-md-6 col-sm-12">
    <div class="card info-box-2">
      <div class="body">
        <div class="content">
          <div class="text">Total Layanan</div>
          <div class="number"><span class="number count-to" data-from="0" data-to="<?=$services->total; ?>" data-speed="2000" data-fresh-interval="700">0</span></div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row clearfix">
  <div class="col-xl-4 col-lg-5 col-md-12">
    <div class="card overflowhidden weather2">
      <a class="weatherwidget-io" href="https://forecast7.com/en/n7d47112d67/sidoarjo-regency/" data-label_1="SIDOARJO REGENCY" data-label_2="WEATHER" data-theme="original" >SIDOARJO REGENCY WEATHER</a>
      <script>
      !function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src='https://weatherwidget.io/js/widget.min.js';fjs.parentNode.insertBefore(js,fjs);}}(document,'script','weatherwidget-io-js');
      </script>
    </div>
  </div>
  <div class="col-xl-8 col-lg-7 col-md-12">
    <div class="card user-account">
      <div class="header">
        <h2><strong>Daftar</strong> User</h2>
        <ul class="header-dropdown">
          <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="zmdi zmdi-more"></i> </a>
            <ul class="dropdown-menu dropdown-menu-right slideUp float-right">
              <li><a href="javascript:void(0);">Action</a></li>
              <li><a href="javascript:void(0);">Another action</a></li>
              <li><a href="javascript:void(0);">Something else</a></li>
            </ul>
          </li>
          <li class="remove">
            <a role="button" class="boxs-close"><i class="zmdi zmdi-close"></i></a>
          </li>
        </ul>
      </div>
      <div class="body">
        <div class="table-responsive">
          <table class="table m-b-0">
            <thead>
              <tr>
                <th>#</th>
                <th class="hidden-xs">Email Address</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              <?php $no = 1; foreach ($users as $key => $value) { ?>
                <tr>
                  <td><?=$no++ ?></td>
                  <td><?=$value->email ?></td>
                  <td>
                    <?php if($value->status === 1){ ?>
                      <span class="badge badge-success">Aktif</span>
                    <?php } else { ?>
                      <span class="badge badge-danger">Nonaktif</span>
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
<div class="row clearfix">
  <div class="col-md-12 col-lg-12">
    <div class="card active-bg">
      <div class="body">
        <p class="copyright m-b-0 text-white">Copyright 2018 © All Rights Reserved.</p>
      </div>
    </div>
  </div>
</div>
