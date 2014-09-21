<?php

     session_start();
     $curruser = $_COOKIE['teeckle_user'];
     if (isset($_POST['group'])) {
          $curruser = $_POST['group'];
     }
     $x=$_POST["x"];
     $y=$_POST["y"];
     $width=$_POST["width"];
     $height=$_POST["height"];
     $path=$_POST["path"];
     $bill = $_POST["bill"];
     print($height.' p '.$width);
// Create image instances JPEG.
if ($bill == 0) {
     list($width,$height)=getimagesize("/home/content/24/9456524/html".$path);
     $x = floor($width/2);
     $y = floor($height/2);
     $width = floor($width/2);
     $height = floor($height/2);
     print($height.' l '.$width);
}

$src = imagecreatefromjpeg("/home/content/24/9456524/html".$path);
$thumbnail = imagecreatetruecolor($width, $height);

// Copy
$bool = imagecopy($thumbnail, $src, 0, 0, $x, $y, $width, $height);
if ($bool == false) {
     die($height.' n '.$width);
}

$extension_pos = strrpos($path, '.'); // find position of the last dot, so where the extension starts
$thumb = substr($path, 0, $extension_pos) . '_thumb' . substr($path, $extension_pos);
// Save image.
$croppedImgPath= "/home/content/24/9456524/html".$thumb;

imagejpeg($thumbnail, $croppedImgPath);

require_once "/home/content/24/9456524/html/php_files/connect.php";
try {  

  $conn = new PDO('mysql:host='.$host.';dbname='.$dbn, $DBusername, $DBpassword);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $stmt = $conn -> prepare("UPDATE `pic_table` SET `thumbnail` = ? WHERE `user` = ? and `piclocation` = ?");
  $stmt->execute(array($thumb,$curruser,$path));
} 
catch (Exception $e) {
  die("Failed: " . $e->getMessage());
}
echo 'success';
?>
