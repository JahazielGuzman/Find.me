<?php

     session_start();
     $parms = array();
     $currentuser = htmlentities(trim($_COOKIE["teeckle_user"]));
     $teeckler = htmlentities(trim($_POST['teeckler']));

     if (!get_magic_quotes_gpc) {
        $currentuser = addslashes($currentuser);
        $teeckler = addslashes($teeckler);
     }

     $params = array($currentuser,$sendto);
     
     require_once 'connect.php';
     $success = true;
     $sql = "DELETE FROM teeckle_table WHERE teeckled = ? AND teeckler = ?";
     try {
          $conn = new PDO('mysql:host='.$host.';dbname='.$dbn, $DBusername, $DBpassword);
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $stmt = $conn -> prepare($sql); 
          $stmt->execute(array($currentuser,$teeckler));
          $result = $stmt -> fetchAll();
     }
     catch (PDOException $e) {
          $success = false;
          die ($e->getMessage());    
     }
     if ($success == true) {
          echo 'success';
     }
?>


