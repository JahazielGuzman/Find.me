<?php
     session_start();
     $username = $_SESSION ['teeckle_user']; 
     
     if (!isset($_POST['country'],$_POST['zip_code'],$_POST['status'],$_POST['orientation'],$_POST['opento'])) {
          die ('line 17');
     }
     $_SESSION ['teeckle_user'] = $username;
    $DOB =  $_SESSION ['teeckle_dob'];
     $sex = $_SESSION ['teeckle_sex'];
     function cleanInput ($input) {
          $input = trim($input);
          $input = htmlentities($input);
          return ($input);
     }
     $Opento = cleanInput($_POST['opento']);
     $country = cleanInput($_POST["country"]);
     $Orientation = cleanInput($_POST['orientation']);
     $zip_code = cleanInput($_POST["zip_code"]);
     $status = cleanInput($_POST['status']);

     if (!get_magic_quotes_gpc) {
        $Orientation = addslashes($Orientation);
        $Opento = addslashes($OpenTo);
        $zip_code = addslashes ($zip_code);
        $country = addslashes($country);
        $status = addslashes($status);
        echo 'not magic';
     }

          
     if ($Orientation != 'looking for a girl' && $Orientation != 'looking for a guy' && $Orientation != 'looking for both') {
          die ('line 23');
     } 
          
     if ($Opento != 'friends' && $Opento != 'short-term relationships' && $Opento != 'long-term relationships') {
          echo 'dis';
          exit;
     }
	     
	$filepath = "countries.dat";
	$content_cou = file_get_contents($filepath);
	$pos_cou = strpos($content_cou, $country);
	if ($pos_cou === false ){
          die ('line 43');
     }
              
     if ($status != 'single' && $status != 'relationship' && $status != 'married') {
          die ('line 49');
     }

     require 'connect.php';

     try {
     $sql = "INSERT INTO TeeckleUserProfile (teeckleUsern, country, zipcode, relstatus, gender, opento, lookingfor, dob) VALUES
     (?,?,?,?,?,?,?,?)";
     $conn = new PDO('mysql:host='.$host.';dbname='.$dbn, $DBusername, $DBpassword);
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     $stmt = $conn -> prepare ($sql);
     $stmt -> execute(array($username, $country, $zip_code, $status, $sex, $Opento, $Orientation, $DOB));
     }
     catch (PDOException $e) {
          die ($e);
     }

     $myFile = "/home/content/24/9456524/html/profile/".$username.".php";
     $fh = fopen($myFile, 'w') or die("can't open file");
     $stringData = file_get_contents("copyprofile.php");
     fwrite($fh, $stringData);
     fclose($fh);
     header('Location: /teeckleProfile.php');
?>
