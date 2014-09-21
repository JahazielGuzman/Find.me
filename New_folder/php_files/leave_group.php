<?php

     session_start();
     $parms = array();
     $currentuser = htmlentities(trim($_SESSION["teeckle_user"]));
     $group = htmlentities(trim($_POST['group']));

     if (!get_magic_quotes_gpc) {
        $currentuser = addslashes($currentuser);
        $group = addslashes($group);
     }

     $params = array($currentuser,$group);
     
     require_once 'connect.php';
     $success = true;
     $sql = "DELETE FROM members WHERE member = ? AND groupid = ?";
     try {
          $conn = new PDO('mysql:host='.$host.';dbname='.$dbn, $DBusername, $DBpassword);
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $stmt = $conn -> prepare($sql); 
          $stmt->execute($params);
     }
     catch (PDOException $e) {
          $success = false;
          echo "fail";    
     }
     if ($success == true) {
          echo "success";
     }
?>
