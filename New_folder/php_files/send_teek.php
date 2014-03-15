<?php
     session_start();
     $parms = array();
     $currentuser = htmlentities(trim($_SESSION["teeckle_user"]));
     $sendto = htmlentities(trim($_POST["visited"]));
     $checked = 1;

     if (!get_magic_quotes_gpc) {
        $currentuser = addslashes($currentuser);
        $sendto = addslashes ($sendto);
     }

     $params = array($currentuser,$sendto);
     
     require_once 'connect.php';
     $success = true;
     $sql = "INSERT INTO teeckle_table (teeckler,teeckled) VALUES (?,?)";
     try {
          $conn = new PDO('mysql:host='.$host.';dbname='.$dbn, $DBusername, $DBpassword);
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $stmt = $conn -> prepare($sql); 
          $stmt->execute($params);
     }
     catch (PDOException $e) {
          $success = false;
          die ($e->getMessage());    
     }
     if ($success = true) {
          echo "Your teeckle to ".$sendto." has been sent successfully";
     }
?>
