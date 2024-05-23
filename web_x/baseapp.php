<?php
$dbCon    = DB::Connect();
$option   = FrontEnd::OptionShow($dbCon);
$banner   = FrontEnd::BannerShow($dbCon);
$slider   = FrontEnd::BannerSliderShow($dbCon);
$news     = FrontEnd::NewsShow($dbCon);
$event    = FrontEnd::EventShow($dbCon);
$service  = FrontEnd::ServicesShow($dbCon);
$employee = FrontEnd::EmployeesShow($dbCon);
$visimisi = FrontEnd::VisiMisiShow($dbCon);
$tupoksi  = FrontEnd::TupoksiShow($dbCon);
$download = FrontEnd::DownloadShow($dbCon);
$hukum    = FrontEnd::DasarHukumShow($dbCon);
$prestasi = FrontEnd::PrestasiShow($dbCon);
$video    = FrontEnd::VideoShow($dbCon);
$dinas    = FrontEnd::DinasShow($dbCon);
$pimpinan = frontend::ProfilShow($dbCon);
$socmed   = frontend::ApiShowSosmed($dbCon);
$announcement = frontend::AnnouncementShow($dbCon);
$telp = frontend::TelpShow($dbCon);
 ?>
