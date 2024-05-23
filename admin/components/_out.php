<?PHP
require '../../conf/config.php';

session_start();
session_destroy();

//header('Location: http://'.$SERVER);

echo 'http://'.$SERVER;
exit;
?>