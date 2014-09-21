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
     $sql = "DELETE FROM groups WHERE admin = ? AND groupid = ?";
     $sql2 = "DELETE FROM members WHERE mgroupid = ?";
     $sql3 = "DELETE FROM pic_table WHERE user = ?";
     $sql4 = "DELETE FROM discussion WHERE groupcon = ?";
     $sql5 = "DELETE FROM discussion_post WHERE dgroupid = ?";
     try {
          $conn = new PDO('mysql:host='.$host.';dbname='.$dbn, $DBusername, $DBpassword);
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $stmt = $conn -> prepare($sql); 
          $stmt->execute($params);
          $stmt = $conn -> prepare($sql2); 
          $stmt->execute($group);
          $stmt = $conn -> prepare($sql3); 
          $stmt->execute($group);
          $stmt = $conn -> prepare($sql4); 
          $stmt->execute($group);
          $stmt = $conn -> prepare($sql5); 
          $stmt->execute($group);
          
     }
     catch (PDOException $e) {
          $success = false;
          echo "fail";    
     }
     if ($success == true) {
          echo "https://teeckle.me/groups.php";
          $myFile = "/home/content/24/9456524/html/groups/".$group.".php";
          unlink ($myFile);
     }
?>


