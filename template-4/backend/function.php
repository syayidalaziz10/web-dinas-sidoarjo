<?php
/**
* ARTAVEL
*/
function encodeUrl($str){
  $str = base64_encode(base64_encode($str));
  $replace = str_replace('=', '', $str);
  return $replace;
}
function decodeUrl($str){
  return base64_decode(base64_decode($str));
}

function redirect($url){
  echo "<script>window.location.href='$url'</script>";
}

function backUrl($int){
  echo "<script>window.history.go($int)</script>";
}

function resizeImagePng($filename, $dir, $w, $h){
  // Get new dimensions
  list($width, $height) = getimagesize($filename);

  // Resample
  $image_p = imagecreatetruecolor($w, $h);
  $image = imagecreatefrompng($filename);
  imagealphablending( $image_p, false );
  imagesavealpha( $image_p, true );

  imagecopyresampled($image_p, $image, 0, 0, 0, 0, $w, $h, $width, $height);

   // Output
  return imagepng($image_p, $dir);
}

function resizeImageJpeg($filename, $dir, $w, $h, $type){
  // Get new dimensions
  list($width, $height) = getimagesize($filename);

  // Resample
  $image_p = imagecreatetruecolor($w, $h);
  if($type === 'image/png'){
   $image = imagecreatefrompng($filename);
  } else {
   $image = imagecreatefromjpeg($filename);
  }

  imagecopyresampled($image_p, $image, 0, 0, 0, 0, $w, $h, $width, $height);

  // Output
  return imagejpeg($image_p, $dir);
}

function multiRequest($data, $options = array()) {
  // array of curl handles
  $curly = array();
  // data to be returned
  $result = array();
  // multi handle
  $mh = curl_multi_init();
  // loop through $data and create curl handles
  // then add them to the multi-handle
  foreach ($data as $id => $d) {
    $curly[$id] = curl_init();
    $url = (is_array($d) && !empty($d['url'])) ? $d['url'] : $d;
    curl_setopt($curly[$id], CURLOPT_URL,            $url);
    curl_setopt($curly[$id], CURLOPT_HEADER,         0);
    curl_setopt($curly[$id], CURLOPT_RETURNTRANSFER, 1);
    // post?
    if (is_array($d)) {
      if (!empty($d['post'])) {
        curl_setopt($curly[$id], CURLOPT_POST,       1);
        curl_setopt($curly[$id], CURLOPT_POSTFIELDS, $d['post']);
      }
    }
    // extra options?
    if (!empty($options)) {
      curl_setopt_array($curly[$id], $options);
    }
    curl_multi_add_handle($mh, $curly[$id]);
  }
  // execute the handles
  $running = null;
  do {
    curl_multi_exec($mh, $running);
  } while($running > 0);
  // get content and remove handles
  foreach($curly as $id => $c) {
    $result[$id] = curl_multi_getcontent($c);
    curl_multi_remove_handle($mh, $c);
  }
  // all done
  curl_multi_close($mh);
  return $result;
}

function successNotif(){
  echo "
  <div class='alert alert-success' role='alert'>
  <div class='container'>
  <div class='alert-icon'>
  <i class='zmdi zmdi-thumb-up'></i>
  </div>
  <strong>Sukses !</strong> Berhasil disimpan
  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
  <span aria-hidden='true'>
  <i class='zmdi zmdi-close'></i>
  </span>
  </button>
  </div>
  </div>
  ";
}


function deleteNotif(){
  echo "
  <div class='alert alert-success' role='alert'>
  <div class='container'>
  <div class='alert-icon'>
  <i class='zmdi zmdi-thumb-up'></i>
  </div>
  <strong>Sukses !</strong> Berhasil dihapus
  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
  <span aria-hidden='true'>
  <i class='zmdi zmdi-close'></i>
  </span>
  </button>
  </div>
  </div>
  ";
}

function failedNotif(){
  echo "
  <div class='alert alert-danger' role='alert'>
  <div class='container'>
  <div class='alert-icon'>
  <i class='zmdi zmdi-block'></i>
  </div>
  <strong>Oh snap!</strong> Gagal menyimpan
  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
  <span aria-hidden='true'>
  <i class='zmdi zmdi-close'></i>
  </span>
  </button>
  </div>
  </div>
  ";
}

function EmailfailedNotif(){
  echo "
  <div class='alert alert-danger' role='alert'>
  <div class='container'>
  <div class='alert-icon'>
  <i class='zmdi zmdi-block'></i>
  </div>
  <strong>Oh snap!</strong> Email telah digunakan
  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
  <span aria-hidden='true'>
  <i class='zmdi zmdi-close'></i>
  </span>
  </button>
  </div>
  </div>
  ";
}

function warnNotif(){
  echo "
  <div class='alert alert-danger' role='alert'>
  <div class='container'>
  <div class='alert-icon'>
  <i class='zmdi zmdi-block'></i>
  </div>
  <strong>Oh snap!</strong> Forbidden action
  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
  <span aria-hidden='true'>
  <i class='zmdi zmdi-close'></i>
  </span>
  </button>
  </div>
  </div>
  ";
}

?>
