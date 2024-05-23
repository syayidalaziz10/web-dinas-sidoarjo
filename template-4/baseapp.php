<?php


$dbCon               = DB::Connect();
$option              = FrontEnd::OptionShow($dbCon);
$banner              = FrontEnd::BannerShow($dbCon);
$slider              = FrontEnd::BannerSliderShow($dbCon);
$news                = FrontEnd::NewsShow($dbCon);
$eventdepan          = FrontEnd::EventShowDepan($dbCon);
$event               = FrontEnd::EventShow($dbCon);
$service             = FrontEnd::ServicesShow($dbCon);
$employee            = FrontEnd::EmployeesShow($dbCon);
$visimisi            = FrontEnd::VisiMisiShow($dbCon);
$tupoksi             = FrontEnd::TupoksiShow($dbCon);
$download            = FrontEnd::DownloadShow($dbCon);
$hukum               = FrontEnd::DasarHukumShow($dbCon);
$prestasi            = FrontEnd::PrestasiShow($dbCon);
$video               = FrontEnd::VideoShow($dbCon);
$dinas               = FrontEnd::DinasShow($dbCon);
$pimpinan            = FrontEnd::ProfilShow($dbCon);
$socmed              = FrontEnd::ApiShowSosmed($dbCon);
$announcement        = FrontEnd::AnnouncementShow($dbCon);
$telp                = FrontEnd::TelpShow($dbCon);
// $counter             = FrontEnd::counterPengunjung($dbCon);
// $layanan_masyarakat  = FrontEnd::layananMasyarakat($dbCon);
// $layanan_pemerintah  = FrontEnd::layananPemerintah($dbCon);
$ppid                = FrontEnd::PPIDShow($dbCon);
$gallery             = FrontEnd::GalleryShow($dbCon);


?>
