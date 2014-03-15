<?php

     session_start();
     if (isset($_SESSION['teeckle_user'])) {
     $date = date("d,m,Y H:i:s");
     $sql = "UPDATE sessions SET upd = ? WHERE ip = ?";
      require_once 'connect.php';
      try {
          $conn = new PDO('mysql:host='.$host.';dbname='.$dbn, $DBusername,$DBpassword);
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $stmt = $conn -> prepare($sql); 
          $stmt->execute(array($date,$_SERVER['REMOTE_ADDR']));
     }
     catch (PDOException $e) {
          die ($e->getMessage());
     }
}
else {
      $sql = "DELETE FROM sessions WHERE ip = ?";
      require_once 'connect.php';
      try {
          $conn = new PDO('mysql:host='.$host.';dbname='.$dbn, $usern,$pass);
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $stmt = $conn -> prepare($sql); 
          $stmt->execute(array($_SERVER['REMOTE_ADDR']));
     }
     catch (PDOException $e) {
          die ($e->getMessage());
     }
}

     
     function cleaninput($input){
			$input=trim($input);
			$input=htmlentities($input);
		return($input);
	}
	
     
     $username = $_SESSION ["teeckle_user"];
     $preference = cleaninput($_POST['preference']);
     $age1 = cleaninput($_POST['age1']);
     $age2 = cleaninput($_POST['age2']);
     $status = cleaninput($_POST["status"]);
     $photo = cleaninput($_POST['photo']);
     $distance = cleaninput($_POST["dist"]);
     $zip_code = cleaninput($_POST['zip']);

     if (!isset($preference,$age1,$age2,$status,$photo,$distance,$zip_code)) {
          die;
     }

     if (!get_magic_quotes_gpc) {
        $preference = addslashes($preference);
        $age1 = addslashes($age1);
        $age2 = addslashes ($age2);
        $status = addslashes($status);
        $photo = addslashes($photo);
        $distance = addslashes($distance);
        $zip_code = addslashes($zip_code);
     }
          
     if ($Orientation != 'straight' && $Orientation != 'gay' && $Orientation != 'bi' && $Orientation != null) {
          die ('error1');
     } 
          
     if ($Opento != 'friends' && $Opento != 'short term relationships' && $Opento != 'long term relationships' && $Opento != null) {
          die ('error2');
          exit;
     }

	if ($country != null) {     
	     $filepath = "countries.dat";
	     $content_cou = file_get_contents($filepath);
	     $pos_cou = strpos($content_cou, $country);
	     if ($pos_cou === false ){
               die ('error3');
          }
     }
              
     if ($status != 'single' && $status != 'relationship' && $status != 'married' && $status != 'other' && $status != null ) {
          die ('error4');
     }

     require 'connect.php';

     $sql = "SELECT thumbnail,teeckleUsern AS usern, gender, relstatus, lookingfor, imow, FLOOR(DATEDIFF(CURDATE(),STR_TO_DATE(dob,'%m/%d/%Y'))/365) AS dob, LCASE(city)as city, LCASE(state) as state,opento
FROM TeeckleUserProfile AS TUP LEFT JOIN (



SELECT * 



FROM pic_table



WHERE defaultpic = 1



) AS pt ON ( pt.user = TUP.teeckleUsern ),
zips_table AS zp, (

SELECT latitude, longitude
FROM zips_table
WHERE zipcode = ?
) AS LAT
WHERE TUP.zipcode = zp.zipcode
AND TUP.zipcode
IN (

SELECT zipcode
FROM zips_table
WHERE (
( 180.00 * ( ACOS( (
SIN( RADIANS( LAT.latitude ) ) * SIN( RADIANS( latitude ) ) + COS( RADIANS( LAT.latitude ) ) * COS( RADIANS( latitude ) ) * COS( RADIANS( LAT.longitude ) - RADIANS( longitude ) ) ) ) ) / PI( )
) * 69.09
) <= ?
)";

     $count = '';

     $params = array();
     $params[] = $zip_code;
     $params[] = $distance;
          $sql .= ' AND lookingfor  = ? AND gender = ?';
          $arr = explode(" ", $preference);
          if ($arr[0] == "guys") {
               $arr[0] = 'M';
          }
          else {
               $arr[0] = 'W';
          }
          if ($arr[3] == "girls") {
          $arr[3] = 'girl';
     }
     else if ($arr[3] == "guys") {
          $arr[3] = 'guy';
     }
     $arr[3] = 'looking for a '.$arr[3];
     $params[] = $arr[3];
     $params[] = $arr[0];
     
          $sql .= " AND FLOOR(DATEDIFF(CURDATE(),STR_TO_DATE(dob,'%m/%d/%Y'))/365) >= ? AND FLOOR(DATEDIFF(CURDATE(),STR_TO_DATE(dob,'%m/%d/%Y'))/365) <= ?";
          $params[] = $age1;
          $params[] = $age2;
          $sql .= ' AND relstatus = ?';
          $params[] = $status;
     if ($photo == 'have a photo') {
          $sql .= ' AND teeckleUsern IN (SELECT user FROM pic_table)';
     }
     if (isset($_POST['ethnicity'])) {
          $sql .= ' AND ethnicity = ?';
          $params[] = $_POST['ethnicity'];
     }
     if (isset($_POST['bodytype'])) {
          $sql .= ' AND bodytype = ?';
          $params[] = $_POST['bodytype'];
     }
     if (isset($_POST['employment'])) {
          $sql .= ' AND employment = ?';
          $params[] = $_POST['employment'];
     }
     if (isset($_POST['feet']) && isset($_POST['inches'])) {
          $height = $_POST['feet'].'"'.$_POST['inches']."'";
          $sql .= ' AND height = ?';
          $params[] = $height;
     }
     if (isset($_POST['alcohol'])) {
          $sql .= ' AND alcohol = ?';
          $params[] = $_POST['alcohol'];
     }
     if (isset($_POST['languages'])) {
          $sql .= ' AND languages = ?';
          $params[] = $_POST['languages'];
     }
     
     
     try {
          $conn = new PDO('mysql:host='.$host.';dbname='.$dbn, $DBusername, $DBpassword);
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $stmt = $conn -> prepare($sql);
          $stmt->execute($params);
          $result = $stmt->fetchAll();
     }
     catch (PDOException $e) {
          $mysqlerror = true;
          die ($e->getMessage());
     }
     if ($mysqlerror == false) {
     echo json_encode($result);
     }
?>
