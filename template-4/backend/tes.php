<?php
include_once 'dbConfig.php';
include_once 'frontend.class.php';
include_once 'dasarhukum.class.php';

$dbCon =  DB::Connect();


$banner = FrontEnd::AnnouncementShow($dbCon);

echo "<pre>";
// $count = count($banner);
// foreach ($banner as $data) {
//   $dateNow = date('Y-m-29');
//   if($data->datex < $dateNow ){
//     continue;
//   }
//   print_r($data);
// }
$text = explode('=','https://www.youtube.com/watch?v=RC1OYrrFzy8');
$colorArr = array('#f44336','#3f51b5','#009688','#795548','#4caf50','#9e9e9e','#374046','#03a9f4');
$random = array_rand($colorArr, 3);

print_r($colorArr[$random[2]]);

//print_r($bannernew);
