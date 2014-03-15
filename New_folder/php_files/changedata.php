<?php

     session_start();
     require_once 'connect.php';
     if (isset($_SESSION['teeckle_user'])) {
     $date = date("d,m,Y H:i:s");
     $sql = "UPDATE sessions SET upd = ? WHERE ip = ?";
      
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
     $sex = cleaninput($_POST['changesex']);
     $birth = cleaninput($_POST['change_birth']);
     $Opento = cleaninput($_POST['opento']);
     $country = cleaninput($_POST["changecountry"]);
     $Orientation = cleaninput($_POST['changeorientation']);
     $zip_code = cleaninput($_POST["change-zip"]);
     $status = cleaninput($_POST['changestatus']);

     if (!get_magic_quotes_gpc) {
        $Orientation = addslashes($Orientation);
        $Opento = addslashes($OpenTo);
        $zip_code = addslashes ($zip_code);
        $country = addslashes($country);
        $status = addslashes($status);
        $sex = addslashes($sex);
        $birth = addslashes($birth);
     }
          
     if ($Orientation != 'looking for a guy' && $Orientation != 'looking for a girl' && $Orientation != 'looking for both' && $Orientation != null) {
          die ('error1');
     } 
          
     if ($Opento != 'friends' && $Opento != 'short-term relationships' && $Opento != 'long-term relationships' && $Opento != null) {
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

     $sql = "UPDATE TeeckleUserProfile ";

     $count = '';

     $params = array();

     $sql .= 'SET';
     if ($country != null) {
          $sql .= ' `country` = ?,';
          $count .= 's';
          $params[] = $country;
     }

     if ($zip_code != null) {
          $sql .= ' `zipcode` = ?,';
          $count .= 's';
          $params[] = $zip_code;
     }

     if ($status != null) {
          $sql .= ' `relstatus` = ?,';
          $count .= 's';
          $params[] = $status;
     }

     if ($sex != null) {
          $sql .= ' `gender` = ?,';
          $count .= 's';
          $params[] = $sex;
     }

     if ($Opento != null) {
          $sql .= ' `opento` = ?,';
          $count .= 's';
          $params[] = $Opento;
     }

     if ($Orientation != null) {
          $sql .= ' `lookingfor` = ?,';
          $count .= 's';
          $params[] = $Orientation;
     }
     if ($birth != null) {
          $sql .= ' `dob` = ?,';
          $count .= 's';
          $params[] = $birth;
     }
     
     $index = (strlen($sql) - 1); 
     $sql = substr_replace($sql,' ',$index);
     $sql .= 'WHERE `teeckleUsern` = "'.$username.'"';
     try {
          $conn = new PDO('mysql:host='.$host.';dbname='.$dbn, $DBusername, $DBpassword);
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $stmt = $conn->prepare($sql);
          $stmt->execute($params);
     }
     catch (PDOException $e) {
          $mysqlerror = true;
          die ("sorry couldnt do it");
     }
     if ($mysqlerror == false) {
     echo "Your info was successfully changed";
     }
?>
