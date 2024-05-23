<?php
include_once 'dbConfig.php';
include_once 'function.php';
include_once 'settings.class.php';

$dbCon = DB::Connect();
$apis = Settings::ApiShow($dbCon);
$res = count($apis);

for ($i=0; $i < $res ; $i++) {
  $data[] = $apis[$i]->value;
}
$ex = multiRequest($data);
for ($i=0; $i < $res ; $i++) {
  $resData[] = json_decode($ex[$i], true);
}
echo json_encode($resData);
