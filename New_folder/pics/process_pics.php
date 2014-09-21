<?php
     session_start();

     $result = array();
     $userin = $_COOKIE['teeckle_user'];
     if ($userin == null) {
          die;
     }
     if (isset($_POST['group'])) {
          $userin = $_POST['group'];
     }
     if (!file_exists($userin)) {
          mkdir($userin,0777);
     }
     if ($_FILES['user_pic']['error'] > 0) {
     switch ($_FILES['user_pic']['error']) {
     case 1:  die ('error1');
                break;
     case 2:  die ('error2');
                break;
     case 3:  die ('error3');
                break;
     case 4: die ('error4');
                break;
     case 6: die ('error5');
                break;
     case 7: die ('error6');
                break;
     }
     
     exit;
     }
 
     $tempFile =  $_FILES['user_pic']['tmp_name'];
     $imginfo_array = getimagesize($tempFile);
     if ($imginfo_array != false) {
          $mime_type = $imginfo_array['mime'];
          switch ($mime_type) {
          case "image/jpeg":
               $extension = 'jpg';
               break;
          case "image/png":
               $extension = 'png';
               break;
          case "image/gif":
               $extension = 'gif';
               break;
          default:  
               die ("not the right file type!");
               break;         
     }
     }
     
     else {
          die ("This is not a valid image file");
     }
     
    if($extension=="jpg" || $extension=="jpeg" )
{
$pice = ".jpg";
$uploadedfile = $_FILES['user_pic']['tmp_name'];
$src = imagecreatefromjpeg($uploadedfile);
if (!$src) {
     die('error2');
}
}
else if($extension=="png")
{
$pice = ".png";
$uploadedfile = $_FILES['user_pic']['tmp_name'];
$src = imagecreatefrompng($uploadedfile);
if (!$src) {
     die('error3');
}
}
else 
{
$pice = ".gif";
$uploadedfile = $_FILES['user_pic']['tmp_name'];
$src = imagecreatefromgif($uploadedfile);
if (!$src) {
     die('error4');
}
}
     $i = 0;
     $pic = "/pics/".$userin."/".$userin.$i.$pice;
     while (file_exists("/home/content/24/9456524/html".$pic)) {
     $i += 1;
     $pic = "/pics/".$userin."/".$userin.$i.$pice;
     }
     
     if (!is_uploaded_file($_FILES['user_pic']['tmp_name'])) {
          die ("not a valid file");
     }
     else {

  $filename = stripslashes($_FILES['user_pic']['name']);


 
list($width,$height)=getimagesize($uploadedfile);

$newwidth = $width;
$newheight = $height;

if (($newwidth <= 1000 && $newheight > 400) || ($newwidth > 1000 && $newheight > 400)) {

     $newwidth = ($width / $height) * 400;  
     $newheight = 400;
     
}
else if ($newwidth > 1000 && $newheight <= 400) {
     
     $newheight = ($height / $width) * 1000;
     $newwidth = 1000;
}

$tmp=imagecreatetruecolor($newwidth,$newheight);
if (!$tmp)
 {
     die('errorimg');
 }

$err = imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);
if (!$err)
 {
     die('errorcop');
 }

$filename = "/home/content/24/9456524/html".$pic;

$success = imagejpeg($tmp,$filename,100);

imagedestroy($src);
imagedestroy($tmp);
}
          if (!$success) {
               die ("hi");
          }
     
     
     

     $sqlpic = "INSERT INTO pic_table (user,piclocation,defaultpic) values (?,?,?)";
     $sql = "SELECT numpics FROM pic_table WHERE user = ? AND defaultpic = 1";
     require_once "/home/content/24/9456524/html/php_files/connect.php";
     try {
          $conn = new PDO('mysql:host='.$host.';dbname='.$dbn, $DBusername, $DBpassword);
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $stmt = $conn -> prepare($sql); 
          $stmt->execute(array($userin));
          $result = $stmt->fetchAll();
     if ($result == array()) {
          $default = 1;
     }
     else {
          $default = 0;
     }
     $stmt = $conn -> prepare($sqlpic); 
     $stmt->execute(array($userin,$pic,$default));
     }
     catch (PDOException $e) {
          $success = false;
          die ($e->getMessage());
     }
     
     if ($die == false) {
          echo $pic;
     }
     
?>
