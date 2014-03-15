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

     $username = $_SESSION['teeckle_user'];

     function cleanInput($input){
			$input=trim($input);
			$input=htmlentities($input);
		return($input);
	}
	$ethnicity = $_POST['ethnicity'];
	$bodytype = $_POST['bodytype'];
	$employment = $_POST['employment'];
	$feet = $_POST['feet'];
	$inches = $_POST['inches'];
	$languages = $_POST['languages'];
	$haircolor = $_POST['haircolor'];
	$eyecolor  = $_POST['eyecolor '];
	$lookingfor = $_POST['lookingfor'];
	$children = $_POST['children'];
	$education = $_POST['education'];
	$zodiac = $_POST['zodiac'];
	$smoker  = $_POST['smoker'];
	$alcohol = $_POST['alcohol'];
	$languages = $_POST['languages'];

	if (!get_magic_quotes_gpc) {
        $ethnicity = addslashes($ethnicity);
        $bodytype = addslashes($bodytype);
        $employment = addslashes ($employment);
        $feet = addslashes($feet);
        $inches = addslashes($inches);
        foreach ($languages as $value) {
               $value = addslashes($value);
          }
        $haircolor = addslashes($haircolor);
        $eyecolor  = addslashes($eyecolor);
	   $lookingfor = addslashes($lookingfor);
	   $children = addslashes($children);
	   $education = addslashes($education);
	   $zodiac = addslashes($zodiac);
	   $smoker  = addslashes($smoker);
	   $alcohol = addslashes($alcohol);
     }

     if ($ethnicity != 'black' && $ethnicity != 'white' && $ethnicity != 'latino' && $ethnicity != 'indian' && $ethnicity != 'middle eastern' && $ethnicity != 'pacific islander' && $ethnicity != 'asian' && $ethnicity != 'native american' && $ethnicity != 'other' && $ethnicity != '...') {
			die('wrong option1');
			 
			}
	if ($bodytype != 'athletic' && $bodytype != 'a little extra' && $bodytype != 'curvy' && $bodytype != 'slim' && $bodytype != 'average' && $bodytype != 'jacked' && $bodytype != '...') {
			die($bodytype);
			 
			}
	if ($employment != 'student' && $employment != 'full time' && $employment != 'part time' && $employment != 'unemployed' && $employment != '...' && $employment != 'self employed') {
			die($employment);
			 
			}
	if ($alcohol != 'heavy drinker' && $alcohol != 'social drinker' && $alcohol != 'dont drink' && $alcohol != '...') {
          die($alcohol);
	}
	if ($feet > 7 && $feet < 3 && $feet != '...') {
			die($feet);
			}
	if ($inches > 11 && $inches < 0 && $inches != '...') {
			die($inches);
               			 
			}
			$feet = strval($feet);
			$inches = strval($inches);
     $height = $feet.'"'.$inches."'";     
	
	if ($haircolor != 'Blonde' && $haircolor != 'Brown' && $haircolor != 'Red' && $haircolor != 'White' && $haircolor != 'Black' && $haircolor != '...') {
			die($haircolor);
			 
			}
	if ($lookingfor != 'Guy' && $lookingfor != 'Girl' && $lookingfor != 'Guy and Girl' && $lookingfor != '...' ) {
			die($lookingfor);
			}
	if ($children != 'Yes' && $children != 'No' && $children != 'Maybe later' && $childen != '...') {
			die($children);
			}
	if ($education != 'High school' && $education != 'College' && $education != 'GED' && $education != '...') {
			die($education);
			 
			}
	if ($zodiac != 'Aquarius' && $zodiac != 'Pisces' && $zodiac != 'Aries' && $zodiac != 'Taurus' && $zodiac != 'Gemini' && $zodiac != 'Cancer' && $zodiac != 'Leo' && $zodiac != 'Virgo' && $zodiac != 'Libra' && $zodiac != 'Scorpio' && $zodiac != 'Sagittarius' && $zodiac != 'Capricorn' && $zodiac != '...') {
			die($zodiac);
			 
			}
     if ($smoker != 'Yes' && $smoker != 'No' && $smoker != 'trying to quit' && $smoker != '...') {
			die($smoker);
			
			}
	
	$ethnicity = cleanInput($ethnicity);
	$bodytype = cleanInput($bodytype);
	$employment = cleanInput($employment);
	$feet = cleanInput($feet);
	$inches = cleanInput($inches);
	foreach ($languages as $value) {
               $value = cleaninput($value);
          }
	$haircolor = cleanInput($haircolor);
	$eyecolor = cleanInput($eyecolor);
	$lookingfor = cleanInput($lookingfor);
	$children = cleanInput($children);
	$education = cleanInput($education);
	$zodiac = cleanInput($zodiac);
	$smoker = cleanInput($smoker);	

	
	
     $sql = "UPDATE TeeckleUserProfile ";
     $count = '';
     $params = array();
     $sql .= 'SET';


     if ($ethnicity != null) {
          $sql .= ' `ethnicity` = ?,';
          $params[] = $ethnicity;
     }

     if ($bodytype != null) {
          $sql .= ' `bodytype` = ?,';
          $params[] = $bodytype;
     }

     if ($employment != null) {
          $sql .= ' `employment` = ?,';
          $params[] = $employment;
     }

     if ($height != null) {
          $sql .= ' `height` = ?,';
          $params[] = $height;
     }

     if ($haircolor != null) {
          $sql .= ' `haircolor` = ?,';
          $params[] = $haircolor;
     }
	 
	 if ($eyecolor != null) {
          $sql .= ' `eyecolor` = ?,';
          $params[] = $eyecolor;
     }
	 
	 if ($lookingfor != null) {
          $sql .= ' `lookingfor` = ?,';
          $params[] = $lookingfor;
     }
	 
	 if ($children != null) {
          $sql .= ' `children` = ?,';
          $params[] = $children;
     }
     
	 if ($education != null) {
          $sql .= ' `education` = ?,';
          $params[] = $education;
     }
	 
	 if ($zodiac != null) {
          $sql .= ' `zodiac` = ?,';
          $params[] = $zodiac;
     }
	 
	 if ($smoker != null) {
          $sql .= ' `smoker` = ?,';
          $params[] = $smoker;
     }
     if ($alcohol != null) {
          $sql .= ' `alcohol` = ?,';
          $params[] = $alcohol;
     }
     if (!empty($languages)) {
          $sql .= ' `languages` = ?,';
          $string = '';
          foreach ($languages as $value) {
               if ($value != '...') {
                    $string .= ' '.$value.',';
               }
          }
          $index = (strlen($string) - 1); 
     $string = substr_replace($string,' ',$index);
          $params[] = $string;
     }

     $index = (strlen($sql) - 1); 
     $sql = substr_replace($sql,' ',$index);
     $sql .= 'WHERE `TeeckleUsern` = "'.$username.'"';

	
     try {
          $conn = new PDO('mysql:host='.$host.';dbname='.$dbn, $DBusername, $DBpassword);
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $stmt = $conn->prepare($sql);
          $stmt->execute($params);
     }
     catch (PDOException $e) {
          $mysqlerror = true;
          die ($e);
     }
     if ($mysqlerror == false) {
     echo "Your info was successfully changed";
     }
?>
