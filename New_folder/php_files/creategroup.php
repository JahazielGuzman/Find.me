<?php

     session_start();
     $admin = $_SESSION['teeckle_user'];
     $die = false;
     if (!isset($_POST['groupName'],$_POST['description'],$_POST['country'],$_POST['zip'],$_POST['privacy'],$_POST['cat']))  {
          $die = true;
          die ('The fields were empty');
     }
     
     $gn = trim($_POST["groupName"]);
     $desc = trim($_POST["description"]);
     $country = trim($_POST["country"]);
     $zipcit = trim($_POST["zip"]);
     $priv = trim($_POST["privacy"]);
     $cat = $_POST["cat"];

     if (!get_magic_quotes_gpc) {
          $gn = addslashes($gn);
          $desc = addslashes ($desc);
          $country = addslashes ($country);
          $zipcit = addslashes ($zipcit);
          $priv = addslashes ($priv);
         
     }

     function cleaninput($input){
			$input=trim($input);
			$input=htmlentities($input);
		return($input);
	}

	     $gn = cleaninput($gn);
          $desc = cleaninput ($desc);
          $country = cleaninput ($country);
          $zipcit = cleaninput ($zipcit);
          $priv = cleaninput ($priv);
          
          $params = array($gn,$admin,$desc,$country,$zipcit,$priv);
          
          if (!empty($cat)) {
          $string = '';
          foreach ($cat as $value) {
               if ($value != '...') {
                    $string .= $value.',';
               }
          }
          $params[] = $string;
     }


     $sql = "INSERT INTO groups (groupname, admin, descript, country, cityg, privacy, category) VALUES (?,?,?,?,?,?,?)";
     $sql2 = "INSERT INTO members (mgroupid,member) VALUES (?,?)";
     require_once 'connect.php';
     
     try {
          $conn = new PDO('mysql:host='.$host.';dbname='.$dbn, $DBusername, $DBpassword);
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $stmt = $conn->prepare($sql);
          $stmt -> execute($params);
          $sql = "SELECT groupid FROM groups WHERE groupname = ?";
          $stmt = $conn -> prepare($sql);
          $stmt -> execute(array($gn));
          $result = $stmt -> fetch();
          $stmt = $conn -> prepare($sql2);
          $stmt -> execute(array($result[0],$admin));
     }
     
     catch(PDOException $e) {
          die ('fail');
     }

     $myFile = "/home/content/24/9456524/html/groups/".$result[0].".php";
     $fh = fopen($myFile, 'w') or die("fail");
     $stringData = file_get_contents("copygroup.php");
     fwrite($fh, $stringData);
     fclose($fh);
     
     if ($die == false) {
          echo 'https://teeckle.me/groups/'.$result[0].'.php';
     }
?>
