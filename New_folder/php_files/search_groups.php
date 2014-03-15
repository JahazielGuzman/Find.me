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
	
     
     $size = cleaninput($_POST['size']);
     $cat = cleaninput($_POST["cat"]);
     $photo = cleaninput($_POST['photo']);
     $distance = cleaninput($_POST["dist"]);
     $zip_code = cleaninput($_POST['zip']);

     if (!isset($cat,$distance,$zip_code)) {
          die;
     }

     if (!get_magic_quotes_gpc) {
        
        
        $photo = addslashes($photo);
        $distance = addslashes($distance);
        $zip_code = addslashes($zip_code);
     }
          

     require 'connect.php';

     $sql = "SELECT thumbnail, groupid, num, groupname, descript, privacy, category, LCASE(city)as city, LCASE(state) as state



FROM groups AS mem LEFT JOIN  (


(
SELECT * 



FROM pic_table



WHERE defaultpic = 1 

) AS pt INNER JOIN (SELECT COUNT(memid) as num, mgroupid FROM members GROUP BY mgroupid) as m
)
 ON ( pt.user = mem.groupid AND m.mgroupid = mem.groupid),

zips_table AS zp, (

SELECT latitude, longitude

FROM zips_table

WHERE zipcode = ?

) AS LAT

WHERE mem.cityg = zp.zipcode 
AND m.mgroupid = mem.groupid 
AND m.num ";

if ($size == "less") {

     $sql .= "< 100";
}
else if ($size == "hundreds") {
     $sql .= " BETWEEN 100 AND 999";
}
else if ($size == "thousands") {

     $sql .= " >= 1000";
}
 
$sql .=  " AND

category IN (?)

AND mem.cityg

IN (

SELECT zipcode

FROM zips_table

WHERE (

( 180.00 * ( ACOS( (

SIN( RADIANS( LAT.latitude ) ) * SIN( RADIANS( latitude ) ) + COS( RADIANS( LAT.latitude ) ) * COS( RADIANS( latitude ) ) * COS( RADIANS( LAT.longitude ) - RADIANS( longitude ) ) ) ) ) / PI( )

) * 69.09

) <= ?
)";

if ($photo == 'have a photo') {
          $sql .= ' AND mem.groupid IN (SELECT user FROM pic_table)';
     }
     
     $count = '';

     $params = array($zip_code,$cat,$distance);

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
